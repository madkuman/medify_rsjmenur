@extends("kasus.layouts.main")

@section("title")
{{$kasus->judul_kasus}} - {{ $form->nama_show ?? '' }} - Kasus
@endsection

@section("content")

<main id="main-container">
	@include("kasus.layouts.header")

	<div class="content">
		<div class="row">
			@include("kasus.layouts.sidebar")
			
			<div class="col-lg-9 col-xl-9">
				<div class="block block-bordered">
					<div class="block-content">
						@if(session("my_role_".$kasus->nomor_kasus))

						<a href="{{url('')}}/kasus/{{ $kasus->nomor_kasus }}/asesmen/{{$form->slug}}/create" class="btn btn-rounded btn-alt-primary min-width-125 float-right"><i class="fa fa-pencil"></i> {{ $form->nama_show ?? '' }} </a>
						@endif

						<h4>{{ $form->nama_show ?? '' }}</h4>
						<hr>
						@php $count = count($hasil) @endphp
						@forelse($hasil as $hasil_item)
						@php $data_val = json_decode($hasil_item->val); @endphp
						@if(session("my_role_".$kasus->nomor_kasus))
						{{-- @if($hasil_item->created_by == Auth::user()->id) --}}
						<button  class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5 pull-right deleteBtn" data-id="{{$hasil_item->id}}">
							<i class="fa fa-trash"></i>
						</button>
						<a href="{{ url('') }}/kasus/{{ $kasus->nomor_kasus }}/asesmen/{{$form->slug}}/edit/{{ $hasil_item->id }}" class="btn btn-sm btn-circle btn-outline-warning mr-5 mb-5 pull-right editBtn" data-id="{{$hasil_item->id}}" data-index="{{$loop->iteration - 1}}">
							<i class="fa fa-pencil"></i>
						</a>
						{{-- @endif --}}
						@if(empty($data_val->img_ttd))					
    					<button  class="btn btn-sm btn-circle btn-outline-primary mr-5 mb-5 pull-right btn-add-ttd" data-toggle="modal" data-id="{{$hasil_item->id}}" data-pasien_id="{{$id}}" data-url="{{ url('') }}/kasus/{{ $kasus->nomor_kasus }}/asesmen/{{$form->slug}}/add-ttd">
        				<i class="fa fa-signature"></i>
    					</button>
    					@endif
						@endif
						

						<a type="btn" href="{{ url('') }}/kasus/{{ $kasus->nomor_kasus }}/asesmen/{{$form->slug}}/print/{{ $hasil_item->id }}" class="btn btn-sm btn-circle btn-outline-secondary mr-5 mb-5 pull-right" target="_blank">
							<i class="fa fa-print"></i>
						</a>
						<a href="{{ url('') }}/kasus/{{ $kasus->nomor_kasus }}/asesmen/{{$form->slug}}/view/{{ $hasil_item->id }}" class="btn btn-sm btn-circle btn-outline-primary mr-5 mb-5 pull-right showBtn" data-id="{{$hasil_item->id}}" data-index="{{$loop->iteration - 1}}">
							<i class="fa fa-search"></i>
						</a>

						<h5 class="mb-5 pl-5">#{{ $form->nama_show ?? '' }} {{$count}}</h5>

						@if(!empty($hasil_item->creator->avatar_thumb))
						<div class="float-left mr-10">
							<img class="img-avatar img-avatar-sm img-avatar-thumb" src="{{url($hasil_item->creator->avatar_thumb)}}" alt="">
						</div>
						@else
						<div class="float-left mr-10">
							<img class="img-avatar img-avatar-sm img-avatar-thumb" src="{{url("assets/img/placeholder.jpg")}}" alt="">
						</div>
						@endif
						<div class="creator">
							<h6 class="pt-10">
								<small class="text-muted">Dibuat Oleh</small><br>
								{{$hasil_item->creator->name}}<br>
								{{date("d F y, H:i", strtotime($hasil_item->created_at))}}
							</h6>
						</div>

						<hr class="my-20">
						@php $count-- @endphp
						@empty

						<div class="text-center py-50">
							<h4 class="font-w400 mb-5">Belum ada asesmen {{ $form->nama_show ?? '' }} tersedia</h4>
							<p>Klik tombol <b>{{ $form->nama_show ?? '' }} Baru</b> untuk melakukan asesmen {{ $form->nama_show ?? '' }}</p>
						</div>

						@endforelse
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
<form method="POST" action="{{ url('') }}/kasus/{{ $kasus->nomor_kasus }}/asesmen/{{$form->slug}}/delete" id="formDelete">
	{{csrf_field()}}
	<input name="id" type="hidden" id="deleteInputId">

</form>
@include('kasus.asesmen.childhood-autism-rating-scale.modal-ttd')
@endsection
@section("js")
@include('kasus.asesmen.childhood-autism-rating-scale.js-ttd')
<script type="text/javascript">
	$(".deleteBtn").click(function(e){
		e.preventDefault();
		id = $(this).data("id");
		$("#deleteInputId").val(id);
		swal({
			title: "Hapus",
			text: "Apakah anda yakin akan menghapus data ini?",
			showCancelButton: true,
			reverseButtons: true,
			type: "warning",
			confirmButtonClass: "btn btn-danger",
			cancelButtonClass: "btn btn-default",
			confirmButtonText: "Hapus",
			cancelButtonText: "Kembali",
			closeOnConfirm: false
		}).then(function(result) {
			if(result.value)
			{
				$("#formDelete").submit();
			}
		});
	});
	
</script>
@endsection