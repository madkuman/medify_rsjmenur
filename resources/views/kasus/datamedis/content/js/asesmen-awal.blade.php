<script type="text/javascript">    
	$('.asesmenEdit').click(function(e) {
		removeAllKeperawatan();
		var id = $(this).data('id');
		$('.id-asesmen').val(id);
		$(this).hide();
		$("#edit-loading-"+id).show();
		var item = $(this).data('item');
		var entry = Object.entries(item);
		removeAllIcd10();
		if(item.jenis == "Gawat Darurat"){
			for (var i = 0; i < entry.length; i++) {
				var key = entry[i][0];
				var val = entry[i][1];
				if(val != null && val != ""){
					if(key == "nyeri_scala"){
						editNyeriScalaSlider("modal-gawat-darurat",val)						
					}
					else if(key == "tindakan_implementasi_keperawatan_array"){
						var tindakan_implementasi_keperawatan_array = JSON.parse(item.tindakan_implementasi_keperawatan_array);
						tindakan_implementasi_keperawatan_array.forEach(function(item, index){
							if(index > 0){
								addJenis();		
							}

							$(`:text[name="jam_implementasi_keperawatan[]"]`)[index].value = item.jam_implementasi_keperawatan;
							$(`:text[name="tindakan_implementasi_keperawatan_array[]"]`)[index].value = item.tindakan_implementasi_keperawatan_array;
						});
					}
					else{
						$(`#modal-gawat-darurat textarea[name="${key}"]`).html(val);
						$(`#modal-gawat-darurat select[name="${key}"]`).val(val);
						$(`#modal-gawat-darurat :text[name="${key}"]`).val(val);
						$(`#modal-gawat-darurat :checkbox[name="${key}"]`).prop('checked', true);
						$(`#modal-gawat-darurat :radio[name="${key}"][value="${val.toLocaleString().replace(/[&\/\\#,+()$~%.'":*?<>{}]/g, '')}"]`).prop('checked', true);
					}
				}else{
					$(`#modal-gawat-darurat select[name="${key}"]`).val(val);
					$(`#modal-gawat-darurat textarea[name="${key}"]`).html(val);
					$(`#modal-gawat-darurat :text[name="${key}"]`).val(val);
					$(`#modal-gawat-darurat :checkbox[name="${key}"]`).prop('checked', false);
					$(`#modal-gawat-darurat :radio[name="${key}"].default-radio`).prop('checked', true);
					if(key == "nyeri_scala"){ editNyeriScalaSlider("modal-gawat-darurat",0) }
				}
			}
			$('#modal-gawat-darurat').modal('toggle');
			countSkorGizi();
			$('input[type=radio]:checked').trigger("change");
		}else
		if(item.jenis == "Rawat Jalan"){
			for (var i = 0; i < entry.length; i++) {
				var key = entry[i][0];
				var val = entry[i][1];
				if(val != null && val != ""){
					if(key == "nyeri_scala"){
						editNyeriScalaSlider("modal-rawat-jalan",val)						
					}
					else{
						$(`#modal-rawat-jalan textarea[name="${key}"]`).html(val);
						$(`#modal-rawat-jalan select[name="${key}"]`).val(val);
						$(`#modal-rawat-jalan :text[name="${key}"]`).val(val);
						$(`#modal-rawat-jalan :checkbox[name="${key}"]`).prop('checked', true);
						$(`#modal-rawat-jalan :radio[name="${key}"][value="${val.toLocaleString().replace(/[&\/\\#,+()$~%.'":*?<>{}]/g, '')}"]`).prop('checked', true);
					}
				}else{
					$(`#modal-rawat-jalan select[name="${key}"]`).val(val);
					$(`#modal-rawat-jalan textarea[name="${key}"]`).html(val);
					$(`#modal-rawat-jalan :text[name="${key}"]`).val(val);
					$(`#modal-rawat-jalan :checkbox[name="${key}"]`).prop('checked', false);
					$(`#modal-rawat-jalan :radio[name="${key}"]`).prop('checked', false);
					if(key == "nyeri_scala"){ editNyeriScalaSlider("modal-rawat-jalan",0) }

				}
			}
			$('#modal-rawat-jalan').modal('toggle');
		}else
		if(item.jenis == "Rawat Inap"){
			for (var i = 0; i < entry.length; i++) {
				var key = entry[i][0];
				var val = entry[i][1];
				if(val != null && val != ""){
					if(key == "nyeri_scala"){
						editNyeriScalaSlider("modal-rawat-inap",val)						
					}
					else{
						$(`#modal-rawat-inap textarea[name="${key}"]`).html(val);
						$(`#modal-rawat-inap select[name="${key}"]`).val(val);
						$(`#modal-rawat-inap :text[name="${key}"]`).val(val);
						$(`#modal-rawat-inap :checkbox[name="${key}"]`).prop('checked', true);
						$(`#modal-rawat-inap :radio[name="${key}"][value="${val.toLocaleString().replace(/[&\/\\#,+()$~%.'":*?<>{}]/g, '')}"]`).prop('checked', true);
					}
				}else{
					$(`#modal-rawat-inap select[name="${key}"]`).val(val);
					$(`#modal-rawat-inap textarea[name="${key}"]`).html(val);
					$(`#modal-rawat-inap :text[name="${key}"]`).val(val);
					$(`#modal-rawat-inap :checkbox[name="${key}"]`).prop('checked', false);
					$(`#modal-rawat-inap :radio[name="${key}"].default-radio`).prop('checked', true);
					if(key == "nyeri_scala"){ editNyeriScalaSlider("modal-rawat-inap",0) }

				}
			}
			$('#modal-rawat-inap').modal('toggle');
			countSkor();
			$('input[type=radio]:checked').trigger("change");
			$('.opsi-checkbox').trigger("change");
		}else
		if(item.jenis == "Gawat Darurat Dokter"){
			for (var i = 0; i < entry.length; i++) {
				var key = entry[i][0];
				var val = entry[i][1];
				if(val != null && val != ""){
					if(key == "nyeri_scala"){
						editNyeriScalaSlider("modal-gawat-darurat",val)						
					}else if(key == 'icd_10_1' || key == 'icd_10_2' || key == 'icd_10_3'){
					    val = val.split('; ');
                        $.each( val, function( index, value ) {
                            $(`#modal-dokter-gawat-darurat select[name="${key}[]"]`).append(new Option(value,value,true, true));
                        });
                    }
					else{
						$(`#modal-dokter-gawat-darurat textarea[name="${key}"]`).html(val);
						$(`#modal-dokter-gawat-darurat select[name="${key}"]`).val(val);
						$(`#modal-dokter-gawat-darurat :text[name="${key}"]`).val(val);
						$(`#modal-dokter-gawat-darurat :checkbox[name="${key}"]`).prop('checked', true);
						$(`#modal-dokter-gawat-darurat :radio[name="${key}"][value="${val.toLocaleString().replace(/[&\/\\#,+()$~%.'":*?<>{}]/g, '')}"]`).prop('checked', true);
					}
				}else{
					$(`#modal-dokter-gawat-darurat select[name="${key}"]`).val(val);
					$(`#modal-dokter-gawat-darurat textarea[name="${key}"]`).html(val);
					$(`#modal-dokter-gawat-darurat :text[name="${key}"]`).val(val);
					$(`#modal-dokter-gawat-darurat :checkbox[name="${key}"]`).prop('checked', false);
					$(`#modal-dokter-gawat-darurat :radio[name="${key}"]`).prop('checked', false);
					$(`#modal-dokter-gawat-darurat select[name="${key}"]`).val("").trigger("change");
					if(key == "nyeri_scala"){ editNyeriScalaSlider("modal-dokter-gawat-darurat",0) }

				}
			}
			$('#modal-dokter-gawat-darurat').modal('toggle');
		}else
		if(item.jenis == "Rawat Jalan Dokter"){
			for (var i = 0; i < entry.length; i++) {
				var key = entry[i][0];
				var val = entry[i][1];
				if(val != null && val != ""){
					if(key == "nyeri_scala"){
						editNyeriScalaSlider("modal-rawat-jalan",val)						
					}else if(key == 'icd_10_1' || key == 'icd_10_2' || key == 'icd_10_3'){
                        val = val.split('; ');
                        $.each( val, function( index, value ) {
                            $(`#modal-dokter-rawat-jalan select[name="${key}[]"]`).append(new Option(value,value,true, true));
                        });
                    }
					else{
						$(`#modal-dokter-rawat-jalan textarea[name="${key}"]`).html(val);
						$(`#modal-dokter-rawat-jalan select[name="${key}"]`).val(val);
						$(`#modal-dokter-rawat-jalan :text[name="${key}"]`).val(val);
						$(`#modal-dokter-rawat-jalan :checkbox[name="${key}"]`).prop('checked', true);
						$(`#modal-dokter-rawat-jalan :radio[name="${key}"][value="${val.toLocaleString().replace(/[&\/\\#,+()$~%.'":*?<>{}]/g, '')}"]`).prop('checked', true);
					}
				}else{
					$(`#modal-dokter-rawat-jalan select[name="${key}"]`).val(val);
					$(`#modal-dokter-rawat-jalan textarea[name="${key}"]`).html(val);
					$(`#modal-dokter-rawat-jalan :text[name="${key}"]`).val(val);
					$(`#modal-dokter-rawat-jalan :checkbox[name="${key}"]`).prop('checked', false);
					$(`#modal-dokter-rawat-jalan :radio[name="${key}"]`).prop('checked', false);
					$(`#modal-dokter-rawat-jalan select[name="${key}"]`).val("").trigger("change");
					if(key == "nyeri_scala"){ editNyeriScalaSlider("modal-dokter-rawat-jalan",0) }

				}
			}
			$('#modal-dokter-rawat-jalan').modal('toggle');
		}else
		if(item.jenis == "Rawat Inap Dokter"){
			for (var i = 0; i < entry.length; i++) {
				var key = entry[i][0];
				var val = entry[i][1];
				if(val != null && val != ""){
					if(key == "nyeri_scala"){
						editNyeriScalaSlider("modal-rawat-inap",val)						
					}else if(key == 'icd_10_1' || key == 'icd_10_2' || key == 'icd_10_3'){
                        val = val.split('; ');
                        $.each( val, function( index, value ) {
                            $(`#modal-dokter-rawat-inap select[name="${key}[]"]`).append(new Option(value,value,true, true));
                        });
                    }
					else{
						$(`#modal-dokter-rawat-inap textarea[name="${key}"]`).html(val);
						$(`#modal-dokter-rawat-inap select[name="${key}"]`).val(val);
						$(`#modal-dokter-rawat-inap :text[name="${key}"]`).val(val);
						$(`#modal-dokter-rawat-inap :checkbox[name="${key}"]`).prop('checked', true);
						$(`#modal-dokter-rawat-inap :radio[name="${key}"][value="${val.toLocaleString().replace(/[&\/\\#,+()$~%.'":*?<>{}]/g, '')}"]`).prop('checked', true);
					}
				}else{
					$(`#modal-dokter-rawat-inap select[name="${key}"]`).val(val);
					$(`#modal-dokter-rawat-inap textarea[name="${key}"]`).html(val);
					$(`#modal-dokter-rawat-inap :text[name="${key}"]`).val(val);
					$(`#modal-dokter-rawat-inap :checkbox[name="${key}"]`).prop('checked', false);
					$(`#modal-dokter-rawat-inap :radio[name="${key}"]`).prop('checked', false);
					$(`#modal-dokter-rawat-inap select[name="${key}"]`).val("").trigger("change");
					if(key == "nyeri_scala"){ editNyeriScalaSlider("modal-dokter-rawat-inap",0) }

				}
			}
			$('#modal-dokter-rawat-inap').modal('toggle');
		}
		else{
			$(`#modal-gawat-darurat textarea`).html("");
			$(`#modal-gawat-darurat :text`).val("");
			$(`#modal-gawat-darurat :checkbox`).prop('checked', false);
			$(`#modal-gawat-darurat :radio.default-radio`).prop('checked', true);
			$(`#modal-gawat-darurat select option[class="default-radio"]`).attr("selected",true);
			$(`#modal-gawat-darurat :text[name="penanggung_jawab_biaya_perawatan_pasien"]`).val("{{$kasus->pembayaran->perusahaan->nama or '-'}}");
			$(`#modal-gawat-darurat :text[name="kategori_pasien"]`).val("{{$kasus->pasien->kategori or '-'}}");

			$(`#modal-rawat-jalan textarea`).html("");
			$(`#modal-rawat-jalan :text`).val("");
			$(`#modal-rawat-jalan :checkbox`).prop('checked', false);
			$(`#modal-rawat-jalan :radio`).prop('checked', false);
			$(`#modal-rawat-jalan select option[class="default-radio"]`).attr("selected",true);

			$(`#modal-rawat-inap textarea`).html("");
			$(`#modal-rawat-inap :text`).val("");
			$(`#modal-rawat-inap :checkbox`).prop('checked', false);
			$(`#modal-rawat-inap :radio.default-radio`).prop('checked', true);
			$(`#modal-rawat-inap select option[class="default-radio"]`).attr("selected",true);
			$(`#modal-rawat-inap :text[name="penanggung_jawab_biaya_perawatan_pasien"]`).val("{{$kasus->pembayaran->perusahaan->nama or '-'}}");

			$(`#modal-dokter-gawat-darurat textarea`).html("");
			$(`#modal-dokter-gawat-darurat :text`).val("");
			$(`#modal-dokter-gawat-darurat :checkbox`).prop('checked', false);
			$(`#modal-dokter-gawat-darurat :radio`).prop('checked', false);
			$(`#modal-dokter-gawat-darurat select option[class="default-radio"]`).attr("selected",true);
			$(`#modal-dokter-gawat-darurat select[name="icd_10_1"]`).val("").trigger("change");
			$(`#modal-dokter-gawat-darurat select[name="icd_10_3"]`).val("").trigger("change");

			$(`#modal-dokter-rawat-jalan textarea`).html("");
			$(`#modal-dokter-rawat-jalan :text`).val("");
			$(`#modal-dokter-rawat-jalan :checkbox`).prop('checked', false);
			$(`#modal-dokter-rawat-jalan :radio`).prop('checked', false);
			$(`#modal-dokter-rawat-jalan select option[class="default-radio"]`).attr("selected",true);
			$(`#modal-dokter-rawat-jalan select[name="icd_10_1"]`).val("").trigger("change");
			$(`#modal-dokter-rawat-jalan select[name="icd_10_3"]`).val("").trigger("change");

			$(`#modal-dokter-rawat-inap textarea`).html("");
			$(`#modal-dokter-rawat-inap :text`).val("");
			$(`#modal-dokter-rawat-inap :checkbox`).prop('checked', false);
			$(`#modal-dokter-rawat-inap :radio`).prop('checked', false);
			$(`#modal-dokter-rawat-inap select option[class="default-radio"]`).attr("selected",true);
			$(`#modal-dokter-rawat-inap select[name="icd_10_1"]`).val("").trigger("change");
			$(`#modal-dokter-rawat-inap select[name="icd_10_3"]`).val("").trigger("change");

			countSkor();
			countSkorGizi();
			$('input[type=radio]:checked').trigger("change");
			$('.opsi-checkbox').trigger("change");
		}
		$(this).show();
		$("#edit-loading-"+id).hide();
	});

