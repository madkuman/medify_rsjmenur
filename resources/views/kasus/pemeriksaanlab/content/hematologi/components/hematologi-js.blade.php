<script type="text/javascript">    
//VITAL SIGN
function hematologiDeleteModal(id)
{   
    console.log('abc');
    $('#hematologiDeleteModal #hematologi_id').val(id)
    $('#hematologiDeleteModal').modal('show');
}

function hematologiEditModal(id)
{
    $('#loading-top').fadeIn();
    $.ajax({
        url: API_URL + '/kasus/pemeriksaanlab/hematologi/'+id,
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            $('#modal-edit-hematologi #hematologi_id').val(data.id)
            $('#modal-edit-hematologi #hbs_ag').val(data.hbs_ag)
            $('#modal-edit-hematologi #anti_hiv').val(data.anti_hiv)
            $('#modal-edit-hematologi #vdrl').val(data.vdrl)
            $('#modal-edit-hematologi #anti_hcv').val(data.anti_hcv)
            $('#modal-edit-hematologi #ict_malaria').val(data.ict_malaria)
            $('#modal-edit-hematologi #coomb_test').val(data.coomb_test)
            $('#modal-edit-hematologi #hb_eag').val(data.hb_eag)
            $('#modal-edit-hematologi').modal('show');
            $('#loading-top').hide();
        },
        error: function() {
            alert('error');
        },
    });
}
</script>
