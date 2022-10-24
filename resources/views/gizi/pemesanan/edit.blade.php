@extends('gizi.layouts.index')

@section('title')
Medify - Gizi Edit Pemesanan
@endsection

@section('css')
<link rel="stylesheet" href="{{asset('assets/js/plugins/datatables/dataTables.bootstrap4.min.css')}}">
@endsection

@section('content')
<div class="content">
	<div class="block p-10">
		<div class="block-header">
			<h3 class="block-title">
				Edit Pesanan
			</h3>
		</div>
		<div class="block-content">
			<form action="{{url('gizi/pemesanan/simpan')}}" method="POST">
			{{csrf_field()}}
			<input type="hidden" name="pemesanan_id" value="{{$data['pesanan']->id}}">
			<div class="row">
				<div class="col-6">
					<div class="form-group">
						<label>Pasien</label>
						<select name="pasien" id="select-pasien" class="form-control js-select2" style="width: 100%;" 
						data-size="5" required="true" name="pasien_id">   
						@if(!empty($data['pasien']))
							<option value="{{$data['pasien']->id}}" selected>{{$data['pasien']->name}}</option>
						</select>
						<input type="hidden" name="kasus_id" value="{{$data['pesanan']->kasus_id}}">
						@else
							<option value="" selected disabled>Pilih Pasien</option>
							<option value=""></option>
						@endif
					</div>
					<div class="form-group">
						<label>Kasus Pasien</label>
						<select name="kasus_id" id="select-kasus" class="form-control js-select2" 
						style="width: 100%;" data-size="5" required="true">   
							@if(!empty($data['pesanan']))
							<option value="{{$data['pesanan']->kasus_id}}" selected>
							{{$data['pesanan']->kasus->lokasi->lokasi->nama}} - (Kelas {{$data['pesanan']->kasus->kelas->nama}}) - {{$data['pesanan']->kasus->judul_kasus}}
							</option>
							@else
							<option value="" selected disabled>Pilih Pasien</option>
							<option value=""></option>
							@endif
						</select>
					</div>
					<div class="form-group">
						<label>Kelas</label>
						<select name="kelas" id="select-kelas" class="form-control js-select2" style="width: 100%;" 
						data-size="2" required="true" name="diet_id">   
							<option value="" selected disabled>Pilih Kelas</option>
							<option value="{{$data['pesanan']->kelas_id}}" selected>{{$data['pesanan']->kelas->nama}}</option>
							@php $j = count($data['kelas']) @endphp
							@for($i=0;$i<$j;$i++)
							<option value="{{$data['kelas'][$i]->id}}">{{$data['kelas'][$i]->nama}}</option>
							@endfor
						</select>
					</div>
					<div class="form-group">
						<label>Jenis Makanan</label>
						 <span id="loader-jenismakanan" class="fa fa-2x fa-cog fa-spin text-primary text-center loader" style="display: none;"></span>
						<select name="jenis_makanan" id="select-jenismakanan" class="form-control js-select2" style="width: 100%;" 
						data-size="5" required="true" onchange="getKategori()">
						<option value="{{$data['jenis_makanan_pesan']->id}}" selected>{{$data['jenis_makanan_pesan']->nama}}</option>
						@foreach($data['JenisMakanan'] as $JM)
						<option value="{{$JM->id}}" data-flag-pesan="{{$JM->flag_pesan}}">{{$JM->nama}}</option>
						@endforeach
						<option value="" disabled>Pilih Jenis</option>
					</select>
					</div>
					<div class="form-group" id="kategori-makanan">
						<label>Kategori Makanan</label>
						<span id="loader-kategorimakanan" class="fa fa-2x fa-cog fa-spin text-primary text-center loader" style="display: none;"></span>
						<select name="kategori_makanan" id="select-kategorimakanan" class="form-control js-select2" style="width: 100%;" 
						data-size="5" required="true" onchange="kodeDiet()">
						<option value="{{$data['pesanan']->diet_kode? $data['pesanan']->diet_kode->kategori_makanan->id : ''}}" selected>{{$data['pesanan']->diet_kode?$data['pesanan']->diet_kode->kategori_makanan->nama:''}}</option>
						<option value="" disabled>Pilih Jenis</option>
					</select>
					</div>
					<div class="form-group" id="diet">
						<label>Diet</label>
						<span id="loader-diet" class="fa fa-2x fa-cog fa-spin text-primary text-center loader" style="display: none;"></span>
						<select name="diet" id="select-diet" class="form-control js-select2" style="width: 100%;" 
						data-size="5" required="true" onchange="getBentuk()">
						<option value="{{$data['pesanan']->diet_kode?$data['pesanan']->diet_kode->diet->id:''}}" selected>{{$data['pesanan']->diet_kode?$data['pesanan']->diet_kode->diet->nama:''}}</option>
						<option value="" disabled>Pilih Jenis</option>
						</select>
					</div>
					<div class="form-group" id="bentuk-makanan">
						<label>Bentuk Makanan</label>
						<span id="loader-bentukmakanan" class="fa fa-2x fa-cog fa-spin text-primary text-center loader" style="display: none;"></span>
						<select name="bentuk_makanan" id="select-bentukmakanan" class="form-control js-select2" style="width: 100%;" 
						data-size="5" required="true" onchange="kodeDiet(1)">
						<option value="{{$data['pesanan']->diet_kode?$data['pesanan']->diet_kode->bentuk_makanan->id:''}}" selected>{{$data['pesanan']->diet_kode?$data['pesanan']->diet_kode->bentuk_makanan->nama:''}}</option>
							<option value="" disabled>Pilih Jenis</option>
						</select>
					</div>
					<div class="form-group tambahan-kelas">
						<label>Kode Diet</label>
						<span id="loader-kodediet" class="fa fa-2x fa-cog fa-spin text-primary text-center loader" style="display: none;"></span>
						<select name="kode_diet" id="select-kodediet" class="form-control js-select2" style="width: 100%;"
								data-size="5" required>
							<option value="{{$data['pesanan']->diet_kode?$data['pesanan']->diet_kode->id:''}}" selected>{{$data['pesanan']->diet_kode?$data['pesanan']->diet_kode->nama:''}}</option>
						</select>
					</div>
					<div class="form-group row" style="display:none;" id="ukuran-makanan">
					<label>Ukuran Makanan</label>
						<div class="col-md-5">
							<input class="form-control" type="number" name="ukuran1" value="@if(!empty($data['pesanan']->ukuran1)){{$data['pesanan']->ukuran1}}@endif">
						</div>
						<div class="col-sm-1" style="padding-top:8px;">X</div>
						<div class="col-md-5">
							<input class="form-control" type="number" name="ukuran2" value="@if(!empty($data['pesanan']->ukuran2)){{$data['pesanan']->ukuran2}}@endif">
						</div>
					</div>
					<div class="form-group" id="menu-makan-tambahan">
						<div class="custom-control custom-checkbox mt-5">
							<input class="custom-control-input" type="checkbox" name="menu_tambahan" id="filter-vip" value="1"
							@if(!empty($data['pesanan']->menu_tambahan_id)) checked @endif>
							<label class="custom-control-label" for="filter-vip">Pesan Menu Tambahan</label>
						</div>
					</div>
					<div class="form-group tambahan-rg"@if(empty($data['pesanan']->rg))style="display: none;"@endif>
						<div class="custom-control custom-checkbox mt-5">
							<input class="custom-control-input" type="checkbox" name="rg" id="rg" value="1" onchange="kodeDiet(1)"
							@if(!empty($data['pesanan']->rg)) checked @endif>
							<label class="custom-control-label" for="rg">Rendah Garam</label>
						</div>
					</div>
					<div class="form-group tambahan-lc"@if(empty($data['pesanan']->lc))style="display: none;"@endif>
						<div class="custom-control custom-checkbox mt-5">
							<input class="custom-control-input" type="checkbox" name="lc" id="lc" value="1" onchange="kodeDiet(1)"
							@if(!empty($data['pesanan']->lc)) checked @endif>
							<label class="custom-control-label" for="lc">Lauk Cincang</label>
						</div>
					</div>
					<div class="form-group tambahan-ptg" @if(empty($data['pesanan']->ptg))style="display: none;"@endif>
						<div class="custom-control custom-checkbox mt-5">
							<input class="custom-control-input" type="checkbox" name="pantang" id="pantang" value="1" onchange="kodeDiet(1)"
								   @if(!empty($data['pesanan']->ptg)) checked @endif>
							<label class="custom-control-label" for="pantang">Pantang</label>
						</div>
					</div>
					<hr>
					<div class="form-group">
						<label>Jadwal Pengantaran</label>
						<input type="text" class="js-datepicker form-control" id="filter-tanggal" name="tanggal" 
						data-week-start="1" data-autoclose="true" data-today-highlight="true" 
						data-date-format="dd-mm-yyyy" autocomplete="off" placeholder="Pilih Tanggal" 
						value="{{$data['pesanan']->format_tanggal()}}" required>
					</div>
					<hr>
					<div class="form-group" id="waktu-makan">
						<label>WAKTU MAKANAN & MAKANAN POKOK</label>
						<br><br>
						<div class="row">
							<div class="col-1 pt-5">
								<div class="custom-control custom-checkbox mt-5">
									<input class="custom-control-input" type="checkbox" name="waktu_pagi" id="waktu_pagi" value="1"
									@if(in_array('1',$data['pesanan']->cek_waktu_makan()['waktu']))
									checked
									@endif
									>
									<label class="custom-control-label" for="waktu_pagi"></label>
								</div>
							</div>
							<div class="col-4">
								<input type="text" class="form-control" value="Pagi" disabled="">
							</div>
						</div>
						
						<div class="row mt-10">
							<div class="col-1 pt-5">
								<div class="custom-control custom-checkbox mt-5">
									<input class="custom-control-input" type="checkbox" name="waktu_siang" id="waktu_siang" value="1" 
									@if(in_array('2',$data['pesanan']->cek_waktu_makan()['waktu']))
									checked
									@endif
									>
									<label class="custom-control-label" for="waktu_siang"></label>
								</div>
							</div>
							<div class="col-4">
								<input type="text" class="form-control" value="Siang" disabled="">
							</div>
						</div>
						<div class="row mt-10">
							<div class="col-1 pt-5">
								<div class="custom-control custom-checkbox mt-5">
									<input class="custom-control-input" type="checkbox" name="waktu_sore" id="waktu_sore" value="1" 
									@if(in_array('3',$data['pesanan']->cek_waktu_makan()['waktu']))
									checked
									@endif
									>
									<label class="custom-control-label" for="waktu_sore"></label>
								</div>
							</div>
							<div class="col-4">
								<input type="text" class="form-control" value="Sore" disabled="">
							</div>
						</div>
						<div class="row mt-10">
							<div class="col-1 pt-5">
								<div class="custom-control custom-checkbox mt-5">
									<input class="custom-control-input" type="checkbox" name="snack_pagi" id="snack_pagi" value="1" 
									@if(in_array('4',$data['pesanan']->cek_waktu_makan()['waktu']))
									checked
									@endif
									>
									<label class="custom-control-label" for="snack_pagi"></label>
								</div>
							</div>
							<div class="col-4">
								<input type="text" class="form-control" value="Snack Pagi" disabled="">
							</div>
						</div>
						<div class="row mt-10">
							<div class="col-1 pt-5">
								<div class="custom-control custom-checkbox mt-5">
									<input class="custom-control-input" type="checkbox" name="snack_sore" id="snack_sore" value="1" 
									@if(in_array('5',$data['pesanan']->cek_waktu_makan()['waktu']))
									checked
									@endif
									>
									<label class="custom-control-label" for="snack_sore"></label>
								</div>
							</div>
							<div class="col-4">
								<input type="text" class="form-control" value="Snack Sore" disabled="">
							</div>
						</div>
					</div>
					<div class="form-group">
						<label>Catatan</label>
						<textarea class="form-control" placeholder="Catatan" name="catatan">{{$data['pesanan']->catatan}}</textarea>
					</div>
					<div class="form-group">
						<button class="btn btn-hero btn-success btn-lg pull-left">Simpan</button>
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
	$(document).ready(function(){
		var makanan_cair = {{$data['pesanan']->diet_kode?$data['pesanan']->diet_kode->jenis_makanan->id:''}};
		var flag = '{{$data['pesanan']->diet_kode?$data['pesanan']->diet_kode->diet->cair:''}}';
		if(makanan_cair == 4 || flag == '1')
		{
			$('#ukuran-makanan').show();
		}
	});
	

