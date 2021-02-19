@extends("admin.layout.default", [
    'heading' => 'Order Details',
    'breadcrumb' => [['label' => 'Orders', 'route' => 'adminOrders'], ['label' => $orderItem->service_name]]
    ])

@section("content")
    <div class="content">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-6">
                       <div class="card card-body border-top-info">
                           <h6 class="font-weight-semibold mb-3">Order Details</h6>
                           <p class="text-muted">Order ID: #{{ $orderItem->order_id }}</p>
                           <p class="text-muted">Service: {{ $orderItem->service_name }}</p>
                           <p class="text-muted">Price: {{ $orderItem->price }}</p>
                           <p class="text-muted">Quantity: {{ $orderItem->quantity }}</p>
                       </div>
                    </div>
                    <div class="col-6">
                        <div class="card card-body border-top-info">
                            <h6 class="font-weight-semibold mb-3">Customer Details</h6>
                            <p class="text-muted">Customer Name: {{ $orderItem->order->user->name }}</p>
                           <p class="text-muted">Email: {{ $orderItem->order->user->email }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

