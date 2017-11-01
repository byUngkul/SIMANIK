<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Sistem Informasi Klinik</title>
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" sizes="32x32" href="{{URL::to('images/favicon.ico')}}">
        <!-- Bootstrap -->
        <link href="{{ URL::to('vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="{{ URL::to('vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    </head>
    <body onload="window.print()">
        <div class="container">
            <div class="table-responsive">
                <h3>Daftar Obat untuk Pasien</h3>
                <hr>
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
                                <td>{{$value['nama']}}</td>
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
    </body>
</html>