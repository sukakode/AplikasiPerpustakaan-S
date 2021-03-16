@extends('backend.layouts.master')

@section('content')
<div class="col-12">
  <div class="card card-outline card-primary">
    <div class="card-header">
      <h4 class="card-title">Riwayat Pengubahan Data Peminjaman</h4>
      <div class="card-tools">
        <a href="{{ route('peminjaman.index') }}" class="btn btn-danger btn-xs">
          <span class="fa fa-arrow-left"></span> &ensp; Kembali
        </a>
      </div>
    </div>
    <div class="card-body p-1">
      @livewire('peminjaman.history', ['header' => $header])
    </div>
  </div>
</div>
@endsection