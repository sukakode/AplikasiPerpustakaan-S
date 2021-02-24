@extends('backend.layouts.master')

@section('content')
<div class="col-12">
  <div class="card card-outline card-primary">
    <div class="card-header">
      <h4 class="card-title">Data Buku</h4>
      <div class="card-tools">
        <button class="btn btn-xs btn-danger" data-toggle="modal" data-target="#trashed-modal">
          <span class="fa fa-trash"></span> &ensp; Data Terhapus
        </button>
        <a href="{{ route('buku.create') }}" class="btn btn-success btn-xs">
          <span class="fa fa-plus"></span> &ensp; Tambah Data
        </a>
      </div>
    </div>
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-bordered m-0">
          <thead>
            <th class="text-center">No.</th>
            <th class="text-center">Judul</th>
            <th class="text-center">Pengarang</th>
            <th class="text-center">Penerbit</th>
            <th class="text-center">Tahun Terbit</th>
            <th class="text-center">Aksi</th>
          </thead>
          <tbody>
            @forelse ($buku as $item)
              <tr>
                <td class="text-center">{{ $loop->iteration }}.</td>
                <td class="text-center">{{ $item->judul }}</td>
                <td class="text-center">{{ $item->pengarang }}</td>
                <td class="text-center">{{ $item->penerbit }}</td>
                <td class="text-center">{{ $item->tahun }}</td>
                <td class="text-center">
                  <div class="btn-group">
                    <a href="{{ route('buku.edit', $item->id) }}" class="btn btn-warning btn-sm borad" style="color: #fff !important;">
                      <span class="fa fa-edit"></span>
                    </a>
                    <form action="{{ route('buku.destroy', $item->id) }}" method="post">
                      @csrf 
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger btn-sm borad">
                        <span class="fa fa-trash"></span>
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
            @empty 
              <tr>
                <td colspan="6" class="text-center">Belum Ada Data Buku.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="trashed-modal">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Data Buku Terhapus</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body p-0">
        <div class="table-responsive">
          <table class="table table-bordered m-0">
            <thead>
              <th class="text-center">No.</th>
              <th class="text-center">Judul</th>
              <th class="text-center">Pengarang</th>
              <th class="text-center">Penerbit</th>
              <th class="text-center">Tahun Terbit</th>
              <th class="text-center">Aksi</th>
            </thead>
            <tbody>
              @forelse ($trashed as $item)
                <tr>
                  <td class="text-center">{{ $loop->iteration }}.</td>
                  <td class="text-center">{{ $item->judul }}</td>
                  <td class="text-center">{{ $item->pengarang }}</td>
                  <td class="text-center">{{ $item->penerbit }}</td>
                  <td class="text-center">{{ $item->tahun }}</td>
                  <td class="text-center">
                    <div class="btn-group">
                      <form action="{{ route('restore.buku', $item->id) }}" method="post">
                        @csrf 
                        @method('PUT')
                        <button type="submit" class="btn btn-info btn-sm borad">
                          <span class="fa fa-undo"></span>
                        </button>
                      </form>
                      <form action="{{ route('buku.destroy', $item->id) }}" method="post">
                        @csrf 
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm borad">
                          <span class="fa fa-trash"></span>
                        </button>
                      </form>
                    </div>
                  </td>
                </tr>
              @empty 
                <tr>
                  <td colspan="6" class="text-center">Belum Ada Data Buku.</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
@endsection