<div class="row">
	<div class="col-12 mt-10 mb-20">
		<h5 class="card-title font-w400">DATA UMUM</h5>
		<hr>
		<div class="col-12 my-10">
			<div class="row my-10">
				<div class="col-sm-5 col-xs-3 col-12">
					<label>Nama</label>
				</div>
				<div class="col">
					{{!empty($item->name) ? $item->name : '-'}}
				</div>
			</div>
			<div class="row my-10">
				<div class="col-sm-5 col-xs-3 col-12">
					<label>Jenis Kelamin</label>
				</div>
				@php
				$genders = ['L' => 'Laki-Laki', 'P' => 'Perempuan'];
				$gender = '-';
				if(!empty($item->gender))
				$gender = $genders[$item->gender];
				@endphp
				<div class="col">
					{{$gender}}
				</div>
			</div>
			<div class="row my-10">
				<div class="col-sm-5 col-xs-3 col-12">
					<label>Usia</label>
				</div>
				<div class="col">
					{{!empty($item->age) ? $item->age : '-'}}
				</div>
			</div>
			<div class="row my-10">
				<div class="col-sm-5 col-xs-3 col-12">
					<label>Tempat, Tanggal Lahir</label>
				</div>
				<div class="col">
					{{!empty($item->kelahiran) ? $item->kelahiran : ''}}
				</div>
			</div>
			<div class="row my-10">
				<div class="col-sm-5 col-xs-3 col-12">
					<label>NRP</label>
				</div>
				<div class="col">
					{{!empty($item->nrp) ? $item->nrp : '-'}}
				</div>
			</div>
			<div class="row my-10">
				<div class="col-sm-5 col-xs-3 col-12">
					<label>Kualifikasi</label>
				</div>
				<div class="col">
					{{!empty($item->masterKualifikasi->nama) ? $item->masterKualifikasi->nama : '-'}}
				</div>
			</div>
			<div class="row my-10">
				<div class="col-sm-5 col-xs-3 col-12">
					<label>Subkualifikasi</label>
				</div>
				<div class="col">
					{{!empty($item->masterSubkualifikasi->nama) ? $item->masterSubkualifikasi->nama : '-'}}
				</div>
			</div>
		</div>
	</div>
</div>