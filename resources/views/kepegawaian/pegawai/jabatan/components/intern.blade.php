
<div class="row mt-30">
	<div class="col-12 text-right float-right">
		@if($is_hrd_member)
		<button type="button" id="button-edit-intern" class="btn btn-alt-primary pull-right"  data-toggle="modal" data-target="#modal-edit-intern">
			<i class="fa fa-pencil-square-o mr-5 mb-10"></i> Edit
		</button>
		@endif
	</div>
</div>
<div class="row">
	<div class="col-12 mb-20">
		<h5 class="card-title font-w400">JABATAN INTERN</h5>
		<hr>
		<div class="row my-10">
			<div class="col-sm-5 col-xs-3 col-12">
				<label>Dep/Bagian</label>
			</div>
			<div class="col">
				{{$pegawai->intern_dep ?? '-'}}
			</div>
		</div>
		<div class="row my-10">
			<div class="col-sm-5 col-xs-3 col-12">
				<label>Jabatan</label>
			</div>
			<div class="col">
				{{$pegawai->intern_jabatan ?? '-'}}
			</div>
		</div>
		<div class="row my-10">
			<div class="col-sm-5 col-xs-3 col-12">
				<label>No. SP</label>
			</div>
			<div class="col">
				{{$pegawai->intern_no_sp ?? '-'}}
			</div>
		</div>
		<div class="row my-10">
			<div class="col-sm-5 col-xs-3 col-12">
				<label>Tanggal SP</label>
			</div>
			<div class="col">
				{{$pegawai->intern_tanggal_sp_show ?? '-'}}
			</div>
		</div>
	</div>  
</div>