@extends('kasus.layouts.main')

@section('title')
{{$kasus->judul_kasus}} - Humpty Dumpty - Kasus
@endsection

@section('css')
<style type="text/css">
.humpty-dumpty-item {
	font-weight: 500;
	width: 100%;
}
.humpty-dumpty-item > input{ /* HIDE RADIO */
	visibility: hidden; /* Makes input not-clickable */
	position: absolute; /* Remove input from document flow */
}

.humpty-dumpty-item div
{
	padding:8px 8px;
}

.humpty-dumpty-item > input + div{ /* DIV STYLES */
	cursor:pointer;
	border:2px solid transparent;
}
.humpty-dumpty-item > input:checked + div{ /* (RADIO CHECKED) DIV STYLES */
	background: #dcdcdc;
}

.table.humpty-dumpty td, .table.humpty-dumpty th
{
	text-align: center;
}
</style>
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
						<button type="button" class="btn btn-rounded btn-alt-primary min-width-125 float-right" data-toggle="modal" data-target="#addModal"><i class="fa fa-pencil"></i> Skor Humpty Dumpty Baru</button>
						@endif
						<h4>Humpty Dumpty</h4>
						<hr>
						@php $count = 1 @endphp
						@forelse($humpty_dumpty as $item)
						
						@if(session('my_role_'.$kasus->nomor_kasus))
						@if(session('my_role_'.$kasus->nomor_kasus)->admin == 1 || $item->created_by == Auth::user()->id)
						<button class="btn btn-circle btn-outline-danger mr-5 mb-5 pull-right deleteBtn" data-id="{{$item->id}}">
							<i class="fa fa-trash"></i>
						</button>
						@endif
						@endif

						<h5 class="mb-5 pl-5">#Humpty Dumpty {{$count++}}</h5>
						<div class="row">
							<div class="col-md-8">
								<table class="table table-sm table-borderless table-vcenter" style="width: 100%">
									<thead>
										<tr>
											<th style="width:25%">Parameter</th>
											<th class="text-center" style="width: 50%;">Penilaian</th>
											<th class="text-center" style="width: 25%;">Skor</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>Usia</td>
											<td class="text-center">{{$item->usia_text}}</td>
											<td class="text-center">{{$item->usia}}</td>
										</tr>
										<tr>
											<td>Jenis kelamin</td>
											<td class="text-center">{{$item->jenis_kelamin_text}}</td>
											<td class="text-center">{{$item->jenis_kelamin}}</td>
										</tr>
										<tr>
											<td>Diagnosis</td>
											<td class="text-center">{{$item->diagnosis_text}}</td>
											<td class="text-center">{{$item->diagnosis}}</td>
										</tr>
										<tr>
											<td>Gangguan kognitif</td>
											<td class="text-center">{{$item->gangguan_kognitif_text}}</td>
											<td class="text-center">{{$item->gangguan_kognitif}}</td>
										</tr>
										<tr>
											<td>Faktor lingkungan</td>
											<td class="text-center">{{$item->faktor_lingkungan_text}}</td>
											<td class="text-center">{{$item->faktor_lingkungan}}</td>
										</tr>
										<tr>
											<td>Respons terhadap pembedahan/sedasi/anastesi</td>
											<td class="text-center">{{$item->respons_text}}</td>
											<td class="text-center">{{$item->respons}}</td>
										</tr>
										<tr>
											<td>Penggunaan medikamentosa</td>
											<td class="text-center">{{$item->penggunaan_medik_text}}</td>
											<td class="text-center">{{$item->penggunaan_medik}}</td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="col-md-4 text-center pt-50">
								<h3> Skor </h3>
								<h1 class="display-1">{{$item->score}}</h1>
								<h4>
									@if($item->score < 12)
									<strong>Risiko Rendah</strong>
									@php $kategori = 'rendah' @endphp									
									@else 
									<strong>Risiko Tinggi</strong>
									@php $kategori = 'tinggi' @endphp
									@endif
								</h4>
							</div>
						</div>
						<hr style="width: 50%">
						@if(session('my_role_'.$kasus->nomor_kasus))
						@if(session('my_role_'.$kasus->nomor_kasus)->admin == 1 || $item->created_by == Auth::user()->id)
						<button type="button" class="btn btn-sm btn-rounded btn-alt-success min-width-125 float-right mr-10 modalTataLaksana" data-id="{{$item->id}}" data-score="{{$item->score}}" data-tatalaksana="{{$item->tatalaksana}}" id="tatalaksana-btn-{{$item->id}}">
							@if(empty($item->tatalaksana))<i class="fa fa-plus"></i> Isi Tatalaksana
							@else <i class="fa fa-search-plus"></i> Lihat Tatalaksana
							@endif
						</button>
						@endif
						@endif
						<h6 class="mb-5 pl-5">Tatalaksana</h6>
						<div class="row">
							<div class="col-12">
								<table class="table table-sm table-striped table-borderless table-vcenter" style="width: 100%">
									<thead>
										<tr>
											<th style="width:65%">Parameter</th>
											<th class="text-center" style="width: 35%;">Penilaian</th>
										</tr>
									</thead>
									@php $tata = json_decode($item->tatalaksana) @endphp
									@php $i=0 @endphp
									<tbody id="tatalaksana-body-{{$item->id}}">
										<tr @if ($kategori != 'rendah') class="d-none" @endif>
											<td>Orientasi ruangan: bel pasien, kamar mandi dll</td>
											<td class="text-center centang">{!! $tata[$i] == 1 ? '<i class="fa fa-check"></i>' : '-' !!}</td>
											@php $i++ @endphp
										</tr>
										<tr @if ($kategori != 'rendah') class="d-none" @endif>
											<td>Posisikan tempat tidur rendah dan ada remnya</td>
											<td class="text-center centang">{!! $tata[$i] == 1 ? '<i class="fa fa-check"></i>' : '-' !!}</td>
											@php $i++ @endphp
										</tr>
										<tr @if ($kategori != 'rendah') class="d-none" @endif>
											<td>Pastikan ada pengaman/pagar samping tempat tidur. Mempunyai luas tempat tidur yang cukup untuk mencegah tangan dan kaki atau bagian tubuh lain terjepit</td>
											<td class="text-center centang">{!! $tata[$i] == 1 ? '<i class="fa fa-check"></i>' : '-' !!}</td>
											@php $i++ @endphp
										</tr>
										<tr @if ($kategori != 'rendah') class="d-none" @endif>
											<td>Anjurkan menggunakan alas kaki yang tidak licin untuk pasien yg dapat berjalan</td>
											<td class="text-center centang">{!! $tata[$i] == 1 ? '<i class="fa fa-check"></i>' : '-' !!}</td>
											@php $i++ @endphp
										</tr>
										<tr @if ($kategori != 'rendah') class="d-none" @endif>
											<td>Nilai kemampuan untuk ke kamar mandi dan bantu bila dibutuhkan</td>
											<td class="text-center centang">{!! $tata[$i] == 1 ? '<i class="fa fa-check"></i>' : '-' !!}</td>
											@php $i++ @endphp
										</tr>
										<tr @if ($kategori != 'rendah') class="d-none" @endif>
											<td>Akses untuk menghubungi petugas kesehatan mudah dijangkau. Terangkan kepada pasien mengenai fungsi alat tersebut</td>
											<td class="text-center centang">{!! $tata[$i] == 1 ? '<i class="fa fa-check"></i>' : '-' !!}</td>
											@php $i++ @endphp
										</tr>
										<tr @if ($kategori != 'rendah') class="d-none" @endif>
											<td>Pastikan lingkungan harus bebas dari peralatan yang mengandung risiko</td>
											<td class="text-center centang">{!! $tata[$i] == 1 ? '<i class="fa fa-check"></i>' : '-' !!}</td>
											@php $i++ @endphp
										</tr>
										<tr @if ($kategori != 'rendah') class="d-none" @endif>
											<td>Pastikan penerangan lampu harus cukup</td>
											<td class="text-center centang">{!! $tata[$i] == 1 ? '<i class="fa fa-check"></i>' : '-' !!}</td>
											@php $i++ @endphp
										</tr>
										<tr @if ($kategori != 'rendah') class="d-none" @endif>
											<td>Memberikan penjelasan pada pasien dan keluarga</td>
											<td class="text-center centang">{!! $tata[$i] == 1 ? '<i class="fa fa-check"></i>' : '-' !!}</td>
											@php $i++ @endphp
										</tr>
										<tr @if ($kategori != 'tinggi') class="d-none" @endif>
											<td>Gunakan gelang risiko jatuh berwarna kuning</td>
											<td class="text-center centang">{!! $tata[$i] == 1 ? '<i class="fa fa-check"></i>' : '-' !!}</td>
											@php $i++ @endphp
										</tr>
										<tr @if ($kategori != 'tinggi') class="d-none" @endif>
											<td>Berikan penjelasan pada pasien atau orang tuanya tentang protokol pencegahan pasien jatuh</td>
											<td class="text-center centang">{!! $tata[$i] == 1 ? '<i class="fa fa-check"></i>' : '-' !!}</td>
											@php $i++ @endphp
										</tr>
										<tr @if ($kategori != 'tinggi') class="d-none" @endif>
											<td>Kunjungi pasien minimal setiap satu jam</td>
											<td class="text-center centang">{!! $tata[$i] == 1 ? '<i class="fa fa-check"></i>' : '-' !!}</td>
											@php $i++ @endphp
										</tr>
										<tr @if ($kategori != 'tinggi') class="d-none" @endif>
											<td>Temani pasien saat mobilisasi</td>
											<td class="text-center centang">{!! $tata[$i] == 1 ? '<i class="fa fa-check"></i>' : '-' !!}</td>
											@php $i++ @endphp
										</tr>
										<tr @if ($kategori != 'tinggi') class="d-none" @endif>
											<td>Tempat tidur pasien harus disesuaikan dengan perkembangan tubuh pasien</td>
											<td class="text-center centang">{!! $tata[$i] == 1 ? '<i class="fa fa-check"></i>' : '-' !!}</td>
											@php $i++ @endphp
										</tr>
										<tr @if ($kategori != 'tinggi') class="d-none" @endif>
											<td>Pertimbangkan penempatan pasien yg perlu perhatian diletakkan dekat nurse station</td>
											<td class="text-center centang">{!! $tata[$i] == 1 ? '<i class="fa fa-check"></i>' : '-' !!}</td>
											@php $i++ @endphp
										</tr>
										<tr @if ($kategori != 'tinggi') class="d-none" @endif>
											<td>Evaluasi terapi yang sesuai. Pindahkan semua peralatan yang tidak dibutuhkan ke luar ruangan</td>
											<td class="text-center centang">{!! $tata[$i] == 1 ? '<i class="fa fa-check"></i>' : '-' !!}</td>
											@php $i++ @endphp
										</tr>
										<tr @if ($kategori != 'tinggi') class="d-none" @endif>
											<td>Pencegahan pengamanan yang cukup, batasi di tempat tidur</td>
											<td class="text-center centang">{!! $tata[$i] == 1 ? '<i class="fa fa-check"></i>' : '-' !!}</td>
											@php $i++ @endphp
										</tr>
										<tr @if ($kategori != 'tinggi') class="d-none" @endif>
											<td>Biarkan pintu terbuka setiap saat kecuali pada pasien yang membutuhkan ruang isolasi</td>
											<td class="text-center centang">{!! $tata[$i] == 1 ? '<i class="fa fa-check"></i>' : '-' !!}</td>
											@php $i++ @endphp
										</tr>
										<tr @if ($kategori != 'tinggi') class="d-none" @endif>
											<td>Tempatkan pasien pada posisi tempat tidur yang rendah kecuali pada pasien yang ditunggu keluarga</td>
											<td class="text-center centang">{!! $tata[$i] == 1 ? '<i class="fa fa-check"></i>' : '-' !!}</td>
											@php $i++ @endphp
										</tr>
										<tr @if ($kategori != 'tinggi') class="d-none" @endif>
											<td>Semua kegiatan yang dilakukan pada pasien harus didokumentasikan</td>
											<td class="text-center centang">{!! $tata[$i] == 1 ? '<i class="fa fa-check"></i>' : '-' !!}</td>
											@php $i++ @endphp
										</tr>
									</tbody>
								</table>
							</div>
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
							<h4 class="font-w400 mb-5">Belum ada Humpty Dumpty</h4><br>
							<p>Klik tombol <b>Skor Humpty Dumpty Baru</b> untuk melakukan penilaian humpty dumpty</p>
						</div>

						@endforelse
					</div>
				</div>
			</div>
			<!-- END Updates -->
		</div>
	</div>
