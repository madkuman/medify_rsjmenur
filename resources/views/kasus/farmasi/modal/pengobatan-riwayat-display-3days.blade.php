<div class="block-content" style="height: 530px; overflow-x: scroll; overflow-y: scroll; display: none;" id="kasus-farmasi-rpo-display-3days">

	<div class="row gutters-tiny mb-20">
		<div class="col-lg-2 col-md-3 col-6">
			<label>Tanggal Awal</label>
			<input class="form-control" type="date" value="{{Carbon\Carbon::now()->subDays(2)->format('Y-m-d')}}" readonly id="input-cpo-display3days-date-start">
		</div>
		<div class="col-lg-2 col-md-3 col-6">
			<label>Tanggal Akhir</label>
			<input class="form-control" type="date" value="{{Carbon\Carbon::now()->format('Y-m-d')}}" id="input-cpo-display3days-date-end">
		</div>
		<div class="col-lg-2 col-md-3 col-6">
			<label>Filter Obat</label>
			<select class="form-control" id="input-cpo-display3days-filter-obat">
				<option value="all">Semua</option>
				<option value="1">Dikonsumsi</option>
				<option value="0">Tidak Dikonsumsi</option>
			</select>
		</div>
		<div class="col-lg-2 col-md-3 col-6">
			<label>Tampilkan</label>
			<select class="form-control" id="input-cpo-display3days-time-display">
				<option value="waktu" @if(config('medify.kasus.riwayat_pemberian_obat.default_time_display','waktu') == 'waktu') selected @endif>Waktu</option>
				<option value="jam" @if(config('medify.kasus.riwayat_pemberian_obat.default_time_display','waktu') == 'jam') selected @endif>Jam</option>
			</select>
		</div>
		<div class="col-lg-2 col-md-12 col-12">
			<div class="progress push progress-data-loader-loading">
				<div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%;">
					<span class="progress-bar-label">0%</span>
				</div>
			</div>
		</div>
	</div>

	<table class="table table-bordered table-striped table-vcenter">
		<thead>
			<tr>
				<th rowspan="2" style="width:300px">Nama Obat</th>
				@php $dates = [1,2,3] @endphp
				@php $timestamps = ['Pg','Si','So','Mlm','Ex'] @endphp
				@php $waktu = ['04.00-09.59', '10.00-13.59','14.00-17.59','18.00-21.59','22.00-03.59']; @endphp
				@foreach($dates as $index_date => $date)
				<th class="text-center" colspan="5" id="kasus-farmasi-rpo-display-3days-date-{{$index_date+1}}">{{$date}}</th>
				@endforeach
			</tr>
			<tr>
				@foreach($dates as $date)
				@foreach($timestamps as $idx => $timestamp)
				<td class="text-center text-capitalize">{{$timestamp}} <br><small class="badge badge-secondary">{{$waktu[$idx]}}</small></td>
				@endforeach
				@endforeach
			</tr>

			@foreach($pengobatan as $index => $obat)
			<tr class="kasus-farmasi-rpo-display-3days-container kasus-farmasi-rpo-data-konsumsi-empty kasus-farmasi-rpo-display-3days-{{$obat->id}}"
				@if($index%2 == 0) style="background: #f1f1f1;border: solid 1px #ccc;" @endif
				>
				<td>{{$obat->nama_obat}}</td>
				@foreach($dates as $index_date => $date)
				@foreach($timestamps as $timestamp)

				<td style="width:50px" class="kasus-farmasi-rpo-display-3days-content-{{$index_date+1}}-{{$timestamp}}">
					<span class="kasus-farmasi-rpo-display-3days-pemakaian-waktu" style="display:none"></span>
					<span class="kasus-farmasi-rpo-display-3days-pemakaian-jam" style="display:none"></span>
				</td>
				@endforeach
				@endforeach
			</tr>
			@endforeach
		</thead>
		<tbody>

		</tbody>
	</table>
</div>