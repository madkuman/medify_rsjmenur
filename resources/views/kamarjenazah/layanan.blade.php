@extends('kamarjenazah.layouts.main')

@section('title')
Kamar Jenazah - Medify
@endsection

@section('toprightmenu')
Kembali ke dashboard
@endsection

@section('url')
{{url('kamarjenazah')}}
@endsection

@section('subtitle')
Tarif Layanan Jenazah
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
            <div class="col-sm-12">
                <div class="block rounded main-content transaction-index">
                  <button class="btn btn-sm btn-alt-info btn-hero pull-right" type="button" id="buttonAdd"  data-toggle="modal" data-target="#addModal"> +  Layanan Kamar Jenazah</button>
                    <div class="block-header">
                        <h3 class="block-title">
                          Daftar Tarif Layanan</h3>
                    </div>
                    <div class="block-content">
                        <div class="row mb-20">
                            <div class="col-sm-12">
                                <form style="margin-top: 10px" id="layananSearchForm">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Cari layanan berdasarkan nama" id="layananSearch">
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
                            Layanan tidak ditemukan. Silahkan coba dengan kata kunci lainnya <br>
                            Atau anda bisa menambah daftar Layanan<br><br>
                            <button class="btn btn-outline-primary">+ Tambah Layanan</button>
                        </div>
                    </div>

                    <div class="table-full-width spinner-container" id="jenazahResult">
                        <div class="spinner-back">
                            <table class="table table-striped table-hover table-pointer ">
                                <thead>
                                    <tr class="header" ng-click="getCurrentPage()">
                                        <th style="width:10%">No</th>
                                        <th style="width:30%">Nama Layanan</th>
                                        <th style="width:30%">Harga</th>
                                        <th style="width:30%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="spinner-back-placeholder">
                                    @for ($i = 0; $i < 10; $i++)
                                    <tr>
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

@include('kamarjenazah.modal.addLayanan')
@include('kamarjenazah.modal.deleteLayanan')
@include('kamarjenazah.modal.editLayanan')
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

    $('#layananSearchForm').submit(function( event ) {
        event.preventDefault();

        keyword = $('#layananSearch').val();
        console.log(keyword);
        loadData(1,keyword);
    });

    function loadData(currentPage=1,keyword='')
    {
        $('.spinner').fadeIn();
        $('#noResult').hide();
        $('#jenazahResult').show();
        $('#renderJenazah').hide();
        $('.spinner-back-placeholder').show();
        $.ajax({
            url: API_URL + '/kamarjenazah/layanan/get?page='+ currentPage + '&keyword=' + keyword,
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

</script>

<script type="text/javascript">

    $('#editlayananModal').off('show.bs.modal').on('show.bs.modal', function (e) {
        id = $(e.relatedTarget).attr('data-id');
        namaLayanan = $(e.relatedTarget).attr('data-layanan_nama');
        tarifLayanan = $(e.relatedTarget).attr('data-layanan_tarif');
        $('#layanan_nama').attr('value',namaLayanan);
        $('#layanan_tarif').attr('value',tarifLayanan);
    });

    $('#buttonEditModal').off('click').on('click',function() {
        $('#buttonEditModal').hide();
        $('#buttonEditLoading').show();

        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        namaLayanan = $('#layanan_nama').val();
        tarifLayanan = $('#layanan_tarif').val();
        idLayanan = id;
        var formData = new FormData();
        formData.append('id',idLayanan);
        formData.append('layanan_nama',namaLayanan);
        formData.append('layanan_tarif',tarifLayanan);
        $.ajax({
            type: "POST",
            url: API_URL + "/kamarjenazah/layanan/edit",
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: formData,
            success: function (response) {

                callSwalString(response);
                $('#buttonDelete').show();
                $('#buttonLoading').hide();
            },
            error: function () {
                callSwal('error','Pengubahan layanan Gagal','Silahkan Coba Lagi',0);
                $('#buttonDelete').show();
                $('#buttonLoading').hide();
            }
        });

        function callSwalString(string)
        {
            var response = jQuery.parseJSON(string);
            callSwal(response.type,response.title,response.text,response.url);
        }

    });

    $('#buttonApply').off('click').on('click',function() {
        $('#buttonApply').hide();
        $('#buttonAddLoading').show();

        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        var nama = $("#layananbaru_nama").val();
        var tarif = $("#layananbaru_tarif").val();
        var jenisLayanan = $("#jenisLayanan").val();
        var formData = new FormData();
        formData.append('layanan_nama', nama);
        formData.append('layanan_tarif', tarif);
        formData.append('jenis_layanan', jenisLayanan);

    $.ajax({
        type: "POST",
        url: API_URL + "/kamarjenazah/layanan/new",
        contentType: false,
        processData: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: formData,
        success: function (response) {
            callSwalString(response);
            $(document).ready(function() {
                $("#addModal").dialog("close");
            });
            $('#buttonApply').show();
            $('#buttonAddLoading').hide();
            // event.preventDefault();
            loadData();
        },
        error: function () {
            callSwal('error','Aksi Gagal','Silahkan Coba Lagi',0);
            $('#buttonApply').show();
            $('#buttonAddLoading').hide();
        }
    });

    function callSwalString(string)
    {
        var response = jQuery.parseJSON(string);
        callSwal(response.type,response.title,response.text,response.url);
    }

    });

    $('#deleteModal').on('show.bs.modal', function (e) {
    id = $(e.relatedTarget).attr('data-id');
    console.log(id);
    });

    $('#buttonDelete').unbind().click(function() {

        $('#buttonDelete').hide();
        $('#buttonDeleteLoading').show();

        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        idLayanan = id;
        var formData = new FormData();
        formData.append('idLayanan',idLayanan);
        $.ajax({
            type: "POST",
            url: API_URL + "/kamarjenazah/layanan/delete",
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: formData,
            success: function (response) {

                callSwalString(response);
                $('#buttonDelete').show();
                $('#buttonDeleteLoading').hide();
            },
            error: function () {
                callSwal('error','Penghapusan Gagal','Silahkan Coba Lagi',0);
                $('#buttonDelete').show();
                $('#buttonDeleteLoading').hide();
            }
        });

        function callSwalString(string)
        {
            var response = jQuery.parseJSON(string);
            callSwal(response.type,response.title,response.text,response.url);
        }

    });
</script>

<script id="template-jenazahlist" type="x-tmpl-mustache">
  var idx = 0;

    var data = {
      "names": [
       {"name":"John"},
       {"name":"Mary"}
    ],
    "idx": function() {
        return idx++;
    }
    };

    var html = Mustache.render(template, data);

    @{{#data}}
    <tr>
        <td>@{{id}}</td>
        <td>@{{nama_layanan}}</td>
        <td>Rp. @{{harga_layanan}}</td>
        <td>
            <button class="btn btn-warning pull-left mb-5" type="button" id="buttonbarangEdit" data-id="@{{id}}" data-layanan_nama="@{{nama_layanan}}" data-layanan_tarif="@{{harga_layanan}}"  data-toggle="modal" data-target="#editlayananModal" style="margin-right:8px;"><i class="fa fa-edit"></i> Edit</a>
            <button class="btn btn-danger pull-left" type="button" id="buttonlayananDelete" data-id="@{{id}}" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-times"></i> Hapus</button>
        </td>
    </tr>
    @{{/data}}
</script>

@endsection
