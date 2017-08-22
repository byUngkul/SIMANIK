@extends('layouts.app')
@section('content')
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
		<div class="x_panel">
			<div class="x_title">
				<h2>Data Pasien</h2>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="form-group">
						<label>ID Pasien</label>
						<input type="text" name="id" id="id" class="form-control" readonly="" value="{{ $pasien['id'] }}">
					</div>
				</div>
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">	
					<div class="form-group">
						<label>Nama Pasien</label>
						<input type="text" name="nama" id="nama" class="form-control" readonly="" value="{{ $pasien['nama'] }}">
					</div>
				</div>
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
					<div class="form-group">
						<label>Umur Pasien</label>
						<input type="text" name="umur" readonly="" class="form-control" value="{{$umur->y}} Tahun">
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<a class="btn btn-success" data-toggle="modal" href='#modal-riwayat'>Lihat riwayat rekam medis</a>
				</div>
			</div>
		</div>

		{{-- modal riwayat rekam medis --}}
					<div class="modal fade" id="modal-riwayat">
						<div class="modal-dialog modal-lg">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									<h4 class="modal-title">Riwayat Rekam Medis</h4>
								</div>
								<div class="modal-body">
									<table class="table table-striped table-bordered">
										<tr>
											<thead>
												<tr>
													<th width="15%">Tanggal Periksa</th>
													<th>Hasil Rekam Medis</th>
												</tr>
											</thead>
											<tbody>
												@if($rekamMedis)
												@foreach($rekamMedis as $data)
												<tr>
													<td>{{ date('d-m-Y', strtotime($data['created_at'])) }}</td>
													<td>
														Keluhan: <strong>{{$data['keluhan']}} </strong>|
														Anamnesis: <strong>{{$data['anamnesis']}} </strong>|
														Diagnosa: <strong>{{$data['diagnosa']}} </strong>|
														Tindakan: <strong>{{$data['tindakan']}} </strong>|
														Keterangan: <strong>{{$data['keterangan']}} </strong>
													</td>
												</tr>
												@endforeach
												@else
												<tr>
													<td>-</td>
													<td>Tidak ada data rekam medis</td>
												</tr>
												@endif
											</tbody>
										</tr>
									</table>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								</div>
							</div>
						</div>
					</div>

		<div class="x_panel">
			<div class="x_title">
				<h2>Rekam Medis Pasien <span class="badge" style="background: #1e88e5;color: #ffffff">{{ $pasien['id'] }}</span></h2>
				<ul class="nav navbar-right panel_toolbox">
					<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
					<li><a class="close-link"><i class="fa fa-close"></i></a></li>
				</ul>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<div class="row">
					<form  method="post" id="frm-rekam-medis">
						<input type="hidden" name="rk_medis" id="rk_medis" value="{{$id}}">
						<input type="hidden" name="nama" id="nama" value="{{$nama}}">
						<input type="hidden" name="tgl_lahir" id="tgl_lahir" value="{{$tgl_lahir}}">
						<input type="hidden" name="dokter_id" id="dokter_id" value="{{ Session::get('id') }}">
						<input type="hidden" name="pasien_id" id="pasien_id" value="{{ $pasien['id'] }}">
						<div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
							<div class="form-group">
								<label>Berat Badan</label>
								<div class="input-group">
									<input type="text" class="form-control" name="bb" id="bb" >
									<div class="input-group-addon">Kg</div>
								</div>
							</div>
						</div>
						<div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
							<div class="form-group">
								<label>Tensi Darah</label>
								<div class="input-group">
									<input type="text" class="form-control" name="tensi" id="tensi" >
									<div class="input-group-addon">mmHg</div>
								</div>
							</div>
						</div>
						<div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
							<div class="form-group">
								<label>Tinggi Badan</label>
								<div class="input-group">
									<input type="text" class="form-control" name="tb" id="tb" >
									<div class="input-group-addon">Cm</div>
								</div>
							</div>
						</div>
						<div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
							<div class="form-group">
								<label>Buta Warna</label>
								<div class="radio">
									<label style="margin-left: 10px;">
										<input type="radio" name="bw" value="tidak">
										Ya
									</label>
									<label>
										<input type="radio" name="bw" value="tidak" checked="checked">
										Tidak
									</label>
								</div>
							</div>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<div class="form-group">
								<label>Keluhan</label>
								<input type="text" name="keluhan" class="form-control" id="keluhan" >
							</div>
							<div class="form-group">
								<label>Anamnesis</label>
								<textarea class="form-control" id="anamnesis" name="anamnesis" rows="3" ></textarea>
							</div>
							<div class="form-group">
								<label>Diagnosa</label>
								<input type="text" name="diagnosa" class="form-control" id="diagnosa" >
							</div>
							<div class="form-group">
								<label>Tindakan</label>
								<input type="text" name="tindakan" class="form-control" id="tindakan" >
							</div>
							<div class="form-group">
								<label>Keterangan</label>
								<textarea class="form-control"  name="deskripsi" id="deskripsi" rows="3" ></textarea>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
			<div class="x_panel">
				<div class="x_title">
					<h2>Isi Resep</h2>
					<ul class="nav navbar-right panel_toolbox">
						<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
						<li><a class="close-link"><i class="fa fa-close"></i></a></li>
					</ul>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
					<label>Alergi Obat</label>
					<div class="form-group">
						<div style="float: left;display: block">
							<div class="radio">
								<label>
									<input type="radio" name="alergi" id="ya" value="ya">
									Ya
								</label>
								<label>
									<input type="radio" name="alergi" id="tidak" value="tidak" checked="checked">
									Tidak
								</label>
							</div>
						</div>
						<div style="float: left;margin-left: 10px">
							<input type="text" name="alergi_obat" id="alergi_obat" class="form-control" disabled="">
						</div>
					</div>
					<br><br>
					<div id="daftar-obat">
						<div class="form-group no">
							<label>Obat 1</label>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
									<select class="form-control select2"  name="obat[]">
										<option disabled="" selected="">- Pilih -</option>
										@foreach ($obat as $data)
										<option value="{{$data['id']}}">{{$data['nama']}}</option>
										@endforeach
									</select>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
									<input type="text" name="jumlah[]" placeholder="jumlah" class="form-control" >
								</div>
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-top:5px">
									<input type="text" placeholder="signa" name="keterangan[]" class="form-control">
								</div>
							</div>
						</div>
						<div class="form-group no">
							<label>Obat 2</label>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
									<select class="form-control select2"  name="obat[]">
										<option disabled="" selected="">- Pilih -</option>
										@foreach ($obat as $data)
										<option value="{{$data['id']}}">{{$data['nama']}}</option>
										@endforeach
									</select>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
									<input type="text" name="jumlah[]" placeholder="jumlah" class="form-control" >
								</div>
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-top:5px">
									<input type="text" placeholder="signa" name="keterangan[]" class="form-control">
								</div>
							</div>
						</div>
					</div>
					<a href="#!" class="btn btn-flat btn-danger btn-tambah"><i class="fa fa-plus"></i></a>
					<button class="btn btn-lg btn-flat btn-primary btn-block" type="submit">
					Simpan <i class="fa fa-save"></i>
					</button>
				</div>
			</div>
		</div>
	</form>
