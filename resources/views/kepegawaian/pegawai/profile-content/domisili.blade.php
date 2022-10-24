<div class="row">
	<div class="col-12 mt-10 mb-20">
		<h5 class="card-title font-w400">DATA DOMISILI</h5>
		<hr>
		<div class="col-12 my-10">
			<div class="row my-10">
				<div class="col-sm-5 col-xs-3 col-12">
					<label>Alamat</label>
				</div>
				<div class="col">
					{{!empty($item->address) ? $item->address : '-'}}
				</div>
			</div>
			<div class="row my-10">
				<div class="col-sm-5 col-xs-3 col-12">
					<label>RT/RW</label>
				</div>
				<div class="col">
					{{!empty($item->rt_rw) ? $item->rt_rw : '-'}}
				</div>
			</div>
			<div class="row my-10">
				<div class="col-sm-5 col-xs-3 col-12">
					<label>Kelurahan</label>
				</div>
				<div class="col">
					{{ $item->kelurahan->nama ?? '-'}}
				</div>
			</div>
			<div class="row my-10">
				<div class="col-sm-5 col-xs-3 col-12">
					<label>Kota/Kabupaten</label>
				</div>  
				<div class="col">
					{{ $item->city->nama ?? '-'}}
				</div>
			</div>
			<div class="row my-10">
				<div class="col-sm-5 col-xs-3 col-12">
					<label>Kecamatan</label>
				</div>
				<div class="col">
					{{ $item->district->nama ?? '-'}}
				</div>
			</div>
		</div>
	</div>
</div>