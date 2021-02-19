@extends("layout.default", [
    'heading' => 'Services',
    'breadcrumb' => [['label' => 'Service']]
    ])

@section("content")
    <div class="row">
        @foreach($services as $service)
            <div class="col-xl-4 col-md-6 d-flex">
                <div class="card">
                    <div class="card-body">
                        <div class="card-img-actions">
                            <img src="{{ $service->img }}" class="card-img" alt="">
                        </div>
                    </div>

                    <div class="card-body bg-light text-center">
                        <div class="mb-2">
                            <h6 class="font-weight-semibold mb-0">
                                <a href="{{ route('orderNow', $service) }}" class="text-default">{{ $service->name }}</a>
                            </h6>

                            <a href="{{ route('orderNow', $service) }}" class="text-muted">{{ $service->description }}</a>
                        </div>

                        <h3 class="mb-0 font-weight-semibold">$ {{ getPrice($service->price) }}</h3>

                        <a href="{{ route('orderNow', $service) }}" class="btn btn-block mt-2 bg-teal-400">Order Now</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

@endsection

