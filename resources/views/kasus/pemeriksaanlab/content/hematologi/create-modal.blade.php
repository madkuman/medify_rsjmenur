<div class="modal fade" id="modal-create-hematologi" tabindex="-1" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-fromright modal-dialog" role="document">
        <div class="modal-content">
            <div class="block rounded block-transparent mb-0">
                <div class="block-header">
                    <h3 class="block-title">Pemeriksaan Hematologi</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <form class="js-validation-be-contact" action="{{url('kasus')}}/{{ $nomor_kasus }}/pemeriksaanlab/hematologi/create" method="post">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="block-content">
                                <h5>أHematologi</h5>
                                <div class="row">
                                    <label class="col-lg-3 col-form-label">Parameter</label>
                                    <div class="col-lg-4 col-form-label text-center">Hasil</div>
                                    <label class="col-lg-2 col-form-label text-center">Satuan</label>
                                    <label class="col-lg-3 col-form-label text-center">Referensi</label>
                                    <div class="col-12"><hr></div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Leukosit</label>
                                    <div class="col-lg-4">
                                        <input type="text" class="form-control" name="leukosit" autocomplete="off">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">btr/mm3</label>
                                    <label class="col-lg-3 col-form-label text-center">4rb-1rb</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Eritrosit</label>
                                    <div class="col-lg-4">
                                        <input type="text" class="form-control" name="eritrosit" autocomplete="off">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">jt/mm3</label>
                                    <label class="col-lg-3 col-form-label text-center">L: 4,3 P: &lt15</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Hemoglobin</label>
                                    <div class="col-lg-4">
                                        <input type="text" class="form-control" name="hemoglobin" autocomplete="off">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">g%</label>
                                    <label class="col-lg-3 col-form-label text-center">L: 13,0 P: 11.5-16</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Hematokrit</label>
                                    <div class="col-lg-4">
                                        <input type="text" class="form-control" name="hematokrit" autocomplete="off">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">g%</label>
                                    <label class="col-lg-3 col-form-label text-center">L. 40-54; P. 35-45;</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">MCV</label>
                                    <div class="col-lg-4">
                                        <input type="text" class="form-control" name="mcv" autocomplete="off">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">fl</label>
                                    <label class="col-lg-3 col-form-label text-center">82-92</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">MCH</label>
                                    <div class="col-lg-4">
                                        <input type="text" class="form-control" name="mch" autocomplete="off">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">pg</label>
                                    <label class="col-lg-3 col-form-label text-center">27-31</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">MCHC</label>
                                    <div class="col-lg-4">
                                        <input type="text" class="form-control" name="mchc" autocomplete="off">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">g/dl</label>
                                    <label class="col-lg-3 col-form-label text-center">32-37</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Trombosit</label>
                                    <div class="col-lg-4">
                                        <input type="text" class="form-control" name="trombosit" autocomplete="off">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">ribu/mm3</label>
                                    <label class="col-lg-3 col-form-label text-center">150rb - 40rb</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">LED</label>
                                    <div class="col-lg-4">
                                        <input type="text" class="form-control" name="led" autocomplete="off">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">mm/jam</label>
                                    <label class="col-lg-3 col-form-label text-center">L:&lt7 P:&lt15</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Retikulosit</label>
                                    <div class="col-lg-4">
                                        <input type="text" class="form-control" name="retikulosit" autocomplete="off">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">%</label>
                                    <label class="col-lg-3 col-form-label text-center">0,5-1,5</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Diff Eosinofil</label>
                                    <div class="col-lg-4">
                                        <input type="text" class="form-control" name="diff_eosinofil" autocomplete="off">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">%</label>
                                    <label class="col-lg-3 col-form-label text-center">1-3</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Diff Eosinofil</label>
                                    <div class="col-lg-4">
                                        <input type="text" class="form-control" name="diff_eosinofil" autocomplete="off">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">%</label>
                                    <label class="col-lg-3 col-form-label text-center">1-3</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Diff Basofil</label>
                                    <div class="col-lg-4">
                                        <input type="text" class="form-control" name="diff_basofil" autocomplete="off">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">%</label>
                                    <label class="col-lg-3 col-form-label text-center">0-1</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Diff Stab</label>
                                    <div class="col-lg-4">
                                        <input type="text" class="form-control" name="diff_stab" autocomplete="off">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">%</label>
                                    <label class="col-lg-3 col-form-label text-center">2-6</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Diff Segmen</label>
                                    <div class="col-lg-4">
                                        <input type="text" class="form-control" name="diff_segmen" autocomplete="off">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">%</label>
                                    <label class="col-lg-3 col-form-label text-center">50-70</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Diff Limposit</label>
                                    <div class="col-lg-4">
                                        <input type="text" class="form-control" name="diff_limposit" autocomplete="off">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">%</label>
                                    <label class="col-lg-3 col-form-label text-center">20-40</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Diff Monosit</label>
                                    <div class="col-lg-4">
                                        <input type="text" class="form-control" name="diff_monosit" autocomplete="off">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">%</label>
                                    <label class="col-lg-3 col-form-label text-center">2-8</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Waktu Pendarahan</label>
                                    <div class="col-lg-4">
                                        <input type="text" class="form-control" name="pendarahan" autocomplete="off">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">m3</label>
                                    <label class="col-lg-3 col-form-label text-center">9-15</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Waktu Pembekuan</label>
                                    <div class="col-lg-4">
                                        <input type="text" class="form-control" name="pembekuan" autocomplete="off">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">m3</label>
                                    <label class="col-lg-3 col-form-label text-center">1-6</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">P T</label>
                                    <div class="col-lg-4">
                                        <input type="text" class="form-control" name="pt" autocomplete="off">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">-</label>
                                    <label class="col-lg-3 col-form-label text-center">-</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">HCT</label>
                                    <div class="col-lg-4">
                                        <input type="text" class="form-control" name="hct" autocomplete="off">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">%</label>
                                    <label class="col-lg-3 col-form-label text-center">L: 40-54 P: 35-45</label>
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