@extends('layouts.app')

@section('content')
	 <div class="row top_tiles">
              <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-clipboard"></i></div>
                  <div class="count">{{ count($resepsionist) }}</div>
                  <h3>Jumlah Resepsionist</h3>
                </div>
              </div>
              <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-user-md"></i></div>
                  <div class="count">{{ count($dokter) }}</div>
                  <h3>Jumlah Dokter</h3>
                </div>
              </div>
              <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-heartbeat"></i></div>
                  <div class="count">{{ count($apoteker) }}</div>
                  <h3>Jumlah Apoteker</h3>
                </div>
              </div>
            </div>

          
@endsection