<div class="form-group row">
    <div class="col-12">
       <label>Rentang Waktu*</label>
       <div class="input-daterange input-group" data-date-format="dd-mm-yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-end-date="+0d">
        <input type="text" class="form-control input-daterange-start" autocomplete="off" name="daterange-start" placeholder="From" data-week-start="1" data-autoclose="true" data-today-highlight="true" value="{{$date_range_start_month_default->format('d-m-Y')}}" required="">
        <div class="input-group-prepend input-group-append">
            <span class="input-group-text font-w600">to</span>
        </div>
        <input type="text" class="form-control input-daterange-end" autocomplete="off" name="daterange-end" placeholder="To" data-week-start="1" data-autoclose="true" data-today-highlight="true" value="{{$date_range_end_month_default->format('d-m-Y')}}" required="">
    </div>
</div>
</div>