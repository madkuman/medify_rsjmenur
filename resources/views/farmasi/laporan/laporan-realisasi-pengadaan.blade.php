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
    @php $total_col = 14 @endphp
    <table>
        <tr>
            <td  colspan="{{$total_col}}">Laporan Realisasi</td>
        </tr>
        <tr>
            <td  colspan="{{$total_col}}">Periode : {{indonesian_date($tanggal_awal)}} - {{indonesian_date($tanggal_akhir)}}</td>
        </tr>
        <tr>
            <td  colspan="{{$total_col}}">Kategori Barang : {{$kategori_names}}</td>
        </tr>
        
        <tr>
            <td colspan="{{$total_col}}"></td>
        </tr>
        <tr>
            <td rowspan="2">No</td>
            <td rowspan="2">Nama Barang</td>
            <td rowspan="2">Satuan</td>
            <td rowspan="2">Formularium</td>
            <td rowspan="2">E Katalog</td>
            <td rowspan="2">Generik / Non Generik</td>
            <td rowspan="2">Produsen</td>
            <td rowspan="2">Usulan</td>
            <td colspan="6">Produsen</td>
        </tr>
        <tr>
            <td>Penerimaan</td>
            <td>Harga Satuan</td>
            <td>Total Harga</td>
            <td>Kekurangan Usulan</td>
            <td>Keterangan</td>
            <td>Sumber Dana</td>
        </tr>

        @php $current_excel_row = 11; @endphp
        @foreach($data as $row_index => $single)
        <tr>
            <td>{{$row_index+1}}</td>
            <td>{{$single->nama_item}}</td>
            <td>{{$single->satuan}}</td>
            <td>{{in_array($single->item_template_id,$array_formularium_rs) ? 'Ya' : 'Tidak'}}</td>
            <td>{{in_array($single->item_template_id,$array_ekatalog) ? 'Ya' : 'Tidak'}}</td>
            <td>{{in_array($single->item_template_id,$array_generik) ? 'Ya' : 'Tidak'}}</td>
            <td></td>
            <td></td>
            <td>{{$single->jml ?? 0}}</td>
            <td>{{$single->harga}}</td>
            <td>{{$single->jml * $single->harga}}</td>
            <td></td>
            <td></td>
        </tr>
        @endforeach
    </table>

</body>
</html>