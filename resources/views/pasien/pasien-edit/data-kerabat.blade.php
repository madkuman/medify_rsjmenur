<div class="row">
    <div class="col-12">
        <h4 class="mb-0">Data Keluarga/Kerabat Yang Bisa Dihubungi</h4>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <div class="row justify-content-center">
                    <div class="col-md-12 ">
                        <div class="form-group">
                            <label class="control-label">Nama Lengkap</label>
                            <input class="form-control" type="text" name="nameKerabat" placeholder="ex: Aldi Sujana" value="@if(!empty($pasien['identitas']->wali)){{$pasien['identitas']->wali->name}}@endif" />
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-md-12 ">
                        <div class="form-group">
                            <label class="control-label">Jenis Kelamin</label>

                            <div class="custom-control custom-radio mb-5">
                                <input class="custom-control-input" type="radio" name="genderKerabat" id="gender-1-kerabat" value="1" 
                                @if(!empty($pasien['identitas']->wali)) @if($pasien['identitas']->wali->gender == 1) checked @endif @endif
                                > 
                                <label class="custom-control-label" for="gender-1-kerabat">Laki Laki</label>
                            </div>
                            <div class="custom-control custom-radio mb-5">
                                <input class="custom-control-input" type="radio" id="gender-2-kerabat" name="genderKerabat" value="2"
                                @if(!empty($pasien['identitas']->wali)) @if($pasien['identitas']->wali->gender == 2) checked @endif @endif>
                                <label class="custom-control-label" for="gender-2-kerabat">Perempuan</label>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-6">
                <div class="row justify-content-center">
                    <div class="col-md-12 ">
                        <div class="form-group">
                            <label class="control-label">Alamat</label>
                            <input class="form-control" type="text" name="addressKerabat" placeholder="ex: Jalan Merpati no.11"  value="@if(!empty($pasien['identitas']->wali)){{$pasien['identitas']->wali->address}}@endif" />
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-md-12 ">
                        <div class="form-group">
                            <label class="control-label">No Telp</label>
                            <input class="form-control" type="number" name="phoneKerabat" placeholder="HP/Nomor Rumah"  value="@if(!empty($pasien['identitas']->wali)){{filter_var($pasien['identitas']->wali->phone , FILTER_SANITIZE_NUMBER_INT)}}@endif" />
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-md-12 ">
                        <div class="form-group">
                            <label class="control-label">Hubungan</label>
                            <select name="relatives_typeKerabat" id="relativesType" class="form-control" data-size="2">
                                @foreach($form['hubungan_keluarga'] as $item)
                                <option value="{{$item->id}}" @if(!empty($pasien['identitas']->wali)) @if($pasien['identitas']->relatives_type == $item->id) selected @endif @endif>{{$item->nama}}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                </div>

            </div>
            @if(config('app.is_military'))
            <div class="col-12 pt-20">
                <label class="css-control css-control-primary css-checkbox">
                    <input type="checkbox" class="css-control-input" id="anggota-trigger2">
                    <span class="css-control-indicator"></span> Pasien Memiliki Kerabat Anggota TNI
                </label>
            </div>
            @endif
        </div>
    </div>
    
    @if(config('app.is_military'))
    <div class="col-12">
        {{-- <h4 class="mb-0">Perubahan Data Kerabat Anggota</h4> --}}
        <hr>
        <div class="row" id="formAnggota">
            <div class="col-lg-6 col-12">
                <div class="row justify-content-center">
                    <div class="col-md-12 ">
                        <div class="form-group">
                            <label class="control-label">Nama Anggota</label>
                            <input class="form-control enabledisable2" type="text" name="name" id="tniNamaKerabat" placeholder="Nama Lengkap Anggota Sesuai KTA" value="@if(!empty($pasien['identitas']->wali)) {{$pasien['identitas']->wali->tni_nama}} @endif"/>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-12 ">
                        <div class="form-group">
                            <label class="control-label">NRP/NIP</label>
                            <input class="form-control enabledisable2" type="text" name="nrpKerabat" id="tniNrpKerabat" placeholder="NRP / NIP Anggota" value="@if(!empty($pasien['identitas']->wali)) {{$pasien['identitas']->wali->tni_nrp}} @endif" />
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-12 ">
                        <div class="form-group">
                            <label class="control-label">Keanggotaan</label>
                            <select name="kelas" id="selectKeanggotaanKerabat" class="form-control js-select2 enabledisable2" data-size="2" style="width: 100%;" data-placeholder="Pilih Keanggotaan">
                                <option></option>
                                @foreach($form['tni_keanggotaan'] as $item)
                                <option value="{{$item->id}}" 
                                    @if(!empty($pasien['identitas']->wali)) 
                                    @if($item->id == $pasien['identitas']->wali->tni_keanggotaan_id) selected @endif @endif>
                                    {{$item->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-md-12 ">
                        <div class="form-group">
                            <label class="control-label">Pangkat <i id="pangkatLoadingKerabat" class="fa fa-asterisk fa-spin text-info"></i></label>
                            <select name="kelas" id="selectPangkatKerabat" class="form-control js-select2 enabledisable2" data-size="2" style="width: 100%;" data-placeholder="Pilih Pangkat">
                                <option></option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-12">

                <div class="row justify-content-center">
                    <div class="col-md-12 ">
                        <div class="form-group">
                            <label class="control-label">Kotama</label>
                            <select name="kelas" id="selectKotamaKerabat" class="form-control js-select2 enabledisable2" data-size="2" style="width: 100%;" data-placeholder="Pilih Kotama">
                                <option></option>
                                @foreach($form['tni_kotama'] as $item)
                                <option value="{{$item->id}}"
                                    @if(!empty($pasien['identitas']->wali))
                                    @if($item->id == $pasien['identitas']->wali->tni_kotama_id) selected @endif @endif>{{$item->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-md-12 ">
                        <div class="form-group">
                            <label class="control-label">Satker <i id="satkerLoadingKerabat" class="fa fa-asterisk fa-spin text-info"></i></label>
                            <select name="kelas" id="selectSatkerKerabat" class="form-control js-select2 enabledisable2" data-size="2" style="width: 100%;" data-placeholder="Pilih Satker">
                                <option></option>
                            </select>
                        </div>
                    </div>
                </div>


                <div class="row justify-content-center">
                    <div class="col-md-12 ">
                        <div class="form-group">
                            <label class="control-label">Hubungan</label>
                            <select name="relatives_type" id="tniRelativesTypeKerabat" class="form-control js-select2 enabledisable2" data-size="2" style="width: 100%;" data-placeholder="Pilih Hubungan">
                                <option></option>
                                @foreach($form['hubungan_keluarga'] as $item)
                                <option value="{{$item->id}}"@if(!empty($pasien['identitas']->wali)) @if($pasien['identitas']->wali->tni_hubungan_type == $item->id) selected @endif @endif>{{$item->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    @endif
</div>