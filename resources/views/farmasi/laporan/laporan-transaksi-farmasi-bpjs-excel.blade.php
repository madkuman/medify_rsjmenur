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
            <td colspan="{{$total_col}}"></td>
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
            <td colspan="12">Pasien BPJS</td>
        </tr>
        <tr>
            <td>Total</td>
            <td>7</td>
            <td>23</td>

            <td>Harga Beli</td>
            <td>Total Beli</td>
            <td>Total Pokok</td>

            <td>Jml Retriksi</td>
            <td>7</td>
            <td>23</td>
            <td>Harga Retriksi</td>
            <td>HIDDEN</td>
            <td>HIDDEN</td>
            <td>Jml Klaim</td>
            <td>Penjualan</td>
            <td>Klaim INA</td>
            <td>Selisih</td>
            <td>Harga</td>
            <td>Harga Total</td>
            <td>Profit Total</td>

        </tr>

        @php $used_transaksi_obat_id = [] @endphp
        @php $current_excel_row = 11; @endphp
        @foreach($data as $row_index => $single)
        <tr>
            
            @php $total_beli = $single->hpp * $single->jumlah @endphp
            @php $total_jual = $single->harga_jual * $single->jumlah @endphp
            @php $total_jual_7 = $single->hpp * $single->hari7 @endphp
            @php $profit = $total_jual - $total_beli @endphp
            @php $current_excel_row++ @endphp

            @php
                $current_transaksi_obat_id = $single->transaksi_obat_id;
                $grand_total_beli = 0;
                $grand_total_jual = 0;
                $grand_total_profit = 0;
                $rowspan = 0;
                if(!in_array($current_transaksi_obat_id,$used_transaksi_obat_id))
                {
                    $first_row = $current_excel_row;
                    $counter = 0;
                    for($i=$row_index;$i<count($data);$i++)
                    {
                        $current_sister = $data[$i];
                        $temp_transaksi_obat_id = $current_sister->transaksi_obat_id;
                        if($temp_transaksi_obat_id != $current_transaksi_obat_id) break;
                        
                        $rowspan++;
                        $counter++;
                    }
                    $last_row = $current_excel_row+$counter-1;
                    $used_transaksi_obat_id[] = $current_transaksi_obat_id;
                }

            @endphp

            @php $retriksi_bpjs_7 = round($single->retriksi_bpjs/30*7) @endphp
            @php $retriksi_bpjs_23 = $single->retriksi_bpjs - $retriksi_bpjs_7 @endphp
            @php $hide_1 = $retriksi_bpjs_7 - $single->hari7 @endphp
            @php 
                if($hide_1 < 0) $hide_2 = $single->hari7;
                else $hide_2 = $hide_1;
            @endphp

            @php    
                $jml_klaim = 0;
                if($hide_2>=0) $jml_klaim=$single->hari7;
                else $jml_klaim = $retriksi_bpjs_7;
            @endphp
            @php    
                $klaim_ina = $jml_klaim * $single->hpp;
                $selisih_aa = $klaim_ina - $total_jual_7;
                $harga_ac = abs($selisih_aa);
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
            <td>{{$single->retriksi_bpjs}}</td>
            <td>{{$retriksi_bpjs_7}}</td>
            <td>{{$retriksi_bpjs_23}}</td>
            <td>{{$single->hpp}}</td>
            <td>{{$hide_1}}</td>
            <td>{{$hide_2}}</td>
            <td>{{$jml_klaim}}</td>
            <td>{{$total_jual_7}}</td>
            <td>{{$klaim_ina}}</td>
            <td>{{$selisih_aa}}</td>
            <td>{{$harga_ac}}</td>
            @if($rowspan > 0)
            <td rowspan="{{$rowspan}}">=SUM(W{{$first_row}}:W{{$last_row}})</td>
            <td rowspan="{{$rowspan}}">=200000-X{{$first_row}}</td>
            @endif
        </tr>
        @endforeach
    </table>

</body>
</html>