<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>DeikhoCP-Login</title>
    <!-- Favicon-->
    <link rel="icon" href="../../favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="{{ asset('public/assets/backend/plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="{{ asset('public/assets/backend/plugins/node-waves/waves.css') }}" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="{{ asset('public/assets/backend/plugins/animate-css/animate.css') }}" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="{{ asset('public/assets/backend/css/style.css') }}" rel="stylesheet">
</head>

<body class="login-page">
    <div class="login-box">
        <div class="logo">
            <a href="javascript:void(0);">Deikho<b>CP</b></a>
            <small>Deikho Control Panel</small>
        </div>
        @if ($message = Session::get('error'))
                     <div class="pgn-wrapper" data-position="bottom-right">
                       <div class="pgn push-on-sidebar-open pgn-flip">
                         <div class="alert alert-danger">
                           <button type="button" class="close" data-dismiss="alert">
                             <span aria-hidden="true">×</span>
                             <span class="sr-only">Close</span>
                           </button><span>{{ $message }}</span>
                         </div>
                       </div>
                     </div>
                     @endif
        <div class="card">
            <div class="body">
                <form id="sign_in"  method="POST" action="{{route('login')}}" >
                    @csrf
                    <div class="msg">Sign in to start your session</div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="username" placeholder="username" required autofocus>
                        </div>
                        @error('username')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                    <div class="row">
                        <div class="col-xs-8 p-t-5">
                            <input type="checkbox" name="rememberme" id="rememberme" class="filled-in chk-col-pink">
                            <label for="rememberme">Remember Me</label>
                        </div>
                        <div class="col-xs-4">
                            <button class="btn btn-block bg-pink waves-effect" type="submit">SIGN IN</button>
                        </div>
                    </div>
                    <div class="row m-t-15 m-b--20">
                        {{-- <div class="col-xs-6">
                            <a href="sign-up.html">Register Now!</a>
                        </div> --}}
                        <div class="col-xs-6 align-right">
                            <a href="forgot-password.html">Forgot Password?</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

 
<!-- Jquery Core Js -->
<script src="{{ asset('public/assets/backend/plugins/jquery/jquery.min.js') }}"></script>

<!-- Bootstrap Core Js -->
<script src="{{ asset('public/assets/backend/plugins/bootstrap/js/bootstrap.js') }}"></script>
     
<!-- Waves Effect Plugin Js -->
<script src="{{ asset('public/assets/backend/plugins/node-waves/waves.js') }}"></script>
     
<!-- Validation Plugin Js -->
<script src="{{ asset('public/assets/backend/plugins/jquery-validation/jquery.validate.js') }}"></script>

<!-- Custom Js -->
<script src="{{ asset('public/assets/backend/js/admin.js') }}"></script>
  
<!-- Demo Js -->
<script src="{{ asset('public/assets/backend/js/pages/examples/sign-in.js') }}"></script>

</body>

</html>