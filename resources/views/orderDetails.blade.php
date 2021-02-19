@extends("layout.default", [
    'heading' => 'Order Details',
    'breadcrumb' => [['label' => 'Orders', 'route' => 'orders'], ['label' => $orderItem->service_name]]
    ])

@section("content")
    <div class="content">
        <div class="row">
            <div class="col-12">
                <!-- Control position -->
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h5 class="card-title">{{ $orderItem->service_name }}</h5>
                        <div class="header-elements">
                            <div class="list-icons">
                                <a class="list-icons-item" data-action="collapse"></a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        @include('chat.chats', ['isAdmin' => false])
                    </div>
                    <div class="card-body">
                        @include('chat.form', [
                           'isAdmin' => false,
                           'type' => 'CASUAL',
                           'postTo' => 'postChat',
                           'uploadTo' => 'uploadChatFiles',
                           'label' => 'Start Order'
                       ])
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