var flag_rapt_suggest_load = 0

$('#create-rapt').click(function(e){

	if(flag_rapt_suggest_load == 0) 
		startGetSuggestionTemplate();

	flag_rapt_suggest_load = 1;

	$('#id-rapt').val(null);
	$('#rapt-preventif').prop('checked', false);
	$('#rapt-kuratif').prop('checked', false);
	$('#rapt-rehab').prop('checked', false);
	$('#rapt-paliatif').prop('checked', false);
	$('#rapt-create-s').text("");
	$('#rapt-create-o').text("");
	$('#rapt-create-a').text("");
	$('#rapt-create-p').text("");
	$('#rapt-create-ppa').text("");
	$('#modal-create-rapt .perkiraan_hari_rawat').val('');
	$('#radio-button-prioritas-prioritas').prop('checked', 'checked');
	$('#radio-button-prioritas-ditunda').prop('checked', '');

});

$('.edit-rapt').click(function(e){
	if(flag_rapt_suggest_load == 0) 
		startGetSuggestionTemplate();

	flag_rapt_suggest_load = 1;

	var rapt = $(this).data('rapt');
	$('#id-rapt').val(rapt.id);
	$('#rapt-preventif').prop('checked', rapt.preventif);
	$('#rapt-kuratif').prop('checked', rapt.kuratif);
	$('#rapt-rehab').prop('checked', rapt.rehab);
	$('#rapt-paliatif').prop('checked', rapt.paliatif);
	$('#rapt-create-s').text(rapt.subjective);
	$('#rapt-create-o').text(rapt.objective);
	$('#rapt-create-a').text(rapt.assessment);
	$('#rapt-create-p').text(rapt.plan);
	$('#rapt-create-ppa').text(rapt.ppa);
	$('#modal-create-rapt .perkiraan_hari_rawat').val(rapt.perkiraan_hari_rawat);
	if(rapt.prioritas == 'prioritas')
	{
		$('#radio-button-prioritas-prioritas').prop('checked', 'checked');
		$('#radio-button-prioritas-ditunda').prop('checked', '');
	}
	else
	{
		$('#radio-button-prioritas-ditunda').prop('checked', 'checked');
		$('#radio-button-prioritas-prioritas').prop('checked', '');
	}
	
	$('#modal-create-rapt input[name=discharge_bantuan]').prop('checked', false);
	$('#modal-create-rapt input[name=discharge_diet]').prop('checked', false);
	$('#modal-create-rapt input[name=discharge_fisik]').prop('checked', false);
	$('#modal-create-rapt input[name=discharge_latihan]').prop('checked', false);
	$('#modal-create-rapt input[name=discharge_luka]').prop('checked', false);
	$('#modal-create-rapt input[name=discharge_medis]').prop('checked', false);
	$('#modal-create-rapt input[name=discharge_mobilitas]').prop('checked', false);
	$('#modal-create-rapt input[name=discharge_obat]').prop('checked', false);
	$('#modal-create-rapt input[name=discharge_perawatan]').prop('checked', false);
	$('#modal-create-rapt input[name=discharge_perawatan_diri]').prop('checked', false);
	$('#modal-create-rapt input[name=discharge_tenaga_khusus]').prop('checked', false);
	$('#modal-create-rapt input[name=discharge_umur]').prop('checked', false);


	if(rapt.discharge_planning != null)
	{
		var dp = JSON.parse(rapt.discharge_planning)

		if(dp.discharge_bantuan == 1) $('#modal-create-rapt input[name=discharge_bantuan]').prop('checked', true);
		if(dp.discharge_diet == 1) $('#modal-create-rapt input[name=discharge_diet]').prop('checked', true);
		if(dp.discharge_fisik == 1) $('#modal-create-rapt input[name=discharge_fisik]').prop('checked', true);
		if(dp.discharge_latihan == 1) $('#modal-create-rapt input[name=discharge_latihan]').prop('checked', true);
		if(dp.discharge_luka == 1) $('#modal-create-rapt input[name=discharge_luka]').prop('checked', true);
		if(dp.discharge_mobilitas == 1) $('#modal-create-rapt input[name=discharge_mobilitas]').prop('checked', true);
		if(dp.discharge_obat == 1) $('#modal-create-rapt input[name=discharge_obat]').prop('checked', true);
		if(dp.discharge_perawatan == 1) $('#modal-create-rapt input[name=discharge_perawatan]').prop('checked', true);
		if(dp.discharge_perawatan_diri == 1) $('#modal-create-rapt input[name=discharge_perawatan_diri]').prop('checked', true);
		if(dp.discharge_tenaga_khusus == 1) $('#modal-create-rapt input[name=discharge_tenaga_khusus]').prop('checked', true);
		if(dp.discharge_umur == 1) $('#modal-create-rapt input[name=discharge_umur]').prop('checked', true);
		if(dp.discharge_medis == 1) $('#modal-create-rapt input[name=discharge_medis]').prop('checked', true);
	}

});

