<script type="text/javascript">
    var AutoCompleteCreateTindakanICD9 = function() {

        var ListLayanan = {};

        var initAutoComplete = function(){
            jQuery('#modal-create-tindakan-icd9 .tindakan-icd9-autocomplete').autoComplete({
                minChars: 3,
                delay : 750,
                source: function(term, suggest){
                    term = term.toLowerCase();
                    
                    var search_tindakan_url = API_URL+"/kasus/get/list/icd9?keyword="+term
                    $.ajax({
                        url: search_tindakan_url,
                        type: 'GET',
                        dataType: 'json',
                        tryCount : 0,
                        retryLimit : 3,
                        success: function(response) {
                            data = response.data
                            for (i = 0; i < data.length; i++) {
                                var suggestword = data[i].code_icd+" - "+data[i].long_desc;
                                ListLayanan[suggestword] = data[i];
                                suggestions.push(suggestword);
                                var suggestword = {};
                            }
                            suggest(suggestions);
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
                    console.log(ListLayanan[term].id);
                    $("#modal-create-tindakan-icd9 #icd_9").val(ListLayanan[term].id);
                    $("#modal-create-tindakan-icd9 #submit-create-tindakan").prop('disabled',false);
                }
            });
        };

        return {
            init: function () {
                initAutoComplete();
            }
        };
    }();

    var AutoCompleteEditTindakanICD9 = function() {

        var ListLayanan = {};

        var initAutoComplete = function(){
            jQuery('#modal-edit-tindakan .tindakan-icd9-autocomplete').autoComplete({
                minChars: 3,
                source: function(term, suggest){
                    term = term.toLowerCase();
                    
                    var search_tindakan_url = API_URL+"/kasus/get/list/icd9?keyword="+term
                    $.ajax({
                        url: search_tindakan_url,
                        type: 'GET',
                        dataType: 'json',
                        tryCount : 0,
                        retryLimit : 3,
                        success: function(response) {
                            data = response.data
                            for (i = 0; i < data.length; i++) {
                                var suggestword = data[i].code_icd+" - "+data[i].long_desc;
                                ListLayanan[suggestword] = data[i];
                                suggestions.push(suggestword);
                                var suggestword = {};
                            }
                            suggest(suggestions);
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
                    //console.log(ListLayanan[term].id);
                    $("#modal-edit-tindakan #icd_9").val(ListLayanan[term].id);
                    $("#modal-edit-tindakan #submit-edit-tindakan").prop('disabled',false);
                }
            });
        };

        return {
            init: function () {
                initAutoComplete();
            }
        };
    }();
    function emptyDaftarHargaID()
    {
        var current_desc = $(".tindakan-autocomplete").val();

        if(current_desc !== createTagihanLastDesc)
        {
            $("#tindakan-input-create-daftar-id").val('');
        }
    }
    function historiTindakan9()
    {
        window.open(
        "{{url('kasus')}}/{{$kasus->nomor_kasus}}/datamedis/tindakan/histori-icd9","popUpWindow",
        "height=800,width=800,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes");
    }




    function addTindakanSuggest(element)
    {
        id = $(element).data("id");
        desc = $(element).data("desc");

        $('#icd_9').val(id)
        $('#tindakan-icd9-text').val(desc)
        $('#modal-create-tindakan-icd9 #submit-create-tindakan-icd').prop('disabled',false);
    }

</script>