
@extends('layouts.master')

@section('content')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.0-rc.3/dist/leaflet.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/0.4.2/leaflet.draw.css"/>
<div id="mapManage" style="width:400px;height:400px;background-color:red;position:fixed">

</div>

{!! Form::open(['url' => 'admin/balade/']) !!}


	<section class="spot container" style="">
		<div class="spotContent col-md-7 col-md-offset-2">
				<textarea id="debug" col="25"></textarea>
				<input type="button" class="genGeojson" value="gen"/>

				<input type="hidden" id="currentSpotEditor">
				{{ Form::hidden('walkId',$walkId)}}				
				<ul>
					<?php $temp_spot_id=0 ?>
					@foreach ($listSpots as $spot)					
					<li class="cardDetail">
						
						<?php $temp_spot_id++ ?>
						<div class="stepIcon">
							<span class="glyphicon {{$spot->icon_content}}" aria-hidden="true"></span>
						</div>					
						<div class="cardDetailDesc">
					
<!--                                {{ Form::label('name['.$spot->spot_id.']', 'Nom du bloc :', ['class' => 'awesome']) }}
                                {{ Form::text('name['.$spot->spot_id.']',$spot->name)}}-->
							
							{{ Form::hidden('spot_id[]', $spot->spot_id) }}

							{{ Form::label('name_'.$spot->spot_id, 'Nom du bloc :', ['class' => 'awesome']) }}
							{{ Form::text('name[]',$spot->name,['id'=>'name_'.$spot->spot_id ,  'temp_spot_id' => $temp_spot_id,  'class' => "spotSelector"])}}

							{{ Form::label("desc_".$spot->spot_id, 'Description :', ['class' => 'awesome']) }}
							{{ Form::textarea('desc[]',$spot->desc,['id'=>'desc_'.$spot->spot_id , 'class' => 'editor']) }}
											
							
						</div>	

	 				
<!--	 				@if ($listMiams->contains('spot_id', $spot->spot_id))
						<div class="miam">
							<hr />
							<div class="miamHeader">
								<span class="glyphicon glyphicon-cutlery"></span><label class=""> Miam Miam :</label>
								<span class="glyphicon glyphicon-plus  pull-right miamOpen"></span>
							</div>
	 						<aside class="row miamList">		
	 
			 					@foreach ($listMiams->where('spot_id',$spot->spot_id) as $miam)
										<div class="col-lg-4 miamDetail">
											<div class="thumbnail">								      
											  <div class="miamVisual" style="background-image: url({{$miam->img}})"></div>
											  <div class="caption">
											    <h4>{{$miam->name}}</h4>
											    <p>{{$miam->desc}}</p>
											    <p> <a href="{{$miam->url}}" class="btn btn-default" role="button" target="_blank">Button</a></p>
											  </div>
											</div>
										</div>
			 					@endforeach	
							</aside>
						</div>		
					@endif-->										
					</li>
						
					@endforeach	
					
					{{ $temp_spot_id}}
				</ul>
				{{ Form::submit('Click Me!') }}
		</div>
	</section>	

{!! Form::close() !!}


@include('layouts.loadscript')

 <link href="{{ asset('css/leaflet.awesome-markers.css') }}" rel="stylesheet">

<script src="https://unpkg.com/leaflet@1.0.0-rc.3/dist/leaflet.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/0.4.2/leaflet.draw.js"></script>



<script src="{{ asset('js/leaflet.awesome-markers.js') }}"></script>   

<!-- script pour l'editeur -->
<script src="{{ asset('js/summernote/summernote.min.js') }}"></script>   

<script type="text/javascript">

	var geojsonFeature=
	{
	"type": "FeatureCollection",
	
	};



//load geojson 
var geojsonLoad= {
	"features": [
		    {
		      "type": "Feature",
		      "properties": {
		        "idFeature": 1
		      },
		      "geometry": {
		        "type": "LineString",
		        "coordinates": [
		          [
		            2.3993808031082153,
		            48.85112655835626
		          ],
		          [
		            2.399868965148926,
		            48.851486605080694
		          ],
		          [
		            2.399836778640747,
		            48.8515819111332
		          ]
		        ]
		      }
		    },
		    {
		      "type": "Feature",
		      "properties": {
		        "idFeature": 2
		      },
		      "geometry": {
		        "type": "LineString",
		        "coordinates": [
		          [
		            2.399836778640747,
		            48.85158014620794
		          ],
		          [
		            2.399533689022064,
		            48.85152896334864
		          ],
		          [
		            2.3993673920631404,
		            48.851906656320175
		          ],
		          [
		            2.400775551795959,
		            48.85296206363088
		          ]
		        ]
		      }
		    },
		    {
		      "type": "Feature",
		      "properties": {
		        "idFeature": "3",
		      },
		      "geometry": {
		        "type": "Point",
		        "coordinates": [
		          2.4007728695869446,
		          48.85295853387763
		        ]
		      }
		    },
		    {
		      "type": "Feature",
		      "properties": {
		        "idFeature": "4"
		      },
		      "geometry": {
		        "type": "Point",
		        "coordinates": [
		          2.4107728695869446,
		          48.85295853387763
		        ]
		      }
		    }			    
		  ]

}

