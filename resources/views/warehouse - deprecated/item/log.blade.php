@extends('layouts.main', ['app' => "warehouse"])

@section('title')
Mutasi Barang - Pergudangan - Medify
@endsection

@section('sidebarcomponent')
    @include('warehouse.components.sidebar')
@endsection

@section('content')

<div class="row page-title-container">
    <div class="icon">
        <i class="fa fa-exchange"></i>
    </div>
    <div class="title">
        Rekap Mutasi Barang<br>
        <small>
            Barang Masuk dan Keluar
        </small>
    </div>
</div>
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="row">
    <div class="col-md-3">
        <form method="POST" action="#">
            <div class="card stacked-form">
                <div class="card-header ">
                    <h4 class="card-title">Filter Data</h4>
                </div>
                <div class="card-body ">
                    <div class="form-group has-label">
                        <label><strong>Jenis Transaksi</strong></label>
                        <select class="selectpicker" id="jenisTransaksi" onchange="changeClient()" data-style="btn-default btn-outline" data-width="100%" >
                            <option value="">Semua</option>
                            <option value="1">Masuk</option>
                            <option value="-1">Keluar</option>
                        </select>
                    </div>
                    <div class="form-group has-label">
                        <label><strong>Tanggal</strong></label>
                        <input type="text" class="form-control datepicker" id="tanggalAwal" placeholder="Isikan Tanggal Awal" />
                        <input type="text" class="form-control datepicker" id="tanggalAkhir" placeholder="Isikan Tanggal Akhir" style="margin-top:5px" />
                    </div>
                    <div class="form-group has-label">
                        <label><strong>Jumlah</strong></label>
                        <input type="number" id="jumlahMin" class="form-control" placeholder="Minimum">
                        <input type="number" id="jumlahMax" class="form-control" placeholder="Maksimum" style="margin-top:5px">
                    </div>
                    <div class="form-group has-label" id="listSeller">
                        <label><strong>Asal Barang</strong></label>
                        <select class="selectpicker" data-live-search="true" id="asalBarang" data-style="btn-default btn-outline" data-width="100%">
                            <option value="">Semua</option>
                            @foreach($supplier as $supp)
                                <option value="{{$supp->id}}">{{$supp->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group has-label" id="listBuyer">
                        <label><strong>Tujuan Barang</strong></label>
                        <select class="selectpicker" data-live-search="true" id="tujuanBarang" data-style="btn-default btn-outline" data-width="100%">
                            <option value="">Semua</option>
                            @foreach($apotek as $appo)
                                <option value="{{$appo->id}}">{{$appo->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group has-label">
                        <label><strong>Barang</strong></label>
                        <select class="selectpicker" id="namaBarang" data-live-search="true" data-style="btn-default btn-outline" data-width="100%">
                            <option value="">Semua</option>
                            @foreach($barang as $bar)
                                <option value="{{$bar->id}}">{{$bar->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="pull-right">
                        <button class="btn btn-default" type="reset" onclick="riset(1)">
                            <i class="fa fa-refresh" aria-hidden="true"></i> Reset
                        </button>   
                        <span>&nbsp;</span>
                        <button class="btn btn-primary pull-right" type="button" onclick="riset(0); filterData(0)">
                            <i class="fa fa-filter" aria-hidden="true"></i> Filter
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="col-md-9 col-sm-7">
        <div class="card main-content transaction-index">
            <div class="card-header ">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="card-category" id="jumlahData">Menampilkan 1-20 dari {{$count}} Barang </div>
                    </div>
                </div>  
            </div>
            <div class="card-body table-full-width inventory">
                <table class="table">
                    <thead>
                        <tr class="header">
                            <th>#</th>
                            <th>Nama Barang</th>
                            <th>Asal/Tujuan</th>
                            <th>Jumlah</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody id="hasilSearch">
                        @foreach($log as $row)
                        @if($row->transaction_detail->type == 1)
                            <tr class="log-items clickable-row" data-href="{{url('warehouse/pengadaan/'.$row->transaction_detail->slug)}}">
                        @else
                            <tr class="log-items clickable-row" data-href="{{url('warehouse/transaction/'.$row->transaction_detail->slug)}}">
                        @endif
                            @if($row->transaction_id)
                                <td>                        
                                    @if($row->transaction_detail->type == 1)
                                        <span class="in"><i class="fa fa-share" rel="tooltip" data-original-title="Transaksi Masuk"></i> </span>
                                    @else
                                        <span class="out"><i class="fa fa-reply"  rel="tooltip" data-original-title="Transaksi Keluar"></i> </span>
                                    @endif
                                </td>
                                <td>
                                    @if($row->item_detail != null)
                                    {{$row->item_detail->name}}
                                    @else -
                                    @endif
                                </td>
                                <td>
                                    @if($row->transaction_detail->type == 1)
                                        {{$row->transaction_detail->seller_detail->nama}}
                                    @else
                                        @if($row->transaction_detail->buyer_detail != null)
                                            {{$row->transaction_detail->buyer_detail->nama}}
                                        @else
                                            -
                                        @endif
                                    @endif
                                </td>
                                <td>{{$row->qty}}</td>
                                <td>{{ date('d F Y, H:i', strtotime($row->created_at)) }}</td>
                            @else
                                <td>                        
                                    <span class="in"><i class="fa fa-share" rel="tooltip" data-original-title="Transaksi Masuk"></i> </span>
                                </td>
                                <td>
                                    @if($row->item_detail != null)
                                    {{$row->item_detail->name}}
                                    @else -
                                    @endif
                                </td>
                                <td>
                                    Awal barang masuk
                                </td>
                                <td>{{$row->qty}}</td>
                                <td>{{ date('F d, H:i', strtotime($row->created_at)) }}</td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="row" style="margin-top: 30px;">
                    <div class="col-md-3">
                        <div class="pull-right">
                            <button class="btn btn-default btn-page" id="buttonFirst" onclick="firstPage()" title="Awal">
                                <i class="fa fa-angle-double-left" aria-hidden="true"></i>
                            </button>
                            <button class="btn btn-default btn-page" id="buttonPrev" onclick="previousPage()" title="Sebelumnya">
                                <i class="fa fa-angle-left" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">
                                <center>
                                <div class="dataTables_wrapper container-fluid dt-bootstrap4">
                                    <div class="dataTables_length">
                                        <label>Halaman 
                                            <select name="labeling" aria-controls="datatables" class="form-control form-control-sm" id="labeling" onchange="changePage()">
                                                @php
                                                    $x = 1;
                                                    for($x = 1; $x <= ceil($count/20); $x++)
                                                    {
                                                        echo "<option value='".$x."'>".$x."</option>";
                                                    }
                                                @endphp
                                            </select> Dari <span id="jumlahHalaman"> {{ceil($count/20)}}</span>
                                        </label>
                                    </div>
                                </div> 
                                </center>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
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
        /*.form-group {
            margin-bottom: 5px;
        }*/

        .card label {
            font-size: 11px;
            margin-bottom: 0;
            text-transform: none;
        }

        .form-control {
            background-color: #FFFFFF;
            border: 1px solid #E3E3E3;
            border-radius: 4px;
            font-size: 12px;
            color: #565656;
            padding: 8px 12px;
            height: 30px;
            -webkit-box-shadow: none;
            box-shadow: none;
        }

        .btn {
            /*border-width: 2px;*/
            /*background-color: transparent;*/
            font-weight: 400;
            padding: 8px 16px;
            /*border: 1px solid #888888;*/
            /*color: #FFFFFF;*/
            /*background-color: #888888;*/
            cursor: pointer;
            /*margin-bottom: 5px;*/
            font-size: 12px;
            line-height: 1.42857143;
        }

        .btn-size {
            /*border-width: 2px;*/
            /*background-color: transparent;*/
            font-weight: 400;
            padding: 8px 16px;
            /*border: 1px solid #888888;*/
            /*color: #FFFFFF;*/
            /*background-color: #888888;*/
            cursor: pointer;
            /*margin-bottom: 5px;*/
            font-size: 0.875rem;
            line-height: 1.42857143;
        }

        .card .card-body .control-label {
            text-align: left;
            padding-top: 18px;
        }

        .inventory .log-items .in i {
            background-color: #447DF7;
        }

        .inventory .log-items .out i {
            background-color: #ff0000;
        }

        .inventory .log-items .in i, .inventory .log-items .out i {
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            margin-right: 10px;
            width: 30px;
            padding: 7px;
            color: #FFFFFF;
            border-radius: .25rem;
        }

        .hidden {
            display: none;
        }

        .bootstrap-select.btn-group .dropdown-menu.inner {
            max-height: 200px !important;
        }

        /*.btn-size {
            font-size: 0.875rem;
        }

        .btn {
            font-size: 12px;
        }*/

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
    <script src="//cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>
    
    <script type="text/javascript">
        $(document).ready(function() {
            $(document).on('click', '.clickable-row', function (){
                //console.log("masuq");
                window.location = $(this).data("href");    
            })
            @if(session('status')) {
                swal('Berhasil', '{{(session('status'))}}', 'success');
            }
            @endif

            $('#buttonFirst').attr('disabled', true);
            $('#buttonPrev').attr('disabled', true);
            $('#buttonLast').attr('disabled', false);
            $('#buttonNext').attr('disabled', false);

            $('#listBuyer').hide();
            $('#listSeller').hide();
        });

        $(".btn-page").on("click", function() {
            $("html, body").scrollTop(0);
        });

        $('.datepicker').datetimepicker({
            format: 'MM/DD/YYYY',
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-chevron-up",
                down: "fa fa-chevron-down",
                previous: 'fa fa-chevron-left',
                next: 'fa fa-chevron-right',
                today: 'fa fa-screenshot',
                clear: 'fa fa-trash',
                close: 'fa fa-remove'
            }
        });

        var currentPage = 0;
        var mode = 0;
        var dataperPage = 20;
        var clint = 0;
        var jumlahData = "{{$count}}";
        var jumlahHalaman = Math.ceil(jumlahData/dataperPage);

        function filterData(page) {
            mode = 1;
            var str = "";

            var jenis = $('#jenisTransaksi').find(":selected").val();
            if(clint == 1) var client = $('#asalBarang').find(":selected").val();
            else if(clint == -1) var client = $('#tujuanBarang').find(":selected").val();
            var barang = $('#namaBarang').find(":selected").val();
            var min_qty = $('#jumlahMin').val();
            var max_qty = $('#jumlahMax').val();
            var min_date = $('#tanggalAwal').val();
            var max_date = $('#tanggalAkhir').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type:'POST',
                url:'{{url("warehouse/log/filter")}}/' + page,
                data: {client:client, jenis:jenis, barang:barang, min_qty:min_qty, max_qty:max_qty, min_date:min_date, max_date:max_date},
                dataType:'json',
                beforeSend: function() {
                    console.log("loading...");
                    var loadingScreen = 
                        '<tr style="text-align: center;">' +
                            '<td></td>' +
                            '<td colspan="5">' +
                                '<div class="loader" id="loader-4">' +
                                    '<span></span>' +
                                    '<span></span>' +
                                    '<span></span>' +
                                '</div>' +
                            '</td>' +
                            '<td></td>' +
                            '<td></td>' +
                            '<td></td>' +
                        '</tr>';
                    $('#hasilSearch').html(loadingScreen);
                },
                success:function(data){
                    console.log(data.data);
                    data.data.forEach(function(item) {
                        var date = new Date(item.created_at);
                        if (item.transaction_detail.type == 1)
                            str += `<tr class="log-items clickable-row" data-href="{{url('warehouse/pengadaan/`+item.transaction_detail.slug+`')}}">`;
                        else str += `<tr class="log-items clickable-row" data-href="{{url('warehouse/transaction/`+item.transaction_detail.slug+`')}}">`;
                            if(item.transaction_id) {
                                str += `<td>`;
                                    if(item.transaction_detail.type == 1)
                                        str += `<span class="in"><i class="fa fa-share" rel="tooltip" data-original-title="Transaksi Masuk"></i> </span>`;
                                    else
                                        str += `<span class="out"><i class="fa fa-reply"  rel="tooltip" data-original-title="Transaksi Keluar"></i> </span>`;
                                str += `</td>
                                <td>`
                                    if(item.item_detail != null)
                                    str += item.item_detail.name;
                                    else str += `-`
                                str += `</td>
                                <td>`
                                    if(item.transaction_detail.type == 1)
                                    str += item.transaction_detail.seller_detail.nama;
                                    else str += item.transaction_detail.buyer_detail.nama;
                                str += `</td>
                                <td>`+item.qty+`</td>
                                <td>`+formatDate(date)+`</td>`;
                            }
                            else {
                                str += `<td>                        
                                    <span class="in"><i class="fa fa-share" rel="tooltip" data-original-title="Transaksi Masuk"></i> </span>
                                </td>
                                <td>`;
                                    if(item.item_detail != null)
                                    str += item.item_detail.name;
                                    else str += `-`;
                                str += `</td>
                                <td>
                                    Awal barang masuk
                                </td>
                                <td>`+item.qty+`</td>
                                <td>`+formatDate(date)+`</td>`;  
                            }
                              
                        str += `</tr>`;
                        console.log(item);
                    });

                    document.getElementById("hasilSearch").innerHTML = str;
                    navigate(page, data.count);
                    //$("#transaksiDetails").html(data.msg);
                },
                error:function(data){
                    console.log(data);
                }
            });
        };

        function loadPage(page) {
            var str = "";

            $.ajax({
                type:'GET',
                url:'{{url("warehouse/log/page")}}/' + page,
                dataType: 'json',
                beforeSend: function() {
                    console.log("loading...");
                    var loadingScreen = 
                        '<tr style="text-align: center;">' +
                            '<td></td>' +
                            '<td colspan="5">' +
                                '<div class="loader" id="loader-4">' +
                                    '<span></span>' +
                                    '<span></span>' +
                                    '<span></span>' +
                                '</div>' +
                            '</td>' +
                            '<td></td>' +
                            '<td></td>' +
                            '<td></td>' +
                        '</tr>';
                    $('#hasilSearch').html(loadingScreen);
                },
                success:function(data){
                    data.data.forEach(function(item) {
                        var date = new Date(item.created_at);
                            if (item.transaction_detail.type == 1)
                                str += `<tr class="log-items clickable-row" data-href="{{url('warehouse/pengadaan/`+item.transaction_detail.slug+`')}}">`;
                            else str += `<tr class="log-items clickable-row" data-href="{{url('warehouse/transaction/`+item.transaction_detail.slug+`')}}">`;
                            if(item.transaction_id) {
                                str += `<td>`;
                                    if(item.transaction_detail.type == 1)
                                        str += `<span class="in"><i class="fa fa-share" rel="tooltip" data-original-title="Transaksi Masuk"></i> </span>`;
                                    else
                                        str += `<span class="out"><i class="fa fa-reply"  rel="tooltip" data-original-title="Transaksi Keluar"></i> </span>`;
                                str += `</td>
                                <td>`
                                    if(item.item_detail != null)
                                    str += item.item_detail.name;
                                    else str += `-`
                                str += `</td>
                                <td>`
                                    if(item.transaction_detail.type == 1)
                                    str += item.transaction_detail.seller_detail.nama;
                                    else str += item.transaction_detail.buyer_detail.nama;
                                str += `</td>
                                <td>`+item.qty+`</td>
                                <td>`+formatDate(date)+`</td>`;
                            }
                            else {
                                str += `<td>                        
                                    <span class="in"><i class="fa fa-share" rel="tooltip" data-original-title="Transaksi Masuk"></i> </span>
                                </td>
                                <td>`;
                                    if(item.item_detail != null)
                                        str += item.item_detail.name;
                                    else str += `-`;
                                str += `</td>
                                <td>
                                  Awal barang masuk
                                </td>
                                <td>`+item.qty+`</td>
                                <td>`+formatDate(date)+`</td>`;  
                            }
                              
                        str += `</tr>`;
                        console.log(item);
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

        function changeClient() {
            var jenis = $('#jenisTransaksi').find(":selected").val();
            //console.log(currentPage);
            if(jenis == 1) {
                $('#listBuyer').hide();
                $('#listSeller').show();
                clint = 1;
            }
            else if(jenis == -1){
                $('#listBuyer').show();
                $('#listSeller').hide();
                clint = -1;
            }
            else{
                $('#listBuyer').hide();
                $('#listSeller').hide();
                clint = 0;
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
            if(count) var str = "Menampilkan "+head+"-"+tail+" dari "+count+" Transaksi";
            else var str = "Tidak ditemukan mutasi barang yang sesuai";

            document.getElementById("jumlahData").innerHTML = str;
            //document.getElementById("jumlahHalaman").innerHTML = "<center>Halaman "+(page+1)+" dari "+jumlahHalaman+"</center>";
            $('#labeling').val(page+1);

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