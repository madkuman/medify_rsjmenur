@extends("kasus.layouts.main")

@section("title")
{{ $kasus->judul_kasus }} - Laporan Hasil Pemeriksaan Psikologi Rekruitmen
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
						<button type="button" class="btn btn-rounded btn-alt-primary min-width-125 float-right editBtn">
							<i class="fa fa-pencil"></i> Buat Baru
						</button>
						@endif
						
						<h4>Laporan Hasil Pemeriksaan Psikologi Rekruitmen</h4>
						<hr>
						@php $count = count($laporan_psikologi_rekruitmen) @endphp
						@forelse($laporan_psikologi_rekruitmen as $item)

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
						
						<h5 class="mb-5 pl-5">#Laporan Hasil Pemeriksaan Psikologi Rekruitmen {{$count}}</h5>
						
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
							<h4 class="font-w400 mb-5">Belum ada asesmen Laporan Hasil Pemeriksaan Psikologi Rekruitmen tersedia</h4>
							<p>Klik tombol <b>Laporan Hasil Pemeriksaan Psikologi Rekruitmen Baru</b> untuk melakukan asesmen Laporan Hasil Pemeriksaan Psikologi Rekruitmen</p>
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
@include("kasus.psikologi.laporan-hasil-pemeriksaan-psikologi-rekruitmen.modal")
@include("kasus.psikologi.laporan-hasil-pemeriksaan-psikologi-rekruitmen.modal-hasil")
@endsection

@section("js")
<script src="{{url("")}}/assets/js/plugins/jquery-masked-inputs/jquery.mask.min.js"></script>
<script type="text/javascript">
	var data = JSON.parse({!!json_encode(str_replace("`", "'", $laporan_psikologi_rekruitmen))!!});

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
		resetForm();

		if (item != "" && item != undefined) {
			$("#id").val(item.id);
			@include("kasus.psikologi.laporan-hasil-pemeriksaan-psikologi-rekruitmen.js-form-edit")
		} else {
			$("#id").val(0);
			resetForm();

			var date = new Date();
			var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());

			$('.js-datepicker').datepicker('setDate', today);
		}
		$("#addModal").modal("toggle");
	});

	$(".showBtn").click(function(e){
		id = $(this).data("id");

		var item = data[$(this).data("index")];
		var tanggal_pemeriksaan = item.tanggal_pemeriksaan ? formatDate(item.tanggal_pemeriksaan) : "-";
		var posisi_yang_dituju = item.posisi_yang_dituju ? item.posisi_yang_dituju : "-";
		var intelegensi = item.intelegensi ? item.intelegensi : "-";
		var daya_tangkap = item.daya_tangkap ? item.daya_tangkap : "-";
		var daya_analisa = item.daya_analisa ? item.daya_analisa : "-";
		var daya_konsentrasi = item.daya_konsentrasi ? item.daya_konsentrasi : "-";
		var bekerja_dengan_angka = item.bekerja_dengan_angka ? item.bekerja_dengan_angka : "-";
		var sistimatika_kerja = item.sistimatika_kerja ? item.sistimatika_kerja : "-";
		var ketelitian_kerja = item.ketelitian_kerja ? item.ketelitian_kerja : "-";
		var kecepatan_kerja = item.kecepatan_kerja ? item.kecepatan_kerja : "-";
		var ketekunan = item.ketekunan ? item.ketekunan : "-";
		var daya_tahan_kerja = item.daya_tahan_kerja ? item.daya_tahan_kerja : "-";
		var inisiatif = item.inisiatif ? item.inisiatif : "-";
		var motivasi_berprestasi = item.motivasi_berprestasi ? item.motivasi_berprestasi : "-";
		var percaya_diri = item.percaya_diri ? item.percaya_diri : "-";
		var menyesuaikan_diri = item.menyesuaikan_diri ? item.menyesuaikan_diri : "-";
		var stabilitas_emosi = item.stabilitas_emosi ? item.stabilitas_emosi : "-";
		var kerja_sama = item.kerja_sama ? item.kerja_sama : "-";
		var kesimpulan = item.kesimpulan ? item.kesimpulan : "-";

		var uraian_psikologis = item.uraian_psikologis ? nl2br(item.uraian_psikologis) : "-";
		var kelebihan = item.kelebihan ? nl2br(item.kelebihan) : "-";
		var kelemahan = item.kelemahan ? nl2br(item.kelemahan) : "-";
		var saran = item.saran ? nl2br(item.saran) : "-";
		
		var hasil = `@include("kasus.psikologi.laporan-hasil-pemeriksaan-psikologi-rekruitmen.hasil")`;
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

	function resetForm() {
		@include("kasus.psikologi.laporan-hasil-pemeriksaan-psikologi-rekruitmen.js-form-create")
	}
</script>
@endsection