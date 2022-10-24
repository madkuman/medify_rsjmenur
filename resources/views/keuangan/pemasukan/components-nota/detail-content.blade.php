<tr class="table-primary pemasukan-hide">
    <td colspan="5" class="text-left" style="text-transform: uppercase;">
        {{$kategori}}
    </td>
</tr>

@foreach($pemasukan_detail as $item)
<tr>
    <td class="text-center">{{++$count}}</td>
    <td>
        {{$item->deskripsi}}
        @if(!empty($item->tipe->nama) || !empty($item->kelas->nama)) 
        ({{$item->tipe->nama ?? ''}}  
        Kelas {{$item->kelas->nama ?? '-'}})
        @endif
    </td>
    <td class="text-right pemasukan-hide">Rp {{number_format($item->harga,0)}}</td>
    <td class="text-right f-13 pemasukan-show" style="display: none">{{number_format($item->subtotal)}}</td>
    <td class="text-center pemasukan-hide">
        {{$item->jumlah}}
    </td>
    <td class="text-right pemasukan-hide">Rp {{number_format($item->subtotal)}}</td>
</tr>
@endforeach