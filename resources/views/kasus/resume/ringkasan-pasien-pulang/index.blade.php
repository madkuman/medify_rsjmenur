<div class="block-content">
	@if(session("my_role_".$kasus->nomor_kasus))
	<button type="button" class="btn btn-primary min-width-125 float-right editBtn" data-toggle="modal" data-target="#addModal"><i class="fa fa-plus"></i> Ringkasan Pasien Pulang Baru</button>
	@endif
	<div class="btn-group float-right" role="group">
		<button type="button" class="btn btn-secondary min-width-125 float-right dropdown-toggle mr-5" id="btnAsesmen" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			<i class="fa fa-file-text mr-5"></i> Asesmen Lainnya
		</button>
		<div class="dropdown-menu" aria-labelledby="btnAsesmen">
			<div class="dropdown-divider"></div>
			<a href="{{url('kasus')}}/{{$kasus->nomor_kasus}}/asesmen/rencana-pemulangan-pasien" class="dropdown-item float-right mb-5 mr-5" target="_blank">
				<i class="fa fa-pencil mr-5"></i> Perencanaan Pulang
			</a>
			<a href="{{url('kasus')}}/{{$kasus->nomor_kasus}}/asesmen/resume-non-jiwa" class="dropdown-item float-right mb-5 mr-5" target="_blank">
				<i class="fa fa-pencil mr-5"></i> Resume Non Jiwa
			</a>
		</div>
	</div>

	<h4>Ringkasan Pasien Pulang</h4>
	<hr>
	@php $count = count($ringkasan_pasien_pulang) @endphp
	@forelse($ringkasan_pasien_pulang as $item)

	@if($item->created_by == Auth::user()->id)
	<button  class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5 pull-right deleteBtn" data-id="{{$item->id}}">
		<i class="fa fa-trash"></i>
	</button>
	<button  class="btn btn-sm btn-circle btn-outline-warning mr-5 mb-5 pull-right editBtn" data-id="{{$item->id}}" data-index="{{$loop->iteration - 1}}">
		<i class="fa fa-pencil"></i>
	</button>
	@endif
	<a type="btn" href="{{url('kasus')}}/{{$kasus->nomor_kasus}}/asesmen/ringkasan-pasien-pulang/print/{{$item->id}}" class="btn btn-sm btn-circle btn-outline-secondary mr-5 mb-5 pull-right" target="_blank">
		<i class="fa fa-print"></i>
	</a>
	<button  class="btn btn-sm btn-circle btn-outline-primary mr-5 mb-5 pull-right showBtn" data-id="{{$item->id}}" data-index="{{$loop->iteration - 1}}">
		<i class="fa fa-search"></i>
	</button>
	<h5 class="mb-5 pl-5">#Ringkasan Pasien Pulang {{$count}}</h5>

	@if(!empty($item->creator->avatar_thumb))
	<div class="float-left mr-10">
		<img class="img-avatar img-avatar-sm img-avatar-thumb" src="{{url($item->creator->avatar_thumb)}}" alt="">
	</div>
	@else
	<div class="float-left mr-10">
		<img class="img-avatar img-avatar-sm img-avatar-thumb" src="{{url("assets/img/placeholder.jpg")}}" alt="">
	</div>
	@endif
	<div class="creator">
		<h6 class="pt-10">
			<small class="text-muted">Dibuat Oleh</small><br>
			{{$item->creator->name}}<br>
			{{date("d F y, H:i", strtotime($item->created_at))}}
		</h6>
	</div>

	<hr class="my-20">
	@php $count-- @endphp
	@empty

	<div class="text-center py-50">
		<h4 class="font-w400 mb-5">Belum ada asesmen Ringkasan Pasien Pulang tersedia</h4>
		<p>Klik tombol <b>Ringkasan Pasien Pulang Baru</b> untuk melakukan asesmen Ringkasan Pasien Pulang</p>
	</div>

	@endforelse
</div>