</script>
<script type="text/javascript">
	function getKategori() {
		$('.tambahan-rg').hide();
		$('.tambahan-lc').hide();
		$('.tambahan-ptg').hide();
		var jenis_makanan=$('#select-jenismakanan').val();
		var jenis_makanan_pesan=$('#select-jenismakanan').select2().find(":selected").data("flag-pesan");
		if(jenis_makanan!=null){
			if(jenis_makanan_pesan != 1) {
				$('#kategori-makanan').hide();
				$('#diet').hide();
				$('#bentuk-makanan').hide();
				$('.tambahan-kelas').hide();
				$('#ukuran-makanan').hide();
				$('#waktu-makan').hide();
				$('#menu-makan-tambahan').hide();
			}
			else {
				$('#waktu-makan').show();
				$('#menu-makan-tambahan').show();
				$.ajax({
					type: "POST",
					url: API_URL + "/gizi/pemesanan/getKategoriMakanan",
					dataType: "json",
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					data: {
						jenis_makanan: jenis_makanan,
					},
					beforeSend: function () {
						$('#loader-kategorimakanan').css('display', 'block');
						$('#kategori-makanan').show();
					},
					success: function (data) {
						var option = [];
						if (jenis_makanan == 1 || jenis_makanan == 2) {
							option.push({
								id: data[0].id,
								flag: data[0].cair,
								text: data[0].nama,
							});
							$("#select-kategorimakanan").html('').select2();
							$('#select-kategorimakanan').select2({
								data: option
							});
							$('#select-kategorimakanan').prop('disabled', false);
							getDiet();
						}
						if (jenis_makanan == 4) {
							option.push({
								id: data[1].id,
								flag: data[1].cair,
								text: data[1].nama,
							});
							option.push({
								id: data[2].id,
								flag: data[2].cair,
								text: data[2].nama,
							});
							$("#select-kategorimakanan").html('').select2();
							$('#select-kategorimakanan').select2({
								data: option
							});
							$('#select-kategorimakanan').prop('disabled', false);
							getDiet();
						}
						if (jenis_makanan == 3) {
							$("#select-kategorimakanan").html('').select2();
							$('#select-kategorimakanan').prop('disabled', true);
							$('#kategori-makanan').hide();
							getDiet();
						}
					},
					complete: function () {
						$('#loader-kategorimakanan').css('display', 'none');
					}
				});
			}
			}
	}
	function getDiet(kategori_makanan=null)
	{
		$('.tambahan-rg').hide();
		$('.tambahan-lc').hide();
		$('.tambahan-ptg').hide();
		var jenis_makanan = $('#select-jenismakanan').val();
		var kategori_makanan = kategori_makanan;
		if(jenis_makanan != null)
		{
			$.ajax({
				type: "POST",
				url: API_URL + "/gizi/pemesanan/getDietPasien",
				dataType: "json",
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				data: {
					jenis_makanan : jenis_makanan,
					kategori_makanan : kategori_makanan
				},
				beforeSend: function(data){
					$('#loader-diet').css('display', 'block');
					$('#kategori-makanan').show();
					$('#diet').show();
				},
				success: function (data) {
					//console.log(data);
					var option = [];
					option.push({
						id: '',
						text: '',
						flag: '',
					});
					//console.log(data)
					// alert(data[0].tipe.name);
					for (i in data) {
						option.push({
							flag: data[i].cair,
							id: data[i].id,
							text: data[i].nama,
						});
					}
					$("#select-diet").html('').select2();
					$('#select-diet').select2({
						data: option
					});
					$('#select-diet').prop('disabled', false);
					getBentuk();
				},
				complete: function(){
					$('#loader-diet').css('display', 'none');
				}
			});
			if(kategori_makanan == null)
			{
				if(jenis_makanan == 4)
				{
					$('#ukuran-makanan').show();
					$('#judul-ukuran').show()
				}
				else
				{
					$('#ukuran-makanan').hide();
					$('#judul-ukuran').hide()
				}
			}
		}
		if(kategori_makanan == null)
		{
			kodeDiet();
		}
		else
		{
			kodeDiet(1);
		}

	}
	function getBentuk()
	{
		var diet = $('#select-diet').val();
		$('.tambahan-rg').css('display', 'none');
		$('.tambahan-lc').css('display', 'none');
		$('.tambahan-ptg').css('display', 'none');
		if ($('#rg').is(':checked')) {
		document.getElementById("rg").checked = false;
		}
		if ($('#lc').is(':checked')) {
		document.getElementById("lc").checked = false;
		}
		if ($('#ptg').is(':checked')) {
			document.getElementById("ptg").checked = false;
		}
		if(diet!= null)
		{
			$.ajax({
				type: "POST",
				url: API_URL + "/gizi/pemesanan/getBentukMakanan",
				dataType: "json",
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				data: {
					diet : diet
				},
				beforeSend: function(){
					$('#loader-bentukmakanan').css('display', 'block');
					$('#bentuk-makanan').show();
					$('.tambahan-rg').css('display', 'block');
					$('.tambahan-lc').css('display', 'block');
					$('.tambahan-ptg').css('display', 'block');
					if ($('#rg').is(':checked')) {
					document.getElementById("rg").checked = false;
					}
					if ($('#lc').is(':checked')) {
					document.getElementById("lc").checked = false;
					}
					if ($('#ptg').is(':checked')) {
					document.getElementById("ptg").checked = false;
					}
				},
				success: function (data) {
					var option = [];
					option.push({
						id: '',
						text: '',
					});
					// alert(data[0].tipe.name);
					for (i in data) {
						option.push({
							id: data[i].id,
							text: data[i].nama,
						});
					}
					$("#select-bentukmakanan").html('').select2();
					$('#select-bentukmakanan').select2({
						data: option
					});
					$('#select-bentukmakanan').prop('disabled', false);
				},
				complete: function(){
					$('#loader-bentukmakanan').css('display', 'none');
				}
			});
		}
		kodeDiet(1);
	}
	function kodeDiet(checkpoint = null) //checkpoint kalau dia dari kategori makanan formula rs atau komersil
	{
		$('.tambahan-rg').hide();
		$('.tambahan-lc').hide();
		$('.tambahan-ptg').hide();
		var jenis_makanan = $('#select-jenismakanan').val();
		var kategori_makanan = $('#select-kategorimakanan').val();
		var diet = $('#select-diet').val();
		var flag = $('#select-diet').select2('data')[0].flag;
		var bentuk_makanan = $('#select-bentukmakanan').val();
		if(checkpoint == null)
		{
			if(kategori_makanan == 3 || kategori_makanan == 4)
			{
				getDiet(kategori_makanan);
			}
		}
		// console.log(jenis_makanan,kategori_makanan,diet,flag,bentuk_makanan);
		if ($('#rg').is(':checked')) {
			var rg = 1;
			$('.tambahan-rg').show();
		} else {
			var rg = 0;
		}
		if ($('#lc').is(':checked')) {
			var lc = 1;
			$('.tambahan-lc').show();
		} else {
			var lc = 0;
		}
		if ($('#pantang').is(':checked')) {
			var ptg = 1;
			$('.tambahan-ptg').show();
		} else {
			var ptg = 0;
		}

		if(jenis_makanan == null  || diet == null || diet == '')
		{
			//console.log('keluar kamu');
			//$('#ukuran-makanan').hide();
			return;
		}
		else
		{
			$.ajax({
				type: "POST",
				url: API_URL + "/gizi/pemesanan/getKodeDietPasien",
				dataType: "json",
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				data: {
					jenis_makanan : jenis_makanan,
					kategori_makanan : kategori_makanan,
					diet : diet,
					bentuk_makanan : bentuk_makanan,
					rg : rg,
					lc : lc,
					ptg : ptg,
				},
				beforeSend: function(){
					$('#loader-kodediet').css('display', 'block');
					$('.tambahan-kelas').show();
				},
				success: function (data) {
					console.log(data);
					var option = [];
					// 	if(data == null)
					// 	{
					// 		$('#kode_diet').addClass('bg-danger').removeClass('bg-info');
					// 		$('#kode_diet').text('Kode Diet Tidak Ditemukan');
					// 		$('#button_simpan').prop('disabled',true);
					// 	}
					// 	else
					// 	{
					// 		$('#kode_diet').addClass('bg-info').removeClass('bg-danger');
					// 		$('#kode_diet').text(data.nama);
					// 		$('#button_simpan').prop('disabled',false);
					// 	}
					for(i in data){
						if(data[i].is_rg ==1){
							$('.tambahan-rg').show();
						}
						if(data[i].is_lc ==1){
							$('.tambahan-lc').show();
						}
						if(data[i].is_ptg ==1){
							$('.tambahan-ptg').show();
						}
					}
					option.push({
						id: '',
						text: '',
					});
					// alert(data[0].tipe.name);
					for (i in data) {
						if(data[i].is_rg==rg&&data[i].is_lc==lc&&data[i].is_ptg==ptg) {
							option.push({
								id: data[i].id,
								text: data[i].nama,
							});
						}
						if(data[i].bentuk_makanan_id==null){
							$("#select-bentukmakanan").html('').select2();
							$('#select-bentukmakanan').prop('disabled', true);
							$('#bentuk-makanan').hide();
						}
					}

					$('#select-kodediet').html('').select2();
					$('#select-kodediet').select2({
						data: option
					});
					if(kategori_makanan!=4) {
						$('#select-kodediet').prop('disabled', false);
					}
					else{
						$('#tambahan-kelas').hide();
					}
				},
				complete: function(){
					$('#loader-kodediet').css('display', 'none');
				}
			});
			if(flag != null || jenis_makanan == 4)
			{
				$('#ukuran-makanan').show();
				$('#judul-ukuran').show()
			}
			else
			{
				$('#ukuran-makanan').hide();
				$('#judul-ukuran').hide()
			}
		}

	}
