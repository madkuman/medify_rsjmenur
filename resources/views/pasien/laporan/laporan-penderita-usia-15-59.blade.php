<table>
	<tr>
		<td colspan="13">
			DAFTAR PENDERITA BARU USIA 15-59 TAHUN YANG BEROBAT DI RUMAH SAKIT KOTA SURABAYA TAHUN 2019
		</td>
	</tr>
	<tr></tr>
	<tr>
		<td rowspan="2">NO.</td>
		<td rowspan="2">NIK</td>
		<td rowspan="2">NAMA</td>
		<td rowspan="2">ALAMAT</td>
		<td rowspan="2">UMUR</td>
		<td colspan="2">JENIS KELAMIN</td>
		<td colspan="5">JENIS PEMBIAYAAN</td>
		<td rowspan="2">JENIS PENYAKIT / DIAGNOSA</td>
	</tr>
	<tr>
		<td>L</td>
		<td>P</td>
		<td>UMUM</td>
		<td>BPJS MANDIRI</td>
		<td>BPJS PBI</td>
		<td>ASURANSI</td>
		<td>LAIN-LAIN</td>
	</tr>
	@for($i=0; $i<10; $i++)
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
	@endfor
	<tr>
		<td colspan="4">JUMLAH</td>
	</tr>
	<tr>
		<td colspan="4">TOTAL LAKI-LAKI DAN PEREMPUAN</td>
	</tr>
</table>




{{-- @extends('layouts.print')

@section('css')
<style type="text/css">
	body{
		font-family: sans-serif;
		font-size: 11px;
	}
</style>
@endsection

@section('content')
<table width="100%" border="0">
	<tr>
		<td class="text-center" colspan="6" style="font-size: 14px;">
			DAFTAR PENDERITA BARU USIA 15-59 TAHUN YANG BEROBAT DI RUMAH SAKIT KOTA SURABAYA TAHUN 2019
		</td>
	</tr>
	<tr><td><br></td></tr>
</table>

<table width="100%" border="1" style="border-collapse: collapse;">
	<tr>
		<td align="center" rowspan="2">NO.</td>
		<td align="center" rowspan="2">NIK</td>
		<td align="center" rowspan="2">NAMA</td>
		<td align="center" rowspan="2">ALAMAT</td>
		<td align="center" rowspan="2">UMUR</td>
		<td align="center" colspan="2">JENIS KELAMIN</td>
		<td align="center" colspan="5">JENIS PEMBIAYAAN</td>
		<td align="center" rowspan="2">JENIS PENYAKIT / DIAGNOSA</td>
	</tr>
	<tr>
		<td align="center">L</td>
		<td align="center">P</td>
		<td align="center">UMUM</td>
		<td align="center">BPJS MANDIRI</td>
		<td align="center">BPJS PBI</td>
		<td align="center">ASURANSI</td>
		<td align="center">LAIN-LAIN</td>
	</tr>
</table>

@endsection --}}