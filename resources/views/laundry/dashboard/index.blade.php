@extends('laundry.layouts.main2')

@section('title')
Laundry - Medify
@endsection

@section('content')

<div class="container">
    <div class="row row-deck">
        <div class="col-sm-9">
            <div class="block rounded main-content transaction-index"  ng-controller="PasienController">
                <div class="block-header">
                    <h3 class="block-title">Permintaan Laundry</h3>
                    <a href="{{url('laundry/permintaan/add-permintaan')}}" class="btn btn-sm btn-alt-info btn-hero pull-right">
                    + Permintaan Laundry
                    </a>
                </div>

                <div id="noResult" style="display: none">
                    <div class="text-center py-50">
                        Tidak ada permintaan laundry<br>
                        Cek transaksi untuk permintaan yang telah di proses<br><br>
                        <a href="{{url('laundry/permintaan/add-permintaan')}}"><button class="btn btn-outline-primary">+ Permintaan laundry</button></a>
                    </div>
                </div>

                <div class="table-full-width spinner-container" id="result">
                    <div class="spinner-back">
                        <table class="table table-striped table-hover table-pointer ">
                            <thead>
                                <tr class="header">
                                    <th width="5%">#</th>
                                    <th width="45%">RUANGAN</th>
                                    <th width="50%">DIBUAT PADA</th>
                                </tr>
                            </thead>
                            <tbody class="spinner-back-placeholder" id="spinner-back-placeholder">
                                @for ($i = 0; $i < 10; $i++)
                                <tr class="clickable-row">
                                    <td class="py-10 px-10"><div class=" bg-primary-lighter">&nbsp;</div></td>
                                    <td class="py-10 px-10"><div class=" bg-primary-lighter">&nbsp;</div></td>
                                    <td class="py-10 px-10"><div class=" bg-primary-lighter">&nbsp;</div></td>
                                </tr>
                                @endfor
                            </tbody>
                            <tbody id="render"></tbody>
                        </table>
                    </div>

                    <div class="spinner" id="spinner">
                        <td colspan="6"><i class="fa fa-4x fa-asterisk fa-spin text-info"></i></td>
                    </div>

                    <div class="flex-center" style="">
                        <ul id="pagination" class="pagination"></ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row col-sm-3" style="max-height: 200px;">
            <div class="block col-sm-12">
                <div class="block-content pb-10 pt-10 pl-0">
                    <div class="text-right text-primary display-4 font-w600">{{$totalPermintaan[0]}}</div>
                    <div class="font-size-md font-w600 text-uppercase text-right">PERMINTAAN HARI INI</div>
                </div>
            </div>

            <div class="block col-sm-12">
                <div class="block-content pb-10 pt-10 pl-0">
                    <div class="text-right text-primary display-4 font-w600">{{$totalPengembalian}}</div>
                    <div class="font-size-md font-w600 text-uppercase text-right">PENGEMBALIAN HARI INI</div>
                </div>
            </div>

            <div class="block col-sm-12">
                <div class="block-content pb-10 pt-10 pl-0">
                    <div class="text-right text-primary display-4 font-w600">{{$totalBarangCuci}}</div>
                    <div class="font-size-md font-w600 text-uppercase text-right">BARANG DICUCI</div>
                </div>
            </div>

            <div class="block col-sm-12">
                <div class="block-content pb-10 pt-10 pl-0">
                    <div class="text-right text-primary display-4 font-w600">{{$totalBarangSelesaiCuci}}</div>
                    <div class="font-size-md font-w600 text-uppercase text-right">BARANG SELESAI DICUCI</div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script id="TemplatePermintaan" type="text/template">
    @{{#data}}
    <tr class="clickable-row" data-href="{{url('laundry/permintaan/detil-permintaan')}}/@{{id}}">
        <td>@{{id}}</td>
        <td>@{{group_id}}</td>
        <td>@{{waktu_diserahkan}}</td>
    </tr>
    @{{/data}}
</script>

<script type="text/javascript">
    var total_pages = 1;
    var visible_pages = 5;
    var items_show = 10;
    var firstLoadPagination = false;
    loadPermintaan();

    function loadPagination(currentPage = 1)
    {
      if($('#pagination').data("twbs-pagination"))
        $('#pagination').twbsPagination('destroy')

        $('#pagination').twbsPagination({
            totalPages: total_pages,
            startPage: currentPage,
            visiblePages: visible_pages,
            initiateStartPageClick: false,
            onPageClick: function (event, page) {
            loadPermintaan(page);

            }
        });
        firstLoadPagination = true;
    }

    function loadPermintaan(currentPage=1)
    {
        $('#spinner').fadeIn();
        $('#noResult').hide();
        $('#result').show();
        $('#render').hide();
        $('#spinner-back-placeholder').show();
        $.ajax({
            url:  API_URL + '/laundry/dashboard/get?page='+ currentPage ,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                if(data.total > 0)
                {   console.log(data);
                    $('#noResult').hide();
                    $('#result').show();
                    total_pages = Math.ceil(data.total/items_show);
                    var template = $('#TemplatePermintaan').html();
                    loadMustache(template);
                    var rendered = Mustache.render(template, data);
                    $('#spinner').fadeOut();
                    $('#render').show();
                    $('#render').html(rendered);
                    $('#spinner-back-placeholder').hide();
                    loadPagination(currentPage);
                }
                else
                {
                    $('#spinner').fadeOut();
                    $('#noResult').fadeIn();
                    $('#result').hide();
                    $('#spinner-back-placeholder').hide();
                }
            },
            error: function() {
                alert('Gagal load permintaan');
            },
        });
    }

    function loadMustache(template) {
        Mustache.parse(template, customTags);
        Mustache.tags = customTags;
    }

</script>
@endsection
