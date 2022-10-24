<div class="modal fade" id="modal-create-kimia" tabindex="-1" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-fromright modal-dialog" role="document">
        <div class="modal-content">
            <div class="block rounded block-transparent mb-0">
                <div class="block-header">
                    <h3 class="block-title">Pemeriksaan Kimia</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <form class="js-validation-be-contact" action="{{url('kasus')}}/{{ $nomor_kasus }}/pemeriksaanlab/kimia/create" method="post">
                        {{ csrf_field() }}
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
                                    <label class="col-lg-3 col-form-label">Bilirubin Total</label>
                                    <div class="col-lg-4">
                                        <input type="text" class="form-control" name="bilirubin_total" autocomplete="off">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">mg/dl</label>
                                    <label class="col-lg-3 col-form-label text-center"> &lt;0,2-1</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Bilirubin Direk</label>
                                    <div class="col-lg-4">
                                        <input type="text" class="form-control" name="bilirubin_direk" autocomplete="off">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">mg/dl</label>
                                    <label class="col-lg-3 col-form-label text-center"> &lt;0,3</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Bilirubin Indirek</label>
                                    <div class="col-lg-4">
                                        <input type="text" class="form-control" name="bilirubin_indirek" autocomplete="off">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">mg/dl</label>
                                    <label class="col-lg-3 col-form-label text-center"> &lt;0,75</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">SGOT</label>
                                    <div class="col-lg-4">
                                        <input type="text" class="form-control" name="sgot" autocomplete="off">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">U/I</label>
                                    <label class="col-lg-3 col-form-label text-center">0-35</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">SGPT</label>
                                    <div class="col-lg-4">
                                        <input type="text" class="form-control" name="sgpt" autocomplete="off">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">U/I</label>
                                    <label class="col-lg-3 col-form-label text-center">0-37</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Gamma GT</label>
                                    <div class="col-lg-4">
                                        <input type="text" class="form-control" name="gamma_gt" autocomplete="off">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">U/I</label>
                                    <label class="col-lg-3 col-form-label text-center">7-50</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Alkali Fosfatase</label>
                                    <div class="col-lg-4">
                                        <input type="text" class="form-control" name="alkali_fosfatase" autocomplete="off">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">U/I</label>
                                    <label class="col-lg-3 col-form-label text-center">64-306</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Total Protein</label>
                                    <div class="col-lg-4">
                                        <input type="text" class="form-control" name="total_protein" autocomplete="off">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">mg/dl</label>
                                    <label class="col-lg-3 col-form-label text-center">6,4-8,3</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Albumin</label>
                                    <div class="col-lg-4">
                                        <input type="text" class="form-control" name="albumin" autocomplete="off">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">mg/dl</label>
                                    <label class="col-lg-3 col-form-label text-center">3,5-5,0</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Globulin</label>
                                    <div class="col-lg-4">
                                        <input type="text" class="form-control" name="globulin" autocomplete="off">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">mg/dl</label>
                                    <label class="col-lg-3 col-form-label text-center">2,2-3,5</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Kreatinin</label>
                                    <div class="col-lg-4">
                                        <input type="text" class="form-control" name="kreatinin" autocomplete="off">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">mg/dl</label>
                                    <label class="col-lg-3 col-form-label text-center">0,5-1,5</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Ureum/BUN</label>
                                    <div class="col-lg-4">
                                        <input type="text" class="form-control" name="ureum_bun" autocomplete="off">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">g/dl</label>
                                    <label class="col-lg-3 col-form-label text-center">10-24</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Kolesterol Total</label>
                                    <div class="col-lg-4">
                                        <input type="text" class="form-control" name="kolesterol_total" autocomplete="off">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">mg/dl</label>
                                    <label class="col-lg-3 col-form-label text-center">150-250</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">HDL</label>
                                    <div class="col-lg-4">
                                        <input type="text" class="form-control" name="hdl" autocomplete="off">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">mg/dl</label>
                                    <label class="col-lg-3 col-form-label text-center">L: 35-55 P:45-65</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">LDL</label>
                                    <div class="col-lg-4">
                                        <input type="text" class="form-control" name="ldl" autocomplete="off">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">mg/dl</label>
                                    <label class="col-lg-3 col-form-label text-center">65-175</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Triglyceride</label>
                                    <div class="col-lg-4">
                                        <input type="text" class="form-control" name="triglyceride" autocomplete="off">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">mg/dl</label>
                                    <label class="col-lg-3 col-form-label text-center">50-200</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Glukosa Acak</label>
                                    <div class="col-lg-4">
                                        <input type="text" class="form-control" name="glukosa_acak" autocomplete="off">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">mg/dl</label>
                                    <label class="col-lg-3 col-form-label text-center">-</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Glukosa Puasa</label>
                                    <div class="col-lg-4">
                                        <input type="text" class="form-control" name="glukosa_puasa" autocomplete="off">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">mg/dl</label>
                                    <label class="col-lg-3 col-form-label text-center">76-110</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Glukosa 2 Jam PP</label>
                                    <div class="col-lg-4">
                                        <input type="text" class="form-control" name="glukosa_2_jam_pp" autocomplete="off">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">mg/dl</label>
                                    <label class="col-lg-3 col-form-label text-center">80-125</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Asam Urat</label>
                                    <div class="col-lg-4">
                                        <input type="text" class="form-control" name="asam_urat" autocomplete="off">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">mg/dl</label>
                                    <label class="col-lg-3 col-form-label text-center">L: 3,4-7,0 P: 2,4-5,7</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Na</label>
                                    <div class="col-lg-4">
                                        <input type="text" class="form-control" name="na" autocomplete="off">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">mmol/L</label>
                                    <label class="col-lg-3 col-form-label text-center">135-145</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">K</label>
                                    <div class="col-lg-4">
                                        <input type="text" class="form-control" name="k" autocomplete="off">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">mmol/L</label>
                                    <label class="col-lg-3 col-form-label text-center">3,5-5</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Cl</label>
                                    <div class="col-lg-4">
                                        <input type="text" class="form-control" name="cl" autocomplete="off">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">mmol/L</label>
                                    <label class="col-lg-3 col-form-label text-center">95-108</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Ca</label>
                                    <div class="col-lg-4">
                                        <input type="text" class="form-control" name="ca" autocomplete="off">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">mg/dl</label>
                                    <label class="col-lg-3 col-form-label text-center">8,1-10,4</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">HBA 1C</label>
                                    <div class="col-lg-4">
                                        <input type="text" class="form-control" name="hba_1c" autocomplete="off">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">%</label>
                                    <label class="col-lg-3 col-form-label text-center">4,5-6,3</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">PSA (ECLIA)</label>
                                    <div class="col-lg-4">
                                        <input type="text" class="form-control" name="psa_eclia" autocomplete="off">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">ng/ml</label>
                                    <label class="col-lg-3 col-form-label text-center">&lt 4</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Cholinnesterase</label>
                                    <div class="col-lg-4">
                                        <input type="text" class="form-control" name="cholinnesterase" autocomplete="off">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">kU/L</label>
                                    <label class="col-lg-3 col-form-label text-center">L: 5,32 - 12,92 P: 4,26 - 11,</label>
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