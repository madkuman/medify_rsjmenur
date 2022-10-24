@extends('rawatinap.layouts.main')

@section('title')
{{$ruangan->nama}} - Rawat Inap - Medify
@endsection

@section('subtitle')
{{$ruangan->bangsal->nama}} / {{$ruangan->nama}}
@endsection

@section('css')
<style>
    .ribbon-bookmark .ribbon-box::before {
        top: 0;
        right: 100%;
        height: 20px !important;
        border: 10px solid;
        border-left-width: 5px;
        border-right-width: 0;
    }
</style>
@endsection

@section('content')
<main id="main-container">
    @include('rawatinap.layouts.navbar')
    <div class="container">
        <div class="block">
            <div class="block-content pb-20">
                <a href="{{url('rawatinap/pengaturan/ruangan/edit')}}/{{$ruangan->id}}" class="btn btn-warning pull-right"><i class="fa fa-pencil"></i> Edit </a>
                <h4 class="text-uppercase">{{$ruangan->nama}}</h4>
                <hr>
                <div class="row">
                    <div class="col-4">
                        <div class="js-slider slick-nav-black slick-dotted-inner slick-dotted-white" data-dots="true" data-arrows="true">
                            @forelse($foto as $item)
                            <div>
                                <img class="img-fluid" src="{{url($item->foto_ori)}}" alt="" style="max-height: 200px;">
                            </div>
                            @empty
                            <div>
                                <img class="img-fluid" src="{{asset('assets/img/photos/photo23.jpg')}}" alt="" style="max-height: 200px;">
                            </div>
                            @endforelse
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="row pt-20">
                            <div class="col-12">
                                @if($ruangan->intensif==1)
                                <a style="float:left;" class="mr-20" data-toggle="tooltip" data-placement="top" title="Intensif"><i class="fal fa-heartbeat fa-2x"></i></a>
                                @endif
                                @if($ruangan->bayi==1)
                                <a style="float:left;" class="mr-20" data-toggle="tooltip" data-placement="top" title="Bayi"><i class="fal fa-heartbeat fa-2x"></i></a>
                                @endif
                                <h5 style="float:left;">
                                    <span class="badge badge-success">Kelas {{$ruangan->kelas_ruang->nama}}</span> 
                                </h5>
                            </div>
                        </div>
                        <blockquote>
                            <p>{{$ruangan->deskripsi}}</p>
                        </blockquote>
                        <br>
                        <div class="row">
                            <strong class="col-4">Tarif</strong>
                            <strong class="col-2">Harga</strong>
                            <strong class="col-2">Kelas Tarif</strong>
                        </div>

                        <div class="row">
                            <div class="col-4" style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">
                                {{$ruangan->tarif->master->deskripsi ?? 'Tarif Tidak Ditemukan'}}
                            </div>
                            <div class="col-2">Rp {{number_format($ruangan->tarif->harga,0)}}</div>
                            <div class="col-2">{{$ruangan->tarif->kelas->nama}}</div>
                        </div>
                        @foreach($ruangan->tarif_lain as $tarif)
                        <div class="row">
                            <div class="col-4" style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">
                                {{$tarif->tarif->master->deskripsi ?? 'Tarif Tidak Ditemukan'}}
                            </div>
                            <div class="col-2">Rp {{number_format($tarif->tarif->harga,0)}}</div>
                            <div class="col-2">{{$tarif->tarif->kelas->nama}}</div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <h4>Daftar Tempat Tidur - {{$ruangan->bangsal->nama}} / {{$ruangan->nama}}</h4>

        <div class="row"> 
            @php $count = 0; @endphp
            @foreach($ruangan->bed as $bed)
            <div class="col-md-3">
                <div class="block" href="{{url('rawatinap/pengaturan/ruangan/')}}/{{$bed->id}}">
                    <div class="block-content pb-20 ribbon ribbon-bookmark ribbon-danger ribbon-left">
                        @if ($bed->is_hitung_statistik == 1)
                            <div class="ribbon-box" style="height: 20px;font-size:9pt;line-height: 1.5">
                                &nbsp;
                            </div>
                        @endif
                        <div class="row p-0 m-0">
                            <div class="col-md-8 text-center h-100 d-flex align-self-center">
                                <h5 class="mb-0">{{$bed->nama}}</h5>
                            </div>
                            <div class="col-md-4 text-center h-100 d-flex align-self-center">
                                <button type="button" class="btn btn-alt-info btn-sm" onclick="swalEdit({{$bed->id}},'{{$bed->nama}}','{{ $bed->is_hitung_statistik }}')"><i class="fa fa-pencil"></i></button> 
                                <button type="button" class="btn btn-alt-danger btn-sm ml-5" onclick="swalDelete({{$bed->id}})"><i class="fa fa-trash"></i></button> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @php $count++ @endphp
            @endforeach
            @if($count == 0)
            <div class="block">
                <div class="block-content pb-20 text-center ">
                    <div class="row p-0 m-0">
                        <div class="col-md-12 text-center ">
                            <h5 class="mb-0 text-center">Tidak terdapat tempat tidur pada bangsal ini</h5>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
        <hr class="mb-30">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="block block-themed">
                    <div class="block-header">
                        <h3 class="block-title">Tambah Tempat Tidur Baru</h3>
                    </div>
                    <div class="block-content pb-20">
                        <div class="row p-0 m-0">
                            <div class="col-md-12">
                                <h5 class="mb-0">
                                    <form method="POST" action="{{url('rawatinap/pengaturan/bed/new')}}" enctype="multipart/form-data">
                                        {{csrf_field()}}
                                        <input type="hidden" name="ruangan_id" value="{{$ruangan->id}}">
                                        <div class="form-group row">
                                            <div class="col-md-8 text-left">
                                                <label >Nama Bed</label>
                                                <input type="text" class="form-control" name="name" placeholder="Bed {{++$count}}" 
                                                required>
                                            </div>
                                            <div class="col-md-4 pt-20">
                                                <button class="btn btn-primary btn-hero pull-right">Simpan</button>
                                            </div>
                                        </div>
                                    </form>

                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>

