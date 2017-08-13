@extends('layouts.app')
@section('content')
{{-- <div class="row top_tiles">
  <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
    <div class="tile-stats">
      <div class="icon"><i class="fa fa-users"></i></div>
      <div class="count">200</div>
      <h3>Pasien Seluruhnya</h3>
    </div>
  </div>
  <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
    <div class="tile-stats">
      <div class="icon"><i class="fa fa-users"></i></div>
      <div class="count">80</div>
      <h3>Pasien Bulan Ini</h3>
    </div>
  </div>
  <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
    <div class="tile-stats">
      <div class="icon"><i class="fa fa-user"></i></div>
      <div class="count">10</div>
      <h3>Pasien Hari Ini</h3>
    </div>
  </div>
</div> --}}

<div class="row">
  <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
    <div class="x_panel" style="height: 500px !important">
      <div class="x_title">
        <h2>Daftar Antrian Pasien</h2>
        <ul class="nav navbar-right panel_toolbox">
            <li style="margin-right: 5px;padding-top: 5px"><span class="badge" style="background: #E30F0F;color: #ffffff">{{ count($antri) }}</span></li>
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
            <li><a class="close-link"><i class="fa fa-close"></i></a></li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
      <div class="">
        <ul class="to_do">
        <?php $no = 1; ?>
        @foreach($antri as $data)
          <li><p>{{ $no++ }}. {{ $data['nama'] }} <small>({{ $data->created_at->diffForHumans() }})</small><a href="{{ route('getRekamMedisPasien', $data['id']) }}" class="btn btn-success btn-xs pull-right">Periksa</a></p></li>
        @endforeach
        </ul>
        </div>
      </div>
    </div>
  </div>

  <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
    <div class="x_panel" style="height: 500px !important">
      <div class="x_title">
        <h2>Pasien Sudah Diperiksa</h2>
        <ul class="nav navbar-right panel_toolbox">
            <li style="margin-right: 5px;padding-top: 5px"><span class="badge" style="background: #b2ff59 ;color: #ffffff">4</span></li>
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
            <li><a class="close-link"><i class="fa fa-close"></i></a></li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
      <div class="">
        <ul class="to_do">
          <li><p>Adam <a href="#!" class="btn btn-info btn-xs pull-right">Lihat detail</a></p></li>
          <li><p>Adam <a href="#!" class="btn btn-info btn-xs pull-right">Lihat detail</a></p></li>
          <li><p>Adam <a href="#!" class="btn btn-info btn-xs pull-right">Lihat detail</a></p></li>
        </ul>
        </div>
      </div>
    </div>
  </div>

  <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
    <div class="x_panel" style="height: 500px !important">
      <div class="x_title">
        <h2>Daftar Pasien Hari Ini</h2>
        <ul class="nav navbar-right panel_toolbox">
            <li style="margin-right: 5px;padding-top: 5px"><span class="badge" style="background: #1e88e5;color: #ffffff">5</span></li>
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
            <li><a class="close-link"><i class="fa fa-close"></i></a></li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
      <div class="">
        <ul class="to_do">
          <li><p>Adam <a href="#!" class="btn btn-danger btn-xs pull-right">mengantri</a></p></li>
          <li><p>Adam <a href="#!" class="btn btn-success btn-xs pull-right">selesai</a></p></li>
          <li><p>Adam <a href="#!" class="btn btn-danger btn-xs pull-right">mengantri</a></p></li>
        </ul>
        </div>
      </div>
    </div>
  </div>
</div>


@endsection