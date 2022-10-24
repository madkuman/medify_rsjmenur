@extends('kasus.layouts.main')

@section('title')
{{$kasus->judul_kasus}} - Asesmen Ceklis Keselamatan Pasien Pembedahan - Kasus
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
						@if(session('my_role_'.$kasus->nomor_kasus))
						<button type="button" class="btn btn-rounded btn-alt-primary min-width-125 float-right editBtn" data-toggle="modal" data-target="#addModal"><i class="fa fa-pencil"></i> Asesmen Ceklis Keselamatan Pasien Pembedahan Baru</button>
						@endif
						
						<h4>Asesmen Ceklis Keselamatan Pasien Pembedahan</h4>
						<hr>
						@php $count = 1 @endphp
						@forelse($ceklis as $item)

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
						<h5 class="mb-5 pl-5">#Asesmen Ceklis Keselamatan Pasien Pembedahan {{$count++}}</h5>
						@php $res = json_decode($item->val) @endphp
						<div class="row" id="">
							@include('kasus.alatbantu.ceklis-pembedahan.tabel-hasil')
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
							<h4 class="font-w400 mb-5">Belum ada asesmen Asesmen Ceklis Keselamatan Pasien Pembedahan tersedia</h4>
							<p>Klik tombol <b>Asesmen Ceklis Keselamatan Pasien Pembedahan Baru</b> untuk melakukan asesmen Asesmen Ceklis Keselamatan Pasien Pembedahan</p>
						</div>

						@endforelse
					</div>
				</div>
			</div>
			<!-- END Updates -->
		</div>
	</div>
</main>
<form method="POST" action="{{url()->current()}}/delete" id="formDelete">
	{{csrf_field()}}
	<input name="id" type="hidden" id="deleteInputId">
	
</form>
@include('kasus.alatbantu.ceklis-pembedahan.add')
@endsection

