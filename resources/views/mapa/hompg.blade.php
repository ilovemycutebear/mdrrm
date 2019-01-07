@extends('masterdesign')


@section('content')
<script>
     var tmp=[];
     var tmpb=[];

    var mymap;

            function onLoad() {
                 mymap = L.map('mapid').setView([14.667668, 120.967153], 14);

                //var geojsonLayer = new L.GeoJSON.AJAX('{{URL::asset('wlmap')}}');       

                L.tileLayer("{{URL::asset('img/maps/offline/{z}/{x}/{y}.png')}}",
                {    maxZoom: 16  }).addTo(mymap);
                   //  geojsonLayer.addTo(mymap);
                    var mapControlsContainer = document.getElementsByClassName("leaflet-control")[0];
                    var logoContainer = document.getElementById("logoContainer");

                    var mapControlsContainera = document.getElementsByClassName("leaflet-control")[0];
                    var logoContainera = document.getElementById("logoContainera");

                    mapControlsContainera.appendChild(logoContainera);

                        }
        function waterleveltrigger(){
    //##################################ICONS##################################################
                var icnormal = L.icon({
        iconUrl:  "{{URL::asset('img/marker/normal.png')}}",
        iconSize: [25,25],
        iconAnchor: [5, 20], // horizontal puis vertical
    });
             var icnalarm = L.icon({
    
        iconUrl:  "{{URL::asset('img/marker/alarm.png')}}",
        iconSize: [25,25],
        iconAnchor: [5, 20], // horizontal puis vertical
    
    });
        var icnalert = L.icon({
  
        iconUrl:  "{{URL::asset('img/marker/alert.png')}}",
        iconSize: [25,25],
        iconAnchor: [5, 20], // horizontal puis vertical
    
    });
    var icncritical = L.icon({
 
        iconUrl:  "{{URL::asset('img/marker/critical.png')}}",
        iconSize: [25,25],
        iconAnchor: [5, 20], // horizontal puis vertical
    
    });
   var icndatadown = L.icon({

        iconUrl:  "{{URL::asset('img/marker/datadown.png')}}",
        iconSize: [25,25],
        iconAnchor: [5, 20], // horizontal puis vertical
    
    });
   var icndatanc = L.icon({
  
        iconUrl:  "{{URL::asset('img/marker/datanc.png')}}",
        iconSize: [25,25],
        iconAnchor: [5, 20], // horizontal puis vertical
    
    });
    var icndataup = L.icon({
  
        iconUrl:  "{{URL::asset('img/marker/dataup.png')}}",
        iconSize: [25,25],
        iconAnchor: [5, 20], // horizontal puis vertical
    
    });
   var icnodata = L.icon({

        iconUrl:  "{{URL::asset('img/marker/nodata.png')}}",
        iconSize: [25,25],
        iconAnchor: [5, 20], // horizontal puis vertical
    });
    //##################################ICONS##################################################
             $.get("{{URL::asset('wlmap')}}").done(function(e){
                //console.log(JSON.parse(e));
                var alldata = JSON.parse(e);
                for (var a in alldata.features ){
                    var b = alldata.features[a];
                    console.log(b.geometry.coordinates);
                    wliconval = "";
                    if((b.properties.description.wlevel>=b.properties.description.wlalert)&&(b.properties.description.wlevel<b.properties.description.wlalarm)){
                        wliconval = icnalert;

                    }
                    else if((b.properties.description.wlevel>=b.properties.description.wlalarm)&&(b.properties.description.wlevel<b.properties.description.wlcritical)){
                        wliconval = icnalarm;

                    }
                    else if(b.properties.description.wlevel>=b.properties.description.wlcritical){
                        wliconval = icncritical;

                    }
                    else if(b.properties.description.wlevel<b.properties.description.wlalarm){
                        wliconval = icnormal;

                    }
                    else{
                        wliconval = icnodata;
                    }
                    var latlng = [b.geometry.coordinates[1],b.geometry.coordinates[0]];

                   var tmpa = L.marker(latlng,{icon:wliconval}).bindTooltip("STENAME: "+ b.properties.description.Sitename+ "<br> WATER LEVEL: "+ b.properties.description.wlevel+"<br> AS OF: "+b.properties.description.asof).addTo(mymap);
                  tmp.push(tmpa);
                }
            });
            console.log(tmp);

        }
    function raintrigger(){
  var blgrndrp = L.icon({

        iconUrl:  "{{URL::asset('img/marker/0119.png')}}",
        iconSize: [20,25],
        iconAnchor: [5, 20], // horizontal puis vertical
    
    });
        var rddrp = L.icon({

        iconUrl:  "{{URL::asset('img/marker/5h5h9.png')}}",
        iconSize: [20,25],
        iconAnchor: [5, 20], // horizontal puis vertical
    
    });
    var bldrp = L.icon({

        iconUrl:  "{{URL::asset('img/marker/1h1h9.png')}}",
        iconSize: [20,25],
        iconAnchor: [5, 20], // horizontal puis vertical
    
    });
   var vltdrp = L.icon({

        iconUrl:  "{{URL::asset('img/marker/2h2h9.png')}}",
        iconSize: [20,25],
        iconAnchor: [5, 20], // horizontal puis vertical
    
    });
   var ylwdrp = L.icon({

        iconUrl:  "{{URL::asset('img/marker/3h3h9.png')}}",
        iconSize: [20,25],
        iconAnchor: [5, 20], // horizontal puis vertical
    
    });
    var orngdrp = L.icon({

        iconUrl:  "{{URL::asset('img/marker/4h4h9.png')}}",
        iconSize: [20,25],
        iconAnchor: [5, 20], // horizontal puis vertical
    
    });
   var skbldrp = L.icon({

        iconUrl:  "{{URL::asset('img/marker/2099.png')}}",
        iconSize: [20,25],
        iconAnchor: [5, 20], // horizontal puis vertical
    
    });
var grydrp = L.icon({

        iconUrl:  "{{URL::asset('img/marker/norf.png')}}",
        iconSize: [20,25],
        iconAnchor: [5, 20], // horizontal puis vertical
    
    });
// VOLUMES

 var blgrndrpv = L.icon({
    
        iconUrl:  "{{URL::asset('img/marker/0119v.png')}}",
        iconSize: [20,25],
        iconAnchor: [5, 20], // horizontal puis vertical
    
    });
        var rddrpv = L.icon({
   
        iconUrl:  "{{URL::asset('img/marker/5h5h9v.png')}}",
        iconSize: [20,25],
        iconAnchor: [5, 20], // horizontal puis vertical
    
    });
    var bldrpv = L.icon({
  
        iconUrl:  "{{URL::asset('img/marker/1h1h9v.png')}}",
        iconSize: [20,25],
        iconAnchor: [5, 20], // horizontal puis vertical
    
    });
   var vltdrpv = L.icon({
  
        iconUrl:  "{{URL::asset('img/marker/2h2h9v.png')}}",
        iconSize: [20,25],
        iconAnchor: [5, 20], // horizontal puis vertical
    
    });
   var ylwdrpv = L.icon({
  
        iconUrl:  "{{URL::asset('img/marker/3h3h9v.png')}}",
        iconSize: [20,25],
        iconAnchor: [5, 20], // horizontal puis vertical
    
    });
    var orngdrpv = L.icon({
 
        iconUrl:  "{{URL::asset('img/marker/4h4h9v.png')}}",
        iconSize: [20,25],
        iconAnchor: [5, 20], // horizontal puis vertical
    
    });
   var skbldrpv = L.icon({
  
        iconUrl:  "{{URL::asset('img/marker/2099v.png')}}",
        iconSize: [20,25],
        iconAnchor: [5, 20], // horizontal puis vertical
    
    });
var grydrpv = L.icon({

        iconUrl:  "{{URL::asset('img/marker/norfv.png')}}",
        iconSize: [20,25],
        iconAnchor: [5, 20], // horizontal puis vertical
    
    });

             $.get("{{URL::asset('map')}}").done(function(e){
                //console.log(JSON.parse(e));
                var alldata = JSON.parse(e);
                for (var c in alldata.features ){
                    var d = alldata.features[c];
                    console.log(d.properties.description.rainfall);
                    var iconval = "";
                    if(d.properties.description.dataof == "daily"){
                             if(d.properties.description.rainfall<=0){
                        iconval = grydrpv;
                        }
                        else if((d.properties.description.rainfall>=1)&&(d.properties.description.rainfall<=24)){
                        iconval = blgrndrpv;
                        }
                        else if((d.properties.description.rainfall>=25)&&(d.properties.description.rainfall<=49)){
                        iconval = skbldrpv;
                        }
                        else if((d.properties.description.rainfall>=50)&&(d.properties.description.rainfall<=74)){
                        iconval = bldrpv;
                        }
                        else if((d.properties.description.rainfall>=75)&&(d.properties.description.rainfall<=99)){
                        iconval = vltdrpv;
                        }
                        else if((d.properties.description.rainfall>=100)&&(d.properties.description.rainfall<=124)){
                        iconval = ylwdrpv;
                        }
                        else if((d.properties.description.rainfall>=125)&&(d.properties.description.rainfall<=149)){
                        iconval = orngdrpv;
                        }
                        else if(d.properties.description.rainfall>=150){
                        iconval = rddrpv;
                        }
                    } //if daily
                    else{

                    if(d.properties.description.rainfall<=0){
                        iconval = grydrp;
                    }
                    else if(d.properties.description.rainfall==1){
                        iconval = blgrndrp;
                    }
                    else if((d.properties.description.rainfall>=2)&&(d.properties.description.rainfall<=9)){
                        iconval = skbldrp;
                    }
                    else if((d.properties.description.rainfall>=10)&&(d.properties.description.rainfall<=19)){
                        iconval = bldrp;
                    }
                    else if((d.properties.description.rainfall>=20)&&(d.properties.description.rainfall<=29)){
                        iconval = vltdrp;
                    }
                    else if((d.properties.description.rainfall>=30)&&(d.properties.description.rainfall<=39)){
                        iconval = ylwdrp;
                    }
                    else if((d.properties.description.rainfall>=40)&&(d.properties.description.rainfall<=49)){
                        iconval = orngdrp;
                    }
                    else if(d.properties.description.rainfall>=50){
                        iconval = rddrp;
                    }
                        }//else ten minitues
                    var latlng = [d.geometry.coordinates[1],d.geometry.coordinates[0]];
                   var tmpc = L.marker(latlng,{icon:iconval}).bindTooltip("STENAME: "+ d.properties.description.Sitename+ "<br> RAIN: "+ d.properties.description.rainfall+"<br> AS OF : "+d.properties.description.asof).addTo(mymap);
                  tmpb.push(tmpc);
                }
            });
            console.log(tmp);

    }//raintrigger
        function triggera (){
                 for (var C in tmp ){
                        mymap.removeLayer(tmp[C]);
                }
            }
        function triggerb (){
                 for (var B in tmpb ){
                        mymap.removeLayer(tmpb[B]);
                }

        }

        </script>   
    </head>

    <body onload="onLoad();"> 
        <div id="mapid" style="height: 800px;"></div>
        <div class="btn-group">
         
        <button onclick="waterleveltrigger()" class="btn btn-primary">Water Level</button>
        <button onclick="triggera()" class="btn btn-warning">remove water level</button>
            <div class="btn-group">
        <button onclick="raintrigger()" class="btn btn-primary">Rain</button>
        <button onclick="triggerb()" class="btn btn-warning">remove rain</button>
            </div>
        </div>
        <div id="logoContainer">
            Legend
        </div>
        <div id="logoContainera">
            Legend
        </div>
    </body>

@stop