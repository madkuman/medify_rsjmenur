@extends("kasus.layouts.main")

@section("title")
{{$kasus->judul_kasus}} - Asesmen Napza Rawat Jalan Non IPWL - Kasus
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
						<button type="button" class="btn btn-rounded btn-alt-primary min-width-125 float-right editBtn" data-toggle="modal" data-target="#addModal"><i class="fa fa-pencil"></i> Asesmen Napza Rawat Jalan Non IPWL Baru</button>
						@endif
						
						<h4>Asesmen Napza Rawat Jalan Non IPWL</h4>
						<hr>
						@php $count = count($asesmen_napza_rawat_jalan_non_ipwl) @endphp
						@forelse($asesmen_napza_rawat_jalan_non_ipwl as $item)

						@if(session("my_role_".$kasus->nomor_kasus))
						@if($item->created_by == Auth::user()->id)
						<button  class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5 pull-right deleteBtn" data-id="{{$item->id}}">
							<i class="fa fa-trash"></i>
						</button>
						<button  class="btn btn-sm btn-circle btn-outline-warning mr-5 mb-5 pull-right editBtn" data-id="{{$item->id}}" data-index="{{$loop->iteration - 1}}">
							<i class="fa fa-pencil"></i>
						</button>
						@endif
						@endif

						<a type="btn" href="{{url()->current()}}/print/{{$item->id}}" class="btn btn-sm btn-circle btn-outline-secondary mr-5 mb-5 pull-right" target="_blank">
							<i class="fa fa-print"></i>
						</a>
						<button  class="btn btn-sm btn-circle btn-outline-primary mr-5 mb-5 pull-right showBtn" data-id="{{$item->id}}" data-index="{{$loop->iteration - 1}}">
							<i class="fa fa-search"></i>
						</button>

						<h5 class="mb-5 pl-5">#Asesmen Napza Rawat Jalan Non IPWL {{$count}}</h5>
						
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
							<h4 class="font-w400 mb-5">Belum ada asesmen Asesmen Napza Rawat Jalan Non IPWL tersedia</h4>
							<p>Klik tombol <b>Asesmen Napza Rawat Jalan Non IPWL Baru</b> untuk melakukan asesmen Asesmen Napza Rawat Jalan Non IPWL</p>
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
@include("kasus.alatbantu.asesmen-napza-rawat-jalan-non-ipwl.modal")
@include("kasus.alatbantu.asesmen-napza-rawat-jalan-non-ipwl.modal-hasil")
@endsection

