<head>
	<title>Print Karcis</title>
</head>

<style type="text/css">
table {
	font-family: sans-serif;
	border-collapse: collapse;
	font-size: 12px;
	font-weight: bold;

}
</style>
<div style="position: absolute;left: 0; top: 0; right: 0; width: 100%">
	<table style="width: 100vw">
		<tr>
			<td style="font-size: 22px; text-align: center;">Tiket Antrian</td>
		</tr>
		<tr>
			<td style="font-size: 16px; text-align: center;">{{config('app.name')}}</td>
		</tr>
		<tr>
			<td style="font-size: 14px; text-align: center;">Poliklinik {{$antrian->poliklinik->name}}</td>
		</tr>
	</table>
</div>
<div style=" position: absolute;left: 0; top: 75; right: 0; width: 100%;">
	<table style="width: 100vw">
		<tr>
			<td style="font-size: 60px; text-align: center;">{{$antrian->nomor_antrian}}</td>
		</tr>
	</table>
</div>
<div style="position: absolute; left: 0; top: 210; right: 0; width: 100%;">
	<table style="width: 100vw; text-align: center;">
		<tr>
			<td style="font-size: 12px; vertical-align: middle;">{{$antrian->pasien->name}}</td>
		</tr>
		<tr>
			<td style="font-size: 12px; vertical-align: middle;">{{$antrian->pasien->no_rm_formatted}}</td>
		</tr>
		<tr>
			<td style="font-size: 12px; vertical-align: middle;">
				{{app('App\Http\Controllers\Functions\DateFormatter')->timestampFormat($antrian->created_at, '%d %B %Y')}}
			</td>
		</tr>

	</table>
</div>