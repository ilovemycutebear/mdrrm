@extends('masterdesign')
@section('content')
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<div class="custom-container container">
    <div class="row">
      @foreach($latestcrsl as $siteinfos)
        <div class="col-xs-6 col-md-4 text-center"><h1>{{ $siteinfos->Site }}</h1></div>
      @endforeach
      @foreach($latestcrsl as $siteinfos)
         <div class="col-md-4 col-md-2 text-center"><h2>RAIN</h2></div>
        <div class="col-md-4 col-md-2 text-center"><h2>LEVEL</h2></div>
      @endforeach  
    @foreach($latestcrsl as $siteinfos)
        <div class="col-md-4 col-md-2 text-center"><h2>{{ $siteinfos->rainten }}</h2></div>
        <div class="col-md-4 col-md-2 text-center"><h2>{{ $siteinfos->water }}</h2></div>
      @endforeach
      @foreach($latestcrsl as $siteinfos)
        <div class="col-xs-6 col-md-4 text-center"><h3>DATA AS OF: {{$siteinfos->asof}}</h3></div>
      @endforeach
    </div>
</div>
@stop