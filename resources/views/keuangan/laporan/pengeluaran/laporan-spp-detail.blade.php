<!DOCTYPE html>
<html>
<head>
    <title>SPP {{$start_date}}-{{$end_date}}</title>
    <style type="text/css">
    body{
        font-family: sans-serif;
    }
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
    .col-red td{
        color: red;
    }
</style>
</head>
<body>
    <table>
        <tr>
            <td style="width: 30%; text-align: center;">{{config('app.name')}}</td>
            <td style="width: 70%"> </td>
        </tr>
    </table>
    <br>
    <table>
        <tr>
            <td class="centered" style="font-weight: bold; font-size: 18px">LAPORAN SPP</td>
        </tr>
        <tr>
            <td class="centered" style="font-weight: 400; font-size: 14px">{{$title}}</td>
        </tr>
        <tr>
            <td class="dummy">.</td>
        </tr>
        <tr>
            <td class="centered">PERIODE : {{strtoupper($start_date)}} S/D {{strtoupper($end_date)}}</td>
        </tr>
    </table>
    <br>
    @foreach($total_per_ma as $key => $item)
    <table>
        <tr>
            <td class="bordered centered" style="width: 5%; font-weight: bold;">No. SPP</td>
            <td class="bordered centered" style="width: 5%; font-weight: bold;">Urut Uji</td>
            <td class="bordered centered" style="width: 5%; font-weight: bold;">No. BK</td>
            <td class="bordered centered" style="width: 15%; font-weight: bold;">Uraian</td>
            <td class="bordered centered" style="width: 15%; font-weight: bold;">Rekanan</td>
            <td class="bordered centered" style="width: 25%; font-weight: bold;">Mengenai</td>
            <td class="bordered centered" style="width: 7.5%; font-weight: bold;">Tgl Uji</td>
            <td class="bordered centered" style="width: 7.5%; font-weight: bold;">Tgl BK</td>
            <td class="bordered centered" style="width: 5%; font-weight: bold;">MA</td>
            <td class="bordered centered" style="width: 10%; font-weight: bold;">Jumlah</td>
        </tr>
        @foreach($spp as $data)
        @if($data->kategori_id == $key)
        <tr @if(\Carbon\Carbon::parse($data->tanggal_spp) < $threshold && empty($data->UJIDetail[0]->bk)) class="col-red" @endif>
            <td class="bordered centered">{{$data->id}}</td>
            <td class="bordered centered">{{!empty($data->UJIDetail[0]) ? $data->UJIDetail[0]->id : '-' }}</td>
            <td class="bordered centered">{{!empty($data->UJIDetail[0]->bk) ? $data->UJIDetail[0]->bk->no_bk : '-' }}</td>
            <td class="bordered">{{$data->kategori->name}}</td>
            <td class="bordered">{{$data->perusahaan->nama}}</td>
            <td class="bordered">{{$data->judul}}</td>
            <td class="bordered centered">{{!empty($data->UJIDetail[0]) ? date('d M Y', strtotime($data->UJIDetail[0]->created_at)) : '-'}}</td>
            <td class="bordered centered">{{!empty($data->UJIDetail[0]->tanggal_bk) ? date('d M Y', strtotime($data->UJIDetail[0]->tanggal_bk)) : '-'}}</td>
            <td class="bordered centered">{{$data->kategori ? $data->kategori->kode_anggaran : '-'}}</td>
            <td class="bordered righted">{{number_format($data->total)}}</td>
        </tr>
        @endif
        @endforeach
        <tr>
            <td class="bordered centered"></td>
            <td class="bordered centered"></td>
            <td class="bordered centered"></td>
            <td class="bordered"></td>
            <td class="bordered"></td>
            <td class="bordered"></td>
            <td class="bordered"></td>
            <td class="bordered"></td>
            <td class="bordered righted">Total : </td>
            <td class="bordered righted">{{number_format($item)}}</td>
        </tr>
        <tr>
            <td colspan="10" style="color: white">aaa</td>
        </tr>
    </table>
    @endforeach
    <table>
        <tr>
            <td class="bordered centered" style="width: 5%; font-weight: bold;"></td>
            <td class="bordered centered" style="width: 5%; font-weight: bold;"></td>
            <td class="bordered centered" style="width: 5%; font-weight: bold;"></td>
            <td class="bordered" style="width: 15%; font-weight: bold;"></td>
            <td class="bordered" style="width: 15%; font-weight: bold;"></td>
            <td class="bordered" style="width: 25%; font-weight: bold;"></td>
            <td class="bordered" style="width: 7.5%; font-weight: bold;"></td>
            <td class="bordered righted" colspan="2" style="width: 12.5%; font-weight: bold;">Grandtotal : </td>
            <td class="bordered righted" style="width: 10%; font-weight: bold;">{{number_format($total)}}</td>
        </tr>
    </table>
</body>
</html>