@extends('backend.layouts.master')

@section('content') 
<div class="col-12">
  <div class="card card-outline card-primary card-outline-tabs">
    <div class="card-header p-0">
      <h4 class="card-title p-2"> &ensp; <span class="fa fa-print text-orange"></span> &ensp; Laporan Data Pengembalian Buku</h4> 
      <div class="card-tools">
        <a href="{{ route('print.pengembalian') }}" target="_blank" class="btn btn-xs btn-info">
          <span class="fa fa-print"></span> &ensp; Print Semua Data
        </a> 
      </div>
      <br>
      <hr class="mb-0">
      <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">
            Berdasarkan Tanggal
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">
            Pengaturan Print 
          </a>
        </li>
      </ul>
    </div>
    <div class="card-body p-0">
      <div class="tab-content pl-4 pr-4 pt-2 pb-2" id="custom-tabs-four-tabContent">
        <div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
          <form action="{{ route('print.pengembalian') }}" method="post" target="_blank">
            @csrf
            <div class="row">
              <div class="col-lg-5 col-xl-5">
                <div class="form-group">
                  <label for="" class="text-sm">Tanggal Mulai - Sampai Tanggal ( tanggal/bulan/tahun ) : </label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="far fa-calendar-alt"></i>
                      </span>
                    </div>
                    <input type="text" class="form-control form-control-sm float-right" id="reservation" name="tanggal">
                  </div>
                </div>
              </div> 
              {{-- <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3 col-xl-3">
                <div class="form-group">
                  <label for="" class="text-sm">Dengan Detail Data ?</label>
                  <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" type="checkbox" id="detail" name="detail" value="1">
                    <label for="detail" class="custom-control-label font-weight-normal">Ya, Dengan Detail</label>
                  </div>
                </div>
              </div> --}}
              <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3 col-xl-3">
                <div class="form-group">
                  <label for="" class="text-sm">Dengan Data Terhapus ?</label>
                  <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" type="checkbox" id="deleted" name="deleted" value="1">
                    <label for="deleted" class="custom-control-label font-weight-normal">Ya, Dengan Data Terhapus</label>
                  </div>
                </div>
              </div>
              <div class="col-xs-12 col-sm-6 col-md-6 col-lg-2 col-xl-2">
                <div class="form-group">
                  <label for="" class="d-none d-lg-block d-xl-block">&ensp;</label>
                  <button type="submit" class="btn btn-outline-info btn-sm btn-block">
                    <span class="fa fa-check"></span> &ensp; Print Data
                  </button>
                </div>
              </div>
              <div class="col-xs-12 col-sm-6 col-md-6 col-lg-2 col-xl-2">
                <div class="form-group">
                  <label for="" class="d-none d-lg-block d-xl-block">&ensp;</label>
                  <button type="reset" class="btn btn-outline-danger btn-sm btn-block">
                    <span class="fa fa-undo"></span> &ensp; Reset Data
                  </button>
                </div>
              </div>
            </div>
          </form>
        </div>
        <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
          &ensp;
        </div>
      </div>
      
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
                <td class="text-center {{ $item->deleted_at != null ? 'bg-lred':'' }}">{{ $loop->iteration }}.</td>
                <td class="text-center {{ $item->deleted_at != null ? 'bg-lred':'' }}">
                  <button data-id="{{ $item->header_id }}" class="btn btn-sm btn-info pr-3 pl-3 info-peminjaman">
                    Lihat Data
                  </button>
                </td>
                <td class="text-center {{ $item->deleted_at != null ? 'bg-lred':'' }}">{{ date('d/m/Y', strtotime($item->tgl_kembali)) }}</td>
                <td class="text-center {{ $item->deleted_at != null ? 'bg-lred':'' }}">{{ $item->keterlambatan }} Hari</td>
                <td class="text-center {{ $item->deleted_at != null ? 'bg-lred':'' }}">Rp. {{ number_format($item->denda, 0, ',', '.') }}</td>
                <td class="text-center {{ $item->deleted_at != null ? 'bg-lred':'' }}">Rp. {{ number_format($item->denda_lainnya, 0, ',', '.') }}</td>
                <td class="text-center {{ $item->deleted_at != null ? 'bg-lred':'' }}">
                  @if ($item->keterangan != null)
                    {{ $item->keterangan }}
                  @else
                    <i><u>Tidak Ada Keterangan</u></i>
                  @endif
                </td>
                <td class="text-center {{ $item->deleted_at != null ? 'bg-lred':'' }}">
                  <div class="btn-group">
                    @if ($item->deleted_at != null)
                      <button class="btn btn-sm btn-secondary pr-3 pl-3">
                        <span class="fa fa-times"></span>
                      </button>
                    @else
                      <button data-id="{{ $item->header->id }}" class="btn btn-sm btn-info pr-3 pl-3 info-pengembalian">
                        <span class="fa fa-info"></span>
                      </button>
                    @endif
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
@livewire('peminjaman.detail', ['report' => true])
@livewire('pengembalian.detail', ['report' => true]) 
@endsection

@section('script')
<script>
  $(document).ready(function() {  

    $('#reservation').daterangepicker({ 
      locale: {
        format: 'DD/MM/YYYY'
      }
    });

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

    // Info Pengembalian
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
    // End

    // Edit Pengembalian
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