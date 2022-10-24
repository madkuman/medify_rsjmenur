<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Laporan Pengeluaran Obat</title>
  <style>
  body { 
    font-family: sans-serif; 
    color: black 
}
.content {
    margin-left: 30px;
}
.rs-title { 
    font-size: 13px;
    border-bottom: 1px solid black;       
}
.text-center {
    text-align: center !important;
}
.text-small {
    font-size: 13px;
}
.box-title {
    width: 250px;
    /*background-color: red;*/
}
.box-header-title {
    /*background-color: red;*/
}
.mt-25 {
    margin-top:25px;
}
.mt-10 {
    margin-top:10px;
}
.header-title {
    font-size: 15px;
}
.table {
    width: 100%;
    max-width: 100%;
    border-collapse: collapse;
}
.table-bordered, .table-bordered td, .table-bordered th {
    border: 1px solid #000;
}
.table-bordered td {
    padding: 2px 3px 2px 3px;
    font-weight: normal;
}
.table-bordered .bt-white {
    border-bottom: 1px solid #fff !important;
}
.text-right{
    text-align: right;
}
</style>
</head>
<body>
    <div class="box-title">
        <div class="rs-title text-center">
            {{config('app.name')}} <br> DEPARTEMEN FARMASI <br> {{session('farmasi')->sluger}}
        </div>
    </div>
    <div class="mt-25">
        <div class="text-center header-title">
            <b>LAPORAN PENJUALAN OBAT {{session('farmasi')->sluger}}</b>
        </div>
    </div>
    <div class="mt-10">
        <table class="text-small">
            <tr>
                <td>Tanggal</td>
                <td>:</td>
                <td>{{$min_date}} sampai {{$max_date}}</td>
            </tr>
            <tr>
                <td>Shift</td>
                <td>:</td>
                <td>
                    @foreach($shift as $item)
                        {{$item->nama}}
                        @if(!$loop->last), @endif
                    @endforeach
                </td>
            </tr>
        </table>
    </div>
    <div class="mt-10">
        <table class="table table-bordered text-small">
            <thead>
                <tr>
                    <th align="center" width="7%">NO.</th>
                    <th align="center" width="15%">NO RESEP</th>
                    <th align="center" width="18%">NAMA PASIEN</th>
                    <th align="center" width="20%">JENIS PASIEN</th>
                    <th align="center" width="10%">BIAYA OBAT</th>
                    <th align="center" width="10%">EMBALASE</th>
                    <th align="center" width="10%">TOTAL</th>
                </tr>
            </thead>
            <tbody>
                @php $total_final = 0; $current_huruf=""; $subtotal=0; @endphp
                @foreach($transaksi as $trans)
                    @if($current_huruf != $trans['nomor_resep_huruf'] && $loop->iteration != 1)
                <tr style="border-left: 0;">
                    <td colspan="6" class="text-right" style="border-left: 0;"><b>SUBTOTAL {{$current_huruf}}</b></td>
                    <td class="text-right">Rp {{number_format($subtotal,0)}}</td>
                </tr>
                    @php $current_huruf = $trans['nomor_resep_huruf']; $subtotal = 0;@endphp
                    @endif
                    @php $subtotal += $trans['total_biaya_obat'];@endphp
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$trans['nomor_resep']}}</td>
                    <td>{{$trans['nama_pasien']}}</td>
                    <td>{{$trans['jenis_pasien']}}</td>
                    <td class="text-right">Rp {{number_format($trans['biaya_obat'])}}</td>
                    <td class="text-right">Rp {{number_format($trans['embalase'])}}</td>
                    <td class="text-right">Rp {{number_format($trans['total_biaya_obat'])}}
                        @php $total_final += $trans['total_biaya_obat'] @endphp
                    </td>
                </tr>
                @endforeach
                 <tr style="border-left: 0;">
                    <td colspan="6" class="text-right" style="border-left: 0;"><b>SUBTOTAL {{$current_huruf}}</b></td>
                    <td class="text-right">Rp {{number_format($subtotal,0)}}</td>
                </tr>
                <tr>
                    <td colspan="6" class="text-right"><b>TOTAL </b></td>
                    <td class="text-right">Rp {{number_format($total_final,0)}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html> 