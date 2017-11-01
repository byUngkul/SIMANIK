@extends('layouts.app')
@section('content')
<div class="col-lg-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Konfirmasi Pembelian Obat</h2>
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
        <form action="{{route('confirmTransaksi', [$id_dokter, $id_pasien])}}" method="post">
            {{csrf_field()}}
            <div class="col-lg-12">
                <h2>Daftar Obat untuk Pasien</h2>
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Obat</th>
                                <th>Harga</th>
                                <th>&nbsp;</th>
                                <th>Jumlah Obat</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no =1; ?>
                            @foreach($obat as $key => $value)
                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$value['nama']}}
                                    <input type="hidden" name="id_resep[]" value="{{$id_resep[$key]}}">
                                    <input type="hidden" name="id_obat[]" value="{{$id_obat[$key]}}">
                                    <input type="hidden" name="jumlah_obat[]" value="{{$jumlah_obat[$key]}}">
                                </td>
                                <td>Rp. {{number_format($value['harga'])}}</td>
                                <td><i class="fa fa-close"></i></td>
                                <td>{{$jumlah_obat[$key]}}</td>
                                <td>{{$value['status'] == 'ada' ? ($value['harga'] * $jumlah_obat[$key]) : 'tidak tersedia'}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>Total Biaya</td>
                            <td>Rp. {{number_format($total_biaya)}}</td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <div>
            <span><button type="submit" class="btn btn-primary pull-right">Konfirmasi Pembayaran <i class="fa fa-credit-card"></i></button></span>
        </form>
    </div>
</div>
</div>
@endsection