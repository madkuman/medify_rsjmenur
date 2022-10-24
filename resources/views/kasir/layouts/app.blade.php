<!doctype html>
<html lang="en" class="no-focus" ng-app="medifyApp">
<head>
    @include('layouts.components2.header')
</head>
<body>
    <div id="page-container" class="page-header-fixed main-content-boxed">  
        <main id="main-container">
            @include('layouts.components2.navbar')
            <div class="content pt-20">
                <div class="row">
                    <div class="col-md-12 col-xl-12">
                        @yield('content')
                    </div>
                </div>
            </div>
        </main>
    </div>

    @include('layouts.components2.js')
</body>
</html>
