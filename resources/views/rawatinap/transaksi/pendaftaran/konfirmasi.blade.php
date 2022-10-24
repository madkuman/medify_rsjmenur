@extends('rawatinap.layouts.main')

@section('title')
Pendaftaran Pasien ke Rawat Inap- Rawat Jalan - Medify
@endsection

@section('subtitle')
Pendaftaran Pasien ke Rawat Inap
@endsection

@section('content')

<main id="main-container">
	@include('rawatinap.layouts.navbar')
	<div class="container">
		<div class="row">
			<div class="col-xl-12 text-center py-20">
				<h3 class="mb-5">Konfirmasi Pendaftaran Rawat Inap</h3>
				<h5 class="text-muted font-w400">Pendaftaran Pasien ke Rawat Inap</h5>
				<button type="button" class="btn btn-outline-primary" onclick="konfirmasiPrint(1)">
					<span><i class="fa fa-print mr-5"></i>Print</span>
				</button>
			</div>
		</div>
		<div class="row row-deck justify-content-center">
			<div class="col-md-3">
				<div class="block text-center" href="javascript:void(0)">
					<div class="block-content block-content-full block-content-sm bg-pulse">
						<span class="font-w600 text-white">Pasien</span>
					</div>
					<div class="block-content block-content-full bg-pulse-lighter">
						<img class="img-avatar img-avatar-thumb" src="{{asset($pasien->photo_thumb)}}" alt="">
					</div>
					<div class="block-content">
						<h4 class="mb-5">{{$pasien->name}}</h4>
						<h6 class="font-w400">
							@if($pasien->gender == 1) Laki laki
							@else Perempuan
							@endif, {{$pasien->age}}
						</h6>
						<ul class="list-unstyled text-left">
							<li><i class="fa fa-address-card mr-5" data-toggle="tooltip" data-placement="top" title="Nomor Rekam Medis">
								
							</i> {{$pasien->no_rm}}</li>
							<li><i class="fa fa-map-pin mr-10" data-toggle="tooltip" data-placement="top" title="Alamat"></i> {{$pasien->address}}</li>
						</ul>
					</div>
				</div>
			</div>

			<div class="col-md-3">
				<div class="block block-link-pop text-center" href="javascript:void()">
					<div class="block-content block-content-full block-content-sm bg-primary text-white font-w600">
						Ruangan Rawat Inap
					</div>

					
					<div class="block-content text-left">
						<div class="form-group">
							<label class="font-w400">Bangsal</label><br>
							<h4>{{$bed->ruangan->bangsal->nama}}</h4>
						</div>
						<div class="form-group">
							<label class="font-w400">Ruangan</label><br>
							<h4>{{$bed->ruangan->nama}}</h4>
						</div>
						<div class="form-group">
							<label class="font-w400">Bed</label><br>
							<h4>{{$bed->nama}}</h4>
						</div>
					</div>
				</div>
			</div>
			@if(!empty($kasus->pembayaran->perusahaan->tipe->slug == 'bpjs') && $transaksi->is_pindah == 0)
			<div class="col-md-3">
				<div class="block block-link-pop text-center" href="javascript:void()">
					<div class="block-content block-content-full block-content-sm bg-success text-white font-w600">
						SEP Rawat Inap Pasien
					</div>
					<div class="block-content px-3">
						<div class="row no-gutters text-left">
							<div id="sep_preview_wrapper" class="col-12" @if(empty($kasus->sep) || $kasus->sep->jenis_pelayanan != 1) style="display:none;" @endif>
								<div class="row">
									<div class="col-12">
										<div class="font-w600 ">Nomor SEP</div>
									</div>
									<div class="col-12 mb-10" id="no_sep_preview"> 
										@if(!empty($kasus->sep) && $kasus->sep->jenis_pelayanan == 1)
										{{$kasus->sep->no_sep}}
										@endif
									</div>
									<div class="col-12">
										<div class="font-w600 ">Nomor Kartu BPJS</div>
									</div>
									<div class="col-12 mb-10" id="no_kartu_preview">
										@if(!empty($kasus->sep) && $kasus->sep->jenis_pelayanan == 1)
										{{$kasus->sep->no_bpjs}}
										@endif
									</div>
									<div class="col-12">
										<div class="font-w600 ">Tanggal SEP</div>
									</div>
									<div class="col-12 mb-10" id="tanggal_preview">
										@if(!empty($kasus->sep) && $kasus->sep->jenis_pelayanan == 1)
										{{implode("-", array_reverse(explode("-", $kasus->sep->tgl_sep)))}}
										@endif
									</div>
									<div class="col-12">
										<div class="font-w600">Jenis Perawatan</div>
									</div>
									<div class="col-12 mb-10" id="jenis_preview">
										@if(!empty($kasus->sep) && $kasus->sep->jenis_pelayanan == 1)
										Rawat Inap
										@else
										Rawat Jalan
										@endif
									</div>
									<div class="col-12">
										<div class="font-w600">Kelas Rawat BPJS</div>
									</div>
									<div class="col-12 mb-10" id="kelas_preview">
										@if(!empty($kasus->sep) && $kasus->sep->jenis_pelayanan == 1)
										Kelas {{$kasus->sep->kelas_rawat}}
										@endif
									</div>
									<div class="col-12">
										<div class="font-w600">Dokter DPJP</div>
									</div>
									<div class="col-12 mb-10" id="dpjp_preview">

									</div>
								</div>
							</div>

			            	<div class="col-12 text-center  mb-20" id="sep_kosong_wrapper"

	                    	@if(!empty($kasus->sep) && $kasus->sep->jenis_pelayanan == 1)
	                    	style="display:none;"
							@endif
			            	>
			                    <span class="font-w600 text-danger">
			                        Pasien belum terdaftar dengan SEP rawat inap
			                    </span>    
			                </div>

			                <div class="form-group input-group col-12" id="sep_select_wrapper">
			                	<select name="sep" class="form-control js-select2" id="sep_select" data-placeholder="Nomor SEP Pasien" style="width: 80%;">
								    <option value=""></option>
								    @foreach($sep as $item)
									    @if(isset($item->no_sep) && $item->jenis_pelayanan == 1)
									    <option value="{{json_encode($item)}}"
									    @if($kasus->pembayaran->perusahaan->tipe->slug == 'bpjs' && isset($kasus->sep_id) && $kasus->sep_id == $item->id)
									    selected=""
									    @endif>
									    	{{$item->no_sep}}
									    </option>
									    @endif
								    @endforeach
								</select>
								<div class="input-group-append" style="width: 20%;">
									<button type="button" class="btn btn-alt-primary" id="sep_select_refresh" data-tanggal-start="{{date('d-m-Y',strtotime("-3 months"))}}" data-tanggal-end="{{date('d-m-Y')}}" data-ppk="{{config('app.bpjs_ppk')}}" data-no-kartu="{{$kasus->pembayaran->no_asuransi ?? ''}}">
										<i class="fa fa-refresh"></i>
									</button>
									<button type="button" class="btn btn-alt-primary" style="display: none;" id="sep_select_loading" disabled="">
										<i class="fa fa-asterisk fa-spin"></i>
									</button>
							    </div>
			                </div>
			            	<div class="col-12 text-center" id="sep_manual_wrapper">
								<div class="form-group input-group">
									<label class="css-control css-control-primary css-checkbox">
								        <input type="checkbox" class="css-control-input" id="custom_sep_check">
								        <span class="css-control-indicator"></span> Gunakan SEP Manual
								    </label>
								</div>
								<div class="form-group input-group"  id="sep_custom_wrapper" style="display: none;">
									<input type="text" name="custom_sep" id="custom_sep" class="form-control" placeholder="Nomor SEP Pasien">
							        <button type="button" class="btn btn-alt-primary" id="sep_custom_send">
										<i class="fa fa-send"></i>
									</button>
									<button type="button" class="btn btn-alt-primary" style="display: none;" id="sep_custom_loading" disabled="">
										<i class="fa fa-asterisk fa-spin"></i>
									</button>
								</div>
			                </div>
			                <div class="col-12 text-center" id="sep_create_wrapper">
								@if (!config('medify.third-party.vclaim.on_v2'))
									<button type="button" class="btn btn-success mb-10" id="sep_button_auto">
										<i class="fa fa-plus"></i> Buat SEP Otomatis
									</button>
								@endif
								<button type="button" class="btn btn-outline-success" id="sep_button">
									<i class="fa fa-plus"></i> Buat SEP Manual
								</button>	
			                </div>
			            </div>
					</div>
				</div>
			</div>
			@endif
		</div>
		<div class="row">
			<div class="col-12 error-ranap-content pt-50">
				<div class="py-10 text-center font-w600 bg-danger text-white align-middle my-5" id="error-wrapper-ranap" style="display: none;">
					<i class="fa fa-exclamation-circle mr-5"></i>
					<span></span>
				</div>
			</div>
		</div>
	</div>
