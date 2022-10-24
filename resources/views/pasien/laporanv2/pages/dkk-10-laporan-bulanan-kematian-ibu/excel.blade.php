<html>
    <table>
        <tr>
            <td colspan="22">LAPORAN KEMATIAN IBU HAMIL/ IBU BERSALIN/ IBU NIFAS</td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td colspan="22">Periode : {{ $date_start->format('d-m-Y') }} - {{ $date_end->format('d-m-Y') }}</td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <th rowspan="2">No</th>
            <th rowspan="2">Nama Ibu yang meninggal</th>
            <th rowspan="2">NIK Ibu yang meninggal</th>
            <th rowspan="2">Nama Suami</th>
            <th rowspan="2">Alamat sesuai KTP dan Domisili (Apabila alamat KTP dan domisili berbeda). ( Lengkap dengan Kelurahan dan Kecamatan )</th>
            <th rowspan="2">Usia Ibu (th)</th>
            <th rowspan="2">GPA</th>
            <th colspan="5">SEBAB KEMATIAN</th>
            <th colspan="5">ASAL RUJUKAN</th>
            <th colspan="3">MASA KEMATIAN</th>
            <th rowspan="2">Tanggal dan Jam Persalinan</th>
            <th rowspan="2">Tanggal dan Jam Kematian</th>
        </tr>
        <tr>
            <th>Perdarahan (dengan penyebab Perdarahan)</th>
            <th>Pre/Eklampsia</th>
            <th>Infeksi</th>
            <th>Jantung</th>
            <th>Lain - lain (sebutkan)</th>
            <th>Puskesmas</th>
            <th>Klinik</th>
            <th>PBM</th>
            <th>dr. / dr Sp.</th>
            <th>RS</th>
            <th>Hamil ( UK…..minggu )</th>
            <th>Persalinan</th>
            <th>Nifas ( mulai 6 jam PP - 42 hari PP )</th>
        </tr>
        @foreach ($data as $item)
            <tr>
                @foreach ($item as $col)
                    <td>{{ $col }}</td>
                @endforeach
            </tr>
        @endforeach
    </table>
</html>