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
            <th>:3578020</th>
        </tr>
        <tr>
            <th colspan="3">Nama Rumah Sakit</th>
            <th>: {{config('app.name')}}</th>
        </tr>
        <tr>
            <th colspan="3">Tahun (Periode Waktu)</th>
            <th>: {{$date1->format('d/m/Y')}} s/d {{$date2->format('d/m/Y')}}</th>
        </tr>
        <tr>
        </tr>
        <tr>
            <th rowspan="5">No. Urut</th>
            <th rowspan="5">No. DTD</th>
            <th rowspan="5">No Daftar Terperinci</th>
            <th rowspan="5">Golongan Sebab Penyakit</th>
            <th rowspan="3" colspan="2">Pasien Mati Menurut Jenis Kelamin</th>
            <th rowspan="5">Jumlah</th>
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
            <th>23</th>
            <th>24</th>
            <th>25</th>
        </tr>
        @foreach($dtds as $key => $dtd)
        <tr>
            <td>{{$idx++}}</td>
            <td>{{$dtd->no_dtd}}</td>
            <td>{{$dtd->no_daftar_terperinci}}</td>
            <td>{{$dtd->golongan_sebab_sebab_sakit}}</td>
            <td>{{$dtd->transaksi['all-L'] ?? 0}}</td>
            <td>{{$dtd->transaksi['all-P'] ?? 0}}</td>
            <td>{{$dtd->transaksi['total'] ?? 0}}</td>
        </tr>
        @endforeach
    </thead>
</table>