@section("js")
<script src="{{url("")}}/assets/js/plugins/jquery-masked-inputs/jquery.mask.min.js"></script>
<script type="text/javascript">
	var data = JSON.parse({!!json_encode(str_replace("`", "'", $asesmen_napza_rawat_jalan_non_ipwl))!!});
	var jenis_napza = ['Alkohol', 'Heroin', 'Metadon/Buprenorfin', 'Opiat lain/Analgesik', 'Barbiturat', 'Sedatif/Hipnotik', 'Amfetamin', 'Kanabis', 'Halusinogen', 'Inhalan'];

	$(document).ready(function(){
		$(".time").mask("00:00");
		datepicker();
	});

	$('.datepicker').datepicker({
		autoclose: true,
		todayHighlight: true,
		format: 'dd/mm/yyyy',
	});

	function nl2br (str, is_xhtml) {   
	    var breakTag = (is_xhtml || typeof is_xhtml === "undefined") ? "<br />" : "<br>";    
	    return (str + "").replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, "$1"+ breakTag +"$2");
	}

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
		removeAlljenis();

		if (item != "" && item != undefined) {
			$("#id").val(item.id);
			@include("kasus.alatbantu.asesmen-napza-rawat-jalan-non-ipwl.js-form-edit")
			datepicker();
		} else {
			$("#id").val(0);
			@include("kasus.alatbantu.asesmen-napza-rawat-jalan-non-ipwl.js-form-create")
			datepicker();
		}
		$("#addModal").modal("toggle");
	});

	$(".showBtn").click(function(e){
		id = $(this).data("id");

		var item = data[$(this).data("index")];
		var alergi = item.alergi ? item.alergi : "-";
		var risiko = item.risiko ? item.risiko : "-";
		var tanggal_pengkajian = item.tanggal_pengkajian ? formatDate(item.tanggal_pengkajian) : "-";
		var jam_pengkajian = item.jam_pengkajian ? item.jam_pengkajian : "-";
		var riwayat_pemakaian_napza = item.riwayat_pemakaian_napza ? item.riwayat_pemakaian_napza : "-";
		
		var jenis_napza_yang_dipakai = item.jenis_napza_yang_dipakai ? JSON.parse(item.jenis_napza_yang_dipakai) : "-";
		
		var etiologi_penggunaan_zat_diajak_teman = item.etiologi_penggunaan_zat_diajak_teman ? "✔️" : "-";
		var etiologi_penggunaan_zat_dipaksa_teman = item.etiologi_penggunaan_zat_dipaksa_teman ? "✔️" : "-";
		var etiologi_penggunaan_zat_coba_coba_keinginan_sendiri = item.etiologi_penggunaan_zat_coba_coba_keinginan_sendiri ? "✔️" : "-";
		var etiologi_penggunaan_zat_pelarian_dari_masalah = item.etiologi_penggunaan_zat_pelarian_dari_masalah ? "✔️" : "-";
		var komplikasi_medik_jiwa = item.komplikasi_medik_jiwa ? item.komplikasi_medik_jiwa : "-";
		var perilaku_kriminal_di_dalam_rumah_sendiri = item.perilaku_kriminal_di_dalam_rumah_sendiri ? item.perilaku_kriminal_di_dalam_rumah_sendiri : "-";
		var perilaku_kriminal_di_luar_rumah = item.perilaku_kriminal_di_luar_rumah ? item.perilaku_kriminal_di_luar_rumah : "-";
		var problem_masyarakat = item.problem_masyarakat ? item.problem_masyarakat : "-";
		var riwayat_perawatan_di_rumah_sakit_terkait_napza = item.riwayat_perawatan_di_rumah_sakit_terkait_napza ? formatDate(item.riwayat_perawatan_di_rumah_sakit_terkait_napza) : "-";
		var riwayat_rehabilitasi_napza_sebelumnya = item.riwayat_rehabilitasi_napza_sebelumnya ? formatDate(item.riwayat_rehabilitasi_napza_sebelumnya) : "-";
		var tempat_rehabilitasi = item.tempat_rehabilitasi ? item.tempat_rehabilitasi : "-";
		var riwayat_relaps_dengan_tanpa_rehabilitasi_napza = item.riwayat_relaps_dengan_tanpa_rehabilitasi_napza ? formatDate(item.riwayat_relaps_dengan_tanpa_rehabilitasi_napza) : "-";
		var faktor_penyebab_relaps_diajak_teman = item.faktor_penyebab_relaps_diajak_teman ? "✔️" : "-";
		var faktor_penyebab_relaps_dipaksa_teman = item.faktor_penyebab_relaps_dipaksa_teman ? "✔️" : "-";
		var faktor_penyebab_relaps_tidak_memiliki_aktivitas_berarti = item.faktor_penyebab_relaps_tidak_memiliki_aktivitas_berarti ? "✔️" : "-";
		var faktor_penyebab_relaps_dendam_setelah_masa_pemulihan = item.faktor_penyebab_relaps_dendam_setelah_masa_pemulihan ? "✔️" : "-";
		var faktor_penyebab_relaps_konflik_dengan_orang_tua = item.faktor_penyebab_relaps_konflik_dengan_orang_tua ? "✔️" : "-";
		var faktor_penyebab_relaps_bergabung_dengan_pengguna_zat = item.faktor_penyebab_relaps_bergabung_dengan_pengguna_zat ? "✔️" : "-";
		var faktor_penyebab_relaps_tidak_mampu_menahan_suggest = item.faktor_penyebab_relaps_tidak_mampu_menahan_suggest ? "✔️" : "-";
		var faktor_penyebab_relaps_keinginan_untuk_menggunakan = item.faktor_penyebab_relaps_keinginan_untuk_menggunakan ? "✔️" : "-";
		var riwayat_seks_bebas = item.riwayat_seks_bebas ? formatDate(item.riwayat_seks_bebas) : "-";
		var anggota_keluarga_yang_menggunakan_napza = item.anggota_keluarga_yang_menggunakan_napza ? item.anggota_keluarga_yang_menggunakan_napza : "-";
		var tanggal_selesai_pengkajian = item.tanggal_selesai_pengkajian ? formatDate(item.tanggal_selesai_pengkajian) : "-";
		var jam_selesai_pengkajian = item.jam_selesai_pengkajian ? item.jam_selesai_pengkajian : "-";
		
		var hasil = `@include("kasus.alatbantu.asesmen-napza-rawat-jalan-non-ipwl.hasil")`;
		$("#showModalHasil #myModalBody").html(hasil);
		$("#showModalHasil").modal("toggle");
	});

	function formatDate (input) {
		if (input === null) {
			return null;
		} else {
			var datePart = input.match(/\d+/g),
			year = datePart[0],
			month = datePart[1], day = datePart[2];

			return day+"/"+month+"/"+year;
		}
	}

	function addJenis() {
		var row = 
		`<tr>
    		<td><input type="text" class="form-control" name="jenis_napza_yang_dipakai[]"></td>
    		<td><input type="text" class="form-control js-datepicker" name="tanggal_sejak[]" autocomplete="off"></td>
    		<td><input type="text" class="form-control js-datepicker" name="tanggal_sampai_dengan[]" autocomplete="off"></td>
    		<td><input type="text" class="form-control" name="cara_pakai[]"></td>
    		<td><button type="button" class="btn btn-rounded btn-alt-danger min-width-125 remove"><i class="fa fa-times"></i> Hapus</button></td>
    	</tr>`;

    	$('#tabel_jenis tbody').append(row);
	}

	$('#addJenis').click(function() {
		addJenis();
		datepicker();
	});

	$('#tabel_jenis tbody').on('click', '.remove', function(){
		if($('#tabel_jenis tbody tr').length > 1){
			$(this).closest('tr').remove();
		}
	});

	function datepicker() {
    	$('.js-datepicker').datepicker({
			autoclose: true,
			todayHighlight: true,
			format: 'dd/mm/yyyy',
		});
    }

    function removeAlljenis() {
    	var row = $('#tabel_jenis tbody tr');
		
		if(row.length > 1){
			for (var i = 1; i < row.length; i++) {
				row[i].remove();
			}
		}
    }
</script>
@endsection