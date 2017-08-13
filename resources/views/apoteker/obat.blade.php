@extends('layouts.app')

@section('content')
<div class="row top_tiles">
  <div class="animated flipInY col-lg-12 col-md-12 col-sm-6 col-xs-12">
    <div class="tile-stats">
      <div class="icon"><i class="fa fa-heartbeat"></i></div>
      <div class="count">100</div>
      <h3>Total Obat</h3>
    </div>
  </div>
</div>

<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
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
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>1</td>
					<td>Bodrex</td>
					<td>Paracetamol</td>
					<td>Demam</td>
					<td>
						<a href="#modal-detail" class="btn btn-flat btn-info" data-toggle="modal"><i class="fa fa-search"></i></a>
						<a href="#modal-edit" class="btn btn-flat btn-warning" data-toggle="modal"><i class="fa fa-edit"></i></a>
						<a href="#!" class="btn btn-flat btn-danger"><i class="fa fa-trash"></i></a>
					</td>
				</tr>
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
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
					<div class="form-group">	
					<label>Kategori</label>
					<input type="text" name="nama" id="nama" class="form-control">
				</div>
				</div>
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
					<div class="form-group">	
				<label>Keadaan Obat</label>
					<div class="form-group">
						<label>
			                              <input type="checkbox" class="js-switch" checked /> Tersedia
			                   </label>
					</div>
				</div>
				</div>
				<div class="form-group">	
					<label>Harga</label>
					<input type="text" name="nama" id="nama" class="form-control">
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
				<div class="form-group">	
					<label>Nama</label>
					<input type="text" name="nama" id="nama" class="form-control">
				</div>
				<div class="form-group">	
					<label>Kandungan</label>
					<textarea class="form-control" name="kandungan" id="kandungan" rows="3"></textarea>
				</div>
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
					<div class="form-group">	
					<label>Kategori</label>
					<input type="text" name="nama" id="nama" class="form-control">
				</div>
				</div>
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
					<div class="form-group">	
				<label>Keadaan Obat</label>
					<div class="form-group">
						<label>
			                              <input type="checkbox" class="js-switch" checked /> Tersedia
			                   </label>
					</div>
				</div>
				</div>
				<div class="form-group">	
					<label>Harga</label>
					<input type="text" name="nama" id="nama" class="form-control">
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary" >Close</button>
			</div>
		</div>
	</div>
</div>
@endsection