$('.hasil-rapt').click(function(e){
	var rapt = $(this).data('rapt');
	$('#hasil-subjective-rapt').text(rapt.subjective);
	$('#hasil-objective-rapt').text(rapt.objective);
	$('#hasil-assessment-rapt').text(rapt.assessment);
	$('#hasil-plan-rapt').text(rapt.plan);
	$('#hasil-ppa-rapt').text(rapt.ppa);
});

$(".deleteAsesmenBtn").click(function(e){
	e.preventDefault();
	id = $(this).data("id");
	$('#deleteAsesmenId').val(id);
	swal({
		title: "Hapus",
		text: "Apakah anda yakin akan menghapus asesmen ini?",
		showCancelButton: true,
		reverseButtons: true,
		type: 'warning',
		confirmButtonClass: "btn btn-danger",
		cancelButtonClass: "btn btn-default",
		confirmButtonText: "Hapus",
		cancelButtonText: "Kembali",
		closeOnConfirm: false
	}).then(function(result) {
		if(result.value)
		{
			$('#formDeleteAsesmen').submit();
		}
	});
});
$(".deleteRaptBtn").click(function(e){
	e.preventDefault();
	id = $(this).data("id");
	$('#deleteRaptId').val(id);
	swal({
		title: "Hapus",
		text: "Apakah anda yakin akan menghapus RAPT ini?",
		showCancelButton: true,
		reverseButtons: true,
		type: 'warning',
		confirmButtonClass: "btn btn-danger",
		cancelButtonClass: "btn btn-default",
		confirmButtonText: "Hapus",
		cancelButtonText: "Kembali",
		closeOnConfirm: false
	}).then(function(result) {
		if(result.value)
		{
			$('#formDeleteRapt').submit();
		}
	});
});

