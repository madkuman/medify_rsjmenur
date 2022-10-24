<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="description" content="The HTML5 Herald">
	<meta name="author" content="SitePoint">

	<title>@yield('title')</title>

	<style type="text/css">
	h1,h2,h3,h4,h5,h6
	{
		margin:2px;
	}
	.text-center
	{
		text-align: center;
	}
	.text-uppercase
	{
		text-transform: uppercase;
	}
	.text-bold
	{
		font-weight: 700;
	}
	
	p {
		font-family: "Arial";
		font-size: 16px;
		margin: 0;
	}
	.text-size-14
	{
		font-size: 14px;
	}
	small
	{
		font-size: 60%;
		letter-spacing: 1px;
	}
	.text-capitalize
	{
		text-transform: capitalize;
	}
	.text-uppercase
	{
		text-transform: uppercase;
	}
</style>
@yield('css')

</head>

<body>
	@yield('content')

	@yield('scripts')
</body>

</html>