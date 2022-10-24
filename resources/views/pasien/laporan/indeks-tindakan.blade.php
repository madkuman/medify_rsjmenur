<table>
	<tr>
		<td colspan="12">INDEKS TINDAKAN</td>
	</tr>
	<tr>
		<td td colspan="15">Tanggal : {{date('d F Y', strtotime($start))}} -  {{date('d F Y', strtotime($end))}}</td>
	</tr>
</table>

@foreach($tindakan as $tx)
@if(count($tx->kasus) > 0)
<table>
	<tr>
		<td colspan="2">Kode ICD IX</td>
		<td colspan="8">: @if(!empty($tx->icd9->code_icd)) {{$tx->icd9->code_icd}} @endif</td>
	<tr>
		<td colspan="2">Tindakan</td>
		<td colspan="8">: @if(!empty($tx->icd9->code_icd)) {{$tx->icd9->long_desc}} @endif </td>
	</tr>
	<tr>
		<td rowspan="3">No</td>
		<td rowspan="3">No RM</td>
		<td colspan="14">Umur</td>
		<td rowspan="3">Bangsal/Poli</td>
		<td rowspan="3">Kelas</td>
		<td colspan="2" rowspan="2">Tanggal</td>
		<td rowspan="3">Lama Perawatan</td>
		<td colspan="2" rowspan="2">Diagnosa</td>
		<td colspan="3" rowspan="2">Hasil</td>
		<td rowspan="2" colspan="2">Nama Dokter</td>
		<td rowspan="3">Keterangan</td>
	</tr>
	<tr>
		<td colspan="2">&lt; 1</td>
		<td colspan="2">1-4</td>
		<td colspan="2">5-14</td>
		<td colspan="2">15-24</td>
		<td colspan="2">25-44</td>
		<td colspan="2">45-64</td>
		<td colspan="2">65+</td>
	</tr>
	<tr>
		<td>L</td>
		<td>P</td>
		<td>L</td>
		<td>P</td>
		<td>L</td>
		<td>P</td>
		<td>L</td>
		<td>P</td>
		<td>L</td>
		<td>P</td>
		<td>L</td>
		<td>P</td>
		<td>L</td>
		<td>P</td>
		<td>Masuk</td>
		<td>Keluar</td>
		<td>Primer</td>
		<td>Sekunder</td>
		<td>Sembuh</td>
		<td>Meninggal</td>
		<td>Lainnya</td>
		<td>DPJP</td>
		<td>Sp Bedah</td>
	</tr>
	@foreach($tx->kasus as $kasus)
	<tr>
		<td>{{$loop->iteration}}</td>
		<td>{{$kasus->pasien->no_rm}}</td>
		<td>@if($kasus->identitas->age_year < 1 && $kasus->identitas->jenis_kelamin == 'L')  {{$kasus->identitas->age}} @endif</td>
		<td>@if($kasus->identitas->age_year < 1 && $kasus->identitas->jenis_kelamin == 'P' )  {{$kasus->identitas->age}} @endif</td>
		<td>@if($kasus->identitas->age_year >= 1 && $kasus->identitas->age_year <= 4  && $kasus->identitas->jenis_kelamin == 'L')  {{$kasus->identitas->age_year}} @endif</td>
		<td>@if($kasus->identitas->age_year >= 1 && $kasus->identitas->age_year <= 4  && $kasus->identitas->jenis_kelamin == 'P')  {{$kasus->identitas->age_year}} @endif</td>
		<td>@if($kasus->identitas->age_year >= 5 && $kasus->identitas->age_year <= 14 && $kasus->identitas->jenis_kelamin == 'L')  {{$kasus->identitas->age_year}} @endif</td>
		<td>@if($kasus->identitas->age_year >= 5 && $kasus->identitas->age_year <= 14 && $kasus->identitas->jenis_kelamin == 'P')  {{$kasus->identitas->age_year}} @endif</td>
		<td>@if($kasus->identitas->age_year >= 15 && $kasus->identitas->age_year <= 24 && $kasus->identitas->jenis_kelamin == 'L')  {{$kasus->identitas->age_year}} @endif</td>
		<td>@if($kasus->identitas->age_year >= 15 && $kasus->identitas->age_year <= 24 && $kasus->identitas->jenis_kelamin == 'P')  {{$kasus->identitas->age_year}} @endif</td>
		<td>@if($kasus->identitas->age_year >= 25 && $kasus->identitas->age_year <= 44 && $kasus->identitas->jenis_kelamin == 'L')  {{$kasus->identitas->age_year}} @endif</td>
		<td>@if($kasus->identitas->age_year >= 25 && $kasus->identitas->age_year <= 44 && $kasus->identitas->jenis_kelamin == 'P')  {{$kasus->identitas->age_year}} @endif</td>
		<td>@if($kasus->identitas->age_year >= 45 && $kasus->identitas->age_year <= 64 && $kasus->identitas->jenis_kelamin == 'L')  {{$kasus->identitas->age_year}} @endif</td>
		<td>@if($kasus->identitas->age_year >= 45 && $kasus->identitas->age_year <= 64 && $kasus->identitas->jenis_kelamin == 'P')  {{$kasus->identitas->age_year}} @endif</td>
		<td>@if($kasus->identitas->age_year >= 65 && $kasus->identitas->jenis_kelamin == 'L')  {{$kasus->identitas->age_year}} @endif</td>
		<td>@if($kasus->identitas->age_year >= 65 && $kasus->identitas->jenis_kelamin == 'P')  {{$kasus->identitas->age_year}} @endif</td>
		<td>{{$kasus->lokasi->lokasi->nama}}</td>
		<td>{{$kasus->kelas->nama}}</td>
		<td>{{date('d/M', strtotime($kasus->created_at))}}</td>
		<td>@if(!empty($kasus->krs_at)) {{date('d/M', strtotime($kasus->krs_at))}} @else @endif</td>
		<td>{{$kasus->lama_perawatan}}</td>
		<td>
			@if(!empty($kasus->diagnosisUtama->icd10->code_icd))
			{{$kasus->diagnosisUtama->icd10->code_icd}}
			@endif
		</td>
		<td>
			@foreach($kasus->diagnosisTambahan as $dx)
			{{$dx->icd10->code_icd}}@if(!$loop->last), @endif
			@endforeach
		</td>
		<td>
			@if($kasus->status_krs->nama == 'Sehat')
			Sehat
			@endif
		</td>
		<td>
			@if($kasus->status_krs->nama == 'Meninggal')
			Meninggal
			@endif
		</td>
		<td>
			@if($kasus->status_krs->nama != 'Sehat' && $kasus->krs__status !='Meninggal' )
			{{$kasus->status_krs->nama}}
			@endif
		</td>
		<td>
			@if(!empty($kasus->admin->user->name))
			{{$kasus->admin->user->name}}
			@endif
		</td>
		<td>
			@foreach($kasus->operasi_selesai as $operasi)
			@if(!empty($operasi->transaksi->dokter->name))
			{{$operasi->transaksi->dokter->name}} @if(!$loop->last), @endif
			@endif
			@endforeach
		</td>
		<td></td>
	</tr>

	@endforeach
</table>
@endif
@endforeach