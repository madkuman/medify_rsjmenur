@extends('kasus.layouts.main')

@section('title')
{{$kasus->judul_kasus}} - Pengkajian IGD - Kasus
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
						<button type="button" class="btn btn-rounded btn-alt-primary min-width-125 float-right" data-toggle="modal" data-target="#addModal"><i class="fa fa-pencil"></i> Pengkajian IGD Baru</button>
						@endif
						<h4>Pengkajian IGD</h4>
						<hr>
						@php $count = 1 @endphp
						@forelse($pengkajian as $item)

						@if(session('my_role_'.$kasus->nomor_kasus))
						@if(session('my_role_'.$kasus->nomor_kasus)->admin == 1 || $item->created_by == Auth::user()->id)
						<button  class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5 pull-right deleteBtn" data-id="{{$item->id}}">
							<i class="fa fa-trash"></i>
						</button>
						<button  class="btn btn-sm btn-circle btn-outline-warning mr-5 mb-5 pull-right editBtn" data-id="{{$item->id}}" data-val="{{$item->val}}">
							<i class="fa fa-pencil"></i>
						</button>
						@endif
						@endif
						<h5 class="mb-5 pl-5">#Pengkajian IGD {{$count++}}</h5>
						@php $res = json_decode($item->val) @endphp
						<div class="row" id="pengkajian-{{$item->id}}">
							@include('kasus.alatbantu.pengkajian-igd.tabel-hasil')
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
								<small class="text-muted">Dibuat/Diubah Oleh</small><br>
								{{$item->creator->name}}<br>
								{{date('d F y, H:i', strtotime($item->updated_at))}}
							</h6>
						</div>

						<hr class="my-20">
						@empty

						<div class="text-center py-50">
							<h4 class="font-w400 mb-5">Belum ada asesmen Pengkajian IGD tersedia</h4>
							<p>Klik tombol <b>Pengkajian IGD Baru</b> untuk melakukan asesmen Pengkajian IGD</p>
						</div>

						@endforelse
					</div>
				</div>
			</div>
			<!-- END Updates -->
		</div>
	</div>
</main>
<form method="POST" action="{{url('')}}/kasus/{{$kasus->nomor_kasus}}/alat-bantu/pengkajian-igd/delete" id="formDelete">
	{{csrf_field()}}
	<input name="id" type="hidden" id="deleteInputId">
	
</form>
@include('kasus.alatbantu.pengkajian-igd.add')
@endsection

@section('js')
@include('kasus.alatbantu.pengkajian-igd.js')
<script src="{{url('')}}/assets/js/plugins/jquery-masked-inputs/jquery.mask.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('.time').mask('00:00');
	});
	$(".editBtn").click(function(e){
		id = $(this).data('id');
		var data = $(this).data('val');
		if(data != ""){
			$("#id").val(id);
			$("#tgl_kedatangan").val(data.tgl_kedatangan);
			$("#jam_kedatangan").val(data.jam_kedatangan);
			$("#pekerjaan").val(data.pekerjaan).change();
			if (data.pekerjaan == 0) {
				$("#pekerjaan_lain2").val(data.pekerjaan_lain2);
				$("#div_pekerjaan_lain2").show();
			}
			$("#penghasilan").val(data.penghasilan);
			$("#agama").val(data.agama).change();
			if (data.agama == 0) {
				$("#agama_lain2").val(data.agama_lain2);
				$("#div_agama_lain2").show();
			}
			$("#pendidikan").val(data.pendidikan).change();
			if (data.pendidikan == 0) {
				$("#pendidikan_lain2").val(data.pendidikan_lain2);
				$("#div_pendidikan_lain2").show();
			}
			$("#bahasa").val(data.bahasa).change();
			if (data.bahasa == 0) {
				$("#bahasa_lain2").val(data.bahasa_lain2);
				$("input[name=penerjemah][value=" + data.penerjemah + "]").prop('checked', true);
				$("#div_bahasa_lain2").show();
				$("div_penerjemah").show();
			}
			$("#tgl_kejadian").val(data.tgl_kejadian);
			$("#jam_kejadian").val(data.jam_kejadian);
			$("#tempat_kejadian").val(data.tempat_kejadian);
			$("#gcs").val(data.gcs);
			$("#td").val(data.td);
			$("#n").val(data.n);
			$("#s").val(data.s);
			$("#rr").val(data.rr);
			$("#spo2").val(data.spo2);
			$("#o2").val(data.o2);
			$("input[name=bvm][value=" + data.bvm + "]").prop('checked', true);
			$("#ett").val(data.ett);
			$("input[name=pipa_oro][value=" + data.pipa_oro + "]").prop('checked', true);
			$("#tracheostomy").val(data.tracheostomy);
			$("#cpr").val(data.cpr);
			$("#infus").val(data.infus);
			$("#ngt").val(data.ngt);
			$("#kateter").val(data.kateter);
			$("input[name=bidai][value=" + data.bidai + "]").prop('checked', true);
			$("#jahit_luka").val(data.jahit_luka);
			$("#data_penunjang").val(data.data_penunjang);
			$("#obat").val(data.obat);
			$("#alasan_indikasi").val(data.alasan_indikasi);
			$("#provokatif").val(data.provokatif).change();
			if (data.provokatif == 0) {
				$("#provokatif_lain2").val(data.provokatif_lain2);
				$("#div_provokatif_lain2").show();
			}
			$("#quality").val(data.quality).change();
			if (data.quality == 0) {
				$("#quality_lain2").val(data.quality_lain2);
				$("#div_quality_lain2").show();
			}
			$("#region").val(data.region);
			$("#lokasi_menjalar").val(data.lokasi_menjalar);
			$("#skala").val(data.skala);
			$("#time").val(data.time).change();
			$("#keadaan_umum").val(data.keadaan_umum).change();
			$("#status_psikologis").val(data.status_psikologis).change();
			if (data.status_psikologis == 0) {
				$("#status_psikologis_lain2").val(data.status_psikologis_lain2);
				$("#div_status_psikologis_lain2").show();
			}
			$("#e").val(data.e);
			$("#v").val(data.v);
			$("#m").val(data.m);
			$("#total").val(data.total);
		}
		$('#addModal').modal('toggle');
	});
</script>
@endsection