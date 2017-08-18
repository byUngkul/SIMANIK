<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Data Obat</title>
        <body>
            <style type="text/css">
                .tg  {border-collapse:collapse;border-spacing:0;border-color:#ccc;width: 100%; }
                .tg td{font-family:Arial;font-size:12px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#ccc;color:#333;background-color:#fff;}
                .tg th{font-family:Arial;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#ccc;color:#333;background-color:#f0f0f0;}
                .tg .tg-3wr7{font-weight:bold;font-size:12px;font-family:"Arial", Helvetica, sans-serif !important;;text-align:center}
                .tg .tg-ti5e{font-size:10px;font-family:"Arial", Helvetica, sans-serif !important;;text-align:center}
                .tg .tg-rv4w{font-size:10px;font-family:"Arial", Helvetica, sans-serif !important;}
            </style>
        
            <div style="font-family:Arial; font-size:12px;">
                <center><h2>{{$status == 'semua' ? 'Data semua Obat' : 'Data Obat stok habis'}}</h2></center>
            </div>
            <br>
            <table class="tg">
              <tr>
                <th class="tg-3wr7">No.<br></th>
                <th class="tg-3wr7">Nama Obat<br></th>
                <th class="tg-3wr7">Kategori Obat<br></th>
                <th class="tg-3wr7">Harga<br></th>
                @if ($status == 'semua')
                        <th class="tg-3wr7">Status Obat<br></th> 
                @endif
              </tr>
              <?php $no = 1; ?>
            @foreach ($obat as $data)
              <tr>
                <td class="tg-rv4w" width="7%">{{ $no++ }}</td>
                <td class="tg-rv4w" width="30%">{{$data['nama'] }}</td>
                <td class="tg-rv4w" width="20%">{{$data['kategori']['kategori'] }}</td>
                <td class="tg-rv4w" width="10%">Rp. {{number_format($data['harga']) }}</td>
                @if ($status == 'semua')
                <td class="tg-rv4w" width="10%">{{$data['status'] }}</td>
                @endif
              </tr>
            @endforeach
            </table>
        </body>
    </head>
</html>