</main>


<div class="row mb-100">
	<div class="col-12 text-center mb-10">
		<label class="css-control css-control-primary css-checkbox div-override-checkbox peringatan-baca" style="display: none">
			<input type="checkbox" class="override-checkbox css-control-input peringatan-baca-checkbox">
			<span class="css-control-indicator"></span> <strong>Saya sudah membaca peringatan</strong>
		</label>
	</div>
	<div class="col-md-12 text-center">
		<form method="POST" action="{{url('rawatinap/transaksi/pendaftaran/submit')}}" class="text-center">
			{{csrf_field()}}
			<input type="hidden" name="transaksi_id" value="{{$transaksi->id}}">
			<input type="hidden" name="bed_id" value="{{$bed->id}}">
			<input type="hidden" name="is_booking" value="{{$booking}}">
			<input type="hidden" name="nomor_kasus" value="{{$nomor_kasus}}">
			<input type="hidden" name="readmisi" value="0">
			<input type="hidden" name="beda_kelas" value="0">
			<input type="hidden" id="no_sep_hidden" name="no_sep" 
		  	@if($kasus->pembayaran->perusahaan->tipe->slug == 'bpjs' && isset($kasus->sep_id))
			value="{{$kasus->sep->no_sep ?? ''}}"
			@else
			value=""
			@endif
			>
			<input type="hidden" name="tempat_tidur_bayi" id="tempat_tidur_bayi" value="0">
			<button type="button" class="btn btn-outline-danger btn-fill btn-hero mr-10 full-only" id="batal-antri">
				<i class="fa fa-trash-o" aria-hidden="true"></i> Batal
			</button>
			<button  class="konfirmasiButton btn btn-primary btn-hero ml-10 btn-click-animate full-only"
			@if($kasus->pembayaran->perusahaan->tipe->slug == 'bpjs' &&  isset($kasus->sep) && $kasus->sep->jenis_pelayanan != 1  && $transaksi->is_pindah == 0)
			disabled=""
			@endif>
				<i class="fa fa-check"></i> Konfirmasi
			</button>


			<div class="mobile-block px-15">
				<button type="button" class="btn btn-outline-danger btn-fill btn-hero mr-10" style="width: 100%; margin-bottom: 5px; " id="batal-antri">
					<i class="fa fa-trash-o" aria-hidden="true"></i> Batal
				</button>
				<button class="konfirmasiButton btn btn-primary btn-hero btn-click-animate" style="width: 100%"
				@if($kasus->pembayaran->perusahaan->tipe->slug == 'bpjs' &&  isset($kasus->sep) && $kasus->sep->jenis_pelayanan != 1  && $transaksi->is_pindah == 0)
				disabled=""
				@endif>
					<i class="fa fa-check"></i> Konfirmasi
				</button>
			</div>
		</form>

	</div>
