@extends('layouts.master')

	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.0-rc.3/dist/leaflet.css" />


@section('content')
	<style>

		
		

		#map { height: 100%; }
		
		#mapContent{height: 200px;    width: 100%; }
		.spot{
			margin-top: 200px
			/*
				padding-left: 30px;
	    		padding-right: 10px;
    		*/
		}

		.spotContent{
			border-left: solid 2px black;
			position: relative;
		}
		.spotContent ul {list-style-type: none; padding-left: 15px;padding-top: 25px}
		.spotContent ul, .spotContent li {margin: 0; position: relative; }
		.spotContent li {
			
			

			margin-left: 15px;
			margin-top: 15px;
		}

		.stepIcon{ 
			position: absolute;
			left: -58px; top: 15px; 
			background-color: #457388;
			border-radius: 50%; 
			height: 50px; 
			width: 50px;
			box-shadow: 0 0 0 0px white, inset 0 2px 0 rgba(0, 0, 0, 0.08), 0 3px 0 0px rgba(0, 0, 0, 0.05);
	
		}

		.stepIcon .glyphicon{
			text-align: center;
			left: 50%;
			top: 50%;
			transform: translate(-50%,-50%);
			color: #ffffff;
		}


		.spot p{
			margin: 0;
			padding:0 15px 0 15px; 
		}

		.cardDetail{
			position: relative;
			margin: 0; 
			min-height:80px;
			background-color: #ffffff; 
	
			/*box-shadow: 2px 2px 0px 0 rgba(0,0,0,0.16),2px 2px 0px 0 rgba(0,0,0,0.12);*/
			box-shadow: 0 2px 5px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12);
		}


		.arrow-left {
		  width: 0; 
		  height: 0; 
		  border-top: 10px solid transparent;
		  border-bottom: 10px solid transparent; 		  
		  border-right:10px solid #ffffff; 
		  position: absolute;
		  left:15px;
		  top:20px;
		}
/*
		li:after {
			display: block;
			width: 0; 
			height: 0; 
			border-top: 10px solid transparent;
			border-bottom: 10px solid transparent; 		  
			border-right:10px solid #ffffff; 
			position: absolute;
			left:15px;
			top:20px;
			content: "";
		}*/
		.cardDetail .cardDetailImg {width: 100%}
		.cardDetail h3 {margin: 5px 0 10px 0;
		padding: 0 15px 0 15px}
		.cardDetail .cardDetailDesc {padding: 5px}
		.miamHeader span{ margin-left: 5px; margin-right: 5px;}


		.miamList{display: none}


		.miamDetail{			
			overflow: hidden;
			padding-left: 5px;
			padding-right: 5px;
		}

		.miamVisual{
			height: 100px;
			background-size: cover;
		}

		.thumbnail{
			margin-bottom: 10px;
			padding: 0;
		}

		.miamDetail h4 {
			height: 36px;
		}
	@media (max-width: 767px) { 


		.timeLineMobile{
			position: absolute;
			background-color: #000000;
			width: 2px;
			top: -55px;
			bottom: 0;
			left:50%;
		    -webkit-transform: translate(-50%,0);
		    -moz-transform: translate(-50%,0);
		    -ms-transform: translate(-50%,0);
		    -o-transform: translate(-50%,0);
		    transform: translate(-50%,0);			

		}	



		.spotContent {
		    border-left: solid 0;

		   
		}
				

		.spotContent li {
		    margin-left: 0;
		    margin-top: 55px;
		}		


		.spotContent ul {		    
		    padding-left: 0;
		    padding-top: 0;
		   
		}

		.stepIcon {
		   
		    left: 50%;
		    top: -28px;
		    height: 30px;
    		width: 30px;
		    -webkit-transform: translate(-50%,-50%);
		    -moz-transform: translate(-50%,-50%);
		    -ms-transform: translate(-50%,-50%);
		    -o-transform: translate(-50%,-50%);
		    transform: translate(-50%,-50%);
		}	


	}




	</style>

<main class="">

	<div class="row">
		<section class=" container" style="position:fixed;top: 51px;right: 0;left: 0;z-index:99999;">		
			<div  class="col-md-9 col-md-offset-1" >
					<div id="mapContent" style="">


				 		<div id="map"></div>
				 	
				 	</div>
			</div>
		</section>
	</div>	


	<section class="spot container" style="">
		<div class="spotContent col-md-7 col-md-offset-2">
			<div class="timeLineMobile"></div>
				<ul>
					@foreach ($listSpots as $spot)
					
					<li class="cardDetail">
						<div class="stepIcon">
							<span class="glyphicon {{$spot->icon_content}}" aria-hidden="true"></span>
						</div>					
						<div class="cardDetailDesc">
							<h3>{{$spot->name}}</h3>
							<p>
								{{$spot->desc}}								
							</p>
						</div>	

	 				
	 				@if ($listMiams->contains('spot_id', $spot->spot_id))
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
					@endif										
					</li>
					@endforeach	
				</ul>
		</div>
	</section>	


    <!-- Scripts -->
    @include('layouts.loadscript')

{{--     <script src="{{ asset('js/all.js') }}"></script>
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCHUOo8VLvsHwr7BMa3qxRuzJ3sR3q-1Kc&callback=initMap">
    </script> --}}

	<script 
		src="https://unpkg.com/leaflet@1.0.0-rc.3/dist/leaflet.js">
	</script>
	{{-- <link rel="stylesheet" href="awmaker/leaflet.awesome-markers.css"> --}}
	{{-- <script src="awmaker/leaflet.awesome-markers.js"></script> --}}
	<script type="text/javascript">
		var mymap = L.map('map').setView([48.8507815, 2.3969352], 18);

		L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
		    attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://mapbox.com">Mapbox</a>',

		}).addTo(mymap);		

	</script>

</main>
@endsection
