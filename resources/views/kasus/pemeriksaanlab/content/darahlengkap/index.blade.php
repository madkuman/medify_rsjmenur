<div class="content pt-0">
    <div class="row">
        <div class="col-lg-12 mb-20">
            @if(session('my_role_'.$kasus->nomor_kasus))
            <button type="button" class="btn-alt btn-primary min-width-125 float-right" data-toggle="modal" data-target="#modal-create-darah"><i class="fa fa-pencil"></i> Catat Kimia Klinik</button>
            @endif
        </div>

        <?php $i = 1; ?>
        @forelse ($darah as $item)

        <div class="col-md-12">
            <div class="block block-transparent">
                <div class="block-content p-0">
                    <div class="row"> 
                        <div class="col-md-12">
                            @if(session('my_role_'.$kasus->nomor_kasus))
                            @if(session('my_role_'.$kasus->nomor_kasus)->admin == 1 || $item->created_by == $lis_user || $item->created_by == Auth::user()->id ||
                            is_null($item->created_by))
                            <button type="button" class="btn btn-sm btn-circle btn-outline-info mr-5 mb-5 float-right" onclick="darahEditModal({{$item->id}})">
                                <i class="fa fa-pencil"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5 float-right" onclick="darahDeleteModal({{$item->id}})">
                                <i class="fa fa-trash"></i>
                            </button>
                            @endif
                            @endif
                            
                            <h5 class="font-w600 text-muted mb-5 text-uppercase">DARAH LENGKAP {{$loop->remaining+1}}</h5>
                        </div>
                        <div class="col-md-12"> 
                            <h5>Lemak Darah</h5>
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
                                        <td>Kolesterol Total</td>
                                        <td>{{$item->kolesterol_total or '-'}}</td>
                                        <td>mg/dl</td>
                                        <td>150-250</td>
                                    </tr>

                                    <tr>
                                        <td>HDL</td>
                                        <td>{{$item->hdl or '-'}}</td>
                                        <td>mg/dl</td>
                                        <td>L: 35-55 P:45-65</td>
                                    </tr>

                                    <tr>
                                        <td>LDL</td>
                                        <td>{{$item->ldl or '-'}}</td>
                                        <td>mg/dl</td>
                                        <td>65-175</td>
                                    </tr>

                                    <tr>
                                        <td>Triglyceride</td>
                                        <td>{{$item->triglyceride or '-'}}</td>
                                        <td>mg/dl</td>
                                        <td>50-200</td>
                                    </tr>

                                </tbody>
                            </table>
                            <h5>Gula Darah</h5>
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
                                        <td>Glukosa Acak</td>
                                        <td>{{$item->glukosa_acak or '-'}}</td>
                                        <td>mg/dl</td>
                                        <td>-</td>
                                    </tr>

                                    <tr>
                                        <td>HBA 1C</td>
                                        <td>{{$item->hba_1c or '-'}}</td>
                                        <td>%</td>
                                        <td>4,5-6,3</td>
                                    </tr>

                                    <tr>
                                        <td>Glukosa 2 Jam PP</td>
                                        <td>{{$item->glukosa_2_jam_pp or '-'}}</td>
                                        <td>mg/dl</td>
                                        <td>80-125</td>
                                    </tr>

                                    <tr>
                                        <td>Glukosa Puasa</td>
                                        <td>{{$item->glukosa_puasa or '-'}}</td>
                                        <td>mg/dl</td>
                                        <td>76-110</td>
                                    </tr>

                                </tbody>
                            </table>
                            <h5>Fungsi Ginjal</h5>
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
                                        <td>Ureum/BUN</td>
                                        <td>{{$item->ureum_bun or '-'}}</td>
                                        <td>g/dl</td>
                                        <td>10-24</td>
                                    </tr>

                                    <tr>
                                        <td>Kreatinin</td>
                                        <td>{{$item->kreatinin or '-'}}</td>
                                        <td>mg/dl</td>
                                        <td>0,5-1,5</td>
                                    </tr>

                                    <tr>
                                        <td>Asam Urat</td>
                                        <td>{{$item->asam_urat or '-'}}</td>
                                        <td>mg/dl</td>
                                        <td>L: 3,4-7,0 P: 2,4-5,7</td>
                                    </tr>

                                    <tr>
                                        <td>PSA (ECLIA)</td>
                                        <td>{{$item->psa_eclia or '-'}}</td>
                                        <td>ng/ml</td>
                                        <td>&lt 4</td>
                                    </tr>

                                </tbody>
                            </table>
                            <h5>Fungsi Liver</h5>
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
                                        <td>Cholinnesterase</td>
                                        <td>{{$item->cholinnesterase or '-'}}</td>
                                        <td>kU/L</td>
                                        <td>L: 5,32 - 12,92 P: 4,26 - 11,</td>
                                    </tr>

                                    <tr>
                                        <td>SGOT</td>
                                        <td>{{$item->sgot or '-'}}</td>
                                        <td>U/I</td>
                                        <td>0-35</td>
                                    </tr>

                                    <tr>
                                        <td>SGPT</td>
                                        <td>{{$item->sgpt or '-'}}</td>
                                        <td>U/I</td>
                                        <td>0-37</td>
                                    </tr>

                                    <tr>
                                        <td>Bilirubin Direk</td>
                                        <td>{{$item->bilirubin_direk or '-'}}</td>
                                        <td>mg/dl</td>
                                        <td> &lt;0,3</td>
                                    </tr>

                                    <tr>
                                        <td>Bilirubin Indirek</td>
                                        <td>{{$item->bilirubin_indirek or '-'}}</td>
                                        <td>mg/dl</td>
                                        <td> &lt;0,75</td>
                                    </tr>

                                    <tr>
                                        <td>Bilirubin Total</td>
                                        <td>{{$item->bilirubin_total or '-'}}</td>
                                        <td>mg/dl</td>
                                        <td> &lt;0,2-1</td>
                                    </tr>

                                    <tr>
                                        <td>Alkali Fosfatase</td>
                                        <td>{{$item->alkali_fosfatase or '-'}}</td>
                                        <td>U/I</td>
                                        <td>64-306</td>
                                    </tr>

                                    <tr>
                                        <td>Gamma GT</td>
                                        <td>{{$item->gamma_gt or '-'}}</td>
                                        <td>U/I</td>
                                        <td>7-50</td>
                                    </tr>

                                    <tr>
                                        <td>Total Protein</td>
                                        <td>{{$item->total_protein or '-'}}</td>
                                        <td>mg/dl</td>
                                        <td>6,4-8,3</td>
                                    </tr>

                                    <tr>
                                        <td>Albumin</td>
                                        <td>{{$item->albumin or '-'}}</td>
                                        <td>mg/dl</td>
                                        <td>3,5-5,0</td>
                                    </tr>

                                    <tr>
                                        <td>Globulin</td>
                                        <td>{{$item->globulin or '-'}}</td>
                                        <td>mg/dl</td>
                                        <td>2,2-3,5</td>
                                    </tr>

                                </tbody>
                            </table>
                            <h5>Darah Lengkap / Hematologi</h5>
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
                                        <td>Leukosit</td>
                                        <td>{{$item->leukosit or '-'}}</td>
                                        <td>btr/mm3</td>
                                        <td>4rb-1rb</td>
                                    </tr>
                                    <tr>
                                        <td>Hematokrit</td>
                                        <td>{{$item->hematokrit or '-'}}</td>
                                        <td>g%</td>
                                        <td>L. 40-54; P. 35-45;</td>
                                    </tr>

                                    <tr>
                                        <td>Hemoglobin</td>
                                        <td>{{$item->hemoglobin or '-'}}</td>
                                        <td>g%</td>
                                        <td>L: 13,0 P: 11.5-16</td>
                                    </tr>

                                    <tr>
                                        <td>LED</td>
                                        <td>{{$item->led or '-'}}</td>
                                        <td>mm/jam</td>
                                        <td>L:&lt7 P:&lt15</td>
                                    </tr>

                                    <tr>
                                        <td>Eritrosit</td>
                                        <td>{{$item->eritrosit or '-'}}</td>
                                        <td>jt/mm3</td>
                                        <td>L: 4,3 P: &lt15</td>
                                    </tr>


                                    <tr style="display: none;">
                                        <td>HCT</td>
                                        <td>{{$item->hct or '-'}}</td>
                                        <td>%</td>
                                        <td>L: 40-54 P: 35-45</td>
                                    </tr>

                                    <tr>
                                        <td>Trombosit</td>
                                        <td>{{$item->trombosit or '-'}}</td>
                                        <td>ribu/mm3</td>
                                        <td>150rb - 40rb</td>
                                    </tr>

                                    <tr>
                                        <td>MCV</td>
                                        <td>{{$item->mcv or '-'}}</td>
                                        <td>fl</td>
                                        <td>82-92</td>
                                    </tr>

                                    <tr>
                                        <td>MCH</td>
                                        <td>{{$item->mch or '-'}}</td>
                                        <td>pg</td>
                                        <td>27-31</td>
                                    </tr>

                                    <tr>
                                        <td>MCHC</td>
                                        <td>{{$item->mchc or '-'}}</td>
                                        <td>g/dl</td>
                                        <td>32-37</td>
                                    </tr>

                                    <tr>
                                        <td>Retikulosit</td>
                                        <td>{{$item->retikulosit or '-'}}</td>
                                        <td>%</td>
                                        <td>0,5-1,5</td>
                                    </tr>

                                    <tr>
                                        <td>Diff Eosinofil</td>
                                        <td>{{$item->diff_eosinofil or '-'}}</td>
                                        <td>%</td>
                                        <td>1-3</td>
                                    </tr>

                                    <tr>
                                        <td>Diff Basofil</td>
                                        <td>{{$item->diff_basofil or '-'}}</td>
                                        <td>%</td>
                                        <td>0-1</td>
                                    </tr>

                                    <tr>
                                        <td>Diff Stab</td>
                                        <td>{{$item->diff_stab or '-'}}</td>
                                        <td>%</td>
                                        <td>2-6</td>
                                    </tr>

                                    <tr>
                                        <td>Diff Segmen</td>
                                        <td>{{$item->diff_segmen or '-'}}</td>
                                        <td>%</td>
                                        <td>50-70</td>
                                    </tr>

                                    <tr>
                                        <td>Diff Limposit</td>
                                        <td>{{$item->diff_limposit or '-'}}</td>
                                        <td>%</td>
                                        <td>20-40</td>
                                    </tr>

                                    <tr>
                                        <td>Diff Monosit</td>
                                        <td>{{$item->diff_monosit or '-'}}</td>
                                        <td>%</td>
                                        <td>2-8</td>
                                    </tr>

                                    <tr>
                                        <td>Waktu Pembekuan</td>
                                        <td>{{$item->pembekuan or '-'}}</td>
                                        <td>m3</td>
                                        <td>1-6</td>
                                    </tr>

                                    <tr>
                                        <td>Waktu Pendarahan</td>
                                        <td>{{$item->pendarahan or '-'}}</td>
                                        <td>m3</td>
                                        <td>9-15</td>
                                    </tr>

                                    <tr>
                                        <td>P T</td>
                                        <td>{{$item->pt or '-'}}</td>
                                        <td>-</td>
                                        <td>-</td>
                                    </tr>
                                </tbody>
                            </table>
                            <h5>Elektrolit</h5>
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
                                        <td>Na</td>
                                        <td>{{$item->na or '-'}}</td>
                                        <td>mmol/L</td>
                                        <td>135-145</td>
                                    </tr>

                                    <tr>
                                        <td>K</td>
                                        <td>{{$item->k or '-'}}</td>
                                        <td>mmol/L</td>
                                        <td>3,5-5</td>
                                    </tr>

                                    <tr>
                                        <td>Cl</td>
                                        <td>{{$item->cl or '-'}}</td>
                                        <td>mmol/L</td>
                                        <td>95-108</td>
                                    </tr>

                                    <tr>
                                        <td>Ca</td>
                                        <td>{{$item->ca or '-'}}</td>
                                        <td>mg/dl</td>
                                        <td>8,1-10,4</td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-10">
                            <h6>
                                <small class="text-muted">Dibuat Oleh</small><br>
                                {{ $item->creator->name ?? "-"}}
                                <span class="float-right font-w400"><i class="fa fa-clock-o text-muted"></i> {{ $item->created_at_formatted }}</span>
                            </h6>
                        </div>
                        @if(!empty($item->updated_by))
                        <div class="col-md-10">
                            <h6>
                                <small class="text-muted">Diupdate Oleh</small><br>
                                {{ $item->updater->name ?? "-"}}
                                <span class="float-right font-w400"><i class="fa fa-clock-o text-muted"></i> {{ $item->updated_at_formatted }}</span>
                            </h6>
                        </div>
                        @endif
                    </div>
                    <div style="padding-bottom: 40px;"><hr></div>
                </div>
            </div>
        </div>
        <?php $i++; ?>
        @empty

        <div class="col-12 text-center py-50">
            <h4 class="font-w400 mb-5">Belum ada catatan Darah Lengkap</h4>
            <p>Klik tombol <b>Pemeriksaan Darah Lengkap</b> untuk menambahkan catatan baru</p>
        </div>

        @endforelse


    </div>
</div>