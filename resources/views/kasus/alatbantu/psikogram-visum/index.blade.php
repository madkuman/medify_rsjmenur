<div class="block border-0">
	@if(session("my_role_".$kasus->nomor_kasus))
	<div class="block-header">
		<h3 class="block-title">Psikogram Visum</h3>
		<div class="block-options">
			<button type="button" class="btn btn-rounded btn-alt-primary min-width-125 float-right editBtn">
				<i class="fa fa-pencil"></i> Psikogram Visum Baru
			</button>
		</div>
	</div>
	@endif
	
	<div class="block-content">
		@php $count = count($psikogram_visum) @endphp
		@forelse($psikogram_visum as $item)

		@if(session("my_role_".$kasus->nomor_kasus))
		@if($item->created_by == Auth::user()->id)
		<button  class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5 pull-right deleteBtn" data-id="{{$item->id}}">
			<i class="fa fa-trash"></i>
		</button>
		<button  class="btn btn-sm btn-circle btn-outline-warning mr-5 mb-5 pull-right editBtn" data-id="{{$item->id}}" data-index="{{$loop->iteration - 1}}">
			<i class="fa fa-pencil"></i>
		</button>
		@endif
		@endif

		<a type="btn" href="{{url('kasus')}}/{{$kasus->nomor_kasus}}/alat-bantu/psikogram-visum/print/{{$item->id}}" class="btn btn-sm btn-circle btn-outline-secondary mr-5 mb-5 pull-right" target="_blank">
			<i class="fa fa-print"></i>
		</a>
		<button  class="btn btn-sm btn-circle btn-outline-primary mr-5 mb-5 pull-right showBtn" data-id="{{$item->id}}" data-index="{{$loop->iteration - 1}}">
			<i class="fa fa-search"></i>
		</button>
		
		<h5 class="mb-5 pl-5">#Psikogram Visum {{$count}}</h5>
		
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
			<h4 class="font-w400 mb-5">Belum ada asesmen Psikogram Visum tersedia</h4>
			<p>Klik tombol <b>Psikogram Visum Baru</b> untuk melakukan asesmen Psikogram Visum</p>
		</div>

		@endforelse
	</div>
					
	<form method="POST" action="{{url('kasus')}}/{{$kasus->nomor_kasus}}/alat-bantu/psikogram-visum/delete" id="formDelete">
		{{csrf_field()}}
		<input name="id" type="hidden" id="deleteInputId">
	</form>

	@include("kasus.alatbantu.psikogram-visum.modal")
	@include("kasus.alatbantu.psikogram-visum.modal-hasil")
</div>