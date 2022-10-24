@extends('layouts.print')

@section('title')
Print Resep Format Dokter
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
        <p>{{config('app.name')}}</p>         
        <p style="padding-bottom: 10px;">{{ $dokter }}</p>
        <p>{{$transaksi->created_by_detail->sip ?? '-'}}</p>
    </div>

    <div style="padding-top: 10px;">
        <p>{{$nomor_resep}}</p>
    </div>
    
    <div style="text-align: right; padding-top: 5px;">
        <p> {{ date('d F Y, H:i', strtotime($transaksi->paid_at ? $transaksi->paid_at : $transaksi->created_at)) }} </p>
    </div>

    @foreach($transaksi->final_detail->resep_detail as $detail)
    <div style="padding-top: 10px;padding-bottom: 10px; border-bottom: 1px solid #000; width: 50%">
        R/ {{$detail->nama_obat}} ({{$detail->satuan}}), No {{$detail->roman}}<br>
        <span style="font-family: Dejavu Sans, sans-serif;">&int;</span> {{$detail->aturan}}
    </div>
    @endforeach

    <div style="padding-top: 30px;">
        <p>Pro : {{$transaksi->pasien_detail ? $transaksi->pasien_detail->name : $transaksi->nama_pasien}}<br>
        Umur : {{$transaksi->pasien_detail ? $transaksi->pasien_detail->age."tahun" : "-"}}<br>
        No Rekam Medis : {{$transaksi->pasien_detail ? $transaksi->pasien_detail->no_rm_formatted : "-"}}<br>
        Alamat : {{$transaksi->pasien_detail ? $transaksi->pasien_detail->address : "-"}}
        </p>
    </div>

</div>
@endsection
