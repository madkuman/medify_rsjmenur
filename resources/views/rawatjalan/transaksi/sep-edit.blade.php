@extends('rawatjalan.layouts.main')

@section('title')
Edit SEP - Transaksi - Rawat Jalan
@endsection

@section('sidebarcomponent')
@include('rawatjalan.components.sidebar')
@endsection

@section('subtitle')
Transaksi
@endsection

@section('css')
@endsection

@section('content')


<main id="main-container">
	@include('rawatjalan.layouts.navbar')
	<div class="container">
		<div class="text-center">
			<h4 class="mb-5">Edit SEP Pasien</h4>
			<h5><small>Ganti SEP Pasien</small></h5>
		</div>
		<form method="POST" action="{{url()->current()}}"> 
			<div class="row justify-content-center row-deck">
				{{csrf_field()}}
				@if(!empty($transaksi->nomor_sep))
				<div class="col-lg-8 col-sm-12">
					<div class="block">
						<div class="block-content">
							<h4 class="mb-10">SEP BPJS</h4>
							<table class="table-borderless" style="width: 60%">
								<tr>
									<th>Nama Pasien</th>
									<td>:</td>
									<td>{{$transaksi->pasien->name}}</td>
								</tr>
								<tr>
									<th>No RM Pasien</th>
									<td>:</td>
									<td>{{$transaksi->pasien->no_rm}}</td>
								</tr>
								<tr>
									<th>Poli Tujuan</th>
									<td>:</td>
									<td>{{$transaksi->poliklinik->name}}</td>
								</tr>
								<tr>
									<th>Nomor SEP Sebelumnya</th>
									<td>:</td>
									<td>{{$transaksi->nomor_sep}}</td>
								</tr>
							</table>

							<div class="py-20 row">
								<div class="form-group col-12">
									<label>Pilih SEP</label>
								</div>
								<div class="form-group input-group col-10" id="sep_select_wrapper">
									<select name="sep" class="form-control js-select2" id="sep_select" data-placeholder="Nomor SEP Pasien" style="width: 80%;">
										<option value=""></option>
										@foreach($sep as $item)
										@if(isset($item->no_sep))
										<option value="{{json_encode($item)}}"
										@if(isset($transaksi->nomor_sep) && $transaksi->nomor_sep == $item->no_sep)
										selected=""
										@endif>
										{{$item->no_sep}} - @if($item->jenis_pelayanan == 1) Rawat Inap @else Rawat Jalan @endif - {{!is_null($item->tgl_sep) ? indonesian_date(strtotime($item->tgl_sep)) : indonesian_date($item->created_at)}}
									</option>
									@endif
									@endforeach
								</select>
								<div class="input-group-append" style="width: 20%;">
									<button type="button" class="btn btn-alt-primary" id="sep_select_refresh">
										<i class="fa fa-refresh"></i>
									</button>
									<button type="button" class="btn btn-alt-primary" style="display: none;" id="sep_select_loading" disabled="">
										<i class="fa fa-asterisk fa-spin"></i>
									</button>
								</div>
							</div>
							<div class="col-8" id="sep_manual_wrapper">
								<div class="form-group input-group">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" class="css-control-input" id="custom_sep_check">
										<span class="css-control-indicator"></span> Nomor SEP yang saya cari tidak terdaftar
									</label>
								</div>
								<div class="form-group"  id="sep_custom_wrapper" style="display: none;">
									<label>Nomor SEP</label>
									<input type="text" name="custom_sep" id="custom_sep" class="form-control" placeholder="Nomor SEP Pasien" value="{{$transaksi->nomor_sep}}">
								</div>
							</div>
							<div class="col-12" id="sep_create_wrapper">
								<button type="button" class="btn btn-info" id="sep_button_auto">
									<i class="fa fa-plus"></i> Buat SEP Otomatis
								</button>
								<button type="button" class="btn btn-outline-info" id="sep_button">
									<i class="fa fa-plus"></i> Buat SEP Manual
								</button>	
							</div>
							<div class="col-12 pt-20">
								<button class="btn btn-hero btn-primary">Simpan</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			@endif
		</div>
	</form>
	<div class="text-center mb-20">
		<a href="{{url('rawatjalan/transaksi/pendaftaran')}}/{{$transaksi->id}}" class="btn btn-secondary">Kembali ke Sebelumnya</a>
	</div>
</div>
</main>
@endsection

