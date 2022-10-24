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
                    <div class="col-md-5 col-xl-3">
                        @include('farmasi.layouts.components.sidebar2')
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
<script src="{{asset('assets/js/bootstrap-timepicker.min.js')}}"></script>
<script type="text/javascript">
    removeHarga();
    removeShift();

    $('.timepicker').timepicker({
        showInputs: false,
        showMeridian: false
    });

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

    $('#pengaturan').on('click', function(){
        $('#modal-large-pengaturan').modal('show');
    });

    $('#close').on('click', function(){
        $('#modal-large-pengaturan').modal('hide');
    });

    $('#btnAddHarga').on('click', function(){
        str = 
        `<div class="row item-wrapper">
            <div class="col-md-4">
                <div class="form-group">
                    <div>
                        <input type="number" class="form-control" name="harga_min[]" placeholder="Harga Minimal">
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <div>
                        <input type="number" class="form-control" name="harga_max[]" placeholder="Harga Maksimal">
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <div>
                        <input type="number" class="form-control" name="laba[]" placeholder="Laba" >
                    </div>
                </div>
            </div>
            <div class="col-md-1">
                <div class="form-group">
                    <button type="button" class="btn btn-lg btn-circle btn-outline-danger btnRemoveHarga">
                        <i class="fa fa-trash"></i>
                    </button>
                </div>
            </div>
        </div>`;
        $('#newHarga').append(str);
        removeHarga();
    });

    $('#btnAddShift').on('click', function(){
        str = 
        `<div class="row item-wrapper">
            <div class="col-md-4">
                <div class="form-group">
                    <div>
                        <input type="text" name="waktu_mulai[]" class="form-control timepicker" id="timepicker-1" placeholder="Waktu Mulai">
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <div>
                        <input type="text" class="form-control timepicker" name="waktu_selesai[]" placeholder="Waktu Selesai">
                    </div>
                </div>
            </div>
            <div class="col-md-1">
                <div class="form-group">
                    <button type="button" class="btn btn-lg btn-circle btn-outline-danger btnRemoveShift">
                        <i class="fa fa-trash"></i>
                    </button>
                </div>
            </div>
        </div>`;
        $('#newShift').append(str);
        removeShift();

        $('.timepicker').timepicker({
            showInputs: false,
            showMeridian: false
        });
    });

    function removeHarga() {
        $('.btnRemoveHarga').on('click', function(){
            var wrapper = $(this).parents('.item-wrapper');
            wrapper.remove();
        });
    }

    function removeShift() {
        $('.btnRemoveShift').on('click', function(){
            var wrapper = $(this).parents('.item-wrapper');
            wrapper.remove();
        });
    }
</script>
</html>
