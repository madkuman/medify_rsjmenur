@extends('pasien.layouts.main')

@section('title')
Pasien - Medify
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
<main id="main-container">
    @include('pasien.layouts.navbar')
    <div class="container">
        <div class="row row-deck">
            <div class="col-sm-12">
                <div class="block rounded main-content transaction-index"  ng-controller="PasienController">
                    <div class="block-header">
                        <h3 class="block-title">Daftar Pasien</h3>
                    </div>
                    <div class="block-content">
                        <div class="row mb-20">
                            <div class="col-sm-12"> 
                                <form style="margin-top: 10px" id="pasienSearchForm">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Cari Pasien Berdasarkan Nama, Alamat, No KTP, atau NRP" id="pasienSearch" autofocus="true">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-secondary">Cari</button>
                                        </div>
                                    </div>
                                </form>
                            </div> 
                        </div>
                    </div>

                    <div id="noResult" style="display: none">
                        <div class="text-center py-50">
                            Pasien tidak ditemukan. Silahkan coba dengan kata kunci lainnya <br>
                            Atau anda bisa membuat pasien baru<br><br>
                            <a href="{{url('pasien/baru')}}" class="btn btn-outline-primary">+ Pasien Baru</a>
                        </div>
                    </div>

                    <div class="table-full-width spinner-container" id="pasienResult"> 
                        <div class="spinner-back" style="overflow: auto;">
                            <table class="table table-striped table-hover" id="tabelPasienResult" width="100%"> 
                                <thead>
                                    <tr class="header" ng-click="getCurrentPage()">
                                        <th style="width:8%">No RM </th>
                                        <th style="width:20%">Nama</th>
                                        <th style="width:22%">Alamat</th>
                                        <th style="width:10%">Kartu Identitas</th>
                                        <th style="width:10%">NRP</th>
                                        <!--<th style="width:10%">Jenis Pasien</th>-->
                                        <th style="width:20%">Jenis Pembayaran</th>
                                        <th style="width:5%">Detail</th>
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
                                        <!--<td class="py-10 px-10"><div class=" bg-primary-lighter">&nbsp;</div></td>-->
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
        </div>
    </div>
</main>

@endsection


@section('js')
<script type="text/javascript" src="{{asset('assets\js\jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets\js\dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/js/pages/be_tables_datatables.js')}}"></script>
<script type="text/javascript">
    var total_pages = 1;
    var visible_pages = 3;
    var keyword = '';
    var items_show = 10;
    var firstLoadPagination = false;

    loadData();

    var oTable = $("#tabelPasienResult").DataTable({
        "bLengthChange": false,
        "bFilter": false,
        "bPaginate": false,
        "bInfo" : false,
    });

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
        $('#pasienResult').show();
        $('#renderPasien').hide();
        $('.spinner-back-placeholder').show();
        $.ajax({
            url: API_URL + '/pasien/get?page='+ currentPage + '&keyword=' + keyword,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                if(data.total>0)
                {   
                   for(i=0; i< data.data.length; i++){
                    if(data.data[i].gender == 1){
                        data.data[i].jenis_kelamin = 'Laki-Laki';
                    }else if(data.data[i].gender == 2){
                        data.data[i].jenis_kelamin = 'Perempuan';
                    }
                };
                $('#noResult').hide();
                $('#pasienResult').show();
                total_pages = Math.ceil(data.total/items_show);
                var template = $('#template-pasienlist').html();
                loadMustache(template);
                if(data.is_anggota == "1")
                    data.is_anggota = true;
                else
                    data.is_anggota = false;
                var rendered = Mustache.render(template, data);
                $('.spinner').fadeOut();
                $('#renderPasien').show();
                $('#renderPasien').html(rendered);
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

    var startSearch;
    $(document).on('keyup', '#pasienSearch', function(){
        clearTimeout(startSearch);
        startSearch = setTimeout(function(){
            keyword = $('#pasienSearch').val();
            loadData(1,keyword);
        }, 700);
    });

</script>


<script id="template-pasienlist" type="x-tmpl-mustache">
    @{{#data}}
    <tr> 
    <td>@{{no_rm}}</td>
    <td>
    @{{name}}<br>
    @{{jenis_kelamin}}, @{{detailed_long_age}}
    </td>
    <td>@{{address}}<br>
    @{{kecamatan}}, @{{kota}}
    </td>
    <td>
    @{{kartu}}<br>
    @{{no_identitas}}
    </td>
    @{{#is_anggota}}
    <td>@{{tni_nrp}}</td>
    @{{/is_anggota}}
    @{{^is_anggota}}
    <td>-</td>
    @{{/is_anggota}}
    <td>@{{all_bayar}}
    </td>
    <td>
    <a class="btn btn-primary btn-sm" href="{{url('pasien')}}/@{{id}}">
    <i class="fa fa-paper-plane"></i> Lihat
    </a>
    </td>
    </tr>
    @{{/data}}
</script>

@endsection