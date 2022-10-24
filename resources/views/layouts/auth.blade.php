<!doctype html>
<html lang="en" ng-app="medifyApp">
<head>
	@include('layouts.components2.header')
	<title>@yield('title')</title>
</head>
<body>
	@yield('content')
</body>
@include('layouts.components2.js')
</html>