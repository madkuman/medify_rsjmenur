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
            var search_tindakan_url = API_URL+`/kasus/datamedis/tindakan/get-top-tindakan-user?limit=50&kelas=${tarif_kelas}&tipe=${tipe}&persen=0`
        }
        else if(panjang.length >= 0)
        {
            var search_tindakan_url = API_URL+`/keuangan/tarif/search?keyword=${keyword}&kelas=${tarif_kelas}&tipe=${tipe}&persen=0`
        }
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
                                    <td style="width:50%;vertical-align: middle;"><div class="pr-10"> `+response[i].deskripsi+`</div></td>
                                    <td style="width:25%;vertical-align: middle;"><div class="pull-right">Rp `+harga+`</div></td>
                                    <td style="width:25%;vertical-align: middle;">
                                        <button type="button" id="tombol_tambah_`+response[i].tarif_master_id+`" 
                                        class="btn-alt btn-hero btn-primary tambahin-tindakan" 
                                        data-id="`+response[i].tarif_master_id+`" data-desk="`+response[i].deskripsi+`" 
                                        data-tarifid="`+response[i].tarif_id+`" 
                                        data-tariftipe="`+tipe+`" 
                                        data-tariftipetext="`+tipe_text+`" 
                                        data-total="`+response[i].harga+`" 
                                        data-tarifkelasid="`+response[i].tarif_kelas_id+`" 
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
        var tarif_kelas = $(desc).data("tarifkelasid");
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

    $('#tarifLoading').hide();
    $('#tarifLoading2').hide();

    var createTagihanLastDesc = '';
</script>