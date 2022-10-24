<script type="text/javascript">
	function initSelect2Pemakaian(){
		@forelse($alkes as $m)
		append_alkes({id: {{$m->item_id}}, text: '{{$m->getItem->nama}}'}, 'pemakaian', {{$m->jumlah}});
		@endforeach
		@forelse($matkes as $m)
		append_matkes({id: {{$m->item_id}}, text: '{{$m->getItem->nama}}'}, 'pemakaian', {{$m->jumlah}});
		@endforeach
		@forelse($obat as $m)
		append_obat({id: {{$m->item_id}}, text: '{{$m->getItem->nama}}'}, 'pemakaian', {{$m->jumlah}});
		@endforeach
		@forelse($implan as $m)
		append_implan({id: {{$m->item_id}}, text: '{{$m->getItem->nama}}'}, 'pemakaian', {{$m->jumlah}});
		@endforeach
	}
	
	var append_alkes = function(initials = '', tipe, jumlah = 1){
		if(initials != '') selected = '<option value="'+initials.id+'">'+initials.text+'</option>';
		else selected = '';
		if (tipe == 'rencana') {
			pre = {
				parent_element: '#form_rencana_alkes',
				class_name: 'select2_rencana_alkes',
				name: 'alkes_rencana[]',
				jumlah_name: 'alkes_jumlah_rencana[]'
			};
		}
		else if (tipe == 'pemakaian') {
			pre = {
				parent_element: '#form_pemakaian_alkes',
				class_name: 'select2_pemakaian_alkes',
				name: 'alkes_pemakaian[]',
				jumlah_name: 'alkes_jumlah_pemakaian[]'
			};
		}
		else if (tipe == 'pengembalian') {
			pre = {
				parent_element: '#form_pengembalian_alkes',
				class_name: 'select2_pengembalian_alkes',
				name: 'alkes_pengembalian[]',
				jumlah_name: 'alkes_jumlah_pengembalian[]'
			};
		}

		$(pre.parent_element).append(`<div class="row alatform">
			<div class="col-6">
			<label>Barang</label>
			<select class="js-select2 form-control input_`+tipe+` `+pre.class_name+`" style="width: 100%;" name="`+pre.name+`" data-placeholder="Masukkan Nama Alkes">
			`+selected+`
			</select>
			</div>
			<div class="col-5">
			<label>Jumlah</label>
			<input type="number" min="1" name="`+pre.jumlah_name+`" class="form-control input_`+tipe+`" placeholder="Jumlah" value="${jumlah}">
			</div>
			<div class="col-1">
			<button type="button" class="btn btn-danger btn_delete" onclick="delete_button(this)"><i class="fa fa-trash"></i></button>
			</div>
			</div>
			</div>`);
		Codebase.helpers(['select2']);
		var halaman = 1;
		$('.'+pre.class_name).last().select2({
			data : initials,
			ajax : {
				url: '{{ url('api/farmasi/item/get') }}',
				delay: 250,
				dataType: 'json',
				data: function (params) {
					var query = {
						keyword: params.term,
						jenis: 'Alkes',
						page: params.page
					}
					return query;
				},
				processResults: function (data, params) {
					if(params.page == undefined || params.page == null)
						halaman ++;
					else
						halaman = params.page+1

					return {
						results:  $.map(data.data, function (item) {
							return {
								id: item.id,
								text: item.nama
							};
						}),
						pagination: {
							more: (halaman * data.per_page) < data.total
						}
					};
				},
			}
		});
	};

	var append_matkes = function(initials = '', tipe, jumlah = 1){
		if(initials != '') selected = '<option value="'+initials.id+'">'+initials.text+'</option>';
		else selected = '';
		if (tipe == 'rencana') {
			pre = {
				parent_element: '#form_rencana_matkes',
				class_name: 'select2_rencana_matkes',
				name: 'matkes_rencana[]',
				jumlah_name: 'matkes_jumlah_rencana[]'
			};
		}
		else if (tipe == 'pemakaian') {
			pre = {
				parent_element: '#form_pemakaian_matkes',
				class_name: 'select2_pemakaian_matkes',
				name: 'matkes_pemakaian[]',
				jumlah_name: 'matkes_jumlah_pemakaian[]'
			};
		}
		else if (tipe == 'pengembalian') {
			pre = {
				parent_element: '#form_pengembalian_matkes',
				class_name: 'select2_pengembalian_matkes',
				name: 'matkes_pengembalian[]',
				jumlah_name: 'matkes_jumlah_pengembalian[]'
			};
		}
		$(pre.parent_element).append(`<div class="row alatform">
			<div class="col-6">
			<label>Barang</label>
			<select class="js-select2 form-control input_`+tipe+` `+pre.class_name+`" style="width: 100%;" name="`+pre.name+`" data-placeholder="Masukkan Nama Matkes" required="">
			`+selected+`
			</select>
			</div>
			<div class="col-5">
			<label>Jumlah</label>
			<input type="number" min="1" name="`+pre.jumlah_name+`" class="form-control input_`+tipe+`" placeholder="Jumlah" required="" value="${jumlah}">
			</div>
			<div class="col-1">
			<button type="button" class="btn btn-danger btn_delete" onclick="delete_button(this)"><i class="fa fa-trash"></i></button>
			</div>
			</div>
			</div>`);
		Codebase.helpers(['select2']);
		$('.'+pre.class_name).last().select2({
			data : initials,
			minimumInputLength: 3,
			ajax : {
				url: '{{ url('api/farmasi/item/get') }}',
				delay: 250,
				dataType: 'json',
				data: function (params) {
					var query = {
						keyword: params.term,
						jenis: 'Matkes',
						page: params.page
					}
					return query;
				},
				processResults: function (data, params) {
					params.page = params.page || 1;

					return {
						results:  $.map(data.data, function (item) {
							return {
								id: item.id,
								text: item.nama
							};
						}),
						pagination: {
							more: (params.page * data.per_page) < data.total
						}
					};
				},
			}
		});
	};

	var append_obat = function(initials = '', tipe, jumlah = 1){
		if(initials != '') selected = '<option value="'+initials.id+'">'+initials.text+'</option>';
		else selected = '';
		if (tipe == 'rencana') {
			pre = {
				parent_element: '#form_rencana_obat',
				class_name: 'select2_rencana_obat',
				name: 'obat_rencana[]',
				jumlah_name: 'obat_jumlah_rencana[]'
			};
		}
		else if (tipe == 'pemakaian') {
			pre = {
				parent_element: '#form_pemakaian_obat',
				class_name: 'select2_pemakaian_obat',
				name: 'obat_pemakaian[]',
				jumlah_name: 'obat_jumlah_pemakaian[]'
			};
		}
		else if (tipe == 'pengembalian') {
			pre = {
				parent_element: '#form_pengembalian_obat',
				class_name: 'select2_pengembalian_obat',
				name: 'obat_pengembalian[]',
				jumlah_name: 'obat_jumlah_pengembalian[]'
			};
		}
		$(pre.parent_element).append(`<div class="row alatform">
			<div class="col-6">
			<label>Obat</label>
			<select class="js-select2 form-control input_`+tipe+` `+pre.class_name+`" style="width: 100%;" name="`+pre.name+`" data-placeholder="Masukkan Nama Obat">
			`+selected+`
			</select>
			</div>
			<div class="col-5">
			<label>Jumlah</label>
			<input type="number" min="1" name="`+pre.jumlah_name+`" class="form-control input_`+tipe+`" placeholder="Jumlah" value="${jumlah}">
			</div>
			<div class="col-1">
			<button type="button" class="btn btn-danger btn_delete" onclick="delete_button(this)"><i class="fa fa-trash"></i></button>
			</div>
			</div>
			</div>`);
		Codebase.helpers(['select2']);
		$('.'+pre.class_name).last().select2({
			data : initials,
			minimumInputLength: 3,
			ajax : {
				url: '{{ url('api/farmasi/item/get') }}',
				delay: 250,
				dataType: 'json',
				data: function (params) {
					var query = {
						keyword: params.term,
						jenis: 'Obat',
						page: params.page
					}
					return query;
				},
				processResults: function (data, params) {
					params.page = params.page || 1;

					return {
						results:  $.map(data.data, function (item) {
							return {
								id: item.id,
								text: item.nama
							};
						}),
						pagination: {
							more: (params.page * data.per_page) < data.total
						}
					};
				},
			}
		});
	};

	var append_implan = function(initials = '', tipe, jumlah = 1){
		if(initials != '') selected = '<option value="'+initials.id+'">'+initials.text+'</option>';
		else selected = '';
		if (tipe == 'rencana') {
			pre = {
				parent_element: '#form_rencana_implan',
				class_name: 'select2_rencana_implan',
				name: 'implan_rencana[]',
				jumlah_name: 'implan_jumlah_rencana[]'
			};
		}
		else if (tipe == 'pemakaian') {
			pre = {
				parent_element: '#form_pemakaian_implan',
				class_name: 'select2_pemakaian_implan',
				name: 'implan_pemakaian[]',
				jumlah_name: 'implan_jumlah_pemakaian[]'
			};
		}
		else if (tipe == 'pengembalian') {
			pre = {
				parent_element: '#form_pengembalian_implan',
				class_name: 'select2_pengembalian_implan',
				name: 'implan_pengembalian[]',
				jumlah_name: 'implan_jumlah_pengembalian[]'
			};
		}
		$(pre.parent_element).append(`<div class="row alatform">
			<div class="col-6">
			<label>Implan</label>
			<select class="js-select2 form-control input_`+tipe+` `+pre.class_name+`" style="width: 100%;" name="`+pre.name+`" data-placeholder="Masukkan Nama Implan">
			`+selected+`
			</select>
			</div>
			<div class="col-5">
			<label>Jumlah</label>
			<input type="number" min="1" name="`+pre.jumlah_name+`" class="form-control input_`+tipe+`" placeholder="Jumlah" value="${jumlah}">
			</div>
			<div class="col-1">
			<button type="button" class="btn btn-danger btn_delete" onclick="delete_button(this)"><i class="fa fa-trash"></i></button>
			</div>
			</div>
			</div>`);
		Codebase.helpers(['select2']);
		$('.'+pre.class_name).last().select2({
			data : initials,
			minimumInputLength: 3,
			ajax : {
				url: '{{ url('api/farmasi/item/get') }}',
				delay: 250,
				dataType: 'json',
				data: function (params) {
					var query = {
						keyword: params.term,
						jenis: 'Implan',
						page: params.page
					}
					return query;
				},
				processResults: function (data, params) {
					params.page = params.page || 1;

					return {
						results:  $.map(data.data, function (item) {
							return {
								id: item.id,
								text: item.nama
							};
						}),
						pagination: {
							more: (params.page * data.per_page) < data.total
						}
					};
				},
			}
		});
	};

	
	$(".add_more_alkes").click(function(){
		var tipe = $(this).attr('tipe');
		append_alkes('', tipe);
	});

	$(".add_more_matkes").click(function(){
		var tipe = $(this).attr('tipe');
		append_matkes('', tipe);
	});

	$(".add_more_obat").click(function(){
		var tipe = $(this).attr('tipe');
		append_obat('', tipe);
	});

	$(".add_more_implan").click(function(){
		var tipe = $(this).attr('tipe');
		append_implan('', tipe);
	});

	var delete_button = function(param){
		$(param).parents('.alatform').remove();
	};

	window.append_functions = {
		'alkes': append_alkes,
		'matkes': append_matkes,
		'obat': append_obat,
		'implan': append_implan,
	}

	$(document).ready(function(e){
		$("#jadwal_operasi").addClass('active');
		Codebase.helpers(['summernote']);
		if (window.location.hash) {
			$(".nav-link[href='"+window.location.hash+"']").trigger('click');
		}

		var append_form_kosong = function(tipe){
			$.each($(".appended_form[tipe='"+tipe+"']"), function(i, val){
				if ($(this).is(':empty')){
					var jenis = $(this).attr('jenis');
					var tipe = $(this).attr('tipe');
					window.append_functions[jenis]('', tipe);
				}
			});
		};
		
		@if ($rencana->count())
		$.ajax({
			url: '{{ url('ajax/kamaroperasi/rencana/item') }}',
			dataType: 'json',
			data: {
				id: {{ $transaksi->id }}
			},
			success: function(data){
				$.each(data, function(ind, val){
					initials = {id: val.item_id, text: val.nama};
					window.append_functions[val.jenis](initials, 'rencana');
					$("input[name='"+val.jenis+"_jumlah_rencana[]']").last().val(val.jumlah);
				});
				append_form_kosong('rencana');
			}
		});
		@else
		append_form_kosong('rencana');
		@endif

		@if ($pemakaian->count())
		$.ajax({
			url: '{{ url('ajax/kamaroperasi/pemakaian/item') }}',
			dataType: 'json',
			data: {
				id: {{ $transaksi->id }}
			},
			success: function(data){
				$.each(data, function(ind, val){
					initials = {id: val.item_id, text: val.nama};
					window.append_functions[val.jenis](initials, 'pemakaian');
					$("input[name='"+val.jenis+"_jumlah_pemakaian[]']").last().val(val.jumlah);
				});
				append_form_kosong('pemakaian');
			}
		});
		@else
		append_form_kosong('pemakaian');
		@endif

		@if ($pengembalian->count())
		$.ajax({
			url: '{{ url('ajax/kamaroperasi/pengembalian/item') }}',
			dataType: 'json',
			data: {
				id: {{ $transaksi->id }}
			},
			success: function(data){
				$.each(data, function(ind, val){
					initials = {id: val.item_id, text: val.nama};
					window.append_functions[val.jenis](initials, 'pengembalian');
					$("input[name='"+val.jenis+"_jumlah_pengembalian[]']").last().val(val.jumlah);
				});
				append_form_kosong('pengembalian');
			}
		});
		@else
		append_form_kosong('pengembalian');
		@endif

		

		$(".select2_paket_alkes").select2({
			ajax : {
				url: '{{ url('ajax/kamaroperasi/search_paket') }}',
				delay: 250,
				dataType: 'json',
				data: function (params) {
					var query = {
						search: params.term,
						tipe: 'alkes',
					}
					return query;
				},
				processResults: function (data) {
					return {
						results: data
					};
				},
			}
		});

		$(".select2_paket_alkes").change(function(){
			var tipe = $(this).attr('tipe');
			$("#form_"+tipe+"_alkes").empty();
			$.ajax({
				url: '{{ url('ajax/kamaroperasi/get_paket_item') }}',
				dataType: 'json',
				data: {
					id: $(this).val()
				},
				success: function(data){
					var jumlah_name = "alkes_jumlah_"+tipe+"[]"; 
					$.each(data, function(ind, val){
						initials = {id: val.item_id, text: val.nama}
						append_alkes(initials, tipe);
						$("input[name='"+jumlah_name+"']").last().val(val.jumlah);
					});
				}
			});
		});

		$(".select2_paket_matkes").select2({
			ajax : {
				url: '{{ url('ajax/kamaroperasi/search_paket') }}',
				delay: 250,
				dataType: 'json',
				data: function (params) {
					var query = {
						search: params.term,
						tipe: 'matkes',
					}
					return query;
				},
				processResults: function (data) {
					return {
						results: data
					};
				},
			}
		});

		$(".select2_paket_matkes").change(function(){
			var tipe = $(this).attr('tipe');
			$("#form_"+tipe+"_matkes").empty(); 
			$.ajax({
				url: '{{ url('ajax/kamaroperasi/get_paket_item') }}',
				dataType: 'json',
				data: {
					id: $(this).val()
				},
				success: function(data){
					var jumlah_name = "matkes_jumlah_"+tipe+"[]"; 
					$.each(data, function(ind, val){
						initials = {id: val.item_id, text: val.nama}
						append_matkes(initials, tipe);
						$("input[name='"+jumlah_name+"']").last().val(val.jumlah);
					});
				}
			});
		});

		$(".select2_paket_obat").select2({
			ajax : {
				url: '{{ url('ajax/kamaroperasi/search_paket') }}',
				delay: 250,
				dataType: 'json',
				data: function (params) {
					var query = {
						search: params.term,
						tipe: 'obat',
					}
					return query;
				},
				processResults: function (data) {
					return {
						results: data
					};
				},
			}
		});

		$(".select2_paket_obat").change(function(){
			var tipe = $(this).attr('tipe');
			$("#form_"+tipe+"_obat").empty(); 
			$.ajax({
				url: '{{ url('ajax/kamaroperasi/get_paket_item') }}',
				dataType: 'json',
				data: {
					id: $(this).val()
				},
				success: function(data){
					var jumlah_name = "obat_jumlah_"+tipe+"[]"; 
					$.each(data, function(ind, val){
						initials = {id: val.item_id, text: val.nama}
						append_obat(initials, tipe);
						$("input[name='"+jumlah_name+"']").last().val(val.jumlah);
					});
				}
			});
		});

		$(".select2_paket_implan").select2({
			ajax : {
				url: '{{ url('ajax/kamaroperasi/search_paket') }}',
				delay: 250,
				dataType: 'json',
				data: function (params) {
					var query = {
						search: params.term,
						tipe: 'implan',
					}
					return query;
				},
				processResults: function (data) {
					return {
						results: data
					};
				},
			}
		});

		$(".select2_paket_implan").change(function(){
			var tipe = $(this).attr('tipe');
			$("#form_"+tipe+"_implan").empty();
			$.ajax({
				url: '{{ url('ajax/kamaroperasi/get_paket_item') }}',
				dataType: 'json',
				data: {
					id: $(this).val()
				},
				success: function(data){
					var jumlah_name = "implan_jumlah_"+tipe+"[]"; 
					$.each(data, function(ind, val){
						initials = {id: val.item_id, text: val.nama}
						append_implan(initials, tipe);
						$("input[name='"+jumlah_name+"']").last().val(val.jumlah);
					});
				}
			});
		});
	});



