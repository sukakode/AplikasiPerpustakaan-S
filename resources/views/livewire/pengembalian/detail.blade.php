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
                      <td class="p-2" width="40%" style="border-top: 0px;"><h6 class="text-nowrap mb-0">Tanggal Pengembalian </h6></td>
                      <td class="p-2" style="border-top: 0px;">:</td>
                      <td class="p-2" style="border-top: 0px;"><h6 class="mb-0">{{ date('d/m/Y', strtotime($loan->tgl_kembali)) }}</h6></td>
                    </tr>
                    <tr>
                      <td class="p-2"><h6 class="mb-0" >Penginput Data</h6></td>
                      <td class="p-2"><h6 class="mb-0">:</h6></td>
                      <td class="p-2"><h6 class="mb-0">{{ $loan->user->name }} </h6></td>
                    </tr>
                    <tr>
                      <td class="p-2"><h6 class="mb-0">Keterlambatan </h6></td>
                      <td class="p-2"><h6 class="mb-0">:</h6></td>
                      <td class="p-2"><h6 class="mb-0">{{ $loan->keterlambatan }} Hari</h6></td>
                    </tr>
                    <tr>
                      <td class="p-2"><h6 class="mb-0">Denda</h6></td>
                      <td class="p-2"><h6 class="mb-0">:</h6></td>
                      <td class="p-2"><h6 class="mb-0"><u>Rp. {{ number_format($loan->denda, 0, ',', '.') }}</u></h6></td>
                    </tr>
                    <tr>
                      <td class="p-2"><h6 class="mb-0">Denda Lainnya</u></h6></td>
                      <td class="p-2"><h6 class="mb-0">:</h6></td>
                      <td class="p-2"><h6 class="mb-0"><u>Rp. {{ number_format($loan->denda_lainnya, 0, ',', '.') }}</h6></td>
                    </tr>
                    <tr>
                      <td class="p-2"><h6 class="mb-0">Keterangan </h6></td>
                      <td class="p-2"><h6 class="mb-0">:</h6></td>
                      <td class="p-2">
                        <h6>
                          @if ($loan->keterangan != null)
                            {{ $loan->keterangan }}
                          @else
                            <i><u>Tidak Ada Keterangan</u></i>
                          @endif
                        </h6>
                      </td>
                    </tr>
                    @if ($loan->edit_id != null)
                    <tr>
                      <td colspan="3" class="text-center p-2">
                        <a href="{{ route('pengembalian.history', $loan->id) }}">
                          <span class="badge badge-info">
                            &ensp; <i class="fa fa-edit"></i> &ensp; Data Pernah di-Edit / di-Ubah
                          </span>
                        </a>
                      </td>
                    </tr>
                    @endif
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
            <form action="{{ route('pengembalian.destroy', $loan->id) }}" method="post">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger">Hapus Data </button>
            </form>
            <button type="button" class="btn btn-warning pengembalian-edit" wire:click="$emit('do-pengembalian-edit', '{{ $loan->id }}')">Edit Data</button>
          @endif
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup Modal</button>
        </div>
      </div>
    </div>
  </div>
</div>
