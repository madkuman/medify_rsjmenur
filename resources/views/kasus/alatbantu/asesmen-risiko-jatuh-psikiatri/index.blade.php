@extends("kasus.layouts.main")

@section("title")
{{$kasus->judul_kasus}} - Asesmen Risiko Jatuh Psikiatri - Kasus
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

						@if(session('my_role_'.$kasus->nomor_kasus))
						<button type="button" class="btn btn-primary min-width-125 float-right editBtn" data-toggle="modal" data-target="#addModal"><i class="fa fa-pencil"></i> Asesmen Risiko Jatuh Psikiatri Baru</button>
						@endif
						
						<a type="btn" href="{{url()->current()}}/print" class="btn btn-secondary min-width-125 float-right mr-5" target="_blank">
							<i class="fa fa-print"></i> Print
						</a>

						<h4>Asesmen Risiko Jatuh Psikiatri</h4>
						<hr>
						@php $count = count($asesmen_risiko_jatuh_psikiatri) @endphp
						@forelse($asesmen_risiko_jatuh_psikiatri as $item)

						@if($item->created_by == Auth::user()->id)
						<button  class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5 pull-right deleteBtn" data-id="{{$item->id}}">
							<i class="fa fa-trash"></i>
						</button>
						<button  class="btn btn-sm btn-circle btn-outline-warning mr-5 mb-5 pull-right editBtn" data-id="{{$item->id}}" data-index="{{$loop->iteration - 1}}">
							<i class="fa fa-pencil"></i>
						</button>
						@endif
						<button  class="btn btn-sm btn-circle btn-outline-primary mr-5 mb-5 pull-right showBtn" data-id="{{$item->id}}" data-index="{{$loop->iteration - 1}}">
							<i class="fa fa-search-plus"></i>
						</button>
						<h5 class="mb-5 pl-5">#Asesmen Risiko Jatuh Psikiatri {{$count}}</h5>
						
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
							<h4 class="font-w400 mb-5">Belum ada asesmen Asesmen Risiko Jatuh Psikiatri tersedia</h4>
							<p>Klik tombol <b>Asesmen Risiko Jatuh Psikiatri Baru</b> untuk melakukan asesmen Asesmen Risiko Jatuh Psikiatri</p>
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
@include("kasus.alatbantu.asesmen-risiko-jatuh-psikiatri.modal")
@include("kasus.alatbantu.asesmen-risiko-jatuh-psikiatri.modal-hasil")
@endsection

