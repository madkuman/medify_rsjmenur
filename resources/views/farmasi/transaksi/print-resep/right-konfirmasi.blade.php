<br>
<div style="text-align: left">
    <strong style="font-size: 8px;">KONFIRMASI RESEP / TINDAK LANJUT</strong>
</div>
<div style="width: 100%; height: 82px;border:solid 1px #000">
    <table class="font-8">
        <tr>
            <td style="width: 30%;">Petugas :</td>
            <td>
                {{$transaksi->analisa_resep_creator->name ?? ''}}
            </td>

        </tr>
        <tr>
            <td style="width: 30%;">Tgl / Jam :</td>
            <td>
                @if(!empty($transaksi->dikerjakan_at))
                {{$transaksi->dikerjakan_at->format('d-m-Y H:i')}}
                @endif
            </td>
        </tr>
        <tr><td colspan="2" style="font-size: 5pt">{{substr($transaksi->tindak_lanjut, 0, 120)}}</td></tr>
        <tr>
            <td></td>
            <td style="text-align: right">Acc Dokter</td>
        </tr>
        <tr>
            <td></td>
            <td style="text-align: right">
                @if(!empty($dokter_ttd))
                    <img src="{{ public_path($dokter_ttd) }}" height="20px" style="text-align: right">
                @else
                    <div style="height: 10px; text-align: right"></div>
                @endif
            </td>
        </tr>
    </table>
</div>