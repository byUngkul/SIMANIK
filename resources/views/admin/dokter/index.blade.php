@extends('layouts.app')
@section('content')
<div class="row top_tiles">
	<div class="animated flipInY col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="tile-stats">
			<div class="icon"><i class="fa fa-user-md"></i></div>
			<div class="count">{{ count($dokter) }}</div>
			<h3>Jumlah Dokter</h3>
		</div>
	</div>
	<div class="col-md-12 col-sm-12 col-xs-12">
		<a class="btn btn-primary" role="button" data-toggle="collapse" href="#collapse-tambah" aria-expanded="false" aria-controls="collapseExample">
			<i class="fa fa-plus"></i> Tambah Data Dokter
		</a>
		<div class="collapse" id="collapse-tambah">
			<div class="well">
				<div class="x_panel">
					<div class="x_title">
						<h2>Tambah Data Dokter</h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<form action="{{ route('postAdminDokter') }}"  method="post" id="frm-dokter" enctype="multipart/form-data">
							{{ csrf_field() }}
							<div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
								<div class="col-lg-12">
									<div class="form-group">
										<label>ID</label>
										<input type="text" name="id" class="form-control" value="{{ $id }}" readonly="">
										<input type="hidden" name="level"  value="dokter">
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<label>Username</label>
										<input type="text" name="username" class="form-control" required="">
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<label>Password</label>
										<input type="password" name="password" class="form-control" required="">
									</div>
								</div>
								<div class="col-lg-4">
									<div class="form-group">
										<label>Nama</label>
										<input type="text" name="nama" class="form-control" required="">
									</div>
								</div>
								<div class="col-lg-4">
									<div class="form-group">
										<label>Tgl. Lahir</label>
										<input type="text" name="tgl_lahir" class="form-control datepicker" required="">
									</div>
								</div>
								<div class="col-lg-4">
									<div class="form-group">
										<label>Spesialis</label>
										<div class="input-group">
											<select class="form-control select2" required="" id="select-spesialis" name="spesialis_id" style="width: 100% !important">
												@foreach($spesialis as $data)
												<option value="{{$data['id']}}">{{$data['spesialis']}}</option>
												@endforeach
											</select>
											<div class="input-group-addon"><i class="fa fa-plus btn-plus"></i></div>
										</div>
									</div>
								</div>
								<div class="col-lg-12">
									<div class="form-group">
										<label>Alamat</label>
										<textarea class="form-control" name="alamat" required=""></textarea>
									</div>
								</div>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
								<div class="panel panel-default">
									<div class="panel-heading">
										<h3 class="panel-title">Upload Photo</h3>
									</div>
									<div class="panel-body">
										<div class="form-group">
											<label></label>
											<img src="{{ URL::to('images/user-dokter.jpg') }}" class="img-thumbnail" width="200px" height="200px" id="showPhoto">
											<input type="file" class="form-control" id="photo" name="photo" value="{{ URL::to('images/user-dokter.jpg') }}">
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-12">
								<button type="submit" class="btn btn-primary btn-block btn-flat">Simpan <i class="fa fa-save"></i></button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="x_panel">
			<div class="x_title">
				<h2> Data Dokter</h2>
				<ul class="nav navbar-right panel_toolbox">
					<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
				</li>
				<li><a class="close-link"><i class="fa fa-close"></i></a>
			</li>
		</ul>
		<div class="clearfix"></div>
	</div>
	<div class="x_content">
		<table id="myTable" class="table table-striped table-bordered">
			<thead>
				<tr>
					<th>No.</th>
					<th>ID</th>
					<th>Username</th>
					<th>Nama</th>
					<th>Alamat</th>
					<th>Tgl. Lahir</th>
					<th>Spesialis</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php $no = 1; ?>
				@foreach($dokter as $data)
				<tr>
					<td>{{ $no++ }}</td>
					<td>{{ $data['id'] }}</td>
					<td>{{ $data['username'] }}</td>
					<td>{{ $data['nama'] }}</td>
					<td>{{ $data['alamat'] }}</td>
					<td>{{ date('d-F-Y', strtotime($data['tgl_lahir'])) }}</td>
					<td>{{ $data['spesialis']['spesialis'] }}</td>
					<td>
						<a href="#modal-edit" data-toggle="modal" class="btn btn-warning btn-flat btn-edit"
							data-id={{ $data['id'] }} data-username={{ $data['username'] }} data-nama="{{ $data['nama'] }}" data-alamat={{ $data['alamat'] }} data-tgl_lahir={{ $data['tgl_lahir'] }} data-password="{{$data['password']}}" data-spesialis_id="{{$data['spesialis_id']}}"
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
{{-- modal edit --}}
<div class="modal fade" id="modal-edit">
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h4 class="modal-title">Edit Data</h4>
		</div>
		<div class="modal-body">
			<form action="{{ route('updateAdminDokter') }}" method="post" id="frm-edit" enctype="multipart/form-data">
			{{ csrf_field() }}
				<div class="row">
					<div class="col-lg-6">
						<div class="form-group">
							<label>ID</label>
							<input type="text" name="id" id="id" class="form-control" value="" readonly="">
						</div>
					</div>
					<div class="col-lg-6">
						<label>Upload Photo terbaru</label>
						<input type="file" name="photo" id="photo" class="form-control">
					</div>
				</div>
				<div class="col-lg-6">
					<div class="form-group">
						<label>Username</label>
						<input type="text" name="username" id="username" class="form-control" required="">
					</div>
				</div>
				<div class="col-lg-6">
					<div class="form-group">
						<label>Password</label>
						<input type="password" id="password" name="password" class="form-control"  required="">
					</div>
				</div>
				<div class="col-lg-4">
					<div class="form-group">
						<label>Nama</label>
						<input type="text" name="nama" id="nama" class="form-control" required="">
					</div>
				</div>
				<div class="col-lg-4">
					<div class="form-group">
						<label>Tgl. Lahir</label>
						<input type="text" name="tgl_lahir" id="tgl_lahir" id="datepicker" class="form-control" required="">
					</div>
				</div>
				<div class="col-lg-4">
					<div class="form-group">
						<label>Spesialis</label>
							<select class="form-control select2" required="" id="spesialis_id" name="spesialis_id" style="width: 100% !important">
								@foreach($spesialis as $data)
								<option value="{{$data['id']}}">{{$data['spesialis']}}</option>
								@endforeach
							</select>
					</div>
				</div>
				<div class="col-lg-12">
					<div class="form-group">
						<label>Alamat</label>
						<textarea class="form-control" required="" id="alamat" name="alamat"></textarea>
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
{{-- modal tambah spesialis --}}
<div class="modal fade" id="modal-spesialis">
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h4 class="modal-title">Tambah Data Spesialis</h4>
		</div>
		<div class="modal-body">
			<form method="post" id="frm-spesialis">
				<div class="form-group">
					<label>Nama Speasialis</label>
					<input type="text" name="spesialis" class="form-control">
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Tambahkan <i class="fa fa-plus"></i></button>
			</form>
		</div>
	</div>
