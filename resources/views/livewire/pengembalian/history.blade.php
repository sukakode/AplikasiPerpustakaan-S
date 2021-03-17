<div>
  <div> 
    <div class="row">
      <div class="col-12">
        <h6 class="font-weight-bold"> <span class="fa fa-edit text-warning"></span> &ensp; Total Data di-Edit / di-Ubah : <span class="badge badge-info pl-2 pr-2">{{ $totalEdit }} x</span></h6>
        <hr>
      </div>
      <div class="col-12 pl-4 pr-4">
        <div id="historyPengembalian" class="carousel slide" data-ride="carousel" wire:ignore.self> 
          <div class="carousel-inner"> 
            @php
              $ke = 0;
            @endphp
            @foreach ($history as $item)
            <div class="carousel-item p-1 {{ $ke == 0 ? 'active':'' }}">
              <div class="card card-primary card-outline">
                <div class="card-header">
                  <h4 class="card-title">{{ $ke == 0 ? 'Data Pertama':'Hasil Edit ke-'.$ke }}</h4>
                  <div class="card-tools">
                    <a href="#historyPengembalian" role="button" data-slide="prev" class="btn btn-xs btn-danger">
                      <span class="fa fa-arrow-left"></span> &ensp;
                      Slide Kiri
                    </a>
                    <a href="#historyPengembalian" role="button" data-slide="next" class="btn btn-xs btn-success">
                      Slide Kanan &ensp;
                      <span class="fa fa-arrow-right"></span>
                    </a>
                  </div>
                </div>
                <div class="card-body"> 
                  <div class="row">
                    <div class="col-lg-6 col-xl-6 mb-2">
                      <div class="table-responsive">
                        <table class="table">
                          <tr>
                            <td class="p-1" width="40%" style="border-top: 0px;"><h6 class="text-nowrap mb-0">Tanggal Pengembalian </h6></td>
                            <td class="p-1" style="border-top: 0px;">:</td>
                            <td class="p-1" style="border-top: 0px;"><h6 class="mb-0">{{ date('d/m/Y', strtotime($item['tgl_kembali'])) }}</h6></td>
                          </tr>
                          <tr>
                            <td class="p-1"><h6 class="mb-0" >Penginput Data</h6></td>
                            <td class="p-1"><h6 class="mb-0">:</h6></td>
                            <td class="p-1"><h6 class="mb-0">{{ $item['user']['name'] }} </h6></td>
                          </tr>
                          <tr>
                            <td class="p-1"><h6 class="mb-0">Keterlambatan </h6></td>
                            <td class="p-1"><h6 class="mb-0">:</h6></td>
                            <td class="p-1"><h6 class="mb-0">{{ $item['keterlambatan'] }} Hari</h6></td>
                          </tr>
                          <tr>
                            <td class="p-1"><h6 class="mb-0">Denda</h6></td>
                            <td class="p-1"><h6 class="mb-0">:</h6></td>
                            <td class="p-1"><h6 class="mb-0"><u>Rp. {{ number_format($item['denda'], 0, ',', '.') }}</u></h6></td>
                          </tr>
                          <tr>
                            <td class="p-1"><h6 class="mb-0">Denda Lainnya</u></h6></td>
                            <td class="p-1"><h6 class="mb-0">:</h6></td>
                            <td class="p-1"><h6 class="mb-0"><u>Rp. {{ number_format($item['denda_lainnya'], 0, ',', '.') }}</h6></td>
                          </tr>
                          <tr>
                            <td class="p-1"><h6 class="mb-0">Keterangan </h6></td>
                            <td class="p-1"><h6 class="mb-0">:</h6></td>
                            <td class="p-1">
                              <h6>
                                @if ($item['keterangan'] != null)
                                  {{ $item['keterangan'] }}
                                @else
                                  <i><u>Tidak Ada Keterangan</u></i>
                                @endif
                              </h6>
                            </td>
                          </tr> 
                          <tr>
                            <td colspan="3" class="text-center p-1">
                              <span class="badge badge-success">
                                &ensp; <i class="fa fa-edit"></i> &ensp; Tanggal Buat || {{ date('d-m-Y H:i:s', strtotime($item['created_at'])) }} &ensp;
                              </span>
                              <span class="badge badge-danger">
                                &ensp; <i class="fa fa-trash"></i> &ensp; Data Trashed || {{ date('d-m-Y H:i:s', strtotime($item['deleted_at'])) }} &ensp;
                              </span> 
                            </td>
                          </tr> 
                        </table>
                      </div>
                    </div>
                    <div class="col-lg-6 col-xl-6 mb-2" style="border-left: 1px solid #d2d2d2;">
                      <h6>Tanggal Peminjaman : {{ $item['header']['tanggal_pinjam'] }}</h6>
                      <h6>Penginput Data : {{ $item['header']['user']['name'] }}</h6>
                      <h6>Nama Peminjam : {{ $item['header']['anggota']['nama_anggota'] }}</h6>
                      <h6>Total Buku : {{ $item['header']['total_buku'] }} Judul</h6>
                      <h6>Jumlah Buku : {{ $item['header']['total_pinjam'] }} Buku</h6> 
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
                            @foreach ($item['header']['detail'] as $item2)
                              <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $item2['buku']['judul'] }}</td>
                                <td class="text-center">{{ $item2['jumlah'] }} Buku</td>
                              </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            @php
              $ke += 1;
            @endphp
            @endforeach 
          </div> 
        </div>
      </div>
    </div>
  </div>
</div>
