@extends('layouts.master')

@section('content')


<main class="">


	<section class="container walks">

		<ul class="row">



			@foreach ($listSpots as $spot)
				{{$spot->name}}<br>

				
			@endforeach		



		</ul>


	</section>
</main>
@endsection
