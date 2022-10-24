<!DOCTYPE html>
<html>
<head>
	<title>Rekonsiliasi Obat</title>
	<style type="text/css">
		table{
			font-family: sans-serif;
			width: 100%;
			font-size: 13px;
			border-collapse: collapse;
		}
		.bordered td, .bordered th{
			border: 1px solid black;
			padding-left: 5px;
			padding-right: 5px;
		}
		td{
			vertical-align: top;
		}
		.centered td, .centered{
			text-align: center;
		}
		.big{
			font-size: 15px;
		}
		.va-mid{
			vertical-align: middle;
		}
	</style>
</head>
<body>
	<table>
		<tr>
			<td width="90%"></td>
			<td width="10%" style="border: 1px solid black; text-align: center;">
				RM 06.K3
			</td>
		</tr>
	</table>
	<table class="big">
		<tr>
			<td width="20%" style="text-align: right;">
				<img src="{{url('')}}/assets/img/pemprov-jatim.png" height="55">
			</td>
			<td width="60%" style="text-align: center;">
				<b>
					PEMERINTAH PROVINSI JAWA TIMUR<br>
					RUMAH SAKIT JIWA MENUR<br>
					Jln Menur No.120, Telp(031)5021635,5021637<br>
					S U R A B A Y A
				</b>
			</td>
			<td width="20%" style="text-align: left;">
				<img src="{{url('')}}/assets/img/menur.png" height="55">
			</td>
		</tr>
	</table>
	<hr style="border-top: 3px double black">
	<table class="big">
		<tr>
			<td class="centered"><b>FORMULIR REKONSILIASI OBAT</b></td>
		</tr>
	</table>
	<br>
	<table>
		<tr>
			<td><b>I. PASIEN MASUK RUMAH SAKIT</b></td>
		</tr>
	</table>
	<table style="margin-left: 15px;">
		<tr>
			<td width="50%">
				<table>
					<tr>
						<td width="30%">No. RM</td>
						<td width="70%">: {{$kasus->pasien->no_rm_formatted}}</td>
					</tr>
					<tr>
						<td>Nama</td>
						<td>: {{$kasus->pasien->name}}</td>
					</tr>
					<tr>
						<td>Tgl Lahir/Umur</td>
						<td>: {{date('d-m-Y', strtotime($kasus->pasien->date_of_birth))}} / {{$kasus->pasien->age}} Tahun</td>
					</tr>
					<tr>
						<td>Jenis Kelamin</td>
						<td>: {{$kasus->pasien->gender == '1' ? 'Laki-laki' : 'Perempuan'}}</td>
					</tr>
				</table>
			</td>
			<td width="50%">
				<table>
					<tr>
						<td width="30%">Ruangan</td>
						<td width="70%">: {{$kasus->lokasi->lokasi->nama}}</td>
					</tr>
					<tr>
						<td>DPJP</td>
						<td>: {{$kasus->dpjp->user->name}}</td>
					</tr>
					<tr>
						<td>Tanggal</td>
						<td>: {{date('d M Y', strtotime($kasus->created_at))}}</td>
					</tr>
					<tr>
						<td>Status</td>
						<td>: {{$kasus->pembayaran->perusahaan->nama ?? $kasus->pembayaran}}</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<br>
	<table class="bordered">
		<tr>
			<td colspan="2" class="centered"><b>RIWAYAT ALERGI OBAT PASIEN</b></td>
		</tr>
		<tr>
			<td width="50%" class="centered">Penyebab</td>
			<td width="50%" class="centered">Manifestasi</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
	</table>
	<br>
	<table class="bordered">
		<tr>
			<td colspan="7" class="centered"><b>RIWAYAT PENGGUNAAN OBAT PASIEN</b></td>
		</tr>
		<tr>
			<td width="10%" rowspan="2" class="centered va-mid">Tgl</td>
			<td width="20%" rowspan="2" class="centered va-mid">Nama Obat</td>
			<td width="15%" rowspan="2" class="centered va-mid">Aturan Pakai</td>
			<td width="10%" rowspan="2" class="centered va-mid">Jumlah</td>
			<td width="15%" rowspan="2" class="centered va-mid">Lama Pakai</td>
			<td width="15%" colspan="2" class="centered va-mid">Dilanjutkan</td>
		</tr>
		<tr>
			<td class="centered">Ya</td>
			<td class="centered">Tidak</td>
		</tr>
		@foreach($rekonsiliasi as $item)
		@if($item->jenis == 'awal')
		@foreach($item->details as $detail)
		<tr>
			<td>{{date('d/m/y', strtotime($detail->tanggal))}}</td>
			<td>{{$detail->obat_nama}}</td>
			<td>
				@if($detail->dihentikan == '1')
				{{$detail->aturan_pakai}}
				@else
				{{$detail->diteruskan_aturan_pakai}}
				@endif
			</td>
			<td>{{$detail->jumlah}}</td>
			<td>-</td>
			<td class="centered">
				@if($detail->dihentikan != '1')
				<div style="font-family: ZapfDingbats, sans-serif;">4</div>
				@endif
			</td>
			<td class="centered">
				@if($detail->dihentikan == '1')
				<div style="font-family: ZapfDingbats, sans-serif;">4</div>
				@endif
			</td>
		</tr>
		@endforeach
		@endif
		@endforeach
	</table>
	<br>
	<table>
		<tr>
			<td colspan="2"><b>Keterangan :</b></td>
		</tr>
		<tr>
			<td width="5%">1.</td>
			<td width="95%">Seluruh informasi mengenai adanya alergi obat harap diberikan dengan benar dan lengkap kepada pasien/keluarga pasien</td>
		</tr>
		<tr>
			<td>2.</td>
			<td>Seluruh terapi yang dibawa pasien dari rumah dan TIDAK dilanjutkan penggunaannya akan dikembalikan kepada pasien/keluarga pasien</td>
		</tr>
		<tr>
			<td>3.</td>
			<td>Seluruh terapi yang dibawa pasien daru rumah dan dilanjutakn pengunaannya akan diserahkan ke Instalasi Farmasi untuk disimpan</td>
		</tr>
		<tr>
			<td>4.</td>
			<td>Lembar ini juga berfungsi sebagai bukti serah terima obat-obatan yang dibawa dari rumah pasien/keluarga pasien dengan petugas</td>
		</tr>
	</table>
	<br><br>
	<table>
		<tr>
			<td class="centered" width="40%">Pasien/Keluarga</td>
			<td width="20%"></td>
			<td class="centered" width="40%">Petugas</td>
		</tr>
	</table>
	<br><br><br>
	<table>
		<tr>
			<td class="centered" width="40%">(_______________________)</td>
			<td width="20%"></td>
			<td class="centered" width="40%">(_______________________)</td>
		</tr>
		<tr>
			<td class="centered">Nama Terang</td>
			<td></td>
			<td class="centered">Nama Terang</td>
		</tr>
	</table>
	<div style="page-break-after: always;"></div>
	<table class="big">
		<tr>
			<td class="centered"><b>FORMULIR REKONSILIASI OBAT</b></td>
		</tr>
	</table>
	<br>
	<table>
		<tr>
			<td><b>II. PASIEN TRANSFER RUANGAN</b></td>
		</tr>
	</table>
	<br>
	<table>
		<tr>
			<td width="50%" style="padding-right: 10px;">
				<table>
					<tr>
						<td class="centered">
							OBAT DILANJUTKAN
						</td>
					</tr>
				</table>
				<table class="bordered">
					<tr class="centered">
						<td>Tgl</td>
						<td>Nama Obat</td>
						<td>Regimen</td>
						<td>Jumlah</td>
					</tr>
					@foreach($rekonsiliasi as $item)
					@if($item->jenis == 'transfer')
					@foreach($item->details as $detail)
					@if($detail->dihentikan != '1')
					<tr>
						<td>{{date('d/m/y', strtotime($detail->tanggal))}}</td>
						<td>{{$detail->obat_nama}}</td>
						<td>{{$detail->diteruskan_aturan_pakai}}</td>
						<td>{{$detail->jumlah}}</td>
					</tr>
					@endif
					@endforeach
					@endif
					@endforeach
				</table>
			</td>
			<td width="50%" style="padding-left: 10px;">
				<table>
					<tr>
						<td class="centered">
							OBAT DIRETUR KE INSTALASI FARMASI
						</td>
					</tr>
				</table>
				<table class="bordered">
					<tr class="centered">
						<td>Tgl</td>
						<td>Nama Obat</td>
						<td>Regimen</td>
						<td>Jumlah</td>
					</tr>
					@foreach($rekonsiliasi as $item)
					@if($item->jenis == 'transfer')
					@foreach($item->details as $detail)
					@if($detail->dihentikan == '1')
					<tr>
						<td>{{date('d/m/y', strtotime($detail->tanggal))}}</td>
						<td>{{$detail->obat_nama}}</td>
						<td>{{$detail->aturan_pakai}}</td>
						<td>{{$detail->jumlah}}</td>
					</tr>
					@endif
					@endforeach
					@endif
					@endforeach
				</table>
			</td>
		</tr>
	</table>
	<br><br>
	<table>
		<tr>
			<td class="centered" width="40%">Petugas Ruang Asal</td>
			<td width="20%"></td>
			<td class="centered" width="40%">Petugas Ruang Rujukan</td>
		</tr>
	</table>
	<br><br><br>
	<table>
		<tr>
			<td class="centered" width="40%">(_______________________)</td>
			<td width="20%"></td>
			<td class="centered" width="40%">(_______________________)</td>
		</tr>
		<tr>
			<td class="centered">Nama Terang</td>
			<td></td>
			<td class="centered">Nama Terang</td>
		</tr>
	</table>
	<br>
	<table>
		<tr>
			<td><b>III. PASIEN PULANG</b></td>
		</tr>
	</table>
	<br>
	<table>
		<tr>
			<td class="centered">OBAT DIRETUR KE INSTALASI FARMASI</td>
		</tr>
	</table>
	<table class="bordered">
		<tr class="centered">
			<td>Tgl</td>
			<td>Nama Obat</td>
			<td>Regimen</td>
			<td>Jumlah</td>
			<td>Keterangan</td>
		</tr>
		@foreach($rekonsiliasi as $item)
		@if($item->jenis == 'pulang')
		@foreach($item->details as $detail)
		@if($detail->dihentikan == '1')
		<tr>
			<td>{{date('d/m/y', strtotime($detail->tanggal))}}</td>
			<td>{{$detail->obat_nama}}</td>
			<td>{{$detail->aturan_pakai}}</td>
			<td>{{$detail->jumlah}}</td>
			<td>-</td>
		</tr>
		@endif
		@endforeach
		@endif
		@endforeach
	</table>
	<br>
	<table>
		<tr>
			<td class="centered">OBAT DIBAWA PULANG PASIEN</td>
		</tr>
	</table>
	<table class="bordered">
		<tr class="centered">
			<td>Tgl</td>
			<td>Nama Obat</td>
			<td>Indikasi</td>
			<td>Jumlah</td>
			<td>Aturan Pakai</td>
			<td>Keterangan</td>
		</tr>
		@foreach($rekonsiliasi as $item)
		@if($item->jenis == 'pulang')
		@foreach($item->details as $detail)
		@if($detail->dihentikan != '1')
		<tr>
			<td>{{date('d/m/y', strtotime($detail->tanggal))}}</td>
			<td>{{$detail->obat_nama}}</td>
			<td>-</td>
			<td>{{$detail->diteruskan_aturan_pakai}}</td>
			<td>{{$detail->jumlah}}</td>
			<td>-</td>
		</tr>
		@endif
		@endforeach
		@endif
		@endforeach
	</table>
	<br>
	<table>
		<tr>
			<td colspan="2"><b>Keterangan :</b></td>
		</tr>
		<tr>
			<td width="5%">1.</td>
			<td width="95%">Lembar ini juga berfungsi sebagai bukti serah terima obat dan informasi/edukasi terkait obat dari petugas kepada pasien/keluarga</td>
		</tr>
	</table>
	<br><br>
	<table>
		<tr>
			<td class="centered" width="40%">Pasien/Keluarga</td>
			<td width="20%"></td>
			<td class="centered" width="40%">Petugas</td>
		</tr>
	</table>
	<br><br><br>
	<table>
		<tr>
			<td class="centered" width="40%">(_______________________)</td>
			<td width="20%"></td>
			<td class="centered" width="40%">(_______________________)</td>
		</tr>
		<tr>
			<td class="centered">Nama Terang</td>
			<td></td>
			<td class="centered">Nama Terang</td>
		</tr>
	</table>
</body>
</html>