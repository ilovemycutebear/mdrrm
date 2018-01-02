<!DOCTYPE html>
<html>
<head>
  <meta charset=utf-8 />
  <title></title>
  <script src='https://api.mapbox.com/mapbox.js/v2.4.0/mapbox.js'></script>
  <link href='https://api.mapbox.com/mapbox.js/v2.4.0/mapbox.css' rel='stylesheet' />
  <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
  <style>
    body { margin:0; padding:0; }
    .map { position:absolute; top:0; bottom:0; width:100%; }
  </style>
</head>
<body>
<style>
.legend label,
.legend span {
  display:block;
  float:left;
  height:15px;
  width:20%;
  text-align:center;
  font-size:9px;
  color:#808080;
  }
.modalcontainer {
    overflow-y: auto;
    max-height: 600px;
    width: 800px;
    margin-left: -400px;
    padding: 15px;
}
</style>
<script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-markercluster/v0.4.0/leaflet.markercluster.js'></script>
<link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-markercluster/v0.4.0/MarkerCluster.css' rel='stylesheet' />
<link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-markercluster/v0.4.0/MarkerCluster.Default.css' rel='stylesheet' />
<div id='legend' style='display:none;'>
  <img src="{{URL::asset('img/legendary.png')}}"/>
</div>
<div id='map-cluster' class='map'></div>
<div id="modalcontainer">
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content" >
        <div class="modal-body">
        <!--*********TABS**************-->
        <ul class="nav nav-tabs" id="myTab">
        <li class="active"><a data-target="#table" data-toggle="tab">Table</a></li>
        <li><a data-target="#chart" data-toggle="tab">Graph(RAIN)</a></li>
        <li><a data-target="#wlchart" data-toggle="tab">Graph(WATER LEVEL)</a></li>

      </ul>

      <div class="tab-content">
        <div class="tab-pane active" id="table">
       <!--*********TABLES**************-->
       <div id="control_label" class="alert-info text-center"><h4>TABLE INFORMATION</h4></div>
        <table class="table table-bordered" id="users-table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Date/Time</th>
                <th>Rain</th>
            </tr>
        </thead>
       </table>
        <!--*********TABLES**************-->
        </div>
        <div class="tab-pane" id="chart">
         <div id="control_label" class="alert-info text-center"><h4>HISTORICAL GRAPH</h4></div>
        <!--*********CHARTS**************-->
        <table class="table table-bordered" id="users-table">
        <tr>
         <div id="chart_div"></div>
         <div id="control_label" class="alert-info">DATE RANGE FILTER</div>
       <div id="control_div"></div>
        <div id='dbgchart' class="alert-info text-center"></div>
        </tr>
        </table>
        <!--*********CHARTS**************-->

        </div>
         <!--*********WLCHARTS**************-->
                <div class="tab-pane" id="wlchart">
         <div id="control_label" class="alert-info text-center"><h4>HISTORICAL GRAPH</h4></div>
        <!--*********WLCHARTS**************-->
        <table class="table table-bordered" id="users-table">
        <tr>
         <div id="wlchart_div"></div>
         <div id="control_label" class="alert-info">DATE RANGE FILTER</div>
       <div id="wlcontrol_div"></div>
        <div id='dbgwlchart' class="alert-info text-center"></div>
        </tr>
        </table>
        <!--*********WLCHARTS**************-->

        </div>
      </div>
<!--*********TABS**************-->
      </div>
        </div>
      
    </div>
  </div>
</div>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script>
var clckr;
L.mapbox.accessToken = 'pk.eyJ1IjoicGFnYXNhbGVnYXpwaSIsImEiOiJjaXM2M3R2eHcwY3A2Mm9sa3RicmJybXU2In0._oRLkJwo06X4W8wBXgN-ig';
var mapCluster = L.mapbox.map('map-cluster')
  .setView([17.513655, 120.671699],9)
  .addLayer(L.mapbox.tileLayer('mapbox.streets'));
     function loadmarkers(){
      var ler = '012345';
L.mapbox.featureLayer()
  .loadURL('{{URL::asset('map')}}')
    .on('click', function(e) {
       //console.log(e.layer.feature.properties.description.site_id);
      clckr = e.layer.feature.properties.description.site_id;
      console.log(clckr);
        mapCluster.panTo(e.layer.getLatLng());
        calltable();
        drawChart();
        drawWlChart();
        $('#myModal').modal('show');

       
  })
  .on('ready', function(e) {


    mapCluster.legendControl.addLegend(document.getElementById('legend').innerHTML);
    
//
    var clusterGroup = new L.layerGroup();



    e.target.eachLayer(function(layer) {
        clusterGroup.addLayer(layer);

        var rf = parseFloat(layer.feature.properties.description.rainfall);
         if(rf < 2.5){
        layer.setIcon(L.mapbox.marker.icon({'marker-symbol': 'water', 'marker-color': 'c0e8e8'}));

        }
        else if((rf <= 7.5)&&(rf > 2.4)){
        layer.setIcon(L.mapbox.marker.icon({'marker-symbol': 'water', 'marker-color': '3535ff'}));

        }    
        else if((rf <= 15)&&(rf > 7.5)){
        layer.setIcon(L.mapbox.marker.icon({'marker-symbol': 'water', 'marker-color': '09099d'}));

        }       
        else if((rf <= 30)&&(rf > 15)){
        layer.setIcon(L.mapbox.marker.icon({'marker-symbol': 'water', 'marker-color': 'ff822f'}));

        }      
        else if(rf > 30){
        layer.setIcon(L.mapbox.marker.icon({'marker-symbol': 'water', 'marker-color': 'ff3131'}));

        } 
        else if(rf == 999){
        layer.setIcon(L.mapbox.marker.icon({'marker-symbol': 'cross', 'marker-color': 'c0e8e8'}));

        }


        layer.bindPopup("<h1>"+layer.feature.properties.description.Sitename+ "</h1><h2><small> Rainfall: "+layer.feature.properties.description.rainfall+"</small></h2><h2><small> As Of: "+layer.feature.properties.description.asof+"</small></h2>");
  });
 
  mapCluster.addLayer(clusterGroup);

  function addDataToMap(data, mapCluster) {
    var dataLayer = L.geoJson(data);
    dataLayer.setStyle({color: "#FF5500"})
    dataLayer.addTo(mapCluster);
}

$.getJSON("{{URL::asset('geojson/abrafews.geojson')}}", function(data) { addDataToMap(data, mapCluster); });

});
mapCluster.scrollWheelZoom.disable();
}
  window.onload = function(){
setInterval(function(){
   // console.log("refreshed");
  loadmarkers();
  //console.log('nyah');
      }, 600000);// setinterval
}
loadmarkers();

