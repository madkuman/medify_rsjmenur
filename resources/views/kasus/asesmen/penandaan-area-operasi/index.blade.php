@extends("kasus.layouts.main")

@section("title")
Penandaan Area Operasi - {{$kasus->judul_kasus}} - Kasus
@endsection

@section('css')
@endsection

@section("content")

<!-- Main Container -->
<main id="main-container">
	@include("kasus.layouts.header")

	<div class="content">
		<div class="row">
			@include("kasus.layouts.sidebar")

			<!-- Updates -->
			<div class="col-lg-9 col-xl-9">
				<div class="block block-bordered">
					<div class="block-content" id="index-container">
						@if(session('my_role_'.$kasus->nomor_kasus))
						<a class="btn btn-rounded btn-alt-primary min-width-125 float-right formButton"  href="{{url()->current()}}/form"><i class="fa fa-pencil"></i> Penandaan Area Operasi Baru</a>
						@endif
						<h4>Penandaan Area Operasi</h4>
						<hr>
						@php $count = count($penandaan_area_operasi) @endphp
						@forelse($penandaan_area_operasi as $item)
						<h5 class="mb-5 pl-5">#Penandaan Area Operasi {{$count--}}</h5>
						<div class="row px-20 pt-10 py-20">
							@include("kasus.asesmen.penandaan-area-operasi.hasil")
						</div>
						<div class=" px-20 py-5">
							<div class="creator">
								<h6 class="pt-10">
									<small class="text-muted">Dibuat Oleh</small><br>
									{{$item->creator->name}}<br>
									{{date("d F y, H:i", strtotime($item->created_at))}}
								</h6>
							</div>
						</div>

						<hr class="my-20">
						@empty

						<div class="text-center py-50">
							<h4 class="font-w400 mb-5">Belum ada asesmen Penandaan Area Operasi tersedia</h4>
							<p>Klik tombol <b>Penandaan Area Operasi Baru</b> untuk melakukan asesmen Penandaan Area Operasi</p>
						</div>

						@endforelse
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
<form method="POST" action="{{url()->current()}}/delete" id="formDelete">
	{{csrf_field()}}
	<input name="id" type="hidden" id="deleteInputId">
	
</form>
@include("kasus.asesmen.penandaan-area-operasi.modal")
@endsection

@section("js")
<script type="text/javascript">
	var data = JSON.parse({!!json_encode(str_replace("`", "'", $penandaan_area_operasi))!!});



	$(document).ready(function(){
		$(".time").mask("00:00");
	});
	$(".editBtn").click(function(e){
		id = $(this).data("id");
		var item = data[$(this).data("index")];
		if(item != "" && item != undefined){
			$("#id").val(item.id);
			
			$(`:text[name="tanggal_operasi"]`).val(item.tanggal_operasi);
			$(`:text[name="jenis_operasi"]`).val(item.jenis_operasi);
		}else{
			$("#id").val(0);
			
			$(`:text[name="tanggal_operasi"]`).val("");
			$(`:text[name="jenis_operasi"]`).val("");
		}
		$("#addModal").modal("toggle");
	});

</script>
@endsection