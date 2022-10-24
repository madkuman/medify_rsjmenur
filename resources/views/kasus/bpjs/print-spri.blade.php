<head>
	<title>
        Print {{ $jenis_sk_si }}
    </title>
	<style type="text/css">
	table {
		border-collapse: collapse;
		font-size: 14px;
		line-height: 150%;
		white-space: nowrap;
	}
	.text-light{
		color: black;
	}
	@page{
		margin-top: 20px;
	}
</style>
</head>


<body style="margin-top: 0px">
	<div style="position: absolute; top: 10" id="logobpjspanjang">
		<img src="{{url('assets/img')}}/logobpjspanjang.png" style="height: 30px">
	</div>
	<div style="position: absolute; top: 5; left: 180;">
		<span>{{ $judul}} <br> {{config('app.name')}}</span>
	</div>
	<div style="float:right">
		No. {{ $rencana_kontrol->no_sk }}
	</div>
		{{-- {{ dd($bpjs, $bpjs_real) }} --}}
	<div style="font-family: sans-serif; margin-top: 55px; margin-left: 23px;">
		<div style="position: absolute; top: 0;">
			<h4>
				Mohon Pemeriksaan dan Penanganan Lebih Lanjut :	
			</h4>
			<table style="width: 100%">
				<tr>
					<td class="text-light" style="width: 20%">No.Kartu</td>
					<td style="width: 1%" class="text-light">:</td>
					<td style="width: 79%;">{{$rencana_kontrol->no_kartu}}</td>
				</tr>
				<tr>
					<td class="text-light" style="width: 20%">Nama Peserta</td>
					<td style="width: 1%" class="text-light">:</td>
					<td style="width: 79%;">{{$rencana_kontrol->nama_pasien ?? '-'}}</td>
				</tr>
				<tr>
					<td class="text-light">Tgl.Lahir</td>
					<td class="text-light">:</td>
					<td>
						@if (isset($rencana_kontrol->pasien->date_of_birth))
							{{ indonesian_date($rencana_kontrol->pasien->date_of_birth, 'j F Y') }}
						@else
							-
						@endif
					</td>
				</tr>
				<tr>
					<td class="text-light">Diagnosa</td>
					<td class="text-light">:</td>
					<td>
						-
					</td>
				</tr>
				<tr>
					<td class="text-light">{{ $jenis_rencana }}</td>
					<td class="text-light">:</td>
					<td>
						@php
							$tanggal_rencana = '';
							if(isset($rencana_kontrol->tgl_rk)){
								$tanggal_rencana = indonesian_date($rencana_kontrol->tgl_rk, 'j F Y');
							}
						@endphp
						{{ $tanggal_rencana }}
					</td>
				</tr>				
				<tr>
					<td class="text-light" colspan="3" style="font-size: 10px;">
						<br>
						<br>
						<br>
						@php
							$created_at_rencana_kontrol = '-';
							if(isset($rencana_kontrol->created_at)){
								$created_at = indonesian_date($rencana_kontrol->created_at, 'Y-m-d');
							}
						@endphp
						Tgl.Entri {{ $created_at_rencana_kontrol }} | Tgl.Cetak {{ indonesian_date(now(), 'Y-m-d H:i') }}
					</td>
					<td colspan="2" style="text-align: right;">
						<p style="text-align:left;">Mengetahui DPJP,</p>
						<br>
						{{ $rencana_kontrol->nama_dokter ?? '-' }}
					</td>
				</tr>
			</table>
		</div>
	</div>
</body>