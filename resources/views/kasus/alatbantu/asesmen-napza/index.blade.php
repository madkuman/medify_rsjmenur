@extends("kasus.layouts.main")

@section("title")
{{$kasus->judul_kasus}} - Asesmen Napza - Kasus
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
						<button type="button" class="btn btn-rounded btn-alt-primary min-width-125 float-right editBtn" data-toggle="modal" data-target="#addModal"><i class="fa fa-pencil"></i> Asesmen Napza Baru</button>
						@endif
						
						<h4>Asesmen Napza</h4>
						<hr>
						@php $count = count($asesmen_napza) @endphp
						@forelse($asesmen_napza as $item)

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
						
						<h5 class="mb-5 pl-5">#Asesmen Napza {{$count}}</h5>
						
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
							<h4 class="font-w400 mb-5">Belum ada asesmen Asesmen Napza tersedia</h4>
							<p>Klik tombol <b>Asesmen Napza Baru</b> untuk melakukan asesmen Asesmen Napza</p>
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
@include("kasus.alatbantu.asesmen-napza.modal")
@include("kasus.alatbantu.asesmen-napza.modal-hasil")
@endsection

@section("js")
<script src="{{url("")}}/assets/js/plugins/jquery-masked-inputs/jquery.mask.min.js"></script>
<script type="text/javascript">
	var data = JSON.parse({!!json_encode(str_replace("`", "'", $asesmen_napza))!!});

	$(document).ready(function(){
		$(".time").mask("00:00");
		datepicker();
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
			@include("kasus.alatbantu.asesmen-napza.js-form-edit");
			datepicker();
		} else {
			$("#id").val(0);
			@include("kasus.alatbantu.asesmen-napza.js-form-create");
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
		
		var jenis_zat_yang_dipakai = item.jenis_zat_yang_dipakai ? JSON.parse(item.jenis_zat_yang_dipakai) : "-";
		
		var alasan_penggunaan_zat_diajak_teman = item.alasan_penggunaan_zat_diajak_teman ? "✔️" : "-";
		var alasan_penggunaan_zat_dipaksa_teman = item.alasan_penggunaan_zat_dipaksa_teman ? "✔️" : "-";
		var alasan_penggunaan_zat_coba_coba_keinginan_sendiri = item.alasan_penggunaan_zat_coba_coba_keinginan_sendiri ? "✔️" : "-";
		var alasan_penggunaan_zat_pelarian_dari_masalah = item.alasan_penggunaan_zat_pelarian_dari_masalah ? "✔️" : "-";
		var komplikasi_medik_jiwa = item.komplikasi_medik_jiwa ? item.komplikasi_medik_jiwa : "-";
		var kriminal_dirumah_tidak_ada_masalah = item.kriminal_dirumah_tidak_ada_masalah ? "✔️" : "-";
		var kriminal_dirumah_mencuri = item.kriminal_dirumah_mencuri ? "✔️" : "-";
		var kriminal_dirumah_mengancam = item.kriminal_dirumah_mengancam ? "✔️" : "-";
		var kriminal_dirumah_menggadai = item.kriminal_dirumah_menggadai ? "✔️" : "-";
		var kriminal_dirumah_mengambil_barang_dengan_paksaan = item.kriminal_dirumah_mengambil_barang_dengan_paksaan ? "✔️" : "-";
		var kriminal_dirumah_menjual_barang_sendiri = item.kriminal_dirumah_menjual_barang_sendiri ? "✔️" : "-";
		var kriminal_dirumah_mengambil_barang = item.kriminal_dirumah_mengambil_barang ? "✔️" : "-";
		var kriminal_dirumah_merusak = item.kriminal_dirumah_merusak ? "✔️" : "-";
		var kriminal_diluar_rumah_tidak_ada_masalah = item.kriminal_diluar_rumah_tidak_ada_masalah ? "✔️" : "-";
		var kriminal_diluar_rumah_mencuri = item.kriminal_diluar_rumah_mencuri ? "✔️" : "-";
		var kriminal_diluar_rumah_merampas_barang = item.kriminal_diluar_rumah_merampas_barang ? "✔️" : "-";
		var kriminal_diluar_rumah_membunuh = item.kriminal_diluar_rumah_membunuh ? "✔️" : "-";
		var kriminal_diluar_rumah_merampok = item.kriminal_diluar_rumah_merampok ? "✔️" : "-";
		var kriminal_diluar_rumah_mengancam = item.kriminal_diluar_rumah_mengancam ? "✔️" : "-";
		var kriminal_diluar_rumah_merusak = item.kriminal_diluar_rumah_merusak ? "✔️" : "-";
		var catatan_polisi_tidak_ada = item.catatan_polisi_tidak_ada ? "✔️" : "-";
		var catatan_polisi_ditahan_diproses_pengadilan = item.catatan_polisi_ditahan_diproses_pengadilan ? "✔️" : "-";
		var catatan_polisi_ditahan_kemudian_langsung_dipulangkan = item.catatan_polisi_ditahan_kemudian_langsung_dipulangkan ? "✔️" : "-";
		var lain_lain_catatan_polisi = item.lain_lain_catatan_polisi ? item.lain_lain_catatan_polisi : "-";
		var problem_sekolah_tidak_ada_masalah = item.problem_sekolah_tidak_ada_masalah ? "✔️" : "-";
		var problem_sekolah_tidak_naik_kelas = item.problem_sekolah_tidak_naik_kelas ? "✔️" : "-";
		var problem_sekolah_berhenti_sekolah = item.problem_sekolah_berhenti_sekolah ? "✔️" : "-";
		var problem_sekolah_susah_konsentrasi_belajar = item.problem_sekolah_susah_konsentrasi_belajar ? "✔️" : "-";
		var problem_sekolah_dikeluarkan_dari_sekolah = item.problem_sekolah_dikeluarkan_dari_sekolah ? "✔️" : "-";
		var problem_sekolah_tidak_disiplin = item.problem_sekolah_tidak_disiplin ? "✔️" : "-";
		
		var hasil = `@include("kasus.alatbantu.asesmen-napza.hasil")`;
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
    		<td><input type="text" class="form-control" name="jenis_zat_yang_dipakai[]"></td>
    		<td><input type="text" class="form-control js-datepicker" name="tanggal_sejak[]"></td>
    		<td><input type="text" class="form-control js-datepicker" name="tanggal_sampai_dengan[]"></td>
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