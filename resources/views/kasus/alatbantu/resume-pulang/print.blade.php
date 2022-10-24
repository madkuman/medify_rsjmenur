<!DOCTYPE html>
<html>
<head>
	<title>Resume Pasien Pulang Rawat Inap</title>
	<style type="text/css">
	@page{
		margin-top: 20px;
		margin-bottom: 20px;
	}
	body{
		font-family: sans-serif;
		font-size: 13px;
	}
	table{
		border-collapse: collapse;
		width: 100%;
		margin-bottom: 5px;
	}
	.centered{
		text-align: center;
	}
	.title{
		font-weight: bold;
		text-align: center;
		vertical-align: middle;
		font-size: 17px;
	}
	.bordered{
		border: 1px solid black;
	}
	.bot{
		border-bottom: 1px solid black;
	}
	.righted{
		text-align: right;
	}
	.pl-20{
		padding-left: 20px;
	}
	.mb-0{
		margin-bottom: 0px !important;
	}
	td{
		vertical-align: top
	}
	.dummy{
		color: white;
		font-size: 40px;
	}
</style>
</head>
<body>
	<table>
		<tr>
			<td width="40%" class="centered">{{config('app.name')}}</td>
			<td width="60%" class="righted"></td>
		</tr>
	</table>
	<table>
		<tr>
			<td class="bordered title" width="60%">
				RESUME PASIEN PULANG
			</td>
			<td class="bordered" width="40%">
				<table class="mb-0">
					<tr>
						<td>No.RM</td>
						<td>: {{$kasus->pasien->no_rm}}</td>
					</tr>
					<tr>
						<td>Nama Pasien</td>
						<td>: {{$kasus->pasien->name}}</td>
					</tr>
					<tr>
						<td>Tgl Lahir/Umur</td>
						<td>: {{indonesian_date($kasus->pasien->date_of_birth)}}, {{$kasus->pasien->age}} Tahun</td>
					</tr>
					<tr>
						<td>Jenis Kelamin</td>
						<td>: {{$kasus->pasien->gender == 1 ? 'Laki laki' : 'Perempuan' }}</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<table>
		<tr>
			<td width="15%">Pangkat / Gol</td>
			<td width="35%">: {{$kasus->pasien->tni_pangkat->nama ?? '-' }}</td>
			<td width="14%">Tanggal Masuk</td>
			<td width="16%">: {{indonesian_date(date('y-m-d', strtotime($kasus->mrs_at ?? $kasus->created_at)))}}</td>
			<td width="20%"> Ruangan {{$kasus->rawat_inap_transaksi_first->tempat_tidur->ruangan->bangsal->nama ?? '-'}}</td>
		</tr>
		<tr>
			<td>NRP / NIP</td>
			<td>: {{$kasus->pasien->tni_nrp ?? '-'}}</td>
			<td>Tanggal Keluar</td>
			<td>: 
				@if(empty($kasus->krs_at))
				{{indonesian_date($now)}}
				@else
				{{indonesian_date(date('y-m-d', strtotime($kasus->krs_at)))}}
				@endif
			</td>
			<td>Ruangan {{$kasus->rawat_inap_transaksi_last->tempat_tidur->ruangan->bangsal->nama ?? '-'}}</td>
		</tr>
		<tr>
			<td>Kesatuan</td>
			<td>: {{$kasus->pasien->tni_kotama->nama ?? '-'}}</td>
			<td>Dx. Medis</td>
			<td>: @if($kasus->diagnosisUtama){{$kasus->diagnosisUtama->icd10->long_desc ?? '-'}} @endif</td>
			<td></td>
		</tr>
	</table>
	<table class="bot">
		<tr>
			<td width="25%">Suhu {{$resume_pulang->val->suhu ?? '-'}} Celcius</td>
			<td width="25%">Nadi {{$resume_pulang->val->nadi ?? '-'}} x/menit</td>
			<td width="25%">RR {{$resume_pulang->val->rr ?? '-'}} x/menit</td>
			<td width="25%">TD {{$resume_pulang->val->td ?? '-'}} mmHg</td>
		</tr>
	</table>
	<table class="bot">
		<tr>
			<td width="57%">
				<table>
					<tr>
						<td width="22%"><li>Diet / Nutrisi</li></td>
						<td width="78%">: {{!empty($resume_pulang->val->oral) ? 'Oral' : ''}}{{!empty($resume_pulang->val->ngt) ? ', NGT' : ''}}, Diet khusus  {{$resume_pulang->val->diet_khusus ?? 'tidak ada'}}, Batasan cairan {{$resume_pulang->val->batasan_cairan ?? 'tidak ada'}}</td>
					</tr>
					<tr>
						<td><li>BAB</li></td>
						<td>: {{$resume_pulang->val->bab ?? '-'}}</td>
					</tr>
					<tr>
						<td><li>BAK</li></td>
						<td>: {{$resume_pulang->val->bak ?? '-'}}, Tanggal pemasangan kateter terakhir {{$resume_pulang->val->kateter ?? '-'}}</td>
					</tr>
					<tr>
						<td><li>Luka / Luka Operasi</li></td>
						<td>: {{!empty($resume_pulang->val->luka) ? str_replace(",", ", ", $resume_pulang->val->luka) : '-'}}, Cairan luka {{$resume_pulang->val->cairan_luka ?? 'tidak ada'}}</td>
					</tr>
				</table>
			</td>
			<td width="43%">
				<table>
					<tr>
						<td width="40%"><li>Transfer - Mobilisasi</li></td>
						<td width="60%">: {{$resume_pulang->val->transfer ?? '-'}}</td>
					</tr>
					<tr>
						<td><li>Alat Bantu</li></td>
						<td>: {{$resume_pulang->val->alat_bantu ?? '-'}}</td>
					</tr>
					<tr>
						<td><li>Kontraksi Uterus</li></td>
						<td>: {{$resume_pulang->val->uterus ?? ''}} 
							@if($resume_pulang->val->fundus_uteri)
							, Fundus uteri {{$resume_pulang->val->fundus_uteri ?? ''}}
							@endif
						</td>
					</tr>
					<tr>
						<td><li>Vulva</li></td>
						<td>: {{$resume_pulang->val->vulva ?? ''}}</td>
					</tr>
					<tr>
						<td><li>Lochea</li></td>
						<td>: 
							{{$resume_pulang->val->lochea ?? ''}}
							@if($resume_pulang->val->warna)
							, Warna {{$resume_pulang->val->warna ?? ''}}
							@endif
							@if($resume_pulang->val->bau)
							, Bau {{$resume_pulang->val->bau ?? ''}}
							@endif
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<table class="bot">
		<tr>
			<td>EDUKASI/PENYULUHAN KESEHATAN YANG SUDAH DIBERIKAN</td>
		</tr>
		<tr>
			<td class="pl-20" width="55%">
				{!! !empty($resume_pulang->val->penyakit) ? '- Penyakit dan pengobatannya<br>' : '' !!}
				{!! !empty($resume_pulang->val->mengatasi_nyeri) ? '- Mengatasi Nyeri<br>' : '' !!}
				{!! !empty($resume_pulang->val->persiapan_lingkungan) ? '- Persiapan lingkungan dan fasilitas untuk perawatan di rumah<br>' : '' !!}
				{!! !empty($resume_pulang->val->perawatan_rumah) ? '- Perawatan di rumah<br>' : '' !!}
			</td>
			<td class="pl-20" width="45%">
				{!! !empty($resume_pulang->val->perawatan_luka) ? '- Perawatan luka<br>' : '' !!}
				{!! !empty($resume_pulang->val->perawatan_ibu) ? '- Perawatan ibu dan bayi<br>' : '' !!}
				{!! !empty($resume_pulang->val->nasehat) ? '- Nasehat Keluarga Berencana<br>' : '' !!}
			</td>
		</tr>
	</table>
	<table>
		<tr>
			<td>DIAGNOSA KEPERAWATAN SELAMA DIRAWAT</td>
		</tr>
		<tr>
			<td class="pl-20">- {{$resume_pulang->val->diagnosa_keperawatan ?? '-'}}</td>
		</tr>
	</table>
	<table class="bot">
		<tr>
			<td>ANJURAN KEPERAWATAN KHUSUS SETELAH PULANG</td>
		</tr>
		<tr>
			<td class="pl-20">- {{$resume_pulang->val->anjuran_keperawatan ?? '-'}}</td>
		</tr>
	</table>
	<table>
		<tr>
			<td>MANAJEMEN NYERI</td>
		</tr>
		<tr>
			<td class="pl-20">Obat yang diminum / anti nyeri : {{$resume_pulang->val->obat_diminum ?? '-'}}</td>
		</tr>
		<tr>
			<td class="pl-20">Efek Samping : {{$resume_pulang->val->efek_samping ?? '-'}}</td>
		</tr>
		<tr>
			<td class="pl-20">Bila nyeri bertambah berta segera ke RS : {{$resume_pulang->val->nyeri_bertambah ?? '-'}}</td>
		</tr>
	</table>
	<table>
		<tr>
			<td colspan="2">Barang dan hasil pemeriksaan yang diserahkan pada pasien/keluarga</td>
		</tr>
		<tr>
			<td class="pl-20" width="50%">
				<table>
					<tr>
						<td width="50%">- Hasil Laborat</td>
						<td width="50%">: {{$resume_pulang->val->hasil_laborat ?? '0'}} Lembar</td>
					</tr>
					<tr>
						<td>- Foto Rontgen</td>
						<td>: {{$resume_pulang->val->rontgen ?? '0'}} Lembar</td>
					</tr>
					<tr>
						<td>- CT Scan</td>
						<td>: {{$resume_pulang->val->ct_scan ?? '0'}} Lembar</td>
					</tr>
					<tr>
						<td>- MRI/MRA</td>
						<td>: {{$resume_pulang->val->mri ?? '0'}} Lembar</td>
					</tr>
					<tr>
						<td>- Hasil USG</td>
						<td>: {{$resume_pulang->val->usg ?? '0'}} Lembar</td>
					</tr>
					<tr>
						<td>- Surat Keterangan Sakit</td>
						<td>: {{$resume_pulang->val->sk_sakit ?? '0'}} Lembar</td>
					</tr>
				</table>
			</td>
			<td width="50%" style="vertical-align: top;">
				{!! !empty($resume_pulang->val->asuransi) ? '- Surat Asuransi<br>' : '' !!}
				{!! !empty($resume_pulang->val->resume) ? '- Resume Pasien Pulang<br>' : '' !!}
				{!! !empty($resume_pulang->val->buku_bayi) ? '- Buku Bayi<br>' : '' !!}
				{!! !empty($resume_pulang->val->kartu_goldar) ? '- Kartu Golongan Darah Bayi<br>' : '' !!}
				{!! !empty($resume_pulang->val->sk_lahir) ? '- Surat Keterangan Lahir<br>' : '' !!}
				{!! !empty($resume_pulang->val->barang_lain2) ? '- '.$resume_pulang->val->barang_lain2.'<br>' : '' !!}
			</td>
		</tr>
	</table>
	<table class="bot">
		<tr>
			<td width="20%">Obat yang dibawa</td>
			<td>: {{$resume_pulang->val->obat_dibawa ?? '-'}}</td>
		</tr>
		<tr>
			<td>Bayi diserahkan oleh</td>
			<td>: {{$resume_pulang->val->bayi_diserahkan ?? '-'}}</td>
		</tr>
	</table>
	<table>
		<tr>
			<td colspan="4">RENCANA KONTROL SELANJUTNYA</td>
		</tr>
		<tr>
			<td width="15%" class="bordered centered">Tanggal</td>
			<td width="10%" class="bordered centered">Jam</td>
			<td width="50%" class="bordered centered">Klinik yang dituju</td>
			<td width="25%" class="bordered centered">Bagian</td>
		</tr>
		<tr>
			<td class="bordered centered">{{$resume_pulang->val->tgl_kontrol ?? '-'}}</td>
			<td class="bordered centered">{{$resume_pulang->val->jam_kontrol ?? '-'}}</td>
			<td class="bordered centered">{{$resume_pulang->val->klinik ?? '-'}}</td>
			<td class="bordered centered">{{$resume_pulang->val->bagian ?? '-'}}</td>
		</tr>
	</table>
	<br>
	<table>
		<tr>
			<td width="40%" class="centered">Diserahkan</td>
			<td width="20%"></td>
			<td width="40%" class="centered">Diterima</td>
		</tr>
		<tr>
			<td width="40%" class="centered">Surabaya, {{indonesian_date(date('d F Y'))}}</td>
			<td width="20%"></td>
			<td width="40%" class="centered">Surabaya, {{indonesian_date(date('d F Y'))}}</td>
		</tr>
		<tr>
			<td colspan="3" class="dummy">dummy</td>
		</tr>
		<tr>
			<td class="centered">{{$dokter->name}}</td>
			<td></td>
			<td class="centered">{{$keluarga}}</td>
		</tr>
	</table>
</body>
</html>