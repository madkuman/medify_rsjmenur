<div class="modal fade" id="modal-create-cppt" tabindex="-1" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block rounded block-transparent mb-0">
                <div class="block-header">
                    <h3 class="block-title">Buat CPPT Baru</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <form class="js-validation-be-contact" action="{{url('kasus')}}/{{ $nomor_kasus }}/datamedis/cppt/create" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="">
                            <div class="">
                                <input type="hidden" class="form-control form-control-lg" id="" name="nomor-kasus" placeholder="" value="{{ $nomor_kasus }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-12" for="">Subjective</label>
                            <div class="col-12">
                                <textarea class="form-control form-control-lg" id="cppt-create-s" name="subjective" rows="3" placeholder=""></textarea>
                            </div>
                            <div class="suggest-subjective-loading col-12 hide">
                                <i class="fa fa-spin fa-spinner"></i> Sedang mengolah data sugesti untuk Anda
                            </div>
                            <div class="col-12 mt-5 suggest-subjective ">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-12" for="">Objective</label>
                            <div class="col-12">
                                <textarea class="form-control form-control-lg" id="cppt-create-o" name="objective" rows="3" placeholder=""></textarea>
                            </div>
                            <div class="suggest-objective-loading col-12 hide">
                                <i class="fa fa-spin fa-spinner"></i> Sedang mengolah data sugesti untuk Anda
                            </div>
                            <div class="col-12 mt-5 suggest-objective ">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-12" for="">Assessment</label>
                            <div class="col-12">
                                <textarea class="form-control form-control-lg search-diagnosis" id="cppt-create-a" name="assessment" rows="3" placeholder=""></textarea>
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
                                <textarea class="form-control form-control-lg" id="cppt-create-p" name="plan" rows="3" placeholder=""></textarea>
                            </div>
                            <div class="suggest-plan-loading col-12 hide">
                                <i class="fa fa-spin fa-spinner"></i> Sedang mengolah data sugesti untuk Anda
                            </div>
                            <div class="col-12 mt-5 suggest-plan ">
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
                                <textarea class="form-control form-control-lg" id="cppt-create-ppa" name="ppa" rows="3" placeholder=""></textarea>
                            </div>
                            {{--
                            <div class="col-12">
                                <label class="css-control css-control-primary css-checkbox">
                                    <input type="checkbox" name="todo" class="css-control-input" checked>
                                    <span class="css-control-indicator"></span> Tambahkan pada To Do
                                </label>
                            </div>
                            --}}
                        </div>
                        <div class="form-group row">
                            <label class="col-12" for="">File Foto / Video</label>
                            <div class="col-12">
                                <input type="file" class="form-control" id="cppt-create-files" name="cppt_files[]" multiple >
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