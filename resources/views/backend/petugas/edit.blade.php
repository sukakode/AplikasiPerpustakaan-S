@extends('backend.layouts.master')

@section('content')
<div class="col-12">
  <div class="card card-outline card-primary">
    <div class="card-header">
      <h4 class="card-title">Edit Data Petugas</h4>
      <div class="card-tools">
        <a href="{{ route('petugas.index') }}" class="btn btn-xs btn-danger">
          <span class="fa fa-arrow-left"></span> &ensp;
          Kembali
        </a>
      </div>
    </div>
    <div class="card-body">
      <form action="{{ route('petugas.update', $data->id) }}" method="post">
        @csrf
        @method('PUT')
        <div class="row">
          <div class="col-lg-6 col-xl-6">
            <div class="form-group">
              <label for="">Nama Petugas : </label>
              <input type="text" name="name" id="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" placeholder="Masukan Nama Petugas..." maxlength="50" value="{{ $data->name }}" required autofocus>
              <span class="invalid-feedback">
                {{ $errors->first('name') }}
              </span>
            </div>
          </div>
          <div class="col-lg-6 col-xl-6">
            <div class="form-group">
              <label for="">E-Mail Petugas : </label>
              <div class="input-group">
                <input type="text" name="email" id="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" placeholder="Masukan E-Mail Petugas..." maxlength="100" value="{{ str_replace('@mail.com', '', $data->email) }}" required>
                <div class="input-group-append">
                  <span class="input-group-text">@mail.com</span>
                </div>
                <span class="invalid-feedback">
                  {{ $errors->first('email') }}
                </span>
              </div>
            </div>
          </div>
          <div class="col-lg-5 col-xl-5">
            <div class="form-group">
              <label for="">Password Petugas :</label>
              <input type="password" name="password" id="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="Masukan Password Petugas" maxlength="100">
              <i class="text-secondary text-sm">* Kosongkan Bila Tidak Ingin Merubah Password Petugas.</i>
              <span class="invalid-feedback">
                {{ $errors->first('password') }}
              </span>
            </div>
          </div>
          <div class="col-lg-5 col-xl-5">
            <div class="form-group">
              <label for="">Konfirmasi Password :</label>
              <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Tulis Ulang Password...">
              <i class="text-secondary text-sm">* Masukan Konfirmasi Password Baru Bila di-Ubah.</i>
            </div>
          </div>
          <div class="col-lg-2 col-xl-2">
            <div class="form-group">
              <label for="">Level Petugas : </label>
              <select name="role" id="role" class="form-control {{ $errors->has('role') ? 'is-invalid' : '' }}" required>
                <option value="">- Pilih Level -</option>
                @foreach ($roles as $item)
                  <option value="{{ $item->name }}" {{ $data->getRoleNames()->first() == $item->name ? 'selected':'' }}>{{ $item->name }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="col-lg-4 col-xl-4 mt-2">
            <button type="submit" class="btn btn-sm btn-success btn-block">
              <span class="fa fa-plus"></span> &ensp;
              Simpan Perubahan Petugas
            </button>
          </div>
          <div class="col-lg-3 col-xl-3 mt-2">
            <button type="reset" class="btn btn-sm btn-danger btn-block">
              <span class="fa fa-undo"></span> &ensp;
              Reset Input
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection