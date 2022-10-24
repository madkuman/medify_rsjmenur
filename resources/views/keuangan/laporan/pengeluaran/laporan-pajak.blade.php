<!DOCTYPE html>
<html>
<head>
    <title>Laporan UJI {{$start_date}}-{{$end_date}}</title>
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
            <td class="centered" style="font-weight: bold; font-size: 18px">LAPORAN PENYETORAN PAJAK PAJAK NON APBN</td>
        </tr>
        <tr>
            <td class="centered" style="font-weight: bold; font-size: 18px">PPN, PPH - 21, PPH - 22, PPH - 23 DAN PPH - 4</td>
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
            <td class="bordered centered" style="width: 3%; font-weight: bold;">No. BK</td>
            <td class="bordered centered" style="width: 10%; font-weight: bold;">Nama Rekanan</td>
            <td class="bordered centered" style="width: 7%; font-weight: bold;">NPWP Rekanan</td>
            <td class="bordered centered" style="width: 5%; font-weight: bold;">Faktur</td>
            <td class="bordered centered" style="width: 10%; font-weight: bold;">Jumlah</td>
            <td class="bordered centered" style="width: 10%; font-weight: bold;">DPP</td>
            <td class="bordered centered" style="width: 9%; font-weight: bold;">PPN</td>
            <td class="bordered centered" style="width: 9%; font-weight: bold;">PPh 21(5%)</td>
            <td class="bordered centered" style="width: 10%; font-weight: bold;">PPh 21(15%)</td>
            <td class="bordered centered" style="width: 9%; font-weight: bold;">PPh 22</td>
            <td class="bordered centered" style="width: 9%; font-weight: bold;">PPh 23</td>
            <td class="bordered centered" style="width: 9%; font-weight: bold;">PPh 24</td>
        </tr>
        @foreach($pajak as $data)
        <tr>
            @if(!is_null($data->bk))
            <td class="bordered centered">{{$data->bk->no_bk}}</td>
            @else
            <td class="bordered centered"></td>
            @endif
            <td class="bordered wrapword">{{$data->spp->perusahaan->nama}}</td>
            <td class="bordered centered wrapword">{{$data->spp->perusahaan->npwp}}</td>
            <td class="bordered righted wrapword">{{$data->spp->no_faktur}}</td>
            <td class="bordered righted wrapword">{{number_format($data->total)}}</td>
            <td class="bordered righted wrapword">{{number_format(floor(($data->kena_ppn+$data->jasa) * (100/110)))}}</td>
            <td class="bordered righted wrapword">{{number_format( $data->detail[1]->jumlah )}}</td>
            @if(empty($data->pph_21_5))
            <td class="bordered righted wrapword">{{number_format( floor( floor(($data->kena_ppn+$data->jasa) * (100/110)) * ($data->pph_21_5/100) ) )}}</td>
            <td class="bordered righted wrapword">{{number_format( $data->detail[2]->jumlah )}}</td>
            @else
            <td class="bordered righted wrapword">{{number_format( $data->detail[2]->jumlah )}}</td>
            <td class="bordered righted wrapword">{{number_format( floor( floor(($data->kena_ppn+$data->jasa) * (100/110)) * ($data->pph_21_15/100) ) )}}</td>
            @endif
            <td class="bordered righted wrapword">{{number_format( $data->detail[3]->jumlah )}}</td>
            <td class="bordered righted wrapword">{{number_format( $data->detail[4]->jumlah )}}</td>
            <td class="bordered righted wrapword">{{number_format( $data->detail[5]->jumlah )}}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>