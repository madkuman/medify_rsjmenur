<div class="content pt-0">
    <div class="row">
        <div class="col-lg-12 mb-20">
            @if(session('my_role_'.$kasus->nomor_kasus))
            <button type="button" class="btn-alt btn-primary min-width-125 float-right" data-toggle="modal" data-target="#modal-create-kimia"><i class="fa fa-pencil"></i>Pemeriksaan Kimia</button>
            @endif
        </div>

        <div class="col-md-12">
            <div class="block block-transparent">
                <div class="block-content p-0">
                    <div class="row"> 
                        <div class="col-md-12">
                            <button type="button" class="btn btn-sm btn-circle btn-outline-info mr-5 mb-5 float-right" onclick="kimiaEditModal()">
                                <i class="fa fa-pencil"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5 float-right" onclick="kimiaDeleteModal()">
                                <i class="fa fa-trash"></i>
                            </button>
                            
                            <h5 class="font-w600 text-muted mb-5 text-uppercase">Kimia 1</h5>
                        </div>
                        <div class="col-md-12"> 
                            <h5>Kimia Klinik</h5>
                            <table class="table table-hover table-vcenter table-bordered">
                                <thead>
                                    <tr>
                                        <th>Parameter</th>
                                        <th>Hasil</th>
                                        <th>Satuan</th>
                                        <th>Referensi</th>    
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr>
                                        <td>Bilirubin Total</td>
                                        <td><!-- {{$item->bilirubin_total or '-'}} --></td>
                                        <td>mg/dl</td>
                                        <td> &lt;0,2-1</td>
                                    </tr>
                                    <tr>
                                        <td>Bilirubin Direk</td>
                                        <td><!-- {{$item->bilirubin_direk or '-'}} --></td>
                                        <td>mg/dl</td>
                                        <td> &lt;0,3</td>
                                    </tr>
                                    <tr>
                                        <td>Bilirubin Indirek</td>
                                        <td><!-- {{$item->bilirubin_indirek or '-'}} --></td>
                                        <td>mg/dl</td>
                                        <td> &lt;0,75</td>
                                    </tr>
                                    <tr>
                                        <td>SGOT</td>
                                        <td><!-- {{$item->sgot or '-'}} --></td>
                                        <td>U/I</td>
                                        <td>0-35</td>
                                    </tr>
                                    <tr>
                                        <td>SGPT</td>
                                        <td><!-- {{$item->sgpt or '-'}} --></td>
                                        <td>U/I</td>
                                        <td>0-37</td>
                                    </tr>
                                    <tr>
                                        <td>Gamma GT</td>
                                        <td><!-- {{$item->gamma_gt or '-'}} --></td>
                                        <td>U/I</td>
                                        <td>7-50</td>
                                    </tr>
                                    <tr>
                                        <td>Alkali Fosfatase</td>
                                        <td><!-- {{$item->alkali_fosfatase or '-'}} --></td>
                                        <td>U/I</td>
                                        <td>64-306</td>
                                    </tr>
                                    <tr>
                                        <td>Total Protein</td>
                                        <td><!-- {{$item->total_protein or '-'}} --></td>
                                        <td>mg/dl</td>
                                        <td>6,4-8,3</td>
                                    </tr>
                                    <tr>
                                        <td>Albumin</td>
                                        <td><!-- {{$item->albumin or '-'}} --></td>
                                        <td>mg/dl</td>
                                        <td>3,5-5,0</td>
                                    </tr>
                                    <tr>
                                        <td>Globulin</td>
                                        <td><!-- {{$item->globulin or '-'}} --></td>
                                        <td>mg/dl</td>
                                        <td>2,2-3,5</td>
                                    </tr>
                                    <tr>
                                        <td>Kreatinin</td>
                                        <td><!-- {{$item->kreatinin or '-'}} --></td>
                                        <td>mg/dl</td>
                                        <td>0,5-1,5</td>
                                    </tr>
                                    <tr>
                                        <td>Ureum/BUN</td>
                                        <td><!-- {{$item->ureum_bun or '-'}} --></td>
                                        <td>g/dl</td>
                                        <td>10-24</td>
                                    </tr>
                                    <tr>
                                        <td>Kolesterol Total</td>
                                        <td><!-- {{$item->kolesterol_total or '-'}} --></td>
                                        <td>mg/dl</td>
                                        <td>150-250</td>
                                    </tr>
                                    <tr>
                                        <td>HDL</td>
                                        <td><!-- {{$item->hdl or '-'}} --></td>
                                        <td>mg/dl</td>
                                        <td>L: 35-55 P:45-65</td>
                                    </tr>
                                    <tr>
                                        <td>LDL</td>
                                        <td><!-- {{$item->ldl or '-'}} --></td>
                                        <td>mg/dl</td>
                                        <td>65-175</td>
                                    </tr>
                                    <tr>
                                        <td>Triglyceride</td>
                                        <td><!-- {{$item->triglyceride or '-'}} --></td>
                                        <td>mg/dl</td>
                                        <td>50-200</td>
                                    </tr>
                                    <tr>
                                        <td>Glukosa Acak</td>
                                        <td><!-- {{$item->glukosa_acak or '-'}} --></td>
                                        <td>mg/dl</td>
                                        <td>-</td>
                                    </tr>
                                    <tr>
                                        <td>Glukosa Puasa</td>
                                        <td><!-- {{$item->glukosa_puasa or '-'}} --></td>
                                        <td>mg/dl</td>
                                        <td>76-110</td>
                                    </tr>
                                    <tr>
                                        <td>Glukosa 2 Jam PP</td>
                                        <td><!-- {{$item->glukosa_2_jam_pp or '-'}} --></td>
                                        <td>mg/dl</td>
                                        <td>80-125</td>
                                    </tr>
                                    <tr>
                                        <td>Asam Urat</td>
                                        <td><!-- {{$item->asam_urat or '-'}} --></td>
                                        <td>mg/dl</td>
                                        <td>L: 3,4-7,0 P: 2,4-5,7</td>
                                    </tr>
                                    <tr>
                                        <td>Na</td>
                                        <td><!-- {{$item->na or '-'}} --></td>
                                        <td>mmol/L</td>
                                        <td>135-145</td>
                                    </tr>
                                    <tr>
                                        <td>K</td>
                                        <td><!-- {{$item->k or '-'}} --></td>
                                        <td>mmol/L</td>
                                        <td>3,5-5</td>
                                    </tr>
                                    <tr>
                                        <td>Cl</td>
                                        <td><!-- {{$item->cl or '-'}} --></td>
                                        <td>mmol/L</td>
                                        <td>95-108</td>
                                    </tr>
                                    <tr>
                                        <td>Ca</td>
                                        <td><!-- {{$item->ca or '-'}} --></td>
                                        <td>mg/dl</td>
                                        <td>8,1-10,4</td>
                                    </tr>
                                    <tr>
                                        <td>HBA 1C</td>
                                        <td><!-- {{$item->hba_1c or '-'}} --></td>
                                        <td>%</td>
                                        <td>4,5-6,3</td>
                                    </tr>
                                    <tr>
                                        <td>PSA (ECLIA)</td>
                                        <td><!-- {{$item->psa_eclia or '-'}} --></td>
                                        <td>ng/ml</td>
                                        <td>&lt 4</td>
                                    </tr>
                                    <tr>
                                        <td>Cholinnesterase</td>
                                        <td><!-- {{$item->cholinnesterase or '-'}} --></td>
                                        <td>kU/L</td>
                                        <td>L: 5,32 - 12,92 P: 4,26 - 11,</td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                        <div class="col-md-10">
                            <h6>
                                <small class="text-muted">Dibuat Oleh</small><br>
                                {{ $item->creator->name ?? "-"}}
                                <span class="float-right font-w400"><i class="fa fa-clock-o text-muted"></i> 17 January 2019 08:22</span>
                            </h6>
                        </div>
                        {{--
                        <div class="col-md-10">
                            <h6>
                                <small class="text-muted">Diupdate Oleh</small><br>
                                Dr. Hari Setiawan
                                <span class="float-right font-w400"><i class="fa fa-clock-o text-muted"></i> 17 January 2019 08:22</span>
                            </h6>
                        </div>
                        --}}
                    </div>
                    <div style="padding-bottom: 40px;"><hr></div>
                </div>
            </div>
        </div>


        <!-- KALAU KOSONG -->
        <!-- <div class="col-12 text-center py-50">
            <h4 class="font-w400 mb-5">Belum ada catatan pemeriksaan Immunologi</h4>
            <p>Klik tombol <b>Pemeriksaan Immunologi</b> untuk menambahkan catatan baru</p>
        </div> -->


    </div>
</div>