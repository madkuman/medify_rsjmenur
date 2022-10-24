<div class="content" style="margin-top:50px;">
	<div class="block p-10"  >
		<div class="block-header">
			<h3 class="block-title">
				Daftar User
			</h3>
		</div>
		<div class="block-content">
			<div class="row">
				<div class="col-12">
					<h6>FILTER</h6>
				</div>
			</div>
			<div class="row">
				<div class="col-3">
					<select class="js-select2 form-control filter-profesi">
						<option value="all">Semua Profesi</option>
						@foreach($profesi as $item)
						<option value="{{$item->id}}">{{$item->title}}</option>
						@endforeach
					</select>
				</div>
				<div class="col-3">
					<select class="js-select2 form-control filter-status">
						<option value="all">Semua Status Aktif</option>
						<option value="1">Aktif</option>
						<option value="0">Tidak Aktif</option>
					</select>
				</div>	
				<div class="col-3">
					<select class="js-select2 form-control filter-special">
						<option value="">Tanpa Filter Khusus</option>
						<option value="tanpa-dokter">Tidak Sinkron Dokter</option>
						<option value="tanpa-pegawai">Tidak Sinkron Kepegawaian</option>
						<option value="admin-1">Admin</option>
					</select>
				</div>
			</div>
		</div>
		<div class="block-content">
			<table class="table table-bordered table-striped table-vcenter js-dataTable-full" id="tableUser">
				<thead>
					<tr>
						<th class="">No</th>
						<th>Nama</th>
						<th>Profesi</th>
						<th>Admin</th>
						<th class="text-center">Login Terakhir</th>
						<th class="text-center">Status</th>
						<th width="10%">Aksi</th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</div>