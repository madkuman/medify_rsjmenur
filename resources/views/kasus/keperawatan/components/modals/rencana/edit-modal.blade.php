@foreach ($kasus_asuhan as $item)
@if(!empty($item->asuhan->diagnosa))
<div class="modal fade" id="modal-edit-rencana-asuhan-{{$item->id}}" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block rounded block-transparent mb-0">
                <div class="block-header">
                    <h3 class="block-title">Edit Rencana Asuhan Keperawatan</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <form action="{{url('kasus')}}/{{ $kasus->nomor_kasus }}/keperawatan/edit" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" value="{{Auth::user()->id}}" name="user_name">
                        <input type="hidden" value="{{$kasus->id}}" name="kasus_id">
                        <input type="hidden" value="{{$item->id}}" name="id">
                        <div class="row">
                            <div class="col-md-4">
                                <h6 class="text-center">DIAGNOSA</h6>
                                <hr>
                                <div class="diagnosa-container mb-50"> 

                                    <div class="form-group" style="
                                        @if(!$item->asuhan->prefix) 
                                        display:none;
                                        @endif
                                    ">
                                        <input type="text" class="form-control opsi" name="prefix" placeholder="" value="{{$item->prefix_diagnosa}}">
                                    </div>

                                    {{$item->asuhan->diagnosa}}
                                    <br><br>
                                    @if (($item->asuhan->opsi_diagnosa)->isNotEmpty())
                                    @foreach ($item->asuhan->opsi_diagnosa as $diagnosa)
                                    <div class="mb-5 custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="opsi_diagnosa[]" id="opsi_diagnosa{{$loop->index}}" value="{{$diagnosa->id}}" 
                                        @if ($item->checked_opsi_diagnosa != "N;")
                                        {{in_array($diagnosa->id, unserialize($item->checked_opsi_diagnosa)) == true ? 'checked' : ''}}
                                        @endif >
                                        <label class="custom-control-label" for="opsi_diagnosa{{$loop->index}}">{{$diagnosa->konten}}</label>
                                    </div>
                                    @endforeach
                                    @endif
                                    <br>
                                    <label>Keterangan Tambahan</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control opsi" name="diagnosa_tambahan" placeholder="" value="{{$item->diagnosa_tambahan}}">
                                    </div>
                                </div>                                
                                <div class="data-penunjang-container mb-50"> 
                                    <h6 class="text-uppercase">Data Penunjang</h6>
                                    @if (($item->asuhan->opsi_penunjang)->isNotEmpty())
                                    @foreach ($item->asuhan->opsi_penunjang as $penunjang)
                                    <div class="mb-5 custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="opsi_penunjang[]" id="opsi_penunjang{{$loop->index}}" value="{{$penunjang->id}}" 
                                        @if ($item->checked_opsi_penunjang != "N;")
                                        {{in_array($penunjang->id, unserialize($item->checked_opsi_penunjang)) == true ? 'checked' : ''}}
                                        @endif>
                                        <label class="custom-control-label" for="opsi_penunjang{{$loop->index}}">{{$penunjang->konten}}</label>
                                    </div>
                                    @endforeach    
                                    @endif                                    
                                    <label>Keterangan Tambahan</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control opsi" name="penunjang_tambahan" placeholder="" value="{{$item->penunjang_tambahan}}">
                                    </div>
                                </div>
                                <div class="data-subyektif-container mb-50"> 
                                    <h6 class="text-uppercase">Data Subyektif</h6>
                                    @if (($item->asuhan->opsi_subyektif)->isNotEmpty())
                                    @foreach ($item->asuhan->opsi_subyektif as $subyektif)
                                    <div class="mb-5 custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="opsi_subyektif[]" id="opsi_subyektif{{$loop->index}}" value="{{$subyektif->id}}" 
                                        @if ($item->checked_opsi_subyektif != "N;")
                                        {{in_array($subyektif->id, unserialize($item->checked_opsi_subyektif)) == true ? 'checked' : ''}}
                                        @endif>
                                        <label class="custom-control-label" for="opsi_subyektif{{$loop->index}}">{{$subyektif->konten}}</label>
                                    </div>
                                    @endforeach    
                                    @endif                                    
                                    <br>
                                    <label>Keterangan Tambahan</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control opsi" name="subyektif_tambahan" placeholder="" value="{{$item->subyektif_tambahan}}">
                                    </div>
                                </div>
                                <div class="data-obyektif-container mb-50"> 
                                    <h6 class="text-uppercase">Data Obyektif</h6>
                                    @if (($item->asuhan->opsi_obyektif)->isNotEmpty())
                                    @foreach ($item->asuhan->opsi_obyektif as $obyektif)
                                    <div class="mb-5 custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="opsi_obyektif[]" id="opsi_obyektif{{$loop->index}}" value="{{$obyektif->id}}" 
                                        @if ($item->checked_opsi_obyektif != "N;")
                                        {{in_array($obyektif->id, unserialize($item->checked_opsi_obyektif)) == true ? 'checked' : ''}}                                                
                                        @endif>
                                        <label class="custom-control-label" for="opsi_obyektif{{$loop->index}}">{{$obyektif->konten}}</label>
                                    </div>
                                    @endforeach    
                                    @endif                                    
                                    <br>
                                    <label>Keterangan Tambahan</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control opsi" name="obyektif_tambahan" placeholder="" value="{{$item->obyektif_tambahan}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <h6 class="text-center">TUJUAN</h6>
                                <hr>
                                <div class="tujuan-container mb-50"> 
                                    {{$item->asuhan->tujuan}}

                                    @if($item->asuhan->durasi_tujuan)
                                    <div class="row gutters-tiny pt-10">
                                        <div class="col-5">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Jumlah Asuhan" name="tujuan_jumlah_asuhan" value="{{$item->tujuan_jumlah_asuhan}}"> 
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-group">
                                                <input type="text" class="form-control" value="X" disabled style="padding:0.5rem"> 
                                            </div>
                                        </div>
                                        <div class="col-5">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Periode Asuhan" name="tujuan_periode_asuhan" value="{{$item->tujuan_periode_asuhan}}"> 
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <select class="form-control" name="tujuan_jenis_periode_asuhan" value="{{$item->tujuan_jenis_periode_asuhan}}">
                                                    <option value="Jam">Jam</option>
                                                    <option value="Pertemuan">Pertemuan</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    @endif

                                    {{$item->asuhan->sub_tujuan}}

                                    <br><br>
                                    @if (($item->asuhan->opsi_tujuan)->isNotEmpty())
                                    @foreach ($item->asuhan->opsi_tujuan as $tujuan)
                                    <div class="mb-5 custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="opsi_tujuan[]" id="opsi_tujuan{{$loop->index}}" value="{{$tujuan->id}}" 
                                        @if ($item->checked_opsi_tujuan != "N;")
                                        {{in_array($tujuan->id, unserialize($item->checked_opsi_tujuan)) == true ? 'checked' : ''}}
                                        @endif>
                                        <label class="custom-control-label" for="opsi_tujuan{{$loop->index}}">{{$tujuan->konten}}</label>
                                    </div>
                                    @endforeach    
                                    @endif                                    
                                    <br>
                                    <label>Keterangan Tambahan</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control opsi" name="tujuan_tambahan" placeholder="" value="{{$item->tujuan_tambahan}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <h6 class="text-center">INTERVENSI</h6>
                                <hr>
                                <div class="mandiri-container mb-50"> 
                                    <h6 class="text-uppercase">Mandiri</h6>
                                    @if (($item->asuhan->opsi_diagnosa)->isNotEmpty())
                                    @foreach ($item->asuhan->opsi_mandiri as $mandiri)
                                    <div class="mb-5 custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="opsi_mandiri[]" id="opsi_mandiri{{$loop->index}}" value="{{$mandiri->id}}" 
                                        @if ($item->checked_opsi_mandiri != "N;")
                                        {{in_array($mandiri->id, unserialize($item->checked_opsi_mandiri)) == true ? 'checked' : ''}}
                                        @endif>
                                        <label class="custom-control-label" for="opsi_mandiri{{$loop->index}}">{{$mandiri->konten}}</label>
                                    </div>
                                    @endforeach    
                                    @endif                                    
                                    <br>
                                    <label>Keterangan Tambahan</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control opsi" name="mandiri_tambahan" placeholder="" value="{{$item->mandiri_tambahan}}">
                                    </div>
                                </div>
                                <div class="kolaborasi-container mb-50"> 
                                    <h6 class="text-uppercase">Kolaborasi</h6>
                                    @if (($item->asuhan->opsi_kolaborasi)->isNotEmpty())
                                    @foreach ($item->asuhan->opsi_kolaborasi as $kolaborasi)
                                    <div class="mb-5 custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="opsi_kolaborasi[]" id="opsi_kolaborasi{{$loop->index}}" value="{{$kolaborasi->id}}" 
                                        @if ($item->checked_opsi_kolaborasi != "N;")
                                        {{in_array($kolaborasi->id, unserialize($item->checked_opsi_kolaborasi)) == true ? 'checked' : ''}}
                                        @endif>
                                        <label class="custom-control-label" for="opsi_kolaborasi{{$loop->index}}">{{$kolaborasi->konten}}</label>
                                    </div>
                                    @endforeach    
                                    @endif                                
                                    <label>Keterangan Tambahan</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control opsi" name="kolaborasi_tambahan" placeholder="" value="{{$item->kolaborasi_tambahan}}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 form-group text-right">
                            <button id="submit" type="submit" class="btn btn-primary" style="margin-top: 15px">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endforeach

