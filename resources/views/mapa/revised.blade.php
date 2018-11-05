@extends('masterdesign')

{!! $map['js']!!}
@section('content')

<div class="container-fluid">

      <div class="container">
      <hr>
      </div>
	<div class="row">
		<div class="col-md-6">
		  {!! $map['html']!!}
		</div>
		<div class="col-md-6">
		</div>
	</div>
</div>

@stop