@section('js')
<script type="text/javascript">
	
	$('#sep_select_refresh').click(function(){
		$('#sep_select_refresh').hide();
		$('#sep_select_loading').show();
		$.ajax({
			type:'GET',
			url:BASE_URL + 'bpjs/sep/search-pasien/'+{{$transaksi->pasien->id}},
			dataType: 'json',
			success:function(data){
				$('#sep_select_refresh').show();
				$('#sep_select_loading').hide();
				$('#sep_select').empty();
				var option = [];
				option.push({
					id : "",
					text : ""});

				for (var i = 0; i < data.length; i++) {
					var text = data[i].no_sep
					if(data[i].jenis_pelayanan == 1) text += ' - Rawat Inap'
						else text += ' - Rawat Jalan'

							text += ' - ' + moment(data[i].created_at).format('DD MMMM YYYY');
						var nilai = JSON.stringify(data[i]);
						option.push({
							id : nilai,
							text :  text
						});
					}
					$('#sep_select').select2({
						data : option
					})
				},
				error:function(error){
					$('#sep_select_refresh').show();
					$('#sep_select_loading').hide();

				}
			});
	});

	$('#custom_sep_check').click(function() {
		if ($(this).is(':checked')) {
			$('#sep_custom_wrapper').show();
			$('.konfirmasiButton').attr("disabled", true);
			$('#sep_button').attr("disabled", true);
			$('#sep_select').attr("disabled", true);
			$('#sep_select').attr("readonly", true);
			$('#sep_select_refresh').attr("disabled", true);
		}else{
			$('#sep_custom_wrapper').hide();
			$('.konfirmasiButton').attr("disabled", false);
			$('#sep_button').attr("disabled", false);
			$('#sep_select').attr("disabled", false);
			$('#sep_select').attr("readonly", false);
			$('#sep_select_refresh').attr("disabled", false);
		}
	});

	$('#sep_button').on('click', function(e){
		
		popupwindow("{{url('')}}/bpjs/sep/create?window=true&pasien_id={{$transaksi->pasien->id}}&pasien_name={{$transaksi->pasien->name}}&rujukan={{$transaksi->nomor_sep??''}}", "Terbitkan SEP Baru", 900, 900);
	});

	$('#sep_button_auto').on('click', function(){
		var pembayaran_id='{{$transaksi->pasien_pembayaran->id}}'
		var pasien_id= '{{$transaksi->pasien->id}}'
		var poli_id = '{{$transaksi->poliklinik->id}}'
		var type_layanan = 'rawatjalan'


		$('#sep_button_auto').prepend('<i class="fa fa-spinner fa-spin"></i>');    
		$('#sep_button_auto').attr('disabled', true);
		$.ajax({
			type: "GET",
			url: BASE_URL + "bpjs/auto-sep/generate/"+type_layanan+"/" + pasien_id + "/" + pembayaran_id + "/" + poli_id ,
			contentType: false,
			dataType: 'json',
			success: function (resp) {
				if(resp.status == 200)
				{
					callSwal('success','Sukses','Silahkan pilih SEP pada input nomor SEP','');
					$('#sep_button_auto').find(".fa-spinner").remove();  
					refreshSelectSEP(true)
				}
				else if(resp.status == 201)
				{
					callSwal('error','Gagal',resp.message,'');
					$('#sep_button_auto').removeAttr('disabled'); 
					$('#sep_button_auto').find(".fa-spinner").remove();  
				}
				else
				{
					callSwal('error','Gagal','Gagal kesalahan server tidak diketahui. Gunakan SEP Manual','');

					$('#sep_button_auto').removeAttr('disabled')
					$('#sep_button_auto').find(".fa-spinner").remove(); 
				}
			},
			error:function(error){    
				$('#sep_button_auto').removeAttr('disabled');
				$('#sep_button_auto').find(".fa-spinner").remove();  
				callSwal('error','Gagal','Silahkan coba lagi atau Gunakan SEP Manual','');
			}
		});

	});

	function refreshSelectSEP(select_first_value = false){
		$('#infoBPJSWrapper').hide();
		$('#sep_select_refresh').hide();
		$('#sep_select_loading').show();
		var sep_select_first_value = '';
		var pasien_id= '{{$transaksi->pasien->id}}'
		$.ajax({
			type:'GET',
			url:BASE_URL + 'bpjs/sep/search-pasien/'+pasien_id,
			dataType: 'json',
			success:function(data){
				$('#sep_select_refresh').show();
				$('#sep_select_loading').hide();
				$('#sep_select').empty();
				var option = [];
				option.push({
					id : "",
					text : ""});

				for (var i = 0; i < data.length; i++) {
					var nilai = JSON.stringify(data[i]);
					option.push({
						id : nilai,
						text :  data[i].no_sep
					});
					if(i == 0) sep_select_first_value = nilai;
				}
				$('#sep_select').select2({
					data : option
				})

				if(select_first_value) {
					$('#sep_select').val(sep_select_first_value).trigger('change')
					var sep = JSON.parse($('#sep_select').val());
					preview_sep(sep);
				}
			},
			error:function(error){
				$('#sep_select_refresh').show();
				$('#sep_select_loading').hide();

			}
		});
	}

</script>
@endsection