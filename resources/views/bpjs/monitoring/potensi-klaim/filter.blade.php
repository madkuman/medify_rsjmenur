<div class="row pt-10 px-15 pb-30">
    <div class="col-12">
        <h6>FILTER</h6>
    </div>
    <div class="col-6">
        <div class="form-group row">
            <div class="col-12">
                <label>Rentang Waktu MRS<span style="color: red;">*</span></label>
                <div class="input-daterange input-group" data-date-format="dd-mm-yyyy" data-week-start="1"
                     data-autoclose="true" data-today-highlight="true" data-end-date="+0d">
                    <input type="text" class="form-control input-daterange-start" autocomplete="off"
                           name="daterange-start" placeholder="From" data-week-start="1" data-autoclose="true"
                           data-today-highlight="true" value="{{ $start_date }}" required="">
                    <div class="input-group-prepend input-group-append">
                        <span class="input-group-text font-w600">to</span>
                    </div>
                    <input type="text" class="form-control input-daterange-end" autocomplete="off" name="daterange-end"
                           placeholder="To" data-week-start="1" data-autoclose="true" data-today-highlight="true"
                           value="{{ $end_date }}" required="">
                </div>
            </div>
        </div>
    </div>
    <div class="col-12"></div>
    <div class="col-2">
        <button type="button" class="btn btn-primary btn-get-data">
            <i class="fa fa-spin fa-spinner btn-get-data-loading" style="display: none"></i> Filter
        </button>
    </div>
</div>
<div class="row px-15">
    <div class="col-12">
        <div class="row progress-data-loader-container" style="display: none">
            <div class="col-4">
                Progress (Total Data : <span class="progress-data-loader-total-data">0</span>)
                <div class="progress push progress-data-loader-loading">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                         id="progress-bar-progress" style="width: 0;">
                        <span class="progress-bar-label">0%</span>
                    </div>
                </div>
                <div class="progress push progress-data-loader-complete"  style="display: none">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 100%;" aria-valuenow="100"
                         aria-valuemin="0" aria-valuemax="100">
                        <span class="progress-bar-label">100%</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>