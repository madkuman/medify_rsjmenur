<table>
	<tr>
		<td colspan="5">
			DATA PELAYANAN PASIEN RAWAT INAP
		</td>
	</tr>
	<tr>
		<td colspan="5">
			Periode Waktu {{indonesian_date($date_start)}} - {{indonesian_date($date_start)}}
		</td>
	</tr>
	<tr>
		<td colspan="5">
			{{config('app.name')}}
		</td>
	</tr>
	<tr></tr>
	<tr>
		<td rowspan="2">No.</td>
		<td rowspan="2">No. RM</td>
		<td rowspan="2">Nama Pasien</td>
		<td rowspan="2">NIK</td>
		<td rowspan="2">Alamat</td>
		<td rowspan="2">Jenis Kelamin</td>
		<td rowspan="2">Status Pernikahan</td>
		<td rowspan="2">No. Hp</td>
		<td rowspan="2">Tempat Lahir</td>
		<td rowspan="2">Tanggal Lahir</td>
		<td rowspan="2">Umur</td>
		<td rowspan="2">Pekerjaan</td>
		<td rowspan="2">Agama</td>
		<td rowspan="2">Pendidikan</td>
		<td rowspan="2">Bahasa</td>
		<td rowspan="2">Suku</td>
		<td rowspan="2">Jenis Bayar</td>
		<td rowspan="2">Kelas Bayar</td>
		<td rowspan="2">No. Asuransi</td>
		<td rowspan="2">No. SEP</td>
		<td rowspan="2">Plafon</td>
		<td rowspan="2">Total Tagihan</td>
		<td rowspan="2">Masuk Dari</td>
		<td rowspan="2">Ruangan</td>
		<td rowspan="2">Kamar</td>
		<td rowspan="2">Tgl MRS</td>
		<td rowspan="2">Tgl KRS</td>
		<td rowspan="2">Lama Dirawat</td>
		<td rowspan="2">DPJP</td>
		<td rowspan="2">Kode ICD 10</td>
		<td rowspan="2">Diagnosa Utama</td>
		<td rowspan="2">Diagnosis</td>
		<td rowspan="2">Kode ICD 9</td>
		<td rowspan="2">Tindakan</td>
		<td rowspan="2">Status Keluar RS</td>
		<td rowspan="2">Jam Meninggal</td>
		<td rowspan="2">Alasan Keluar RS</td>
	@if(config('app.is_military'))
		<td colspan="6">Pasien Adalah Anggota</td>
	@endif
		<td colspan="5">Data Keluarga / Kerabat yang bisa dihubungi</td>
	@if(config('app.is_military'))
		<td colspan="7">Pasien memiliki Kerabat Anggota</td>
	@endif
	</tr>
	<tr>
	@if(config('app.is_military'))
		<td>Nama Anggota</td>
		<td>NRP/NIP</td>
		<td>Keanggotaan</td>
		<td>Pangkat</td>
		<td>Kotoma</td>
		<td>Satker</td>
	@endif
		<td>Nama</td>
		<td>Jenis Kelamin</td>
		<td>Alamat</td>
		<td>No. Telp</td>
		<td>Hubungan</td>
	@if(config('app.is_military'))
		<td>Nama Anggota</td>
		<td>NRP/NIP</td>
		<td>Keanggotaan</td>
		<td>Pangkat</td>
		<td>Kotama</td>
		<td>Satker</td>
		<td>Hubungan</td>
	@endif
	</tr>
	<!-- SELAMAT MENIKMATI TERNARY IF BUAT YANG NGEDIT INI :* -->
	@foreach($data as $key => $item)
	<tr>
		<td>{{$key+1}}</td>
		<td>{{$item->pasien->no_rm}}</td>
		<td>{{$item->pasien->name}}</td>
		<td>{{$item->pasien->no_identitas ?? '-'}}</td>
		<td>{{$item->pasien->address ?? '-'}}</td>
		<td>{{$item->pasien->gender == 1 ? 'Laki-laki' : 'Perempuan'}}</td>
		<td>-</td>
		<td>{{$item->pasien->phone ?? '-'}}</td>
		<td>{{$item->pasien->place_of_birth ?? '-'}}</td>
		<td>{{!empty($item->pasien->date_of_birth) && $item->pasien->date_of_birth != '0000-00-00' ? date("d-m-Y", strtotime($item->pasien->date_of_birth)) : '-'}}</td>
		<td>{{$item->pasien->age ?? '-'}}</td>
		<td>{{$item->kasus->identitas->pekerjaan ?? '-'}}</td>
		<td>{{$item->pasien->agama->nama ?? '-'}}</td>
		<td>{{$item->pasien->pendidikan->nama ?? '-'}}</td>
		<td>{{$item->pasien->bahasa ?? '-'}}</td>
		<td>{{$item->pasien->suku ?? '-'}}</td>
		<td>{{$item->kasus->pembayaran->perusahaan->nama ?? '-'}}</td>
		<td>{{$item->kasus->pembayaran->kelas->nama ?? '-'}}</td>
		<td>{{$item->kasus->pembayaran->no_asuransi ?? '-'}}</td>
		<td>{{$item->kasus->sep->no_sep ?? '-'}}</td>
		<td>{{$item->kasus->sep->total_plafon ?? '-'}}</td>
		<td>{{$item->kasus->tagihan_total ?? '-'}}</td>
		<td></td>
		<td>{{$item->kasus->lokasi->lokasi->nama ?? '-'}}</td>
		<td></td>
		<td>{{!empty($item->kasus->mrs_at) && $item->kasus->mrs_at != '0000-00-00 00:00:00' ? date("d-m-Y", strtotime($item->kasus->mrs_at)) : date("d-m-Y", strtotime($item->waktu_masuk))}}</td>
		<td>{{!empty($item->kasus->krs_at) && $item->kasus->krs_at != '0000-00-00 00:00:00' ? date("d-m-Y", strtotime($item->kasus->krs_at)) : '-'}}</td>
		<td>
			@php $mrs_date = !empty($item->kasus->mrs_at) && $item->kasus->mrs_at != '0000-00-00 00:00:00' ? \Carbon\Carbon::parse($item->kasus->mrs_at) : \Carbon\Carbon::parse($item->waktu_masuk); @endphp
			@if(!empty($item->kasus->krs_at) && $item->kasus->krs_at != '0000-00-00 00:00:00')
			@php $krs_date = \Carbon\Carbon::parse($item->kasus->krs_at); @endphp
			@else
			@php $krs_date = \Carbon\Carbon::now(); @endphp
			@endif
			{{$mrs_date->diffInDays($krs_date)}} Hari
		</td>
		<td>{{$item->kasus->dpjp->user->name ?? '-'}}</td>
		<td>{{$item->kasus->diagnosisUtama->icd10->code_icd ?? ''}}</td>
		<td>{{$item->kasus->diagnosisUtama->icd10->code_icd ?? ''}} {{$item->kasus->diagnosisUtama->icd10->long_desc ?? ''}}</td>
		<td>
			@if(count($item->kasus->diagnosis) > 0)
			@foreach($item->kasus->diagnosis as $diagnosis)
			{{$diagnosis->icd10->code_icd ?? ''}} {{$diagnosis->icd10->long_desc ?? ''}}<br>
			@endforeach
			@endif
		</td>
		<td>
			@if(count($item->kasus->tindakan_icd9) > 0)
			{{$item->kasus->tindakan_icd9[0]->icd9->code_icd ?? ''}}
			@endif
		</td>
		<td>
			@if(count($item->kasus->tindakan_icd9) > 0)
			@foreach($item->kasus->tindakan_icd9 as $tindakan)
			{{$tindakan->desc ?? ''}}<br>
			@endforeach
			@endif
		</td>
		<td>{{$item->kasus->status_krs->nama ?? ''}}</td>
		<td>{{!empty($item->pasien->death_at) && $item->pasien->death_at != '0000-00-00 00:00:00' ? date("H:i", strtotime($item->pasien->death_at)) : ''}}</td>
		<td>{{$item->kasus->krs_alasan ?? ''}}</td>
	@if(config('app.is_military'))
		<td>{{$item->pasien->is_anggota == 1 ? $item->pasien->name : ''}}</td>
		<td>{{$item->pasien->is_anggota == 1 ? $item->pasien->tni_nrp : ''}}</td>
		<td>{{$item->pasien->is_anggota == 1 ? $item->pasien->tni_keanggotaan->nama ?? '-' : ''}}</td>
		<td>{{$item->pasien->is_anggota == 1 ? $item->pasien->tni_pangkat->nama ?? '-' : ''}}</td>
		<td>{{$item->pasien->is_anggota == 1 ? $item->pasien->tni_kotama->nama ?? '-' : ''}}</td>
		<td>{{$item->pasien->is_anggota == 1 ? $item->pasien->tni_satker->nama ?? '-' : ''}}</td>
	@endif
		<td>{{$item->pasien->wali->name ?? ''}}</td>
		<td>{{!empty($item->pasien->wali) ? $item->pasien->wali->gender == 1 ? 'Laki-laki' : 'Perempuan' : ''}}</td>
		<td>{{$item->pasien->wali->address ?? ''}}</td>
		<td>{{$item->pasien->wali->phone ?? ''}}</td>
		<td>{{$item->pasien->jenis_hubungan_keluarga->nama ?? ''}}</td>

	@if(config('app.is_military'))
		<td>{{!empty($item->pasien->wali) ? $item->pasien->wali->is_anggota == 1 ? $item->pasien->wali->name : '' : ''}}</td>
		<td>{{!empty($item->pasien->wali) ? $item->pasien->wali->is_anggota == 1 ? $item->pasien->wali->tni_nrp : '' : ''}}</td>
		<td>{{!empty($item->pasien->wali) ? $item->pasien->wali->is_anggota == 1 ? $item->pasien->wali->tni_keanggotaan->nama ?? '-' : '' : ''}}</td>
		<td>{{!empty($item->pasien->wali) ? $item->pasien->wali->is_anggota == 1 ? $item->pasien->wali->tni_pangkat->nama ?? '-' : '' : ''}}</td>
		<td>{{!empty($item->pasien->wali) ? $item->pasien->wali->is_anggota == 1 ? $item->pasien->wali->tni_kotama->nama ?? '-' : '' : ''}}</td>
		<td>{{!empty($item->pasien->wali) ? $item->pasien->wali->is_anggota == 1 ? $item->pasien->wali->tni_satker->nama ?? '-' : '' : ''}}</td>
		<td>{{$item->pasien->jenis_hubungan_keluarga->nama ?? ''}}</td>
	@endif
	</tr>
	@endforeach
</table>