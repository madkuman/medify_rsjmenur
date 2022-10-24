<script type="text/javascript">    
//VITAL SIGN
function imunDeleteModal(id)
{   
    console.log('abc');
    $('#imunDeleteModal #imun_id').val(id)
    $('#imunDeleteModal').modal('show');
}

function imunEditModal(id)
{
    $('#loading-top').fadeIn();
    $.ajax({
        url: API_URL + '/kasus/pemeriksaanlab/imun/'+id,
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            $('#modal-edit-imun #imun_id').val(data.id)
            $('#modal-edit-imun #hbs_ag').val(data.hbs_ag)
            $('#modal-edit-imun #anti_hiv').val(data.anti_hiv)
            $('#modal-edit-imun #vdrl').val(data.vdrl)
            $('#modal-edit-imun #anti_hcv').val(data.anti_hcv)
            $('#modal-edit-imun #ict_malaria').val(data.ict_malaria)
            $('#modal-edit-imun #coomb_test').val(data.coomb_test)
            $('#modal-edit-imun #hb_eag').val(data.hb_eag)
            $('#modal-edit-imun').modal('show');
            $('#loading-top').hide();
        },
        error: function() {
            alert('error');
        },
    });
}
</script>
