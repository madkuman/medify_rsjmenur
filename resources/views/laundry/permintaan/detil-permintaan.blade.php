@extends('laundry.layouts.main2')

@section('title')
Detail Laundry - Medify
@endsection


@section('content')

<div class="container">
    <div class="row row-deck">
        <div class="col-sm-12">
            <div class="block rounded main-content transaction-index"  ng-controller="PasienController">
                <div class="block-header pb-0 pt-0" style="padding-right:50px;">
                    <h3 class="mb-0">Transaksi #{{$detail->id}}</h3>
                    <h4 class="font-w800 text-uppercase pull-right mb-0 {{$detail->getStatus->class}}">{{$detail->getStatus->nama}}</h4>
                </div>
                <hr>
                <div class="block-content pt-0" style="padding-right:50px;">
                    <div class="row">
                      <div class="col-md-2">
                        <p class="font-size-sm mb-5 font-w400 text-uppercase">Ruangan</p>
                        <h5>{{$detail->getGroupName->name}}</h5>
                      </div>
                      <div class="col-md-3">
                        <p class="font-size-sm mb-5 font-w400 text-uppercase">Tanggal Diserahkan</p>
                        <h5>{{$detail->created_at->formatLocalized('%d %B %Y, %H:%M')}}</h5>
                      </div>
                      <div class="col-md-3">
                        <p class="font-size-sm mb-5 font-w400 text-uppercase">Tanggal Diterima</p>
                        <h5>{{$detail->waktu_diterima}}</h5>
                      </div>
                      @if($detail->status_id === 1 || $detail->status_id === 2)
                          <div class="col-md-4">
                            <button class="btn btn-hero btn-danger pull-right ml-2" data-toggle="modal" data-target="#deleteModal"  type="button" id="buttonHapus">Hapus</button>
                            <button class="btn btn-hero btn-warning pull-right" data-toggle="modal" data-target="#editModal" type="button" id="buttonEdit">Edit</button>
                          </div>
                      @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="block rounded main-content transaction-index"  ng-controller="PasienController">
                <div class="block-header pb-0" style="padding-right:50px;">
                    <h3>{{$detail->getStatus->header}}</h3>
                </div>
                <div class="block-content table-full-width spinner-container" id="result">
                    <div class="spinner-back">
                        <table class="table table-hover table-pointer ">
                            <thead>
                                <tr class="header">
                                  <th width="5%">#</th>
                                  <th width="15%">NAMA BARANG</th>
                                  <th width="18%">JUMLAH DISERAHKAN</th>
                                  <th width="22%">KET</th>
                                  <th width="18%">JUMLAH DITERIMA</th>
                                  <th width="22%">KET</th>
                                </tr>
                            </thead>
                            <tbody class="spinner-back-placeholder" id="spinner-back-placeholder">
                                @for ($i = 0; $i < 10; $i++)
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
                            <tbody id="render"></tbody>
                        </table>
                    </div>
                    <div class="block-content">
                      <div class="col-md-12 text-right" style="height: 75px">
                        @if($detail->status_id === 1)
                          <button class="btn btn-danger" style="padding:0px 40px;" type="button" id="buttonCancel"  data-toggle="modal" data-target="#rejectModal"><i class="fa fa-close"></i> Tolak</button>
                          <button class="btn btn-primary ml-2" style="padding:0px 40px;" type="button" id="buttonSubmit" data-toggle="modal" data-target="#acceptModal"><i class="fa fa-check"></i> Terima</button>
                        @elseif($detail->status_id === 2)
                          <button class="btn btn-primary" style="padding:0px 40px;" type="button" id="buttonSubmit" data-toggle="modal" data-target="#statusModal"><i class="fa fa-check"></i> Cuci Selesai</button>
                        @elseif($detail->status_id === 3)
                          <button class="btn btn-primary" style="padding:0px 40px;" type="button" id="buttonSubmit" data-toggle="modal" data-target="#statusModal"><i class="fa fa-check"></i> Serahkan Barang</button>
                        @elseif($detail->status_id === 4)
                          <button class="btn btn-primary" style="padding:0px 40px;" type="button" id="buttonSubmit" data-toggle="modal" data-target="#statusModal"><i class="fa fa-check"></i> Konfirmasi Terima</button>
                        @endif
                      </div>
                    </div>
                    <div class="spinner" id="spinner">
                        <td colspan="6"><i class="fa fa-4x fa-asterisk fa-spin text-info"></i></td>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="block rounded main-content transaction-index"  ng-controller="PasienController">
                <div class="block-content pt-0" style="padding-right:50px;">
                    <div class="row">
                      <div class="col-md-2">
                        <p class="font-size-sm mb-5 font-w400 text-uppercase">Yang Menyerahkan (ruangan)</p>
                        <h6 class="mb-5">{{$detail->creator->name}}</h6>
                        <h6>{{$detail->created_at->formatLocalized('%d %B %Y, %H:%M')}}</h6>
                      </div>
                      <div class="col-md-3">
                        <p class="font-size-sm mb-5 font-w400 text-uppercase">Yang Menerima (pencucian)</p>
                        <h6 class="mb-5">{{$penanggungjawab->penerima_pencucian}}</h6>
                        <h6>{{$penanggungjawab->waktu_penerima}}</h6>
                      </div>
                      <div class="col-md-2">
                        <p class="font-size-sm mb-5 font-w400 text-uppercase">Selesai Pencucian</p>
                        <h6 class="mb-5">{{$penanggungjawab->selesai_pencucian}}</h6>
                        <h6>{{$penanggungjawab->waktu_selesai_pencucian}}</h6>
                      </div>
                      <div class="col-md-3">
                        <p class="font-size-sm mb-5 font-w400 text-uppercase">Yang Menyerahkan (pencucian)</p>
                        <h6 class="mb-5">{{$penanggungjawab->menyerahkan_pencucian}}</h6>
                        <h6>{{$penanggungjawab->waktu_menyerahkan}}</h6>
                      </div>
                      <div class="col-md-2">
                        <p class="font-size-sm mb-5 font-w400 text-uppercase">Yang Menerima (ruangan)</p>
                        <h6 class="mb-5">{{$penanggungjawab->menerima_ruangan}}</h6>
                        <h6>{{$penanggungjawab->waktu_menerima}}</h6>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if($detail->status_id === 1)
      @include('laundry.modal_popup.reject_modal')
      @include('laundry.modal_popup.accept_modal')
      @include('laundry.modal_popup.edit_modal')
      @include('laundry.modal_popup.delete_modal')
    @elseif($detail->status_id === 2)
      @include('laundry.modal_popup.cuci_modal')
      @include('laundry.modal_popup.edit_prosescuci_modal')
      @include('laundry.modal_popup.delete_modal')
    @elseif($detail->status_id === 3)
      @include('laundry.modal_popup.serahbarang_modal')
    @elseif($detail->status_id === 4)
      @include('laundry.modal_popup.konfirmasi_modal')
    @endif