@section('js')
<script src="{{url('')}}/assets/js/plugins/jquery-masked-inputs/jquery.mask.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('.time').mask('00:00');
	});

	$(".deleteBtn").click(function(e){
		e.preventDefault();
		id = $(this).data("id");
		$('#deleteInputId').val(id);
		swal({
			title: "Hapus",
			text: "Apakah anda yakin akan menghapus data ini?",
			showCancelButton: true,
			reverseButtons: true,
			type: 'warning',
			confirmButtonClass: "btn btn-danger",
			cancelButtonClass: "btn btn-default",
			confirmButtonText: "Hapus",
			cancelButtonText: "Kembali",
			closeOnConfirm: false
		}).then(function(result) {
			if(result.value)
			{
				$('#formDelete').submit();
			}
		});
	});
	$(".editBtn").click(function(e){
		id = $(this).data('id');
		var data = $(this).data('val');
		console.log(data);
		if(data != "" && data != undefined){
			$("#id").val(id);
			$("input[type=checkbox][name=konfirmasi_identitas_dan_gelang_pasien]").prop('checked', data.konfirmasi_identitas_dan_gelang_pasien == '1');
			$("input[type=checkbox][name=konfirmasi_lokasi_pasien]").prop('checked', data.konfirmasi_lokasi_pasien == '1');
			$("input[type=checkbox][name=konfirmasi_prosedur_operasi]").prop('checked', data.konfirmasi_prosedur_operasi == '1');
			$("input[type=checkbox][name=konfirmasi_persetujuan_operasi]").prop('checked', data.konfirmasi_persetujuan_operasi == '1');
			$("input[type=checkbox][name=lokasi_operasi_sudah_diberi_tanda]").prop('checked', data.lokasi_operasi_sudah_diberi_tanda == '1');
			$("input[type=checkbox][name=lokasi_operasi_tidak_dapat_dilakukan]").prop('checked', data.lokasi_operasi_tidak_dapat_dilakukan == '1');
			$("input[type=checkbox][name=mesin_dan_obat_anestesi_sudah_dicek]").prop('checked', data.mesin_dan_obat_anestesi_sudah_dicek == '1');
			$("input[type=checkbox][name=pulse_oximeter_sudah_dicek_dan_berfungsi]").prop('checked', data.pulse_oximeter_sudah_dicek_dan_berfungsi == '1');
			$("input[type=checkbox][name=pasien_mempunyai_riwayat_alergi]").prop('checked', data.pasien_mempunyai_riwayat_alergi == '1');
			$("input[type=checkbox][name=kesulitan_nafas_atau_resiko_aspirasi]").prop('checked', data.kesulitan_nafas_atau_resiko_aspirasi == '1');
			$("input[type=checkbox][name=resiko_kehilangan_darah_lebih_dari_500ml]").prop('checked', data.resiko_kehilangan_darah_lebih_dari_500ml == '1');
			$("input[type=checkbox][name=dua_akses_intravena_akses_sentral_dan_rencana_terapi_cairan]").prop('checked', data.dua_akses_intravena_akses_sentral_dan_rencana_terapi_cairan == '1');
			$("input[type=checkbox][name=sebutkan_nama_dan_peran_masing_masing_anggota_tim]").prop('checked', data.sebutkan_nama_dan_peran_masing_masing_anggota_tim == '1');
			$("input[type=checkbox][name=konfirmasi_nama_pasien]").prop('checked', data.konfirmasi_nama_pasien == '1');
			$("input[type=checkbox][name=konfirmasi_prosedur]").prop('checked', data.konfirmasi_prosedur == '1');
			$("input[type=checkbox][name=konfirmasi_lokasi_insisi]").prop('checked', data.konfirmasi_lokasi_insisi == '1');
			$("input[type=checkbox][name=konfirmasi_fiksasi_pasien]").prop('checked', data.konfirmasi_fiksasi_pasien == '1');
			console.log(data.profilaksis_antibiotik_sudah_diberikan_30_menit_sebelum , data.profilaksis_antibiotik_sudah_diberikan_30_menit_sebelum  == '1', $("input[name=profilaksis_antibiotik_sudah_diberikan_30_menit_sebelum]"))
			$("input[name=profilaksis_antibiotik_sudah_diberikan_30_menit_sebelum]").prop('checked', data.profilaksis_antibiotik_sudah_diberikan_30_menit_sebelum == '1');
			$("input[type=checkbox][name=kemungkinan_timbul_kesulitan_dalam_operasi]").prop('checked', data.kemungkinan_timbul_kesulitan_dalam_operasi == '1');
			$("input[name=masalah_khusus_pada_pasien_dan_langkah_antisipasi]").prop('checked', data.masalah_khusus_pada_pasien_dan_langkah_antisipasi == '1');
			$("input[type=checkbox][name=cek_alat_steril]").prop('checked', data.cek_alat_steril == '1');
			$("input[type=checkbox][name=kesediaan_alat_khusus]").prop('checked', data.kesediaan_alat_khusus == '1');
			$("input[type=checkbox][name=hasil_mri_ct_scan_foto_rontgen_terpasang]").prop('checked', data.hasil_mri_ct_scan_foto_rontgen_terpasang == '1');
			$("input[type=text][name=profilaksis_diberikan_oleh]").val(data.profilaksis_diberikan_oleh);
			$("input[type=text][name=estimasi_lama_operasi_dalam_jam]").val(data.estimasi_lama_operasi_dalam_jam);
			$("input[type=text][name=perkiraan_kehilangan_darah_dalam_cc]").val(data.perkiraan_kehilangan_darah_dalam_cc);
			$("input[type=text][name=sirculation_nurs]").val(data.sirculation_nurs);
			$("input[type=checkbox][name=konfirmasi_secara_verbal_tentang_nama_prosedur_tindakan]").prop('checked', data.konfirmasi_secara_verbal_tentang_nama_prosedur_tindakan == '1');
			$("input[type=text][name=instrumen_pra]").val(data.instrumen_pra);
			$("input[type=text][name=instrumen_intra]").val(data.instrumen_intra);
			$("input[type=text][name=instrumen_tambahan]").val(data.instrumen_tambahan);
			$("input[type=text][name=instrumen_pasca]").val(data.instrumen_pasca);
			$("input[type=text][name=instrumen_keterangan]").val(data.instrumen_keterangan);
			$("input[type=text][name=kassa_pra]").val(data.kassa_pra);
			$("input[type=text][name=kassa_intra]").val(data.kassa_intra);
			$("input[type=text][name=kassa_tambahan]").val(data.kassa_tambahan);
			$("input[type=text][name=kassa_pasca]").val(data.kassa_pasca);
			$("input[type=text][name=kassa_keterangan]").val(data.kassa_keterangan);
			$("input[type=text][name=lapspong_pra]").val(data.lapspong_pra);
			$("input[type=text][name=lapspong_intra]").val(data.lapspong_intra);
			$("input[type=text][name=lapspong_tambahan]").val(data.lapspong_tambahan);
			$("input[type=text][name=lapspong_pasca]").val(data.lapspong_pasca);
			$("input[type=text][name=lapspong_keterangan]").val(data.lapspong_keterangan);
			$("input[type=text][name=depers_pra]").val(data.depers_pra);
			$("input[type=text][name=depers_intra]").val(data.depers_intra);
			$("input[type=text][name=depers_tambahan]").val(data.depers_tambahan);
			$("input[type=text][name=depers_pasca]").val(data.depers_pasca);
			$("input[type=text][name=depers_keterangan]").val(data.depers_keterangan);
			$("input[type=text][name=jarum_pra]").val(data.jarum_pra);
			$("input[type=text][name=jarum_intra]").val(data.jarum_intra);
			$("input[type=text][name=jarum_tambahan]").val(data.jarum_tambahan);
			$("input[type=text][name=jarum_pasca]").val(data.jarum_pasca);
			$("input[type=text][name=jarum_keterangan]").val(data.jarum_keterangan);
			$("input[type=text][name=pisau_pra]").val(data.pisau_pra);
			$("input[type=text][name=pisau_intra]").val(data.pisau_intra);
			$("input[type=text][name=pisau_pasca]").val(data.pisau_pasca);
			$("input[type=text][name=pisau_keterangan]").val(data.pisau_keterangan);
			$("input[type=checkbox][name=spesimen_telah_diberikan_label]").prop('checked', data.spesimen_telah_diberikan_label == '1');
			$("input[type=checkbox][name=terdapat_masalah_dengan_peralatan_selama_operasi]").prop('checked', data.terdapat_masalah_dengan_peralatan_selama_operasi == '1');
			$("textarea[name=pesan_khusus]").html(data.pesan_khusus);
		}else{
			$("#id").val(0);
			$("input[type=checkbox][name=konfirmasi_identitas_dan_gelang_pasien]").prop('checked', false);
			$("input[type=checkbox][name=konfirmasi_lokasi_pasien]").prop('checked', false);
			$("input[type=checkbox][name=konfirmasi_prosedur_operasi]").prop('checked', false);
			$("input[type=checkbox][name=konfirmasi_persetujuan_operasi]").prop('checked', false);
			$("input[type=checkbox][name=lokasi_operasi_sudah_diberi_tanda]").prop('checked', false);
			$("input[type=checkbox][name=lokasi_operasi_tidak_dapat_dilakukan]").prop('checked', false);
			$("input[type=checkbox][name=mesin_dan_obat_anestesi_sudah_dicek]").prop('checked', false);
			$("input[type=checkbox][name=pulse_oximeter_sudah_dicek_dan_berfungsi]").prop('checked', false);
			$("input[type=checkbox][name=pasien_mempunyai_riwayat_alergi]").prop('checked', false);
			$("input[type=checkbox][name=kesulitan_nafas_atau_resiko_aspirasi]").prop('checked', false);
			$("input[type=checkbox][name=resiko_kehilangan_darah_lebih_dari_500ml]").prop('checked', false);
			$("input[type=checkbox][name=dua_akses_intravena_akses_sentral_dan_rencana_terapi_cairan]").prop('checked', false);
			$("input[type=checkbox][name=sebutkan_nama_dan_peran_masing_masing_anggota_tim]").prop('checked', false);
			$("input[type=checkbox][name=konfirmasi_nama_pasien]").prop('checked', false);
			$("input[type=checkbox][name=konfirmasi_prosedur]").prop('checked', false);
			$("input[type=checkbox][name=konfirmasi_lokasi_insisi]").prop('checked', false);
			$("input[type=checkbox][name=konfirmasi_fiksasi_pasien]").prop('checked', false);
			$("input[name=profilaksis_antibiotik_sudah_diberikan_30_menit_sebelum]").prop('checked', false);
			$("input[type=checkbox][name=kemungkinan_timbul_kesulitan_dalam_operasi]").prop('checked', false);
			$("input[name=masalah_khusus_pada_pasien_dan_langkah_antisipasi]").prop('checked', false);
			$("input[type=checkbox][name=cek_alat_steril]").prop('checked', false);
			$("input[type=checkbox][name=kesediaan_alat_khusus]").prop('checked', false);
			$("input[type=checkbox][name=hasil_mri_ct_scan_foto_rontgen_terpasang]").prop('checked', false);
			$("input[type=text][name=profilaksis_diberikan_oleh]").val('');
			$("input[type=text][name=estimasi_lama_operasi_dalam_jam]").val('');
			$("input[type=text][name=perkiraan_kehilangan_darah_dalam_cc]").val('');
			$("input[type=text][name=sirculation_nurs]").val('');
			$("input[type=checkbox][name=konfirmasi_secara_verbal_tentang_nama_prosedur_tindakan]").prop('checked', false);
			$("input[type=text][name=instrumen_pra]").val('');
			$("input[type=text][name=instrumen_intra]").val('');
			$("input[type=text][name=instrumen_tambahan]").val('');
			$("input[type=text][name=instrumen_pasca]").val('');
			$("input[type=text][name=instrumen_keterangan]").val('');
			$("input[type=text][name=kassa_pra]").val('');
			$("input[type=text][name=kassa_intra]").val('');
			$("input[type=text][name=kassa_tambahan]").val('');
			$("input[type=text][name=kassa_pasca]").val('');
			$("input[type=text][name=kassa_keterangan]").val('');
			$("input[type=text][name=lapspong_pra]").val('');
			$("input[type=text][name=lapspong_intra]").val('');
			$("input[type=text][name=lapspong_tambahan]").val('');
			$("input[type=text][name=lapspong_pasca]").val('');
			$("input[type=text][name=lapspong_keterangan]").val('');
			$("input[type=text][name=depers_pra]").val('');
			$("input[type=text][name=depers_intra]").val('');
			$("input[type=text][name=depers_tambahan]").val('');
			$("input[type=text][name=depers_pasca]").val('');
			$("input[type=text][name=depers_keterangan]").val('');
			$("input[type=text][name=jarum_pra]").val('');
			$("input[type=text][name=jarum_intra]").val('');
			$("input[type=text][name=jarum_tambahan]").val('');
			$("input[type=text][name=jarum_pasca]").val('');
			$("input[type=text][name=jarum_keterangan]").val('');
			$("input[type=text][name=pisau_pra]").val('');
			$("input[type=text][name=pisau_intra]").val('');
			$("input[type=text][name=pisau_pasca]").val('');
			$("input[type=text][name=pisau_keterangan]").prop('checked', false);
			$("input[type=checkbox][name=spesimen_telah_diberikan_label]").prop('checked', false);
			$("input[type=checkbox][name=terdapat_masalah_dengan_peralatan_selama_operasi]").prop('checked', false);
			$("textarea[name=pesan_khusus]").html('');
		}
		$('#addModal').modal('toggle');
	});
</script>
@endsection