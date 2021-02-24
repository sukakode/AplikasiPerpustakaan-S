@extends('backend.layouts.master')

@section('content')
<div class="col-12">
  <div class="card card-outline card-primary">
    <div class="card-header">
      <h4 class="card-title">Data Peminjaman Buku</h4>
      <div class="card-tools">
        <a href="{{ route('peminjaman.create') }}" class="btn btn-xs btn-success">
          <span class="fa fa-plus"></span> &ensp; Tambah Data
        </a>
      </div>
    </div>
    <div class="card-body p-0">
      <div class="row">
        <div class="col-12">
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th class="text-center">No.</th>
                  <th class="text-center">Tanggal</th>
                  <th class="text-center">Anggota</th>
                  <th class="text-center">Penginput</th>
                  <th class="text-center">Total Buku</th>
                  <th class="text-center">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($peminjaman as $item)
                  <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td class="text-center">{{ date('d/m/Y', strtotime($item->tanggal_pinjam)) }}</td>
                    <td class="text-center">{{ $item->anggota->nama_anggota }}</td>
                    <td class="text-center">{{ $item->user->name }}</td>
                    <td class="text-center">{{ $item->total_buku }} Buku</td>
                    <td class="text-center">
                      <div class="btn-group">
                        <button data-id="{{ $item->id }}" class="btn btn-sm btn-info pr-3 pl-3 info-peminjaman">
                          <span class="fa fa-info"></span>
                        </button>
                        @if ($item->pengembalian)
                          <button data-id="{{ $item->pengembalian->id }}" class="btn btn-primary pr-3 pl-3 btn-sm info-pengembalian">
                            <span class="fa fa-check"></span>
                          </button>
                        @else
                          <button data-id="{{ $item->id }}" class="btn btn-success pr-3 pl-3 btn-sm pengembalian">
                            <span class="fa fa-arrow-right"></span>
                          </button>
                        @endif
                      </div>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td class="text-center" colspan="6">Belum Data Peminjaman.</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@livewire('peminjaman.detail')
@livewire('pengembalian.create')
@livewire('pengembalian.detail')
@endsection

@section('script')
<script>
  $(document).ready(function() {
    $('.info-peminjaman').on('click', function(data) {
      var id = $(this).data('id');
      window.livewire.emit('get-peminjaman', id);
    }); 

    window.livewire.on('openDetail', () => {
      $('#modal-detail').modal('show');
    });

    $('#modal-detail').on('hidden.bs.modal', function() {
      window.livewire.emit('clear-attr');
    });

    $('.pengembalian').on('click', function() {
      var id = $(this).data('id');
      window.livewire.emit('do-pengembalian', id);
    });

    window.livewire.on('openPengembalian', () => {
      $('#modal-pengembalian').modal('show');
    });

    window.livewire.on('closePengembalian', () => {
      $('#modal-pengembalian').modal('hide');
    });

    $('#modal-pengembalian').on('hidden.bs.modal', function() {
      window.livewire.emit('clear-attr');
    });
    
    $('.info-pengembalian').on('click', function(data) {
      var id = $(this).data('id');
      window.livewire.emit('get-pengembalian', id);
    });

    window.livewire.on('openDetailReturn', () => {
      $('#modal-detail-return').modal('show');
    });

    $('#modal-detail-return').on('hidden.bs.modal', function() {
      window.livewire.emit('clear-attr');
    });

    window.livewire.on('reloadPage', () => {
      window.location.reload();
    });

  });
</script>
@endsection