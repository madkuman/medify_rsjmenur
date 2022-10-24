
<div class="row">
	<div class="col-12 mt-10 mb-20">
		<h5 class="card-title font-w400">DATA ASURANSI KESEHATAN</h5>
		<hr>
		<div class="col-12 my-10">
			<div class="row my-10">
				<div class="col-sm-5 col-xs-3 col-12">
					<label>Perusahaan Asuransi</label>
				</div>
				<div class="col">
					{{!empty($item->masterFaskesAsuransi->nama) ? $item->masterFaskesAsuransi->nama: '-'}}
				</div>
			</div>
			<div class="row my-10">
				<div class="col-sm-5 col-xs-3 col-12">
					<label>No. Asuransi</label>
				</div>
				<div class="col">
					{{!empty($item->bpjs) ? $item->bpjs : '-'}}
				</div>
			</div>
			<div class="row my-10">
				<div class="col-sm-5 col-xs-3 col-12">
					<label>Faskes</label>
				</div>
				<div class="col">
					{{!empty($item->faskes) ? $item->faskes : '-'}}
				</div>
			</div>
			<div class="row my-10">
				<div class="col-sm-5 col-xs-3 col-12">
					<label>Kelas Pelayanan</label>
				</div>
				<div class="col">
					{{!empty($item->class) ? $item->class : '-'}}
				</div>
			</div>
		</div>
	</div>
</div>