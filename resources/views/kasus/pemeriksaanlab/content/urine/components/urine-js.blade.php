<script type="text/javascript">    
//VITAL SIGN
function urineDeleteModal(id)
{
    $('#urineDeleteModal #urine_id').val(id)
    $('#urineDeleteModal').modal('show');
}

function urineEditModal(id)
{
    $('#loading-top').fadeIn();
    $.ajax({
        url: API_URL + '/kasus/pemeriksaanlab/urine/'+id,
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            $('#modal-edit-urine #urine_id').val(data.id)
            $('#modal-edit-urine #tes_kehamilan').val(data.tes_kehamilan)
            $('#modal-edit-urine #leuko').val(data.leuko)
            $('#modal-edit-urine #eritrosit').val(data.eritrosit)
            $('#modal-edit-urine #epitel').val(data.epitel)
            $('#modal-edit-urine #bakteri').val(data.bakteri)
            $('#modal-edit-urine #cylinder').val(data.cylinder)
            $('#modal-edit-urine #kristal').val(data.kristal)
            $('#modal-edit-urine #candida').val(data.candida)
            $('#modal-edit-urine #morphin').val(data.morphin)
            $('#modal-edit-urine #metamphetamine').val(data.metamphetamine)
            $('#modal-edit-urine #amphetamine').val(data.amphetamine)
            $('#modal-edit-urine #diazepam').val(data.diazepam)
            $('#modal-edit-urine #ganja').val(data.ganja)
            $('#modal-edit-urine #warna').val(data.warna)
            $('#modal-edit-urine #berat_jenis').val(data.berat_jenis)
            $('#modal-edit-urine #ph').val(data.ph)
            $('#modal-edit-urine #protein').val(data.protein)
            $('#modal-edit-urine #reduksi').val(data.reduksi)
            $('#modal-edit-urine #reduksi_2_jpp').val(data.reduksi_2_jpp)
            $('#modal-edit-urine #urobilinogen').val(data.urobilinogen)
            $('#modal-edit-urine #bilirubin').val(data.bilirubin)
            $('#modal-edit-urine #keton').val(data.keton)
            $('#modal-edit-urine #nitrit').val(data.nitrit)
            $('#modal-edit-urine #leukosit').val(data.leukosit)
            $('#modal-edit-urine #urobilirubin').val(data.urobilirubin)
            $('#modal-edit-urine').modal('show');
            $('#loading-top').hide();
        },
        error: function() {
            alert('error');
        },
    });
}
</script>
