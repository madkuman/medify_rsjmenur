<input type="hidden" value="{{$asuhan->id}}" name="asuhan_diagnosa">
<input type="hidden" value="{{$asuhan->jenis_id}}" name="asuhan_jenis">
<h6 class="text-uppercase">Rencana Asuhan Keperawatan Medikal {{$asuhan->jenis->nama}}</h6>
<hr>
<div class="row">
    <div class="col-md-4">
        <h6 class="text-center">DIAGNOSA</h6>
        <hr>
        <div class="diagnosa-container mb-50"> 
            @if($asuhan->prefix)
            <div class="form-group">
                <input type="text" class="form-control opsi" name="prefix" placeholder="">
            </div>
            @endif
            {{$asuhan->diagnosa}}
            <br><br>
            @foreach($asuhan->opsi_diagnosa as $item)
            <div class="custom-control custom-checkbox mb-5">
                <input class="custom-control-input" type="checkbox" name="opsi_diagnosa[]" id="opsi_diagnosa{{$loop->index}}" value="{{$item->id}}">
                <label class="custom-control-label" for="opsi_diagnosa{{$loop->index}}">{{$item->konten}}</label>
            </div>
            @endforeach
            <br>
            <label>Keterangan Tambahan</label>
            <div class="form-group">
                <input type="text" class="form-control opsi" name="diagnosa_tambahan" placeholder="">
            </div>
        </div>
        <div class="data-penunjang-container mb-50"> 
            <h6 class="text-uppercase">Data Penunjang</h6>
            @foreach($asuhan->opsi_penunjang as $item)
            <div class="custom-control custom-checkbox mb-5">
                <input class="custom-control-input" type="checkbox" name="opsi_penunjang[]" id="opsi_penunjang{{$loop->index}}" value="{{$item->id}}">
                <label class="custom-control-label" for="opsi_penunjang{{$loop->index}}">{{$item->konten}}</label>
            </div>
            @endforeach
            <label>Keterangan Tambahan</label>
            <div class="form-group">
                <input type="text" class="form-control opsi" name="penunjang_tambahan" placeholder="">
            </div>
        </div>
        <div class="data-subyektif-container mb-50"> 
            <h6 class="text-uppercase">Data Subyektif</h6>
            @foreach($asuhan->opsi_subyektif as $item)
            <div class="custom-control custom-checkbox mb-5">
                <input class="custom-control-input" type="checkbox" name="opsi_subyektif[]" id="opsi_subyektif{{$loop->index}}" value="{{$item->id}}">
                <label class="custom-control-label" for="opsi_subyektif{{$loop->index}}">{{$item->konten}}</label>
            </div>
            @endforeach
            <br>
            <label>Keterangan Tambahan</label>
            <div class="form-group">
                <input type="text" class="form-control opsi" name="subyektif_tambahan" placeholder="">
            </div>
        </div>
        <div class="data-obyektif-container mb-50"> 
            <h6 class="text-uppercase">Data Obyektif</h6>
            @foreach($asuhan->opsi_obyektif as $item)
            <div class="custom-control custom-checkbox mb-5">
                <input class="custom-control-input" type="checkbox" name="opsi_obyektif[]" id="opsi_obyektif{{$loop->index}}" value="{{$item->id}}">
                <label class="custom-control-label" for="opsi_obyektif{{$loop->index}}">{{$item->konten}}</label>
            </div>
            @endforeach
            <br>
            <label>Keterangan Tambahan</label>
            <div class="form-group">
                <input type="text" class="form-control opsi" name="obyektif_tambahan" placeholder="">
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <h6 class="text-center">TUJUAN</h6>
        <hr>
        <div class="tujuan-container mb-50"> 
            {{$asuhan->tujuan}}
            @if($asuhan->durasi_tujuan)
            <div class="row gutters-tiny pt-10">
                <div class="col-5">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Jumlah Asuhan" name="tujuan_jumlah_asuhan"> 
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <input type="text" class="form-control" value="X" disabled style="padding:0.5rem"> 
                    </div>
                </div>
                <div class="col-5">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Periode Asuhan" name="tujuan_periode_asuhan"> 
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <select class="form-control" name="tujuan_jenis_periode_asuhan">
                            <option value="Jam">Jam</option>
                            <option value="Pertemuan">Pertemuan</option>
                        </select>
                    </div>
                </div>
            </div>
            @endif

            {{$asuhan->sub_tujuan}}
            <br><br>
            @foreach($asuhan->opsi_tujuan as $item)
            <div class="custom-control custom-checkbox mb-5">
                <input class="custom-control-input" type="checkbox" name="opsi_tujuan[]" id="opsi_tujuan{{$loop->index}}" value="{{$item->id}}">
                <label class="custom-control-label" for="opsi_tujuan{{$loop->index}}">{{$item->konten}}</label>
            </div>
            @endforeach
            <br>
            <label>Keterangan Tambahan</label>
            <div class="form-group">
                <input type="text" class="form-control opsi" name="tujuan_tambahan" placeholder="">
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <h6 class="text-center">INTERVENSI</h6>
        <hr>
        <div class="mandiri-container mb-50"> 
            <h6 class="text-uppercase">Mandiri</h6>
            @foreach($asuhan->opsi_mandiri as $item)
            <div class="custom-control custom-checkbox mb-5">
                <input class="custom-control-input" type="checkbox" name="opsi_mandiri[]" id="opsi_mandiri{{$loop->index}}" value="{{$item->id}}">
                <label class="custom-control-label" for="opsi_mandiri{{$loop->index}}">{{$item->konten}}</label>
            </div>
            @endforeach
            <br>
            <label>Keterangan Tambahan</label>
            <div class="form-group">
                <input type="text" class="form-control opsi" name="mandiri_tambahan" placeholder="">
            </div>
        </div>
        <div class="kolaborasi-container mb-50"> 
            <h6 class="text-uppercase">Kolaborasi</h6>
            @foreach($asuhan->opsi_kolaborasi as $item)
            <div class="custom-control custom-checkbox mb-5">
                <input class="custom-control-input" type="checkbox" name="opsi_kolaborasi[]" id="opsi_kolaborasi{{$loop->index}}" value="{{$item->id}}">
                <label class="custom-control-label" for="opsi_kolaborasi{{$loop->index}}">{{$item->konten}}</label>
            </div>
            @endforeach
            <label>Keterangan Tambahan</label>
            <div class="form-group">
                <input type="text" class="form-control opsi" name="kolaborasi_tambahan" placeholder="">
            </div>
        </div>
    </div>
</div>