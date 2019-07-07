<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>GCO-Admin | Log in</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link href="{{ url('public/backend/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ url('public/backend/dist/css/AdminLTE.min.css') }}" rel="stylesheet">
  <link href="{{ url('public/backend/plugins/iCheck/square/blue.css') }}" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- My style -->
  <link rel="stylesheet" href="{{ url('public/backend/cus/mystyle.css') }}"> 
</head>
<body class="hold-transition login-page">
  <div class="login-box">
      <div class="login-logo">
        <a href="javascript:void(0)">&#10053; <b>Login</b> &#10053;</a>
      </div>

    <div class="login-box-body">
      <div class="loginImg">
          <i class="fa fa-user-secret"></i>
      </div>
        <p class="login-box-msg">&#9824; Sign in to start your session &#9824;</p>

        @include('backend.block.error')

        @if(Session::has('flash_message'))
        <div class="alert alert-{!! Session::get('flash_level') !!} alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Thông báo</h4>
            {!! Session::get('flash_message') !!}
        </div>
        @endif

        <form action="{{ asset('login') }}" method="post">
            {{ csrf_field() }}
          <div class="form-group has-feedback">
              <input type="text" class="form-control" placeholder="Username" name="username" value="{!! old('username') !!}">
              <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>

          <div class="form-group has-feedback">
              <input type="password" class="form-control" placeholder="Password" name="password">
              <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>

          <div class="row">
              <div class="col-xs-8">
                  <div class="checkbox icheck">
                    <label>
                        <input type="checkbox" name="remember"> Remember Me
                    </label>
                  </div>
              </div>

              <div class="col-xs-4">
                  <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
              </div>
          </div>
        </form>
    </div>
  </div>

    <div id = "cloud"><span class='shadow'></span></div>

  <script src="{{ url('public/backend/plugins/jQuery/jquery-3.1.1.min.js') }}"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="{{ url('public/backend/bootstrap/js/bootstrap.min.js') }}"></script>
  <script src="{{ url('public/backend/plugins/iCheck/icheck.min.js') }}"></script>
  <script>
      $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%'
        });
      });
  </script>
</body>
</html>