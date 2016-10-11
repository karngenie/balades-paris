@extends('layouts.master')

@section('content')


<main class="">
	<section class="info">
				<h1>Trouver une balades dans paris !</h1>
	</section>

	<section class="container walks">

		<ul class="row">
			<?php 
				$walkId; 
				$walkPrevId=-1; 
				$i=0; //Permet de tester si on est sur la 1er balade
				
			?>
			@foreach ($walks as $walk)

				@if ($walk->walk_id != $walkPrevId)
					@include('blocs.walk',["currWalkId" => $walk->walk_id])
					<?php  $walkPrevId = $walk->walk_id?>
				@endif
				
			@endforeach




		</ul>


	</section>
</main>
@endsection
