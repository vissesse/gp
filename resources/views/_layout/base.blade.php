<!DOCTYPE html>
<html lang="pt">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title')</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    {{--
    <link href="{{ asset('vendor/fontawesome/css/all.css') }}" rel="stylesheet">
    <!--load all styles -->
    --}}
    <link href="{{ asset('select2/dist/css/select2.min.css') }}" rel="stylesheet " />
    <script src="{{ asset('select2/dist/js/select2.min.js') }}"></script>


    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

</head>

<body id="page-top">
    <!-- sidebar-->
    @if(Auth::guest())
    @yield('login')
    @else

    <!-- end of side bar-->
    <div id="wrapper">
        @include('_layout.side-bar')
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <!-- topbar -->
                @includeif('_layout.nav-top-bar')
                <div class="container-fluid">
                    <!-- Page Heading -->
                    @yield('content')
                </div>
            </div>
            <!--foot -->
            <!-- Footer -->
            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Sistema de gestao de pauta Isutic</span>
                    </div>
                </div>
            </footer>
        </div>

        <!-- End of Footer -->
    </div>
    @endif
    <!-- End of Content Wrapper -->
    @include('_layout.footer')
    <!-- Modal -->

</body>

</html>