<!DOCTYPE html>
<html>

<head>
    <title>Rekonsiliasi Obat</title>
    <style type="text/css">
        * {
            margin: 10px;
        }

        table {
            font-family: sans-serif;
            width: 100%;
            font-size: 13px;
            border-collapse: collapse;
        }

        .bordered td,
        .bordered th {
            border: 1px solid black;
            padding-left: 5px;
            padding-right: 5px;
        }

        td {
            vertical-align: top;
        }

        .centered td,
        .centered {
            text-align: center;
        }

        .big {
            font-size: 15px;
        }

        .va-mid {
            vertical-align: middle;
        }
    </style>
</head>

<body>
    <table class="big">
        <tr>
            <td width="20%" style="text-align: right;">
                <img src="{{ url('') }}/assets/img/pemprov-jatim.png" height="55">
            </td>
            <td width="60%" style="text-align: center;">
                <b>
                    PEMERINTAH PROVINSI JAWA TIMUR<br>
                    RUMAH SAKIT JIWA MENUR<br>
                    Jln Menur No.120, Telp(031)5021635,5021637<br>
                    S U R A B A Y A
                </b>
            </td>
            <td width="20%" style="text-align: left;">
                <img src="{{ url('') }}/assets/img/menur.png" height="55">
            </td>
        </tr>
    </table>
    <hr style="border-top: 3px double black">
    <table class="big">
        <tr>
            <td class="centered"><b>LEMBAR KONSELING OBAT</b></td>
        </tr>
    </table>
    <br>
    <table style="margin-left: 7px;">
        <tr>
            <td width="50%">
                <table>
                    <tr>
                        <td width="30%">No. RM</td>
                        <td width="70%">: {{ $kasus->pasien->no_rm_formatted }}</td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td>: {{ $kasus->pasien->name }}</td>
                    </tr>
                    <tr>
                        <td>Tgl Lahir/Umur</td>
                        <td>: {{ date('d-m-Y', strtotime($kasus->pasien->date_of_birth)) }} / {{ $kasus->pasien->age }}
                            Tahun</td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td>: {{ $kasus->pasien->gender == '1' ? 'Laki-laki' : 'Perempuan' }}</td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>: {{ $kasus->pasien->address }} </td>
                    </tr>
                    <tr>
                        <td>No. Telp.</td>
                        <td>: {{ $kasus->pasien->phone }}</td>
                    </tr>
                </table>
            </td>
            <td width="50%">
                <table>
                    <tr>
                        <td width="30%">Ruangan</td>
                        <td width="70%">: {{ $kasus->lokasi->lokasi->nama }}</td>
                    </tr>
                    <tr>
                        <td>DPJP</td>
                        <td>: {{ $kasus->dpjp->user->name }}</td>
                    </tr>
                    <tr>
                        <td>Apoteker</td>
                        <td>: </td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td>: {{ $kasus->pembayaran->perusahaan->nama ?? $kasus->pembayaran }}</td>
                    </tr>
                    <tr>
                        <td>Tinggi Badan</td>
                        <td>: {{ $kasus->identitas->tinggi_badan }}</td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <table class="bordered" style="font-size: 11px;">
        <tr class="centered">
            <th width="4%">No.</th>
            <th width="14%">Tanggal / Jam</th>
            <th>Metode</th>
            <th>Uraian</th>
            <th>Rekomendasi</th>
            <th width="14%">TTD Apoteker</th>
            <th width="14%">TTD Pasien</th>
        </tr>
        @foreach ($konseling_obat as $index => $data)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td> {{ date('d-m-Y / H:i', strtotime($data->created_at)) }} </td>
                <td>{!! nl2br($data->json_val->metode) !!}</td>
                <td>{!! nl2br($data->json_val->uraian) !!}</td>
                <td>{!! nl2br($data->json_val->rekomendasi) !!}</td>
                <td class="centered">
                    @if ($data->creator->ttd != null)
                        <img src="{{ url($data->creator->ttd) }}" width="60">
                        <br>
                    @else
                        <br>
                        <br>
                    @endif
                    {{ str_limit($data->creator->name, 10) }}
                </td>
                <td class="centered">
                    @if (!empty($data->json_val->ttd_img_pasien))
                        <img src="{{ public_path($data->json_val->ttd_img_pasien) }}" width="60">
                        <br>
                    @else
                        <br>
                        <br>
                    @endif
                    {{ str_limit($data->json_val->nama_pasien ?? '', 10) }}
                </td>
            </tr>
        @endforeach
    </table>
</body>

</html>
