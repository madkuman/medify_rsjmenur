@extends('kasus.layouts.main')

@section('title')
{{$kasus->judul_kasus}} - Identifikasi Bayi
@endsection

@section('css')

@endsection

@section('content')

<!-- Main Container -->
<main id="main-container">
	@include('kasus.layouts.header')

	<div class="content">
		<div class="row">
			@include('kasus.layouts.sidebar')

			<div class="col-lg-9 col-xl-9">
				<div class="block block-bordered">
					<div class="block-content">
						<button type="button" class="btn btn-rounded btn-alt-primary min-width-125 float-right btnModal" data-toggle="modal" data-target="#modalForm"><i class="fa fa-pencil"></i> Buat Baru</button>
						<h4>Asesmen Identifikasi Bayi</h4>
						<hr>
						<div class="row">
							@php $count = count($data_asesmen) @endphp
							@forelse($data_asesmen as $item)
							<div class="col-12"> 
								@if(session('my_role_'.$kasus->nomor_kasus))
									@if(session('my_role_'.$kasus->nomor_kasus)->admin == 1 || $item->created_by == Auth::user()->id)
									<button  class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5 pull-right deleteBtn" data-id="{{$item->id}}">
										<i class="fa fa-trash"></i>
									</button>
									<button  class="btn btn-sm btn-circle btn-outline-warning mr-5 mb-5 pull-right editBtn" data-id="{{$item->id}}" data-index="{{$loop->iteration - 1}}" data-val="{{ $item->val }}">
										<i class="fa fa-pencil"></i>
									</button>
									@endif
								@endif

								<a href="{{url()->current()}}/print/{{$item->id}}" class="btn btn-sm btn-circle btn-outline-secondary mb-5 mr-5 pull-right" target="_blank">
									<i class="fa fa-print"></i>
								</a>
								
								<h5 class="mb-5 pl-5">#Identifikasi Bayi {{$count--}}</h5>
								@php $res = json_decode($item->val) @endphp

								@if(!empty($item->creator->avatar_thumb))
								<div class="float-left mr-10">
									<img class="img-avatar img-avatar-sm img-avatar-thumb" src="{{url($item->creator->avatar_thumb)}}">
								</div>
								@else
								<div class="float-left mr-10">
									<img class="img-avatar img-avatar-sm img-avatar-thumb" src="{{url('assets/img/placeholder.jpg')}}">
								</div>
								@endif
								<div class="creator">
									<h6 class="pt-10">
										<small class="text-muted">Dibuat Oleh</small><br>
										{{$item->creator->name}}<br>
										{{date('d F y, H:i', strtotime($item->created_at))}}
									</h6>
								</div>
							</div>
							<hr class="my-20">
							@empty
							<div class="col-12">
								<div class="text-center py-50">
									<h4 class="font-w400 mb-5">Belum ada Identifikasi Bayi tersedia</h4>
									<p>Klik tombol <b>Buat Baru</b> untuk melakukan Identifikasi Bayi</p>
								</div>
							</div>

							@endforelse
						</div>
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

@include('kasus.asesmen.identitikasi-bayi.modal')

@endsection

