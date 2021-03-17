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
    <div class="card-body">
      <div class="row">
        <div class="col-12">
          <h6 class="font-weight-bold"> <span class="fa fa-check text-primary"></span> &ensp; Data Saat Ini</h6>
          <hr>
        </div>
        <div class="col-lg-6 col-xl-6 mb-2 pl-4 pr-4">
          <h6>Tanggal Peminjaman : {{ date('d/m/Y', strtotime($header->tanggal_pinjam)) }}</h6>
          <h6>Penginput Data : {{ $header->user->name }}</h6>
          <h6>Nama Peminjam : {{ $header->anggota->nama_anggota }}</h6>
          <h6>Total Buku : {{ $header->total_buku }} Judul</h6>
          <h6>Jumlah Buku : {{ $header->total_pinjam }} Buku</h6>
          @if ($header->deleted_at != null) 
            <span class="badge badge-danger">
              &ensp; <i class="fa fa-trash"></i> &ensp; Data Trashed &ensp;
            </span>
          @else
            <h6>
              Status : &ensp;
              @if ($header->pengembalian)
                <span class="badge badge-success">
                  &ensp; <i class="fa fa-check"></i> &ensp; Sudah di-Kembalikan &ensp;
                </span>
              @else
                <span class="badge badge-danger">
                  &ensp; <i class="fa fa-times"></i> &ensp; Belum di-Kembalikan &ensp;
                </span>
              @endif
              
              @if ($header->edit_id != null)
              <span class="badge badge-info">
                &ensp; <i class="fa fa-edit"></i> &ensp; Data Pernah di-Edit / di-Ubah
              </span>
              @endif
            </h6>
          @endif
        </div>
        <div class="col-lg-6 col-xl-6 mb-2 pl-4 pr-4">
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th class="text-center">No.</th>
                  <th class="text-center">Judul</th>
                  <th class="text-center">Jumlah</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($header->detail as $item)
                  <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td class="text-center">{{ $item->buku->judul }}</td>
                    <td class="text-center">{{ $item->jumlah }} Buku</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <hr>
      @livewire('peminjaman.history', ['header' => $header])
    </div>
  </div>
</div>
@endsection

@section('script')
<script>
  $(document).ready(function() {
    window.livewire.emit('get-history', '{{ $header->edit_id }}');
  });
</script>
@endsection