</main>

<form method="POST" action="{{url('')}}/kasus/{{$kasus->nomor_kasus}}/alat-bantu/humpty-dumpty/delete" id="formDelete">
	{{csrf_field()}}
	<input name="id" type="hidden" id="deleteInputId">
	
</form>

@include('kasus.alatbantu.humpty-dumpty.add')
@include('kasus.alatbantu.humpty-dumpty.tatalaksana')
<!-- END Main Container -->    
@endsection

@section('js')
<script type="text/javascript">
	var morse_id = 0;
	var tatalaksana_id = null;
	$.fn.updateValue = function(tatalaksana){ 
		var centang = $("#tatalaksana-body-"+tatalaksana_id+" .centang");
		centang.each(function(index, item){
			if(tatalaksana[index] == 1)
			{
				$(item).html(
					`<i class="fa fa-check"></i>`
					)
			}
		});
		$(`#tatalaksana-btn-${tatalaksana_id}`).attr('data-tatalaksana', tatalaksana);
	}
	$(document).ready(function(){
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

		$(".modalTataLaksana").click(function(){
			id = $(this).data("id");
			tatalaksana_id = id;
			score = $(this).data("score");
			data = $(this).data("tatalaksana");
			if(data != ""){
				$(".terlaksana").each(function(index){
					$(this).prop('checked', data[index]);
					if(data[index])
						$(this).prop('disabled', true);
					else
						$(this).prop('disabled', false);
				});
			}else{
				$(".terlaksana").each(function(index){
					$(this).prop('checked', 0);
					$(this).prop('disabled', false);
				});
			}
			if(score < 12){
				$('.item-rendah').show();
			}
			else{
				$('.item-tinggi').show();
			}
			$('#addTataLaksana').modal('toggle');
		});

		$("#submit_tatalaksana").click(function(){
			$(this).prepend('<i class="fa fa-spinner fa-spin"></i>');
			$(this).attr("disabled", true);

			var formData = new FormData();
			var tatalaksana = [];
			$('.terlaksana').each(function(){
				tatalaksana.push($(this).is(":checked") ? 1 : 0);
			});
			formData.append('id', id);
			formData.append('tatalaksana', tatalaksana.toString());
			$.ajax({
				type: "POST",
				url: "{{url()->current()}}/tatalaksana",
				data: formData,
				cache: false,
				contentType: false,
				processData: false,
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				success: function (response) {
					$('#submit_tatalaksana').find("i").remove();
					$('#submit_tatalaksana').attr("disabled", false);
					$("#tatalaksana-btn-"+id).data('tatalaksana',tatalaksana); 
					$('#addTataLaksana').modal('toggle');
					$.fn.updateValue(tatalaksana);
					callSwal('success', 'Tatalaksana Pencegahan Pasien dengan Risiko Jatuh Berhasil Disimpan', '', '');
				},
				error: function (error) {
					$('#submit_tatalaksana').find("i").remove();
					$('#submit_tatalaksana').attr("disabled", false);
					callSwal('error', 'Tatalaksana Pencegahan Pasien dengan Risiko Jatuh Gagal Disimpan', '', '');
				}
			});
		});
	});

</script>
@endsection