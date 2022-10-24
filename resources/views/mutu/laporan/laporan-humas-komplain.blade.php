<table>
	<tr>
		<td colspan="6">HUMAS - KECEPATAN RESPON TERHADAP KOMPLAIN</td>
	</tr>
	<tr>
		<td colspan="6"></td>
	</tr>
	<tr>
		<td>No</td>
		<td>Komplain</td>
		<td>Lokasi</td>
		<td>Tanggal / Waktu Komplain</td>
		<td>Tanggal / Waktu Respon</td>
		<td>Memenuhi Kriteria</td>
	</tr>
	@php
        $yes = 0;
        $no = 0;
    @endphp
	@foreach($data as $item)
	<tr>
		<td>{{$loop->iteration}}</td>
		<td>{{$item->komplain_keterangan ?? '-'}}</td>
        <td>{{$item->lokasi ?? '-'}}</td>
        @php
            $hours = 2;
            if($item->respon_tanggal != null){
                $t1 = strtotime($item->respon_tanggal);
                $t2 = strtotime($item->komplain_tanggal);
                $diff = $t1 - $t2;
                $hours = $diff / ( 60 * 60 );
            }
        @endphp
		<td>{{indonesian_date($item->komplain_tanggal,'d/m/Y / H:i')}}</td>
		<td>{{is_null($item->respon_tanggal) ? '-' : indonesian_date($item->respon_tanggal,'d/m/Y / H:i')}}</td>
		<td>
            @php
                if ($hours > 0 && $hours <= 1) {
                    echo '&#10004;';
                    $yes++;
                } else {
                    echo '-';
                    $no++;
                }
            @endphp
        </td>
    </tr>
    @endforeach
    @if (count($data) > 0)
    <tr>
        <td colspan="6"></td>
    </tr>
    <tr>
        <td colspan="6"><b>Kesimpulan Laporan Kecepatan Terhadap Respon</b></td>
    </tr>
    <tr>
        <td>{{$yes}}</td>
        <td colspan="5"> Jumlah komplain yang masuk kreteria</td>
    </tr>
    <tr>
        <td>{{$no}}</td>
        <td colspan="5"> Jumlah komplain yang tidak masuk kreteria</td>
    </tr>
    <tr>
        @php
        $persenyes = round(($yes/($yes+$no))*100, 2);
        $persenno = round(($no/($yes+$no))*100, 2);
        @endphp
        <td>
            {{$persenyes}} %</td>
        <td colspan="5"> Komplain telah memenuhi kreteria kecepatan respon</td>
    </tr>
    <tr>
        <td>{{$persenno}} %</td>
        <td colspan="5"> Komplain tidak memenuhi kreteria kecepatan respon</td>
    </tr>
        @endif
</table>