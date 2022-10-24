<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    @include('kamarjenazah.layouts.css')
</head>
 {{-- border="1px solid black" --}}
<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    @include('kamarjenazah.layouts.kop')
                </td>
            </tr>
            
            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr class="information">
                            <td width="10%">
                                <p align="left"><b/>RAHASIA</p>
                            </td>
                            <td>
                                <p align="center" style="padding-bottom: 0px;"><u/>SERTIFIKAT MEDIS PENYEBAB KEMATIAN</p>
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
                            <td colspan="2">
                                <p>No. Urut Pencatatan Kematian __ __ __ No. Rekam Medis {{$pasien['identitas']['id']}} Ruangan :</p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="heading">
                <td colspan="2">
                    I. Identitas Jenazah
                </td>
            </tr>           
            <tr class="details">
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
                    12345678901234567890 No. Kartu Keluarga 99999999999999
                </td>
            </tr>
            <tr class="details">
                <td>
                    4. Jenis Kelamin
                </td>
                <td>
                    @if($pasien['identitas']['gender'] == 1) Laki laki
                    @else Perempuan
                    @endif
                </td>
            </tr>
            <tr class="details">
                <td>
                    5. Tempat/Tanggal Lahir/ Umur
                </td>
                <td>
                    {{$pasien['identitas']['place_of_birth']}}, {{date('d F Y', strtotime($pasien['identitas']['date_of_birth']))}} <b>Umur</b> {{$pasien['identitas']['age']}} Th
                </td>
            </tr>
            <tr class="details">
                <td>
                    6. Agama
                </td>
                <td>
                    {{$pasien['identitas']['agama']['nama']}}
                </td>
            </tr>
            <tr class="details">
                <td>
                    7. Alamat Tempat Tinggal
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
                    8. Status Kependudukan
                </td>
                <td>
                    Bukan Penduduk
                </td>
            </tr>
            <tr class="details">
                <td>
                    9. Hubungan dengan Kepala Rumah Tangga
                </td>
                <td>
                    Kepala Rumah Tangga
                </td>
            </tr>
            <tr class="details">
                <td>
                    10. Waktu Meninggal
                </td>
                <td>
                    {{$jenazah['permintaan'][0]['waktu_meninggal']}}
                </td>
            </tr>
            <tr class="detailsbottom">
                <td>
                    11. Tempat Meninggal
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
            <tr class="item">
                <td>
                    1. Status Jenazah
                </td>                
                <td>
                    Belum Dimakamkan
                </td>
            </tr>
            <tr class="item">
                <td>
                    2. Nama Pemeriksa Jenazah
                </td>
                <td>
                    Daniel Kurniawan
                </td>
            </tr>

            <tr class="detailsbottom">
                <td>
                    3. Waktu Pemeriksaan Jenazah
                </td>
                <td>
                    Tanggal ___ Bulan ___ Tahun ___ Pukul ___
                </td>
            </tr>

            <tr class="heading">
                <td colspan="2">
                    III. Penyebab Kematian
                </td>
            </tr>
            <tr class="item">
                <td>
                    1. Dasar Diagnosis
                </td>                
                <td>
                    @foreach($jenazah['nama_diagnosis'] as $namanya)
                    <li>{{$namanya}}</li>
                    @endforeach
                </td>
            </tr>
            <tr class="item">
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