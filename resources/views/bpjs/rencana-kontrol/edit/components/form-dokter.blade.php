
<div class="form-group">
    <label class="control-label">Dokter</label>
    <select class="js-select2 form-control" name="dokter" data-placeholder="Pilih Dokter" id="dokterSelect" style="width: 100%;">
        <option value="{{ $rencana_kontrol->kode_dokter }}">{{ $rencana_kontrol->nama_dokter }}</option>
    </select>
</div>