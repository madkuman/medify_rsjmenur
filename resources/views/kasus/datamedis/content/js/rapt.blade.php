 <script type="text/javascript">
 	function startGetSuggestionTemplate()
 	{
 		$('.suggest-subjective-loading').show()
 		$('.suggest-objectve-loading').show()
 		$('.suggest-plan-loading').show()
 		var success_s = getSuggestion('/kasus/{{$kasus->nomor_kasus}}/suggest/cppt-subjective-template','subjective');
 		var success_o = getSuggestion('/kasus/{{$kasus->nomor_kasus}}/suggest/cppt-objective-template','objective');
 		var success_p = getSuggestion('/kasus/{{$kasus->nomor_kasus}}/suggest/cppt-plan-template','plan');

 	}

 	function getSuggestion(url,class_element)
    {
        $.ajax({
            url: API_URL + url,
            type: 'GET',
            dataType: 'json',
            tryCount : 0,
            retryLimit : 3,
            beforeSend: function(){
            },
            success: function(data) {
                $('.suggest-'+class_element+'-loading').show()
                var content = '';
                $.each(data, function(key, item) {
                    var str = item.text;
                    var text_fill = str.replace(/<br>/g, '\n'); 

                    content += '<a href="javascript:void(0)" class="badge badge-primary mr-5 mb-5 badge-lg badge-outline js-tooltip-enabled suggest-item" data-type="'+class_element+'" data-text="'+text_fill+'" data-toggle="tooltip" data-placement="bottom" title="'+item.text+'" data-html="true">'+item.title+'</a>'
                });
                $("body").tooltip({
                    selector: '[data-toggle="tooltip"]'
                });

                $('.suggest-'+class_element).append(content)
                $('.suggest-'+class_element+'-loading').hide()
                return 1;
            },
            error:function(data){
                this.tryCount++;
                if (this.tryCount <= this.retryLimit) {
                    
                    $.ajax(this);
                    return 1;
                }else{
                    return 1;
                }  
            }
        });
    }

    $(document).on('click', '.suggest-item', function(){ 

        var type = $(this).data("type")
        var content = $(this).data("text");
        if(type == 'subjective') {
            var short_type = 's'
            var cppt_type = 'rapt'
        }
        else if(type == 'objective') {
            var short_type = 'o'
            var cppt_type = 'rapt'
        }
        else if(type == 'assessment') {
            var short_type = 'a'
            var cppt_type = 'rapt'
        }
        else if(type == 'plan') {
            var short_type = 'p'
            var cppt_type = 'rapt'
        }

        var old_content = $('#'+cppt_type+'-create-'+short_type).val();
        if(old_content != '') old_content = old_content + '\n'
        $('#'+cppt_type+'-create-'+short_type).val(old_content + content)
    });

    $(document).on('click', '.suggest-item-diagnosis', function(){ 

        var type = $(this).data("type")
        var content = $(this).data("text");

    	var short_type = 'a'
    	var cppt_type = 'rapt'
        var old_content = $('#'+cppt_type+'-create-'+short_type).val();
        var new_content = old_content.replace(new RegExp(keyword_assessment + '$'), content);
        $('#'+cppt_type+'-create-'+short_type).val(new_content + '\n');
        $('.suggest-assessment').empty()
    });


    var typingTimer;                
    var doneTypingInterval = 500; 
    var keyword_assessment;

    $('#rapt-create-a').bind('input propertychange', function() {
    	var text = this.value;
    	var text_array = text.split("\n")
    	keyword_assessment = text_array[text_array.length-1];

        clearTimeout(typingTimer);
        typingTimer = setTimeout(searchDiagnosis, doneTypingInterval);

    });

    function searchDiagnosis()
    {
    	var check = keyword_assessment.replace(" ","")
    	if(check == '') return
        $('.suggest-assessment-loading').show()
    	$.ajax({
            url: API_URL+"/kasus/get/list/diagnosis?keyword="+keyword_assessment,
            type: 'GET',
            dataType: 'json',
            tryCount : 0,
            retryLimit : 3,
            beforeSend: function(){
            },
            success: function(response) {
            	data = response.data
            	data_short = data.slice(0,5)

        		$('.suggest-assessment-loading').show()
                var content = '';
                $.each(data_short, function(key, item) {
                    var str = item.code_icd +' - '+ item.long_desc;
                    var text_fill = str.replace(/<br>/g, '\n'); 

                    content += '<a href="javascript:void(0)" class="badge badge-primary mr-5 mb-5 badge-lg badge-outline js-tooltip-enabled suggest-item-diagnosis" data-type="assessment" data-text="'+text_fill+'" >'+text_fill+'</a>'
                });
                $("body").tooltip({
                    selector: '[data-toggle="tooltip"]'
                });

                $('.suggest-assessment').empty()
                $('.suggest-assessment').append(content)
                $('.suggest-assessment-loading').hide()
                return 1;
            },
            error:function(data){
                this.tryCount++;
                if (this.tryCount <= this.retryLimit) {
                    
                    $.ajax(this);
                    return 1;
                }else{
                    return 1;
                }  
            }
        });
    }


 </script>