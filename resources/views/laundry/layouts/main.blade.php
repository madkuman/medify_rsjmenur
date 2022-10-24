<!doctype html>
<html lang="en" class="no-focus" ng-app="medifyApp">
<head>
    @include('layouts.components2.header')
</head>
<body>
    <div id="page-container" class="page-header-fixed main-content-boxed">
    @include('layouts.components2.navbar')
        <main id="main-container">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                    @include('laundry.layouts.components.navbar')
                    </div>
                    <div class="col-md-2 pr-0" >
                    @yield('sidebar')
                    </div>
                    <div class="col-md-10">
                    @yield('content')
                    </div>
                </div>
            </div>
        </main>
    </div>
    <div style="margin-bottom:50px;"></div>
    @include('layouts.components2.footer')
	@include('layouts.components2.js')
	@yield('js')
</body>
</html>
