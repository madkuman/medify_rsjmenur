<script type="text/javascript">
    var allow_crud = {{$allow_crud}};
    /*CPPT*/
    function cpptEditModal(id,index)
    {
        $('#loading-top').fadeIn();
        $.ajax({
            url: API_URL + '/kasus/{{$kasus->nomor_kasus}}/datamedis/cppt/'+ id,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                $('#cpptModalEdit #title-number').html('' + index);
                var subj = data.subjective
                var obj = data.objective
                var ass = data.assessment
                var plan = data.plan
                var ppa = data.ppa

                $('#cppt-edit-id').val(id)
                $('#cppt-edit-s').val(subj)
                $('#cppt-edit-o').val(obj)
                $('#cppt-edit-a').val(ass)
                $('#cppt-edit-p').val(plan)
                $('#cppt-edit-ppa').val(ppa)
                $('#cpptModalEdit').modal('show');
                $('#loading-top').hide();
            },
            error: function() {
            },
        });
    }


    function cpptDeleteModal(id,index)
    {
        $('#cpptModalDelete #title-number').html('' + index);
        $('#cppt-delete-id').val(id)
        $('#cpptModalDelete').modal('show');
    }
    function cpptDeletefileModal(id,path)
    {
        $('#cppt-delete-path').val(path)
        $('#cppt-deletefile-id').val(id)
        $('#cpptModalDeletefile').modal('show');
    }

    function cpptPrint(id)
    {
        window.open('{{url('')}}/kasus/{{$kasus->nomor_kasus}}/datamedis/cppt/print/'+id, '_blank');
    }

    function raptPrint(id)
    {
        window.open('{{url('')}}/kasus/{{$kasus->nomor_kasus}}/datamedis/cppt/print-rapt/'+id, '_blank');
    }

    function cpptCopy(id,nomor_kasus = null)
    {
        $('#cppt-histori-modal').modal('hide');
        $('#loading-top').fadeIn();
        if(nomor_kasus == null) {
            nomor_kasus = '{{$kasus->nomor_kasus}}';
        }
        $.ajax({
            url: API_URL + '/kasus/'+nomor_kasus+'/datamedis/cppt/'+ id,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                var subj = data.subjective
                var obj = data.objective
                var ass = data.assessment
                var plan = data.plan
                var ppa = data.ppa

                $('#cppt-create-s').val(subj)
                $('#cppt-create-o').val(obj)
                $('#cppt-create-a').val(ass)
                $('#cppt-create-p').val(plan)
                $('#cppt-create-ppa').val(ppa)
                $('#modal-create-cppt').modal('show');
                $('#loading-top').hide();
            },
            error: function() {
            },
        });
    }

    var flag_cppt_suggest_load = 0;
    var flag_adime_suggest_load = 0;

    function cpptCreate()
    {
        if(flag_cppt_suggest_load == 0){
            startGetSuggestionTemplate();
            @if(Auth::user()->profesi == 2)
            startGetSuggestionPerawat();
            @elseif(Auth::user()->specialty == 52)
            startGetSuggestionFarmasi();
            @endif
        }

        flag_cppt_suggest_load = 1;

        $('#loading-top').fadeIn();
        $('#cppt-create-s').val('')
        $('#cppt-create-o').val('')
        $('#cppt-create-a').val('')
        $('#cppt-create-p').val('')
        $('#cppt-create-ppa').val('')
        $('#cppt-create-files').val('')
        $('#modal-create-cppt').modal('show');
        $('#loading-top').hide();
    }

     function adimeCreate()
    {
        if(flag_adime_suggest_load == 0){
            startGetSuggestionGizi();
        }

        flag_adime_suggest_load = 1;
        
        $('#loading-top').fadeIn();
        $('#adime-id').val("");
        $('#adime-create-a').val('')
        $('#adime-create-d').val('')
        $('#adime-create-i').val('')
        $('#adime-create-m').val('')
        $('#adime-create-e').val('')
        $('#modal-create-adime').modal('show');
        $('#loading-top').hide();
    }

    function adimeEdit(adime)
    {
        $('#loading-top').fadeIn();
        $('#adime-id').val(adime.id);
        $('#adime-create-a').val(adime.assessment);
        $('#adime-create-d').val(adime.subjective);
        $('#adime-create-i').val(adime.objective);
        $('#adime-create-m').val(adime.plan);
        $('#adime-create-e').val(adime.ppa);
        $('#modal-create-adime').modal('show');
        $('#loading-top').hide();
    }

    function cpptOverrideModal(id, index)
    {
        $('#cpptModalOverride #title-number').html('' + index);
        $('#cppt-override-id').val(id)
        $('#cpptModalOverride').modal('show');
    }

    function cpptReviewModal(id, index)
    {
        $('#modal-review-cppt .block-title').html('Review CPPT ' + index);
        $('#modal-review-cppt .cppt-id').val(id)
        $('#modal-review-cppt').modal('show');
    }

    function markedPrintCPPT(id, index, sudah_termarked)
    {
        var success_message = sudah_termarked == true ?  'Marked print CPPT Berhasil dihapus' : 'CPPT berhasil di marked print';
        $.ajax({
            url: API_URL + '/kasus/{{$kasus->nomor_kasus}}/cppt/marked-print/'+ id,
            type: 'GET',
            dataType: 'json',
            tryCount : 0,
            retryLimit : 3,
            beforeSend: function(){
                $('#cppt_button_verifikasi_loading_'+index).show()
            },
            success: function(data) {
                $.notify({
                title: '<strong>Sukses</strong>',
                message: success_message
                    },{
                    type: 'primary',
                    placement: {
                        from: "top",
                        align: "center"
                    },
                    delay: 3000
                });

                $('#cppt_button_verifikasi_loading_'+index).hide()
                $(`#marked-print-cppt-${index}`).empty();
                $(this).data('toogle', null);
                if(sudah_termarked) {
                    $(`#marked-print-cppt-${index}`).append(`
                        <button type="button" class="btn-block-option" title="Marked Print" onclick="markedPrintCPPT( ${id} , ${index}, false )">
                            <i class="si si-flag"></i>
                        </button>
                    `);
                } else {
                    $(`#marked-print-cppt-${index}`).append(`
                        <button type="button" class="btn-block-option" title="Hapus Marked Print" onclick="markedPrintCPPT( ${id} , ${index}, true )">
                            <i class="fa fa-flag"></i>
                        </button>
                    `);
                }

            },
            error:function(error){
                console.log('error marked print cppt', error);
                
                $.notify({
                    title: '<strong>Sorry</strong>',
                    message: 'Terjadi kesalahan server, tidak dapat memproses Markted Print CPPT '
                },{
                    type: 'danger',
                    placement: {
                        from: "top",
                        align: "center"
                    },
                    delay: 3000
                });
                $('#cppt_button_verifikasi_loading_'+index).hide();
            }
        });
    } 

    function cpptVerifikasi(id, index)
    {
        $.ajax({
            url: API_URL + '/kasus/{{$kasus->nomor_kasus}}/cppt/verifikasi/'+ id,
            type: 'GET',
            dataType: 'json',
            tryCount : 0,
            retryLimit : 3,
            beforeSend: function(){
                $('#cppt_button_verifikasi_loading_'+index).show()
                $('#cppt_button_verifikasi_check'+index).hide()
            },
            success: function(data) {
               $.notify({
                title: '<strong>Sukses</strong>',
                message: 'CPPT '+index+' berhasil diverifikasi.'
                    },{
                    type: 'primary',
                    placement: {
                        from: "top",
                        align: "center"
                    },
                    delay: 3000
                });

                $('#cppt_button_verifikasi_loading_'+index).hide()
                $('#cppt_button_verifikasi_'+index).hide()
                $('#cppt_container_verified_'+index).show();
                $('#cppt_verified_by_'+index).text(data.verified_by);
                $('#cppt_verified_at_'+index).text(data.verified_at);

            },
            error:function(data){
                this.tryCount++;
                if (this.tryCount <= this.retryLimit) {
                    
                    $.ajax(this);
                    return;
                }else{
                    $.notify({
                        title: '<strong>Sorry</strong>',
                        message: 'Terjadi kesalahan server, tidak dapat memverifikasi CPPT '+index
                    },{
                        type: 'danger',
                        placement: {
                            from: "top",
                            align: "center"
                        },
                        delay: 3000
                    });
                    $('#cppt_button_verifikasi_loading_'+index).hide()
                    $('#cppt_button_verifikasi_check'+index).show()
                }  
            }
        });
    } 


    function cpptVerifikasiNERS(id, index)
    {
        $.ajax({
            url: API_URL + '/kasus/{{$kasus->nomor_kasus}}/cppt/verifikasi-ners/'+ id,
            type: 'GET',
            dataType: 'json',
            tryCount : 0,
            retryLimit : 3,
            beforeSend: function(){
                $('#cppt_button_verifikasi_ners_loading_'+index).show()
                $('#cppt_button_verifikasi_ners_loading_'+index).hide()
            },
            success: function(data) {
               $.notify({
                title: '<strong>Sukses</strong>',
                message: 'CPPT '+index+' berhasil diverifikasi.'
                    },{
                    type: 'primary',
                    placement: {
                        from: "top",
                        align: "center"
                    },
                    delay: 3000
                });

                $('#cppt_button_verifikasi_ners_loading_'+index).hide()
                $('#cppt_button_verifikasi_ners_'+index).hide()
                $('#cppt_ners_container_verified_'+index).show();
                $('#cppt_ners_verified_by_'+index).text(data.verified_by);
                $('#cppt_ners_verified_at_'+index).text(data.verified_at);

            },
            error:function(data){
                this.tryCount++;
                if (this.tryCount <= this.retryLimit) {
                    
                    $.ajax(this);
                    return;
                }else{
                    $.notify({
                        title: '<strong>Sorry</strong>',
                        message: 'Terjadi kesalahan server, tidak dapat memverifikasi CPPT '+index
                    },{
                        type: 'danger',
                        placement: {
                            from: "top",
                            align: "center"
                        },
                        delay: 3000
                    });
                    $('#cppt_button_verifikasi_loading_'+index).hide()
                    $('#cppt_button_verifikasi_check'+index).show()
                }  
            }
        });
    }



    /*SUGGEST*/

    function startGetSuggestionTemplate()
    {
        $('.suggest-subjective-loading').show()
        $('.suggest-objectve-loading').show()
        $('.suggest-plan-loading').show()
        var success_s = getSuggestion('/kasus/{{$kasus->nomor_kasus}}/suggest/cppt-subjective-template','subjective');
        var success_o = getSuggestion('/kasus/{{$kasus->nomor_kasus}}/suggest/cppt-objective-template','objective');
        var success_p = getSuggestion('/kasus/{{$kasus->nomor_kasus}}/suggest/cppt-plan-template','plan');
       
    }
    function startGetSuggestionDokter()
    {
        $('.suggest-subjective-loading').show()
        $('.suggest-assessment-loading').show()
        $('.suggest-plan-loading').show()
        var success_s = getSuggestion('/kasus/{{$kasus->nomor_kasus}}/suggest/cppt-subjective','subjective');
        var success_a = getSuggestion('/kasus/{{$kasus->nomor_kasus}}/suggest/cppt-assessment','assessment');
        var success_p_resep = getSuggestion('/kasus/{{$kasus->nomor_kasus}}/suggest/cppt-plan-resep','plan');
        var success_p_icd9 = getSuggestion('/kasus/{{$kasus->nomor_kasus}}/suggest/cppt-plan-icd9','plan');
       
    }

    function startGetSuggestionPerawat()
    {
        $('.suggest-objective-loading').show()
        $('.suggest-subjective-loading').show()
        $('.suggest-assessment-loading').show()
        $('.suggest-plan-loading').show()

        var success_o_ttv = getSuggestion('/kasus/{{$kasus->nomor_kasus}}/suggest/cppt-objective-ttv','objective');
        var success_o_keperawatan = getSuggestion('/kasus/{{$kasus->nomor_kasus}}/suggest/cppt-objective-keperawatan','objective');
        var success_o_keperawatan = getSuggestion('/kasus/{{$kasus->nomor_kasus}}/suggest/cppt-objective-evaluasi-implementasi-keperawatan','objective');
        var success_s_keperawatan = getSuggestion('/kasus/{{$kasus->nomor_kasus}}/suggest/cppt-subjective-keperawatan','subjective');
        var success_a_keperawatan = getSuggestion('/kasus/{{$kasus->nomor_kasus}}/suggest/cppt-assessment-keperawatan','assessment');
        var success_p_keperawatan = getSuggestion('/kasus/{{$kasus->nomor_kasus}}/suggest/cppt-plan-keperawatan','plan');
        
    }

    function startGetSuggestionFarmasi()
    {
        $('.suggest-assessment-loading').show()
        $('.suggest-plan-loading').show()

        var success_a_keperawatan = getSuggestion('/kasus/{{$kasus->nomor_kasus}}/suggest/cppt-assessment-farmasi','assessment');
        var success_p_keperawatan = getSuggestion('/kasus/{{$kasus->nomor_kasus}}/suggest/cppt-plan-farmasi','plan');
    }



    function startGetSuggestionGizi()
    {
        $('.suggest-adime-assessment-loading').show()
        $('.suggest-adime-intervensi-loading').show()

        var success_i_adime = getSuggestion('/kasus/{{$kasus->nomor_kasus}}/suggest/cppt-adime-intervensi-template','adime-intervensi');
        var success_a_adime = getSuggestion('/kasus/{{$kasus->nomor_kasus}}/suggest/cppt-adime-assessment-template','adime-assessment');
        
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
            var cppt_type = 'cppt'
        }
        else if(type == 'objective') {
            var short_type = 'o'
            var cppt_type = 'cppt'
        }
        else if(type == 'assessment') {
            var short_type = 'a'
            var cppt_type = 'cppt'
        }
        else if(type == 'plan') {
            var short_type = 'p'
            var cppt_type = 'cppt'
        }
        else if(type == 'adime-assessment') {
            var short_type = 'a'
            var cppt_type = 'adime'
        }
        else if(type == 'adime-intervensi') {
            var short_type = 'i'
            var cppt_type = 'adime'
        }

        var old_content = $(this).parent().parent().find('textarea').val();
        if(old_content != '') old_content = old_content + '\n'
        $(this).parent().parent().find('textarea').val(old_content + content)
    });

    var typingTimer;                
    var doneTypingInterval = 500; 
    var keyword_assessment;

    $(document).on('click', '.suggest-item-diagnosis', function(){ 

        var type = $(this).data("type")
        var content = $(this).data("text");

        var short_type = 'a'
        var cppt_type = 'cppt'
        var old_content = $(this).parent().parent().find('textarea').val();
        var new_content = old_content.replace(new RegExp(keyword_assessment + '$'), content);
        $(this).parent().parent().find('textarea').val(new_content + '\n');
        $('.suggest-assessment').empty()
    });

    $('.search-diagnosis').bind('input propertychange', function() {
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

    $('#modal-covid-form input[name=status]').change(function(){
        var value = $(this).val()
        if(value == 'positif') $('#modal-covid-form #jadikan_diagnosis_utama').show();
        else $('#modal-covid-form #jadikan_diagnosis_utama').hide();
    })

    var loadHistori = 0;
    $(document).on('click', '#cppt-histori-button', function(){
        element = $('#cppt-histori-modal');

        if (loadHistori == 0) {
            loadHistori = 1;
            $('#cppt-histori-button').prop('disabled', true);
            $('#loading-top').fadeIn();

            $.ajax({
                url: BASE_URL + 'kasus/{{$kasus->nomor_kasus}}/datamedis/cppt/histori?typedata=json',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    element.find(".pasien-name").html('Pasien '+data.kasus.identitas.nama);

                    var content = ``;

                    $.each(data.cppts, function(i,cppt) {
                        content += `
                            <div class="col-12">
                                <div class="block block-bordered block-mode-hidden">
                                    <div class="block-header block-header-default">
                                        <h5 class="mb-0">
                                            Kasus `+cppt[0].kasus.judul_kasus+`
                                            <br>
                                            <p class="mb-0" style="font-size: 10px;">`+cppt[0].kasus.lokasi.lokasi.nama+`</p>
                                        </h5>
                                    <div class="block-options">
                                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle" aria-controls="cpptss-item-`+i+`"><i class="fas fa-chevron-down"></i></button>
                                    </div>
                                </div>
                                 <div class="block-content soap-item" id="cpptss-item-`+i+`">
                                    <div class="row">
                        `;
                        var cppt_counter = cppt.length;
                        $.each(cppt,function (j,item) {
                            var jenis = 'cppt';
                            var class_cppt ='';
                            if(item.jenis != null)jenis = item.jenis;
                            if(item.creator.profesi == 1 ) class_cppt = 'badge badge-primary';
                            else if(item.creator.profesi == 2 ) class_cppt = 'badge badge-success';
                            else if(item.creator.profesi == 3 ) class_cppt = 'badge badge-danger';
                            else if(item.creator.profesi == 10 ) class_cppt = 'badge badge-warning';
                            else  class_cppt = 'badge badge-secondary';

                            var button_copy ='';
                            if(allow_crud == 1){
                                button_copy = `
                                    <div class="block-options">
                                        <button type="button" class="btn-block-option" data-toggle="tooltip" data-placement="top" title="Copy CPPT" onclick="cpptCopy(`+item.id+`,'`+item.kasus.nomor_kasus+`')">
                                            <i class="fal fa-copy"></i>
                                        </button>
                                    </div>
                                 `;
                            }

                            content +=`
                                        <div class="col-12">
                                            <div class="block block-bordered block-mode-hidden">
                                                <div class="block-header block-header-default">
                                                    <h3 class="block-title">`+jenis.toUpperCase()+` `+cppt_counter+`
                                                        <small>
                                                            `+item.tanggal+`
                                                            <span class="`+class_cppt+`">
                                                            `+item.creator.profesi_detail.title+`
                                                            -
                                                            `+item.creator.name+`
                                                            </span>
                                                        </small>
                                                    </h3>
                                                `+button_copy+`
                                                <div class="block-options">
                                                    <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle" aria-controls="cppt-item-`+cppt_counter+`"><i class="fas fa-chevron-down"></i></button>
                                                </div>
                                            </div>
                                            <div class="block-content soap-item" id="cppt-item-`+cppt_counter+`">
                            `;
                            if(jenis == 'adime'){
                                content +=`
                                                <h5 class="font-w400 mb-0">
                                                    <small>ASSESSMENT</small>
                                                </h5>
                                                <h5 class="font-w400" style="white-space: pre-line">`+item.assessment+`</h5>

                                                <h5 class="font-w400 mb-0">
                                                    <small>DIAGNOSIS</small>
                                                </h5>
                                                <h5 class="font-w400" style="white-space: pre-line">`+item.subjective+`</h5>


                                                <h5 class="font-w400 mb-0">
                                                    <small>INTERVENTION</small>
                                                </h5>
                                                <h5 class="font-w400" style="white-space: pre-line">`+item.objective+`</h5>


                                                <h5 class="font-w400 mb-0">
                                                    <small>MONITORING</small>
                                                </h5>
                                                <h5 class="font-w400" style="white-space: pre-line">`+item.plan+`</h5>

                                                <h5 class="font-w400 mb-0">
                                                    <small>EVALUATION</small>
                                                </h5>
                                                <h5 class="font-w400" style="white-space: pre-line">`+item.ppa+`</h5>
                                `;
                            }else{
                                if(jenis == 'rapt'){
                                    var preventif = '<i class="fa fa-close text-danger">';
                                    var kuratif = '<i class="fa fa-close text-danger">';
                                    var rehab = '<i class="fa fa-close text-danger">';
                                    var paliatif = '<i class="fa fa-close text-danger">';
                                    if(item.preventif != 0){
                                        preventif = '<i class="fa fa-check text-primary"></i>';
                                    }

                                    if(item.kuratif != 0){
                                        kuratif = '<i class="fa fa-check text-primary"></i>';
                                    }

                                    if(item.rehab != 0){
                                        rehab = '<i class="fa fa-check text-primary"></i>';
                                    }

                                    if(item.paliatif != 0){
                                        paliatif = '<i class="fa fa-check text-primary"></i>';
                                    }
                                    var prioritas = '';
                                    if(item.prioritas == 'prioritas'){
                                        prioritas = '<strong>Prioritas</strong>'
                                    }else if(item.prioritas == 'tunda'){
                                        prioritas = 'Dapat Ditunda';
                                    }
                                    content += `
                                            <div class="row">
                                                <div class="col-4">
                                                    <h5 class="font-w400 mb-0">
                                                        <small>KEBUTUHAN PELAYANAN</small>
                                                    </h5>
                                                    <h5 class="font-w400" style="white-space: pre-line" id="kebutuhan_pelayanan_rapt">
                                                    `+preventif+` Preventif
                                                    `+kuratif+` Kuratif
                                                    `+rehab+` Rehab
                                                    `+paliatif+` Paliatif
                                                    </h5>
                                                </div>
                                                <div class="col-4">
                                                    <h5 class="font-w400 mb-0">
                                                        <small>PRIORITAS</small>
                                                    </h5>
                                                    <h5 class="font-w400" style="white-space: pre-line">
                                                    `+prioritas+`
                                                    </h5>

                                                </div>
                                                <div class="col-4">
                                                     <h5 class="font-w400 mb-0">
                                                          <small>PERKIRAAN HARI RAWAT</small>
                                                     </h5>
                                                     <h5 class="font-w400" style="white-space: pre-line">
                                                        `+item.perkiraan_hari_rawat+` hari
                                                     </h5>
                                                </div>
                                            </div>
                                    `;
                                }

                                if(item.creator.profesi == 1) var keterangan = 'INSTRUKSI DOKTER';
                                else var keterangan = 'Keterangan';

                                content +=`
                                            <h5 class="font-w400 mb-0">
                                                <small>SUBJECTIVE</small>
                                            </h5>
                                            <h5 class="font-w400" style="white-space: pre-line">`+item.subjective+`</h5>

                                            <h5 class="font-w400 mb-0">
                                                <small>OBJECTIVE</small>
                                            </h5>
                                            <h5 class="font-w400" style="white-space: pre-line">`+item.objective+`</h5>

                                            <h5 class="font-w400 mb-0">
                                                <small>ASSESSMENT</small>
                                            </h5>
                                            <h5 class="font-w400" style="white-space: pre-line">`+item.assessment+`</h5>

                                            <h5 class="font-w400 mb-0">
                                                <small>PLAN</small>
                                            </h5>
                                            <h5 class="font-w400" style="white-space: pre-line">`+item.plan+`</h5>

                                            <h5 class="font-w400 mb-0">
                                                <small>
                                                        `+keterangan+`
                                                </small>
                                            </h5>
                                            <h5 class="font-w400" style="white-space: pre-line">`+item.ppa+`</h5>
                                `;
                            }

                            content +=`
                                        <div class="row">
                                            <div class="col-4">
                                                <h6 class="p-10">
                                                    <small class="text-muted">Dibuat Oleh</small><br>
                                                        `+item.creator.name+`<br>
                                                    <span class="font-w400"> `+item.tanggal+`</span>
                                                </h6>
                                            </div>
                            `;

                            if(item.updated_by != null){
                                content +=`
                                <div class="col-4">
                                    <h6 class="p-10">
                                        <small class="text-muted">Diupdate Oleh</small><br>
                                        `+item.updater.name+`<br>
                                        <span class="font-w400"> `+item.tanggal_update+`</span>
                                    </h6>
                                </div>
                                `;
                            }

                            if(item.verified_by != null){
                                content +=`
                                    <div class="col-4 ">
                                        <h6 class="p-10">
                                            <small class="text-muted">Verifikasi Dokter Oleh</small><br>
                                            `+item.verifier.name+`<br>
                                            <span class="font-w400"> `+item.tanggal_verifikasi+`</span>
                                        </h6>
                                    </div>
                                `;
                            }else{
                                content +=`
                                     <div class="col-4 hide" id="cppt_container_verified_`+cppt_counter+`">
                                        <h6 class="p-10">
                                            <small class="text-muted">Verifikasi Dokter Oleh</small><br>
                                            <span id="cppt_verified_by_`+cppt_counter+`"></span><br>
                                            <span class="font-w400" id="cppt_verified_at_`+cppt_counter+`"></span>
                                        </h6>
                                    </div>
                                `;
                            }

                            if(item.verified_ners_by != null){
                                content +=`
                                     <div class="col-4 ">
                                        <h6 class="p-10">
                                            <small class="text-muted">Verifikasi NERS Oleh</small><br>
                                            `+item.verifikator_ners.name+`<br>
                                            <span class="font-w400"> `+item.tanggal_verifikasi_ners+`</span>
                                        </h6>
                                    </div>
                                `;
                            }else{
                                content +=`
                                     <div class="col-4 hide" id="cppt_ners_container_verified_`+cppt_counter+`">
                                        <h6 class="p-10">
                                        <small class="text-muted">Verifikasi NERS Oleh</small><br>
                                        <span id="cppt_ners_verified_by_`+cppt_counter+`"></span><br>
                                        <span class="font-w400" id="cppt_ners_verified_at_`+cppt_counter+`"></span>
                                        </h6>
                                    </div>
                                `;
                            }
                            content +=`
                                            </div>
                                        </div>
                                    </div>
                               </div>
                            `;

                            cppt_counter--
                        })
                        content +=`
                                            </div>
                                        </div>
                                    </div>
                               </div>
                            `;
                    });

                    element.find(".cppt").append(content);
                    $('#loading-top').hide();
                    $('#cppt-histori-button').prop('disabled', false);
                    $('#cppt-histori-modal').modal('show');
                },
                error: function() {
                    alert('error');
                },
            });
        } else {
            $('#cppt-histori-modal').modal('show');
        }

    });

    let status_btn_content_toogle = '';
    $(".btn-edit-cppt").on("click", function() {
        // let btn_toogle_content = $(this).siblings().find('.btn-content-toogle').attr('class'); // buat testing
        let btn_toogle_content_element = $(this).siblings().find('.btn-content-toogle');
        let dropdown_is_visible = $(this).parent().siblings().first().is(":visible");

        if (btn_toogle_content_element.data('status') == 'non-active' && dropdown_is_visible == false) {
            btn_toogle_content_element.trigger('click');
            btn_toogle_content_element.data('status', 'active');
        } 

        // let parent = $(this).parent().attr('class'); // buat testing
        let parent_element = $(this).parent();
        // let sibling = $(this).parent().siblings().first().attr('class'); // buat testing
        let sibling_element = $(this).parent().siblings().first();
        // let row_file_upload = sibling_element.find('#file-upload-row').attr('class'); // buat testing
        let row_file_upload_element = sibling_element.find('#file-upload-row');
        $("#file-upload-preview-edit").empty();
        row_file_upload_element.clone().appendTo("#file-upload-preview-edit");

    });

    $(".btn-content-toogle").on("click", function() {
        $(this).data('status', 'non-active');
    });

    function readback(id){
        console.log(id)
        $("#modal-readback").modal('show');

        $("#modal-readback #cppt_id").val(id);
    }

    function verifReadback(id) {
        console.log(id)
        $("#verifReadback #readback_id").val(id);
        swal({
            title: "Konfirmasi",
            text: "Ingin konfirmasi readback cppt ini?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Verifikasi",
        }).then(isConfirm => {
            if (isConfirm.value) {
               $("form#verifReadback").submit()
            }
        });
    }

</script>