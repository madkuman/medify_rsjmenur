<div class="block-content">
	@if(session("my_role_".$kasus->nomor_kasus))
	<button type="button" class="btn btn-rounded btn-alt-primary min-width-125 float-right editBtn" data-toggle="modal" data-target="#addModal"><i class="fa fa-pencil"></i> Resume Gawat Darurat Baru</button>
	@endif
	
	<h4>Resume Gawat Darurat</h4>
	<hr>
	@php $count = count($resume_gawat_darurat) @endphp
	@forelse($resume_gawat_darurat as $item)

	@if($item->created_by == Auth::user()->id)
	<button  class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5 pull-right deleteBtn" data-id="{{$item->id}}">
		<i class="fa fa-trash"></i>
	</button>
	<button  class="btn btn-sm btn-circle btn-outline-warning mr-5 mb-5 pull-right editBtn" data-id="{{$item->id}}" data-index="{{$loop->iteration - 1}}">
		<i class="fa fa-pencil"></i>
	</button>
	@endif
	<a type="btn" href="{{url('kasus')}}/{{$kasus->nomor_kasus}}/asesmen/resume-gawat-darurat/print/{{$item->id}}" class="btn btn-sm btn-circle btn-outline-secondary mr-5 mb-5 pull-right" target="_blank">
		<i class="fa fa-print"></i>
	</a>
	<button  class="btn btn-sm btn-circle btn-outline-primary mr-5 mb-5 pull-right showBtn" data-id="{{$item->id}}" data-index="{{$loop->iteration - 1}}">
		<i class="fa fa-search"></i>
	</button>
	<h5 class="mb-5 pl-5">#Resume Gawat Darurat {{$count}}</h5>

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
		<h4 class="font-w400 mb-5">Belum ada asesmen Resume Gawat Darurat tersedia</h4>
		<p>Klik tombol <b>Resume Gawat Darurat Baru</b> untuk melakukan asesmen Resume Gawat Darurat</p>
	</div>

	@endforelse
</div>