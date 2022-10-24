@extends('kasus.layouts.main')

@section('title')
{{$kasus->judul_kasus}} - Pengkajian Awal Rawat Inap - Neonatus Anak - Kasus
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
						<button type="button" class="btn btn-rounded btn-alt-primary min-width-125 float-right" data-toggle="modal" data-target="#addModal"><i class="fa fa-pencil"></i> Pengkajian Awal Rawat Inap - Neonatus Anak Baru</button>
						@endif
						<h4>Pengkajian Awal Rawat Inap - Neonatus Anak</h4>
						<hr>
						@php $count = 1 @endphp
						@forelse($neonatus as $item)

						@if(session('my_role_'.$kasus->nomor_kasus))
						<button  class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5 pull-right deleteBtn" data-id="{{$item->id}}">
							<i class="fa fa-trash"></i>
						</button>
						<button  class="btn btn-sm btn-circle btn-outline-warning mr-5 mb-5 pull-right editBtn" data-id="{{$item->id}}" data-val="{{$item->val}}">
							<i class="fa fa-pencil"></i>
						</button>
						@endif
						<h5 class="mb-5 pl-5">#Pengkajian Awal Rawat Inap - Neonatus Anak {{$count++}}</h5>
						@php $res = json_decode($item->val) @endphp
						<div class="row" id="neonatus-{{$item->id}}">
							@include('kasus.alatbantu.pengkajian-ranap-neonatus.tabel-hasil')
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
							<h4 class="font-w400 mb-5">Belum ada asesmen Pengkajian Awal Rawat Inap - Neonatus Anak tersedia</h4>
							<p>Klik tombol <b>Pengkajian Awal Rawat Inap - Neonatus Anak Baru</b> untuk melakukan asesmen Pengkajian Awal Rawat Inap - Neonatus Anak</p>
						</div>

						@endforelse
					</div>
				</div>
			</div>
			<!-- END Updates -->
		</div>
	</div>
</main>
<form method="POST" action="{{url('')}}/kasus/{{$kasus->nomor_kasus}}/alat-bantu/pengkajian-ranap-neonatus/delete" id="formDelete">
	{{csrf_field()}}
	<input name="id" type="hidden" id="deleteInputId">
	
</form>
@include('kasus.alatbantu.pengkajian-ranap-neonatus.add')
@endsection

