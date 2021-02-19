@extends("admin.layout.default", [
    'heading' => 'Dashboard',
    'breadcrumb' => [['label' => 'Dashboard']],
    'contentCenter' => true
    ])

@section("content")

    <!-- Registration form -->
    <form action="" method="post">
        {{ csrf_field() }}
        <div class="card">
            <div class="card-body">
                <div class="text-center">
                    <div class="icon-object border-success text-success"><i class="icon-key"></i></div>
                    <h5 class="content-group-lg">Update Password</h5>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group form-group-feedback form-group-feedback-left">
                            <input type="text" class="form-control" placeholder="Name" name="name">
                            <div class="form-control-feedback">
                                <i class="icon-user text-muted"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group form-group-feedback form-group-feedback-left">
                            <input type="email" class="form-control" placeholder="Email" name="email">
                            <div class="form-control-feedback">
                                <i class="icon-user-lock text-muted"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group form-group-feedback form-group-feedback-left">
                            <input type="password" class="form-control" placeholder="New password" name="password">
                            <div class="form-control-feedback">
                                <i class="icon-user-lock text-muted"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group form-group-feedback form-group-feedback-left">
                            <input type="password" class="form-control" placeholder="Repeat password" name="password_confirmation">
                            <div class="form-control-feedback">
                                <i class="icon-user-lock text-muted"></i>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="text-right">
                    <button type="submit" class="btn bg-teal-400 btn-labeled btn-labeled-left btn-block">
                        <b><i class="icon-lock2"></i></b> Update Password
                    </button>
                </div>
            </div>
        </div>
    </form>
    <!-- /registration form -->

@endsection
