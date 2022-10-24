@extends('layouts.print')

@section('title')
Print Resep
@endsection

@section('css')
<style type="text/css">
    @page {
        margin-top: 0.0cm;
        margin-left: 0.6cm;
        margin-bottom: 0cm;
        margin-right: 0cm;
    }
</style>
@endsection

@section('content')

<div style="width: 95%">
    <div style="text-align: center; border-bottom: 2px solid #000; padding-top: 20px;">
        <span>{{config('app.name')}}</span><br>
        <span>{{ $resep->doctor['name'] }}</span><br>
        <span>No. SIP : {{ $resep->doctor['sip'] }}</span><br>
    </div>

    <div style="padding-top: 10px;">
        <span>{{$resep->transaksi_farmasi->ori_detail['nomor_resep'] ?? ''}}</span>
    </div>
    
    <div style="text-align: right; padding-top: 5px;">
        <span> {{ $resep->tanggal }} </span>
    </div>

    @foreach ( $resep->resepDetail as $resepDetail )
    <div style="padding-top: 10px;padding-bottom: 10px; border-bottom: 1px solid #000; width: 50%">
        <span>R/ {{$resepDetail->type}} 
                @if($resepDetail->kategori == 'racikan')
                <br>
                {!! nl2br($resepDetail->racikan) !!}
                @else {{ $resepDetail->obat_name }}
                @endif
        </span>
        <br><span>{{ $resepDetail->jumlah }}</span> 
        <br>{!! nl2br($resepDetail->aturan) !!}
    </div>
    @endforeach

    <div style="padding-top: 30px;">
        <span>Pro : {{$kasus->pasien->name}}<br>
        Umur : {{$kasus->pasien->age}} tahun <br>
        No Rekam Medis : {{$kasus->pasien_id}} <br>
        Alamat : {{$kasus->identitas->alamat}} <br><br>

        @if($kasus->pembayaran->perusahaan->tipe->id == 1)
        No BPJS : {{$kasus->pembayaran->no_asuransi ?? '-'}} <br>
        No SEP : {{$kasus->active_sep->no_sep ?? '-'}} <br>
        @endif
        </span>
    </div>

</div>
@endsection