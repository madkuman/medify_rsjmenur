<script type="text/javascript">
	var trCount = 1;
	var tbody = $('#harga-tbody');
	var editor = new SimpleTableCellEditor("hargaTable");

	$(document).ready(function(){
		setEditable();
		$('.departemen').on('select2:select', function (e) {
			var data2 = e.params.data;

			$.ajax({
				type: "GET",
				url: API_URL + "/keuangan/tarif/getkategori",
				dataType: "json",
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				data: {
					id : data2.id
				},
				success: function (data) {
					console.log(data);
					var option = [];
					option.push({
						id: '',
						text: '',
					});
					for (i in data) {
						option.push({
							id: data[i].id,
							text: data[i].nama
						});
					}
					// $('#select_kategori_sub').hide();
					// $('#select_kategori_sub_sub').hide();
					// $(".tarif_kategori option").remove();
					// $(".tarif_kategori_sub option").remove();
					// $(".tarif_kategori_sub_sub option").remove();
					$('.tarif_kategori').select2({
						data: option
					});
				}
			});
		});
	})
	$(document).on('click', '#tambahRecord', function(){
		trCount++;
		tbody.append(`@include('keuangan.tarif.components.create-tr')`);
		setEditable();
	});
	$(document).on('click', '.remove', function(el){
		trCount--;
		$(this).parent().parent().remove();
		reindexNum();
	});

	$(document).on('change', '.select-jenis', function(el){
		var parent = $(this).parent().parent();
		var nilai = parent.find('.harga-in').val();
		if(this.value == 'persen'){
			parent.find('.editable').text(nilai+'%');
		} else if(this.value == 'nominal'){
			parent.find('.editable').text(parseFloat(nilai).toLocaleString('id-ID', {currency: 'IDR', style: 'currency'}));
		}

	})

	function reindexNum(){
		$('.index-num').each(function(key, item){
			item.innerText = key+1;
		});
	}

	function setEditable(){
		editor.SetEditableClass("editable",{

		  // method used to vali<a href="https://www.jqueryscript.net/time-clock/">date</a> new value
		  validation : function(val){
		  	return val;
		  },

		  // method used to format new value
		  formatter : function(val){
		  	return parseFloat(val).toLocaleString('id-ID', {currency: 'IDR', style: 'currency'});
		  },

		  // key codes
		  keys : {
		    validation: [13],
		    cancellation: [27]
		  },
		  internals: {
    		renderValue: (elem, formattedNewVal) => {
    			var jenis = $(elem).parent().find('.select-jenis').val();
    			if(jenis == 'persen'){
    				var nilai = $(elem).parent().find('.harga-in').val();
	    			$(elem).text(nilai+'%');
    			} else {
	    			$(elem).text(formattedNewVal);
    			}
    		},
    		renderEditor: (elem, oldVal) => {
    			// oldVal = oldVal.replace(/\D/g,'');
    			oldVal = $(elem).parent().find('.harga-in').val();
    			$(elem).html(`<input type='number' min="0" class="form-control" style="width:100%; max-width:none">`);
    			var input = $(elem).find('input');
    			input.focus();
    			input.val(oldVal);
    		},
    		extractEditorValue: (elem) => {
    			var inp = $(elem).parent().find('.harga-in');
    			var harga = $(elem).find('input').val()
    			inp.val(harga);
    			return harga;
    		},
    		extractValue: (elem) => { return $(elem).text(); }
	    } 
		});
	}

</script>