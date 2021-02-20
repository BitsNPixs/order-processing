@extends("admin.layout.default", [
    'heading' => $meta['title'],
    'breadcrumb' => [['label' => $meta['title']]]
    ])

@section("content")

    <div class="row">

        <div class="col-12">
            @if(session()->has('msg'))
                <p class="alert alert-{{ session('msgType', 'success') }}" data-onload="scroll">{{ session('msg') }}</p>
            @endif

            <div class="card">
                <div class="card-header header-elements-inline">
                    <h5 class="card-title">{{ $meta['title'] }}</h5>
                    <div class="header-elements">
                        <div class="list-icons">
                            <a class="list-icons-item" data-action="collapse"></a>
                        </div>
                    </div>
                </div>

                <table class="table datatable-responsive">
                    <thead>
                        <tr>
                            <th>Order Id</th>
                            <th>Customer</th>
                            <th>Service</th>
                            <th>Price</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orderItems as $orderItem)
                        <tr>
                            <td>
                                {{ $orderItem->order->id }}
                            </td>
                            <td>
                                {{ $orderItem->order->user->name }}
                            </td>
                            <td>
                                {{ $orderItem->service_name }}
                            </td>
                            <td>{{ getCurrency() }} {{ getPrice($orderItem->price) }}</td>
                            <td>{{ getOrderStatusText($orderItem->status) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
