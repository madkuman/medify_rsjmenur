@extends("kasus.layouts.main")

@section("title")
{{$kasus->judul_kasus}} - Asesmen Permohonan dan Jawaban Konsultasi - Kasus
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
                        
						<a href="{{url('')}}/kasus/{{ $kasus->nomor_kasus }}/asesmen/asesmen-permohonan-dan-jawaban-konsultasi/form" class="btn btn-rounded btn-alt-primary min-width-125 float-right"><i class="fa fa-pencil"></i> Asesmen Permohonan dan Jawaban Konsultasi </a>
						@endif
						
						<h4>Asesmen Permohonan dan Jawaban Konsultasi</h4>
						<hr>
						@php $count = count($asesmen_permohonan_dan_jawaban_konsultasi) @endphp
						@forelse($asesmen_permohonan_dan_jawaban_konsultasi as $item)

						@if(session("my_role_".$kasus->nomor_kasus))
						@if($item->created_by == Auth::user()->id)
						<button  class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5 pull-right deleteBtn" data-id="{{$item->id}}">
							<i class="fa fa-trash"></i>
						</button>
						<a href="{{ url('') }}/kasus/{{ $kasus->nomor_kasus }}/asesmen/asesmen-permohonan-dan-jawaban-konsultasi/form/{{ $item->id }}/edit" class="btn btn-sm btn-circle btn-outline-warning mr-5 mb-5 pull-right editBtn" data-id="{{$item->id}}" data-index="{{$loop->iteration - 1}}">
							<i class="fa fa-pencil"></i>
						</a>
						@endif
						@endif

						<a type="btn" href="{{ url('') }}/kasus/{{ $kasus->nomor_kasus }}/asesmen/asesmen-permohonan-dan-jawaban-konsultasi/print/{{ $item->id }}" class="btn btn-sm btn-circle btn-outline-secondary mr-5 mb-5 pull-right" target="_blank">
							<i class="fa fa-print"></i>
						</a>
						<a href="{{ url('') }}/kasus/{{ $kasus->nomor_kasus }}/asesmen/asesmen-permohonan-dan-jawaban-konsultasi/form/{{ $item->id }}" class="btn btn-sm btn-circle btn-outline-primary mr-5 mb-5 pull-right showBtn" data-id="{{$item->id}}" data-index="{{$loop->iteration - 1}}">
							<i class="fa fa-search"></i>
						</a>

						<h5 class="mb-5 pl-5">#Asesmen Permohonan dan Jawaban Konsultasi {{$count}}</h5>
						
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
							<h4 class="font-w400 mb-5">Belum ada asesmen Asesmen Permohonan dan Jawaban Konsultasi tersedia</h4>
							<p>Klik tombol <b>Asesmen Permohonan dan Jawaban Konsultasi Baru</b> untuk melakukan asesmen Asesmen Permohonan dan Jawaban Konsultasi</p>
						</div>

						@endforelse
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
<form method="POST" action="{{ url('') }}/kasus/{{ $kasus->nomor_kasus }}/asesmen/asesmen-permohonan-dan-jawaban-konsultasi/delete" id="formDelete">
	{{csrf_field()}}
	<input name="id" type="hidden" id="deleteInputId">
	
</form>
@endsection

@section("js")
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