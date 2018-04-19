@extends('masterdesign')


@section('content')
<div class="container-fluid">

      <div class="container">
      <hr>
      </div>
  <div class="row">
    <div class="col-lg-7">
     <!--#################################################DIVIDER######################################################################-->
<div id='legend' style='display:none;'>
  <img src="{{URL::asset('img/wlegends.png')}}"/>
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
        <li><a data-target="#wlchart" data-toggle="tab">Graph(WATER LEVEL)</a></li>

      </ul>

      <div class="tab-content">
        <div class="tab-pane active" id="table">
       <!--*********TABLES**************-->
       <div id="control_label" class="alert-info text-center"><h4>TABLE INFORMATION</h4></div>
        <table class="table table-bordered" id="users-table">
        <thead>
            <tr>
                <th>NAME</th>
                <th>DATE/TIME</th>
                <th>BATTERY</th>
                <th>WATER LEVEL</th>
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
</div>
<!--#################################################DIVIDER######################################################################-->
    <div class="col-lg-5" style="padding-left: 50px;">

<!--#################################################DIVIDER######################################################################-->
 <!--*********TABLES**************-->
       <div id="table_latest" class="alert-info text-center"><h4>LATEST DATA (WATER LEVEL)</h4></div>
        <table class="table table-bordered" id="latest-table">
        <thead>
            <tr class="bg-primary">
                <th>SITE NAME</th>
                <th>CREATED AT</th>
                <th>WL</th>
            </tr>
        </thead>
       </table>
        <!--*********TABLES**************-->
       <!--*********TABLES**************-->
       <div id="table_latest" class="alert-info text-center"><h4>HOURLY DATA (WATER LEVEL)</h4></div>
        <table class="table table-bordered" id="hourly-table">
        <thead>
            <tr class="bg-primary">
                <th>SITE NAME</th>
                <th>AVERAGE LEVEL<br>1 HR</th>
            </tr>
        </thead>
       </table>
        <!--*********TABLES**************-->
         <!--*********TABLES**************-->
       <div id="table_latest" class="alert-info text-center"><h4>WARNINGS</h4></div>
        <table class="table table-bordered" id="table-warning">
        <thead>
            <tr class="bg-primary">
                <th>SITE NAME</th>
                <th>ALERT</th>
                <th>ALARM</th>
                <th>CRITICAL</th>
            </tr>
        </thead>
       </table>
        <!--*********TABLES**************-->
<!--#################################################DIVIDER######################################################################-->
    </div><!--colmd4-->
  </div> <!--ROW-->
  </div>
</div>

