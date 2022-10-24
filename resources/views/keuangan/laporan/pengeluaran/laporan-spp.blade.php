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
            white-space: -webkit-pre-wrap;
            word-wrap: break-word;
            word-break: break-all;
        }
        .wrapword{
            white-space: -moz-pre-wrap !important;  /* Mozilla, since 1999 */
            white-space: -webkit-pre-wrap; /*Chrome & Safari*/
            white-space: -pre-wrap;      /* Opera 4-6 */
            white-space: -o-pre-wrap;    /* Opera 7 */
            white-space: pre-wrap;       /* css-3 */
            word-wrap: break-word;       /* Internet Explorer 5.5+ */
            word-break: break-all;
            white-space: normal;
        }
        table tr td {
            page-break-inside: avoid;
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
    @foreach($total_unpaid_per_ma as $key => $item)
    <table style="table-layout:fixed;">
        <tr>
            <td class="bordered centered" style="width: 5%; font-weight: bold;">No. SPP</td>
            <td class="bordered centered" style="width: 15%; font-weight: bold;">No. PJK</td>
            <td class="bordered centered" style="width: 7%; font-weight: bold;">Tgl SPP</td>
            <td class="bordered centered" style="width: 8%; font-weight: bold;">Tgl Uji</td>
            <td class="bordered centered" style="width: 5%; font-weight: bold;">No. BK</td>
            <td class="bordered centered" style="width: 10%; font-weight: bold;">Uraian</td>
            <td class="bordered centered" style="width: 10%; font-weight: bold;">Rekanan</td>
            <td class="bordered centered" style="width: 20%; font-weight: bold;">Mengenai</td>
            <td class="bordered centered" style="width: 10%; font-weight: bold;">Terbayar</td>
            <td class="bordered centered" style="width: 10%; font-weight: bold;">Belum Terbayar</td>
        </tr>
        @foreach($spp as $data)
        @if($data->kategori_id == $key)
        <tr @if(\Carbon\Carbon::parse($data->tanggal_spp) < $threshold && empty($data->UJIDetail[0]->bk)) class="col-red" @endif>
            <td class="bordered centered">{{$data->no_spp}}</td>
            <td class="bordered centered wrapword">{{$data->nomor_pjk}}</td>
            <td class="bordered centered wrapword">{{date('d M Y', strtotime($data->tanggal_spp))}}</td>
            <td class="bordered centered wrapword">{{!empty($data->UJIDetail[0]) ? date('d M Y', strtotime($data->UJIDetail[0]->created_at)) : '-'}}</td>
            @if(!empty($data->UJIDetail[0]))
                @if(!empty($data->UJIDetail[0]->bk))
                <td class="bordered centered wrapword">{{$data->UJIDetail[0]->bk->no_bk}}/{{date('n', strtotime($data->UJIDetail[0]->bk->created_at))}}</td>
                @else
                <td class="bordered centered"></td>
                @endif
            @else
            <td class="bordered centered"></td>
            @endif
            <td class="bordered">{{$data->kategori->name ?? '-'}}</td>
            <td class="bordered">{{$data->perusahaan->nama}}</td>
            <td class="bordered">{{$data->judul}}</td>
            <td class="bordered righted wrapword">{{number_format($data->total_paid)}}</td>
            <td class="bordered righted wrapword">{{number_format($data->total-$data->total_paid)}}</td>
        </tr>
        @endif
        @endforeach
        <tr>
            <td class="bordered centered"></td>
            <td class="bordered centered"></td>
            <td class="bordered centered"></td>
            <td class="bordered centered"></td>
            <td class="bordered centered"></td>
            <td class="bordered centered"></td>
            <td class="bordered"></td>
            <td class="bordered righted">Total : </td>
            <td class="bordered righted wrapword">{{number_format($total_paid_per_ma[$key])}}</td>
            <td class="bordered righted wrapword">{{number_format($item)}}</td>
        </tr>
        <tr>
            <td colspan="10" style="color: white">aaa</td>
        </tr>
    </table>
    @endforeach
    <table>
        <tr>
            <td class="bordered centered" style="width: 5%; font-weight: bold;"></td>
            <td class="bordered centered" style="width: 15%; font-weight: bold;"></td>
            <td class="bordered centered" style="width: 7%; font-weight: bold;"></td>
            <td class="bordered centered" style="width: 8%; font-weight: bold;"></td>
            <td class="bordered centered" style="width: 5%; font-weight: bold;"></td>
            <td class="bordered centered" style="width: 10%; font-weight: bold;"></td>
            <td class="bordered" style="width: 10%; font-weight: bold;"></td>
            <td class="bordered righted" style="width: 20%; font-weight: bold;">Grandtotal : </td>
            <td class="bordered righted wrapword" style="width: 10%; font-weight: bold;">{{number_format($total_paid)}}</td>
            <td class="bordered righted wrapword" style="width: 10%; font-weight: bold;">{{number_format($total_unpaid)}}</td>
        </tr>
    </table>
</body>
</html>