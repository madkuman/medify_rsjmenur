
<script type="text/javascript">
	/*DIAGNOSIS*/
	function diagnosisDeleteModal(id,index)
	{
		$('#diagnosisDeleteModal #diagnosis-id').val(id)
		$('#diagnosisDeleteModal').modal('show');
	}

	$('#modal-ganti-diagnosis #submit-create-diagnosis').prop('disabled',true);
	var AutoCompleteCreateDiagnosis = function() {

		var ListLayanan = {};
        //console.log(ListLayanan)

        var initAutoComplete = function(){
        	jQuery('.diagnosis-autocomplete').autoComplete({
        		minChars: 2,
        		source: function(term, suggest){
        			term = term.toLowerCase();
        			
        			$.ajax({
        				url: API_URL+"/kasus/get/list/diagnosis?keyword="+term,
        				type: 'GET',
        				dataType: 'json',
        				tryCount : 0,
        				retryLimit : 3,
        				beforeSend: function(){
        					$('#diagnosis_error_wrapper').hide();
        				},
        				success: function(response) {
        					data = response.data
        					if(data.length > 0){
        						for (i = 0; i < data.length; i++) {
        							var suggestword = data[i].code_icd+" - "+data[i].long_desc;
        							ListLayanan[suggestword] = data[i];
        							suggestions.push(suggestword);
        							var suggestword = {};
        						}
        						suggest(suggestions);
        					}
        					else
        					{
        						$('#diagnosis_error_wrapper').text('Diagnosis tidak ditemukan, gunakan keyword lain').show();
        					}
        				},
        				error: function() {
        					this.tryCount++;
        					if (this.tryCount <= this.retryLimit) {
        						$.ajax(this);
        						return;
        					}            
        					return;
        				},
        			});

        			var suggestions    = [];


        		},
        		onSelect: function(event, term, item) {

        			$("#modal-ganti-diagnosis #id-diagnosis").val(ListLayanan[term].id)
        			$('#modal-ganti-diagnosis #submit-create-diagnosis').prop('disabled',false);
                    //$("#tindakan-input-edit-daftar-id").val(ListLayanan[term].id);
                }
            });
        };

        return {
        	init: function () {
        		initAutoComplete();
        	}
        };
    }();


    function addDiagnosisSuggest(element)
    {
    	id = $(element).data("id");
    	desc = $(element).data("desc");

    	$('#id-diagnosis').val(id)
    	$('#nama-diagnosis').val(desc)
    	$('#modal-ganti-diagnosis #submit-create-diagnosis').prop('disabled',false);
    }
    AutoCompleteCreateDiagnosis.init();
</script>