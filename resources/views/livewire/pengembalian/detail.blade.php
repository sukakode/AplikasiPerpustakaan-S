<div>
  <div class="modal fade" id="modal-detail-return">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Detail Pengembalian</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body pl-3 pr-3 pt-0" style="max-height: 300px; overflow: auto;">
          @if (empty($header))
            <h5 class="text-center">- Pilih Data Pengembalian Terlebih Dahulu -</h5>
          @else
            <div class="row">
              <div class="col-lg-6 col-xl-6 mb-2">
                <div class="table-responsive">
                  <table class="table">
                    <tr>
                      <td width="40%" style="border-top: 0px;"><h6>Tanggal Pengembalian </h6></td>
                      <td style="border-top: 0px;">:</td>
                      <td style="border-top: 0px;"><h6>{{ date('d/m/Y', strtotime($loan->tgl_kembali)) }}</h6></td>
                    </tr>
                    <tr>
                      <td><h6>Penginput Data</h6></td>
                      <td>:</td>
                      <td><h6>{{ $loan->user->name }} </h6></td>
                    </tr>
                    <tr>
                      <td><h6>Keterlambatan </h6></td>
                      <td>:</td>
                      <td><h6>{{ $loan->keterlambatan }} Hari</h6></td>
                    </tr>
                    <tr>
                      <td><h6>Denda</h6></td>
                      <td>:</td>
                      <td><h6><u>Rp. {{ number_format($loan->denda, 0, ',', '.') }}</u></h6></td>
                    </tr>
                    <tr>
                      <td><h6>Denda Lainnya</u></h6></td>
                      <td>:</td>
                      <td><h6><u>Rp. {{ number_format($loan->denda_lainnya, 0, ',', '.') }}</h6></td>
                    </tr>
                    <tr>
                      <td><h6>Keterangan </h6></td>
                      <td>:</td>
                      <td>
                        <h6>
                          @if ($loan->keterangan != null)
                            {{ $loan->keterangan }}
                          @else
                            <i><u>Tidak Ada Keterangan</u></i>
                          @endif
                        </h6>
                      </td>
                    </tr>
                  </table>
                </div>
              </div>
              <div class="col-lg-6 col-xl-6 mb-2" style="border-left: 1px solid #d2d2d2;">
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
          @endif
        </div>
        <div class="modal-footer text-right">
          @if (!empty($header))
            <a href="#" class="btn btn-danger">Hapus Data</a>
            <a href="#" class="btn btn-warning">Edit Data</a>
          @endif
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup Modal</button>
        </div>
      </div>
    </div>
  </div>
</div>
