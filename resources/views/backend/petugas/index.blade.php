@extends('backend.layouts.master')

@section('content')
<div class="col-12">
  <div class="card card-outline card-primary">
    <div class="card-header">
      <h4 class="card-title">
        Data Petugas
      </h4>
      <div class="card-tools">
        <a href="{{ route('print.petugas') }}" target="_blank" class="btn btn-xs btn-info">
          <span class="fa fa-print"></span> &ensp; Print Data
        </a>
        <button class="btn btn-xs btn-danger" data-toggle="modal" data-target="#trashed-modal">
          <span class="fa fa-trash"></span> &ensp; Data Terhapus
        </button>
        <a href="{{ route('petugas.create') }}" class="btn btn-xs btn-success">
          <span class="fa fa-plus"></span> &ensp;
          Tambah Data
        </a>
      </div>
    </div>
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-boredered m-0">
          <thead>
            <tr>
              <th class="text-center">No.</th>
              <th class="text-center">Nama Petugas</th>
              <th class="text-center">E-Mail Petugas</th>
              <th class="text-center">Level Petugas</th>
              <th class="text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($petugas as $item)
              <tr>
                <td class="text-center">{{ $loop->iteration }}.</td>
                <td class="text-center">{{ $item->name }}</td>
                <td class="text-center">{{ $item->email }}</td>
                <td class="text-center">{{ $item->getRoleNames()->first() }}</td>
                <td class="text-center">
                  <div class="btn-group">
                    @if ($item->getRoleNames()->first() == "Super Admin")
                      <a href="#" class="btn btn-secondary btn-sm borad">Tidak Ada Aksi</a>
                    @else
                      <a href="{{ route('petugas.edit', $item->id) }}" class="btn btn-warning btn-sm text-white borad">
                        <span class="fa fa-edit"></span>
                      </a>
                      <form action="{{ route('petugas.destroy', $item->id) }}" method="post">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger btn-sm borad">
                          <span class="fa fa-trash"></span>
                        </button>
                      </form>
                    @endif
                  </div>
                </td>
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
<div class="modal fade" id="trashed-modal">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Data Petugas Terhapus</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body p-0">
        <div class="table-responsive">
          <table class="table table-boredered m-0">
            <thead>
              <tr>
                <th class="text-center">No.</th>
                <th class="text-center">Nama Petugas</th>
                <th class="text-center">E-Mail Petugas</th>
                <th class="text-center">Level Petugas</th>
                <th class="text-center">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($trashed as $item)
                <tr>
                  <td class="text-center">{{ $loop->iteration }}.</td>
                  <td class="text-center">{{ $item->name }}</td>
                  <td class="text-center">{{ $item->email }}</td>
                  <td class="text-center">{{ $item->getRoleNames()->first() }}</td>
                  <td class="text-center">
                    <div class="btn-group">
                      <form action="{{ route('restore.petugas', $item->id) }}" method="post">
                        @csrf 
                        @method('PUT')
                        <button type="submit" class="btn btn-info btn-sm borad">
                          <span class="fa fa-undo"></span>
                        </button>
                      </form>
                      <form action="{{ route('petugas.destroy', $item->id) }}" method="post">
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
                  <td colspan="5" class="text-center">Belum Ada Data Petugas.</td>
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