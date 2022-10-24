
<script type="text/javascript">
    $('#create-timbang').click(function(e){
        $('#id-timbang').val(null);
        $('#timbang-create-s').text("");
        $('#timbang-create-o').text("");
        $('#timbang-create-a').text("");
        $('#timbang-create-p').text("");
        $('#timbang-create-ppa').val("");
    });

    $('.edit-timbang').click(function(e){
        $('.suggest-main-loading').hide()
        var timbang = $(this).data('timbang');
        $('#id-timbang').val(timbang.id);
        $('#timbang-create-s').text(timbang.subjective);
        $('#timbang-create-o').text(timbang.objective);
        $('#timbang-create-a').text(timbang.assessment);
        $('#timbang-create-p').text(timbang.plan);
        $('#timbang-create-ppa').val(timbang.ppa);
        $('#timbang-create-e').val(timbang.evaluasi);
    });
    $(".deleteTimbangBtn").click(function(e){
        e.preventDefault();
        id = $(this).data("id");
        $('#deleteTimbangId').val(id);
        swal({
            title: "Hapus",
            text: "Apakah anda yakin akan menghapus data timbang terima ini?",
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
                $('#formDeleteTimbang').submit();
            }
        });
    });
    
    var flag_suggest_load  = 0;

    function timbangCreate()
    {
        if(flag_suggest_load == 0){
            startGetSuggestionTemplate();
            $('.suggest-main-loading').show()
        }

        flag_suggest_load = 1;

        $('#loading-top').fadeIn();
        $('#timbang-create-s').val('')
        $('#timbang-create-o').val('')
        $('#timbang-create-a').val('')
        $('#timbang-create-p').val('')
        $('#timbang-create-ppa').val('')
        $('#timbang-create-e').val('')
        $('#modal-create-timbang-terima').modal('show');
        $('#loading-top').hide();
    }

    function startGetSuggestionTemplate()
    {
        $('.suggest-cppt-loading').show()
        var success_s = getSuggestion('/kasus/{{$kasus->nomor_kasus}}/suggest/timbang-cppt-suggest','main');
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
                    if(item.subjective != null) var subjective = item.subjective;
                    else var subjective = ''

                    if(item.objective != null) var objective = item.objective;
                    else var objective = ''

                    if(item.assessment != null) var assessment = item.assessment;
                    else var assessment = ''

                    if(item.plan != null) var plan = item.plan;
                    else var plan = ''
                        
                    if(item.ppa != null) var ppa = item.ppa;
                    else var ppa = ''
                        
                    var text_fill_s = subjective.replace(/<br>/g, '\n'); 
                    var text_fill_o = objective.replace(/<br>/g, '\n'); 
                    var text_fill_a = assessment.replace(/<br>/g, '\n'); 
                    var text_fill_p = plan.replace(/<br>/g, '\n'); 
                    var text_fill_i = ppa.replace(/<br>/g, '\n'); 
                    

                    content += '<a href="javascript:void(0)" class="badge badge-primary mr-5 mb-5 badge-lg badge-outline js-tooltip-enabled suggest-item" data-toggle="tooltip" data-placement="bottom" data-html="true" title="'+item.subtitle+'" data-text-s="'+text_fill_s+'" data-text-o="'+text_fill_o+'" data-text-a="'+text_fill_a+'" data-text-p="'+text_fill_p+'" data-text-i="'+text_fill_i+'">'+item.title+'</a>'
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

        var text_s = $(this).data("text-s");
        var text_o = $(this).data("text-o");
        var text_a = $(this).data("text-a");
        var text_p = $(this).data("text-p");
        var text_i = $(this).data("text-i");

        $('#timbang-create-s').val(text_s);
        $('#timbang-create-o').val(text_o);
        $('#timbang-create-a').val(text_a);
        $('#timbang-create-p').val(text_p);
        $('#timbang-create-ppa').val(text_i);
    });
</script>