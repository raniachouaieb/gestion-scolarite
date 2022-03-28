<!doctype html>
<html lang="en">
<head>
    <title></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{ asset('login-admin/css/style.css')}}">

</head>
<body class="img js-fullheight" style="background-image: url(https://thumbs.dreamstime.com/b/child-girl-running-back-to-school-pupil-kid-retro-dress-briefcase-jumping-over-blackboard-background-child-girl-running-155758904.jpg);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center mb-5">
                <h2 class="heading-section"></h2>
            </div>
        </div>

        @yield('content')

    </div>


<script src="{{ asset('login-admin/js/jquery.min.js')}}"></script>
<script src="{{ asset('login-admin/js/popper.js')}}"></script>
<script src="{{ asset('login-admin/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('login-admin/js/main.js')}}"></script>

  <script src="{{ asset('js/sweetalert.js')}}"></script>
    <script>
        @if(Session('status'))
    //  alert('{{ session('status') }}');
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
