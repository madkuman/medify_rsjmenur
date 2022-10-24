<!DOCTYPE html>
<html lang="en">
<head>
	<style type="text/css">
	body{
		font-family: sans-serif;
	}
	.text-center{
		text-align: center;
	}
	.border-bottom{
		border-bottom: solid 1px #000;
	}
	.text-bold{
		font-weight: 700;
	}
	table td,
	.subjudul,
	table th,{
		font-size: 14px;
		vertical-align: top;
	}
</style>
<title>@yield('title')</title>
</head>
<body>
	<table width="100%">
	<tr>
		<td width="100%"><img src="{{config('app.kop_sm')}}" height="50"></td>
	</tr>
</table>
	<br>
	<div class="text-center" style="margin-bottom: 30px">
		<span class="text-bold">DATA RIWAYAT</span>
		<br>
		<span class="text-bold">PERSONEL</span>
	</div>
	@include('kepegawaian.laporan.hasil.profile-pegawai.components.data-umum')
	<br>
	@include('kepegawaian.laporan.hasil.profile-pegawai.components.keluarga')
	<br>
	@include('kepegawaian.laporan.hasil.profile-pegawai.components.riwayat-pangkat')
	<br>
	@include('kepegawaian.laporan.hasil.profile-pegawai.components.pendidikan-militer')
	<br>
	@include('kepegawaian.laporan.hasil.profile-pegawai.components.pendidikan-umum')
	<br>
	@include('kepegawaian.laporan.hasil.profile-pegawai.components.tanda-jasa')
	<br>
	@include('kepegawaian.laporan.hasil.profile-pegawai.components.riwayat-jabatan')
	<br><br>
	<div style="float:right;white-space: pre;text-align: center;" class="subjudul">
		{{$ttd->bagian_atas}}
		<br><br><br><br><br><br>
		{{$ttd->bagian_bawah}}
	</div>
</body>
</html>