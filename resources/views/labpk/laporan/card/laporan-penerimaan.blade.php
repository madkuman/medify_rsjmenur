<form method="GET" action="{{url()->current()}}/laporan-penerimaan" target="_blank" id="form-laporan-penerimaan">
    <div class="col-12 col-md-6 col-sm-10 mt-20">
        <div class="form-group">                        
            <label class="" for="example-daterange1">Jenis Laporan</label>
            <div class="">
                <select name="jenis_laporan" class="form-control js-select2" style="width: 100%">
                    <option value="tahunan">Tahunan</option>
                    <option value="bulanan">Bulanan</option>
                    <option value="harian">Harian</option>
                </select>
            </div>
        </div>
        <div class="form-group container-tahunan">                        
            <label class="" for="example-daterange1">Pilih Tahun</label>
            <div class="">
            <input type="text" class="form-control js-datepicker-year" name="date" data-autoclose="true" data-today-highlight="true" data-date-format="yyyy-mm" required placeholder="yyyy-mm" value="{{ date('Y') }}">
            </div>
        </div>
        <div class="form-group container-bulanan" style="display: none">                        
            <label class="" for="example-daterange1">Pilih Bulan</label>
            <div class="">
            <input type="text" class="form-control datepicker-month" disabled name="date" data-autoclose="true" data-today-highlight="true" data-date-format="yyyy-mm" required placeholder="yyyy-mm" value="{{$current_month}}">
            </div>
        </div>
        <div class="form-group container-harian" style="display: none">                        
            <label class="" for="example-daterange1">Pilih Tanggal</label>
            <div class="input-daterange input-group" data-date-format="yyyy-mm-dd" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                <input type="text" class="form-control" autocomplete="off" id="example-daterange1" disabled name="date" placeholder="From" data-week-start="1" data-autoclose="true" data-today-highlight="true" value="{{ now()->startOfMonth()->format('Y-m-d')}}" required="">
                <div class="input-group-prepend input-group-append">
                    <span class="input-group-text font-w600">to</span>
                </div>
                <input type="text" class="form-control" autocomplete="off" id="example-daterange2" name="date_end" placeholder="To" data-week-start="1" data-autoclose="true" data-today-highlight="true" value="{{ now()->endOfMonth()->format('Y-m-d')}}" required="">
            </div>
        </div>
        <div class="form-group">
            <button class="btn button btn-primary btn-submit">Print</button>
        </div>
    </div>
</form>
@section('js')
    @parent
    <script>
        $('#form-laporan-penerimaan [name="jenis_laporan"]').on('change', function () {
            let val = $(this).val();
            let form = $('#form-laporan-penerimaan');
            form.find('[name="date"]').prop('disabled', true);
            form.find('.container-tahunan').hide();
            form.find('.container-bulanan').hide();
            form.find('.container-harian').hide();
            form.find('.container-'+val).show();
            form.find('.container-'+val).find('[name="date"]').prop('disabled', false);
        });
    </script>
@endsection