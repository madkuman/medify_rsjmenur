<form method="GET" action="{{url()->current()}}/laporan-jumlah-penderita" target="_blank">
    <div class="row mt-20">
        <div class="col-4">
            <div class="form-group">
                <label for="">Jenis Laporan</label>
                <select name="jenis_laporan" class="jenis_laporan form-control" id="">
                    <option value="tahunan">Tahunan</option>
                    <option value="bulanan" selected>Bulanan</option>
                    <option value="rentang-tanggal">Rentang Tanggal</option>
                </select>
            </div>
        </div>
        <div class="col-4 col-year hide">
            <div class="form-group">                        
                <label class="" for="example-daterange1">Pilih Tahun</label>
                <div class="">
                <input type="text" class="form-control js-datepicker-year" name="date" disabled data-autoclose="true" data-today-highlight="true" data-date-format="yyyy" required placeholder="yyyy" value="{{$current_year}}">
                </div>
            </div>
        </div>
        <div class="col-4 col-month">
            <div class="form-group">                        
                <label class="" for="example-daterange1">Pilih Bulan</label>
                <div class="">
                <input type="text" class="form-control datepicker-month" name="date" data-autoclose="true" data-today-highlight="true" data-date-format="yyyy-mm" required placeholder="yyyy-mm" value="{{$current_month}}">
                </div>
            </div>
        </div>
        <div class="col-4 col-rentang-tanggal hide">
            <div class="form-group row">
                <div class="col-12">
                    <label>Rentang Waktu</label>
                    <div class="input-daterange input-group" data-date-format="dd-mm-yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-end-date="+0d">
                        <input disabled type="text" class="form-control input-daterange-start" autocomplete="off" name="date" placeholder="From" data-week-start="1" data-autoclose="true" data-today-highlight="true" value="{{$date_range_start_month_default->format('d-m-Y')}}" required="">
                        <div class="input-group-prepend input-group-append">
                            <span class="input-group-text font-w600">to</span>
                        </div>
                        <input disabled type="text" class="form-control input-daterange-end" autocomplete="off" name="date_end" placeholder="To" data-week-start="1" data-autoclose="true" data-today-highlight="true" value="{{$date_range_end_month_default->format('d-m-Y')}}" required="">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label for="" class="text-light">.</label>
                <button class="btn button btn-primary d-block btn-submit">Print</button>
            </div>
        </div>
    </div>
</form>