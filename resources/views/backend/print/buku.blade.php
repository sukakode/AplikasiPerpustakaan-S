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
    Laporan Data Buku
    <small class="float-right">
      Tanggal Print : {{ $tgl }}
    </small> 
  </p>
  <hr>

	<table class='table table-bordered'>
    <thead>
      <tr>
        <th class="text-center">No.</th>
        <th class="text-center">Judul</th>
        <th class="text-center">Pengarang</th>
        <th class="text-center">Penerbit</th>
        <th class="text-center">Tahun</th>
      </tr>
    </thead>
		<tbody> 
      @forelse ($data as $item)
        <tr>
          <td class="text-center p-2">{{ $loop->iteration }}</td>
          <td class="text-center p-2">{{ $item->judul }}</td>
          <td class="text-center p-2">{{ $item->pengarang }}</td>
          <td class="text-center p-2">{{ $item->penerbit }}</td>
          <td class="text-center p-2">{{ $item->tahun }}</td>
        </tr>
      @empty
        <tr>
          <td colspan="5" class="text-center">
            Belum Ada Data.
          </td>
        </tr>
      @endforelse
		</tbody>
	</table>

</body>
</html>