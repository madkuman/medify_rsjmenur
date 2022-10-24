<form method="GET" action="{{url()->current()}}/laporan-kunjungan-tahunan-per-lokasi" target="_blank">
    <div class="col-4 mt-20">
        <div class="form-group">                        
            <label class="" for="example-daterange1">Pilih Tahun</label>
            <div class="">
            <input type="text" class="form-control js-datepicker-month" name="date" data-autoclose="true" data-today-highlight="true" data-date-format="yyyy-mm" required placeholder="yyyy-mm" value="{{$current_month}}">
            </div>
        </div>
        <div class="form-group">
            <button class="btn button btn-primary btn-submit">Print</button>
        </div>
    </div>
</form>