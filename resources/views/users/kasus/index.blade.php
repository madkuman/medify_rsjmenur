@extends('layouts.main2')

@section('title')
    Arsip Kasus
@endsection

@section('css')
    <style>
        .containers {
            display: block;
            position: relative;
            padding-left: 25px;
            margin-bottom: 12px;
            cursor: pointer;
            font-size: 20px;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        /* Hide the browser's default checkbox */
        .containers input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
            height: 0;
            width: 0;
        }

        /* Create a custom checkbox */
        .checkmark {
            position: absolute;
            top: 6px;
            left: 0;
            height: 20px;
            width: 20px;
            background-color: #eee;
        }

        /* On mouse-over, add a grey background color */
        .containers:hover input ~ .checkmark {
            background-color: #ccc;
        }

        /* When the checkbox is checked, add a blue background */
        .containers input:checked ~ .checkmark {
            background-color: #2196F3;
        }

        /* Create the checkmark/indicator (hidden when not checked) */
        .checkmark:after {
            content: "";
            position: absolute;
            display: none;
        }

        /* Show the checkmark when checked */
        .containers input:checked ~ .checkmark:after {
            display: block;
        }
        .containers .checkmark:after {
            left: 9px;
            top: 5px;
            width: 5px;
            height: 10px;
            border: solid white;
            border-width: 0 3px 3px 0;
            -webkit-transform: rotate(45deg);
            -ms-transform: rotate(45deg);
            transform: rotate(45deg);
        }
    </style>
@endsection

