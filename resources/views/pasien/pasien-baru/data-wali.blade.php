<h5 class="uppercase">Data Wali Pasien
    <hr>
</h5>
<div class="row">
    <div class="col-6">

        <div class="row justify-content-center">
            <div class="col-md-12 ">
                <div class="form-group">
                    <label class="control-label">Jenis Kartu Identitas</label>
                    <select name="kelas" id="selectKelas" class="form-control" data-size="2">
                        <option value="1">KTP</option>
                        <option value="2">KTA</option>
                        <option value="2">Kartu Mahasiswa/Pelajar</option>
                        <option value="2">SIM</option>
                        <option value="2">Jamsostek</option>
                        <option value="2">KSK</option>
                        <option value="2">Lainnya</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-12 ">
                <div class="form-group">
                    <label class="control-label">No Identitas</label>
                    <input class="form-control" type="text" name="ktp" placeholder="Nomor Identitas" />
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-12 ">
                <div class="form-group">
                    <label class="control-label">Nama Lengkap</label>
                    <input class="form-control" type="text" name="name" placeholder="ex: Aldi Sujana" />
                </div>
            </div>
        </div>


        <div class="row justify-content-center">
            <div class="col-md-12 ">
                <div class="form-group">
                    <label class="control-label">Jenis Kelamin</label>

                    <div class="custom-control custom-radio mb-5">
                        <input class="custom-control-input" type="radio" name="gender" id="gender-1" value="1" checked   onchange="changeGender(1)">
                        <label class="custom-control-label" for="gender-1">Laki Laki</label>
                    </div>
                    <div class="custom-control custom-radio mb-5">
                        <input class="custom-control-input" type="radio" id="gender-2" name="gender"  value="2"   onchange="changeGender(2)">
                        <label class="custom-control-label" for="gender-2">Perempuan</label>
                    </div>

                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-12 ">
                <div class="form-group">
                    <label class="control-label">Tempat Lahir</label>
                    <input class="form-control" type="text" name="birthplace" placeholder="ex : Surabaya" />
                </div>
            </div>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-md-12 ">
                <div class="form-group">
                    <label class="control-label">Tanggal Lahir</label>
                    <input type="text" class="form-control datepicker" id="tanggal-lahir" name="birthdate" placeholder="ex : 02/14/2018">
                </div>
            </div>
        </div>

    </div>
    <div class="col-6">

        <div class="row justify-content-center">
            <div class="col-md-12 ">
                <div class="form-group">
                    <label class="control-label">Alamat</label>
                    <input class="form-control" type="text" name="address" placeholder="ex: Jalan Merpati no.11" />
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12 ">
                <div class="form-group row">
                    <label class="col-12" for="example-select2">Kota/Kabupaten</label>
                    <div class="col-lg-12">
                        <select class="js-select2 form-control" id="kotaSelect2" name="city" style="width: 100%;" data-placeholder="Pilih kota/kabupaten">

                        </select>
                    </div>
                </div>
            </div>

        </div>
        <div class="row justify-content-center">
            <div class="col-md-12 ">
                <div class="form-group">
                    <label class="control-label">Kecamatan <i id="kecamatanLoading" class="fa fa-asterisk fa-spin text-info"></i></label>
                    <select name="district" class="form-control js-select2" data-placeholder="Pilih Kecamatan" id="kecamatanSelect2">
                    </select>
                </div>

            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-12 ">
                <div class="form-group">
                    <label class="control-label">No Telp</label>
                    <input class="form-control" type="text" name="phone" placeholder="HP/Nomor Rumah" />
                </div>
            </div>
        </div>
        
    </div>
    @if(config('app.is_military'))
    <div class="col-12 pt-20">
        <label class="css-control css-control-primary css-checkbox">
            <input type="checkbox" class="css-control-input">
            <span class="css-control-indicator"></span> Pasien adalah Anggota
        </label>
    </div>
    @endif
</div>
@if(config('app.is_military'))
<hr>
<div class="row">
    <div class="col-6">
        <div class="row justify-content-center">
            <div class="col-md-12 ">
                <div class="form-group">
                    <label class="control-label">NRP/NIP</label>
                    <input class="form-control" type="text" name="occupation" placeholder="ex: Aldi Sujana" />
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12 ">
                <div class="form-group">
                    <label class="control-label">Keanggotaan</label>
                    <select name="kelas" id="selectKelas" class="form-control" data-size="2">
                        <option value="1">Islam</option>
                        <option value="2">Kristen</option>
                        <option value="2">Katolik</option>
                        <option value="2">Buddha</option>
                        <option value="2">Hindu</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-12 ">
                <div class="form-group">
                    <label class="control-label">Pangkat</label>
                    <select name="kelas" id="selectKelas" class="form-control" data-size="2">
                        <option value="1">Islam</option>
                        <option value="2">Kristen</option>
                        <option value="2">Katolik</option>
                        <option value="2">Buddha</option>
                        <option value="2">Hindu</option>
                    </select>
                </div>
            </div>
        </div>

    </div>
    <div class="col-6">

        <div class="row justify-content-center">
            <div class="col-md-12 ">
                <div class="form-group">
                    <label class="control-label">Kotama</label>
                    <select name="kelas" id="selectKelas" class="form-control" data-size="2">
                        <option value="1">Islam</option>
                        <option value="2">Kristen</option>
                        <option value="2">Katolik</option>
                        <option value="2">Buddha</option>
                        <option value="2">Hindu</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-12 ">
                <div class="form-group">
                    <label class="control-label">Satker</label>
                    <select name="kelas" id="selectKelas" class="form-control" data-size="2">
                        <option value="1">Islam</option>
                        <option value="2">Kristen</option>
                        <option value="2">Katolik</option>
                        <option value="2">Buddha</option>
                        <option value="2">Hindu</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

@endif
</div>