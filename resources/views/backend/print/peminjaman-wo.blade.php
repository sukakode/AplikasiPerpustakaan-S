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
    Laporan Data Anggota
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
        <th class="text-center p-1"><small class="font-weight-bold">No.</small></th>
        <th class="text-center p-1"><small class="font-weight-bold">Tanggal</small></th>
        <th class="text-center p-1"><small class="font-weight-bold">Anggota</small></th>
        <th class="text-center p-1"><small class="font-weight-bold">Penginput</small></th>
        <th class="text-center p-1"><small class="font-weight-bold">Total Buku</small></th> 
        <th class="text-center p-1"><small class="font-weight-bold">Status</small></th>
      </tr> 
    </thead>
    <tbody>
      @forelse ($data as $item) 
        <tr>
          <td class="text-center p-2"><small>{{ $no = $loop->iteration }}</small></td>
          <td class="text-center p-2"><small>{{ date('d/m/Y', strtotime($item['tanggal_pinjam'])) }}</small></td>
          <td class="text-center p-2"><small>{{ $item['anggota']['nama_anggota'] }}</small></td>
          <td class="text-center p-2"><small>{{ $item['user']['name'] }}</small></td>
          <td class="text-center p-2"><small>{{ $item['total_buku'] }} Buku</td> 
          <td class="text-center p-2"><small>{{ $item['pengembalian'] == null ? 'Belum di-Kembalikan':'di-Kembalikan' }}</td> 
        </tr>   
      @empty
        <tr>
          <td class="text-center" colspan="6">Belum Data Peminjaman.</td>
        </tr>
      @endforelse
      <tr>
        <th colspan="6" class="p-1" style="background-color: #e9e9e9;"></th>
      </tr>
    </tbody>  
	</table>

</body>
</html>