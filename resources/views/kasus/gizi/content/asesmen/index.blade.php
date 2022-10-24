
<div class="block-content">
	<button type="button" class="btn-alt btn-primary min-width-125 float-right editBtn"><i class="fa fa-pencil"></i> Asesmen Awal Lanjutan Baru</button>

	<h4 class="pt-10">Asesmen Awal Lanjutan</h4>
	<hr>
	@php $count = count($asesmen) @endphp
	@forelse($asesmen as $item)
	<div class="p-10"> 
	@if(session('my_role_'.$kasus->nomor_kasus))
	@if(session('my_role_'.$kasus->nomor_kasus)->admin == 1 || $item->created_by == Auth::user()->id)
	<button  class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5 pull-right asesmenDeleteBtn" data-id="{{$item->id}}">
		<i class="fa fa-trash"></i>
	</button>
	<button  class="btn btn-sm btn-circle btn-outline-warning mr-5 mb-5 pull-right editBtn" data-id="{{$item->id}}" data-index="{{$loop->iteration - 1}}">
		<i class="fa fa-pencil"></i>
	</button>
	@endif
	@endif
	<h5 class="mb-5 pl-5">#Asesmen Awal Lanjutan {{$count--}}</h5>
	@php $res = json_decode($item->val) @endphp
	<div class="row" id="asesmen-{{$item->id}}">
		@include('kasus.gizi.content.asesmen.tabel-hasil')
	</div>
	@if(!empty($item->creator->avatar_thumb))
	<div class="float-left mr-10">
		<img class="img-avatar img-avatar-sm img-avatar-thumb" src="{{url($item->creator->avatar_thumb)}}" alt="">
	</div>
	@else
	<div class="float-left mr-10">
		<img class="img-avatar img-avatar-sm img-avatar-thumb" src="{{url('assets/img/placeholder.jpg')}}" alt="">
	</div>
	@endif
	<div class="creator">
		<h6 class="pt-10">
			<small class="text-muted">Dibuat Oleh</small><br>
			{{$item->creator->name}}<br>
			{{date('d F y, H:i', strtotime($item->created_at))}}
		</h6>
	</div>

	<hr class="my-20">
	</div>
	@empty

	<div class="text-center py-50">
		<h4 class="font-w400 mb-5">Belum ada asesmen Asesmen Awal Lanjutan tersedia</h4>
		<p>Klik tombol <b>Asesmen Awal Lanjutan Baru</b> untuk melakukan asesmen Asesmen Awal Lanjutan</p>
	</div>

	@endforelse
</div>


<form method="POST" action="{{url('')}}/kasus/{{$kasus->nomor_kasus}}/alat-bantu/asuhan-gizi/delete" id="asesmenFormDelete">
	{{csrf_field()}}
	<input name="id" type="hidden" id="asesmenDeleteInputId">
	
</form>