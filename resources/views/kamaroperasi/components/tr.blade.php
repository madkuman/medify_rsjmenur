@php $i = 1; @endphp
@foreach($transaksi as $item)
<tr>
	<td>{{$i ?? '-'}}</td>
	<td>{{$item->kasus->pasien->name ?? '-'}}<br><small>
		#{{$item->kasus->pasien->no_rm}}
		<br>
		@if($item->kasus->identitas->jenis_kelamin == "L")
        Laki laki
        @else
        Perempuan
        @endif
        , 
        @if(!empty($item->kasus->pasien->age))
        {{$item->kasus->pasien->age ?? '-'}} tahun
        @else
        {{$item->kasus->identitas->umur ?? '-'}} tahun
        @endif
	</small></td>
	<td>{{$item->kasus->lokasi->lokasi->nama ?? '-'}}</td>
	<td>{{$item->kasus->pembayaran->perusahaan->tipe->nama ?? '-'}} - {{$item->kasus->pembayaran->perusahaan->nama ?? '-'}}</td>
	<td>{{$item->jenis_spesialis->nama?? ''}}</td>
	<td>{{$item->kasus->diagnosisUtama->icd10->code_icd ?? '-'}} - {{$item->kasus->diagnosisUtama->icd10->long_desc ?? '-'}}</td>
	<td>{{$item->keterangan ?? '-'}}</td>
	<td>{{$item->created_at->format('Y-m-d') ?? '-'}}</td>
	<td>{{$item->pembuat_jadwal->name ?? '-'}}</td>
	<td>{{$item->masaTunggu()[0] ?? '-'}}<br>
	<td class=" text-center">
		<button type="button" class="btn btn-secondary dropdown-toggle" id="toolbarDrop" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Aksi</button>
		<div class="dropdown-menu" aria-labelledby="toolbarDrop">
			<a href="{{url('kamaroperasi/pendaftaran/')}}/{{$item->id}}" class="btn btn-primary dropdown-item" data-toggle="tooltip" data-placement="top" title="" data-original-title="Daftarkan">
				<i class="fa fa-check"></i> Daftarkan Pasien
			</a>
			<button class="btn btn-default btn-sm dropdown-item" onclick="{{$item->masaTunggu()[1]}}" id="{{$item->id}}" data-toggle="modal" data-target="#masa_tunggu_modal">
				<i class="fa fa-clock-o" aria-hidden="true"></i> Ubah Masa Tunggu
			</button>
			<button type="button" class="btn btn-outline-danger btn-fill tolak-pemesanan dropdown-item" onclick="tolakButton({{$item->id}})" data-toggle="tooltip" data-placement="top" title="" data-original-title="Tolak">
				<i class="fa fa-times" aria-hidden="true"></i> Tolak Permintaan
			</button>
		</div>
	</td>
</tr>
@php $i++; @endphp
@endforeach