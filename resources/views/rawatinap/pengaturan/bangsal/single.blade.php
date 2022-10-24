@extends('rawatinap.layouts.main')

@section('title')
{{$bangsal->nama}} - Rawat Inap - Medify
@endsection

@section('subtitle')
{{$bangsal->nama}}
@endsection

@section('css')
<link rel="stylesheet" href="{{asset('assets/js/plugins/slick/slick.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/js/plugins/slick/slick-theme.min.css')}}">
@endsection

@section('content')
<main id="main-container">
    @include('rawatinap.layouts.navbar')
    <div class="container">

        <div class="block">
            <div class="block-content pb-20">
                <a href="{{url('rawatinap/pengaturan/bangsal/edit')}}/{{$bangsal->id}}" class="btn btn-warning pull-right"><i class="fa fa-pencil"></i> Edit </a>
                <h4 class="text-uppercase">{{$bangsal->nama}}</h4>
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
                                @if($bangsal->intensif==1)
                                <a style="float:left;" class="mr-20" data-toggle="tooltip" data-placement="top" title="Intensif"><i class="fal fa-heartbeat fa-2x"></i></a>
                                @endif
                                @if($bangsal->bayi==1)
                                <a style="float:left;" class="mr-20" data-toggle="tooltip" data-placement="top" title="Bayi"><i class="fal fa-child fa-2x"></i></a>
                                @endif
                                <h5 style="float:left;" class="mr-20">
                                    @forelse($kelas_bangsal as $index => $kelasbangsal)
                                    <span class="badge badge-success">Kelas {{$kelasbangsal}}</span> 
                                    @empty
                                    <span class="badge badge-info">-</span>
                                    @endforelse
                                </h5>
                                <p class="font-w600">
                                    <i class="fa fa-chart-area text-muted"></i> {{ $bangsal->count_tempat_tidur_statistik }} / {{ $bangsal->count_tempat_tidur_total }}
                                 </p>
                            </div>
                        </div>
                        <blockquote>
                            <b>{{$bangsal->tarif['deskripsi']}}</b>
                        </blockquote>
                        <blockquote>
                            <p>{{$bangsal->deskripsi}}</p>
                        </blockquote>
                    </div>
                </div>
            </div>
        </div>

        <a href="javascript:void(0)" class="btn btn-primary pull-right mr-5" data-toggle="modal" data-target="#modalCreate"><i class="fa fa-plus"></i> Tambah </a>

        <h4>Daftar Ruangan Bangsal {{$bangsal->name}}</h4>
        <hr>
        @php $count = 0; @endphp
        @foreach($bangsal->ruangan as $ruang)

        <div class="block" >
            <div class="block-content pb-20  ">
                <div class="row p-0 m-0">
                    <div class="col-3 text-center h-100 d-flex align-self-center">
                        <a href="{{url('rawatinap/pengaturan/ruangan/')}}/{{$ruang->id}}" class="h5 mb-0 text-primary">{{$ruang->nama}}</a>
                    </div>
                    <div class="col-2 text-center h-100 d-flex align-self-center">
                        <h5 class="mb-0 font-w400">Kelas <span class="uppercase"> {{$ruang->kelas_ruang->nama}} </span></h5>
                    </div>
                    <div class="col-2 text-center h-100 d-flex align-self-center">
                        <h5 class="mb-0 font-w400"><i class="fa fa-bed text-muted"></i> <span class="ml-10"> {{count($ruang->bed)}}</span></h5>
                    </div>
                    <div class="col-2 text-center h-100 d-flex align-self-center">
                        <h5 class="mb-0 font-w400"><i class="fa fa-chart-area text-muted"></i> <span class="ml-10"> {{ $ruang->bed->where('is_hitung_statistik',1)->count() }} / {{ $ruang->bed->count() }}</span></h5>
                    </div>
                    <div class="col-3">
                        <a class="btn btn-alt-info btn-sm" href="{{url('rawatinap/pengaturan/ruangan/edit')}}/{{$ruang->id}}"><i class="fa fa-pencil"></i></a> 
                        <button type="button" class="btn btn-alt-danger btn-sm ml-5" onclick="swalDelete({{$ruang->id}})"><i class="fa fa-trash"></i></button> 
                         <a href="{{url('rawatinap/pengaturan/ruangan/')}}/{{$ruang->id}}" class="btn btn-alt-info btn-success"><i class="fa fa-bed"></i> Edit Bed</a>
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
                    <div class="col-12 text-center ">
                        <h5 class="mb-0 text-center">Tidak terdapat ruangan pada bangsal ini</h5>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</main>

