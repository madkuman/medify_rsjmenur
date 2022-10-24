<div class="modal fade" id="modal-create-urine" tabindex="-1" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-fromright modal-dialog" role="document">
        <div class="modal-content">
            <div class="block rounded block-transparent mb-0">
                <div class="block-header">
                    <h3 class="block-title">Pemeriksaan Urine</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <form class="js-validation-be-contact" action="{{url('kasus')}}/{{ $nomor_kasus }}/pemeriksaanlab/urine/create" method="post">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="block-content">
                                <h5>Urinalisa</h5>
                                <div class="row">
                                    <label class="col-lg-3 col-form-label">Parameter</label>
                                    <div class="col-lg-4 col-form-label text-center">Hasil</div>
                                    <label class="col-lg-2 col-form-label text-center">Satuan</label>
                                    <label class="col-lg-3 col-form-label text-center">Referensi</label>
                                    <div class="col-12"><hr></div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Warna</label>
                                    <div class="col-lg-4">
                                        <input  type="text" class="form-control" name="warna" autocomplete="off">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center"> - </label>
                                    <label class="col-lg-3 col-form-label text-center"> - </label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Berat Jenis / S.G</label>
                                    <div class="col-lg-4">
                                        <input  type="text" class="form-control" name="berat_jenis" autocomplete="off">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center"> - </label>
                                    <label class="col-lg-3 col-form-label text-center"> - </label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">pH</label>
                                    <div class="col-lg-4">
                                        <input  type="text" class="form-control" name="ph" autocomplete="off">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center"> - </label>
                                    <label class="col-lg-3 col-form-label text-center"> - </label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Protein</label>
                                    <div class="col-lg-4">
                                        <input  type="text" class="form-control" name="protein" autocomplete="off">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center"> - </label>
                                    <label class="col-lg-3 col-form-label text-center"> - </label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Reduksi</label>
                                    <div class="col-lg-4">
                                        <input  type="text" class="form-control" name="reduksi" autocomplete="off">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center"> - </label>
                                    <label class="col-lg-3 col-form-label text-center"> - </label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Bilirubin</label>
                                    <div class="col-lg-4">
                                        <input  type="text" class="form-control" name="bilirubin" autocomplete="off">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center"> - </label>
                                    <label class="col-lg-3 col-form-label text-center"> - </label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Keton</label>
                                    <div class="col-lg-4">
                                        <input  type="text" class="form-control" name="keton" autocomplete="off">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center"> - </label>
                                    <label class="col-lg-3 col-form-label text-center"> - </label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Nitrit</label>
                                    <div class="col-lg-4">
                                        <input  type="text" class="form-control" name="nitrit" autocomplete="off">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center"> - </label>
                                    <label class="col-lg-3 col-form-label text-center"> - </label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Leukosit</label>
                                    <div class="col-lg-4">
                                        <input  type="text" class="form-control" name="leukosit" autocomplete="off">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center"> - </label>
                                    <label class="col-lg-3 col-form-label text-center"> - </label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Tes Kehamilan</label>
                                    <div class="col-lg-4">
                                        <input  type="text" class="form-control" name="tes_kehamilan" autocomplete="off">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center"> - </label>
                                    <label class="col-lg-3 col-form-label text-center"> - </label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Reduksi 2 Jpp</label>
                                    <div class="col-lg-4">
                                        <input  type="text" class="form-control" name="reduksi_2_jpp" autocomplete="off">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center"> - </label>
                                    <label class="col-lg-3 col-form-label text-center"> - </label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Urobilinogen</label>
                                    <div class="col-lg-4">
                                        <input  type="text" class="form-control" name="urobilinogen" autocomplete="off">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center"> - </label>
                                    <label class="col-lg-3 col-form-label text-center"> - </label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Urobilirubin</label>
                                    <div class="col-lg-4">
                                        <input  type="text" class="form-control" name="urobilirubin" autocomplete="off">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center"> - </label>
                                    <label class="col-lg-3 col-form-label text-center"> - </label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Candida</label>
                                    <div class="col-lg-4">
                                        <input  type="text" class="form-control" name="candida" autocomplete="off">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center"> lpb </label>
                                    <label class="col-lg-3 col-form-label text-center"> - </label>
                                </div>
                                <div class="col-12"><hr></div>
                            </div>
                            <div class="block-content" style="margin-top: 30px;">
                                <h5>Sedimen</h5>
                                <div class="row">
                                    <label class="col-lg-3 col-form-label">Parameter</label>
                                    <div class="col-lg-4 col-form-label text-center">Hasil</div>
                                    <label class="col-lg-2 col-form-label text-center">Satuan</label>
                                    <label class="col-lg-3 col-form-label text-center">Referensi</label>
                                    <div class="col-12"><hr></div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Eritrosit</label>
                                    <div class="col-lg-4">
                                        <input  type="text" class="form-control" name="eritrosit" autocomplete="off">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center"> lpb </label>
                                    <label class="col-lg-3 col-form-label text-center"> - </label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Leuko</label>
                                    <div class="col-lg-4">
                                        <input  type="text" class="form-control" name="leuko" autocomplete="off">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center"> lpb </label>
                                    <label class="col-lg-3 col-form-label text-center"> - </label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Epitel</label>
                                    <div class="col-lg-4">
                                        <input  type="text" class="form-control" name="epitel" autocomplete="off">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center"> lpb </label>
                                    <label class="col-lg-3 col-form-label text-center"> - </label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Bakteri</label>
                                    <div class="col-lg-4">
                                        <input  type="text" class="form-control" name="bakteri" autocomplete="off">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center"> lpb </label>
                                    <label class="col-lg-3 col-form-label text-center"> - </label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Cylinder</label>
                                    <div class="col-lg-4">
                                        <input  type="text" class="form-control" name="cylinder" autocomplete="off">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center"> lpb </label>
                                    <label class="col-lg-3 col-form-label text-center"> - </label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Kristal</label>
                                    <div class="col-lg-4">
                                        <input  type="text" class="form-control" name="kristal" autocomplete="off">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center"> lpb </label>
                                    <label class="col-lg-3 col-form-label text-center"> - </label>
                                </div>
                                <div class="col-12"><hr></div>
                            </div>
                            <div class="block-content" style="margin-top: 30px;">
                                <h5>Narkoba</h5>
                                <div class="row">
                                    <label class="col-lg-3 col-form-label">Parameter</label>
                                    <div class="col-lg-4 col-form-label text-center">Hasil</div>
                                    <label class="col-lg-2 col-form-label text-center">Satuan</label>
                                    <label class="col-lg-3 col-form-label text-center">Referensi</label>
                                    <div class="col-12"><hr></div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Morfin</label>
                                    <div class="col-lg-4">
                                        <input  type="text" class="form-control" name="morphin" autocomplete="off">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center"> - </label>
                                    <label class="col-lg-3 col-form-label text-center"> - </label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Metamphetamine</label>
                                    <div class="col-lg-4">
                                        <input  type="text" class="form-control" name="metamphetamine" autocomplete="off">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center"> - </label>
                                    <label class="col-lg-3 col-form-label text-center"> - </label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Amphetamine</label>
                                    <div class="col-lg-4">
                                        <input  type="text" class="form-control" name="amphetamine" autocomplete="off">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center"> - </label>
                                    <label class="col-lg-3 col-form-label text-center"> - </label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Diazepam</label>
                                    <div class="col-lg-4">
                                        <input  type="text" class="form-control" name="diazepam" autocomplete="off">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center"> - </label>
                                    <label class="col-lg-3 col-form-label text-center"> - </label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Ganja</label>
                                    <div class="col-lg-4">
                                        <input  type="text" class="form-control" name="ganja" autocomplete="off">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center"> - </label>
                                    <label class="col-lg-3 col-form-label text-center"> - </label>
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