@extends('kasus.layouts.main')

@section('title')
{{$kasus->judul_kasus}} - Patograf - Kasus
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
						<button type="button" class="btn btn-rounded btn-alt-primary min-width-125 float-right" data-toggle="modal" data-target="#addModal"><i class="fa fa-pencil"></i> Patograf Baru</button>
						@endif
						<h4>Patograf</h4>
						<hr>
						@php $count = 1 @endphp
						@forelse($patograf as $item)

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
						<h5 class="mb-5 pl-5">#Patograf {{$count++}}</h5>
						@php $res = json_decode($item->val) @endphp
						<div class="row" id="patograf-{{$item->id}}">
							@include('kasus.alatbantu.patograf.tabel-hasil')
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
						@empty

						<div class="text-center py-50">
							<h4 class="font-w400 mb-5">Belum ada asesmen Patograf tersedia</h4>
							<p>Klik tombol <b>Patograf Baru</b> untuk melakukan asesmen Patograf</p>
						</div>

						@endforelse
					</div>
				</div>
			</div>
			<!-- END Updates -->
		</div>
	</div>
</main>
<form method="POST" action="{{url('')}}/kasus/{{$kasus->nomor_kasus}}/alat-bantu/patograf/delete" id="formDelete">
	{{csrf_field()}}
	<input name="id" type="hidden" id="deleteInputId">
	
</form>
@include('kasus.alatbantu.patograf.add')
@endsection

