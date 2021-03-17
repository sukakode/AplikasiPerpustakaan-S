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
    Laporan Data Pengembalian
    <small class="float-right">
      Tanggal Print : {{ $tgl }}
    </small> 
  </p>
  <hr>

	<table class='table table-bordered'> 
    <thead>
      <tr>
        <th class="text-center p-2"><small class="font-weight-bold">No.</small></th>
        <th class="text-center p-2"><small class="font-weight-bold">Tanggal Kembali</small></th>
        <th class="text-center p-2"><small class="font-weight-bold">Keterlambatan</small></th>
        <th class="text-center p-2"><small class="font-weight-bold">Denda</small></th>
        <th class="text-center p-2"><small class="font-weight-bold">Denda Lainnya</small></th>
        <th class="text-center p-2"><small class="font-weight-bold">Keterangan</small></th> 
      </tr>
    </thead>
    <tbody>
      @forelse ($data as $item)
        <tr>
          <td class="text-center p-2"><small>{{ $loop->iteration }}</small></td> 
          <td class="text-center p-2"><small>{{ date('d/m/Y', strtotime($item->tgl_kembali)) }}</small></td>
          <td class="text-center p-2"><small>{{ $item->keterlambatan }} Hari</small></td>
          <td class="text-center p-2"><small>Rp. {{ number_format($item->denda, 0, ',', '.') }}</small></td>
          <td class="text-center p-2"><small>Rp. {{ number_format($item->denda_lainnya, 0, ',', '.') }}</small></td>
          <td class="text-center p-2">
            <small>
              @if ($item->keterangan != null)
                {{ $item->keterangan }}
              @else
                -
              @endif
            </small>
          </td> 
        </tr>
      @empty
        <tr>
          <td class="text-center" colspan="6">Belum Data Peminjaman.</td>
        </tr>
      @endforelse
      <tr>
        <td colspan="6" class="p-1" style="background-color: #e9e9e9;"></td>
      </tr>
      <tr>
        <td class="text-right p-2 font-weight-bold" colspan="3"></td>
        <td class="text-center p-2"><small class="font-weight-bold">Denda</small></td>
        <td class="text-center p-2"><small class="font-weight-bold">Denda Lainnya</small></td>
        <td class="text-center p-2"><small class="font-weight-bold">Denda + Lainnya</small></td>
      </tr>
      <tr>
        <td class="text-right p-2 font-weight-bold" colspan="3">Total : </td>
        <td class="text-center p-2"><small class="font-weight-bold">Rp. {{ number_format($data->sum('denda'), 0, ',', '.') }}</small></td>
        <td class="text-center p-2"><small class="font-weight-bold">Rp. {{ number_format($data->sum('denda_lainnya'), 0, ',', '.') }}</small></td>
        <td class="text-center p-2"><small class="font-weight-bold">Rp. {{ number_format($data->sum('denda') + $data->sum('denda_lainnya'), 0, ',', '.') }}</small></td>
      </tr>
    </tbody> 
	</table>

</body>
</html>