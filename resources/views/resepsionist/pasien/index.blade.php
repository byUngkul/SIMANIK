@extends('layouts.app')
@section('content')
<!-- top tiles -->
<div class="row tile_count">
	<div class="col-md-4 col-sm-4 col-xs-6 tile_stats_count">
		<span class="count_top"><i class="fa fa-user"></i> Total Pasien</span>
		<div class="count">{{ count($pasien) }}</div>
	</div>
	<div class="col-md-4 col-sm-4 col-xs-6 tile_stats_count">
		<span class="count_top"><i class="fa fa-clock-o"></i> Pasien Bulan Ini</span>
		<div class="count">{{ count($bulan) }}</div>
	</div>
	<div class="col-md-4 col-sm-4 col-xs-6 tile_stats_count">
		<span class="count_top"><i class="fa fa-user"></i> Pasien Hari Ini</span>
		<div class="count green">{{ count($HariIni) }}</div>
	</div>
</div>
<!-- /top tiles -->
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
			<form action="{{ route('exportExcelPasien', 'xlsx') }}" method="post" id="frm-excel" target="_blank">
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
			<form action="{{ route('exportPDFPasien') }}" method="post" id="frm-pdf" target="_blank">
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
			<h2>Data Pasien Terdaftar</h2>
			<div class="clearfix"></div>
		</div>
		<div class="x_content">
			<table id="datatable" class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>No.</th>
						<th>ID</th>
						<th>Nama</th>
						<th>Alamat</th>
						<th>Tgl. Periksa</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php $no = 1; ?>
					@foreach($pasien as $data)
					<tr>
						<td>{{ $no++ }}</td>
						<td>{{ $data['id'] }}</td>
						<td>{{ $data['nama'] }}</td>
						<td>{{ $data['alamat'] }}</td>
						<td>{{ date('d-F-Y', strtotime($data['created_at'])) }}</td>
						<td>
							<a href="#modal-edit" data-toggle="modal" class="btn btn-warning btn-flat btn-edit"
								data-id="{{ $data['id'] }}" data-nama="{{ $data['nama'] }}" data-alamat="{{ $data['alamat'] }}" data-tgl_lahir="{{ $data['tgl_lahir'] }}" data-telp="{{ $data['telp'] }}" data-pekerjaan="{{$data['pekerjaan']}}" data-status="{{$data['status']}}" data-jenis_kelamin="{{$data['jenis_kelamin']}}"
							><i class="fa fa-edit"></i></a>
							<a href="#!" class="btn btn-danger btn-flat btn-hapus" data-id="{{$data['id']}}"><i class="fa fa-trash"></i></a>
							<a href="#modal-tambah" data-toggle="modal" class="btn btn-primary btn-flat btn-tambah" data-id="{{$data['id']}}" data-nama="{{$data['nama']}}"><i class="fa fa-plus"></i></a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