// si pas de  donnée
/*
var geojsonLoad= {
	"features": [
			{}]
}
*/
geojsonFeature.features=geojsonLoad.features;




$("#debug").val(JSON.stringify(geojsonFeature));















	var map  = L.map('mapManage').setView([48.8507815, 2.3969352], 18);
	var highlighted_feature;

	L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
	attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://mapbox.com">Mapbox</a>',

	}).addTo(map);		


	//ajouter les fonction pour les ajout des id
	//geojson=L.geoJson(geojsonFeature).addTo(map);

		geojson=L.geoJson(geojsonFeature, {
			pointToLayer: pointToLayer,
			onEachFeature:onEachFeature
		}).addTo(map);


	var redMarker = L.AwesomeMarkers.icon({
		icon: 'glyphicon-star',
		markerColor: 'red'
	}); 

	// FeatureGroup is to store editable layers
	//var drawnItems = new L.FeatureGroup();
	var drawnItems = geojson;
	//drawnItems.addLayer(geojson);
	map.addLayer(drawnItems);

	map.addControl(new L.Control.Draw({
		edit: {
			featureGroup: drawnItems,
			poly : {
				allowIntersection : false
			}
		},
		draw: {
			polygon : {
				allowIntersection: false,
				showArea:true
			},
            marker: {
                icon:redMarker
            }			
		}
	}));

	map.on(L.Draw.Event.CREATED, function(event) {
		var layer = event.layer;
		let CurrentLayer=$("#currentSpotEditor").val();
		layer.idFeature=CurrentLayer;
		
		
		//console.log(layer);
		drawnItems.addLayer(layer);



		//hightlightCurrent(CurrentLayer);

	});

     map.on('draw:edited', function (e) {
         var layers = e.layers;
         layers.eachLayer(function (layer) {
			 //console.log(layer.getLatLng());
             //do whatever you want; most likely save back to db
         });
     });


	$(document).ready(function() {

		$('.editor').summernote({
			height:200,
		});		

		$(document).on('click', '.spotSelector', function(){
			resetHighlight();

			let temp_spot_id=$(this).attr("temp_spot_id");

			$("#currentSpotEditor").val(temp_spot_id);

			hightlightCurrent(temp_spot_id);
			
	
		});


		$(document).on('click', '.genGeojson', function(){

			var json;
			geojsonFeature.features=[{}];
			for (var key in drawnItems._layers) {
				//console.log(drawnItems._layers[key]);

				json= drawnItems._layers[key].toGeoJSON();

				L.extend(json.properties, {"idFeatureid" : drawnItems._layers[key].idFeature});




				geojsonFeature.features.push(json);
	
				console.log(json);
			}
			$("#debug").val(JSON.stringify(geojsonFeature));
		});




	});

	function hightlightCurrent(CurrentLayer)
	{
		drawnItems.eachLayer(
			function (layer) {
				//console.log(layer);
				highlighted_feature = layer;
				console.log(layer.idFeatureid);
				if (layer.idFeature==CurrentLayer){

					// si marker
					if (typeof layer._icon != 'undefined')
					{

						var redMarker = L.AwesomeMarkers.icon({
							icon: layer.options.icon.options.icon,
							markerColor: 'blue'
						});

						highlighted_feature.setIcon(redMarker);

					}
					else
					{
						// si segment
						highlighted_feature.setStyle({
							weight: 5,
							color: '#0006ff',
							fillColor: 'blue',
							dashArray: '',
							fillOpacity: 1
						})
					}

				}
			}
		);
	}

	function resetHighlight(e) {

		drawnItems.eachLayer(
			function (layer) {
				highlighted_feature = layer;
				// si marker
				if (typeof layer._icon != 'undefined')
				{
						var redMarker = L.AwesomeMarkers.icon({
							icon: layer.options.icon.options.icon,
							markerColor: 'red'
						});
						highlighted_feature.setIcon(redMarker);


				}		
				else
				{				
					
					highlighted_feature.setStyle({
						weight: 5,
						color: '#000000',
						fillColor: 'blue',
						dashArray: '',
						fillOpacity: 1
					})
				}
			}
		);

	}	


	function pointToLayer(feature,latlng){			
		
		var redMarker = L.AwesomeMarkers.icon({
		icon: 'glyphicon-star',
		markerColor: 'red'
		});  	

		if (feature['geometry']["type"]=="Point")
		{		
			return L.marker(latlng,{icon: redMarker});		
		}	
	}


	function onEachFeature(feature, layer) {
		//console.log(feature['properties']["idSeg"]);
		//console.log(feature.id);
		layer.idFeature = feature['properties']["idFeature"];
		
	}	
	
</script> 
@endsection