@endsection

@section('js')
<script id="TemplatePermintaan" type="text/template">
    @{{#data}}
    <tr>
        <td>@{{nomor}}</td>
        <td>@{{nama_barang}}</td>
        <td align="center">@{{diserahkan}}</td>
        <td>@{{keterangan}}</td>
        <td align="center">@{{diterima}}</td>
        <td>@{{keterangan_terima}}</td>

    </tr>
    @{{/data}}
</script>

<script type="text/javascript">

        $('#buttonSubmitModal').off('click').on('click',function() {
            $('#buttonSubmitModal').hide();
            $('#buttonLoading').show();

            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            barang = [];
            ket = [];
            detail_id = [];

            var idTransaksi = {{$permintaan->id}};
            var jumlah = {{$permintaan->jumlah}};
            for (var i = 1; i <= jumlah; i++) {
                barang[i] = $("#barang"+i).val();
                ket[i] = $("#ket"+i).val();
                detail_id[i] = $("#detail"+i).val();
            }

            var formData = new FormData();
            for (var i = 1; i <= jumlah; i++) {
                formData.append('detail_id'+'['+i+']', detail_id[i]);
                formData.append('barang'+'['+i+']', barang[i]);
                formData.append('ket'+'['+i+']', ket[i]);
            }
            formData.append('jumlah', jumlah);
            formData.append('id', idTransaksi);

        $.ajax({
            type: "POST",
            url: API_URL + "/laundry/permintaan/new",
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: formData,
            success: function (response) {
                callSwalString(response);
                $('#acceptModal').hide();
                $('#buttonSubmitModal').show();
                $('#buttonLoading').hide();
            },
            error: function () {
                callSwal('error','Aksi Gagal','Silahkan Coba Lagi',0);
                $('#buttonSubmitModal').show();
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

        $('#buttonEditProsesCuciModal').off('click').on('click',function() {
            $('#buttonEditProsesCuciModal').hide();
            $('#buttonEditProsesCuciLoading').show();

            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            barang = [];
            ket = [];
            detail_id = [];

            var idTransaksi = {{$permintaan->id}};
            var jumlah = {{$permintaan->jumlah}};
            for (var i = 1; i <= jumlah; i++) {
                barang[i] = $("#editbarang"+i).val();
                ket[i] = $("#editket"+i).val();
                detail_id[i] = $("#editdetail"+i).val();
            }

            var formData = new FormData();
            for (var i = 1; i <= jumlah; i++) {
                formData.append('detail_id'+'['+i+']', detail_id[i]);
                formData.append('barang'+'['+i+']', barang[i]);
                formData.append('ket'+'['+i+']', ket[i]);
            }
            formData.append('jumlah', jumlah);
            formData.append('id', idTransaksi);

        $.ajax({
            type: "POST",
            url: API_URL + "/laundry/permintaan/editProsesCuci",
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: formData,
            success: function (response) {
                callSwalString(response);
                $('#EditProsesCuciModal').hide();
                $('#buttonEditProsesCuciModal').show();
                $('#buttonEditProsesCuciLoading').hide();
            },
            error: function () {
                callSwal('error','Aksi Gagal','Silahkan Coba Lagi',0);
                $('#buttonEditProsesCuciModal').show();
                $('#buttonEditProsesCuciLoading').hide();
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

        $('#buttonEditModal').off('click').on('click',function() {
            $('#buttonEditModal').hide();
            $('#buttonEditLoading').show();

            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            barang = [];
            ket = [];
            detail_id = [];

            var idTransaksi = {{$permintaan->id}};
            var jumlah = {{$permintaan->jumlah}};
            for (var i = 1; i <= jumlah; i++) {
                barang[i] = $("#editbarang"+i).val();
                ket[i] = $("#editket"+i).val();
                detail_id[i] = $("#editdetail"+i).val();
            }

            var formData = new FormData();
            for (var i = 1; i <= jumlah; i++) {
                formData.append('detail_id'+'['+i+']', detail_id[i]);
                formData.append('barang'+'['+i+']', barang[i]);
                formData.append('ket'+'['+i+']', ket[i]);
            }
            formData.append('jumlah', jumlah);
            formData.append('id', idTransaksi);

        $.ajax({
            type: "POST",
            url: API_URL + "/laundry/permintaan/edit",
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: formData,
            success: function (response) {
                callSwalString(response);
                $('#EditModal').hide();
                $('#buttonEditModal').show();
                $('#buttonEditLoading').hide();
            },
            error: function () {
                callSwal('error','Aksi Gagal','Silahkan Coba Lagi',0);
                $('#buttonEditModal').show();
                $('#buttonEditLoading').hide();
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

        $('#buttonDeleteModal').off('click').on('click',function() {
            $('#buttonDeleteModal').hide();
            $('#buttonDeleteLoading').show();

            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            var idTransaksi = {{$permintaan->id}};
            var formData = new FormData();
            formData.append('id', idTransaksi);

        $.ajax({
            type: "POST",
            url: API_URL + "/laundry/permintaan/delete",
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: formData,
            success: function (response) {
                callSwalString(response);
                $('#DeleteModal').hide();
                $('#buttonDeleteModal').show();
                $('#buttonDeleteLoading').hide();
            },
            error: function () {
                callSwal('error','Aksi Gagal','Silahkan Coba Lagi',0);
                $('#buttonDeleteModal').show();
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

<script type="text/javascript">
    var total_pages = 1;
    var visible_pages = 5;
    var items_show = 10;
    var firstLoadPagination = false;
    loadPermintaan();

    function loadPagination(currentPage = 1)
    {

        $('#pagination').twbsPagination('destroy');
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
            url:  API_URL + '/laundry/permintaan/get/{{$detail->id}}',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                if(data)
                {   console.log(data);
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

        $('#ButtonStatusModal').off('click').click(function() {

            $('#ButtonStatusModal').hide();
            $('#buttonLoading').show();

            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            var idTransaksi = {{$permintaan->id}};

            var formData = new FormData();

        $.ajax({
            type: "POST",
            url: API_URL + "/laundry/permintaan/update/{{$detail->id}}",
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: formData,
            success: function () {
                callSwal('success','Aksi Berhasil','Status telah terupdate','laundry/permintaan/detil-permintaan/{{$detail->id}}');
                $('#statusModal').hide();
                $('#buttonLoading').hide();
            },
            error: function () {
                callSwal('error','Aksi Gagal','Silahkan Coba Lagi',0);
                $('#ButtonStatusModal').show();
                $('#buttonLoading').hide();
            }
        });
    });
</script>

<script type="text/javascript">

        $('#buttonRejectModal').off('click').on('click',function() {
            $('#buttonRejectModal').hide();
            $('#buttonLoading').show();

            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            var idTransaksi = {{$permintaan->id}};
            var keterangan_tolak = $('#keterangan_tolak').val();

            var formData = new FormData();
            formData.append('idTransaksi', idTransaksi);
            formData.append('keterangan_tolak', keterangan_tolak);

        $.ajax({
            type: "POST",
            url: API_URL + "/laundry/permintaan/reject",
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: formData,
            success: function (response) {
                callSwalString(response);
                $('#rejectModal').hide();
                $('#buttonRejectModal').show();
                $('#buttonLoading').hide();
            },
            error: function () {
                callSwal('error','Aksi Gagal','Silahkan Coba Lagi',0);
                $('#buttonRejectModal').show();
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
