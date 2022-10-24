<form method="GET" action="{{url()->current()}}/rekap-pemeriksaan-pasien-bulanan" target="_blank">
    <div class="col-12">
        @include('radiolog.laporan.card.components-radio-layanan')
    </div>
    <div class="col-4 mt-20">
        <div class="form-group">                        
            {{Form::label('cetak_date', 'Pilih Bulan dan Tahun')}}
            <input type="text" class="form-control" id="cetakBulananPolos" name="date" data-autoclose="true" data-today-highlight="true" data-date-format="yyyy-mm-dd" required placeholder="yyyy-mm" value="{{$current_month}}">
        </div>
        <div class="form-group">
            <button class="btn button btn-primary btn-submit">Print</button>
        </div>
    </div>
</form>