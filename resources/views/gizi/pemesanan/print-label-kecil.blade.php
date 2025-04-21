<!DOCTYPE html>
<html>

<head>
    <title>Cetak Label Pemesanan</title>
    <style type="text/css">
        @page {
            size: 28mm 62mm landscape;
            margin-left: 2mm;
            margin-right: 2mm;
            margin-top: 2mm;
            margin-bottom: -10mm;
            border: 1px solid black;
        }

        table {
            width: 100%;
        }

        td {
            font-size: 11px;
            padding: 0;
        }

        .bold {
            font-weight: bold;
            font-size: 12px;
        }

        .box {
            border: 1px solid black;
            padding: 3px;
        }

        .bordered {
            border-bottom: 1px solid black;
        }

        .dummy {
            font-size: 1px;
            color: white;
        }
    </style>
</head>

<body>
    @php
        if ($waktu_makan_id == 1) {
            $best_before = '08:30';
        } elseif ($waktu_makan_id == 2) {
            $best_before = '13:30';
        } elseif ($waktu_makan_id == 3) {
            $best_before = '19:30';
        } elseif ($waktu_makan_id == 4) {
            $best_before = '11:00';
        } elseif ($waktu_makan_id == 5) {
            $best_before = '17:00';
        }
    @endphp
    @foreach ($result as $pemesanan_detail)
        <div class="box" style="border: 1px solid black">
            <table>
                <tr>
                    <td style="text-align:center">
                        {{ strtoupper($pemesanan_detail->lokasi->nama) }}
                    </td>
                </tr>
                <tr>
                    <td style="text-align:center">
                        ({{ strtoupper($pemesanan_detail->waktu_makan->nama) }})
                    </td>
                </tr>
                <tr>
                    <td class="bold">
                        {{ substr(strtoupper($pemesanan_detail->pemesanan->pasien->name), 0, 16) }} /
                        {{ $pemesanan_detail->pemesanan->pasien->no_rm_formatted }} /
                        {{ date('d-m-Y', strtotime($pemesanan_detail->pemesanan->pasien->date_of_birth)) }}
                    </td>
                </tr>
                {{-- <tr>
                        <td>
                            #{{$pemesanan_detail->pemesanan->pasien->no_rm_formatted}}
                        </td>
                    </tr>
                    <tr>
                        <td class="dummy" rowspan="3">dummy</td>
                    </tr> --}}
            </table>
            <table class="bordered">
                <tr>
                    <td style="width: 15%;">Diet</td>
                    <td style="width: 3%;">:</td>
                    <td style="width: 82%; overflow: hidden; word-wrap: break-word;">{{ $pemesanan_detail->diet->nama }}
                        @if ($pemesanan_detail->catatan != null)
                            / {{ $pemesanan_detail->catatan }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Tgl</td>
                    <td>:</td>
                    <td>{{ $tanggal }}</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td>BAIK DIKONSUMSI LANGSUNG</td>
                </tr>
            </table>
            {{-- <table style="border-collapse: collapse">
                    <tr>
                        <td style="text-align: center;width: 60%" class="dummy">dummy</td>
                        <td style="text-align: center;width: 40%" class="dummy">dummy</td>
                    </tr>
                    <tr>
                        <td style="text-align: center;">{{strtoupper($pemesanan_detail->waktu_makan->nama)}}</td>
                        <td style="text-align: center;">QC</td>
                    </tr>
                    <tr>
                        <td style="text-align: center; font-size: 10px;border-right: solid black 1px;">SEBAIKNYA DIKONSUMSI LANGSUNG</td>
                        <td style="text-align: center;" rowspan="2">{{$qc}}</td>
                    </tr>
                    <tr>
                        <td style="text-align: center; font-size: 10px;border-right: solid black 1px;">SEBELUM JAM {{$best_before}}</td>
                    </tr>
                </table> --}}
        </div>
        @if (!$loop->last)
            <div style="page-break-after:always;"></div>
        @endif
    @endforeach
</body>

</html>
