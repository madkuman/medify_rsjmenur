@extends('rawatjalan.layouts.main')

@section('title')
Poliklinik - Rawat Jalan - Medify
@endsection

@section('sidebarcomponent')
@include('rawatjalan.components.sidebar')
@endsection

@section('subtitle')
Daftar Ruangan
@endsection

@section('content')
<main id="main-container">
	@include('rawatjalan.layouts.navbar')
	<div class="container">
        <div class="row">
            <div class="col-xl-12 text-center py-20">
                <h3>Daftar Ruangan</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-12 mb-20">
                <input type="text" style="width: 100%" class="form-control fuzzy-search-ruangan" placeholder="Cari Ruangan ...">
            </div>
        </div>
        <div id="ruangan-list">
            <ul class="list row row-deck">
                @foreach($ruangan as $item)
                <li class="col-md-3">
                    <div class="block block-rounded block-bordered block-link-pop text-center pb-10" style="height: 90%" >
                        <div class="block-content">
                            <p class="font-size-h3 text-elegance">
                                <strong class="title">{{ucwords(strtolower($item->nama))}}</strong>
                            </p>
                            <p class="font-w600">
                                Poliklinik :<br>
                                <span class="badge badge-info poliname">{{$item->poliklinik->name}}</span>
                            </p>

                            <p class="font-w600">
                                Dokter :<br>
                                <span class="font-w400 doktername">{{$item->dokter ? $item->dokter->name : '-'}}</span>
                            </p>
                            
                            <div class="text-center">
                                <button class="btn btn-alt-info btn-edit" data-id="{{$item->id}}" data-nama="{{$item->nama}}" data-poli="{{$item->poliklinik_id}}" data-dokter="{{$item->dokter_id}}">
                                    <i class="fa fa-pencil"></i> Edit
                                </button>
                                <button class="btn btn-alt-danger btn-hapus" data-id="{{$item->id}}">
                                    <i class="fa fa-trash"></i> Hapus
                                </button>
                            </div>
                        </div>
                    </div>
                </li>
                @endforeach
                <li class="col-md-3">
                    <a class="block block-link-pop text-center bg-primary" href="javascript:void(0)" data-toggle="modal" data-target="#modal-ruangan-baru" style="height: 90%">
                        <div class="block-content py-50">
                            <i class="fa fa-plus-circle fa-5x text-white mb-10 mt-20"></i>
                            <div class="font-w600 font-size-lg text-white mb-20">Buat Ruangan Baru</div>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</main>
<form id="form-ruangan-hapus" method="POST" action="{{url('rawatjalan/ruangan/hapus')}}">
{{ csrf_field() }}
<input type="hidden" name="id_ruangan" id="id_ruangan_hapus">
</form>
@include('rawatjalan.ruangan.components.modal-ruangan-baru')
{{-- @include('rawatjalan.ruangan.components.modal-ruangan-detail') --}}
@endsection

@section('angular')
<script src="{{asset('assets/js/plugins/listjs/list.min.js')}}"></script>
<script type="text/javascript">
    var options = {
        valueNames: [ 'title', 'poliname', 'doktername' ]
    };
    var ruanganList = new List('ruangan-list', options);

    $('.btn-edit').on('click', function(){
        id = $(this).data('id');
        dokter = $(this).data('dokter');
        poli = $(this).data('poli');
        nama = $(this).data('nama');
		ruangan_nama = nama.split(" ").pop(-1);
        $('#poli').select2().val(poli).trigger('change');
        $('#dokter').select2().val(dokter).trigger('change');
        $('#id_ruangan').val(id);
        $('#nama_ruangan').val(ruangan_nama);
        $('#modal-title').html('Edit Ruangan');
        $('#modal-ruangan-baru').modal('show');
    });

    $('.btn-hapus').on('click', function(){
        id = $(this).data('id');
        swal({
            title: 'Apa anda yakin menghapus ruangan ini?',
            type: 'warning',
            confirmButtonClass: 'btn btn-primary',
            cancelButtonClass: 'btn btn-outline-danger',
            showCancelButton: true,
            confirmButtonText: 'Hapus Ruangan',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.value) {
                $('#id_ruangan_hapus').val(id)
                $('#form-ruangan-hapus').submit()
            }
        })
    });

    $("#modal-ruangan-baru").on("hidden.bs.modal", function () {
        $('#modal-title').html('Tambah Ruangan');
        $('#poli').select2().val("").trigger('change');
        $('#dokter').select2().val("").trigger('change');
        $('#id_ruangan').val("");
        $('#form-ruangan')[0].reset();
    });

    $(".fuzzy-search-ruangan").keyup(function(){
        ruanganList.search($(this).val());
    });
    
    $(document).ready(function() {
        $('#main-container').addClass('overflow-hidden');
    });
</script>
@endsection