<form method="POST" action="{{url('rawatinap/pengaturan/bed/delete')}}" id="formDeleteBed">
    {{csrf_field()}}
    <input type="hidden" name="bed_id" id="inputDeleteBed">
</form>

<form method="POST" action="{{url('rawatinap/pengaturan/bed/edit')}}" id="formEditBed">
    {{csrf_field()}}
    <input type="hidden" name="bed_id" id="inputEditBedID">
    <input type="hidden" name="name" id="inputEditBedName">
    <input type="hidden" name="is_hitung_statistik" id="inputEditBedIsHitungStatistik">
</form>

@endsection

@section('js')
<script type="text/javascript">
    function swalDelete(id)
    {
        swal({
            title: 'Apakah anda yakin',
            text: "Data yang telah dihapus tidak dapat dikembalikan.",
            type: 'warning',
            showCancelButton: true,
            reverseButtons:true,
            confirmButtonClass: 'btn btn-primary',
            cancelButtonClass: 'btn btn-outline-danger',
            confirmButtonText: 'Ya, hapus tempat tidur',
            cancelButtonText: 'Batalkan'
        }).then((result) => {
            if (result.value) {
                $('#inputDeleteBed').val(id);
                $('#formDeleteBed').submit();
            }
        })
    }

    function swalEdit(id, name, is_hitung_statistik)
    {
        swal({
            title: 'Edit Tempat Tidur',
            html:`
                <div class="form-group">
                    <label >Nama Tempat Tidur</label>
                    <input id="swal-input-bed-name" class="swal2-input" value="${name}">
                </div>
                <div class="form-group">
                    <label class="mb-3">Hitung Statistik</label><br>
                    <div class="custom-control custom-radio custom-control-inline mb-5">
                        <input class="custom-control-input" type="radio" name="is_hitung_statistik" id="example-inline-radio2" ${is_hitung_statistik == 1 ? 'checked' : ''}
                        value="1">
                        <label class="custom-control-label" for="example-inline-radio2">Dihitung</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline mb-5">
                        <input class="custom-control-input" type="radio" name="is_hitung_statistik" id="example-inline-radio3" ${is_hitung_statistik == 0 ? 'checked' : ''}
                        value="0">
                        <label class="custom-control-label" for="example-inline-radio3">Tidak dihitung</label>
                    </div>
                </div>
            `,
            showCancelButton: true,
            reverseButtons:true,
            confirmButtonClass: 'btn btn-primary',
            cancelButtonClass: 'btn btn-outline-danger',
            confirmButtonText: 'Ya, ubah data',
            cancelButtonText: 'Batalkan',
        }).then((result) => {
            if (result.value) {
                var new_name = $('#swal-input-bed-name').val();
                if(new_name == ""){
                    swal({type : 'warning', title : 'Masukan nama tempat tidur!'});
                    return false;
                }
                $('#inputEditBedName').val(new_name);
                $('#inputEditBedID').val(id);
                $('#inputEditBedIsHitungStatistik').val($('[name="is_hitung_statistik"]:checked').val());
                $('#formEditBed').submit();
            }
        })
    }
</script>
@endsection