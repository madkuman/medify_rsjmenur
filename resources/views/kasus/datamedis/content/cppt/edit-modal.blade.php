<div class="modal fade" id="cpptModalEdit" tabindex="-1" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block rounded block-transparent mb-0">
                <div class="block-header">
                    <h3 class="block-title">CPPT <span id="title-number"></span></h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <form class="js-validation-be-contact" action="{{url('kasus')}}/{{ $nomor_kasus }}/datamedis/cppt/edit" method="post">
                        {{ csrf_field() }}

                        <input type="hidden" class="form-control form-control-lg" id="cppt-edit-id" name="id" placeholder=""></textarea>

                        
                        <div class="form-group row">
                            <label class="col-12" for="">Subjective</label>
                            <div class="col-12">
                                <textarea class="form-control form-control-lg" id="cppt-edit-s" name="subjective" rows="3" placeholder=""></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-12" for="">Objective</label>
                            <div class="col-12">
                                <textarea class="form-control form-control-lg" id="cppt-edit-o" name="objective" rows="3" placeholder=""></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-12" for="">Assessment</label>
                            <div class="col-12">
                                <textarea class="form-control form-control-lg search-diagnosis" id="cppt-edit-a" name="assessment" rows="3" placeholder=""></textarea>
                            </div>
                            <div class="suggest-assessment-loading col-12 hide">
                                <i class="fa fa-spin fa-spinner"></i> Sedang mengolah data sugesti untuk Anda
                            </div>
                            <div class="col-12 mt-5 suggest-assessment ">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-12" for="">Plan</label>
                            <div class="col-12">
                                <textarea class="form-control form-control-lg" id="cppt-edit-p" name="plan" rows="3" placeholder=""></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-12" for="">
                                @if(Auth::user()->profesi == 1)
                                Instruksi Dokter
                                @else
                                Keterangan
                                @endif
                            </label>
                            <div class="col-12">
                                <textarea class="form-control form-control-lg" id="cppt-edit-ppa" name="ppa" rows="3" placeholder=""></textarea>
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