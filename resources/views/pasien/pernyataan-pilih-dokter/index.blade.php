@extends('pasien.layouts.main')

@section("title")
{{$identitas->name}} - Surat Pernyataan Memilih Dokter
@endsection

@section('subtitle')
<a href="{{url("")}}/pasien/{{$identitas->id}}">{{$identitas->name}}</a>
@endsection

@section("content")

<main id="main-container">
	 @include('pasien.layouts.navbar')

	<div class="container">
		<div class="block block-bordered">
			<div class="block-content">
				<div>
					<button type="button" class="btn btn-rounded btn-alt-primary min-width-125 float-right editBtn" data-toggle="modal" data-target="#addModal"><i class="fa fa-pencil mr-2"></i> Surat Pernyataan Baru</button>
					
					<h4>Surat Pernyataan Memilih Dokter</h4>
					<hr>
					@php $count = 1 @endphp
					@forelse($surat as $item)

					@if($item->created_by == Auth::user()->id)
					<button  class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5 pull-right deleteBtn" data-id="{{$item->id}}" data-toggle="tooltip" data-placement="top" data-original-title="Hapus">
						<i class="fa fa-trash"></i>
					</button>
					<button  class="btn btn-sm btn-circle btn-outline-warning mr-5 mb-5 pull-right editBtn" data-id="{{$item->id}}" data-index="{{$loop->iteration - 1}}" data-toggle="tooltip" data-placement="top" data-original-title="Ubah">
						<i class="fa fa-pencil"></i>
					</button>
					@endif

					<button  class="btn btn-sm btn-circle btn-outline-primary mr-5 mb-5 pull-right showBtn" data-id="{{$item->id}}" data-index="{{$loop->iteration - 1}}" data-toggle="tooltip" data-placement="top" data-original-title="Lihat">
						<i class="fa fa-search-plus"></i>
					</button>
					<a href="#" class="btn btn-sm btn-circle btn-outline-primary mr-5 mb-5 pull-right printBtn" data-id="{{$item->id}}" data-toggle="tooltip" data-placement="top" data-original-title="Cetak">
						<i class="fa fa-print"></i>
					</a>

					<h5 class="mb-5 pl-5">#Surat Pernyataan Memilih Dokter {{$count++}}</h5>
					
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
					@empty

					<div class="text-center py-50">
						<h4 class="font-w400 mb-5">Belum ada Surat Pernyataan Memilih Dokter tersedia</h4>
						<p>Klik tombol <b>Surat Pernyataan Baru</b> untuk membuat Surat Pernyataan Pasien</p>
					</div>

					@endforelse
				</div>
			</div>
		</div>
	</div>
</main>

<form method="POST" action="{{url()->current()}}/delete" id="formDelete">
	{{csrf_field()}}
	<input name="id" type="hidden" id="deleteInputId">
	
</form>
@include("pasien.pernyataan-pilih-dokter.modal")
@include("pasien.pernyataan-pilih-dokter.modal-hasil")
@endsection

@section("js")
<script src="{{url("")}}/assets/js/plugins/jquery-masked-inputs/jquery.mask.min.js"></script>
<script type="text/javascript">
	var data = JSON.parse({!!json_encode(str_replace("`", "'", $surat))!!});

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

	 	if(item != "" && item != undefined) {
	 		$("#id").val(id);
			@include("pasien.pernyataan-pilih-dokter.js-form-edit")
	 	} else {
	 		$("#id").val(0);
	 		resetForm();
	 	}
	 	$("#addModal").modal("toggle");
	});

	$(".showBtn").click(function(e){
		id = $(this).data("id");

		var item = data[$(this).data("index")];

		var no_rm = $(`:text[name="no_rm"]`).val();
		var nama_pasien = $(`:text[name="nama_pasien"]`).val();
		var umur_pasien = $(`:text[name="umur_pasien"]`).val();
		var jenis_kelamin_pasien = $(`:text[name="jenis_kelamin_pasien"]`).val();
		var tgl_lahir_pasien = $(`:text[name="tgl_lahir_pasien"]`).val();
		
		no_rm = no_rm ? no_rm : "-";
		nama_pasien = nama_pasien ? nama_pasien : "-";
		umur_pasien = umur_pasien ? umur_pasien : "-";
		jenis_kelamin_pasien = jenis_kelamin_pasien ? jenis_kelamin_pasien : "-";
		tgl_lahir_pasien = tgl_lahir_pasien ? tgl_lahir_pasien : "-";
		
		var nama_wali = item.nama_wali ? item.nama_wali : "-";
		var alamat = item.alamat ? item.alamat : "-";
		var no_telepon = item.no_telp ? item.no_telp : "-";
		var hubungan = item.hubungan ? item.hubungan : "-";
		var memilih_dokter = item.dokter ? item.dokter.name : "-";
		var ruangan_pasien = item.ruangan ? item.ruangan : "-";

		var hasil = `@include("pasien.pernyataan-pilih-dokter.hasil")`;
		$("#showModalHasil #myModalBody").html(hasil);
		$("#showModalHasil").modal("toggle");
	});

	$(".printBtn").click(function(e){
		e.preventDefault()
		var id = $(this).data("id");
		var url = `{{url()->current()}}/print/`+ id;
		window.open(url, '_blank');
	});

	function resetForm() {
		@include("pasien.pernyataan-pilih-dokter.js-form-create")
	}
</script>
@endsection