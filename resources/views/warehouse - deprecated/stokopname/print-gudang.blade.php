<!DOCTYPE html>
<html>
<head>
    <title>Print Stok Opname - Gudang</title>

    <style type="text/css">
    body{
        font-family: sans-serif;
    }
    table{
        width: 100%;
        border-collapse: collapse;
    }
    .bordered td{
        border: 1px solid black;
    }
    .bordered th{
        border: 1px solid black;
    }
    .centered{
        text-align: center;
    }
    .title{
        font-weight: bold;
        text-align: center; 
    }
    td, th{
        padding-left: 10px;
        padding-right: 10px;
    }
    .righted{
        text-align: right;
    }
    .abs-left{
        float: left !important;
        width: 10%;
    }
    .abs-right{
        float: right !important;
        width: 90%;
    }
    .dummy{
        font-size: 20px;
        color: white;
    }

</style>
</head>
<body>
    <table>
        <tr>
            <td class="title">Laporan Stok Opname #{{$stokopname->slug}}</td>
        </tr>
        <tr>
            <td class="centered">Dibuat Oleh {{$stokopname->created_by_detail->name}}</td>
        </tr>
    </table>
    <br><br><br>
    <table class="bordered">
        <thead>
            <tr>
                <th width="7%">No</th>
                <th width="16%">Nama Material</th>
                <th width="9%">Satuan</th>
                <th width="13%">Harga Satuan</th>
                <th width="11%">Jumlah</th>
                <th width="20%">ED</th>
                <th width="8%">Ket</th>
                <th width="16%">Harga Total</th>
            </tr>
        </thead>
        <tbody>
            @php $i=1; $total = 0;@endphp
            @forelse($barang as $row)
                @if($row['sebenarnya'] == 0)
                    @continue
                @endif
            <tr>
                <td>{{$i}}</td>
                <td>{{$row['nama']}}</td>
                <td>{{$row['satuan']}}</td>
                <td class="righted">{{$row['harga']}}</td>
                <td>{{$row['sebenarnya']}}</td>
                <td>{{date('d F Y', strtotime($row['kadaluarsa']))}}</td>
                <td>{{$row['keterangan']}}</td>
                <td class="righted">{{$row['sebenarnya'] * $row['harga']}}</td>
                @php $i++; $total+= ($row['sebenarnya'] * $row['harga'])@endphp
            </tr>
            @empty
            <tr>
                <td class="centered" colspan="8" style="line-height: 3">Belum Ada Barang</td>
            </tr>
            @endforelse
            <tr>
                <th class="righted" colspan="7">Total</td>
                <th class="righted" style="padding-left: 0px;">{{$total}}</td>
            </tr>
        </tbody>
    </table>
    <br>
    <table>
        <tr>
            <td class="centered" width="40%">Mengetahui</td>
            <td class="centered" width="20%"></td>
            <td class="centered" width="40%"></td>
        </tr>
        <tr>
            <td class="centered">a.n Kepala {{config('app.name')}}</td>
            <td class="centered"></td>
            <td class="centered">Surabaya, {{date("d F Y")}}</td>
        </tr>
        <tr>
            <td class="centered">Wakabin</td>
            <td class="centered"></td>
            <td class="centered">Kepala Departmen Farmasi</td>
        </tr>
        <tr>
            <td class="dummy" colspan="3">dummy</td>
        </tr>
    </table>
</body>
</html>