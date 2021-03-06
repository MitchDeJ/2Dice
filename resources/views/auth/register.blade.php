<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="2Dice,Timetodice,Dice,Gamble,Fun,Free-to-play,Business">
    <meta name="description" content="2Dice is a free-to-play gamble website. We offer a fun way of gambling without losing real money.">
    <meta name="author" content="Mitchell de Jonge, Ruben Catshoek">
    <title>2Dice - V1.0</title>
    <!-- Force scrollbar -->
    <style> html {
            overflow: -moz-scrollbars-vertical;
            overflow-y: scroll;
        }</style>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}">
    <!-- Custom stylesheet -->
{{ Html::style('css/stylesheet.css') }}
<!-- Bootstrap core CSS-->
{{ Html::style("vendor/bootstrap/css/bootstrap.min.css" ) }}
<!-- Custom fonts for this template-->
{{ Html::style("vendor/font-awesome/css/font-awesome.min.css" ) }}
<!-- Custom styles for this template-->
{{ Html::style("css/sb-admin.css") }}
<!-- jQuery-->
    {{ Html::script("js/jquery-3.2.1.min.js") }}
</head>

<body class="bg-dark">
<div class="col-md-12">
    <a href="{{ url('/dashboard') }}"><img class="logo_center" src="img/dicelogo.png" style="margin: auto; margin-top: 2%; display: block; " alt="Dice logo" width="150px" height="60px"></a>
</div>
<div class="container">
    <div class="card card-register mx-auto mt-5">
        <div class="card-body">
            <form class="form-horizontal" method="POST" action="{{ route('register') }}" id="register-form">
                {{ csrf_field() }}
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-12 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="control-label">Username</label>
                            <input id="name" type="text" class="form-control" placeholder="Username" name="name" value="{{ old('name') }}" required autofocus>
                            @if ($errors->has('name'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="control-label">Email address</label><small> (You need a valid email address to request a forgotten password)</small>
                    <input id="email" type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" required>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-6 {{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="control-label">Password</label>
                            <input id="password" type="password" class="form-control" placeholder="Password" name="password" required>
                        </div>
                        <div class="col-md-6">
                            <label for="password-confirm" class="control-label">Confirm password</label>
                            <input id="password-confirm" type="password" class="form-control" placeholder="Confirm password" name="password_confirmation" required>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block g-recaptcha"
                        data-sitekey="6LffKs4ZAAAAANvACQR3muXpFpKU4yXxnzIkU9ei"
                        data-callback='onSubmit'
                        data-action='submit'>
                    Register
                </button>
            </form>
            <div class="text-center">
                <a class="d-block small mt-3" href="{{ url('/dashboard') }}">Login Page</a>
            </div>
        </div>
    </div>
</div>
<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="https://www.google.com/recaptcha/api.js"></script>
<script>
    function onSubmit(token) {
        document.getElementById("register-form").submit();
    }
</script>
</body>

</html>

