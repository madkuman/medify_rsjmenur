@extends('urikkes.layouts.main')

@section('title')
Laporan - Medical Checkup
@endsection

@section('subtitle')
Daftar Paket Layanan
@endsection

@section('content')
<main id="main-container">
    @include('urikkes.layouts.navbar')
    <div class="content">
        <div class="row gutters-tiny" >
            <div class="col-xl-12">
                <div class="row">
                    <div class="col-3 mb-20 d-none">
                        <a class="block block-bordered block-link-shadow" style="height:100%;" href="#" data-toggle="modal" data-target="#modal-hasil">
                            <div class="block-content block-content-full">
                                <div class="mb-10 text-center">
                                    <h4><span class="font-w500">Hasil Uji dan Pemeriksaan Kesehatan</span></h4>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-3 mb-20 d-none">
                        <a class="block block-bordered block-link-shadow" style="height:100%;" href="#" data-toggle="modal" data-target="#modal-rekap">
                            <div class="block-content block-content-full">
                                <div class="mb-10 text-center">
                                    <h4><span class="font-w500">Rekapitulasi Hasil Uji dan Pemeriksaan Kesehatan</span></h4>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-3 mb-20 d-none">
                        <a class="block block-bordered block-link-shadow" style="height:100%;" href="#" data-toggle="modal" data-target="#modal-diskesal">
                            <div class="block-content block-content-full">
                                <div class="mb-10 text-center">
                                    <h4><span class="font-w500">Laporan Integrasi Sistem Diskesal</span></h4>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-3 mb-20 d-none">
                        <a class="block block-bordered block-link-shadow" style="height:100%;" href="#" data-toggle="modal" data-target="#modal-pasien-umum">
                            <div class="block-content block-content-full">
                                <div class="mb-10 text-center">
                                    <h4><span class="font-w500">Laporan Pasien Umum</span></h4> </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-3 mb-20 d-none">
                        <a class="block block-bordered block-link-shadow" style="height:100%;" href="#" data-toggle="modal" data-target="#modal-pamen-pns-jiwa-treadmill">
                            <div class="block-content block-content-full">
                                <div class="mb-10 text-center">
                                    <h4><span class="font-w500">Laporan Pamen dan PNS Gol IV yang melaksanakan Urikkes Jiwa dan Treadmill</span></h4> </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-3 mb-20">
                        <a class="block block-bordered block-link-shadow" style="height:100%;" href="#" data-toggle="modal" data-target="#modal-rekap-transaksi">
                            <div class="block-content block-content-full">
                                <div class="mb-10 text-center">
                                    <h4><span class="font-w500">Laporan Rekap Transaksi Medical Checkup</span></h4> </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@include('urikkes.components.modals.modal_hasil')
@include('urikkes.components.modals.modal_rekap')
@include('urikkes.components.modals.modal_diskesal')
@include('urikkes.components.modals.modal_pasien_umum')
@include('urikkes.components.modals.modal_pamen_pns_jiwa_treadmill')
@include('urikkes.components.modals.modal_rekap_transaksi')
@endsection

@section('js')
<script type="text/javascript">
    
    $(document).on('click', '.btn-submit', function(){
        $(this).parent().unbind('submit').submit();
    })

    $('.kesatuan-select').select2({
        width: '100%',
        placeholder: "Pilih Kesatuan", 
    });
    $('.satker-select').select2({
        width: '100%',
        placeholder: "Pilih Kesatuan Terlebih Dahulu", 
    });

    $('.dokter_laporan').select2({
        width: '72%',
        placeholder: "Pilih TTD Dokter", 
        templateResult: formatOutput
    });

    function formatOutput (item) {
        var lengkap = $(item.element).data('sebagai') + " - " + item.text + " - " + $(item.element).data('keterangan');
        return lengkap;
    };

    $('.get-by').click(function() {
        var target = $(this).data('field');
        console.log(target);
        var sibling = $(`#${target}`).siblings('fieldset');
        sibling.prop('disabled', true);
        sibling.hide();
        $(`#${target}`).show();
        $(`#${target}`).prop('disabled', false);        
    });


    $('.satker-loading').hide();

    $('.kesatuan-select').on("select2:select", function(e) {
        id = $(this).val();
        var target = $(this).data('satker');
        getSatker(id, $(`#${target}-satker`), $(`#${target}-satker-loading`));
    });

    function getSatker(id, satker, satkerLoading)
    {
        satkerLoading.show();
        $.ajax({
            type:'GET',
            url:API_URL + '/pasien/satker/get/'+id,
            dataType: 'json',
            success:function(data){
                console.log(data);
                satker.html('').select2({
                    data: [{id: '', text: ''}],
                    width: '100%',
                    placeholder: "Pilih Satker", 
                });
                data.forEach(function(item) {
                    var newOption = new Option(item.nama, item.id, false, false);
                    satker.append(newOption).trigger('change');
                });
                satkerLoading.fadeOut();
            },
            error:function(data){
                console.log(data);
            }
        });
    }
    //display tahun aja
    $(".tahun_aja").datepicker( {
        format: " yyyy", // Notice the Extra space at the beginning
        viewMode: "years", 
        minViewMode: "years"
    });
    
</script>
@endsection