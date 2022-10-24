@extends('kasus.layouts.main')

@section('title')
{{$kasus->judul_kasus}} - Asesmen Perioperatif - Kasus
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
						<button type="button" class="btn-alt btn-primary min-width-125 float-right addBtn" ><i class="fa fa-pencil"></i> Buat Baru</button>
						<h4 class="pt-10">Asesmen Perioperatif</h4>
						<hr>
						<div class="row">
							@php $count = 1 @endphp
							@forelse($perioperatif as $item)
							<div class="col-8"> 
								@if(session('my_role_'.$kasus->nomor_kasus))
								@if(session('my_role_'.$kasus->nomor_kasus)->admin == 1 || $item->created_by == Auth::user()->id)
								<button  class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5 pull-right deleteBtn" data-id="{{$item->id}}">
									<i class="fa fa-trash"></i>
								</button>
								@endif
								@endif
								<h5 class="mb-5 pl-5">#Asesmen Perioperatif {{$count++}}</h5>
								@php $res = json_decode($item->val) @endphp
								<div class="p-10" id="">
									@include('kasus.alatbantu.perioperatif.tabel-hasil')
									@include('kasus.alatbantu.perioperatif.creator')
								</div>
							</div>
							<div class="col-12">
								<hr class="m-0">
							</div>
							@empty
							<div class="col-12">
								<div class="text-center py-50">
									<h4 class="font-w400 mb-5">Belum ada Asesmen Perioperatif tersedia</h4>
									<p>Klik tombol <b>Asesmen Perioperatif Baru</b> untuk melakukan Asesmen Perioperatif</p>
								</div>
							</div>

							@endforelse
						</div>
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
@include('kasus.alatbantu.perioperatif.add')
@include('kasus.alatbantu.perioperatif.view-modal')
@endsection

