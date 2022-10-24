@extends('rawatinap.layouts.main')

@section('title')
Edit Bangsal {{$bangsal->nama}} - Rawat Inap - Medify
@endsection

@section('subtitle')
Pengaturan - Edit Bangsal {{$bangsal->nama}}
@endsection

@section('content')


<main id="main-container">
    @include('rawatinap.layouts.navbar')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="block pb-100">
                    <div class="block-content block-content text-left">
                        <button class="btn btn-danger pull-right" onclick="swalDelete({{$bangsal->id}})"><i class="fa fa-trash"></i> Hapus </button>

                        <h4>Edit Bangsal Baru</h4>
                        <a href="{{url('rawatinap/pengaturan/bangsal/')}}/{{$bangsal->id}}">Kembali ke bangsal</a>
                        <hr>
                        <form method="POST" action="{{url('rawatinap/pengaturan/bangsal/edit')}}" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-6">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label >Nama Bangsal</label>
                                    <input type="text" class="form-control" name="name" placeholder=".." value="{{$bangsal->nama}}" required>
                                    <input type="hidden" class="form-control" name="bangsal_id" placeholder=".." value="{{$bangsal->id}}">
                                </div>
                                <div class="form-group">
                                    <label>Jenis Tarif</label>
                                    <select class="js-select2 form-control requireForm" id="tipeLayanan" name="tarif_master_id" style="width: 100%;" data-placeholder="Choose one..">
                                        <option disabled="" hidden="" selected="">Pilih Jenis Tarif</option>
                                        @foreach($tarif as $row)
                                            <option value="{{$row->id}}" @if($bangsal->tarif_master_id == $row->id) selected @endif>
                                                {{$row->deskripsi}}
                                            </option>
                                        @endforeach
                                    </select>
                                    <p class="text-danger teksWarning" id="tipeWarn" style="display: none; margin-bottom: 8px;"></p>
                                </div>
                                
                                <div class="form-group">
                                    <label >Deskripsi Bangsal</label>
                                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="6" 
                                    placeholder="Content..">{{$bangsal->deskripsi}}</textarea>
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox custom-control-inline mb-5">
                                        <input class="custom-control-input" type="checkbox" name="intensif" id="example-inline-checkbox1" 
                                        value="1" @if($bangsal->intensif==1) checked @endif>
                                        <label class="custom-control-label" for="example-inline-checkbox1">Ruang Intensif</label>
                                    </div>
                                    <div class="custom-control custom-checkbox custom-control-inline mb-5">
                                        <input class="custom-control-input" type="checkbox" name="bayi" id="example-inline-checkbox2" 
                                        value="1" @if($bangsal->bayi==1) checked @endif>
                                        <label class="custom-control-label" for="example-inline-checkbox2">Ruang Bayi</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="mb-3">Pengaturan Perhitungan Statistik</label><br>
                                    <div class="custom-control custom-radio custom-control-inline mb-5">
                                        <input class="custom-control-input" type="radio" name="is_hitung_statistik" id="example-inline-radio1" 
                                        value="" checked>
                                        <label class="custom-control-label" for="example-inline-radio1">Abaikan  <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="bottom"   data-container="body" title="Tidak merubah pengaturan dalam tempat tidur"></i></label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline mb-5">
                                        <input class="custom-control-input" type="radio" name="is_hitung_statistik" id="example-inline-radio2" 
                                        value="1">
                                        <label class="custom-control-label" for="example-inline-radio2">Dihitung</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline mb-5">
                                        <input class="custom-control-input" type="radio" name="is_hitung_statistik" id="example-inline-radio3" 
                                        value="0">
                                        <label class="custom-control-label" for="example-inline-radio3">Tidak dihitung</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Foto Bangsal</label>
                                    <div class="row">
                                        @forelse($foto as $item)
                                        <div class="col-xl-4 item-gallery animated fadeIn">
                                            <div class="options-container">
                                                <img class="img-fluid options-item mb-5" src="{{url($item->foto_thumb)}}" alt="">
                                                <div class="options-overlay bg-black-op-75">
                                                    <div class="options-overlay-content">
                                                        <a class="btn btn-danger" 
                                                        style="color: #FFF;" onclick="swalDeleteGambar({{$item->id}})">
                                                        <i class="fa fa-trash"></i> Hapus </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @empty
                                        <div class="col-12">
                                            <p>Belum ada foto pada bangsal ini.</p>
                                        </div>
                                        @endforelse
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label >Upload Foto Bangsal</label>
                                    <div class="form-foto">
                                        

                                        <!--<div class="row single-foto" id="foto_0" data-index="0">
                                            <div class="col-8">
                                                <div class="form-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="form-control fotoForm" id="foto0" name="foto[]">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <button type="button" class="btn btn-danger">
                                                        <i class="fa fa-times mr-5"></i>
                                                        Hapus
                                                    </button>
                                                </div>
                                            </div>
                                        </div>-->
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <button type="button" class="btn btn-rounded btn-noborder btn-success mb-3" onclick="addForm();" id="tambahBtn">
                                                <i class="fa fa-plus mr-5"></i>Tambah Foto
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group float-right">
                                    <button class="btn btn-primary btn-hero">Simpan</button>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>

                </div>

            </div>
        </div>
    </div>
