<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>window.laravel = { csrfToken: '{{ csrf_token() }}' }</script>

    <title>EASY | School</title>
    {{-- <title>{{ config('app.name', 'CBT - Portal') }}</title> --}}

        <!-- Fonts -->
    <link rel="icon" type="image/png" href="{{ asset('assets/images/e.jpg') }}"/>
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">


    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('assets/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/bower_components/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('assets/bower_components/Ionicons/css/ionicons.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/dist/css/AdminLTE.min.cs') }}s">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('assets/dist/css/skins/_all-skins.min.css') }}">


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">



  <!-- TmeCircles -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/timecircles/1.5.3/TimeCircles.min.css">
  
  <!-- toast plugins  -->
  <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" type="text/css" />

         <!-- Jquery Confirm. -->
    <link rel="stylesheet" href="{{ asset('assets/dist/jquery-confirm.min.css') }}">
  <!-- Alertify  -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/alertify.js/0.5.0/alertify.core.css" />

    <style>
      .block:hover
      {
        background: #666;
      }
    </style>

</head>



<body class="hold-transition skin-blue sidebar-collapse" id="page-top">

    <div id="app" class="wrapper">
        
        <nav class="navbar navbar-expand navbar-dark bg-dark static-top" style="height: 50px">

          <a class="navbar-brand mr-1" href="#" style="margin-top: 15px; font-size: 16px">CBT - Portal</a>

          {{-- <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#" style="margin-right: 5%">
            <i class="fas fa-bars"></i>
          </button>  --}} 
        </nav>

          <!-- Content Wrapper. Contains page content -->
          <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                  <h1>
                    Test
                    <small>Preview</small>
                  </h1>
                  <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li><a href="#">Exam</a></li>
                  </ol>
                </section>



                    <!-- Main content -->
                    <section class="content">


                        @yield('content')


                    </section>

        </div>



            <!-- /.content-wrapper -->
            <footer class="main-footer text-center">
                <div class="text-center hidden-xs">   <b>Version</b> 1.0.0   </div>
                <strong> &copy; 2014-2019 <a href="#">Snapnet</a>.</strong> All rights  reserved.
            </footer>



    </div>






<!-- jQuery 3 -->
<script src="{{ asset('assets/bower_components/jquery/dist/jquery.min.js') }}"></script>

<script src="{{ asset('js/app.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('assets/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('assets/bower_components/fastclick/lib/fastclick.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>

<!-- TOAST SCRIPT  -->
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" type="text/javascript"></script>

<!-- IMECIRCLES -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/timecircles/1.5.3/TimeCircles.min.js"></script>


<!-- Jquery Confirm -->
<script src="{{ asset('assets/dist/jquery-confirm.min.js') }}"></script>
<!-- Alertify -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/alertify.js/0.5.0/alertify.min.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="{{ asset('assets/dist/js/demo.js') }}"></script>

@yield('script')

</body>
</html>
