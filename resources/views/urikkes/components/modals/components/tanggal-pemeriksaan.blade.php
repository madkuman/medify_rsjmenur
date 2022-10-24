<div class="form-group row">
    <div class="col-8">
        <label>Tanggal Pemeriksaan</label>
        <div class="row">
            <div class="col-6">
                <input class="form-control form-control-lg js-datepicker form-control " id="tanggal_min" name="tanggal_min" placeholder="Mulai dari" data-today-highlight="true" data-date-format="dd-mm-yyyy" autocomplete="off" required="" value="{{$awal_tahun}}" data-date-autoclose="true">
            </div>
            <div class="col-6">
                <input class="form-control form-control-lg js-datepicker form-control " id="tanggal_max" name="tanggal_max" placeholder="Sampai" data-today-highlight="true" data-date-format="dd-mm-yyyy" autocomplete="off" required="" value="{{$akhir_tahun}}" data-date-autoclose="true">
            </div>
        </div>
    </div>
</div>