</div>
@endsection
@section('customJs')
<script type="text/javascript">
	$(document).ready(function() {
		// alergi obat
		$('#ya').click(function() {
			$('#alergi_obat').prop('disabled', false);
		});
		$('#tidak').click(function() {
			$('#alergi_obat').prop('disabled', true);
		});
		// isi obat
		$('.btn-tambah').on('click', function(event) {
			event.preventDefault();
			var no = $('.no').length;
			var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
			$.ajax({
			url: "/dokter/getObat",
			type: 'GET',
			dataType: 'JSON',
			success: function (data) {
				var obat = '<div class="form-group no"><label>Obat '+(no+1)+'</label><div class="row"><div class="col-xs-12 col-sm-12 col-md-8 col-lg-8"><select class="form-control select2 obat"  name="obat[]"><option disabled="" selected="">- Pilih -</option></select></div><div class="col-xs-12 col-sm-12 col-md-4 col-lg-4"><input type="text" name="jumlah[]" placeholder="jumlah" class="form-control" ></div><div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-top:5px"><input type="text" placeholder="keterangan" name="keterangan[]" class="form-control"></div></div></div>';
				$('#daftar-obat').append(obat);
				$.each(data, function(i, item){
					$('.obat').append($("<option/>", {
								value: item.id,
								text: item.nama
								}));
						});
						$('.select2').select2();
					}
					});
					
				});
				$('#frm-rekam-medis').on('submit', function(e) {
					e.preventDefault();
					var id = $('#rk_medis').val();
					var nama = $('#nama').val();
					var tgl = $('#tgl_lahir').val();
					var dokter_id = $('#dokter_id').val();
					var pasien_id = $('#pasien_id').val();
					var bb = $('#bb').val();
					var tensi = $('#tensi').val();
					var tb = $('#tb').val();
					var bw = $('input[name="bw"]').val();
					var keluhan = $('#keluhan').val();
					var anamnesis = $('#anamnesis').val();
					var diagnosa = $('#diagnosa').val();
					var tindakan = $('#tindakan').val();
					var deskripsi = $('#deskripsi').val();
					if ($('#tidak').val()) {
						var alergi = $('#tidak').val();
					}else {
						var alergi = $('#alergi_obat').val();
					}
					var obat = $('select[name="obat[]"]').serializeArray();
					var jumlah = $('input[name="jumlah[]"]').serializeArray();
					var keterangan = $('input[name="keterangan[]"]').serializeArray();
					$.post("{{route('postRekamMedisPasien')}}", {
						id:id,
						nama:nama,
						tgl:tgl,
						dokter_id:dokter_id,
						pasien_id:pasien_id,
						bb:bb,
						tensi:tensi,
						bw:bw,
						tb:tb,
						keluhan:keluhan,
						anamnesis:anamnesis,
						diagnosa:diagnosa,
						tindakan:tindakan,
						deskripsi:deskripsi,
						alergi_obat:alergi,
						obat:obat,
						jumlah:jumlah,
						keterangan:keterangan,
					}, function(data) {
						console.log(data);
						toastr.success('Success !', 'Data berhasil di simpan !');
						location.href = "{{route('dokter.index')}}";
					});
				});
			});
	</script>
	@endsection