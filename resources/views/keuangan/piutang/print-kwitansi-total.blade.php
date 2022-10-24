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
        text-transform: uppercase;
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
    <div class="terima-dari">
        @foreach($perusahaan as $item){{ $loop->first ? '' : ', ' }}{{$item->nama}}@endforeach
    </div>
    <div class="banyaknya_uang">
        {{$banyaknya_uang}} RUPIAH
    </div>
    <div class="pasien">
        Pasien dengan rincian terlampir
    </div>
    <div class="terbilang">
        Rp {{number_format($terbilang,0)}}
    </div>

    <div class="ttd">
        Surabaya, {{$tanggal}}<br>
        {{$ttd->jabatan}}<br>
        {{config('app.name')}}
        <br><br>
        {{$ttd->nama}}<br>
        {{$ttd->pangkat}} NRP. {{$ttd->nip}}
    </div>
</body>
</html>