@extends('layouts.main',['app' => "warehouse"])

@section('title')
    Supplier - Pergudangan - Medify
@endsection

@section('sidebarcomponent')
    @include('warehouse.components.sidebar')
@endsection

@section('content')

    <div class="row page-title-container">
        <div class="icon">
            <i class="fa fa-truck"></i>
        </div>
        <div class="title">
            Supplier<br>
            <small>
                Daftar semua supplier
            </small>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="custom-search-input">
                                <div class="input-group col-md-12">
                                    <input type="text" class="form-control" id="searchBar" placeholder="Cari Supplier">
                                    <span class="input-group-btn">
                                        <button class="btn btn-info" type="button">
                                            <i class="fa fa-search" aria-hidden="true" id="searchButton" onclick="riset(0); search()"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="card-category" id="jumlahData">
                                Menampilkan 1-12 dari {{$count}} Supplier 
                            </div>
                        </div>
                        {{-- <div class="col-md-3">
                            <div class="form-horizontal">
                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-md-4 card-category">Halaman</label>
                                        <div class="col-md-5" style="padding-left: 3px !important;">
                                            <select name="labeling" id="labeling" class="form-control" onchange="changePage()">
                                                @php
                                                    $x = 1;
                                                    for($x = 1; $x <= ceil($count/12); $x++)
                                                    {
                                                        echo "<option value='".$x."'>".$x."</option>";
                                                    }
                                                @endphp
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                    <div class="hr-custom"></div>
                    <div class="row" id="hasilSearch">
                        @foreach($suppliers as $supplier)
                            <div class="col-md-3" style="margin-bottom: 25px;">
                                <a href="{{url('warehouse/supplier/'.$supplier->slug)}}">
                                <div class="card-custom card-inverse-custom card-info-custom">
                                    <img class="card-img-top-custom" src="@if($supplier->foto != null) {{asset($supplier->foto)}} @else {{asset('assets/app/Warehouse/supplier/no_image.png')}} @endif" onerror="imgError(this);" style="padding: 15px;">
                                    <div class="card-block-custom">
                                        <h4 class="card-title">@if(mb_strlen($supplier->nama) > 18 ) {{mb_substr($supplier->nama,0,18)."..."}} @else {{$supplier->nama}} @endif</h4>
                                        <p class="card-category">{{$supplier->jenis}}</p>
                                        <hr>
                                        <div class="meta card-text-custom">
                                            <i class="fa fa-map-marker" aria-hidden="true"></i> @if(mb_strlen($supplier->alamat) > 19 ) {{mb_substr($supplier->alamat,0,18)."..."}} @else {{$supplier->alamat}} @endif
                                        </div>
                                        <div class="card-text-custom">
                                            <i class="fa fa-phone text-muted"></i> {{$supplier->telepon}}
                                        </div>
                                    </div>
                                </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row" style="margin-top: 30px;">
                        <div class="col-md-4">
                            <div class="pull-right">
                                <button class="btn btn-default btn-page" id="buttonFirst" onclick="firstPage()" title="Awal">
                                    <i class="fa fa-angle-double-left" aria-hidden="true"></i>
                                </button>
                                <button class="btn btn-default btn-page" id="buttonPrev" onclick="previousPage()" title="Sebelumnya">
                                    <i class="fa fa-angle-left" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <center>
                                    <div class="dataTables_wrapper container-fluid dt-bootstrap4">
                                        <div class="dataTables_length">
                                            <label>Halaman 
                                                <select name="labeling" aria-controls="datatables" class="form-control form-control-sm" id="labeling" onchange="changePage()">
                                                    @php
                                                        $x = 1;
                                                        for($x = 1; $x <= ceil($count/12); $x++)
                                                        {
                                                            echo "<option value='".$x."'>".$x."</option>";
                                                        }
                                                    @endphp
                                                </select> Dari <span id="jumlahHalaman"> {{ceil($count/12)}}</span>
                                            </label>
                                        </div>
                                    </div> 
                                    </center>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="pull-left">
                                <button class="btn btn-default btn-page" id="buttonNext" onclick="nextPage()" title="Selanjutnya">
                                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                                </button>
                                <button class="btn btn-default btn-page" id="buttonLast" onclick="lastPage()" title="Akhir">
                                    <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <style type="text/css">
        /*html {
        font-family: Lato, 'Helvetica Neue', Arial, Helvetica, sans-serif;
        font-size: 14px;
        }*/

        .card label {
            font-size: 11px;
            margin-bottom: 0;
            text-transform: none;
        }

        h5 {
            font-size: 1.28571429em;
            font-weight: 700;
            line-height: 1.2857em;
            margin: 0;
        }

        .card-custom {
            font-size: 1em;
            overflow: hidden;
            padding: 0;
            border: none;
            border-radius: .28571429rem;
            box-shadow: 0 1px 3px 0 #d4d4d5, 0 0 0 1px #d4d4d5;
        }

        .card-block-custom {
            font-size: 1em;
            position: relative;
            margin: 0;
            padding: 1em;
            border: none;
            border-top: 1px solid rgba(34, 36, 38, .1);
            box-shadow: none;
        }

        .card-img-top-custom {
            display: block;
            width: 100%;
            height: 220px;
        }

        .card-title-custom {
            font-size: 1.28571429em;
            font-weight: 700;
            line-height: 1.2857em;
        }

        .card-text-custom {
            clear: both;
            margin-top: .5em;
            color: rgba(0, 0, 0, .68);
        }

        .card-footer-custom {
            font-size: 1em;
            position: static;
            top: 0;
            left: 0;
            max-width: 100%;
            padding: .75em 1em;
            color: rgba(0, 0, 0, .4);
            border-top: 1px solid rgba(0, 0, 0, .05) !important;
            background: #fff;
        }

        .card-inverse-custom .btn-custom {
            border: 1px solid rgba(0, 0, 0, .05);
        }

        .profile-custom {
            position: absolute;
            top: -12px;
            display: inline-block;
            overflow: hidden;
            box-sizing: border-box;
            width: 25px;
            height: 25px;
            margin: 0;
            border: 1px solid #fff;
            border-radius: 50%;
        }

        .profile-avatar-custom {
            display: block;
            width: 100%;
            height: auto;
            border-radius: 50%;
        }

        .profile-inline-custom {
            position: relative;
            top: 0;
            display: inline-block;
        }

        .profile-inline-custom ~ .card-title-custom {
            display: inline-block;
            margin-left: 4px;
            vertical-align: top;
        }

        .text-bold-custom {
            font-weight: 700;
        }

        #custom-search-input{
            padding: 3px;
            border: solid 1px #E4E4E4;
            border-radius: 6px;
            background-color: #fff;
        }

        #custom-search-input input{
            border: 0;
            box-shadow: none;
        }

        #custom-search-input button{
            margin: 2px 0 0 0;
            background: none;
            box-shadow: none;
            border: 0;
            color: #666666;
            padding: 0 8px 0 10px;
            /*border-left: solid 1px #ccc;*/
        }

        #custom-search-input button:hover{
            border: 0;
            box-shadow: none;
            border-left: solid 1px #ccc;
        }

        #custom-search-input .glyphicon-search{
            font-size: 23px;
        }

        input:focus {
            box-shadow: 0 0 5px rgba(81, 203, 238, 1);
            /*padding: 3px 0px 3px 3px;
            margin: 5px 1px 3px 0px;*/
            border: 1px solid rgba(81, 203, 238, 1);
        }

        .hr-custom {
            margin-top: 1rem; 
            margin-bottom: 1rem; 
            border: 0;
        }

        #loader-4 span{
          display: inline-block;
          width: 20px;
          height: 20px;
          border-radius: 100%;
          background-color: #3498db;
          margin: 35px 5px;
          opacity: 0;
        }

        #loader-4 span:nth-child(1){
          animation: opacitychange 1s ease-in-out infinite;
        }

        #loader-4 span:nth-child(2){
          animation: opacitychange 1s ease-in-out 0.33s infinite;
        }

        #loader-4 span:nth-child(3){
          animation: opacitychange 1s ease-in-out 0.66s infinite;
        }

        @keyframes opacitychange{
          0%, 100%{
            opacity: 0;
          }

          60%{
            opacity: 1;
          }
        }

        div.dataTables_wrapper div.dataTables_length label {
            font-weight: normal;
            text-align: left;
            white-space: nowrap;
        }

        .card label {
            font-size: 0.75rem;
            margin-bottom: 5px;
            text-transform: uppercase;
        }

        .input-group-sm>.input-group-btn>select.btn:not([size]):not([multiple]), .input-group-sm>select.form-control:not([size]):not([multiple]), .input-group-sm>select.input-group-addon:not([size]):not([multiple]), select.form-control-sm:not([size]):not([multiple]) {
            height: calc(1.9999rem + 2px);
        }

        div.dataTables_wrapper div.dataTables_length select {
            width: 75px;
            display: inline-block;
        }

        .btn.disabled, .btn:disabled {
            cursor: not-allowed;
            opacity: .40;
        }

        .btn-default.disabled, .btn-default:disabled {
            background-color: #888888 !important;
            border-color: #888888 !important;
        }
    </style>
