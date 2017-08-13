<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Data Rekam Medis {{$bulan . '-' . $tahun}}</title>
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
    <style type="text/css" media="print">
          @page { size: landscape; }
    </style>
    <body onload="window.print()">
    <div class="page-header">
      <h1>Data Rekam Medis <small>{{$bulan . '-' . $tahun}}</small></h1>
    </div>
  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>No.</th>
        <th>Nama Pasien</th>
        <th>Jenis Kelamin</th>
        <th>Diagnosa</th>
        <th>Keluhan</th>
        <th>Anamnesis</th>
        <th>Tindakan</th>
        <th>Keterangan</th>
        <th>Alergi obat</th>
        <th>bb</th>
        <th>tb</th>
        <th>tensi</th>
        <th>bw</th>
        </tr>
    </thead>
    <tbody>
    <?php $no = 1; ?>
      @foreach($rekamMedis as $data)
        <tr>
          <td>{{$no++}}.</td>
          <td>{{$data['pasien']['nama']}}</td>
          <td>{{$data['pasien']['jenis_kelamin']}}</td>
          <td>{{$data['diagnosa']}}</td>
          <td>{{$data['keluhan']}}</td>
          <td>{{$data['anamnesis']}}</td>
          <td>{{$data['tindakan']}}</td>
          <td>{{$data['keterangan']}}</td>
          <td>{{$data['alergi_obat']}}</td>
          <td>{{$data['bb']}}</td>
          <td>{{$data['tb']}}</td>
          <td>{{$data['tensi']}}</td>
          <td>{{$data['bw']}}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
  </body>
  </html>