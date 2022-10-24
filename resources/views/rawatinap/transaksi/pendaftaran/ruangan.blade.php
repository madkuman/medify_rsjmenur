@extends('rawatinap.layouts.main')

@section('title')
Pendaftaran Pasien ke Rawat Inap - Medify
@endsection

@section('subtitle')
Pendaftaran Pasien ke Rawat Inap
@endsection

@section('content')
<main id="main-container">
    @include('rawatinap.layouts.navbar')
    <div class="container">

        <div class="row">
            <div class="col-xl-3">
                <div class="block">
                    <div class="block-header block-header-default">
                        <h5 class="block-title">Informasi Pasien</h5>
                    </div>
                    <div class="block-content">
                        <h5>{{$pasien->name}}
                            <small><br>
                                {{$pasien->age}} tahun <br> {{$pasien->address}} <br> 
                                @if(!empty($kasus->pembayaran->kelas))
                                <span class="text-primary">KELAS : {{$kasus->pembayaran->kelas->nama}}</span>
                                @endif
                            </small>
                        </h5>
                    </div>
                </div>
                <div class="block">
                    <div class="block-header block-header-default">
                        <h5 class="block-title">Filter</h5>
                    </div>
                    <div class="block-content pb-20">
                        <h6>RUANGAN</h6>
                        <div class="row">
                            <div class="col-12">
                                <select id="bangsalMulti" class="js-select2 filter-option" name="filter_bangsal[]" multiple="multiple" style="width: 100%;">
                                    @foreach($bangsal as $item)
                                    <option value="{{$item->id}}">{{$item->nama}} (@if(!empty($item->bed_kosong))
                                            {{$item->bed_kosong}} 
                                            @else
                                            0
                                            @endif)</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <hr>
                        <h6>KELAS PERAWATAN</h6>
                        @foreach($kelas as $item)
                        <div class="custom-control custom-checkbox mb-5">
                            <input class="custom-control-input filter-option" type="checkbox" name="filter_kelas[]" id="kelas_{{$item->id}}"  value="{{$item->id}}" 
                                @if(!empty($kasus->pembayaran->kelas))
                                    @if($kasus->pembayaran->kelas->id == $item->id) checked @endif >
                                @endif
                            <label class="custom-control-label" for="kelas_{{$item->id}}">
                                Kelas {{$item->nama}}
                            </label>
                        </div>
                        @endforeach
                        <!-- <button type="button" class="btn btn-primary btn-block mt-20" onclick="loadData()">Filter</button> -->

                    </div>
                </div>
            </div>
            <div class="col-xl-9">
                <div class="block main-content transaction-index"  ng-controller="PasienController">
                    <div class="block-content text-center">
                        <h3 class="mb-5">Pendaftaran Pasien @if($is_bayi) Bayi @endif ke Rawat Inap @if($is_intensif) (Intensif) @endif</h3>
                        <h5 class="text-muted font-w400">Pilih ruangan untuk pasien yang akan didaftarkan</h5>
                    </div>

                    <div id="noResult" style="display: none">
                        <div class="text-center py-50">
                            Ruangan tidak ditemukan. Silahkan coba dengan filter lainnya
                        </div>
                    </div>

                    <div class="table-full-width spinner-container" id="pasienResult" style="overflow: auto;"> 
                        <div class="spinner-back">
                            <table class="table table-striped table-hover table-pointer "> 
                                <thead>
                                    <tr class="header" ng-click="getCurrentPage()">
                                        <th>#</th>
                                        <th>Bangsal</th>
                                        <th>Ruang</th>
                                        <th>Bed</th>
                                        <th>Nama Pasien</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="spinner-back-placeholder">
                                    @for ($i = 0; $i < 10; $i++)
                                    <tr> 
                                        <td class="py-10 px-10"><div class=" bg-primary-lighter">&nbsp;</div></td>
                                        <td class="py-10 px-10"><div class=" bg-primary-lighter">&nbsp;</div></td>
                                        <td class="py-10 px-10"><div class=" bg-primary-lighter">&nbsp;</div></td>
                                        <td class="py-10 px-10"><div class=" bg-primary-lighter">&nbsp;</div></td>
                                        <td class="py-10 px-10"><div class=" bg-primary-lighter">&nbsp;</div></td>
                                        <td class="py-10 px-10"><div class=" bg-primary-lighter">&nbsp;</div></td>
                                    </tr>
                                    @endfor
                                </tbody>
                                <tbody id="renderResult"></tbody>
                            </table> 
                        </div>

                        <div class="spinner">
                            <td colspan="6"><i class="fa fa-4x fa-asterisk fa-spin text-info"></i></td>
                        </div>

                        <div class="flex-center" style="">
                            <ul id="pagination" class="pagination"></ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection


