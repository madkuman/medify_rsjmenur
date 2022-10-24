<div class="modal fade" id="modal-create-timbang-terima" tabindex="-1" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block rounded block-transparent mb-0">
                <div class="block-header">
                    <h3 class="block-title">Buat Timbang Terima Baru</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <form class="js-validation-be-contact" action="{{url('')}}/kasus/{{$kasus->nomor_kasus}}/keperawatan/timbang-terima/save" method="post">
                        {{csrf_field()}}
                        <div class="">
                            <div class="">
                                <input type="hidden" class="form-control form-control-lg" id="" name="nomor-kasus" placeholder="" value="">
                                <input type="hidden" class="form-control form-control-lg" id="id-timbang" name="id" placeholder="" value="">
                            </div>
                        </div>
                        <div>
                            <label>Suggest Timbang Terima</label>
                            <div class="suggest-main-loading col-12">
                                <i class="fa fa-spin fa-spinner"></i> Sedang mengolah data sugesti untuk Anda
                            </div>
                            <div class="col-12 mt-5 suggest-main ">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-12" for="">Subjective</label>
                            <div class="col-12">
                                <textarea class="form-control form-control-lg" id="timbang-create-s" name="subjective" rows="3" placeholder=""></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-12" for="">Objective</label>
                            <div class="col-12">
                                <textarea class="form-control form-control-lg" id="timbang-create-o" name="objective" rows="3" placeholder=""></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-12" for="">Assessment</label>
                            <div class="col-12">
                                <textarea class="form-control form-control-lg" id="timbang-create-a" name="assessment" rows="3" placeholder=""></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-12" for="">Plan</label>
                            <div class="col-12">
                                <textarea class="form-control form-control-lg" id="timbang-create-p" name="plan" rows="3" placeholder=""></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-12" for="">Instruksi PPA</label>
                            <div class="col-12">
                                <textarea class="form-control form-control-lg" id="timbang-create-ppa" name="ppa" rows="3" placeholder=""></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-12" for="">Evaluasi</label>
                            <div class="col-12">
                                <textarea class="form-control form-control-lg" id="timbang-create-e" name="evaluasi" rows="3" placeholder=""></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12 text-center">
                                <button type="submit" class="btn-alt btn-click-animate btn-hero btn-primary min-width-175 float-right">
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