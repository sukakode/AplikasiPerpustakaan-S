@extends('backend.layouts.master')

@section('content')
<div class="col-12">
  <div class="card card-outline card-primary">
    <div class="card-header">
      <h4 class="card-title">Tambah Data Anggota</h4>
      <div class="card-tools">
        <a href="{{ route('anggota.index') }}" class="btn btn-xs btn-danger">
          <span class="fa fa-arrow-left"></span> &ensp;
          Kembali
        </a>
      </div>
    </div>
    <div class="card-body">
      <form action="{{ route('anggota.update', $data->id) }}" method="post">
        @csrf
        @method('PUT')
        <div class="row">
          <div class="col-lg-7 col-xl-7">
            <div class="form-group">
              <label for="">Nama Anggota : </label>
              <input type="text" name="nama_anggota" id="nama_anggota" class="form-control {{ $errors->has('nama_anggota') ? 'is-invalid':'' }}" maxlength="50" placeholder="Masukan Nama Anggota..." value="{{ $data->nama_anggota }}" required autofocus>
              <span class="invalid-feedback">
                {{ $errors->first('nama_anggota') }}
              </span>
            </div>
          </div>
          <div class="col-lg-5 col-xl-5">
            <div class="form-group">
              <label for="">Telpon Anggota : </label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">(+62)</span>
                </div>
                <input type="text" pattern="\d*" name="telp_anggota" id="telp_anggota" class="form-control {{ $errors->has('telp_anggota') ? 'is-invalid':'' }}" minlength="10" maxlength="14" placeholder="Masukan Nomor Telp Anggota..." value="{{ $data->telp_anggota }}" required>
                <span class="invalid-feedback">
                  {{ $errors->first('telp_anggota') }}
                </span>
              </div>
            </div>
          </div>
          <div class="col-lg-12 col-lx-12">
            <div class="form-group">
              <label for="">Alamat Anggota : </label>
              <textarea name="alamat_anggota" id="alamat_anggota" cols="1" rows="1" class="form-control {{ $errors->has('alamat_anggota') }}" placeholder="Masukan Alamat Anggota..." required>{{ $data->alamat_anggota }}</textarea>
              <span class="invalid-feedback">
                {{ $errors->first('alamat_anggota') }}
              </span>
            </div>
          </div>
          <div class="col-lg-3 col-xl-3 mt-2">
            <button type="submit" class="btn btn-sm btn-success btn-block">
              <span class="fa fa-plus"></span> &ensp;
              Simpan Perubahan Anggota
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