@section('angular')
<script type="text/javascript">
    $('.js-select2').select2();



    var total_pages = 1;
    var visible_pages = 5;
    var keyword = '';
    var items_show = 10;
    var firstLoadPagination = false;

    loadData();

    function loadPagination(currentPage = 1)
    {

        $('#pagination').twbsPagination('destroy');
        $('#pagination').twbsPagination({
            totalPages: total_pages,
            startPage: currentPage,
            visiblePages: visible_pages,
            initiateStartPageClick: false,
            onPageClick: function (event, page) {
                loadData(page,keyword);
            }
        });
        firstLoadPagination = true;
    }
    function reloadPagination(currentPage)
    {
        var defaultOpts = {
            totalPages: 20
        };
        $('#pagination').twbsPagination($.extend({}, defaultOpts, {
            startPage: currentPage,
            totalPages: total_pages
        }));
    }


    function loadData(currentPage=1,keyword='')
    {
        var data = [];

        data.filter_kelas = [];
        data.filter_bangsal = $("#bangsalMulti").val();

        $('input[name^="filter_kelas"]:checked').each(function() {
           data.filter_kelas.push($(this).val());
        });
        console.log(data.filter_kelas);
        console.log(data.filter_bangsal);
        /*
        $('input[name^="filter_bangsal"]').each(function() {
            data.filter_bangsal.push($(this).val());
        });
        console.log(filter_bangsal);
        */
        $('.spinner').fadeIn();
        $('#noResult').hide();
        $('#pasienResult').show();
        $('#renderResult').hide();
        $('.spinner-back-placeholder').show();
        console.log(data);

        $.ajax({
            url: API_URL + '/rawatinap/tempattidur/kosong?page='+ currentPage,
            type: 'POST',
            dataType: 'json',
            data : {
                    'filter_kelas' : data.filter_kelas,
                    'filter_bangsal' : data.filter_bangsal,
                    'transaksi_id' : {{$transaksi}}
                },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                if(data.total>0)
                {
                    $('#noResult').hide();
                    $('#pasienResult').show();
                    total_pages = Math.ceil(data.total/items_show);
                    var template = $('#template-pasienlist').html();
                    loadMustache(template);
                    var rendered = Mustache.render(template, data);
                    $('.spinner').fadeOut();
                    $('#renderResult').show();
                    $('#renderResult').html(rendered);
                    $('.spinner-back-placeholder').hide();
                    loadPagination(currentPage);
                }
                else
                {
                    $('.spinner').fadeOut();
                    $('#noResult').fadeIn();
                    $('#pasienResult').hide();
                    $('.spinner-back-placeholder').hide();
                }
            },
            error: function() {
                alert('error');
            },
        });
    }

    function loadMustache(template) {
        Mustache.parse(template, customTags);
        Mustache.tags = customTags;
    }

    $('#pasienSearchForm').submit(function( event ) {
        event.preventDefault();

        keyword = $('#pasienSearch').val();
        console.log(keyword);
        loadData(1,keyword);
    });

    $('.filter-option').change(function(){
        loadData();
    });
</script>

<script id="template-pasienlist" type="x-tmpl-mustache">

    @{{#data}}
    <tr> 
        <td>@{{id}}</td>
        <td>@{{ruangan.bangsal.nama}}</td>
        <td>@{{ruangan.nama}}</td>
        <td>@{{nama}}</td>
        @{{#transaksi_id}}
            <td>@{{transaksi.pasien.name}}</td>
            <td>
                <form method="POST" action="{{url('rawatinap/transaksi/pendaftaran/konfirmasi')}}">
                    {{csrf_field()}}
                    <input type="hidden" value="{{$transaksi}}" name="transaksi_id">
                    <input type="hidden" value="@{{id}}" name="bed_id">
                    <input type="hidden" value="1" name="is_booking">
                    <input type="hidden" value="{{$nomor_kasus}}" name="nomor_kasus">
                    <button class="btn btn-warning btn-click-animate" type="submit">Booking</button>
                </form>
            </td>
            </tr>    
        @{{/transaksi_id}}
        @{{^transaksi_id}}
        <td>-</td>
        <td>
            <form method="POST" action="{{url('rawatinap/transaksi/pendaftaran/konfirmasi')}}">
                {{csrf_field()}}
                <input type="hidden" value="{{$transaksi}}" name="transaksi_id">
                <input type="hidden" value="@{{id}}" name="bed_id">
                <input type="hidden" value="0" name="is_booking">
                <input type="hidden" value="{{$nomor_kasus}}" name="nomor_kasus">
                <button class="btn btn-primary btn-click-animate" type="submit">Daftarkan</button>
            </form>
        </td>
        </tr>
        @{{/transaksi_id}}
    @{{/data}}
</script>
@endsection