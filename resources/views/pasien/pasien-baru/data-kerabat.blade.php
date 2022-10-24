<h4 class="mb-0">Data Keluarga/Kerabat Yang Bisa Dihubungi</h4>

<hr>
<form id="pasienSubmit">

    <div class="row">
        <div class="col-lg-6 col-sm-12">
            <div class="row justify-content-center">
                <div class="col-md-12 ">
                    <div class="form-group">
                        <label class="control-label">Nama Lengkap</label>
                        <input class="form-control" type="text" name="nameKerabat" placeholder="ex: Aldi Sujana" />
                        <div class="invalid-feedback">Silahkan isi data nama kerabat pasien </div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-12 ">
                    <div class="form-group">
                        <label class="control-label">Jenis Kelamin</label>

                        @foreach($form['kelamin'] as $item)
                            <div class="custom-control custom-radio mb-5">
                                <input class="custom-control-input" type="radio" id="gender-kerabat-{{$item->id}}" name="genderKerabat" value="{{$item->id}}" onchange="changeGenderKerabat({{$item->id}})">
                                <label class="custom-control-label" for="gender-kerabat-{{$item->id}}">{{$item->nama}}</label>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>

        </div>
        <div class="col-lg-6 col-sm-12">
            <div class="row justify-content-center">
                <div class="col-md-12 ">
                    <div class="form-group">
                        <label class="control-label">Alamat</label>
                        <input class="form-control" type="text" name="addressKerabat" placeholder="ex: Jalan Merpati no.11" />
                        <div class="invalid-feedback">Silahkan isi data alamat kerabat pasien </div>
                    </div>
                </div>
            </div>


            <div class="row justify-content-center">
                <div class="col-md-12 ">
                    <div class="form-group">
                        <label class="control-label">No Telp</label>
                        <input class="form-control" type="number" name="phoneKerabat" placeholder="HP/Nomor Rumah"  />
                        <div class="invalid-feedback">Silahkan isi data nomor telepon/HP kerabat pasien </div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-12 ">
                    <div class="form-group">
                        <label class="control-label">Hubungan</label>
                        <select name="relatives_typeKerabat" id="relativesType" class="form-control" data-size="2">
                            @foreach($form['hubungan_keluarga'] as $item)
                            <option value="{{$item->id}}" >{{$item->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>


        </div>

    @if(config('app.is_military'))
        <div class="col-lg-6 col-sm-12 pt-20">
            <label class="css-control css-control-primary css-checkbox">
                <input type="checkbox" class="css-control-input" id="anggota-trigger2">
                <span class="css-control-indicator"></span> Pasien Memiliki Kerabat Anggota TNI
            </label>
        </div>
        <div class="col-lg-6 col-sm-12 pt-20">
            <a href="javascript:void(0)" id="copydata" onclick="copyData()"><span class="pull-right">Copy Data Kerabat</span></a>
        </div>
    @endif
    </div>
    @if(config('app.is_military'))
    <hr>
    <div class="row" id="formAnggota2">
        <div class="col-lg-6 col-sm-12">
            <div class="row justify-content-center">
                <div class="col-md-12 ">
                    <div class="form-group">
                        <label class="control-label">Nama Anggota</label>
                        <input class="form-control enabledisable2" type="text" name="name" id="tniNamaKerabat" placeholder="Nama Lengkap Anggota Sesuai KTA"/>
                        <div class="invalid-feedback">Silahkan isi data nama kerabat pasien </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-12 ">
                    <div class="form-group">
                        <label class="control-label">NRP/NIP</label>
                        <input class="form-control enabledisable2" type="text" name="nrp" id="tniNrpKerabat" placeholder="NRP / NIP Anggota" />
                        <div class="invalid-feedback">Silahkan isi data NRP/NIP keanggotaan kerabat pasien </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-12 ">
                    <div class="form-group">
                        <label class="control-label">Keanggotaan</label>
                        <select name="kelas" id="selectKeanggotaanKerabat" class="form-control js-select2 enabledisable2 emptiable-kerabat" data-size="2" style="width: 100%;" data-placeholder="Pilih Keanggotaan">
                            <option></option>
                            @foreach($form['tni_keanggotaan'] as $item)
                            <option value="{{$item->id}}"> {{$item->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-12 ">
                    <div class="form-group">
                        <label class="control-label">Pangkat <i id="pangkatLoadingKerabat" class="fa fa-asterisk fa-spin text-info"></i></label>
                        <select name="kelas" id="selectPangkatKerabat" class="form-control js-select2 enabledisable2 emptiable-kerabat" data-size="2" style="width: 100%;" data-placeholder="Pilih Pangkat">
                        </select>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-lg-6 col-sm-12">

            <div class="row justify-content-center">
                <div class="col-md-12 ">
                    <div class="form-group">
                        <label class="control-label">Kotama</label>
                        <select name="kelas" id="selectKotamaKerabat" class="form-control js-select2 enabledisable2 emptiable-kerabat" data-size="2" style="width: 100%;" data-placeholder="Pilih Kotama">
                            <option></option>
                            @foreach($form['tni_kotama'] as $item)
                            <option value="{{$item->id}}">{{$item->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-12 ">
                    <div class="form-group">
                        <label class="control-label">Satker <i id="satkerLoadingKerabat" class="fa fa-asterisk fa-spin text-info"></i></label>
                        <select name="kelas" id="selectSatkerKerabat" class="form-control js-select2 enabledisable2 emptiable-kerabat" data-size="2" style="width: 100%;" data-placeholder="Pilih Satker">
                        </select>
                    </div>
                </div>
            </div>


            <div class="row justify-content-center">
                <div class="col-md-12 ">
                    <div class="form-group">
                        <label class="control-label">Hubungan</label>
                        <select name="relatives_type" id="tniRelativesTypeKerabat" class="form-control js-select2 enabledisable2" data-size="2" data-placeholder="Pilih Hubungan">
                            <option></option>
                            @foreach($form['hubungan_keluarga'] as $item)
                            <option value="{{$item->id}}" >{{$item->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>


        </div>

    </div>
    @endif

</form>