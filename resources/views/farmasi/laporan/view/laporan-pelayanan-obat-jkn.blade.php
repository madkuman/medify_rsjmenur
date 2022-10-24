<table>
    <tr>
        <td colspan="12">LAPORAN PELAYANAN OBAT UNTUK PESERTA JKN DI RUMAH SAKIT</td>
    </tr>
    <tr>
        <td colspan="12">DIREKTORAT PELAYANAN KEFARMASIAN</td>
    </tr>
    <tr>
        <td colspan="12">KEMENTERIAN KESEHATAN REPUBLIK INDONESIA</td>
    </tr>
    <tr>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td>Nama Rumah Sakit</td>
        <td colspan="2">: {{config('app.name')}}</td>
    </tr>
    <tr>
        <td></td>
        <td>Tipe Rumah Sakit</td>
        <td colspan="2">: Rumah Sakit Khusus Kelas A</td>
    </tr>
    <tr>
        <td></td>
        <td>Alamat Rumah Sakit</td>
        <td colspan="2">: Jln Menur No.120</td>
    </tr>
    <tr>
        <td></td>
        <td>Kabupaten/ Kota</td>
        <td colspan="2">: Surabaya</td>
    </tr>
    <tr>
        <td></td>
        <td>Provinsi</td>
        <td colspan="2">: Jawa Timur</td>
    </tr>
    <tr>
        <td></td>
        <td>Nama KA Instalasi Farmasi</td>
        <td colspan="2">: </td>
    </tr>
    <tr>
        <td></td>
        <td>Jumlah Apoteker</td>
        <td colspan="2">: </td>
    </tr>
    <tr>
        <td></td>
        <td>No Telepon / HP</td>
        <td colspan="2">: </td>
    </tr>
    <tr>
        <td></td>
        <td>Bulan</td>
        <td colspan="2">: {{indonesian_date(strtotime($date_start),'F')}} - {{indonesian_date(strtotime($date_end),'F')}}</td>
    </tr>
    <tr>
        <td></td>
        <td>Tahun</td>
        <td colspan="2">: {{$year}}</td>
    </tr>
    <tr>
        <td></td>
    </tr>
    <tr>
        <td rowspan="2">No</td>
        <td colspan="2">Nama Obat</td>
        <td rowspan="2">Bentuk Sediaan</td>
        <td rowspan="2">Kekuatan</td>
        <td rowspan="2">Stok Awal</td>
        <td rowspan="2">Jumlah Penerimaan</td>
        <td colspan="3">Jumlah Penggunaan</td>
        <td rowspan="2">Harga Per Item</td>
        <td rowspan="2">Total Harga</td>
    </tr>
    <tr>
        <td>Generik</td>
        <td>Bermerk</td>
        <td>Rawat Jalan</td>
        <td>Rawat Inap</td>
        <td>Total</td>
    </tr>
    @php
        $i=0;
        $row = 18;
    @endphp
    @foreach($data as $item)
        <tr>
            <td>{{++$i}}</td>
            @if($item['generik'] == 'generik')
                <td>{{$item['nama']}}</td>
                <td></td>
            @else
                <td></td>
                <td>{{$item['nama']}}</td>
            @endif
                <td>{{$item['satuan']}}</td>
                <td></td>
                <td>{{$item['stok_awal']}}</td>
                <td>{{$item['pengadaan_real']}}</td>
                <td>{{$item['rj']}}</td>
                <td>{{$item['ri']}}</td>
                <td>=SUM(H{{$row}}:I{{$row}})</td>
                <td>{{$item['harga']}}</td>
                <td>=J{{$row}}*K{{$row}}</td>
        </tr>
        @php $row++ @endphp
    @endforeach
</table>