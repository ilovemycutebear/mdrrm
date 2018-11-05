@extends ('masterdesign')



@section('content')

	<h1>{{$sitelog->id}}</h1>

	<ul>	
	@foreach($sitelog -> logger as $logs) <!--called logger method to connect two tables.-->


		<li>{{$logs->datemrcvd}}</li>
	@endforeach
	</ul>
@stop

