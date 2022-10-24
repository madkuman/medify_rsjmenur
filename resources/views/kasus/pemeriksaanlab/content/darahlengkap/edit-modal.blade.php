<div class="modal fade" id="modal-edit-darah" tabindex="-1" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-fromright modal-dialog" role="document">
        <div class="modal-content">
            <div class="block rounded block-transparent mb-0">
                <div class="block-header">
                    <h3 class="block-title">Pemeriksaan Darah Lengkap</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <form class="js-validation-be-contact" action="{{url('kasus')}}/{{ $nomor_kasus }}/pemeriksaanlab/darahlengkap/create" method="post">
                        {{ csrf_field() }}
                        <input id="darah_id" name="darah_id" type="hidden">
                        <div class="row">
                            <div class="block-content">
                                <h5 style="margin-bottom: 0px;">Lemak Darah</h5>
                                <div class="row">
                                    <label class="col-lg-3 col-form-label">Parameter</label>
                                    <div class="col-lg-4 col-form-label text-center">Hasil</div>
                                    <label class="col-lg-2 col-form-label text-center">Satuan</label>
                                    <label class="col-lg-3 col-form-label text-center">Referensi</label>
                                    <div class="col-12"><hr></div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Kolesterol Total</label>
                                    <div class="col-lg-4">
                                        <input  type="text" class="form-control" name="kolesterol_total" autocomplete="off" id="kolesterol_total">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">mg/dl</label>
                                    <label class="col-lg-3 col-form-label text-center">150-250</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">HDL</label>
                                    <div class="col-lg-4">
                                        <input  type="text" class="form-control" name="hdl" autocomplete="off" id="hdl">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">mg/dl</label>
                                    <label class="col-lg-3 col-form-label text-center">L: 35-55 P:45-65</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">LDL</label>
                                    <div class="col-lg-4">
                                        <input  type="text" class="form-control" name="ldl" autocomplete="off" id="ldl">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">mg/dl</label>
                                    <label class="col-lg-3 col-form-label text-center">65-175</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Triglyceride</label>
                                    <div class="col-lg-4">
                                        <input  type="text" class="form-control" name="triglyceride" autocomplete="off" id="triglyceride">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">mg/dl</label>
                                    <label class="col-lg-3 col-form-label text-center">50-200</label>
                                </div>
                                <hr>
                                <h5 style="margin-bottom: 0px; margin-top: 80px;">Gula Darah</h5>
                                <div class="row">
                                    <label class="col-lg-3 col-form-label">Parameter</label>
                                    <div class="col-lg-4 col-form-label text-center">Hasil</div>
                                    <label class="col-lg-2 col-form-label text-center">Satuan</label>
                                    <label class="col-lg-3 col-form-label text-center">Referensi</label>
                                    <div class="col-12"><hr></div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Glukosa Acak</label>
                                    <div class="col-lg-4">
                                        <input  type="text" class="form-control" name="glukosa_acak" autocomplete="off" id="glukosa_acak">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">mg/dl</label>
                                    <label class="col-lg-3 col-form-label text-center">-</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">HBA 1C</label>    
                                    <div class="col-lg-4">
                                        <input  type="text" class="form-control" name="hba_1c" autocomplete="off" id="hba_1c">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">%</label>
                                    <label class="col-lg-3 col-form-label text-center">4,5-6,3</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Glukosa 2 Jam PP</label>
                                    <div class="col-lg-4">
                                        <input  type="text" class="form-control" name="glukosa_2jam" autocomplete="off" id="glukosa_2jam">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">mg/dl</label>
                                    <label class="col-lg-3 col-form-label text-center">80-125</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Glukosa Puasa</label>
                                    <div class="col-lg-4">
                                        <input  type="text" class="form-control" name="glukosa_puasa" autocomplete="off" id="glukosa_puasa">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">mg/dl</label>
                                    <label class="col-lg-3 col-form-label text-center">76-110</label>
                                </div>
                                <hr>
                                <h5 style="margin-bottom: 0px; margin-top: 80px;">Fungsi Ginjal</h5>
                                <div class="row">
                                    <label class="col-lg-3 col-form-label">Parameter</label>
                                    <div class="col-lg-4 col-form-label text-center">Hasil</div>
                                    <label class="col-lg-2 col-form-label text-center">Satuan</label>
                                    <label class="col-lg-3 col-form-label text-center">Referensi</label>
                                    <div class="col-12"><hr></div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Ureum/BUN</label>
                                    <div class="col-lg-4">
                                        <input  type="text" class="form-control" name="ureum_bun" autocomplete="off" id="ureum_bun">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">g/dl</label>
                                    <label class="col-lg-3 col-form-label text-center">10-24</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Kreatinin</label>
                                    <div class="col-lg-4">
                                        <input  type="text" class="form-control" name="kreatinin" autocomplete="off" id="kreatinin">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">mg/dl</label>
                                    <label class="col-lg-3 col-form-label text-center">0,5-1,5</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Asam Urat</label>
                                    <div class="col-lg-4">
                                        <input  type="text" class="form-control" name="asam_urat" autocomplete="off" id="asam_urat">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">mg/dl</label>
                                    <label class="col-lg-3 col-form-label text-center">L: 3,4-7,0 P: 2,4-5,7</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">PSA (ECLIA)</label>
                                    <div class="col-lg-4">
                                        <input  type="text" class="form-control" name="psa_eclia" autocomplete="off" id="psa_eclia">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">ng/ml</label>
                                    <label class="col-lg-3 col-form-label text-center">&lt 4</label>
                                </div>
                                <hr>
                                <h5 style="margin-bottom: 0px; margin-top: 80px;">Darah Lengkap</h5>
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
                                        <input  type="text" class="form-control" name="leukosit" autocomplete="off" id="leukosit">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">btr/mm3</label>
                                    <label class="col-lg-3 col-form-label text-center">4rb-1rb</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Hematokrit</label>
                                    <div class="col-lg-4">
                                        <input  type="text" class="form-control" name="hematokrit" autocomplete="off" id="hematokrit">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">g%</label>
                                    <label class="col-lg-3 col-form-label text-center">L. 40-54; P. 35-45;</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Hemoglobin</label>
                                    <div class="col-lg-4">
                                        <input  type="text" class="form-control" name="hemoglobin" autocomplete="off" id="hemoglobin">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">g%</label>
                                    <label class="col-lg-3 col-form-label text-center">L: 13,0 P: 11.5-16</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">LED</label>
                                    <div class="col-lg-4">
                                        <input  type="text" class="form-control" name="led" autocomplete="off" id="led">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">mm/jam</label>
                                    <label class="col-lg-3 col-form-label text-center">L:&lt7 P:&lt15</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Eritrosit</label>
                                    <div class="col-lg-4">
                                        <input  type="text" class="form-control" name="eritrosit" autocomplete="off" id="eritrosit">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">jt/mm3</label>
                                    <label class="col-lg-3 col-form-label text-center">L: 4,3 P: &lt15</label>
                                </div>
                                <!-- <div class="form-group row" style="display: none;">
                                    <label class="col-lg-3 col-form-label">HCT</label>
                                    <div class="col-lg-4">
                                        <input type="text" class="form-control" name="hct" autocomplete="off" id="hct">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">%</label>
                                    <label class="col-lg-3 col-form-label text-center">L: 40-54 P: 35-45</label>
                                </div> -->
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Trombosit</label>
                                    <div class="col-lg-4">
                                        <input  type="text" class="form-control" name="trombosit" autocomplete="off" id="trombosit">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">ribu/mm3</label>
                                    <label class="col-lg-3 col-form-label text-center">150rb - 40rb</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">MCV</label>
                                    <div class="col-lg-4">
                                        <input  type="text" class="form-control" name="mcv" autocomplete="off" id="mcv">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">fl</label>
                                    <label class="col-lg-3 col-form-label text-center">82-92</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">MCH</label>
                                    <div class="col-lg-4">
                                        <input  type="text" class="form-control" name="mch" autocomplete="off" id="mch">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">pg</label>
                                    <label class="col-lg-3 col-form-label text-center">27-31</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">MCHC</label>
                                    <div class="col-lg-4">
                                        <input  type="text" class="form-control" name="mchc" autocomplete="off" id="mchc">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">g/dl</label>
                                    <label class="col-lg-3 col-form-label text-center">32-37</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Retikulosit</label>
                                    <div class="col-lg-4">
                                        <input  type="text" class="form-control" name="retikulosit" autocomplete="off" id="retikulosit">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">%</label>
                                    <label class="col-lg-3 col-form-label text-center">0,5-1,5</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Diff Eosinofil</label>
                                    <div class="col-lg-4">
                                        <input  type="text" class="form-control" name="diff_eosinofil" autocomplete="off" id="diff_eosinofil">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">%</label>
                                    <label class="col-lg-3 col-form-label text-center">1-3</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Diff Basofil</label>
                                    <div class="col-lg-4">
                                        <input  type="text" class="form-control" name="diff_basofil" autocomplete="off" id="diff_basofil">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">%</label>
                                    <label class="col-lg-3 col-form-label text-center">0-1</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Diff Stab</label>
                                    <div class="col-lg-4">
                                        <input  type="text" class="form-control" name="diff_stab" autocomplete="off" id="diff_stab">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">%</label>
                                    <label class="col-lg-3 col-form-label text-center">2-6</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Diff Segmen</label>
                                    <div class="col-lg-4">
                                        <input  type="text" class="form-control" name="diff_segmen" autocomplete="off" id="diff_segmen">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">%</label>
                                    <label class="col-lg-3 col-form-label text-center">50-70</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Diff Limposit</label>
                                    <div class="col-lg-4">
                                        <input  type="text" class="form-control" name="diff_limposit" autocomplete="off" id="diff_limposit">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">%</label>
                                    <label class="col-lg-3 col-form-label text-center">20-40</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Diff Monosit</label>
                                    <div class="col-lg-4">
                                        <input  type="text" class="form-control" name="diff_monosit" autocomplete="off" id="diff_monosit">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">%</label>
                                    <label class="col-lg-3 col-form-label text-center">2-8</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Waktu Pembekuan</label>
                                    <div class="col-lg-4">
                                        <input  type="text" class="form-control" name="pembekuan" autocomplete="off" id="pembekuan">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">m3</label>
                                    <label class="col-lg-3 col-form-label text-center">1-6</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Waktu Pendarahan</label>
                                    <div class="col-lg-4">
                                        <input  type="text" class="form-control" name="pendarahan" autocomplete="off" id="pendarahan">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">m3</label>
                                    <label class="col-lg-3 col-form-label text-center">9-15</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">P T</label>
                                    <div class="col-lg-4">
                                        <input  type="text" class="form-control" name="pt" id="pt" autocomplete="off">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center"></label>
                                    <label class="col-lg-3 col-form-label text-center"></label>
                                </div>
                                <hr>
                            </div>                
                            <div class="block-content">
                                <h5 style="margin-bottom: 0px; margin-top: 80px;">Fungsi Liver</h5>
                                <div class="row">
                                    <label class="col-lg-3 col-form-label">Parameter</label>
                                    <div class="col-lg-4 col-form-label text-center">Hasil</div>
                                    <label class="col-lg-2 col-form-label text-center">Satuan</label>
                                    <label class="col-lg-3 col-form-label text-center">Referensi</label>
                                    <div class="col-12"><hr></div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Cholinnesterase</label>
                                    <div class="col-lg-4">
                                        <input  type="text" class="form-control" name="cholinnesterase" autocomplete="off" id="cholinnesterase">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">kU/L</label>
                                    <label class="col-lg-3 col-form-label text-center">L: 5,32 - 12,92 P: 4,26 - 11,25</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">SGOT</label>
                                    <div class="col-lg-4">
                                        <input  type="text" class="form-control" name="sgot" autocomplete="off" id="sgot">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">U/I</label>
                                    <label class="col-lg-3 col-form-label text-center">0-35</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">SGPT</label>
                                    <div class="col-lg-4">
                                        <input  type="text" class="form-control" name="sgpt" autocomplete="off" id="sgpt">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">U/I</label>
                                    <label class="col-lg-3 col-form-label text-center">0-37</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Bilirubin Direk</label>
                                    <div class="col-lg-4">
                                        <input  type="text" class="form-control" name="bilirubin_direk" autocomplete="off" id="bilirubin_direk">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">mg/dl</label>
                                    <label class="col-lg-3 col-form-label text-center"> &lt;0,3</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Bilirubin Indirek</label>
                                    <div class="col-lg-4">
                                        <input  type="text" class="form-control" name="bilirubin_indirek" autocomplete="off" id="bilirubin_indirek">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">mg/dl</label>
                                    <label class="col-lg-3 col-form-label text-center"> &lt;0,75</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Bilirubin Total</label>
                                    <div class="col-lg-4">
                                        <input  type="text" class="form-control" name="bilirubin_total" autocomplete="off" id="bilirubin_total">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">mg/dl</label>
                                    <label class="col-lg-3 col-form-label text-center"> &lt;0,2-1</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Alkali Fosfatase</label>
                                    <div class="col-lg-4">
                                        <input  type="text" class="form-control" name="alkali_fosfatase" autocomplete="off" id="alkali_fosfatase">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">U/I</label>
                                    <label class="col-lg-3 col-form-label text-center">64-306</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Gamma GT</label>
                                    <div class="col-lg-4">
                                        <input  type="text" class="form-control" name="gamma_gt" autocomplete="off" id="gamma_gt">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">U/I</label>
                                    <label class="col-lg-3 col-form-label text-center">7-50</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Total Protein</label>
                                    <div class="col-lg-4">
                                        <input  type="text" class="form-control" name="total_protein" autocomplete="off" id="total_protein">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">mg/dl</label>
                                    <label class="col-lg-3 col-form-label text-center">6,4-8,3</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Albumin</label>
                                    <div class="col-lg-4">
                                        <input  type="text" class="form-control" name="albumin" autocomplete="off" id="albumin">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">mg/dl</label>
                                    <label class="col-lg-3 col-form-label text-center">3,5-5,0</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Globulin</label>
                                    <div class="col-lg-4">
                                        <input  type="text" class="form-control" name="globulin" autocomplete="off" id="globulin">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">mg/dl</label>
                                    <label class="col-lg-3 col-form-label text-center">2,2-3,5</label>
                                </div> 
                                <hr>
                                <h5 style="margin-bottom: 0px; margin-top: 80px;">Pemeriksaan Elektrolit</h5>
                                <div class="row">
                                    <label class="col-lg-3 col-form-label">Parameter</label>
                                    <div class="col-lg-4 col-form-label text-center">Hasil</div>
                                    <label class="col-lg-2 col-form-label text-center">Satuan</label>
                                    <label class="col-lg-3 col-form-label text-center">Referensi</label>
                                    <div class="col-12"><hr></div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Na</label>
                                    <div class="col-lg-4">
                                        <input  type="text" class="form-control" name="na" autocomplete="off" id="na">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">mmol/L</label>
                                    <label class="col-lg-3 col-form-label text-center">135-145</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">K</label>
                                    <div class="col-lg-4">
                                        <input  type="text" class="form-control" name="k" autocomplete="off" id="k">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">mmol/L</label>
                                    <label class="col-lg-3 col-form-label text-center">3,5-5</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Cl</label>
                                    <div class="col-lg-4">
                                        <input  type="text" class="form-control" name="cl" autocomplete="off" id="cl">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">mmol/L</label>
                                    <label class="col-lg-3 col-form-label text-center">95-108</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Ca</label>
                                    <div class="col-lg-4">
                                        <input  type="text" class="form-control" name="ca" autocomplete="off" id="ca">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">mg/dl</label>
                                    <label class="col-lg-3 col-form-label text-center">8,1-10,4</label>
                                </div>
                                <hr>      
                            </div>
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
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>