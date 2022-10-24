@if(empty($kasus->krs_at))
<div class="row">
	<div class="col-12 bg-danger">
		<div class="py-10 px-50">
			<span class="mb-0 text-white font-w600">Kasus ini, masa rawat inap sudah melebihi 3 Hari</span>
			<span class="badge badge-warning">   {{$d}} Hari</span>
		</div>
	</div>
</div>
@endif