@section('js')
@include('kasus.alatbantu.pengkajian-ranap-neonatus.js')
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
			$("input[name=tgl_kedatangan]").val(data.tgl_kedatangan);
			$("input[name=jam_kedatangan]").val(data.jam_kedatangan);
			$("input[name=ruangan]").val(data.ruangan);
			$("input[name=agama]").val(data.agama);
			$("input[name=alamat]").val(data.alamat);
			$("input[name=tgl_pengkajian]").val(data.tgl_pengkajian);
			$("input[name=jam_pengkajian]").val(data.jam_pengkajian);
			$("input[name=alergi_obat]").val(data.alergi_obat);
			$("input[name=reaksi_obat]").val(data.reaksi_obat);
			$("input[name=alergi_makanan]").val(data.alergi_makanan);
			$("input[name=reaksi_makanan]").val(data.reaksi_makanan);
			$("input[name=alergi_lain]").val(data.alergi_lain);
			$("input[name=reaksi_terhadap_alergi]").val(data.reaksi_terhadap_alergi);
			$("select[name=gelang_tanda_alergi]").val(data.gelang_tanda_alergi).change();
			$("input[name=keluhan]").val(data.keluhan);
			$("input[name=diagnosis_perawatan]").val(data.diagnosis_perawatan);
			$("input[name=tempat_perawatan]").val(data.tempat_perawatan);
			$("input[name=waktu_perawatan]").val(data.waktu_perawatan);
			$("select[name=riwayat_keluarga]").val(data.riwayat_keluarga).change();
			$("select[name=pemeriksaan_kehamilan]").val(data.pemeriksaan_kehamilan).change();
			$("input[name=penggunaan_obat]").val(data.penggunaan_obat);
			$("select[name=konsumsi_tablet_fe]").val(data.konsumsi_tablet_fe).change();
			$("select[name=gangguan_kehamilan]").val(data.gangguan_kehamilan).change();
			$("select[name=cara_lahir]").val(data.cara_lahir).change();
			$("input[name=pb]").val(data.pb);
			$("input[name=BBL]").val(data.BBL);
			$("input[name=lk]").val(data.lk);
			$("input[name=ld]").val(data.ld);
			$("input[name=ll]").val(data.ll);
			$("input[name=as]").val(data.as);
			$("select[name=ketuban]").val(data.ketuban).change();
			$("select[name=keadaan_tali_pusat]").val(data.keadaan_tali_pusat).change();
			$("select[name=penyulit_persalinan]").val(data.penyulit_persalinan).change();
			$("input[name=obat_selama_persalinan]").val(data.obat_selama_persalinan);
			$("select[name=reflek]").val(data.reflek).change();
			$("input[name=asi_hingga_usia]").val(data.asi_hingga_usia);
			$("input[name=alasan_tidak_asi]").val(data.alasan_tidak_asi);
			$("input[name=penyakit_neonatal]").val(data.penyakit_neonatal);
			if (data.bcg) $("input[name=bcg]").prop('checked', true);
			if (data.dpt) $("input[name=dpt]").prop('checked', true);
			if (data.hepatitis_b) $("input[name=hepatitis_b]").prop('checked', true);
			if (data.polio) $("input[name=polio]").prop('checked', true);
			if (data.campak) $("input[name=campak]").prop('checked', true);
			$("input[name=masalah_perilaku]").val(data.masalah_perilaku);
			$("input[name=perilaku_kekerasan]").val(data.perilaku_kekerasan);
			$("select[name=hubungan_keluarga]").val(data.hubungan_keluarga).change();
			$("input[name=tempat_tinggal]").val(data.tempat_tinggal);
			$("input[name=nama_kerabat]").val(data.nama_kerabat);
			$("input[name=hubungan_kerabat]").val(data.hubungan_kerabat);
			$("input[name=telepon_kerabat]").val(data.telepon_kerabat);
			$("select[name=pekerjaan_ortu]").val(data.pekerjaan_ortu).change();
			$("select[name=penghasilan_ortu]").val(data.penghasilan_ortu).change();
			$("select[name=pendidikan]").val(data.pendidikan).change();
			$("input[name=budaya]").val(data.budaya);
			$("input[name=td]").val(data.td);
			$("input[name=nadi]").val(data.nadi);
			$("input[name=p]").val(data.p);
			$("input[name=suhu]").val(data.suhu);
			$("input[name=spo2]").val(data.spo2);
			$("input[name=pews]").val(data.pews);
			$("input[name=lingkar_kepala]").val(data.lingkar_kepala);
			$("input[name=bb_sekarang]").val(data.bb_sekarang);
			$("input[name=bb_sebelum]").val(data.bb_sebelum);
			$("input[name=antropometri_tb]").val(data.antropometri_tb);
			$("input[name=antropometri_lla]").val(data.antropometri_lla);
			$("input[name=nafsu_makan]").val(data.nafsu_makan);
			$("input[name=pola_makan]").val(data.pola_makan);
			$("select[name=mual]").val(data.mual).change();
			$("input[name=frekuensi_muntah]").val(data.frekuensi_muntah);
			$("input[name=makanan_pantangan]").val(data.makanan_pantangan);
			$("input[name=jumlah_minum_susu_formula]").val(data.jumlah_minum_susu_formula);
			$("input[name=ngt]").val(data.ngt);
			$("input[name=dot]").val(data.dot);
			$("input[name=sendok]").val(data.sendok);
			$("input[name=tidur_siang]").val(data.tidur_siang);
			$("input[name=tidur_malam]").val(data.tidur_malam);
			$("input[name=aktivitas_lain]").val(data.aktivitas_lain);
			$("input[name=kebiasaan_tidur]").val(data.kebiasaan_tidur);
			$("input[name=frekuensi_mandi]").val(data.frekuensi_mandi);
			$("input[name=frekuensi_menyikat_gigi]").val(data.frekuensi_sikat_gigi);
			$("input[name=frekuensi_mencuci_rambut]").val(data.frekuensi_mencuci_rambut);
			$("input[name=frekuensi_ganti_pakaian]").val(data.frekuensi_ganti_pakaian);
			$("select[name=bermain]").val(data.bermain).change();
			$("select[name=pola_asuh]").val(data.pola_asuh).change();
			$("input[name=bentuk_dada]").val(data.bentuk_dada);
			$("input[name=frekuensi_nafas]").val(data.frekuensi_nafas);
			$("select[name=irama]").val(data.irama).change();
			$("select[name=retraksi_dada]").val(data.retraksi_dada).change();
			$("select[name=otot_bantu_pernafasan]").val(data.otot_bantu_pernafasan).change();
			$("select[name=bunyi_nafas]").val(data.bunyi_nafas).change();
			$("select[name=pernafasan_cuping_hidung]").val(data.pernafasan_cuping_hidung).change();
			$("input[name=cyanosis_pernafasan]").val(data.cyanosis_pernafasan);
			$("select[name=perkusi]").val(data.perkusi).change();
			$("input[name=batuk_sputum]").val(data.batuk_sputum);
			$("input[name=alat_bantu_pernafasan]").val(data.alat_bantu_pernafasan);
			$("select[name=bunyi_jantung]").val(data.bunyi_jantung).change();
			$("select[name=crt]").val(data.crt).change();
			$("input[name=cyanosis_sirkulasi]").val(data.cyanosis_sirkulasi);
			$("select[name=clubbing_finger]").val(data.clubbing_finger).change();
			$("select[name=kesadaran]").val(data.kesadaran).change();
			$("select[name=kejang]").val(data.kejang).change();
			$("select[name=tremor]").val(data.tremor).change();
			$("select[name=kaku_kuduk]").val(data.kaku_kuduk).change();
			$("select[name=bentuk_kelamin]").val(data.bentuk_kelamin).change();
			$("select[name=uretra]").val(data.uretra).change();
			$("select[name=scrotum]").val(data.scrotum).change();
			$("select[name=vagina]").val(data.vagina).change();
			$("select[name=bak]").val(data.bak).change();
			$("input[name=frekuensi_bak]").val(data.frekuensi_bak);
			$("input[name=jumlah_bak]").val(data.jumlah_bak);
			$("input[name=warna_bak]").val(data.warna_bak);
			$("select[name=masalah_bak]").val(data.masalah_bak).change();
			$("select[name=penggunaan_alat_bantu]").val(data.penggunaan_alat_bantu).change();
			$("select[name=mulut]").val(data.mulut).change();
			$("select[name=bibir]").val(data.bibir).change();
			$("select[name=lidah]").val(data.lidah).change();
			$("select[name=rongga_mulut]").val(data.rongga_mulut).change();
			$("select[name=nyeri_telan]").val(data.nyeri_telan).change();
			$("select[name=kembung]").val(data.kembung).change();
			$("select[name=luka]").val(data.luka).change();
			$("select[name=bising_usus]").val(data.bising_usus).change();
			$("select[name=anus_hemmoroid]").val(data.anus_hemmoroid).change();
			$("select[name=kulit]").val(data.kulit).change();
			$("select[name=turgor_kulit]").val(data.turgor_kulit).change();
			$("select[name=akral]").val(data.akral).change();
			$("select[name=kebersihan]").val(data.kebersihan).change();
			$("select[name=punggung]").val(data.punggung).change();
			$("input[name=area_luka]").val(data.area_luka);
			if (data.tidak_ada) $("input[name=tidak_ada]").prop('checked', true);
			if (data.omphalocel) $("input[name=omphalocel]").prop('checked', true);
			if (data.gastroschizis) $("input[name=gastroschizis]").prop('checked', true);
			if (data.hisprung_diseases) $("input[name=hisprung_diseases]").prop('checked', true);
			if (data.atresia_ani) $("input[name=atresia_ani]").prop('checked', true);
			if (data.polidaktili) $("input[name=polidaktili]").prop('checked', true);
			if (data.sindaktili) $("input[name=sindaktili]").prop('checked', true);
			if (data.ctev) $("input[name=ctev]").prop('checked', true);
			if (data.down_syndrome) $("input[name=down_syndrome]").prop('checked', true);
			if (data.caput_succedaneum) $("input[name=caput_succedaneum]").prop('checked', true);
			if (data.cephal_hematoma) $("input[name=cephal_hematoma]").prop('checked', true);
		}
		$('#addModal').modal('toggle');
	});
</script>
@endsection