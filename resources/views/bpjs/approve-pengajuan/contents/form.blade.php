<div class="form-group">
    <label>Tanggal Penerbitan SEP</label>
    <input type="text" class="js-datepicker form-control js-datepicker-enabled required" id="tanggal" name="tanggal" autocomplete="false" data-today-highlight="true" data-date-format="yyyy-mm-dd" required="" placeholder="dd-mm-yyyy">
    <div class="invalid-feedback">Tanggal penerbitan SEP harus diisi</div>
</div>
<div class="form-group">
    <label>Nomor Kartu BPJS</label>
    <div class="input-group required">
        <input type="text" class="form-control required" id="no_kartu" name="no_kartu" placeholder="Nomor Kartu BPJS" autocomplete="false">
        <div class="input-group-append">
            <button id="kartu-search" type="button" class="btn btn-secondary"><i class="fa fa-search"></i>
            </button>
        </div>
    </div>
    <div class="invalid-feedback">Nomor kartu BPJS pasien harus diisi</div>
</div>
<div class="form-group">
    <label>Jenis Pelayanan</label>
    <select name="jenis_pelayanan" class="form-control required" id="jenis_layanan" style="width: 100%;"  required="">
        <option value="" disabled="" hidden="" selected="">Pilih Jenis Pelayanan</option>
        <option value="1">Rawat Inap</option>
        <option value="2">Rawat Jalan</option>
    </select>
    <div class="invalid-feedback">Jenis Pelayanan Harus diisi</div>
</div>
<div class="form-group">
    <label>Keterangan</label>
    <input type="text" class="form-control required" id="keterangan" name="keterangan" placeholder="Keterangan Penerbitan">
    <div class="invalid-feedback">Keterangan Harus diisi</div>
</div>
<button type="button" class="btn btn-primary float-right" id="submit">Simpan</button>
<div class="row justify-content-center mt-20" style="display: none;" id="form_loading">
    <div class="col-3 mx-auto">
        <i class="fa fa-asterisk fa-spin fa-4x text-info"></i>
    </div>
</div>