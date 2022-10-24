<!doctype html>
<html lang="en" class="no-focus" ng-app="medifyApp">
<head>
	@include('layouts.components2.header')
</head>
<body>
	<!-- @include('layouts.components2.svg') -->
	<div style="position: fixed; top:100px; left: 48%; z-index: 2000; display: none" id="loading-top">
		<i class="fa fa-4x fa-asterisk fa-spin text-info"></i>
	</div>
	
	<div id="page-container" class="sidebar-o page-header-fixed  side-scroll main-content-boxed">
		@yield('content')
	</div>
	@include('layouts.components2.footer')
	@include('layouts.components2.js')
</body>
</html>
