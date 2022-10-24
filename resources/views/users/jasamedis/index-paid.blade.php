@extends('layouts.main2')

@section('content')

@include('layouts.components2.navbar')
<!-- Main Container -->
<main id="main-container">
    <div class="content">
        <div class="block">
            <div class="block-content pb-20">
                <a href="{{url('jasa-medis')}}" class="pull-right">Jasa Medis Belum Terbayar</a>
                <h5>Jasa Medis Belum Terbayar</h5>
                <hr>
                <div class="row py-10">
                    <div class="col-md-2 text-left">
                        <span class="font-w600 text-uppercase">Tanggal</span>
                    </div>
                    <div class="col-md-2 text-left">
                        <span class="font-w600 text-uppercase">Deskripsi</span>
                    </div>
                    <div class="col-md-2 text-left">
                        <span class="font-w600 text-uppercase">Pasien</span>
                    </div>
                    <div class="col-md-2 text-left">
                        <span class="font-w600 text-uppercase">PJ Pembayaran</span>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-4 text-right">
                                <span class="font-w600 text-uppercase">Bruto</span>
                            </div>
                            <div class="col-md-4 text-right">
                                <span class="font-w600 text-uppercase">PPH</span>
                            </div>
                            <div class="col-md-4 text-right">
                                <span class="font-w600 text-uppercase">Netto</span>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>

                @foreach($jasamedis as $key => $items)
                <p class="p-10 table-warning text-center">{{$key}} - <span id="netto-total-{{$loop->index}}"></span></p>
                @php $netto_total[$loop->index] = 0 @endphp
                @php $current_index_month = $loop->index @endphp

                @foreach($items as $item)
                <div class="row py-10">
                    <div class="col-md-2">
                        {{$item->created_at_formatted}}
                    </div>
                    <div class="col-md-2">
                        {{$item->deskripsi}}
                    </div>
                    <div class="col-md-2">
                        @if($item->pemasukan_detail_id != 0)
                        {{$item->pemasukan_detail->pemasukan->pasien->name}}
                        @endif
                    </div>
                    <div class="col-md-2">
                        @if($item->pemasukan_detail_id != 0)
                        {{$item->pemasukan_detail->pemasukan->pihak_ketiga}}
                        @endif
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-4 text-right">
                                {{$item->total_rupiah}}
                            </div>
                            <div class="col-md-4 text-right">
                                Rp {{number_format($item->pph,0)}}
                            </div>
                            <div class="col-md-4 text-right">
                                Rp {{number_format($item->netto,0)}}
                            </div>
                        </div>
                    </div>
                </div>

                @php $netto_total[$current_index_month] += $item->netto @endphp
                @endforeach

                @php $netto_total[$current_index_month] = 'Rp '.number_format($netto_total[$current_index_month]) @endphp


                @endforeach
            </div>
        </div>
    </div>
</main>

@endsection

@section('js')
<script type="text/javascript">
    @foreach($netto_total as $item)
    $('#netto-total-{{$loop->index}}').html('{{$item}}')
    @endforeach
    
</script>
@endsection
