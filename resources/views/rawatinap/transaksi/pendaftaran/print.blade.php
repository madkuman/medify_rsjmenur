<!DOCTYPE html>
<html>
<head>
    <title>Persetujuan Rawat Inap</title>
    <style type="text/css">
    table {
        border-collapse: collapse;
        width: 100vw;
        font-size: 14px;
    }
    .dummy{
        color: white;
        font-size: 28px;
    }
    .centered{
        text-align: center;
    }
    .big{
        font-size: 17px;
    }

</style>
</head>
<body>
    <table>
        <tr>
            <td class="small" style="font-weight: bold; border-bottom: 1px solid black">{{config('app.name')}}</td>
            <td></td>
        </tr>
    </table>
    <br><br>
    <table>
        <tr>
            <td class="centered big">PERNYATAAN PERSETUJUAN DIRAWAT INAP</td>
        </tr>
    </table>
    <br><br>
    <table>
        <tr>
            <td>Yang bertanda tangan dibawah ini :</td>
        </tr>
    </table>
    <br>
    <table>
        <tr>
            <td style="width:12%">Nama</td>
            <td style="width:1%">:</td>
            <td style="width:20%">...............................</td>
            <td style="width:15%">Tgl Lahir/Umur</td>
            <td style="width:1%">:</td>
            <td style="width:20%">...................../.......Th</td>
            <td style="width:10%">JK</td>
            <td style="width:1%">:</td>
            <td style="width:20%">L/P</td>
        </tr>
        <tr>
            <td>Pangkat/Gol</td>
            <td>:</td>
            <td>...............................</td>
            <td>NRP</td>
            <td>:</td>
            <td>...............................</td>
            <td>Kesatuan</td>
            <td>:</td>
            <td>...............................</td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td colspan="7">...............................</td>
        </tr>
    </table>
    <br>
    <table>
        <tr>
            <td>(Bila diwakilkan : Pasien adalah Suami / Istri / Anak / Orangtua / Keluarga ...............................)</td>
        </tr>
    </table>
    <br>
    <table>
        <tr>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Menyatakan dengan ini setuju untuk dirawat inap dan mengijinkan dokter maupun yang ditunjuk melakukan berbagai cara diagnostic dan pengobatan yang dianggap perlu dan penting, baik untuk keadaan biasa apalagi keadaan darurat dan usaha lain untuk penyelamatan *) atas pasien{{config('app.name')}}. Setelah mendapat keterangan yang lengkap dan jelas tentang faedah dan kemungkinan terjadinya resiko atas tindakan yang secara medis tidak menyalahi standar pelayanan kesehatan. Dan sanggup mematuhi semua peraturan yang berlaku di{{config('app.name')}}.</td>
        </tr>
    </table>
    <br><br>
    <table>
        <tr>
            <td style="width:20%">Nama</td>
            <td style="width:1%">:</td>
            <td style="width:40%">{{$pasien->name}}</td>
            <td style="width:15%">JK</td>
            <td style="width:1%">:</td>
            <td style="width:25%">{{$pasien->jenis_kelamin}}</td>
        </tr>
        <tr>
            <td>Tgl Lahir/Umur</td>
            <td>:</td>
            <td>{{date('d-m-Y', strtotime($pasien->date_of_birth))}} / {{$pasien->age}} Th.</td>
            <td>NRP/NIP</td>
            <td>:</td>
            <td>{{$pasien->tni_nrp or ''}}</td>
        </tr>
        <tr>
            <td>Pangkat/Gol</td>
            <td>:</td>
            <td>{{$pasien->tni_pangkat->nama or ''}}</td>
        </tr>
        <tr>
            <td>Kesatuan</td>
            <td>:</td>
            <td>{{$pasien->tni_satker->nama or ''}}</td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td>{{$pasien->address or ''}}</td>
        </tr>
        <tr>
            <td>No. RM</td>
            <td>:</td>
            <td>{{$pasien->no_rm or ''}}</td>
        </tr>
        <tr>
            <td>Ruang/Kelas</td>
            <td>:</td>
            <td>{{$bed->ruangan->bangsal->nama}} {{$bed->ruangan->nama}} / {{$bed->ruangan->kelas_ruang->nama}}</td>
        </tr>
    </table>
    <br>
    <table>
        <tr>
            <td style="width:60%"></td>
            <td style="width: 40%">Surabaya, {{$tanggal}}</td>
        </tr>
        <tr>
            <td>Dokter Yang Memeriksa</td>
            <td>Tanda Tangan Pasien/Wali</td>
        </tr>
        <tr>
            <td class="dummy" colspan="2">.</td>
        </tr>
        <tr>
            <td>.....................................</td>
            <td>.....................................</td>
        </tr>
    </table>
</body>
</html>