@push('map-scripts')
<script>
var clckr;
var clusterGroup = new L.layerGroup();
L.mapbox.accessToken = 'pk.eyJ1IjoicGFnYXNhbGVnYXpwaSIsImEiOiJjaXM2M3R2eHcwY3A2Mm9sa3RicmJybXU2In0._oRLkJwo06X4W8wBXgN-ig';
var mapCluster = L.mapbox.map('map-cluster')
  .setView([17.513655, 120.671699],10)
  .addLayer(L.mapbox.tileLayer('mapbox.streets'));
     function loadmarkers(){
      var ler = '012345';
L.mapbox.featureLayer()
  .loadURL('{{URL::asset('wlmap')}}')
    .on('click', function(e) {
       //console.log(e.layer.feature.properties.description.site_id);
      clckr = e.layer.feature.properties.description.site_id;
      console.log(clckr);
        mapCluster.panTo(e.layer.getLatLng());
        calltable();
       // drawChart();
        drawWlChart();

        $('#myModal').modal('show');

       
  })
  .on('ready', function(e) {

    mapCluster.legendControl.addLegend(document.getElementById('legend').innerHTML);
    
//
   
    //var blgrndrp = new L.Icon({iconUrl: "{{URL::asset('img/marker/0119.png')}}"});
    var icnalarm = L.Icon.extend({
    options: {
        iconUrl:  "{{URL::asset('img/marker/alarm.png')}}",
        iconSize: [25,25],
        iconAnchor: [5, 20], // horizontal puis vertical
    }
    });
        var icnalert = L.Icon.extend({
    options: {
        iconUrl:  "{{URL::asset('img/marker/alert.png')}}",
        iconSize: [25,25],
        iconAnchor: [5, 20], // horizontal puis vertical
    }
    });
    var icncritical = L.Icon.extend({
    options: {
        iconUrl:  "{{URL::asset('img/marker/critical.png')}}",
        iconSize: [25,25],
        iconAnchor: [5, 20], // horizontal puis vertical
    }
    });
   var icndatadown = L.Icon.extend({
    options: {
        iconUrl:  "{{URL::asset('img/marker/datadown.png')}}",
        iconSize: [25,25],
        iconAnchor: [5, 20], // horizontal puis vertical
    }
    });
   var icndatanc = L.Icon.extend({
    options: {
        iconUrl:  "{{URL::asset('img/marker/datanc.png')}}",
        iconSize: [25,25],
        iconAnchor: [5, 20], // horizontal puis vertical
    }
    });
    var icndataup = L.Icon.extend({
    options: {
        iconUrl:  "{{URL::asset('img/marker/dataup.png')}}",
        iconSize: [25,25],
        iconAnchor: [5, 20], // horizontal puis vertical
    }
    });
   var icnodata = L.Icon.extend({
    options: {
        iconUrl:  "{{URL::asset('img/marker/nodata.png')}}",
        iconSize: [25,25],
        iconAnchor: [5, 20], // horizontal puis vertical
    }
    });
var icnormal = L.Icon.extend({
    options: {
        iconUrl:  "{{URL::asset('img/marker/normal.png')}}",
        iconSize: [25,25],
        iconAnchor: [5, 20], // horizontal puis vertical
    }
    });


    e.target.eachLayer(function(layer) {
        clusterGroup.addLayer(layer);

        var sitenm = layer.feature.properties.description.Sitename;
        var wla = parseFloat(layer.feature.properties.description.wlevel);
        var wlb =parseFloat(layer.feature.properties.description.tbm);
        var wlc =parseFloat(layer.feature.properties.description.ylevel);


        var wl  = (wlb-wlc)+wla;
        if(sitenm=="DOLORES"){
          console.log("dolores WL:"+ sitenm);
          if((wl >= parseFloat(layer.feature.properties.description.wlalarm))&&(wl <= parseFloat(layer.feature.properties.description.wlcritical))){
        layer.setIcon(new icnalarm);

        }
         else if((wl >= parseFloat(layer.feature.properties.description.wlalert))&&(wl <= layer.feature.properties.description.wlalarm)){

        layer.setIcon(new icnalert);

        }
        else if(wl >= parseFloat(layer.feature.properties.description.wlcritical)){
        layer.setIcon(new icncritical);

        }    
        else if(wl < parseFloat(layer.feature.properties.description.wlalarm)){
        layer.setIcon(new icnormal);

        }

        }
        if(sitenm=="LA PAZ"){
          console.log("la paz WL:"+ sitenm);
          if((wl >= parseFloat(layer.feature.properties.description.wlalarm))&&(wl <= parseFloat(layer.feature.properties.description.wlcritical))){
        layer.setIcon(new icnalarm);

        }
         else if((wl >= parseFloat(layer.feature.properties.description.wlalert))&&(wl <= layer.feature.properties.description.wlalarm)){

        layer.setIcon(new icnalert);

        }
        else if(wl >= parseFloat(layer.feature.properties.description.wlcritical)){
        layer.setIcon(new icncritical);

        }    
        else if(wl < parseFloat(layer.feature.properties.description.wlalarm)){
        layer.setIcon(new icnormal);

        }
          
        }
        if(sitenm=="VIGAN"){
          console.log("vigan WL:"+ sitenm);
          if((wl >= parseFloat(layer.feature.properties.description.wlalarm))&&(wl <= parseFloat(layer.feature.properties.description.wlcritical))){
        layer.setIcon(new icnalarm);

        }
         else if((wl >= parseFloat(layer.feature.properties.description.wlalert))&&(wl <= layer.feature.properties.description.wlalarm)){

        layer.setIcon(new icnalert);

        }
        else if(wl >= parseFloat(layer.feature.properties.description.wlcritical)){
        layer.setIcon(new icncritical);

        }    
        else if(wl < parseFloat(layer.feature.properties.description.wlalarm)){
        layer.setIcon(new icnormal);

        }
        }
        if(sitenm=="BANTAY"){
          console.log("bantay WL:"+ sitenm);
          if((wl >= parseFloat(layer.feature.properties.description.wlalarm))&&(wl <= parseFloat(layer.feature.properties.description.wlcritical))){
        layer.setIcon(new icnalarm);

        }
         else if((wl >= parseFloat(layer.feature.properties.description.wlalert))&&(wl <= layer.feature.properties.description.wlalarm)){

        layer.setIcon(new icnalert);

        }
        else if(wl >= parseFloat(layer.feature.properties.description.wlcritical)){
        layer.setIcon(new icncritical);

        }    
        else if(wl < parseFloat(layer.feature.properties.description.wlalarm)){
        layer.setIcon(new icnormal);

        }  
        }
        if(sitenm=="QUIRINO(B)"){
          console.log("quirinob WL:"+ sitenm);
          if((wl >= parseFloat(layer.feature.properties.description.wlalarm))&&(wl <= parseFloat(layer.feature.properties.description.wlcritical))){
        layer.setIcon(new icnalarm);

        }
         else if((wl >= parseFloat(layer.feature.properties.description.wlalert))&&(wl <= layer.feature.properties.description.wlalarm)){

        layer.setIcon(new icnalert);

        }
        else if(wl >= parseFloat(layer.feature.properties.description.wlcritical)){
        layer.setIcon(new icncritical);

        }    
        else if(wl < parseFloat(layer.feature.properties.description.wlalarm)){
        layer.setIcon(new icnormal);

        }
        }
       /* if(rf <= 0){
        layer.setIcon(new grydrp);

        }
         else if((rf >= 0.1)&&(rf <= 1.9)){
        layer.setIcon(new blgrndrp);

        }
        else if((rf >= 2.0)&&(rf <= 9.9)){
        layer.setIcon(new skbldrp);

        }    
        else if((rf >= 10.0)&&(rf <= 19.9)){
        layer.setIcon(new bldrp);

        }       
        else if((rf >= 20.0)&&(rf <= 29.9)){
        layer.setIcon(new vltdrp);

        }      
        else if((rf >= 30.0)&&(rf <= 39.9)){
        layer.setIcon(new ylwdrp);

        } 
        else if((rf >= 40.0)&&(rf <= 49.9)){
        layer.setIcon(new orngdrp);

        }
        else if(rf >= 50.0){
        layer.setIcon(new rddrp);

        }*/


        layer.bindTooltip(layer.feature.properties.description.Sitename,{ direction:'left', permanent: true, opacity : 0.6, offset : L.point(10,10), className: 'myCSSClass' });
        layer.bindPopup("<h1>"+layer.feature.properties.description.Sitename+ "</h1><h2><small> Rainfall: "+layer.feature.properties.description.rainfall+"</small></h2><h2><small> As Of: "+layer.feature.properties.description.asof+"</small></h2>");
  });
  $.getJSON("{{URL::asset('geojson/abrafews.geojson')}}", function(data) { 
  
 // dataLayer
  //addDataToMap(data, mapCluster); 
  var dataLayer ="";
  dataLayer = L.geoJson(data);
  dataLayer.setStyle({color: "#FF5500"})
  dataLayer.addTo(clusterGroup);
  });

  mapCluster.addLayer(clusterGroup);

});
}//loadmarkers
loadmarkers();
drawlatestable();
warningtable();
setInterval(function(){
    clusterGroup.clearLayers();
    console.log("refreshing data");
    loadmarkers();
     $('#latest-table').DataTable().destroy();
     $('#hourly-table').DataTable().destroy();
    drawlatestable();
    drawhourlytable();
  }, 60000);

