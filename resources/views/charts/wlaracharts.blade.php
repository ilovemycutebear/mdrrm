<html>
  <head>
    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
google.load('visualization', '1', {packages: ['controls', 'charteditor']});
google.setOnLoadCallback(drawChart);

function drawChart() {
	var jsonData = $.ajax({
          url:  "{{URL::asset('wlaracharts/'.$tabid->id) }}",
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
                    height: 50,
                    width: 600,
                    chartArea: {
                        width: '80%'
                    }
                }
            }
        }
    });

    var chart = new google.visualization.ChartWrapper({
        chartType: 'LineChart',
        containerId: 'chart_div'
    });

    function setOptions (wrapper) {
       
        wrapper.setOption('width', 620);
        wrapper.setOption('chartArea.width', '80%');
      
    }
    
    setOptions(chart);
   
    
    dash.bind([control], [chart]);
    dash.draw(data);
  	google.visualization.events.addListener(control, 'statechange', function () {
        var v = control.getState();
        document.getElementById('dbgchart').innerHTML = v.range.start+ ' to ' +v.range.end;
        return 0;
    });
}
</script>
</head>
<div id="dashboard">
    <div id="chart_div"></div>
    <div id="control_div"></div>
<p><span id='dbgchart'></span></p>
</div>
  </body>
</html>