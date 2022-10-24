<table>
	<tr>
		<td colspan="12">INDEKS DOKTER</td>
	</tr>
	<tr>
		<td td colspan="15">Tanggal : {{date('d F Y', strtotime($start))}} -  {{date('d F Y', strtotime($end))}}</td>
	</tr>
</table>

@foreach($dokter as $user)
<table>
	<tr>
		<td colspan="2">Kode Dokter</td>
		<td>: </td>
	<tr>
		<td colspan="2">Nama Dokter</td>
		<td>{{$user->name}}</td>
	</tr>
	<tr>
		<td rowspan="2">No</td>
		<td rowspan="2">No RM</td>
		<td colspan="7">Umur</td>
		<td rowspan="2">Bangsal/Poli</td>
		<td rowspan="1" colspan="3">Layanan</td>
		<td rowspan="2">Kelas</td>
		<td colspan="2">Tanggal</td>
		<td rowspan="2">Lama Perawatan</td>
		<td colspan="2">Diagnosa</td>
		<td rowspan="2">Tindakan</td>
		<td colspan="3">Hasil</td>
		<td rowspan="2">Keterangan</td>
	</tr>
	<tr>
		<td>&lt; 1</td>
		<td>1-4</td>
		<td>5-14</td>
		<td>15-24</td>
		<td>25-44</td>
		<td>45-64</td>
		<td>65+</td>
		<td>RJ</td>
		<td>IGD</td>
		<td>R.Inap</td>
		<td>Masuk</td>
		<td>Keluar</td>
		<td>Utama</td>
		<td>Tambahan</td>
		<td>Sembuh</td>
		<td>Meninggal</td>
		<td>Lainnya</td>
	</tr>
	@foreach($user->kasus as $kasus)
	<tr>
		<td>{{$loop->iteration}}</td>
		<td>{{$kasus->pasien->no_rm ?? ''}}</td>
		<td>@if($kasus->identitas->age_year < 1)  {{$kasus->identitas->age}} @endif</td>
		<td>@if($kasus->identitas->age_year >= 1 && $kasus->identitas->age_year <= 4)  {{$kasus->identitas->age_year}} @endif</td>
		<td>@if($kasus->identitas->age_year >= 5 && $kasus->identitas->age_year <= 14)  {{$kasus->identitas->age_year}} @endif</td>
		<td>@if($kasus->identitas->age_year >= 15 && $kasus->identitas->age_year <= 24)  {{$kasus->identitas->age_year}} @endif</td>
		<td>@if($kasus->identitas->age_year >= 25 && $kasus->identitas->age_year <= 44)  {{$kasus->identitas->age_year}} @endif</td>
		<td>@if($kasus->identitas->age_year >= 45 && $kasus->identitas->age_year <= 64)  {{$kasus->identitas->age_year}} @endif</td>
		<td>@if($kasus->identitas->age_year >= 65)  {{$kasus->identitas->age_year}} @endif</td>
		<td>{{$kasus->lokasi->lokasi->nama ?? ''}}</td>
		<td>@if($kasus->tipe_rj == 1) X @endif</td>
		<td>@if($kasus->tipe_igd == 1) X @endif</td>
		<td>@if($kasus->tipe_ri == 1) X @endif</td>
		<td>{{$kasus->kelas->nama ?? ''}}</td>
		<td>
			@if($kasus->tipe_ri)
				@if(!empty($kasus->mrs_at)) 
					{{indonesian_date($kasus->mrs_at,'d M Y')}}
				@else
					{{indonesian_date($kasus->created_at,'d M Y')}}
				@endif
			@else
				{{indonesian_date($kasus->created_at,'d M Y')}}
			@endif
		</td>
		<td>@if(!empty($kasus->krs_at)) {{indonesian_date($kasus->krs_at,'d M Y')}}@endif</td>
		<td>{{$kasus->lama_perawatan}}</td>
		<td>
			{{$kasus->diagnosisUtama->icd10->code_icd ?? ''}}
		</td>
		<td>
			@foreach($kasus->diagnosisTambahan as $dx)
				{{$dx->icd10->code_icd ?? ''}}
				@if(!$loop->last), @endif
			@endforeach
		</td>
		<td>
			@foreach($kasus->tindakan_icd9 as $tx)
			{{$tx->icd9->code_icd ?? ''}}
			@if(!$loop->last), @endif
			@endforeach
		</td>
		@php
			$status_krs = $kasus->status_krs->nama ?? '';
		@endphp
		<td>
			@if($status_krs == 'Sehat')
			Sehat
			@endif
		</td>
		<td>
			@if($status_krs == 'Meninggal')
			Meninggal
			@endif
		</td>
		<td>
			@if($status_krs != 'Sehat' && $status_krs !='Meninggal' )
			{{$status_krs}}
			@endif
		</td>
		<td></td>
	</tr>

	@endforeach
	<tr><td></td></tr>
	<tr><td></td></tr>
	<tr><td></td></tr>
</table>
@endforeach