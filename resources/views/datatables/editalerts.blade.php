@extends('masterdesign')


@section('content')
<!--**************************************MODAL********************************************-->
<div id="modalcontainer">
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content" >
        <div class="modal-body">
        <!--*********TABS**************-->
        <ul class="nav nav-tabs" id="myTab">
               <div id="table_latest" class="alert-success text-center"><h4>EDIT INFORMATION</h4></div>

      </ul>
      <form method= "POST" action= "editinfo/update">
      {{ csrf_field() }}
      <div class='form-group'>
      <div class='col-sm-3 col-md-3 col-lg-3 text-right' style='padding-top:7px;'>
      <label for='ID'>ID</label>
      </div>
      <div class='col-sm-9 col-md-9 col-lg-9 plchldrnamei'>
      
      </div>
      <div style='clear:both;'> 
      </div>
      </div>

      <div class='form-group'>
      <div class='col-sm-3 col-md-3 col-lg-3 text-right' style='padding-top:7px;'>
      <label for='SITENAME'>SITENAME</label>
      </div>
      <div class='col-sm-9 col-md-9 col-lg-9 plchldrname'>
      
      </div>
      <div style='clear:both;'> 
      </div>
      </div>

            <div class='form-group'>
      <div class='col-sm-3 col-md-3 col-lg-3 text-right' style='padding-top:7px;'>
      <label for='LAT'>LAT</label>
      </div>
      <div class='col-sm-9 col-md-9 col-lg-9 plchldrnameb'>
      
      </div>
      <div style='clear:both;'> 
      </div>
      </div>

            <div class='form-group'>
      <div class='col-sm-3 col-md-3 col-lg-3 text-right' style='padding-top:7px;'>
      <label for='LONG'>LONG</label>
      </div>
      <div class='col-sm-9 col-md-9 col-lg-9 plchldrnamec'>
      
      </div>
      <div style='clear:both;'> 
      </div>
      </div>

            <div class='form-group'>
      <div class='col-sm-3 col-md-3 col-lg-3 text-right' style='padding-top:7px;'>
      <label for='ALERT'>ALERT</label>
      </div>
      <div class='col-sm-9 col-md-9 col-lg-9 plchldrnamed'>
      
      </div>
      <div style='clear:both;'> 
      </div>
      </div>

            <div class='form-group'>
      <div class='col-sm-3 col-md-3 col-lg-3 text-right' style='padding-top:7px;'>
      <label for='ALARM'>ALARM</label>
      </div>
      <div class='col-sm-9 col-md-9 col-lg-9 plchldrnamee'>
      
      </div>
      <div style='clear:both;'> 
      </div>
      </div>

            <div class='form-group'>
      <div class='col-sm-3 col-md-3 col-lg-3 text-right' style='padding-top:7px;'>
      <label for='CRITICAL'>CRITICAL</label>
      </div>
      <div class='col-sm-9 col-md-9 col-lg-9 plchldrnamef'>
      
      </div>
      <div style='clear:both;'> 
      </div>
      </div>

            <div class='form-group'>
      <div class='col-sm-3 col-md-3 col-lg-3 text-right' style='padding-top:7px;'>
      <label for='TBM'>TBM</label>
      </div>
      <div class='col-sm-9 col-md-9 col-lg-9 plchldrnameg'>
      
      </div>
      <div style='clear:both;'> 
      </div>
      </div>

            <div class='form-group'>
      <div class='col-sm-3 col-md-3 col-lg-3 text-right' style='padding-top:7px;'>
      <label for='Y'>Y</label>
      </div>
      <div class='col-sm-9 col-md-9 col-lg-9 plchldrnameh'>
      
      </div>
      <div style='clear:both;'> 
      </div>
      </div>

    
<!--*********TABS**************-->
   

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save Changes</button>
      </div>
      </form>
        </div>
      </div>
    </div>

  </div>
</div>
<!--**************************************MODAL********************************************-->
 <!--*********TABLES**************-->
       <div id="table_latest" class="alert-info text-center"><h4>SITE INFORMATION</h4></div>
        <table class="table table-bordered" id="inform-table">
       </table>
        <!--*********TABLES**************-->
