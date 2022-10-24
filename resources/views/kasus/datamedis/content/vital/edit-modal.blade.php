
<div class="modal fade" id="modal-edit-vital" tabindex="-1" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-fromright modal-dialog" role="document">
        <div class="modal-content">
            <div class="block rounded block-transparent mb-0">
                <div class="block-header">
                    <h3 class="block-title">Catat TTV</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <form class="js-validation-be-contact" action="{{url('kasus')}}/{{ $nomor_kasus }}/datamedis/vital-sign/edit" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" class="form-control form-control-lg"  name="id" id="vital_id" placeholder="" >
                        <div class="row">
                            <div class="col-12">
                                <h4>Tanda Tanda Vital</h4>
                            </div>
                            <div class="col-6">
                                <div class="form-group row">
                                    <label class="col-12" for="">Tekanan Darah</label>
                                    <div class="col-6">
                                        <input type="number" class="form-control form-control-lg"  name="sistol" placeholder="" onchange="hitungAsesmen('edit')" id="edit-sistol">
                                        <small>Sistol</small>
                                    </div>
                                    <div class="col-6">
                                        <input type="number" class="form-control form-control-lg"  name="diastol" placeholder=""  onchange="hitungAsesmen('edit')" id="edit-diastol">
                                        <small>Diastol</small>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label class="col-12" for="">Nadi</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control form-control-lg"  name="nadi" placeholder="" onchange="hitungAsesmen('edit')" id="edit-nadi">
                                        <small>Beat Per Minute</small>
                                    </div>
                                </div>
                                @if($kasus->identitas->jenis_kelamin == 'P')
                                <div class="form-group row">
                                    <label class="col-12" for="">Maternal HR</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control form-control-lg"  name="maternal" placeholder="" onchange="hitungAsesmen('edit')" id="edit-maternal">
                                        <small>Beat Per Minute</small>
                                    </div>
                                </div>
                                @endif

                                <div class="form-group row">
                                    <label class="col-12" for="">Temperatur</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control form-control-lg"  name="temperatur" placeholder="" onchange="hitungAsesmen('edit')" id="edit-temp">
                                        <small>Dalam Satuan Celcius</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group row">
                                    <label class="col-12" for="">Pernapasan</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control form-control-lg"  name="pernapasan" placeholder="" onchange="hitungAsesmen('edit')" id="edit-pernafasan">
                                        <small>Breath Per Minute</small>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label class="col-12" for="">O2</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control form-control-lg"  name="o2" placeholder="" onchange="hitungAsesmen('edit')" id="edit-o2">
                                        <small>Dalam Liter Per Minute</small>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-12" for="">SPO2</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control form-control-lg"  name="spo2" placeholder="" onchange="hitungAsesmen('edit')" id="edit-spo2">
                                        <small>Dalam Satuan %</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if($kasus->lokasi->lokasi->departemen->slug != 'rawat-jalan')
                        <div class="row">
                            <div class="col-12">
                                <h4>Nyeri</h4>
                            </div>
                            <div class="col-6">
                                <div class="form-group row">
                                    <label class="col-12" for="">Skala Nyeri</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control form-control-lg"  name="skala_nyeri" id="skala_nyeri" placeholder="" >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-12" for="">Provokatif</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control form-control-lg"  name="provokatif" id="provokatif" placeholder="" >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-12" for="">Quality</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control form-control-lg"  name="quality" id="quality" placeholder="" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group row">
                                    <label class="col-12" for="">Region</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control form-control-lg"  name="region" id="region" placeholder="" >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-12" for="">Scala</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control form-control-lg"  name="scala" id="scala" placeholder="" >
                                    </div>
                                </div> 

                                <div class="form-group row">
                                    <label class="col-12" for="">Time</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control form-control-lg"  name="time" id="time" placeholder="" >
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <h4>Balans Cairan</h4>
                            </div>
                            <div class="col-6">
                                <h5>Cairan Masuk</h5>
                                <div class="form-group row">
                                    <label class="col-12" for="">Cairan Infus / TTS</label>
                                    <div class="col-12">
                                        <input type="number" class="form-control form-control-lg"  name="cairan_infus" id="cairan_infus" placeholder="" >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-12" for="">Cairan Per OS</label>
                                    <div class="col-12">
                                        <input type="number" class="form-control form-control-lg"  name="cairan_per_os" id="cairan_per_os" placeholder="" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <h5>Cairan Keluar</h5>
                                <div class="form-group row">
                                    <label class="col-12" for="">Produksi Urine</label>
                                    <div class="col-12">
                                        <input type="number" class="form-control form-control-lg"  name="produksi_urine" id="produksi_urine" placeholder="" >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-12" for="">Cairan Lain2</label>
                                    <div class="col-12">
                                        <input type="number" class="form-control form-control-lg"  name="cairan_lain" id="cairan_lain" placeholder="" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group row">
                                    <label class="col-12" for="">Rencana Tindakan</label>
                                    <div class="col-12">
                                        <textarea class="form-control form-control-lg" name="rencana_tindakan" id="rencana_tindakan"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <h4>Monitoring Lainnya</h4>
                            </div>
                            <div class="col-6">
                                <div class="form-group row">
                                    <label class="col-12" for="">GCS</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control form-control-lg"  name="gcs" id="gcs" placeholder="" >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-12" for="">AVPU</label>
                                    <div class="col-12">
                                        <select class="form-control form-control-lg" name="avpu" placeholder="" onchange="hitungAsesmen('edit')" id="edit-avpu">
                                            <option value="Alert">Alert</option>
                                            <option value="VPU">VPU</option>
                                        </select>
                                    </div>
                                </div>


                                @if($kasus->identitas->age_year > 13)
                                <div class="form-group row">
                                    <label class="col-12" for="">EWS</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control form-control-lg"  name="ews" id="edit-ews" value="" readonly="">
                                        <small>Isi Sistol, Nadi, Temperatur, Pernapasan, O2, SPO2, AVPU</small>
                                    </div>
                                </div>
                                @if($kasus->identitas->jenis_kelamin == 'P')
                                <div class="form-group row">
                                    <label class="col-12" for="">IMEWS</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control form-control-lg"  name="imews" id="edit-imews" value="" readonly="">
                                        <small>Isi 
                                            <span id="edit-detail-imews-sistol">Sistol</span>, 
                                            <span id="edit-detail-imews-diastol">Diastol</span>, 
                                            <span id="edit-detail-imews-temp">Temperatur</span>, 
                                            <span id="edit-detail-imews-pernafasan">Pernapasan</span>, 
                                            <span id="edit-detail-imews-spo2">SPO2</span>, 
                                            <span id="edit-detail-imews-avpu">AVPU</span>, 
                                            <span id="edit-detail-imews-maternal">Maternal HR</span>
                                        </small>
                                    </div>
                                </div>
                                @endif
                                @else
                                <div class="form-group row">
                                    <label class="col-12" for="">PEWS</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control form-control-lg"  name="pews" id="edit-pews" value="">
                                    </div>
                                </div>
                                @endif
                            </div>
                            <div class="col-6">
                                <div class="form-group row">
                                    <label class="col-12" for="">Porsi Makan</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control form-control-lg"  name="porsi_makan" id="porsi_makan" placeholder="" >
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label class="col-12" for="">Gula Darah Sewaktu</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control form-control-lg"  name="gula_darah_sewaktu" id="gula_darah_sewaktu"  placeholder="" >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-12" for="">Berat Badan</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control form-control-lg"  name="berat_badan" id="berat_badan" placeholder="" >
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group row">
                                    <div class="col-12 text-center">
                                        <button type="submit" class="btn-alt btn-click-animate btn-hero btn-primary min-width-175 float-right">
                                            <i class="fa fa-send mr-5"></i> Simpan
                                        </button>
                                    </div>
                                </div>                            
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>