@extends('kasus.layouts.main')

@section('title')
{{$kasus->judul_kasus}}  - Morse Fall - Kasus
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
						<button type="button" class="btn btn-rounded btn-alt-primary min-width-125 float-right" data-toggle="modal" data-target="#addModal"><i class="fa fa-plus"></i> Skor Morse Fall Baru</button>
						@endif
						<h4>Morse Fall</h4>
						<hr>

						@php $count = 1 @endphp
						@forelse($morse as $item)

						@if(session('my_role_'.$kasus->nomor_kasus) && (session('my_role_'.$kasus->nomor_kasus)->admin == 1 || $item->created_by == Auth::user()->id))
						<button  class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5 pull-right deleteBtn" data-id="{{$item->id}}">
							<i class="fa fa-trash"></i>
						</button>
						@endif

						<h5 class="mb-5 pl-5">#Morse Fall {{$count++}}</h5>
						<div class="row">
							<div class="col-md-8">
								<table class="table table-sm table-striped table-borderless table-vcenter" style="width: 100%">
									<thead>
										<tr>
											<th style="width:40%">Parameter</th>
											<th class="text-center" style="width: 35%;">Penilaian</th>
											<th class="text-center" style="width: 25%;">Skor</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>History of falling ( &lt;3 months)</td>
											<td class="text-center">{{$item->jatuh_text}}</td>
											<td class="text-center">{{$item->jatuh}}</td>
										</tr>
										<tr>
											<td>Secondary diagnosis</td>
											<td class="text-center">{{$item->diagnosis_text}}</td>
											<td class="text-center">{{$item->diagnosis}}</td>
										</tr>
										<tr>
											<td>Ambulatory aid</td>
											<td class="text-center">{{$item->ambulatory_text}}</td>
											<td class="text-center">{{$item->ambulatory}}</td>
										</tr>
										<tr>
											<td>IV/Heparin lock</td>
											<td class="text-center">{{$item->iv_text}}</td>
											<td class="text-center">{{$item->iv}}</td>
										</tr>
										<tr>
											<td>Gait/Transfering</td>
											<td class="text-center">{{$item->gait_text}}</td>
											<td class="text-center">{{$item->gait}}</td>
										</tr>
										<tr>
											<td>Mental status</td>
											<td class="text-center">{{$item->mental_text}}</td>
											<td class="text-center">{{$item->mental}}</td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="col-md-4 text-center pt-20">
								<h3> Skor </h3>
								<h1 class="display-1">{{$item->score}}</h1>

								<h3 class="text-center font-w400">
									@if($item->score < 24)
									<small>Risiko Jatuh Rendah</small>
									@php $kategori = 'rendah' @endphp
									@elseif($item->score < 50)
									<small>Risiko Jatuh Sedang</small>
									@php $kategori = 'sedang' @endphp
									@else
									<small>Risiko Jatuh Tinggi</small>
									@php $kategori = 'tinggi' @endphp
									@endif
								</h3>
							</div>
						</div>
						<hr style="width: 50%">
						<button class="btn btn-sm btn-rounded btn-alt-success mr-5 mb-5 pull-right tatalaksana-btn" data-id="{{$item->id}}" data-tatalaksana="{{$item->tatalaksana}}" data-score="{{$item->score}}" id="tatalaksana-btn-{{$item->id}}">
							<i class="fa fa-pencil"></i> Isi Tatalaksana
						</button>
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
											<td>Orientasikan pasien pada lingkungan kamar/bangsal</td>
											<td class="text-center centang">@if($tata[$i]) <i class="fa fa-check"></i> @else - @endif</td>
											@php $i++ @endphp
										</tr>
										<tr @if ($kategori != 'rendah') class="d-none" @endif>
											<td>Pastikan roda tempat tidur terkunci</td>
											<td class="text-center centang">@if($tata[$i]) <i class="fa fa-check"></i> @else - @endif</td>
											@php $i++ @endphp
										</tr>
										<tr @if ($kategori != 'rendah') class="d-none" @endif>
											<td>Pastikan bel pasien terjangkau</td>
											<td class="text-center centang">@if($tata[$i]) <i class="fa fa-check"></i> @else - @endif</td>
											@php $i++ @endphp
										</tr>
										<tr @if ($kategori != 'rendah') class="d-none" @endif>
											<td>Singkirkan barang yang berbahaya terutama pada malam hari, misal: kursi tambahan</td>
											<td class="text-center centang">@if($tata[$i]) <i class="fa fa-check"></i> @else - @endif</td>
											@php $i++ @endphp
										</tr>
										<tr @if ($kategori != 'rendah') class="d-none" @endif>
											<td>Posisikan tempat tidur pada posisi terendah</td>
											<td class="text-center centang">@if($tata[$i]) <i class="fa fa-check"></i> @else - @endif</td>
											@php $i++ @endphp
										</tr>
										<tr @if ($kategori != 'rendah') class="d-none" @endif>
											<td>Pastikan pengaman tempat tidur terpasang</td>
											<td class="text-center centang">@if($tata[$i]) <i class="fa fa-check"></i> @else - @endif</td>
											@php $i++ @endphp
										</tr>
										<tr @if ($kategori != 'rendah') class="d-none" @endif>
											<td>Minta persetujuan pasien agar lampu malam tetap menyala karena lingkungan masih asing</td>
											<td class="text-center centang">@if($tata[$i]) <i class="fa fa-check"></i> @else - @endif</td>
											@php $i++ @endphp
										</tr>
										<tr @if ($kategori != 'rendah') class="d-none" @endif>
											<td>Pastikan alat bantu jalan dalam jangkauan</td>
											<td class="text-center centang">@if($tata[$i]) <i class="fa fa-check"></i> @else - @endif</td>
											@php $i++ @endphp
										</tr>
										<tr @if ($kategori != 'rendah') class="d-none" @endif>
											<td>Tempatkan meja pasien dengan baik agar tidak menghalangi</td>
											<td class="text-center centang">@if($tata[$i]) <i class="fa fa-check"></i> @else - @endif</td>
											@php $i++ @endphp
										</tr>
										<tr @if ($kategori != 'rendah') class="d-none" @endif>
											<td>Tempatkan pasien sesuai tinggi badannya</td>
											<td class="text-center centang">@if($tata[$i]) <i class="fa fa-check"></i> @else - @endif</td>
											@php $i++ @endphp
										</tr>
										<tr @if ($kategori != 'sedang') class="d-none" @endif>
											<td>Lakukan semua pedoman pencegahan jatuh standar</td>
											<td class="text-center centang">@if($tata[$i]) <i class="fa fa-check"></i> @else - @endif</td>
											@php $i++ @endphp
										</tr>
										<tr @if ($kategori != 'sedang') class="d-none" @endif>
											<td>Review kembali obat-obatan yang beresiko</td>
											<td class="text-center centang">@if($tata[$i]) <i class="fa fa-check"></i> @else - @endif</td>
											@php $i++ @endphp
										</tr>
										<tr @if ($kategori != 'sedang') class="d-none" @endif>
											<td>Beritahu pasien agar mobilisasi secara bertahap: duduk perlahan sebelum berdiri</td>
											<td class="text-center centang">@if($tata[$i]) <i class="fa fa-check"></i> @else - @endif</td>
											@php $i++ @endphp
										</tr>
										<tr @if ($kategori != 'tinggi') class="d-none" @endif>
											<td>Lakukan semua pedoman pencegahan risiko jatuh</td>
											<td class="text-center centang">@if($tata[$i]) <i class="fa fa-check"></i> @else - @endif</td>
											@php $i++ @endphp
										</tr>
										<tr @if ($kategori != 'tinggi') class="d-none" @endif>
											<td>Pakaikan gelang warna kuning di tangan pasien</td>
											<td class="text-center centang">@if($tata[$i]) <i class="fa fa-check"></i> @else - @endif</td>
											@php $i++ @endphp
										</tr>
										<tr @if ($kategori != 'tinggi') class="d-none" @endif>
											<td>Kunjungi dan monitor pasien setiap jam</td>
											<td class="text-center centang">@if($tata[$i]) <i class="fa fa-check"></i> @else - @endif</td>
											@php $i++ @endphp
										</tr>
										<tr @if ($kategori != 'tinggi') class="d-none" @endif>
											<td>Tempatkan pasien di kamar yang paling dekat dengan nurse station (jika memungkinkan)</td>
											<td class="text-center centang">@if($tata[$i]) <i class="fa fa-check"></i> @else - @endif</td>
											@php $i++ @endphp
										</tr>
										<tr @if ($kategori != 'tinggi') class="d-none" @endif>
											<td>Kaji kebutuhan BAB/BAK secara teratur tiap 2-3 jam</td>
											<td class="text-center centang">@if($tata[$i]) <i class="fa fa-check"></i> @else - @endif</td>
											@php $i++ @endphp
										</tr>
										<tr @if ($kategori != 'tinggi') class="d-none" @endif>
											<td>Dokumentasikan setiap perubahan pada pengkajian risiko jatuh</td>
											<td class="text-center centang">@if($tata[$i]) <i class="fa fa-check"></i> @else - @endif</td>
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
							<h4 class="font-w400 mb-5">Belum ada hasil Morse Fall tersedia</h4>
							<p>Klik tombol <b>Skor morse Baru</b> untuk melakukan penilaian Morse Fall</p>
						</div>

						@endforelse
					</div>
				</div>
			</div>
			<!-- END Updates -->
		</div>
	</div>
