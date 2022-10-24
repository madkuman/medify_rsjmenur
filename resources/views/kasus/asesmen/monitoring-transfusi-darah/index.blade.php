@extends("kasus.layouts.main")

@section("title")
{{$kasus->judul_kasus}} - Monitoring Transfusi Darah - Kasus
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
					<div class="block-content">
						@if(session('my_role_'.$kasus->nomor_kasus))
						<button type="button" class="btn btn-rounded btn-alt-primary min-width-125 float-right editBtn" data-toggle="modal" data-target="#addModal"><i class="fa fa-pencil"></i> Monitoring Transfusi Darah Baru</button>
						@endif
						<h4>Monitoring Transfusi Darah</h4>
						<hr>
						@php $count = 1 @endphp
						@forelse($monitoring_transfusi_darah as $item)

						@if($item->created_by == Auth::user()->id)
						<button  class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5 pull-right deleteBtn" data-id="{{$item->id}}">
							<i class="fa fa-trash"></i>
						</button>
						<button  class="btn btn-sm btn-circle btn-outline-warning mr-5 mb-5 pull-right editBtn" data-id="{{$item->id}}" data-index="{{$loop->iteration - 1}}">
							<i class="fa fa-pencil"></i>
						</button>
						@endif
						<h5 class="mb-5 pl-5">#Monitoring Transfusi Darah {{$count++}}</h5>
						<div class="row" id="">
							@include("kasus.asesmen.monitoring-transfusi-darah.hasil")
						</div>
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
						@empty

						<div class="text-center py-50">
							<h4 class="font-w400 mb-5">Belum ada asesmen Monitoring Transfusi Darah tersedia</h4>
							<p>Klik tombol <b>Monitoring Transfusi Darah Baru</b> untuk melakukan asesmen Monitoring Transfusi Darah</p>
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
@include("kasus.asesmen.monitoring-transfusi-darah.modal")
@endsection

@section("js")
<script src="{{url("")}}/assets/js/plugins/jquery-masked-inputs/jquery.mask.min.js"></script>
<script type="text/javascript">
	var data = JSON.parse({!!json_encode(str_replace("`", "'", $monitoring_transfusi_darah))!!});

	$(document).ready(function(){
		$(".time").mask("00:00");
	});

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
	$(".editBtn").click(function(e){
		id = $(this).data("id");
		var item = data[$(this).data("index")];
		console.log(item);
		if(item != "" && item != undefined){
			$("#id").val(item.id);
			
			
			tanggal = moment(item.tanggal)
			tanggal = tanggal.format('DD/MM/YYYY')
			$(`:text[name="tanggal"]`).val(tanggal);
			$(`:text[name="jam"]`).val(item.jam);
			$(`:text[name="monitoring"]`).val(item.monitoring);
			$(`:text[name="menit_15_sebelum_transfusi"]`).val(item.menit_15_sebelum_transfusi);
			$(`:text[name="menit_15_sebelum_td"]`).val(item.menit_15_sebelum_td);
			$(`:text[name="menit_15_sebelum_nadi"]`).val(item.menit_15_sebelum_nadi);
			$(`:text[name="menit_15_sebelum_t"]`).val(item.menit_15_sebelum_t);
			$(`:text[name="menit_15_sebelum_rr"]`).val(item.menit_15_sebelum_rr);
			$(`:text[name="transfusi"]`).val(item.transfusi);
			$(`:text[name="jam_mulai_transfusi"]`).val(item.jam_mulai_transfusi);
			$(`:text[name="setelah_darah_masuk"]`).val(item.setelah_darah_masuk);
			$(`:text[name="menit_15_setelah_td"]`).val(item.menit_15_setelah_td);
			$(`:text[name="menit_15_setelah_nadi"]`).val(item.menit_15_setelah_nadi);
			$(`:text[name="menit_15_setelah_t"]`).val(item.menit_15_setelah_t);
			$(`:text[name="menit_15_setelah_rr"]`).val(item.menit_15_setelah_rr);
			$(`:text[name="jam_1_setelah_td"]`).val(item.jam_1_setelah_td);
			$(`:text[name="jam_1_setelah_nadi"]`).val(item.jam_1_setelah_nadi);
			$(`:text[name="jam_1_setelah_t"]`).val(item.jam_1_setelah_t);
			$(`:text[name="jam_1_setelah_rr"]`).val(item.jam_1_setelah_rr);
			$(`:text[name="reaksi_selama_transfusi"]`).val(item.reaksi_selama_transfusi);
			$(`:text[name="jam_selesai_transfusi"]`).val(item.jam_selesai_transfusi);
			$(`:text[name="jam_4_setelah_td"]`).val(item.jam_4_setelah_td);
			$(`:text[name="jam_4_setelah_nadi"]`).val(item.jam_4_setelah_nadi);
			$(`:text[name="jam_4_setelah_t"]`).val(item.jam_4_setelah_t);
			$(`:text[name="jam_4_setelah_rr"]`).val(item.jam_4_setelah_rr);
			$(`:text[name="reaksi_transfusi"]`).val(item.reaksi_transfusi);
			$(`:text[name="golongan_darah"]`).val(item.golongan_darah);
			$(`:text[name="rhesus"]`).val(item.rhesus);
		}else{
			$("#id").val(0);
			
			$(`:text[name="tanggal"]`).val("");
			$(`:text[name="jam"]`).val("");
			$(`:text[name="monitoring"]`).val("");
			$(`:text[name="menit_15_sebelum_transfusi"]`).val("");
			$(`:text[name="menit_15_sebelum_td"]`).val("");
			$(`:text[name="menit_15_sebelum_nadi"]`).val("");
			$(`:text[name="menit_15_sebelum_t"]`).val("");
			$(`:text[name="menit_15_sebelum_rr"]`).val("");
			$(`:text[name="transfusi"]`).val("");
			$(`:text[name="jam_mulai_transfusi"]`).val("");
			$(`:text[name="setelah_darah_masuk"]`).val("");
			$(`:text[name="menit_15_setelah_td"]`).val("");
			$(`:text[name="menit_15_setelah_nadi"]`).val("");
			$(`:text[name="menit_15_setelah_t"]`).val("");
			$(`:text[name="menit_15_setelah_rr"]`).val("");
			$(`:text[name="jam_1_setelah_td"]`).val("");
			$(`:text[name="jam_1_setelah_nadi"]`).val("");
			$(`:text[name="jam_1_setelah_t"]`).val("");
			$(`:text[name="jam_1_setelah_rr"]`).val("");
			$(`:text[name="reaksi_selama_transfusi"]`).val("");
			$(`:text[name="jam_selesai_transfusi"]`).val("");
			$(`:text[name="jam_4_setelah_td"]`).val("");
			$(`:text[name="jam_4_setelah_nadi"]`).val("");
			$(`:text[name="jam_4_setelah_t"]`).val("");
			$(`:text[name="jam_4_setelah_rr"]`).val("");
			$(`:text[name="reaksi_transfusi"]`).val("");
			$(`:text[name="golongan_darah"]`).val("");
			$(`:text[name="rhesus"]`).val("");
		}
		$("#addModal").modal("toggle");
	});
</script>
@endsection