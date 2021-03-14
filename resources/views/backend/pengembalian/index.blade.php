@extends('backend.layouts.master')

@section('content')
<div class="col-12">
  <div class="card card-outline card-primary">
    <div class="card-header">
      <h4 class="card-title">Data Pengembalian Buku</h4>
      <div class="card-tools">
        <a href="{{ route('print.pengembalian') }}" target="_blank" class="btn btn-xs btn-info">
          <span class="fa fa-print"></span> &ensp; Print Data
        </a>
        <button class="btn btn-xs btn-danger" data-toggle="modal" data-target="#trashed-modal">
          <span class="fa fa-trash"></span> &ensp; Data Terhapus
        </button>
        <a href="{{ route('peminjaman.index') }}" class="btn btn-xs btn-success">
          <span class="fa fa-arrow-right"></span> &ensp; Data Peminjaman
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
                  <th class="text-center">Data Peminjaman</th>
                  <th class="text-center">Tanggal Kembali</th>
                  <th class="text-center">Keterlambatan</th>
                  <th class="text-center">Denda</th>
                  <th class="text-center">Denda Lainnya</th>
                  <th class="text-center">Keterangan</th>
                  <th class="text-center">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($pengembalian as $item)
                  <tr>
                    <td class="text-center">{{ $loop->iteration }}.</td>
                    <td class="text-center">
                      <button data-id="{{ $item->header_id }}" class="btn btn-sm btn-info pr-3 pl-3 info-peminjaman">
                        Lihat Data
                      </button>
                    </td>
                    <td class="text-center">{{ date('d/m/Y', strtotime($item->tgl_kembali)) }}</td>
                    <td class="text-center">{{ $item->keterlambatan }} Hari</td>
                    <td class="text-center">Rp. {{ number_format($item->denda, 0, ',', '.') }}</td>
                    <td class="text-center">Rp. {{ number_format($item->denda_lainnya, 0, ',', '.') }}</td>
                    <td class="text-center">
                      @if ($item->keterangan != null)
                        {{ $item->keterangan }}
                      @else
                        <i><u>Tidak Ada Keterangan</u></i>
                      @endif
                    </td>
                    <td class="text-center">
                      <div class="btn-group">
                        <button data-id="{{ $item->header->id }}" class="btn btn-sm btn-info pr-3 pl-3 info-pengembalian">
                          <span class="fa fa-info"></span>
                        </button>
                      </div>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td class="text-center" colspan="8">Belum Data Peminjaman.</td>
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
@livewire('pengembalian.detail') 
@livewire('pengembalian.edit')


<div class="modal fade" id="trashed-modal">
  <div class="modal-dialog modal-xl modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Data Pengembalian Terhapus</h4>
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
                <th class="text-center">Data Peminjaman</th>
                <th class="text-center">Tanggal Kembali</th>
                <th class="text-center">Keterlambatan</th>
                <th class="text-center">Denda</th>
                <th class="text-center">Denda Lainnya</th>
                <th class="text-center">Keterangan</th>
                <th class="text-center">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($trashed as $item)
                <tr>
                  <td class="text-center">{{ $loop->iteration }}.</td>
                  <td class="text-center">
                    <button data-id="{{ $item->header_id }}" class="btn btn-sm btn-info pr-3 pl-3 info-peminjaman">
                      Lihat Data
                    </button>
                  </td>
                  <td class="text-center">{{ date('d/m/Y', strtotime($item->tgl_kembali)) }}</td>
                  <td class="text-center">{{ $item->keterlambatan }} Hari</td>
                  <td class="text-center">Rp. {{ number_format($item->denda, 0, ',', '.') }}</td>
                  <td class="text-center">Rp. {{ number_format($item->denda_lainnya, 0, ',', '.') }}</td>
                  <td class="text-center">
                    @if ($item->keterangan != null)
                      {{ $item->keterangan }}
                    @else
                      <i><u>Tidak Ada Keterangan</u></i>
                    @endif
                  </td>
                  <td class="text-center">
                    <div class="btn-group">   
                      @if ($item->header->pengembalian == null)
                      <form action="{{ route('restore.pengembalian', $item->id) }}" method="post">
                        @csrf 
                        @method('PUT')
                        <button type="submit" class="btn btn-success btn-sm borad">
                          <span class="fa fa-undo"></span>
                        </button>
                      </form>
                      @endif
                      <form action="{{ route('pengembalian.destroy', $item->id) }}" method="post">
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
                  <td class="text-center" colspan="8">Belum Data Pengembalian.</td>
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
    $('.info-peminjaman').on('click', function(data) {
      var id = $(this).data('id');
      $('#trashed-modal').modal('hide');
      window.livewire.emit('get-peminjaman', id);
    }); 

    window.livewire.on('openDetail', () => {
      $('#modal-detail').modal('show');
    });

    $('#modal-detail').on('hidden.bs.modal', function() {
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

    // Info Pengembalian
    window.livewire.on('openPengembalianEdit', () => {
      $('#modal-detail-return').modal('hide');
      $('#modal-pengembalian-edit').modal('show');
    });
    
    window.livewire.on('closePengembalianEdit', () => {
      $('#modal-pengembalian-edit').modal('hide');
    });

    $('#modal-pengembalian-edit').on('hidden.bs.modal', function() {
      window.livewire.emit('clear-attr-edit');
    });
    // End

  });
</script>
@endsection