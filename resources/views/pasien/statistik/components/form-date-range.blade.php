
<div class="form-group row">
    <label class="col-12" for="example-daterange1">Rentang Waktu*</label>
    <div class="col-lg-8">
        <div class="input-daterange input-group" data-date-format="dd/mm/yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-end-date="+0d">
            <input type="text" class="form-control" autocomplete="off" id="example-daterange1" name="daterange1" placeholder="From" data-week-start="1" data-autoclose="true" data-today-highlight="true" value="{{$date_range_start_month_default->format('d/m/Y')}}" required="">
            <div class="input-group-prepend input-group-append">
                <span class="input-group-text font-w600">to</span>
            </div>
            <input type="text" class="form-control" autocomplete="off" id="example-daterange2" name="daterange2" placeholder="To" data-week-start="1" data-autoclose="true" data-today-highlight="true" value="{{$date_range_end_month_default->format('d/m/Y')}}" required="">
        </div>
    </div>
</div>