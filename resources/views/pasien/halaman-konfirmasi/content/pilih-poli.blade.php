<div class="row pilih-poli">
    <div class="col-12">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="form-group row">
                    <div class="col-6">
                        <label class="control-label">Pilih Poli</label>
                        <select hidden name="poli" class="form-control js-select2" data-size="5" id="selectPoli" style="width: 100%;">
                            <option value="{{$antrian->poliklinik_id}}" selected>{{$antrian->poliklinik->name}}</option>
                        </select>
                    </div>
                    <div class="col-6 d-none">
                        <label class="control-label">Pilih Kelas Antrian</label>
                        <select name="antrian_kelas" class="form-control js-select2" data-size="5" id="selectKelasAntrian" style="width: 100%;">
                            <option value="0" selected disabled>Pilih Kelas Antrian</option>
                            @foreach($poli_level as $kelas)
                            <option value="{{$kelas->id}}" {{$kelas->level == $antrian_level ? 'selected' : ''}}>{{$kelas->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <div class="block block-bordered">
                        <div class="block-content">
                            <div id="InfoPoli" class="row">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 py-0">
                <label class="control-label">Pilih Dokter Shift</label>
            </div>
            <div class="col-12 mb-10">
                <label class="css-control css-control-primary css-radio">
                    <input disabled type="radio" class="css-control-input rajal-shift" name="rajal_shift" value="pagi" {{ $antrian->jadwal->shift == 'pagi' ? 'checked' : '' }}>
                    <span class="css-control-indicator"></span> Pagi
                </label>
                <label class="css-control css-control-primary css-radio">
                    <input disabled type="radio" class="css-control-input rajal-shift" name="rajal_shift" value="sore" {{ $antrian->jadwal->shift == 'sore' ? 'checked' : '' }}>
                    <span class="css-control-indicator"></span> Sore
                </label>
            </div>
            <div class="col-12" id="selectDokterPagi" style="display: {{ $antrian->jadwal->shift == 'pagi' ? 'block' : 'none' }}">
                <label class="control-label">Pilih Dokter Praktek Pagi <i class="selectDokterLoading fa fa-asterisk fa-spin text-info" style="display: none"></i></label>
                <input hidden type="hidden" name="dokter_jadwal_id" value="{{$antrian->jadwal_id}}" id="dokterJadwalPagi" class="not-required">
                <select hidden name="dokter_poli" id="selectDokterElementPagi" class="form-control js-select2 not-required selectDokterElement" style="width: 100%;" disabled>
                    <option value="{{$antrian->dokter_id}}" selected>{{$antrian->dokter->name}}</option>
                </select>
            </div>
            <div class="col-12" id="selectDokterSore" style="display: {{ $antrian->jadwal->shift == 'sore' ? 'block' : 'none' }}">
                <input type="hidden" name="dokter_jadwal_id" {{$antrian->jadwal_id}} id="dokterJadwalSore" class="not-required">
                <label hidden class="control-label">Pilih Dokter Praktek Sore <i class="selectDokterLoading fa fa-asterisk fa-spin text-info" style="display: none"></i></label>
                <select hidden name="dokter_poli" id="selectDokterElementSore" class="form-control js-select2 not-required selectDokterElement" style="width: 100%;" disabled>
                    <option value="{{$antrian->dokter_id}}" selected>{{$antrian->dokter->name}}</option>
                </select>
            </div>
            <div class="col-12 mt-10">
                <div class="py-10 text-center font-w600 bg-danger text-white mb-20 align-middle" id="error-wrapper-poliklinik" style="display: none;">
                    <i class="fa fa-exclamation-circle mr-5"></i>
                    <span></span>
                </div>
            </div>
        </div>
    </div>                             
</div>