@extends('layouts.app')
@section('content')
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<div class="x_panel">
		<div class="x_title">
			<h2>Isi Resep | <span class="btn btn-primary btn-flat" style="color:white">Dr. {{$dataResep[0]['dokter']['nama']}}</span> | <span class="btn btn-info btn-flat" style="color:white">Pasien: {{$dataResep[0]['pasien']['nama']}}</span></h2>
			<ul class="nav navbar-right panel_toolbox">
				<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
			</li>
			<li>
				<a class="close-link"><i class="fa fa-close"></i></a>
			</li>
		</ul>
		<div class="clearfix"></div>
	</div>
	<div class="x_content" style="min-height: 300px;margin-bottom: 50px">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
			<div class="form-group">
				<label>Cari Obat</label>
				<select class="form-control select2" id="list-obat" multiple="multiple">
					{{-- <option selected disabled>-Cari Obat-</option> --}}
					@foreach($obat as $data)
					<option value="{{$data['id']}}" 
						data-nama="{{$data['nama']}}"
						data-harga="{{$data['harga']}}"
					>{{$data['nama']}}</option>
					@endforeach
				</select>
			</div>
		</div>
		<div class="col-lg-8 col-xs-12">
			<form action="{{route('postResepObat', [$dataResep[0]['dokter']['id'], $dataResep[0]['pasien']['id']])}}" method="post" id="frm-next" target="_blank">
				{{csrf_field()}}
			<input type="hidden" name="id_dokter" value="{{$dataResep[0]['dokter']['id']}}" form="frm-next">
			<input type="hidden" name="id_pasien" value="{{$dataResep[0]['pasien']['id']}}" form="frm-next">

			<div class="table-responsive">
				<label>Isi Resep</label>
				<table class="table table-hover table-striped">
					<thead>
						<tr>
							<th>No.</th>
							<th>Nama Obat</th>
							<th>Jumlah</th>
						</tr>
					</thead>
					<tbody>
						@foreach($dataResep as $key => $value)
						<tr>
							<td>{{++$key}}</td>
							<td>{{$value['obat']}}
								<input type="hidden" name="id_resep[]" value="{{$value['id']}}">
							</td>
							<td>
								{{$value['jumlah']}}
								<input type="hidden" name="jumlah_obat[]" value="{{$value['jumlah']}}">
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
		<div class="col-lg-12 col-xs-12" style="margin-top: 50px;">
			<div class="table-responsive">
				<label>Daftar Obat untuk Pasien</label>
				<table class="table table-hover table-striped">
					<thead>
						<tr>
							<th>No.</th>
							<th>Nama Obat</th>
							<th>Status Obat</th>
							<th>Harga</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody id="obat-masuk">

					</tbody>
				</table>
			</div>
		</div>
		{{-- <div class="col-lg-4 col-md-4 col-xs-12 pull-right">
			<table class="table table-striped" id="table-bayar">
				<tr>
					<td>Total Harga :</td>
					<td id="total-harga">0</td>
				</tr>
			</table>
		</div> --}}
		<div>
			<a href="{{route('apoteker.index')}}" class="btn btn-danger btn-flat btn-md"><i class="fa fa-arrow-left"></i> Kembali</a>
			<button type="submit" class="btn btn-primary pull-right btn-submit" disabled="true">Selanjutnya <i class="fa fa-arrow-right"></i></button>
		</div>
			</form>
	</div>
</div>
</div>
@endsection
@section('customJs')
<script type="text/javascript">
	$(document).ready(function() {
		// var sum = 0;
		// var quantity = 0;
		// $('.harga-ada').each(function() {
		// var price = $(this);
		// var q = price.closest('tr').find('.jumlah-ada').text();
		// sum += parseInt(price.text()) * parseInt(q);
		// quantity += parseInt(q);
		// });
		// $('#total-harga-ada').text('Rp. '+sum);
		// $('#total-jumlah-ada').text(quantity+ ' Obat');
		// $('.btn-konfirmasi').on('click', function(e) {
		// 	e.preventDefault();
		// 	var id = $('input[name="id[]"').serializeArray();
		// 	var pasien_id = $('input[name="pasien_id"').val();
		// 	$.post("{{route('postResep')}}", {id:id,pasien_id:pasien_id}, function(data) {
		// 		toastr.success('Success !', 'Pembayaran sudah dikonfirmasi !');
		// 		$('.btn-konfirmasi').prop('disabled', true);
		// 	});
		// });
		// transaksi ajax
		$('#list-obat').on('change',function() {
			$('#list-obat option:selected').each(function() {
				var id_obat = $(this).val();
				var no = $('#obat-masuk').find('tr').length;

				// resource data
				const nama_obat = $(this).data('nama');
				// var harga = $(this).data('harga');

				// $('#total-harga').change(function() {
				// 	alert('berubah');
				// });
				// hapus selected
				$(this).remove();

				$.get('{{route("getDataObat")}}', {id:id_obat}, function(data) {
					const row = '<tr>'+
								'<td>'+(no+1)+'<input type="hidden" name="obat_id[]" form="frm-next" value="'+data.id+'"/></td>'+
								'<td>'+data.nama+'</td>'+'<td>'+(data.status == "ada" ? '<a class="btn btn-success">'+data.status+'<i class="fa fa-check"></i></a>' : '<a class="btn btn-danger">'+data.status+' <i class="fa fa-close"></i></a>')+'</td>'+
								'<td class="harga-obat">'+data.harga+'</td>'+
								'<td>'+
								'<a class="btn btn-danger btn-flat btn-hapus'+data.id+'" data-id="'+data.id+'">'+
								'<i class="fa fa-trash"></i></a>'+
								'</td>'+
								'</tr>';
					
					$('#obat-masuk').append(row);
					$('.btn-submit').attr('disabled', false);
					// const hargaAwal = $('#obat-masuk').find('.harga-obat'+data.id).text();
					// const hargaBaru = data.harga;
					// const hasil = parseFloat(hargaAwal) + parseFloat(hargaBaru);
					// alert(hasil);

				});

				// btn hapus
				$('#obat-masuk').on('click', '.btn-hapus'+id_obat, function(e) {
					e.preventDefault();
					$.get('{{route("getDataObat")}}', {id:id_obat}, function(data) {
						const recover = '<option value="'+data.id+'" data-nama="'+data.nama+'">'+data.nama+'</option>';
						$('#list-obat').append(recover);
					});
					$(this).closest('tr').remove();
				});
			});
		});
	});
</script>
@endsection


