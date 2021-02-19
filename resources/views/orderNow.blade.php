@extends("layout.default", [
    'heading' => $service->name,
    'breadcrumb' => [['route' => 'services', 'label' => 'Service'], ['label' => $service->name]]
    ])

@section("content")
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card mb-0">
                <div class="card-body">
                    <form action="{{ route("orderNow", $service) }}" method="post">
                        {{ csrf_field() }}

                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="media flex-column flex-sm-row mt-0 mb-3">
                            <div class="mr-sm-3 mb-2 mb-sm-0">
                                <div class="card-img-actions">
                                    <img src="{{ $service->img }}" class="img-fluid img-preview rounded" alt="">
                                </div>
                            </div>

                            <div class="media-body">
                                <h4 class="media-title">{{ $service->name }}</h4>
                                <p>{{ $service->description }}</p>
                                <h5 class="mb-0 font-weight-semibold">$ {{ $service->customer_price ?? $service->price }}</h5>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-md-6">Quantity:</label>
                            <div class="col-md-6">
                                <input type="number" class="form-control" value="1" name="quantity" min="1" max="10" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-md-6">Communication Mode:</label>
                            <div class="col-md-6">
                                <select name="communication-mode" id="communication-mode" class="form-control" required>
                                    @foreach(getCommunicationModes() as $mode)
                                    <option value="{{ $mode['code'] }}">{{ $mode['text'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block mt-4">Order Now</button>

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

