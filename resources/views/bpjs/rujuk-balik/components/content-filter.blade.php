<div id="searchByNo">
    <div class="form-group">
        <label>Nomor SRB</label>
        <div class="input-group">
            <input type="text" class="form-control required" id="noSrb">
            <div class="input-group-append">
                <button id="filterNoSrb" class="btn btn-primary"><i class="fa fa-search"></i> Cari</button>
            </div>
            <br>
        </div>
        <div class="invalid-feedback alert alert-danger"  id="error_search_rujukan_nomor"></div>
    </div>
</div>
<div id="searchByTanggal" style="display: none">
    <div class="form-group filter-by-date">
        <div class="row">
            <div class="col-lg-5 col-sm-12">
                <div class="form-group">
                    <label>Tanggal Start</label>
                    <input type="text" class="form-control js-datepicker" id="dateStart" data-week-start="1" data-today-highlight="true" data-auto-close="true">
                </div>
            </div>
            <div class="col-lg-5 col-sm-12">
                <div class="form-group">
                    <label>Tanggal End </label>   
                    <input type="text" class="form-control js-datepicker" id="dateEnd" data-week-start="1" data-today-highlight="true" data-auto-close="true">
                </div>
            </div>
            <div class="col-lg-2 col-sm-12">
                <div class="form-group">
                    <button class="btn btn-primary btn-lg" style="margin-top: 19px; width: 100%;" id="filterTanggal"><i class="fa fa-search mr-5"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>