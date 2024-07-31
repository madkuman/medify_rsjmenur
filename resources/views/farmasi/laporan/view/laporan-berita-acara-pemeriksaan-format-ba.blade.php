<!DOCTYPE html>
<html>

<body>
    <table>
        <tr></tr>
        <tr></tr>
        <tr></tr>
        <tr></tr>
        <tr></tr>
        <tr></tr>
        <tr></tr>
        <tr>
            <td colspan="7">BERITA ACARA PEMERIKSAAN BARANG DI GUDANG</td>
        </tr>
        <tr>
            <td colspan="7">NOMOR : {{$no_berita_acara}}</td>
        </tr>
        <tr></tr>
        <tr></tr>
        <tr>
            <td>
                Pada hari ini, {{getTanggalIndonesiaHari($tanggal->dayOfWeek)}} tanggal {{getTerbilang($tanggal->format('d'))}} bulan {{getTanggalIndonesiaBulan($tanggal->format('n'))}} tahun {{getTerbilang($tanggal->format('Y'))}},
            </td>
        </tr>
        <tr>
            <td>
                kami yang bertanda tangan dibawah ini
            </td>
        </tr>
        <tr></tr>
        <tr>
            <td>Nama</td>
            <td>: SHODIKIN S.Kep, Ns</td>
        </tr>
        <tr>
            <td>Jabatan</td>
            <td>: Pejabat Penatausahaan Barang Milik Daerah selaku Pejabat Penatausahaan Barang</td>
        </tr>
        <tr>
            <td>Berdasarkan</td>
            <td>: Keputusan Gubernur Jawa Timur Nomor 020/590/102.8/2022 tanggal 1 Januari 2022</td>
        </tr>
        <tr></tr>
        <tr>
            <td>Telah melakukan pemeriksaan pembukuan/pencatatan dan pemeriksaan barang di gudang</td>
        </tr>
        <tr>
            <td>yang dilaksanakan oleh</td>
        </tr>
        <tr></tr>
        <tr>
            <td>Nama</td>
            <td>: FADHILATUS SOLICHA SB, S.Farm, Apt</td>
        </tr>
        <tr>
            <td>Jabatan</td>
            <td>: Pengurus Barang Persediaan Medis Selaku Pengurus Barang Persediaan</td>
        </tr>
        <tr>
            <td>Berdasarkan</td>
            <td>: Keputusan Gubernur Jawa Timur Nomor 020/590/102.8/2022 tanggal 1 Januari 2022</td>
        </tr>
        <tr></tr>
        <tr>
            <td>Setelah diadakan pemeriksaan barang di gudang, kami menemui kenyataan bahwa fisik barang tidak terdapat</td>
        </tr>
        <tr>
            <td>selisih kurang maupun selisih lebih dan sesuai dengan pembukuan/pencatatan administrasi pergudangan</td>
        </tr>
        <tr>
            <td>yang berada dalam pengurusan Pengurus Barang Persediaan dengan hasil sebagai berikut (rincian terlampir)</td>
        </tr>
        <tr></tr>
        @php $total = 0 @endphp
        @foreach($data as $row)
        <tr>
            <td></td>
            <td>{{$loop->iteration}}. {{$row->kode}} - {{$row->nama}}</td>
            <td></td>
            <td>Rp</td>
            <td>{{$row->nominal}}
        </tr>
        @php $total += $row->nominal @endphp
        @endforeach
        <tr>
            <td></td>
            <td>TOTAL</td>
            <td></td>
            <td>Rp</td>
            <td>{{$total}}
        </tr>
        <tr></tr>
        <tr>
            <td>Demikian Berita Acara ini dibuat dengan sebenar benarnya untuk dipergunakan sebagaimana mestinya</td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td>Pejabat Penatausahaan Barang</td>
            <td></td>
            <td></td>
            <td></td>
            <td>Pengurus Barang Persediaan</td>
            <td></td>
        </tr>
        <tr></tr>
        <tr></tr>
        <tr></tr>
        <tr>
            <td></td>
            <td>SHODIKIN, S.Kep, Ns</td>
            <td></td>
            <td></td>
            <td></td>
            <td>FADHILATUS SOLICHA SB, S.Farm, Apt</td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td>NIP. 19690321 199101 1 001</td>
            <td></td>
            <td></td>
            <td></td>
            <td>NIP. 19950919 201903 2 014</td>
            <td></td>
        </tr>
    </table>
</body>

</html>