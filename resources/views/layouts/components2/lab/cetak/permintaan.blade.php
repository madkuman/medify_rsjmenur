<!DOCTYPE html>
<html>
<head>
	<title>PERMINTAAN PEMERIKSAAN {{$departemen}}</title>
	<style type="text/css">
		@page{
			margin-bottom: 20px;
			margin-top: 40px;
		}
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
		.gap td{
			padding-top: 4px;
			padding-bottom: 4px; 
		}
		.ttd{
			color: white;
			font-size: 30px;
			padding-top: 20px;
		}
		.page_break { page-break-before: always; }
	</style>
</head>
<body>
	<table>
		<tr>
			<td width="90%"></td>
			<td width="10%" style="border: 1px solid black; text-align: center;">
				RMPM. 01
			</td>
		</tr>
	</table>
	<table style="margin-top: 10px;">
		<tr>
			<td width="33%" style="text-align: right;">
				<img src="{{url('')}}/assets/img/pemprov-jatim.png" height="55">
			</td>
			<td width="34%" style="text-align: center; font-size: 12px;">
				<b>
					RUMAH SAKIT JIWA MENUR<br>
					<span style="text-transform: uppercase;">{{$departemen}}</span><br>
					Jl Raya Menur No.120 Surabaya
				</b>
			</td>
			<td width="33%" style="text-align: left;">
				<img src="{{url('')}}/assets/img/menur.png" height="55">
			</td>
		</tr>
		<tr>
			<td colspan="3" style="font-size: 7px;">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="3" style="text-align: center;">
				<b style="font-size: 16px;text-transform: uppercase;">PERMINTAAN PEMERIKSAAN {{$departemen}}</b>
			</td>
		</tr>
	</table>
	<table>
		<tr>
			<td style="border: 1px solid black; padding: 5px;">
				<table>
					<tr>
						<td width="50%">
							<table class="gap">
								<tr>
									<td width="30%">No RM</td>
									<td width="70%">: {{$transaksi->pasien->no_rm_formatted}}</td>
								</tr>
								<tr>
									<td>Nama</td>
									<td>: {{$transaksi->pasien->name}}</td>
								</tr>
								<tr>
									<td>Tgl Lahir/Umur</td>
									<td>: {{date('j M Y', strtotime($transaksi->pasien->date_of_birth))}}</td>
								</tr>
								<tr>
									<td>Jenis Kelamin</td>
									<td>: {{$transaksi->pasien->gender == '1' ? 'Laki-laki' : 'Perempuan'}}</td>
								</tr>
								<tr>
									<td>Alamat</td>
									<td>: {{$transaksi->pasien->address}}</td>
								</tr>
								<tr>
									<td>Dokter Pengirim</td>
									<td>: {{$transaksi->nama_dokter ?? $transaksi->creator['name'] }}</td>
								</tr>
							</table>
						</td>
						<td width="50%">
							<table class="gap">
								<tr>
									<td width="30%">No. Transaksi</td>
									<td width="70%">: {{$transaksi->id}}</td>
								</tr>
								<tr>
									<td>Tanggal & Jam</td>
									<td>: {{date('j M Y, H:i' , strtotime($transaksi->created_at))}}</td>
								</tr>
								<tr>
									<td>Debitur</td>
									<td>: {{$transaksi->kasus->pembayaran->perusahaan->nama ?? $transaksi->kasus->pembayaran}}</td>
								</tr>
								<tr>
									<td>Ruangan</td>
									<td>: {{$transaksi->kasus->lokasi->lokasi->nama}}</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr class="gap">
						<td colspan="2">Keterangan Klinis Singkat / Diagnosis Pasien : {{$transaksi->kasus->diagnosisUtama->icd10->code_icd}} - {{$transaksi->kasus->diagnosisUtama->icd10->long_desc}}</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<br>
	<table class="bordered">
		<tr>
			<td colspan="2"><b>PEMERIKSAAN</b></td>
		</tr>
		@foreach($all_transaksi as $pelayanan => $item)
		<tr>
			<td colspan="2"><b>{{$pelayanan}}</b></td>
		</tr>
			@foreach($item as $detail)
			<tr>
				<td width="2%" class="centered" style="vertical-align: middle">
					@if(in_array($detail->id, $tarif_selected))
					<b style="font-family: ZapfDingbats, sans-serif;">4</b>
					@endif
				</td>
				<td width="98%">{{$detail->deskripsi}}</td>
			</tr>
			@endforeach
		@endforeach
	</table>
	<br>
	<table class="bordered">
		<tr>
			<td><b>Keterangan Permintaan :</b></td>
		</tr>
		<tr>
			<td>{{{$transaksi->keterangan_permintaan}}}<br></td>
		</tr>
	</table>
	<br>
	<table class="bordered">
		<tr>
			<td><b>Klinis :</b></td>
		</tr>
		<tr>
			<td>{{{$transaksi->keterangan}}}<br></td>
		</tr>
	</table>
	<br><br>
	<table style="page-break-inside: avoid !important;">
		<tr>
			<td width="70%"></td>
			<td width="30%" class="centered">Surabaya, {{date('d F Y')}}</td>
		</tr>
		<tr>
			<td></td>
			<td class="centered">Tanda Tangan Dokter</td>
		</tr>
		@if($transaksi->tanpa_kasus == 1)
		<tr>
			<td></td>
			<td class="ttd centered">
				@if($transaksi->nama_dokter)
				@if($transaksi->creator->ttd)
				<img src="{{asset($transaksi->creator->ttd)}}" style="height: 50px;" />
				@else
				-
				@endif
				@else
				-
				@endif
			</td>
		</tr>
		<tr>
			<td></td>
			<td class="centered">{{$transaksi->nama_dokter ?? $transaksi->creator['name']}}</td>
		</tr>
		@else
		@php
			$user = $transaksi->creator ?? $transaksi->kasus->dpjp->user;
		@endphp
		<tr>
			<td></td>
			<td class="ttd centered">
				@if(!empty($user->ttd))
				<img src="{{asset($user->ttd)}}" style="height: 50px;" />
				@else
				-
				@endif
			</td>
		</tr>
		<tr>
			<td></td>
			<td class="centered">{{$user->name}}</td>
		</tr>
		@endif
	</table>

	<!-- KULTUR BIOLOGI -->
	@if(!empty($transaksi->spesimen))
	@if(count($transaksi->spesimen) > 0)
	<div class="page_break"></div>
	<table>
		<tr>
			<td width="90%"></td>
			<td width="10%" style="border: 1px solid black; text-align: center;">
				RMPM. 01
			</td>
		</tr>
	</table>
	<table class="margin-minus" style="margin-top: 10px; border: 1px solid black;">
		<tr>
			<td width="55%" style="vertical-align: middle;">
				<table>
					<tr>
						<td width="20%" style="text-align: right;">
							<img src="{{url('')}}/assets/img/pemprov-jatim.png" height="55">
						</td>
						<td width="60%" style="text-align: center; font-size: 12px;">
							<b>
								RUMAH SAKIT JIWA MENUR<br>
								LABORATORIUM KLINIK<br>
								Jl Raya Menur No.120 Surabaya
							</b>
						</td>
						<td width="20%" style="text-align: left;">
							<img src="{{url('')}}/assets/img/menur.png" height="55">
						</td>
					</tr>
				</table>
			</td>
			<td width="45%">
				<table class="mini-gap">
					<tr>
						<td>No. RM</td>
						<td>: {{$transaksi->pasien->no_rm_formatted}}</td>
					</tr>
					<tr>
						<td>Nama</td>
						<td>: {{$transaksi->pasien->name}}</td>
					</tr>
					<tr>
						<td>Tgl Lahir/Umur</td>
						<td>: {{date('j M Y', strtotime($transaksi->pasien->date_of_birth))}}</td>
					</tr>
					<tr>
						<td>Jenis Kelamin</td>
						<td>: {{$transaksi->pasien->gender == '1' ? 'Laki-laki' : 'Perempuan'}}</td>
					</tr>
					<tr>
						<td>Alamat</td>
						<td>: {{$transaksi->pasien->address}}</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2" style="text-align: center; border-top: 1px solid black; padding: 6px;">
				<b style="font-size: 16px;">FORMULIR KULTUR MIKROBIOLOGI</b>
			</td>
		</tr>
	</table>
	<table>
		<tr>
			<td style="border: 1px solid black; padding: 5px;">
				<table>
					<tr>
						<td width="50%">
							<table class="gap">
								<tr>
									<td width="30%">Tgl Permintaan</td>
									<td width="70%">: {{date('j M Y, H:i' , strtotime($transaksi->created_at))}}</td>
								</tr>
								<tr>
									<td>Debitur</td>
									<td>: {{$transaksi->kasus->pembayaran->perusahaan->nama ?? $transaksi->kasus->pembayaran}}</td>
								</tr>
								<tr>
									<td>Ruangan</td>
									<td>: {{$transaksi->kasus->lokasi->lokasi->nama}}</td>
								</tr>
								<tr>
									<td>Dokter Pengirim</td>
									<td>: {{$transaksi->nama_dokter ?? $transaksi->creator['name'] }}</td>
								</tr>
								<tr >
									<td>Diagnosa</td>
									<td>: {{$transaksi->kasus->diagnosisUtama->icd10->code_icd}} - {{$transaksi->kasus->diagnosisUtama->icd10->long_desc}}</td>
								</tr>
							</table>
						</td>
						<td width="50%">
							<table class="gap">
								<tr>
									<td width="40%">No. Transaksi</td>
									<td width="60%">: {{$transaksi->id}}</td>
								</tr>
								<tr>
									<td>Antibiotik yg diberikan</td>
									<td>:</td>
								</tr>
								<tr>
									<td>Lama Pemberian</td>
									<td>:</td>
								</tr>
								<tr>
									<td>Kualitas Spesimen</td>
									<td>: {{$transaksi->spesimen_kualitas}} </td>
								</tr>
								<tr>
									<td>Diterima tanggal</td>
									<td>: @if(!empty($transaksi->spesimen_terima_at))
										{{indonesian_date($transaksi->spesimen_terima_at)}}
										@endif
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<br>
	<table class="bordered">
		<tr>
			<td colspan="2"><b>BAHAN/SPESIMEN</b></td>
		</tr>
		@foreach($spesimen_list as $spesimen_kategori)
		<tr>
			<td colspan="2"><b>{{$spesimen_kategori->nama}}</b></td>
		</tr>
			@foreach($spesimen_kategori->spesimen as $spesimen)
			<tr>
				<td width="2%" class="centered" style="vertical-align: middle">
					@if(in_array($spesimen->id, $spesimen_selected))
					<b style="font-family: ZapfDingbats, sans-serif;">4</b>
					@endif
				</td>
				<td width="98%">{{$spesimen->nama}}</td>
			</tr>
			@endforeach
		@endforeach
	</table>
	<br>
	<table class="bordered">
		<tr>
			<td><b>Keterangan Permintaan :</b></td>
		</tr>
		<tr>
			<td>{{{$transaksi->keterangan_permintaan}}}<br></td>
		</tr>
	</table>
	<br>
	<table class="bordered">
		<tr>
			<td><b>Klinis :</b></td>
		</tr>
		<tr>
			<td>{{{$transaksi->keterangan}}}<br></td>
		</tr>
	</table>
	<br><br>
	<table style="page-break-inside: avoid;">
		<tr>
			<td width="70%"></td>
			<td width="30%" class="centered">Surabaya, {{date('d F Y')}}</td>
		</tr>
		<tr>
			<td></td>
			<td class="centered">Tanda Tangan Dokter</td>
		</tr>
		@if($transaksi->tanpa_kasus == 1)
		<tr>
			<td></td>
			<td class="ttd centered">
				@if($transaksi->nama_dokter)
				@if($transaksi->creator->ttd)
				<img src="{{asset($transaksi->creator->ttd)}}" style="height: 50px;" />
				@else
				-
				@endif
				@else
				-
				@endif
			</td>
		</tr>
		<tr>
			<td></td>
			<td class="centered">{{$transaksi->nama_dokter ?? $transaksi->creator['name']}}</td>
		</tr>
		@else
		<tr>
			<td></td>
			<td class="ttd centered">
				@if($transaksi->kasus->dpjp->user->ttd))
				<img src="{{asset($transaksi->kasus->dpjp->user->ttd)}}" style="height: 50px;" />
				@else
				-
				@endif
			</td>
		</tr>
		<tr>
			<td></td>
			<td class="centered">{{$transaksi->kasus->dpjp->user->name ?? $transaksi->creator['name']}}</td>
		</tr>
		@endif
	</table>
	@endif
	@endif
</body>