</div>
</div>
@endsection
@section('customJs')
<script type="text/javascript">
	$(document).ready(function() {
		function showFile(fileInput, img, showName) {
			if (fileInput.files[0]) {
				var reader = new FileReader();
				reader.onload = function (e) {
				$(img).attr('src', e.target.result);
				}
				reader.readAsDataURL(fileInput.files[0]);
				}
				$('#showPhoto').text(fileInput.files[0].name)
			}
			$('#photo').on('change', function() {
				showFile(this, '#showPhoto');
				});
		$('#frm-dokter').on('submit', function() {
				toastr.success('Success !', 'Data berhasil di simpan !');
		});
		$('#myTable').on('click','.btn-edit', function(e) {
			e.preventDefault();
			var id = $(this).data('id');
			var username = $(this).data('username');
			var nama = $(this).data('nama');
			var alamat = $(this).data('alamat');
			var tgl_lahir = $(this).data('tgl_lahir');
			var password = $(this).data('password');
			var spesialis_id = $(this).data('spesialis_id');
			// console.log(spesialis_id);
			$('#id').val(id);
			$('#username').val(username);
			$('#nama').val(nama);
			$('#alamat').val(alamat);
			$('#tgl_lahir').val(tgl_lahir);
			$('#password').val(password);
			$('#spesialis_id').val(spesialis_id).change();
		});
		$('#frm-edit').on('submit', function(e) {
				toastr.success('Success !', 'Data berhasil di simpan !');
				$('#modal-edit').modal('hide');
		});
		$('#myTable').on('click','.btn-delete', function(e) {
			e.preventDefault();
			var id = $(this).data('id');
			$.confirm({
			title: 'Alert !',
			content: 'Apakah anda ingin menghapus data ini ?',
			buttons: {
			confirm: function () {
						$.get("{{route('deleteAdminDokter')}}", {id:id}, function(data) {
				toastr.success('Success !', 'Data berhasil di hapus');
				location.reload();
						});

			},
			cancel: function () {
			$.alert('Batal!');
			},
			}
			});
		});
		$('.btn-plus').on('click', function(e) {
			e.preventDefault();
			$('#modal-spesialis').modal('show');
		});
		$('#frm-spesialis').on('submit', function(e) {
			e.preventDefault();
			var data = $(this).serialize();
			$.post("{{ route('addSpesialis') }}", data,function(data) {
				$('#select-spesialis').append($("<option/>", {
					value : data.id,
					text : data.spesialis
				}));
					$('#modal-spesialis').modal('hide');
			});
		});
	});
</script>
@endsection
