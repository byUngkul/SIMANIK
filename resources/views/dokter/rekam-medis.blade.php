@extends('layouts.app')
@section('content')
<div class="row top_tiles">
  <div class="animated flipInY col-lg-6 col-md-6 col-sm-12 col-xs-12">
    <div class="tile-stats">
      <div class="icon"><i class="fa fa-list-alt"></i></div>
      <div class="count">{{count($rekamMedis)}}</div>
      <h3>Total Rekam Medis</h3>
    </div>
  </div>
  <div class="animated flipInY col-lg-6 col-md-6 col-sm-12 col-xs-12">
    <div class="tile-stats">
      <div class="icon"><i class="fa fa-list-alt"></i></div>
      <div class="count">{{ count($HariIni) }}</div>
      <h3>Total Rekam Medis hari ini</h3>
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
      <form action="{{ route('exportExcelRekamMedis', 'xlsx') }}" method="post" id="frm-excel" target="_blank">
      {{ csrf_field() }}
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
      <form action="{{route('exportPDFRekamMedis')}}" method="post" id="frm-pdf" target="_blank">
      {{ csrf_field() }}
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
              <th>Tanggal Periksa</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
          <?php $no = 1; ?>
          @foreach($rekamMedis as $data)
            <tr>
              <td>{{$no++}}</td>
              <td>{{$data['pasien']['nama']}}</td>
              <td>{{date('d-m-Y', strtotime($data['created_at']))}}</td>
              <td>
                <a href="#modal-detail" class="btn btn-info btn-flat btn-detail" data-toggle="modal"
                data-id="{{$data['id']}}" data-bb="{{$data['bb']}}" data-tb="{{$data['tb']}}" data-tensi="{{$data['tensi']}}" data-bw="{{$data['bw']}}" data-keluhan="{{$data['keluhan']}}" data-anamnesis="{{$data['anamnesis']}}" data-diagnosa="{{$data['diagnosa']}}" data-tindakan="{{$data['tindakan']}}" data-keterangan="{{$data['keterangan']}}"
                ><i class="fa fa-search"></i></a>
                <a href="#modal-edit" data-toggle="modal" class="btn btn-warning btn-flat btn-edit" data-id="{{$data['id']}}" data-bb="{{$data['bb']}}" data-tb="{{$data['tb']}}" data-tensi="{{$data['tensi']}}" data-bw="{{$data['bw']}}" data-keluhan="{{$data['keluhan']}}" data-anamnesis="{{$data['anamnesis']}}" data-diagnosa="{{$data['diagnosa']}}" data-tindakan="{{$data['tindakan']}}" data-keterangan="{{$data['keterangan']}}"
                ><i class="fa fa-edit"></i></a>
                <a href="#!" class="btn btn-danger btn-flat btn-delete" data-id="{{$data['id']}}"><i class="fa fa-trash"></i></a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
{{-- Modal Detail --}}
<div class="modal fade" id="modal-detail">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Detail Data</h4>
      </div>
      <div class="modal-body">
        <form id="frm-detail">
        <input type="hidden" name="id" id="id">
          <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
            <div class="form-group">
              <label>Berat Badan</label>
              <div class="input-group">
                <input type="text" class="form-control" name="bb" id="bb">
                <div class="input-group-addon">Kg</div>
              </div>
            </div>
          </div>
          <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
            <div class="form-group">
              <label>Tensi Darah</label>
              <div class="input-group">
                <input type="text" class="form-control" name="tensi" id="tensi">
                <div class="input-group-addon">mmHg</div>
              </div>
            </div>
          </div>
          <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
            <div class="form-group">
              <label>Tinggi Badan</label>
              <div class="input-group">
                <input type="text" class="form-control" name="tb" id="tb">
                <div class="input-group-addon">Cm</div>
              </div>
            </div>
          </div>
          <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
            <div class="form-group">
              <label>Buta Warna</label>
              <div class="radio">
                <label style="margin-left: 10px;">
                  <input type="radio" name="bw" value="ya" id="ya">
                  Ya
                </label>
                <label>
                  <input type="radio" name="bw" value="tidak" id="tidak">
                  Tidak
                </label>
              </div>
            </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="form-group">
              <label>Keluhan</label>
              <input type="text" name="keluhan" class="form-control" id="keluhan">
            </div>
            <div class="form-group">
              <label>Anamnesis</label>
              <textarea class="form-control" id="anamnesis" name="anamnesis" rows="3"></textarea>
            </div>
            <div class="form-group">
              <label>Diagnosa</label>
              <input type="text" name="diagnosa" class="form-control" id="diagnosa">
            </div>
            <div class="form-group">
              <label>Tindakan</label>
              <input type="text" name="tindakan" class="form-control" id="tindakan">
            </div>
            <div class="form-group">
              <label>Keterangan</label>
              <textarea class="form-control" id="keterangan" name="keterangan" rows="3"></textarea>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </form>
      </div>
    </div>
  </div>
