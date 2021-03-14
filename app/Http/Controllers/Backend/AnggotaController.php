<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Member;
use PDF;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $anggota = Member::orderBy('created_at', 'DESC')->get();
      $trashed = Member::orderBy('deleted_at', 'DESC')->onlyTrashed()->get();
      return view('backend.anggota.index', compact('anggota', 'trashed'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('backend.anggota.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->validate($request, [
        'nama_anggota' => 'required|string|max:50',
        'telp_anggota' => 'required|numeric|digits_between: 10, 14',
        'alamat_anggota' => 'required|string|max:100',
      ],[
        'required' => 'Kolom :attribute Wajib di-Isi !',
        'max' => 'Isi-an :attribute Tidak Boleh Lebih Dari :max Karakter !',
        'digits_between' => 'Isi-an Angka Harus Memiliki Jumlah Karakter Antara 10 - 14 Karakter', 
      ]);

      try {
        $anggota = Member::firstOrCreate($request->except(['_token']));

        session()->flash('success', 'Berhasil Menambah Data Anggota !');
        return redirect(route('anggota.index'));
      } catch (\Exception $e) {
        session()->flash('error', 'Terjadi Kesalahan Saat Menyimpan Data Anggota !');
        return redirect()->back();
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      try {
        $data = Member::findOrFail($id);

        return view('backend.anggota.edit', compact('data'));
      } catch (\Exception $e) {
        session()->flash('error', 'Terjadi Kesalahan !');
        return redirect()->back();
      }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $this->validate($request, [
        'nama_anggota' => 'required|string|max:50',
        'telp_anggota' => 'required|numeric|digits_between: 10, 14',
        'alamat_anggota' => 'required|string|max:100',
      ],[
        'required' => 'Kolom :attribute Wajib di-Isi !',
        'max' => 'Isi-an :attribute Tidak Boleh Lebih Dari :max Karakter !',
        'digits_between' => 'Isi-an Angka Harus Memiliki Jumlah Karakter Antara 10 - 14 Karakter', 
      ]);
      
      try {
        $anggota = Member::findOrFail($id); 

        $anggota->update($request->except(['_token', '_method']));
        session()->flash('info', 'Data Anggota Berhasil di-Tambahkan !');
        return redirect(route('anggota.index'));
      } catch (\Exception $e) {
        session()->flash('error', 'Terjadi Kesalahan Saat Menyimpan Perubahan Data !');
        return redirect()->back();
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      try {
        $anggota = Member::withTrashed()->findOrFail($id);
        if (!$anggota->trashed()) {
          $anggota->delete();
          session()->flash('warning', 'Data Anggota Berhasil di-Hapus !');
        } else {
          $anggota->forceDelete();
          session()->flash('error', 'Data Anggota Berhasil di-Hapus Permanen !');
        }

        return redirect(route('anggota.index'));
      } catch (\Exception $e) {
        session()->flash('error', 'Terjadi Kesalahan !');
        return redirect()->back();
      }
    }
    
    public function restore($id)
    {
      try {
        $anggota = Member::onlyTrashed()->findOrFail($id);
        $anggota->restore();

        session()->flash('success', 'Berhasil Memulihkan Data Anggota !');
        return redirect(route('anggota.index'));
      } catch (\Exception $e) {
        session()->flash('error', 'Terjadi Kesalahan Saat Memulihkan Data Anggota !');
        return redirect()->back();
      }
    }

    public function print()
    {
      $tgl = date('d/m/Y H:i:s');
      $data = Member::orderBy('created_at', 'DESC')->get();
      $pdf = PDF::loadview('backend.print.anggota', compact('tgl', 'data'));
      return $pdf->stream();
    }
}
