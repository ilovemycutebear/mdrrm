@extends('masterdesign')


@section('content')
<div class="container-fluid">
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
                <th>VALUE</th>
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
  <!--#################################################DIVIDER######################################################################-->
    <div class="col-xs-6">

<!--#################################################DIVIDER######################################################################-->
 <!--*********TABLES**************-->
       <div id="table_latest" class="alert-info text-center"><h4>RAIN</h4></div>
        <table class="table table-bordered" id="latest-tablern">
        <thead>
            <tr class="bg-primary">
                <th>SITE NAME</th>
                <th>ID</th>
            </tr>
        </thead>
       </table>
        <!--*********TABLES**************-->
       
<!--#################################################DIVIDER######################################################################-->
    </div><!--colmd4-->
<!--#################################################DIVIDER######################################################################-->
    <div class="col-xs-6">

<!--#################################################DIVIDER######################################################################-->
 <!--*********TABLES**************-->
       <div id="table_latest" class="alert-info text-center"><h4>WATER LEVEL</h4></div>
        <table class="table table-bordered" id="latest-tablewl">
        <thead>
            <tr class="bg-primary">
                <th>SITE NAME</th>
                <th> ID </th>
            </tr>
        </thead>
       </table>
<!--#################################################DIVIDER######################################################################-->
    </div><!--colmd4-->
</div>

@push('map-scripts')
<script>

    $( document ).ready(function() {
    drawlatestablern();
    drawlatestablewl();

   

});


var clckr = 0;
function drawlatestablern(){

   rnTable = $('#latest-tablern').DataTable({
        ordering: false, //remove ordering button
        bInfo : false, //remove showing entries
          bSort : false, //disable datatable sorting so it is sorted by wltbm
         searching: false,
         paging: false,
        "ajax": "{{URL::asset('dttbldetails')}}",
        "columns": [
            { "data": 'Site', "name": 'Site' },
             { "data": 'site_id', "name": 'site_id' },
       ],        
    });
    $('#latest-tablern tbody').on('click', 'tr', function () {

    var data = rnTable.row( this ).data();
    clckr = data.site_id;
    console.log(clckr);
    google.charts.load("visualization", "1", {packages:["corechart","controls"]}); //remove charts for jsapi CDN
    google.charts.setOnLoadCallback(drawrnChart); //remove charts for jsapi CDN
    RNcalltable();
    $('#myModal').modal('show');
} );

}
function drawlatestablewl(){

   wlTable = $('#latest-tablewl').DataTable({
        ordering: false, //remove ordering button
        bInfo : false, //remove showing entries
          bSort : false, //disable datatable sorting so it is sorted by wltbm
         searching: false,
         paging: false,
        "ajax": "{{URL::asset('dttbldetailsrn')}}",
        "columns": [
            { "data": 'Site', "name": 'Site' },
             { "data": 'site_id', "name": 'site_id' },
       ],        
    });
    $('#latest-tablewl tbody').on('click', 'tr', function () {

    var data = wlTable.row( this ).data();
    clckr = data.site_id;
    console.log(clckr);
    google.charts.load("visualization", "1", {packages:["corechart","controls"]}); //remove charts for jsapi CDN
    google.charts.setOnLoadCallback(drawWlChart); //remove charts for jsapi CDN
    WLcalltable();
    $('#myModal').modal('show');
} );

}
function WLcalltable(){
    console.log ('{{URL::asset('wldata')}}'+"/"+clckr);
    $('#users-table').DataTable({
        destroy: true,
        ajax: '{{URL::asset('wldata')}}'+"/"+clckr,
        columns: [
            { data: 'name', name: 'name' },
            { data: 'created_at', name: 'created_at' },
            { data: 'batteryvolt', name: 'batteryvolt' , orderable: false},
            { data: 'wlevel', name: 'wlevel' }
        ], 
        dom: 'Bfrtip',
        buttons: [
             'copy', 'excel', 'pdf', 'print'
        ]
    });
}
function RNcalltable(){
    console.log ('{{URL::asset('data')}}'+"/"+clckr);
    $('#users-table').DataTable({
        destroy: true,
        ajax: '{{URL::asset('data')}}'+"/"+clckr,
        columns: [
            { data: 'name', name: 'name' },
            { data: 'created_at', name: 'created_at' },
            { data: 'batteryvolt', name: 'batteryvolt' , orderable: false},
            { data: 'wlevel', name: 'wlevel' }
        ], 
        dom: 'Bfrtip',
        buttons: [
             'copy', 'excel', 'pdf', 'print'
        ]
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
 // clear clicker
}
function drawrnChart() {
  var jsonData = $.ajax({
          url:  '{{URL::asset('laracharts')}}'+"/"+clckr,
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
 // clear clicker
}
//google.load('visualization', '1', {packages: ['controls', 'charteditor']});

</script>
@endpush
@stop