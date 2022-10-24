@extends('warehouse.layouts.main')

@section('title')
Farmasi Racikan Obat
@endsection

@section('content')
	<form method="POST" enctype="multipart/form-data" action="">
		{{csrf_field()}}
		<div class="block">
	        <div class="block-header block-header-default">
	            <h3 class="block-title">Buat Racikan Obat</h3>
	            <div class="block-options">
	                <button type="submit" class="btn btn-sm btn-primary btn-square d-none" id="btnSimpan">
	                    <i class="fa fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;Simpan
	                </button>
	            </div>
	        </div>
	        <div class="block-content">
	            <div class="form-group">
	                <label>Nama Pasien</label>
	                <h5 class="card-title">Nama Pasien</h5>
	                <input type="hidden" name="pasien" value="ID Pasien">
	            </div>
	        </div>
	    </div>

	    <div class="row">
	    	<div class="col-md-6">
	    		<div class="block">
	    			<div class="block-header block-header-default">
			            <h3 class="block-title">Isi resep obat</h3>
			        </div>
			        <div class="block-content">
		    			<div class="form-group row">
		    				<div class="col-12">
	                            <div class="custom-control custom-radio custom-control-inline mb-5">
	                                <input class="custom-control-input" type="radio" name="jenisObat" id="obatGenerik" value="generik" checked>
	                                <label class="custom-control-label" for="obatGenerik">Obat Generik</label>
	                            </div>
	                            <div class="custom-control custom-radio custom-control-inline mb-5">
	                                <input class="custom-control-input" type="radio" name="jenisObat" id="racikan" value="racikan">
	                                <label class="custom-control-label" for="racikan">Racikan</label>
	                            </div>
	                        </div>
		    			</div>
		    			<div class="form-group row">
                            <label class="col-12">Tipe Obat</label>
                            <div class="col-md-12">
	                            <select class="js-select2 form-control" id="tipeObat" name="" style="width: 100%;" data-placeholder="Pilih Obat">
                                    <option value="0">Tabs</option>
                                    <option value="1">Caps</option>
                                    <option value="2">Dels</option>
                                </select>
                            </div>
                        </div>
		    			<div class="form-group row" id="obatForGenerik">
                            <label class="col-12">Nama Obat</label>
                            <div class="col-md-12">
	                            <select class="js-select2 form-control" id="namaObat" name="" style="width: 100%;" data-placeholder="Pilih Obat">
                                    <option value="0">A</option>
                                    <option value="1">B</option>
                                    <option value="2">C</option>
                                </select>
                            </div>
                        </div>

                        <div class="row" id="racikan-row">
                        	<div class="col-md-12">
                        		<div class="form-group d-none" id="obatForRacikan">
		                            <label>Nama Obat Racikan</label>
		                            <div class="row racikan-obat-wrapper">
			                            <div class="col-md-7">
			                                <select class="js-select2 form-control namaobat-select" id="_racikan" name="" style="width: 100%;" data-placeholder="Pilih Obat">
			                                    <option value="0">A</option>
			                                    <option value="1">B</option>
			                                    <option value="2">C</option>
			                                </select>
			                            </div>
			                            <div class="col-md-3">
			                                <input type="text" class="form-control jumlah-obat" id="jumlah" placeholder="Jumlah">
			                            </div>
			                            <div class="col-md-2">
			                                <button type="button" class="button-control btn btn-sm btn-primary btn-square btnAddRacikan">
							                    <i class="fa fa-plus" aria-hidden="true"></i>
							                </button>
			                            </div>
		                            </div>
		                        </div>
                        	</div>
                        </div>

                        <div class="form-group row">
                            <label class="col-12">Nomor Obat</label>
                            <div class="col-12">
                                <input type="text" class="form-control" placeholder="Isikan Nomor Obat" name="" id="nomorObat">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-12">Aturan Penggunaan</label>
                            <div class="col-12">
                                <input type="text" class="form-control" placeholder="Isikan Aturan Penggunaan" name="" id="aturanPenggunaan">
                            </div>
                        </div>
                        <div class="text-center pb-10">
                        	<button type="button" class="btn btn-sm btn-primary btn-square" id="btn-add">
			                    <i class="fa fa-plus" aria-hidden="true"></i>&nbsp; Tambahkan Obat
			                </button>
                        </div>
		    		</div>
	    		</div>
	    	</div>

	    	<div class="col-md-6">
	    		<div class="row" id="resep-wrapper">
	                
	    		</div>
	    		<div class="py-30 text-center">
	    			<h2 class="h3 font-w400 text-muted mb-50" id="checkResep">Tidak Ada Resep Obat !</h2>
	    		</div>
            </div>
	    </div>
    </form>
@endsection

@section('css')
	<style type="text/css">
		.button-control {
			display: block;
		    width: 100%;
		    padding: .375rem .75rem;
		    font-size: 1rem;
		    line-height: 1.5;
		    color: #495057;
		    background-color: #fff;
		    background-clip: padding-box;
		    border: 1px solid #dde2ec;
		    height: 40px;
		}
		.text-small {
			font-size: 1rem !important;
		}
	</style>
@endsection

