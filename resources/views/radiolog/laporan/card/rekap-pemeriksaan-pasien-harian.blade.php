<form method="GET" action="{{url()->current()}}/rekap-pemeriksaan-pasien-harian" target="_blank">
    <div class="col-4 mt-20">
        <div class="form-group">                        
            <label class="" for="example-daterange1">Pilih Tanggal</label>
            <div class="">
                <input type="text" class="form-control js-datepicker" autocomplete="off" name="date" data-week-start="1" data-autoclose="true" data-today-highlight="true" placeholder="dd-mm-yyyy" data-date-format="dd-mm-yyyy" value="{{$date_single_day_default->format('d-m-Y')}}" data-end-date="+0d">
            </div>
        </div>
        <div class="form-group">
            <button class="btn button btn-primary btn-submit">Print</button>
        </div>
    </div>
</form>