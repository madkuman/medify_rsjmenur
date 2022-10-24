@extends('kasus.layouts.main')

@section('title')
{{$kasus->judul_kasus}} - Pengkajian Awal Kebidanan dan Kandungan - Kasus
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
						<button type="button" class="btn btn-rounded btn-alt-primary min-width-125 float-right" data-toggle="modal" data-target="#addModal"><i class="fa fa-pencil"></i> Pengkajian Awal Kebidanan Baru</button>
						@endif
						<h4>Pengkajian Awal Kebidanan dan Kandungan</h4>
						<hr>
						@php $count = 1 @endphp
						@forelse($perinatal as $item)

						@if(session('my_role_'.$kasus->nomor_kasus))
						<button  class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5 pull-right deleteBtn" data-id="{{$item->id}}">
							<i class="fa fa-trash"></i>
						</button>
						<button  class="btn btn-sm btn-circle btn-outline-warning mr-5 mb-5 pull-right editBtn" data-id="{{$item->id}}" data-val="{{$item->val}}">
							<i class="fa fa-pencil"></i>
						</button>
						@endif
						<h5 class="mb-5 pl-5">#Pengkajian Awal Kebidanan dan Kandungan {{$count++}}</h5>
						@php $res = json_decode($item->val) @endphp
						<div class="row" id="perinatal-{{$item->id}}">
							@include('kasus.alatbantu.pengkajian-awal-kebidanan.tabel-hasil')
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
							<h4 class="font-w400 mb-5">Belum ada asesmen Pengkajian Awal Kebidanan dan Kandungan tersedia</h4>
							<p>Klik tombol <b>Pengkajian Awal Kebidanan dan Kandungan Baru</b> untuk melakukan asesmen Pengkajian Awal Kebidanan dan Kandungan</p>
						</div>

						@endforelse
					</div>
				</div>
			</div>
			<!-- END Updates -->
		</div>
	</div>
</main>
<form method="POST" action="{{url('')}}/kasus/{{$kasus->nomor_kasus}}/alat-bantu/perinatal/delete" id="formDelete">
	{{csrf_field()}}
	<input name="id" type="hidden" id="deleteInputId">
</form>

@include('kasus.alatbantu.pengkajian-awal-kebidanan.add')
@endsection

