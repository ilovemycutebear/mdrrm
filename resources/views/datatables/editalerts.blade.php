@extends('masterdesign')


@section('content')

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
            { "data": 'name', "name": 'name', "title":'SITE NAME' },
            { "data": 'sitelat', "name": 'lat', "title":'LAT' },
            { "data": 'sitelong', "name": 'long' ,"title":'LONG' },
             { "data": 'wlalert', "name": 'alert', "title":'ALERT' },
            { "data": 'wlalarm', "name": 'alarm', "title":'ALARM' },
           { "data": 'wlcritical', "name": 'critical', "title":'CRITICAL' }
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
                    var data = "";

          data += "<form name='altEditor-form' role='form'>";

          /*for (var j in columnDefs) {
            data += "<div class='form-group'><div class='col-sm-3 col-md-3 col-lg-3 text-right' style='padding-top:7px;'><label for='" + columnDefs[j].title + "'>" + columnDefs[j].title + ":</label></div><div class='col-sm-9 col-md-9 col-lg-9'><input type='text'  id='" + columnDefs[j].title + "' name='" + columnDefs[j].title + "' placeholder='" + columnDefs[j].title + "' style='overflow:hidden'  class='form-control  form-control-sm' value='" + adata.data()[0][j] + "'></div><div style='clear:both;'></div></div>";
            
          }*/
          data += "</form>";


          $('#altEditor-modal').on('show.bs.modal', function() {
            $('#altEditor-modal').find('.modal-title').html('Edit Record');
            $('#altEditor-modal').find('.modal-body').html('<pre>' + data + '</pre>');
            $('#altEditor-modal').find('.modal-footer').html("<button type='button' data-content='remove' class='btn btn-default' data-dismiss='modal'>Close</button>\
               <button type='button' data-content='remove' class='btn btn-primary' id='editRowBtn'>Save Changes</button>");
          });

          $('#altEditor-modal').modal('show');
          $('#altEditor-modal input[0]').focus();
                }// action: function
    }]
    });
}
    
</script>
@endpush

@stop