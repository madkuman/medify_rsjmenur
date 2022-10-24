<tr class="table-primary">
    <td colspan="7" class="text-left" style="text-transform: uppercase;">
        {{$kategori}}
    </td>
</tr>

@foreach($pemasukan_detail as $item)
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