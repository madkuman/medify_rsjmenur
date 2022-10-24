<!doctype html>
<html lang="en" class="no-focus">
<head>
	@include('layouts.components2.header')
</head>
<body>
	<div id="page-container" class="page-header-fixed main-content-boxed mb-30">
		@include('layouts.components2.navbar')
		<main id="main-container">
			@yield('content')
		</main>
	</div>

	@include('layouts.components2.footer')
	@include('layouts.components2.js')
</body>
</html>
