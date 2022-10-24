<head>
	<title>Print SEP</title>
	<style type="text/css">
	table {
		border-collapse: collapse;
		font-size: 13px;
		line-height: 125%;
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
		<span>SURAT ELEGIBILITAS PESERTA <br> {{config('app.name')}}</span>
	</div>
    @if(isset($bpjs->prolanis_prb) && $bpjs->prolanis_prb != 'null')
		<div style="position: absolute; top: 5; right:10;">
			<span>PASIEN POTENSI PRB</span>
		</div>
    @endif
		{{-- {{ dd($bpjs, $bpjs_real) }} --}}
	<div style="font-family: sans-serif; margin-top: 55px; margin-left: 23px;">
		<div style="position: absolute; left: -10;">
			<table style="width: 100vw" style="table-layout: fixed;">
				<tr>
					<td class="text-light" style="width: 20% !important;">No.SEP</td>
					<td class="text-light" style="width: 1% !important;">:</td>
					<td class="text-light" style="width: 79%">{{$bpjs_real->noSep ?? '-'}}</td>
				</tr>
				<tr>
					<td class="text-light">Tgl.SEP</td>
					<td class="text-light">:</td>
					<td>{{$bpjs_real->tglSep ?? '-'}}</td>
				</tr>
				<tr>
					<td class="text-light">No.Kartu</td>
					<td class="text-light">:</td>
					<td>
						@php
							$nomor_kartu = $bpjs_real->peserta->noKartu ?? '-';
							$nomor_rm = $bpjs_real->peserta->noMr ?? '-';
							$format_nomor_kartu = $nomor_kartu.' ( MR.'.$nomor_rm.')';
						@endphp
						{{$format_nomor_kartu}}
					</td>
				</tr>
				<tr>
					<td class="text-light">Nama Peserta</td>
					<td class="text-light">:</td>
					<td>{{$bpjs_real->peserta->nama ?? '-'}}</td>
				</tr>
				<tr>
					<td class="text-light">Tgl Lahir</td>
					<td class="text-light">:</td>
					@php 
					$tgl_lahir = implode("-", array_reverse(explode("-", $bpjs_real->peserta->tglLahir)));
					@endphp
					<td>{{$tgl_lahir ?? '-'}}</td>
				</tr>
				<tr>
					<td class="text-light">No. Telepon</td>
					<td class="text-light">:</td>
					<td>
						@php
							$phone = $bpjs->pasien->phone ?? '-';
							if($phone == 0)
								$phone = '-';
						@endphp
						{{ $phone }}
					</td>
				</tr>
				<tr>
					<td class="text-light">Sub/Spesialis</td>
					<td class="text-light">:</td>
					<td>
						{{ $sep_internal->nmtujuanrujuk ?? $bpjs_real->poli ?? '-' }}
					</td>
				</tr>
				<tr>
					<td class="text-light">Dokter</td>
					<td class="text-light">:</td>
					<td>
						@php
							$dokter_name = $sep_internal->nmdokter ?? $bpjs_real->dpjp->nmDPJP;
						@endphp
						{{ $dokter_name }}
					</td>
				</tr>
				<tr>
					<td class="text-light">Faskes Perujuk</td>
					<td class="text-light">:</td>
					<td>
						{{ $rujukan->provPerujuk->nama ?? $bpjs->nama_ppk_rujukan ?? '-' }}
					</td>
				</tr>				
				<tr>
					<td class="text-light">Diagnosa Awal</td>
					<td class="text-light">:</td>
					<td>
						@php
							$diagnosa_awal = $bpjs_real->diagnosa ?? '-';
							if($diagnosa_awal != '-')
								$diagnosa_awal = cutText($diagnosa_awal, 20);
						@endphp
						{{$diagnosa_awal}}
					</td>
				</tr>
			</table>
			{{-- <p style="font-size:10px"> --}}
				<table>
					<tr>
						<td style="font-size:10px">
							*Saya menyetujui BPJS Kesehatan menggunakan informasi medis pasien jika diperlukan<br>
							*SEP Bukan sebagai bukti penjamin peserta <br>
							@if ($bpjs_real->jnsPelayanan != 'Rawat Jalan')
								**Dengan diterbitkannya SEP ini, Peserta rawat inap telah mendapatkan informasi dan menempati dengan <br>
								kelas rawat sesuai hak kelasnya (terkecuali kelas penuh atau naik kelas sesuai aturan yang berlaku) <br>
							@endif
						</td>
						<td style="padding-left: 51%">
							Pasien/Keluarga Pasien
							<br><br>
							<hr>
						</td>
					</tr>
				</table>
				{{-- <tr>
					<td class="text-light" colspan="3" style="font-size: 10px;"> --}}
						{{-- *Saya menyetujui BPJS Kesehatan menggunakan informasi medis pasien jika diperlukan<br>
						*SEP Bukan sebagai bukti penjamin peserta <br>
						@if ($bpjs_real->jnsPelayanan != 'Rawat Jalan')
							**Dengan diterbitkannya SEP ini, Peserta rawat inap telah mendapatkan informasi dan menempati dengan <br>
							kelas rawat sesuai hak kelasnya (terkecuali kelas penuh atau naik kelas sesuai aturan yang berlaku) <br>
						@endif --}}
					{{-- </td>
				</tr> --}}
			{{-- </p> --}}
			<p bottom="0" style="font-size:10px">
				Dicetak tanggal {{ indonesian_date(now(), 'Y-m-d H:i:s') }} wib
			</p>
		</div>
		<div style="position: absolute; top: 50; left: 350;">
			<table style="width: 100vw">
				<tr>
					<td class="text-light" style="width: 5%">Peserta</td>
					<td class="text-light" style="width: 1%">:</td>
					<td >{{ $bpjs_real->peserta->jnsPeserta ?? '-' }}</td>
				</tr>
				<tr>
					<td class="text-light">Jns.Rawat</td>
					<td class="text-light">:</td>
					<td >{{$bpjs_real->jnsPelayanan ?? '-'}}</td>
				</tr>
				<tr>
					<td class="text-light">Jns.Kunjungan</td>
					<td class="text-light">:</td>
					<td >
						@php
							$jenis_kunjungan = config('const.tujuan_kunjungan')[$bpjs->tujuan_kunjungan ?? null] ?? '-';
							if(!empty($sep_internal))
								$jenis_kunjungan = 'Kunjungan Rujukan Internal';
						@endphp
						{{ $jenis_kunjungan}}
					</td>
				</tr>
				<tr>
					<td class="text-light">&nbsp;</td>
					<td class="text-light">:</td>
					<td >{{ config('const.flag_procedure')[$bpjs->flag_procedure ?? null] ?? '-'}}</td>
				</tr>
				<tr>
					<td class="text-light">Poli Perujuk</td>
					<td class="text-light">:</td>
					<td >{{ $rujukan->poliRujukan->nama ?? $bpjs->poli->name ??'-' }}</td>
				</tr>
				<tr>
					<td class="text-light">Kls.Rawat / Hak</td>
					<td class="text-light">:</td>
					<td>{{$bpjs_real->kelasRawat ?? '-'}} / {{$bpjs_real->peserta->hakKelas ?? '-'}}</td>
				</tr>
                @if(isset($bpjs_real->penjamin) && !empty($bpjs_real->penjamin))
				<tr>
					<td class="text-light">Penjamin Laka</td>
					<td class="text-light">:</td>
					<td>{{$bpjs_real->penjamin}}</td>
				</tr>
                @endif
				<tr>
					<td class="text-light">Catatan</td>
					<td class="text-light">:</td>
					<td>{{$bpjs_real->catatan}}</td>
				</tr>
			</table>
		</div>
	</div>
</body>