
@extends('layouts.master')

@section('content')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.0-rc.3/dist/leaflet.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/0.4.2/leaflet.draw.css"/>
<div id="mapManage" style="width:400px;height:400px;background-color:red;position:fixed">
cpououc
</div>
{!! Form::open(['url' => 'admin/balade/']) !!}


	<section class="spot container" style="">
		<div class="spotContent col-md-7 col-md-offset-2">

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


<script src="https://unpkg.com/leaflet@1.0.0-rc.3/dist/leaflet.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/0.4.2/leaflet.draw.js"></script>
<script type="text/javascript">


</script>


<!-- script pour l'editeur -->
<script src="{{ asset('js/summernote/summernote.min.js') }}"></script>   

<script type="text/javascript">

	var map  = L.map('mapManage').setView([48.8507815, 2.3969352], 18);
	var highlighted_feature;

	L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
	attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://mapbox.com">Mapbox</a>',

	}).addTo(map );		



	// FeatureGroup is to store editable layers
	var drawnItems = new L.FeatureGroup();

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
			}
		}
	}));

	map.on(L.Draw.Event.CREATED, function(event) {
		var layer = event.layer;
		let CurrentLayer=$("#currentSpotEditor").val();
		layer.id=CurrentLayer;
		console.log(layer);
		drawnItems.addLayer(layer);

		//hightlightCurrent(CurrentLayer);

	});

     map.on('draw:edited', function (e) {
         var layers = e.layers;
         layers.eachLayer(function (layer) {
			 console.log(layer.getLatLng());
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
	});

	function hightlightCurrent(CurrentLayer)
	{
		drawnItems.eachLayer(
			function (layer) {
				//console.log(layer);
				highlighted_feature = layer;
				console.log(layer.id);
				if (layer.id==CurrentLayer){
					highlighted_feature.setStyle({
						weight: 5,
						color: '#0006ff',
						fillColor: 'blue',
						dashArray: '',
						fillOpacity: 1
					})
				}
			}
		);
	}

	function resetHighlight(e) {

		drawnItems.eachLayer(
			function (layer) {
				//console.log(layer);
				highlighted_feature = layer;
				highlighted_feature.setStyle({
					weight: 5,
					color: '#000000',
					fillColor: 'blue',
					dashArray: '',
					fillOpacity: 1
				})
			}
		);

	}	


</script> 
@endsection