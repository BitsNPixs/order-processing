@extends("layout.default", [
    'heading' => 'Login'
    ])

@section("content")
    <div class="content d-flex justify-content-center align-items-center">

        <!-- Simple login form -->
        <form action="{{ route("login") }}" method="post" class="login-form">
            {{ csrf_field() }}
            <div class="card mb-0">
                <div class="card-body">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="text-center mb-3">
                        <i class="icon-reading icon-2x text-slate-300 border-slate-300 border-3 rounded-round p-3 mb-3 mt-1"></i>
                        <h5 class="content-group">Login to your account</h5>
                        <span class="d-block text-muted">Enter your credentials below</span>
                    </div>

                    <div class="form-group form-group-feedback form-group-feedback-left">
                        <input type="text" class="form-control" placeholder="Email" name="email" value="{{ old("email") }}">
                        <div class="form-control-feedback">
                            <i class="icon-user"></i>
                        </div>
                    </div>

                    <div class="form-group form-group-feedback form-group-feedback-left">
                        <input type="password" class="form-control" placeholder="Password" name="password">
                        <div class="form-control-feedback">
                            <i class="icon-lock2"></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">Sign in <i class="icon-circle-right2 position-right"></i></button>
                    </div>
                </div>
            </div>
        </form>
        <!-- /simple login form -->
    </div>

@endsection

