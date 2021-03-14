<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use PDF;

class PetugasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $petugas = User::orderBy('created_at', 'DESC')->get();
      $trashed = User::orderBy('deleted_at', 'DESC')->onlyTrashed()->get();
      return view('backend.petugas.index', compact('petugas', 'trashed'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $roles = Role::orderBy('created_at', 'ASC')->get();
      return view('backend.petugas.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $request->merge([
        'email' => $request->email . '@mail.com'
      ]);

      $this->validate($request, [
        'name' => 'required|string|max:100',
        'email' => 'required|string|email|max:100|unique:users',
        'password' => 'required|string|min:8|confirmed',
        'role' => 'required|string|exists:roles,name',
      ],[
        'required' => 'Kolom :attribute Wajib di-Isi !',
        'max' => 'Maximal Karakter :attribute Tidak Boleh Lebih Dari :max !',
        'unique' => ':attribute Sudah di-Pakai / Sudah Ada !',
        'min' => 'Minimal Karakter :attribute Harus Lebih Dari :min Karakter !',
        'confirmed' => 'Konfirmasi Password Tidak Sama !',
        'exists' => 'Data :attribute Tidak Ada Pada Tabel Yang Bersangkutan !',
      ]);

      $request->merge([
        'password' => Hash::make($request->password),
      ]);

      try {
        $petugas = User::firstOrCreate($request->except(['_token', 'role', 'password_confirmation']));
        $petugas->assignRole($request->role);

        session()->flash('success', 'Data Petugas Berhasil di-Tambahkan !');
        return redirect(route('petugas.index'));
      } catch (\Exception $e) {
        dd($e);
        session()->flash('error', 'Terjadi Kesalahan Saat Menambahkan Data Petugas !');
        return redirect()->back()->withInput($request->all());
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
        $roles = Role::orderBy('created_at', 'ASC')->get();
        $data = User::findOrFail($id);

        return view('backend.petugas.edit', compact('roles', 'data'));
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
      try {
        $user = User::findOrFail($id);
      } catch (\Exception $e) {
        session()->flash('error', 'Terjadi Kesalahan Saat Menyimpan Perubahan Data Petugas !');
        return redirect()->back()->withInput($request->all());
      }
      
      $request->merge([
        'email' => $request->email . '@mail.com'
      ]);

      $validation_message = [
        'required' => 'Kolom :attribute Wajib di-Isi !',
        'max' => 'Maximal Karakter :attribute Tidak Boleh Lebih Dari :max !',
        'unique' => ':attribute Sudah di-Pakai / Sudah Ada !',
        'min' => 'Minimal Karakter :attribute Harus Lebih Dari :min Karakter !',
        'confirmed' => 'Konfirmasi Password Tidak Sama !',
        'exists' => 'Data :attribute Tidak Ada Pada Tabel Yang Bersangkutan !',
      ];

      $this->validate($request, [
        'name' => 'required|string|max:100',
        'email' => 'required|string|email|max:100|unique:users,email,'.$user->id,
        'role' => 'required|string|exists:roles,name',
      ], $validation_message);

      if ($request->password != "") {
        $this->validate($request, [
          'password' => 'required|string|min:8|confirmed',
        ], $validation_message);

        $password = Hash::make($request->password);
      } else {
        $password = $user->password;
      }

      $request->merge([
        'password' => $password
      ]);

      try {
        $user->update($request->except(['_token', 'role', 'password_confirmation', '_method']));
        
        session()->flash('info', 'Data Petugas Berhasil di-Ubah.');
        return redirect(route('petugas.index'));
      } catch (\Exception $e) {
        session()->flash('error', 'Terjadi Kesalahan Saat Menyimpan Perubahan Data Petugas !');
        return redirect()->back()->withInput($request->all());
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
        $user = User::withTrashed()->findOrFail($id);
        if (!$user->trashed()) {
          $user->delete();
          session()->flash('warning', 'Data Petugas di-Hapus !');
        } else {
          $user->forceDelete();
          session()->flash('error', 'Data Petugas di-Hapus Permanen !');
        }

        return redirect(route('petugas.index'));
      } catch (\Exception $e) {
        session()->flash('error', 'Terjadi Kesalahan Saat Menghapus Data Petugas !');
        return redirect()->back();
      }
    }

    public function restore($id)
    {
      try {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->restore();

        session()->flash('success', 'Data Petugas Berhasil di-Pulihkan !');
        return redirect(route('petugas.index'));
      } catch (\Exception $e) {
        session()->flash('error', 'Terjadi Kesalahan Saat Memulihkan Data Petugas !');
        return redirect()->back();
      }
    }

    public function print()
    {
      $tgl = date('d/m/Y H:i:s');
      $data = User::orderBy('created_at', 'ASC')->get(); 
      $pdf = PDF::loadview('backend.print.petugas', compact('tgl', 'data'));
      return $pdf->stream();
    }
}