function calculate(el, jenis){
	var score = 0;
	var table = $(el).closest(`table`);
	var checked = table.find(`input[type=radio]:checked`);

	checked.each(function(i, item){
		score += parseInt(item.value);
	});
	table.find(`.input-skor-${jenis}`).val(score);
	table.find(`.skor-${jenis}`).html(score);
}

function calculateSelect(el, jenis){
	var score = 0;
	var wrapper = $(el).closest(`.form-single-wrapper`);

	var select = wrapper.find(`select`);

	select.each(function(i, item){
		score += parseInt(item.value);
	});
	wrapper.find(`.input-skor-${jenis}`).val(score);
	wrapper.find(`.skor-${jenis}`).html(score);
	wrapper.find(`.analisis-skor-${jenis}`).hide()
	wrapper.find(`.analisis-skor-${jenis}-${score}`).show();
}

function raptPrint(id)
{
	window.open('{{url('')}}/kasus/{{$kasus->nomor_kasus}}/datamedis/cppt/print-rapt/'+id, '_blank');
}

$(".nyeri_scala_input").ionRangeSlider({
    min: $(this).data('min'),
    max: $(this).data('max')
});

$('.nyeri_scala_input').change(function(){
	var value = $(this).val();
	var number = 1
	if(value == 0) number = 1
	else if(value >= 1 && value <= 2) number = 2
	else if(value >= 3 && value <= 4) number = 3
	else if(value >= 5 && value <= 6) number = 4
	else if(value >= 7 && value <= 8) number = 5
	else if(value >= 9 && value <= 10) number = 6

	$(this).closest('.skrining-nyeri-wrapper').find('.img-pain-scale-face').attr("src","{{url('assets/img/kasus')}}/pain-scale-face-"+number+".jpg");
})

