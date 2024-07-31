<div class="block-content" id="kasus-farmasi-rpo-display-1day">
	<div class="row justify-content-center">
		<div class="col-12 col-md-6 col-lg-5 col-xl-5">
			<div class="row">
				<div class="col-2">
					<button class="btn btn-secondary" id="button-cpo-display1day-yesterday">
						<i class="fa fa-arrow-left"></i>
					</button>
				</div>
				<div class="col-8">
					<input class="form-control" type="date" value="{{Carbon\Carbon::now()->format('Y-m-d')}}" id="input-cpo-display1day-date">
				</div>
				<div class="col-2">
					<button class="btn btn-secondary" id="button-cpo-display1day-tomorrow">
						<i class="fa fa-arrow-right"></i>
					</button>
				</div>
			</div>
			<div class="row gutters-tiny mt-10">
				<div class="col-4">
					<label>Filter Obat</label>
					<select class="form-control"  id="input-cpo-display1day-filter-obat">
						<option value="all">Semua</option>
						<option value="1">Dikonsumsi</option>
						<option value="0">Tidak Dikonsumsi</option>
					</select>
				</div>
				<div class="col-4">
					<label>Tampilkan</label>
					<select class="form-control" id="input-cpo-display1day-time-display">
						<option value="waktu" @if(config('medify.kasus.riwayat_pemberian_obat.default_time_display','waktu') == 'waktu') selected @endif>Waktu</option>
						<option value="jam" @if(config('medify.kasus.riwayat_pemberian_obat.default_time_display','waktu') == 'jam') selected @endif>Jam</option>
					</select>
				</div>
				<!-- <div class="col-4">
					<label>Stok Hari Ini</label>
					<select class="form-control" id="input-cpo-display1day-obat-stok">
						<option value="all">Semua</option>
						<option value="sisa">Tersisa</option>
						<option value="habis-hari-ini">Habis Hari Ini</option>
						<option value="habis-kemarin">Habis Sebelumnya</option>
						<option value="habis-hari-ini-kemarin">Habis Hari Ini dan Sebelumnya</option>
					</select>
				</div> -->
			</div>
			<div class="row gutters-tiny mt-20">
				<div class="col-6"><h6 class="text-uppercase mb-0">Nama Obat</h6></div> 
				<div class="col-6"><h6 class="text-uppercase mb-0">Pemakaian</h6></div>
			</div>
			<hr>
			<div class="progress push progress-data-loader-loading">
                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%;">
                    <span class="progress-bar-label">0%</span>
                </div>
            </div>
			@foreach($pengobatan as $index => $obat)
			<div class="row gutters-tiny p-5 kasus-farmasi-rpo-display-1day-container kasus-farmasi-rpo-data-konsumsi-empty kasus-farmasi-rpo-display-1day-{{$obat->id}}"  @if($index%2 == 0) style="background: #f1f1f1;" @endif>
				<div class="col-6">{{$obat->nama_obat}} Test</div> 
				<div class="col-6">
					<span class="kasus-farmasi-rpo-display-1day-pemakaian-waktu" style="display:none"></span>
					<span class="kasus-farmasi-rpo-display-1day-pemakaian-jam" style="display:none"></span>
				</div>
			</div>
			@endforeach
		</div>
	</div>
</div>