<br>
<div style="text-align: left">
    <strong>TELAAH OBAT</strong>
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
        <td>Nama Pasien</td>
        <td class="bordered text-center">
            @if($transaksi->lima_benar_pasien == '1' || empty($transaksi->lima_benar_at))
            X
            @endif
        </td>
        <td class="bordered text-center">
            @if($transaksi->lima_benar_pasien != 1 && !empty($transaksi->lima_benar_at))
            X
            @endif
        </td>
    </tr>
    <tr>
        <td>Nama Obat</td>
        <td class="bordered text-center">
            @if($transaksi->lima_benar_obat == '1' || empty($transaksi->lima_benar_at))
            X
            @endif
        </td>
        <td class="bordered text-center">
            @if($transaksi->lima_benar_obat != 1 && !empty($transaksi->lima_benar_at))
            X
            @endif
        </td>
    </tr>
    <tr>
        <td>Dosis, Bentuk, Kekuatan Sediaan</td>
        <td class="bordered text-center">
            @if($transaksi->lima_benar_dosis == '1' || empty($transaksi->lima_benar_at))
            X
            @endif
        </td>
        <td class="bordered text-center">
            @if($transaksi->lima_benar_dosis != 1 && !empty($transaksi->lima_benar_at))
            X
            @endif
        </td>
    </tr>
    <tr>
        <td>Rute Pemberian</td>
        <td class="bordered text-center">
            @if($transaksi->lima_benar_aturan == '1' || empty($transaksi->lima_benar_at))
            X
            @endif
        </td>
        <td class="bordered text-center">
            @if($transaksi->lima_benar_aturan != 1 && !empty($transaksi->lima_benar_at))
            X
            @endif
        </td>
    </tr>
    <tr>
        <td>Waktu Frekuensi Aturan Pakai</td>
        <td class="bordered text-center">
            @if($transaksi->lima_benar_waktu == '1' || empty($transaksi->lima_benar_at))
            X
            @endif
        </td>
        <td class="bordered text-center">
            @if($transaksi->lima_benar_waktu != 1 && !empty($transaksi->lima_benar_at))
            X
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
            @if(!empty($transaksi->lima_benar_created_by) && !empty($transaksi->lima_benar_creator->ttd))
            <img src="{{{url('')}}}/{{$transaksi->lima_benar_creator->ttd}}" height="30px">
            @else
            <div style="height: 30px"></div>
            @endif
        </td>
    </tr>
    <tr>
        <td style="text-align: center" colspan="3">
            @if(!empty($transaksi->lima_benar_created_by))
            (  {{$transaksi->lima_benar_creator->name}}  )
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