@extends('laundry.layouts.main')

@section('title')
Laundry Transaksi - Medify
@endsection


@section('sidebar')
    @include('laundry.layouts.components.sidebar2')
@endsection

@section('content')
<div class="col-md-12 bg-white pull-right" style="margin-left:40px;">
    <div>
        <h5 class="block-title" style="float:left; margin-top:25px;">Transaksi Pencucian</h5><br>
    </div>
    <div style="margin-top:50px;width:100%;">
        <hr>
    </div>
    <div id="noResult" style="display: none">
        <div class="text-center py-50">
            Permintaan tidak ditemukan. Silahkan coba dengan kata kunci lainnya <br>
            <br><br>
        </div>
    </div>
    <div class="col-md-12">
        <div class="table-full-width spinner-container" id="PermintaanResult">
            <div class="spinner-back">
                <table class="table table-hover table-pointer ">
                    <thead>
                        <tr class="header">
                            <th width="5%" class="text-left">#</th>
                            <th width="5%" class="text-left">Ruangan</th>
                            <th width="20%" class="text-left">Diserahkan</th>
                            <th width="20%" class="text-left">Diterima</th>
                            <th width="20%" class="text-left">Penerima</th>
                            <th width="15%" class="text-left">Dikembalikan</th>
                            <th width="15%" class="text-left">Status</th>
                        </tr>
                    </thead>
                    <tbody class="spinner-back-placeholder col-md-12">
                        @for ($i = 0; $i < 10; $i++)
                        <tr class="clickable-row">
                            <td class="py-10 px-10"><div class=" bg-primary-lighter">&nbsp;</div></td>
                            <td class="py-10 px-10"><div class=" bg-primary-lighter">&nbsp;</div></td>
                            <td class="py-10 px-10"><div class=" bg-primary-lighter">&nbsp;</div></td>
                            <td class="py-10 px-10"><div class=" bg-primary-lighter">&nbsp;</div></td>
                            <td class="py-10 px-10"><div class=" bg-primary-lighter">&nbsp;</div></td>
                            <td class="py-10 px-10"><div class=" bg-primary-lighter">&nbsp;</div></td>
                            <td class="py-10 px-10"><div class=" bg-primary-lighter">&nbsp;</div></td>
                        </tr>
                        @endfor
                    </tbody>
                    <tbody id="renderPermintaan"></tbody>
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
<script id="template" type="text/template">
    @{{#data}}
    <tr class="clickable-row" data-href="{{url('laundry/permintaan/detil-permintaan')}}/@{{id}}">
        <td class="text-left">@{{id}}</td>
        <td class="text-left">@{{group_id}}</td>
        <td class="text-left">@{{waktu_diserahkan}}</td>
        <td class="text-left">@{{waktu_diterima}}</td>
        <td class="text-left">@{{nama_penerima}}</td>
        <td class="text-left">@{{waktu_dikembalikan}}</td>
        <td class="text-left @{{warna_status}}">@{{nama_status}}</td>
    </tr>
    @{{/data}}
</script>



<script type="text/javascript">
    $('#select').select2();
    $('.js-select2').select2();
    // $('#tgl_min').bootstrapMaterialDatePicker({ weekStart : 0, time: false });
    // $('#tgl_max').bootstrapMaterialDatePicker({ weekStart : 0, time: false });
    // $('#tgl_min2').bootstrapMaterialDatePicker({ weekStart : 0, time: false });
    // $('#tgl_max2').bootstrapMaterialDatePicker({ weekStart : 0, time: false });
    // $('#tgl_min').bootstrapMaterialDatePicker({ weekStart : 0, time: false, format : 'DD/MM/YYYY' });
    // $('#tgl_max').bootstrapMaterialDatePicker({ weekStart : 0, time: false, format : 'DD/MM/YYYY'  });
    // $('#tgl_min2').bootstrapMaterialDatePicker({ weekStart : 0, time: false, format : 'DD/MM/YYYY'  });
    // $('#tgl_max2').bootstrapMaterialDatePicker({ weekStart : 0, time: false, format : 'DD/MM/YYYY'  });

</script>

<script type="text/javascript">
    var total_pages = 1;
    var visible_pages = 5;
    var items_show = 10;
    var firstLoadPagination = false;
    var grup = '';
    var tgl_min ='';
    var tgl_max ='';
    var proses = [];
    var tgl_min2 = '';
    var tgl_max2 = '';
    var counter = 0;
    loadData(1,grup,tgl_min,tgl_max,proses,counter,tgl_min2,tgl_max2);

    function loadPagination(currentPage = 1)
    {

        $('#pagination').twbsPagination('destroy');
        $('#pagination').twbsPagination({
            totalPages: total_pages,
            startPage: currentPage,
            visiblePages: visible_pages,
            initiateStartPageClick: false,
            onPageClick: function (event, page) {
            loadData(page,grup,tgl_min,tgl_max,proses,counter,tgl_min2,tgl_max2);

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

    $('#Filter').submit(function( event ) {
        event.preventDefault();
        event.stopImmediatePropagation();
        counter = 0;
        grup = $('#ruanganSelect2').val();
        tgl_min = $('#tgl_min').val();
        tgl_max = $('#tgl_max').val();
        tgl_min2 = $('#tgl_min2').val();
        tgl_max2 = $('#tgl_max2').val();
        idx_proses = ['proses_penerimaan','proses_cuci','proses_kembali','proses_terima','proses_selesai'];
        proses = [];
        for (var i = 0; i < 5; i++) {
          if ($('#'+idx_proses[i]).prop("checked")){
            proses.push(parseInt($('#'+idx_proses[i]+':checked').val()));
            counter += 1;
          }
        }
        proses_penerimaan = $('#proses_penerimaan:checked').val();
        proses_cuci = $('#proses_cuci:checked').val();
        proses_kembali = $('#proses_kembali:checked').val();
        proses_terima = $('#proses_terima:checked').val();
        proses_selesai = $('#proses_selesai:checked').val();

        loadData(1,grup,tgl_min,tgl_max,proses,counter,tgl_min2,tgl_max2);
    });


    function loadData(currentPage=1,grup='',tgl_min='',tgl_max='',proses='',counter='',tgl_min2='',tgl_max2='')
    {
        $('.spinner').fadeIn();
        $('#noResult').hide();
        $('#PermintaanResult').show();
        $('#renderPermintaan').hide();
        $('.spinner-back-placeholder').show();
        $.ajax({
            url:  API_URL + '/laundry/transaksi/get?page='+ currentPage +
                                                        '&grup=' + grup +
                                                        '&tgl_min=' + tgl_min +
                                                        '&tgl_max=' + tgl_max +
                                                        '&tgl_min2=' + tgl_min2 +
                                                        '&tgl_max2=' + tgl_max2 +
                                                        '&proses=' + proses +
                                                        '&counter=' + counter,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                if(data.total>0)
                {  console.log(data);
                    $('#noResult').hide();
                    $('#PermintaanResult').show();
                    total_pages = Math.ceil(data.total/items_show);
                    var template = $('#template').html();
                    loadMustache(template);
                    var rendered = Mustache.render(template, data);
                    $('.spinner').fadeOut();
                    $('#renderPermintaan').show();
                    $('#renderPermintaan').html(rendered);
                    $('.spinner-back-placeholder').hide();
                    loadPagination(currentPage);
                }
                else
                {
                    $('.spinner').fadeOut();
                    $('#noResult').fadeIn();
                    $('#PermintaanResult').hide();
                    $('.spinner-back-placeholder').hide();
                }
            },
            error: function() {
                alert('gagal load data');
            },
        });
    }

    function loadMustache(template) {
        Mustache.parse(template, customTags);
        Mustache.tags = customTags;
    }

</script>

@endsection