<div class="modal" id="modalEdit" role="dialog" aria-labelledby="modal-large" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form method="POST" action="{{url('rawatinap/pengaturan/ruangan/edit')}}" enctype="multipart/form-data">
                <div class="block block-themed block-transparent mb-0">

                    <div class="block-header">
                        <h3 class="block-title">Edit Data Ruangan</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>


                    <div class="block-content">
                        {{csrf_field()}}
                        <input type="hidden" name="ruangan_id" id="inputEditRuanganID">
                        <div class="form-group row">
                            <div class="col-8 text-left">
                                <label >Nama Ruangan</label>
                                <input type="text" class="form-control" name="name" id="inputEditRuanganNama" placeholder=".." required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-8  text-left">
                                <label>Kelas</label>
                                <select class="js-select2 form-control" name="kelas" id="inputEditRuanganKelas" 
                                style="width: 100%;" data-placeholder="Choose one.." required>
                                    @foreach($kelas as $item)
                                    <option value="{{$item->id}}">{{$item->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary btn-hero" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-alt-primary btn-hero">
                        <i class="fa fa-check"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" id="modalCreate" role="dialog" aria-labelledby="modal-large" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form method="POST" action="{{url('rawatinap/pengaturan/ruangan/new')}}" enctype="multipart/form-data">
                <div class="block block-transparent mb-0">

                    <div class="block-header">
                        <h5 class="block-title">Tambah Data Ruangan</h5>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        {{csrf_field()}}
                        <input type="hidden" name="bangsal_id" value="{{$bangsal->id}}">
                        <div class="form-group">

                                @if(config('bpjs_enable'))
                                @php 
                                    $col2 = 'col-2';
                                    $col3 = 'col-3';
                                @endphp
                                @else
                                @php 
                                    $col2 = 'col-3';
                                    $col3 = 'col-3';
                                @endphp
                                @endif
                            <div class="row gutters-tiny">
                                <div class="{{$col2}} text-left">
                                    <label>Nama Ruangan</label>
                                    <input type="text" class="form-control" name="nama[]" id="" placeholder="Nama Ruangan" required>
                                </div>
                                <div class="col-2  text-left">
                                    <label>Kelas</label>
                                    <select class="js-select2 form-control" name="kelas[]" id="" style="width: 100%;" 
                                    data-placeholder="Choose one.." required>
                                        @foreach($kelas as $item)
                                        <option value="{{$item->id}}">{{$item->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @if(config('bpjs_enable'))
                                <div class="{{$col2}} text-left">
                                    <label>Tipe Ruang <i class="fa fa-asterisk fa-spin text-info" id="loading_kelas"></i></label>
                                    <select class="js-select2 form-control kelas-applicare" name="kelas_applicare[]" style="width: 100%;" data-placeholder="Pilih Kelas/Tipe Bangsal">
                                        <option></option>
                                    </select>
                                </div>
                                @endif
                                <div class="col-3">
                                    <label>Jenis Tarif</label>
                                    <select class="js-select2 form-control" id="tipeLayanan" name="jenis_tarif[]" style="width: 100%;" data-placeholder="Choose one..">
                                        <option disabled="" hidden="" selected="">Pilih Jenis Tarif</option>
                                        @foreach($tarif as $row)
                                            <option value="{{$row->id}}" >
                                                {{$row->master->deskripsi ?? '-'}} {{$row->kelas->nama ?? '-'}} | Rp {{number_format($row->harga,0)}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="{{$col2}}">
                                    <label>Jumlah Bed</label>
                                    <input type="number" class="form-control" name="bed[]" id="" placeholder="Bed" required>
                                </div>
                                <div class="col-1 text-center">
                                    <label>Hapus</label>
                                    <button class="btn btn-outline-danger btn-circle btn-sm" disabled=""><i class="fal fa-trash-alt"></i></button>
                                </div>
                            </div>
                        </div>
                        <div id="panelFormRuangan">
                        </div>
                        <div class="form-group text-center">
                            <button type="button" class="btn btn-circle btn-outline-primary" id="tambahButton"><i class="fa fa-plus"></i></button>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary  btn-sm btn-hero" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-sm btn-hero">
                        <i class="fa fa-check"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<form method="POST" action="{{url('rawatinap/pengaturan/ruangan/delete')}}" id="formDeleteRuangan">
    {{csrf_field()}}
    <input type="hidden" name="ruangan_id" id="inputDeleteRuanganID">
</form>


@endsection


@section('js')

<script src="{{asset('assets/js/plugins/slick/slick.min.js')}}"></script>

<script type="text/javascript">
    var opsi_kelas_applicare = "";
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
                $('#inputDeleteRuanganID').val(id);
                $('#formDeleteRuangan').submit();
            }
        })
    }

    function swalEdit(id, name, kelas)
    {
        $('#inputEditRuanganID').val(id);
        $('#inputEditRuanganNama').val(name);
        $('#inputEditRuanganKelas').val(kelas).trigger('change');
        jQuery('#modalEdit').modal('show');
    }

    $('#tambahButton').click( function(){
        $('#panelFormRuangan').append(`
            <div class="form-group">
                <div class="row gutters-tiny">
                    <div class="{{$col2}} text-left">
                        <input type="text" class="form-control" name="nama[]" id="" placeholder="Nama Ruangan" required>
                    </div>
                    <div class="col-2  text-left">
                        <select class="js-select2 form-control" name="kelas[]" id="" style="width: 100%;" 
                        data-placeholder="Choose one.." required>
                            @foreach($kelas as $item)
                            <option value="{{$item->id}}">{{$item->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                    @if(config('bpjs_enable'))
                    <div class="col-2 text-left">
                        <select class="js-select2 form-control kelas-applicare" name="kelas_applicare[]" style="width: 100%;" data-placeholder="Pilih Kelas/Tipe Bangsal">
                            <option></option>`+
                            opsi_kelas_applicare
                            +`
                        </select>
                    </div>
                    @endif
                    <div class="col-3">
                        <select class="js-select2 form-control" id="tipeLayanan" name="jenis_tarif[]" style="width: 100%;" data-placeholder="Choose one..">
                            <option disabled="" hidden="" selected="">Pilih Jenis Tarif</option>
                            @foreach($tarif as $row)
                                <option value="{{$row->id}}" >
                                    {{$row->master->deskripsi ?? '-'}} {{$row->kelas->nama ?? '-'}} | Rp {{number_format($row->harga,0)}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="{{$col2}}">
                        <input type="number" class="form-control" name="bed[]" id="" placeholder="Bed" required>
                    </div>
                    <div class="col-1 text-center">
                        <button class="btn btn-outline-danger btn-circle btn-sm btnRemove"><i class="fal fa-trash-alt"></i></button>
                    </div>
                </div>
            </div>
            `)

        $('.js-select2 ').select2();
    })

    $(document).on('click', '.btnRemove', function() {
        var element = $(this).parent().parent().parent();
        element.remove();

    });

    $(document).ready(function() {
        getKelasApplicare();
    });

    function getKelasApplicare(){
        $('#loading_kelas').show();
        $.ajax({
            type: "GET",
            url: API_URL + "/bpjs/referensi/applicare/kelas",
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                var res = JSON.parse(response).response.list;
                $('.kelas-applicare').empty();
                var option = [];
                option.push({
                    id:"",
                    "text":""
                });
                for (var i = 0; i < res.length ; i++) {
                    option.push({
                        id: res[i].kodekelas,
                        text: res[i].namakelas
                    });
                    opsi_kelas_applicare+=`<option value="`+res[i].kodekelas+`">
                                            `+res[i].namakelas+`
                                            </option>
                                            `;
                }
                $('.kelas-applicare').select2({
                    data : option
                });

                $('#loading_kelas').hide();
            },
            error: function(e) {
                $('#loading_kelas').show();
            }
        });
    }
</script>
@endsection