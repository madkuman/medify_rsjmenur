<div class="content pt-0">
    <div class="row">
        <div class="col-lg-12 mb-20">
            @if($allow_crud)
            <button type="button" class="btn-alt btn-primary min-width-125 float-right" data-toggle="modal" data-target="#modal-create-vital"><i class="fa fa-pencil"></i> Catat TTV</button>
            @endif
            <button type="button" class="btn-alt btn-info min-width-125 float-right" data-toggle="modal" data-target="#modal-chart-vital"><i class="fa fa-chart-line"></i>Grafik</button>
            <a type="btn" class="btn-alt btn-info min-width-125 float-right" href="{{url('kasus')}}/{{$kasus->nomor_kasus}}/datamedis/vital-sign/print" target="_blank"><i class="fa fa-print"></i> Print TTV</a>
            <a type="btn" class="btn-alt btn-info min-width-125 float-right" href="{{url('kasus')}}/{{$kasus->nomor_kasus}}/datamedis/vital-sign/print-observasi" target="_blank"><i class="fa fa-print"></i> Observasi</a>
        </div>

        <div class="col-md-12">
            <div class="block block-transparent">
                <div class="block-content p-0">
                    <div class="row">
                        <div class="col-12 autoscroll-x" style="height: 400px;overflow-y: scroll;">
                            <table class="table table-bordered table-vcenter" style="max-width: none;width: 2125px">
                                <thead>
                                    <tr>
                                        <th rowspan="2" style="width: 25px">#</th>
                                        <th rowspan="2" style="width: 200px">Tgl</th>
                                        <th rowspan="2" style="width: 50px">Jam</th>
                                        <th rowspan="2" style="width: 100px">T.Darah</th>
                                        <th rowspan="2" style="width: 100px">MAP</th>
                                        <th rowspan="2" style="width: 100px">Nadi (BPM) </th>
                                        <th rowspan="2" style="width: 100px">T ( &#8451; )</th>
                                        <th rowspan="2" style="width: 100px">RR (RPM)</th>
                                        <th rowspan="2" style="width: 100px">O2 (LPM)</th>
                                        <th rowspan="2" style="width: 100px">SPO2</th>

                                        @if($kasus->lokasi->lokasi->departemen->slug != 'rawat-jalan')
                                        <th rowspan="2" style="width: 100px">Skala Nyeri</th>
                                        <th rowspan="2" style="width: 100px">Provokatif</th>
                                        <th rowspan="2" style="width: 100px">Quality</th>
                                        <th rowspan="2" style="width: 100px">Region</th>
                                        <th rowspan="2" style="width: 100px">Scala</th>
                                        <th rowspan="2" style="width: 100px">Time</th>
                                        <th rowspan="2" style="width: 100px">GCS</th>
                                        <th rowspan="2" style="width: 100px">AVPU</th>
                                        <th rowspan="2" style="width: 100px">EWS</th>
                                        <th rowspan="2" style="width: 100px">Porsi Makan</th>
                                        <th rowspan="2" style="width: 100px">Gula Darah</th>
                                        <th rowspan="2" style="width: 100px">BB (kg)</th>
                                        <th colspan="2" style="width: 200px; border-bottom: 1px solid gainsboro;">Cairan Masuk</th>
                                        <th colspan="2" style="width: 200px; border-bottom: 1px solid gainsboro;">Cairan Keluar</th>
                                        @endif
                                        <th rowspan="2" style="width: 180px" class="text-right">Info</th>
                                    </tr>
                                    @if($kasus->lokasi->lokasi->departemen->slug != 'rawat-jalan')
                                    <tr>
                                        <th>Infus</th>
                                        <th>Per OS</th>
                                        <th>Urine</th>
                                        <th>Lain2</th>
                                    </tr>
                                    @endif
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    @forelse ($vitals as $item)
                                    <tr>
                                        <td>{{$loop->remaining+1}}</td>
                                        <td>{{indonesian_date(strtotime($item->created_at),'j F')}}</td>
                                        <td>{{date('H:i', strtotime($item->created_at))}}</td>
                                        <td>{{$item->sistol or '-'}}/{{$item->diastol or '-'}}</td>
                                        <td>{{number_format($item->map_sistol_diastol,2) ?? '-'}}</td>
                                        <td>{{$item->nadi or '-'}}</td>
                                        <td>{{$item->temperatur or '-'}}</td>
                                        <td>{{$item->pernapasan or '-'}}</td>
                                        <td>{{$item->o2 or '-'}}</td>
                                        <td>{{$item->spo2 or '-'}}</td>

                                        @if($kasus->lokasi->lokasi->departemen->slug != 'rawat-jalan')
                                        <td>{{$item->skala_nyeri or '-'}}</td>
                                        <td>{{$item->provokatif or '-'}}</td>
                                        <td>{{$item->quality or '-'}}</td>
                                        <td>{{$item->region or '-'}}</td>
                                        <td>{{$item->scala or '-'}}</td>
                                        <td>{{$item->time or '-'}}</td>
                                        <td>{{$item->gcs or '-'}}</td>
                                        <td>{{$item->avpu or '-'}}</td>
                                        <td>{{$item->ews or '-'}}</td>
                                        <td>{{$item->porsi_makan or '-'}}</td>
                                        <td>{{$item->gula_darah_sewaktu or '-'}}</td>
                                        <td>{{$item->berat_badan or '-'}}</td>
                                        <td>{{$item->cairan_infus or '-'}}</td>
                                        <td>{{$item->cairan_per_os or '-'}}</td>
                                        <td>{{$item->produksi_urine or '-'}}</td>
                                        <td>{{$item->cairan_lain or '-'}}</td>
                                        @endif
                                        <td>
                                            <button type="button" class="btn btn-sm btn-circle btn-outline-secondary mr-5 mb-5 float-right" data-toggle="tooltip" data-html="true" title="@include('kasus.datamedis.content.vital.tooltip')" data-placement="left">
                                                <i class="fa fa-info"></i>
                                            </button>
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
                                        </td>
                                    </tr>
                                    <?php $i++; ?>
                                    @empty
                                    <tr>
                                        <td colspan="10">
                                            <div class="col-12 text-center py-50">
                                                <h4 class="font-w400 mb-5">Belum ada catatan TTV</h4>
                                                <p>Klik tombol <b>Catat TTV</b> untuk menambahkan catatan baru</p>
                                            </div>   
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <hr>
                </div>
            </div>
        </div>
    </div>
</div>

