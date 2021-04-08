<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BorrowHeader;
use App\Models\LoanReturn;
use PDF;

class PengembalianController extends Controller
{
  public function index()
  {
    $pengembalian = LoanReturn::orderBy('created_at', 'DESC')->get();
    $trashed = LoanReturn::onlyTrashed()->where('new_id', '=', null)->orderBy('deleted_at', 'DESC')->get();
    return view('backend.pengembalian.index', compact('pengembalian', 'trashed'));
  }

  public function create(BorrowHeader $peminjaman)
  {
    return view('backend.pengembalian.create', compact('peminjaman'));
  }

  public function destroy($pengembalian)
  { 
    try { 
      $data = LoanReturn::withTrashed()->findOrFail($pengembalian);
      if (!$data->trashed()) {
        $data->delete();
        session()->flash('warning', 'Data Pengembalian di-Hapus !');
      } else {
        session()->flash('error', 'Data Pengembalian di-Hapus Permanen !');
        $data->forceDelete();
      } 
      
      return redirect(session()->previousUrl());
    } catch (\Exception $e) {
      session()->flash('error', 'Terjadi Kesalahan !');
      return redirect()->back();
    }
  }
  
  public function restore($id)
  {
    try {
      $pengembalian = LoanReturn::onlyTrashed()->findOrFail($id);
      $pengembalian->restore();

      session()->flash('success', 'Berhasil Memulihkan Data Pengembalian !');
      return redirect(route('pengembalian.index'));
    } catch (\Exception $e) {
      session()->flash('error', 'Terjadi Kesalahan Saat Memulihkan Data Pengembalian Buku !');
      return redirect()->back();
    }
  }

  public function print()
  {
    $tgl = date('d/m/Y H:i:s');
    $data = LoanReturn::orderBy('created_at', 'ASC')->get(); 
    // dd($data->sum('denda_lainnya'));
    $pdf = PDF::loadview('backend.print.pengembalian', compact('tgl', 'data'));
    return $pdf->stream();
  }

  public function history(LoanReturn $pengembalian)
  {
    return view('backend.pengembalian.history', [
      'loan' => $pengembalian,
    ]);
  }

  public function report()
  {
    $pengembalian = LoanReturn::orderBy('created_at', 'DESC')->get();
    $trashed = LoanReturn::onlyTrashed()->where('new_id', '=', null)->orderBy('deleted_at', 'DESC')->get();
    return view('backend.pengembalian.report', compact('pengembalian', 'trashed')); 
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
        $data = LoanReturn::withTrashed()->where('new_id', '=', null)->whereBetween('created_at', [$tgl_awal, $tgl_akhir])->orderBy('tgl_kembali')->get();
        $trash = true;
      } else {
        $data = LoanReturn::whereBetween('created_at', [$tgl_awal, $tgl_akhir])->orderBy('tgl_kembali')->get();
      }  

      $tgl = date('d/m/Y H:i:s');
      $tgl_awal = date('d/m/Y', strtotime($tgl_awal));
      $tgl_akhir = date('d/m/Y', strtotime($tgl_akhir));

      $view = "backend.print.pengembalian";
      // if (isset($request->detail) && $request->detail !== null) { 
      //   $view = "backend.print.pengembalian";
      // } else {
      //   $view = "backend.print.pengembalian-wo";
      // }

      $pdf = PDF::loadview($view, compact('tgl', 'data', 'trash', 'tgl_awal', 'tgl_akhir'));
      return $pdf->stream();
    } catch (\Exception $e) {
      session()->flash('error', 'Terjadi Kesalahan !');
      return redirect()->back();
    }
  }
}
