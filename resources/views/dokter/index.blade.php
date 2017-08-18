@extends('layouts.app')
@section('content')
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
          <li><p>{{ $no++ }}. {{ $data['nama'] }} <small>({{ $data->created_at->diffForHumans() }})</small><a href="{{url("/dokter/periksa/pasien/id=" . $data['id'] . "&nama=" .$data['nama']."&tgl=".$data['tgl_lahir'])}}" class="btn btn-success btn-xs pull-right">Periksa</a></p></li>
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
            <li style="margin-right: 5px;padding-top: 5px"><span class="badge" style="background: #b2ff59 ;color: #ffffff">{{count($obat)}}</span></li>
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
            <li><a class="close-link"><i class="fa fa-close"></i></a></li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
      <div class="">
        <ul class="to_do">
          @foreach ($obat as $data)
            <li><p>{{$data['nama']}} <span class="pull-right">({{$data->updated_at->diffForHumans()}})</span></p></li>
          @endforeach
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
            <li style="margin-right: 5px;padding-top: 5px"><span class="badge" style="background: #1e88e5;color: #ffffff">{{ count($pasien) }}</span></li>
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
            <li><a class="close-link"><i class="fa fa-close"></i></a></li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
      <div class="">
        <ul class="to_do">
          @foreach ($pasien as $data)
            <li><p>{{$data['nama']}} 
            @if ($data['status'] == 'antri')
              <span class="pull-right btn btn-xs btn-danger">Mengantri <i class="fa fa-spinner fa-pulse fa-fw"></i></span>
              @elseif($data['status'] == 'obat')
              <span class="pull-right btn btn-xs btn-warning">Antri Obat <i class="fa fa-spinner fa-pulse fa-fw"></i></span>
              @elseif($data['status'] == 'selesai')
              <span class="pull-right btn btn-xs btn-success">Selesai</span>
            @endif
            </p></li>
          @endforeach
        </ul>
        </div>
      </div>
    </div>
  </div>
</div>


@endsection