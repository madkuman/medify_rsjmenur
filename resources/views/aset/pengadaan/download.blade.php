<!DOCTYPE html>
<html>
<body>
<table>
    <tr>
        <td colspan="3">
            <h2 align="left"><strong>PENGADAAN {{$transaction->kode}}</strong></h2>
        </td>
    </tr>
    <tr>
        <td colspan="3">
            <label>PENYEDIA</label>
            <h3 class="text-primary">@if($transaction->supplier){{$transaction->supplier->name_perusahaan}} @endif</h3>
            <label>TANGGAL TRANSAKSI</label>
            <h3>{{indonesian_date($transaction->date)}}</h3>
            <label>TOTAL TRANSAKSI</label>
            <h3>{{  formatCurrency($transaction->total_price) }}</h3>
        </td>
    </tr>
    <tr>
        <th>ID</th>
        <th>Barang</th>
        <th>Jumlah</th>
        <th>Harga Satuan</th>
        <th>Subtotal</th>
    </tr>
    <?php
    $transactions = json_decode($transaction->json,true);
    ?>
    @if($transaction->json==NULL|$transaction->json==""|| sizeof($transactions)==0)
    @else
        @foreach($transactions as $key => $list_transaction)
            <tr>
                <td>{{$list_transaction['id_template']}}</td>
                <td>{{$list_transaction['nama_template']}}</td>
                <td>{{$list_transaction['jumlah']}}</td>
                <td>{{formatCurrency($list_transaction['harga_satuan'])}}</td>
                <td>{{formatCurrency($list_transaction['subtotal'])}}</td>
            </tr>
        @endforeach
    @endif
</table>
</body>
</html>