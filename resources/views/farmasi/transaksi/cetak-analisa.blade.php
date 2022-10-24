<!DOCTYPE html>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<head>
    <title>
        Analisa Resep
    </title>
    <style>
    table {
        border-collapse: collapse;
    }

    thead:before,
    thead:after {
        display: none;
    }

    tbody:before,
    tbody:after {
        display: none;
    }

    .bordered {
        border: 1px solid black;
    }
    .checklist-container
    {
        font-family: ZapfDingbats, sans-serif; 
        font-size: 7
    }
    .text-center
    {
        text-align: center;
    }
</style>
</head>

<body>
    <div class="page-header text-center" style="text-align: center; margin-top: 50px;">
        <b>PENGKAJIAN RESEP</b>
    </div>
    <br>
    <table style="width: 100vw; font-size: 13px">
        <tr>
            <td style="width: 22%; border: 1px"></td>
            <td style="width: 26%; border: 1px">Nama</td>
            <td style="width: 1%; border: 1px">:</td>
            <td style="width: 29%; border: 1px">{{$transaksi->pasien_detail ? $transaksi->pasien_detail->name : $transaksi->nama_pasien}}</td>
            <td style="width: 22%; border: 1px"></td>
        </tr>
        <tr>
            <td></td>
            <td>Umur/Tanggal Lahir</td>
            <td>:</td>
            <td>
                {{$transaksi->pasien_detail ? $transaksi->pasien_detail->detailed_age : "-"}}/{{$transaksi->pasien_detail ? date("j F, Y", strtotime($transaksi->pasien_detail->date_of_birth)) : "-"}}
            </td>
            <td></td>
        </tr>
    </table>
    <table style="width: 100vw; font-size: 13px">
        <tr>
            <td style="width: 12%"></td>
            <td style="width: 1%"></td>
            <td></td>
            <td style="width: 8%; text-align: center;">ADA</td>
            <td style="width: 4%"></td>
            <td style="width: 8%; text-align: center;">TIDAK</td>
            <td style="width: 12%"></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td><strong>SYARAT ADMINISTRASI</strong></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>1. SEP</td>
            <td class="bordered text-center">
                @if($transaksi->analisa_resep_sep == '1') 
                    <div class="checklist-container">4</div>
                @endif
            </td>
            <td></td>
            <td class="bordered text-center">
                @if($transaksi->analisa_resep_sep != 1) 
                    <div class="checklist-container">4</div>
                @endif
            </td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>2. Fotokopi Kartu</td>
            <td class="bordered text-center">
                @if($transaksi->analisa_resep_fotokopi_kartu == '1') 
                    <div class="checklist-container">4</div>
                @endif
            </td>
            <td></td>
            <td class="bordered text-center">
                @if($transaksi->analisa_resep_fotokopi_kartu != 1) 
                    <div class="checklist-container">4</div>
                @endif
            </td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>3. Identitas Pasien (Nama, Domisili, Tgl Lahir)</td>
            <td class="bordered text-center">
                @if($transaksi->analisa_resep_identitas_pasien == '1') 
                    <div class="checklist-container">4</div>
                @endif
            </td>
            <td></td>
            <td class="bordered text-center">
                @if($transaksi->analisa_resep_identitas_pasien != 1) 
                    <div class="checklist-container">4</div>
                @endif
            </td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>4. Paraf Dokter</td>
            <td class="bordered text-center">
                @if($transaksi->analisa_resep_paraf_dokter == '1') 
                    <div class="checklist-container">4</div>
                @endif
            </td>
            <td></td>
            <td class="bordered text-center">
                @if($transaksi->analisa_resep_paraf_dokter != 1) 
                    <div class="checklist-container">4</div>
                @endif
            </td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td><strong>ASPEK FARMASTETIK</strong></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>5. Nama, Bentuk, Kekuatan</td>
            <td class="bordered text-center">
                @if($transaksi->analisa_resep_nama_obat == '1') 
                    <div class="checklist-container">4</div>
                @endif
            </td>
            <td></td>
            <td class="bordered text-center">
                @if($transaksi->analisa_resep_nama_obat != 1) 
                    <div class="checklist-container">4</div>
                @endif
            </td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>6. Jumlah Obat</td>
            <td class="bordered text-center">
                @if($transaksi->analisa_resep_jumlah_obat == '1') 
                    <div class="checklist-container">4</div>
                @endif
            </td>
            <td></td>
            <td class="bordered text-center">
                @if($transaksi->analisa_resep_jumlah_obat != 1) 
                    <div class="checklist-container">4</div>
                @endif
            </td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>7. Signa / Aturan Pakai</td>
            <td class="bordered text-center">
                @if($transaksi->analisa_resep_signa_obat == '1') 
                    <div class="checklist-container">4</div>
                @endif
            </td>
            <td></td>
            <td class="bordered text-center">
                @if($transaksi->analisa_resep_signa_obat != 1) 
                    <div class="checklist-container">4</div>
                @endif
            </td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td><strong>ASPEK KLINIS</strong></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>8. Tepat Indikasi</td>
            <td class="bordered text-center">
                @if($transaksi->analisa_resep_tepat_indikasi == '1') 
                    <div class="checklist-container">4</div>
                @endif
            </td>
            <td></td>
            <td class="bordered text-center">
                @if($transaksi->analisa_resep_tepat_indikasi != 1) 
                    <div class="checklist-container">4</div>
                @endif
            </td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>9. Tepat Dosis</td>
            <td class="bordered text-center">
                @if($transaksi->analisa_resep_tepat_dosis == '1') 
                    <div class="checklist-container">4</div>
                @endif
            </td>
            <td></td>
            <td class="bordered text-center">
                @if($transaksi->analisa_resep_tepat_dosis != 1) 
                    <div class="checklist-container">4</div>
                @endif
            </td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>10. Tepat Rute</td>
            <td class="bordered text-center">
                @if($transaksi->analisa_resep_tepat_rute == '1') 
                    <div class="checklist-container">4</div>
                @endif
            </td>
            <td></td>
            <td class="bordered text-center">
                @if($transaksi->analisa_resep_tepat_rute != 1) 
                    <div class="checklist-container">4</div>
                @endif
            </td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>11. Tepat Waktu</td>
            <td class="bordered text-center">
                @if($transaksi->analisa_resep_tepat_waktu == '1') 
                    <div class="checklist-container">4</div>
                @endif
            </td>
            <td></td>
            <td class="bordered text-center">
                @if($transaksi->analisa_resep_tepat_waktu != 1) 
                    <div class="checklist-container">4</div>
                @endif
            </td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>12. Tidak Duplikasi Terapi</td>
            <td class="bordered text-center">
                @if($transaksi->analisa_resep_duplikasi_terapi == '1') 
                    <div class="checklist-container">4</div>
                @endif
            </td>
            <td></td>
            <td class="bordered text-center">
                @if($transaksi->analisa_resep_duplikasi_terapi != 1) 
                    <div class="checklist-container">4</div>
                @endif
            </td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>13. Tidak Ada Alergi Obat & ROTD</td>
            <td class="bordered text-center">
                @if($transaksi->analisa_resep_alergi_obat == '1') 
                    <div class="checklist-container">4</div>
                @endif
            </td>
            <td></td>
            <td class="bordered text-center">
                @if($transaksi->analisa_resep_alergi_obat != 1) 
                    <div class="checklist-container">4</div>
                @endif
            </td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>14. Tidak Ada Interaksi Obat</td>
            <td class="bordered text-center">
                @if($transaksi->analisa_resep_interaksi_obat == '1') 
                    <div class="checklist-container">4</div>
                @endif
            </td>
            <td></td>
            <td class="bordered text-center">
                @if($transaksi->analisa_resep_interaksi_obat != 1) 
                    <div class="checklist-container">4</div>
                @endif
            </td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>15. Tidak Ada Kontra Indikasi</td>
            <td class="bordered text-center">
                @if($transaksi->analisa_resep_kontra_indikasi == '1') 
                    <div class="checklist-container">4</div>
                @endif
            </td>
            <td></td>
            <td class="bordered text-center">
                @if($transaksi->analisa_resep_kontra_indikasi != 1) 
                    <div class="checklist-container">4</div>
                @endif
            </td>
            <td></td>
        </tr>
    </table>
    <br><br><br>
    <table style="width: 100vw; font-size: 13px">
        <tr>
            <td style="width: 60%"></td>
            <td style="width: 40%; text-align: center;">Paraf Apoteker</td>
        </tr>
        <tr>
            <td style="width: 60%"></td>
            <td style="width: 40%; font-size: 50px; color: white">ajsdnajsd</td>
        </tr>
        <tr>
            <td style="width: 60%"></td>
            @php
            $user = $transaksi->analisa_resep_creator;
            if($user && $user->profesi == 3){
                $nama = $user->name;
            }else{
                $nama = session('farmasi')->kasie;
            }
            @endphp
            <td style="width: 40%; text-align: center;">{{$nama ?? ''}}</td>
        </tr>
    </table>
</body>

