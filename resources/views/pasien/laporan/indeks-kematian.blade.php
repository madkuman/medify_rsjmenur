<table>
	<tr>
		<td colspan="12">INDEKS KEMATIAN</td>
	</tr>
	<tr>
		<td td colspan="15">Tanggal : {{date('d F Y', strtotime($start))}} -  {{date('d F Y', strtotime($end))}}</td>
	</tr>
</table>

<table>
	<tr>
		<td rowspan="3">No</td>
		<td rowspan="3">No RM</td>
		<td colspan="14">Umur</td>
		<td rowspan="3">Bangsal/Poli</td>
		<td rowspan="3">Kelas</td>
		<td colspan="2" rowspan="2">Tanggal</td>
		<td rowspan="3">Lama Perawatan</td>
		<td colspan="2" rowspan="2">Diagnosa</td>
		<td rowspan="3">Tindakan</td>
		<td colspan="2" rowspan="2">Nama Dokter</td>
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
		<td>DPJP</td>
		<td>Sp.Bedah</td>
	</tr>
	@foreach($kasus as $item)
	<tr>
		<td>{{$loop->iteration}}</td>
		<td>{{$item->pasien->no_rm}}</td>
		<td>@if($item->identitas->age_year < 1 && $item->identitas->jenis_kelamin == 'L')  {{$item->identitas->age}} @endif</td>
		<td>@if($item->identitas->age_year < 1 && $item->identitas->jenis_kelamin == 'P' )  {{$item->identitas->age}} @endif</td>
		<td>@if($item->identitas->age_year >= 1 && $item->identitas->age_year <= 4  && $item->identitas->jenis_kelamin == 'L')  {{$item->identitas->age_year}} @endif</td>
		<td>@if($item->identitas->age_year >= 1 && $item->identitas->age_year <= 4  && $item->identitas->jenis_kelamin == 'P')  {{$item->identitas->age_year}} @endif</td>
		<td>@if($item->identitas->age_year >= 5 && $item->identitas->age_year <= 14 && $item->identitas->jenis_kelamin == 'L')  {{$item->identitas->age_year}} @endif</td>
		<td>@if($item->identitas->age_year >= 5 && $item->identitas->age_year <= 14 && $item->identitas->jenis_kelamin == 'P')  {{$item->identitas->age_year}} @endif</td>
		<td>@if($item->identitas->age_year >= 15 && $item->identitas->age_year <= 24 && $item->identitas->jenis_kelamin == 'L')  {{$item->identitas->age_year}} @endif</td>
		<td>@if($item->identitas->age_year >= 15 && $item->identitas->age_year <= 24 && $item->identitas->jenis_kelamin == 'P')  {{$item->identitas->age_year}} @endif</td>
		<td>@if($item->identitas->age_year >= 25 && $item->identitas->age_year <= 44 && $item->identitas->jenis_kelamin == 'L')  {{$item->identitas->age_year}} @endif</td>
		<td>@if($item->identitas->age_year >= 25 && $item->identitas->age_year <= 44 && $item->identitas->jenis_kelamin == 'P')  {{$item->identitas->age_year}} @endif</td>
		<td>@if($item->identitas->age_year >= 45 && $item->identitas->age_year <= 64 && $item->identitas->jenis_kelamin == 'L')  {{$item->identitas->age_year}} @endif</td>
		<td>@if($item->identitas->age_year >= 45 && $item->identitas->age_year <= 64 && $item->identitas->jenis_kelamin == 'P')  {{$item->identitas->age_year}} @endif</td>
		<td>@if($item->identitas->age_year >= 65 && $item->identitas->jenis_kelamin == 'L')  {{$item->identitas->age_year}} @endif</td>
		<td>@if($item->identitas->age_year >= 65 && $item->identitas->jenis_kelamin == 'P')  {{$item->identitas->age_year}} @endif</td>
		<td>{{$item->lokasi->lokasi->nama}}</td>
		<td>{{$item->kelas->nama}}</td>
		<td>{{date('d/M', strtotime($item->created_at))}}</td>
		<td>@if(!empty($item->krs_at)) {{date('d/M', strtotime($item->krs_at))}} @else @endif</td>
		<td>{{$item->lama_perawatan}}</td>
		<td>
			@if(!empty($item->diagnosisUtama->icd10->code_icd))
			{{$item->diagnosisUtama->icd10->code_icd}}
			@endif
		</td>
		<td>
			@foreach($item->diagnosisTambahan as $dx)
			{{$dx->icd10->code_icd}}@if(!$loop->last), @endif
			@endforeach
		</td>

		<td>
			@foreach($item->tindakan_icd9 as $tx)
			{{$tx->icd9->code_icd}}@if(!$loop->last), @endif
			@endforeach
		</td>
		<td>
			@if(!empty($item->admin->user->name))
			{{$item->admin->user->name}}
			@endif
		</td>
		<td>
			@foreach($item->operasi_selesai as $operasi)
			@if(!empty($operasi->transaksi->dokter->name))
			{{$operasi->transaksi->dokter->name}} @if(!$loop->last), @endif
			@endif
			@endforeach
		</td>
		<td></td>
	</tr>

	@endforeach
</table>