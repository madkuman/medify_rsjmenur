@extends('farmasi.layouts.main')

@section('title')
Farmasi Layar Antrian
@endsection

@section('css')
<style type="text/css">
	.select2-container--default .select2-selection--single{
		background-color: #42a5f5!important;
		font-size: 1.5em;
		color: #FFF;
		padding-bottom: 4%;
	}
	#select2-selectPoli-container{
		color: #FFF;
		margin-left: 2%;
	}
	.select2-container--default .select2-selection--single .select2-selection__arrow b {
		border-color: #FFF transparent transparent transparent;
	}
</style>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-xl-12 text-center py-20">
            <h3>Daftar Screen Antrian</h3>
        </div>
    </div>
    <div class="row row-deck">
        @foreach($screens as $item)
        <div class="col-md-3">
            <div class="d-none" id="content_ruangan_{{$item->id}}">
                @php
                $jenis_antrian = json_decode($item->jenis_antrian_nama);
                $jenis_resep = json_decode($item->jenis_resep_nama);
                @endphp
                <div class="jenis_antrian">
                    @foreach ($jenis_antrian as $value)
                        <span class="badge badge-info mr-10">{{$value}}</span>
                    @endforeach
                </div>
                <div class="jenis_resep">
                    @foreach ($jenis_resep as $value)
                        <span class="badge badge-primary mr-10">{{$value}}</span>
                    @endforeach
                </div>                
                @endphp
            </div>
            <div class="block block-rounded block-bordered block-link-pop text-center pb-10" >
                <div class="block-content">
                    <p class="font-size-h3 text-elegance">
                        <strong>{{ucwords(strtolower($item->nama))}}</strong>
                    </p>
                    <p class="font-w600">
                        Jenis Antrian <br>
                        @foreach ($jenis_antrian as $nama)
                        <span class="badge badge-info">{{$nama}}</span>
                        @endforeach
                    </p>
                    {{-- <p class="font-w600">
                        Jenis Resep <br>
                        @foreach ($jenis_resep as $nama)
                        <span class="badge badge-info">{{$nama}}</span>
                        @endforeach
                    </p> --}}
                    
                    <div class="text-center">
                        <a class="btn btn-alt-success" href="{{url("farmasi/".session('farmasi')->slug."/screen-tv/master/".$item->slug)}}">
                            <i class="fa fa-expand"></i> Tampilkan
                        </a>
                        <button class="btn btn-alt-info screen-detail" data-id="{{$item->id}}" data-index="{{$loop->iteration-1}}">
                            <i class="fa fa-search-plus"></i> Detail
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        <div class="col-md-3">
            <a class="block block-link-pop text-center  bg-primary" href="javascript:void(0)" data-toggle="modal" data-target="#modal-screen-baru">
                <div class="block-content">
                    <i class="fa fa-plus-circle fa-5x text-white my-10 mt-30"></i>
                    <div class="font-w600 font-size-lg text-white">Buat Screen Antrian Baru</div>
                </div>
            </a>
        </div>
    </div>
</div>

<form id="form_hapus" action="{{url('farmasi/'.session('farmasi')->slug.'/screen-tv')}}/delete" method="POST">
    {{ csrf_field() }}
    <input type="hidden" name="screen_id" id="screen_id">
</form>

@include('farmasi.screen.components.modal-screen-baru')
@include('farmasi.screen.components.modal-screen-detail')
@endsection

