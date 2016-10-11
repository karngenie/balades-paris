<li>	
	<article class="col-lg-3">
		<!-- <a class="card-walks" href="#">		-->
		<a class="card-walks" href='{{ route("balade",$walk->slug) }}'>				
			<div class="card-walks-img">
				<img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/51/Jardin_des_Tuileries_3%2C_Paris_September_2013.jpg/1920px-Jardin_des_Tuileries_3%2C_Paris_September_2013.jpg" />
				<h3 class="card-walks-title">{{$walk->walk_name}}</h3>
				<div class="card-walks-district">												
					@foreach ($walks as $walkDistrict)
						@if ($walkDistrict->walk_id == $currWalkId)									
							<div>{{$walkDistrict->name_short}}</div>
						@endif
					@endforeach	
				</div>					
			</div>
			<div class="card-walks-content">
				<p>
					Ancien quartier, luxe, espace vert et miam-miam
				</p>
			</div>
			<div class="card-walks-action">
				<div class="btn card-walks-btn" href="#" role="button">Voir le parcours</div>
			</div>				
		</a>
	</article>	
</li>

		
			
			
			
			
