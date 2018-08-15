<!DOCTYPE html>
<!--[if IE 9 ]><html class="ie9"><![endif]-->
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> {{ config('app.name', 'CointTable') }}</title>


    <link href="{{ asset('vendors/bower_components/animate.css/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/bower_components/bootstrap-sweetalert/lib/sweet-alert.css') }}" rel="stylesheet">

    <!-- Vendor CSS -->
    <link href="{{ asset('vendors/bower_components/fullcalendar/dist/fullcalendar.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/bower_components/animate.css/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/bower_components/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css') }}" rel="stylesheet">   
    <!--Selects-->
    <link href="{{ asset('vendors/bower_components/bootstrap-select/dist/css/bootstrap-select.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/bower_components/chosen/chosen.min.css') }}" rel="stylesheet">

    <!-- bootstrap datepicker 
    <link href="{{ asset('vendors/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">-->

     <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{ asset('plugins/datepicker/datepicker3.css') }}">
     
     <!--Palete Colors-->
    <link href="{{ asset('vendors/bower_components/google-material-color/dist/palette.css') }}" rel="stylesheet">

    <!-- CSS -->
    <link href="{{ asset('css/app.min.1.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.min.2.css') }}" rel="stylesheet"> 

   



    @guest
        
    @else
    
    <!--DataTables-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/material-design-lite/1.1.0/material.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdn.datatables.net/1.10.16/css/dataTables.material.min.css" rel="stylesheet" type="text/css">

    <link href="https://cdn.datatables.net/fixedheader/3.1.3/css/fixedHeader.dataTables.min.css" rel="stylesheet" type="text/css">


    <link href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.dataTables.min.css" rel="stylesheet" type="text/css">

    <link href="{{ asset('css/tables/buttons.dataTables.min.css') }}" rel="stylesheet">

    <!--Library Input Image-->
    <link href="{{ asset('css/fileinput.min.css') }}" rel="stylesheet"> 

   

    <!--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyABpVVe_0GyalUmY4SnuVktfNvSjXo2YJQ&libraries&libraries=places,geometry,drawing"></script>-->

    @endguest

