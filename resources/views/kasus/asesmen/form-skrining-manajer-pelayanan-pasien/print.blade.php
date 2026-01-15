<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $kasus->judul_kasus }} - FORM SKRINING MANAJER PELAYANAN PASIEN (MPP)</title>
</head>
<style type="text/css">
    @page {
        margin: 20px 30px;
        footer: page-footer;
    }

    body {
        font-size: 12px !important;
        font-family: Arial, Helvetica, sans-serif;
    }

    table {
        width: 100%;
    }

    table,
    tr,
    td {
        vertical-align: middle;
        border-collapse: collapse;
    }

    td {
        padding: 0 10px;
    }

    .table-padding td {
        padding: 5px 10px;
    }

    .table-bordered tr,
    .table-bordered td {
        border: 1px solid #000;
    }

    .bordered {
        border: 1px solid #000;
    }

    .border-bottom-0 {
        border-bottom: none;
    }

    .text-center {
        text-align: center;
    }

    .text-right {
        text-align: right;
    }

    .text-left {
        text-align: left;
    }

    .border-bottom-0 {
        border-bottom: none;
    }

    label {
        font-weight: 400;
    }
</style>

<body>
    <div class="block-content block-hasil" style="padding-left: 25px; padding-right: 25px;">
        <table>
            <tr>
                <td width="80%"> </td>
                <td class="bordered border-bottom-0 text-center">
                    <span>RM.30</span>
                </td>
            </tr>
            <tr>
                <td width="80%"> </td>
                <td class="bordered border-bottom-0 text-center">
                    <span><em>Halaman 1/1</em></span>
                </td>
            </tr>
        </table>

        <!-- HEADER -->
        <table>
            <tr>
                <td  class="bordered" width="60%" style="padding: 10px 0; border-right: none">
                    <table>
                        <tr>
                            <td width="18%" style="text-align: right;">
                                <img src="{{ url('') }}/assets/img/pemprov-jatim.png" height="55">
                            </td>
                            <td width="62%" style="text-align: center; font-size: 11px">
                                <b>
                                    PEMERINTAH PROVINSI JAWA TIMUR<br>
                                    RUMAH SAKIT JIWA MENUR<br>
                                    Jl Menur No.120, Telp(031) 5021635-5021637<br>
                                    Surabaya
                                </b>
                            </td>
                            <td width="20%" style="text-align: left;">
                                <img src="{{ url('') }}/assets/img/menur.png" height="55">
                            </td>
                        </tr>
                    </table>
                </td>

                <td class="bordered" width="40%" style="padding: 10px 0; border-left: none">
                    <table>
                        <tr>
                            <td><span>No. RM</span></td>
                            <td><span>:</span></td>
                            <td> {{ optional($kasus->pasien)->no_rm }} </td>
                        </tr>
                        <tr>
                            <td><span>Nama</span></td>
                            <td><span>:</span></td>
                            <td> {{ optional($kasus->pasien)->name }} </td>
                        </tr>
                        <tr>
                            <td><span>Tgl lahir / umur</span></td>
                            <td><span>:</span></td>
                            <td> {{ optional($kasus->identitas)->tanggal }} / {{ optional($kasus->identitas)->age }}
                            </td>
                        </tr>
                        <tr>
                            <td><span>Jenis kelamin</span></td>
                            <td><span>:</span></td>
                            <td> {{ optional($kasus->pasien)->jenis_kelamin }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <table class="bordered border-bottom-0">
            <tr>
                <td class="text-center">
                    <h4>FORM SKRINING MANAJER PELAYANAN PASIEN (MPP)</h4>
                </td>
            </tr>
        </table>

        <table class="bordered border-bottom-0" style="padding: 10px 0">
            <tr>
                <td width="20%">Dx Medis</td>
                <td width="5%">:</td>
                <td>{{ optional($asesmen->jsonval)->dx_medis }}</td>
            </tr>

            <tr>
                <td width="20%">Tanggal</td>
                <td width="5%">:</td>
                <td>{{ optional($asesmen->jsonval)->tanggal }}</td>
            </tr>

            <tr>
                <td width="20%">MPP</td>
                <td width="5%">:</td>
                <td>{{ optional($asesmen->jsonval)->mpp }}</td>
            </tr>
        </table>

        @php
            $risiko = [['Pelayanan inadequat', 'Risiko readmisi', 'Risiko komplain', ''], ['Pasien tanpa asuransi dengan sumber daya tinggi', 'Pasien dengan asuransi kesehatan dengan minimal coverage', 'Pasien dengan pembayar yang belum jelas', ''], ['Kasus multidiagnosis', 'Kasus multiprovider', 'Mendapatkan banyak tindakan medis', ''], ['Rencana rawat lebih dari rencana rawat dalam Clinical Pathway', 'Kasus yang diprediksi membutuhkan waktu lebih dari ....', ''], ['Ada riwayat dan risiko penelantaran', 'Pasien tanpa identitas', 'Pasien upaya bunuh diri, riwayat lari, pasung*', '']];
        @endphp

        <table class="table-bordered table-padding">
            <tr>
                <td colspan="3">
                    <strong>Berikan tanda √ pada pilihan data risiko yang sesuai</strong>
                </td>
            </tr>

            <tr>
                <td class="text-center"><strong>NO</strong></td>
                <td class="text-center"><strong>DATA RISIKO</strong></td>
                <td class="text-center"><strong>KET.</strong></td>
            </tr>

            @php
                $json = $asesmen->jsonval;
            @endphp

            @foreach ($json->risiko as $row_key => $row_item)
                @php
                    $row_index = (int) preg_replace('/[^0-9]/', '', $row_key);
                @endphp

                @foreach ($row_item as $column_key => $column_item)
                    @php
                        $column_index = (int) preg_replace('/[^0-9]/', '', $column_key);
                    @endphp

                    <tr class="risiko-input">
                        <!-- NO -->
                        @if ($column_index === 0)
                            <td class="text-center" rowspan="{{ count(get_object_vars($row_item)) }}" width="8%">
                                {{ $row_index + 1 }}
                            </td>
                        @endif

                        <!-- DATA RISIKO -->
                        <td>
                            <div class="form-check ml-2">
                                <!-- checkbox -->
                                @if (isset($column_item->check) && $column_item->check == 'on')
                                    <strong>√</strong>
                                @else
                                    <input class="form-check-input risiko-check" type="checkbox">
                                @endif

                                <!-- text -->
                                <label class="form-check-label">
                                    {{ $column_item->text ?? '.........................' }}
                                </label>

                                @if ($row_index === 3 && $column_index === 1)
                                    <span>{{ $json->waktu_prediksi }}</span>
                                @endif
                            </div>
                        </td>

                        <!-- KETERANGAN -->
                        @if ($column_index === 0)
                            <td rowspan="{{ count(get_object_vars($row_item)) }}" style="vertical-align: top">
                                <div class="risiko-ket">{!! $column_item->ket ? nl2br($column_item->ket) : '' !!}</div>
                            </td>
                        @endif
                    </tr>
                @endforeach
            @endforeach
        </table>

        <div>* Coret yang tidak perlu</div>

    </div>

    <htmlpagefooter name="page-footer">
        <small>RSJM / Revisi 00 / 08.2018</small>
    </htmlpagefooter>
</body>

</html>
