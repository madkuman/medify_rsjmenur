<!DOCTYPE html>
<html>
<head>
    <title>Review Stok Opname #{{$stokopname->slug}}</title>
    <style type="text/css">
        table{
            width: 100%;
            border-collapse: collapse;
        }
        table td, table th{
            border:solid 1px #000;
            padding:3px;
        }
        .text-right
        {
            text-align: right
        }
        .text-center
        {
            text-align: center
        }
    </style>
</head>
<body>
    <h3 class="block-title" style="text-align: center; font-weight: bold;">Review Stok Opname #{{$stokopname->slug}}</h3>
    <hr class="my-5">
    <table>
        <tr>
            <th style="width: 4%">No</th>
            <th>Barang</th>
            <th style="width: 12.5%">Kadaluarsa</th>
            <th style="width: 12.5%">Stok Sistem</th>
            <th style="width: 12.5%">Stok SO</th>
            <th style="width: 12.5%">Perbedaan</th>
            <th style="width: 7.5%">Harga</th>
            <th style="width: 15%">Nilai Beda</th>
        </tr>
        @php $count = 1 @endphp
        @php $total = 0 @endphp
        
        @foreach($barang as $row)
        @if($row['tercatat'] == 0 && $row['sebenarnya'] == 0 && $row['beda'] == 0) 
            @php $print = 0 @endphp 
        @else
            @php $print = 1 @endphp 
        @endif

        @if($print)
        <tr>
            <td class="text-center">{{$count++}}</td>
            <td>{{$row['nama']}}</td>
            <td class="text-center">{{$row["kadaluarsa"]->format('d F Y')}}</td>
            <td class="text-right">{{number_format($row['tercatat'])}}</td>
            <td class="text-right">{{number_format($row['sebenarnya'])}}</td>
            <td class="text-right">{{number_format($row['beda'])}}</td>
            <td class="text-right">{{number_format($row['harga'])}}</td>
            <td class="text-right">{{number_format($row['beda']*$row['harga'])}}</td>
        </tr>
        @php $total += $row['beda']*$row['harga'] @endphp
        @endif
        @endforeach
        <tr>
            <td colspan="7">Total</td>
            <td class="text-right">{{number_format($total)}}</td>
        </tr>
    </table>
</body>
</html>