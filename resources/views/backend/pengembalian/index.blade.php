@extends('backend.layouts.master')

@section('content')
<div class="col-12">
  <div class="card card-outline card-primary">
    <div class="card-header">
      <h4 class="card-title">Data Pengembalian Buku</h4>
      <div class="card-tools">
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
                    <td class="text-center">{{ $loop->iteration }}</td>
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
                        <button data-id="{{ $item->id }}" class="btn btn-sm btn-info pr-3 pl-3 info-pengembalian">
                          <span class="fa fa-info"></span>
                        </button>
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

  });
</script>
@endsection