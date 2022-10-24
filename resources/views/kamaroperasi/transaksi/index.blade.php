@extends('layouts.main2')

@section('title')
Pemesanan - Kamar Operasi - Medify
@endsection

@section('content')
<div class="content pt-100 px-100">
    <div class="mt-50 mb-30 text-center">
        <h2 class="font-w700 text-black mb-10">Pendaftaran Pasien</h2>
        <h3 class="h5 text-muted mb-0">Pilih pasien yang akan didaftarkan</h3>
    </div>

    <div class="block main-content transaction-index"  ng-controller="PasienController">
        <div class="block-header bg-success">
            <h3 class="block-title text-white">Daftar Pasien</h3>
        </div>
        <div class="block-content">
            <div class="row mb-20">
                <div class="col-sm-12"> 
                    <form style="margin-top: 10px" id="pasienSearchForm">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Cari Pasien" id="pasienSearch">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-secondary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div> 
            </div>
        </div>
        <div class="table-full-width spinner-container" > 
            <div class="spinner-back">
                <table class="table table-striped table-hover table-pointer "> 
                    <thead>
                        <tr class="header" ng-click="getCurrentPage()">
                            <th style="width:5%">#</th>
                            <th style="width:15%">Nama</th>
                            <th style="width:25%">Alamat</th>
                            <th style="width:10%">Jenis Kelamin</th>
                            <th style="width:8%">Usia</th>
                            <th style="width:10%">Jenis Pasien</th>
                        </tr>
                    </thead>
                    <tbody class="spinner-back-placeholder">
                        @for($i=0;$i<10;$i++)
                        <tr class="clickable-row"> 
                            <td class="py-10 px-10"><div class=" bg-primary-lighter">&nbsp;</div></td>
                            <td class="py-10 px-10"><div class=" bg-primary-lighter">&nbsp;</div></td>
                            <td class="py-10 px-10"><div class=" bg-primary-lighter">&nbsp;</div></td>
                            <td class="py-10 px-10"><div class=" bg-primary-lighter">&nbsp;</div></td>
                            <td class="py-10 px-10"><div class=" bg-primary-lighter">&nbsp;</div></td>
                            <td class="py-10 px-10"><div class=" bg-primary-lighter">&nbsp;</div></td>
                        </tr>
                        @endfor
                    </tbody>
                    <tbody id="renderPasien"></tbody>



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
        $.ajax({
            url: API_URL + '/pasien/get/?page='+ currentPage + '&keyword=' + keyword,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                total_pages = Math.ceil(data.total/items_show);
                var template = $('#template-pasienlist').html();
                loadMustache(template);
                var rendered = Mustache.render(template, data);
                $('.spinner').fadeOut();
                $('#renderPasien').html(rendered);
                $('.spinner-back-placeholder').hide();
                loadPagination(currentPage);
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

</script>

<script id="template-pasienlist" type="x-tmpl-mustache">
    @{{#data}}
    <tr class="clickable-row" onclick='goToHref("{{url()->current()}}/@{{id}}")'> 
    <td>@{{id}}</td>
    <td>@{{name}}</td>
    <td>@{{address}}</td>
    <td>@{{jenis_kelamin}}</td>
    <td>@{{age}}</td>
    <td>@{{types}}</td>
    </tr>
    @{{/data}}
</script>

@endsection