@extends('layouts.app')
@section('content')
<div class="row top_tiles">
	<div class="animated flipInY col-lg-12 col-md-12 col-sm-6 col-xs-12">
		<div class="tile-stats">
			<div class="icon"><i class="fa fa-heartbeat"></i></div>
			<div class="count">{{count($kategori)}}</div>
			<h3>Total Kategori Obat</h3>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<a class="btn btn-primary btn-flat" role="button" data-toggle="collapse" href="#collapse-tambah" aria-expanded="false" aria-controls="collapse-tambah">
			Tambah Kategori Obat <i class="fa fa-plus"></i>
		</a>
		{{-- collapse tambah --}}
		<div class="collapse" id="collapse-tambah">
			<div class="well">
				<form method="post" id="frm-tambah">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class="form-group">
							<label>Nama Kategori Obat</label>
							<input type="text" name="kategori" class="form-control">
						</div>
					</div>
					
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<button type="submit" class="btn btn-flat btn-primary btn-block">Simpan <i class="fa fa-save"></i></button>
					</div>
			</form>
				</div>
		</div>
	</div>
	</div>

	<div class="x_panel">
		<div class="x_title">
			<h2>Data Kategori Obat</h2>
			<div class="clearfix"></div>
		</div>
		<div class="x_content">
			<table id="myTable" class="table table-striped table-hover">
				<thead>
					<tr>
						<th>No.</th>
						<th>Nama Kategori</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php $no = 1; ?>
					@foreach ($kategori as $data)
					<tr>
						<td>{{$no++}}</td>
						<td>{{$data['kategori']}}</td>
						<td>
							<a href="#modal-edit" class="btn btn-flat btn-warning btn-edit" data-toggle="modal" data-id="{{$data['id']}}"
								data-kategori="{{$data['kategori']}}" 
							><i class="fa fa-edit"></i></a>
							<a href="#!" class="btn btn-flat btn-danger btn-hapus" data-id="{{$data['id']}}"><i class="fa fa-trash"></i></a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>

{{-- modal edit --}}
<div class="modal fade" id="modal-edit">
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h4 class="modal-title">Edit Kategori Obat</h4>
		</div>
		<div class="modal-body">
			<form method="post" id="frm-edit">
				<div class="form-group">
					<label>Nama Kategori</label>
					<input type="text" name="kategori" id="kategori" class="form-control">
					<input type="hidden" name="id" id="id">
				</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary btn-simpan" >Simpan <i class="fa fa-save"></i></button>
			</form>
		</div>
	</div>
</div>
</div>
</div>
@endsection
@section('customJs')
<script type="text/javascript">
	$(document).ready(function() {
		$('#myTable').on('click','.btn-edit', function(e) {
			e.preventDefault();
			var id = $(this).data('id');
			var kategori = $(this).data('kategori');
			
			var form = $('#modal-edit');
			form.find('#id').val(id);
			form.find('#kategori').val(kategori);
		});

		$('#frm-edit').on('submit', function(e) {
			e.preventDefault();
			var data = $(this).serialize();
			console.log(data);
			$.post("{{route('postUpdateKategori')}}", data, function() {
				// console.log(data);
				toastr.success('Success !', 'Data berhasil di update !');
				location.reload();
			});
		});

		$('#myTable').on('click','.btn-hapus', function(e) {
			var id = $(this).data('id');
			$.confirm({
			icon: 'fa fa-warning',
			title: 'Alert !',
			content: 'Apakah anda ingin menghapus data ini ?',
			type: 'red',
			typeAnimated: true,
			buttons: {
			confirm: function () {
			$.get("{{ route('getHapusKategori') }}", {id: id}, function (data) {
			toastr.success('Success !', 'Data berhasil di hapus');
			location.reload();
			});
			},
			cancel: function () {
			
			},
			}
			});
			});
		$('#frm-tambah').on('submit', function(e) {
			e.preventDefault();
			var data = $(this).serialize();
			$.post("{{route('postKategori')}}", data, function(data) {
				toastr.success('Success !', 'Data berhasil di simpan !');
				location.reload();
			});
		});
	});
	</script>
	@endsection