</div>

@endsection

@section('js')
<script type="text/javascript">
	var selected_tipe_pembayaran = "{{ $kasus->pembayaran->perusahaan->tipe->slug ?? '' }}";
	var kasus_kelas_id = "{{ $kasus->pembayaran->kelas_id }}";
	var selected_kelas_id = "{{ $bed_kelas_id }}";

	$('#sep_select').on("select2:select", function(arg) {
		var sep = JSON.parse($('#sep_select').val());
		$('#no_sep_preview').text("");
        $('#no_kartu_preview').text("");
        $('#tanggal_preview').text("");
        $('#jenis_preview').text("");
        if(sep && sep.jenis_pelayanan == 1){
			$('#no_sep_hidden').val(sep.no_sep);
            $('#no_sep_preview').text( sep.no_sep || "");
            $('#no_kartu_preview').text(sep.no_bpjs || "");
            $('#tanggal_preview').text( sep.tgl_sep.split("-").reverse().join("-") || "-");
            $('#jenis_preview').text( sep.jenis_pelayanan == 1 ? "Rawat Inap" : "Rawat Jalan");
            $('#kelas_preview').text("Kelas "+sep.kelas_rawat);
            if(sep.dokter != null)
            {
            	$('#dpjp_preview').text(sep.dokter.name);
            }

            $('#sep_preview_wrapper').show();
            $('#sep_kosong_wrapper').hide();
            $('.konfirmasiButton').attr("disabled", false);
        }else{
            $('.konfirmasiButton').attr("disabled", true);
        	$('#sep_preview_wrapper').hide();
            $('#sep_kosong_wrapper').show();
        }
	});
	$('#sep_select_refresh').click(function(){
		$('#sep_select_refresh').hide();
		$('#sep_select_loading').show();
		var tanggal_start =  $('#sep_select_refresh').attr('data-tanggal-start');
		var tanggal_end =  $('#sep_select_refresh').attr('data-tanggal-end');
		var ppk = $('#sep_select_refresh').attr('data-ppk');
		var nomor_kartu = $('#sep_select_refresh').attr('data-no-kartu');
		$.ajax({
            type:'GET',
            url:"{{url('')}}/api/bpjs/monitoring/histori-pelayanan-peserta/get-data?tanggal_start="+tanggal_start+"&tanggal_end="+tanggal_end+"&no_bpjs="+nomor_kartu,
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
					var sep_ppk = data[i].noSep.substr(0,8);
					if(data[i].jnsPelayanan == 1 && sep_ppk == ppk) {
						data[i].no_sep = data[i].noSep;
						data[i].jenis_pelayanan = data[i].jnsPelayanan;
						data[i].no_bpjs = data[i].noKartu;
						data[i].tgl_sep = data[i].tglSep;
						data[i].kelas_rawat = data[i].kelasRawat;
						var nilai = JSON.stringify(data[i]);
						option.push({
							id: nilai,
							text: data[i].noSep
						});
						if (i == 0) sep_select_first_value = nilai;
					}
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

    $('#sep_custom_send').on('click', function(){
        $('#sep_custom_send').hide();
        $('#sep_custom_loading').show();
        var no_sep = $('#custom_sep').val();
        var formData = new FormData();
        formData.append('pasien_id', "{{$pasien->id}}");
        $.ajax({
            type: "POST",
            url: API_URL + "/bpjs/sep/manual-inap/" + no_sep,
            contentType: false,
            cache: false,
            processData: false,
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (resp) {
                $('#no_sep_preview').text(no_sep || "-");
                $('#sep_preview_wrapper').show();
                $('#sep_kosong_wrapper').hide();
		        $('#sep_custom_send').show();
		        $('.konfirmasiButton').attr("disabled", false);
		        $('#sep_custom_loading').hide();
            },
            error:function(error){
                $('#infoBPJSWrapper').hide();
                $('#custom_sep').val("")
                $('#sep_custom_send').show();
                $('#sep_custom_loading').hide();
                $('#sep_kosong_wrapper').show();
                console.log(error);
            }
        });
    });

	$('#custom_sep').keyup(function() {
		var val = $('#custom_sep').val();
		if(val.length > 0)  $('.konfirmasiButton').attr("disabled", false);
		else $('.konfirmasiButton').attr("disabled", true);
		console.log(val.length)
	})

	$('document').ready(function() {
		/*$('#konfirmasiButton').prop('disabled',true);
		$('#selectTidurBayi').on('change', function() {
            valBayi = $(this).val();
            $('#tempat_tidur_bayi').val(valBayi);
            if (valBayi=="") {
            	$('#konfirmasiButton').prop('disabled',true);
            }
            else {
            	$('#konfirmasiButton').prop('disabled',false);	
            }
        });*/
		cekBPJSPotensi();
        $("#custom_sep").change(function(){
			$('#no_sep_hidden').val($('#custom_sep').val());
		});

        $('#batal-antri').on('click', function() {
        	var deleteSupp = $(this).parent().find('form');
        	swal({
        		title: "Apa anda yakin ?",
        		text: "Anda batal mendaftarkan pasien ke ruangan ini.",
        		type: "warning",
        		showCancelButton: true,
        		reverseButtons: true,
        		confirmButtonClass: 'btn btn-primary',
        		cancelButtonClass: 'btn btn-default',
        		confirmButtonText: "Ya",
        		cancelButtonText: "Tidak",
        		closeOnConfirm: false,
        		closeOnCancel: false,
        		allowOutsideClick: false
        	}).then((result) => {
        		if (result.value) 
        		{
        			swal("Konfirmasi Dibatalkan", "" , "error")
        			.then(function()
        			{
        				window.location = "{{url('/rawatinap/transaksi/pendaftaran/ruangan?transaksi_id=')}}{{$transaksi->id}}";		
        			});					
        		} 
        		else 
        		{
        			swal("Konfirmasi Ulang", "Lakukan konfirmasi pada antrian.", "error");
        		}
        	}) 
        });
    });

	$('#sep_button').on('click', function(e){
		popupwindow("{{url('')}}/bpjs/sep/create?window=true&pasien_id={{$pasien->id}}&pasien_name={{$pasien->name}}&rujukan={{$kasus->sep->no_sep??''}}&is_inap=true&pembayaran_id={{$kasus->pasien_pembayaran_id}}", "Terbitkan SEP Baru", 900, 900);
	});

	$('#sep_button_auto').on('click', function(){
		var pembayaran_id= "{{$kasus->pasien_pembayaran_id}}";
		var pasien_id= "{{$pasien->id}}"
		var kasus_id= "{{$kasus->id}}"

		$('#sep_button_auto').prepend('<i class="fa fa-spinner fa-spin"></i>');    
		$('#sep_button_auto').attr('disabled', true);
		$.ajax({
			type: "GET",
			url: BASE_URL + "bpjs/auto-sep/generate/rawat-inap/" + pasien_id + "/" + pembayaran_id + "/" + kasus_id,
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

	function konfirmasiPrint(index) {
		var url = "{{url('rawatinap/transaksi/pendaftaran/konfirmasi/print?transaksi_id=')}}{{$transaksi->id}}&bed_id={{$bed->id}}"
		popupwindow(url,'Konfirmasi Print',620,1000);

	}

	function cekBPJSPotensi()
    {
        if (selected_tipe_pembayaran == 'bpjs') {
            if (kasus_kelas_id != selected_kelas_id) {
				$('input[name=beda_kelas]').val('1');
                appendPeringatan('Pendaftaran Pasien ke Rawat Inap berpotensi Beda Kelas dalam Purifikasi BPJS', 'ranap', false, 'ranap-potensi-beda-kelas');
            }

            $.ajax({
                url: API_URL + '/kasus/purifikasi/potensi/rawat-inap',
                type: 'GET',
                dataType: 'json',
                data:{
                    'pasien_id': "{{ $kasus->pasien_id ?? 0 }}",
                    'kasus_id': "{{ $kasus->id ?? 0 }}"
                },
                success : function (data){
                    if (data.readmisi) {
						$('input[name=readmisi]').val('1');
                        appendPeringatan('Pendaftaran Pasien ke Rawat Inap berpotensi Readmisi dalam Purifikasi BPJS', 'ranap', false, 'ranap-potensi-readmisi');
                    }
                },
                error: function (err) {
                    console.log(err)
                    console.log('Checking bpjs potensi error');
                }
            });
        }
    }

	function appendPeringatan(alert_message, alert_position_tag, alert_required = false, unique_id = '') {
		error_template_el = $('#error-wrapper-' + alert_position_tag).clone();
		error_template_el.attr('id', unique_id).addClass(`peringatan-${alert_position_tag}`);
		error_template_el.find('span').text(alert_message);
		if (alert_required) {
			error_template_el.addClass('peringatan-required');
		} else {
			error_template_el.addClass('peringatan-optional');
		}
		error_template_el.show();
		if (unique_id != '') {
			$(`.error-${alert_position_tag}-content`).find(`#${unique_id}`).remove();
		}
		$(`.error-${alert_position_tag}-content`).append(error_template_el);
	}
</script>
@endsection