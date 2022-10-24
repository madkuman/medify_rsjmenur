
<div id="form_laka" style="display: none;">
    <hr>
    <h5>Data Kecelakaan Laka</h5>
    <div class="form-group">
        <label class="css-control css-control-primary css-checkbox"  id="suplesi_wrap">
            <input type="checkbox" class="css-control-input" id="suplesi">
            <span class="css-control-indicator"></span> Suplesi
        </label>
    </div> 
    <div class="form-group" id="sep_suplesi_wrap">
        <label>Nomor SEP Suplesi</label>
        <input type="text" class="suplesi form-control" id="sep_suplesi" name="sep_suplesi" placeholder="Nomor SEP Suplesi" readonly="" disabled="">
    </div>
    <div class="form-group">
        <label>Pihak Penjamin</label>
        <select class="laka form-control js-select2" name="penjamin_laka" multiple="multiple" id="penjamin_laka" style="width: 100%;" data-placeholder="Pihak Penjamin">
            <option value=""></option>
            <option value="1">PT Jasa Raharja</option>
            <option value="2">BPJS Ketenagakerjaan</option>
            <option value="3">PT Taspen</option>
            <option value="4">PT ASABRI</option>
        </select>
    </div>
    <div class="form-group">
        <label for="tanggal_laka">Tanggal Kejadian Laka</label>
        <input type="text" class="laka js-datepicker form-control" id="tanggal_laka" name="tanggal_laka" data-autoclose="true"  autocomplete="off"  data-today-highlight="true" data-date-format="yyyy-mm-dd" placeholder="dd-mm-yyyy">
    </div>
    <div class="form-group">
        <label>
            Provinsi Kejadian Laka
            <i class="fa fa-asterisk fa-spin text-info" id="prov-laka-loading" style="display: none;"></i>
        </label>
        <select class="laka form-control js-select2" name="provinsi_laka" id="provinsi_laka" style="width:100%;" data-placeholder="Provinsi Laka">
            <option value=""></option>
        </select>
    </div>
    <div class="form-group">
        <label>
            Kabupaten/Kota Kejadian Laka
            <i class="fa fa-asterisk fa-spin text-info" id="kota-laka-loading" style="display: none;"></i>
        </label>
        <select class="laka form-control js-select2" name="kota_laka" id="kota_laka" style="width:100%;" data-placeholder="Kabupaten/Kota Laka">
            <option value=""></option>
        </select>
    </div>
    <div class="form-group">
        <label>
            Kecamatan Kejadian Laka
            <i class="fa fa-asterisk fa-spin text-info" id="kc-laka-loading" style="display: none;"></i></label>
        <select class="laka form-control js-select2" name="kecamatan_laka" id="kecamatan_laka" style="width: 100%;" data-placeholder="Kecamatan Laka">
            <option value=""></option>
        </select>
    </div>
    <div class="form-group">
        <label>Keterangan Kecelakaan</label>
        <input type="text" class="suplesi form-control" id="keterangan_laka" name="keterangan_laka" placeholder="Keterangan Kecelakaan">
    </div>
</div>