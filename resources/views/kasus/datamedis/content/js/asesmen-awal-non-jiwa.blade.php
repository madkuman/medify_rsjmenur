
<script src="{{url("")}}/assets/js/plugins/jquery-masked-inputs/jquery.mask.min.js"></script>
<script type="text/javascript">    
	var data = JSON.parse({!!json_encode(str_replace("`", "'", $asesmen_non_jiwa))!!});

	$('.editAsesmenNonJiwaBtn').click(function(e) {
		// removeAllKeperawatan();
		var id = $(this).data('id');
		$('.id-asesmen').val(id);
		$(this).hide();
		$("#edit-loading-"+id).show();
		removeAllIcd10();
		var item = JSON.parse(data[id].val);
		var entry = Object.entries(item);
		if(item.jenis == "Gawat Darurat Dokter Non Jiwa"){
			for (var i = 0; i < entry.length; i++) {
				var key = entry[i][0];
				var val = entry[i][1];
				if(val != null && val != ""){
					$(`#modal-dokter-gawat-darurat-non-jiwa textarea[name="${key}"]`).html(val);
					$(`#modal-dokter-gawat-darurat-non-jiwa select[name="${key}"]`).val(val);
					$(`#modal-dokter-gawat-darurat-non-jiwa :text[name="${key}"]`).val(val);
					$(`#modal-dokter-gawat-darurat-non-jiwa :checkbox[name="${key}"]`).prop('checked', true);
				}
			}
			$('#modal-dokter-gawat-darurat-non-jiwa').modal('toggle');
		}
		else if(item.jenis == "Rawat Jalan Dokter Non Jiwa"){
			for (var i = 0; i < entry.length; i++) {
				var key = entry[i][0];
				var val = entry[i][1];
				if(val != null && val != ""){
					$(`#modal-dokter-rawat-jalan-non-jiwa textarea[name="${key}"]`).html(val);
					$(`#modal-dokter-rawat-jalan-non-jiwa select[name="${key}"]`).val(val);
					$(`#modal-dokter-rawat-jalan-non-jiwa :text[name="${key}"]`).val(val);
					$(`#modal-dokter-rawat-jalan-non-jiwa :checkbox[name="${key}"]`).prop('checked', true);
				}
			}
			$('#modal-dokter-rawat-jalan-non-jiwa').modal('toggle');
		}
		else if(item.jenis == "Rawat Inap Dokter Non Jiwa"){
			for (var i = 0; i < entry.length; i++) {
				var key = entry[i][0];
				var val = entry[i][1];
				if(val != null && val != ""){
					$(`#modal-dokter-rawat-inap-non-jiwa textarea[name="${key}"]`).html(val);
					$(`#modal-dokter-rawat-inap-non-jiwa select[name="${key}"]`).val(val);
					$(`#modal-dokter-rawat-inap-non-jiwa :text[name="${key}"]`).val(val);
					$(`#modal-dokter-rawat-inap-non-jiwa :checkbox[name="${key}"]`).prop('checked', true);
				}
			}
			$('#modal-dokter-rawat-inap-non-jiwa').modal('toggle');
		}
		else{
			$(`#modal-dokter-gawat-darurat-non-jiwa textarea`).html("");
			$(`#modal-dokter-gawat-darurat-non-jiwa :text`).val("");
			$(`#modal-dokter-gawat-darurat-non-jiwa :checkbox`).prop('checked', false);
			$(`#modal-dokter-gawat-darurat-non-jiwa :radio`).prop('checked', false);
			$(`#modal-dokter-gawat-darurat-non-jiwa select option[class="default-radio"]`).attr("selected",true);
			$(`#modal-dokter-gawat-darurat-non-jiwa select[name="icd_10_1"]`).val("").trigger("change");
			$(`#modal-dokter-gawat-darurat-non-jiwa select[name="icd_10_3"]`).val("").trigger("change");

			$(`#modal-dokter-rawat-jalan-non-jiwa textarea`).html("");
			$(`#modal-dokter-rawat-jalan-non-jiwa :text`).val("");
			$(`#modal-dokter-rawat-jalan-non-jiwa :checkbox`).prop('checked', false);
			$(`#modal-dokter-rawat-jalan-non-jiwa :radio`).prop('checked', false);
			$(`#modal-dokter-rawat-jalan-non-jiwa select option[class="default-radio"]`).attr("selected",true);
			$(`#modal-dokter-rawat-jalan-non-jiwa select[name="icd_10_1"]`).val("").trigger("change");
			$(`#modal-dokter-rawat-jalan-non-jiwa select[name="icd_10_3"]`).val("").trigger("change");

			$(`#modal-dokter-rawat-inap-non-jiwa textarea`).html("");
			$(`#modal-dokter-rawat-inap-non-jiwa :text`).val("");
			$(`#modal-dokter-rawat-inap-non-jiwa :checkbox`).prop('checked', false);
			$(`#modal-dokter-rawat-inap-non-jiwa :radio`).prop('checked', false);
			$(`#modal-dokter-rawat-inap-non-jiwa select option[class="default-radio"]`).attr("selected",true);
			$(`#modal-dokter-rawat-inap-non-jiwa select[name="icd_10_1"]`).val("").trigger("change");
			$(`#modal-dokter-rawat-inap-non-jiwa select[name="icd_10_3"]`).val("").trigger("change");
		}
		$(this).show();
		$("#edit-loading-"+id).hide();
	});

$(".deleteAsesmenNonJiwaBtn").click(function(e){
	e.preventDefault();
	id = $(this).data("id");
	$('#deleteAsesmenNonJiwaId').val(id);
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
			$('#formDeleteAsesmenNonJiwa').submit();
		}
	});
});

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

function time() {
	$(".time").mask("00:00");
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