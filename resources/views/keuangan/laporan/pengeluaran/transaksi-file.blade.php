<!DOCTYPE html>
<html>
<head>
    <title>Transaksi File Pengadaan {{indonesian_date($start_date)}}-{{indonesian_date($end_date)}}</title>
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
        .content{
            font-size: 8px;
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
            <td class="centered" style="font-weight: bold; font-size: 18px">LAPORAN TRANSAKSI FILE PENGADAAN</td>
        </tr>
        <tr>
            <td class="centered">{{strtoupper($perusahaan)}}</td>
        </tr>
        <tr>
            <td class="centered">PERIODE : {{strtoupper(indonesian_date($start_date))}} S/D {{strtoupper(indonesian_date($end_date))}}</td>
        </tr>
    </table>
    <br>
    <table style="table-layout:fixed;">
        @php $no = 1; $company_id = 0; @endphp
        @foreach($files as $i => $file)
        @if($file->perusahaan_id != $company_id)
        @php $company_id = $file->perusahaan_id @endphp
        @if($i > 0)
        <tr>
            <td colspan="17" style="color: white">aaa</td>
        </tr>
        @endif
        <tr class="bordered">
            <td class="wrapword" colspan="17">Rekanan: <strong>{{$file->perusahaan->nama}}</strong></td>
        </tr>
        <tr>
            <th class="bordered" rowspan="2">No</th>
            <th class="bordered" rowspan="2">No PJK</th>
            <th class="bordered" rowspan="2">Tgl PJK</th>
            <th class="bordered" rowspan="2">Distributor</th>
            <th class="bordered" rowspan="2">Nama Barang</th>
            <th class="bordered" rowspan="2">Sat</th>
            <th class="bordered" rowspan="2">Jml</th>
            <th class="bordered" rowspan="2">Harga Sat</th>
            <th class="bordered" rowspan="2">Disc.</th>
            <th class="bordered" rowspan="2">Jml Harga</th>
            <th class="bordered" rowspan="2">Jml Total PJK</th>
            <th class="bordered" colspan="6">Waktu Kirim</th>
        </tr>
        <tr>
            <th class="bordered">UKPBJ 1</th>
            <th class="bordered">Proga</th>
            <th class="bordered">PPK</th>
            <th class="bordered">UKPBJ 2</th>
            <th class="bordered">UJI</th>
            <th class="bordered">BP</th>
        </tr>
        @endif
        @foreach($file->detail as $j => $detail)
        <tr>
            <td class="content bordered">{{$no++}}</td>
            <td class="content bordered">{{$file->nomorpjk}}</td>
            <td class="content bordered">{{indonesian_date($file->tanggal_transaksi)}}</td>
            <td class="content bordered">{{$file->perusahaan->nama}}</td>
            <td class="content bordered">{{$detail->deskripsi}}</td>
            <td class="content bordered">{{$detail->keterangan}}</td>
            <td class="content bordered">{{$detail->jumlah}}</td>
            <td class="content bordered">{{number_format($detail->harga)}}</td>
            <td class="content bordered">{{number_format($detail->diskon)}}</td>
            <td class="content bordered">{{number_format($detail->subtotal)}}</td>
            <td class="content bordered">{{number_format($file->total)}}</td>
            @if($j == 0)
            <td class="content bordered" rowspan="{{count($file->detail)}}">{{isset($file->tgl_ukpbj_1) ? indonesian_date($file->tgl_ukpbj_1) : '-'}}</td>
            <td class="content bordered" rowspan="{{count($file->detail)}}">{{isset($file->tgl_proga) ? indonesian_date($file->tgl_proga) : '-'}}</td>
            <td class="content bordered" rowspan="{{count($file->detail)}}">{{isset($file->tgl_ppk) ? indonesian_date($file->tgl_ppk) : '-'}}</td>
            <td class="content bordered" rowspan="{{count($file->detail)}}">{{isset($file->tgl_ukpbj_2) ? indonesian_date($file->tgl_ukpbj_2) : '-'}}</td>
            <td class="content bordered" rowspan="{{count($file->detail)}}">{{isset($file->tgl_uji) ? indonesian_date($file->tgl_uji) : '-'}}</td>
            <td class="content bordered" rowspan="{{count($file->detail)}}">{{isset($file->tgl_bp) ? indonesian_date($file->tgl_bp) : '-'}}</td>
            @endif
        </tr>
        @endforeach
        @endforeach
    </table>
</body>
</html>