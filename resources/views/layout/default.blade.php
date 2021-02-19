<!doctype html>
<html>
<head>
	<title>{{ $heading }} - Bitsnpixs</title>
    <meta name="robots" content="noindex, nofollow">
    <base href="{{url("/")}}/">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" href="{{ltrim(mix('css/app.css'), "/")}}">

</head>
<body>
    @include('includes.header')
    
    @isset($heading)
    <div class="page-header border-bottom bg-white">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex pt-3 pb-3">
                <h1 class="font-weight-semibold">{{ $heading }}</h1>
            </div>
            
            @isset($breadcrumb)
                <div class="header-elements d-none py-0 mb-3 mb-md-0">
                    <div class="breadcrumb">
                        <a href="{{ route('index') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                        @foreach($breadcrumb as $item)
                            @isset($item['route'])
                                <a href="{{ route($item['route']) }}" class="breadcrumb-item">{{ $item['label'] }}</a>
                            @else
                                <span class="breadcrumb-item active">{{ $item['label'] }}</span>
                            @endisset
                        @endforeach
                    </div>
                </div>
            @endisset
        </div>
    </div>
    @endisset
    
    <!-- Page content -->
    <div class="page-content">

        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Content area -->
            <div class="content">
                @yield("content")
            </div>
        </div>
    </div>
    <!-- Page content -->
    
    @include('includes.footer')

	<script src="{{ltrim(mix('js/app.js'), "/")}}"></script>
</body>
</html>