@section('js')
<script src="{{url('')}}/assets/js/plugins/jquery-masked-inputs/jquery.mask.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('.time').mask('00:00');
	});

	$('.addBtn').click(function(e)
	{
		$('#addModal').modal('show');
	})

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


	$('.viewBtn').click(function(e)
	{
		var id = $(this).data('id');
		var data = $(this).data('val');


		if(data != "" && data != undefined){
			$("#viewModal input[name=id]").val(id);
			$("#viewModal input[name=pasien_datang_dari_ruang]").val(data.pasien_datang_dari_ruang);
			$("#viewModal input[name=jam]").val(data.jam);
			$("#viewModal input[name=keluhan_utama]").val(data.keluhan_utama);
			$("#viewModal select[name=keadaan_umum]").val(data.keadaan_umum);
			$("#viewModal input[name=tekanan_darah]").val(data.tekanan_darah);
			$("#viewModal input[name=n]").val(data.n);
			$("#viewModal input[name=s]").val(data.s);
			$("#viewModal input[name=rr]").val(data.rr);
			$("#viewModal input[name=tb]").val(data.tb);
			$("#viewModal input[name=bb]").val(data.bb);
			$("#viewModal select[name=pernapasan]").val(data.pernapasan);
			if(data.surat_ijin_operasi == 'on') $("#viewModal input[name=surat_ijin_operasi]").prop('checked', true);
			if(data.surat_ijin_pembiusan == 'on') $("#viewModal input[name=surat_ijin_pembiusan]").prop('checked', true);
			if(data.perhiasan == 'on') $("#viewModal input[name=perhiasan]").prop('checked', true);
			if(data.folley_catether == 'on') $("#viewModal input[name=folley_catether]").prop('checked', true);
			if(data.persiapan_kulit_cukur == 'on') $("#viewModal input[name=persiapan_kulit_cukur]").prop('checked', true);
			if(data.huknah == 'on') $("#viewModal input[name=huknah]").prop('checked', true);
			$("#viewModal input[name=persediaan_darah]").val(data.persediaan_darah);
			$("#viewModal input[name=hasil_laboratorium]").val(data.hasil_laboratorium);
			$("#viewModal input[name=rontgen]").val(data.rontgen);
			$("#viewModal input[name=infus]").val(data.infus);
			$("#viewModal input[name=obat_yang_diberikan]").val(data.obat_yang_diberikan);
			$("#viewModal input[name=alergi]").val(data.alergi);
			$("#viewModal input[name=obat_premedikasi]").val(data.obat_premedikasi);
			$("#viewModal select[name=riwayat_operasi]").val(data.riwayat_operasi);
			$("#viewModal select[name=pendidikan_kesehatan]").val(data.pendidikan_kesehatan);
			$("#viewModal input[name=ok_pasien_masuk_kamar_operasi]").val(data.ok_pasien_masuk_kamar_operasi);
			$("#viewModal input[name=jam_pasien_masuk_kamar_operasi]").val(data.jam_pasien_masuk_kamar_operasi);
			$("#viewModal textarea[name=cemas]").val(data.cemas);
			$("#viewModal textarea[name=nyeri]").val(data.nyeri);
			$("#viewModal textarea[name=resiko_jatuh]").val(data.resiko_jatuh);
			$("#viewModal textarea[name=resiko_hypovolemik]").val(data.resiko_hypovolemik);
			$("#viewModal input[name=kie]").val(data.kie);
			$("#viewModal input[name=distraksi_relaksasi]").val(data.distraksi_relaksasi);
			$("#viewModal input[name=kolaborasi_pemberian_terapi]").val(data.kolaborasi_pemberian_terapi);
			$("#viewModal input[name=kaji_tingkat_nyeri]").val(data.kaji_tingkat_nyeri);
			$("#viewModal input[name=distraksi_relaksasi2]").val(data.distraksi_relaksasi2);
			$("#viewModal input[name=kolaborasi_pemberian_terapi2]").val(data.kolaborasi_pemberian_terapi2);
			$("#viewModal input[name=observasi_tingkat_kesadaran]").val(data.observasi_tingkat_kesadaran);
			$("#viewModal input[name=pasang_pengaman_pasien]").val(data.pasang_pengaman_pasien);
			$("#viewModal input[name=pantau_keadaan_umum_pasien]").val(data.pantau_keadaan_umum_pasien);
			$("#viewModal input[name=pantau_intake_output]").val(data.pantau_intake_output);
			$("#viewModal input[name=kolaborasi_pemberian_cairan]").val(data.kolaborasi_pemberian_cairan);
			$("#viewModal input[name=kolaborasi_pemberian_terapi3]").val(data.kolaborasi_pemberian_terapi3);
			$("#viewModal input[name=mulai_anestesi]").val(data.mulai_anestesi);
			$("#viewModal input[name=selesai_anestesi]").val(data.selesai_anestesi);
			$("#viewModal select[name=jenis_pembiusan]").val(data.jenis_pembiusan);
			$("#viewModal select[name=posisi_infus]").val(data.posisi_infus);
			$("#viewModal select[name=posisi_pembedahan]").val(data.posisi_pembedahan);
			$("#viewModal select[name=jenis_operasi]").val(data.jenis_operasi);
			$("#viewModal select[name=golongan_operasi]").val(data.golongan_operasi);
			$("#viewModal select[name=posisi_tangan]").val(data.posisi_tangan);
			$("#viewModal select[name=chateter_urine]").val(data.chateter_urine);
			$("#viewModal input[name=chateter_dipasang_oleh]").val(data.chateter_dipasang_oleh);
			$("#viewModal select[name=disinfektisasi_kulit]").val(data.disinfektisasi_kulit);
			$("#viewModal input[name=incisie_kulit]").val(data.incisie_kulit);
			$("#viewModal select[name=diatermi]").val(data.diatermi);
			$("#viewModal select[name=code_diatermi]").val(data.code_diatermi);
			$("#viewModal input[name=diatermi_dipasang_oleh]").val(data.diatermi_dipasang_oleh);
			$("#viewModal select[name=lokasi_plat_diatermi]").val(data.lokasi_plat_diatermi);
			$("#viewModal select[name=kondisi_kulit_sebelum]").val(data.kondisi_kulit_sebelum);
			$("#viewModal select[name=kondisi_kulit_sesudah]").val(data.kondisi_kulit_sesudah);
			$("#viewModal select[name=monitor_anestesi]").val(data.monitor_anestesi);
			$("#viewModal select[name=mesin_anestesi]").val(data.mesin_anestesi);
			$("#viewModal select[name=lokasi_thorniquet]").val(data.lokasi_thorniquet);
			$("#viewModal input[name=thorniquet_dimulai]").val(data.thorniquet_dimulai);
			$("#viewModal input[name=thorniquet_selesai]").val(data.thorniquet_selesai);
			$("#viewModal input[name=unit_pemanas_dimulai]").val(data.unit_pemanas_dimulai);
			$("#viewModal input[name=unit_pemanas_selesai]").val(data.unit_pemanas_selesai);
			$("#viewModal input[name=lokasi_pemakaian_imaging]").val(data.lokasi_pemakaian_imaging);
			$("#viewModal input[name=jenis_pemakaian_imaging]").val(data.jenis_pemakaian_imaging);
			$("#viewModal select[name=tampon]").val(data.tampon);
			$("#viewModal input[name=jumlah_kassa_yang_dipakai_operasi]").val(data.jumlah_kassa_yang_dipakai_operasi);
			$("#viewModal input[name=jumlah_kassa_besar_yang_dipakai_operasi]").val(data.jumlah_kassa_besar_yang_dipakai_operasi);
			$("#viewModal input[name=jumlah_deppres_yang_dipakai_operasi]").val(data.jumlah_deppres_yang_dipakai_operasi);
			$("#viewModal input[name=jumlah_pisau_yang_dipakai_operasi]").val(data.jumlah_pisau_yang_dipakai_operasi);
			$("#viewModal input[name=ukuran_pisau_yang_dipakai_operasi]").val(data.ukuran_pisau_yang_dipakai_operasi);
			$("#viewModal input[name=jumlah_jarum_yang_dipakai_operasi]").val(data.jumlah_jarum_yang_dipakai_operasi);
			$("#viewModal input[name=ukuran_jarum_yang_dipakai_operasi]").val(data.ukuran_jarum_yang_dipakai_operasi);
			if(data.instrumen_lengkap == 'on') $("#viewModal input[name=instrumen_lengkap]").prop('checked', true);
			if(data.jaringan_pa == 'on') $("#viewModal input[name=jaringan_pa]").prop('checked', true);
			if(data.formulin == 'on') $("#viewModal input[name=formulin]").prop('checked', true);
			if(data.proses_penyakit == 'on') $("#viewModal input[name=proses_penyakit]").prop('checked', true);
			if(data.posisi_yang_tidak_tepat_selama_pembedahan == 'on') $("#viewModal input[name=posisi_yang_tidak_tepat_selama_pembedahan]").prop('checked', true);
			if(data.benda_asing_tertinggal == 'on') $("#viewModal input[name=benda_asing_tertinggal]").prop('checked', true);
			if(data.bersihkan_daerah_yang_akan_dioperasi_dengan_alkohol == 'on') $("#viewModal input[name=bersihkan_daerah_yang_akan_dioperasi_dengan_alkohol]").prop('checked', true);
			if(data.cek_kadaluarsa_alat_yang_akan_dipakai == 'on') $("#viewModal input[name=cek_kadaluarsa_alat_yang_akan_dipakai]").prop('checked', true);
			if(data.pertahankan_sterilitas_selama_pembedahan == 'on') $("#viewModal input[name=pertahankan_sterilitas_selama_pembedahan]").prop('checked', true);
			if(data.cuci_tangan_secara_steril == 'on') $("#viewModal input[name=cuci_tangan_secara_steril]").prop('checked', true);
			if(data.tutup_luka_operasi_dengan_kassa_steril == 'on') $("#viewModal input[name=tutup_luka_operasi_dengan_kassa_steril]").prop('checked', true);
			if(data.pastikan_posisi_pasien_sesuai_tindakan_operasi == 'on') $("#viewModal input[name=pastikan_posisi_pasien_sesuai_tindakan_operasi]").prop('checked', true);
			if(data.cek_daerah_penekanan_selama_operasi == 'on') $("#viewModal input[name=cek_daerah_penekanan_selama_operasi]").prop('checked', true);
			if(data.pasang_sabuk_atau_tali_pengaman == 'on') $("#viewModal input[name=pasang_sabuk_atau_tali_pengaman]").prop('checked', true);
			if(data.hitung_jumlah_kassa_kassa_besar_deppers_pisau_alat_instrumen_sebelum_dan_setelah_operasi == 'on') $("#viewModal input[name=hitung_jumlah_kassa_kassa_besar_deppers_pisau_alat_instrumen_sebelum_dan_setelah_operasi]").prop('checked', true);
			if(data.jumlah_kassa_kassa_besar_deppers_pisau_alat_instrumen_sebelum_dan_setelah_operasi_lengkap == 'on') $("#viewModal input[name=jumlah_kassa_kassa_besar_deppers_pisau_alat_instrumen_sebelum_dan_setelah_operasi_lengkap]").prop('checked', true);
		}
		$('#viewModal').modal('show');
		$("#viewModal :input").prop("disabled", true);
		$("#viewModal .editBtn").prop("disabled", false);
	})

	$('.editBtn').click(function(e){
		$("#viewModal :input").prop("disabled", false);
	})
</script>
@endsection