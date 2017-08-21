<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sistem Informasi Klinik</title>
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" sizes="32x32" href="{{URL::to('images/favicon.ico')}}">
    {{-- Select2 --}}
    <link rel="stylesheet" type="text/css" href="{{URL::to('bower_components/select2/dist/css/select2.min.css')}}">
    <!-- Bootstrap -->
    <link href="{{ URL::to('vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ URL::to('vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="{{ URL::to('vendors/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
    {{-- Datepicker --}}
    <link rel="stylesheet" type="text/css" href="{{ URL::to('bower_components/datepicker/css/bootstrap-datepicker.min.css') }}">
    {{-- Toastr --}}
    <link rel="stylesheet" type="text/css" href="{{ URL::to('bower_components/toastr/toastr.min.css') }}">
    {{-- Datatables --}}
    <link href="{{ URL::to('vendors/datatables.net-bs/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ URL::to('vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ URL::to('vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ URL::to('vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ URL::to('vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css') }}" rel="stylesheet">
    {{-- Jquery Confirm --}}
    <link rel="stylesheet" type="text/css" href="{{ URL::to('bower_components/jquery-confirm/dist/jquery-confirm.min.css') }}">
    <!-- Switchery -->
    <link href="{{ URL::to('bower_components/switchery/dist/switchery.min.css') }}" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="{{ URL::to('css/custom.min.css') }}" rel="stylesheet">
  </head>
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col menu_fixed">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="#!" class="site_title"><i class="fa fa-shield"></i> <span> {{ Session::get('profesi') }}</span></a>
            </div>
            <div class="clearfix"></div>
            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                @if(Auth::guard('admin')->check())
                <img src="{{URL::to('images/user-admin.jpg')}}" alt="" class="img-circle profile_img">
                @elseif(Auth::guard('resepsionist')->check())
                <img src="{{ URL::to('images/', Auth::guard('resepsionist')->user()->getPhoto()) }}" al class="img-circle profile_img">
                @elseif(Auth::guard('dokter')->check())
                <img src="{{URL::to('images/',  Auth::guard('dokter')->user()->getPhoto())}}" alt="" class="img-circle profile_img">
                @elseif(Auth::guard('apoteker')->check())
                <img src="{{ URL::to('images/', Auth::guard('apoteker')->user()->getPhoto()) }}" alt="" class="img-circle profile_img">
                @else
                <img src="{{URL::to('images/user-admin.jpg')}}" alt="" class="img-circle profile_img">
                Resepsionist
                @endif
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2>
                @if(Auth::guard('admin')->check())
                {{ Auth::guard('admin')->user()->username }}
                @elseif(Auth::guard('resepsionist')->check())
                {{ Auth::guard('resepsionist')->user()->username }}
                @elseif(Auth::guard('dokter')->check())
                {{ Auth::guard('dokter')->user()->username }}
                @elseif(Auth::guard('apoteker')->check())
                {{ Auth::guard('apoteker')->user()->username }}
                @endif
                </h2>
              </div>
            </div>
            <!-- /menu profile quick info -->
            <br />
            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  @if(Auth::guard('admin')->check())
                  <li><a href="{{ route('admin.index') }}"><i class="fa fa-home"></i> Dashboard</a>
                </li>
                <li><a href="{{ route('adminResepsionist') }}"><i class="fa fa-clipboard"></i> Resepsionist</a>
                <li><a href="{{ route('adminDokter') }}"><i class="fa fa-user-md"></i> Dokter</a></li>
                <li><a href="{{ route('adminApoteker') }}"><i class="fa fa-heartbeat"></i> Apoteker</a></li>
                @elseif(Auth::guard('resepsionist')->check())
                <li><a href="{{ route('resepsionist.index') }}"><i class="fa fa-clipboard"></i> Pendaftaran Pasien</a>
              </li>
              <li><a href="{{ route('getPasien') }}"><i class="fa fa-users"></i>Data Pasien Terdaftar</a>
            </li>
            @elseif(Auth::guard('dokter')->check())
            <li><a href="{{ route('dokter.index') }}"><i class="fa fa-stethoscope "></i> Pemeriksaan Pasien</a>
          </li>
          <li><a href="{{ route('getRekamMedis') }}"><i class="fa fa-list-alt"></i> Data Rekam Medis</a>
          <li><a href="{{ route('getResep') }}"><i class="fa fa-file-text"></i> Data Resep </a>
        </li>
        @elseif(Auth::guard('apoteker')->check())
        <li><a href="{{ route('apoteker.index') }}"><i class="fa fa-list"></i> Resep Hari Ini</a>
      </li>
      <li><a href="{{ route('getObat') }}"><i class="fa fa-medkit"></i> Data Obat</a>
      <li><a href="{{ route('getKategori') }}"><i class="fa fa-bars"></i> Data Kategori Obat</a>
      @endif
    </ul>
  </div>
</div>
<!-- /sidebar menu -->
</div>
</div>
<!-- top navigation -->
<div class="top_nav">
<div class="nav_menu">
<nav>
  <div class="nav toggle">
    <a id="menu_toggle"><i class="fa fa-bars"></i></a>
  </div>
  <ul class="nav navbar-nav navbar-right">
    <li class="">
      <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
        @if(Auth::guard('admin')->check())
        <img src="{{URL::to('images/user-admin.jpg')}}" alt="">
        {{ Auth::guard('admin')->user()->username }}
        @elseif(Auth::guard('resepsionist')->check())
        <img src="{{ URL::to('images/', Auth::guard('resepsionist')->user()->getPhoto()) }}" alt="">
        {{ Auth::guard('resepsionist')->user()->username }}
        @elseif(Auth::guard('dokter')->check())
        <img src="{{URL::to('images/', Auth::guard('dokter')->user()->getPhoto())}}" alt="">
        {{ Auth::guard('dokter')->user()->username }}
        @elseif(Auth::guard('apoteker')->check())
        <img src="{{ URL::to('images/', Auth::guard('apoteker')->user()->getPhoto()) }}" alt="">
        {{ Auth::guard('apoteker')->user()->username }}
        @else
        <img src="{{URL::to('images/user-admin.jpg')}}" alt="">
        Resepsionist
        @endif
        <span class=" fa fa-angle-down"></span>
      </a>
      <ul class="dropdown-menu dropdown-usermenu pull-right">
        <li><a href="{{ route('logout') }}"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
      </ul>
    </li>
  </nav>
</div>
</div>
<!-- /top navigation -->
<!-- page content -->
<div class="right_col" role="main">
@yield('content')
<br />
</div>
</div>
</div>
<!-- /page content -->
<!-- footer content -->
<footer>
<div class="pull-right">
Developed with <i class="fa fa-heart" style="color: red"></i> by <a href="http://easytech.co.id/">Easytech.co.id</a>
</div>
<div class="clearfix"></div>
</footer>
<!-- /footer content -->
</div>
</div>
<!-- jQuery -->
<script src="{{ URL::to('vendors/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ URL::to('vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
{{-- select2 --}}
<script src="{{ URL::to('bower_components/select2/dist/js/select2.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ URL::to('vendors/fastclick/lib/fastclick.js') }}"></script>
{{-- Datatables --}}
<script src="{{ URL::to('vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::to('vendors/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ URL::to('vendors/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ URL::to('vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js') }}"></script>
<script src="{{ URL::to('vendors/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
<script src="{{ URL::to('vendors/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ URL::to('vendors/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ URL::to('vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js') }}"></script>
<script src="{{ URL::to('vendors/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
<script src="{{ URL::to('vendors/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ URL::to('vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js') }}"></script>
<script src="{{ URL::to('vendors/datatables.net-scroller/js/dataTables.scroller.min.js') }}"></script>
<script src="{{ URL::to('vendors/jszip/dist/jszip.min.js') }}"></script>
<script src="{{ URL::to('vendors/pdfmake/build/pdfmake.min.js') }}"></script>
<script src="{{ URL::to('vendors/pdfmake/build/vfs_fonts.js') }}"></script>
{{-- Datepicker --}}
<script src="{{ URL::to('bower_components/datepicker/js/bootstrap-datepicker.min.js') }}"></script>
{{-- Toastr --}}
<script src="{{ URL::to('bower_components/toastr/toastr.min.js') }}"></script>
{{-- Jquery confirm --}}
<script src="{{ URL::to('bower_components/jquery-confirm/dist/jquery-confirm.min.js') }}"></script>
<!-- Switchery -->
<script src="{{ URL::to('bower_components/switchery/dist/switchery.min.js') }}"></script>
<!-- Custom Theme Scripts -->
<script src="{{ URL::to('js/custom.min.js') }}"></script>
<script type="text/javascript">
$(document).ready(function () {
$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});
$("#myTable").DataTable({
dom: 'Bfrtip',
buttons: [
'copy', 'csv', 'excel', 'pdf', 'print'
]
});
$('#datatable').DataTable();
$('.datepicker').datepicker({
format: 'yyyy-mm-dd',
todayHighlight: true
});
$('.bulan').datepicker( {
format: "mm",
viewMode: "months",
minViewMode: "months"
});
$('.tahun').datepicker( {
format: "yyyy",
viewMode: "years",
minViewMode: "years"
})
$('.select2').select2();
});
</script>
@yield('customJs')
</body>
</html>