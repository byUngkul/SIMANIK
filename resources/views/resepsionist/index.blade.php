@extends('layouts.app') @section('content')
<!-- top tiles -->
<div class="row tile_count">
  <div class="col-md-4 col-sm-4 col-xs-6 tile_stats_count">
    <span class="count_top"><i class="fa fa-user"></i> Total Pasien</span>
    <div class="count">{{ count($total) }}</div>
  </div>
  <div class="col-md-4 col-sm-4 col-xs-6 tile_stats_count">
    <span class="count_top"><i class="fa fa-clock-o"></i> Pasien Bulan Ini</span>
    <div class="count">{{ count($bulan) }}</div>
  </div>
  <div class="col-md-4 col-sm-4 col-xs-6 tile_stats_count">
    <span class="count_top"><i class="fa fa-user"></i> Pasien Hari Ini</span>
    <div class="count green">{{ count($pasien) }}</div>
  </div>
</div>
<hr>
<!-- /top tiles -->

<div class="col-lg-12">
  <div class="page-title">
    <div class="title_left">
      <h3><i class="fa fa-users"></i> Pedaftaran Pasien</h3>
    </div>
  </div>
</div>
<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
  <div class="x_panel">
    <div class="x_title">
      <h2>Data Pasien</h2>
      <ul class="nav navbar-right panel_toolbox">
        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
        </li>
        <li><a class="close-link"><i class="fa fa-close"></i></a>
        </li>
      </ul>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
      <form action="{{ route('postPendaftaranPasien') }}" method="post" id="frm-pasien">
        {{ csrf_field() }}
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <div class="form-group">
            <label>ID</label>
            <input type="text" name="id" class="form-control" required="" value="{{$id}}" readonly="">
            <input type="hidden" name="status" value="antri">
          </div>
          <div class="form-group">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" required="">
          </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
          <div class="form-group">
            <label>Tanggal Lahir</label>
            <input type="text" name="tgl_lahir" class="form-control datepicker">
          </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
          <div class="form-group">
            <label>Jenis Kelamin</label>
            <div class="radio">
              <label>
                <input type="radio" name="jenis_kelamin" id="input" value="pria" checked="checked">
                Pria
              </label>
              <label style="margin-left: 10px">
                <input type="radio" name="jenis_kelamin" id="input" value="wanita">
                Wanita
              </label>
            </div>
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <div class="form-group">
            <label>Pekerjaan</label>
            <input type="text" name="pekerjaan" class="form-control" required="">
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
          <div class="form-group">
            <label>No. Telp</label>
            <input type="text" name="telp" class="form-control" required="">
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
          <div class="form-group">
            <label>Pilih Dokter</label>
            <select name="layanan_dokter" id="pelayanan_dokter" class="form-control select2" style="width:100% !important">
              <option disabled selected>-Pilih Dokter-</option>
              @foreach($dokter as $data)
                <option value="{{$data['id']}}" data-spesialis="{{$data['spesialis']['spesialis']}}">{{$data['nama']}}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
          <div class="form-group">
            <label>Spesialis Dokter</label>
            <input type="text" id="spesialis" class="form-control" required="" readonly>
          </div>
        </div>
        <div class="col-lg-12 col-xs-12 col-sm-12 col-md-12">
          <div class="form-group">
            <label>Alamat</label>
            <textarea class="form-control" name="alamat" required=""></textarea>
          </div>
        </div>
        <div class="col-lg-12">
          <button type="submit" class="btn btn-block btn-primary btn-lg btn-flat">Simpan <i class="fa fa-save"></i></button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="col-md-4 col-sm-4 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
      <h2>Daftar Antrian <a href="#" data-toggle="tooltip" data-placement="top" title="Tekan F5 untuk mendapatkan data terbaru"><i class="fa fa-question-circle"></i></a></h2>
      <ul class="nav navbar-right panel_toolbox">
        <li data-count="{{ count($pasien) }}" style="margin-right: 5px;padding-top: 5px" id="count"><span class="badge" style="background: #448aff;color: #ffffff">{{ count($pasien) }}</span></li>
        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
        </li>
        <li><a class="close-link"><i class="fa fa-close"></i></a>
        </li>
      </ul>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">

      <div class="">
        <ul class="to_do" id="daftar-antri">
          @if($pasien)
          <?php $no = 1; ?> @foreach($pasien as $data)
          <li>
            <p>{{$no++}}. {{ $data->nama }} ({{ $data->created_at->diffForHumans() }})<a href="#!" class="btn btn-danger btn-xs pull-right btn-hapus"
                data-toggle="tooltip" title="Hapus Data" data-id="{{ $data['id'] }}"><i class="fa fa-trash"></i></a></p>
          </li>
          @endforeach @else
          <p style="text-align: center">Antrian Kosong</p>
          @endif
        </ul>
      </div>
    </div>
  </div>
</div>
<!-- End to do list -->
<div class="clearfix"> </div>
@endsection @section('customJs')
<script type="text/javascript">
  $(document).ready(function () {
    $('#frm-pasien').on('submit', function () {
      toastr.success('Success !', 'Data berhasil di simpan !');
    });

    $('#pelayanan_dokter').on('change', function () {
      $('#pelayanan_dokter option:selected').each(function () {
        var spesialis = $(this).data('spesialis');
        $('#spesialis').val(spesialis);
      });
    });

    $('.btn-hapus').on('click', function (e) {
      var id = $(this).data('id');
      $.confirm({
        icon: 'fa fa-warning',
        title: 'Alert !',
        content: 'Apakah anda ingin menghapus data ini ?',
        type: 'red',
        typeAnimated: true,
        buttons: {
          confirm: function () {
            $.get("{{ route('getHapusPasien') }}", {
              id: id
            }, function (data) {
              toastr.success('Success !', 'Data berhasil di hapus');
              location.reload();
            });
          },
          cancel: function () {},
        }
      });
    });
  });
</script>
@endsection