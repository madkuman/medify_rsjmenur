<div class="col-lg-12 mb-5">
		@if($allow_crud)
	<button type="button" class="btn-alt btn-primary min-width-125 float-right" data-toggle="modal" data-target="#modal-update-identitas"><i class="fa fa-pencil"></i> Edit Identitas</button>
	@if(!empty($kasus->pasien_id) && empty($kasus->identitas->tempat_lahir))
	<button type="button" class="btn-alt btn-warning min-width-125 float-right" data-toggle="modal" data-target="#updateFromRMModal"><i class="fa fa-pencil"></i> Update Data</button>
	@endif
	@endif
	<button onclick="new_window('{{url('')}}/pasien/{{$kasus->pasien->id}}/print/profile','')" class="btn-alt btn-info min-width-125 float-right"><i class="fa fa-print"></i>Print Profile</button>
	<button onclick="new_window('{{url('')}}/pasien/{{$kasus->pasien->id}}/print/ktp','')" class="btn-alt btn-info min-width-125 float-right"><i class="fa fa-print"></i>Print Kartu Identitas</button>
	<h5 class="text-uppercase pt-15">INFORMASI UMUM</h5>

</div>
<div class="col-lg-6">
	<h5 class="font-w400"><small>Nama Pasien</small><br> {{$identitas->nama}}</h5>
	<h5 class="font-w400"><small>Jenis Kelamin</small><br> {{ $identitas->jenis_kelamin == 'L' ? 'Laki-Laki' : 'Perempuan' }}</h5>
	@if(empty($identitas->umur))
	<h5 class="font-w400"><small>Usia</small><br> {{ $identitas->age or '-'}}</h5>
	@else
	<h5 class="font-w400"><small>Usia</small><br> {{ $identitas->umur or '-'}} Tahun</h5>
	@endif
	<h5 class="font-w400"><small>Tempat, Tanggal Lahir</small><br> {{ $identitas->tempat_lahir or '-'}}, {{$identitas->tanggal_lahir or '-'}}</h5>
	<h5 class="font-w400"><small>Alamat</small><br> {{ $identitas->alamat or '-'}}</h5>
	
</div>
<div class="col-lg-6">
	<h5 class="font-w400"><small>Status Pernikahan</small><br>
		@if($identitas->status == 1) Belum Menikah
		@elseif($identitas->status == 2) Menikah
		@elseif($identitas->status == 3) Duda / Janda
		@else -
		@endif
	</h5>
	<h5 class="font-w400"><small>No Identitas</small><br> {{ $identitas->no_identitas or '-'}} </h5>
	<h5 class="font-w400"><small>Pekerjaan</small><br> {{ $identitas->pekerjaan or '-'}}</h5>
	<h5 class="font-w400"><small>No HP</small><br> {{ $identitas->no_hp or '-'}}</h5>
	<h5 class="font-w400"><small>Asal Rujukan</small><br> {{ $identitas->asal_rujukan or '-'}}</h5>
	
</div>
<div class="col-lg-12"><hr></div>