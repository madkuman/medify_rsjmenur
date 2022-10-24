<div class="row mt-30">
	<div class="col-12 text-right float-right">
		@if($is_hrd_member)
		<button type="button" id="button-edit-pns" class="btn btn-alt-primary pull-right" data-toggle="modal" data-target="#modal-edit-pns">
			<i class="fa fa-pencil-square-o mr-5 mb-10"></i> Edit
		</button>
		@endif
	</div>
</div>
<div class="row">
	<div class="col-12 mb-20">
		<h5 class="card-title font-w400">KHUSUS PNS</h5>
		<hr>
		<div class="row my-10">
			<div class="col-sm-5 col-xs-3 col-12">
				<label>Dep/Bagian</label>
			</div>
			<div class="col">
				{{$pegawai->departemen ?? '-'}}
			</div>
		</div>
		<div class="row my-10">
			<div class="col-sm-5 col-xs-3 col-12">
				<label>Jabatan</label>
			</div>
			<div class="col">
				{{$pegawai->jabatan ?? '-'}}
			</div>
		</div>
		<div class="row my-10">
			<div class="col-sm-5 col-xs-3 col-12">
				<label>Nama Jabatan Fungsional</label>
			</div>
			<div class="col">
				{{$pegawai->pns_jabatan_fungsional ?? '-'}}
			</div>
		</div> 
	</div>  
</div>