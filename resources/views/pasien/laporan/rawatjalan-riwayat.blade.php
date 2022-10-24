<table>
	<tr>
		<td colspan="12">LAPORAN PENDAFTARAN PASIEN</td>
	</tr>
	<tr>
		<td td colspan="5">Tanggal : {{date('d F Y', strtotime($start))}} -  {{date('d F Y', strtotime($end))}}</td>
	</tr>
</table>
@foreach($perusahaan as $pt)
@if(count($pt->transaksi_rj) > 0)
<table>
	<tr>
		<td colspan="2">Debitur: {{$pt->nama}}</td>
		<td>Jumlah: {{count($pt->transaksi_rj)}}</td>
	</tr>
	<tr>
		<td>No</td>
		<td>Nama Pasien</td>
		<td>No RM</td>
		<td>Umur</td>
		<td>JK</td>
		<td>Baru/Lama</td>
		<td>Kota</td>
		<td>Klinik</td>
		<td>Kode ICD</td>
		<td>Diagnosa</td>
		<td>Kelas Tarif</td>
		<td>Total Tagihan</td>
	</tr>
	@foreach($pt->transaksi_rj as $item)
	<tr>
		<td>{{$loop->iteration}}</td>
		<td>{{$item->kasus->pasien->name}}</td>
		<td>{{$item->kasus->pasien->no_rm}}</td>
		<td>{{$item->kasus->identitas->age}}</td>
		<td>@if($item->kasus->pasien->gender == 1) L @else P @endif</td>
		<td>@if($item->is_pasien_baru) B @else L @endif</td>
		<td>@if(!empty($item->kasus->pasien->alamat_kota->nama)) {{$item->kasus->pasien->alamat_kota->nama}} @else - @endif  </td>
		<td>{{$item->poliklinik->name}}</td>
		<td>
			@if(!empty($item->kasus->diagnosisUtama->icd10->code_icd))
			{{$item->kasus->diagnosisUtama->icd10->code_icd}}
			@else
			@foreach($item->kasus->diagnosis as $diagnosis)
			{{$diagnosis->icd10->code_icd}},
			@endforeach
			@endif
		</td>
		<td>
			@if(!empty($item->kasus->diagnosisUtama->icd10->code_icd))
			{{$item->kasus->diagnosisUtama->icd10->long_desc}}
			@else
			@foreach($item->kasus->diagnosis as $diagnosis)
			{{$diagnosis->icd10->long_desc}},
			@endforeach
			@endif
		</td>
		<td>{{$item->kasus->kelas->nama ?? '-'}}</td>
		<td>
			@php $total = 0 @endphp
			@foreach($item->kasus->daftar_tagihan as $item_tagihan)
			@php $total += $item_tagihan->total_bill @endphp
			@endforeach
			{{$total}}
		</td>
	</tr>
	@endforeach
</table>
@endif
@endforeach

<table>
	<tr>
		<td colspan="3">REKAPITULASI KUNJUNGAN</td>
	</tr>
	@php $total = 0 @endphp
	@foreach($perusahaan as $pt)
	<tr>
		<td>{{$loop->iteration}}</td>
		<td>{{$pt->nama}}</td>
		<td>{{count($pt->transaksi_rj)}}</td>
	</tr>
	@php $total = $total + count($pt->transaksi_rj) @endphp
	@endforeach
	<tr>
		<td></td>
		<td>TOTAL</td>
		<td>{{$total}}</td>
	</tr>
</table>