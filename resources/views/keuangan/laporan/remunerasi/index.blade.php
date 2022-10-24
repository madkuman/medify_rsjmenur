@extends('keuangan.layouts.main')

@section('title')
Laporan Remunerasi - Keuangan
@endsection


@section('content')


<!-- Page Content -->   
<div class="mt-20">
    <div class="block">
        <form method="GET" action="{{url()->current()}}/print-laporan-kinerja-berdasarkan-tagihan" target="_blank">
            {{csrf_field()}}
            <div class="block-content block-content-full">
                <h4>Laporan Kinerja Personil Berdasarkan Tagihan</h4>
                <hr>
                <div class="row mb-10">
                    <div class="col-2">
                        <h6 class="pt-10">Pilih Tanggal</h6>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <div class="input-daterange input-group" data-date-format="dd-mm-yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                                <input type="text" class="form-control" id="tanggal_awal" name="tanggal_awal" placeholder="From" data-week-start="1" data-autoclose="true" autocomplete="off" required="true" value="{{Carbon\Carbon::today()->subMonth()->startOfMonth()->format('d-m-Y')}}">
                                <div class="input-group-prepend input-group-append">
                                    <span class="input-group-text font-w600">to</span>
                                </div>
                                <input type="text" class="form-control" id="tanggal_akhir" name="tanggal_akhir" placeholder="To" data-week-start="1" data-autoclose="true" autocomplete="off" required="true" value="{{Carbon\Carbon::today()->subMonth()->endOfMonth()->format('d-m-Y')}}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-10">
                    <div class="col-2">
                        <h6 class="pt-10">Lokasi</h6>
                    </div>
                    <div class="col-3">
                        <select class="form-control js-select2" name="lokasi_id">
                            <option value="0" selected>Semua</option>
                            @foreach($lokasi as $item)
                            <option value="{{$item->id}}">{{$item->nama}}</option>
                            @endforeach
                            @foreach($lokasi_ranap as $item)
                            <option value="{{$item->id}}">{{$item->nama}}</option>
                            @endforeach
                            <option value="{{$lokasi_ok->id}}">{{$lokasi_ok->nama}}</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-10">
                    <div class="col-2">
                        <h6 class="pt-10">Personil</h6>
                    </div>
                    <div class="col-3">
                        <select class="form-control js-select2" name="user_id">
                            <option value="0" selected>Semua</option>
                            @foreach($user as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-10">
                    <div class="col-2">
                        <h6 class="pt-10">Sumber Data</h6>
                    </div>
                    <div class="col-3">
                        <select class="form-control" name="sumber_data">
                            <option value="pemasukan" selected>Terbayar - Pemasukan</option>
                            <option value="piutang">Belum Terbayar - Piutang</option>
                            <option value="tagihan">Belum Tercheckout - Kasus</option>
                            <option value="pemasukan-retribusi">Retribusi - Pemasukan</option>
                            <option value="farmasi">Farmasi</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-10">
                    <div class="col-2">
                        <h6 class="pt-10">Jenis Pembayaran Pasien</h6>
                    </div>
                    <div class="col-3">
                        <select class="form-control js-select2" name="perusahaan_id">
                            <option value="0" selected>Semua</option>
                            @foreach($perusahaan as $item)
                            <option value="{{$item->id}}" @if($loop->first) selected @endif>{{$item->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-10">
                    <div class="col-2">
                        <h6 class="pt-10"></h6>
                    </div>
                    <div class="col-2">
                        <button type="submit" class="btn btn-primary submit-button">Cetak Laporan</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- END Page Content -->
@endsection

@section('js')
<script type="text/javascript">
    $(document).on('click', '.submit-button', function(){
        $(this).parent().parent().parent().parent().unbind('submit').submit();
    })
</script>
@endsection