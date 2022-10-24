@extends('layouts.main2')

@section('title')
Buat Pengembalian Alat - CSSD
@endsection

@section('css')

@endsection

@section('content')
<main id="main-container">
	<div class="content">
		@include('cssd.layouts.navbar')
		<div class="block">
			<div class="block-content block-content-full">
				<div class="row">
					<div class="col-6">
						<H6>BUAT PENGEMBALIAN BARU</H6>
						<hr>
						<form method="POST" action="{{url()->current()}}" id="formSubmit">
							{{csrf_field()}}
							<div class="form-group">
								<label>Kamar Operasi</label>
								<select class="form-control js-select2" name="ruangan_ok" id="ruangan_ok">
									@foreach($ruangan_ok as $ruang)
									<option value="{{$ruang->id}}">{{$ruang->name}}</option>
									@endforeach
								</select>
							</div>
							@php $batas_ronde = 9 @endphp
							<div class="form-group">
								<label>Ronde</label>
								<div class="input-daterange input-group">
									<select class="form-control js-select2" name="ronde_ok" id="ronde_ok">
										@for($i=1;$i<$batas_ronde;$i++)
										<option value="{{$i}}">{{$i}}</option>
										@endfor
									</select>
								</div>
							</div>
							<div class="form-group">
								<label>Tanggal Operasi</label>
								<input type="text" class="js-datepicker form-control" autocomplete="off" required id="tanggal_ok" name="tanggal_ok" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="dd/mm/yyyy" placeholder="dd/mm/yyyy">
							</div>
							<input type="hidden" id="ok_id" name="transaksi_ok_id"><br>
							<small>Data yang diinput harus memiliki jadwal operasi pada modul Kamar Operasi <a href="{{url('kamaroperasi/jadwal')}}">Lihat Jadwal</a></small>
							<hr>
							<div class="row">
								<div class="col-7"><label>Alkes</label></div>
								<div class="col-3"><label>Jumlah</label></div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-7"><select class="form-control js-select2" name="alkes_id[]"></select></div>
									<div class="col-3"><input class="form-control alkes-jumlah"  required name="alkes_jumlah[]" type="number"><span class="text-danger hide">Isi Jumlah</span></div>
									<div class="col-2 text-center"><button type="button" class="btn btn-outline-danger btn-circle btnDelete" disabled=""><i class="fa fa-trash"></i></button></div>
								</div>
							</div>
							<div id="alkes-container"></div>
							<div class="form-group">
								<div class="row">
									<div class="col-12 text-center">
										<button type="button" class="btn btn-circle btn-outline-primary" id="tambahAlat"><i class="fa fa-plus"></i></button>
									</div>
								</div>
							</div>

							<div class="form-group">
								<button type="button" id="buttonSubmit" class="btn btn-primary btn-block">Simpan</button>
							</div>
						</form>
					</div>
				</div>
			</div>

		</div>
	</div>
</main>

@endsection

@section('js')
<script type="text/javascript">
	@foreach($alkes as $item)
	@if($loop->first) var data = [ @endif {id:{{$item->id}}, text:'{{$item->nama}}'} @if(!$loop->last), @endif
	@endforeach
	];
</script>

<script type="text/javascript">
	$(".js-select2").select2({
		data: data
	})

	$('#tambahAlat').click(function(){
		$('#alkes-container').append(`
			<div class="form-group">
			<div class="row">
			<div class="col-7"><select class="form-control js-select2" name="alkes_id[]"></select></div>
			<div class="col-3"><input class="form-control alkes-jumlah" name="alkes_jumlah[]" type="number" required><span class="text-danger hide">Isi Jumlah</span></div>
			<div class="col-2 text-center"><button type="button" class="btn btn-outline-danger btn-circle btnDelete"><i class="fa fa-trash"></i></button></div>
			</div>
			</div>
			`)
		$(".js-select2").select2({
			data: data
		})
	})

	$(document).on('click', '.btnDelete', function() {
		var element = $(this).parent().parent();
		element.remove();
	})

	$(document).on('click', '#buttonSubmit', function() {
		var ruangan_ok = $('#ruangan_ok').val();
		var ronde_ok = $('#ronde_ok').val();
		var tanggal_ok = $('#tanggal_ok').val();
		$.ajax({
			type: "GET",
			contentType: "application/json; charset=utf-8",
			url: API_URL + '/cssd/cek-jadwal-operasi',
			data: {
				ruangan_ok : ruangan_ok,
				ronde_ok:ronde_ok,
				tanggal_ok:tanggal_ok
			},
			success: function (result) {
				if(result == 0)
				{
					swal({
						type: 'error',
						title: 'Jadwal Operasi Tidak Ditemukan',
						html: 'Cek jadwal operasi pada modul kamar operasi'
					})
				}
				else
				{
					
					$('#ok_id').val(result);
					if(validateForm()) $('#formSubmit').submit();
				}

			}
		});
	})



	function validateForm(){
		var countError = 0;
		$('.alkes-jumlah').each(function(n,element){
			if ($(element).val()=='') {
				$(element).siblings(".text-danger").removeClass("hide");
				countError++;
			}
			else {
				$(element).siblings(".text-danger").addClass("hide");
			}
		});
		if(countError == 0) return 1;
		else return 0;
	}
</script>



@endsection