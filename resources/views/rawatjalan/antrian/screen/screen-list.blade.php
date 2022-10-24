@extends('rawatjalan.layouts.main')

@section('title')
Poliklinik - Rawat Jalan - Medify
@endsection

@section('sidebarcomponent')
@include('rawatjalan.components.sidebar')
@endsection

@section('subtitle')
Daftar Screen TV
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
<main id="main-container">
	@include('rawatjalan.layouts.navbar')
	<div class="container">
        <div class="row">
            <div class="col-xl-12 text-center py-20">
                <h3>Daftar Screen TV</h3>
            </div>
        </div>
        <div class="row row-deck">
            @foreach($screens as $item)
            <div class="col-md-3">
                <div class="d-none" id="content_ruangan_{{$item->id}}">
                    @php
                    $ruangan_nama = json_decode($item->ruangan_nama);
                    $level_nama = json_decode($item->level_nama);
                    @endphp
                    <div class="level">
                    @foreach ($level_nama as $value)
                        <span class="badge badge-info mr-10">{{$value}}</span>
                    @endforeach
                    </div>
                    <div class="ruangan">
                    @foreach ($ruangan_nama as $value)
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
                            Kelas Pasien <br>
                            @foreach ($level_nama as $nama)
                            <span class="badge badge-info">{{$nama}}</span>
                            @endforeach
                        </p>
                        
                        <div class="text-center">
                            <a class="btn btn-alt-success" href="{{url('rawatjalan/antrian-screen/'.$item->slug)}}">
                                <i class="fa fa-expand"></i> Tampilkan
                            </a>
                            <button class="btn btn-alt-info screen-detail" data-id="{{$item->id}}">
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
                        <div class="font-w600 font-size-lg text-white">Buat Screen TV Baru</div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</main>
<form id="form_hapus" action="{{url('rawatjalan/screen-tv/hapus')}}" method="POST">
{{ csrf_field() }}
<input type="hidden" name="screen_id" id="screen_id">
</form>

@include('rawatjalan.antrian.screen.components.modal-screen-baru')
@include('rawatjalan.antrian.screen.components.modal-screen-detail')
@endsection

@section('angular')
<script type="text/javascript">
    level_id = new Array();
    ruangan_id = new Array();
    nama_edit = '';
    scr_id_edit = '';
    $(document).ready(function(){
        $('.js-example-basic-multiple').select2();
        $('.multiple-max').select2({
            maximumSelectionLength: 12,
            language: {
                maximumSelected: function (e) {
                    var t = "Hanya bisa memilih maksimal " + e.maximum + " poli";
                    e.maximum != 1;
                    return t;
                }
            }
        });
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
            confirmButtonText: 'Hapus Screen TV',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.value) {
                $('#screen_id').val(id)
                $('#form_hapus').submit()
            }
        })
    });

    $('#btn_edit').on('click', function() {
        id = $(this).data('id');
        $('#level_all').val([]).change();
        $('#ruangan_all').val([]).change();
        $('#nama_scr').val(nama_edit);
        $('#level_all').val(level_id).change();
        $('#ruangan_all').val(ruangan_id).change();
        $('input[name="id"]').val(scr_id_edit);
        $('.form-screen-title').html("Edit Screen TV");
        $('#modal-screen-detail').modal('hide');
        $('#modal-screen-baru').modal('show');
    });

    $('#level_all_check').on('click', function(){
        if($('#level_all_check').is(":checked")) {
            $('#level_all').val([]).change();
            $('#level_all').prop("disabled",true);
        }
        else {
            $('#level_all').prop("disabled",false);
        }
    });

    $('.screen-detail').on('click', function(){
        id = $(this).data('id');
        level_detail = '';
        ruangan_detail = '';
        level_id = [];
        ruangan_id = [];
        nama_edit = '';
        scr_id_edit = '';
        $.ajax({
			url: "{{url('')}}/api/rawatjalan/screen-tv/"+id,
			dataType: 'json',
			cache: false,
			type: 'GET',
			success: function(data) {
                content_level = $('#content_ruangan_'+id+' .level').html()
                content_ruangan = $('#content_ruangan_'+id+' .ruangan').html()
                temp_level = JSON.parse( data.level_id);
                temp_ruangan = JSON.parse( data.ruangan_id);
                
                $.each(temp_level, function( index, value ) {
                    level_id[index] = parseInt(value);
                });
                $.each(temp_ruangan, function( index, value ) {
                    ruangan_id[index] = parseInt(value);
                });
                nama_edit = data.nama;
                scr_id_edit = data.id;
                $('#nama_scr_detail').html(data.nama);
                $('#kelas_detail').html(content_level);
                $('#ruangan_detail').html(content_ruangan);
                $('#btn_hapus').data('id', id);
                $('#btn_edit').data('id', id);
                $('#modal-screen-detail').modal('show');
			}
		});
    });

    $(document).on('hide.bs.modal','#modal-screen-baru', function () {
        $('.form-screen-title').html("Tambah Screen TV");
        $('input[name="id"]').val('');
        $('input[name="nama_scr"]').val('');
        $('#level_all').val([]).change();
        $('#ruangan_all').val([]).change();
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
                        'level[]': {
                            required: true,
                        },
                        'ruangan[]': {
                            required: true,
                        }
                    },
                    messages: {
                        'nama_scr': 'Kolom ini wajib diisi',
                        'level[]': 'Kolom ini wajib diisi',
                        'ruangan[]': 'Kolom ini wajib diisi',
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