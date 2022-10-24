	<table>
		<tr>
			<td colspan="{{(count($data_usia)*count($data_jenis_kelamin))+4}}">LAPORAN DEMOGRAFI
				@if($layanan=='igd') LAYANAN IGD
				@elseif($layanan=='rj') LAYANAN RAWAT JALAN
				@elseif($layanan=='ri') LAYANAN RAWAT INAP
				@elseSEMUA LAYANAN
				@endif
			</td>
		</tr>
		<tr>
			<td colspan="{{(count($data_usia)*count($data_jenis_kelamin))+4}}">PERIODE : {{$start}} - {{$end}}</td>
		</tr>
		<tr>
			<td colspan="{{(count($data_usia)*count($data_jenis_kelamin))+4}}">RENTANG USIA : @if($usia=='semua') SEMUA @else {{$usia}} TAHUN @endif DAN JENIS KELAMIN :
				@if($jenis_kelamin=='semua') SEMUA
				@elseif($jenis_kelamin==1) LAKI-LAKI
				@else PEREMPUAN
				@endif
			</td>
		</tr>
		<tr></tr>
		<tr>
			<td rowspan="2">NO</td>
			<td rowspan="2">PROVINSI</td>
			<td rowspan="2">KABUPATEN/KOTA</td>
			<td rowspan="2">KECAMATAN</td>
			@foreach($data_usia as $i => $each_usia)
			<td @if(count($data_jenis_kelamin) == 2) colspan="2" @endif>{{$data_usia[$i]}}</td>
			@endforeach
		</tr>
		<tr>
			@foreach($data_usia as $i => $each_usia)
			@foreach($data_jenis_kelamin as $i => $each_jenis_kelamin)
			<td>{{$data_jenis_kelamin[$i]}}</td>
			@endforeach
			@endforeach
		</tr>
		@php
		$i=0;
		@endphp
		@if(count($data) > 0)
		@foreach($data as $provinsi)
		<tr>
			<td rowspan="{{$provinsi->jumlah_kecamatan_provinsi}}">{{++$i}}</td>
			<td rowspan="{{$provinsi->jumlah_kecamatan_provinsi}}">{{$provinsi->nama}}</td>
			@php($j=1)
			@foreach($provinsi->kota as $kota)
			@if($j > 1)
			<tr>
				@endif
				<td rowspan="{{$kota->jumlah_kecamatan_kabupaten}}">{{$kota->nama}}</td>
				@php($l=1)
				@foreach($kota->kecamatan as $kecamatan)
				@if($l > 1)
				<tr>
					@endif
					<td>{{$kecamatan->nama}}</td>
					@foreach($data_usia as $index =>$each_usia)
					@foreach($data_jenis_kelamin as $each_jk)
					<td>{{$kecamatan[$each_usia.$each_jk]}}</td>
					@endforeach
					@endforeach
					@php($l++)
					@endforeach
					@php($j++)
					@endforeach
				</tr>
				@endforeach
				@else
				<tr>
					<td rowspan="2" colspan="{{(count($data_usia)*count($data_jenis_kelamin))+4}}">Data Tidak Ditemukan</td>
				</tr>
				@endif
			</table>