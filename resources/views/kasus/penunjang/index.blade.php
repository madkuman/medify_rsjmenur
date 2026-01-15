@extends('kasus.layouts.main')

@section('title')
{{$kasus->judul_kasus}}  - Penunjang - Kasus
@endsection

@section('css')
<style type="text/css">
.avatar-preview {
    border-radius: 0;
}
.avatar-preview div {
    border-radius: 0;
}
.avatar-upload {
    margin: 20px auto;
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
                                    <a class="nav-link  @if (session('active_nav') != 'galeri') active @endif" href="#permintaan" id="nav-permintaan">Permintaan Penunjang</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link @if (session('active_nav') == 'galeri') active @endif" href="#galeri" id="nav-galeri">Galeri Hasil Penunjang</a>
                                </li>
                                
                            </ul>
                            <div class="block-content tab-content overflow-hidden">
                                <div class="tab-pane fade fade-left @if (session('active_nav') != 'galeri')  show active @endif" id="permintaan" role="tabpanel">
                                    @include('kasus.penunjang.content.permintaan.index')
                                </div>
                                <div class="tab-pane fade fade-left @if (session('active_nav') == 'galeri') show active @endif" id="galeri" role="tabpanel">
                                    @include('kasus.penunjang.content.galeri.index')
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

<form id="form-penunjang-galeri-delete" method="POST" action="{{url('')}}/kasus/{{$kasus->nomor_kasus}}/penunjang/delete">
    <input type="hidden" name="id" class="input-id">
    {{csrf_field()}}
</form>
@include('kasus.penunjang.content.galeri.create')
@include('kasus.penunjang.content.galeri.modals')

@endsection

@section('js')
<script type="text/javascript" src="{{asset('js/kasus/penunjang/tambah-penunjangv1.2.js?time='.microtime(true))}}"></script>
<script type="text/javascript">

 function tolakTransaksi(id,modul,slug){
    swal({
        title: 'Apa anda yakin?',
        input: 'text',
        text: "Mengapa anda membatalkan permintaan ini?",
        type: 'warning',
        confirmButtonClass: 'btn btn-primary',
        cancelButtonClass: 'btn btn-outline-danger',
        showCancelButton: true,
        confirmButtonText: 'Batalkan Permintaan',
        cancelButtonText: 'Batal',
        inputValidator: (value) => {
            return !value && 'Masukan Alasan Pembatalan!'
        }
    }).then((result) => {
        if (result.value) {
            switch(modul)
            {
                case 6:
                $('#formTolak').prop('action','{{url("radiologi/transaksi/cancel")}}/'+slug+'');
                break;
                case 10:
                $('#formTolak').prop('action','{{url("labpk/transaksi/cancel")}}/'+slug+'');
                break;
                case 11:
                $('#formTolak').prop('action','{{url("labpa/transaksi/cancel")}}/'+slug+'');
            } 
            console.log(modul);
            $('#tolakketerangan').val(result.value)
            $('#modulId').val(modul)            
            $('#tolakId').val(id)
            $('#formTolak').submit()
        }
    })
}
$(document).ready(function(){
    Codebase.helpers(['select2']);
});
function showModal() {
    $('#modal').modal('show');
}


$('.lg-backdrop').click(function(){
    alert('hide');
})

function editPenunjang(id)
{
    $(".show-container-"+id).hide();
    $(".edit-container-"+id).show();
}

function editPenunjangCancel(id)
{
    $(".show-container-"+id).show();
    $(".edit-container-"+id).hide();
}

function deletePenunjang(id)
{
    swal({
        title: "Hapus",
        text: "Apakah anda yakin akan menghapus hasil penunjnang ini?",
        showCancelButton: true,
        reverseButtons: true,
        type: 'warning',
        confirmButtonClass: "btn btn-danger",
        cancelButtonClass: "btn btn-default",
        confirmButtonText: "Hapus",
        cancelButtonText: "Kembali",
        closeOnConfirm: false
    }).then(function(result) {
        if(result.value){
            $('#inputIDDelete').val(id)
            $('#formDelete').submit();
        }
    });
}
</script>
<script type="text/javascript">
    window.onhashchange = locationchange;

    function locationchange()
    {   
        var lokasi = location.hash;
        var satuan = lokasi.split("");
        satuan.splice(0,1);
        var hash = satuan.join("");
        console.log(location.hash);
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

    console.log($(this).attr('href'));
    location.hash = $(this).attr('href');
});

});

$(document).ready(function() {
   locationchange();
});

function cetakBarcode(barcode,slug)
{
    window.open(
    "{{url('kasus')}}/{{$kasus->nomor_kasus}}/penunjang/print-barcode/"+barcode+'/'+slug,"popUpWindow",
    "height=800,width=800,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes");
   
}
function historiPermintaan()
{   
    window.open(
    "{{url('kasus')}}/{{$kasus->nomor_kasus}}/penunjang/histori","popUpWindow",
    "height=800,width=800,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes");
    
}
function historiGaleriPermintaan()
{   
    window.open(
    "{{url('kasus')}}/{{$kasus->nomor_kasus}}/penunjang/histori-galeri","popUpWindow",
    "height=800,width=800,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes");
    
}

$('.btn-delete-galeri-item').click(function(){
    var title = $(this).data('title')
    var id = $(this).data('id')
    swal({
        title: 'Apakah Anda Yakin?',
        text: "File "+title+" akan terhapus dari sistem",
        type: 'warning',
        showCancelButton: true,
        confirmButtonClass: 'btn btn-secondary',
        cancelButtonClass: 'btn btn-primary',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batalkan'
    }).then((result) => {
        if(result.value){
            $('#form-penunjang-galeri-delete .input-id').val(id)
            $('#form-penunjang-galeri-delete').submit();
        }
    })
})

    function cetakpermintaan(departemen,slug,dpjp){
        if(dpjp == 'kosong'){
            swal('Gagal',
                'Kasus belum memiliki DPJP',
                'error');
            return true;
        }else{
            window.open("{{url('')}}/"+departemen+"/transaksi/cetak/permintaan/"+slug,
                'newwindow',
                `width=${screen.width},height=${screen.height}`);
            return false;
        }
    }
</script>

@endsection