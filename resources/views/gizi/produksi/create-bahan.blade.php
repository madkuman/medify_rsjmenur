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
				Buat Produksi <small>Catat Bahan</small>
			</h3>
		</div>
		<div class="block-content pt-0">
			<hr>
			<form action="{{url('gizi/produksi/baru/catat-bahan')}}" method="POST">
				{{csrf_field()}}
				<input type="hidden" value="{{$produksi_id}}" name="produksi_id">
				
				<div class="row">
					<div class="col-8">
						<!-- <button class="btn btn-outline-primary pull-right" data-toggle="modal" data-target="#modal-makanan" type="button">Lihat Rekap Makanan</button> -->
						<h6>Catat Bahan Yang Anda Gunakan Pada Produksi Ini<br>
							<small>Pencatatan bahan akan secara otomatis dikurangi oleh sistem</small>
						</h6>
						<h5 class="font-w400"><small>PRODUKSI UNTUK TANGGAL</small><br>
						@if($auto == 1)
						{{$tanggal['hari_ini']}} pagi, siang, sore.
						@endif
						</h5>
						<div class="row">
							<div class="col-4 ">
								<h5 class="font-w400"><small>BAHAN MAKANAN</small></h5>
							</div>
							<div class="col-3">
								<h5 class="font-w400"><small>JUMLAH REKAP</small></h5>
							</div>
							<div class="col-3">
								<h5 class="font-w400"><small>JUMLAH REALISASI</small></h5>
							</div>
						</div>
						@foreach($bahan as $item)
						<div class="form-group">
							<div class="row">
								<input type="hidden" name="jenis_bahan[]" value="{{$item['jenis_bahan']}}">
								<div class="col-4 ">
									<select name="bahan[]" class="form-control js-select2" style="width: 100%;" data-size="5">
										<option value="{{$item['id']}}" selected readonly>{{$item['nama']}} ({{$item['satuan']}})</option>
									</select>
								</div>
								<div class="col-3">
									<input type="text" class="form-control" placeholder="Jumlah" name="jumlah[]" 
									value="{{$item['total_bk_final']}}" readonly autocomplete="off">
								</div>
								<div class="col-3">
									<input type="text" class="form-control" placeholder="Jumlah" name="jumlah_real[]"
									value="{{$item['total_bk_final']}}" autocomplete="off">
								</div>
								<div class="col-2">
									<button type="button" class="btn btn-circle btn-outline-danger mr-5 mb-5 btnRemove" disabled>
										<i class="fa fa-trash"></i>
									</button>
								</div>
							</div>
						</div>
						@endforeach

						<div id="container-new-form">
						</div>

						<div class="form-group text-center">
							<button type="button" class="btn btn-circle btn-outline-primary mr-5 mb-5" id="buttonAdd">
								<i class="fa fa-plus"></i>
							</button>
						</div>
						<div class="form-group">
							<!-- kalo udah di koding ganti jadi button -->
							<button type="submit" class="btn btn-hero btn-success">Simpan</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

@include('gizi.produksi.components-create-bahan.makanan')

@endsection

@section('js')
<script type="text/javascript">
	$('#buttonAdd').click(function(){

		content = ''

		content+=	'<div class="form-group">'
		content+=		'<div class="row">'
		content+=			'<div class="col-4 ">'
		content+=				'<select name="bahan[]" class="form-control js-select2" style="width: 100%;" data-size="5" required="">'
		content+=					'<option value="" selected disabled>Pilih Makanan</option>'
		content+=					'@foreach($bahan_all  as $item_all)'
		content+=					'<option value="{{$item_all->id}}">{{$item_all->nama}} ({{$item_all->satuan}})</option>'
		content+=					'@endforeach'
		content+=				'</select>'
		content+=			'</div>'
		content+=			'<div class="col-3">'
		content+=				'<input type="text" class="form-control" placeholder="Jumlah" name="jumlah[]" autocomplete="off">'
		content+=			'</div>'
		content+=			'<div class="col-3">'
		content+=				'<input type="text" class="form-control" placeholder="Jumlah" name="jumlah_real[]" autocomplete="off">'
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