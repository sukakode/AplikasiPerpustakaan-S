@extends('backend.layouts.master')

@section('content')
<div class="col-12">
  <form action="{{ route('peminjaman.update', $peminjaman->id) }}" method="post">
    @csrf
    @method('PUT')
    <div class="card card-outline card-primary">
      <div class="card-header">
        <h4 class="card-title">Edit Peminjaman Buku</h4>
        <div class="card-tools">
          <a href="{{ route('peminjaman.index') }}" class="btn btn-xs btn-danger">
            <span class="fa fa-arrow-left"></span> &ensp; kembali
          </a>
          <button type="submit" class="btn btn-info btn-xs">
            <span class="fa fa-check"></span> &ensp; Simpan Perubahan Data
          </button>
        </div>
      </div>
      <div class="card-body">
          <div class="row">
            <div class="col-lg-4 col-xl-4">
              <div class="form-group">
                <label for="">Penginput Data : </label>
                <input type="text" name="user_id" id="user_id" class="form-control" value="{{ auth()->user()->name }}" readonly>
              </div>
            </div>
            <div class="col-lg-3 col-xl-3">
              <div class="form-group">
                <label for="">Tanggal Peminjaman : </label>
                <input type="date" name="tanggal_pinjam" id="tanggal_pinjam" class="form-control {{ $errors->has('tanggal_pinjam') ? 'is-invalid' : '' }}" value="{{ date('Y-m-d', strtotime($peminjaman->tanggal_pinjam)) }}" readonly>
                <span class="invalid-feedback">
                  {{ $errors->first('tanggal_pinjam') }}
                </span>
              </div>
            </div>
            <div class="col-lg-5 col-xl-5">
              <div class="form-group">
                <label for="">Anggota Peminjam : </label>
                <select name="anggota_id" id="anggota_id" class="form-control select2" data-placeholder="Pilih Data Peminjam" style="width: 100% !important;" required>
                  <option value=""></option>
                  @foreach ($anggota as $item)
                    <option value="{{ $item->id }}" {{ $peminjaman->anggota_id == $item->id ? 'selected':'' }}>{{ $item->nama_anggota }}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
          @livewire('peminjaman.cart')
      </div>
    </div>
  </form>

</div>
@endsection

@section('script')
<script>
  $(document).ready(function() {
    $('.select2').select2();

    window.livewire.emit('edit-data', '{{ $peminjaman->id }}');
  });
</script>
@endsection
