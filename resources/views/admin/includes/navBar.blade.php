@php
	$_currentController = explode("@", basename(str_replace('\\', '/', Route::currentRouteAction())))[0] ? :"";
@endphp

<!-- Main sidebar -->
<div class="sidebar sidebar-dark sidebar-main sidebar-expand-md">

	<!-- Sidebar mobile toggler -->
	<div class="sidebar-mobile-toggler text-center">
		<a href="#" class="sidebar-mobile-main-toggle">
			<i class="icon-arrow-left8"></i>
		</a>
		Navigation
		<a href="#" class="sidebar-mobile-expand">
			<i class="icon-screen-full"></i>
			<i class="icon-screen-normal"></i>
		</a>
	</div>
	<!-- /sidebar mobile toggler -->


	<!-- Sidebar content -->
	<div class="sidebar-content">

		<!-- Main navigation -->
		<div class="card card-sidebar-mobile">
			<ul class="nav nav-sidebar" data-nav-type="accordion">

				<li class="nav-item">
					<a href="{{ route('admin.index') }}" class="nav-link {{ $_currentController == 'DashboardController'? " active":""}}">
						<i class="icon-home4"></i>
						<span>
							Dashboard
						</span>
					</a>
				</li>

				<li class="nav-item nav-item-submenu {{ in_array($_currentController, ['OrderController', 'ChatController']) ? "nav-item-expanded nav-item-open":""}}">
					<a href="#" class="nav-link">
						<i class="icon-cart5"></i> <span>Order Management</span>
					</a>
					<ul class="nav nav-group-sub" data-submenu-title="Customer Managemen">
						<li class="nav-item">
							<a href="{{ route('adminOrders', ['type' => 'new']) }}" class="nav-link">New Orders</a>
						</li>
						<li class="nav-item">
							<a href="{{ route('adminOrders', ['type' => 'working']) }}" class="nav-link">Working Orders</a>
						</li>
						<li class="nav-item">
							<a href="{{ route('adminOrders', ['type' => 'delivered']) }}" class="nav-link">Delivered</a>
						</li>
						<li class="nav-item">
							<a href="{{ route('adminOrders', ['type' => 'archive']) }}" class="nav-link">Order Archive</a>
						</li>
						<li class="nav-item">
							<a href="{{ route('adminOrders', ['type' => 'pending-payment']) }}" class="nav-link">Pending Orders</a>
						</li>
					</ul>
				</li>



			</ul>
		</div>
		<!-- /main navigation -->

	</div>
	<!-- /sidebar content -->

</div>
<!-- /main sidebar -->
