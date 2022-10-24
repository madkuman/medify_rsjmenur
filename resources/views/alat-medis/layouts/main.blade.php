<!doctype html>
<html lang="en" class="no-focus" ng-app="medifyApp">
<head>
    @include('alat-medis.layouts.components.header')
    @include('layouts.components2.header')
</head>
<body>
<div id="page-container" class="page-header-fixed main-content-boxed">
    @include('layouts.components2.navbar')
    <main id="main-container">
        <div class="content pt-20">
            <div class="row">
                <div class="col-md-5 col-xl-3">
                    @include('alat-medis.layouts.components.sidebar')
                </div>
                <div class="col-md-7 col-xl-9">
                    {{--@include('aset.layouts.flash')--}}
                    @yield('content')
                </div>
            </div>
        </div>
    </main>
</div>

@include('alat-medis.layouts.components.js')
@include('alat-medis.layouts.components.footer')
</body>
</html>
