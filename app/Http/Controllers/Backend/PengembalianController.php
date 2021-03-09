<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BorrowHeader;
use App\Models\LoanReturn;

class PengembalianController extends Controller
{
  public function index()
  {
    $pengembalian = LoanReturn::orderBy('created_at', 'DESC')->get();
    return view('backend.pengembalian.index', compact('pengembalian'));
  }

  public function create(BorrowHeader $peminjaman)
  {
    return view('backend.pengembalian.create', compact('peminjaman'));
  }

  public function destroy(LoanReturn $pengembalian)
  {
    // dd(session()->previousUrl());
    try {
      $pengembalian->delete();
      
      session()->flash('warning', 'Data Pengembalian di-Hapus !');
      return redirect(session()->previousUrl());
    } catch (\Exception $e) {
      session()->flash('error', 'Terjadi Kesalahan !');
      return redirect()->back();
    }
  }
}
