
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Admin</title>
	<meta name="robots" content="noindex, nofollow">
    <base href="{{url("/")}}/">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" href="{{ltrim(mix('css/admin.css'), "/")}}">
</head>

<body>

	@include('admin.includes.topBar')


	<!-- Page content -->
	<div class="page-content" id="app">

		@includeWhen(Auth::guard('admin')->check(), 'admin.includes.navBar')


		<!-- Main content -->
		<div class="content-wrapper">
			
			@includeWhen(Auth::guard('admin')->check(), 'admin.includes.pageHeader')

			<!-- Content area -->
			<div class="content {{ isset($contentCenter) ? 'd-flex justify-content-center align-items-center' : '' }}">
				@yield('content')
			</div>
			<!-- /content area -->


			@include('includes.footer')

		</div>
		<!-- /main content -->

	</div>
	<!-- /page content -->

	<script src="{{ ltrim(mix('js/admin.js'), "/") }}"></script>

</body>
</html>
