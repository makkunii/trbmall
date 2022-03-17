<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  {{-- yielding the custom title of per page  --}}
  <title>Trb Mall - @yield('title')</title>

<!-- Css Styles -->
  <link rel="stylesheet" href="{{ asset('public/plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('public/dist/css/adminlte.min.css') }}">

<!--  Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">

    <div class="container">
      <a href="{{ route('home')}}" class="navbar-brand">
        <img src="{{ asset('public/images/trbmalllogo.png') }}" alt="TRB MALL Logo" style="height:60px">
      </a>

      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
            <a href="" class="nav-link">Home</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('home')}} " class="nav-link">Contact</a>
                </li>
      </div>

      <!-- Right navbar links -->
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        <ul class="navbar-nav ">
              <li class="nav-item">
                <a href="{{ route('login')}}" class="nav-link">Login</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link" href="{{ route('cart.list')}}">
                  <i class="fas fa-shopping-cart text-danger btn-lg"></i>
                  <span class="badge badge-warning navbar-badge">{{ Cart::getTotalQuantity()}}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                  <span class="dropdown-header">1 Items</span>
                  <div class="dropdown-divider"></div>
                  <a href="#" class="dropdown-item">
                   TESTING
                  </a>
                  <div class="dropdown-divider"></div>

                  <div class="dropdown-divider"></div>
                  <a href="#" class="dropdown-item dropdown-footer">See All Items</a>
                </div>
              </li>
      </ul>
    </div>
  </nav>
</head>

<body class="hold-transition layout-top-nav">



   @yield("section")






<!-- Scripts -->
<script src="{{ asset('public/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('public/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('public/dist/js/adminlte.min.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" ></script>


</body>
</html>

<!-- Script for provinces -->
<script>
   $(document).ready(function() {
    $('.province').change(function(){
        var province = $(this).val();
        $('.city').html('<option> Loading.. </option>');
          $.ajax({
              url:'{{ route("getCityz") }}',
              type:'POST',
              data:'province='+province+'&_token={{csrf_token()}}',

              success:function(result){
                  $('.city').html(result);
              }

          });

        });

     $('.city').change(function(){

        var city = $(this).val();
        var province = $('.province').val();
        $('.brgy').html('<option> Loading.. </option>');
         $.ajax({
             url:'{{ route("getBrgyz") }}',
             type:'POST',
             data:'city='+city+'&province='+province+'&_token={{csrf_token()}}',

             success:function(result){
                 $('.brgy').html(result);
             }

         });

        });
      });
    </script>
