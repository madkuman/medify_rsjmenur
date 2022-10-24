@extends('kasus.layouts.main')

@section('title')
{{$kasus->judul_kasus}}  - Pengaturan - Kasus
@endsection

@section('css')
<style type="text/css">
.view-resume{
    white-space: pre-line;
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
                        <div class="block">
                            <div class="block-content pb-15">
                                <h4 class="my-0">Pengaturan Kasus</h4>
                                <hr class="my-20">
                                @include('kasus.pengaturan.components-index.krs')
                                @include('kasus.pengaturan.components-index.keluar-kasus')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Updates -->
        </div>
    </div>
</main>



<!--MODAL-->

<form method="POST" action="{{url()->current()}}/tutup-kasus" id="formClose">
    {{csrf_field()}}
</form>



@endsection

@section('js')
<script src="{{url('')}}/assets/js/plugins/jquery-masked-inputs/jquery.mask.min.js"></script>
<script type="text/javascript">
    $('#example-datepicker1').datepicker();
    $(document).ready(function() {
        @if(!empty($kasus->krs_alasan))
        $('#alasan_krs').val('{{$kasus->krs_alasan}}').trigger('change');
        @endif

        @if(!empty($kasus->krs_status))
        $('#status_krs').val('{{$kasus->krs_status}}').trigger('change');
        @endif

        @if(isset($rujuk))
        $('#alasan_krs > option').each(function() {
            if($(this).data('rujuk') == 1){
                $(this).prop('selected', true).trigger('change');
                $('[name="alasan_krs_selected"]').val($(this).val())
            }
        })
        @endif
    });

    $('#status_krs').on('change', function() {
        if ($('#status_krs :selected').data('meninggal') == 1) {
            $('#death_date').prop('required',true);
            $('#death_time').prop('required',true);
            $('#div_waktu_kematian').show();
            $('.time').mask('00:00');
        }
        else {
            $('#death_date').removeAttr('required');
            $('#death_time').removeAttr('required');
            $('#div_waktu_kematian').hide();
        }
    });

    $('#alasan_krs').on('change', function() {
        if ($('#alasan_krs :selected').data('aps') == 1) {
            $('#div_keterangan_aps').show();
        }
        else {
            $('input[name="krs_keterangan"]').val('');
            $('#div_keterangan_aps').hide();
        }
    });

    $('#alasan_krs').on('change', function() {
        if ($('#alasan_krs :selected').data('rujuk') == 1) {
            $('#div_keterangan_rujuk').show();
        }
        else {
            $(`.asal-rujukan-select`).val("");
            $(`.asal-rujukan-select`).select2().trigger("change");
            $('#div_keterangan_rujuk').hide();
        }
    });

    function alasanKRS(){
        @if(!isset($rujuk) && $kasus->sep_id != 0)
        if($('#alasan_krs :selected').data('rujuk') == 1){
            $('#rujukan_wrapper').show();
        }else{
            $('#rujukan_wrapper').hide();
        }
        @endif
    }

    function submitClose()
    {
        swal({
            title: 'Tutup Kasus?',
            text: "Anda akan menutup kasus, data tetap bisa anda akses pada arsip.",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Tutup Kasus!',
            confirmButtonClass: 'btn btn-primary ml-10',
            cancelButtonClass: 'btn btn-outline-danger ',
            buttonsStyling: false,
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                $('#formClose').submit();
            }
        })
    }

    function confirmKeluarKasus()
    {
        swal({
            title: 'Keluar dari Kasus?',
            text: "Anda akan keluar dari kasus. Anda tidak dapat mengakses ke kasus ini lagi",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Keluar Kasus!',
            confirmButtonClass: 'btn btn-primary ml-10',
            cancelButtonClass: 'btn btn-outline-danger ',
            buttonsStyling: false,
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                $('#keluarKasusForm').submit();
            }
        })
    }

    function confirmKRS()
    {
        if(! $('#confirmKRSForm')[0].checkValidity()) {
            // If the form is invalid, submit it. The form won't actually submit;
            // this will just cause the browser to display the native HTML5 error messages.
            $('#confirmKRSForm').find(':submit').click();
        }
        else{
            var pasien_name = "{{$kasus->identitas->nama}}";
            var prompt_text = "Anda akan menyimpan data KRS Pasien "+pasien_name+". Proses ini permanen dan tidak bisa diulang kembali.";
            swal({
                title: 'Simpan data KRS?',
                text: prompt_text,
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Simpan Data KRS!',
                confirmButtonClass: 'btn btn-primary ml-10',
                cancelButtonClass: 'btn btn-outline-danger ',
                buttonsStyling: false,
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    $('#confirmKRSForm').submit();
                }
            });
        }
    }

    function printResume(index) {
        var url = "{{url()->current()}}/resume/print/"+index;
        popupwindow(url,'Stok Barang Tiap Farmasi',620,1000);

    }

    function bpjsRujuk() {
        @if(!isset($rujuk) && $kasus->sep_id != 0 && !empty($kasus->active_sep))
            // popupwindow("{{url('')}}/bpjs/rujukan/create?window=true&pasien_id={{$kasus->pasien_id}}&kasus_id={{$kasus->id}}&no_sep={{$kasus->active_sep->no_sep}}", "Buat Rujukan Baru", 800, 800);
            window.location = "{{url('')}}/bpjs/rujukan/create?window=true&pasien_id={{$kasus->pasien_id}}&kasus_id={{$kasus->id}}&no_sep={{$kasus->active_sep->no_sep}}&from_kasus=1";
        @else
            callSwal("error", "Gagal!", "Kasus Tidak Memiliki SEP", "");
        @endif
    }

    $('#button_rujuk_bpjs').on('click', function(){
        @if(isset($rujuk))
        popupwindow(BASE_URL+"bpjs/rujukan-keluar/{{$rujuk->no_rujukan}}?window=true", "Detail Rujukan", 500, 900);
        @endif
    });

    function editKRS() {
        $('#form-krs').show();
        $('#data-krs').hide();
    }

    $('.js-select2').select2();

    $('#btn-batal-krs').on('click',function(e){
        $(this).prepend('<i class="fa fa-spinner fa-spin mr-2"></i>');
        $(this).addClass("disabled");
    })
    $('#btn-batal-tutup-kasus').on('click',function(e){
        $(this).prepend('<i class="fa fa-spinner fa-spin mr-2"></i>');
        $(this).addClass("disabled");
    })
</script>
@endsection