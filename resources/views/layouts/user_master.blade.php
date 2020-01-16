<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title','Home') | {{ config('app.name', 'QuizQon') }}</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.5.0/css/mdb.min.css" rel="stylesheet">

    <link rel="icon" href="images/favicon.ico" type="image/gif" sizes="16x16">
    <link href="https://fonts.googleapis.com/css?family=Nunito:100,300,400,500,600,700,800" rel="stylesheet" type="text/css">

    <!-- Custom style sheets -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css')}}">
    @stack('head')
</head>

<body style="font-family:Nunito">
    <!--Main Navigation-->
    <header>
        @include('partial.nav')
    </header>
    <!--/Main Navigation-->

    <!--Main layout-->
    <main>
        @yield('content')
        
    <div id="fb-root"></div>
    </main>
    <!--/Main layout-->

    <!--Footer-->
    @include('partial.footer')
    <!--/Footer-->


    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.13.0/umd/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.5.0/js/mdb.min.js"></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-154888749-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-154888749-1');
    </script>

    <!--   Custom Scripts   -->
    @stack('scripts')
</body>
</html>
