@extends('gizi.layouts.index')

@section('title')
Gizi Resep
@endsection

@section('css')
<link rel="stylesheet" href="{{asset('assets/js/plugins/simplemde/css/simplemde.min.css')}}">
@endsection

@section('content')
<div class="content">
	<div class="block p-10">
		<div class="block-header">
			<h3 class="block-title">
				Resep Baru
			</h3>
		</div>
		<div class="block-content">
			<!--ketika dikoding ini diganti ya action sama methodnya -->
			<form action="{{url('gizi/resep/simpan')}}" method="POST">
				{{csrf_field()}}
				<div class="row">
					<div class="col-6">
						<div class="form-group">
							<label>Nama Resep</label>
							<input type="hidden" value="{{$resep->id}}" name="id_resep">
							<input type="text" class="form-control" placeholder="Nama Resep" value="{{$resep->nama}}" name="nama_resep">
						</div>
						<div class="form-group">
							<label>Jumlah Porsi</label>
							<input type="text" class="form-control" placeholder="Jumlah Porsi" value="{{$resep->porsi}}" name="jumlah_porsi">
						</div>
						<div class="form-group">
							<label>Waktu Masak</label>
							<input type="text" class="form-control" placeholder="Waktu Masak" value="{{$resep->waktu_masak}}" name="waktu_masak">
						</div>
						<div class="form-group">
							<label>Ukuran Tiap Porsi</label>
							<input type="text" class="form-control" placeholder="Ukuran Tiap Porsi" value="{{$resep->ukuran_tiap_porsi}}" name="ukuran">
						</div>
					</div>
					<div class="col-6">
						<div class="form-group">
							<label>Nilai Gizi E</label>
							<input type="text" class="form-control" value="{{$resep->nilai_e}}" placeholder="Nilai Gizi E" name="nilai_E">
						</div>
						<div class="form-group">
							<label>Nilai Gizi P</label>
							<input type="text" class="form-control" value="{{$resep->nilai_p}}" placeholder="Nilai Gizi P" name="nilai_P">
						</div>
						<div class="form-group">
							<label>Nilai Gizi L</label>
							<input type="text" class="form-control" value="{{$resep->nilai_l}}" placeholder="Nilai Gizi L" name="nilai_L">
						</div>
						<div class="form-group">
							<label>Nilai Gizi K</label>
							<input type="text" class="form-control" value="{{$resep->nilai_k}}" placeholder="Nilai Gizi K" name="nilai_K">
						</div>
					</div>
				</div>
				<hr>
				<div class="row  justify-content-center">
					<div class="col-3 ">
						<h5 class="font-w400"><small>BAHAN MAKANAN</small></h5>
					</div>
					<div class="col-2">
						<h5 class="font-w400"><small>JUMLAH BB</small></h5>
					</div>
					<div class="col-2">
						<h5 class="font-w400"><small>JUMLAH BK</small></h5>
					</div>
					<div class="col-1">
						<h5 class="font-w400"><small>HAPUS</small></h5>
					</div>
				</div>

				<div class="row">
					<div class="col-12">
						<!-- UNTUK ITEM PERTAMA DELETE DI DISABLED UNTUK ITEM KEDUA DST BISA DELETE -->
						@php $j = count($detail) @endphp
						@for($i = 0; $i<$j ; $i++)
						<div class="form-group">
							<div class="row justify-content-center">
								<div class="col-3 ">
									<input type="hidden" name="id_detail[]" value="{{$detail[$i]->id}}">
									<select name="bahan[]" class="form-control js-select2" style="width: 100%;" data-size="5">
										@php $z = count($bahan) @endphp	
										@for($x = 0; $x<$z; $x++)
										<option value="{{$bahan[$x]->id}}" 
										@if($bahan[$x]->id == $detail[$i]->bahan_makanan_id)
										{
											selected
										}
										@endif
										>{{$bahan[$x]->nama}}</option>
										@endfor
									</select>
								</div>
								<div class="col-2">
									<input type="text" class="form-control" placeholder="Jumlah BB" value="{{$detail[$i]->jumlah_bb}}" name="jumlah_BB[]">
								</div>
								<div class="col-2">
									<input type="text" class="form-control" placeholder="Jumlah BK" value="{{$detail[$i]->jumlah_bk}}" name="jumlah_BK[]">
								</div>
								<div class="col-1">
									<button type="button" class="btn btn-circle btn-outline-danger mr-5 mb-5 btnRemove" @if($i==0) disabled @endif>
										<i class="fa fa-trash"></i>
									</button>
								</div>
							</div>
						</div>
						@endfor

						<div id="container-new-form">
						</div>

						<div class="form-group text-center">
							<button type="button" class="btn btn-circle btn-outline-primary mr-5 mb-5" id="buttonAdd">
								<i class="fa fa-plus"></i>
							</button>
						</div>
					</div>
				</div>
				<hr>
				<div class="form-group row">
					<div class="col-12">
						<!-- SimpleMDE Container -->
						<label>Prosedur Masak <small>(Opsional)</small></label>
						<textarea class="js-simplemde" id="simplemde" name="simplemde">{{$resep->prosedur}}</textarea>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<div class="form-group">
							<button class="btn btn-success btn-hero pull-right">Simpan</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection

@section('js')
<script src="{{asset('assets/js/plugins/simplemde/js/simplemde.min.js')}}"></script>
<script type="text/javascript">
	jQuery('.js-simplemde:not(.js-simplemde-enabled)').each(function(){
		var el = jQuery(this);

            // Add .js-simplemde-enabled class to tag it as activated
            el.addClass('js-simplemde-enabled');

            // Init editor
            new SimpleMDE({ element: el[0] });
       });
	

	// <!--JANGAN LUPA SELECT2 NYA PAKE YANG SEARCH AJAX -->
	$('#buttonAdd').click(function(){

		content = ''

		content+=	'<div class="form-group">'
		content+=		'<div class="row justify-content-center">'
		content+=			'<div class="col-3 ">'
		content+=				'<select name="bahan[]" class="form-control js-select2" style="width: 100%;" data-size="5" required="">'
		content+=					'@php $z = count($bahan) @endphp'
		content+=					'@for($x = 0; $x<$z; $x++)'
		content+=					'{{$selected = ''}}'
		content+=					'@if($bahan[$x]->id == 1)'
		content+=					'{'
		content+=						'$selected = 'selected';'
		content+=					'}'
		content+=					'@endif'
		content+=					'<option value="{{$bahan[$x]->id}}" {{$selected}}>{{$bahan[$x]->nama}}</option>'
		content+=					'@endfor'
		content+=				'</select>'
		content+=			'</div>'
		content+=			'<div class="col-2">'
		content+=				'<input type="text" class="form-control" placeholder="Jumlah BB" name="jumlah_BB[]">'
		content+=			'</div>'
		content+=			'<div class="col-2">'
		content+=				'<input type="text" class="form-control" placeholder="Jumlah BK" name="jumlah_BK[]">'
		content+=			'</div>'
		content+=			'<div class="col-1">'
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