<script type="text/javascript">    
//VITAL SIGN
function kimiaDeleteModal(id)
{   
    console.log('abc');
    $('#kimiaDeleteModal #kimia_id').val(id)
    $('#kimiaDeleteModal').modal('show');
}

function kimiaEditModal(id)
{
    $('#loading-top').fadeIn();
    $.ajax({
        url: API_URL + '/kasus/pemeriksaanlab/kimia/'+id,
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            $('#modal-edit-kimia #kimia_id').val(data.id)
            $('#modal-edit-kimia #hbs_ag').val(data.hbs_ag)
            $('#modal-edit-kimia #anti_hiv').val(data.anti_hiv)
            $('#modal-edit-kimia #vdrl').val(data.vdrl)
            $('#modal-edit-kimia #anti_hcv').val(data.anti_hcv)
            $('#modal-edit-kimia #ict_malaria').val(data.ict_malaria)
            $('#modal-edit-kimia #coomb_test').val(data.coomb_test)
            $('#modal-edit-kimia #hb_eag').val(data.hb_eag)
            $('#modal-edit-kimia').modal('show');
            $('#loading-top').hide();
        },
        error: function() {
            alert('error');
        },
    });
}
</script>
