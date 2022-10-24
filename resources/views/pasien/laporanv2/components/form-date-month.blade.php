<div class="form-group row">
    <div class="col-12">
        <label>Pilih Bulan dan Tahun *</label>
        <input type="text" required class="form-control bg-white" id="form-input-date-month" name="bulan_tahun" autocomplete="off" data-autoclose="true"
            data-today-highlight="true" data-date-format="yyyy-mm-dd" required placeholder="yyyy-mm" readonly value="{{ $date_range_end_month_default->format('Y-m') }}">
    </div>
</div>

@section('js')
    @parent
    <script>
        $("#form-input-date-month").datepicker({
            format: "yyyy-mm",
            startView: "months",
            minViewMode: "months"
        });
    </script>
@endsection
