<script type="text/javascript">    
//VITAL SIGN
function fecesDeleteModal(id)
{
    $('#fecesDeleteModal #feces_id').val(id)
    $('#fecesDeleteModal').modal('show');
}

function fecesEditModal(id)
{
    $('#loading-top').fadeIn();
    $.ajax({
        url: API_URL + '/kasus/pemeriksaanlab/feces/'+id,
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            $('#modal-edit-feces #feces_id').val(data.id)
            $('#modal-edit-feces #warna').val(data.warna)
            $('#modal-edit-feces #konsistensi').val(data.konsistensi)
            $('#modal-edit-feces #bau').val(data.bau)
            $('#modal-edit-feces #lendir').val(data.lendir)
            $('#modal-edit-feces #darah').val(data.darah)
            $('#modal-edit-feces #lekosit').val(data.lekosit)
            $('#modal-edit-feces #eritrosit').val(data.eritrosit)
            $('#modal-edit-feces #amoeba').val(data.amoeba)
            $('#modal-edit-feces #kista').val(data.kista)
            $('#modal-edit-feces #telur_cacing').val(data.telur_cacing)
            $('#modal-edit-feces #protein').val(data.protein)
            $('#modal-edit-feces #lemak').val(data.lemak)
            $('#modal-edit-feces #karbohidrat').val(data.karbohidrat)
            $('#modal-edit-feces #serat').val(data.serat)
            $('#modal-edit-feces #amylum').val(data.amylum)
            $('#modal-edit-feces #bakteri').val(data.bakteri)
            $('#modal-edit-feces #benzidin_test').val(data.benzidin_test)
            $('#modal-edit-feces').modal('show');
            $('#loading-top').hide();
        },
        error: function() {
            alert('error');
        },
    });
}
</script>
