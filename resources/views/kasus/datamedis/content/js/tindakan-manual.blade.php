<script type="text/javascript">
    $(document).ready(function() {
        $('#modal-create-tindakan-manual').keydown(function(event){
            if(event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });
        SearchTindakanPerawatManual();
    });

    function removeTindakanManual()
    {   
        $('.btnRemoveTindakan').on('click', function() {
            var remove_tindakan = $(this).parents('.tindakan-input');
            remove_tindakan.remove();
            var id = $(this).data(id).id;
            $("#tombol_tambah_manual_"+id).prop('disabled', false);
            if(!$('#formTindakanManual').children().hasClass('tindakan-input'))
            {
                $("#submit_akhir_manual").hide();
                $('#hasil-tambahkan-empty-manual').show()
            }
        })

    }

    function resetTindakanManual()
    {   
        console.log($('#tindakan-perawat-manual').val())
        if($('#tindakan-perawat-manual').val() == '')
        {
            $('#hasil-pencarian-manual').hide();
            $('#top-tindakan-manual').show();
        }
    }

    var typingTimer;                
    var doneTypingInterval = 500;  

    $('#tindakan-perawat-manual').on('keyup', function()
    {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(SearchTindakanPerawatManual, doneTypingInterval);
    })

    $('#tipe_tarif').on('change', function()
    {
        SearchTindakanPerawatManual();
    })

    $('#tindakan-perawat-manual').on('keydown', function()
    {
        clearTimeout(typingTimer);
    })

    $('.sugesti').on('click', function(){
        console.log(this.value);
        var query = this.value;
        $('#tindakan-perawat-manual').val(query);
        SearchTindakanPerawatManual();
    });

    function SearchTindakanPerawatManual()
    {   
        var panjang = $('#tindakan-perawat-manual').val();
        var keyword = $('#tindakan-perawat-manual').val();
        var tipe = $('#tipe_tarif_manual option:selected').val();
        var tipe_text = $('#tipe_tarif_manual option:selected').text()
        if($('#tindakan-perawat-manual').val() == '')
        {
            var search_tindakan_url = API_URL+'/kasus/datamedis/tindakan/get-top-tindakan-user?limit=50&kelas={{$kasus->kelas->id}}&tipe='+tipe+'&persen=0'
        }
        else if(panjang.length >= 0)
        {
            var search_tindakan_url = API_URL+"/keuangan/tarif/search?keyword="+keyword+'&kelas={{$kasus->kelas->id}}&tipe='+tipe+'&persen=0'
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
                $('#hasil-pencarian-manual').empty();
                $('#loading-tindakan-perawat-search-manual').show();
                $('#hasil-pencarian-empty-manual').hide()
            },
            success: function(response) {
                console.log(response)
                if(response.length > 0)
                {
                    $('#perawat-total-hasil-manual').text(response.length)
                    input =`<table table class="table table-striped table-hover">`
                    for(i=0;i<response.length;i++)
                    {   
                        harga = numeral(response[i].harga).format('0,0');
                        input += `<tr>
                                    <td style="width:50%;vertical-align: middle;"><div class="pr-10"> `+response[i].deskripsi+`</div>
                                    <div><span class="autocomplete-content-bottom">`+response[i].kategori_all+`</span></div></td>
                                    <td style="width:25%;vertical-align: middle;"><div class="pull-right">Rp `+harga+`</div></td>
                                    <td style="width:25%;vertical-align: middle;">
                                        <button type="button" id="tombol_tambah_manual_`+response[i].tarif_master_id+`" 
                                        class="btn-alt btn-hero btn-primary tambahin-tindakan" 
                                        data-id="`+response[i].tarif_master_id+`" data-desk="`+response[i].deskripsi+`" 
                                        data-tarifid="`+response[i].tarif_id+`" 
                                        data-tariftipe="`+tipe+`" 
                                        data-tariftipetext="`+tipe_text+`" 
                                        data-total="`+response[i].harga+`" 
                                        data-persen="`+response[i].persen+`" 
                                        onclick="input_top_tindakan_manual(this)">Tambah Tindakan</button>
                                    </td>
                                    </tr>`
                    }
                    input +=`</table>`
                    $('#hasil-pencarian-manual').empty();
                    $('#hasil-pencarian-manual').hide();
                    $('#hasil-pencarian-manual').append(input);
                    $('#hasil-pencarian-manual').show();
                }
                else
                {
                    $('#hasil-pencarian-manual').empty();
                    $('#hasil-pencarian-manual').hide();
                    $('#create-tindakan-perawat-keyword-manual').text(keyword)
                    $('#create-tindakan-perawat-tipe-manual').text(tipe_text)
                    $('#hasil-pencarian-empty-manual').show()
                }
               
            },
            complete: function(){
                $('#loading-tindakan-perawat-search-manual').hide();
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

    function input_top_tindakan_manual(desc)
    {   
        var id = $(desc).data("id");
        var desk = $(desc).data("desk");
        var tarif_id = $(desc).data("tarifid");
        var tarif_tipe = $(desc).data("tariftipe");
        var tarif_tipe_text = $(desc).data("tariftipetext");
        var tarif_kelas = "{{$kasus->kelas->id}}";
        if ($(desc).data("persen")) {
            var total = "";
        } else {
            var total = $(desc).data("total");
        }
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
                                <td style="width:25%">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp </span>
                                        </div>
                                        <input type="text" name="price[]" class="form-control" value="`+total+`" required>
                                  </div>
                                </td>
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
            <input type="hidden" name="tagihan[]" value="1">
        </div>
        `

        $("#formTindakanManual").prepend(input);
        $("#submit_akhir_manual").show();
        $('#hasil-tambahkan-empty-manual').hide()
        removeTindakanManual();
    }
        const numberWithCommas = (x) => {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }
    
    $('#tarifLoading').hide();

    function updateCreateSubTotal()
    {
        var unit_price = $('#tagihanCreateUnitPrice').val();
        var qty = $('#tagihanCreateQty').val();
        var subtotal = unit_price * qty;
        subtotal = numberWithCommas(subtotal);
        $('#tagihanCreateSubTotalMask').val(subtotal);
    }

    var kasus_departemen_id =  {{$kasus->lokasi->lokasi->departemen->id}}

</script>