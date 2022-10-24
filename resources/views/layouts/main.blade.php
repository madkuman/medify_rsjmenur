<!doctype html>
	<html lang="en" ng-app="medifyApp">
	<head>
		@include('layouts.components.header')
		<title>@yield('title')</title>
	</head>

	<body>
		<div class="wrapper">
				@include('layouts.components.sidebar')
				{{-- @if($app == 'warehouse')
					@include('warehouse.components.sidebar')
				@elseif($app == 'radiology')
					@include('radiology.components.sidebar')
				@else
					@include('layouts.components.sidebar')
				@endif --}}
			
			<div class="main-panel">
				@include('layouts.components.navbar')
				<div class="content" id="main-content">
					<div class="container-fluid">
						<div class="row">
							<div class="col-md-12">
								@yield('content')
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
	
	@include('layouts.components.footer')
</html>