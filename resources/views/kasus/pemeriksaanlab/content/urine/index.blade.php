<div class="content pt-0">
    <div class="row">
        <div class="col-lg-12 mb-20">
            @if(session('my_role_'.$kasus->nomor_kasus))
            <button type="button" class="btn-alt btn-primary min-width-125 float-right" data-toggle="modal" data-target="#modal-create-urine"><i class="fa fa-pencil"></i>Periksa Urine</button>
            @endif
        </div>

        <?php $i = 1; ?>
        @forelse ($urine as $item)

        <div class="col-md-12">
            <div class="block block-transparent">
                <div class="block-content p-0">
                    <div class="row"> 
                        <div class="col-md-12">
                            @if(session('my_role_'.$kasus->nomor_kasus))
                            @if(session('my_role_'.$kasus->nomor_kasus)->admin == 1 || $item->created_by == $lis_user || $item->created_by == Auth::user()->id || is_null($item->created_by))
                            <button type="button" class="btn btn-sm btn-circle btn-outline-info mr-5 mb-5 float-right" onclick="urineEditModal({{$item->id}})">
                                <i class="fa fa-pencil"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5 float-right" onclick="urineDeleteModal({{$item->id}})">
                                <i class="fa fa-trash"></i>
                            </button>
                            @endif
                            @endif
                            
                            <h5 class="font-w600 text-muted mb-5 text-uppercase">URINE LENGKAP {{$loop->remaining+1}}</h5>
                        </div>
                        <div class="col-md-12"> 
                            <h5>Urinalisa</h5>
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
                                        <td>Warna</td>
                                        <td>{{$item->warna or '-'}}</td>
                                        <td> - </td>
                                        <td> - </td>
                                    </tr>
                                    <tr>
                                        <td>Berat Jenis / S.G</td>
                                        <td>{{$item->berat_jenis or '-'}}</td>
                                        <td> - </td>
                                        <td> - </td>
                                    </tr>
                                    <tr>
                                        <td>pH</td>
                                        <td>{{$item->ph or '-'}}</td>
                                        <td> - </td>
                                        <td> - </td>
                                    </tr>
                                    <tr>
                                        <td>Protein</td>
                                        <td>{{$item->protein or '-'}}</td>
                                        <td> - </td>
                                        <td> - </td>
                                    </tr>
                                    <tr>
                                        <td>Reduksi</td>
                                        <td>{{$item->reduksi or '-'}}</td>
                                        <td> - </td>
                                        <td> - </td>
                                    </tr>
                                    <tr>
                                        <td>Bilirubin</td>
                                        <td>{{$item->bilirubin or '-'}}</td>
                                        <td> - </td>
                                        <td> - </td>
                                    </tr>
                                    <tr>
                                        <td>Keton</td>
                                        <td>{{$item->keton or '-'}}</td>
                                        <td> - </td>
                                        <td> - </td>
                                    </tr>
                                    <tr>
                                        <td>Nitrit</td>
                                        <td>{{$item->nitrit or '-'}}</td>
                                        <td> - </td>
                                        <td> - </td>
                                    </tr>
                                    <tr>
                                        <td>Leukosit</td>
                                        <td>{{$item->leukosit or '-'}}</td>
                                        <td> - </td>
                                        <td> - </td>
                                    </tr>
                                    <tr>
                                        <td>Tes Kehamilan</td>
                                        <td>{{$item->tes_kehamilan or '-'}}</td>
                                        <td> - </td>
                                        <td> - </td>
                                    </tr>
                                    <tr>
                                        <td>Reduksi 2 Jpp</td>
                                        <td>{{$item->reduksi_2_jpp or '-'}}</td>
                                        <td> - </td>
                                        <td> - </td>
                                    </tr>
                                    <tr>
                                        <td>Urobilinogen</td>
                                        <td>{{$item->urobilinogen or '-'}}</td>
                                        <td> - </td>
                                        <td> - </td>
                                    </tr>
                                    <tr>
                                        <td>Urobilirubin</td>
                                        <td>{{$item->urobilirubin or '-'}}</td>
                                        <td> - </td>
                                        <td> - </td>
                                    </tr>
                                    <tr>
                                        <td>Candida</td>
                                        <td>{{$item->candida or '-'}}</td>
                                        <td> lpb </td>
                                        <td> - </td>
                                    </tr>
                                </tbody>
                            </table>
                            <h5 style="margin-top: 60px;">Sedimen</h5>
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
                                        <td>Eritrosit</td>
                                        <td>{{$item->eritrosit or '-'}}</td>
                                        <td> lpb </td>
                                        <td> - </td>
                                    </tr>
                                    <tr>
                                        <td>Leuko</td>
                                        <td>{{$item->leuko or '-'}}</td>
                                        <td> lpb </td>
                                        <td> - </td>
                                    </tr>
                                    <tr>
                                        <td>Epitel</td>
                                        <td>{{$item->epitel or '-'}}</td>
                                        <td> lpb </td>
                                        <td> - </td>
                                    </tr>
                                    <tr>
                                        <td>Bakteri</td>
                                        <td>{{$item->bakteri or '-'}}</td>
                                        <td> lpb </td>
                                        <td> - </td>
                                    </tr>
                                    <tr>
                                        <td>Cylinder</td>
                                        <td>{{$item->cylinder or '-'}}</td>
                                        <td> lpb </td>
                                        <td> - </td>
                                    </tr>
                                    <tr>
                                        <td>Kristal</td>
                                        <td>{{$item->kristal or '-'}}</td>
                                        <td> lpb </td>
                                        <td> - </td>
                                    </tr>
                                </tbody>
                            </table>


                            <h5 style="margin-top: 60px;">Narkoba</h5>
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
                                        <td>Morfin</td>
                                        <td>{{$item->morphin or '-'}}</td>
                                        <td> - </td>
                                        <td> - </td>
                                    </tr>
                                    <tr>
                                        <td>Metamphetamine</td>
                                        <td>{{$item->metamphetamine or '-'}}</td>
                                        <td> - </td>
                                        <td> - </td>
                                    </tr>
                                    <tr>
                                        <td>Amphetamine</td>
                                        <td>{{$item->amphetamine or '-'}}</td>
                                        <td> - </td>
                                        <td> - </td>
                                    </tr>
                                    <tr>
                                        <td>Diazepam</td>
                                        <td>{{$item->diazepam or '-'}}</td>
                                        <td> - </td>
                                        <td> - </td>
                                    </tr>
                                    <tr>
                                        <td>Ganja</td>
                                        <td>{{$item->ganja or '-'}}</td>
                                        <td> - </td>
                                        <td> - </td>
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
            <h4 class="font-w400 mb-5">Belum ada catatan pemeriksaan Urine</h4>
            <p>Klik tombol <b>Periksa Urine</b> untuk menambahkan catatan baru</p>
        </div>

        @endforelse


    </div>
</div>