<div>
	<h5 class="subjudul text-bold">Riwayat Pangkat</h5>
</div>
@if (count($pegawai->riwayat_pangkat) > 0)
<div style="margin-left: 10px">
	<table style="width: 100%">
		<tbody>
			@php $riwayat_pangkat = $pegawai->riwayat_pangkat @endphp
			@php $batas_baris = ceil(count($riwayat_pangkat)/2) @endphp
			<!-- {{-- Mengambil Batas Jumlah Baris --}} -->

			@foreach ($riwayat_pangkat as $pangkat)
			<tr>
				<td style="width: 4%">{{$loop->iteration}}.</td>
				<td style="width: 24%">{{$pangkat->nama}} {{$pangkat->korps}}</td>
				<td style="width: 22%">{{ date('d/m/y', strtotime( $pangkat->tmt)) ?? '-'}}</td>

				<!-- {{-- Mengambil Index Yang Akan di Print di Kolom Bagian 2 --}} -->
				@php $index = $loop->index + $batas_baris @endphp
				@php $index = (int)$index; @endphp
				@if($index < $loop->count)
				<td style="width: 4%">{{$index + 1}}.</td>
				<td style="width: 24%">{{$riwayat_pangkat[$index]->nama}} {{$pangkat->korps}}</td>
				<td style="width: 22%">{{ date('d/m/y', strtotime( $riwayat_pangkat[$index]->tmt)) ?? '-'}}</td>
				@endif 

			</tr>
			<!-- {{-- Berhenti jika sudah mencapai batas baris --}} -->
			@php if($batas_baris == $loop->iteration) break @endphp
			@endforeach
		</tbody>
	</table>
</div>
@else
<div style="margin-left: 30px">
	<p>Tidak ada data.</p>
</div>
@endif