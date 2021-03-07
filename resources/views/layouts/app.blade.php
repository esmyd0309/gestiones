<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
       
        <title>@yield('title') | Tecnologia</title>
  
        <link href="{{ asset('css/admin/vendor1/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
        <!-- Custom styles for this page -->
        <link href="{{ asset('css/admin/vendor1/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
        <!-- Custom styles for this template-->
        <link href="{{ asset('css/admin/css/sb-admin-2.min.css') }}" rel="stylesheet">
       
    </head>


    <body id="page-top">
        <div id="app">

        
            <div id="wrapper">
                @include("theme.lte.aside")
                <div id="content-wrapper" class="d-flex flex-column">
                <div id="content">
                    @include("theme.lte.header")
                    <div class="container-fluid">
                        @yield("content")
                    </div>
                </div>
                @include("theme.lte.footer")
            
                </div>
            </div>
        
            <a class="scroll-to-top rounded" href="#page-top">
                <i class="fas fa-angle-up"></i>
            </a>
        </div>
       
        @yield('script')

        <!-- Bootstrap core JavaScript-->
        <script src="{{ asset('css/admin/vendor1/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('css/admin/vendor1/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
       
    
        <!-- Core plugin JavaScript-->
        <script src="{{ asset('css/admin/vendor1/jquery-easing/jquery.easing.min.js') }}"></script>

        <!-- Custom scripts for all pages-->
        <script src="{{ asset('css/admin/js/sb-admin-2.min.js') }}"></script>

    
        <!-- Page level plugins -->
        <script src="{{ asset('css/admin/vendor1/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('css/admin/vendor1/datatables/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('css/admin/js/demo/datatables-demo.js') }}"></script>
        <script src="{{ asset('css/admin/vendor1/chart.js/Chart.min.js') }}"></script>
        <script src="{{ asset('css/admin/js/demo/chart-area-demo.js') }}"></script>
        <script src="{{ asset('css/admin/js/demo/chart-pie-demo.js') }}"></script>
        <script src="{{ asset('css/admin/js/demo/chart-bar-demo.js') }}"></script>
       

    </body>
</html>