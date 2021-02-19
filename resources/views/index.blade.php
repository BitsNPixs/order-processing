@extends("layout.default", [
	'heading' => 'Dashboard'
	])

@section("content")

	<!-- Services -->
	<div class="card">
		<div class="card-header header-elements-inline">
			<h6 class="card-title">Services</h6>
    	</div>

		<div class="card-body pb-0">
			<div class="row">
				@foreach($services as $service)
				<div class="col-xl-6">
					<div class="media flex-column flex-sm-row mt-0 mb-3">
    					<div class="mr-sm-3 mb-2 mb-sm-0">
							<div class="card-img-actions">
								<img src="{{ $service->img }}" class="img-fluid img-preview rounded" alt="">
							</div>
						</div>

    					<div class="media-body">
							<h6 class="media-title"><a href="{{ route('orderNow', $service) }}">{{ $service->name }}</a></h6>
							<p>{{ $service->description }}</p>
							<a href="{{ route('orderNow', $service) }}" class="btn mt-2 bg-teal-400">Order Now</a>
						</div>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</div>
	<!-- /Services -->

@endsection