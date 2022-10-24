@extends('gizi.layouts.index')

@section('title')
Gizi Belanja
@endsection

@section('css')

@endsection

@section('content')
<div class="content">
	<div class="block p-10">
		<div class="block-header">
			<h3 class="block-title">
				Buat Daftar Belanja
			</h3>
		</div>
		<div class="block-content">
		<form action="{{url('gizi/belanja/konfirmasi')}}" method="POST">
			{{csrf_field()}}	
			<div class="form-group">
				<div class="row">
					<div class="col-8">
						<label>Deskripsi</label>
						<input type="text" value="Belanja Kebutuhan Tanggal {{date('d F Y')}} sore - {{$data['besok']}} siang" class="form-control" 
						placeholder="Jelaskan Alasan Belanja Berikut" name="deskripsi" required>
					</div>
				</div>
			</div>
			<hr>
			<label>Daftar Bahan</label>
			@if(count($data['resep_detail']) > 0)
			@foreach($data['resep_detail'] as $item)
			@if($item['stok'] > $item['total_bk_final'])
			@continue
			@endif
			<div class="form-group">
				<div class="row">
					<div class="col-4">
						<select disabled class="form-control js-select2" style="width: 100%;" data-size="5" required>   
							<option disabled selected>{{$item['nama']}}({{$item['satuan']}})</option>
							<input type="hidden" value="{{$item['id']}}" name="bahan[]">
						</select>
					</div>
					<div class="col-3">
						<input type="text" name="jumlah_barang[]" class="form-control" autocomplete="off" value="{{$item['total_bk_final']}}" placeholder="Jumlah Bahan Makanan">
					</div>
					<div class="col-1">
						<button type="button" class="btn btn-circle btn-outline-danger mr-5 mb-5" disabled>
							<i class="fa fa-trash"></i>
						</button>
					</div>
				</div>
			</div>
			@endforeach
			@else
			<div class="form-group">
				<div class="row">
					<div class="col-4">
						<select name="bahan[]" class="form-control js-select2" style="width: 100%;" data-size="5" required>   
							<option value="" disabled selected>Pilih Bahan Makanan</option>
							@foreach($data['bahan'] as $bahan)
							<option value="{{$bahan->id}}"> {{$bahan->nama}}({{$bahan->satuan}})</option>
							@endforeach
						</select>
					</div>
					<div class="col-3">
						<input type="text" name="jumlah_barang[]" class="form-control" autocomplete="off" placeholder="Jumlah Bahan Makanan" required>
					</div>
					<div class="col-1">
						<button type="button" class="btn btn-circle btn-outline-danger mr-5 mb-5" disabled>
							<i class="fa fa-trash"></i>
						</button>
					</div>
				</div>
			</div>
			@endif
			<div id="container-new-form">
			</div>
			<div class="form-group text-center">
				<div class="row">
					<div class="col-8">
						<button type="button" class="btn btn-circle btn-outline-primary mr-5 mb-5" id="buttonAdd">
							<i class="fa fa-plus"></i>
						</button>
					</div>
				</div>
			<hr>
			<div class="row">
				<div class="col-4">
					<div class="form-group">
						<textarea class="form-control" placeholder="Keterangan" name="keterangan"></textarea>
					</div>
					<div class="form-group">
						<button class="btn btn-hero btn-success btn-lg">Simpan</button>
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
		content += '<div class="form-group">'
		content +=		'<div class="row">'
		content +=			'<div class="col-4">'
		content +=				'<select name="bahan[]" class="form-control js-select2" style="width: 100%;" data-size="5" required>   '
		content +=					'<option value="" disabled selected>Pilih Bahan Makanan</option>'
		content +=					'@foreach($data['bahan'] as $bahan)'
		content +=					'<option value="{{$bahan->id}}"> {{$bahan->nama}}</option>'
		content +=					'@endforeach'			
		content +=				'</select>'
		content +=			'</div>'
		content +=			'<div class="col-3">'
		content +=				'<input type="text" name="jumlah_barang[]" class="form-control" autocomplete="off" placeholder="Jumlah Bahan Makanan" required>'
		content +=			'</div>'
		content +=			'<div class="col-1">'
		content +=				'<button type="button" class="btn btn-circle btn-outline-danger mr-5 mb-5 btnRemove">'
		content +=					'<i class="fa fa-trash"></i>'
		content +=				'</button>'
		content +=			'</div>'
		content +=		'</div>'
		content +=	'</div>'

		$('#container-new-form').append(content);
		$('.js-select2').select2();

	});


	$(document).on('click', '.btnRemove', function() {
		var element = $(this).parent().parent().parent();
		element.remove();

	});
</script>


@endsection