@section("js")
<script src="{{url("")}}/assets/js/plugins/jquery-masked-inputs/jquery.mask.min.js"></script>
<script type="text/javascript">
	var data = JSON.parse({!!json_encode(str_replace("`", "'", $asesmen_risiko_jatuh_psikiatri))!!});

	$(document).ready(function(){
		$(".time").mask("00:00");
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
		if (item != "" && item != undefined) {
			$("#id").val(item.id);
			@include("kasus.alatbantu.asesmen-risiko-jatuh-psikiatri.js-form-edit")
		} else {
			$("#id").val(0);
			@include("kasus.alatbantu.asesmen-risiko-jatuh-psikiatri.js-form-create")
		}

		$("#addModal").modal("toggle");
		countSkor();
		$('input[type=radio]:checked').trigger("change");
		$('.opsi-checkbox').trigger("change");
	});

	$(".showBtn").click(function(e){
		id = $(this).data("id");

		var item = data[$(this).data("index")];
		var usia_skor = item.usia_skor ?? "0" 
		var status_mental_skor = item.status_mental_skor ?? "0" 
		var eliminasi_skor = item.eliminasi_skor ?? "0" 
		var ambulasi_skor = item.ambulasi_skor ?? "0" 
		var nutrisi_skor = item.nutrisi_skor ?? "0" 
		var gangguan_pola_tidur_skor = item.gangguan_pola_tidur_skor ?? "0" 
		var riwayat_jatuh_skor = item.riwayat_jatuh_skor ?? "0" 		
		var usia = item.usia ? item.usia : "-";
		var status_mental = item.status_mental ? item.status_mental : "-";
		var eliminasi = item.eliminasi ? item.eliminasi : "-";
		var pengobatan_tanpa = item.pengobatan_tanpa ? "" : "d-none";
		var pengobatan_jantung = item.pengobatan_jantung ? "" : "d-none";
		var pengobatan_psikotoprik = item.pengobatan_psikotoprik ? "" : "d-none";
		var pengobatan_tambahan = item.pengobatan_tambahan ? "" : "d-none";
		var diagnosa_bipolar = item.diagnosa_bipolar ? "" : "d-none";
		var diagnosa_obat = item.diagnosa_obat ? "" : "d-none";
		var diagnosa_gangguan = item.diagnosa_gangguan ? "" : "d-none";
		var diagnosa_demensia = item.diagnosa_demensia ? "" : "d-none";
		var ambulasi = item.ambulasi ? item.ambulasi : "-";
		var nutrisi = item.nutrisi ? item.nutrisi : "-";
		var gangguan_pola_tidur = item.gangguan_pola_tidur ? item.gangguan_pola_tidur : "-";
		var riwayat_jatuh = item.riwayat_jatuh ? item.riwayat_jatuh : "-";
		var tanggal_risiko_jatuh = item.tanggal_risiko_jatuh ? formatDate(item.tanggal_risiko_jatuh) : "-";
		var jam_risiko_jatuh = item.jam_risiko_jatuh ? item.jam_risiko_jatuh : "-";
		var pasien_skor_lebih_dari_90_pasang_stiker_warna_kuning = item.pasien_skor_lebih_dari_90_pasang_stiker_warna_kuning ? "✔️" : "-";
		var pasien_skor_lebih_dari_90_tempelkan_stiker_warna_kuning = item.pasien_skor_lebih_dari_90_tempelkan_stiker_warna_kuning ? "✔️" : "-";
		var pasien_skor_lebih_dari_90_pakaikan_baju_dengan_penanda = item.pasien_skor_lebih_dari_90_pakaikan_baju_dengan_penanda ? "✔️" : "-";
		var pasien_skor_lebih_dari_90_pakaikan_sprei_dengan_penanda = item.pasien_skor_lebih_dari_90_pakaikan_sprei_dengan_penanda ? "✔️" : "-";
		var pasien_skor_lebih_dari_90_motivasi_keluarga = item.pasien_skor_lebih_dari_90_motivasi_keluarga ? "✔️" : "-";
		var pasien_skor_lebih_dari_90_tempatkan_pasien_dekat_nurse_station = item.pasien_skor_lebih_dari_90_tempatkan_pasien_dekat_nurse_station ? "✔️" : "-";
		var pasien_skor_lebih_dari_90_lakukan_pemasangan_fiksasi_fisil = item.pasien_skor_lebih_dari_90_lakukan_pemasangan_fiksasi_fisil ? "✔️" : "-";
		var pasien_skor_lebih_dari_90_orientasikan_pasien = item.pasien_skor_lebih_dari_90_orientasikan_pasien ? "✔️" : "-";
		var tanggal_pasien = item.tanggal_pasien ? formatDate(item.tanggal_pasien) : "-";
		var jam_pasien = item.jam_pasien ? item.jam_pasien : "-";
		var total_skor = parseInt(item.usia_skor)
				+ parseInt(item.status_mental_skor)
				+ parseInt(item.eliminasi_skor)
				+ parseInt(item.pengobatan_tanpa_skor)
				+ parseInt(item.pengobatan_jantung_skor)
				+ parseInt(item.pengobatan_psikotoprik_skor)
				+ parseInt(item.pengobatan_tambahan_skor)
				+ parseInt(item.diagnosa_bipolar_skor)
				+ parseInt(item.diagnosa_obat_skor)
				+ parseInt(item.diagnosa_gangguan_skor)
				+ parseInt(item.diagnosa_demensia_skor)
				+ parseInt(item.nutrisi_skor)
				+ parseInt(item.ambulasi_skor)
				+ parseInt(item.gangguan_pola_tidur_skor)
				+ parseInt(item.riwayat_jatuh_skor)
				;

		var hasil = `@include("kasus.alatbantu.asesmen-risiko-jatuh-psikiatri.hasil")`;
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

	function countSkor() {
		$('.opsi-radio').change(function() {
			var skor = $(this).data("skor");
			$(`input[name="${$(this).attr('name')}_skor"]`).val(skor);
			countTotalSkor();
		});

		$('.opsi-checkbox').change(function() {
			var skor = $(this).data("skor");
			if(this.checked) {
				$(`input[name="${$(this).attr('name')}_skor"]`).val(skor);
			}
			else{
				$(`input[name="${$(this).attr('name')}_skor"]`).val(0);
			}
			countTotalSkor();
		});
	}

	function countTotalSkor() {
		var total_skor = 0;
		$('.block-skor-radio input[type=hidden]').each(function() {
			var skor_data = $(this).val();
			var name = $(this).attr('name');
			total_skor += parseInt(skor_data);
		});

		$('.block-skor-checkbox input[type=hidden]').each(function() {
			var skor_data = $(this).val();
			var name = $(this).attr('name');
			total_skor += parseInt(skor_data);
		});
		$('#total_skor').html('Total Skor : ' + total_skor);
	}
</script>
@endsection