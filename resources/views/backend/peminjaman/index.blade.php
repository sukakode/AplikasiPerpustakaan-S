@extends('backend.layouts.master')

@section('content')
<div class="col-12">
  <div class="card card-outline card-primary">
    <div class="card-header">
      <h4 class="card-title">Data Peminjaman Buku</h4>
      <div class="card-tools">
        <a href="{{ route('print.peminjaman') }}" target="_blank" class="btn btn-xs btn-info">
          <span class="fa fa-print"></span> &ensp; Print Data
        </a>
        <button class="btn btn-xs btn-danger" data-toggle="modal" data-target="#trashed-modal">
          <span class="fa fa-trash"></span> &ensp; Data Terhapus
        </button>
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
                    <td class="text-center">{{ $loop->iteration }}.</td>
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
                          <button data-id="{{ $item->id }}" class="btn btn-primary pr-3 pl-3 btn-sm info-pengembalian">
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
@livewire('pengembalian.edit')

<div class="modal fade" id="trashed-modal">
  <div class="modal-dialog modal-xl modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Data Peminjaman Terhapus</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body p-0">
        <div class="table-responsive">
          <table class="table table-bordered m-0">
            <thead>
              <tr>
                <th class="text-center">No.</th>
                <th class="text-center">Tanggal</th>
                <th class="text-center">Anggota</th>
                <th class="text-center">Penginput</th>
                <th class="text-center">Total Buku</th>
                <th class="text-center">Tanggal Hapus</th>
                <th class="text-center">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($trashed as $item)
                <tr>
                  <td class="text-center">{{ $loop->iteration }}.</td>
                  <td class="text-center">{{ date('d/m/Y', strtotime($item->tanggal_pinjam)) }}</td>
                  <td class="text-center">{{ $item->anggota->nama_anggota }}</td>
                  <td class="text-center">{{ $item->user->name }}</td>
                  <td class="text-center">{{ $item->total_buku }} Buku</td>
                  <td class="text-center">{{ date('d/m/Y', strtotime($item->deleted_at)) }}</td>
                  <td class="text-center">
                    <div class="btn-group">
                      <button data-id="{{ $item->id }}" class="btn btn-sm btn-info borad info-peminjaman-trashed">
                        <span class="fa fa-info"></span>
                      </button>
                      <form action="{{ route('restore.peminjaman', $item->id) }}" method="post">
                        @csrf 
                        @method('PUT')
                        <button type="submit" class="btn btn-success btn-sm borad">
                          <span class="fa fa-undo"></span>
                        </button>
                      </form>
                      <form action="{{ route('peminjaman.destroy', $item->id) }}" method="post">
                        @csrf 
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm borad">
                          <span class="fa fa-trash"></span>
                        </button>
                      </form>
                    </div>
                  </td>
                </tr>
              @empty
                <tr>
                  <td class="text-center" colspan="7">Belum Data Peminjaman.</td>
                </tr>
              @endforelse
            </tbody> 
          </table>
        </div>
      </div>
      <div class="modal-footer float-right">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup Modal</button>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
<script>
  $(document).ready(function() {

    // Info Peminjaman
    $('.info-peminjaman').on('click', function(data) {
      var id = $(this).data('id');
      window.livewire.emit('get-peminjaman', id);
    }); 

    $('.info-peminjaman-trashed').on('click', function(data) {
      var id = $(this).data('id');
      window.livewire.emit('get-peminjaman-trashed', id);
      $('#trashed-modal').modal('hide');
    }); 

    window.livewire.on('openDetail', () => {
      $('#modal-detail').modal('show');
    });

    $('#modal-detail').on('hidden.bs.modal', function() {
      window.livewire.emit('clear-attr');
    });
    // End

    // Pengembalian
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
    // End
    
    // Info Pengembalian
    $('.info-pengembalian').on('click', function(data) {
      var id = $(this).data('id');
      window.livewire.emit('get-pengembalian', id);
    });

    window.livewire.on('openDetailReturn', () => {
      $('#modal-detail-return').modal('show');
    });
    
    window.livewire.on('closePengembalianDetail', () => {
      $('#modal-detail-return').modal('hide');
    });

    $('#modal-detail-return').on('hidden.bs.modal', function() {
      window.livewire.emit('clear-attr');
    });
    // End

    // Info Pengembalian
    window.livewire.on('openPengembalianEdit', () => {
      $('#modal-pengembalian-edit').modal('show');
    });
    
    window.livewire.on('closePengembalianEdit', () => {
      $('#modal-pengembalian-edit').modal('hide');
    });

    $('#modal-pengembalian-edit').on('hidden.bs.modal', function() {
      window.livewire.emit('clear-attr-edit');
    });
    // End

    window.livewire.on('reloadPage', () => {
      window.location.reload();
    });

  });
</script>
@endsection