<div class="col-sm-2">
    <div class="form-group">
        <label class="control-label">Sumber Data</label>
        <select class="form-control" data-size="5" id="filter-source" tabindex="-1" aria-hidden="true">
            <option value="rs">RS</option>
            <option value="bpjs">BPJS</option>
        </select>
    </div>
</div>
<div class="col-sm-4">
    <div class="form-group">
        <label class="control-label">Format Filter</label>
        <select class="form-control" data-size="5" id="filter-format" tabindex="-1" aria-hidden="true">
            <option value="1">Tanggal Entri</option>
            <option value="2">Tanggal Rencana Kontrol</option>
        </select>
    </div>
</div>
<div class="col-sm-4">
    <div class="form-group filter-by-date">
        <div class="row">
            <div class="col-lg-6 col-sm-12">
                <div class="form-group">
                    <label>Tanggal Start</label>
                    <input type="text" class="form-control js-datepicker" id="filter-date-start" data-week-start="1" data-today-highlight="true" data-auto-close="true" data-date-format="dd-mm-yyyy" value="{{ now()->copy()->startOfMonth()->format('d-m-Y') }}">
                </div>
            </div>
            <div class="col-lg-6 col-sm-12">
                <div class="form-group">
                    <label>Tanggal End </label>   
                    <input type="text" class="form-control js-datepicker" id="filter-date-end" data-week-start="1" data-today-highlight="true" data-auto-close="true" data-date-format="dd-mm-yyyy" value="{{ now()->copy()->endOfMonth()->format('d-m-Y') }}">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-sm-2">
    <div class="form-group">
        <button class="btn btn-primary btn-lg" style="margin-top: 19px; width: 100%;" id="filter-submit"><i class="fa fa-search mr-5"></i>Filter</button>
    </div>
</div>