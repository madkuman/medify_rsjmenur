@extends('kasus.layouts.main')
@section('title')
  {{$kasus->judul_kasus}}  - Pemeriksaan Urikkes
@endsection

@section('css')

<style type="text/css">
#modal-create-evaluasi {
            padding-right: 0 !important;
            padding-left: 0 !important;
        }
.modal-gede {
            padding-right: 0 !important;
            padding-left: 0 !important;
        }
.stakes-select {
    min-width: 70px;
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
                        <div class="block rounded p-0">
                            @include('kasus.urikkes.components.navbar')
                            <div class="block-content tab-content">
                                <div class="tab-pane fade fade-left
                                @if (empty($nav_active) || $nav_active == 'layanan' )
                                show active
                                @endif
                                " id="layanan" role="tabpanel">
                                @include('kasus.urikkes.content.layanan.index')
                                </div>
                                <div class="tab-pane fade fade-left
                                @if (isset($nav_active) && $nav_active == 'evaluasi')
                                show active
                                @endif
                                " id="evaluasi" role="tabpanel">
                                @include('kasus.urikkes.content.evaluasi-klinis.index')
                                </div>
                                <!-- <div class="tab-pane fade fade-left
                                @if (isset($nav_active) && $nav_active == 'mata')
                                show active
                                @endif
                                " id="mata" role="tabpanel">
                                @include('kasus.urikkes.content.mata.index')
                                </div> -->

                                <div class="tab-pane fade fade-left
                                @if (isset($nav_active) && $nav_active == 'gigi')
                                show active
                                @endif
                                " id="gigi" role="tabpanel">
                                @include('kasus.urikkes.content.gigi.index')
                                </div>

                                <div class="tab-pane fade fade-left
                                @if (isset($nav_active) && $nav_active == 'telinga')
                                show active
                                @endif
                                " id="telinga" role="tabpanel">
                                @include('kasus.urikkes.content.telinga.index')
                                </div>
                                <div class="tab-pane fade fade-left
                                @if (isset($nav_active) && $nav_active == 'resume')
                                show active
                                @endif
                                " id="resume" role="tabpanel">
                                @include('kasus.urikkes.content.resume.index')
                                </div>

                                <div class="tab-pane fade fade-left
                                @if (isset($nav_active) && $nav_active == 'laporan')
                                show active
                                @endif
                                " id="laporan" role="tabpanel" style="">
                                @include('kasus.urikkes.content.laporan.index')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Updates -->
        </div>
    </div>
</main>
<!-- END Main Container -->

<!-- MODAL INCLUDE SINI -->



@include('kasus.urikkes.content.evaluasi-klinis.modals.modal-create')
@include('kasus.urikkes.content.evaluasi-klinis.modals.modal-edit')
@include('kasus.urikkes.content.evaluasi-klinis.modals.modal-delete')

{{-- @include('kasus.urikkes.content.mata.modals.modal-create')
@include('kasus.urikkes.content.mata.modals.modal-edit')
@include('kasus.urikkes.content.mata.modals.modal-delete') --}}


@include('kasus.urikkes.content.gigi.modals.modal-create')
@include('kasus.urikkes.content.gigi.modals.modal-edit')
@include('kasus.urikkes.content.gigi.modals.modal-delete')


@include('kasus.urikkes.content.telinga.modals.modal-create')
@include('kasus.urikkes.content.telinga.modals.modal-edit')
@include('kasus.urikkes.content.telinga.modals.modal-delete')

@include('kasus.urikkes.content.resume.modals.modal-create')
@include('kasus.urikkes.content.resume.modals.modal-edit')
@include('kasus.urikkes.content.resume.modals.modal-delete')

@include('kasus.urikkes.content.laporan.modals.fisik')
@include('kasus.urikkes.content.laporan.modals.napza')
@include('kasus.urikkes.content.laporan.modals.sk_dokter')
@include('kasus.urikkes.content.laporan.modals.sk_keswa')
@endsection

@section('js')
<script src="{{asset('plugins/tinymce/tinymce.min.js')}}"></script>
<script src="{{url('')}}/assets/js/plugins/jquery-masked-inputs/jquery.mask.min.js"></script>

<script type="text/javascript">

jQuery(function () {
    Codebase.helpers(['datepicker', 'colorpicker', 'maxlength', 'select2', 'masked-inputs', 'rangeslider', 'tags-inputs']);
});
//layanan & jiwa & resume
    tinymce.init({
        selector: '.wysiwyg'
    });

//umum



//klinis
  $('.ket').hide();
  $('#print_sebagian').hide();


  $('#print_all').click(function() {
    console.log($(this));
    if(! $(this).children("input[type='checkbox']").is(':checked')){
      $(this).siblings("#print_sebagian").show();
    }else{
      $(this).siblings("#print_sebagian").hide();
    }
  });

  $('.pilih').on('change', function(){
    console.log($(this).children('.tidak-normal')[0]);
    if($($(this).children('.tidak-normal')[0]).is(':selected'))
    {
        $(this).siblings(".ket").show();
         $('.ket-edit').show();
    }
    if($($(this).children('.normal')[0]).is(':selected'))
    {
        $(this).siblings(".ket").hide();
         $('.ket-edit').hide();
    }
  });

  /*$('.tidak-normal').click(function() {
    console.log($(this));
    if($(this).is(':selected')){
      $(this).siblings(".ket").show();
    }
  });*/


  /*$('.normal').click(function() {
    console.log($(this));
    if($(this).is(':selected')){
      $(this).parent().siblings(".ket").hide();
    }
  });*/

    
    @foreach($evaluasi as $key => $eval)
        $('#modal-edit-eval{{$key}} .tidak-normal').each(function(){
            if($(this).children("input[type='radio']").is(':checked')){
              $(this).siblings(".ket").show();
            }
        });
        $('#modal-edit-eval{{$key}} .normal').each(function(){
            if($(this).children("input[type='radio']").is(':checked')){
              $(this).siblings(".ket").hide();
            }
        }); $('#modal-edit-mata{{$key}} .tidak-normal').each(function(){
            if($(this).children("input[type='radio']").is(':checked')){
              $(this).siblings(".ket").show();
            }
        });
        $('#modal-edit-mata{{$key}} .normal').each(function(){
            if($(this).children("input[type='radio']").is(':checked')){
              $(this).siblings(".ket").hide();
            }
        });
    @endforeach

    $(".nav-tabs").find("li a").last().click();

    var url = document.URL;
    var hash = url.substring(url.indexOf('#'));

    $(".nav-tabs").find("li a").each(function(key, val) {

      if (hash == $(val).attr('href')) {
        $(val).click();
      }
      $(val).click(function(ky, vl) {
        console.log($(this).attr('href')+"1");
        location.hash = $(this).attr('href');
      });

    });

   window.onhashchange = locationchange;
    function locationchange()
    {   
        var lokasi = location.hash;
        var satuan = lokasi.split("");
        satuan.splice(0,1);
        var hash_baru = satuan.join("");
        console.log(location.hash_baru+"2");
        if(lokasi === '')
        {
            $('.tab-pane').removeClass('show active');
            $('.nav-link').removeClass('active');
            $('#layanan').addClass('show active');
            $('#nav-layanan').addClass('active');    
        }
        else
        {
            $('.tab-pane').removeClass('show active');
            $('.nav-link').removeClass('active');
            $(''+lokasi+'').addClass('show active');
            $('#nav-'+hash_baru+'').addClass('active');    
        }
    }
    
   $(document).ready(function() {
        locationchange();
        $('#dokter_laporan').select2({
            placeholder: "Dokter Pemeriksa",
            templateResult: formatOutput
        });
        $('.js-select2').select2();
   });
   function formatOutput (item) {
        var lengkap = $(item.element).data('sebagai') + " - " + item.text + " - " + $(item.element).data('keterangan');
        return lengkap;
    };
    $('#dokter_laporan').on("select2:select", function(e) { 
        var keterangan = $('#dokter_laporan').find(':selected').data("keterangan");
       $("#dokter_ket").val(keterangan);
    });
</script>
<script type="text/javascript">
    $(function(){
       $('.js-datepicker').datepicker({
          format: 'mm/dd/yy'
        });
    });
    $('#laporan-napza').on('click', function(){
        $('#modal-laporan-napza').modal('show');
    })

    $('#laporan-fisik').on('click', function(){
        $('#modal-laporan-fisik').modal('show');
    });

    $('#laporan-sk-dokter').on('click', function(){
        $('#modal-laporan-sk-dokter').modal('show');
    });

    $('#laporan-sk-keswa').on('click', function(){
        $('#modal-laporan-sk-keswa').modal('show');
    });

    $('#submit_laporan_sk_dokter').on('click', function(){
        var nomor_surat = $('#dokter-nomor_surat').val();
        var keperluan = $('#dokter-keperluan').val();
        var dokter2 = $('#dokter_laporan2').val();

        $('#keperluan_input').val(keperluan);
        $('#nomor_surat_input').val(nomor_surat);
        $('#dokter2_input').val(dokter2);
        $('#dokter2_input').prop('disabled', false);
        $('#keperluan_input').prop('disabled', false);
        $('#nomor_surat_input').prop('disabled', false);
        submitWindow();
        // $('#form_laporan').submit();
    });

    $('#submit_laporan_keswa').on('click', function(){
        var nama_ttd = $('#keswa_nama_ttd').val();
        var sipds_ttd = $('#keswa_sipds_ttd').val();
        var jabatan_ttd = $('#keswa_jabatan_ttd').val();
        var instansi_ttd = $('#keswa_instansi_ttd').val();
        var keterangan_ttd = $('#keswa_keterangan_ttd').val();
        var tgl = $('#keswa-tanggal').val();
        var tgl_surat = $('#keswa-tanggal-surat').val();
        var keperluan = $('#keswa-keperluan').val();
        var nomor_surat = $('#keswa_nomor_surat').val();

        $('#nama_ttd_input').val(nama_ttd);
        $('#sipds_ttd_input').val(sipds_ttd);
        $('#jabatan_ttd_input').val(jabatan_ttd);
        $('#instansi_ttd_input').val(instansi_ttd);
        $('#keterangan_ttd_input').val(keterangan_ttd);
        $('#keperluan_input').val(keperluan);
        $('#nomor_surat_input').val(nomor_surat);
        // $('#tanggal_pemeriksaan_input').val(tgl);
        // $('#tanggal_surat_input').val(tgl_surat);

        $('#nama_ttd_input').prop('disabled',false);
        $('#sipds_ttd_input').prop('disabled',false);
        $('#jabatan_ttd_input').prop('disabled',false);
        $('#instansi_ttd_input').prop('disabled',false);
        $('#keterangan_ttd_input').prop('disabled',false);
        $('#tanggal_surat_input').prop('disabled',false);
        $('#tanggal_pemeriksaan_input').prop('disabled',false);
        $('#nomor_surat_input').prop('disabled',false);
        $('#keperluan_input').prop('disabled', false);
        submitWindow();
        // $('#form_laporan').submit();
    })

    $('#submit_laporan_fisik').on('click', function(){
        var laborat = $('#laborat').val();
        var kesimpulan = $('#kesimpulan').val();
        var saran = $('#saran').val();
        var jari_jari = $('#jari_jari').val();
        $('#laborat_input').val(laborat);
        $('#kesimpulan_input').val(kesimpulan);
        $('#saran_input').val(saran);
        $('#jari_jari_input').val(jari_jari);
        $('#laborat_input').prop('disabled', false);
        $('#kesimpulan_input').prop('disabled', false);
        $('#saran_input').prop('disabled', false);
        $('#jari_jari_input').prop('disabled', false);
        submitWindow();
        // $('#form_laporan').submit();
    })
    $('#submit_laporan_napza').on('click', function(){
        var nama_ttd = $('#nama_ttd').val();
        var sipds_ttd = $('#sipds_ttd').val();
        var jabatan_ttd = $('#jabatan_ttd').val();
        var instansi_ttd = $('#instansi_ttd').val();
        var keterangan_ttd = $('#keterangan_ttd').val();
        var nama_peminta = $('#nama_peminta').val();
        var sipds_peminta = $('#sipds_peminta').val();
        var jabatan_peminta = $('#jabatan_peminta').val();
        var instansi_peminta = $('#instansi_peminta').val();
        var perihal = $('#perihal').val();
        var tgl_fisik = $('#tgl-fisik').val();
        var tgl_psikiatrik = $('#tgl-psikiatrik').val();
        var tgl_tambahan = $('#tgl-tambahan').val();
        var keperluan = $('#keperluan').val();
        var nomor_surat = $('#nomor_surat').val();
        var tanggal_surat = $('#tanggal_surat').val();
        var jam_fisik = $('#jam-fisik').val();
        var jam_psikiatrik = $('#jam-psikiatrik').val();
        var jam_tambahan = $('#jam-tambahan').val();

        $('#nama_ttd_input').val(nama_ttd);
        $('#sipds_ttd_input').val(sipds_ttd);
        $('#jabatan_ttd_input').val(jabatan_ttd);
        $('#instansi_ttd_input').val(instansi_ttd);
        $('#keterangan_ttd_input').val(keterangan_ttd);
        $('#nama_peminta_input').val(nama_peminta);
        $('#sipds_peminta_input').val(sipds_peminta);
        $('#jabatan_peminta_input').val(jabatan_peminta);
        $('#instansi_peminta_input').val(instansi_peminta);
        $('#perihal_input').val(perihal);
        $('#tgl_fisik_input').val(tgl_fisik);
        $('#tgl_psikiatrik_input').val(tgl_psikiatrik);
        $('#tgl_tambahan_input').val(tgl_tambahan);
        $('#keperluan_input').val(keperluan);
        $('#nomor_surat_input').val(nomor_surat);
        $('#tanggal_surat_input').val(tanggal_surat);
        $('#jam_fisik_input').val(jam_fisik);
        $('#jam_psikiatrik_input').val(jam_psikiatrik);
        $('#jam_tambahan_input').val(jam_tambahan);

        $('#nama_ttd_input').prop('disabled',false);
        $('#sipds_ttd_input').prop('disabled',false);
        $('#jabatan_ttd_input').prop('disabled',false);
        $('#instansi_ttd_input').prop('disabled',false);
        $('#keterangan_ttd_input').prop('disabled',false);
        $('#nama_peminta_input').prop('disabled',false);
        $('#sipds_peminta_input').prop('disabled',false);
        $('#jabatan_peminta_input').prop('disabled',false);
        $('#instansi_peminta_input').prop('disabled',false);
        $('#perihal_input').prop('disabled',false);
        $('#tgl_fisik_input').prop('disabled',false);
        $('#tgl_psikiatrik_input').prop('disabled',false);
        $('#tgl_tambahan_input').prop('disabled',false);
        $('#keperluan_input').prop('disabled',false);
        $('#tanggal_surat_input').prop('disabled',false);
        $('#nomor_surat_input').prop('disabled',false);
        $('#jam_fisik_input').prop('disabled',false);
        $('#jam_psikiatrik_input').prop('disabled',false);
        $('#jam_tambahan_input').prop('disabled',false);
        submitWindow();
        // $('#form_laporan').submit();
    })

    function changeValueJenisPasien(value)
    {
        $('#jenis_pasien').val(value)
    }

    function showDinasButton()
    {
        $('#buku_dinas_container').slideToggle();
        $('#buku_umum_container').slideUp();
        $('#sk_dokter_container').slideUp();
    }

    function showUmumButton()
    {
        $('#buku_umum_container').slideToggle();
        $('#buku_dinas_container').slideUp();
        $('#sk_dokter_container').slideUp();
    }

    function showDokterButton()
    {
        $('#sk_dokter_container').slideToggle();
        $('#buku_umum_container').slideUp();
        $('#buku_dinas_container').slideUp();
    }

    $('input[type=radio][name=buku_dinas_bagian]').change(function() {
        $('#jenis_pasien').val(this.value)
    });

    $('input[type=radio][name=buku_umum_bagian]').change(function() {
        $('#jenis_pasien').val(this.value)
    });
    
    $('input[type=radio][name=sk_dokter_ttd]').change(function() {
        $('#jenis_pasien').val(this.value);
        if(this.value == "sk_dokter2"){
            $('#dokter_laporan2_wrapper').show();
        }else{
            $('#dokter_laporan2').val("").trigger('change');
            $('#dokter_laporan2_wrapper').hide();
        }
    });

    $('.time').mask('00:00');

    function submitWindow()
    {   
        var form = document.getElementById('form_laporan');
        form.setAttribute("target", "print_popup");
        window.open("{{url('kasus')}}/{{$kasus->nomor_kasus}}/urikkes/laporan/print",'print_popup','width=1000,height=800');
        form.submit();
    }
</script>
@endsection
