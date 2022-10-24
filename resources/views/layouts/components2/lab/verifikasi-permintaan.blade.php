<table class="table table-bordered">
    <thead>
        <tr>
            <th class="text-center" style="width: 60px;"></th>
            <th>Layanan</th>
            <th class="text-right" style="width: 200px;">Total Harga</th>
        </tr>
    </thead>
    <tbody>

        @php $count = 1 @endphp
        @php $total_biaya = 0 @endphp
        @foreach($transaksi->detail as $detail)
        <tr>
            <td class="text-center">{{$count++}}</td>
            <td>

            <p class="font-w600 mb-5">{{$detail->tarif->deskripsi}}</p>
            </td>
            <td class="text-right">
                <?php 
                    $temp = $detail->harga;
                 ?>
                <span style='float:left'>Rp</span>{{number_format($temp, 0)}}
            </td>
            @php $total_biaya += $temp @endphp
        </tr>
        @endforeach
        <tr class="table-warning">
            <td colspan="2" class="font-w700 text-uppercase text-right">Total</td>
            <td class="font-w700 text-right"><span style="float:left">Rp</span>  
            {{number_format($total_biaya,0)}}</td>
        </tr>
    </tbody>
</table>

<hr>
<p class="h6 my-0">KLINIS</p>
<div style="margin-bottom: 20px;">
{{$transaksi->keterangan}}
<p class="h6 my-0">KETERANGAN PERMINTAAN</p>
<div style="margin-bottom: 20px;">
{{$transaksi->keterangan_permintaan}}
<br><br>
</div>
