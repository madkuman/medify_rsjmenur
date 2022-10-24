<!DOCTYPE html>
<html>
<head>
	<title>Nota</title>
	<style type="text/css">
	table {
		border-collapse: collapse;
		font-size: 14px;
	}
	@page{ 
		margin: 3px; 
	}
	body{ 
		margin: 3px; 
	}
	.left{
		text-align: left;
	}
	.center{
		text-align: center;
	}
	.right{
		text-align: right;
	}
	td{
		padding-top: 3px;
	}
	.wrapword{
        white-space: -moz-pre-wrap !important;  /* Mozilla, since 1999 */
        white-space: -webkit-pre-wrap; /*Chrome & Safari*/
        white-space: -pre-wrap;      /* Opera 4-6 */
        white-space: -o-pre-wrap;    /* Opera 7 */
        white-space: pre-wrap;       /* css-3 */
        word-wrap: break-word;       /* Internet Explorer 5.5+ */
        word-break: break-all;
        white-space: normal;
    }

</style>
</head>
<body>
	<table style="width: 100vw; table-layout: fixed">
		<tr>
			<td colspan="3">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="3">&nbsp;</td>
		</tr>
		<tr>
			<td class="left" style="width: 49%">No : {{$uji->id}}</td>
			<td class="center" style="width: 2%"></td>
			<td class="right" style="width: 49%">{{$tanggal}}</td>
		</tr>
		<tr>
			<td class="left"></td>
			<td class="center"></td>
			<td class="right">{{$tahun}}</td>
		</tr>
		<tr>
			<td colspan="3" class="center wrapword">{{$uji->spp->perusahaan->nama}}</td>
		</tr>
		<tr>
			<td colspan="3" class="center" style="border-bottom: 1px solid black"> {{config('app.name')}}</td>
		</tr>
		<tr>
			<td class="left">Bruto</td>
			<td class="center">:</td>
			<td class="right">{{number_format($uji->total)}}</td>
		</tr>
		<tr>
			<td class="left">Peng. Brg</td>
			<td class="center">:</td>
			<td class="right">{{number_format($uji->pengadaan_barang)}}</td>
		</tr>
		<tr>
			<td class="left">Bebas PPn</td>
			<td class="center">:</td>
			<td class="right">{{number_format($uji->bebas_ppn)}}</td>
		</tr>
		<tr>
			<td class="left">Barang PPH 23 Non PPn</td>
			<td class="center">:</td>
			<td class="right">{{number_format($uji->pph23nonppn)}}</td>
		</tr>
		<tr>
			<td class="left">Kena PPn</td>
			<td class="center">:</td>
			<td class="right">{{number_format($uji->kena_ppn)}}</td>
		</tr>
		<tr>
			<td class="left">Jasa</td>
			<td class="center">:</td>
			<td class="right">{{number_format($uji->jasa)}}</td>
		</tr>
		<tr>
			<td class="left">DPP</td>
			<td class="center">:</td>
			<td class="right">{{($pengadaan_barang == 0) ? '0' : number_format($dpp)}}</td>
		</tr>
		<tr>
			<td class="left">PPn</td>
			<td class="center">:</td>
			<td class="right">{{number_format($ppn)}}</td>
		</tr>
		<tr>
			<td class="left">PPh 21 (5%)</td>
			<td class="center">:</td>
			<td class="right">{{number_format($pph_21_5)}}</td>
		</tr>
		<tr>
			<td class="left">PPh 21 (15%)</td>
			<td class="center">:</td>
			<td class="right">{{number_format($pph_21_15)}}</td>
		</tr>
		<tr>
			<td class="left">PPh 22</td>
			<td class="center">:</td>
			<td class="right">{{number_format($pph_22)}}</td>
		</tr>
		<tr>
			<td class="left">PPh 23</td>
			<td class="center">:</td>
			<td class="right">{{number_format($pph_23)}}</td>
		</tr>
		<tr>
			<td class="left">PPh 4</td>
			<td class="center">:</td>
			<td class="right">{{number_format($pph_4)}}</td>
		</tr>
		<tr>
			<td colspan="3" style="border-bottom: 1px solid black">
		</tr>
		<tr>
			<td class="left">Total Pajak</td>
			<td class="center">:</td>
			<td class="right">{{number_format($uji->total-$dibayarkan)}}</td>
		</tr>
		<tr>
			<td class="left">Dibayarkan</td>
			<td class="center">:</td>
			<td class="right">{{number_format($dibayarkan)}}</td>
		</tr>
		<tr>
			<td colspan="3" class="left">{{$terbilang}}</td>
		</tr>
	</table>
</body>