@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready(function() {
            @if(session('status'))
                swal('Berhasil', '{{(session('status'))}}', 'success');
            @endif
            //swal("Berhasil Hapus!", "Data berhasil dihapus", "success");
            $("#searchBar").keyup(function(event) {
                if (event.keyCode === 13) {
                    $("#searchButton").click();
                }
            });

            $('#buttonFirst').attr('disabled', true);
            $('#buttonPrev').attr('disabled', true);
            $('#buttonLast').attr('disabled', false);
            $('#buttonNext').attr('disabled', false);
        });

        function imgError(image) {
            image.onerror = "";
            image.src = "https://cdn.browshot.com/static/images/not-found.png";
            // https://vignette.wikia.nocookie.net/simpsons/images/6/60/No_Image_Available.png/revision/latest?cb=20170219125728
            return true;
        }

        $(".btn-page").on("click", function() {
            $("html, body").scrollTop(0);
        });

        var currentPage = 0;
        var mode = 0;
        var dataperPage = 12;
        var jumlahData = "{{$count}}";
        var jumlahHalaman = Math.ceil(jumlahData/dataperPage);

        function search() {
            var str = "";
            mode = 1;
            var key = $('#searchBar').val();

            $.ajax({
                type:'GET',
                url:'{{url("warehouse/supplier/search")}}/' + key,
                dataType: 'json',
                beforeSend: function() {
                    console.log("loading...");
                    var loadingScreen = 
                        '<div class="loader center" id="loader-4" style="margin: 0 auto;">' +
                            '<span></span>' +
                            '<span></span>' +
                            '<span></span>' +
                        '</div>';
                    $('#hasilSearch').html(loadingScreen);
                },
                success:function(data){
                    data.data.forEach(function(item) {
                        console.log(item);
                    str += `<div class="col-md-3" style="margin-bottom: 25px;">
                            <a href="{{url('warehouse/supplier/`+item.slug+`')}}">
                            <div class="card-custom card-inverse-custom card-info-custom">
                                <img class="card-img-top-custom" src="` 
                                if(item.foto != null) str += `{{asset('`+item.foto+`')}}`;
                                else str += `assets/app/Warehouse/supplier/no_image.png'`; str+= `" style="padding: 15px;" onerror="imgError(this);">
                                <div class="card-block-custom">
                                    <h4 class="card-title">`+item.nama+`</h4>
                                    <p class="card-category">`+item.jenis+`</p>
                                    <hr>
                                    <div class="meta card-text-custom">
                                        <i class="fa fa-map-marker" aria-hidden="true"></i> `+item.alamat+`
                                    </div>
                                    <div class="card-text-custom">
                                        <i class="fa fa-phone text-muted"></i> `+item.telepon+`
                                    </div>
                                </div>
                            </div>
                            </a>
                        </div>`;
                        //console.log(item);
                    });

                    document.getElementById("hasilSearch").innerHTML = str;
                    navigate(0, data.count);
                    //$("#transaksiDetails").html(data.msg);
                },
                error:function(data){
                    console.log(data);
                }
            });
        }

        function loadPage(page) {
            var str = "";

            $.ajax({
                type:'GET',
                url:'{{url("warehouse/supplier/page")}}/' + page,
                dataType: 'json',
                beforeSend: function() {
                    //console.log("loading...");
                    var loadingScreen = 
                        '<div class="loader center" id="loader-4" style="margin: 0 auto;">' +
                            '<span></span>' +
                            '<span></span>' +
                            '<span></span>' +
                        '</div>';
                    $('#hasilSearch').html(loadingScreen);
                },
                success:function(data){
                    data.data.forEach(function(item) {
                        str += `<div class="col-md-3" style="margin-bottom: 25px;">
                            <a href="{{url('warehouse/supplier/`+item.slug+`')}}">
                                <div class="card-custom card-inverse-custom card-info-custom">
                                    <img class="card-img-top-custom" src="` 
                                    if(item.foto != null) str += `{{asset('`+item.foto+`')}}`;
                                    else str += `assets/app/Warehouse/supplier/no_image.png'`; str+= `" style="padding: 15px;" onerror="imgError(this);">
                                    <div class="card-block-custom">
                                        <h4 class="card-title">`+item.nama+`</h4>
                                        <p class="card-category">`+item.jenis+`</p>
                                        <hr>
                                        <div class="meta card-text-custom">
                                            <i class="fa fa-map-marker" aria-hidden="true"></i> `+item.alamat+`
                                        </div>
                                        <div class="card-text-custom">
                                            <i class="fa fa-phone text-muted"></i> `+item.telepon+`
                                        </div>
                                    </div>
                                </div>
                            </a>
                            </div>`;
                        //console.log(item);
                    });

                    document.getElementById("hasilSearch").innerHTML = str;
                    navigate(page, data.count);
                    //$("#transaksiDetails").html(data.msg);
                },
                error:function(data){
                    console.log(data);
                }
            });
        }

        function previousPage() {
            if(currentPage>0) currentPage--;

            if(mode) filterData(currentPage);
            else {
                loadPage(currentPage);
            }
            //searchCallback();
        };

        function nextPage() {
            if(currentPage < jumlahHalaman-1) currentPage++;

            if(mode) {
                filterData(currentPage);
            }
            else {
                loadPage(currentPage);
            }

            //console.log(currentPage);
            //searchCallback();
        };

        function lastPage() {
            currentPage = jumlahHalaman-1;

            if(mode) {
                filterData(currentPage);
            }
            else {
                loadPage(currentPage);
            }

            //console.log(currentPage);
            //searchCallback();
        };

        function firstPage() {
            currentPage = 0;

            if(mode) {
                filterData(currentPage);
            }
            else {
                loadPage(currentPage);
            }

            //console.log(currentPage);
            //searchCallback();
        };

        function changePage() {
            currentPage = $('#labeling').find(":selected").val()-1;
            //console.log(currentPage);
            if(mode) {
                filterData(currentPage);
            }
            else {
                loadPage(currentPage);
            }
        };

        function navigate(page, count) {
            jumlahData = count;
            var newJumlah = Math.ceil(count/dataperPage)
            if(jumlahHalaman != newJumlah){
                jumlahHalaman = newJumlah;
                $('#labeling').empty();
                var select = document.getElementById("labeling");

                for(var i = 1; i <= jumlahHalaman; i++) {
                    select.options.add(new Option(i, i));
                }
                document.getElementById("jumlahHalaman").innerHTML = jumlahHalaman;
            } 

            var head = page*dataperPage+1;
            var tail = (page+1)*dataperPage < count ? (page+1)*dataperPage : count;

            if(count) {
                if(page) var str = "Menampilkan "+head+"-"+tail+" dari "+count+" Supplier";
                else var str = "Menampilkan "+count+" Supplier";
            }
            else var str = "Tidak ditemukan Supplier yang sesuai";
            //console.log(jumlahHalaman);
            var hal = jumlahHalaman == 0 ? 1 : jumlahHalaman;
            //console.log(hal);
            //var int = page+"/"+hal;

            document.getElementById("jumlahData").innerHTML = str;
            //document.getElementById("jumlahHalaman").innerHTML = "<center>Halaman "+page+1+" dari "+jumlahHalaman+"</center>";
            $('#labeling').val(page);

            if(!page) {
                $('#buttonFirst').attr('disabled', true);
                $('#buttonPrev').attr('disabled', true);
                $('#buttonLast').attr('disabled', false);
                $('#buttonNext').attr('disabled', false);
            }
            else if(page+1 == jumlahHalaman) {
                $('#buttonFirst').attr('disabled', false);
                $('#buttonPrev').attr('disabled', false);
                $('#buttonLast').attr('disabled', true);
                $('#buttonNext').attr('disabled', true);
            }
            else {
                $('#buttonFirst').attr('disabled', false);
                $('#buttonPrev').attr('disabled', false);
                $('#buttonLast').attr('disabled', false);
                $('#buttonNext').attr('disabled', false);
            }
        }

        function riset(reset) {
            currentPage = 0;
            mode = 0;
            if(reset) loadPage(currentPage);
        };
    </script>
@endsection