</main>


<form method="POST" action="{{url('rawatinap/pengaturan/bangsal/delete')}}" id="formDelete" >
    {{csrf_field()}}
    <input type="hidden" class="form-control" name="bangsal_id" placeholder=".." id="inputDeleteID">
</form>

<form method="POST" action="{{url('rawatinap/pengaturan/foto/delete')}}" id="formDeleteFoto" >
    {{csrf_field()}}
    <input type="hidden" class="form-control" name="foto_id" placeholder=".." id="inputDeleteFotoID">
</form>

@endsection

@section('js')
<script type="text/javascript">
    function addForm(){
        var totalFoto = $(".fotoForm").length;
        var codeToAdd = `<div class="row single-foto" id="foto_`+totalFoto+`" data-index="`+totalFoto+`">
                            <div class="col-8">
                                <div class="form-group">
                                    <div class="custom-file">
                                        <input type="file" class="form-control fotoForm" id="foto`+totalFoto+`" name="foto[]" accept=".png, .jpg, .jpeg">
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <button type="button" class="btn btn-danger" onclick="removeForm(`+totalFoto+`)">
                                        <i class="fa fa-times mr-5"></i>
                                        Hapus
                                    </button>
                                </div>
                            </div>
                        </div>`;
        $(".form-foto").append(codeToAdd);
    }
    function removeForm(id) {
        $("#foto_"+id).remove();
    }

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
            confirmButtonText: 'Ya, hapus bangsal',
            cancelButtonText: 'Batalkan'
        }).then((result) => {
            if (result.value) {
                $('#inputDeleteID').val(id);
                $('#formDelete').submit();
            }
        })
    }

    function swalDeleteGambar(id)
    {
        swal({
            title: 'Apakah anda yakin',
            text: "Foto yang telah dihapus tidak dapat dikembalikan.",
            type: 'warning',
            showCancelButton: true,
            reverseButtons:true,
            confirmButtonClass: 'btn btn-primary',
            cancelButtonClass: 'btn btn-outline-danger',
            confirmButtonText: 'Ya, hapus foto',
            cancelButtonText: 'Batalkan'
        }).then((result) => {
            if (result.value) {
                $('#inputDeleteFotoID').val(id);
                $('#formDeleteFoto').submit();
            }
        })
    }
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
                $('#kelas-applicare').empty();
                var option = [];
                option.push({
                    id:"",
                    "text":""
                });
                for (var i = 0; i < res.length ; i++) {
                    option.push({
                        id: res[i].kodekelas,
                        text: res[i].namakelas
                    })
                }
                $('#kelas-applicare').select2({
                    data : option
                });

                @if(isset($bangsal->kelas_applicare))
                    $('#kelas-applicare').val("{{$bangsal->kelas_applicare}}").trigger('change');
                @endif

                $('#loading_kelas').hide();
            },
            error: function(e) {
                $('#loading_kelas').show();
            }
        });
    }
</script>
@endsection