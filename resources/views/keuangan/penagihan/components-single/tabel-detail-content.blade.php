<tr class="table-primary">
    <td colspan="7" class="text-left">
        {{$kategori}}
    </td>
</tr>
@foreach($piutang_detail as $item)
    <tr>
        <td class="text-center">{{++$count}}</td>
        <td>
            <p class="font-w600 mb-5">{{$item->deskripsi}}</p>

            @if (!empty($item->tarif_tipe_id))
            @if($item->tipe->slug == 'cito')
            <div class="text-muted">{{$item->tipe->nama}}</div>
            @endif
            @else
            @endif
            <div class="text-muted">{{$item->keterangan}}</div>
        </td>
        <td class="text-center">
            @if (!empty($item->kelas))
            {{$item->kelas->nama}}
            @else
            -
            @endif
        </td>
        <td class="text-center">
            <span class="badge badge-pill badge-primary">{{$item->jumlah}}</span>
        </td>
        <td class="text-right">Rp {{number_format($item->harga,0)}}</td>
        <td class="text-center">
            Rp {{number_format($item->diskon,0)}}
        </td>
        <td class="text-right">Rp {{number_format($item->subtotal)}}</td>
    </tr>
@endforeach