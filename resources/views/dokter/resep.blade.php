@extends('layouts.app')
@section('content')
<div class="row top_tiles">
  <div class="animated flipInY col-lg-6 col-md-6 col-sm-12 col-xs-12">
    <div class="tile-stats">
      <div class="icon"><i class="fa fa-file-text"></i></div>
      <div class="count">{{ count($resep) }}</div>
      <h3>Total Resep Obat</h3>
    </div>
  </div>
  <div class="animated flipInY col-lg-6 col-md-6 col-sm-12 col-xs-12">
    <div class="tile-stats">
      <div class="icon"><i class="fa fa-file-text"></i></div>
      <div class="count">{{ count($hariIni) }}</div>
      <h3>Total Resep Obat Hari Ini</h3>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <a class="btn btn-success" role="button" data-toggle="collapse" href="#collapse-excel" aria-expanded="false" aria-controls="collapse-excel">
    Export to excel <i class="fa fa-file-excel-o"></i>
  </a>
  <a class="btn btn-danger" role="button" data-toggle="collapse" href="#collapse-pdf" aria-expanded="false" aria-controls="collapse-pdf">
    Export to pdf <i class="fa fa-file-pdf-o"></i>
  </a>

  {{-- Collapse excel --}}
  <div class="collapse" id="collapse-excel">
    <div class="well">
      <form action="{{route('excelResep', 'xlsx')}}" method="post" id="frm-excel" target="_blank">
      {{csrf_field()}}
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
          <div class="form-group">
          <label>Pilih Bulan ?</label>
          <input type="text" name="bulan" class="form-control bulan">
        </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
          <div class="form-group">
          <label>Pilih Tahun ?</label>
          <input type="text" name="tahun" class="form-control tahun">
        </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <button type="submit" class="btn btn-success btn-block btn-flat">Export to excel <i class="fa fa-file-excel-o"></i></button>
        </div>
      </form>
    </div>
  </div>

  {{-- Collapse Pdf --}}
  <div class="collapse" id="collapse-pdf">
    <div class="well">
      <form action="{{route('PDFResep')}}" method="post" id="frm-pdf">
      {{csrf_field()}}
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
          <div class="form-group">
          <label>Pilih Bulan ?</label>
          <input type="text" name="bulan" class="form-control bulan">
        </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
          <div class="form-group">
          <label>Pilih Tahun ?</label>
          <input type="text" name="tahun" class="form-control tahun">
        </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <button type="submit" class="btn btn-danger btn-block btn-flat">Export to pdf <i class="fa fa-file-pdf-o"></i></button>
        </div>
      </form>
    </div>
  </div>
    <div class="x_panel">
      <div class="x_title">
        <h2>Data Rekam Medis</h2>
        <ul class="nav navbar-right panel_toolbox">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
          <li><a class="close-link"><i class="fa fa-close"></i></a></li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <table id="datatable" class="table table-striped">
          <thead>
            <tr>
              <th>No.</th>
              <th>Nama Pasien</th>
              <th>Tanggal Resep</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
          <?php $no = 1; ?>
          @for ($i = 0; $i < count($resep); $i++)
            <tr>
              <td>{{ $no++ }}</td>
              <td>{{ $resep[$i]['pasien']['nama'] }}</td>
              <td>{{ date('d-m-Y', strtotime($resep[$i]['created_at'])) }}</td>
              <td>
                <a href="{{ route('printDetailResep', $resep[$i]['pasien']['id']) }}" target="_blank" class="btn btn-info btn-flat"><i class="fa fa-print"></i></a>
                <a href="#modal-detail" data-toggle="modal" class="btn btn-success btn-flat btn-detail" data-id="{{$resep[$i]['pasien']['id']}}"
                ><i class="fa fa-search"></i></a>
               {{--  <a href="#modal-edit" data-toggle="modal" class="btn btn-warning btn-flat"><i class="fa fa-edit"></i></a> --}}
              </td>
            </tr>
          @endfor
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

{{-- modal detail --}}
<div class="modal fade" id="modal-detail">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Detail Resep</h4>
      </div>
      <div class="modal-body">
        <table class="table table-striped table-bordered table-hover">
          <thead>
            <tr>
              <th width="20%">Tgl. Resep</th>
              <th width="80%">Isi Resep</th>
            </tr>
          </thead>
          <tbody id="daftar-resep">
          
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

{{-- modal edit --}}
{{-- <div class="modal fade" id="modal-edit">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Modal title</h4>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div> --}}
@endsection

@section('customJs')
  <script type="text/javascript">
    $(document).ready(function() {
      $('#datatable').on('click', '.btn-detail', function(event) {
        event.preventDefault();
        var pasien_id = $(this).data('id');
        if ($('tr#baris').length >= 1) {
          return true;
        }else{
        $.get("{{route('getIsiResep')}}", {pasien_id:pasien_id}, function(data) {
          $.each(data, function(i, item) {
            var date = new Date();
            var hari = date.getDate(item.created_at);
            var bulan = date.getMonth(item.created_at) + 1;
            var tahun = date.getFullYear(item.created_at);
            console.log(item);
            var table = '<tr id="baris"><td>'+hari + '-' + bulan +'-' + tahun+'</td><td>Nama Obat : '+item.obat.nama+' | Jumlah : '+item.jumlah+'  | Signa : '+item.keterangan+'</td></tr>';
            $('#daftar-resep').append(table);
          }); 
        });
      };
      });
    });
  </script>
@endsection