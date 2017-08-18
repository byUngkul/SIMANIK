@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
    <div class="x_panel" style="height: 500px !important">
      <div class="x_title">
        <h2>Daftar resep belum terlayani</h2>
        <ul class="nav navbar-right panel_toolbox">
            <li style="margin-right: 5px;padding-top: 5px"><span class="badge" style="background: #E30F0F;color: #ffffff">{{count($belum)}}</span></li>
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
            <li><a class="close-link"><i class="fa fa-close"></i></a></li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
      <div class="">
        <ul class="to_do">
        @foreach ($belum as $data)
          <li><p>Pasien: {{ $data->pasien->nama }} | Dokter: {{ $data->dokter->nama }} <a href="{{url('/apoteker/DetailResep/dokter_id='. $data['dokter_id'] .'&pasien_id='.$data['pasien_id'].' ')}}" class="btn btn-flat btn-xs btn-info pull-right">Lihat</a><span class="pull-right" style="margin-right: 3px">{{$data->created_at->diffForHumans()}} | </span></p></li>
        @endforeach
        </ul>
      </div>
      </div>
    </div>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
    <div class="x_panel" style="height: 500px !important">
      <div class="x_title">
        <h2>Daftar resep sudah terlayani</h2>
        <ul class="nav navbar-right panel_toolbox">
            <li style="margin-right: 5px;padding-top: 5px"><span class="badge" style="background: #b2ff59;color: #ffffff">{{count($selesai)}}</span></li>
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
            <li><a class="close-link"><i class="fa fa-close"></i></a></li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
      <div class="">
        <ul class="to_do">
        <?php $no = 1; ?>
        @foreach ($selesai as $data)
        <li><p>Pasien: {{$data['pasien']['nama']}} | Dokter: {{$data['dokter']['nama']}}<a href="#modal-detail-selesai" data-toggle="modal" class="btn btn-flat btn-xs btn-info btn-detail pull-right" data-id="{{$data['id']}}"
        data-dokter_id="{{$data['dokter_id']}}" data-pasien_id="{{$data['pasien_id']}}"
        data-controls-modal="modal-detail-selesai"
   data-backdrop="static"
   data-keyboard="false">Lihat</a> <span class="pull-right" style="margin-right: 3px">{{$data->updated_at->diffForHumans()}} | </span></p></li>  
        @endforeach
        </ul>
      </div>
      </div>
    </div>
  </div>
</div>   

<div class="modal fade" id="modal-detail-selesai">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Isi Resep | Dr. <span id="nama_dokter"></span></h4>
      </div>
      <div class="modal-body">
      <p> Nama Pasien : <b id="nama_pasien"></b></p>
          <table class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>Nama Obat</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Stok Obat</th>
              </tr>
            </thead>
              <tbody id="daftar-obat">
              </tbody>
          </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-close" data-dismiss="modal">Close</button>
    </div>
    </div>
  </div>
</div>
@endsection

@section('customJs')
    <script type="text/javascript">
        $('.btn-detail').on('click', function(event) {
          event.preventDefault();
          var dokter_id = $(this).data('dokter_id');
          var pasien_id = $(this).data('pasien_id');
          // console.log(dokter_id + ' ' + pasien_id);
          $.get("{{route('getDetailResep')}}", {dokter_id:dokter_id,pasien_id:pasien_id}, function(data) {
            // console.log(data);
            var nama_dokter = $('#nama_dokter').text(data[1]);
            var nama_pasien = $('#nama_pasien').text(data[2]);
            var sum = 0;
            var quantity = 0;
            $.each(data, function(k, v) {

              var table = '<tr><td>'+data[0][k].obat.nama+'</td><td class="jumlah">'+data[0][k].jumlah+'</td><td class="harga">'+data[0][k].obat.harga+'</td><td>'+(data[0][k].obat.status == 'ada' ? '<span class="btn btn-flat btn-success btn-block">Tersedia <i class="fa fa-check"></i></span>' : '<span class="btn btn-flat btn-danger btn-block">Habis <i class="fa fa-close"></i></span>' )+'</td></tr>';
              $('#daftar-obat').append(table);
            });             
          });
          });
          $('.btn-close').on('click', function() {
            // e.preventDefault()
            $('#daftar-obat').empty();
            $('#modal-detail-selesai').modal('hide');
          })
    </script>
@endsection
