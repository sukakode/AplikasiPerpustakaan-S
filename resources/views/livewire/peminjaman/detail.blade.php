<div>
  <div class="modal fade" id="modal-detail">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Detail Peminjaman</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body pl-3 pr-3" style="max-height: 300px; overflow: auto;">
          @if (empty($header))
            <h5 class="text-center">- Pilih Data Peminjaman Terlebih Dahulu -</h5>
          @else
            <div class="row">
              <div class="col-lg-6 col-xl-6 mb-2">
                <h6>Tanggal Peminjaman : {{ $header->tanggal_pinjam }}</h6>
                <h6>Penginput Data : {{ $header->user->name }}</h6>
                <h6>Nama Peminjam : {{ $header->anggota->nama_anggota }}</h6>
                <h6>Total Buku : {{ $header->total_buku }} Judul</h6>
                <h6>Jumlah Buku : {{ $header->total_pinjam }} Buku</h6>
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
                </h6>
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
                {{-- {{ print_r($header->detail) }} --}}
              </div>
            </div>
          @endif
        </div>
        <div class="modal-footer text-right">
          @if (!empty($header))
            <a href="#" class="btn btn-danger">Hapus Data</a>
            <a href="{{ route('peminjaman.edit', $header->id) }}" class="btn btn-warning">Edit Data</a>
          @endif
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup Modal</button>
        </div>
      </div>
    </div>
  </div>
</div>
