<div>
  <div class="modal fade" id="modal-pengembalian-edit" wire:ignore.self>
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Form Edit Pengembalian Buku</h4>
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
                <h5>Detail Peminjaman</h5>
                <hr>
                <div class="row">
                  <div class="col-12 pl-4 pr-4">
                    <h6>Tanggal Peminjaman : {{ date('d/m/Y', strtotime($header->tanggal_pinjam)) }}</h6>
                    <h6>Penginput Data : {{ $header->user->name }}</h6>
                    <h6>Nama Peminjam : {{ $header->anggota->nama_anggota }}</h6> 
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
              <div class="col-lg-6 col-xl-6 mb-2">
                <h5>Pengembalian</h5>
                <hr>
                <form wire:submit.prevent="buatEdit()" method="post">
                  <div class="row">
                    <div class="col-lg-6 col-xl-6 pl-4 pr-4">
                      <div class="form-group">
                        <label for="">Tanggal Kembali : </label>
                        <input type="date" wire:model="tgl_kembali" name="tgl_kembali" id="tgl_kembali" class="form-control">
                      </div>
                    </div>
                    <div class="col-lg-6 col-xl-6 pl-4 pr-4">
                      <div class="form-group">
                        <label for="">Penginput : </label>
                        <input type="text" wire:model="user.name" name="tgl_kembali" id="tgl_kembali" class="form-control" readonly>
                      </div>
                    </div>
                    <div class="col-12 pl-4 pr-4">
                      <table class="table">
                        <tr>
                          <td><span class="fa fa-calendar text-primary"></span> &ensp; Keterlambatan </td>
                          <td>:</td>
                          <td class="text-center"><b>{{ $diff }} Hari</b></td>
                        </tr>
                        <tr>
                          <td><span class="fa fa-coins text-danger"></span> &ensp; Denda </td>
                          <td>:</td>
                          <td class="text-center"><b>Rp. {{ number_format($denda * $diff, 0, '.', ',') }}</b></td>
                        </tr>
                        <tr>
                          <td><span class="fa fa-coins text-danger"></span> &ensp; Denda Lainnya </td>
                          <td>:</td>
                          <td class="text-center">
                            <b>
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" style="display: inline; padding: 0px 10px;">Rp. </span>
                                </div>
                                <input type="number" wire:model="denda_lainnya" name="denda_lainnya" id="denda_lainnya" class="form-control form-control-sm" placeholder="Ex. 0" style="text-align: center;">
                              </div>
                            </b>
                          </td>
                        </tr>
                        <tr>
                          <td><span class="fa fa-info text-info"></span> &ensp; Keterangan </td>
                          <td>:</td>
                          <td class="text-center">
                            <b>
                              <textarea wire:model="keterangan" name="keterangan" id="keterangan" cols="1" rows="1" class="form-control" placeholder="Masukan Keterangan Denda Lainnya..."></textarea>
                            </b>
                          </td>
                        </tr>
                      </table>
                    </div>
                    <div class="col-12 pl-4 pr-4">
                      <button type="submit" class="btn btn-success btn-block btn-sm" >
                        <span class="fa fa-check"></span> &ensp; Simpan Perubahan Pengembalian
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          @endif
        </div>
        <div class="modal-footer text-right"> 
          <button class="btn btn-danger" wire:click="$emitSelf('cancel-edit')">Batal Merubah Data</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup Modal</button>
        </div>
      </div>
    </div>
  </div>
</div>
