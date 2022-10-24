@foreach ($telinga as $key => $value)
<div class="modal fade" id="modal-edit-telinga{{$key}}" tabindex="-1" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block rounded block-transparent mb-0">
                <div class="block-header">
                    <h3 class="block-title">Edit Pemeriksaan {{$key+1}}</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <form class="js-validation-be-contact" action="{{url('kasus')}}/{{$kasus->nomor_kasus}}/pemeriksaan-spesialis/telinga/edit" method="post">
                        {{ csrf_field() }}
                        <div class="">
                            <div class="">
                                <input type="hidden" class="form-control form-control-lg" id="" name="id" placeholder="" value="{{$value->id}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-3" for="">Audiometri (AD)</label>
                            <div class="col-9">
                                <input type="text" class="form-control form-control-lg" id="" name="audio_ad" rows="3" placeholder="" value="{{$value->audio_ad}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-3" for="">Audiometri (AS)</label>
                            <div class="col-9">
                                <input type="text" class="form-control form-control-lg" id="" name="audio_as" rows="3" placeholder="" value="{{$value->audio_as}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-3" for="">Suara Bisikan (AD)</label>
                            <div class="col-9">
                                <input type="text" class="form-control form-control-lg" id="" name="suara_ad" rows="3" placeholder="" value="{{$value->suara_ad}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-3" for="">Suara Bisikan (AS)</label>
                            <div class="col-9">
                                <input type="text" class="form-control form-control-lg" id="" name="suara_as" rows="3" placeholder="" value="{{$value->suara_as}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-3" for="">Liang</label>
                            <div class="col-9">
                                <input type="text" class="form-control form-control-lg" id="" name="liang" rows="3" placeholder="" value="{{$value->liang}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-3" for="">Tajam Pendengaran</label>
                            <div class="col-9">
                                <input type="text" class="form-control form-control-lg" id="" name="tajam_pendengaran" rows="3" placeholder="" value="{{$value->tajam_pendengaran}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-3" for="">Gendang Kanan</label>
                            <div class="col-9">
                                <input type="text" class="form-control form-control-lg" id="" name="gendang_kanan" rows="3" placeholder="" value="{{$value->gendang_kanan}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-3" for="">Gendang Kiri</label>
                            <div class="col-9">
                                <input type="text" class="form-control form-control-lg" id="" name="gendang_kiri" rows="3" placeholder="" value="{{$value->gendang_kiri}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12 text-center">
                                <button type="submit" class="btn-alt btn-hero btn-primary min-width-175 float-right">
                                    <i class="fa fa-send mr-5"></i> Simpan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
