<div> 
  <div id="historyPeminjaman" class="carousel slide" data-ride="carousel"> 
    <div class="carousel-inner">
      <div class="carousel-item active p-2">
        <div class="card card-primary card-outline">
          <div class="card-header">
            <h4 class="card-title">Data Saat Ini</h4>
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
                <h6>Tanggal Peminjaman : {{ date('d/m/Y', strtotime($header->tanggal_pinjam)) }}</h6>
                <h6>Penginput Data : {{ $header->user->name }}</h6>
                <h6>Nama Peminjam : {{ $header->anggota->nama_anggota }}</h6>
                <h6>Total Buku : {{ $header->total_buku }} Judul</h6>
                <h6>Jumlah Buku : {{ $header->total_pinjam }} Buku</h6>
                @if ($header->deleted_at != null) 
                  <span class="badge badge-danger">
                    &ensp; <i class="fa fa-trash"></i> &ensp; Data Trashed &ensp;
                  </span>
                @else
                  <h6>
                    Status : &ensp;
                    @if ($header->pengembalian)
                      <span class="badge badge-success">
                        &ensp; <i class="fa fa-check"></i> &ensp; Sudah di-Kembalikan &ensp;
                      </span>
                    @else
                      <span class="badge badge-danger">
                        &ensp; <i class="fa fa-times"></i> &ensp; Belum di-Kembalikan &ensp;
                      </span>
                    @endif
                    
                    @if ($header->edit_id != null)
                    <a href="{{ route('peminjaman.history', $header->id) }}">
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
                      @foreach ($header->detail as $item)
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
          </div>
        </div>
      </div>
      <div class="carousel-item p-2">
        <div class="card card-primary card-outline">
          <div class="card-header">
            <h4 class="card-title">Data Saat Ini</h4>
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
                <h6>Tanggal Peminjaman : {{ date('d/m/Y', strtotime($header->tanggal_pinjam)) }}</h6>
                <h6>Penginput Data : {{ $header->user->name }}</h6>
                <h6>Nama Peminjam : {{ $header->anggota->nama_anggota }}</h6>
                <h6>Total Buku : {{ $header->total_buku }} Judul</h6>
                <h6>Jumlah Buku : {{ $header->total_pinjam }} Buku</h6>
                @if ($header->deleted_at != null) 
                  <span class="badge badge-danger">
                    &ensp; <i class="fa fa-trash"></i> &ensp; Data Trashed &ensp;
                  </span>
                @else
                  <h6>
                    Status : &ensp;
                    @if ($header->pengembalian)
                      <span class="badge badge-success">
                        &ensp; <i class="fa fa-check"></i> &ensp; Sudah di-Kembalikan &ensp;
                      </span>
                    @else
                      <span class="badge badge-danger">
                        &ensp; <i class="fa fa-times"></i> &ensp; Belum di-Kembalikan &ensp;
                      </span>
                    @endif
                    
                    @if ($header->edit_id != null)
                    <a href="{{ route('peminjaman.history', $header->id) }}">
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
                      @foreach ($header->detail as $item)
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
          </div>
        </div>
      </div>
      <div class="carousel-item p-2">
        <div class="card card-primary card-outline">
          <div class="card-header">
            <h4 class="card-title">Data Saat Ini</h4>
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
                <h6>Tanggal Peminjaman : {{ date('d/m/Y', strtotime($header->tanggal_pinjam)) }}</h6>
                <h6>Penginput Data : {{ $header->user->name }}</h6>
                <h6>Nama Peminjam : {{ $header->anggota->nama_anggota }}</h6>
                <h6>Total Buku : {{ $header->total_buku }} Judul</h6>
                <h6>Jumlah Buku : {{ $header->total_pinjam }} Buku</h6>
                @if ($header->deleted_at != null) 
                  <span class="badge badge-danger">
                    &ensp; <i class="fa fa-trash"></i> &ensp; Data Trashed &ensp;
                  </span>
                @else
                  <h6>
                    Status : &ensp;
                    @if ($header->pengembalian)
                      <span class="badge badge-success">
                        &ensp; <i class="fa fa-check"></i> &ensp; Sudah di-Kembalikan &ensp;
                      </span>
                    @else
                      <span class="badge badge-danger">
                        &ensp; <i class="fa fa-times"></i> &ensp; Belum di-Kembalikan &ensp;
                      </span>
                    @endif
                    
                    @if ($header->edit_id != null)
                    <a href="{{ route('peminjaman.history', $header->id) }}">
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
                      @foreach ($header->detail as $item)
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
          </div>
        </div>
      </div>
    </div> 
  </div>
</div>
