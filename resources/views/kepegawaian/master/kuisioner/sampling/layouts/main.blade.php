<!doctype html>
<html lang="en" class="no-focus">
<head>
	@include('layouts.components2.header')
</head>
<body>
	<div id="page-container" class="page-header-fixed main-content-boxed">  
		@include('layouts.components2.navbar')
		<main id="main-container">
			<div class="row">
				<div class="col-12">
					<div class="block" style="background-color: #FCFCFD">
						<div class="block-content container pb-5">
							<h4>
								<span class="text-muted font-w400" style="text-transform: capitalize">{{$kuisioner->nama ?? 'Kuisioner'}}</span>
							</h4>
						</div>
					</div>
				</div>
				<div class="col-12">
					<div class="container">
						@yield('content')
					</div>
				</div>
			</div>
		</main>
	</div>
	
	@include('layouts.components2.footer')
	@include('layouts.components2.js')
</body>
</html>
