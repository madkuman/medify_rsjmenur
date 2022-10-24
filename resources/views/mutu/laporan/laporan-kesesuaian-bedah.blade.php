<table>
	<tr>
		<td colspan="7">KESESUAIAN DIAGNOSIS RENCANA DAN PASCA OPERASI BEDAH</td>
	</tr>
	<tr>
		<td colspan="7"></td>
	</tr>
	<tr>
		<td>No</td>
		<td>Tanggal Operasi</td>
		<td>Judul Operasi</td>
		<td>Dokter</td>
		<td>Diagnosis Rencana</td>
		<td>Diagnosis Pasca</td>
		<td>Kesesuaian</td>
    </tr>
    @php
        $yes = 0;
        $no = 0;
    @endphp
	@foreach($data as $item)
	<tr>
		<td>{{$loop->iteration}}</td>
		<td>{{indonesian_date($item->tanggal_operasi,'d/m/Y')}}</td>
        <td>{{$item->transaksi->judul ?? '-'}}</td>
		{{-- <td>{{indonesian_date($item->komplain_tanggal,'d/m/Y / H:i')}}</td> --}}
        <td>{{$item->transaksi->dokter->name ?? '-'}}</td>
        <td>{{$item->diagnosis_awal ?? '-'}}</td>
        <td>{{$item->diagnosis_akhir ?? '-'}}</td>
		{{-- <td>{{is_null($item->respon_tanggal) ? '-' : indonesian_date($item->respon_tanggal,'d/m/Y / H:i')}}</td> --}}
		<td>
            @php
                if ($item->diagnosis_awal == $item->diagnosis_akhir) {
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
    <tr>
        <td colspan="7"></td>
    </tr>
    <tr>
        <td colspan="7"><b>Kesimpulan Laporan Kesesuaian Diagnosis</b></td>
    </tr>
    <tr>
        <td colspan="7">{{$yes}} : Jumlah diagnosis pasca sesuai dengan diagnosis rencana</td>
    </tr>
    <tr>
        <td colspan="7">{{$no}} : Jumlah diagnosis pasca tidak sesuai dengan diagnosis rencana</td>
    </tr>
</table>