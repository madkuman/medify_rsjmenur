<!doctype html>
<html lang="en" class="no-focus" ng-app="medifyApp">
<head>
    @include('layouts.components2.header')
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap-timepicker.min.css')}}">
    <style type="text/css">
        .modal-content {
            border-radius: 0;
        }
        .modal-full {
            min-width: 100%;
            margin: 0;
        }
        .modal-full .modal-content {
            min-height: 100vh;
        }
        #modal-large-pengaturan {
            padding-right: 0 !important;
            padding-left: 0 !important;
        }
    </style>
</head>
<body>
    {{-- @include('layouts.components2.svg') --}}
    <div id="page-container" class="page-header-fixed main-content-boxed">  
        @include('layouts.components2.navbar')
        <main id="main-container">
            <div class="content pt-20">
                <div class="row">
                    <div class="col-12">
                        @include('farmasi.layouts.components.sidebar-nav')
                        <div class="mg-t-20">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
            {{--
            // INI SIDEBAR BIASA
            <div class="content pt-20">
                <div class="row">
                    <div class="col-md-5 col-xl-3">
                        @include('farmasi.layouts.components.sidebar')
                    </div>
                    <div class="col-md-7 col-xl-9">
                        @yield('content')
                    </div>
                </div>
            </div>
            --}}
        </main>
    </div>

    @include('layouts.components2.js')
</body>
<script src="{{asset('assets/js/bootstrap-timepicker.min.js')}}"></script>
@include('farmasi.layouts.components.js')
</html>
