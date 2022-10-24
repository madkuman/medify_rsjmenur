<div class="form-group">
    <label class="control-label">Tanggal Rencana Kontrol</label>
    <input type="text" class="js-datepicker form-control" id="tglRencanaKontrol" name="tanggal_rencana_kontrol" data-autoclose="true" autocomplete="off" data-today-highlight="true" data-date-format="dd-mm-yyyy" required="" placeholder="dd-mm-yyyy">
</div>
<div class="form-group pilih-form-pasien">
    <label class="control-label">
        Pasien
        <i class="fa fa-asterisk fa-spin text-info" id="pasienLoading" style="display: none;"></i>
    </label>
    <select name="pasien" id="pasienSelect" class="js-select2 form-control" style="width: 100%;">
        <option value=""></option>
    </select>
</div>
<div class="form-group pilih-form-pasien">
    <label class="control-label">Kasus Pasien</label>
    <select name="kasus_pasien" id="kasusPasien" class="js-select2 form-control" style="width: 100%">
        <option value=""></option>
    </select>
</div>
<div class="form-group form-no-sep">
    <label class="control-label">
        <span class="swaper-sep-kartu-text">@if($jenis == '2') No SEP @else No Kartu @endif</span>
        <i class="fa fa-asterisk fa-spin text-info" id="sepLoading" style="display: none;"></i>
    </label>
    <input type="text"name="no_sep" id="noSep" class="form-control" required readonly>
</div>
<div class="form-group">
    <label>Poli</label>
    <select class="js-select2 form-control" name="poli" data-placeholder="Pilih Poli" id="poliSelect" required style="width: 100%;">
        <option value=""></option>
    </select>
    <div class="badge badge-danger" id='error-select-poli'></div>
</div>