<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags always come first -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="../img/zu/favicon.ico">
    <title>ZU Potal de administración</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css">

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Material Design Bootstrap -->
    <link href="{{ asset('css/mdb.min.css') }}" rel="stylesheet">
    @yield('css')
    <style>


    </style>

</head>
<body class="fixed-sn white-skin">

    @yield('menu')

    <main>
        <div class="container-fluid">

            @yield('content')

        </div>
    </main>
    <!-- SCRIPTS -->

    <!-- JQuery -->
    <script type="text/javascript" src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>

    <!-- Tooltips -->
    <script type="text/javascript" src="{{ asset('js/tether.min.js') }}"></script>

    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>

    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="{{ asset('js/mdb.min.js') }}"></script>
    
    <!--Data table-->
    <script type="text/javascript" src="{{ asset('js/jquery.dataTables.js') }}"></script>
    
    <script>
        //var url="http://192.168.0.26/zu/public/index.php/";
        var urlCore="{{asset('')}}";
        $(".button-collapse").sideNav();
        var el = document.querySelector('.custom-scrollbar');
        Ps.initialize(el);

        new WOW().init();
        
    </script>

    <!-- ZU core JavaScript -->
    <script type="text/javascript" src="{{ asset('js/app/core.js') }}"></script>

@yield('scripts')

@yield('footer')
        
    <!-- Modal -->
    <div class="modal fade" id="modalDialogMsj" tabindex="-1" role="dialog" aria-labelledby="tituloModalDialogMsj" aria-hidden="true">
        <div class="modal-dialog modal-notify" role="document">
            <!--Content-->
            <div class="modal-content">
                <!--Header-->
                <div class="modal-header">
                    <h4 class="modal-title w-100" id="tituloModalDialogMsj">Modal title</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!--Body-->
                <div class="modal-body" id="bodyModalDialogMsj">
                    ...
                </div>
                <!--Footer-->
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="buttonModalDialogMsj">Aceptar</button>
                </div>
            </div>
            <!--/.Content-->
        </div>
    </div>
    <!-- Modal -->
</body>

</html>