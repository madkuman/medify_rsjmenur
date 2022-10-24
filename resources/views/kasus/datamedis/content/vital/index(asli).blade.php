<div class="content pt-0">
    <div class="row">
        <div class="col-lg-12 mb-20">
            @if($allow_crud)
            <button type="button" class="btn-alt btn-primary min-width-125 float-right" data-toggle="modal" data-target="#modal-create-vital"><i class="fa fa-pencil"></i> Catat TTV</button>
            @endif
            <button type="button" class="btn-alt btn-info min-width-125 float-right" data-toggle="modal" data-target="#modal-chart-vital"><i class="fa fa-chart-line"></i>Grafik</button>
        </div>


        <?php $i = 1; ?>
        @forelse ($vitals as $item)

        <div class="col-md-12">
            <div class="block block-transparent">
                <div class="block-content p-0">
                    <div class="row"> 
                        <div class="col-md-10">
                            @if($allow_crud)
                            @if($my_role_admin == 1 || $item->created_by == Auth::user()->id)
                            <button type="button" class="btn btn-sm btn-circle btn-outline-info mr-5 mb-5 float-right" onclick="vitalEditModal({{$item->id}})">
                                <i class="fa fa-pencil"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5 float-right" onclick="vitalDeleteModal({{$item->id}})">
                                <i class="fa fa-trash"></i>
                            </button>
                            @endif
                            @endif
                            
                            <h5 class="font-w600 text-muted mb-5 text-uppercase">TTV {{$loop->remaining+1}}</h5>
                        </div>
                        <div class="col-md-5"> 

                            <h5 class=" mb-0"><small class="font-w400">Tekanan Darah</small></h5>
                            <h5 class="mb-15"><span class="font-w400">{{$item->sistol or '-'}}/{{$item->diastol or '-'}}</span></h5>


                            <h5 class=" mb-0"><small class="font-w400">MAP (1/3 sistol + 2/3 diastol)</small></h5>
                            <h5 class="mb-15"><span class="font-w400">{{$item->map_sistol_diastol or '-'}}</span></h5>

                            <h5 class=" mb-0"><small class="font-w400">Nadi</small></h5>
                            <h5 class="mb-15"><span class="font-w400">{{$item->nadi or '-'}} BPM</span></h5>

                            <h5 class=" mb-0"><small class="font-w400">Pernapasan</small></h5>
                            <h5 class="mb-15"><span class="font-w400">{{$item->pernapasan or '-'}} BPM</span></h5>

                            <h5 class=" mb-0"><small class="font-w400">Temperatur</small></h5>
                            <h5 class="mb-15"><span class="font-w400">{{$item->temperatur or '-'}} C</span></h5>

                            <h5 class=" mb-0"><small class="font-w400">SPO2</small></h5>
                            <h5 class="mb-15"><span class="font-w400">{{$item->spo2 or '-'}}</span></h5>
                            <!--
                            <h5 class=" mb-0"><small class="font-w400">Penilaian Nyeri</small></h5>
                            <h5 class="mb-15"><span class="font-w400">{{$item->penilaian_nyeri or '-'}}</span></h5>
                            -->

                            <h5 class=" mb-0"><small class="font-w400">Skala Nyeri</small></h5>
                            <h5 class="mb-15"><span class="font-w400">{{$item->skala_nyeri or '-'}}</span></h5>

                            <h5 class=" mb-0"><small class="font-w400">Provokatif</small></h5>
                            <h5 class="mb-15"><span class="font-w400">{{$item->provokatif or '-'}}</span></h5>
                            
                            <h5 class=" mb-0"><small class="font-w400">Quality</small></h5>
                            <h5 class="mb-15"><span class="font-w400">{{$item->quality_region or '-'}}</span></h5>
                            
                        </div>
                        <div class="col-md-5">
                            <h5 class=" mb-0"><small class="font-w400">Region</small></h5>
                            <h5 class="mb-15"><span class="font-w400">{{$item->region or '-'}}</span></h5>

                            <h5 class=" mb-0"><small class="font-w400">Time</small></h5>
                            <h5 class="mb-15"><span class="font-w400">{{$item->time or '-'}}</span></h5>

                            <h5 class=" mb-0"><small class="font-w400">Nyeri Hilang Bila</small></h5>
                            <h5 class="mb-15"><span class="font-w400">{{$item->nyeri_hilang or '-'}}</span></h5>

                            <h5 class=" mb-0"><small class="font-w400">Porsi Makan</small></h5>
                            <h5 class="mb-15"><span class="font-w400">{{$item->porsi_makan or '-'}}</span></h5>

                            <h5 class=" mb-0"><small class="font-w400">GCS</small></h5>
                            <h5 class="mb-15"><span class="font-w400">{{$item->gcs or '-'}}</span></h5>

                            <h5 class=" mb-0"><small class="font-w400">Cairan Infus / TTS</small></h5>
                            <h5 class="mb-15"><span class="font-w400">{{$item->cairan_infus or '-'}}</span></h5>

                            <h5 class=" mb-0"><small class="font-w400">Gula Darah Sewaktu</small></h5>
                            <h5 class="mb-15"><span class="font-w400">{{$item->gula_darah_sewaktu or '-'}}</span></h5>

                            <h5 class=" mb-0"><small class="font-w400">Produksi Urine</small></h5>
                            <h5 class="mb-15"><span class="font-w400">{{$item->produksi_urine or '-'}}</span></h5>

                            <h5 class=" mb-0"><small class="font-w400">Berat Badan</small></h5>
                            <h5 class="mb-15"><span class="font-w400">{{$item->berat_badan or '-'}}</span></h5>

                        </div>
                        <div class="col-md-10">
                            <h6>
                                <small class="text-muted">Dibuat Oleh</small><br>
                                {{ $item->creator->name }}
                                <span class="float-right font-w400"><i class="fa fa-clock-o text-muted"></i> {{ $item->created_at_formatted }}</span>
                            </h6>
                        </div>
                        @if(!empty($item->updated_by))
                        <div class="col-md-10">
                            <h6>
                                <small class="text-muted">Diupdate Oleh</small><br>
                                {{ $item->updater->name }}
                                <span class="float-right font-w400"><i class="fa fa-clock-o text-muted"></i> {{ $item->updated_at_formatted }}</span>
                            </h6>
                        </div>
                        @endif
                    </div>
                    <hr>
                </div>
            </div>
        </div>
        <?php $i++; ?>
        @empty

        <div class="col-12 text-center py-50">
            <h4 class="font-w400 mb-5">Belum ada catatan TTV</h4>
            <p>Klik tombol <b>Catat TTV</b> untuk menambahkan catatan baru</p>
        </div>

        @endforelse


    </div>
</div>

