@extends('layouts.main2')
@section('title')
{{$form->parameter}} - Edit Form - Pengaturan
@endsection
@section('css')

@endsection
@section('content')
@include('labpk.components.header')

<div class="content">
    <div class="block">
        <div class="block-header">
            <h3 class="block-title">{{$form->parameter}} - Edit Form</h3>
            <div class="block-options">
                <button class="btn btn-danger deleteButton"><i class="fa fa-trash"></i> Hapus Form</button>
            </div>
        </div>
        <div class="block-content">
            <form method="POST">
                {{csrf_field()}}
                <div id="deletionDiv"></div>
                <input type="hidden" name="id" value="{{$form->id}}">
                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <label>Tipe Form</label>
                            <select class="js-select2 form-control select-type" name="type" disabled>
                                <option value="" disabled selected>Pilih</option>
                                <option value="parameter-number" @if($form->type == 'parameter-number') selected @endif>Parameter Angka</option>
                                <option value="parameter-number-greatherthan" @if($form->type == 'parameter-number-greatherthan') selected @endif>Parameter Angka Lebih Dari</option>
                                <option value="parameter-number-lessthan" @if($form->type == 'parameter-number-lessthan') selected @endif>Parameter Angka Kurang Dari</option>
                                <option value="parameter-text" @if($form->type == 'parameter-text') selected @endif>Parameter Teks</option>
                                <option value="paragraph" @if($form->type == 'paragraph') selected @endif>Paragraf</option>
                                <option value="text" @if($form->type == 'text') selected @endif>Teks Pendek</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <label>Parameter</label>
                            <input class="form-control" type="text" name="parameter" value="{{$form->parameter}}">
                        </div>
                    </div>
                    @if($form->type == 'parameter-text' || $form->type == 'parameter-number' || $form->type == 'parameter-number-greatherthan' || $form->type == 'parameter-number-lessthan')
                    <div class="col-3">
                        <div class="form-group">
                            <label>Kode <small>(Tidak diwajibkan untuk diisi)</small></label>
                            <input class="form-control" type="text" value="{{$form->slug}}" name="slug">
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label>Satuan</label>
                            <input class="form-control" type="text" value="{{$form->satuan}}" name="satuan">
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label>Metode</label>
                            <input class="form-control" type="text" value="{{$form->metode}}" name="metode">
                        </div>
                    </div>
                    @endif
                </div>
                @if($form->type == 'parameter-text' || $form->type == 'parameter-number' || $form->type == 'parameter-number-greatherthan' || $form->type == 'parameter-number-lessthan')
                <hr>
                <table class="table table-striped table-layanan">
                    <tr>
                        @if($form->type == 'parameter-text')
                        <th>Nilai Normal</th>
                        @endif

                        @if($form->type == 'parameter-number')
                        <th colspan="2">Nilai Referensi</th>                        
                        <th colspan="2">Nilai Kritis</th>
                        @endif
                        @if($form->type == 'parameter-number-greatherthan' || $form->type == 'parameter-number-lessthan')
                            <th>Nilai Referensi</th>
                            <th>Nilai Kritis</th>
                        @endif

                        <th>Pria</th>
                        <th>Wanita</th>
                        <th colspan="2">Usia (th)</th>
                        <th>Hapus</th>
                    </tr>

                    @if(!count($form->detail))
                    <tr id="layanan_0" data-index="0" class="single-layanan">
                        @if($form->type == 'parameter-text')
                        <td>
                            <input type="text"  name="form_referensi_lainnya[]" class="form-control" placeholder="Nilai Lainnya">
                        </td>
                        @endif
                        @if($form->type == 'parameter-number')
                        <td>
                            <input type="number" step="0.01" name="form_referensi_min[]" class="form-control" placeholder="Minimal">
                        </td>
                        <td class="border-right">
                            <input type="number" step="0.01" name="form_referensi_max[]" class="form-control" placeholder="Maksimal">
                        </td>
                        <td>
                            <input type="number" step="0.01" name="form_kritis_min[]" class="form-control" placeholder="Batas Bawah">
                        </td>
                        <td class="border-right">
                            <input type="number" step="0.01" name="form_kritis_max[]" class="form-control" placeholder="Batas Atas">
                        </td>
                        @endif
                            @if($form->type == 'parameter-number-greatherthan')
                                <td>
                                    <input type="number" step="0.01" name="form_referensi_min[]" class="form-control" placeholder="Minimal">
                                </td>
                                <td>
                                    <input type="number" step="0.01" name="form_kritis_min[]" class="form-control" placeholder="Batas Bawah">
                                </td>
                            @endif
                            @if($form->type == 'parameter-number-lessthan')
                                <td class="border-right">
                                    <input type="number" step="0.01" name="form_referensi_max[]" class="form-control" placeholder="Maksimal">
                                </td>
                                <td class="border-right">
                                    <input type="number" step="0.01" name="form_kritis_max[]" class="form-control" placeholder="Batas Atas">
                                </td>
                            @endif
                        <td class="text-center border-right">
                            <input type="hidden" name="form_jk_pria-0" value="0" >
                            <div class="custom-control custom-checkbox mb-5">
                                <input class="custom-control-input" type="checkbox" name="form_jk_pria-0" value="1" checked="" id="form-checkbox-pria-0">
                                <label class="custom-control-label" for="form-checkbox-pria-0"></label>
                            </div>
                        </td>
                        <td class="text-center border-right">
                            <input type="hidden" name="form_jk_wanita-0" value="0" >
                            <div class="custom-control custom-checkbox mb-5">
                                <input class="custom-control-input" type="checkbox" name="form_jk_wanita-0" value="1" checked="" id="form-checkbox-wanita-0">
                                <label class="custom-control-label" for="form-checkbox-wanita-0"></label>
                            </div>
                        </td>

                        <td>
                            <input type="number" step="0.01" name="usia_min[]" class="form-control" placeholder="Min">
                        </td>
                        <td class="border-right">
                            <input type="number" step="0.01" name="usia_max[]" class="form-control" placeholder="Max">
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger" disabled="">
                                <i class="fa fa-times"></i>
                            </button>
                        </td>
                    </tr>   
                    @else
                    @foreach($form->detail as $index => $row)
                    <tr id="layanan_{{$index}}" data-index="0" class="single-layanan">
                        <input type="hidden" name="form_id[]" value="{{$row->id}}">
                        <input type="hidden" name="form_action[]" id="layanan_{{$index}}" data-index="{{$index}}">
                        @if($form->type == 'parameter-text')
                        <td>
                            <input type="text"  name="form_referensi_lainnya[]" class="form-control" placeholder="Nilai Lainnya" value="{{$row->referensi_lainnya}}">
                        </td>
                        @endif
                        @if($form->type == 'parameter-number')
                        <td>
                            <input type="number" step="0.01" name="form_referensi_min[]" class="form-control" placeholder="Minimal" value="{{$row->referensi_min}}">
                        </td>
                        <td class="border-right">
                            <input type="number" step="0.01" name="form_referensi_max[]" class="form-control" placeholder="Maksimal" value="{{$row->referensi_max}}">
                        </td>
                        <td>
                            <input type="number" step="0.01" name="form_kritis_min[]" class="form-control" placeholder="Batas Bawah" value="{{$row->kritis_min}}">
                        </td>
                        <td class="border-right">
                            <input type="number" step="0.01" name="form_kritis_max[]" class="form-control" placeholder="Batas Atas" value="{{$row->kritis_max}}">
                        </td>
                        @endif
                        @if($form->type == 'parameter-number-greatherthan')
                            <td>
                                <input type="number" step="0.01" name="form_referensi_min[]" class="form-control" placeholder="Minimal" value="{{$row->referensi_min}}">
                            </td>
                            <td>
                                <input type="number" step="0.01" name="form_kritis_min[]" class="form-control" placeholder="Batas Bawah" value="{{$row->kritis_min}}">
                            </td>
                        @endif
                        @if($form->type == 'parameter-number-lessthan')
                            <td class="border-right">
                                <input type="number" step="0.01" name="form_referensi_max[]" class="form-control" placeholder="Maksimal" value="{{$row->referensi_max}}">
                            </td>
                            <td class="border-right">
                                <input type="number" step="0.01" name="form_kritis_max[]" class="form-control" placeholder="Batas Atas" value="{{$row->kritis_max}}">
                            </td>
                        @endif
                        <td class="border-right text-center">
                            <input type="hidden" name="form_jk_pria-{{$index}}" value="0" >
                            <div class="custom-control custom-checkbox mb-5">
                                <input class="custom-control-input" type="checkbox" name="form_jk_pria-{{$index}}" value="1" id="form-checkbox-pria-{{$index}}" @if($row->jk_pria == 1) checked @endif >
                                <label class="custom-control-label" for="form-checkbox-pria-{{$index}}"></label>
                            </div>
                        </td>
                        <td class="text-center border-right">
                            <div class="custom-control custom-checkbox mb-5">
                                <input type="hidden" name="form_jk_wanita-{{$index}}" value="0" >
                                <input class="custom-control-input" type="checkbox" name="form_jk_wanita-{{$index}}" value="1" id="form-checkbox-wanita-{{$index}}"  @if($row->jk_wanita == 1) checked @endif >
                                <label class="custom-control-label" for="form-checkbox-wanita-{{$index}}"></label>
                            </div>
                        </td>
                        <td>
                            <input type="text" name="usia_min[]" class="form-control" placeholder="Min" value="{{$row->usia_min}}">
                        </td>
                        <td class="border-right">
                            <input type="text" name="usia_max[]" class="form-control" placeholder="Max" value="{{$row->usia_max}}">
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger" onclick="removeForm({{$index}}, {{$row->id}})">
                                <i class="fa fa-times"></i>
                            </button>
                        </td>
                    </tr>   
                    @endforeach
                    @endif

                </table>
                <div class="text-center">
                    <button type="button" class="btn btn btn-outline-primary" onclick="addForm();">
                        <i class="fa fa-plus mr-5" ></i> Tambah Parameter
                    </button>
                </div>
                @endif
                <div class="row">
                    <div class="form-group">
                        <div class="col-3">
                            <button class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
