<!-- Page header -->
<div class="page-header page-header-light">
	<div class="page-header-content header-elements-md-inline">
		<div class="page-title d-flex">
			<h4>{{ $heading ?? ''}}</h4>
		</div>
	</div>
	
	@isset($breadcrumb)
	<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
		<div class="d-flex">
			<div class="breadcrumb">
				<a href="{{ route('admin.index') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
				@foreach($breadcrumb as $item)
                    @isset($item['route'])
                        <a href="{{ route($item['route']) }}" class="breadcrumb-item">{{ $item['label'] }}</a>
                    @else
                        <span class="breadcrumb-item active">{{ $item['label'] }}</span>
                    @endisset
                @endforeach
			</div>
		</div>
	</div>
	@endif
</div>
<!-- /page header -->