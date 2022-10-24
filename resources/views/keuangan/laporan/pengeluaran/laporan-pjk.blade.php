<!DOCTYPE html>
<html>
<head>
    <title>PJK {{$start_date}}-{{$end_date}}</title>
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
        body {
            width: 100%;
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
            <td class="centered" style="font-weight: bold; font-size: 18px">LAPORAN PJK</td>
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
    <table style="width: 100%; table-layout: fixed">
        <tr>
            <td class="bordered centered" style="width: 15%; font-weight: bold;">No. PJK</td>
            <td class="bordered centered" style="width: 10%; font-weight: bold;">Tanggal</td>
            <td class="bordered centered" style="width: 15%; font-weight: bold;">No. Faktur</td>
            <td class="bordered centered" style="width: 20%; font-weight: bold;">Rekanan</td>
            <td class="bordered centered" style="width: 30%; font-weight: bold;">Mengenai</td>
            <td class="bordered centered" style="width: 10%; font-weight: bold;">Jumlah</td>
        </tr>
        @foreach($pjk as $data)
        <tr>
            <td class="bordered centered">{{$data->nomor_pjk}}</td>
            <td class="bordered centered">{{date('d M Y', strtotime($data->tanggal_transaksi))}}</td>
            <td class="bordered centered wrapword">{{$data->no_faktur}}</td>
            <td class="bordered">{{$data->perusahaan->nama}}</td>
            <td class="bordered">{{$data->judul}}</td>
            <td class="bordered righted">{{number_format($data->total)}}</td>
        </tr>
        @endforeach
        <tr>
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