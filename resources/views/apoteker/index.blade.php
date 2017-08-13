@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
    <div class="x_panel" style="height: 500px !important">
      <div class="x_title">
        <h2>Daftar resep belum terlayani</h2>
        <ul class="nav navbar-right panel_toolbox">
            <li style="margin-right: 5px;padding-top: 5px"><span class="badge" style="background: #E30F0F;color: #ffffff">{{count($resep)}}</span></li>
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
            <li><a class="close-link"><i class="fa fa-close"></i></a></li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
      <div class="">
        <ul class="to_do">
        @foreach ($resep as $data)
          <li><p>Pasien {{ $data['pasien']['nama'] }} | dokter {{ $data['dokter']['nama'] }} <span class="pull-right" style="margin-right: 5px"> ({{$resep->created_at->diffForHumans}}) <a href="#modal-detail" data-toggle="modal" class="btn btn-flat btn-xs btn-info">Lihat</a></span></p></li>
        @endforeach
        </ul>
      </div>
      </div>
    </div>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
    <div class="x_panel" style="height: 500px !important">
      <div class="x_title">
        <h2>Daftar resep sudah terlayani</h2>
        <ul class="nav navbar-right panel_toolbox">
            <li style="margin-right: 5px;padding-top: 5px"><span class="badge" style="background: #b2ff59;color: #ffffff">3</span></li>
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
            <li><a class="close-link"><i class="fa fa-close"></i></a></li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
      <div class="">
        <ul class="to_do">
        <li><p>Pasien Adam | dokter hendrik <span class="pull-right">(2 jam yang lalu)  <a href="#modal-detail-selesai" data-toggle="modal" class="btn btn-flat btn-xs btn-info">Lihat</a></span></p></li>
        <li><p>Pasien Adam | dokter hendrik <span class="pull-right">(2 jam yang lalu)  <a href="#modal-detail" data-toggle="modal" class="btn btn-flat btn-xs btn-info">Lihat</a></span></p></li>
        <li><p>Pasien Adam | dokter hendrik <span class="pull-right">(2 jam yang lalu)  <a href="#modal-detail" data-toggle="modal" class="btn btn-flat btn-xs btn-info">Lihat</a></span></p></li>
        </ul>
      </div>
      </div>
    </div>
  </div>
</div>   

{{-- modal detail -antri --}}
<div class="modal fade" id="modal-detail">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Isi Resep | Dr. Hendrik</h4>
      </div>
      <div class="modal-body">
      <p> Nama Pasien : <b>Adam</b></p>
          <table class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>No.</th>
                <th>Nama Obat</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Cek Obat</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>Total</td>
                <td>Rp. 5000</td>
              </tr>
            </tfoot>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>Bodrex</td>
                  <td>2</td>
                  <td>4000</td>
                  <td>
                    <div class="">
                            <label>
                              <input type="checkbox" class="js-switch" checked /> Tersedia
                            </label>
                          </div>
                  </td>
                </tr>
                <tr>
                  <td>1</td>
                  <td>Bodrex</td>
                  <td>2</td>
                  <td>4000</td>
                  <td>
                    <div class="">
                            <label>
                              <input type="checkbox" class="js-switch" checked /> Tersedia
                            </label>
                          </div>
                  </td>
                </tr>
                <tr>
                  <td>1</td>
                  <td>Bodrex</td>
                  <td>2</td>
                  <td>4000</td>
                  <td>
                    <div class="">
                            <label>
                              <input type="checkbox" class="js-switch" checked /> Tersedia
                            </label>
                          </div>
                  </td>
                </tr>
              </tbody>
          </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-flat pull-left">Print Obat yang tidak tersedia <i class="fa fa-print"></i></button>
        <button type="button" class="btn btn-primary btn-flat">Konfirmasi Pembayaran <i class="fa fa-credit-card"></i></button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal-detail-selesai">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Isi Resep | Dr. Hendrik</h4>
      </div>
      <div class="modal-body">
      <p> Nama Pasien : <b>Adam</b></p>
          <table class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>No.</th>
                <th>Nama Obat</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Cek Obat</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>Total</td>
                <td>Rp. 5000</td>
              </tr>
            </tfoot>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>Bodrex</td>
                  <td>2</td>
                  <td>4000</td>
                  <td>
                    <div class="">
                            <label>
                              <input type="checkbox" class="js-switch" checked /> Tersedia
                            </label>
                          </div>
                  </td>
                </tr>
                <tr>
                  <td>1</td>
                  <td>Bodrex</td>
                  <td>2</td>
                  <td>4000</td>
                  <td>
                    <div class="">
                            <label>
                              <input type="checkbox" class="js-switch" checked /> Tersedia
                            </label>
                          </div>
                  </td>
                </tr>
                <tr>
                  <td>1</td>
                  <td>Bodrex</td>
                  <td>2</td>
                  <td>4000</td>
                  <td>
                    <div class="">
                            <label>
                              <input type="checkbox" class="js-switch" checked /> Tersedia
                            </label>
                          </div>
                  </td>
                </tr>
              </tbody>
          </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-flat">Print Resep <i class="fa fa-print"></i></button>
      </div>
    </div>
  </div>
</div>
@endsection