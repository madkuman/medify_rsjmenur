<!doctype html>
<html lang="en" class="no-focus">
<head>
	@include('layouts.components2.header')
</head>
<body>
	<div id="page-container" class="page-header-fixed main-content-boxed"> 
		@include('layouts.components2.navbar') 
		<main id="main-container">
			@include('pasien.layouts.navbar')
			<div class="container">
				<div class="block p-10">
					<div class="block-header">
						<h3 class="block-title">@yield('page-title')
						</h3>
					</div>
					@yield('content')
				</div>
			</div>
		</main>
	</div>

	@include('layouts.components2.footer')
	@include('layouts.components2.js')
</body>
</html>
