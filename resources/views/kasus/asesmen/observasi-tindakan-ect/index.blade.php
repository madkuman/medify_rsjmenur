@extends('kasus.layouts.main')

@section('title')
{{$kasus->judul_kasus}} - Observasi Tindakan ECT - Kasus
@endsection

@section('content')

<!-- Main Container -->
<main id="main-container">
	@include('kasus.layouts.header')

	<div class="content">
		<div class="row">
			@include('kasus.layouts.sidebar')

			<!-- Updates -->
			<div class="col-lg-9 col-xl-9">
				<div class="block block-bordered">
					<div class="block-content">
						@if(session("my_role_".$kasus->nomor_kasus))
						<button type="button" class="btn btn-rounded btn-alt-primary min-width-125 float-right" data-toggle="modal" data-target="#addModal"><i class="fa fa-pencil"></i> Observasi Tindakan ECT Baru</button>
						<a href="{{url()->current()}}/print" target="_blank" type="button" class="btn btn-rounded btn-alt-info min-width-125 float-right"><i class="fa fa-print"></i> Print Rekap</a>
						@endif

						<h4>Observasi Tindakan ECT</h4>
						<hr>
						@php $count = 1 @endphp
						@forelse($observasi_tindakan_ect as $i => $item)

						@if(session('my_role_'.$kasus->nomor_kasus))
						@if(session('my_role_'.$kasus->nomor_kasus)->admin == 1 || $item->created_by == Auth::user()->id)
						<button  class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5 pull-right deleteBtn" data-id="{{$item->id}}">
							<i class="fa fa-trash"></i>
						</button>
						@endif
						<button  class="btn btn-sm btn-circle btn-outline-info mr-5 mb-5 pull-right" data-toggle="modal" data-target="#edit-modal-{{$i}}">
							<i class="fa fa-pencil"></i>
						</button>
						@endif

						<h5 class="mb-5 pl-5">#Observasi Tindakan ECT {{$count++}}</h5>
						@php $res = json_decode($item->val) @endphp
						<div class="row" id="">
							@include('kasus.asesmen.observasi-tindakan-ect.table-hasil')
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

						@include('kasus.asesmen.observasi-tindakan-ect.edit')
						@empty

						<div class="text-center py-50">
							<h4 class="font-w400 mb-5">Belum ada asesmen Observasi Tindakan ECT tersedia</h4>
							<p>Klik tombol <b>Observasi Tindakan ECT Baru</b> untuk melakukan asesmen Observasi Tindakan ECT</p>
						</div>

						@endforelse
					</div>
				</div>
			</div>
			<!-- END Updates -->
		</div>
	</div>
</main>

<form method="POST" action="{{url('')}}/kasus/{{$kasus->nomor_kasus}}/asesmen/observasi-tindakan-ect/delete" id="formDelete">
	{{csrf_field()}}
	<input name="id" type="hidden" id="deleteInputId">
</form>

@include('kasus.asesmen.observasi-tindakan-ect.add')
@endsection

@section('js')
@include('kasus.asesmen.observasi-tindakan-ect.js')
<script src="{{url('')}}/assets/js/plugins/jquery-masked-inputs/jquery.mask.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('.time').mask('00:00');
	});
</script>
@endsection