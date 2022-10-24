<style type="text/css">
@page { 
	margin: 0px;
	size: 800px 302px 
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
	top: 0px; 
	bottom: 0px; 
	left: 0px;
	right: 0px; 
	width: 100%; 
	height: 100%; 
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
	left: -95px;
	bottom: 140px;
	z-index: 2;
	color: white;
	transform: rotate(270deg);
	font-size: 20px;
}
.gap{
	padding-top: 10px;
}
.barcode{
	position: absolute;
	left: 615px;
	bottom: 105px;
	z-index: 2;
	transform: rotate(90deg);	
}
.big{
	font-weight: 700;
}

</style>
<body>
	<div class="rumkital">
		{{config('app.name')}}
	</div>
	<div class="barcode">
		{!! $barcode !!}
	</div>
	<div class="page-content">
		<table>
			<tr>
				<td width="5%" class="part blue">

				</td>
				<td width="60%" class="part">
					<table style="margin-top: 15px;">
						<tr>
							<td class="pl-20" width="20%">
								<img src="{{asset(config('app.logo_url'))}}" height="55">
							</td>
							<td width="80%" class="title">
								{{strtoupper($transaksi->tempat_tidur->ruangan->bangsal->nama.'-'.$transaksi->tempat_tidur->ruangan->nama)}}
							</td>
						</tr>
					</table>
					<br>
					<table>
						<tr>
							<td class="pl-20 label" width="50%">NAMA PASIEN</td>
							<td class="label" width="50%">JENIS KELAMN / USIA</td>
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
							<td class="label" width="50%">TANGGAL PELAYANAN</td>
						</tr>
						<tr>
							<td class="pl-20 big" width="50%">{{$transaksi->kasus->pembayaran->perusahaan->nama}}</td>
							<td class="big" width="50%">{{$created_at}}</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</div>
</body>