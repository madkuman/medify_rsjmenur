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
                    <div class="col-md-5 col-xl-3">
                        @include('warehouse.layouts.components.sidebar')
                    </div>
                    <div class="col-md-7 col-xl-9">
                        @yield('content')
                    </div>
                </div>
            </div>
        </main>
    </div>

    @include('layouts.components2.js')
</body>
<script type="text/javascript">
    function formatMoney(money) {
        return 'Rp. '+money.toLocaleString();
    }

    function formatTime(date) {
        dates = new Date(date);
        var monthNames = [
            "January", "February", "March",
            "April", "May", "June", "July",
            "August", "September", "October",
            "November", "December"
        ];

        var day = dates.getDate();
        var monthIndex = dates.getMonth();
        var year = dates.getFullYear();
        var hours = dates.getHours();
        var min = dates.getMinutes();

        return day + ' ' + monthNames[monthIndex] + ' ' + year + ', ' + hours + ':' + min;
    }

    function formatDate(date) {
        dates = new Date(date);
        var monthNames = [
            "January", "February", "March",
            "April", "May", "June", "July",
            "August", "September", "October",
            "November", "December"
        ];

        var day = dates.getDate();
        var monthIndex = dates.getMonth();
        var year = dates.getFullYear();

        return day + ' ' + monthNames[monthIndex] + ' ' + year;
    }
    
</script>
</html>
