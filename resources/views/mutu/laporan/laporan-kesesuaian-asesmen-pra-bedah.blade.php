<table>
	<tr>
		<td colspan="7">KESESUAIAN ASESMEN PRA BEDAH OPERASI</td>
	</tr>
	<tr>
		<td colspan="7"></td>
	</tr>
	<tr>
		<td>No</td>
		<td>Tanggal Operasi</td>
		<td>Judul Operasi</td>
		<td>Dokter</td>
		<td>Pengisi Pra Bedah</td>
		<td>Tanggal Pengisian</td>
		<td>Kesesuaian</td>
    </tr>
    @php
        $yes = 0;
        $no = 0;
        $persenyes = 0;
        $persenno = 0;
    @endphp
	@foreach($data as $item)
	<tr>
		<td>{{$loop->iteration}}</td>
		<td>{{indonesian_date($item->tanggal_operasi,'d F Y')}}</td>
        <td>{{$item->transaksi->judul ?? '-'}}</td>
        <td>{{$item->transaksi->dokter->name ?? '-'}}</td>
        <td>{{$item->prabedah->creator->name ?? '-'}}</td>
        <td>{{is_null($item->prabedah) ? '-' : indonesian_date($item->prabedah->created_at,'d F Y / H:i')}}</td>
		<td>
            @php
                if (is_null($item->prabedah)) {
                    echo '-';
                    $no++;
                } else {
                    echo '&#10004;';
                    $yes++;
                }
            @endphp
        </td>
    </tr>
    @endforeach
    <tr>
        <td colspan="7"></td>
    </tr>
    <tr>
        <td colspan="7"><b>Kesimpulan Laporan Kesesuaian Asesmen Pra Bedah</b></td>
    </tr>
    <tr>
        <td></td>
        <td colspan="6">{{$yes}} : Jumlah operasi sudah mengisi asesmen pra bedah</td>
    </tr>
    <tr>
        <td></td>
        <td colspan="6">{{$no}} : Jumlah operasi belum mengisi asesmen pra bedah</td>
    </tr>
    <tr>
        <td></td>
        <td colspan="6">{{round(($yes/($yes+$no))*100, 2)}} % : Persentase operasi sudah mengisi asesmen pra bedah</td>
    </tr>
    <tr>
        <td></td>
        <td colspan="6">{{round(($no/($yes+$no))*100, 2)}} % : Persentase operasi belum mengisi asesmen pra bedah</td>
    </tr>
</table>