@extends('backend.layouts.master')

@section('content')
<div class="col-12">
  <div class="card card-outline card-primary">
    <div class="card-header">
      <h4 class="card-title">Edit Data Buku</h4>
      <div class="card-tools">
        <a href="{{ route('buku.index') }}" class="btn btn-danger btn-xs">
          <span class="fa fa-arrow-left"></span> &ensp; Kembali
        </a>
      </div>
    </div>
    <div class="card-body">
      <form action="{{ route('buku.update', $data->id) }}" method="post">
        @csrf
        @method('PUT')
        <div class="row">
          <div class="col-lg-12 col-xl-12">
            <div class="form-group">
              <label for="">Judul Buku : </label>
              <input type="text" name="judul" id="judul" class="form-control {{ $errors->has('judul') ? 'is-invalid':'' }}" placeholder="Masukan Judul Buku..." value="{{ $data->judul }}" required autofocus>
              <span class="invalid-feedback">
                {{ $errors->first('judul') }}
              </span>
            </div>
          </div>
          <div class="col-lg-5 col-xl-5">
            <div class="form-group">
              <label for="">Penerbit : </label>
              <input type="text" name="penerbit" id="penerbit" class="form-control {{ $errors->has('penerbit') ? 'is-invalid':'' }}" placeholder="Masukan Penerbit Buku..." value="{{ $data->penerbit }}" required>
              <span class="invalid-feedback">
                {{ $errors->first('penerbit') }}
              </span>
            </div>
          </div>
          <div class="col-lg-5 col-xl-5">
            <div class="form-group">
              <label for="">Pengarang : </label>
              <input type="text" name="pengarang" id="pengarang" class="form-control {{ $errors->has('pengarang') ? 'is-invalid':'' }}" placeholder="Masukan Pengarang..." value="{{ $data->pengarang }}" required>
              <span class="invalid-feedback">
                {{ $errors->first('pengarang') }}
              </span>
            </div>
          </div>
          <div class="col-lg-2 col-xl-2">
            <div class="form-group">
              <label for="">Tahun Terbit : </label>
              <input type="number" name="tahun" id="tahun" class="form-control {{ $errors->has('tahun') ? 'is-invalid':'' }}" placeholder="Masukan Tahun Terbit Buku..." min="1980" max="<?=date('Y')?>" step="1" value="{{ $data->tahun }}" required>
              <span class="invalid-feedback">
                {{ $errors->first('tahun') }}
              </span>
            </div>
          </div>
          <div class="col-lg-3 col-xl-3 mt-2">
            <button type="submit" class="btn btn-sm btn-success btn-block">
              <span class="fa fa-plus"></span> &ensp;
              Tambah Data Buku
            </button>
          </div>
          <div class="col-lg-3 col-xl-3 mt-2">
            <button type="reset" class="btn btn-danger btn-sm btn-block">
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