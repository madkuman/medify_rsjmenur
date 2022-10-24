<div class="modal fade" id="modal-edit-imun" tabindex="-1" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-fromright modal-dialog" role="document">
        <div class="modal-content">
            <div class="block rounded block-transparent mb-0">
                <div class="block-header">
                    <h3 class="block-title">Pemeriksaan Immunologi</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <form class="js-validation-be-contact" action="{{url('kasus')}}/{{ $nomor_kasus }}/pemeriksaanlab/imun/create" method="post">
                        {{ csrf_field() }}
                        <input id="imun_id" name="imun_id" type="hidden">
                        <div class="row">
                            <div class="block-content">
                                <h5>Immunologi</h5>
                                <div class="row">
                                    <label class="col-lg-3 col-form-label">Parameter</label>
                                    <div class="col-lg-4 col-form-label text-center">Hasil</div>
                                    <label class="col-lg-2 col-form-label text-center">Satuan</label>
                                    <label class="col-lg-3 col-form-label text-center">Referensi</label>
                                    <div class="col-12"><hr></div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">HBs Ag (RPHA)</label>
                                    <div class="col-lg-4">
                                        <input  type="text" class="form-control" name="hbs_ag" autocomplete="off" id="hbs_ag">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">mlU/ml</label>
                                    <label class="col-lg-3 col-form-label text-center">Negative</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Anti HIV</label>
                                    <div class="col-lg-4">
                                        <input  type="text" class="form-control" name="anti_hiv" autocomplete="off" id="anti_hiv">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">mlU/ml</label>
                                    <label class="col-lg-3 col-form-label text-center">Negative</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">VDRL</label>
                                    <div class="col-lg-4">
                                        <input  type="text" class="form-control" name="vdrl" autocomplete="off" id="vdrl">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center"></label>
                                    <label class="col-lg-3 col-form-label text-center">Negative</label> 
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Anti HCV</label>
                                    <div class="col-lg-4">
                                        <input  type="text" class="form-control" name="anti_hcv" autocomplete="off" id="anti_hcv">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center"></label>
                                    <label class="col-lg-3 col-form-label text-center">Negative</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">ICT Malaria</label>
                                    <div class="col-lg-4">
                                        <input  type="text" class="form-control" name="ict_malaria" autocomplete="off" id="ict_malaria">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center"></label>
                                    <label class="col-lg-3 col-form-label text-center">Negative</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Coomb Test</label>
                                    <div class="col-lg-4">
                                        <input  type="text" class="form-control" name="coomb_test" autocomplete="off" id="coomb_test">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center"></label>
                                    <label class="col-lg-3 col-form-label text-center">Negative</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">HB eAg</label>
                                    <div class="col-lg-4">
                                        <input  type="text" class="form-control" name="hb_eag" autocomplete="off" id="hb_eag">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center"></label>
                                    <label class="col-lg-3 col-form-label text-center">Negative</label>
                                </div>
                                <hr>
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-12 text-center">
                                            <button type="submit" class="btn-alt btn-hero btn-primary min-width-175 float-right">
                                                <i class="fa fa-send mr-5"></i> Simpan
                                            </button>
                                        </div>
                                    </div>                            
                                </div>
                            </div> 
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>