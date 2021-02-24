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

class PeminjamanController extends Controller
{
  public function index()
  {
    $peminjaman = BorrowHeader::orderBy('created_at', 'DESC')->get();

    return view('backend.peminjaman.index', compact('peminjaman'));
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
}
