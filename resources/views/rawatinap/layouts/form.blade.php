<!doctype html>
<html lang="en" class="no-focus" ng-app="medifyApp">
<head>
    @include('layouts.components2.header')
</head>
<body>
<div id="page-container" class="page-header-fixed main-content-boxed">
    <div id="page-overlay" onclick="closeNav()"></div>
    @include('layouts.components2.navbar')
    @include('layouts.components2.sidebar')
    <main id="main-container" class="gizi">
        <div class="overlap-content">
            @yield('content')
        </div>
    </main>
</div>

@include('layouts.components2.js')
@yield('additionaljs')
</body>
</html>