@section('content')

    <!-- Main Container -->
    <main id="main-container">
        <div class="content">
            <div class="row">
                <div class="col-xl-12">
                    <h5 class="text-uppercase text-muted">Arsip Kasus Saya</h5>
                    <div class="row justify-content-around">
                        <div class="col-lg-12 col-12">
                            <div class="block rounded main-content transaction-index col-12 ">
                                <div class="block-header">
                                    <h3 class="block-title"><i class="fa fa-search fa-6" aria-hidden="true"></i> Filter</h3>
                                </div>
                                <div class="block-content">
                                    <form action="" autocomplete="off">
                                        <div class="row">
                                            <div class="col-5">
                                                <div class="form-group">
                                                    <label for="inputName">No. RM</label>
                                                    <input type="text" class="form-control" id="no_rm" name="no_rm">
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-12">Tipe Kasus</label>
                                                    <div class="col-12">
                                                        <div class="custom-control custom-checkbox custom-control-inline mb-5">
                                                            <input class="custom-control-input" type="checkbox" name="Ranap" id="ranap" value="1">
                                                            <label class="custom-control-label" for="ranap">Ranap</label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox custom-control-inline mb-5">
                                                            <input class="custom-control-input" type="checkbox" name="rajal" id="rajal" value="1">
                                                            <label class="custom-control-label" for="rajal">Rajal</label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox custom-control-inline mb-5">
                                                            <input class="custom-control-input" type="checkbox" name="igd" id="igd" value="1">
                                                            <label class="custom-control-label" for="igd">IGD</label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox custom-control-inline mb-5">
                                                            <input class="custom-control-input" type="checkbox" name="medical_checkup" id="medical_checkup" value="1">
                                                            <label class="custom-control-label" for="medical_checkup">Medical Checkup</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="">Tanggal MRS (maksimal 1 bulan)</label>
                                                    <div class="input-daterange input-group" data-date-format="dd/mm/yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                                                        <input autocomplete="off" type="text" class="form-control" id="tanggal_mrs_min" data-date-format="dd/mm/yyyy" name="example-daterange1" placeholder="From" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                                                        <div class="input-group-prepend input-group-append">
                                                            <span class="input-group-text font-w600">to</span>
                                                        </div>
                                                        <input autocomplete="off" type="text" class="form-control" id="tanggal_mrs_max" data-date-format="dd/mm/yyyy" name="example-daterange2" placeholder="To" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Tanggal KRS (maksimal 1 bulan)</label>
                                                    <div class="input-daterange input-group" data-date-format="dd/mm/yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                                                        <input autocomplete="off" type="text" class="form-control" id="tanggal_krs_min" data-date-format="dd/mm/yyyy" name="example-daterange1" placeholder="From" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                                                        <div class="input-group-prepend input-group-append">
                                                            <span class="input-group-text font-w600">to</span>
                                                        </div>
                                                        <input autocomplete="off" type="text" class="form-control" id="tanggal_krs_max" data-date-format="dd/mm/yyyy" name="example-daterange2" placeholder="To" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <label for="lokasi">Lokasi</label>
                                                    <select class="form-control js-select2" name="lokasi" id="lokasi">
                                                        <option value="">Semua</option>
                                                        @foreach ($lokasi as $item)
                                                            <option value="{{$item->id}}">{{$item->nama}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group d-none" id="group-tipe-lokasi">
                                                    <label for="lokasi">Tipe Lokasi</label>
                                                    <select class="form-control js-select2" name="tipe_lokasi" id="tipe_lokasi" style="width: 249px;">
                                                        <option value="">Pernah Berkunjung/Menempati</option>
                                                        <option value="1">Lokasi Akhir</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <div class="row">
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <label for="ranap" class="containers">Ranap
                                                        <input type="checkbox" value="1" id="ranap" name="ranap">
                                                        <span class="checkmark"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <label class="containers">Rajal
                                                        <input type="checkbox" value="1" id="rajal" name="rajal">
                                                        <span class="checkmark"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <label class="containers">IGD
                                                        <input type="checkbox" value="1" id="igd" name="igd">
                                                        <span class="checkmark"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <label class="containers">Medical Checkup
                                                        <input type="checkbox" value="1" id="medical_checkup" name="medical_checkup">
                                                        <span class="checkmark"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div> -->
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="block kasus-list">
                                <div class="block-content">
                                    <div class="px-15" style="display: inline-block; width: 100%">
                                        <button type="btn" class="btn btn-primary pull-right" onclick="download();">Download</button>
                                    </div>
                                    <table class="table table-bordered table-striped table-vcenter js-dataTable-full" id="tabelArsipKasus">
                                        <thead>
                                        <tr>
                                            <th width="5%">No</th>
                                            <th class="text-center" width="10%">No. RM</th>
                                            <th class="text-center">Nama Pasien</th>
                                            <th class="text-center">Jenis Kelamin</th>
                                            <th class="text-center">Usia</th>
                                            <th class="text-center">Lokasi</th>
                                            <th class="text-center">Tanggal KRS</th>
                                            <th width="15%">Aksi</th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('js')


    <script type="text/javascript">
        var page = 1;
        $("#tanggal_krs_min").datepicker({
            format: 'dd/mm/yyyy',
            autoclose: true,
        }).on('changeDate', function (selected) {
            var startDate = new Date(selected.date.valueOf());
            startDate.setMonth(startDate.getMonth()+1);
            $('#tanggal_krs_max').datepicker('setEndDate', startDate);
        }).on('clearDate', function (selected) {
            $('#tanggal_krs_max').datepicker('setEndDate', null);
        });

        $("#tanggal_krs_max").datepicker({
            format: 'dd/mm/yyyy',
            autoclose: true,
        }).on('changeDate', function (selected) {
            var endDate = new Date(selected.date.valueOf());
            endDate.setMonth(endDate.getMonth()-1);
            $('#tanggal_krs_min').datepicker('setStartDate', endDate);
        }).on('clearDate', function (selected) {
            $('#tanggal_krs_min').datepicker('setStartDate', null);
        });

        $("#tanggal_mrs_min").datepicker({
            format: 'dd/mm/yyyy',
            autoclose: true,
        }).on('changeDate', function (selected) {
            var startDate = new Date(selected.date.valueOf());
            startDate.setMonth(startDate.getMonth()+1);
            $('#tanggal_mrs_max').datepicker('setEndDate', startDate);
        }).on('clearDate', function (selected) {
            $('#tanggal_mrs_max').datepicker('setEndDate', null);
        });

        $("#tanggal_mrs_max").datepicker({
            format: 'dd/mm/yyyy',
            autoclose: true,
        }).on('changeDate', function (selected) {
            var endDate = new Date(selected.date.valueOf());
            endDate.setMonth(endDate.getMonth()-1);
            $('#tanggal_mrs_min').datepicker('setStartDate', endDate);
        }).on('clearDate', function (selected) {
            $('#tanggal_mrs_min').datepicker('setStartDate', null);
        });

        // FOR ENDLESS SCROLL
        // $(document).ready(function(){
        //     loadMoreData(page);
        // });
        // $(window).scroll(function() {
        //     if($(window).scrollTop() + $(window).height() >= $(document).height()) {
        //         page++;
        //         loadMoreData(page);
        //     }
        // });
        $('#ranap').on('change', function() {
            table.draw();
        })
        $('#rajal').on('change', function() {
            table.draw();
        })
        $('#igd').on('change', function() {
            table.draw();
        })
        $('#medical_checkup').on('change', function() {
            table.draw();
        })
        $('#lokasi').on('change', function() {
            if($('#lokasi').val() != ''){
                $('#group-tipe-lokasi').removeClass('d-none');
            }else{
                $('#tipe_lokasi').val('').trigger('change');
                $('#group-tipe-lokasi').addClass('d-none');
            }
            table.draw();
        })
        $('#tipe_lokasi').on('change', function() {
            if ($('#lokasi').val()) {
                table.draw();
            }
        })
        $('#no_rm').on('keyup', function() {
            table.draw();
        })
        $("#tanggal_krs_min").on('change', function(){
            // FOR ENDLESS SCROLL
            // page = 1;
            // loadFilterChange(page); *for endless scroll*
            table.draw();
        });
        $("#tanggal_krs_max").on('change', function(){
            // FOR ENDLESS SCROLL
            // page = 1;
            // loadFilterChange(page); *for endless scroll*
            table.draw();
        });
        $("#tanggal_mrs_min").on('change', function(){
            table.draw();
        });
        $("#tanggal_mrs_max").on('change', function(){
            table.draw();
        });
        // FOR ENDLESS SCROLL
        // $(document).on('click', '#search_button', function() {
        //     page = 1;
        //     loadFilterChange(page);
        // })
        // $("#search_box").keyup(function(e){
        //     if ( e.keyCode === 13 ) {
        //         page = 1;
        //         loadFilterChange(page);
        //     }
        // });


        function loadMoreData(page){
            var data = [];
            data.keyword = $("#search_box").val();
            data.tanggal_min = $("#tanggal_krs_min").datepicker('getFormattedDate');
            data.tanggal_max = $("#tanggal_krs_max").datepicker('getFormattedDate');

            $.ajax({
                url: API_URL + '/arsip-kasus?page=' + page,
                type: "POST",
                dataType: 'json',
                data:
                    {
                        'keyword' : data.keyword,
                        'tanggal_min' : data.tanggal_min,
                        'tanggal_max' : data.tanggal_max
                    },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function()
                {
                    $('.ajax-load').show();
                }
            }).done(function(data)
            {
                if(data.html == ""){
                    var empty_records = `<div></div>`;
                    // $('.ajax-load').html("No more records found");
                    $('.ajax-load').html(empty_records);
                    return;
                }
                $('.ajax-load').hide();
                $('.list').append(data.html);
            }).fail(function(jqXHR, ajaxOptions, thrownError)
            {
                alert('server not responding...');
                $('.ajax-load').hide();
            });
        }
        function loadFilterChange(page){
            var data = [];
            data.keyword = $("#search_box").val();
            data.tanggal_min = $("#tanggal_krs_min").datepicker('getFormattedDate');
            data.tanggal_max = $("#tanggal_krs_max").datepicker('getFormattedDate');

            $.ajax({
                url: API_URL + '/arsip-kasus?page=' + page,
                type: "POST",
                dataType: 'json',
                data:
                    {
                        'keyword' : data.keyword,
                        'tanggal_min' : data.tanggal_krs_min,
                        'tanggal_max' : data.tanggal_krs_max
                    },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function()
                {
                    $('.list').empty();
                    $('.ajax-load').show();
                }
            }).done(function(data)
            {
                $('.ajax-load').hide();
                $('.list').append(data.html);
            }).fail(function(jqXHR, ajaxOptions, thrownError)
            {
                alert('server not responding...');
                $('.ajax-load').hide();
            });
        }

    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            table.draw();
        });

        var table = $('#tabelArsipKasus').DataTable({
            "ordering": true,
            pageLength: 8,
            lengthMenu: [[5, 8, 15, 20], [5, 8, 15, 20]],
            autoWidth: false,
            searching: false,
            processing: true,
            serverSide: true,
            language: {
                processing: '<div class="panel panel-default"><i class="fa fa-4x fa-gear fa-spin text-info"></i></div>'
            },
            ajax: {
                type: "POST",
                dataType: "json",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: API_URL + '/arsip-kasus/load-table',
                data: {
                    tanggal_krs_min : function() {
                        return $('#tanggal_krs_min').datepicker('getFormattedDate');
                    },
                    tanggal_krs_max : function() {
                        return $('#tanggal_krs_max').datepicker('getFormattedDate');
                    },
                    tanggal_mrs_min : function() {
                        return $('#tanggal_mrs_min').datepicker('getFormattedDate');
                    },
                    tanggal_mrs_max : function() {
                        return $('#tanggal_mrs_max').datepicker('getFormattedDate');
                    },
                    ranap : function(){
                        return $('#ranap:checked').val();
                    },
                    rajal : function(){
                        return $('#rajal:checked').val();
                    },
                    igd : function(){
                        return $('#igd:checked').val();
                    },
                    medical_checkup : function(){
                        return $('#medical_checkup:checked').val();
                    },
                    lokasi : function() {
                        return $('#lokasi').val();
                    },
                    tipe_lokasi : function() {
                        return $('#tipe_lokasi').val();
                    },
                    no_rm : function() {
                        return $('#no_rm').val();
                    }
                }
            },
            columns: [
                { data: 'id', name: 'id', className: 'text-center',
                    render: function(data, type, row, meta){
                        return meta.row + meta.settings._iDisplayStart + 1;}
                },
                { data: 'pasien.no_rm', name: 'no_rm' },
                { data: 'pasien.name', name: 'name' },
                { data: function(data){
                        if (data.pasien.gender == 1) {
                            var laki = 'Laki - Laki';
                            return laki;
                        }
                        if(data.pasien.gender == 2){
                            return perempuan = 'Perempuan';
                        }
                        if (data.pasien.gender == 0) {
                            return kosong = '-';
                        }
                    }, name: 'name' },
                { data: 'pasien.age', name: 'usia' },
                { data: function(data){
                        var lokasi = data.lokasi.lokasi;
                        return lokasi.nama;
                    }, name: 'lokasi' },
                { data: 'format_krs', name: 'krs' },
                { data : 'nomor_kasus', name : 'nomor_kasus', className: 'text-center',
                    render: function(data) {
                        content = `<a class="btn btn-outline-primary btn-sm mr-5 mb-5" href="{{url('kasus')}}/`+data+`"><i class="fa fa-pencil"></i> Lihat Kasus</a>`;
                        return content;
                    },
                    searchable: false,
                    sortable: false
                },
            ],
            order: [[ 0, "asc" ]],
        });

        function download(){
            var krs_min = $('#tanggal_krs_min').datepicker('getFormattedDate');
            var krs_max = $('#tanggal_krs_max').datepicker('getFormattedDate');
            var mrs_min = $('#tanggal_mrs_min').datepicker('getFormattedDate');
            var mrs_max = $('#tanggal_mrs_max').datepicker('getFormattedDate');
            var ranap = $('#ranap:checked').val() ?? '';
            var rajal = $('#rajal:checked').val() ?? '';
            var igd = $('#igd:checked').val() ?? '';
            var medical_checkup = $('#medical_checkup:checked').val() ?? '';
            var lokasi = $('#lokasi').val();
            var tipe_lokasi = $('#tipe_lokasi').val();
            var no_rm = $('#no_rm').val();
            var url = `{{url()->current()}}/download?tanggal_krs_min=${krs_min}&tanggal_krs_max=${krs_max}&tanggal_mrs_min=${mrs_min}&tanggal_mrs_max=${mrs_max}&ranap=${ranap}&rajal=${rajal}&igd=${igd}&medical_checkup=${medical_checkup}&lokasi=${lokasi}&tipe_lokasi=${tipe_lokasi}&no_rm=${no_rm}`;
            window.open(url);
        }

    </script>
@endsection
