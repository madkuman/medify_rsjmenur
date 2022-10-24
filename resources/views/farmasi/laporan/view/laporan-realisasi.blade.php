<table>
    <thead>
        <tr>
            <th colspan="19" style="text-transform: uppercase">Laporan Realisasi Tanggal {{indonesian_date($date_start, 'd F Y')}} - {{indonesian_date($date_end, 'd F Y')}}</th>
        </tr>
        <tr>
            <th>NO</th>
            <th>NAMA OBAT</th>
            <th>SATUAN</th>
            <th>STATUS PEMBELIAN</th>
            <th style="text-transform: uppercase">SISA STOK AKHIR PERIODE SEBELUMNYA</th>
            <th>PREDIKSI PENGADAAN PERIODE INI</th>
            <th>PEMAKAIAN RATA-RATA PER BULAN</th>
            <th style="text-transform: uppercase">PREDIKSI SISA STOK AKHIR PERIODE INI</th>
            <th>JUMLAH KEBUTUHAN PERIODE SELANJUTNYA</th>
            <th>RENCANA KEBUTUHAN PERIODE SELANJUTNYA</th>
            <th>RENCANA PENGADAAN PERIODE SELANJUTNYA</th>
            <th>RENCANA PENGADAAN PERIODE INI</th>
            <th>REALISASI PENGADAAN PERIODE SEBELUMNYA</th>
            <th>USULAN</th>
            <th style="text-transform: uppercase">REALISASI {{indonesian_date($date_end, 'd F Y')}}</th>
            <th>SATUAN</th>
            <th>HARGA SATUAN REALISASI</th>
            <th>TOTAL HARGA REALISASI</th>
            <th>TOTAL HARGA</th>
        </tr>
    </thead>
    <tbody>
        @php
            $row = 3;
        @endphp
        @foreach ($data as $item)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$item["obat"]}}</td>
                <td>{{$item["satuan"]}}</td>
                <td></td>
                <td>{{$item["stok"]}}</td>
                <td>{{$item["pengadaan_ago"]}}</td>
                <td>{{$item["transaksi_real"]/$interval_month}}</td>
                <td>={{excel_column(5)}}{{$row}}+{{excel_column(6)}}{{$row}}-({{excel_column(7)}}{{$row}} *{{$interval_month}})</td>
                <td>={{excel_column(7)}}{{$row}}*{{$konstanta}}</td>
                <td>={{excel_column(9)}}{{$row}}-{{excel_column(8)}}{{$row}}</td>
                <td></td>
                <td>{{$item["pengadaan_ago"]}}</td>
                <td>{{$item["pengadaan"]}}</td>
                <td></td>
                <td>{{$item["pengadaan"]}}</td>
                <td>{{$item["satuan"]}}</td>
                <td>{{$item["harga"]}}</td>
                <td>={{excel_column(15)}}{{$row}}*{{excel_column(17)}}{{$row}}</td>
                <td>{{$item["harga"] * $item["stok"]}}</td>
            </tr>
            @php
                $row++;
            @endphp
        @endforeach
        <tr>
            <td colspan="16" style="text-align: center">TOTAL</td>
            <td>=SUM({{excel_column(17)}}3:{{excel_column(17)}}{{$last_row}})</td>
            <td>=SUM({{excel_column(18)}}3:{{excel_column(18)}}{{$last_row}})</td>
            <td>=SUM({{excel_column(19)}}3:{{excel_column(19)}}{{$last_row}})</td>
        </tr>
    </tbody>
</table>