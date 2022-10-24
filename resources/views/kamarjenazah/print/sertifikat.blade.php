<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        p {
            margin: 0px;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
            padding-bottom: 10px;
        }

        tr.border_bottom td {
            border-bottom:5pt solid black;
            padding-bottom: 10px;
        }

        .invoice-box table td {
            padding: 0px;
            /*vertical-align: top;*/
            padding-bottom: 10px;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: left;
            padding-bottom: 10px;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 0px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: inherit;
            color: #333;
            padding-bottom: 10px;
        }

        .information {
            padding-bottom: 10px;
        }

        .informations {
            padding-bottom: 0px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
            padding-bottom: 0px;
        }

        .invoice-box table tr.details td {
            padding-bottom: 10px;
        }

        .invoice-box table tr.detailsafterheading td {
            padding-bottom: 10px;
            padding-top: 8px;
        }

        .invoice-box table tr.item td{
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table width="100%">
                        <tr>
                            <td width="100%"><img src="{{config('app.kop_lg')}}" height="50"></td>
                        </tr>
                    </table>

                </td>
            </tr>

            <tr class="informations">
                <td colspan="2">
                    <table>
                        <tr class="information">
                            <td width="20%">
                                <p align="left" style="font-size:18px; padding-top: 0px;"><b/>RAHASIA</p>
                            </td>
                            <td>
                                <h3 align="center" style="padding-bottom: 10px;"><u/>SERTIFIKAT MEDIS PENYEBAB KEMATIAN</h3>
                            </td>
                        </tr>
                    </table>
                    <table>
                        <tr class="information">
                            <td width="50%">
                                <p align="left">Bulan / Tahun  {{date("m/Y")}}</p>
                            </td>
                            <td>
                                <p align="right">Kode RS : 3578020</p>
                            </td>
                        </tr>
                        <tr class="information">
                          @if(!isset($invoice['transaksi_id']))
                          <td colspan="2">
                            <p>No. Urut Pencatatan Kematian __ __ __ No. Rekam Medis {{$pasien['identitas']['id']}} Ruangan :</p>
                        </td>
                        @else
                        <td colspan="2">
                            <p>No. Urut Pencatatan Kematian {{$invoice['transaksi_id']}} No. Rekam Medis {{$pasien['identitas']['id']}} Ruangan :</p>
                        </td>
                        @endif
                    </tr>
                </table>
            </td>
        </tr>

        <tr class="heading">
            <td colspan="2">
                I. Identitas Jenazah
            </td>
        </tr>
        <tr class="detailsafterheading">
            <td>
                1. Nama Lengkap
            </td>
            <td>
                {{$pasien['identitas']['name']}}
            </td>
        </tr>
        <tr class="details">
            <td>
                2. Pangkat / NRP
            </td>
            <td>
                BPJS
            </td>
        </tr>
        <tr class="details">
            <td>
                3. No. Induk Kependudukan (NIK)
            </td>
            <td>
                {{$jenazah['nik'][0]['nik']}}
            </td>
        </tr>
        <tr class="details">
            <td>
              4. No. Kartu Keluarga :
          </td>
          <td>
            {{$jenazah['nokk'][0]['nokk']}}
        </td>
    </tr>
    <tr class="details">
        <td>
            5. Jenis Kelamin
        </td>
        <td>
            @if($pasien['identitas']['gender'] == 1) Laki laki
            @else Perempuan
            @endif
        </td>
    </tr>
    <tr class="details">
        <td>
            6. Tempat/Tanggal Lahir/ Umur
        </td>
        <td>
            {{$pasien['identitas']['place_of_birth']}}, {{date('d F Y', strtotime($pasien['identitas']['date_of_birth']))}} <b>Umur</b> {{$pasien['identitas']['age']}} Th
        </td>
    </tr>
    <tr class="details">
        <td>
            7. Agama
        </td>
        <td>
            {{$pasien['identitas']['agama']['nama']}}
        </td>
    </tr>
    <tr class="details">
        <td>
            8. Alamat Tempat Tinggal
        </td>
        <td>
            {{$pasien['identitas']['address']}},
            @if(!empty($pasien['identitas']['alamat_kecamatan']))
            {{$pasien['identitas']['alamat_kecamatan']['name']}}, {{$pasien['identitas']['alamat_kota']['name']}}
            @endif
        </td>
    </tr>
    <tr class="details">
        <td>
            9. Status Kependudukan
        </td>
        <td>
            {{$jenazah['status_kependudukan'][0]['status_kependudukan']}}
        </td>
    </tr>
    <tr class="details">
        <td>
            10. Hubungan dengan Kepala Rumah Tangga
        </td>
        <td>
            {{$jenazah['hubungan_keluarga'][0]['hubungan_keluarga']}}
        </td>
    </tr>
    <tr class="details">
        <td>
            11. Waktu Meninggal
        </td>
        <td>
            {{$jenazah['permintaan'][0]['waktu_meninggal']}}
        </td>
    </tr>
    <tr class="details">
        <td>
            12. Tempat Meninggal
        </td>
        <td>
            {{$jenazah['tempat_kematian'][0]['nama_tempat']}} - {{$jenazah['permintaan'][0]['detail_tempat']}}
        </td>
    </tr>

    <tr class="heading">
        <td colspan="2">
            II. Keterangan Khusus Kasus Kematian di Rumah atau Lainnya (Termasuk DOA)
        </td>
    </tr>
    <tr class="detailsafterheading">
        <td>
            1. Status Jenazah
        </td>
        <td>
            @if($jenazah['status_jenazah'][0]['status_jenazah'] == 'Belum dimakamkan')
            Belum dimakamkan
            @else
            Telah dimakamkan : {{$jenazah['dikubur'][0]['dikubur']}}
            @endif
        </td>
    </tr>
    <tr class="details">
        <td>
            2. Nama Pemeriksa Jenazah
        </td>
        <td>
            {{$jenazah['nama_pemeriksa'][0]['nama_pemeriksa']}}
        </td>
    </tr>

    <tr class="details">
        <td>
            3. Waktu Pemeriksaan Jenazah
        </td>
        <td>
            {{$created_at}}
        </td>
    </tr>

    <tr class="heading">
        <td colspan="2">
            III. Penyebab Kematian
        </td>
    </tr>
    <tr class="detailsafterheading">
        <td>
            1. Dasar Diagnosis
        </td>
        <td>
            <ul>
                @foreach($jenazah['nama_diagnosis'] as $namanya)
                <li>{{$namanya}}</li>
                @endforeach
            </ul>
        </td>
    </tr>
    <tr class="details">
        <td>
            2. Kelompok Penyebab Kematian
        </td>
        <td>
            {{$jenazah['sebab_kematian'][0]['nama_sebab']}} ({{$jenazah['permintaan'][0]['detail_kematian']}})
        </td>
    </tr>

</table>
</div>
</body>
</html>