$(".submit_item").click(function(){
	var tipe = $(this).attr('tipe');
	var jenis = ['alkes', 'matkes', 'obat', 'implan'];
	var status = true;

	$.each(jenis, function(i, val){
		var select2_name = val+'_'+tipe+'[]';
		var jumlah_name = val+'_jumlah_'+tipe+'[]';
		var item_kosong = $('select[name="'+select2_name+'"]').filter(function(){
			return !$(this).val();
		}).length;
		var jumlah_kosong = $('input[name="'+jumlah_name+'"]').filter(function(){
			return !$(this).val();
		}).length;
		if (item_kosong) {
			swal({
				title: "Gagal",
				text: "Pastikan barang "+val+" telah lengkap terisi!",
				type: 'error',
				confirmButtonClass: "btn btn-primary"
			});
			status = false;
			return false;
		}
		if (jumlah_kosong) {
			swal({
				title: "Gagal",
				text: "Pastikan jumlah "+val+" telah lengkap terisi!",
				type: 'error',
				confirmButtonClass: "btn btn-primary"
			});
			status = false;
			return false;
		}
	});
	if(status)
		$(this).parents('form:first').submit();
});

$("#pemakaian_form").submit(function(e){
	var nama = [];
	$.each($(".select2_pemakaian_matkes, .select2_pemakaian_obat, .select2_pemakaian_implan"), function(i, val){
		if($(this).val())
			nama.push($(this).select2('data')[0].text);
	});
	$("#nama_obat").val(JSON.stringify(nama));
});
</script>