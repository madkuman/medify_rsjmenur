
@foreach($reseps as $transaksi)
<div style="width: 95%">
    <div style="text-align: center; border-bottom: 2px solid #000; padding-top: 20px;">
        <p>{{config('app.name')}}</p>
        <p>Jl.Menur No. 120, Kode Pos 60282.</p>
        <p style="padding-bottom: 10px;">{{ $transaksi->dokter_nama }}</p>
        <p>{{$transaksi->created_by_detail->sip ?? '-'}}</p>
    </div>

    <div style="padding-top: 10px;">
        <p>{{$transaksi->final_detail->nomor_resep}}</p>
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

@if(!$loop->last)
<div style="page-break-after: always;"></div>
@endif
@endforeach