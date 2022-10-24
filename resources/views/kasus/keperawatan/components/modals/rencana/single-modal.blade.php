@foreach ($kasus_asuhan as $item)
@if(!empty($item->asuhan->diagnosa))
<div class="modal fade" id="modal-single-rencana-asuhan-{{$item->id}}" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
        <div class="modal-dialog modal-dialog-fromright modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="block rounded block-transparent mb-0">
                    <div class="block-header">
                    <h3 class="block-title">Rencana Asuhan Keperawatan Medikal Bedah</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div>
                        
                    </div>
                    <div class="block-content">
                        <div class="row">
                            <div class="col-md-4">
                                <h6 class="text-center">DIAGNOSA</h6>
                                <hr>
                                <div class="diagnosa-container mb-50"> 
                                    {{$item->prefix_diagnosa}} {{$item->asuhan->diagnosa}}
                                    <br>
                                    <ul>
                                        @if ($item->checked_opsi_diagnosa != 'N;')
                                            @foreach ((unserialize($item->checked_opsi_diagnosa)) as $checked_diagnosa)
                                                <li>{{$item->asuhan->detail->where('id', $checked_diagnosa)->first()->konten}}</li>
                                            @endforeach
                                        @endif
                                        @if ($item->diagnosa_tambahan != NULL)
                                            <li>Keterangan: {{$item->diagnosa_tambahan}}</li>
                                        @endif                                    
                                    </ul>
                                </div>
                                <div class="data-penunjang-container mb-50"> 
                                    <h6 class="text-uppercase">Data Penunjang</h6>
                                    <ul>
                                        @if ($item->checked_opsi_penunjang != 'N;')
                                            @foreach ((unserialize($item->checked_opsi_penunjang)) as $checked_penunjang)
                                                <li>{{$item->asuhan->detail->where('id', $checked_penunjang)->first()->konten}}</li>
                                            @endforeach        
                                        @endif
                                        @if ($item->penunjang_tambahan != NULL)
                                            <li>Keterangan: {{$item->penunjang_tambahan}}</li>
                                        @endif
                                    </ul>
                                </div>
                                <div class="data-subyektif-container mb-50"> 
                                    <h6 class="text-uppercase">Data Subyektif</h6>
                                    <ul>
                                        @if ($item->checked_opsi_subyektif != 'N;')
                                            @foreach ((unserialize($item->checked_opsi_subyektif)) as $checked_subyektif)
                                                <li>{{$item->asuhan->detail->where('id', $checked_subyektif)->first()->konten}}</li>
                                            @endforeach        
                                        @endif
                                        @if ($item->subyektif_tambahan != NULL)
                                            <li>Keterangan: {{$item->subyektif_tambahan}}</li>
                                        @endif
                                    </ul>
                                </div>
                                <div class="data-obyektif-container mb-50"> 
                                    <h6 class="text-uppercase">Data Obyektif</h6>
                                    <ul>
                                        @if ($item->checked_opsi_obyektif != 'N;')
                                            @foreach ((unserialize($item->checked_opsi_obyektif)) as $checked_obyektif)
                                                <li>{{$item->asuhan->detail->where('id', $checked_obyektif)->first()->konten}}</li>
                                            @endforeach        
                                        @endif
                                        @if ($item->obyektif_tambahan != NULL)
                                            <li>Keterangan: {{$item->obyektif_tambahan}}</li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <h6 class="text-center">TUJUAN</h6>
                                <hr>
                                <div class="tujuan-container mb-50"> 
                                    {{$item->asuhan->tujuan}}
                                    @if($item->asuhan->durasi_tujuan)
                                    , {{$item->tujuan_jumlah_asuhan ?? '...'}} X {{$item->tujuan_periode_asuhan ?? '...'}} {{$item->tujuan_jenis_periode_asuhan ?? 'Jam'}}, {{$item->asuhan->sub_tujuan}}
                                    @endif
                                    <br><br>
                                    <h6 class="text-uppercase">KRITERIA HASIL</h6>
                                    <ul>
                                        @if ($item->checked_opsi_tujuan != 'N;')
                                            @foreach ((unserialize($item->checked_opsi_tujuan)) as $checked_tujuan)
                                                <li>{{$item->asuhan->detail->where('id', $checked_tujuan)->first()->konten}}</li>
                                            @endforeach        
                                        @endif
                                        @if ($item->tujuan_tambahan != NULL)
                                            <li>Keterangan: {{$item->tujuan_tambahan}}</li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <h6 class="text-center">INTERVENSI</h6>
                                <hr>
                                <div class="mandiri-container mb-50"> 
                                    <h6 class="text-uppercase">Mandiri</h6>
                                    <ul>
                                        @if ($item->checked_opsi_mandiri != 'N;')
                                            @foreach ((unserialize($item->checked_opsi_mandiri)) as $checked_mandiri)
                                                <li>{{$item->asuhan->detail->where('id', $checked_mandiri)->first()->konten}}</li>
                                            @endforeach        
                                        @endif
                                        @if ($item->mandiri_tambahan != NULL)
                                            <li>Keterangan: {{$item->mandiri_tambahan}}</li>
                                        @endif
                                    </ul>
                                </div>
                                <div class="kolaborasi-container mb-50"> 
                                    <h6 class="text-uppercase">Kolaborasi</h6>
                                    <ul>
                                        @if ($item->checked_opsi_kolaborasi != 'N;')
                                            @foreach ((unserialize($item->checked_opsi_kolaborasi)) as $checked_kolaborasi)
                                                <li>{{$item->asuhan->detail->where('id', $checked_kolaborasi)->first()->konten}}</li>
                                            @endforeach        
                                        @endif
                                        @if ($item->kolaborasi_tambahan != NULL)
                                            <li>Keterangan: {{$item->kolaborasi_tambahan}}</li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
@endforeach
