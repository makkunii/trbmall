<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Trb Mall - @yield('title')</title>

  <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="/dist/css/adminlte.min.css">


  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">

    <div class="container">
      <a href="{{ route('home')}}" class="navbar-brand">
        <img src="{{ asset('images/trbmalllogo.png') }}" alt="TRB MALL Logo" style="height:60px">
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
                <a class="nav-link" data-toggle="dropdown" href="{{ route('cart')}}">
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







<script src="/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="/dist/js/adminlte.min.js"></script>
</body>
</html>