@section('js')
<script src="{{url('')}}/assets/js/plugins/jquery-masked-inputs/jquery.mask.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('.time').mask('00:00');
	});

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

	var total_skor_semua = {
		'neuromuskular' : 0,
		'ballard' : 0
	};

	function calculate(el, jenis_bagan, inputan){
		var score = 0;
		var table = $(el).closest(`table`);
		var checked = table.find(`input[type=radio]:checked`);

		checked.each(function(i, item){
			score += parseInt(item.value);
		});
		table.find(`.skor_${inputan}`).html(el.value);
		table.find(`.input_total_skor_${jenis_bagan}`).val(score);
		table.find(`.total_skor_${jenis_bagan}`).html(score);

		total_skor_semua[jenis_bagan] = score;
		hitung_total_bagan();
	}	

	$('.btnModal').click(function(e){
		resetFormModal();
		$('#id').val('');
	});

	$('.editBtn').click(function(e){
		resetFormModal();
		let id = $(this).data('id');
		let items = $(this).data('val');
		entry = Object.entries(items);

		for(i = 0; i < entry.length; i++) {
			let key = entry[i][0];
			let val = entry[i][1];

			if(val != null && val != ""){
				$(`:text[name="${key}"]`).val(val);
				$(`input[type="number"][name="${key}"]`).val(val);
				$(`textarea[name="${key}"]`).val(val);
				$(`:checkbox[name="${key}"]`).prop('checked', true);
				$(`:radio[name="${key}"][value="${val}"]`).prop('checked', true);
				// $(`select[name="${key}"] option[value="${val}"]`).prop('selected', true);
				$(`select[name="${key}"]`).val(val).select2();
				$(`:input[type="time"][name="${key}"]`).val(val);
				$(`.skor_${key}`).html(val);
			}
		}
		initSkorEdit(items);
		$('#id').val(id);
		$('#modalForm').modal('show');
	});

	function initSkorEdit(items){
		$(`.total_skor_ballard`).html(items.total_skor_ballard);
		$(`.input_total_skor_ballard`).val(items.total_skor_ballard);
		$(`.total_skor_neuromuskular`).html(items.total_skor_neuromuskular);
		$(`.input_total_skor_neuromuskular`).val(items.total_skor_neuromuskular);
		total_skor_semua['ballard']  = parseInt(items.total_skor_ballard ?? 0 );
		total_skor_semua['neuromuskular'] = parseInt(items.total_skor_neuromuskular ?? 0 );
		hitung_total_bagan();
	}

	function hitung_total_bagan() {
		let total_semua = total_skor_semua['ballard'] + total_skor_semua['neuromuskular'];
		$('.total_skor').html(total_semua);

		if(total_semua >= 50){
			$('.tabel-getasi tr').removeClass('bg-secondary text-light');
			$('.tabel-getasi .tr_getasi_50').addClass('bg-secondary text-light');			
		} else if (total_semua > 45) {
			$('.tabel-getasi tr').removeClass('bg-secondary text-light');
			$('.tabel-getasi .tr_getasi_45_between').addClass('bg-secondary text-light');			
		} 
		else if (total_semua == 45) {
			$('.tabel-getasi tr').removeClass('bg-secondary text-light');
			$('.tabel-getasi .tr_getasi_45').addClass('bg-secondary text-light');			
		} 
		else if (total_semua > 40) {
			$('.tabel-getasi tr').removeClass('bg-secondary text-light');
			$('.tabel-getasi .tr_getasi_40_between').addClass('bg-secondary text-light');			
		} 
		else if (total_semua == 40) {
			$('.tabel-getasi tr').removeClass('bg-secondary text-light');
			$('.tabel-getasi .tr_getasi_40').addClass('bg-secondary text-light');			
		} 
		else if (total_semua > 35) {
			$('.tabel-getasi tr').removeClass('bg-secondary text-light');
			$('.tabel-getasi .tr_getasi_35_between').addClass('bg-secondary text-light');			
		} 
		else if (total_semua == 35) {
			$('.tabel-getasi tr').removeClass('bg-secondary text-light');
			$('.tabel-getasi .tr_getasi_35').addClass('bg-secondary text-light');			
		} 
		else if (total_semua > 30) {
			$('.tabel-getasi tr').removeClass('bg-secondary text-light');
			$('.tabel-getasi .tr_getasi_30_between').addClass('bg-secondary text-light');			
		} 
		else if (total_semua == 30) {
			$('.tabel-getasi tr').removeClass('bg-secondary text-light');
			$('.tabel-getasi .tr_getasi_30').addClass('bg-secondary text-light');			
		} 
		else if (total_semua > 25) {
			$('.tabel-getasi tr').removeClass('bg-secondary text-light');
			$('.tabel-getasi .tr_getasi_25_between').addClass('bg-secondary text-light');			
		} 
		else if (total_semua == 25) {
			$('.tabel-getasi tr').removeClass('bg-secondary text-light');
			$('.tabel-getasi .tr_getasi_25').addClass('bg-secondary text-light');			
		} 
		else if (total_semua > 20) {
			$('.tabel-getasi tr').removeClass('bg-secondary text-light');
			$('.tabel-getasi .tr_getasi_20_between').addClass('bg-secondary text-light');			
		} 
		else if (total_semua == 20) {
			$('.tabel-getasi tr').removeClass('bg-secondary text-light');
			$('.tabel-getasi .tr_getasi_20').addClass('bg-secondary text-light');			
		} 
		else if (total_semua > 15) {
			$('.tabel-getasi tr').removeClass('bg-secondary text-light');
			$('.tabel-getasi .tr_getasi_15_between').addClass('bg-secondary text-light');			
		} 
		else if (total_semua == 15) {
			$('.tabel-getasi tr').removeClass('bg-secondary text-light');
			$('.tabel-getasi .tr_getasi_15').addClass('bg-secondary text-light');			
		} 
		else if (total_semua > 10) {
			$('.tabel-getasi tr').removeClass('bg-secondary text-light');
			$('.tabel-getasi .tr_getasi_10_between').addClass('bg-secondary text-light');			
		} 
		else if (total_semua == 10) {
			$('.tabel-getasi tr').removeClass('bg-secondary text-light');
			$('.tabel-getasi .tr_getasi_10').addClass('bg-secondary text-light');			
		} 
		else if (total_semua > 5) {
			$('.tabel-getasi tr').removeClass('bg-secondary text-light');
			$('.tabel-getasi .tr_getasi_5_between').addClass('bg-secondary text-light');			
		} 
		else if (total_semua == 5) {
			$('.tabel-getasi tr').removeClass('bg-secondary text-light');
			$('.tabel-getasi .tr_getasi_5').addClass('bg-secondary text-light');			
		} 
		else if (total_semua > 0) {
			$('.tabel-getasi tr').removeClass('bg-secondary text-light');
			$('.tabel-getasi .tr_getasi_0_between').addClass('bg-secondary text-light');			
		}  else {
			$('.tabel-getasi tr').removeClass('bg-secondary text-light');
			$('.tabel-getasi .tr_getasi_0').addClass('bg-secondary text-light');			
		}
	}

	function resetFormModal() {
		$('input[type="text"]:not([readonly])').val('');
		$('input[type="number"]').val('');
		$('textarea').val('');
		$('input[type="checkbox"]:enabled').prop('checked', false);
	}
</script>
@endsection