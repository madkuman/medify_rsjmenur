@extends('laundry.layouts.main2')

@section('title')
Barang Laundry - Medify
@endsection


@section('content')

<div class="container">
    <div class="row row-deck">
        <div class="col-sm-12">
            <div class="block rounded main-content transaction-index">
                <div class="block-header">
                    <h3 class="block-title">Barang Laundry</h3>
                    <button class="btn btn-sm btn-alt-info btn-hero pull-right" type="button" id="buttonAdd"  data-toggle="modal" data-target="#addModal"> +  Barang Laundry</button>
                </div>

                <div id="noResult" style="display: none">
                    <div class="text-center py-50">
                        Tidak ada barang laundry<br>
                        <button class="btn btn-outline-primary">+ Barang baru</button>
                    </div>
                </div>

                <div class="table-full-width spinner-container" id="result">
                    <div class="spinner-back">
                        <table class="table table-striped table-hover table-pointer ">
                            <thead>
                                <tr class="header">
                                    <th width="5%">#</th>
                                    <th width="25%">NAMA BARANG</th>
                                    <th width="50%">DETAIL BARANG</th>
                                    <th width="20%">AKSI</th>
                                </tr>
                            </thead>
                            <tbody class="spinner-back-placeholder" id="spinner-back-placeholder">
                                @for ($i = 0; $i < 10; $i++)
                                <tr class="clickable-row">
                                    <td class="py-10 px-10"><div class=" bg-primary-lighter">&nbsp;</div></td>
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
    </div>
</div>

@include('laundry.modal_popup.add_barang')
@include('laundry.modal_popup.delete_barang')
@include('laundry.modal_popup.edit_barang')
{{-- @include('laundry.modal_popup.detail_barang') --}}
@endsection

@section('js')
<script id="TemplatePermintaan" type="text/template">
    @{{#data}}
    <tr data-id="@{{nama}}" data-toggle="modal" data-target="#detailModal">
        <td>@{{nomor}}</td>
        <td>@{{nama}}</td>
        <td>@{{detail}}</td>
        <td>
            <button class="btn btn-warning pull-left mb-5" type="button" id="buttonbarangEdit" data-id="@{{id}}" data-namaBarang="@{{nama}}" data-detailBarang="@{{detail}}"  data-toggle="modal" data-target="#editbarangModal" style="margin-right:8px;"><i class="fa fa-edit"></i> Edit</a>
            <button class="btn btn-danger pull-left" type="button" id="buttonDelete" data-id="@{{id}}" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-times"></i> Hapus</button>
        </td>
    </tr>
    @{{/data}}
</script>

<script type="text/javascript">
    var id;
    var nama, detail;
    var namaBarang, detailBarang;

    $('#editbarangModal').off('show.bs.modal').on('show.bs.modal', function (e) {
    id = $(e.relatedTarget).attr('data-id');
    namaBarang = $(e.relatedTarget).attr('data-namaBarang');
    detailBarang = $(e.relatedTarget).attr('data-detailBarang');
    $('#barangnama').attr('value',namaBarang);
    $('#barangdetail').attr('value',detailBarang);
    console.log(id);
    console.log(namaBarang);
    console.log(detailBarang);
    });

    $('#buttonEditModal').off('click').on('click',function() {
        $('#buttonEditModal').hide();
        $('#buttonEditLoading').show();

        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        namaBarang = $('#barangnama').val();
        detailBarang = $('#barangdetail').val();
        idBarang = id;
        var formData = new FormData();
        formData.append('id',idBarang);
        formData.append('namaBarang',namaBarang);
        formData.append('detailBarang',detailBarang);
        $.ajax({
            type: "POST",
            url: API_URL + "/laundry/barang/edit",
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
                callSwal('error','Pengubahan barang Gagal','Silahkan Coba Lagi',0);
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
</script>

<script type="text/javascript">
    $('#detailModal').modal({
        keyboard: true,
        backdrop: "static",
        show:false,

    }).on('show.bs.modal', function(){
          var getNamaBarang = $(this).data('nama');
        //make your ajax call populate items or what even you need
        $(this).find('#namaBarang').html($('<b>' + getNamaBarang  + '</b>'))
    });

    $(".table-striped").find('tr[data-target]').on('click', function(){
        //or do your operations here instead of on show of modal to populate values to modal.
         $('#detailModal').data('nama',$(this).data('id'));
    });
</script>

<script type="text/javascript">
    var total_pages = 1;
    var visible_pages = 5;
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
            loadData(page);

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

    function loadData(currentPage=1)
    {
        $('#spinner').fadeIn();
        $('#noResult').hide();
        $('#result').show();
        $('#render').hide();
        $('#spinner-back-placeholder').show();
        $.ajax({
            url:  API_URL + '/laundry/barang/get?page='+ currentPage ,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                if(data)
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

<script type="text/javascript">

        $('#buttonApply').off('click').on('click',function() {
            $('#buttonApply').hide();
            $('#buttonLoading').show();

            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            var nama = $("#namaBarang").val();
            var keterangan = $("#keteranganBarang").val();
            var formData = new FormData();
            formData.append('nama', nama);
            formData.append('keterangan', keterangan);

        $.ajax({
            type: "POST",
            url: API_URL + "/laundry/barang/add",
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
                $('#buttonLoading').hide();
                // event.preventDefault();
                loadData();
            },
            error: function () {
                callSwal('error','Aksi Gagal','Silahkan Coba Lagi',0);
                $('#buttonApply').show();
                $('#buttonLoading').hide();
            }
        });

        function callSwalString(string)
        {
            var response = jQuery.parseJSON(string);
            callSwal(response.type,response.title,response.text,response.url);
        }

    });
</script>

<script type="text/javascript">
    var id;
    var nama, detail;

    $('#deleteModal').on('show.bs.modal', function (e) {
    id = $(e.relatedTarget).attr('data-id');
    console.log(id);
});

    $('#detailModal').on('show.bs.modal', function (e) {
    nama = $(e.relatedTarget).attr('data-id[0]');
    detail = $(e.relatedTarget).atrr('data-id[1]');
    console.log(nama);
    console.log(detail);
});

    $('#buttonDelete').unbind().click(function() {

        $('#buttonDelete').hide();
        $('#buttonLoading').show();

        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        idBarang = id;
        var formData = new FormData();
        formData.append('id',idBarang);
        $.ajax({
            type: "POST",
            url: API_URL + "/laundry/barang/delete",
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
                callSwal('error','Penghapusan Gagal','Silahkan Coba Lagi',0);
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

</script>

@endsection
