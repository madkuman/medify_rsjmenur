<tr>
    <td>{{ $loop->iteration }}</td>
    <td>
        @if ($item->tipe)
            <b>{{ $item->tipe_racikan->nama ?? 'Racikan' }}:</b>
        @endif
        {{ $item->nama_obat }}
    </td>
    <td style="background-color: #CAEDFF">
        @if ($item->tipe)

        @else
            {{ $item_final->nama_obat }}
        @endif
    </td>
    <td style="white-space: nowrap">
        {{ $item->jumlah }}
        @if (count($transaksi->copy_resep) != 0)
            <br>
            <b>Jumlah Awal: {{$item_final->jumlah_awal}}</b>
            <br>
            <b>Jumlah Diambil: {{$item_final->attr_info_copy_resep->jumlah_diambil }}</b>
            <br>
            <b>Jumlah Dilayani: {{$item_final->attr_info_copy_resep->jumlah_dilayani }}</b>
        @endif
    </td>
    <td style="white-space: nowrap; background-color: #CAEDFF">
        {{ $item_final->jumlah }}
        @if ($transaksi->attr_is_harian)
            <br>(7 Hari: {{ $item_final->hari7 }}, 23 Hari: {{ $item_final->hari23}}, Duk RS: {{ $item_final->dukunganrs }})
        @endif
        @if (count($transaksi->copy_resep) != 0)
            <br>
            <b>Jumlah Awal: {{$item_final->jumlah_awal}}</b>
            <br>
            <b>Jumlah Diambil: {{$item_final->attr_info_copy_resep->jumlah_diambil }}</b>
            <br>
            <b>Jumlah Dilayani: {{$item_final->attr_info_copy_resep->jumlah_dilayani }}</b>
        @endif
    </td>
    <td>{{ $item->aturan }}</td>
    <td style="background-color: #CAEDFF">{{ $item_final->aturan }}</td>
    <td style="background-color: #CAEDFF">{{ !empty($item_final) ? $item_final->aturan_per_jam_1 : '' }}</td>
    <td style="background-color: #CAEDFF">{{ !empty($item_final) ? $item_final->aturan_per_jam_2 : '' }}</td>
    <td style="background-color: #CAEDFF">{{ !empty($item_final) ? $item_final->aturan_per_jam_3 : '' }}</td>
    <td style="background-color: #CAEDFF">{{ !empty($item_final) ? $item_final->aturan_per_jam_4 : '' }}</td>
    <td style="background-color: #CAEDFF">{{ !empty($item_final) ? $item_final->aturan_per_jam_5 : '' }}</td>
    <td style="background-color: #CAEDFF">{{ $item_final->default_petunjuk_minum }}</td>
    <td style="background-color: #CAEDFF">{{ $item_final->default_catatan }}</td>
    <td>{{ formatCurrency($item_final->harga, '') }}</td>
    <td>{{ formatCurrency($item_final->subtotal, '') }}</td>
</tr>
@if ($item->tipe)
    @foreach ($item_final->racikan ?? $item->racikan ?? [] as $item_racikan)
        @include('farmasi.transaksi.components.kategori-resep-default-table-sudah-dikonfirmasi-row-racikan', ['index' => $index, 'racikan_index' => $loop->index, 'item_racikan' => $item_racikan])
    @endforeach
@endif