@include('labpk.components.footer')

@endsection
@section('js')

@section('js')
<script type="text/javascript">
    function addForm(){
        var totalLayanan = $(".single-layanan").length;
        var codeToAdd = `
            <tr id="layanan_`+totalLayanan+`" data-index="`+totalLayanan+`" class="single-layanan">
                @if($form->type == 'parameter-text')
                <td>
                <input type="text"  name="form_referensi_lainnya[]" class="form-control" placeholder="Nilai Lainnya">
                </td>
                @endif

                @if($form->type == 'parameter-number')
                <td>
                    <input type="number" step="0.01" name="form_referensi_min[]" class="form-control" placeholder="Minimal">
                </td>
                <td class="border-right">
                    <input type="number" step="0.01" name="form_referensi_max[]" class="form-control" placeholder="Maksimal">
                </td>
                <td>
                    <input type="number" step="0.01" name="form_kritis_min[]" class="form-control" placeholder="Batas Bawah">
                </td>
                <td class="border-right">
                    <input type="number" step="0.01" name="form_kritis_max[]" class="form-control" placeholder="Batas Atas">
                </td>
                @endif
                @if($form->type == 'parameter-number-greatherthan')
                <td>
                    <input type="number" step="0.01" name="form_referensi_min[]" class="form-control" placeholder="Minimal">
                </td>
                <td>
                    <input type="number" step="0.01" name="form_kritis_min[]" class="form-control" placeholder="Batas Bawah">
                </td>
                @endif
                @if($form->type == 'parameter-number-lessthan')
                td class="border-right">
                    <input type="number" step="0.01" name="form_referensi_max[]" class="form-control" placeholder="Maksimal">
                </td
                <td class="border-right">
                    <input type="number" step="0.01" name="form_kritis_max[]" class="form-control" placeholder="Batas Atas">
                </td>
                @endif
                <td class="border-right">
                    <div class="custom-control custom-checkbox mb-5">
                        <input type="hidden" name="form_jk_pria-`+totalLayanan+`" value="0" >
                        <input class="custom-control-input" type="checkbox" name="form_jk_pria-`+totalLayanan+`" value="1" checked="" id="form-checkbox-pria-`+totalLayanan+`">
                        <label class="custom-control-label" for="form-checkbox-pria-`+totalLayanan+`"></label>
                    </div>
                </td>
                <td class="border-right">
                    <div class="custom-control custom-checkbox mb-5">
                        <input type="hidden" name="form_jk_wanita-`+totalLayanan+`" value="0" >
                        <input class="custom-control-input" type="checkbox" name="form_jk_wanita-`+totalLayanan+`" value="1" checked="" id="form-checkbox-wanita-`+totalLayanan+`">
                        <label class="custom-control-label" for="form-checkbox-wanita-`+totalLayanan+`"></label>
                    </div>
                </td>
                <td>
                    <input type="number" step="0.01" name="usia_min[]" class="form-control" placeholder="Min">
                </td>
                <td class="border-right">
                    <input type="number" step="0.01" name="usia_max[]" class="form-control" placeholder="Max">
                </td>
                <td>
                    <button type="button" class="btn btn-danger" onclick="removeForm(`+totalLayanan+`)">
                        <i class="fa fa-times"></i>
                    </button>
                </td>
            </tr>   
            `
        ;
        $(".table-layanan").append(codeToAdd);
        window.scrollTo(0, document.body.scrollHeight);
    }
    function removeForm(id, realId = null) {
        $("#deletionDiv").append(`<input type="hidden" name="form_delete[]" value="`+realId+`">`);
        var totalLayanan = $(".single-layanan").length;
        if(!id && totalLayanan == 1){
            $(".custom-form").val('');
        }
        else 
            $("#layanan_"+id).remove();
    }


    
    $('.deleteButton').click(function(){
        var id = {{$form->id}}       
        swal({
            title: 'Apakah anda yakin?',
            text: "Data tidak dapat dikembalikan",
            type: 'warning',
            showCancelButton: true,
            confirmButtonClass: 'btn btn-danger',
            cancelButtonClass: 'btn btn-secondary',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            showLoaderOnConfirm: true,
            preConfirm: function() {
                return new Promise(function(resolve) {
                    $.ajax({
                        type: "POST",
                        url: BASE_URL + "labpk/pengaturan/form/delete/"+id,
                        dataType: "json",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (data) {
                            callSwal(data.type,data.title,data.message,0);
                            if(data.type == 'success')
                                window.location.href = BASE_URL + "labpk/pengaturan/form";
                        },
                        error: function () {
                            callSwal('error','Transaksi Gagal','Silahkan Coba Lagi',0);
                        }
                    })
                });
            }
        })
    });
</script>
@endsection
@endsection