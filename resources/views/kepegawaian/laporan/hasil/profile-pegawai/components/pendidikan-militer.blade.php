{{-- Pendidikan Militer --}}
<div>
	<h5 class="subjudul text-bold">Pendidikan Militer</h5>
</div>
@if ($pegawai->militaries->count() > 0)
<div style="margin-left: 10px">
	<table style="width: 100%">
		<tbody>
			@php $militaries = $pegawai->militaries @endphp
			@php $batas_baris = ceil(count($militaries)/2) @endphp
			<!-- {{-- Mengambil Batas Jumlah Baris --}} -->
			@foreach ($militaries as $dikmil)
			<tr>
				<td class="text-center" style="width: 4%">{{$loop->iteration}}.</td>
				<td class="pad-right" style="width: 30%">{{$dikmil->name ?? '-'}}</td>
				<td class="pad-left" style="width: 16%" >{{$dikmil->tmt ?? '-'}}</td>

				<!-- {{-- Mengambil Index Yang Akan di Print di Kolom Bagian 2 --}} -->
				@php $index = $loop->index + $batas_baris @endphp
				@php $index = (int)$index; @endphp
				@if($index < $loop->count)
				<td class="text-center" style="width: 4%">{{$index + 1}}.</td>
				<td class="pad-right" style="width: 30%">{{$militaries[$index]->name ?? '-'}}</td>
				<td class="pad-left" style="width: 16%" >{{$militaries[$index]->tmt ?? '-'}}</td>
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