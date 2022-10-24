@extends('gizi.layouts.index')

@section('title')
Gizi Menu
@endsection

@section('css')
<link rel="stylesheet" href="{{asset('assets/js/plugins/simplemde/css/simplemde.min.css')}}">
@endsection

@section('content')
<div class="content">
	<div class="block p-10">
		<div class="block-header">
			<h3 class="block-title">
				Ubah Menu
			</h3>
		</div>
		<div class="block-content">
			<!--ketika dikoding ini diganti ya action sama methodnya -->
			<form action="{{url('gizi/menu/simpan')}}" method="POST">
				{{csrf_field()}}
				<div class="row">
					<div class="col-6">
						<div class="form-group">
							<input type="hidden" value="{{$menu->id}}" name="id">
							<label>Nama Menu</label>
							<input type="text" class="form-control" name="nama_menu" value="{{$menu->nama}}" placeholder="Nama Menu" required>
						</div>
						<div class="form-group">
							<label>Kelas</label>
							<select class="form-control" name="kelas">
								@foreach($kelas as $kelas)
								<option value="{{$kelas->id}}" 
								@if($kelas->id == $menu->kelas_id)
								{
									selected
								}
								@endif
								>{{$kelas->nama}}</option>
								@endforeach
							</select>
						</div>
{{--						<div class="form-group">--}}
{{--							<label>Diet</label>--}}
{{--							<select class="form-control js-select2" name="diet">--}}
{{--								@foreach($diet as $diet)--}}
{{--								<option value="{{$diet->id}}"--}}
{{--								@if($diet->id == $menu->diet_id)--}}
{{--								{--}}
{{--									selected--}}
{{--								}--}}
{{--								@endif--}}
{{--								>{{$diet->nama}}</option>--}}
{{--								@endforeach--}}
{{--							</select>--}}
{{--						</div>--}}
						<div class="form-group">
							<label>Tanggal Periode</label>
							<input type="text" name="tanggal_periode" value="{{$menu->tanggal_periode}}" 
							class="form-control" placeholder="Tanggal Periode" required>
						</div>
					</div>
				</div>
				<hr>

				<div class="row">
					<div class="col-12">
						<div class="text-center"><h6>MAKAN PAGI</h6></div>
						<div class="row  justify-content-center">
							<div class="col-3 ">
								<h5 class="font-w400"><small>RESEP MAKANAN</small></h5>
							</div>
							<div class="col-2">
								<h5 class="font-w400"><small>JUMLAH</small></h5>
							</div>
							<div class="col-1">
								<h5 class="font-w400"><small>HAPUS</small></h5>
							</div>
						</div>

						<div class="row">
							<div class="col-12">
								<!-- UNTUK ITEM PERTAMA DELETE DI DISABLED UNTUK ITEM KEDUA DST BISA DELETE -->
								@php $j = count($mp) @endphp
								@if($j > 0)
								@for($i=0; $i<$j ; $i++)
								<div class="form-group">
									<div class="row justify-content-center">
										<div class="col-3 ">
											<input type="hidden" name="id_mp[]" value="{{$mp[$i]->id}}">
											<select name="makan_pagi[]" class="form-control js-select2" style="width: 100%;" data-size="5">
												<option value="0" disabled>Pilih Resep</option>
												@foreach($resep as $resep_a)
												<option value="{{$resep_a->id}}"
												@if($resep_a->id == $mp[$i]->resep_id)
												{
													selected
												}
												@endif
												>{{$resep_a->nama}}</option>
												@endforeach
											</select>
										</div>
										<div class="col-2">
											<input type="text" name="jumlah_mp[]" value="{{$mp[$i]->jumlah}}" class="form-control" placeholder="Jumlah">
										</div>
										<div class="col-1">
											<button type="button" class="btn btn-circle btn-outline-danger mr-5 mb-5 btnRemove">
												<i class="fa fa-trash"></i>
											</button>
										</div>
									</div>
								</div>
								@endfor
								@else
								<div class="form-group">
									<div class="row justify-content-center">
										<div class="col-3 ">
											<select name="makan_pagi[]" class="form-control js-select2" style="width: 100%;" data-size="5">
												<option value="0" selected disabled>Pilih Resep</option>
												@foreach($resep as $resep_a)
												<option value="{{$resep_a->id}}">{{$resep_a->nama}}</option>
												@endforeach
											</select>
										</div>
										<div class="col-2">
											<input type="text" name="jumlah_mp[]" class="form-control" placeholder="Jumlah">
										</div>
										<div class="col-1">
											<button type="button" class="btn btn-circle btn-outline-danger mr-5 mb-5 btnRemove">
												<i class="fa fa-trash"></i>
											</button>
										</div>
									</div>
								</div>
								@endif
								<div class="container-new-form">
								</div>

								<div class="form-group text-center">
									<button type="button" data-id="addmakanpagi" class="btn btn-circle btn-outline-primary mr-5 mb-5 buttonAdd">
										<i class="fa fa-plus"></i>
									</button>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="row mt-20">
					<div class="col-12">
						<div class="text-center"><h6>SNACK PAGI</h6></div>
						<div class="row  justify-content-center">
							<div class="col-3 ">
								<h5 class="font-w400"><small>RESEP MAKANAN</small></h5>
							</div>
							<div class="col-2">
								<h5 class="font-w400"><small>JUMLAH</small></h5>
							</div>
							<div class="col-1">
								<h5 class="font-w400"><small>HAPUS</small></h5>
							</div>
						</div>
						<div class="row">
							<div class="col-12">
								<!-- UNTUK ITEM PERTAMA DELETE DI DISABLED UNTUK ITEM KEDUA DST BISA DELETE -->
								@php $j = count($sp) @endphp
								@if($j > 0)
								@for($i=0; $i<$j ; $i++)	
								<div class="form-group">
									<div class="row justify-content-center">
										<div class="col-3 ">
											<input type="hidden" name="id_sp[]" value="{{$sp[$i]->id}}">
											<select name="snack_pagi[]" class="form-control js-select2" style="width: 100%;" data-size="5">
												<option value="0" disabled>Pilih Resep</option>
												@foreach($resep as $resep_b)
												<option value="{{$resep_b->id}}"
												@if($resep_b->id == $sp[$i]->resep_id)
												{
													selected
												}
												@endif
												>{{$resep_b->nama}}</option>
												@endforeach
											</select>
										</div>
										<div class="col-2">
											<input type="text" name="jumlah_sp[]" value="{{$sp[$i]->jumlah}}" class="form-control" placeholder="Jumlah">
										</div>
										<div class="col-1">
											<button type="button" class="btn btn-circle btn-outline-danger mr-5 mb-5 btnRemove">
												<i class="fa fa-trash"></i>
											</button>
										</div>
									</div>
								</div>
								@endfor
								@else
								<div class="form-group">
									<div class="row justify-content-center">
										<div class="col-3 ">
											<select name="snack_pagi[]" class="form-control js-select2" style="width: 100%;" data-size="5">
												<option value="0" selected disabled>Pilih Resep</option>
												@foreach($resep as $resep_b)
												<option value="{{$resep_b->id}}">{{$resep_b->nama}}</option>
												@endforeach
											</select>
										</div>
										<div class="col-2">
											<input type="text" name="jumlah_sp[]" class="form-control" placeholder="Jumlah">
										</div>
										<div class="col-1">
											<button type="button" class="btn btn-circle btn-outline-danger mr-5 mb-5 btnRemove">
												<i class="fa fa-trash"></i>
											</button>
										</div>
									</div>
								</div>
								@endif
								<div class="container-new-form">
								</div>

								<div class="form-group text-center">
									<button type="button" data-id="addsnackpagi" class="btn btn-circle btn-outline-primary mr-5 mb-5 buttonAdd">
										<i class="fa fa-plus"></i>
									</button>
								</div>
							</div>
						</div>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-12">
						<div class="text-center"><h6>MAKAN SIANG</h6></div>
						<div class="row  justify-content-center">
							<div class="col-3 ">
								<h5 class="font-w400"><small>RESEP MAKANAN</small></h5>
							</div>
							<div class="col-2">
								<h5 class="font-w400"><small>JUMLAH</small></h5>
							</div>
							<div class="col-1">
								<h5 class="font-w400"><small>HAPUS</small></h5>
							</div>
						</div>
						<div class="row">
							<div class="col-12">
								<!-- UNTUK ITEM PERTAMA DELETE DI DISABLED UNTUK ITEM KEDUA DST BISA DELETE -->
								@php $j = count($ms) @endphp
								@if($j > 0)
								@for($i=0; $i<$j ; $i++)
								<div class="form-group">
									<div class="row justify-content-center">
										<div class="col-3 ">
											<input type="hidden" name="id_ms[]" value="{{$ms[$i]->id}}">
											<select name="makan_siang[]" class="form-control js-select2" style="width: 100%;" data-size="5">
												<option value="0" disabled>Pilih Resep</option>
												@foreach($resep as $resep_c)
												<option value="{{$resep_c->id}}"
												@if($resep_c->id == $ms[$i]->resep_id)
												{
													selected
												}
												@endif
												>{{$resep_c->nama}}</option>
												@endforeach
											</select>
										</div>
										<div class="col-2">
											<input type="text" name="jumlah_ms[]" value="{{$ms[$i]->jumlah}}" class="form-control" placeholder="Jumlah">
										</div>
										<div class="col-1">
											<button type="button" class="btn btn-circle btn-outline-danger mr-5 mb-5 btnRemove">
												<i class="fa fa-trash"></i>
											</button>
										</div>
									</div>
								</div>
								@endfor
								@else
								<div class="form-group">
									<div class="row justify-content-center">
										<div class="col-3 ">
											<select name="makan_siang[]" class="form-control js-select2" style="width: 100%;" data-size="5">
												<option value="0" selected disabled>Pilih Resep</option>
												@foreach($resep as $resep_c)
												<option value="{{$resep_c->id}}">{{$resep_c->nama}}</option>
												@endforeach
											</select>
										</div>
										<div class="col-2">
											<input type="text" name="jumlah_ms[]" class="form-control" placeholder="Jumlah">
										</div>
										<div class="col-1">
											<button type="button" class="btn btn-circle btn-outline-danger mr-5 mb-5 btnRemove">
												<i class="fa fa-trash"></i>
											</button>
										</div>
									</div>
								</div>
								@endif
								<div class="container-new-form">
								</div>

								<div class="form-group text-center">
									<button type="button" data-id="addmakansiang" class="btn btn-circle btn-outline-primary mr-5 mb-5 buttonAdd">
										<i class="fa fa-plus"></i>
									</button>
								</div>
							</div>
						</div>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-12">
						<div class="text-center"><h6>MAKAN SORE</h6></div>
						<div class="row  justify-content-center">
							<div class="col-3 ">
								<h5 class="font-w400"><small>RESEP MAKANAN</small></h5>
							</div>
							<div class="col-2">
								<h5 class="font-w400"><small>JUMLAH</small></h5>
							</div>
							<div class="col-1">
								<h5 class="font-w400"><small>HAPUS</small></h5>
							</div>
						</div>
						<div class="row">
							<div class="col-12">
								<!-- UNTUK ITEM PERTAMA DELETE DI DISABLED UNTUK ITEM KEDUA DST BISA DELETE -->
								@php $j = count($msr) @endphp
								@if($j > 0)
								@for($i=0; $i<$j ; $i++)
								<div class="form-group">
									<div class="row justify-content-center">
										<div class="col-3 ">
											<input type="hidden" name="id_msr[]" value="{{$msr[$i]->id}}">
											<select name="makan_sore[]" class="form-control js-select2" style="width: 100%;" data-size="5">
												<option value="0" disabled>Pilih Resep</option>
												@foreach($resep as $resep_d)
												<option value="{{$resep_d->id}}"
												@if($resep_d->id == $msr[$i]->resep_id)
												{
													selected
												}
												@endif
												>{{$resep_d->nama}}</option>
												@endforeach
											</select>
										</div>
										<div class="col-2">
											<input type="text" name="jumlah_msr[]" value="{{$msr[$i]->jumlah}}" class="form-control" placeholder="Jumlah">
										</div>
										<div class="col-1">
											<button type="button" class="btn btn-circle btn-outline-danger mr-5 mb-5 btnRemove">
												<i class="fa fa-trash"></i>
											</button>
										</div>
									</div>
								</div>
								@endfor
								@else
								<div class="form-group">
									<div class="row justify-content-center">
										<div class="col-3 ">
											<select name="makan_sore[]" class="form-control js-select2" style="width: 100%;" data-size="5">
												<option value="0" selected disabled>Pilih Resep</option>
												@foreach($resep as $resep_d)
												<option value="{{$resep_d->id}}">{{$resep_d->nama}}</option>
												@endforeach
											</select>
										</div>
										<div class="col-2">
											<input type="text" name="jumlah_msr[]" class="form-control" placeholder="Jumlah">
										</div>
										<div class="col-1">
											<button type="button" class="btn btn-circle btn-outline-danger mr-5 mb-5 btnRemove">
												<i class="fa fa-trash"></i>
											</button>
										</div>
									</div>
								</div>
								@endif
								<div class="container-new-form">
								</div>
								
								<div class="form-group text-center">
									<button type="button" data-id="addmakansore" class="btn btn-circle btn-outline-primary mr-5 mb-5 buttonAdd">
										<i class="fa fa-plus"></i>
									</button>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row mt-20">
					<div class="col-12">
						<div class="text-center"><h6>SNACK SORE</h6></div>
						<div class="row  justify-content-center">
							<div class="col-3 ">
								<h5 class="font-w400"><small>RESEP MAKANAN</small></h5>
							</div>
							<div class="col-2">
								<h5 class="font-w400"><small>JUMLAH</small></h5>
							</div>
							<div class="col-1">
								<h5 class="font-w400"><small>HAPUS</small></h5>
							</div>
						</div>
						<div class="row">
							<div class="col-12">
								<!-- UNTUK ITEM PERTAMA DELETE DI DISABLED UNTUK ITEM KEDUA DST BISA DELETE -->
								@php $j = count($ss) @endphp
								@if($j > 0)
								@for($i=0; $i<$j ; $i++)
								<div class="form-group">
									<div class="row justify-content-center">
										<div class="col-3 ">
											<input type="hidden" name="id_ss[]" value="{{$ss[$i]->id}}">
											<select name="snack_sore[]" class="form-control js-select2" style="width: 100%;" data-size="5">
												<option value="0" disabled>Pilih Resep</option>
												@foreach($resep as $resep_e)
												<option value="{{$resep_e->id}}"
												@if($resep_e->id == $ss[$i]->resep_id)
												{
													selected
												}
												@endif
												>{{$resep_e->nama}}</option>
												@endforeach
											</select>
										</div>
										<div class="col-2">
											<input type="text" name="jumlah_ss[]" value="{{$ss[$i]->jumlah}}" class="form-control" placeholder="Jumlah">
										</div>
										<div class="col-1">
											<button type="button" class="btn btn-circle btn-outline-danger mr-5 mb-5 btnRemove">
												<i class="fa fa-trash"></i>
											</button>
										</div>
									</div>
								</div>
								@endfor
								@else
								<div class="form-group">
									<div class="row justify-content-center">
										<div class="col-3 ">
											<select name="snack_sore[]" class="form-control js-select2" style="width: 100%;" data-size="5">
												<option value="0" selected disabled>Pilih Resep</option>
												@foreach($resep as $resep_e)
												<option value="{{$resep_e->id}}">{{$resep_e->nama}}</option>
												@endforeach
											</select>
										</div>
										<div class="col-2">
											<input type="text" name="jumlah_ss[]" class="form-control" placeholder="Jumlah">
										</div>
										<div class="col-1">
											<button type="button" class="btn btn-circle btn-outline-danger mr-5 mb-5 btnRemove">
												<i class="fa fa-trash"></i>
											</button>
										</div>
									</div>
								</div>
								@endif
								<div class="container-new-form">
								</div>

								<div class="form-group text-center">
									<button type="button" data-id="addsnacksore" class="btn btn-circle btn-outline-primary mr-5 mb-5 buttonAdd">
										<i class="fa fa-plus"></i>
									</button>
								</div>
							</div>
						</div>
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
<script type="text/javascript">

	// <!--JANGAN LUPA SELECT2 NYA PAKE YANG SEARCH AJAX -->
	$('.buttonAdd').click(function(){

		var a = $(this).data('id');
		content = ''

		content+=	'<div class="form-group">'
		content+=		'<div class="row justify-content-center">'
		content+=			'<div class="col-3 ">'
		content+=				'<select class="form-control js-select2" style="width: 100%;" data-size="5"'
		if(a == 'addmakanpagi')
		{
			content+=					'name="makan_pagi[]"'	
		} 
		else if(a == 'addsnackpagi')
		{
			content+=					'name="snack_pagi[]"'
		} 
		else if(a == 'addmakansiang')
		{
			content+=					'name="makan_siang[]"'
		}
		else if(a == 'addsnacksore')
		{
			content+=					'name="snack_sore[]"'
		}
		else if(a == 'addmakansore')
		{
			content+=					'name="makan_sore[]"'
		}
		content+=					'>'
		content+=					'<option value="0" selected disabled>Pilih Resep</option>'
		content+=					'@foreach($resep as $resep_f)'
		content+=							'<option value="{{$resep_f->id}}">{{$resep_f->nama}}</option>'
		content+=					'@endforeach'
		content+=				'</select>'
		content+=			'</div>'
		content+=			'<div class="col-2">'
		content+=				'<input type="text"'
		if(a == 'addmakanpagi')
		{
			content+=					'name="jumlah_mp[]"'	
		} 
		else if(a == 'addsnackpagi')
		{
			content+=					'name="jumlah_sp[]"'
		} 
		else if(a == 'addmakansiang')
		{
			content+=					'name="jumlah_ms[]"'
		}
		else if(a == 'addsnacksore')
		{
			content+=					'name="jumlah_ss[]"'
		}
		else if(a == 'addmakansore')
		{
			content+=					'name="jumlah_msr[]"'
		}
		content+=				'class="form-control" placeholder="Jumlah">'
		content+=			'</div>'
		content+=			'<div class="col-1">'
		content+=				'<button type="button" class="btn btn-circle btn-outline-danger mr-5 mb-5 btnRemove">'
		content+=					'<i class="fa fa-trash"></i>'
		content+=				'</button>'
		content+=			'</div>'
		content+=		'</div>'
		content+=	'</div>'


		var containerNewForm = $(this).parent().siblings(".container-new-form")
		containerNewForm.append(content);
		$('.js-select2').select2();

	});


	$(document).on('click', '.btnRemove', function() {
		var element = $(this).parent().parent().parent();
		element.remove();

	});
</script>

@endsection