@push('map-scripts')
<script>
$( document ).ready(function() {
    drawlatestable();
});
function drawlatestable(){
   var table = $('#inform-table').DataTable({
        processing: true,
         searching: false,
         paging: false,
        "ajax": "{{URL::asset('editalerts')}}",
        "columns": [
            { "data": 'id', "id": 'id', "title":'ID' },
            { "data": 'name', "name": 'name', "title":'SITE NAME' },
            { "data": 'sitelat', "name": 'lat', "title":'LAT' },
            { "data": 'sitelong', "name": 'long' ,"title":'LONG' },
             { "data": 'wlalert', "name": 'alert', "title":'ALERT' },
            { "data": 'wlalarm', "name": 'alarm', "title":'ALARM' },
           { "data": 'wlcritical', "name": 'critical', "title":'CRITICAL' },
           { "data": 'wltbm', "name": 'tbm', "title":'TBM' },
           { "data": 'wly', "name": 'ylevel', "title":'Y' }
        ],
    "dom": 'Bfrtip',        // element order: NEEDS BUTTON CONTAINER (B) ****
    "select": 'single',     // enable single row selection
    "responsive": true,     // enable responsiveness
    "altEditor": true,      // Enable altEditor ****
    buttons: [
    {
      extend: 'selected', // Bind to Selected row
      text: 'Edit',
      name: 'edit',        // DO NOT change name
       action: function () {
                    var count = table.rows( { selected: true } ).data();
                     console.log(count[0]);
                        var data = "";
                         var datab = "";
                          var datac = "";
                           var datad = "";
                            var datae = "";
                             var dataf = "";
                              var datag = "";
                               var datah = "";
                               var datai = "";
                         

                    $('#myModal').modal('show');
                    $('#myModal').on('shown.bs.modal', function () {
                      datai = "<input type='text'  id='" + count[0].id + "' name='siteid' placeholder='...' style='overflow:hidden'  class='form-control  form-control-sm' value='" + count[0].id + "'>";
                        data = "<input type='text'  id='" + count[0].name + "' name='sitename' placeholder='...' style='overflow:hidden'  class='form-control  form-control-sm' value='" + count[0].name + "'>";
                         datab = "<input type='text'  id='" + count[0].sitelat + "' name='sitelat' placeholder='...' style='overflow:hidden'  class='form-control  form-control-sm' value='" + count[0].sitelat + "'>";
                         datac = "<input type='text'  id='" + count[0].sitelong + "' name='sitelong' placeholder='...' style='overflow:hidden'  class='form-control  form-control-sm' value='" + count[0].sitelong + "'>";
                         datad = "<input type='text'  id='" + count[0].wlalert + "' name='wlalert' placeholder='...' style='overflow:hidden'  class='form-control  form-control-sm' value='" + count[0].wlalert + "'>";
                         datae = "<input type='text'  id='" + count[0].wlalarm + "' name='wlalarm' placeholder='...' style='overflow:hidden'  class='form-control  form-control-sm' value='" + count[0].wlalarm + "'>";
                         dataf = "<input type='text'  id='" + count[0].wlcritical + "' name='wlcritical' placeholder='...' style='overflow:hidden'  class='form-control  form-control-sm' value='" + count[0].wlcritical + "'>";
                         datag = "<input type='text'  id='" + count[0].wltbm + "' name='wltbm' placeholder='...' style='overflow:hidden'  class='form-control  form-control-sm' value='" + count[0].wltbm + "'>";
                         datah = "<input type='text'  id='" + count[0].wly + "' name='wly' placeholder='...' style='overflow:hidden'  class='form-control  form-control-sm' value='" + count[0].wly + "'>";
                     $( ".plchldrnamei" ).html(datai);
                    $( ".plchldrname" ).html(data);
                    $( ".plchldrnameb" ).html(datab);
                    $( ".plchldrnamec" ).html(datac);
                    $( ".plchldrnamed" ).html(datad);
                    $( ".plchldrnamee" ).html(datae);
                    $( ".plchldrnamef" ).html(dataf);
                    $( ".plchldrnameg" ).html(datag);
                    $( ".plchldrnameh" ).html(datah);
                    });

                    $('#myModal').on('hidden.bs.modal', function () {
                    $( ".plchldrname" ).empty();
                    $( ".plchldrnameb" ).empty();
                    $( ".plchldrnamec" ).empty();
                    $( ".plchldrnamed" ).empty();
                    $( ".plchldrnamee" ).empty();
                    $( ".plchldrnamef" ).empty();
                    $( ".plchldrnameg" ).empty();
                    $( ".plchldrnameh" ).empty();
                    $( ".plchldrnamei" ).empty();

                            });

                }// action: function
    }]
    });
}
    
</script>
@endpush

@stop