function calltable(){

    $('#users-table').DataTable({
        destroy: true,
        processing: true,
        serverSide: true,
        ajax: '{{URL::asset('wldata')}}'+"/"+clckr,
        columns: [
            { data: 'name', name: 'name' },
            { data: 'created_at', name: 'date/time' },
            { data: 'batteryvolt', name: 'batteryvolt' },
            { data: 'wlevel', name: 'wlevel' }
        ],
         order: [ [0, 'desc'] ],
        dom: 'Bfrtip',
        buttons: [
             'copy', 'excel', 'pdf', 'print'
        ]
    });
}
function warningtable(){
    $('#table-warning').DataTable({
        destroy: true,
        processing: true,
        serverSide: true,
        searching: false,
        bSort : false,
        paging: false,
        ajax: '{{URL::asset('editalerts')}}',
        columns: [
            { data: 'name', name: 'name' },
            { data: 'wlalert', name: 'wlalert' },
             { data: 'wlalarm', name: 'wlalarm' },
              { data: 'wlcritical', name: 'wlcritical' }
        ]
    });
}
function drawhourlytable(){

    $('#hourly-table').DataTable({
        destroy: true,
        processing: true,
        serverSide: true,
        searching: false,
        bSort : false,
        paging: false,
        ajax: '{{URL::asset('wlhourlydata')}}',
        columns: [
            { data: 'name', name: 'name' },
            { data: 'water', name: 'water' }
        ]
    });
}
function drawlatestable(){

    $('#latest-table').DataTable({
          bSort : false, //disable datatable sorting so it is sorted by wltbm
         searching: false,
         paging: false,
        "ajax": "{{URL::asset('wllatestdata')}}",
        "columns": [
            { "data": 'Site', "name": 'Site' },
            { "data": 'asof', "name": 'asof' },
            { "data": 'water', "name": 'water' },


       ],        
    });
}
//google.load('visualization', '1', {packages: ['controls', 'charteditor']});
google.charts.load('current', {'packages':['corechart', 'controls']});
//google.setOnLoadCallback(drawChart);

/*function drawChart() {
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
}*/
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
@endpush

@stop