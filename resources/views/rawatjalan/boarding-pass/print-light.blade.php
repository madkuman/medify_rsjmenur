<style type="text/css">
@page { 
	margin: 0px;
	size: 302px 800px 
}
body {
	margin: 0px;
	font-family: sans-serif; 
	font-size: 18px;
}
table{
	border-collapse: collapse;
	width: 100vw;
}
.part{
	height: 302px;
	vertical-align: top;
	padding-top: 10px;
}
.centered{
	text-align: center;
}
.righted{
	text-align: right;
}
.pr-20{
	padding-right: 20px;
}
.pl-20{
	padding-left: 20px;
}
.title{
	font-size: 25px;
	font-weight: 600;
}
.upper{
	order: 200;
}
.page-content { 
	position: absolute; 
	top: 247px; 
	bottom: 0px; 
	left: -249px;
	right: 0px; 
	width: 800px; 
	height: 302px; 
	overflow: hidden;
	z-index: 1;
}
.blue{
	background-color: #000066;
}
.grey{
	background-color: #e6e6e6;
}
.label{
	font-size: 13px;
}
.rumkital{
	position: absolute;
	left: 30px;
	top: 5px;
	z-index: 2;
	color: black;
	font-size: 20px;
}
.gap{
	padding-top: 10px;
}
.barcode{
	position: absolute;
	left: 50px;
	top: 470px;
	z-index: 2;
}
.big{
	font-weight: 700;
}
.border{
	border-right: 1px solid black
}
</style>
<body>
	<div class="rumkital">
		{{config('app.name')}}
	</div>
	<div class="barcode">
		{!! $barcode !!}
	</div>
	<div class="page-content" style="transform: rotate(90deg);">
		<table>
			<tr>
				<td width="5%" class="part border">

				</td>
				<td width="60%" class="part">
					<table style="margin-top: 15px;">
						<tr>
							<td class="pl-20" width="20%">
								<img src="{{asset(config('app.logo_url'))}}" height="55">
							</td>
							<td width="80%" class="title">
								{{strtoupper('Poli '.$transaksi->poliklinik->name)}}
							</td>
						</tr>
					</table>
					<br>
					<table>
						<tr>
							<td class="pl-20 label" width="50%">NAMA PASIEN</td>
							<td class="label" width="50%">JENIS KELAMIN / USIA</td>
						</tr>
						<tr>
							<td class="pl-20 big" width="50%">{{$transaksi->pasien->name}}</td>
							<td class="big" width="50%">{{$transaksi->pasien->jenis_kelamin}}, {{$transaksi->pasien->age}} th</td>
						</tr>
					</table>
					<br>
					<table>
						<tr>
							<td class="pl-20 label" width="50%">NO RM</td>
							<td class="label" width="50%">TTL</td>
						</tr>
						<tr>
							<td class="pl-20 big" width="50%">{{$transaksi->pasien->no_rm}}</td>
							<td class="big" width="50%">{{$transaksi->pasien->place_of_birth}}, {{$transaksi->pasien->date_of_birth}}</td>
						</tr>
					</table>
					<br>
					<table>
						<tr>
							<td class="pl-20 label" width="50%">JENIS PEMBAYARAN</td>
							<td class="label" width="50%">ESTIMASI PELAYANAN</td>
						</tr>
						<tr>
							<td class="pl-20 big" width="50%">{{$transaksi->pasien_pembayaran->perusahaan->nama}}</td>
							<td class="big" width="50%">{{$ordered_at}}</td>
						</tr>
					</table>
				</td>
				<td width="35%" class="part grey">
					<table style="padding-top: 20px;">
						<tr>
							<td class="pl-20">TUJUAN SELANJUTNYA</td>
						</tr>
					</table>
					<br>
					<table>
						<tr>
							<td class="pl-20 label" width="60%">TUJUAN</td>
							<td class="label" width="40%">TANGGAL</td>
						</tr>
						<tr>
							<td class="pl-20 gap">_____________</td>
							<td class="gap">__________</td>
						</tr>
					</table>
					<br>
					<table>
						<tr>
							<td class="pl-20 label" width="60%">TUJUAN</td>
							<td class="label" width="40%">TANGGAL</td>
						</tr>
						<tr>
							<td class="pl-20 gap">_____________</td>
							<td class="gap">__________</td>
						</tr>
					</table>
					<br>
					<table>
						<tr>
							<td class="pl-20 label" width="60%">TUJUAN</td>
							<td class="label" width="40%">TANGGAL</td>
						</tr>
						<tr>
							<td class="pl-20 gap">_____________</td>
							<td class="gap">__________</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</div>
</body>
<script type="text/javascript">
	window.addEventListener("message", receiveMessage, false);

	function receiveMessage(event) {
		window.print();
	}
</script>