<div class="clearfix"></div>
{{-- Modal edit --}}
<div class="modal fade" id="modal-edit">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Edit Data</h4>
			</div>
			<div class="modal-body">
				<form method="post" id="frm-edit">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class="form-group">
							<label>ID</label>
							<input type="text" name="id" id="id" class="form-control" required=""  readonly="">
							<input type="hidden" name="status" value="antri">
						</div>
						<div class="form-group">
							<label>Nama</label>
							<input type="text" name="nama" id="nama" class="form-control" required="">
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
						<div class="form-group">
							<label>Tanggal Lahir</label>
							<input type="text" name="tgl_lahir" id="tgl_lahir" class="form-control datepicker">
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
						<div class="form-group">
							<label>Jenis Kelamin</label>
							<div class="radio">
								<label>
									<input type="radio" id="pria" name="jenis_kelamin"  value="pria">
									Pria
								</label>
								<label style="margin-left: 10px">
									<input type="radio" id="wanita" name="jenis_kelamin"  value="wanita">
									Wanita
								</label>
							</div>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class="form-group">
							<label>Pekerjaan</label>
							<input type="text" name="pekerjaan" id="pekerjaan" class="form-control" required="">
						</div>
						<div class="form-group">
							<label>No. Telp</label>
							<input type="text" name="telp" id="telp" class="form-control" required="">
						</div>
						<div class="form-group">
							<label>Alamat</label>
							<textarea class="form-control" id="alamat" name="alamat" required=""></textarea>
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
{{--  modal tambah  --}}
<div class="modal fade" id="modal-tambah">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Edit Data</h4>
			</div>
			<div class="modal-body">
				<form method="post" id="frm-tambah">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class="form-group">
							<label>ID Pasien</label>
							<input type="text" name="id" id="id_pasien" class="form-control" required=""  readonly="">
							<input type="hidden" name="status" value="antri">
						</div>
						<div class="form-group">
							<label>Nama Pasien</label>
							<input type="text" name="nama" id="nama_pasien" class="form-control" required="">
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
						<div class="form-group">
							<label>Pilih Dokter</label>
							<select name="dokter_id" id="dokter_id" class="form-control select2" style="width:100% !important">
								<option disabled selected>-Pilih Dokter-</option>
								@foreach($dokter as $data)
									<option value="{{$data['id']}}" data-id="{{$data['id']}}" data-nama="{{$data['nama']}}" data-spesialis="{{$data['spesialis']['spesialis']}}">{{$data['nama']}}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
						<div class="form-group">
							<label>Spesialis</label>
							<input type="text" id="spesialis_id" class="form-control" readonly>
						</div>
					</div>
					
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default btn-close" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Tambahkan ke Antrian <i class="fa fa-refresh"></i></button>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
@section('customJs')
<script type="text/javascript">
	$(document).ready(function() {
		$('#datatable').on('click', '.btn-edit', function() {
			var id = $(this).data('id');
			var nama = $(this).data('nama');
			var jenis_kelamin = $(this).data('jenis_kelamin');
			var alamat = $(this).data('alamat');
			var tgl_lahir = $(this).data('tgl_lahir');
			var telp = $(this).data('telp');
			var pekerjaan = $(this).data('pekerjaan');
			$('#id').val(id);
			$('#nama').val(nama);
			if (jenis_kelamin == 'pria') {
				$('#pria').prop('checked', 'checked');
			}else{
				$('#wanita').prop('checked', 'checked');
			}
			$('#alamat').val(alamat);
			$('#tgl_lahir').val(tgl_lahir);
			$('#telp').val(telp);
			$('#pekerjaan').val(pekerjaan);
		});

		$('#frm-edit').on('submit', function(e) {
			e.preventDefault();
			var data = $(this).serialize();
			$.post("{{ route('postUpdatePasien') }}", data, function() {
				toastr.success('Success !', 'Data berhasil di update !');
				location.reload();
			});
		});

		$('#datatable').on('click', '.btn-hapus', function(e) {
	              var id = $(this).data('id');
	                 $.confirm({
	                    icon: 'fa fa-warning',
	                    title: 'Alert !',
	                    content: 'Apakah anda ingin menghapus data ini ?',
	                    type: 'red',
	                    typeAnimated: true,
	                    buttons: {
	                        confirm: function () {
	                            $.get("{{ route('getHapusPasien') }}", {id: id}, function (data) {
	                                toastr.success('Success !', 'Data berhasil di hapus');
	                                location.reload();
	                            });
	                        },
	                        cancel: function () {
	                    
	                        },
	                    }
	                });
	          });
		
		$('#datatable').on('click','.btn-tambah', function(e) {
			e.preventDefault();
			var id = $(this).data('id');
			var nama = $(this).data('nama');
			$('#id_pasien').val(id);
			$('#nama_pasien').val(nama);
		});

		$('#dokter_id').on('change', function() {
			$('#dokter_id option:selected').each(function() {
				var id = $(this).data('id');
				var nama = $(this).data('nama');
				var spesialis = $(this).data('spesialis');
				$('#spesialis_id').val(spesialis);
			});
		});

		$('#frm-tambah').on('submit', function(e) {
			e.preventDefault();
			var data = $(this).serialize();
			$.post("{{route('postPasienTerdaftar')}}", data, function(data) {
				toastr.success('Success !', 'Pasien berhasil terdaftar di antrian !');
				$('#modal-tambah').modal('hide');
			});
		});
	});
</script>
@endsection