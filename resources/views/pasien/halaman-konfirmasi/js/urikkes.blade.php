<script type="text/javascript">
	$('#selectPaket').on('select2:select', function (e) {
		var selected;
		if(e.params == undefined){
	    	selected = $(this).find(":selected");
	    	var id = selected.value
	    	var text = selected.text();
	    	var harga = selected.data('harga');
		} else {
	    	var id = e.params.data.id;
	    	var text = e.params.data.text;
	    	var harga = $(e.params.data.element).data('harga');
		}

		$("#urikkes_paket").empty();
		if(id != 0){
			$("#urikkes_paket").html(`<div class="col-md-12 tindakan-input">
	            <a class="block block-link-shadow" href="javascript:void(0)">
	                <div class="block-content block-content-full clearfix">
	                    <table style="width:100%">
	                        <tbody>
	                            <tr>
	                                <td style="width:60%">
	                                    <div class="pr-5"> 
	                                       ${text}
	                                    </div>
	                                </td>
	                                <td style="width:10%"></td>
	                                <td style="width:25%">Rp `+harga+`</td>
	                                <td style="width:5%">
	                                </td>
	                            </tr>
	                        </tbody>
	                    </table>
	                </div>
	            </a>
	            <input type="hidden" name="price[]" value="`+harga+`">
			</div>
	        `);
			$('#total_harga').val(harga);
			$('#total_paket').html(harga.toLocaleString('id-ID'));
		} else {
			$('#total_harga').val(harga);
			$('#total_paket').html(harga.toLocaleString('id-ID'));
			fetchLayanan();
		}
		$("#paket_custom_content").show()
	});

	$(document).on('click', '#urikkes_tambah', function() {
		fetchLayanan();
		$("#paket_custom_content").show();
	})
	$(document).on('change', '#departemen', function(){
		var selected_dept = $(this).val();
		if(selected_dept == 0)
			$(".layanan-row").show();
		else{
			$(".layanan-row").hide();
			$(`.row-${selected_dept}`).show();
		}
	});
	$(document).on('change', '#tipe_tarif', function(){
		fetchLayanan();
	})

	$(document).on('click', '#add_paket', function(){
		fetchLayanan();
	})

	$(document).on('click', '#submit_akhir', function(){
		var pilihan_paket = $('#urikkes_paket_custom_modal').html();
		$("#urikkes_paket_custom").append(pilihan_paket);
		var total_modal = parseInt($('#total_modal').val());
		var total_harga = parseInt($('#total_harga').val());
		var total = total_harga + total_modal;
		$('#total_harga').val(total);
		$('#total_paket').html(total.toLocaleString('id-ID'));
		$("#modal-custom-paket").modal("hide");
		$("#urikkes_paket_custom_modal").empty();
		$('#create-modal-content-perawat').find('input').val('');
		$('#departemen').val('0');
		$("#hasil-tbody").empty();
		$("#total_modal").val('0');
	})

    $(document).on('click', '.btnRemoveTindakan', function() {
        var remove_tindakan = $(this).parents('.tindakan-input');
        var id = $(this).data(id).id;
		var harga = parseInt($(this).data('harga'));
        $("#tombol_tambah_"+id).prop('disabled', false);
        if(!$('#formTindakan').children().hasClass('tindakan-input'))
        {
			if($('#urikkes_paket_custom_modal .tindakan-input').length == 0){
        		$("#submit_akhir").hide();
			}
			if($(this).closest('#urikkes_paket_custom').length > 0) {
					var total_harga = parseInt($('#total_harga').val());
					var total = total_harga - harga;
					$('#total_harga').val(total);
					$('#total_paket').html(total.toLocaleString('id-ID'));
			} else {
					var total_modal = parseInt($('#total_modal').val());
					$('#total_modal').val(total_modal - harga);
			}
			$('#hasil-tambahkan-empty').show()
		}
        remove_tindakan.remove();
    })

    $(document).on('input', '#search_layanan', function(){
    	var keyword = $(this).val();

    	if(keyword.length == 0)
    		$(".layanan-row").show();
    	if(keyword.length < 3)
    		return;
    	rows = document.getElementById('hasil-tbody').getElementsByClassName('layanan-row');
	    for(i = 0; i < rows.length; i++)
	    {
	        textValue = rows[i].getElementsByClassName('row-deskripsi')[0].innerText.toLowerCase();
	        if(textValue.indexOf(keyword) > -1 ) {
	            rows[i].style.display = "";
	        } else {
	            rows[i].style.display = "none";
	        }
	    }
    })

	function fetchLayanan(){
	    var tipe = $('.tipe-layanan:checked').val() == undefined ? 1 : $('.tipe-layanan:checked').val();

		var targetUrl = `{{url('api/keuangan/tarif/get-penunjang-urikkes')}}?&tipe=${tipe}`;
	    $("#modal-custom-paket").modal("show");
	    $.ajax({
	        url: targetUrl,
	        type: 'GET',
	        dataType: 'json',
	        beforeSend: function(){
	        	$("#hasil-tbody").hide();
			    $("#hasil-pencarian-loading").show();
	        },
	        success: function(response) {
	            loadResponse(response);
	        },
	        error: function() {
	            $('#hasil-pencarian-error').show();
	        },
		});
	}
	function loadResponse(response) {
		var pencarian_div = $("#hasil-tbody");
		pencarian_div.empty();
		for(let i in response) {
			// if(i == 5)
			// 	break;
			if(response[i].tarif_urikkes[0] == undefined)
				continue;
			pencarian_div.append(`<tr class="layanan-row row-${response[i].kategori.departemen_id}">
                                    <td style="width:50%;vertical-align: middle;"><div class="pr-10 row-deskripsi"> `+response[i].deskripsi+`</div>
                                    <div><span class="autocomplete-content-bottom">`+response[i].kategori.nama+`</span></div></td>
                                    <td style="width:25%;vertical-align: middle;"><div class="pull-right">Rp `+response[i].tarif_urikkes[0].harga+`</div></td>
                                    <td style="width:25%;vertical-align: middle;">
                                        <button type="button" id="tombol_tambah_`+response[i].tarif_master_id+`" 
                                        class="btn-alt btn-hero btn-primary tambahin-tindakan" 
                                        data-id="`+response[i].id+`" data-desk="`+response[i].deskripsi+`" 
                                        data-tarifid="`+response[i].tarif_id+`" 
                                        data-tariftipe="" 
                                        data-tariftipetext=""
                                        data-total="`+response[i].tarif_urikkes[0].harga+`" 
                                        onclick="input_top_tindakan(this)">Tambah Tindakan</button>
                                    </td>
                                    </tr>`);
		}
	    $("#hasil-pencarian-loading").hide();		
    	$("#hasil-tbody").show();
    	console.log("ini")
	}

    function input_top_tindakan(desc)
    {   
        var id = $(desc).data("id");
        var desk = $(desc).data("desk");
        // var tarif_id = $(desc).data("tarifid");
        // var tarif_tipe = $(desc).data("tariftipe");
        var tarif_tipe_text = $(desc).data("tariftipetext");
        var total = $(desc).data("total");
        var tarif_kelas = "14";
        var  harga = total.toLocaleString('id-ID');
        var input;

        input = 
        `<div class="col-md-12 tindakan-input">
            <a class="block block-link-shadow" href="javascript:void(0)">
                <div class="block-content block-content-full clearfix">
                    <table style="width:100%">
                        <tbody>
                            <tr>
                                <td style="width:60%">
                                    <div class="pr-5"> 
                                       `+desk+`
                                    </div>
                                </td>
                                <td style="width:10%">`+tarif_tipe_text+`</td>
                                <td style="width:25%">Rp `+harga+`</td>
                                <td style="width:5%">
                                <button type="button" data-harga="`+total+`" data-id="`+id+`" class="btn-block-option btnRemoveTindakan">
                                    <i class="fa fa-times"></i>
                                </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </a>
            <input type="hidden" name="tarif_master_id[]" value="`+id+`">
            <input type="hidden" name="price[]" value="`+total+`">
		</div>
        `
        $("#urikkes_paket_custom_modal").append(input);
        $("#paket_custom_content").show();
        $("#submit_akhir").show();
		$('#hasil-tambahkan-empty').hide()
		var total_modal = parseInt($('#total_modal').val());
		$('#total_modal').val(total_modal + total);
        // removeTindakan();
    }

	@if(empty($pasien->tni_pangkat->urikkes_paket_id))
	var default_value_urikkes = 0;
	@else
	var default_value_urikkes = {{$pasien->tni_pangkat->urikkes_paket_id}}
	setDefaultSelectUrikkes();
	@endif

	function setDefaultSelectUrikkes()
	{
		$('#selectPaket').val(default_value_urikkes).trigger('change');
	}


	function setMetodeBayarTunai(){
		var tunai_id = $('#selectPembayaran option[data-tunai="yes"]').val()
		if(tunai_id != undefined){
			$('#selectPembayaran').val(tunai_id).trigger('change');
			lihatMetode(tunai_id)
		}
	}

</script>