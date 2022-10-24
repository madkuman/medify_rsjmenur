<!DOCTYPE html>
<html>
<head>
    <title>BK Terbayar {{$start_date}}-{{$end_date}}</title>
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
            <td class="centered" style="font-weight: bold; font-size: 18px">LAPORAN BK TERBAYAR</td>
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
            <td class="bordered centered" style="width: 10%; font-weight: bold;">Tanggal BK</td>
            <td class="bordered centered" style="width: 8%; font-weight: bold;">No. BK</td>
            <td class="bordered centered" style="width: 10%; font-weight: bold;">Jenis BK</td>
            <td class="bordered centered" style="width: 7%; font-weight: bold;">No. SPP</td>
            <td class="bordered centered" style="width: 20%; font-weight: bold;">Rekanan</td>
            <td class="bordered centered" style="width: 33%; font-weight: bold;">Mengenai</td>
            <td class="bordered centered" style="width: 12%; font-weight: bold;">Jumlah</td>
        </tr>
        @foreach($bk_paid as $data)
        <tr>
            <td class="bordered centered">{{date('d M Y', strtotime($data->tanggal_bk))}}</td>
            <td class="bordered centered">{{$data->bk->no_bk}}</td>
            <td class="bordered centered">{{$data->akun->nama}}</td>
            <td class="bordered centered">{{$data->spp->no_spp}}</td>
            <td class="bordered">{{$data->spp->perusahaan->nama}}</td>
            <td class="bordered">{{$data->spp->judul}}</td>
            <td class="bordered righted">{{number_format($data->total)}}</td>
        </tr>
        @endforeach
        <tr>
            <td class="bordered centered"></td>
            <td class="bordered centered"></td>
            <td class="bordered centered"></td>
            <td class="bordered centered"></td>
            <td class="bordered centered"></td>
            <td class="bordered righted">Grandtotal : </td>
            <td class="bordered righted">{{number_format($total)}}</td>
        </tr>
    </table>
</body>
</html>