<!doctype html>
<html lang="en" class="no-focus" ng-app="medifyApp">
<head>
    @include('layouts.components2.header')
</head>
<body>
    {{-- @include('layouts.components2.svg') --}}
    <div id="page-container" class="page-header-fixed main-content-boxed">
        @include('layouts.components2.navbar')
        <main id="main-container">
            <div class="content pt-20">
                <div class="row">
                    <div class="col-xl-3 pr-0">
                        @include('kamarjenazah.layouts.navbar')
                    </div>
                    <div class="col-xl-9 pl-0">
                        @yield('content')
                    </div>
                </div>
            </div>
        </main>
    </div>

    @include('layouts.components2.js')
</body>
</html>
