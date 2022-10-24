<table>
    <thead>
        <tr>
            <th></th>
            <th></th>
            <th>Formulir RL 4B</th>
        </tr>
        <tr>
            <th></th>
            <th></th>
            <th colspan="2">DATA KEADAAN MORBIDITAS PASIEN {{$layanan}}</th>
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
            <th rowspan="3" colspan="18">Jumlah Pasien Kasus Menurut Golongan Umur &amp; Sex</th>
            <th rowspan="3" colspan="2">Pasien Keluar (Hidup &amp; Mati) Menurut Jenis Kelamin</th>
            <th rowspan="5">Jumlah Pasien Keluar Hidup</th>
            <th rowspan="5">Jumlah Pasien Keluar Mati</th>
        </tr>
        <tr></tr>
        <tr></tr>
        <tr>
            <th colspan="2">0-6 hr</th>
            <th colspan="2">7-28 hr</th>
            <th colspan="2">28hr-&lt;1th</th>
            <th colspan="2">1-4 th</th>
            <th colspan="2">5-14 th</th>
            <th colspan="2">15-24 th</th>
            <th colspan="2">25-44 th</th>
            <th colspan="2">45-64 th</th>
            <th colspan="2">&gt;65</th>
            <th rowspan="2">Laki-Laki</th>
            <th rowspan="2">Perempuan</th>
        </tr>
        <?php $idx = 1 ?>
        <tr>
            <?php for($i=0;$i<9;$i++) { ?>
            <th>&nbsp;L&nbsp;</th>
            <th>&nbsp;P&nbsp;</th>
            <?php } ?>
        </tr>
        <tr>
            <?php for($i=0;$i<26;$i++) { ?>
            <th>{{$i+1}}</th>
            <?php } ?>
        </tr>
        @foreach($dtds as $key => $dtd)
        <tr>
            <td>{{$idx++}}</td>
            <td>{{$dtd->no_dtd}}</td>
            <td>{{$dtd->no_daftar_terperinci}}</td>
            <td>{{$dtd->golongan_sebab_sebab_sakit}}</td>
            

            <td>{{$transaksi[$dtd->id]['0-6-1'] ?? 0}}</td>
            <td>{{$transaksi[$dtd->id]['0-6-2'] ?? 0}}</td>
            <td>{{$transaksi[$dtd->id]['7-28-1'] ?? 0}}</td>
            <td>{{$transaksi[$dtd->id]['7-28-2'] ?? 0}}</td>
            <td>{{$transaksi[$dtd->id]['29-364-1'] ?? 0}}</td>
            <td>{{$transaksi[$dtd->id]['29-364-2'] ?? 0}}</td>
            <td>{{$transaksi[$dtd->id]['365-1824-1'] ?? 0}}</td>
            <td>{{$transaksi[$dtd->id]['365-1824-2'] ?? 0}}</td>
            <td>{{$transaksi[$dtd->id]['1825-5474-1'] ?? 0}}</td>
            <td>{{$transaksi[$dtd->id]['1825-5474-2'] ?? 0}}</td>
            <td>{{$transaksi[$dtd->id]['5475-9124-1'] ?? 0}}</td>
            <td>{{$transaksi[$dtd->id]['5475-9124-2'] ?? 0}}</td>
            <td>{{$transaksi[$dtd->id]['9125-16424-1'] ?? 0}}</td>
            <td>{{$transaksi[$dtd->id]['9125-16424-2'] ?? 0}}</td>
            <td>{{$transaksi[$dtd->id]['16425-23724-1'] ?? 0}}</td>
            <td>{{$transaksi[$dtd->id]['16425-23724-2'] ?? 0}}</td>
            <td>{{$transaksi[$dtd->id]['23725-99999-1'] ?? 0}}</td>
            <td>{{$transaksi[$dtd->id]['23725-99999-2'] ?? 0}}</td>


            <td>{{$transaksi[$dtd->id]['total-1'] ?? 0}}</td>
            <td>{{$transaksi[$dtd->id]['total-2'] ?? 0}}</td>
            <td>{{$transaksi[$dtd->id]['total-hidup'] ?? 0}}</td>
            <td>{{$transaksi[$dtd->id]['total-meninggal'] ?? 0}}</td>
        </tr>
        @endforeach
    </thead>
</table>