@section('js')
@include('kasus.alatbantu.pengkajian-awal-kebidanan.js')
<script src="{{url('')}}/assets/js/plugins/jquery-masked-inputs/jquery.mask.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('.time').mask('00:00');
	});

	$("input[name=abdomen_tfu]").blur(function(e) {
		var tfu = parseInt($(this).val());
		var tbj = (tfu - 12) * 155;
		$("input[name=abdomen_tbj]").val(tbj);
	})

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
			$("input[name=reaksi_alergi]").val(data.reaksi_alergi);
			$("input[name=gelang_alergi][value=" + data.gelang_alergi + "]").prop('checked', true);
			$("input[name=keluhan]").val(data.keluhan);
			$("input[name=riwayat_sekarang]").val(data.riwayat_sekarang);
			$("input[name=kardiovaskuler][value=" + data.kardiovaskuler + "]").prop('checked', true);
			$("input[name=hipertensi][value=" + data.hipertensi + "]").prop('checked', true);
			$("input[name=diabetes][value=" + data.diabetes + "]").prop('checked', true);
			$("input[name=malaria][value=" + data.malaria + "]").prop('checked', true);
			$("input[name=kelamin][value=" + data.kelamin + "]").prop('checked', true);
			$("input[name=pernah_dirawat][value=" + data.pernah_dirawat + "]").prop('checked', true);
			$("input[name=sempat_dirawat]").val(data.sempat_dirawat);
			$("input[name=tempat_dirawat]").val(data.tempat_dirawat);
			$("input[name=bulan_tahun_dirawat]").val(data.bulan_tahun_dirawat);
			$("input[name=riwayat_keluarga]").val(data.riwayat_keluarga);
			$("input[name=hpht]").val(data.hpht);
			$("input[name=tp]").val(data.tp);
			$("input[name=gerakan_janin]").val(data.gerakan_janin);
			$("input[name=penyulit]").val(data.penyulit);
			$("input[name=obat_dikonsumsi]").val(data.obat_dikonsumsi);
			if (data.riwayat_kb_lalu) {
				var multiple = data.riwayat_kb_lalu.split("|");
				multiple.forEach(function(value) {
					$("#riwayat_kb_lalu option[value='" + value + "']").prop("selected", true).change();
				});
			}
			$("input[name=lama_kb]").val(data.lama_kb);
			$("input[name=keluhan_pemakaian]").val(data.keluhan_pemakaian);
			$("input[name=rencana_kb]").val(data.rencana_kb);
			$("input[name=merokok][value=" + data.merokok + "]").prop('checked', true);
			$("input[name=alkohol][value=" + data.alkohol + "]").prop('checked', true);
			$("input[name=alergi_sehari_hari]").val(data.alergi_sehari_hari);
			$("select[name=nafsu_makan]").val(data.nafsu_makan).change();
			$("input[name=perubahan_bb][value=" + data.perubahan_bb + "]").prop('checked', true);
			$("input[name=perubahan_bb_kg]").val(data.perubahan_bb_kg);
			if (data.pola_nutrisi_keterangan) {
				var multiple = data.pola_nutrisi_keterangan.split("|");
				multiple.forEach(function(value) {
					$("#pola_nutrisi_keterangan option[value='" + value + "']").prop("selected", true).change();
				});
			}
			$("input[name=frekuensi_bab]").val(data.frekuensi_bab);
			$("select[name=kondisi_bab]").val(data.kondisi_bab).change();
			$("input[name=frekuensi_bak]").val(data.frekuensi_bak);
			$("select[name=kondisi_bak]").val(data.kondisi_bak).change();
			$("input[name=durasi_tidur_siang]").val(data.durasi_tidur_siang);
			$("input[name=durasi_tidur_malam]").val(data.durasi_tidur_malam);
			$("input[name=pola_tidur_insomnia][value=" + data.pola_tidur_insomnia + "]").prop('checked', true);
			$("input[name=gambaran_diri_terganggu]").val(data.gambaran_diri_terganggu);
			$("input[name=peran_terganggu]").val(data.peran_terganggu);
			$("input[name=emosi]").val(data.emosi);
			$("input[name=frekuensi_seksual]").val(data.frekuensi_seksual);
			$("input[name=pola_spiritual]").val(data.pola_spiritual);
			$("input[name=pola_hubungan]").val(data.pola_hubungan);
			$("input[name=resiko_cedera][value=" + data.resiko_cedera + "]").prop('checked', true);
			$("select[name=status_fungsional]").val(data.status_fungsional).change();
			$("input[name=ketergantungan]").val(data.ketergantungan);
			$("input[name=asupan_makan_berkurang][value=" + data.asupan_makan_berkurang + "]").prop('checked', true);
			$("input[name=gangguan_metabolisme]").val(data.gangguan_metabolisme);
			$("input[name=bb_lebih_kurang][value=" + data.bb_lebih_kurang + "]").prop('checked', true);
			$("input[name=hb_hct][value=" + data.hb_hct + "]").prop('checked', true);
			$("input[name=tinggi_badan]").val(data.tinggi_badan);
			$("input[name=berat_badan_sebelum]").val(data.berat_badan_sebelum);
			$("input[name=berat_badan_sekarang]").val(data.berat_badan_sekarang);
			$("input[name=gcs]").val(data.gcs);
			$("input[name=imews]").val(data.imews);
			$("input[name=temperatur]").val(data.temperatur);
			$("input[name=nadi]").val(data.nadi);
			$("input[name=rr]").val(data.rr);
			$("input[name=spo2]").val(data.spo2);
			$("input[name=tekanan_darah]").val(data.tekanan_darah);
			$("input[name=provokatif]").val(data.provokatif);
			$("input[name=quality]").val(data.quality);
			$("input[name=region]").val(data.region);
			$("input[name=scala]").val(data.scala);
			$("input[name=time]").val(data.time);
			$("input[name=nyeri_hilang]").val(data.nyeri_hilang);
			$("input[name=kondisi_kepala]").val(data.kondisi_kepala);
			$("input[name=rambut_rontok][value=" + data.rambut_rontok + "]").prop('checked', true);
			$("input[name=mata_icterus][value=" + data.mata_icterus + "]").prop('checked', true);
			$("input[name=mata_cekung][value=" + data.mata_cekung + "]").prop('checked', true);
			$("input[name=mata_anemis][value=" + data.mata_anemis + "]").prop('checked', true);
			$("input[name=mata_oedem][value=" + data.mata_oedem + "]").prop('checked', true);
			$("input[name=kondisi_leher]").val(data.kondisi_leher);
			$("input[name=pembesaran_kelenjar_getah_bening][value=" + data.pembesaran_kelenjar_getah_bening + "]").prop('checked', true);
			$("input[name=pembendungan_vena_julgularis][value=" + data.pembendungan_vena_julgularis + "]").prop('checked', true);
			$("input[name=mammae_simetris][value=" + data.mammae_simetris + "]").prop('checked', true);
			$("input[name=asi_keluar][value=" + data.asi_keluar + "]").prop('checked', true);
			$("input[name=benjolan][value=" + data.benjolan + "]").prop('checked', true);
			$("input[name=hyperpigmentasi_areola][value=" + data.hyperpigmentasi_areola + "]").prop('checked', true);
			$("select[name=puting_susu]").val(data.puting_susu).change();
			$("select[name=suara_nafas]").val(data.suara_nafas).change();
			$("select[name=suara_jantung]").val(data.suara_jantung).change();
			$("input[name=abdomen_acites][value=" + data.abdomen_acites + "]").prop('checked', true);
			$("input[name=abdomen_bising_usus][value=" + data.abdomen_bising_usus + "]").prop('checked', true);
			$("input[name=abdomen_nyeri_ulu][value=" + data.abdomen_nyeri_ulu + "]").prop('checked', true);
			$("input[name=abdomen_linea][value=" + data.abdomen_linea + "]").prop('checked', true);
			$("input[name=abdomen_inea][value=" + data.abdomen_inea + "]").prop('checked', true);
			$("input[name=abdomen_striae_livide][value=" + data.abdomen_striae_livide + "]").prop('checked', true);
			$("input[name=abdomen_striae_albican][value=" + data.abdomen_striae_albican + "]").prop('checked', true);
			$("input[name=abdomen_luka][value=" + data.abdomen_luka + "]").prop('checked', true);
			$("input[name=abdomen_leopold_i]").val(data.abdomen_leopold_i);
			$("input[name=abdomen_bagian_fundus]").val(data.abdomen_bagian_fundus);
			$("input[name=abdomen_leopold_ii]").val(data.abdomen_leopold_ii);
			$("input[name=abdomen_leopold_iii]").val(data.abdomen_leopold_iii);
			$("input[name=abdomen_leopold_iv]").val(data.kondisi_leher);
			if (data.abdomen_tfu) $("input[name=abdomen_tfu]").val(data.abdomen_tfu);
			$("input[name=abdomen_tbj]").val(data.abdomen_tbj);
			$("input[name=abdomen_djj]").val(data.abdomen_djj);
			$("input[name=abdomen_his]").val(data.abdomen_his);
			$("input[name=labia_varises][value=" + data.labia_varises + "]").prop('checked', true);
			$("input[name=labia_warna]").val(data.labia_warna);
			$("input[name=labia_jumlah]").val(data.labia_jumlah);
			$("input[name=labia_konsistensi]").val(data.labia_konsistensi);
			$("input[name=labia_bau]").val(data.labia_bau);
			$("input[name=erineum][value=" + data.erineum + "]").prop('checked', true);
			$("input[name=hemoroid][value=" + data.hemoroid + "]").prop('checked', true);
			$("input[name=vulva_pendarahan][value=" + data.vulva_pendarahan + "]").prop('checked', true);
			$("input[name=vulva_fluor_albus][value=" + data.vulva_fluor_albus + "]").prop('checked', true);
			$("input[name=vulva_gatal][value=" + data.vulva_gatal + "]").prop('checked', true);
			$("input[name=vulva_berwarna][value=" + data.vulva_berwarna + "]").prop('checked', true);
			$("input[name=vulva_berbau][value=" + data.vulva_berbau + "]").prop('checked', true);
			$("input[name=hambatan_belajar]").val(data.hambatan_belajar);
			$("input[name=penerjemah]").val(data.penerjemah);
			$("select[name=kebutuhan_pembelajaran]").val(data.kebutuhan_pembelajaran).change();
			$("input[name=tanggal_pemeriksaan_penunjang]").val(data.tanggal_pemeriksaan_penunjang);
			$("input[name=umur_65][value=" + data.umur_65 + "]").prop('checked', true);
			$("input[name=keterbatasan_mobilitas][value=" + data.keterbatasan_mobilitas + "]").prop('checked', true);
			$("input[name=perawatan_pengobatan_lanjutan][value=" + data.perawatan_pengobatan_lanjutan + "]").prop('checked', true);
			$("input[name=bantuan_beraktivitas][value=" + data.bantuan_beraktivitas + "]").prop('checked', true);
			if (data.perencanaan_pulang) {
				var multiple = data.perencanaan_pulang.split("|");
				multiple.forEach(function(value) {
					$("#perencanaan_pulang option[value='" + value + "']").prop("selected", true).change();
				});
			}
			$("input[name=diagnosa_kebidanan]").val(data.diagnosa_kebidanan);
		}
		$('#addModal').modal('toggle');

	});
</script>
@endsection