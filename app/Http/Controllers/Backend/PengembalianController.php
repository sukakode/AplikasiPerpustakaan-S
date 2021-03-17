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
}
