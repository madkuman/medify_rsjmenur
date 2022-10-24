@extends('kasus.layouts.main')

@section('title')
{{$kasus->judul_kasus}} - Riwayat Kehamilan - Kasus
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
						<h4>Riwayat Kehamilan</h4>
						<hr>
						<div class="autoscroll-x">
							<table class="table table-bordered table-vcenter">
								<thead>
									@if(count($riwayat_kehamilan) > 0)
									<tr>
										<th rowspan="2" class="text-center">Nama Suami</th>
										<th rowspan="2" class="text-center">Lama Kawin</th>
										<th rowspan="2" class="text-center">Umur Kehamilan</th>
										<th rowspan="2" class="text-center">Tahun Persalinan</th>
										<th rowspan="2" class="text-center">Tempat Persalinan</th>
										<th rowspan="2" class="text-center">Jenis Persalinan</th>
										<th rowspan="2" class="text-center">Penolong</th>
										<th rowspan="2" class="text-center">Penyulit Kehamilan</th>
										<th colspan="4" class="text-center">Anak</th>
										<th rowspan="2" class="text-center">Aksi</th>
									</tr>
									<tr>
										<th class="text-center">Jenis</th>
										<th class="text-center">BB</th>
										<th class="text-center">PB</th>
										<th class="text-center">Keadaan</th>
									</tr>
									@endif
								</thead>
								<tbody>
									@forelse($riwayat_kehamilan as $item)
									@php $res = json_decode($item->val) @endphp
									@include('kasus.alatbantu.riwayat-kehamilan.tabel-hasil')
									@empty
									@endforelse
								</tbody>
							</table>
							@if(count($riwayat_kehamilan) < 1)
							<div class="text-center pt-50">
								<h4 class="font-w400 mb-5">Belum ada asesmen Riwayat Kehamilan tersedia</h4>
								<p>Klik tombol dibawah ini untuk melakukan asesmen Riwayat Kehamilan</p>
							</div>
							@endif
						</div>
						<div class="text-center py-20">
							<button type="button" class="btn btn-rounded btn-primary" data-toggle="modal" data-target="#addModal"><i class="fa fa-plus"></i></button>
						</div>
					</div>
				</div>
			</div>
			<!-- END Updates -->
		</div>
	</div>
</main>
<form method="POST" action="{{url('')}}/kasus/{{$kasus->nomor_kasus}}/alat-bantu/riwayat-kehamilan/delete" id="formDelete">
	{{csrf_field()}}
	<input name="id" type="hidden" id="deleteInputId">
	
</form>
@include('kasus.alatbantu.riwayat-kehamilan.add')
@endsection

@section('js')
@include('kasus.alatbantu.riwayat-kehamilan.js')
<script src="{{url('')}}/assets/js/plugins/jquery-masked-inputs/jquery.mask.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('.time').mask('00:00');
	});

	$(document).on('click', '.delete-item', function(){
		var wrapper = $(this).parents('.item-baru');
		wrapper.remove();
	});

	var counter = 1;
	$('#new_item').on('click', function(){
		counter++;
		str = 
		`<tr class="item-baru">
		<td><input type="text" class="form-control" id="suami_`+counter+`" name="suami[]"></td>
		<td><input type="text" class="form-control" id="lama_`+counter+`" name="lama[]"></td>
		<td><input type="text" class="form-control" id="umur_`+counter+`" name="umur[]"></td>
		<td><input type="text" class="form-control" id="tahun_`+counter+`" name="tahun[]"></td>
		<td><input type="text" class="form-control" id="tempat_`+counter+`" name="tempat[]"></td>
		<td><input type="text" class="form-control" id="jenis_`+counter+`" name="jenis[]"></td>
		<td><input type="text" class="form-control" id="penolong_`+counter+`" name="penolong[]"></td>
		<td><input type="text" class="form-control" id="penyulit_`+counter+`" name="penyulit[]"></td>
		<td><input type="text" class="form-control" id="jenis_anak_`+counter+`" name="jenis_anak[]"></td>
		<td><input type="text" class="form-control" id="bb_anak_`+counter+`" name="bb_anak[]"></td>
		<td><input type="text" class="form-control" id="pb_anak_`+counter+`" name="pb_anak[]"></td>
		<td><input type="text" class="form-control" id="keadaan_anak_`+counter+`" name="keadaan_anak[]"></td>
		<td><button type="button" class="btn btn-rounded btn-alt-danger delete-item"><i class="fa fa-trash"></i></button></td>
		</tr>`;
		$('#table_append').append(str);
	});

</script>
@endsection