</script>
<script type="text/javascript">
	
$('#select-pasien').select2({
           ajax: {
               url: API_URL+"/pasien/get",
               dataType: 'json',
               delay: 250,
               data: function (params)
               {
                   return {
                       keyword: params.term,
                       page: params.page
                   };
               },
               processResults: function (data, params) {
                   params.page = params.page || 1;
                   return {
                       results: data.data,
                   };
               },
               cache: true
           },
           escapeMarkup: function (markup) { return markup; },
           minimumInputLength: 3,
           placeholder: "Cari Pasien",
           templateResult: formatPasien,
           templateSelection: formatPasienSelection
       });

function formatPasien (item) {
           if (item.loading) {
               return item.text;
           }

           var markup = item.name;

           return markup;
       }

       function formatPasienSelection (item) {
           if(item.name) return item.name;
           else return item.text;
       }


$('#select-pasien').on('select2:select', function (e) {
	var data = e.params.data;
	// alert(data.id)
	$.ajax({
		type: "POST",
		url: API_URL + "/gizi/pemesanan/getPembayaranPasien",
		dataType: "json",
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		data: {
			id : data.id
		},
		success: function (data) {
			var option = [];
			option.push({
				id: '',
				text: '',
			});
			console.log(data)
			// alert(data[0].tipe.name);
			for (i in data) {
				option.push({
					id: data[i].id,
					text: data[i].perusahaan.nama,
				});
			}
			$('#pasien-pembayaran').select2({
				data: option
			})
		}
	});
})

$(document).ready(function(){
    $("#select-pasien").change(function(){
      var pasien_id = $(this).val();
      $.ajax({
        url: API_URL + '/pasien/'+pasien_id+'/kasus',
        dataType: 'json',
        success: function(data){
          console.log(data)
          var kasus_current = $('#select-kasus').val();
          var option = [];

          for (i in data) {
            if(kasus_current != data[i].id)
            {
              option.push({
                id: data[i].id,
                text: data[i].lokasi +' - (Kelas '+data[i].kelas+') - '+data[i].judul_kasus,
              });
            }
          }
          $('#select-kasus').html('').select2({
            data: option
          })
        }
      });
   	});
});

$('#pasien-pembayaran').select2();

$('#pasien-pembayaran').on('select2:select', function (e) {
	var data = e.params.data;
	document.getElementById("perusahaan").value = data.perusahaan_keuangan_id;
})

</script>
@endsection