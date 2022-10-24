<!DOCTYPE html>
<html>
<head>
    <title>Laporan BK Detail {{$start_date}}-{{$end_date}}</title>
    <style type="text/css">
    table {
        border-collapse: collapse;
        font-size: 13px;
        width: 100%;
    }
    .bordered {
        border: 1px solid black;
    }
    .dummy{
        color: white;
        font-size: 18px;
    }
    .centered{
        text-align: center;
    }
    .righted{
        text-align: right;
    }
    td {
        padding-left: 5px;
        padding-right: 5px;
    }

</style>
</head>
<body>
    <table>
        <tr>
            <td class="centered" style="border-bottom: 1px solid black;">{{config('app.name')}}</td>
            <td></td>
        </tr>
    </table>
    <br>
    <table>
        <tr>
            <td class="centered" style="font-weight: bold; font-size: 18px">KU 300 PENGELUARAN</td>
        </tr>
        <tr>
            <td class="dummy">.</td>
        </tr>
        <tr>
            <td class="centered">PERIODE : {{strtoupper($start_date)}} S/D {{strtoupper($end_date)}}</td>
        </tr>
    </table>
    <br>
    <table>
        <tr>
            <td class="bordered centered" style="width: 8%; font-weight: bold;">Tanggal BK</td>
            <td class="bordered centered" style="width: 8%; font-weight: bold;">No. BK</td>
            <td class="bordered centered" style="width: 8%; font-weight: bold;">SPP</td>
            <td class="bordered centered" style="width: 68%; font-weight: bold;">KU-300 Pengeluaran</td>
            <td class="bordered centered" style="width: 8%; font-weight: bold;">Jumlah</td>
        </tr>
        @foreach($bk_paid as $data)
        <tr>
            <td class="bordered centered">{{!empty($data->tanggal_bk) ? date('d M Y', strtotime($data->tanggal_bk)) : '-'}}</td>
            @if(!is_null($data->bk))
            <td class="bordered centered">{{$data->bk->no_bk}}</td>
            @else
            <td class="bordered centered"></td>
            @endif
            <td class="bordered centered">{{$data->spp->no_spp}}</td>
            <td class="bordered">Kepada {{$data->spp->perusahaan->direktur}}, {{$data->spp->perusahaan->jabatan}} {{$data->spp->perusahaan->nama}}, {{$data->spp->judul}}</td>
            <td class="bordered righted">{{number_format($data->total)}}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>