@section('angular')
<script type="text/javascript">
    var data = JSON.parse({!!json_encode(str_replace("`", "'", $screens))!!});

    jenis_antrian = new Array();
    jenis_resep = new Array();
    nama_edit = '';
    scr_id_edit = '';

    $(document).ready(function(){
        $('.js-example-basic-multiple').select2();
    });

    $('#btn_edit').on('click', function() {
        id = $(this).data('id');
        $('#jenis_antrian_all').val([]).change();
        $('#jenis_resep_all').val([]).change();
        $('#nama_scr').val(nama_edit);
        $('#jenis_antrian_all').val(jenis_antrian).change();
        $('#jenis_resep_all').val(jenis_resep).change();
        $('input[name="id"]').val(scr_id_edit);
        $('.form-screen-title').html("Edit Screen Antrian");
        $('#modal-screen-detail').modal('hide');
        $('#modal-screen-baru').modal('show');
    });

    $('#btn_hapus').on('click', function() {
        id = $(this).data('id');
        $("#modal-screen-detail").modal('hide');
        swal({
            title: 'Apa anda yakin menghapus screen ini?',
            type: 'warning',
            confirmButtonClass: 'btn btn-primary',
            cancelButtonClass: 'btn btn-outline-danger',
            showCancelButton: true,
            confirmButtonText: 'Hapus Screen',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.value) {
                $('#screen_id').val(id)
                $('#form_hapus').submit()
            }
        })
    });

    $('.screen-detail').on('click', function(){
        id = $(this).data('id');        
        var item = data[$(this).data("index")];
        jenis_antrian = [];
        jenis_resep = [];
        nama_edit = '';
        scr_id_edit = '';

        content_jenis_antrian = $('#content_ruangan_'+id+' .jenis_antrian').html()
        content_jenis_resep = $('#content_ruangan_'+id+' .jenis_resep').html()

        temp_jenis_antrian = JSON.parse( item.jenis_antrian);
        temp_jenis_resep = JSON.parse( item.jenis_resep);

        $.each(temp_jenis_antrian, function( index, value ) {
            jenis_antrian[index] = parseInt(value);
        });
        $.each(temp_jenis_resep, function( index, value ) {
            jenis_resep[index] = parseInt(value);
        });

        nama_edit = item.nama;
        scr_id_edit = item.id;
        $('#nama_scr_detail').html(item.nama);
        $('#jenis_antrian_detail').html(content_jenis_antrian);
        $('#jenis_resep_detail').html(content_jenis_resep);
        $('#btn_hapus').data('id', id);
        $('#btn_edit').data('id', id);
        $('#modal-screen-detail').modal('show');
    });

    $(document).on('hide.bs.modal','#modal-screen-baru', function () {
        $('.form-screen-title').html("Tambah Screen Antrian");
        $('input[name="id"]').val('');
        $('input[name="nama_scr"]').val('');
        $('#jenis_antrian_all').val([]).change();
        $('#jenis_resep_all').val([]).change();
    });

    var BeFormValidation = function() {
            var initValidationBootstrap = function(){
                jQuery('#form_ruangan').validate({
                    ignore: [],
                    errorClass: 'invalid-feedback animated fadeInDown',
                    errorElement: 'div',
                    errorPlacement: function(error, e) {
                        jQuery(e).parents('.form-group > div').append(error);
                    },
                    highlight: function(e) {
                        jQuery(e).closest('.form-group').removeClass('is-invalid').addClass('is-invalid');
                    },
                    success: function(e) {
                        jQuery(e).closest('.form-group').removeClass('is-invalid');
                        jQuery(e).remove();
                    },
                    rules: {
                        'nama_scr' : {
                            required: true,
                        },
                        'jenis_antrian[]': {
                            required: true,
                        },
                        'jenis_resep[]': {
                            required: true,
                        }
                    },
                    messages: {
                        'nama_scr': 'Kolom ini wajib diisi',
                        'jenis_antrian[]': 'Kolom ini wajib diisi',
                        'jenis_resep[]': 'Kolom ini wajib diisi',
                    }
                });
            };

            return {
                init: function () {
                    initValidationBootstrap();
                    jQuery('.js-select2').on('change', function(){
                        jQuery(this).valid();
                    });
                }
            };
        }();

        jQuery(function(){ BeFormValidation.init(); });
</script>
@endsection