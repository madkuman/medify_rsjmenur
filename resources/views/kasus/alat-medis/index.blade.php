@extends('kasus.layouts.main')

@section('title')
{{$kasus->judul_kasus}} - Penunjang - Kasus
@endsection

@section('css')

<style type="text/css">

    .btn_delete {
        width: 80%;
    }

</style>
@endsection

@section('content')

<!-- Main Container -->
<main id="main-container">
    @include('kasus.layouts.header')

    <div class="content">
        <div class="row">
            @include('kasus.layouts.sidebar')

            <!-- Updates -->
            <div class="col-lg-4 col-xl-9">
                <div class="row">
                    <div class="col-lg-12">
                        @if(empty($kasus->pasien_id))
                        <div class="block">
                            <div class="block-content tab-content overflow-hidden">
                                <div class="col-12 text-center py-50">
                                    <h4 class="font-w400 mb-5">Data pasien belum tersinkronisasi. Silahkan lakukan Sinkronisasi dahulu</h4>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="block">
                            <ul class="nav nav-tabs nav-tabs-block nav-justified nav-primary" data-toggle="tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link @if (session('active_nav') == 'permintaan') active @endif" href="#permintaan" id="nav-permintaan">Penggunaan Alat Medis</a>
                                </li>        
                            </ul>
                            <div class="block-content tab-content overflow-hidden">
                                <div class="tab-pane fade fade-left @if (session('active_nav') == 'permintaan') show active @endif" id="permintaan" role="tabpanel">
                                    @include('kasus.alat-medis.content.permintaan')
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <!-- END Updates -->
        </div>
    </div>
</main>
<!-- END Main Container -->    
<form method="POST" action="{{url()->current()}}/permintaan" id="formPermintaan">
    {{csrf_field()}}
</form>
<form method="POST" action="{{url()->current()}}/selesai" id="formSelesai">
    {{csrf_field()}}
    <input type="hidden" name="nomor_kasus" value="{{$kasus->id}}">
</form>


<!--MODAL-->
@include('kasus.alat-medis.content.modals.permintaan')
@include('kasus.alat-medis.content.modals.selesai')

@endsection

@section('js')


<script type="text/javascript">
    window.onhashchange = locationchange;

    function locationchange()
    {   
        var lokasi = location.hash;
        var satuan = lokasi.split("");
        satuan.splice(0,1);
        var hash = satuan.join("");
        if(lokasi === '')
        {
            $('.tab-pane').removeClass('show active');
            $('.nav-link').removeClass('active');
            $('#permintaan').addClass('show active');
            $('#nav-permintaan').addClass('active');    
        }
        else
        {
            $('.tab-pane').removeClass('show active');
            $('.nav-link').removeClass('active');
            $(''+lokasi+'').addClass('show active');
            $('#nav-'+hash+'').addClass('active');    
        }
    }

    $(".nav-tabs").find("li a").last().click();

    var url = document.URL;
    var hash = url.substring(url.indexOf('#'));

    $(".nav-tabs").find("li a").each(function(key, val) {
        if (hash == $(val).attr('href')) {
            $(val).click();
        }
        $(val).click(function(ky, vl) {
            location.hash = $(this).attr('href');
        });
    });

    $(document).ready(function() {
       locationchange();
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $(".items_template_dropdown").select2({
            dropdownParent: $("#modalAlatMedisBaru")
        });

        $(".add_more").click(function(){
            append();
        });

        $(".selesai").click(function(){
            var idnya = $(this).attr("items_template_id");
            var jumlah = $(this).attr("jumlah");

            $("#items_template_id").val(idnya);
            $("#jumlah_pengembalian").val(jumlah);
            $("#jumlah_pengembalian").attr('max', jumlah);
        });
    });

    function permintaanGagal(){
        swal("Permintaan Gagal!", "", "error");
    }

    function tolakTransaksi(id){
        swal({
            title: 'Apa anda yakin membatalkan permintaan alat medis?',
            type: 'warning',
            confirmButtonClass: 'btn btn-primary',
            cancelButtonClass: 'btn btn-outline-danger',
            showCancelButton: true,
            confirmButtonText: 'Batalkan Permintaan',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.value) {            
                $('#tolakId').val(id)
                $('#formTolak').submit()
            }
        })
    }

    function append(argument) {
        $("#permintaan_alat_medis").append(`
            <div class="form-group row form_alat_medis" >
                <div class="col-6">
                    <label>Nama Alat Medis</label>
                    <select class="js-select2 form-control items_template_dropdown" name="items_template_id[]" data-width="100%" data-placeholder="Pilih Alat Medis" required>
                        <option value="" selected="" disabled="">Pilih</option>
                        @foreach($item_template as $per_data)
                             <option value="{{$per_data->id}}">{{$per_data->name}} (Tersedia : {{$per_data->item_alat_medis_count}})</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-4">
                    <label>Jumlah</label>
                    <input type="number" name="jumlah[]" class="form-control">
                </div>
                <div class="col-2">
                    <label>&nbsp;</label>
                    <button type="button" class="btn btn-danger btn_delete form-control" onclick="delete_button(this)"><i class="fa fa-trash"></i></button>
                </div>
            </div>`);

        $(".items_template_dropdown").select2({
            dropdownParent: $("#modalAlatMedisBaru")
        });
    }

    function delete_button(param) {
        $(param).parents('.form_alat_medis').remove();
    }

</script>

@endsection