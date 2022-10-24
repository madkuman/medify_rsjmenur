<table style="width: 100%">
	<tbody>
		<tr>
			<td style="vertical-align: top; width: 4%; text-align: center;">1.</td>
			<td style="vertical-align: top; width: 21%;">Nama</td>
			<td style="vertical-align: top; width: 2%;">:</td>
			<td style="vertical-align: top; width: 43%">{{$pegawai->name}}</td>
			<td style="width: 30%" rowspan="12">
				@php
				$path = public_path('/uploads/kepegawaian/profile/');
				@endphp 
				@if (file_exists($path.$pegawai->photo.".png"))
				<img src="{{ $path.$pegawai->photo.'.png' }}" style="width: 150px">
				@elseif(file_exists($path.$pegawai->photo.".jpg"))
				<img src="{{ $path.$pegawai->photo.'.jpg' }}" style="width: 150px">
				@elseif(file_exists($path.$pegawai->photo.".jpeg"))
				<img src="{{ $path.$pegawai->photo.'.jpeg' }}" style="width: 150px">
				@else
				<img src="{{ URL::asset('assets/img/avatars/avatar9.jpg') }}" style="width: 150px">
				@endif
			</td>
		</tr>
		<tr>
			<td style="vertical-align: top; text-align: center;">2.</td>
			<td style="vertical-align: top;">Tempat/Tgl. Lahir</td>
			<td class="text-center" style="vertical-align: top; width: 2%">:</td>
			<td>{{ $pegawai->kelahiran_format_new ?? '-'}}</td>
		</tr>
		<tr>
			<td style="vertical-align: top; text-align: center;">3.</td>
			<td style="vertical-align: top;">Pangkat/Korps</td>
			<td class="text-center" style="vertical-align: top; width: 2%">:</td>
			<td>{{$pegawai->pangkat}} {{$pegawai->korps}}</td>
		</tr>
		<tr>
			<td style="vertical-align: top; text-align: center;">4.</td>
			<td style="vertical-align: top;">Nrp</td>
			<td class="text-center" style="vertical-align: top; width: 2%">:</td>
			<td>{{ !empty($pegawai->nrp) ? $pegawai->nrp : '-' }}</td>
		</tr>
		<tr>
			<td style="text-align: center;">5.</td>
			<td>Jenis Kelamin</td>
			<td class="text-center" style="width: 2%">:</td>
			<td>{{ !empty($pegawai->gender) ? $pegawai->gender : '-' }}</td>
		</tr>
		<tr>
			<td style="vertical-align: top; text-align: center;">6.</td>
			<td style="vertical-align: top;">Gol. Darah</td>
			<td class="text-center" style="vertical-align: top; width: 2%">:</td>
			<td>{{ !empty($pegawai->blood_type) ? $pegawai->blood_type : '-' }}</td>
		</tr>
		<tr>
			<td style="vertical-align: top; text-align: center;">7.</td>
			<td style="vertical-align: top;">Status Keluarga</td>
			<td class="text-center" style="vertical-align: top; width: 2%">:</td>
			@php
			$marriage = $pegawai->marriages->first();
			@endphp
			<td>{{ !empty($marriage) ? $marriage->status . '/' . $marriage->total_child : '-' }}</td>
		</tr>
		<tr>
			<td style="vertical-align: top; text-align: center;">8.</td>
			<td style="vertical-align: top;">Jabatan</td>
			<td class="text-center" style="vertical-align: top; width: 2%">:</td>
			<td>{{$pegawai->jabatan}}</td>
		</tr>
		<tr>
			<td style="vertical-align: top; text-align: center;">9.</td>
			<td style="vertical-align: top;">Tmt. Jab</td>
			<td class="text-center" style="vertical-align: top; width: 2%">:</td>
			<td>{{ date('d/m/y', strtotime( $pegawai->st_kasal_tanggal_sp)) ?? '-'}}</td>
		</tr>
		<tr>
			<td style="vertical-align: top; text-align: center;">10.</td>
			<td style="vertical-align: top;">Alamat</td>
			<td class="text-center" style="vertical-align: top; width: 2%">:</td>
			<td>{{ !empty($pegawai->address) ? $pegawai->address : '-' }}</td>
		</tr>
		<tr>
			<td style="vertical-align: top; text-align: center;">11.</td>
			<td style="vertical-align: top;">No. Tlp</td>
			<td class="text-center" style="vertical-align: top; width: 2%">:</td>
			<td>{{ !empty($pegawai->phone) ? $pegawai->phone : '-' }}</td>
		</tr>
		<tr>
			<td style="vertical-align: top; text-align: center;">12.</td>
			<td style="vertical-align: top;">Tmt Masuk</td>
			<td class="text-center" style="vertical-align: top; width: 2%">:</td>
			<td>{{ !empty($pegawai->tmtFormattedReport) ? $pegawai->tmtFormattedReport : '-' }}</td>
		</tr>
	</tbody>
</table>