function calltable(){

    $('#users-table').DataTable({
        destroy: true,
        processing: true,
        serverSide: true,
        ajax: '{{URL::asset('data')}}'+"/"+clckr,
        columns: [
            { data: 'site_id', name: 'site_id' },
            { data: 'name', name: 'name' },
            { data: 'datetime_10mins', name: 'datetime_10mins' },
            { data: 'rain10', name: 'rain10' }
        ]
    });
}
//google.load('visualization', '1', {packages: ['controls', 'charteditor']});
google.charts.load('current', {'packages':['corechart', 'controls']});
//google.setOnLoadCallback(drawChart);

function drawChart() {
  var jsonData = $.ajax({
          url:  '{{URL::asset('laracharts')}}'+"/"+clckr,
          dataType: "json",
          async: false
          }).responseText;
    var data = new google.visualization.DataTable(jsonData);   
    var dash = new google.visualization.Dashboard(document.getElementById('dashboard'));
    var control = new google.visualization.ControlWrapper({
        controlType: 'ChartRangeFilter',
        containerId: 'control_div',
        options: {
            filterColumnIndex: 0,
            ui: {
                chartOptions: {
                  colors: ['#0b7701'],
                    height: 50,
                    width: 550
                }
            },
          
        }
      
        
    });
    var chart = new google.visualization.ChartWrapper({
        chartType: 'AreaChart',
        containerId: 'chart_div',
           options: {
            filterColumnIndex: 0,
            legend: { position: 'bottom' },
            ui: {
                chartOptions: {
                      height: 50,
                    width: 550,
                    chartArea: {
                        width: '80%'
                    }
                }
            },
            colors: ['#0b7701'] 
        }
    }); 
    dash.bind([control], [chart]);
    dash.draw(data);
    google.visualization.events.addListener(control, 'statechange', function () {
        var v = control.getState();
        document.getElementById('dbgchart').innerHTML = '<b>START: </b>'+v.range.start+ '<br /><b>END: </b> ' +v.range.end;
        return 0;
    });
}
function drawWlChart() {
  var jsonData = $.ajax({
          url:  '{{URL::asset('wlaracharts')}}'+"/"+clckr,
          dataType: "json",
          async: false
          }).responseText;
    var data = new google.visualization.DataTable(jsonData);   
    var dash = new google.visualization.Dashboard(document.getElementById('dashboard'));
    var control = new google.visualization.ControlWrapper({
        controlType: 'ChartRangeFilter',
        containerId: 'wlcontrol_div',
        options: {
            filterColumnIndex: 0,
            ui: {
                chartOptions: {
                   colors: ['#42b6f4'],
                    height: 50,
                    width: 550
                }
            },
         
        },
 
        
    });
    var chart = new google.visualization.ChartWrapper({
        chartType: 'AreaChart',
        containerId: 'wlchart_div',
           options: {
            filterColumnIndex: 0,
            legend: { position: 'bottom' },
            ui: {
                chartOptions: {
                      height: 50,
                    width: 550,
                    chartArea: {
                        width: '80%'
                    }
                }
            },
            colors: ['#42b6f4']
        }
    }); 
    dash.bind([control], [chart]);
    dash.draw(data);
    google.visualization.events.addListener(control, 'statechange', function () {
        var v = control.getState();
        document.getElementById('dbgwlchart').innerHTML = '<b>START: </b>'+v.range.start+ '<br /><b>END: </b> ' +v.range.end;
        return 0;
    });
}
</script>

<script src="//code.jquery.com/jquery.js"></script>
        <!-- DataTables -->
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
        <!-- Bootstrap JavaScript -->
 <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</body>
</html>