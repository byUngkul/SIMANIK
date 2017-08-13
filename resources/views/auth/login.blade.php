<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login Area | SIMANIK</title>

    <!-- Bootstrap -->
    <link href="{{ URL::to('vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ URL::to('vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{ URL::to('vendors/nprogress/nprogress.css') }}" rel="stylesheet">
    <!-- Animate.css -->
    <link href="{{ URL::to('vendors/animate.css/animate.min.css') }}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{ URL::to('css/custom.min.css') }}" rel="stylesheet">
  </head>

  <body style="background: #448aff">
          <div style="text-align: center;margin-top: 100px">
              <div class="col-lg-12">
                <h1 style="text-align: center;margin-bottom: 30px;color:#ffffff">Sistem Informasi Klinik</h1>
                @include('layouts.alert')
                <a data-toggle="modal" href='#modal-resepsionist'><img src="{{URL::to('images/resepsionis.png')}}"></a>
                <a data-toggle="modal" href='#modal-dokter'><img src="{{URL::to('images/dokter.png')}}"></a>
                <a data-toggle="modal" href='#modal-apoteker'><img src="{{URL::to('images/apoteker.png')}}"></a>
                <a data-toggle="modal" href='#modal-admin'><img src="{{URL::to('images/admin.png')}}"></a>
              </div>
          </div>

          {{-- Modal resepsionist --}}
                <div class="modal fade" id="modal-resepsionist">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Login Resepsionist</h4>
                      </div>
                      <div class="modal-body">
                        <form action="{{ route('login') }}" method="post">
                        {{ csrf_field() }}
                          <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="username" id="" class="form-control">
                            <input type="hidden" name="level" id="" class="form-control" value="resepsionist">
                          </div>
                          <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" id="" class="form-control">
                          </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Login</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>

                 {{-- Modal dokter --}}
                <div class="modal fade" id="modal-dokter">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Login Dokter</h4>
                      </div>
                      <div class="modal-body">
                        <form action="{{ route('login') }}" method="post">
                        {{ csrf_field() }}
                          <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="username" id="" class="form-control">
                            <input type="hidden" name="level" id="" class="form-control" value="dokter">
                          </div>
                          <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" id="" class="form-control">
                          </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Login</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>

                 {{-- Modal apoteker --}}
                <div class="modal fade" id="modal-apoteker">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Login Apoteker</h4>
                      </div>
                      <div class="modal-body">
                        <form action="{{ route('login') }}" method="post">
                        {{ csrf_field() }}
                          <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="username" id="" class="form-control">
                            <input type="hidden" name="level" id="" class="form-control" value="apoteker">
                          </div>
                          <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" id="" class="form-control">
                          </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Login</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>

                 {{-- Modal Admin --}}
                <div class="modal fade" id="modal-admin">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Login Admin</h4>
                      </div>
                      <div class="modal-body">
                        <form action="{{ route('login') }}" method="post">
                        {{ csrf_field() }}
                          <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="username" id="" class="form-control">
                            <input type="hidden" name="level" id="" class="form-control" value="admin">
                          </div>
                          <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" id="" class="form-control">
                          </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Login</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
          
          <script src="{{ URL::to('vendors/jquery/dist/jquery.min.js') }}"></script>
          <script src="{{ URL::to('vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
  </body>
</html>
