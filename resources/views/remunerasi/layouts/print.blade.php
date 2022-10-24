<!DOCTYPE html>
<html lang="en" ng-app="medifyApp">
<head>
	<title>@yield('title')</title>
	<style type="text/css">
	table, th, td {
		border: 1px solid black;
		border-collapse: collapse;
	}
	th, td {
		padding: 15px;
	}
</style>
	@yield('css')
</head>
<body>
	@yield('main-content')
</body>
</html>