</main>


<form method="POST" action="{{url('')}}/kasus/{{$kasus->nomor_kasus}}/alat-bantu/morse/delete" id="formDelete">
	{{csrf_field()}}
	<input name="id" type="hidden" id="deleteInputId">
	
</form>

@include('kasus.alatbantu.morse.add')
@include('kasus.alatbantu.morse.tatalaksana')
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
    });
    $(".tatalaksana-btn").click(function(e){
    	morse_id = $(this).data('id');
    	var tatalaksana = $(this).data('tatalaksana');
    	tatalaksana_id = morse_id;
		var score = $(this).data('score');

		if(tatalaksana != ""){
			$(".terlaksana").each(function(index){
				$(this).prop('checked', tatalaksana[index]);
				if(tatalaksana[index])
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

		$('.rendah').hide();
		$('.sedang').hide();
		$('.tinggi').hide();
		if(score < 24){
			$('.rendah').show();
		}
		else if(score > 45){
			$('.tinggi').show();
		}
		else{
			$('.sedang').show();
		}
		$('#tatalaksana-modal').modal('toggle');
	});
    $('#submit-morse').click(function(e){
    	var formData = new FormData();
    	var tatalaksana = [];
    	$('.terlaksana').each(function(){
    		tatalaksana.push($(this).is(":checked") ? 1 : 0);
    	});
    	formData.append('id', morse_id);
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
    			$("#tatalaksana-btn-"+morse_id).data('tatalaksana',tatalaksana); 
    			$('#tatalaksana-modal').modal('toggle');
    			$.fn.updateValue(tatalaksana);
    			callSwal('success', 'Tatalaksana Risiko Jatuh Pasien Berhasil Disimpan', '', '');
    		},
    		error: function (error) {
    			callSwal('error', 'Tatalaksana Risiko Jatuh Pasien Gagal Disimpan', '', '');
    		}
    	});
    });
</script>
@endsection