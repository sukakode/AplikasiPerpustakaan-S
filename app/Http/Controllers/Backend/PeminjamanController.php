<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BorrowDetail;
use App\Models\BorrowHeader;
use App\Models\Member;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use PDF;

class PeminjamanController extends Controller
{
  public function index()
  {
    $peminjaman = BorrowHeader::orderBy('created_at', 'DESC')->get();
    $trashed = BorrowHeader::onlyTrashed()->where('new_id', '=', null)->orderBy('deleted_at', 'DESC')->get();
    return view('backend.peminjaman.index', compact('peminjaman', 'trashed'));
  }

  public function create()
  {
    $anggota = Member::orderBy('nama_anggota', 'ASC')->get();
    return view('backend.peminjaman.create', compact('anggota'));
  }

  public function store(Request $request)
  {
    $this->validate($request, [
      'anggota_id' => 'required|numeric|exists:members,id',
      'buku_id' => 'required|array',
      'buku_id.*' => 'exists:books,id',
      'jumlah' => 'required|array',
      'jumlah.*' => 'min:1',
    ], [
      'required' => 'Data Tidak Boleh Kosong !',
      'exists' => 'Tidak di-Temukan Data Yang Bersangkutan !',
      'min' => 'Jumlah Data Minimal :min !',
    ]);

    try {
      $total = 0;
      foreach ($request->jumlah as $key => $value) {
        $total += $value;
      }
      DB::beginTransaction();
      $header = BorrowHeader::firstOrCreate([
        'tanggal_pinjam' => Carbon::now(),
        'total_buku' => count($request->buku_id),
        'total_pinjam' => $total,
        'user_id' => auth()->user()->id,
        'anggota_id' => $request->anggota_id,
      ]);

      foreach ($request->buku_id as $key => $value) {
        $cek = Book::findOrFail($value);
        $detail = BorrowDetail::firstOrCreate([
          'header_id' => $header->id,
          'buku_id' => $value,
          'jumlah' => $request->jumlah[$key]
        ]);
      }

      DB::commit();

      session()->flash('success', 'Data Peminjaman di-Tambahkan !');
      return redirect(route('peminjaman.index'));
    } catch (\Exception $e) {
      DB::rollback();
      session()->flash('error', 'Terjadi Kesalahan Saat Menyimpan Data - Silahkan Ulangi Input !');
      return redirect()->back()->withInput($request->all());
    }
  }

  public function edit(BorrowHeader $peminjaman)
  {
    $anggota = Member::orderBy('nama_anggota', 'ASC')->get();
    return view('backend.peminjaman.edit', compact('peminjaman', 'anggota'));
  }

  public function update(Request $request, BorrowHeader $peminjaman)
  {
    $this->validate($request, [
      'anggota_id' => 'required|numeric|exists:members,id',
      'buku_id' => 'required|array',
      'buku_id.*' => 'exists:books,id',
      'jumlah' => 'required|array',
      'jumlah.*' => 'min:1',
    ], [
      'required' => 'Data Tidak Boleh Kosong !',
      'exists' => 'Tidak di-Temukan Data Yang Bersangkutan !',
      'min' => 'Jumlah Data Minimal :min !',
    ]);

    try {
      $total = 0;
      foreach ($request->jumlah as $key => $value) {
        $total += $value;
      }
      DB::beginTransaction();

      // Insert New Data
      $header = BorrowHeader::firstOrCreate([
        'tanggal_pinjam' => $peminjaman->tanggal_pinjam,
        'total_buku' => count($request->buku_id),
        'total_pinjam' => $total,
        'user_id' => auth()->user()->id,
        'anggota_id' => $request->anggota_id,
        'edit_id' => $peminjaman->id,
      ]);

      foreach ($request->buku_id as $key => $value) {
        $cek = Book::withTrashed()->findOrFail($value);
        $detail = BorrowDetail::firstOrCreate([
          'header_id' => $header->id,
          'buku_id' => $value,
          'jumlah' => $request->jumlah[$key]
        ]);
      }

      // Delete The Latest Data
      foreach ($peminjaman->detail as $key => $value) {
        $value->delete();
      }
      $peminjaman->update([
        'new_id' => $header->id
      ]);
      $peminjaman->delete();

      $pengembalian = DB::table('loan_returns')->where('header_id', '=', $peminjaman->id)->update(['header_id' => $header->id]);

      DB::commit();
      session()->flash('warning', 'Data Transaksi Peminjaman di-Ubah !');
      return redirect(route('peminjaman.index'));
    } catch (\Exception $e) {
      DB::rollback();
      dd($e);
      session()->flash('error', 'Terjadi Kesalahan !');
      return redirect()->back();
    }
  }

