
<!DOCTYPE html>
<html lang="en" style="background-image: url({{ asset('img/1510130_2.jpg')}}) no-repeat fixed; width: 100%;">
<head>
    <title>Agency Book</title>

    <!-- META SECTION -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="{{ asset('favicon.ico')}}" type="image/x-icon">
    <!-- END META SECTION -->
    <!-- CSS INCLUDE -->
    <link rel="stylesheet" href="{{ asset('mera/css/styles.css')}}">
    <link rel="stylesheet" href="{{ asset('mera/css/additional_styles.css')}}">

    <link rel="stylesheet" href="{{ asset('mera/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{ asset('mera/css/bootstrap1.min.css')}}">
    <link rel="stylesheet" href="{{ asset('mera/css/bootstrap-theme.css')}}">
    <link rel="stylesheet" href="{{ asset('mera/css/bootstrap-theme.css.map')}}">
    <link rel="stylesheet" href="{{ asset('mera/css/bootstrap.css.map')}}">

    <script type="text/javascript" src="{{ asset('mera/jquery1.js')}}"></script>
    <script type="text/javascript" src="{{ asset('mera/js/jquery-2.1.js')}}"></script>
    <script type="text/javascript" src="{{ asset('mera/js/jquery-3.1.0.js')}}"></script>


    <!-- APP WRAPPER -->
    <div class="app app-fh" style="background: url({{ asset('img/185340.jpg')}}) no-repeat fixed; width: 100%;">

        <!-- START APP CONTAINER -->

        <div style="background-image: url({{ asset('img/185340.jpg')}}) no-repeat fixed;">


            <div class="app-login-box"
                 style=" width:30%; margin-top: 10%; margin-left:20%;
                         background-image: url({{ asset('img/Memories-quote-with-travel-background_2.png')}}) center center no-repeat fixed;">

                <div class="app-login-box-user"><img src="mera/img/user/no-image.png"></div>
                <div class="app-login-box-container">
                    <h4 style="text-align:center">Login</h4>

                    <br/>
                    <br/>

                    <div class="row justify-content-center">

                        <div class="card">

                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <br/>
                                <br/>

                                <div class="form-group row">
                                    <label style="float:left;" class="col-md-5 col-form-label  text-md-right">User Name</label>

                                    <div class="col-sm-7" style="float:right;">
                                        <input id="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row"  >
                                    <label style="float:left;" class="col-md-4 col-form-label text-md-right">{{ __('Password') }} &nbsp;&nbsp;&nbsp;&nbsp;</label>

                                    <div class="col-md-7"  style="float:right;">
                                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>

                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row" style="float: right;">
                                    <div class="col-md-8">
                                        <button type="submit" class="btn btn-info" style="float: right;">
                                            {{ __('Login') }}
                                        </button>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


                <script type="text/javascript" src="{{ asset('mera/js/bootstrap.js')}}"></script>
                <script type="text/javascript" src="{{ asset('mera/bootstrap1.min.js')}}"></script>
                <script type="text/javascript" src="{{ asset('mera/js/npm.js')}}"></script>


                <script type="text/javascript" src="{{ asset('mera/js/vendor/jquery/jquery.min.js')}}"></script>
                <script type="text/javascript" src="{{ asset('mera/js/vendor/jquery/jquery-ui.min.js')}}"></script>
                <script type="text/javascript" src="{{ asset('mera/js/vendor/bootstrap/bootstrap.min.js')}}"></script>
                <script type="text/javascript" src="{{ asset('mera/js/vendor/moment/moment.min.js')}}"></script>

                <script type="text/javascript" src="{{ asset('mera/js/vendor/customscrollbar/jquery.mCustomScrollbar.min.js')}}"></script>
                <script type="text/javascript" src="{{ asset('bootstrap-select1.jss')}}"></script>
                <script type="text/javascript" src="{{ asset('mera/js/vendor/bootstrap-datetimepicker/bootstrap-datetimepicker.js')}}"></script>

                <script type="text/javascript" src="{{ asset('mera/js/vendor/maskedinput/jquery.maskedinput.min.js')}}"></script>
                <script type="text/javascript" src="{{ asset('mera/js/vendor/form-validator/jquery.form-validator.min.js')}}"></script>

                <script type="text/javascript" src="{{ asset('mera/js/vendor/noty/jquery.noty.packaged.js')}}"></script>

                <script type="text/javascript" src="{{ asset('mera/js/vendor/datatables/jquery.dataTables.min.js')}}"></script>
                <script type="text/javascript" src="{{ asset('mera/js/vendor/datatables/dataTables.bootstrap.min.js')}}"></script>

                <script type="text/javascript" src="{{ asset('mera/js/vendor/sweetalert/sweetalert.min.js')}}"></script>
                <script type="text/javascript" src="{{ asset('mera/js/vendor/knob/jquery.knob.min.js')}}"></script>

                <script type="text/javascript" src="{{ asset('mera/js/vendor/jvectormap/jquery-jvectormap.min.js')}}"></script>
                <script type="text/javascript" src="{{ asset('mera/js/vendor/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
                <script type="text/javascript" src="{{ asset('mera/js/vendor/jvectormap/jquery-jvectormap-us-aea-en.js')}}"></script>

                <script type="text/javascript" src="{{ asset('mera/js/vendor/sparkline/jquery.sparkline.min.js')}}"></script>

                <script type="text/javascript" src="{{ asset('mera/js/vendor/morris/raphael.min.js')}}"></script>
                <script type="text/javascript" src="{{ asset('mera/js/vendor/morris/morris.min.js')}}"></script>

                <script type="text/javascript" src="{{ asset('mera/js/vendor/rickshaw/d3.v3.js')}}"></script>
                <script type="text/javascript" src="{{ asset('mera/js/vendor/rickshaw/rickshaw.min.js')}}"></script>

                <script type="text/javascript" src="{{ asset('mera/js/vendor/isotope/isotope.pkgd.min.js')}}"></script>

                <script type="text/javascript" src="{{ asset('mera/js/app.js')}}"></script>
                <script type="text/javascript" src="{{ asset('mera/js/app_plugins.js')}}"></script>
                <script type="text/javascript" src="{{ asset('mera/js/app_demo.js')}}"></script>
                <!-- END SCRIPTS -->
                <script type="text/javascript" src="{{ asset('mera/js/app_demo_dashboard.js')}}"></script>