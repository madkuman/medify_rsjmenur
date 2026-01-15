<!DOCTYPE html>
<html>
<head>
    <style>
        table td{
            border: solid 1px black;
        }
        </style>
</head>
<body>
    @php $total_col = 16 @endphp
    <table>
        <tr>
            <td  colspan="{{$total_col}}">Laporan Transaksi Farmasi</td>
        </tr>
        <tr>
            <td  colspan="{{$total_col}}">Periode : {{indonesian_date($tanggal_awal)}} - {{indonesian_date($tanggal_akhir)}}</td>
        </tr>
        <tr>
            <td  colspan="{{$total_col}}">Farmasi : {{$farmasi_names}}</td>
        </tr>
        <tr>
            <td  colspan="{{$total_col}}">Asal Pelayanan : {{$lokasi_names}}</td>
        </tr>
        <tr>
            <td  colspan="{{$total_col}}">Jenis Resep : {{$jenis_resep_name}}</td>
        </tr>
        <tr>
            <td  colspan="{{$total_col}}">Asuransi : {{$asuransi_names}}</td>
        </tr>
        <tr>
            <td  colspan="{{$total_col}}">Kategori Barang : {{$kategori_names}}</td>
        </tr>
        <tr>
            <td  colspan="{{$total_col}}">No RM : {{$no_rm}}</td>
        </tr>
        
        <tr>
            <td></td>
        </tr>
        <tr>
            <td rowspan="2">No</td>
            <td rowspan="2">Dokter</td>
            <td rowspan="2">No RM</td>
            <td rowspan="2">Asal</td>
            <td rowspan="2">Status</td>
            <td rowspan="2">Resep</td>
            <td colspan="3">Resep</td>
            <td colspan="3">Pembelian</td>
            <td colspan="5">Rawat Jalan, IGD, Rawat Inap (Umum)</td>
        </tr>
        <tr>
            <td>Total</td>
            <td>7</td>
            <td>23</td>
            <td>Harga Beli</td>
            <td>Total Beli</td>
            <td>Total Pokok</td>
            <td>Harga Jual</td>
            <td>Total Jual</td>
            <td>Total Bayar</td>
            <td>Profit</td>
            <td>Profit Total</td>
        </tr>

        @php $used_transaksi_obat_id = [] @endphp
        @foreach($data as $row_index => $single)
        <tr>
            @php $total_beli = $single->hpp * $single->jumlah @endphp
            @php $total_jual = $single->harga_jual * $single->jumlah @endphp
            @php $profit = $total_jual - $total_beli @endphp

            @php
                $current_transaksi_obat_id = $single->transaksi_obat_id;
                $grand_total_beli = 0;
                $grand_total_jual = 0;
                $grand_total_profit = 0;
                $rowspan = 0;
                if(!in_array($current_transaksi_obat_id,$used_transaksi_obat_id))
                {
                    for($i=$row_index;$i<count($data);$i++)
                    {
                        $current_sister = $data[$i];
                        $temp_transaksi_obat_id = $current_sister->transaksi_obat_id;
                        if($temp_transaksi_obat_id != $current_transaksi_obat_id) break;
                        $temp_harga_beli = $current_sister->hpp * $current_sister->jumlah;
                        $temp_harga_jual = $current_sister->harga_jual * $current_sister->jumlah;
                        $temp_profit = $temp_harga_jual - $temp_harga_beli;

                        $grand_total_beli += $temp_harga_beli;
                        $grand_total_jual += $temp_harga_jual;
                        $grand_total_profit += $temp_profit;
                        $rowspan++;
                    }
                    $used_transaksi_obat_id[] = $current_transaksi_obat_id;
                }

            @endphp

            <td>{{$row_index + 1}}</td>
            @if($rowspan > 0)
            <td rowspan="{{$rowspan}}">{{$single->dokter_nama}}</td>
            <td rowspan="{{$rowspan}}">{{$single->no_rm}}</td>
            <td rowspan="{{$rowspan}}">{{$single->lokasi_nama}}</td>
            <td rowspan="{{$rowspan}}">{{$single->asuransi_nama}}</td>
            @endif
            <td>{{$single->nama_obat}}</td>
            <td>{{$single->jumlah}}</td>
            <td>{{$single->hari7}}</td>
            <td>{{$single->hari23}}</td>
            <td>{{$single->hpp}}</td>
            <td>{{$total_beli}}</td>
            @if($rowspan > 0)
            <td rowspan="{{$rowspan}}">{{$grand_total_beli}}</td>
            @endif
            <td>{{$single->harga_jual}}</td>
            <td>{{$total_jual}}</td>
            @if($rowspan > 0)
            <td rowspan="{{$rowspan}}">{{$grand_total_jual}}</td>
            @endif
            <td>{{$profit}}</td>
            @if($rowspan > 0)
            <td rowspan="{{$rowspan}}">{{$grand_total_profit}}</td>
            @endif
        </tr>
        @endforeach
    </table>

</body>
</html>