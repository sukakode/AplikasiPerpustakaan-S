@extends('backend.layouts.master')

@section('content')
<div class="col-12">
  <div class="card card-outline card-primary">
    <div class="card-header">
      <h4 class="card-title">Riwayat Pengubahan Data Pengembalian</h4>
      <div class="card-tools">
        <a href="{{ route('pengembalian.index') }}" class="btn btn-danger btn-xs">
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
          <div class="table-responsive">
            <table class="table">
              <tr>
                <td class="p-1" width="40%" style="border-top: 0px;"><h6 class="text-nowrap mb-0">Tanggal Pengembalian </h6></td>
                <td class="p-1" style="border-top: 0px;">:</td>
                <td class="p-1" style="border-top: 0px;"><h6 class="mb-0">{{ date('d/m/Y', strtotime($loan->tgl_kembali)) }}</h6></td>
              </tr>
              <tr>
                <td class="p-1"><h6 class="mb-0" >Penginput Data</h6></td>
                <td class="p-1"><h6 class="mb-0">:</h6></td>
                <td class="p-1"><h6 class="mb-0">{{ $loan->user->name }} </h6></td>
              </tr>
              <tr>
                <td class="p-1"><h6 class="mb-0">Keterlambatan </h6></td>
                <td class="p-1"><h6 class="mb-0">:</h6></td>
                <td class="p-1"><h6 class="mb-0">{{ $loan->keterlambatan }} Hari</h6></td>
              </tr>
              <tr>
                <td class="p-1"><h6 class="mb-0">Denda</h6></td>
                <td class="p-1"><h6 class="mb-0">:</h6></td>
                <td class="p-1"><h6 class="mb-0"><u>Rp. {{ number_format($loan->denda, 0, ',', '.') }}</u></h6></td>
              </tr>
              <tr>
                <td class="p-1"><h6 class="mb-0">Denda Lainnya</u></h6></td>
                <td class="p-1"><h6 class="mb-0">:</h6></td>
                <td class="p-1"><h6 class="mb-0"><u>Rp. {{ number_format($loan->denda_lainnya, 0, ',', '.') }}</h6></td>
              </tr>
              <tr>
                <td class="p-1"><h6 class="mb-0">Keterangan </h6></td>
                <td class="p-1"><h6 class="mb-0">:</h6></td>
                <td class="p-1">
                  <h6>
                    @if ($loan->keterangan != null)
                      {{ $loan->keterangan }}
                    @else
                      <i><u>Tidak Ada Keterangan</u></i>
                    @endif
                  </h6>
                </td>
              </tr>
              @if ($loan->edit_id != null)
              <tr>
                <td colspan="3" class="text-center p-1">
                  <span class="badge badge-info">
                    &ensp; <i class="fa fa-edit"></i> &ensp; Data Pernah di-Edit / di-Ubah
                  </span>
                </td>
              </tr>
              @endif
            </table>
          </div>
        </div>
        <div class="col-lg-6 col-xl-6 mb-2 pl-4 pr-4" style="border-left: 1px solid #d2d2d2;">
          <h6>Tanggal Peminjaman : {{ $loan->header->tanggal_pinjam }}</h6>
          <h6>Penginput Data : {{ $loan->header->user->name }}</h6>
          <h6>Nama Peminjam : {{ $loan->header->anggota->nama_anggota }}</h6>
          <h6>Total Buku : {{ $loan->header->total_buku }} Judul</h6>
          <h6>Jumlah Buku : {{ $loan->header->total_pinjam }} Buku</h6>
          <h6>
            Status : &ensp;
            @if ($loan->header->pengembalian)
              <span class="badge badge-success">
                &ensp; <i class="fa fa-check"></i> &ensp; Sudah di-Kembalikan &ensp;
              </span>
            @else
              <span class="badge badge-danger">
                &ensp; <i class="fa fa-times"></i> &ensp; Belum di-Kembalikan &ensp;
              </span>
            @endif 
          </h6>
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
                @foreach ($loan->header->detail as $item)
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
      @livewire('pengembalian.history', ['loan' => $loan])
    </div>
  </div>
</div>
@endsection

@section('script')
<script>
  $(document).ready(function() {
    window.livewire.emit('get-history', '{{ $loan->edit_id }}');
  });
</script>
@endsection