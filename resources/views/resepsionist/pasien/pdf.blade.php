<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Data Pasien {{$bulan . '-' . $tahun}}</title>
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" sizes="32x32" href="{{URL::to('images/favicon.ico')}}">
    {{-- Select2 --}}
    <link rel="stylesheet" type="text/css" href="{{URL::to('bower_components/select2/dist/css/select2.min.css')}}">
    <!-- Bootstrap -->
    <link href="{{ URL::to('vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ URL::to('vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    </head>
    <body onload="window.print()">
    <div class="page-header">
      <h1>Data Pasien <small>{{$bulan . '-' . $tahun}}</small></h1>
    </div>
  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>No.</th>
        <th>Nama Pasien</th>
        <th>Jenis Kelamin</th>
        <th>Tgl. Lahir</th>
        <th>Pekerjaan</th>
        <th>No. Telp</th>
        <th>Alamat</th>
      </tr>
    </thead>
    <tbody>
    <?php $no = 1; ?>
      @foreach($pasien as $data)
        <tr>
          <td>{{$no++}}</td>
          <td>{{$data['nama']}}</td>
          <td>{{$data['jenis_kelamin']}}</td>
          <td>{{$data['tgl_lahir']}}</td>
          <td>{{$data['pekerjaan']}}</td>
          <td>{{$data['telp']}}</td>
          <td>{{$data['alamat']}}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
  </body>
  </html>