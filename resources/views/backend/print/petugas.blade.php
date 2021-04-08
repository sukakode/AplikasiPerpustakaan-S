<!DOCTYPE html>
<html>
<head>
  <title>Program Perpus</title>
  <link rel="stylesheet" href="{{ public_path('assets') }}/dist/css/adminlte.min.css">

  <style>  
    @font-face {
      font-family: 'Journal';
      src: url('{{ storage_path("fonts\Helvetica.ttf") }}') format('truetype');
    }
    .typed {
      font-family: 'Journal';
    }
    .header {
      margin-bottom: 20px;
      line-height: 1.4; 
      font-family: "Journal";
    }
    .header-image {
      height: 60px;
      width: auto;
      border-radius: 50%;
      float: left;
      margin-right: 10px;
    }
    hr {
      margin-top: 20px;
    }
  </style>
</head>
<body>  
  <p class="header">
    <img src="{{ public_path('images') }}/SK.png" class="header-image">
    Suka Kode - Program Perpustakaan 
    <br>
    Laporan Data Petugas
    <small class="float-right">
      Tanggal Print : {{ $tgl }}
      @if (isset($tgl_awal) && isset($tgl_akhir))
      <br>
      Data Tanggal : {{ $tgl_awal }} - {{ $tgl_akhir }}
      @endif
    </small> 
  </p>
  <hr>

	<table class='table table-bordered'>
    <thead>
      <tr>
        <th class="text-center">No.</th>
        <th class="text-center">Nama Petugas</th>
        <th class="text-center">E-Mail Petugas</th>
        <th class="text-center">Level Petugas</th> 
        @if (isset($trash) && $trash)
          <th class="text-center p-2"><small class="font-weight-bold">Terhapus</small></th>
        @endif
      </tr>
    </thead>
    <tbody>
      @forelse ($data as $item)
        <tr>
          <td class="text-center p-2">{{ $loop->iteration }}</td>
          <td class="text-center p-2">{{ $item->name }}</td>
          <td class="text-center p-2">{{ $item->email }}</td>
          <td class="text-center p-2">{{ $item->getRoleNames()->first() }}</td> 
          @if (isset($trash) && $trash)
            <td class="text-center p-2"><small>{{ $item->deleted_at != null ? date('d/m/Y', strtotime($item->deleted_at)):'-' }}</small></td>
          @endif
        </tr>
      @empty
        <tr>
          <td colspan="4" class="text-center">Belum Ada Data Petugas.</td>
        </tr>
      @endforelse
    </tbody> 
	</table>

</body>
</html>