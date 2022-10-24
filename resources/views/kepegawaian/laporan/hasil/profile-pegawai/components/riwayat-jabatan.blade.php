{{-- Riwayat Jabatan --}}
<div>
	<h5 class="subjudul text-bold">Riwayat Jabatan/Penugasan</h5>
</div>
@if (count($pegawai->riwayat_jabatan) > 0)  
<div>
	<div style="margin-left: 10px">
		<table style="width: 100%">
			<tbody>
				@foreach ($pegawai->riwayat_jabatan as $key => $jabatan)
				<tr>
					<td style="vertical-align: top; width: 4%">{{$key+1}}.</td>
					<td style="vertical-align: top; width: 50%">{{ $jabatan->nama }}</td>
					<td style="vertical-align: top; width: 19%; text-align: center;">{{ date('d/m/y', strtotime( $jabatan->tmt)) ?? '-'}}</td>
					<td style="vertical-align: top; width: 25%; text-align: center;">{{ $jabatan->st_number }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@else
<div style="margin-left: 30px">
	<p>Tidak ada data.</p>
</div>
@endif