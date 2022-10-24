@extends('layouts.main', ['app' => "warehouse"])

@section('title')
Transaksi - Pergudangan - Medify
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
        Rekap Transaksi<br>
        <small>
            Barang Keluar
        </small>
    </div>
</div>
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="row">
    <div class="col-md-3">
        <form>
            <div class="card stacked-form">
                <div class="card-header ">
                    <h4 class="card-title">Filter Data</h4>
                </div>
                <div class="card-body ">
                    <div class="form-group has-label">
                        <label><strong>Tanggal</strong></label>
                        <input type="text" class="form-control datepicker" id="tanggalAwal" placeholder="Isikan Tanggal Awal" />
                        <input type="text" class="form-control datepicker" id="tanggalAkhir" placeholder="Isikan Tanggal Akhir" style="margin-top:5px" />
                    </div>
                    {{-- <div class="form-group">
                        <label><strong>Harga</strong></label>
                        <input type="text" id="minimal-price" class="form-control" placeholder="Minimal">
                        <input type="hidden" id="hargaMin">
                        <input type="text" id="maximal-price" class="form-control" placeholder="Maksimal" style="margin-top:5px">
                        <input type="hidden" id="hargaMax">
                    </div> --}}
                    <div class="form-group has-label">
                        <label><strong>Tujuan Barang</strong></label>
                        <select class="selectpicker" data-live-search="true" id="asalBarang" data-style="btn-default btn-outline" data-width="100%">
                            <option value="">Semua</option>
                            @foreach($apotek as $supp)
                                <option value="{{$supp->id}}">{{$supp->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input name="tolak" class="form-check-input" id="checkbox1" type="checkbox">
                            <span class="form-check-sign"></span>
                            <strong>Transaksi tertolak</strong>
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input name="terima" class="form-check-input" id="checkbox2" type="checkbox" checked>
                            <span class="form-check-sign"></span>
                            <strong>Transaksi diterima</strong>
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input name="belum" class="form-check-input" id="checkbox3" type="checkbox" checked>
                            <span class="form-check-sign"></span>
                            <strong>Transaksi belum diverifikasi</strong>
                        </label>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="pull-right">
                        <button class="btn btn-default" type="reset" onclick="riset(1)">
                            <i class="fa fa-refresh" aria-hidden="true"></i> Reset
                        </button>   
                        <span>&nbsp;</span>
                        <button class="btn btn-primary pull-right" onclick="riset(0); filterData(0)">
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
                {{-- <a href="{{url('warehouse/transaction/new')}}" class="btn btn-fill btn-size btn-round btn-primary pull-right"><i class="fa fa-plus"></i> Tambah Transaksi Baru</a> --}}
                <h4 class="card-title">Rekap Transaksi</h4>
                <p class="card-category">Daftar semua transaksi yang pernah dilakukan</p>
                <br>
                <div class="row">
                    <div class="col-sm-8">
                        <div class="card-category" id="jumlahData">Menampilkan 1-20 dari {{$count}} Transaksi </div>     
                    </div>
                    {{-- <div class="col-sm-4">
                        <div class="form-horizontal">
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-md-4 card-category">Halaman</label>
                                    <div class="col-md-5" style="padding-left: 3px !important;">
                                        <select name="labeling" class="form-control labeling" onchange="changePage()">
                                            @php
                                                $x = 1;
                                                for($x = 1; $x <= ceil($count/20); $x++)
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
            </div>
            <div class="card-body table-full-width inventory">
                <table class="table">
                    <thead>
                        <tr class="header">
                            <th>#</th>
                            <th>Tujuan</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Keterangan</th>
                            {{-- <th>Actions</th> --}}
                        </tr>
                    </thead>
                    <tbody id="hasilSearch">                        
                        @foreach($transactions as $transaction)
                            @if($transaction->status != 0)
                            <tr class="transaction clickable-row" data-href="{{url('warehouse/transaction/'.$transaction->slug)}}">
                            @else
                            <tr class="unread transaction clickable-row" data-href="{{url('warehouse/transaction/'.$transaction->slug)}}">
                            @endif
                            <td>
                                <span class="out"><i class="fa fa-reply"  rel="tooltip" data-original-title="Transaksi Keluar"></i> </span>
                            </td>
                            <td>
                                @if($transaction->buyer_detail != null)
                                    {{$transaction->buyer_detail->nama}}
                                @else
                                    -
                                @endif
                            </td>
                            <td>{{ date('d F Y, H:i', strtotime($transaction->created_at)) }}</td>
                            <td>
                                @if($transaction->status == 0)
                                    Menunggu Konfirmasi
                                @elseif($transaction->status == 1)
                                    Barang Telah Dikirim
                                @else
                                    Transaksi Ditolak   
                                @endif
                            </td>
                            <td>
                                @if($transaction->description != null)
                                    {{$transaction->description}}
                                @else
                                    -
                                @endif
                            </td>
                        </tr>                    
                        @endforeach
                    </tbody>
                </table>
                <div class="row" style="margin-top: 30px;">
                    <div class="col-md-3">
                        <div class="pull-right">
                            <button class="btn btn-default  btn-page" id="buttonFirst" onclick="firstPage()" title="Awal">
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
                                            </select> Dari <span id="jumlahHalaman">{{ceil($count/20)}}</span>
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

        .bootstrap-select.btn-group .dropdown-menu.inner {
            max-height: 200px !important;
        }

        .hidden {
            display: none;
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
    <script src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>
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
        });

        $(".btn-page").on("click", function() {
            $("html, body").scrollTop(0);
        });

        $('#minimal-price').inputmask("numeric", {
            radixPoint: ",",
            groupSeparator: ",",
            //digits: 2,
            autoGroup: true,
            //prefix: 'Rp. ', //No Space, this will truncate the first character
            rightAlign: false,
            //oncleared: function () { self.Value(''); }
        });

        $("#minimal-price").keyup(function() {
            var price = document.getElementById("minimal-price").value;
            var priceReplace = price.split('.').join('');
            document.getElementById("hargaMin").value = priceReplace;
            //console.log(priceReplace);
        });

        $('#maximal-price').inputmask("numeric", {
            radixPoint: ",",
            groupSeparator: ",",
            //digits: 2,
            autoGroup: true,
            //prefix: 'Rp. ', //No Space, this will truncate the first character
            rightAlign: false,
            //oncleared: function () { self.Value(''); }
        });

        $("#maximal-price").keyup(function() {
            var price = document.getElementById("maximal-price").value;
            var priceReplace = price.split('.').join('');
            document.getElementById("hargaMax").value = priceReplace;
            //console.log(priceReplace);
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
        var jumlahData = "{{$count}}";
        var jumlahHalaman = Math.ceil(jumlahData/dataperPage);

        function changeCategory() {
            var type = $('#jenisTransaksi').val();
            var select = document.getElementById("kategori");

            if(type == 1) {
                select.options[1] = null;    
                select.options.add(new Option("Beli", "Beli"));
                select.options.add(new Option("Retur", "Retur"));
            } else if (type == -1){
                select.options[1] = null;
                select.options[1] = null;
                select.options.add(new Option("Permintaan", "Permintaan", true));
            } else {
                select.options[1] = null;
                select.options[1] = null;
            }

            $('.selectpicker').selectpicker('refresh');
            //document.getElementById("kategori").innerHTML = str;
        }

        function filterData(page) {
            mode = 1;
          var str = "";
          var status = "";
          var numb = "";

          var jenis = $('#jenisTransaksi').find(":selected").val();
          var supplier = $('#asalBarang').find(":selected").val();
          var kategori = $('#kategori').find(":selected").val();
          //var min_price = $('#hargaMin').val();
          //var max_price = $('#hargaMax').val();
          var min_date = $('#tanggalAwal').val();
          var max_date = $('#tanggalAkhir').val();
          var tertolak = $('#checkbox1').is(":checked");
          var diterima = $('#checkbox2').is(":checked");
          var belum = $('#checkbox3').is(":checked");

          if (tertolak) {
            if(diterima && belum) {
                status = 0;
            } else if(diterima) {
                status = "!=";
                numb = 0;
            } else if(belum) {
                status = "!=";
                numb = 1;
            } else {
                status = "=";
                numb = 2;
            }
          } else {
            if(diterima && belum) {
                status = 1;
            } else if(diterima) {
                status = "=";
                numb = 1;
            } else if(belum) {
                status = "=";
                numb = 0;
            } else {
                
            }
          }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type:'POST',
                url:'{{url("warehouse/transaction/filter")}}/' + page,
                data: {apotek:supplier, jenis:jenis, kategori:kategori, min_date:min_date, max_date:max_date, status:status, numb:numb},
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
                        if(item.status != 0) str += `<tr class="transaction clickable-row" data-href="{{url('warehouse/transaction/`+item.slug+`')}}"><td>`;
                        else str += `<tr class="unread transaction clickable-row" data-href="{{url('warehouse/transaction/`+item.slug+`')}}"><td>`;
                        if(item.type == 1) str += `<span class="in"><i class="fa fa-share" rel="tooltip" data-original-title="Transaksi Masuk"></i> </span>`;
                        else str += `<span class="out"><i class="fa fa-reply"  rel="tooltip" data-original-title="Transaksi Keluar"></i> </span>`;                            
                        str += `</td>
                            <td>`;
                                if(item.buyer_detail != null) str+= item.buyer_detail.nama; 
                                else str += "-";
                            str += `</td>
                            <td>`+formatDate(date)+`</td>
                            <td>`;
                                if(item.status == 0) str += `Menunggu Konfirmasi`;
                                else if(item.status == 1) str += `Barang Telah Dikirim`;
                                else str += `Transaksi Ditolak`;
                            str+= `</td>
                            <td>`; 
                            if(item.status != 2) {
                                if(item.description!= null) str += item.description;    
                            }
                            else {
                                str += `(tertolak) ` + item.explanation;
                            }

                            str += `</td>
                        </tr>`;

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
                url:'{{url("warehouse/transaction/page")}}/' + page,
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
                        if(item.status != 0) str += `<tr class="transaction clickable-row" data-href="{{url('warehouse/transaction/`+item.slug+`')}}"><td>`;
                        else str += `<tr class="unread transaction clickable-row" data-href="{{url('warehouse/transaction/`+item.slug+`')}}"><td>`;
                        if(item.type == 1) str += `<span class="in"><i class="fa fa-share" rel="tooltip" data-original-title="Transaksi Masuk"></i> </span>`;
                        else str += `<span class="out"><i class="fa fa-reply"  rel="tooltip" data-original-title="Transaksi Keluar"></i> </span>`;                            
                        str += `</td>
                            <td>`;
                                if(item.client_detail != null) str+= item.client_detail.nama; 
                                else str += "-";
                            str += `</td>
                            <td>`+formatDate(date)+`</td>
                            <td>Rp. `; if(item.total_price!= null) str+= formatMoney(item.total_price); else str += 0; 
                            str+= `</td>
                            <td>`; if(item.description!= null) str += item.description; 
                            str += `</td>
                        </tr>`;

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
            if(currentPage > 0) currentPage--;

            if(mode) filterData(currentPage);
            else {
                loadPage(currentPage);
            }
            //searchCallback();
        };

        function nextPage() {
            $("body").scrollTop(0);

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
            if(count) var str = "Menampilkan "+head+"-"+tail+" dari "+count+" Transaksi";
            else var str = "Tidak ditemukan transaksi yang sesuai";

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