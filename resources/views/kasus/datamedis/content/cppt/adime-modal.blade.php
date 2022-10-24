<div class="modal fade" id="modal-create-adime" tabindex="-1" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block rounded block-transparent mb-0">
                <div class="block-header">
                    <h3 class="block-title">ADIME Gizi</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <form class="js-validation-be-contact" action="{{url('kasus')}}/{{ $nomor_kasus }}/datamedis/cppt/save/adime" method="post">
                        {{ csrf_field() }}
                        <div class="">
                            <div class="">
                                <input type="hidden" class="form-control form-control-lg" id="" name="nomor-kasus" placeholder="" value="{{ $nomor_kasus }}">
                                <input type="hidden" class="form-control form-control-lg" id="adime-id" name="id" placeholder="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-12" for="">Assessment</label>
                            <div class="col-12">
                                <textarea class="form-control form-control-lg" id="adime-create-a" name="assessment" rows="3" placeholder="">
                                </textarea>
                            </div>
                            <div class="suggest-adime-assessment-loading col-12 hide">
                                <i class="fa fa-spin fa-spinner"></i> Sedang mengolah data sugesti untuk Anda
                            </div>
                            <div class="col-12 mt-5 suggest-adime-assessment ">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-12" for="">Diagnosis</label>
                            <div class="col-12">
                                <textarea class="form-control form-control-lg" id="adime-create-d" name="subjective" rows="3" placeholder=""></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-12" for="">Intervensi</label>
                            <div class="col-12">
                                <textarea class="form-control form-control-lg" id="adime-create-i" name="objective" rows="3" placeholder="">
                                </textarea>
                            </div>
                            <div class="suggest-adime-intervensi-loading col-12 hide">
                                <i class="fa fa-spin fa-spinner"></i> Sedang mengolah data sugesti untuk Anda
                            </div>
                            <div class="col-12 mt-5 suggest-adime-intervensi ">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-12" for="">Monitoring</label>
                            <div class="col-12">
                                <textarea class="form-control form-control-lg" id="adime-create-m" name="plan" rows="3" placeholder=""></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-12" for="">Evaluation</label>
                            <div class="col-12">
                                <textarea class="form-control form-control-lg" id="adime-create-e" name="ppa" rows="3" placeholder=""></textarea>
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