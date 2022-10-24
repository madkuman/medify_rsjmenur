<!DOCTYPE html>
<html>
<head>
	<title>Faktur Masuk Gudang Farmasi</title>
    <style type="text/css">
    body{
        font-family: sans-serif;
    }
    table{
        width: 100%;
        border-collapse: collapse;
    }
    .bordered, .bordered td, .bordered th {
        border: 1px solid #000;
        border-collapse: collapse;
    }
    .bordered td, .bordered th {
        padding: 2px 4px 2px 4px;
    }
    .centered{
        text-align: center;
    }
    .big{
        font-size: 18px;
        text-transform: uppercase;
        font-weight: 600;
    }
    .big2{
        font-size: 16px;
        font-weight: 600;
    }
    .righted{
        text-align: right;
    }
    .un-top td{
        border-top: 1px solid white !important;
    }
    .un-bot td{
        border-bottom: 1px solid white !important;
    }
    .un-top-bot td{
        border-top: 1px solid white !important;
        border-bottom: 1px solid white !important;
    }
</style>
</head>
<body>
    <table>
        <tr>
            <td class="centered big"><b>Faktur Masuk Gudang Farmasi</b></td>
        </tr>
        <tr>
            <td class="centered big2">{{indonesian_date($min_date)}} - {{indonesian_date($max_date)}}</td>
        </tr>
    </table>
    <br>
    <table class="bordered">
        <thead>
            <tr>
                <th class="centered" width="10%">No / Tgl SP</th>
                <th class="centered" width="10%">No / Tgl Faktur</th>
                <th class="centered" width="10%">Distributor</th>
                <th class="centered" width="5%">No</th>
                <th class="centered" width="15%">Nama Barang</th>
                <th class="centered" width="5%">Satuan</th>
                <th class="centered" width="10%">Jumlah</th>
                <th class="centered" width="15%">Harga Sat +PPN +Disc</th>
                <th class="centered" width="10%">Jumlah Harga</th>
                <th class="centered" width="10%">Nilai Faktur</th>
            </tr>
        </thead>
        <tbody>
            @php($total =0)
            @foreach($pengadaans as $pengadaan)
            <!-- ROW PERTAMA -->
            <tr class="@if(count($pengadaan->log)>1) un-bot @endif">
                <td>
                    {{$pengadaan->nomor_surat_jalan}}<br>
                    @if(isset($pengadaan->tanggal_surat_jalan) && substr($pengadaan->tanggal_surat_jalan, 0, 10) != "1970-01-01")
                    {{indonesian_date($pengadaan->tanggal_surat_jalan)}}
                    @endif
                </td>
                <td>
                    {{$pengadaan->nomor_referensi}}<br>
                    @if(isset($pengadaan->tanggal_faktur) && substr($pengadaan->tanggal_tanggal_faktur, 0, 10) != "1970-01-01")
                    {{indonesian_date($pengadaan->tanggal_faktur)}}
                    @endif
                </td>
                <td>
                    {{$pengadaan->supplier_detail->nama}}
                </td>
                <td class="centered">
                    @foreach($pengadaan->log as $log)
                    @if($loop->iteration == 1) {{$loop->iteration}} @endif
                    @endforeach
                </td>
                <td>
                    @foreach($pengadaan->log as $log)
                    @if($loop->iteration == 1) {{$log->detail_item->detail_item->nama}} @endif
                    @endforeach
                </td>
                <td>
                    @foreach($pengadaan->log as $log)
                    @if($loop->iteration == 1) {{$log->detail_item->detail_item->satuan}} @endif
                    @endforeach
                </td>
                <td class="righted">
                    @foreach($pengadaan->log as $log)
                    @if($loop->iteration == 1) {{$log->jumlah}} @endif
                    @endforeach
                </td>
                <td class="righted">
                    @foreach($pengadaan->log as $log)
                    @if($loop->iteration == 1) {{number_format($log->harga_saat_itu)}} @endif
                    @endforeach
                </td>
                <td class="righted">
                    @foreach($pengadaan->log as $log)
                    @if($loop->iteration == 1) {{number_format($log->subtotal)}} @endif
                    @endforeach
                </td>
                <td class="righted">
                    {{number_format($pengadaan->total_harga)}}
                    @php($total += $pengadaan->total_harga)
                </td>
            </tr>
            <!-- ROW KEDUA DAN SETERUSNYA -->
            @if(count($pengadaan->log)>1)
            @foreach($pengadaan->log as $log)
            @if($loop->iteration != 1)
            <tr class="@if($loop->iteration == count($pengadaan->log)) un-top @else un-top-bot @endif">
                <td></td>
                <td></td>
                <td></td>
                <td class="centered">
                    {{$loop->iteration}}
                </td>
                <td>
                    {{$log->detail_item->detail_item->nama}}
                </td>
                <td>
                    {{$log->detail_item->detail_item->satuan}}
                </td>
                <td class="righted">
                    {{$log->jumlah}}
                </td>
                <td class="righted">
                    {{number_format($log->harga_saat_itu)}}
                </td>
                <td class="righted">
                    {{number_format($log->subtotal)}}
                </td>
                <td class="righted"></td>
            </tr>
            @endif
            @endforeach
            @endif
            @endforeach
            <tr>
                <td colspan="9" class="righted">TOTAL</td>
                <td class="righted">{{number_format($total)}}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>