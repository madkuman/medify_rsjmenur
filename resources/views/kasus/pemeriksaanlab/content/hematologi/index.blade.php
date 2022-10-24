<div class="content pt-0">
    <div class="row">
        <div class="col-lg-12 mb-20">
            @if(session('my_role_'.$kasus->nomor_kasus))
            <button type="button" class="btn-alt btn-primary min-width-125 float-right" data-toggle="modal" data-target="#modal-create-hematologi"><i class="fa fa-pencil"></i>Pemeriksaan Hematologi</button>
            @endif
        </div>

        <div class="col-md-12">
            <div class="block block-transparent">
                <div class="block-content p-0">
                    <div class="row"> 
                        <div class="col-md-12">
                            <button type="button" class="btn btn-sm btn-circle btn-outline-info mr-5 mb-5 float-right" onclick="hematologiEditModal()">
                                <i class="fa fa-pencil"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5 float-right" onclick="hematologiDeleteModal()">
                                <i class="fa fa-trash"></i>
                            </button>
                            
                            <h5 class="font-w600 text-muted mb-5 text-uppercase">Hematologi 1</h5>
                        </div>
                        <div class="col-md-12"> 
                            <h5>Hematologi</h5>
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
                                        <td><!-- {{$item->leukosit or '-'}} --></td>
                                        <td>btr/mm3</td>
                                        <td>4rb-1rb</td>
                                    </tr>
                                    <tr>
                                        <td>Eritrosit</td>
                                        <td><!-- {{$item->eritrosit or '-'}} --></td>
                                        <td>jt/mm3</td>
                                        <td>L: 4,3 P: &lt15</td>
                                    </tr>
                                    <tr>
                                        <td>Hemoglobin</td>
                                        <td><!-- {{$item->hemoglobin or '-'}} --></td>
                                        <td>g%</td>
                                        <td>L: 13,0 P: 11.5-16</td>
                                    </tr>
                                    <tr>
                                        <td>Hematokrit</td>
                                        <td><!-- {{$item->hematokrit or '-'}} --></td>
                                        <td>g%</td>
                                        <td>L. 40-54; P. 35-45;</td>
                                    </tr>
                                    <tr>
                                        <td>MCV</td>
                                        <td><!-- {{$item->mcv or '-'}} --></td>
                                        <td>fl</td>
                                        <td>82-92</td>
                                    </tr>
                                    <tr>
                                        <td>MCH</td>
                                        <td><!-- {{$item->mch or '-'}} --></td>
                                        <td>pg</td>
                                        <td>27-31</td>
                                    </tr>
                                    <tr>
                                        <td>MCHC</td>
                                        <td><!-- {{$item->mchc or '-'}} --></td>
                                        <td>g/dl</td>
                                        <td>32-37</td>
                                    </tr>
                                    <tr>
                                        <td>Trombosit</td>
                                        <td><!-- {{$item->trombosit or '-'}} --></td>
                                        <td>ribu/mm3</td>
                                        <td>150rb - 40rb</td>
                                    </tr>
                                    <tr>
                                        <td>LED</td>
                                        <td><!-- {{$item->led or '-'}} --></td>
                                        <td>mm/jam</td>
                                        <td>L:&lt7 P:&lt15</td>
                                    </tr>
                                    <tr>
                                        <td>Retikulosit</td>
                                        <td><!-- {{$item->retikulosit or '-'}} --></td>
                                        <td>%</td>
                                        <td>0,5-1,5</td>
                                    </tr>
                                    <tr>
                                        <td>Diff Eosinofil</td>
                                        <td><!-- {{$item->diff_eosinofil or '-'}} --></td>
                                        <td>%</td>
                                        <td>1-3</td>
                                    </tr>
                                    <tr>
                                        <td>Diff Eosinofil</td>
                                        <td><!-- {{$item->diff_eosinofil or '-'}} --></td>
                                        <td>%</td>
                                        <td>1-3</td>
                                    </tr>
                                    <tr>
                                        <td>Diff Basofil</td>
                                        <td><!-- {{$item->diff_basofil or '-'}} --></td>
                                        <td>%</td>
                                        <td>0-1</td>
                                    </tr>
                                    <tr>
                                        <td>Diff Stab</td>
                                        <td><!-- {{$item->diff_stab or '-'}} --></td>
                                        <td>%</td>
                                        <td>2-6</td>
                                    </tr>
                                    <tr>
                                        <td>Diff Segmen</td>
                                        <td><!-- {{$item->diff_segmen or '-'}} --></td>
                                        <td>%</td>
                                        <td>50-70</td>
                                    </tr>
                                    <tr>
                                        <td>Diff Limposit</td>
                                        <td><!-- {{$item->diff_limposit or '-'}} --></td>
                                        <td>%</td>
                                        <td>20-40</td>
                                    </tr>
                                    <tr>
                                        <td>Diff Monosit</td>
                                        <td><!-- {{$item->diff_monosit or '-'}} --></td>
                                        <td>%</td>
                                        <td>2-8</td>
                                    </tr>
                                    <tr>
                                        <td>Waktu Pendarahan</td>
                                        <td><!-- {{$item->pendarahan or '-'}} --></td>
                                        <td>m3</td>
                                        <td>9-15</td>
                                    </tr>
                                    <tr>
                                        <td>Waktu Pembekuan</td>
                                        <td><!-- {{$item->pembekuan or '-'}} --></td>
                                        <td>m3</td>
                                        <td>1-6</td>
                                    </tr>
                                    <tr>
                                        <td>P T</td>
                                        <td><!-- {{$item->pt or '-'}} --></td>
                                        <td>-</td>
                                        <td>-</td>
                                    </tr>
                                    <tr>
                                        <td>HCT</td>
                                        <td><!-- {{$item->hct or '-'}} --></td>
                                        <td>%</td>
                                        <td>L: 40-54 P: 35-45</td>
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
                        </div>{{--
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