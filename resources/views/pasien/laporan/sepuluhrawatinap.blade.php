<table>
    <thead>
        <tr>
            <th></th>
            <th></th>
            <th>Formulir RL 5.3</th>
        </tr>
        <tr>
            <th></th>
            <th></th>
            <th colspan="2">Daftar 10 Besar Penyakit Rawat Inap</th>
        </tr>
        <tr>
            <th></th>
        </tr>
        <tr>
            <th></th>
        </tr>
        <tr>
            <th colspan="3">Kode Rumah Sakit</th>
            <th>:</th>
        </tr>
        <tr>
            <th colspan="3">Nama Rumah Sakit</th>
            <th>: {{config('app.name')}}</th>
        </tr>
        <tr>
            <th colspan="3">Tahun (Periode Waktu)</th>
            <th>: {{($date1->format('d M Y'))}} s/d {{($date2->format('d M Y'))}}</th>
        </tr>
        <tr>
        </tr>
        <tr>
            <th rowspan="5">No. Urut</th>
            <th rowspan="5">No. DTD</th>
            <th rowspan="5">No Daftar Terperinci</th>
            <th rowspan="5">Golongan Sebab Penyakit</th>
            <th rowspan="3" colspan="2">Pasien Keluar (Hidup &amp; Mati) Menurut Jenis Kelamin</th>
            <th rowspan="5">Jumlah Pasien Keluar Hidup</th>
            <th rowspan="5">Jumlah Pasien Keluar Mati</th>
        </tr>
        <tr></tr>
        <tr></tr>
        <tr>
            <th rowspan ="2">&nbsp;Laki- Laki&nbsp;</th>
            <th rowspan ="2">&nbsp;Perempuan &nbsp;</th>
        </tr>
        <tr></tr>
        <?php $idx = 1 ?>
        <tr>
            <th>1</th>
            <th>2</th>
            <th>3</th>
            <th>4</th>
            <th>5</th>
            <th>6</th>
            <th>7</th>
            <th>8</th>
        </tr>
        @foreach($dtds as $key => $dtd)
        <tr>
            <td>{{$idx++}}</td>
            <td>{{$dtd->no_dtd}}</td>
            <td>{{$dtd->no_daftar_terperinci}}</td>
            <td>{{$dtd->golongan_sebab_sebab_sakit}}</td>
            <td>{{$dtd->transaksi['all-1'] ?? 0}}</td>
            <td>{{$dtd->transaksi['all-2'] ?? 0}}</td>
            <td>{{($dtd->transaksi['all-1'] ?? 0) + ($dtd->transaksi['all-2'] ?? 0) - ($dtd->transaksi['all-meninggal'] ?? 0)}}</td>
            <td>{{($dtd->transaksi['all-meninggal'] ?? 0)}}</td>
        </tr>
        @endforeach
    </thead>
</table>
