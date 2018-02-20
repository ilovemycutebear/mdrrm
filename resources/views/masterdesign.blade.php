<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>FEWS</title>
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="//cdn.datatables.net/1.10.8/css/jquery.dataTables.min.css">
  <link href='https://api.mapbox.com/mapbox.js/v3.1.1/mapbox.css' rel='stylesheet' />
  <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
  <link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-markercluster/v1.0.0/MarkerCluster.css' rel='stylesheet' />
<link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-markercluster/v1.0.0/MarkerCluster.Default.css' rel='stylesheet' />


<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.1.2/css/buttons.dataTables.min.css"/> 
<link rel="stylesheet" href="https://cdn.datatables.net/select/1.1.2/css/select.dataTables.min.css"/>
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.0.2/css/responsive.dataTables.min.css"/>


    <style type="text/css">
        body{
    height: 100%;
    padding-top: 40px;
    background-image: url("{{URL::asset('img/background.jpg')}}");
    background-repeat: no-repeat;
    background-size: cover;
}  
  .myCSSClass {
  background:rgba(89, 89, 89, 0.33);
  color: white;
}
.map { position:absolute; top:0; bottom:0; width:100%; height: 700px; }
.color_table{
    color: white !important;
    background-color: #eeeeee !important;
}
    </style>
</head>
<body>
      <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand">PAGASA FEWS</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="{{ Request::is('/') ? 'active' : '' }}">
                <a href="{{ url('/') }}">HOME</a>
            </li>
            <li class="{{ Request::is('rainmapview') ? 'active' : '' }}">
                <a href="{{ url('rainmapview') }}">RAIN</a>
            </li>
            <li class="{{ Request::is('wlevelmapview') ? 'active' : '' }}">
                <a href="{{ url('wlevelmapview') }}">WATER LEVEL</a>
            </li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
             <li class="{{ Request::is('/') ? 'active' : '' }}">
                <a href="{{ url('about') }}">CONTACT US</a>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
            @yield('content')


        <!-- jQuery -->

        <script src="//code.jquery.com/jquery.js"></script>
        <!-- DataTables -->
        <script src="//cdn.datatables.net/1.10.8/js/jquery.dataTables.min.js"></script>
        <!-- Bootstrap JavaScript -->
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript" src="https://www.google.com/jsapi"></script>
        <script src='https://api.mapbox.com/mapbox.js/v3.1.1/mapbox.js'></script>
        <script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-markercluster/v1.0.0/leaflet.markercluster.js'></script>

        <script src="https://cdn.datatables.net/buttons/1.1.2/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/select/1.1.2/js/dataTables.select.min.js"></script> 
        <script src="https://cdn.datatables.net/responsive/2.0.2/js/dataTables.responsive.min.js"></script>
        <!--script src="{{URL::asset('js/dataTables.altEditor.free.js')}}"></script-->
        <!-- App scripts -->

        @stack('map-scripts')

    </body>

</html>
