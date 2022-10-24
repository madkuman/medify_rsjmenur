@extends('keuangan.layouts.main')

@section('title')
Laporan Buku Piutang - Keuangan
@endsection


@section('content')


<!-- Page Content -->   
<div class="mt-20">
    <div class="row">
        <div class="col-12">
            <div class="block">
                <div class="block-header text-center">
                    <h5 class="mb-0">Laporan Pemasukan - Buku Piutang</h5>
                </div>
                <div class="block-content block-content-full">
                    <form method="get" action="{{url()->current()}}/cetak">
                        <div class="row">
                            <div class="col-3">
                                <div class="form-group">
                                    <label>Pilih Tanggal</label>
                                    <input type="text" class="form-control" required id="cetakRekapDate" name="bulan" autocomplete="off" data-autoclose="true" data-today-highlight="true" data-date-format="yyyy-mm-dd" required placeholder="yyyy-mm">
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary">Cetak</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END Page Content -->
@endsection

@section('js')
<script type="text/javascript">
   $("#cetakRekapDate").datepicker( {
    format: "yyyy-mm",
    startView: "months", 
    minViewMode: "months"
});
</script>
@endsection