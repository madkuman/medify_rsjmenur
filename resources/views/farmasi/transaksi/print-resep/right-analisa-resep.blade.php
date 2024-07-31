<br>
<div style="text-align: left">
    <strong>TELAAH RESEP</strong>
</div>
<table class="border font-8">
    <tr>
        <td>Kriteria Pengkajian</td>
        <td style="width: 15%; text-align: center;">Ya</td>
        <td style="width: 15%; text-align: center;">Tidak</td>
    </tr>
    <tr>
        <td><strong>SYARAT ADMINISTRASI</strong></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td>SEP</td>
        <td class="bordered text-center">
            @if($transaksi->analisa_resep_sep == '1' || empty($transaksi->analisa_resep_at))
            <span style="font-family: DejaVu Sans, sans-serif;">✔</span>
            @endif
        </td>
        <td class="bordered text-center">
            @if($transaksi->analisa_resep_sep != 1 && !empty($transaksi->analisa_resep_at))
            <span style="font-family: DejaVu Sans, sans-serif;">✔</span>
            @endif
        </td>
    </tr>
    <tr>
        <td>Fotokopi Kartu</td>
        <td class="bordered text-center">
            @if($transaksi->analisa_resep_fotokopi_kartu == '1' || empty($transaksi->analisa_resep_at))
            <span style="font-family: DejaVu Sans, sans-serif;">✔</span>
            @endif
        </td>
        <td class="bordered text-center">
            @if($transaksi->analisa_resep_fotokopi_kartu != 1 && !empty($transaksi->analisa_resep_at))
            <span style="font-family: DejaVu Sans, sans-serif;">✔</span>
            @endif
        </td>
    </tr>
    <tr>
        <td>Identitas Pasien (Nama, Domisili, Tgl Lahir)</td>
        <td class="bordered text-center">
            @if($transaksi->analisa_resep_identitas_pasien == '1' || empty($transaksi->analisa_resep_at))
            <span style="font-family: DejaVu Sans, sans-serif;">✔</span>
            @endif
        </td>
        <td class="bordered text-center">
            @if($transaksi->analisa_resep_identitas_pasien != 1 && !empty($transaksi->analisa_resep_at))
            <span style="font-family: DejaVu Sans, sans-serif;">✔</span>
            @endif
        </td>
    </tr>
    <tr>
        <td>Paraf Dokter</td>
        <td class="bordered text-center">
            @if($transaksi->analisa_resep_paraf_dokter == '1' || empty($transaksi->analisa_resep_at))
            <span style="font-family: DejaVu Sans, sans-serif;">✔</span>
            @endif
        </td>
        <td class="bordered text-center">
            @if($transaksi->analisa_resep_paraf_dokter != 1 && !empty($transaksi->analisa_resep_at))
            <span style="font-family: DejaVu Sans, sans-serif;">✔</span>
            @endif
        </td>
    </tr>
    <tr>
        <td><strong>ASPEK FARMASTETIK</strong></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td>Nama, Bentuk, Kekuatan</td>
        <td class="bordered text-center">
            @if($transaksi->analisa_resep_nama_obat == '1' || empty($transaksi->analisa_resep_at))
            <span style="font-family: DejaVu Sans, sans-serif;">✔</span>
            @endif
        </td>
        <td class="bordered text-center">
            @if($transaksi->analisa_resep_nama_obat != 1 && !empty($transaksi->analisa_resep_at))
            <span style="font-family: DejaVu Sans, sans-serif;">✔</span>
            @endif
        </td>
    </tr>
    <tr>
        <td>Jumlah Obat</td>
        <td class="bordered text-center">
            @if($transaksi->analisa_resep_jumlah_obat == '1' || empty($transaksi->analisa_resep_at))
            <span style="font-family: DejaVu Sans, sans-serif;">✔</span>
            @endif
        </td>
        <td class="bordered text-center">
            @if($transaksi->analisa_resep_jumlah_obat != 1 && !empty($transaksi->analisa_resep_at))
            <span style="font-family: DejaVu Sans, sans-serif;">✔</span>
            @endif
        </td>
    </tr>
    <tr>
        <td>Signa / Aturan Pakai</td>
        <td class="bordered text-center">
            @if($transaksi->analisa_resep_signa_obat == '1' || empty($transaksi->analisa_resep_at))
            <span style="font-family: DejaVu Sans, sans-serif;">✔</span>
            @endif
        </td>
        <td class="bordered text-center">
            @if($transaksi->analisa_resep_signa_obat != 1 && !empty($transaksi->analisa_resep_at))
            <span style="font-family: DejaVu Sans, sans-serif;">✔</span>
            @endif
        </td>
    </tr>
    <tr>
        <td><strong>ASPEK KLINIS</strong></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td>Tepat Indikasi</td>
        <td class="bordered text-center">
            @if($transaksi->analisa_resep_tepat_indikasi == '1' || empty($transaksi->analisa_resep_at))
            <span style="font-family: DejaVu Sans, sans-serif;">✔</span>
            @endif
        </td>
        <td class="bordered text-center">
            @if($transaksi->analisa_resep_tepat_indikasi != 1 && !empty($transaksi->analisa_resep_at))
            <span style="font-family: DejaVu Sans, sans-serif;">✔</span>
            @endif
        </td>
    </tr>
    <tr>
        <td>Tepat Dosis</td>
        <td class="bordered text-center">
            @if($transaksi->analisa_resep_tepat_dosis == '1' || empty($transaksi->analisa_resep_at))
            <span style="font-family: DejaVu Sans, sans-serif;">✔</span>
            @endif
        </td>
        <td class="bordered text-center">
            @if($transaksi->analisa_resep_tepat_dosis != 1 && !empty($transaksi->analisa_resep_at))
            <span style="font-family: DejaVu Sans, sans-serif;">✔</span>
            @endif
        </td>
    </tr>
    <tr>
        <td>Tepat Rute</td>
        <td class="bordered text-center">
            @if($transaksi->analisa_resep_tepat_rute == '1' || empty($transaksi->analisa_resep_at))
            <span style="font-family: DejaVu Sans, sans-serif;">✔</span>
            @endif
        </td>
        <td class="bordered text-center">
            @if($transaksi->analisa_resep_tepat_rute != 1 && !empty($transaksi->analisa_resep_at))
            <span style="font-family: DejaVu Sans, sans-serif;">✔</span>
            @endif
        </td>
    </tr>
    <tr>
        <td>Tepat Waktu</td>
        <td class="bordered text-center">
            @if($transaksi->analisa_resep_tepat_waktu == '1' || empty($transaksi->analisa_resep_at))
            <span style="font-family: DejaVu Sans, sans-serif;">✔</span>
            @endif
        </td>
        <td class="bordered text-center">
            @if($transaksi->analisa_resep_tepat_waktu != 1 && !empty($transaksi->analisa_resep_at))
            <span style="font-family: DejaVu Sans, sans-serif;">✔</span>
            @endif
        </td>
    </tr>
    <tr>
        <td>Tidak Duplikasi Terapi</td>
        <td class="bordered text-center">
            @if($transaksi->analisa_resep_duplikasi_terapi == '1' || empty($transaksi->analisa_resep_at))
            <span style="font-family: DejaVu Sans, sans-serif;">✔</span>
            @endif
        </td>
        <td class="bordered text-center">
            @if($transaksi->analisa_resep_duplikasi_terapi != 1 && !empty($transaksi->analisa_resep_at))
            <span style="font-family: DejaVu Sans, sans-serif;">✔</span>
            @endif
        </td>
    </tr>
    <tr>
        <td>Tidak Ada Alergi Obat & ROTD</td>
        <td class="bordered text-center">
            @if($transaksi->analisa_resep_alergi_obat == '1' || empty($transaksi->analisa_resep_at))
            <span style="font-family: DejaVu Sans, sans-serif;">✔</span>
            @endif
        </td>
        <td class="bordered text-center">
            @if($transaksi->analisa_resep_alergi_obat != 1 && !empty($transaksi->analisa_resep_at))
            <span style="font-family: DejaVu Sans, sans-serif;">✔</span>
            @endif
        </td>
    </tr>
    <tr>
        <td>Tidak Ada Interaksi Obat</td>
        <td class="bordered text-center">
            @if($transaksi->analisa_resep_interaksi_obat == '1' || empty($transaksi->analisa_resep_at))
            <span style="font-family: DejaVu Sans, sans-serif;">✔</span>
            @endif
        </td>
        <td class="bordered text-center">
            @if($transaksi->analisa_resep_interaksi_obat != 1 && !empty($transaksi->analisa_resep_at))
            <span style="font-family: DejaVu Sans, sans-serif;">✔</span>
            @endif
        </td>
    </tr>
    <tr>
        <td>Tidak Ada Kontra Indikasi</td>
        <td class="bordered text-center">
            @if($transaksi->analisa_resep_kontra_indikasi == '1' || empty($transaksi->analisa_resep_at))
            <span style="font-family: DejaVu Sans, sans-serif;">✔</span>
            @endif
        </td>
        <td class="bordered text-center">
            @if($transaksi->analisa_resep_kontra_indikasi != 1 && !empty($transaksi->analisa_resep_at))
            <span style="font-family: DejaVu Sans, sans-serif;">✔</span>
            @endif
        </td>
    </tr>
</table>
<table>
    <tr>
        <td style="width: 55%;text-align: center" colspan="3">
            Penelaah
        </td>
    </tr>
    <tr>
        <td style="text-align: center" colspan="3">
            @if(!empty($transaksi->analisa_resep_by) && !empty($transaksi->analisa_resep_creator->ttd))
            <img src="{{{url('')}}}/{{$transaksi->analisa_resep_creator->ttd}}" height="30px">
            @else
            <div style="height: 30px"></div>
            @endif
        </td>
    </tr>
    <tr>
        <td style="text-align: center" colspan="3">
            @if(!empty($transaksi->analisa_resep_by))
            (  {{$transaksi->analisa_resep_creator->name}}  )
            @else
            (  ........................  )
            @endif
        </td>
    </tr>
    <tr>
        <td style="text-align: center" colspan="3">
            Nama Terang
        </td>
    </tr>
</table>