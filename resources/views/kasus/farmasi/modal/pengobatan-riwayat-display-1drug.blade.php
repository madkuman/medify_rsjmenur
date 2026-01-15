<div class="block-content" id="kasus-farmasi-rpo-display-1drug" style="display:none">
	<div class="row justify-content-center">
		<div class="col-12 col-md-6 col-lg-5 col-xl-5">
			<div class="row">
				<div class="col-lg-8 col-md-8 col-12">
					<label>Obat</label>
					<select class="js-select2 form-control" style="width:100%" id="input-cpo-display1drug-select-obat">
						<option value="" disabled selected></option>
						@foreach($pengobatan as $cpo)
						<option value="{{$cpo->id}}">{{$cpo->nama_obat}}</option>
						@endforeach
					</select>
				</div>
				<div class="col-lg-4 col-md-4 col-12">
					<label>Tampilkan</label>
					<select class="form-control" id="input-cpo-display-1drug-time-display">
						<option value="waktu" @if(config('medify.kasus.riwayat_pemberian_obat.default_time_display','waktu') == 'waktu') selected @endif>Waktu</option>
						<option value="jam" @if(config('medify.kasus.riwayat_pemberian_obat.default_time_display','waktu') == 'jam') selected @endif>Jam</option>
					</select>
				</div>
			</div>
			<div class="row gutters-tiny mt-10">
				<div class="col-5">
					<span>Pemberian Pertama</span><br>
					<span>Pemberian Terakhir</span><br>
					<span>Total Konsumsi</span><br>
				</div>
				<div class="col-5">
					<span>:</span>
					<span id="kasus-farmasi-rpo-display-1drug-pemberian-pertama"></span><br>
					<span>:</span>
					<span id="kasus-farmasi-rpo-display-1drug-pemberian-terakhir"></span><br>
					<span>:</span>
					<span id="kasus-farmasi-rpo-display-1drug-total-konsumsi"></span><br>
				</div>
			</div>
			<div class="progress push progress-data-loader-loading mt-10">
                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%;">
                    <span class="progress-bar-label">0%</span>
                </div>
            </div>
			<div class="row gutters-tiny mt-20">
				<div class="col-6"><h6 class="text-uppercase mb-0">Tanggal</h6></div> 
				<div class="col-6"><h6 class="text-uppercase mb-0">Pemakaian</h6></div>
			</div>
			<hr>
			<div id="kasus-farmasi-rpo-display-1drug-container-pemakaian">
			</div>
		</div>
	</div>
</div>