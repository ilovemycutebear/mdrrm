

    
      <!-- Modal content-->
      
            <table class="table table-bordered" id="users-table">
            {{$tabid->name}}
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Date/Time</th>
                <th>Rain</th>
            </tr>
        </thead>
    </table>
 
      

<script>
$(function() {
    $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{URL::asset('data/'.$tabid->id) }}",
        columns: [
            { data: 'site_id', name: 'site_id' },
            { data: 'name', name: 'name' },
            { data: 'datetime_10mins', name: 'datetime_10mins' },
            { data: 'rain10', name: 'rain10' }
        ]
    });
});
</script>