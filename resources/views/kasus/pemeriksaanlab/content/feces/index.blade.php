<div class="content pt-0">
    <div class="row">
        <div class="col-lg-12 mb-20">
            @if(session('my_role_'.$kasus->nomor_kasus))
            <button type="button" class="btn-alt btn-primary min-width-125 float-right" data-toggle="modal" data-target="#modal-create-feces"><i class="fa fa-pencil"></i> Catat Feces Lengkap</button>
            @endif
        </div>

        <?php $i = 1; ?>
        @forelse ($feces as $item)

        <div class="col-md-12">
            <div class="block block-transparent">
                <div class="block-content p-0">
                    <div class="row"> 
                        <div class="col-md-12">
                            @if(session('my_role_'.$kasus->nomor_kasus))
                            @if(session('my_role_'.$kasus->nomor_kasus)->admin == 1 ||  $item->created_by == $lis_user || $item->created_by == Auth::user()->id || is_null($item->created_by))
                            <button type="button" class="btn btn-sm btn-circle btn-outline-info mr-5 mb-5 float-right" onclick="fecesEditModal({{$item->id}})">
                                <i class="fa fa-pencil"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5 float-right" onclick="fecesDeleteModal({{$item->id}})">
                                <i class="fa fa-trash"></i>
                            </button>
                            @endif
                            @endif
                            
                            <h5 class="font-w600 text-muted mb-5 text-uppercase">Feces LENGKAP {{$loop->remaining+1}}</h5>
                        </div>
                        <div class="col-md-12"> 
                            <h5>Makroskopis</h5>
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
                                        <td>Konsistensi</td>
                                        <td>{{$item->konsistensi or '-'}}</td>
                                        <td> - </td>
                                        <td> - </td>
                                    </tr>

                                    <tr>
                                        <td>Bau</td>
                                        <td>{{$item->bau or '-'}}</td>
                                        <td> - </td>
                                        <td> - </td>
                                    </tr>

                                    <tr>
                                        <td>Lendir</td>
                                        <td>{{$item->lendir or '-'}}</td>
                                        <td> - </td>
                                        <td> - </td>
                                    </tr>

                                    <tr>
                                        <td>Darah</td>
                                        <td>{{$item->darah or '-'}}</td>
                                        <td> - </td>
                                        <td> - </td>
                                    </tr>
                                </tbody>
                            </table>
                            <h5>Mikroskopis</h5>
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
                                        <td>Lekosit</td>
                                        <td>{{$item->lekosit or '-'}}</td>
                                        <td> - </td>
                                        <td> - </td>
                                    </tr>

                                    <tr>
                                        <td>Eritrosit</td>
                                        <td>{{$item->eritrosit or '-'}}</td>
                                        <td> - </td>
                                        <td> - </td>
                                    </tr>

                                    <tr>
                                        <td>Amoeba</td>
                                        <td>{{$item->amoeba or '-'}}</td>
                                        <td> - </td>
                                        <td> - </td>
                                    </tr>

                                    <tr>
                                        <td>Kista</td>
                                        <td>{{$item->kista or '-'}}</td>
                                        <td> - </td>
                                        <td> - </td>
                                    </tr>

                                    <tr>
                                        <td>Telur Cacing</td>
                                        <td>{{$item->telur_cacing or '-'}}</td>
                                        <td> - </td>
                                        <td> - </td>
                                    </tr>
                                </tbody>
                            </table>
                            <h5>Pencernaan</h5>
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
                                        <td>Protein</td>
                                        <td>{{$item->protein or '-'}}</td>
                                        <td> - </td>
                                        <td> - </td>
                                    </tr>

                                    <tr>
                                        <td>Lemak</td>
                                        <td>{{$item->lemak or '-'}}</td>
                                        <td> - </td>
                                        <td> - </td>
                                    </tr>

                                    <tr>
                                        <td>Karbohidrat</td>
                                        <td>{{$item->karbohidrat or '-'}}</td>
                                        <td> - </td>
                                        <td> - </td>
                                    </tr>

                                    <tr>
                                        <td>Serat</td>
                                        <td>{{$item->serat or '-'}}</td>
                                        <td> - </td>
                                        <td> - </td>
                                    </tr>

                                    <tr>
                                        <td>Amylum</td>
                                        <td>{{$item->amylum or '-'}}</td>
                                        <td> - </td>
                                        <td> - </td>
                                    </tr>

                                    <tr>
                                        <td>Bakteri</td>
                                        <td>{{$item->bakteri or '-'}}</td>
                                        <td> - </td>
                                        <td> - </td>
                                    </tr>
                                </tbody>
                            </table>
                            <h5>Lain Lain</h5>
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
                                        <td>Benzidin Test</td>
                                        <td>{{$item->benzidin_test or '-'}}</td>
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
                                {{ $item->updater->name  ?? "-"}}
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