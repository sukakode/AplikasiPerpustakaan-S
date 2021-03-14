<div>
  <div class="row">
    <div class="col-lg-8 col-xl-8">
      <div class="form-group" wire:ignore>
        <label for="">Nama Buku : </label>
        <select id="buku_id" class="form-control" data-placeholder="Pilih Data Buku" style="width: 100% !important;">
          <option value=""></option>
          @foreach ($buku as $item)
            <option value="{{ $item->id }}">{{ $item->judul }}</option>
          @endforeach
        </select>
      </div>
    </div>
    <div class="col-lg-2 col-xl-2">
      <label for="">Jumlah : </label>
      <input type="number" wire:model="qty" id="qty" wire:keydown.enter="addBuku()" class="form-control" pattern="/d*" placeholder="Min. 1" min="1" >
    </div>
    <div class="col-lg-1 col-xl-1">
      <div class="form-group">
        <label for="" class="d-none d-lg-block d-xl-block">&ensp;</label>
        <button type="button" class="btn btn-success btn-block mt-2" wire:click="addBuku()">
          <span class="fa fa-plus"></span>
        </button>
      </div>
    </div>
    <div class="col-lg-1 col-xl-1">
      <div class="form-group">
        <label for="" class="d-none d-lg-block d-xl-block">&ensp;</label>
        <button type="button" class="btn btn-danger btn-block mt-2" wire:click="resetVar()">
          <span class="fa fa-undo"></span>
        </button>
      </div>
    </div>
    <div class="col-12">
      <hr class="mt-0">
    </div>
  </div>
  <div class="row">
    <div class="col-12 pr-4 pl-4">
      <h5 class="mb-3">Buku Yang Akan di-Pinjam</h5>
      
      <span class="text-danger">
        <u>
          {{ $errors->has('buku_id') ? 'Data Buku Yang di-Pinjam Tidak Boleh Kosong !' : '' }}
          @if ($errors->has('buku_id') || $errors->has('jumlah'))
            <br>
          @endif
          {{ $errors->has('jumlah') ? 'Jumlah Buku Yang di-Pinjam Minimal 1 Buku !' : '' }}
        </u>
      </span> 
    </div>
    <div class="col-12">
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th class="text-center">No.</th>
              <th class="text-center">Judul Buku</th>
              <th class="text-center">Penerbit</th>
              <th class="text-center">Jumlah</th>
              <th class="text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($pinjam as $item)
              <tr>
                <td class="text-center">{{ $loop->iteration }}.</td>
                <td class="text-center">{{ $item['judul'] }}</td>
                <td class="text-center">{{ $item['penerbit'] }}</td>
                <td class="text-center">{{ $item['qty'] }} Buku</td>
                <td class="text-center">
                  <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-danger" wire:click="delBuku({{ $item['id'] }})">
                      <div class="fa fa-trash"></div>
                    </button>
                  </div>
                </td>
                <input type="hidden" name="buku_id[]" value="{{ $item['id'] }}">
                <input type="hidden" name="jumlah[]" value="{{ $item['qty'] }}">
              </tr>
            @empty
              <tr>
                <td class="text-center" colspan="5">
                  Belum Ada Data Buku Yang Akan di-Pinjam.
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

@push('script')
<script>
  $(document).ready(function() {
    $("#buku_id").select2();

    window.livewire.on('refreshSelect2', data => {
      $('#buku_id').empty();
      $('#buku_id').append(`<option value=""></option>`);

      var obj = $.map(data, function(object) {
        object.text = object.text || object.judul;
        return object;
      })

      $('#buku_id').select2({
        data: obj
      });
    });

    $('#buku_id').on('select2:select', function (e) {
      window.livewire.emit('checkBuku', e.params.data.id);
    });

    $('#qty').on('keydown', function(e) {
      e.preventDefault();
    });
  });
</script>
@endpush