<table>
    <tr>
        <td colspan="18">DATA PELAKSANAAN PELAYANAN KEFARMASIAN DI RUMAH SAKIT</td>
    </tr>
    <tr>
        <td colspan="18">PROVINSI JAWA TIMUR</td>
    </tr>

    <tr>
        <td colspan="18">TRIWULAN {{$triwulan}} / TAHUN {{$tahun}}</td>
    </tr>
    <tr>
        <td colspan="18"></td>
    </tr>
    <tr>
        <td rowspan="2">No.</td>
        <td rowspan="2">Nama Rumah Sakit</td>
        <td rowspan="2">Kab/Kota</td>
        <td rowspan="2">Tipe RS</td>
        <td rowspan="2">Kepemilikan RS</td>
        <td rowspan="2">Jumlah TT</td>
        <td rowspan="2">Rata2 Jumlah Pasien Rawat Jalan /bulan</td>
        <td rowspan="2">Rata2 Jumlah Pasien Rawat Inap /bulan</td>
        <td rowspan="2">Akreditasi</td>
        <td colspan="4">SDM Kefarmasian</td>
        <td colspan="3">Pelayanan Farmasi Klinik</td>
        <td colspan="2">Waktu Pelayanan</td>
    </tr>
    <tr>
        <td>Nama Kepala IFRS dan Kontak Person</td>
        <td>Jumlah Apoteker</td>
        <td>Jumlah TTK</td>
        <td>Jumlah S2 Farklin</td>
        <td>PIO /bulan</td>
        <td>Konseling /bulan</td>
        <td>Visite /bulan</td>
        <td>Waktu Tunggu Obat Racikan (menit)</td>
        <td>Waktu Tunggu Obat Jadi (menit)</td>
    </tr>
    <tr>
        <td>1</td>
        <td>{{config('app.name')}}</td>
        <td>Surabaya</td>
        <td>Rumah Sakit Khusus Kelas A</td>
        <td>Pemerintah Provinsi Jawa Timur</td>
        <td>{{$bed}}</td>
        <td>{{$transaksi_rajal}}</td>
        <td>{{$transaksi_ranap}}</td>
        <td></td>
        <td>{{$kadep_farmasi}} {{$kadep_farmasi}}</td>
        <td>{{$apoteker}}</td>
        <td>{{$ttk}}</td>
        <td>{{$s2_farmasi}}</td>
        <td>{{$pio}}</td>
        <td></td>
        <td>{{$visite}}</td>
        <td>{{$racikan}}</td>
        <td>{{$non_racikan}}</td>
    </tr>
</table>