<script type="text/javascript">
    $(document).ready(function() {
        $('#modal-create-tindakan').keydown(function(event){
            if(event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });
        SearchTindakanPerawat();
    });

    function removeTindakan()
    {   
        $('.btnRemoveTindakan').on('click', function() {
            var remove_tindakan = $(this).parents('.tindakan-input');
            remove_tindakan.remove();
            var id = $(this).data(id).id;
            $("#tombol_tambah_"+id).prop('disabled', false);
            if(!$('#formTindakan').children().hasClass('tindakan-input'))
            {
                $("#submit_akhir").hide();
                $('#hasil-tambahkan-empty').show()
            }
        })

    }

    function resetTindakan()
    {   
        console.log($('#tindakan-perawat').val())
        if($('#tindakan-perawat').val() == '')
        {
            $('#hasil-pencarian').hide();
            $('#top-tindakan').show();
        }
    }

    var typingTimer;                
    var doneTypingInterval = 500;  

    $('#tindakan-perawat').on('keyup', function()
    {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(SearchTindakanPerawat, doneTypingInterval);
    })

    $('#tipe_tarif').on('change', function()
    {
        SearchTindakanPerawat();
    })

    $('#tindakan-perawat').on('keydown', function()
    {
        clearTimeout(typingTimer);
    })

    $('.sugesti').on('click', function(){
        console.log(this.value);
        var query = this.value;
        $('#tindakan-perawat').val(query);
        SearchTindakanPerawat();
    });

    function SearchTindakanPerawat()
    {   
        var panjang = $('#tindakan-perawat').val();
        var keyword = $('#tindakan-perawat').val();
        var tipe = $('#tipe_tarif option:selected').val();
        var tipe_text = $('#tipe_tarif option:selected').text()
        if($('#tindakan-perawat').val() == '')
        {
            var search_tindakan_url = API_URL+'/kasus/datamedis/tindakan/get-top-tindakan-user?limit=50&kelas={{$kasus->kelas->id}}&tipe='+tipe+'&persen=0'
        }
        else if(panjang.length >= 0)
        {
            var search_tindakan_url = API_URL+"/keuangan/tarif/search?keyword="+keyword+'&kelas={{$kasus->kelas->id}}&tipe='+tipe+'&persen=0'
        }
        console.log(search_tindakan_url)
        var flag = 1;
        var input;
        var harga;

        $.ajax({
            url: search_tindakan_url,
            type: 'GET',
            dataType: 'json',
            tryCount : 0,
            retryLimit : 3,
            beforeSend: function(){
                $('#hasil-pencarian').empty();
                $('#loading-tindakan-perawat-search').show();
                $('#hasil-pencarian-empty').hide()
            },
            success: function(response) {
                if(response.length > 0)
                {
                    $('#perawat-total-hasil').text(response.length)
                    input =`<table table class="table table-striped table-hover">`
                    for(i=0;i<response.length;i++)
                    {   
                        harga = numeral(response[i].harga).format('0,0');
                        input += `<tr>
                                    <td style="width:50%;vertical-align: middle;"><div class="pr-10"> `+response[i].deskripsi+`</div>
                                    <div><span class="autocomplete-content-bottom">`+response[i].kategori_all+`</span></div></td>
                                    <td style="width:25%;vertical-align: middle;"><div class="pull-right">Rp `+harga+`</div></td>
                                    <td style="width:25%;vertical-align: middle;">
                                        <button type="button" id="tombol_tambah_`+response[i].tarif_master_id+`" 
                                        class="btn-alt btn-hero btn-primary tambahin-tindakan" 
                                        data-id="`+response[i].tarif_master_id+`" data-desk="`+response[i].deskripsi+`" 
                                        data-tarifid="`+response[i].tarif_id+`" 
                                        data-tariftipe="`+tipe+`" 
                                        data-tariftipetext="`+tipe_text+`" 
                                        data-total="`+response[i].harga+`" 
                                        onclick="input_top_tindakan(this)">Tambah Tindakan</button>
                                    </td>
                                    </tr>`
                    }
                    input +=`</table>`
                    $('#hasil-pencarian').empty();
                    $('#hasil-pencarian').hide();
                    $('#hasil-pencarian').append(input);
                    $('#hasil-pencarian').show();
                }
                else
                {
                    $('#hasil-pencarian').empty();
                    $('#hasil-pencarian').hide();
                    $('#create-tindakan-perawat-keyword').text(keyword)
                    $('#create-tindakan-perawat-tipe').text(tipe_text)
                    $('#hasil-pencarian-empty').show()
                }
               
            },
            complete: function(){
                $('#loading-tindakan-perawat-search').hide();
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
    }

    function input_top_tindakan(desc)
    {   
        var id = $(desc).data("id");
        var desk = $(desc).data("desk");
        var tarif_id = $(desc).data("tarifid");
        var tarif_tipe = $(desc).data("tariftipe");
        var tarif_tipe_text = $(desc).data("tariftipetext");
        var total = $(desc).data("total");
        var tarif_kelas = "{{$kasus->kelas->id}}";
        var  harga = total.toLocaleString('id-ID');
        var input;

        input = 
        `
        <div class="col-md-12 tindakan-input">
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
                                <button type="button" data-id="`+id+`" class="btn-block-option btnRemoveTindakan">
                                    <i class="fa fa-times"></i>
                                </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </a>
            <input type="hidden" name="tarif_master_id[]" value="`+id+`">
            <input type="hidden" name="tarif_id[]" value="`+tarif_id+`">
            <input type="hidden" name="tarif_tipe_id[]" value="`+tarif_tipe+`">
            <input type="hidden" name="tarif_kelas[]" value="`+tarif_kelas+`">
            <input type="hidden" name="desc_keperawatan[]" value="`+desk+`">
            <input type="hidden" name="price[]" value="`+total+`">
            <input type="hidden" name="tagihan[]" value="1">
        </div>
        `
        console.log("ha")
        $("#formTindakan").prepend(input);
        $("#submit_akhir").show();
        $('#hasil-tambahkan-empty').hide()
        removeTindakan();
    }

    function tindakanDeleteModal(id)
    {
        $('#tindakanDeleteModal #tindakan-id').val(id)
        $('#tindakanDeleteModal').modal('show');
    }

    function tindakanSubscribeModal(id)
    {
        $('#tindakanSubscribeModal #tindakan-id').val(id)
        $('#tindakanSubscribeModal').modal('show');
    }
    function tindakanUnsubscribeModal(id)
    {
        $('#tindakanUnsubscribeModal #tindakan-id').val(id)
        $('#tindakanUnsubscribeModal').modal('show');
    }

    $("#modal-edit-tindakan #submit-edit-tindakan").prop('disabled',true);
    function tindakanEditModal(id)
    {
        $('#loading-top').fadeIn();
        $.ajax({
            url: API_URL + '/kasus/{{$kasus->nomor_kasus}}/datamedis/tindakan/'+ id,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                var price = data.price
                var desc = data.desc
                var icd_9 = data.icd_9;

                if ($.trim(icd_9).length == 0) {
                    $.ajax({
                        url: API_URL + '/kasus/{{$kasus->nomor_kasus}}/tagihan/detail/'+ data.tagihan_detail_id,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            var tarif_id = data.tarif_id;
                            var tarif_tipe_id = data.tarif_tipe_id;
                            var tarif_kelas = data.tarif_kelas;
                            var departemen_id = data.departemen_id;
                            console.log(departemen_id)

                                $('#modal-edit-tindakan #input-id').val(id)
                                $('#modal-edit-tindakan #input-desc').val(desc)
                                $('#modal-edit-tindakan #input-price').val(price)
                                $('#modal-edit-tindakan #tarif_id_edit').val(tarif_id)
                                $('#modal-edit-tindakan #tarif_tipe_id_edit').val(tarif_tipe_id)
                                $('#modal-edit-tindakan #tarif_kelas_edit').val(tarif_kelas)
                                $('#modal-edit-tindakan #departemen_id_edit').val(departemen_id)
                                $('#modal-edit-tindakan .icd9-class').hide()
                                $("#modal-edit-tindakan #input-icd9-desc").prop('disabled', true);
                                $('#modal-edit-tindakan').modal('show');
                                $('#loading-top').hide();    
                        },
                        error: function() {
                            alert('error');
                        },
                    });
                }
                else {
                    $('#modal-edit-tindakan #input-id').val(id)
                    $('#modal-edit-tindakan #input-icd9-desc').val(desc)
                    $('#modal-edit-tindakan #input-price').hide()
                    $('#modal-edit-tindakan .perawat-class').hide()
                    $("#modal-edit-tindakan #input-desc").prop('disabled', true);
                    $('#modal-edit-tindakan').modal('show');
                    $('#loading-top').hide();    
                }
            },
            error: function() {
                alert('error');
            },
        });
    }

    $('#tarifLoading').hide();
    $('#tarifLoading2').hide();

    var createTagihanLastDesc = '';
</script>
<script type="text/javascript">
    var resultSearch;
    $("#modal-create-tindakan #submit-create-tindakan").prop('disabled',true);
    var AutoCompleteCreateTindakan = function() {

        var ListLayanan = {};

        var initAutoComplete = function(){
            jQuery('#modal-create-tindakan .tindakan-autocomplete').autoComplete({
                minChars: 3,
                source: function(term, suggest){
                    term = term.toLowerCase();
                    var search_tindakan_url = API_URL+"/keuangan/tarif/searchtarif?keyword="+term+'&kelas={{$kasus->kelas->refer}}&departemen={{$kasus->lokasi->lokasi->departemen->id or "0"}}'
                    $.ajax({
                        url: search_tindakan_url,
                        type: 'GET',
                        dataType: 'json',
                        success: function(response) {
                            data = response
                            resultSearch = response;
                            for (i = 0; i < data.length; i++) {
                                console.log(data[i])
                                var suggestword = data[i].deskripsi;
                                ListLayanan[suggestword] = data[i];
                                suggestions.push(suggestword);
                                var suggestword = {};
                            }
                            suggest(suggestions);
                        },
                        error: function() {
                        },
                    });

                    var suggestions    = [];


                },
                onSelect: function(event, term, item) {
                    $('#tarifLoading').show();
                    $("#tindakan-input-create-price").val(ListLayanan[term].total)
                    $('#tarifLoading').hide();
                    //$("#tarif_id").val(ListLayanan[term].id);
                    //$("#tarif_tipe_id").val(ListLayanan[term].tarif_tipe_id);
                    //$("#tarif_kelas").val("{{$kasus->kelas->kategori}}");
                    //$("#departemen_id").val(ListLayanan[term].departemen);
                    $("#modal-create-tindakan #submit-create-tindakan").prop('disabled',false);

                    createTagihanLastDesc = ListLayanan[term].deskripsi;
                    tambahTindakan(ListLayanan[term]);
                }
            });
        };

        return {
            init: function () {
                initAutoComplete();
            }
        };
    }();

    $("#modal-edit-tindakan #submit-edit-tindakan").prop('disabled',true);
</script>
<script type="text/javascript">
    var AutoCompleteEditTindakan = function() {

        var ListLayanan = {};

        var initAutoComplete = function(){
            jQuery('#modal-edit-tindakan .tindakan-autocomplete').autoComplete({
                minChars: 3,
                source: function(term, suggest){
                    term = term.toLowerCase();
                    
                    var search_tindakan_url = API_URL+"/keuangan/tarif/searchtarif?keyword="+term+'&kelas={{$kasus->kelas->refer}}&departemen={{$kasus->lokasi->lokasi->departemen->id or "0"}}'
                    $.ajax({
                        url: search_tindakan_url,
                        type: 'GET',
                        dataType: 'json',
                        success: function(response) {
                            data = response
                            resultSearch = response;
                            for (i = 0; i < data.length; i++) {
                                console.log(data[i])
                                var suggestword = data[i].deskripsi;
                                ListLayanan[suggestword] = data[i];
                                suggestions.push(suggestword);
                                var suggestword = {};
                            }
                            suggest(suggestions);
                        },
                        error: function() {
                        },
                    });

                    var suggestions    = [];

                },
                onSelect: function(event, term, item) {
                    $('#tarifLoading2').show();
                    $("#modal-edit-tindakan #input-price").val(ListLayanan[term].total)
                    $('#tarifLoading2').hide();
                    $("#tarif_id_edit").val(ListLayanan[term].id);
                    $("#tarif_tipe_id_edit").val(ListLayanan[term].tarif_tipe_id);
                    $("#tarif_kelas_edit").val("{{$kasus->kelas->kategori}}");
                    $("#departemen_id_edit").val(ListLayanan[term].departemen);
                    $("#modal-edit-tindakan #submit-edit-tindakan").prop('disabled',false);
                    
                    createTagihanLastDesc = ListLayanan[term].deskripsi;
                }
            });
        };

        return {
            init: function () {
                initAutoComplete();
            }
        };
    }();

</script>