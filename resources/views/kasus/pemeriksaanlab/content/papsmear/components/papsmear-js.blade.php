<script type="text/javascript">    
//VITAL SIGN
function smearDeleteModal(id)
{   
    console.log('abc');
    $('#smearDeleteModal #smear_id').val(id)
    $('#smearDeleteModal').modal('show');
}

function smearEditModal(id)
{
    $('#loading-top').fadeIn();
    $.ajax({
        url: API_URL + '/kasus/pemeriksaanlab/smear/'+id,
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            $('#modal-edit-smear #smear_id').val(data.id)
            $('#modal-edit-smear #pap_smear').val(data.pap_smear)
            $('#modal-edit-smear').modal('show');
            $('#loading-top').hide();
        },
        error: function() {
            alert('error');
        },
    });
}
</script>
