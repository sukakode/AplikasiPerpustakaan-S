<div> 
  <div class="row">
    <div class="col-12">
      <h6 class="font-weight-bold"> <span class="fa fa-edit text-warning"></span> &ensp; Total Data di-Edit / di-Ubah : <span class="badge badge-info pl-2 pr-2">{{ $totalEdit }} x</span></h6>
      <hr>
    </div>
    <div class="col-12 pl-4 pr-4">
      <div id="historyPeminjaman" class="carousel slide" data-ride="carousel" wire:ignore.self> 
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
                  <a href="#historyPeminjaman" role="button" data-slide="prev" class="btn btn-xs btn-danger">
                    <span class="fa fa-arrow-left"></span> &ensp;
                    Slide Kiri
                  </a>
                  <a href="#historyPeminjaman" role="button" data-slide="next" class="btn btn-xs btn-success">
                    Slide Kanan &ensp;
                    <span class="fa fa-arrow-right"></span>
                  </a>
                </div>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-lg-6 col-xl-6 mb-2">
                    <h6>Tanggal Peminjaman : {{ date('d/m/Y', strtotime($item['tanggal_pinjam'])) }}</h6>
                    <h6>Penginput Data : {{ $item['user']['name'] }}</h6>
                    <h6>Nama Peminjam : {{ $item['anggota']['nama_anggota'] }}</h6>
                    <h6>Total Buku : {{ $item['total_buku'] }} Judul</h6>
                    <h6>Jumlah Buku : {{ $item['total_pinjam'] }} Buku</h6>
                    <span class="badge badge-success">
                      &ensp; <i class="fa fa-edit"></i> &ensp; Tanggal Buat || {{ date('d-m-Y H:i:s', strtotime($item['created_at'])) }} &ensp;
                    </span>
                    @if ($item['deleted_at'] != null) 
                      <span class="badge badge-danger">
                        &ensp; <i class="fa fa-trash"></i> &ensp; Data Trashed || {{ date('d-m-Y H:i:s', strtotime($item['deleted_at'])) }} &ensp;
                      </span>
                    @else
                      <h6>
                        Status : &ensp;
                        @if ($item['pengembalian'])
                          <span class="badge badge-success">
                            &ensp; <i class="fa fa-check"></i> &ensp; Sudah di-Kembalikan &ensp;
                          </span>
                        @else
                          <span class="badge badge-danger">
                            &ensp; <i class="fa fa-times"></i> &ensp; Belum di-Kembalikan &ensp;
                          </span>
                        @endif
                        
                        @if ($item['edit_id'] != null)
                        <a href="{{ route('peminjaman.history', $item['id']) }}">
                          <span class="badge badge-info">
                            &ensp; <i class="fa fa-edit"></i> &ensp; Data Pernah di-Edit / di-Ubah
                          </span>
                        </a>
                        @endif
                      </h6>
                    @endif
                  </div>
                  <div class="col-lg-6 col-xl-6 mb-2">
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
                          @foreach ($item['detail'] as $item2)
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
