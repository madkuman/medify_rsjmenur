<table>
    <tr>
        <td colspan="9">FORM PENGGUNAAN OBAT DI RUMAH SAKIT</td>
    </tr>
    <tr>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td>Nama Rumah Sakit</td>
        <td colspan="2">: {{config('app.name')}}</td>
        <td></td>
        <td>Tribulan</td>
        <td>: {{$triwulan}}</td>
    </tr>
    <tr>
        <td></td>
        <td>Kelas RS</td>
        <td colspan="2">: Kelas A</td>
        <td></td>
        <td>Tahun</td>
        <td>: {{$tahun}}</td>
    </tr>
    <tr>
        <td></td>
        <td>Tipe RS</td>
        <td colspan="2">: Tipe A</td>
    </tr>
    <tr>
        <td></td>
        <td>Jenis RS</td>
        <td colspan="2">: Khusus</td>
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
        <td>Kepemilikan</td>
        <td colspan="2">: Pemda</td>
    </tr>
    <tr>
        <td></td>
    </tr>
    <tr>
        <td rowspan="2">No</td>
        <td rowspan="2">Nama Obat</td>
        <td rowspan="2">Kelas Terapi</td>
        <td rowspan="2">Bentuk Sediaan</td>
        <td>Penjamin</td>
        <td>Kesesuaian dengan</td>
        <td colspan="3">Jumlah Penggunaan (satuan terkecil)</td>
    </tr>
    <tr>
        <td>(JKN/Non-JKN)</td>
        <td>Fornas (Ya/Tidak)</td>
        <td>RJ</td>
        <td>RI</td>
        <td>Total</td>
    </tr>
    @php $i=0; @endphp
    @foreach($data as $item)
        <tr>
            <td>{{++$i}}</td>
            <td>{{$item['nama']}}</td>
            <td></td>
            <td>{{$item['satuan']}}</td>
            <td>JKN</td>
            <td>{{$item['fornas']}}</td>
            <td>{{$item['pemakaian_rj_jkn']}}</td>
            <td>{{$item['pemakaian_ri_jkn']}}</td>
            <td>{{$item['pemakaian_rj_jkn'] + $item['pemakaian_ri_jkn']}}</td>
        </tr>
        <tr>
            <td>{{++$i}}</td>
            <td>{{$item['nama']}}</td>
            <td></td>
            <td>{{$item['satuan']}}</td>
            <td>Non-JKN</td>
            <td>{{$item['fornas']}}</td>
            <td>{{$item['pemakaian_rj_non_jkn']}}</td>
            <td>{{$item['pemakaian_ri_non_jkn']}}</td>
            <td>{{$item['pemakaian_rj_non_jkn'] + $item['pemakaian_ri_non_jkn']}}</td>
        </tr>
    @endforeach
</table>