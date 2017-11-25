<?php
/**
 * Created by PhpStorm.
 * User: Ruben
 * Date: 25-11-2017
 * Time: 21:55
 */
?>
        <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>2Dice - V1.0</title>
    <!-- Force scrollbar -->
    <style> html {
            overflow: -moz-scrollbars-vertical;
            overflow-y: scroll;
        }</style>
    <!-- Favicon -->
    <link rel="icon" type="image/png" href={{ asset("img/favicon.png")}}/>
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
    <br>
    <div class="col-md-12 text-center">
      <div class="text-white" style="font-size: 1500%;">Oops</div>
        <h3 class="text-white">404 page not found</h3> <br>
        <p class="text-white">This page cannot be found</p>
        <a href="{{ url('/dashboard') }}" class="text-dark">
                <button type="button" class="btn btn-outline-warning">Homepage</button>
        </a>
    </div>
</body>
<!-- Bootstrap core JavaScript-->
{{ Html::script("vendor/jquery/jquery.min.js") }}
{{ Html::script("vendor/bootstrap/js/bootstrap.bundle.min.js") }}
<!-- Core plugin JavaScript-->
{{ Html::script("vendor/jquery-easing/jquery.easing.min.js") }}
<!-- Custom scripts for all pages-->
{{ Html::script("js/sb-admin.min.js") }}
</html>
