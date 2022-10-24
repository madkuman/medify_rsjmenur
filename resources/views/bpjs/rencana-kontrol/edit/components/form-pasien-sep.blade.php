<div class="form-group">
    <label class="control-label">
        @if ($jenis == 1)
            No SPRI
        @else            
            No SKDP
        @endif
    </label>
    <input type="text"name="no_sep" id="noSep" class="form-control" value="{{ $rencana_kontrol->no_sk }}" required readonly>
</div>
<div class="form-group">
    <label class="control-label">
        @if ($jenis == 1)
            No Kartu
        @else            
            No SEP
        @endif
    </label>
    <input type="text"name="no_sep" id="noSep" class="form-control" @if ($jenis == 1) value="{{ $rencana_kontrol->no_kartu }}" @else value="{{ $rencana_kontrol->no_sep }}" @endif required readonly>
</div>
<div class="form-group">
    <label class="control-label">Tanggal Rencana Kontrol</label>
    <input type="text" class="js-datepicker form-control" id="tglRencanaKontrol" name="tanggal_rencana_kontrol" data-autoclose="true" autocomplete="off" data-today-highlight="true" data-date-format="dd-mm-yyyy" required="" placeholder="dd-mm-yyyy" value="{{ $rencana_kontrol->tgl_rk->format('d-m-Y') }}">
</div>
<div class="form-group">
    <label>Poli</label>
    <select class="js-select2 form-control" name="poli" data-placeholder="Pilih Poli" id="poliSelect" required style="width: 100%;">
        <option value="{{ $rencana_kontrol->kode_poli }}">{{ $rencana_kontrol->nama_poli }}</option>
    </select>
</div>