function editNyeriScalaSlider(modal_id, value)
{
	var instance = $("#"+modal_id+" .nyeri_scala_input").data("ionRangeSlider");
	if(instance){
	    instance.update({
	    from: value
	    });
    }
}

$('.icd10-search').select2({
    ajax: {
        url: API_URL+"/kasus/get/list/diagnosis",
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
            var icd = JSON.parse(data).data;
            return {
                results: $.map(icd, function(obj) {
                    return { id: obj.code_icd+" - "+obj.long_desc, text: obj.code_icd+" - "+obj.long_desc };
                })
            };
        },
        cache: true
    },
    minimumInputLength: 3,
    placeholder: "Cari ICD 10",
});



function formatICD10 (item) {
    if (item.loading) {
        return item.text;
    }

    var markup = item.code_icd + ' - '+ item.long_desc;;

    return markup;
}

function formatICD10Selection (item) {
    if(item.code_icd){
        var markup = item.code_icd + ' - '+ item.long_desc;;
        return markup;
    }
    else return item.text;
}

$('.icd9-search').select2({
    ajax: {
        url: API_URL+"/kasus/get/list/icd9",
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
    placeholder: "Cari ICD 9",
    templateResult: formatICD9,
    templateSelection: formatICD9Selection
});

function formatICD9 (item) {
    if (item.loading) {
        return item.text;
    }

    var markup = item.code_icd + ' - '+ item.long_desc;

    return markup;
}

function formatICD9Selection (item) {
    if(item.code_icd){
        var markup = item.code_icd + ' - '+ item.long_desc;
        return markup;
    }
    else return item.text;
}

function countSkor() {
	$('.opsi-radio').change(function() {
		var skor = $(this).data("skor");
		$(`input[name="${$(this).attr('name')}_skor"]`).val(skor);
		countTotalSkor();
	});

	$('.opsi-checkbox').change(function() {
		var skor = $(this).data("skor");
		if(this.checked) {
			$(`input[name="${$(this).attr('name')}_skor"]`).val(skor);
			console.log("check");
		}
		else{
			$(`input[name="${$(this).attr('name')}_skor"]`).val(0);
		}
		countTotalSkor();
	});
}

function countTotalSkor() {
	var total_skor = 0;
	$('.block-skor-radio input[type=hidden]').each(function() {
		var skor_data = $(this).val();
		var name = $(this).attr('name');
		total_skor += parseInt(skor_data);
	});

	$('.block-skor-checkbox input[type=hidden]').each(function() {
		var skor_data = $(this).val();
		var name = $(this).attr('name');
		console.log(name, skor_data);
		total_skor += parseInt(skor_data);
	});
	$('#total_skor').html('Total Skor : ' + total_skor);
}

function countSkorGizi() {
	$('input[type=radio]').change(function() {
		var skor = $(this).data("skor");
		$(`input[name="${$(this).attr('name')}_skor"]`).val(skor);
		countTotalSkorGizi();
	});
}

function countTotalSkorGizi() {
	var total_skor = 0;
	$('.block-skor-gizi input[type=hidden]').each(function() {
		var skor_data = $(this).val();
		var name = $(this).attr('name');
		total_skor += parseInt(skor_data);
	});
	$('#total_skor_gizi').html('Total Skor : ' + total_skor);
}

function addJenis() {
	var row = 
	`<div class="col-12 row child">
        <div class="col-md-3">
            <div class="form-group row mb-5">
                <label class="col-12">Jam</label>
                <div class="col-12">
                    <input type="text" class="form-control time" name="jam_implementasi_keperawatan[]">
                </div>
            </div>  
        </div>
        <div class="col-md-7">
            <div class="form-group row mb-5">
                <label class="col-12">Tindakan</label>
                <div class="col-12">
                    <input type="text" class="form-control" name="tindakan_implementasi_keperawatan_array[]">
                </div>
            </div>  
        </div>
        <div class="col-2">
            <button type="button" class="btn btn-danger btn-simple delete_keperawatan mt-30">
                <i class="fa fa-trash"></i>
            </button>
        </div>
    </div>`;

	$('.row_keperawatan').append(row);
}


$('.add_keperawatan').click(function() {
	addJenis();
	time();
});


$('.row_keperawatan').on('click', '.delete_keperawatan', function(){
	if($('.row_keperawatan .child').length > 1){
		$(this).closest('.child').remove();
	}
});

function time() {
	$(".time").mask("00:00");
}

function removeAllKeperawatan() {
	var row = $('.row_keperawatan .child');
	if(row.length > 1){
		for (var i = 1; i < row.length; i++) {
			row[i].remove();
		}
	}
}

function removeAllIcd10() {
    var row = $('.icd10-search option');
    if(row.length > 0){
        for (var i = 0; i < row.length; i++) {
            row[i].remove();
        }
    }
}


</script>