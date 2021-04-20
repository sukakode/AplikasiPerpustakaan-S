@extends('backend.layouts.master')

@section('content') 
<div class="col-12">
  <div class="card card-outline card-primary card-outline-tabs">
    <div class="card-header p-0">
      <h4 class="card-title p-2"> &ensp; <span class="fa fa-print text-indigo"></span> &ensp; Laporan Data Petugas</h4> 
      <div class="card-tools">
        <a href="{{ route('print.petugas') }}" target="_blank" class="btn btn-xs btn-info">
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
        <li class="nav-item">
          <a class="nav-link disabled" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">
            <span class="bg-lred">&ensp;</span> = Data Terhapus
          </a>
        </li>
      </ul>
    </div>
    <div class="card-body p-0">
      <div class="tab-content pl-4 pr-4 pt-2 pb-2" id="custom-tabs-four-tabContent">
        <div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
          <form action="{{ route('print.petugas') }}" method="post" target="_blank">
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
              <div class="col-lg-3 col-xl-3">
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
                    <span class="fa fa-undo"></span> &ensp; Reset
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
        
        <table class="table table-bordered m-0">
          <thead>
            <tr>
              <th class="text-center">No.</th>
              <th class="text-center">Nama Petugas</th>
              <th class="text-center">E-Mail Petugas</th>
              <th class="text-center">Level Petugas</th> 
            </tr>
          </thead>
          <tbody>
            @forelse ($petugas as $item)
              <tr>
                <td class="text-center {{ $item->deleted_at != null ? 'bg-lred':'' }}">{{ $loop->iteration }}.</td>
                <td class="text-center {{ $item->deleted_at != null ? 'bg-lred':'' }}">{{ $item->name }}</td>
                <td class="text-center {{ $item->deleted_at != null ? 'bg-lred':'' }}">{{ $item->email }}</td>
                <td class="text-center {{ $item->deleted_at != null ? 'bg-lred':'' }}">{{ $item->getRoleNames()->first() }}</td> 
              </tr>
            @empty
              <tr>
                <td colspan="5" class="text-center">Belum Ada Data Petugas.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div> 
@endsection

@section('script')
<script>
  $(document).ready(function() {  

    $('#reservation').daterangepicker({ 
      locale: {
        format: 'DD/MM/YYYY'
      }
    });
  });
</script>
@endsection