<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Trb Mall - @yield('title')</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('public/assets/css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('public/assets/css/font-awesome.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('public/assets/css/elegant-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('public/assets/css/jquery-ui.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('public/assets/css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('public/assets/css/slicknav.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('public/assets/css/style.css') }}" type="text/css">
</head>

<body>

@yield("content")
@yield('categories')
@yield('search')

    <!-- Footer Section Begin -->
    <footer class="footer spad">
        <div class="container">

            <div class="row">
                <div class="col-lg-12">
                    <div class="footer__copyright">
                        <div class="footer__copyright__text"><p>All rights reserved | TRB Mall</p></div>
                        <div class="footer__copyright__payment"><img src="{{ asset('/img/payment-item.png')}}" alt=""></div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

   <!-- Js Plugins -->
   <script src="{{ asset('public/assets/js/jquery-3.3.1.min.js') }}"></script>
   <script src="{{ asset('public/assets/js/bootstrap.min.js') }}"></script>
   <script src="{{ asset('public/assets/js/jquery-ui.min.js') }}"></script>
   <script src="{{ asset('public/assets/js/jquery.slicknav.js') }}"></script>
   <script src="{{ asset('public/assets/js/mixitup.min.js') }}"></script>
   <script src="{{ asset('public/assets/js/owl.carousel.min.js') }}"></script>
   <script src="{{ asset('public/assets/js/main.js') }}"></script>


   <script src="{{ asset('public/plugins/datatables/jquery.dataTables.min.js') }}"></script>
   <script src="{{ asset('public/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
   <script src="{{ asset('public/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
   <script src="{{ asset('public/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
   <script src="{{ asset('public/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>


<script>
    $(function () {
    $('#example1').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "responsive": true,
    });
  });
</script>

</body>

</html>
