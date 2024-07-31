<!doctype html>
<html lang="en" class="no-focus">

<head>
	@include('layouts.components2.header')
</head>

<body>
	<div class="container-fluid pt-10">
		<div class="block">
			<div class="block-header">
				<h3 class="block-title">@yield('page-title')
				</h3>
			</div>
			@yield('content')
		</div>
	</div>

	@include('layouts.components2.footer')
	@include('layouts.components2.js')
</body>

</html>