<div class="content pt-0">
    <div class="row">
        <div class="col-lg-12 mb-20">
            @if(session('my_role_'.$kasus->nomor_kasus))
            <button type="button" class="btn-alt btn-primary min-width-125 float-right" data-toggle="modal" data-target="#modal-create-imun"><i class="fa fa-pencil"></i>Pemeriksaan Immunologi</button>
            @endif
        </div>

        <?php $i = 1; ?>
        @forelse ($imun as $item)

        <div class="col-md-12">
            <div class="block block-transparent">
                <div class="block-content p-0">
                    <div class="row"> 
                        <div class="col-md-12">
                            @if(session('my_role_'.$kasus->nomor_kasus))
                            @if(session('my_role_'.$kasus->nomor_kasus)->admin == 1 || $item->created_by == $lis_user || $item->created_by == Auth::user()->id || is_null($item->created_by))
                            <button type="button" class="btn btn-sm btn-circle btn-outline-info mr-5 mb-5 float-right" onclick="imunEditModal({{$item->id}})">
                                <i class="fa fa-pencil"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5 float-right" onclick="imunDeleteModal({{$item->id}})">
                                <i class="fa fa-trash"></i>
                            </button>
                            @endif
                            @endif
                            
                            <h5 class="font-w600 text-muted mb-5 text-uppercase">Immunologi {{$loop->remaining+1}}</h5>
                        </div>
                        <div class="col-md-12"> 
                            <h5>Immunologi</h5>
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
                                        <td>HBs Ag(RPHA)</td>
                                        <td>{{$item->hbs_ag or '-'}}</td>
                                        <td> mlU/ml </td>
                                        <td> Negative </td>
                                    </tr>

                                    <tr>
                                        <td>Anti HIV</td>
                                        <td>{{$item->anti_hiv or '-'}}</td>
                                        <td> mlU/ml </td>
                                        <td> Negative </td>
                                    </tr>

                                    <tr>
                                        <td>Anti HCV</td>
                                        <td>{{$item->anti_hcv or '-'}}</td>
                                        <td> - </td>
                                        <td> Negative </td>
                                    </tr>

                                    <tr>
                                        <td>ICT Malaria</td>
                                        <td>{{$item->ict_malaria or '-'}}</td>
                                        <td> - </td>
                                        <td> Negative </td>
                                    </tr>

                                    <tr>
                                        <td>VDRL</td>
                                        <td>{{$item->vdrl or '-'}}</td>
                                        <td> - </td>
                                        <td> Negative </td>
                                    </tr>

                                    <tr>
                                        <td>Coomb Test</td>
                                        <td>{{$item->coomb_test or '-'}}</td>
                                        <td> - </td>
                                        <td> Negative </td>
                                    </tr>

                                    <tr>
                                        <td>HB eAG</td>
                                        <td>{{$item->hb_eag or '-'}}</td>
                                        <td> - </td>
                                        <td> Negative </td>
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
            <h4 class="font-w400 mb-5">Belum ada catatan pemeriksaan Immunologi</h4>
            <p>Klik tombol <b>Pemeriksaan Immunologi</b> untuk menambahkan catatan baru</p>
        </div>

        @endforelse


    </div>
</div>