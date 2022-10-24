<div class="col-lg-12 mb-5">
	<h5 class="text-uppercase pt-15">INFORMASI KUNJUNGAN</h5>
</div>
<div class="col-12">
	<div class="row">
		<div class="col-12 mb-10">
			<h5 class="mb-0"><small>Daftar Layanan Yang Dikunjungi</small></h5>
		</div>
		<div class="col-12">
			<div class="row">
				<div class="col-12">
					<h5 class="font-w400">
						@if($kasus->tipe_rj) 
							<span class="badge badge-success">Rawat Jalan</span> 
						@endif
						@if($kasus->tipe_igd) 
						<span class="badge badge-danger">IGD</span>
						@endif
						@if($kasus->tipe_ri) 
						<span class="badge badge-primary">Rawat Inap</span>
						@endif
						@if($kasus->tipe_mc) 
						<span class="badge badge-info">Medical Checkup</span>
						@endif
					</h5>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="col-lg-12"><hr></div>