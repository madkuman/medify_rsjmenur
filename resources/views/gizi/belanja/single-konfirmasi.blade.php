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
		<form action="{{url('gizi/belanja/finalisasi')}}" method="POST">
			{{csrf_field()}}
			<input type="hidden" value="{{$data['belanja']->id}}" name="belanja_id">	
			<div class="form-group">
				<div class="row">
					<div class="col-8">
						<label>Deskripsi</label>
						<input name="deskripsi" type="text" class="form-control" value="{{$data['belanja']->deskripsi}}" placeholder="Jelaskan Alasan Belanja Berikut">
					</div>
				</div>
			</div>
			<hr>
			@php $total_akhir = 0; @endphp
			<label>Daftar Bahan</label>
			@foreach($data['detail'] as $detail)
			@php $jumlah_beli = ceil($detail->jumlah_estimasi + ($detail->jumlah_estimasi * 0.05)); 
			$total_satuan = $detail->detail_bahan->harga * $jumlah_beli; 
			$total_akhir += $total_satuan; @endphp
			<div class="form-group">
				<div class="row">
					<div class="col-4">
						<input type="hidden" value="{{$detail->bahan_makanan_id}}" name="bahan[]">
						<input type="hidden" value="{{$detail->jumlah_estimasi}}" name="jumlah_estimasi[]">
						<select class="form-control js-select2" style="width: 100%;" data-size="5" required disabled>   
							<option value="{{$detail->bahan_makanan_id}}">{{$detail->detail_bahan->nama}}({{$detail->detail_bahan->satuan}})</option>
						</select>
					</div>
					<div class="col-2">
						<input type="text" class="form-control" autocomplete="off" placeholder="Jumlah Bahan Makanan" 
						value="{{$detail->jumlah_estimasi}}" disabled>
					</div>
					<div class="col-2">
						<input type="hidden" value="{{$jumlah_beli}}" name="jumlah_realisasi[]">
						<input name="jumlah_realisasi[]" type="number" class="form-control jumlah_real" autocomplete="off" placeholder="Jumlah Realisasi" 
						value="{{$jumlah_beli}}" disabled>
					</div>
					<div class="col-2">
						<input type="hidden" value="{{$total_satuan}}" name="total_satuan[]">
						<input name="total_satuan[]" type="number" class="form-control total_satuan" autocomplete="off" 
						value="{{$total_satuan}}" placeholder="Total Harga Barang" disabled>
					</div>
				</div>
			</div>
			@endforeach
			<hr>
			<div class="form-group">
				<div class="row">
					<div class="col-4">
					</div>
					<div class="col-4" style="text-align:right"><label>Total Harga Belanja</label></div>
					<div class="col-2">
						<input type="hidden" value="{{$total_akhir}}" name="jumlah">
						<input id="jumlah" name="jumlah" type="number" class="form-control" autocomplete="off" 
						value="{{$total_akhir}}" disabled>
					</div>
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="col-4">
					<div class="form-group">
						<textarea name="keterangan" class="form-control" placeholder="Keterangan">{{$data['belanja']->keterangan}}</textarea>
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

	$(document).ready(function() {
	  $(window).keydown(function(event){
	    if(event.keyCode == 13) {
	      event.preventDefault();
	      return false;
	    }
	  });
	});

	$('#buttonAdd').click(function(){

		content = ''
		content += '<div class="form-group">'
		content +=		'<div class="row">'
		content +=			'<div class="col-4">'
		content +=				'<select name="bahan[]" class="form-control js-select2" style="width: 100%;" data-size="5" required="" name="pasien_id">   '
		content +=					'<option value="" disabled selected>Pilih Bahan Makanan</option>'			
		content +=				'</select>'
		content +=			'</div>'
		content +=			'<div class="col-3">'
		content +=				'<input type="text" class="form-control" autocomplete="off" placeholder="Jumlah Bahan Makanan">'
		content +=			'</div>'
		content +=			'<div class="col-2">'
		content +=			'<input name="total_satuan[]" type="number" class="form-control total_satuan" autocomplete="off" placeholder="Total Harga Barang">'
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



	$(document).on("change", ".total_satuan", function()
	{
		var sum = 0;
		$(".total_satuan").each(function(){
			sum += +$(this).val();
		});
		$("#jumlah").val(sum);
	});

	$(document).on("change",".")

	$(document).on('click', '.btnRemove', function() {
		var element = $(this).parent().parent().parent();
		element.remove();

	});
</script>
@endsection