@extends('layouts.main2')
@section('title')
Edit Form Layanan {{$tarif->deskripsi}}
@endsection
@section('content')
@include('labpk.components.header')

<div class="content">
    <div class="block block-themed">

        <div class="block-content">
            <form action="{{url('labpk/pengaturan/layanan/form/'.$tarif->id)}}" method="POST" id="layananForm">
                <h3>Edit Form Layanan {{$tarif->deskripsi}}</h3>
                {{csrf_field()}}
                <div id="deletionDiv"></div>
                <table class="table table-striped table-layanan">
                    <tr>
                        <th>Parameter</th>
                        <th>Satuan</th>
                        <th colspan="2">Nilai Referensi</th>
                        <th colspan="2">Nilai Kritis</th>
                        <th>Pria</th>
                        <th>Wanita</th>
                        <th colspan="2">Usia </th>
                        <th>Metode</th>
                        <th>Hapus</th>
                    </tr>

                    @if(!count($forms))
                    <tr id="layanan_0" data-index="0" class="single-layanan">
                        <td>
                            <input type="hidden" name="form_action[]" id="action_0" value="0">
                            <input type="text" name="form_parameter[]" class="form-control" placeholder="Parameter">
                        </td>
                        <td>
                            <input type="text" name="form_satuan[]" class="form-control" placeholder="Satuan">
                        </td>
                        <td>
                            <input type="number" name="form_referensi_min[]" class="form-control" placeholder="Minimal">
                        </td>
                        <td>
                            <input type="number" name="form_referensi_max[]" class="form-control" placeholder="Maksimal">
                        </td>
                        <td>
                            <input type="number" name="form_kritis_min[]" class="form-control" placeholder="Batas Bawah">
                        </td>
                        <td>
                            <input type="number" name="form_kritis_max[]" class="form-control" placeholder="Batas Atas">
                        </td>
                        <td>
                            <input type="hidden" name="form_jk_pria-0" value="0" >
                            <div class="custom-control custom-checkbox mb-5">
                                <input class="custom-control-input" type="checkbox" name="form_jk_pria-0" value="1" checked="" id="form-checkbox-pria-0">
                                <label class="custom-control-label" for="form-checkbox-pria-0"></label>
                            </div>
                        </td>
                        <td>
                            <input type="hidden" name="form_jk_pria-0" value="0" >
                            <div class="custom-control custom-checkbox mb-5">
                                <input class="custom-control-input" type="checkbox" name="form_jk_wanita-0" value="1" checked="" id="form-checkbox-wanita-0">
                                <label class="custom-control-label" for="form-checkbox-wanita-0"></label>
                            </div>
                        </td>

                        <td>
                            <input type="number" name="usia_min[]" class="form-control" placeholder="Min">
                        </td>
                        <td>
                            <input type="number" name="usia_max[]" class="form-control" placeholder="Max">
                        </td>
                        <td>
                            <input type="text" name="metode[]" class="form-control" placeholder="Metode">
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger" disabled="">
                                <i class="fa fa-times"></i>
                                Hapus
                            </button>
                        </td>
                    </tr>   
                    @else
                    @foreach($forms as $index => $row)
                    <tr id="layanan_{{$index}}" data-index="0" class="single-layanan">
                        <td class="border-right">
                            <input type="hidden" name="form_id[]" value="{{$row->id}}">
                            <input type="hidden" name="form_action[]" id="layanan_{{$index}}" data-index="{{$index}}">
                            <input type="text" name="form_parameter[]"  class="form-control" placeholder="Parameter" value="{{$row->parameter}}">
                        </td>
                        <td class="border-right">
                            <input type="text" name="form_satuan[]" class="form-control" placeholder="Satuan" value="{{$row->satuan}}">
                        </td>
                        <td>
                            <input type="number" name="form_referensi_min[]" class="form-control" placeholder="Minimal" value="{{$row->referensi_min}}">
                        </td>
                        <td class="border-right">
                            <input type="number" name="form_referensi_max[]" class="form-control" placeholder="Maksimal" value="{{$row->referensi_max}}">
                        </td>
                        <td>
                            <input type="number" name="form_kritis_min[]" class="form-control" placeholder="Batas Bawah" value="{{$row->kritis_min}}">
                        </td>
                        <td class="border-right">
                            <input type="number" name="form_kritis_max[]" class="form-control" placeholder="Batas Atas" value="{{$row->kritis_max}}">
                        </td>

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
                        <td class="border-right">
                            <input type="text" name="metode[]" class="form-control" placeholder="Metode" value="{{$row->metode ?? ''}}">
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
            </div>
            <div class="text-center">
                <button type="button" class="btn btn btn-outline-primary" onclick="addForm();">
                    <i class="fa fa-plus mr-5" ></i> Tambah Parameter
                </button>
            </div>
            <div style="padding-bottom: 70px">
                <button type="button" class="btn btn-primary btn-hero pull-right mr-30" data-toggle="modal" data-target="#modalConfirmation">Simpan Perubahan</button>
            </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="modalConfirmation" tabindex="-1" role="dialog" aria-labelledby="modalConfirmation" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-popin" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Simpan Perubahan</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <p>Apakah anda yakin untuk menyimpan perubahan?</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Batal</button>
                <button type="button" onclick="submitForm();" class="btn btn-alt-success" data-dismiss="modal">
                    <i class="fa fa-check"></i> Lanjut
                </button>
            </div>
        </div>
    </div>
</div>


@include('labpk.components.footer')

@endsection
@section('js')
<script type="text/javascript">
    function addForm(){
        var totalLayanan = $(".single-layanan").length;
        var codeToAdd = `
            <tr id="layanan_`+totalLayanan+`" data-index="`+totalLayanan+`" class="single-layanan">
                <td class="border-right">
                    <input type="hidden" name="form_action[]" id="action_`+totalLayanan+`" value="0">
                    <input type="text" name="form_parameter[]" class="form-control" placeholder="Parameter">
                </td>
                <td class="border-right">
                    <input type="text" name="form_satuan[]" class="form-control" placeholder="Satuan">
                </td>
                <td>
                    <input type="number" name="form_referensi_min[]" class="form-control" placeholder="Minimal">
                </td>
                <td class="border-right">
                    <input type="number" name="form_referensi_max[]" class="form-control" placeholder="Maksimal">
                </td>
                <td>
                    <input type="number" name="form_kritis_min[]" class="form-control" placeholder="Batas Bawah">
                </td>
                <td class="border-right">
                    <input type="number" name="form_kritis_max[]" class="form-control" placeholder="Batas Atas">
                </td>
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
                    <input type="number" name="usia_min[]" class="form-control" placeholder="Min">
                </td>
                <td class="border-right">
                    <input type="number" name="usia_max[]" class="form-control" placeholder="Max">
                </td>
                <td class="border-right">
                    <input type="text" name="metode[]" class="form-control" placeholder="Metode">
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
    function submitForm() {
        $("#layananForm").submit();
    }

    $(document).ready(function(){
        $('#deskripsi_wrapper').hide();
        $('#form_urikkes').change(function() {
            if (this.checked) {
                $('#deskripsi_wrapper').show();
            } else {
                $('#deskripsi_wrapper').hide();
            }
        });
    });
</script>
@endsection