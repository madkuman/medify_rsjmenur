@extends('gizi.layouts.index')

@section('title')
Gizi Produksi
@endsection

@section('css')

@endsection

@section('content')
<div class="content">
	<div class="block p-10">
		<div class="block-header">
			<h3 class="block-title">
				Buat Produksi <small>Catat Makanan</small>
			</h3>
		</div>
		<div class="block-content pt-0">
			<hr>
			<form action="{{url('gizi/produksi/baru/simpan-makanan')}}" method="POST">
				{{csrf_field()}}
				<input type="hidden" name="tanggal_produksi" value="{{$tanggal['hari_ini']}}">
				@if(empty($flag['auto']))
				@foreach($flag as $flag_item)
				<input type="hidden" name="flag[]" value="{{$flag_item}}">
				@endforeach
				<input type="hidden" name="flag[3]" value="0">
				@else
				<input type="hidden" name="flag[0]" value="1">
				<input type="hidden" name="flag[1]" value="1">
				<input type="hidden" name="flag[2]" value="1">
				<input type="hidden" name="flag[3]" value="1">
				@endif
				<div class="row">
					<div class="col-8">
						<h6>Catat Hasil Produksi Yang Telah Anda Buat<br>
							<small>Pencatatan resep akan membantu anda untuk mencatat penggunaan bahan</small>
						</h6>
						<h5 class="font-w400"><small>PRODUKSI UNTUK TANGGAL</small><br>
						@if($flag['auto'] == 1)
						{{$tanggal['hari_ini']}} pagi, siang, sore</h5>
						@else
						{{$tanggal['hari_ini']}} @endif @if($flag['pagi'] == 1) Pagi @endif @if($flag['siang'] == 1) Siang @endif @if($flag['sore'] == 1) Sore @endif.
						<div class="row">
							<div class="col-4 ">
								<h5 class="font-w400"><small>RESEP MAKANAN</small></h5>
							</div>
							<div class="col-3">
								<h5 class="font-w400"><small>JUMLAH REKAP</small></h5>
							</div>
							<div class="col-3">
								<h5 class="font-w400"><small>JUMLAH REALISASI</small></h5>
							</div>
						</div>
						@if(!empty($data))
						@foreach($data as $data_item)
						<div class="form-group">
							<div class="row">
								<div class="col-4 ">
									<select class="form-control js-select2" style="width: 100%;" data-size="5">
										<option value="" disabled selected>{{$data_item['nama']}}</option>
										<input type="hidden" value="{{$data_item['id']}}" name="makanan[]">
									</select>
								</div>
								<div class="col-3">
									<input type="text" class="form-control" placeholder="Jumlah" 
									name="jumlah[]" value="{{$data_item['jumlah']}}" readonly>
								</div>
								<div class="col-3">
									<input type="text" class="form-control" placeholder="Jumlah" name="jumlah_real[]" 
									value="{{$data_item['jumlah']}}" autocomplete="off">
								</div>
								<div class="col-2">
									<button type="button" class="btn btn-circle btn-outline-danger mr-5 mb-5 btnRemove" disabled>
										<i class="fa fa-trash"></i>
									</button>
								</div>
							</div>
						</div>
						@endforeach
						<input type="hidden" name="tanggal" value="{{$tanggal['hari_ini']}}">
						@else
						<div class="form-group">
							<div class="row">
								<div class="col-4 ">
									<select name="makanan[]" class="form-control js-select2" style="width: 100%;" data-size="5" required>
										<option value="" disabled selected>Pilih Makanan</option>
										@foreach($resep as $resep_item)
										<option value="{{$resep_item->id}}">{{$resep_item->nama}}</option>
										@endforeach
									</select>
								</div>
								<div class="col-3">
									<input type="text" class="form-control" placeholder="Jumlah" name="jumlah[]" autocomplete="off" required>
								</div>
								<div class="col-3">
									<input type="text" class="form-control" placeholder="Jumlah" name="jumlah_real[]" autocomplete="off" required>
								</div>
								<div class="col-2">
									<button type="button" class="btn btn-circle btn-outline-danger mr-5 mb-5 btnRemove" disabled>
										<i class="fa fa-trash"></i>
									</button>
								</div>
							</div>
						</div>
						@endif
						<div id="container-new-form">
						</div>

						<div class="form-group text-center">
							<button type="button" class="btn btn-circle btn-outline-primary mr-5 mb-5" id="buttonAdd">
								<i class="fa fa-plus"></i>
							</button>
						</div>
						<div class="form-group">
							<button class="btn btn-hero btn-success">Selanjutnya</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection

@section('js')
<script type="text/javascript">
	$('#buttonAdd').click(function(){

		content = ''

		content+=	'<div class="form-group">'
		content+=		'<div class="row">'
		content+=			'<div class="col-4 ">'
		content+=				'<select name="makanan[]" class="form-control js-select2" style="width: 100%;" data-size="5" required="">'
		content+=					'<option value="" selected disabled>Pilih Makanan</option>'
		content+=					'@foreach($resep as $resep_item)'
		content+=					'<option value="{{$resep_item->id}}">{{$resep_item->nama}}</option>'
		content+=					'@endforeach'
		content+=				'</select>'
		content+=			'</div>'
		content+=			'<div class="col-3">'
		content+=				'<input type="text" class="form-control" placeholder="Jumlah" name="jumlah[]" autocomplete="off" required>'
		content+=			'</div>'
		content+=			'<div class="col-3">'
		content+=				'<input type="text" class="form-control" placeholder="Jumlah" name="jumlah_real[]" autocomplete="off" required>'
		content+=			'</div>'
		content+=			'<div class="col-2">'
		content+=				'<button type="button" class="btn btn-circle btn-outline-danger mr-5 mb-5 btnRemove">'
		content+=					'<i class="fa fa-trash"></i>'
		content+=				'</button>'
		content+=			'</div>'
		content+=		'</div>'
		content+=	'</div>'

		$('#container-new-form').append(content);
		$('.js-select2').select2();

	});


	$(document).on('click', '.btnRemove', function() {
		var element = $(this).parent().parent().parent();
		element.remove();

	});
</script>

@endsection