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
Riwayat Transaksi
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
                  <form id="transaksiSubmit">
                    <div class="block-header">
                        <h3 class="block-title">
                          Daftar Riwayat Transaksi Jemput Jenazah</h3>
                    </div>

                    <div class="table-full-width spinner-container" id="jenazahResult">
                        <div class="spinner-back">
                            <table class="table table-striped table-hover table-pointer ">
                                <thead>
                                    <tr class="header" ng-click="getCurrentPage()">
                                        <th style="width:5%">No</th>
                                        <th style="width:15%">Nama Pasien</th>
                                        <th style="width:22%">Waktu Kematian</th>
                                        <th style="width:15%">Total Invoice</th>
                                        <th style="width:20%">Transaksi Dibuat</th>
                                        <th style="width:18%">Aksi</th>
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
                  </form>
                <div id="noResult" style="display: none">
                    <div class="text-center py-50">
                        Belum ada transaksi yang terjadi<br>
                        Atau anda bisa menambah transaksi permintaan jemput jenazah<br><br>
                        <a href="{{url('kamarjenazah/permintaan_jemput')}}"> <button class="btn btn-outline-primary">+ Daftar permintaan jemput jenazah</button> </a>
                    </div>
                </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Hapus Transaksi Jemput Jenazah</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    Apakah anda yakin akan menghapus transaksi ini?
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" id="buttonDelete"><i class="fa fa-times"></i> Hapus</button>
                    <button class="btn btn-alt-danger" style="display: none" type="button"  id="buttonLoading">
                    <i class="fa fa-asterisk fa-spin"></i> Loading
                    </button>
                  </div>
                </div>
              </div>
            </div>
@endsection

@section('js')

<script type="text/javascript">
    var myRoomNumber;

    $('#exampleModalCenter').on('show.bs.modal', function (e) {
    myRoomNumber = $(e.relatedTarget).attr('data-id');
});

    $('#buttonDelete').unbind().click(function() {

        $('#buttonDelete').hide();
        $('#buttonLoading').show();

        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        transaksi = myRoomNumber;

        var formData = new FormData();
        formData.append('transaksi',transaksi);

        $.ajax({
            type: "POST",
            url: API_URL + "/kamarjenazah/transaksi/delete",
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
                callSwal('error','Transaksi Gagal','Silahkan Coba Lagi',0);
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
            url: API_URL + '/kamarjenazah/transaksi/get?page='+ currentPage ,
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


<script id="template-jenazahlist" type="x-tmpl-mustache">
  var idx = 0;
  //  var html = Mustache.render(template, data);

    @{{#data}}
    <tr>
        <td class="clickable-row" data-href="{{url('kamarjenazah/detil-transaksi')}}/@{{id}}">@{{id}}</td>
        <td class="clickable-row" data-href="{{url('kamarjenazah/detil-transaksi')}}/@{{id}}">@{{nama}}</td>
        <td class="clickable-row" data-href="{{url('kamarjenazah/detil-transaksi')}}/@{{id}}">@{{waktu_kematian}}</td>
        <td class="clickable-row" data-href="{{url('kamarjenazah/detil-transaksi')}}/@{{id}}">@{{total_invoice}}</td>
        <td class="clickable-row" data-href="{{url('kamarjenazah/detil-transaksi')}}/@{{id}}">@{{waktu_pembuatan}}</td>
        <td>
            <a href="{{url('kamarjenazah/transaksi/edit')}}/@{{id}}" class="btn btn-warning pull-left mb-5" style="margin-right:8px;">Edit</a>
            <button class="btn btn-danger pull-left" type="button" data-toggle="modal" id="buttonModal" data-target="#exampleModalCenter" data-id="@{{id}}"><i class="fa fa-times"></i> Hapus</button>
        </td>
    </tr>
    @{{/data}}
</script>

@endsection
