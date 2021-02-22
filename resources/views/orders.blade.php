@extends("layout.default", [
    'heading' => 'Orders',
    'breadcrumb' => [['label' => 'Orders']]
    ])

@section("content")
    <div class="row">
        <div class="col-12">

            @if(session()->has('msg'))
                <p class="alert alert-{{ session('msgType', 'success') }}" data-onload="scroll">{{ session('msg') }}</p>
            @endif

            <div class="card">
                <div class="card-header header-elements-inline">
                    <h5 class="card-title">Your Orders</h5>
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
                            <th>Services</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orderItems as $item)
                        <tr>
                            <td class="text-center">#{{ $item->order->id }}</td>
                            <td class="service-name-col">
                                <nobr>{{ $item->service_name }}</nobr>
                            </td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ getCurrency() }}{{ $item->price }}</td>
                            <td>{{ getCurrency() }}{{ $item->quantity * $item->price }}</td>
                            <td>{{ getOrderStatusText($item->status) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

