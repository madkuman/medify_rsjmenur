<form method="GET" action="{{url()->current()}}/laporan-data-status-ranap" target="_blank">
    <div class="col-4 mt-20">
        <div class="form-group">                        
            <label>Pilih Bulan</label>
            <div class="">
            <input type="text" class="form-control datepicker-month" name="date" data-autoclose="true" data-today-highlight="true" data-date-format="yyyy-mm" required placeholder="yyyy-mm" value="{{$current_month}}">
            </div>
        </div>
        <div class="form-group">
            <button class="btn button btn-primary btn-submit">Print</button>
        </div>
    </div>
</form>