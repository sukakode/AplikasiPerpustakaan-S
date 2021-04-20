<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Book;
use PDF;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $buku = Book::orderBy('created_at', 'DESC')->get();
      $trashed = Book::orderBy('deleted_at', 'DESC')->onlyTrashed()->get();
      return view('backend.buku.index', compact('buku', 'trashed'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('backend.buku.create');
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
        'judul' => 'required|string|max:50',
        'penerbit' => 'required|string|max:50',
        'pengarang' => 'required|string|max:50',
        'tahun' => 'required|numeric|digits_between:4,4',
      ], [
        'required' => 'Kolom :attribute Wajib di-Isi !',
        'max' => 'Jumlah Maximal Karakter :attribute adalah :max !',
        'numeric' => 'Isi-an Data :attribute Harus Berupa Angka !',
        'digits_between' => 'Isi-an Data :attribute Harus 4 Digit !', 
      ]);

      try {
        $buku = Book::firstOrCreate($request->except(['_token']));

        session()->flash('success', 'Data Buku Berhasil di-Tambahkan !');
        return redirect(route('buku.index'));
      } catch (\Exception $e) {
        session()->flash('error', 'Terjadi Kesalahan Saat Menyimpan Data !');
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
        $data = Book::findOrFail($id);

        return view('backend.buku.edit', compact('data'));
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
        'judul' => 'required|string|max:50',
        'pengarang' => 'required|string|max:50',
        'penerbit' => 'required|string|max:50',
        'tahun' => 'required|numeric|digits_between:4,4',
      ],
      [
        'required' => 'Kolom :attribute Wajib di-Isi !',
        'max' => 'Jumlah Maximal Karakter :attribute adalah :max !',
        'numeric' => 'Isi-an Data :attribute Harus Berupa Angka !',
        'digits_between' => 'Isi-an Data :attribute Harus 4 Digit !', 
      ]);

      try {
        $buku = Book::findOrFail($id);
        $buku->update($request->except(['_token', '_method']));

        session()->flash('info', 'Data Buku Berhasil di-Ubah !');
        return redirect(route('buku.index'));
      } catch (\Exception $th) {
        session()->flash('error', 'Terjadi Kesalahan Menyimpan Perubahan Data Buku !');
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
        $buku = Book::withTrashed()->findOrFail($id);
        if (!$buku->trashed()) {
          $buku->delete();
          session()->flash('warning', 'Data Buku di-Hapus !');
        } else {
          session()->flash('error', 'Data Buku di-Hapus Permanen !');
          $buku->forceDelete();
        }

        return redirect(route('buku.index'));
      } catch (\Exception $e) {
        session()->flash('error', 'Terjadi Kesalahan Saat Menghapus Data Buku !');
        return redirect()->back();
      }
    }

    public function restore($id)
    {
      try {
        $buku = Book::onlyTrashed()->findOrFail($id);
        $buku->restore();

        session()->flash('success', 'Berhasil Memulihkan Data Buku !');
        return redirect(route('buku.index'));
      } catch (\Exception $e) {
        session()->flash('error', 'Terjadi Kesalahan Saat Memulihkan Data Buku !');
        return redirect()->back();
      }
    }

    public function print()
    {
      $tgl = date('d/m/Y H:i:s');
      $data = Book::orderBy('created_at', 'DESC')->get();
      $pdf = PDF::loadview('backend.print.buku', compact('tgl', 'data'));
      return $pdf->stream();
    }

    public function report()
    {
      $buku = Book::withTrashed()->orderBy('created_at', 'DESC')->get();
      return view('backend.buku.report', compact('buku'));
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
          $data = Book::withTrashed()->whereBetween('created_at', [$tgl_awal, $tgl_akhir])->orderBy('judul')->get();
          $trash = true;
        } else {
          $data = Book::whereBetween('created_at', [$tgl_awal, $tgl_akhir])->orderBy('judul')->get();
        }  

        $tgl = date('d/m/Y H:i:s');
        $tgl_awal = date('d/m/Y', strtotime($tgl_awal));
        $tgl_akhir = date('d/m/Y', strtotime($tgl_akhir));
        $pdf = PDF::loadview('backend.print.buku', compact('tgl', 'data', 'trash', 'tgl_awal', 'tgl_akhir'));
        return $pdf->stream();
      } catch (\Exception $e) {
        session()->flash('error', 'Terjadi Kesalahan !');
        return redirect()->back();
      }
    }
}