@section('js')
	<script type="text/javascript">
		$(document).ready(function(){
			checkResep();
		});

		$('#obatGenerik').on('click', function() {
            $(this).parents('.block-content').find('#obatForGenerik').removeClass('d-none');
            $(this).parents('.block-content').find('#obatForRacikan').addClass('d-none');
        });

        $('#racikan').on('click', function() {
            $(this).parents('.block-content').find('#obatForGenerik').addClass('d-none');
            $(this).parents('.block-content').find('#obatForRacikan').removeClass('d-none');
        });

		$('.btnAddRacikan').on('click', function() {
            var formRacikan = 
            	`<div class="row racikan-obat-wrapper mt-10">
                    <div class="col-md-7">
                        <select class="js-select2 form-control namaobat-select" id="" name="" style="width: 100%;" data-placeholder="Pilih Obat">
                            <option value="0">A</option>
                            <option value="1">B</option>
                            <option value="2">C</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control jumlah-obat" placeholder="Jumlah">
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="button-control btn btn-sm btn-danger btn-square btnRemoveRacikan">
		                    <i class="fa fa-minus" aria-hidden="true"></i>
		                </button>
                    </div>
                </div>`
            $('#obatForRacikan').append(formRacikan);
            removeRacikan();
        });


		function removeRacikan() {
			$('.btnRemoveRacikan').on('click', function() {
	        	var remove_racikan = $(this).parents('.racikan-obat-wrapper');
	            remove_racikan.remove();
	        })
		}

		$('#btn-add').on('click', function(){
			var jenisObat = $('input[name=jenisObat]:checked').val();
			var tipeObat = $('#tipeObat').find(":selected").text();
			var tipeObatVal = $('#tipeObat').find(":selected").val();
			var namaObat;
			var namaObatVal;
			var nomorObat = $('#nomorObat').val();
			var aturanPenggunaan = $('#aturanPenggunaan').val();

			var detailRacikan = [];

			var resepJadi = 
			`<div class="col-md-6 resep-jadi">
                <a class="block block-link-shadow" href="javascript:void(0)">
                    <div class="block-content block-content-full clearfix">
                        <div class="float-right">
                            <button type="button" class="btn-block-option btnRemoveResep">
                                <i class="fa fa-times"></i>
                            </button>
                        </div>
                        <div class="float-left mt-10">`

			if (jenisObat == 'generik') {
				namaObat = $('#namaObat').find(":selected").text();
				namaObatVal = $('#namaObat').find(":selected").val();

				resepJadi += 
					`<div class="font-w600 mb-5">Obat Generik</div>
                    <div class="font-size-sm text-muted">`+ tipeObat +`</div>
                    <div class="font-size-sm text-muted">`+ namaObat +` - `+ aturanPenggunaan +`</div>
                    <div class="font-size-sm text-muted">`+ nomorObat +`</div>

                    <input type="hidden" name="jenisObatVal" value="`+ jenisObat +`">
                    <input type="hidden" name="tipeObatVal" value="`+ tipeObatVal +`">
                    <input type="hidden" name="namaObatVal" value="`+ namaObatVal +`">
                    <input type="hidden" name="nomorObatVal" value="`+ nomorObat +`">
                    <input type="hidden" name="aturanPenggunaanVal" value="`+ aturanPenggunaan +`">`
			} else if (jenisObat == 'racikan') {
				var namaObatTxt = []
				var jumlahObatTxt = []
				var arrInputNamaObat = [];
				var arrInputJumlah = [];
				
				$(".namaobat-select").each(function () {
				    arrInputNamaObat.push($(this).val())
				    namaObatTxt.push($(this).find(":selected").text());
				});

				$(".jumlah-obat").each(function () {
				    arrInputJumlah.push($(this).val())
				    jumlahObatTxt.push($(this).val());
				})

				resepJadi += 
					`<div class="font-w600 mb-5">Racikan</div>
	       			<div class="font-size-sm text-muted">`+ tipeObat +`</div>`;

                for (var i = 0; i < arrInputNamaObat.length; i++) {
                    resepJadi += 
                    `<div class="font-size-sm text-muted">
                    	`+ namaObatTxt[i] +` - `+ jumlahObatTxt[i] +`
                    </div>
                    <input type="hidden" name="jenisObatVal" value="`+ arrInputNamaObat[i] +`">
                    <input type="hidden" name="jenisObatVal" value="`+ arrInputJumlah[i] +`">`;
                }

                resepJadi +=
	                 `<div class="font-size-sm text-muted">`+ nomorObat +`</div>
	                 <div class="font-size-sm text-muted">`+ aturanPenggunaan +`</div>
	                 <input type="hidden" name="jenisObatVal" value="`+ jenisObat +`">
	                 <input type="hidden" name="tipeObatVal" value="`+ tipeObatVal +`">
	                 <input type="hidden" name="nomorObatVal" value="`+ nomorObat +`">
	                 <input type="hidden" name="aturanPenggunaanVal" value="`+ aturanPenggunaan +`">`
			}

			resepJadi += 
						`</div>
                    </div>
                </a>
            </div>`;

            $('#resep-wrapper').append(resepJadi);
            removeResepJadi();
            reseFields();
            checkResep();
		});

		function removeResepJadi() {
			$('.btnRemoveResep').on('click', function() {
	        	var remove_racikan = $(this).parents('.resep-jadi');
	            remove_racikan.remove();
	            checkResep();
	        })
		}

		function reseFields() {
			$('#tipeObat').val(null).trigger('change');
            $('#namaObat').val(null).trigger('change');
            $('#nomorObat').val(null).trigger('change');
            $('#aturanPenggunaan').val(null).trigger('change');
            $('#_racikan').val(null).trigger('change');
            $('#jumlah').val(null).trigger('change');

            $('.btnRemoveRacikan').each(function () {
	        	var remove_racikan = $(this).parents('.racikan-obat-wrapper');
	            remove_racikan.remove();
	        })
		}

		function checkResep() {
			var countResep = document.getElementsByClassName("resep-jadi");
			console.log(countResep.length);
			if (countResep.length > 0) {
				$('#btnSimpan').removeClass('d-none');
				$('#checkResep').addClass('d-none');
			} else {
				$('#btnSimpan').addClass('d-none');
				$('#checkResep').removeClass('d-none');
			}
		}

	</script>
@endsection