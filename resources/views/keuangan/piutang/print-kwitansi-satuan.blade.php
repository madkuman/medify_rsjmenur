<html>
<head>
    <style type="text/css">
    @page {
     margin: 0px;
    }
    body{
        font-style: "Tahoma";
        font-size: 14px;
        text-transform: uppercase;
    }
    .text-center
    {
        text-align: center
    }
    .text-right
    {
        text-align: right;
    }
    .table
    {
        width: 100%;
    }
    table.table,.table th,.table td {
        border: 1px solid black;
        border-collapse: collapse;
    }
    .table th, .table td {
        padding: 8px;
        font-style: "Tahoma";
        font-size: 7px;
    }
    .date td{
        text-align: center;
    }
    .underline{
        text-decoration: underline;
    }

    .terima-dari
    {
        position: fixed;
        left:34%;
        top:15%;
    }
    .banyaknya_uang{
        position: fixed;
        left: 38%;
        top: 28%;
    }
    .pasien{
        position: fixed;
        left: 48%;
        top: 48%;
    }
    .terbilang{
        position: fixed;
        left: 32%;
        top: 80%;
    }
    .ttd{
        position: fixed;
        left:60%;
        top: 60%;
        text-align: center;
    }
</style>
</head>
<body>
    @foreach($piutang as $item)
    <div class="terima-dari">
        @php $tunai = $item->perusahaan->tunai ?? 1; @endphp
        @if($tunai)
        {{$item->pasien->name}}
        @else
        {{$item->perusahaan->nama}}
        @endif
    </div>
    <div class="banyaknya_uang">
        {{$item->total_terbilang}} RUPIAH
    </div>
    <div class="pasien">
        {{$item->kasusTagihan->kasus->lokasi->lokasi->departemen->nama ?? '-'}} atas nama terlampir dengan rincian terlampir
    </div>
    <div class="terbilang">
        Rp {{number_format($item->total,0)}}
    </div>
    <div class="ttd">
        Surabaya, {{$tanggal}}<br>
        {{$ttd->jabatan}}<br>
        {{config('app.name')}}
        <br><br>
        {{$ttd->nama}}<br>
        {{$ttd->pangkat}} NRP. {{$ttd->nip}}
    </div>

    <pagebreak></pagebreak>
    @endforeach
</body>
</html>