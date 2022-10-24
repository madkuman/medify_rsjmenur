<tr>
    <td colspan="7" class="text-center">
        <hr>
        {{$kategori}}
        <hr>
    </td>
</tr>

@foreach($item_pertanggal as $tanggal => $items)
<tr>
    <td colspan="7" class="text-left" style="padding-top: 20px;">
        {{$tanggal}}
    </td>
</tr>

@foreach($items as $item)
<tr>
    <td class="text-center"><ul><li></li></ul></td>
    <td>
        {{$item->deskripsi}} - ({{$item->tipe->nama ?? '-'}})
    </td>
    <td class="text-right">Rp</td>
    <td class="text-right">{{number_format($item->harga,0)}}</td>
    <td  class="text-center">
        {{$item->jumlah}}
    </td>
    <td class="text-right">Rp</td>
    <td class="text-right">{{number_format($item->subtotal)}}</td>
</tr>
@endforeach
@endforeach