<div>
    <table class="font-8">
        <tr>
            <td style="width: 30%;">No. Asuransi</td>
            <td>:</td>
            <td>
                {{ $transaksi->pembayaran_detail->no_asuransi ?? '-' }}
            </td>
        </tr>
        <tr>
            <td style="width: 30%;">SEP</td>
            <td>:</td>
            <td>
                {{ $transaksi->kasus->sep->no_sep ?? '-' }}
            </td>
        </tr>
    </table>
</div>
