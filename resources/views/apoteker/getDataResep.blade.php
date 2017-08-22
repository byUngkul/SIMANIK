@extends('layouts.app')
@section('content')
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<div class="x_panel">
		<div class="x_title">
			<h2>Isi Resep | <span class="btn btn-primary btn-flat" style="color:white">Dr. {{$nama_dokter['dokter']['nama']}}</span> | <span class="btn btn-info btn-flat" style="color:white">Pasien: {{$nama_pasien['pasien']['nama']}}</span></h2>
			<ul class="nav navbar-right panel_toolbox">
				<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
			</li>
			<li><a class="close-link"><i class="fa fa-close"></i></a>
		</li>
	</ul>
	<div class="clearfix"></div>
</div>
<div class="x_content">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<a href="{{route('apoteker.index')}}" class="btn btn-danger btn-flat btn-md"><i class="fa fa-arrow-left"></i> Kembali</a>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
		<table  class="table table-striped table-bordered">
			<thead>
				<tr>
					<th>No.</th>
					<th>Nama Obat</th>
					<th>Harga</th>
					<th>Jumlah</th>
					<th>Stok Obat</th>
				</tr>
			</thead>
			@if ($ada)
				
			<tfoot>
			<tr>
				<td>&nbsp;</td>
				<td>Total</td>
				<td id="total-harga-ada"></td>
				<td id="total-jumlah-ada"></td>
				<td>&nbsp;</td>
			</tr>
			</tfoot>
			<tbody>
				<?php $no = 1;?>

				@foreach ($ada as $data)
				<tr class="baris">
					<td>{{$no++}}</td>
					<td>{{$data['obat']['nama']}} <input type="hidden" name="id[]" class="id" value="{{$data['id']}}"><input type="hidden" name="pasien_id" value="{{$data['pasien_id']}}"></td>
					<td class="harga-ada">{{$data['obat']['harga']}}</td>
					<td class="jumlah-ada">{{$data['jumlah']}}</td>
					<td>
						<span class="btn btn-flat btn-sm btn-success btn-block">Tersedia <i class="fa fa-check"></i></span>
					</td>
				</tr>
				@endforeach
			</tbody>
			@else 
			<tbody>
				<tr>
					<td colspan="5" style="text-align: center;">Tidak ada obat tersedia</td>
				</tr>
			</tbody>
			@endif
			
		</table>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
		<table id="habis" class="table table-striped table-bordered">
			<thead>
				<tr>
					<th>No.</th>
					<th>Nama Obat</th>
					<th>Stok Obat </th>
				</tr>
			</thead>
			<tbody>
				<?php $no = 1;?>
				@foreach ($habis as $data)
				<tr class="baris">
					<td>{{$no++}}</td>
					<td>{{$data['obat']['nama']}}</td>
					<td>
						<span class="btn btn-flat btn-sm btn-danger btn-block">Habis <i class="fa fa-close"></i></span>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	<div class="row">
		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
		@if ($ada)
			<button  class="btn btn-primary btn-flat btn-md btn-konfirmasi">Konfirmasi pembayaran <i class="fa fa-credit-card"></i></button>
		@endif
		</div>
		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
			@if($habis)
		<form action="{{url('/apoteker/DetailResep/dokter_id='.$data['dokter_id']. '&pasien_id='.$data['pasien_id'].'/Print')}}" method="post" target="_blank">
		{{csrf_field()}}
		@foreach ($habis as $data)
		<input type="hidden" name="habis[]" value="{{$data['id']}}">
		@endforeach
			<button type="submit" class="btn btn-warning btn-flat btn-md pull-right btn-print">Print Obat yang tidak tersedia <i class="fa fa-print"></i></button>
		</form>
		@endif
		</div>
	</div>
</div>
</div>
</div>
@endsection
@section('customJs')
<script type="text/javascript">
	$(document).ready(function() {
		var sum = 0;
		var quantity = 0;
		$('.harga-ada').each(function() {
		var price = $(this);
		var q = price.closest('tr').find('.jumlah-ada').text();
		sum += parseInt(price.text()) * parseInt(q);
		quantity += parseInt(q);
		});
		$('#total-harga-ada').text('Rp. '+sum);
		$('#total-jumlah-ada').text(quantity+ ' Obat');
		$('.btn-konfirmasi').on('click', function(e) {
			e.preventDefault();
			var id = $('input[name="id[]"').serializeArray();
			var pasien_id = $('input[name="pasien_id"').val();
			$.post("{{route('postResep')}}", {id:id,pasien_id:pasien_id}, function(data) {
				toastr.success('Success !', 'Pembayaran sudah dikonfirmasi !');
				$('.btn-konfirmasi').prop('disabled', true);
			});
		});
	});
</script>
@endsection