  public function destroy(Request $request, $peminjaman)
  {
    try {
      $data = BorrowHeader::withTrashed()->findOrFail($peminjaman);
      if (!$data->trashed()) {
        $data->delete();
        session()->flash('warning', 'Data Peminjaman di-Hapus !');
      } else {
        session()->flash('error', 'Data Peminjaman di-Hapus Permanen !');
        $data->forceDelete();
      }

      return redirect(route('peminjaman.index'));
    } catch (\Exception $e) {
      session()->flash('error', 'Terjadi Kesalahan !');
      return redirect()->back();
    }
  }

  public function restore($id)
  {
    try {
      $peminjaman = BorrowHeader::onlyTrashed()->findOrFail($id);
      $peminjaman->restore();

      session()->flash('success', 'Berhasil Memulihkan Data Peminjaman !');
      return redirect(route('peminjaman.index'));
    } catch (\Exception $e) {
      session()->flash('error', 'Terjadi Kesalahan Saat Memulihkan Data Peminjaman Buku !');
      return redirect()->back();
    }
  }
  
  public function print()
  {
    $tgl = date('d/m/Y H:i:s');
    $data = BorrowHeader::with('detail')
      ->with('pengembalian')
      ->with('anggota')
      ->with('user')
      ->with('detail.buku')
      ->orderBy('created_at', 'DESC')
      ->get()->toArray(); 
    // dd($data);
    $pdf = PDF::loadview('backend.print.peminjaman', compact('tgl', 'data'));
    return $pdf->stream();
  }

  public function history(BorrowHeader $peminjaman)
  {
    return view('backend.peminjaman.history', [
      'header' => $peminjaman,
    ]);
  }

  public function report()
  {
    $peminjaman = BorrowHeader::withTrashed()->where('new_id', '=', null)->orderBy('created_at', 'DESC')->get();
    return view('backend.peminjaman.report', compact('peminjaman'));
  }

  public function reportPrint(Request $request)
  {
    try {
      $hapus = str_replace(" ", "", $request->tanggal);
      $hapus = str_replace("-", "/", $hapus);
      $explode = explode("/", $hapus);
      $tgl_awal = $explode[2] . '-' . $explode[1] . '-' . $explode[0];
      $tgl_akhir = $explode[5] . '-' . $explode[4] . '-' . $explode[3];
      
      $trash = false;
      if (isset($request->deleted) && $request->deleted !== null) {
        $data = BorrowHeader::withTrashed()->where('new_id', '=', null)->whereBetween('created_at', [$tgl_awal, $tgl_akhir])->orderBy('tanggal_pinjam')->get();
        $trash = true;
      } else {
        $data = BorrowHeader::whereBetween('created_at', [$tgl_awal, $tgl_akhir])->orderBy('tanggal_pinjam')->get();
      }  

      $tgl = date('d/m/Y H:i:s');
      $tgl_awal = date('d/m/Y', strtotime($tgl_awal));
      $tgl_akhir = date('d/m/Y', strtotime($tgl_akhir));

      $view = "backend.print.peminjaman";
      if (isset($request->detail) && $request->detail !== null) { 
        $view = "backend.print.peminjaman";
      } else {
        $view = "backend.print.peminjaman-wo";
      }

      $pdf = PDF::loadview($view, compact('tgl', 'data', 'trash', 'tgl_awal', 'tgl_akhir'));
      return $pdf->stream();
    } catch (\Exception $e) {
      session()->flash('error', 'Terjadi Kesalahan !');
      return redirect()->back();
    }
  }
}
