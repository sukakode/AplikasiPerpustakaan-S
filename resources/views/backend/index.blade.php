@extends('backend.layouts.master')

@section('content') 
<div class="col-12 col-sm-6 col-md-3">
  <div class="info-box">
    <a href="{{ route('buku.index') }}" class="info-box-icon bg-info elevation-1"><i class="fas fa-book"></i></a>

    <div class="info-box-content">
      <span class="info-box-text">Jumlah Buku</span>
      <span class="info-box-number">
        {{ count($book) }} Buku
      </span>
    </div>
  </div>
</div>
<div class="col-12 col-sm-6 col-md-3">
  <div class="info-box mb-3">
    <a href="{{ route('anggota.index') }}" class="info-box-icon bg-lightblue elevation-1"><i class="fas fa-users"></i></a>

    <div class="info-box-content">
      <span class="info-box-text">Total Anggota</span>
      <span class="info-box-number">{{ count($member) }} Orang</span>
    </div>
  </div>
</div>

<div class="clearfix hidden-md-up"></div>

<div class="col-12 col-sm-6 col-md-3">
  <div class="info-box mb-3"> 
    <a href="{{ route('peminjaman.index') }}" class="info-box-icon bg-success elevation-1"><i class="fas fa-handshake"></i></a>

    <div class="info-box-content">
      <span class="info-box-text">Peminjaman</span>
      <span class="info-box-number">{{ count($borrow) }} Data</span>
    </div>
  </div>
</div>

<div class="col-12 col-sm-6 col-md-3">
  <div class="info-box mb-3">
    <a href="{{ route('pengembalian.index') }}" class="info-box-icon bg-purple elevation-1"><i class="fas fa-archive"></i></a>

    <div class="info-box-content">
      <span class="info-box-text">Pengembalian</span>
      <span class="info-box-number">{{ count($loan) }} Data</span>
    </div> 
  </div> 
</div>

<div class="col-12 col-sm-4 col-md-4">
  <div class="card card-outline card-success" style="max-height: 300px; min-height: 300px; overflow: auto;">
    <div class="card-header">
      <h4 class="card-title text-center">Halo, {{ auth()->user()->name }}</h4>
    </div>
    <div class="card-body p-1">
      <ul class="list-group list-group-flush">
        <li class="list-group-item text-center p-0">
          <img src="{{ asset('assets') }}/dist/img/UserLogo.png " class="img-circle elevation-2" style="width: 25%; padding: 2px; border: 1px solid #fff;" alt="User Image">
          <br>
          <h6 class="m-2 btn btn-primary btn-xs">
            {{ auth()->user()->name }}
          </h6>
        </li>
        <li class="list-group-item text-center p-0">
          <h6 class="mt-2">
            User Level - <u>{{ auth()->user()->getRoleNames()->first() }}</u>
          </h6>
        </li> 
        <li class="list-group-item text-center p-0">
          <h6 class="mt-2">
            <span id="datetime"> DD / MM / YYYY - H:i:s </span>
          </h6>
        </li>
        <li class="list-group-item p-0">
          <marquee>-- Silahkan gunakan aplikasi dengan sebaik-baiknya --</marquee>
        </li>
      </ul> 
    </div>
  </div>
</div>


<div class="col-12 col-sm-8 col-md-8" >
  <div class="card card-outline card-warning" style="min-height: 300px; max-height: 300px; overflow: auto;">
    <div class="card-header">
      <h4 class="card-title">
        Data Pengembalian & Kas
      </h4>
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
                  <th class="text-center">Denda</th>
                  <th class="text-center">Denda Lainnya</th>
                  <th class="text-center">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @php
                  $kas = 0;
                @endphp
                @forelse ($loan as $item)
                  <tr>
                    <td class="text-center">{{ $loop->iteration }}.</td>
                    <td class="text-center">
                      <button data-id="{{ $item->header_id }}" class="btn btn-sm btn-info pr-3 pl-3 info-peminjaman">
                        Lihat Data
                      </button>
                    </td>
                    <td class="text-center">{{ date('d/m/Y', strtotime($item->tgl_kembali)) }}</td>
                    <td class="text-center">Rp. {{ number_format($item->denda, 0, ',', '.') }}</td>
                    <td class="text-center">Rp. {{ number_format($item->denda_lainnya, 0, ',', '.') }}</td> 
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

<div class="col-12">
  <form action="{{ route('peminjaman.store') }}" method="post">
    @csrf
    <div class="card card-outline card-primary">
      <div class="card-header">
        <h4 class="card-title">Peminjaman Buku</h4>
        <div class="card-tools"> 
          <button type="submit" class="btn btn-success btn-xs">
            <span class="fa fa-check"></span> &ensp; Simpan Data Peminjaman
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
                <input type="date" name="tanggal_pinjam" id="tanggal_pinjam" class="form-control {{ $errors->has('tanggal_pinjam') ? 'is-invalid' : '' }}" value="{{ date('Y-m-d') }}" readonly>
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
                  @foreach ($member as $item)
                    <option value="{{ $item->id }}" {{ old('anggota_id') == $item->id ? 'selected':'' }}>{{ $item->nama_anggota }}</option>
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
@livewire('peminjaman.detail', ['report' => true])
@livewire('pengembalian.detail', ['report' => true])  
@endsection

@section('script')
<script type="text/javascript"> 
  function display_ct5() {
    var x = new Date()
    var ampm = x.getHours( ) >= 12 ? ' PM' : ' AM';

    // var x1= x.getMonth() + 1+ "/" + x.getDate() + "/" + x.getFullYear(); 
    var month = x.getMonth()+1;
    var x1= x.getDate() + " / " + month + " / " + x.getFullYear(); 
    x1 = x1 + " - " +  x.getHours( )+ ":" +  x.getMinutes() + ":" +  x.getSeconds();
    document.getElementById('datetime').innerHTML = x1;
    display_c5();
  }

  function display_c5(){
    var refresh=1000; 
    mytime=setTimeout('display_ct5()',refresh)
  }

</script>
<script>
  $(document).ready(function() {
    $('.select2').select2();

    display_c5()

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
  });
</script>
@endsection