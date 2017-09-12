@extends('layouts.app')
@section('content')
<div class="row top_tiles">
	<div class="animated flipInY col-lg-12 col-md-12 col-sm-6 col-xs-12">
		<div class="tile-stats">
			<div class="icon"><i class="fa fa-heartbeat"></i></div>
			<div class="count">{{count($obat)}}</div>
			<h3>Total Obat</h3>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<a class="btn btn-primary btn-flat" role="button" data-toggle="collapse" href="#collapse-tambah" aria-expanded="false" aria-controls="collapse-tambah">
			Tambah Obat <i class="fa fa-plus"></i>
		</a>
		<a class="btn btn-success btn-flat" href="{{route('exportExcelObat', 'xlsx')}}">
			Export To Excel <i class="fa fa-file-excel-o"></i>
		</a>
		<a class="btn btn-danger btn-flat" href="#collapse-pdf" data-toggle="collapse">
			Export To PDF <i class="fa fa-file-pdf-o"></i>
		</a>
		{{-- collapse pdf --}}
	<div class="collapse" id="collapse-pdf">
		<div class="well">
			<form action="{{route('exportPDFObat')}}" method="post">
				{{csrf_field()}}
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
					<div class="form-group">
						<label>Semua Data Obat</label>
						<input type="submit" class="btn btn-flat btn-info btn-md btn-block" name="semua" value="semua">
					</div>
				</div>
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
					<div class="form-group">
						<label>Data Obat yang Habis</label>
						<input type="submit" class="btn btn-flat btn-danger btn-md btn-block" name="habis" value="habis">
					</div>
				</div>
			</form>
		</div>
	</div>
		{{-- collapse tambah --}}
		<div class="collapse" id="collapse-tambah">
			<div class="well">
				<form method="post" id="frm-tambah">
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
						<div class="form-group">
							<label>Nama Obat</label>
							<input type="text" name="nama" class="form-control">
						</div>
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
						<div class="form-group">
							<label>Kategori Obat</label>
							<div class="input-group">
								<select name="kategori_id" id="select-kategori" class="form-control select2" style="width: 100% !important">
									<option disabled="" selected="">-Pilih Kategori Obat-</option>
									@foreach ($kategori as $data)
									<option value="{{$data['id']}}">{{$data['kategori']}}</option>
									@endforeach
								</select>
								<div class="input-group-addon"><a href="#modal-kategori" data-toggle="modal" class="btn-kategori"><i class="fa fa-plus"></i></a></div>
							</div>
						</div>
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
						<div class="form-group">
							<label>Harga Obat</label>
							<input type="text" name="harga" class="form-control">
						</div>
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
						<div class="form-group">
							<label>Stok Obat</label>
							<div class="radio">
								<label>
									<input type="checkbox" class="js-switch" checked=""  /> Tersedia
								</label>
							</div>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class="form-group">
							<label>Kandungan</label>
							<textarea class="form-control" rows="3" name="kandungan"></textarea>
						</div>
						<button type="submit" class="btn btn-flat btn-primary btn-block">Simpan <i class="fa fa-save"></i></button>
					</div>
				</div>
			</form>
		</div>
	</div>
	</div>

	<div class="x_panel">
		<div class="x_title">
			<h2>Data Obat</h2>
			<div class="clearfix"></div>
		</div>
		<div class="x_content">
			<table id="datatable" class="table table-striped table-hover">
				<thead>
					<tr>
						<th>No.</th>
						<th>Nama</th>
						<th>Kandungan</th>
						<th>Kategori</th>
						<th>Stok Obat</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php $no = 1; ?>
					@foreach ($obat as $data)
					<tr>
						<td>{{$no++}}</td>
						<td>{{$data['nama']}}</td>
						<td>{{$data['kandungan']}}</td>
						<td>{{$data['kategori']['kategori']}}</td>
						<td>
							@if ($data['status'] == 'ada')
							<span class="btn btn-flat btn-success btn-block">Tersedia <i class="fa fa-check"></i></span>
							@else
							<span class="btn btn-flat btn-danger btn-block">Habis <i class="fa fa-close"></i></span>
							@endif
						</td>
						<td>
							<a href="#modal-detail" class="btn btn-flat btn-info btn-detail" data-toggle="modal" data-controls-modal="modal-detail"
								data-backdrop="static"
								data-keyboard="false"
								data-nama="{{$data['nama']}}" data-kandungan="{{$data['kandungan']}}" data-kategori="{{$data['kategori']['kategori']}}" data-harga="{{$data['harga']}}" data-stok="{{$data['status']}}"
							><i class="fa fa-search"></i></a>
							<a href="#modal-edit" class="btn btn-flat btn-warning btn-edit" data-toggle="modal" data-id="{{$data['id']}}"
								data-nama="{{$data['nama']}}" data-kandungan="{{$data['kandungan']}}" data-kategori="{{$data['kategori']['kategori']}}" data-harga="{{$data['harga']}}" data-stok="{{$data['status']}}"
							><i class="fa fa-edit"></i></a>
							<a href="#!" class="btn btn-flat btn-danger btn-hapus" data-id="{{$data['id']}}"><i class="fa fa-trash"></i></a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
