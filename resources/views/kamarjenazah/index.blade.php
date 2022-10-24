@extends('kamarjenazah.layouts.main')

@section('title')
Kamar Jenazah - Medify
@endsection

@section('toprightmenu')
+ Permintaan Jemput Jenazah
@endsection

@section('url')
{{url('kamarjenazah/permintaan_jemput')}}
@endsection

@section('subtitle')
Dashboard
@endsection

@section('css')
<style type="text/css">
    .block-content {
        padding-bottom: 18px;
    }
</style>
@endsection

@section('content')
    <div class="container">
      <div class="row row-deck">
        <div class="col-sm-4" style="max-height: 200px; padding-right: 0px;">
            <div class="block col-sm-12 mb-0">
                <div class="block-content">
                    <div class="text-right text-primary display-4 font-w600">{{$totalPermintaan[0]}}</div>
                    <div class="font-size-sm font-w600 text-uppercase text-right">total permintaan jemput</div>
                </div>
            </div>
        </div>
        <div class="col-sm-4" style="max-height: 200px; padding-right: 0px;">
            <div class="block col-sm-12 mb-0">
                <div class="block-content">
                    <div class="text-right text-primary display-4 font-w600">{{$permintaanBaruCount[0]}}</div>
                    <div class="font-size-sm font-w600 text-uppercase text-right">permintaan hari ini</div>
                </div>
            </div>
        </div>
          <div class="col-sm-4" style="max-height: 200px;">
            <div class="block col-sm-12 mb-0">
                <div class="block-content">
                    <div class="text-right text-primary display-4 font-w600">{{$totalTransaksi}}</div>
                    <div class="font-size-sm font-w600 text-uppercase text-right">total transaksi</div>
                </div>
            </div>
          </div>
    </div>
        <div class="row row-deck mt-10">
            <div class="col-sm-12">
                <div class="block rounded main-content transaction-index"  ng-controller="PasienController">
                    <div class="block-header">
                        <h3 class="block-title">Daftar Permintaan Jemput Jenazah</h3>
                    </div>

                    <div id="noResult" style="display: none">
                        <div class="text-center py-50">
                            Permintaan tidak ditemukan. Silahkan coba dengan kata kunci lainnya <br>
                            Atau anda bisa menambah daftar jenazah<br><br>
                            <a href="{{url('kamarjenazah/permintaan_jemput')}}"> <button class="btn btn-outline-primary">+ Permintaan jemput jenazah</button> </a>
                        </div>
                    </div>

                    <div class="table-full-width spinner-container" id="jenazahResult">
                        <div class="spinner-back">
                            <table class="tr1 table table-striped table-hover table-pointer">
                                <thead>
                                    <tr class="header" ng-click="getCurrentPage()">
                                        <th style="width:8%">No RM </th>
                                        <th style="width:20%">Nama</th>
                                        <th style="width:14%">Lokasi Meninggal</th>
                                        <th style="width:24%">Waktu Meninggal</th>
                                        <th style="width:24%">Permintaan Waktu Jemput</th>
                                    </tr>
                                </thead>
                                <tbody class="spinner-back-placeholder">
                                    @for ($i = 0; $i < 10; $i++)
                                    <tr class="clickable-row">
                                        <td class="py-10 px-10"><div class=" bg-primary-lighter">&nbsp;</div></td>
                                        <td class="py-10 px-10"><div class=" bg-primary-lighter">&nbsp;</div></td>
                                        <td class="py-10 px-10"><div class=" bg-primary-lighter">&nbsp;</div></td>
                                        <td class="py-10 px-10"><div class=" bg-primary-lighter">&nbsp;</div></td>
                                        <td class="py-10 px-10"><div class=" bg-primary-lighter">&nbsp;</div></td>
                                    </tr>
                                    @endfor
                                </tbody>
                                <tbody id="renderJenazah"></tbody>
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

@endsection

@section('angular')
<script type="text/javascript">

    $('#deletePermintaan').click(function() {

        $('#deleteLoading').show();
        $('#deletePermintaan').hide();

        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        delete_permintaan = $("#deletePermintaan").val();

        var formData = new FormData();
        formData.append('id', delete_permintaan);

        for (var pair of formData.entries()) {
            console.log(pair[0]+ ', ' + pair[1]);
        }

        $.ajax({
            type: "POST",
            url: API_URL + "kamarjenazah/permintaan_jemput/delete",
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: formData,
            success: function (response) {

                callSwalString(response);
                $('#deletePermintaan').show();
                $('#deleteLoading').hide();
            },
            error: function () {
                callSwal('error','Aksi Gagal','Silahkan Coba Lagi',0);
                $('#deletePermintaan').show();
                $('#deleteLoading').hide();
            }
        });

        function callSwalString(string)
        {
            var response = jQuery.parseJSON(string);
            callSwal(response.type,response.title,response.text,response.url);
        }

    });
</script>
@endsection
@section('js')

<script type="text/javascript">
    var total_pages = 1;
    var visible_pages = 5;
    var keyword = '';
    var items_show = 10;
    var firstLoadPagination = false;

    loadData();

    function loadPagination(currentPage = 1)
    {
        console.log(total_pages);

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
        console.log('reload');
        console.log(total_pages);
        $('#pagination').twbsPagination($.extend({}, defaultOpts, {
            startPage: currentPage,
            totalPages: total_pages
        }));
    }


    function loadData(currentPage=1,keyword='')
    {
        $('.spinner').fadeIn();
        $('#noResult').hide();
        $('#jenazahResult').show();
        $('#renderJenazah').hide();
        $('.spinner-back-placeholder').show();
        $.ajax({
            url: API_URL + '/kamarjenazah/get?page='+ currentPage + '&keyword=' + keyword,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                if(data.total>0)
                {
                    $('#noResult').hide();
                    $('#jenazahResult').show();
                    total_pages = Math.ceil(data.total/items_show);
                    var template = $('#template-jenazahlist').html();
                    loadMustache(template);
                    var rendered = Mustache.render(template, data);
                    $('.spinner').fadeOut();
                    $('#renderJenazah').show();
                    $('#renderJenazah').html(rendered);
                    $('.spinner-back-placeholder').hide();
                    loadPagination(currentPage);
                }
                else
                {
                    $('.spinner').fadeOut();
                    $('#noResult').fadeIn();
                    $('#jenazahResult').hide();
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

    $('#permintaanSearchForm').submit(function( event ) {
        event.preventDefault();

        keyword = $('#permintaanSearch').val();
        console.log(keyword);
        loadData(1,keyword);
    });
</script>


<script id="template-jenazahlist" type="x-tmpl-mustache">
    @{{#data}}
    <tr class="clickable-row" data-href="{{url('kamarjenazah/detil-permintaan')}}/@{{id}}">
        <td>@{{pasien_id}}</td>
        <td>@{{nama}}</td>
        <td>@{{tempat_meninggal}}</td>
        <td>@{{waktu_meninggal}}</td>
        <td>@{{waktu_jemput}}</td>
    </tr>
    @{{/data}}
</script>

@endsection
