<div class="modal fade" id="addModal" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog modal-fullscreen" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ url()->current() }}/create">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title">Klinik Rehab Medik</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <input type="hidden" name="id" value="" class="id-asesmen">
                    <div class="block-content" style="padding-left: 25px; padding-right: 25px;">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-12">
                                <h5 class="mb-5 mt-10">Pemeriksaan Umum</h5>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Keluhan Utama</label>
                                    <div class="col-12">
                                        <textarea class="form-control" name="keluhan_utama"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 full-only"></div>
                            <div class="col-md-5">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Riwayat Penyakit</label>
                                    <div class="col-12">
                                        <textarea class="form-control" name="riwayat_penyakit"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <hr>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <h5 class="mb-5 mt-10">Pemeriksaan Fisik</h5>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Kesadaran</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="kesadaran">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Ambulasi</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="ambulasi">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row mb-5">
                                    <label class="col-12">N Cranialis</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="n_cranialis">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Reflek Fisiologi</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="reflek_fisiologi">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Reflek Patologi</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="reflek_patologi">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Motoris</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="motoris">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Sensoris</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="sensoris">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row mb-5">
                                    <label class="col-12">R O M</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="r_o_m">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Atropi</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="atropi">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Kontraktur</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="kontraktur">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Lain-lain</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="lain2">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <hr>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Diagnosa Awal</label>
                                    <div class="col-12">
                                        <textarea class="form-control" name="diagnosa_awal"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Rencana</label>
                                    <div class="col-12">
                                        <textarea class="form-control" name="rencana"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <hr>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Terima Medicamentos</label>
                                    <div class="col-12">
                                        <textarea class="form-control" name="terima_medicamentos"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Terapi Fisik</label>
                                    <div class="col-12">
                                        <textarea class="form-control" name="terapi_fisik"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="form-group">
                        <button type="button" class="btn btn-default btn-simple"
                            data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-click-animate btn-primary btn-simple">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
