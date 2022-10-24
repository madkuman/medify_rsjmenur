<head>
	<title>
        Print {{ $jenis_sk_si }}
    </title>
	<style type="text/css">
	table {
		border-collapse: collapse;
		font-size: 13px;
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
@php
	$response = $rencana_kontrol_bpjs->response ?? (object)[];
	$peserta  = $response->sep->peserta ?? (object)[];
@endphp

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
			<table style="width: 100%">
				<tr>
					<td class="text-light" style="width: 20%">Kepada Yth</td>
					<td style="width: 1%" class="text-light">&nbsp;</td>
					<td style="width: 79%;">
						{{ $rencana_kontrol->nama_dokter }}<br>
					</td>
				</tr>
				<tr>
					<td>
						&nbsp;
					</td>
					<td>
						&nbsp;
					</td>
					<td>
						{{ $rencana_kontrol->dokter->bpjs_spesialis_text ?? null }}
					</td>
				</tr>
				<tr>
					<td colspan="3">
						Mohon Pemeriksaan dan Penanganan Lebih Lanjut :
					</td>
				</tr>
				<tr>
					<td class="text-light" style="width: 20%">No.Kartu</td>
					<td style="width: 1%" class="text-light">:</td>
					<td style="width: 79%;">{{$rencana_kontrol->no_kartu}}</td>
				</tr>
				<tr>
					<td class="text-light">Nama Peserta</td>
					<td class="text-light">:</td>
					<td>{{$rencana_kontrol->nama_pasien ?? '-'}}</td>
				</tr>
				<tr>
					<td class="text-light">Tgl.Lahir</td>
					<td class="text-light">:</td>
					<td>
						@if (isset($rencana_kontrol->pasien->date_of_birth))
							{{ indonesian_date($rencana_kontrol->pasien->date_of_birth, 'j F Y') }}
						@else
							{{ indonesian_date($peserta->tglLahir ?? now(), 'j F Y') }}
						@endif
					</td>
				</tr>
				<tr>
					<td class="text-light">Diagnosa</td>
					<td class="text-light">:</td>
					<td>
						{{ $rencana_kontrol->sep->diagnosis->code_icd}} - {{ cutText($rencana_kontrol->sep->diagnosis->long_desc ?? null,50) }}
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
					<td colspan="3">
						Demikin atas bantuannya, diucapkan banyak terima kasih
					</td>
				</tr>
				<tr>
					<td class="text-light" colspan="3" style="font-size: 10px;">
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
					<td colspan="2" style="text-align: left;">
						Mengetahui DPJP,<br>
						<br>
						{{ $rencana_kontrol->nama_dokter ?? '-' }}
					</td>
				</tr>
			</table>
		</div>
	</div>
</body>