@php
$_controller = explode("@", basename(str_replace('\\', '/', Route::currentRouteAction())))[0] ? :"";
@endphp

<!-- Page header -->
	<div class="page-header">

		@if(Auth::check())

		<!-- Page header content -->
		<div class="page-header-content header-elements-md-inline">
			<div class="page-title d-flex">
				<h4><img src="img/logo.png"></h4>
			</div>
		</div>
		<!-- /page header content -->


		<!-- Secondary navbar -->
		<div class="navbar navbar-expand-md navbar-dark border-top-0">
			<div class="d-md-none w-100">
				<button type="button" class="navbar-toggler d-flex align-items-center w-100" data-toggle="collapse" data-target="#navbar-navigation">
					<i class="icon-menu-open mr-2"></i>
					Main navigation
				</button>
			</div>

			<div class="navbar-collapse collapse" id="navbar-navigation">
				<ul class="navbar-nav navbar-nav-highlight">
					<li class="nav-item">
						<a href="{{ route('index') }}" class="navbar-nav-link {{ $_controller == 'DashboardController' ? " active" : ""}}">
							<i class="icon-home4 mr-2"></i>
							Dashboard
						</a>
					</li>

					<li class="nav-item">
						<a href="{{ route('services') }}" class="navbar-nav-link {{ $_controller == 'ServiceController' ? " active" : ""}}">
							<i class="icon-strategy mr-2"></i>
							Service
						</a>
					</li>

					<li class="nav-item dropdown">
						<a href="#" class="navbar-nav-link dropdown-toggle {{ $_controller == 'OrderController' ? " active" : ""}}" data-toggle="dropdown">
							<i class="icon-cart2"></i>
							Orders
						</a>

						<div class="dropdown-menu">
							@foreach(orderMenus() as $key => $menu)
                                <a href="{{ route('orders', ['type' => $key]) }}" class="dropdown-item">
                                	{{ $menu['label'] }}
                                </a>
                            @endforeach
						</div>
					</li>
				</ul>

				<ul class="navbar-nav navbar-nav-highlight ml-md-auto">
					<li class="nav-item dropdown">
						<a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown">
							<i class="icon-cog3"></i>
							<span class="ml-2">Account</span>
						</a>

						<div class="dropdown-menu dropdown-menu-right">
							<a href="{{route('logout')}}" class="dropdown-item"><i class="icon-switch2"></i> Logout</a>
						</div>
					</li>
				</ul>
			</div>
		</div>
		<!-- /secondary navbar -->

		@endif

	</div>
	<!-- /page header -->