</div>
{{-- modal detail --}}
<div class="modal fade" id="modal-detail">
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h4 class="modal-title">Detail Obat</h4>
		</div>
		<div class="modal-body">
			<div class="form-group">
				<label>Nama</label>
				<input type="text" name="nama" id="nama" class="form-control">
			</div>
			<div class="form-group">
				<label>Kandungan</label>
				<textarea class="form-control" name="kandungan" id="kandungan" rows="3"></textarea>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
					<div class="form-group">
						<label>Kategori</label>
						<input type="text" name="kategori" id="kategori" class="form-control">
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
					<div class="form-group">
						<label>Stok Obat</label>
						<div class="form-group status">
							
						</div>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label>Harga</label>
				<input type="text" name="harga" id="harga" class="form-control">
			</div>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default btn-close" data-dismiss="modal">Close</button>
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
			<h4 class="modal-title">Edit Obat</h4>
		</div>
		<div class="modal-body">
			<form method="post" id="frm-edit">
				<div class="form-group">
					<label>Nama</label>
					<input type="text" name="nama" id="nama" class="form-control">
					<input type="hidden" name="id" id="id">
				</div>
				<div class="form-group">
					<label>Kandungan</label>
					<textarea class="form-control" name="kandungan" id="kandungan" rows="3"></textarea>
				</div>
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
						<div class="form-group">
							<label>Kategori</label>
							<select name="kategori_id" class="form-control select2" style="width: 100% !important">
								@foreach ($kategori as $data)
									<option value="{{$data['id']}}">{{$data['kategori']}}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
						<div class="form-group">
							<label>Keadaan Obat</label>
							<select name="status" class="form-control" id="stok">
								<option value="ada">Ada</option>
								<option value="habis">Habis</option>
							</select>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label>Harga</label>
					<input type="text" name="harga" id="harga" class="form-control">
				</div>
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
{{-- modal kategori --}}
<div class="modal fade" id="modal-kategori">
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h4 class="modal-title">Tambah Kategori Obat</h4>
		</div>
		<div class="modal-body">
			<form method="post" id="frm-kategori">
				<div class="form-group">
					<label>Nama Kategori</label>
					<input type="text" name="kategori" id="kategori" class="form-control">
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-flat btn-primary">Simpan <i class="fa fa-save"></i></button>
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
		$('#datatable').on('click','.btn-detail', function(e) {
			e.preventDefault();
			var nama = $(this).data('nama');
			var kandungan = $(this).data('kandungan');
			var kategori = $(this).data('kategori');
			var stok = $(this).data('stok');
			var harga = $(this).data('harga');
			if (stok == 'ada') {
				var status = '<span class="btn btn-flat btn-success btn-block">Tersedia <i class="fa fa-check"></i></span>'
				$('.status').append(status);
			}else {
				var status = '<span class="btn btn-flat btn-danger btn-block">Habis <i class="fa fa-close"></i></span>'
				$('.status').append(status);
			}
			var form = $('#modal-detail');
			form.find('#nama').val(nama);
			form.find('#kandungan').val(kandungan);
			form.find('#kategori').val(kategori);
			form.find('#harga').val(harga);
			$('.btn-close').on('click', function(event) {
				event.preventDefault();
				$('.status').empty();
			});
		});
		
		$('#datatable').on('click','.btn-edit', function(e) {
			e.preventDefault();
			var id = $(this).data('id');
			var nama = $(this).data('nama');
			var kandungan = $(this).data('kandungan');
			var kategori = $(this).data('kategori');
			var stok = $(this).data('stok');
			var harga = $(this).data('harga');
			// console.log(stok);
			
			if (stok == 'ada') {
				$('#stok').val(stok).change();
			}else {
				$('#stok').val(stok).change();
			}
			var form = $('#modal-edit');
			form.find('#id').val(id);
			form.find('#nama').val(nama);
			form.find('#kandungan').val(kandungan);
			form.find('#kategori').val(kategori).change();
			form.find('#harga').val(harga);
		});

		$('#frm-edit').on('submit', function(e) {
			e.preventDefault();
			var data = $(this).serialize();
			console.log(data);
			$.post("{{route('postUpdateObat')}}", data, function() {
				// console.log(data);
				toastr.success('Success !', 'Data berhasil di update !');
				location.reload();
			});
		});

		$('#datatable').on('click', '.btn-hapus',function(e) {
			var id = $(this).data('id');
			$.confirm({
			icon: 'fa fa-warning',
			title: 'Alert !',
			content: 'Apakah anda ingin menghapus data ini ?',
			type: 'red',
			typeAnimated: true,
			buttons: {
			confirm: function () {
			$.get("{{ route('getHapusObat') }}", {id: id}, function (data) {
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
			$.post("{{route('postObat')}}", data, function(data) {
				toastr.success('Success !', 'Data berhasil di simpan !');
				location.reload();
			});
		});
		$('#frm-kategori').on('submit', function(e) {
			e.preventDefault();
			var data = $(this).serialize();
			$.post("{{route('postKategori')}}", data, function(data) {
				toastr.success('Success!', 'Kategori berhasil di tambahkan!');
				$('#select-kategori').append($('<option />', {
						value: data.id,
						text: data.kategori,
					}));
					$('#modal-kategori').modal('hide');
				});
			})
		});
	</script>
	@endsection