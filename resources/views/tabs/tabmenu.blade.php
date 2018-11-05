
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Case</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
</head>
<body>

 <div class="container">
  <h2></h2>
            <ul class="nav nav-tabs" id="myTab">
        <li class="active"><a data-target="#table" data-toggle="tab">Table</a></li>
        <li><a data-target="#chart" data-toggle="tab">Chart</a></li>

      </ul>

      <div class="tab-content">
        <div class="tab-pane active" id="table">
        Table
        @include('datatables.index',compact('tabid'))
        </div>
        <div class="tab-pane" id="chart">
        Chart
         @include('charts.laracharts',compact('tabid'))
        </div>
      </div>
</div>


<script>
      jQuery(function () {
    jQuery('#myTab a:last').tab('show')
})
</script>
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
        @stack('scripts')
</body>
</html>