</div>
{{-- modal edit --}}
<div class="modal fade" id="modal-edit">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Edit Data</h4>
      </div>
      <div class="modal-body">
        <form method="post" id="frm-edit">
        <input type="hidden" name="id" id="id">
          <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
            <div class="form-group">
              <label>Berat Badan</label>
              <div class="input-group">
                <input type="text" class="form-control" name="bb" id="bb">
                <div class="input-group-addon">Kg</div>
              </div>
            </div>
          </div>
          <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
            <div class="form-group">
              <label>Tensi Darah</label>
              <div class="input-group">
                <input type="text" class="form-control" name="tensi" id="tensi">
                <div class="input-group-addon">mmHg</div>
              </div>
            </div>
          </div>
          <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
            <div class="form-group">
              <label>Tinggi Badan</label>
              <div class="input-group">
                <input type="text" class="form-control" name="tb" id="tb">
                <div class="input-group-addon">Cm</div>
              </div>
            </div>
          </div>
          <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
            <div class="form-group">
              <label>Buta Warna</label>
              <div class="radio">
                <label style="margin-left: 10px;">
                  <input type="radio" name="bw" value="ya" id="ya">
                  Ya
                </label>
                <label>
                  <input type="radio" name="bw" value="tidak" id="tidak">
                  Tidak
                </label>
              </div>
            </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="form-group">
              <label>Keluhan</label>
              <input type="text" name="keluhan" class="form-control" id="keluhan">
            </div>
            <div class="form-group">
              <label>Anamnesis</label>
              <textarea class="form-control" id="anamnesis" name="anamnesis" rows="3"></textarea>
            </div>
            <div class="form-group">
              <label>Diagnosa</label>
              <input type="text" name="diagnosa" class="form-control" id="diagnosa">
            </div>
            <div class="form-group">
              <label>Tindakan</label>
              <input type="text" name="tindakan" class="form-control" id="tindakan">
            </div>
            <div class="form-group">
              <label>Keterangan</label>
              <textarea class="form-control" id="keterangan" name="keterangan" rows="3"></textarea>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Simpan <i class="fa fa-save"></i></button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@section('customJs')
  <script type="text/javascript">
    $(document).ready(function() {
      $('#datatable').on('click', '.btn-edit', function(event) {
        event.preventDefault();
        var id = $(this).data('id');
        var bb = $(this).data('bb');
        var tensi = $(this).data('tensi');
        var tb = $(this).data('tb');
        var bw = $(this).data('bw');
        var keluhan = $(this).data('keluhan');
        var anamnesis = $(this).data('anamnesis');
        var diagnosa = $(this).data('diagnosa');
        var tindakan = $(this).data('tindakan');
        var keterangan = $(this).data('keterangan');
        // console.log(id);
        var form = $('#frm-edit');
        if (bw == 'ya') {
            form.find('#ya').val(bw).prop('checked', true);     
        }else{
            form.find('#tidak').val(bw).prop('checked', true);
        }
        form.find('#id').val(id);
        form.find('#bb').val(bb);
        form.find('#tb').val(tb);
        form.find('#tensi').val(tensi);
        form.find('#keluhan').val(keluhan);
        form.find('#anamnesis').val(anamnesis);
        form.find('#diagnosa').val(diagnosa);
        form.find('#tindakan').val(tindakan);
        form.find('#keterangan').val(keterangan);
      });

        $('#datatable').on('click','.btn-detail',  function(event) {
        event.preventDefault();
        var id = $(this).data('id');
        var bb = $(this).data('bb');
        var tensi = $(this).data('tensi');
        var tb = $(this).data('tb');
        var bw = $(this).data('bw');
        var keluhan = $(this).data('keluhan');
        var anamnesis = $(this).data('anamnesis');
        var diagnosa = $(this).data('diagnosa');
        var tindakan = $(this).data('tindakan');
        var keterangan = $(this).data('keterangan');
        // console.log(id);
        var form = $('#frm-detail');
        if (bw == 'ya') {
            form.find('#ya').val(bw).prop('checked', true);     
        }else{
            form.find('#tidak').val(bw).prop('checked', true);
        }

        form.find('#id').val(id);
        form.find('#bb').val(bb);
        form.find('#tb').val(tb);
        form.find('#tensi').val(tensi);
        form.find('#keluhan').val(keluhan);
        form.find('#anamnesis').val(anamnesis);
        form.find('#diagnosa').val(diagnosa);
        form.find('#tindakan').val(tindakan);
        form.find('#keterangan').val(keterangan);
      });

      $('#frm-edit').on('submit', function(event) {
        event.preventDefault();
        var data = $(this).serialize();
        // console.log(data);
        $.post("{{route('postUpdateRekamMedis')}}", data, function() {
          toastr.success('Success !', 'Data berhasil di simpan !');
          $('#modal-edit').modal('hide');
          location.reload();
        });
      });

      $('#datatable').on('click','.btn-delete', function(event) {
        event.preventDefault();
        var id = $(this).data('id');
              $.confirm({
                  icon: 'fa fa-warning',
                  title: 'Alert !',
                  content: 'Apakah anda ingin menghapus data ini ?',
                  type: 'red',
                  typeAnimated: true,
                  buttons: {
                  confirm: function () {
                        $.get("{{ route('getDeleteRekamMedis') }}", {id:id}, function(data) {
                          toastr.success('Success !', 'Data berhasil di hapus');
                          location.reload();
                        });
                  
                  },
                  cancel: function () {
                  },
                  }
              });
      });
    });
  </script>
@endsection