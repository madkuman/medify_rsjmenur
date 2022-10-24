{{-- Pendidikan Umum --}}
<div>
	<h5 class="subjudul text-bold">Pendidikan Umum</h5>
</div>
@if ($pegawai->educations->count() > 0)
<div style="margin-left: 10px">
	<table style="width: 100%">
		<tbody>
			@php $educations = $pegawai->educations @endphp
			@php $batas_baris = ceil(count($educations)/2) @endphp
			<!-- {{-- Mengambil Batas Jumlah Baris --}} -->
			@foreach ($educations as $dikum)
			<tr>
				<td class="text-center" style="width: 4%">{{$loop->iteration}}.</td>
				<td class="pad-right" style="width: 30%">{{$dikum->name ?? '-'}}</td>
				<td class="pad-left" style="width: 16%" >{{$dikum->tmt ?? '-'}}</td>

				<!-- {{-- Mengambil Index Yang Akan di Print di Kolom Bagian 2 --}} -->
				@php $index = $loop->index + $batas_baris @endphp
				@php $index = (int)$index; @endphp
				@if($index < $loop->count)
				<td class="text-center" style="width: 4%">{{$index + 1}}.</td>
				<td class="pad-right" style="width: 30%">{{$educations[$index]->name ?? '-'}}</td>
				<td class="pad-left" style="width: 16%" >{{$educations[$index]->tmt ?? '-'}}</td>
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