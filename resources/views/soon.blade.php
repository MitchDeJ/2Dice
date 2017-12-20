<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="2Dice,Timetodice,Dice,Gamble,Fun,Free-to-play,Business">
    <meta name="description"
          content="2Dice is a free-to-play gamble website. We offer a fun way of gambling without losing real money.">
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
<script>
    // Set the date we're counting down to
    var countDownDate = {{$timestamp}};

    var xmlHttp;
    function srvTime(){
        try {
            //FF, Opera, Safari, Chrome
            xmlHttp = new XMLHttpRequest();
        }
        catch (err1) {
            //IE
            try {
                xmlHttp = new ActiveXObject('Msxml2.XMLHTTP');
            }
            catch (err2) {
                try {
                    xmlHttp = new ActiveXObject('Microsoft.XMLHTTP');
                }
                catch (eerr3) {
                    //AJAX not supported, use CPU time.
                }
            }
        }
        xmlHttp.open('HEAD',window.location.href.toString(),false);
        xmlHttp.setRequestHeader("Content-Type", "text/html");
        xmlHttp.send('');
        return xmlHttp.getResponseHeader("Date");
    }
    var st = srvTime();
    var now =  Math.round(new Date(st).getTime() / 1000);

    var s = setInterval(function () {
        now++;
    }, 1000);

    // Update the count down every 1 second
    var x = setInterval(function () {
        // Find the distance between now an the count down date
        var distance = countDownDate - now;

        // Time calculations for days, hours, minutes and seconds
        var hours = Math.floor((distance % (60 * 60 * 24)) / (60 * 60));
        var minutes = Math.floor((distance % (60 * 60)) / (60));
        var seconds = Math.floor((distance % (60)));

        // Output the result in an element with id="demo"
        if (distance > 0)
        document.getElementById("countdown").innerHTML = hours + "h " + minutes + "m " + seconds + "s ";

        // If the count down is over, write some text
        if (distance == 0) {
            location.reload(true);
            document.getElementById("countdown").innerHTML = "IT'S TIME 2 DICE";
        }
    }, 100);
</script>
<div class="col-md-12">
    <a href="{{ url('/dashboard') }}"><img class="logo_center" src="img/dicelogo.png"
                                           style="margin: auto; margin-top: 2%; display: block; " alt="Dice logo"
                                           width="150px" height="60px"></a>
</div>
<div class="container">
    <br>
    <br>
<div id="countdown" style="color:white; font-size:1000%; text-align:center"></div>
</div>
<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
</body>

</html>
