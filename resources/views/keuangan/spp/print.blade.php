<!DOCTYPE html>
<html>
<head>
	<title>Nota</title>
	<style type="text/css">
	.table {
		border-collapse: collapse;
	}
	.bordered {
		border: 1px solid black;
		border-collapse: collapse;
	}
	.small{
		font-size: 13px;
	}
	.dummy{
		color: white;
		font-size: 13px;
	}

</style>
</head>
<body>
	<table width="100%">
	<tr>
		<td width="100%"><img src="{{config('app.kop_lg')}}" height="50"></td>
	</tr>
</table>
	<br>
	<table style="width: 100vw">
		<tr>
			<td style="text-align: center; text-decoration: underline; font-weight: bold; font-size: 15px">SURAT PERMINTAAN PEMBAYARAN</td>
		</tr>
		<tr>
			<td style="text-align: center;">Nomor SPP BLU / {{$spp->no_spp}} / {{$bulanRomawi}} / {{date('Y', strtotime($spp->tanggal_spp))}}</td>
		</tr>
	</table>
	<br>
	<table style="width: 100vw">
		<tr>
			<td style="width: 25%; vertical-align: top">Dari</td>
			<td style="width: 2%; vertical-align: top">:&nbsp;&nbsp;</td>
			<td style="width: 73%">Kepala {{config('app.name')}}</td>
		</tr>
		<tr>
			<td style="vertical-align: top">Kepada</td>
			<td style="vertical-align: top">:&nbsp;&nbsp;</td>
			<td>Bendahara Pengeluaran {{config('app.name')}}</td>
		</tr>
		<tr>
			<td style="vertical-align: top">Sebesar</td>
			<td style="vertical-align: top">:&nbsp;&nbsp;</td>
			<td>Rp. {{number_format($spp->total)}}</td>
		</tr>
		<tr>
			<td style="vertical-align: top">Terbilang</td>
			<td style="vertical-align: top">:&nbsp;&nbsp;</td>
			<td>{{$terbilang}}</td>
		</tr>
		<tr>
			<td style="vertical-align: top">Untuk Pembayaran</td>
			<td style="vertical-align: top">:&nbsp;&nbsp;</td>
			<td>
				@if(isset($spp->kategori->parent->name))
				{{$spp->kategori->parent->name ?? '-'}} / {{$spp->kategori->name ?? '-'}}
				@else
				{{$spp->kategori->name ?? '-'}}
				@endif
			</td>
		</tr>
		<tr>
			<td style="vertical-align: top">Kode Anggaran</td>
			<td style="vertical-align: top">:&nbsp;&nbsp;</td>
			<td>{{$spp->kategori->kode_anggaran}}</td>
		</tr>
		<tr>
			<td style="vertical-align: top">Beban Anggaran</td>
			<td style="vertical-align: top">:&nbsp;&nbsp;</td>
			<td>{{$spp->tahun_anggaran}}</td>
		</tr>
		<tr>
			<td style="width: 25%; vertical-align: top">Dibayarkan Kepada</td>
			<td style="width: 2%; vertical-align: top">:&nbsp;&nbsp;</td>
			<td style="width: 73%">{{$spp->perusahaan->direktur}}, {{$spp->perusahaan->jabatan}} {{$spp->perusahaan->nama}}</td>
		</tr>
		<!-- <tr>
			<td style="vertical-align: top">PKP</td>
			<td style="vertical-align: top">:&nbsp;&nbsp;</td>
			<td></td>
		</tr> -->
		<tr>
			<td style="vertical-align: top">Alamat</td>
			<td style="vertical-align: top">:&nbsp;&nbsp;</td>
			<td>{{$spp->perusahaan->alamat}}</td>
		</tr>
		<tr>
			<td style="vertical-align: top">NPWP</td>
			<td style="vertical-align: top">:&nbsp;&nbsp;</td>
			<td>{{$spp->perusahaan->npwp}}</td>
		</tr>
		<tr>
			<td colspan="3">Permintaan Pembayaran Berkenaan dengan (terlampir)</td>
	</table>
	<br>
	<table style="width: 100vw">
		<tr>
			<td colspan="7">SURAT PERJANJIAN / SPK / SPRIN</td>
		</tr>
		<tr>
			<td style="width: 7%">1.</td>
			<td style="width: 13%">Nomor</td>
			<td style="width: 2%">:</td>
			<td style="width: 51%">{{!empty($spp->no_spkktr) ? $spp->no_spkktr : $spp->no_sprin}}</td>
			<td style="width: 3%">Tgl.</td>
			<td style="width: 21%; text-align: right;">{{($spp->no_spkktr == '-') ? '-' : $tanggal_spkktr}}</td>
			<td style="width: 3%"></td>
		</tr>
		<tr>
			<td></td>
			<td>Mengenai</td>
			<td>:</td>
			<td>{{$spp->judul}}</td>
			<td>Rp.</td>
			<td style="text-align: right;">{{number_format($spp->total)}}</td>
		</tr>
	</table>
	<table style="width: 100vw">
		<tr>
			<td style="width: 7%">2.</td>
			<td style="width: 38%">PENGAWASAN OTORISASI</td>
			<td style="width: 2%"></td>
			<td style="width: 3%"></td>
			<td style="width: 18%"></td>
			<td style="width: 5%"></td>
			<td style="width: 3%"></td>
			<td style="width: 21%"></td>
			<td style="width: 3%"></td>
		</tr>
		<tr>
			<td></td>
			<td>Jumlah Pagu Anggaran tersebut diatas</td>
			<td>:</td>
			<td></td>
			<td></td>
			<td></td>
			<td>Rp.</td>
			<td style="text-align: right;">{{number_format($spp->kategori->total_anggaran)}}</td>
			<td></td>
		</tr>
		<tr>
			<td></td>
			<td>Jumlah s/d SPP BLU lalu</td>
			<td>:</td>
			<td>Rp.</td>
			<td style="text-align: right;">{{number_format($jumlah_spp_lalu)}}</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td></td>
			<td>Jumlah SPP BLU ini</td>
			<td>:</td>
			<td style="border-bottom: 1px solid black">Rp.</td>
			<td style="border-bottom: 1px solid black; text-align: right;">{{number_format($spp->total)}}</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td></td>
			<td>Jumlah s/d SPP BLU ini</td>
			<td>:</td>
			<td></td>
			<td></td>
			<td></td>
			<td style="border-bottom: 1px solid black">Rp.</td>
			<td style="border-bottom: 1px solid black; text-align: right;">{{number_format($jumlah_spp_lalu + $spp->total)}}</td>
			<td></td>
		</tr>
		<tr>
			<td></td>
			<td>Sisa Pagu Anggaran</td>
			<td>:</td>
			<td></td>
			<td></td>
			<td></td>
			<td>Rp.</td>
			<td style="text-align: right;">{{number_format($spp->kategori->total_anggaran - ($jumlah_spp_lalu + $spp->total))}}</td>
			<td></td>
		</tr>
	</table>
	<br><br>
	<table style="width: 100vw">
		<tr>
			<td style="width: 55%"></td>
			<td style="width: 45%; text-align: center;">Surabaya, {{$tanggal}}</td>
		</tr>
		<tr>
			<td style="width: 55%"></td>
			<td style="width: 45%; text-align: center;">{{$ttd->jabatan}}</td>
		</tr>
	</table>
	<br><br><br>
	<table style="width: 100vw">
		<tr>
			<td style="width: 55%"></td>
			<td style="width: 45%; text-align: center;">{{$ttd->nama}}</td>
		</tr>
		<tr>
			<td style="width: 55%"></td>
			@if(!empty($ttd->nip))
			<td style="width: 45%; text-align: center;">{{$ttd->pangkat}} NRP {{$ttd->nip}}</td>
			@else
			<td style="width: 45%; text-align: center;">{{$ttd->pangkat}}</td>
			@endif
		</tr>
	</table>
</body>