@section('js')
@include('kasus.alatbantu.patograf.js')
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
			$("input[name=ketuban_pecah_jam]").val(data.ketuban_pecah_jam);
			$("input[name=mules_jam]").val(data.mules_jam);
			$("input[name=denyut_jantung_janin]").val(data.denyut_jantung_janin);
			$("input[name=air_ketuban_penyusupan]").val(data.air_ketuban_penyusupan);
			$("input[name=pembukaan_serviks]").val(data.pembukaan_serviks);
			$("input[name=turunnya_kepala]").val(data.turunnya_kepala);
			$("input[name=waktu]").val(data.waktu);
			$("input[name=kontraksi_tiap_10]").val(data.kontraksi_tiap_10);
			$("input[name=oksitosin_ui]").val(data.oksitosin_ui);
			$("input[name=obat_dan_cairan_iv]").val(data.obat_dan_cairan_iv);
			$("input[name=nadi]").val(data.nadi);
			$("input[name=tekanan_darah]").val(data.tekanan_darah);
			$("input[name=suhu]").val(data.suhu);
			$("input[name=suhu_urin]").val(data.suhu_urin);
			$("input[name=aseton_urin]").val(data.aseton_urin);
			$("input[name=volume_urin]").val(data.volume_urin);
			$("input[name=tanggal]").val(data.tanggal);
			$("input[name=nama_bidan]").val(data.nama_bidan);
			$("input[name=tempat_persalinan]").val(data.tempat_persalinan);
			$("select[name=catatan]").val(data.catatan).change();
			$("input[name=alasan_merujuk]").val(data.alasan_merujuk);
			$("input[name=tempat_rujukan]").val(data.tempat_rujukan);
			$("select[name=pendamping_rujuk]").val(data.pendamping_rujuk).change();
			if (!data.normal) $("input[name=normal]").prop('checked', false);
			$("input[name=masalah_kala_i]").val(data.masalah_kala_i);
			$("input[name=penatalaksanaan_kala_i]").val(data.penatalaksanaan_kala_i);
			$("input[name=hasilnya_kala_i]").val(data.hasilnya_kala_i);
			$("input[name=ketuban_pecah_jam]").val(data.ketuban_pecah_jam);
			if (!data.episotomi) $("input[name=episotomi]").prop('checked', false);
			$("input[name=indikasi_episotomi]").val(data.indikasi_episotomi);
			$("select[name=pendamping_persalinan]").val(data.pendamping_persalinan).change();
			if (!data.gawat_janin) $("input[name=gawat_janin]").prop('checked', false);
			$("input[name=tindakan_gawat_janin]").val(data.tindakan_gawat_janin);
			if (!data.distosia_bahu) $("input[name=distosia_bahu]").prop('checked', false);
			$("input[name=tindakan_distosia_bahu]").val(data.tindakan_distosia_bahu);
			$("input[name=masalah_kala_ii]").val(data.masalah_kala_ii);
			$("input[name=penatalaksanaan_kala_ii]").val(data.penatalaksanaan_kala_ii);
			$("input[name=hasilnya_kala_ii]").val(data.hasilnya_kala_ii);
			$("input[name=lama_kala_iii]").val(data.lama_kala_iii);
			if (!data.pemberian_oksitosin) $("input[name=pemberian_oksitosin]").prop('checked', false);
			$("input[name=waktu_pemberian_oksitosion]").val(data.waktu_pemberian_oksitosion);
			$("input[name=alasan_tidak_oksitosion]").val(data.alasan_tidak_oksitosion);
			if (!data.penegangan_tali) $("input[name=penegangan_tali]").prop('checked', false);
			$("input[name=alasan_tidak_penegangan_tali]").val(data.alasan_tidak_penegangan_tali);
			if (!data.masase) $("input[name=masase]").prop('checked', false);
			$("input[name=alasan_tidak_masase]").val(data.alasan_tidak_masase);
			if (!data.plasenta_lengkap) $("input[name=plasenta_lengkap]").prop('checked', false);
			$("input[name=tindakan_tidak_plasenta_lengkap]").val(data.tindakan_tidak_plasenta_lengkap);
			if (!data.plasenta_30) $("input[name=plasenta_30]").prop('checked', false);
			$("input[name=tindakan_tidak_plasenta_30]").val(data.tindakan_tidak_plasenta_30);
			if (!data.laserasi) $("input[name=laserasi]").prop('checked', false);
			$("input[name=tempat_laserasi]").val(data.tempat_laserasi);
			$("select[name=derajat_laserasi_perineum]").val(data.derajat_laserasi_perineum).change();
			$("input[name=tindakan_laserasi_perineum]").val(data.tindakan_laserasi_perineum);
			$("select[name=penjahitan]").val(data.penjahitan).change();
			$("input[name=alasan_tidak_dijahit]").val(data.alasan_tidak_dijahit);
			$("input[name=tempat_laserasi]").val(data.tempat_laserasi);
			if (!data.atoni_uteri) $("input[name=atoni_uteri]").prop('checked', false);
			$("input[name=tindakan_atoni_uteri]").val(data.tindakan_atoni_uteri);
			$("input[name=jumlah_perdarahan]").val(data.jumlah_perdarahan);
			$("input[name=masalah_kala_iii]").val(data.masalah_kala_iii);
			$("input[name=penatalaksanaan_kala_iii]").val(data.penatalaksanaan_kala_iii);
			$("input[name=hasilnya_kala_iii]").val(data.hasilnya_kala_iii);
			$("input[name=berat_badan]").val(data.berat_badan);
			$("input[name=panjang_badan]").val(data.panjang_badan);
			$("select[name=jenis_kelamin]").val(data.jenis_kelamin).change();
			$("select[name=penilaian_bayi_lahir]").val(data.penilaian_bayi_lahir).change();
			$("input[name=tindakan_bayi_lahir]").val(data.tindakan_bayi_lahir);
			if (!data.mengeringkan) $("input[name=mengeringkan]").prop('checked', false);
			if (!data.menghangatkan) $("input[name=menghangatkan]").prop('checked', false);
			if (!data.rangsangan_taktil) $("input[name=rangsangan_taktil]").prop('checked', false);
			if (!data.bungkus) $("input[name=bungkus]").prop('checked', false);
			if (!data.pencegahan_infeksi_mata) $("input[name=pencegahan_infeksi_mata]").prop('checked', false);
			$("select[name=aspiksia]").val(data.aspiksia).change();
			$("select[name=tindakan_aspiksia]").val(data.tindakan_aspiksia).change();
			$("input[name=cacat_bawaan]").val(data.cacat_bawaan);
			$("input[name=tindakan_hipotermi]").val(data.tindakan_hipotermi);
			$("input[name=waktu_pemberian_asi]").val(data.waktu_pemberian_asi);
			$("input[name=masalah_bayi_lahir]").val(data.masalah_bayi_lahir);
			$("input[name=penatalaksanaan_bayi_lahir]").val(data.penatalaksanaan_bayi_lahir);
			$("input[name=hasilnya_bayi_lahir]").val(data.hasilnya_bayi_lahir);
			$("input[name=jam_ke]").val(data.jam_ke);
			$("input[name=waktu_pemantauan]").val(data.waktu_pemantauan);
			$("input[name=tekanan_darah_pemantauan]").val(data.tekanan_darah_pemantauan);
			$("input[name=nadi_pemantauan]").val(data.nadi_pemantauan);
			$("input[name=suhu_pemantauan]").val(data.suhu_pemantauan);
			$("input[name=tinggi_fundus_uteri]").val(data.tinggi_fundus_uteri);
			$("input[name=kontraksi_uterus]").val(data.kontraksi_uterus);
			$("input[name=kandung_kemih]").val(data.kandung_kemih);
			$("input[name=perdarahan]").val(data.perdarahan);
			$("input[name=masalah_kala_iv]").val(data.masalah_kala_iv);
			$("input[name=penatalaksanaan_kala_iv]").val(data.penatalaksanaan_kala_iv);
			$("input[name=hasilnya_kala_iv]").val(data.hasilnya_kala_iv);
		}
		$('#addModal').modal('toggle');
	});
</script>
@endsection