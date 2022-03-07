<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('login-template/fonts/icomoon/style.css')}}">

    <link rel="stylesheet" href="{{ asset('login-template/css/owl.carousel.min.css')}}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('login-template/css/bootstrap.min.css')}}">
    
    <!-- Style -->
    <link rel="stylesheet" href="{{ asset('login-template/css/style.css')}}">

    <title>Login #3</title>
  </head>
  <body>
  

  <div class="half">
    <div class="bg order-1 order-md-2" style="background-image: url('login-template/images/bg2_academia.webp');"></div>
    <div class="contents order-2 order-md-1">

     @yield('content')
    </div>

    
  </div>
    
    

    <script src="{{ asset('login-template/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{ asset('login-template/js/popper.min.js')}}"></script>
    <script src="{{ asset('login-template/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('login-template/js/main.js')}}"></script>
    <script>
        @if(Session('status'))             
     // alert('{{ session('status') }}');
                swal({
            title: '{{ session('status') }}',
            //text: "You clicked the button!",
            icon: '{{ session('statuscode') }}',
            button: "Done!",
            });
@endif

    </script>
  </body>
</html>