</head>
@auth
<body data-ma-header="blue">
@else
<body>
@endauth

    @auth
        @include('menu.nav')
        <section id="main">
            @include('menu.menu-lateral')
            <section id="content">
                <div class="container">
                    
                    @yield('content')
                </div>
            </section>
            @include('footer.footer')
        </section>
        <!-- Page Loader -->
        <div class="page-loader  palette-blue-400 bg">
            <div class="preloader pl-xl pls-white">
                <svg class="pl-circular" viewBox="25 25 50 50">
                    <circle class="plc-path" cx="50" cy="50" r="20"/>
                </svg>
            </div>
        </div>
    @else
        <div class="login" data-lbg="blue">
            @yield('content')
        </div>
    @endauth


    <!-- Javascript Libraries -->
    <script src="{{ URL::asset('vendors/bower_components/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('vendors/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('vendors/bower_components/Waves/dist/waves.min.js') }}"></script>

    @guest
        
    @else
        <script src="{{ URL::asset('vendors/bower_components/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js') }}"></script>
        <script src="{{ URL::asset('vendors/bootstrap-growl/bootstrap-growl.min.js') }}"></script>
        <script src="{{ URL::asset('vendors/bower_components/moment/min/moment.min.js') }}"></script>
        <script src="{{ URL::asset('vendors/bower_components/fullcalendar/dist/fullcalendar.min.js') }}"></script>
        <script src="{{ URL::asset('vendors/bower_components/simpleWeather/jquery.simpleWeather.min.js') }}"></script>
        <script src="{{ URL::asset('vendors/bower_components/salvattore/dist/salvattore.min.js') }}"></script>

        <!--Selects-->
        <script src="{{ URL::asset('vendors/bower_components/bootstrap-select/dist/js/bootstrap-select.js') }}"></script>
        <script src="{{ URL::asset('vendors/bower_components/chosen/chosen.jquery.min.js') }}"></script>





       
        <script src="{{ URL::asset('vendors/bower_components/bootstrap-sweetalert/lib/sweet-alert.min.js') }}"></script>

        <script src="{{ URL::asset('vendors/bower_components/flot/jquery.flot.js') }}"></script>
        <script src="{{ URL::asset('vendors/bower_components/flot/jquery.flot.resize.js') }}"></script>
        <script src="{{ URL::asset('vendors/bower_components/flot.curvedlines/curvedLines.js') }}"></script>
        <script src="{{ URL::asset('vendors/sparklines/jquery.sparkline.min.js') }}"></script>
        <script src="{{ URL::asset('vendors/bower_components/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js') }}"></script>
        <script src="{{ URL::asset('js/flot-charts/curved-line-chart.js') }}"></script>
        <script src="{{ URL::asset('js/flot-charts/line-chart.js') }}"></script>

        <script src="{{ URL::asset('vendors/fileinput/fileinput.min.js') }}"></script>

        <script src="{{ URL::asset('vendors/input-mask/input-mask.min.js') }}"></script>

        <!-- Placeholder for IE9 -->
            <!--[if IE 9 ]>
            <script src="vendors/bower_components/jquery-placeholder/jquery.placeholder.min.js"></script>
        <![endif]-->
        <script src="{{ URL::asset('js/charts.js') }}"></script>
        <script src="{{ URL::asset('js/actions.js') }}"></script>
        <script src="{{ URL::asset('js/demo.js') }}"></script>

        <!--Table Coint data Socket-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.3/socket.io.js"></script>

        <!-- Date libreria de calendario -->
        <!-- bootstrap datepicker
             <script src="{{ asset('vendors/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script> -->
        <script src="{{ asset('plugins/datepicker/bootstrap-datepicker.js') }}"></script>




        <!--DataTables-->
        <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.16/js/dataTables.material.min.js"></script>
        <script src="https://cdn.datatables.net/plug-ins/1.10.16/sorting/currency.js"></script>
        <script src="http://cdn.datatables.net/plug-ins/1.10.16/sorting/percent.js"></script>

        <script src="https://cdn.datatables.net/fixedheader/3.1.3/js/dataTables.fixedHeader.min.js"></script>

        <script src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js"></script>

         <!--datatables export to pdf, excel, csv, print-->
        <script src="{{ URL::asset('js/tables/export/buttons.print.min.js') }}"></script>
        <script src="{{ URL::asset('js/tables/export/dataTables.buttons.min.js') }}"></script>
        <script src="{{ URL::asset('js/tables/export/buttons.flash.min.js') }}"></script>
        <script src="{{ URL::asset('js/tables/export/jszip.min.js') }}"></script>
        <script src="{{ URL::asset('js/tables/export/pdfmake.min.js') }}"></script>
        <script src="{{ URL::asset('js/tables/export/vfs_fonts.js') }}"></script>
        <script src="{{ URL::asset('js/tables/export/buttons.html5.min.js') }}"></script>
        <script src="{{ URL::asset('js/tables/export/buttons.colVis.min.js') }}"></script>
        <script src="{{ URL::asset('js/tables/export/date-de.js') }}"></script>
        <script src="{{ URL::asset('js/tables/export/datetime.js') }}"></script>
        <script src="{{ URL::asset('js/tables/export/moment-timezone-with-data.js') }}"></script>

         <!--Library Input Image-->
        <script src="{{ URL::asset('js/fileinput.min.js') }}"></script>
        <script src="{{ URL::asset('js/fileinput_locale_LANG.js') }}"></script>
        <script src="{{ URL::asset('js/fileinput_locale_es.js') }}"></script>
        <script src="{{ URL::asset('js/fileinput_locale_fr.js') }}"></script>



        <!-- Moments Para la fecha actual-->
        <script src="{{ URL::asset('js/date/moment.js') }}"></script>
        <script src="{{ URL::asset('js/date/moment-with-locales.min.js') }}"></script>


        <!-- Morris.js charts -->
        <script src="{{ URL::asset('https://www.gstatic.com/charts/loader.js') }}"></script>

        <script src="{{ URL::asset('js/chartjs/highcharts.js') }}"></script>
        <script src="{{ URL::asset('js/chartjs/series-label.js') }}"></script>
        <script src="{{ URL::asset('js/chartjs/exporting.js') }}"></script>
    @endguest

        <script src="{{ URL::asset('js/functions.js') }}"></script>

    @yield('footer')

</body>
</html>