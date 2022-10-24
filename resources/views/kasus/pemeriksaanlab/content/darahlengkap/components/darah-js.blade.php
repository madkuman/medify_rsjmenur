<script type="text/javascript">    
//VITAL SIGN
function darahDeleteModal(id)
{
    $('#darahDeleteModal #darah_id').val(id)
    $('#darahDeleteModal').modal('show');
}

function darahEditModal(id)
{
    $('#loading-top').fadeIn();
    $.ajax({
        url: API_URL + '/kasus/pemeriksaanlab/darahlengkap/'+id,
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            $('#modal-edit-darah #darah_id').val(data.id)
            $('#modal-edit-darah #kolesterol_total').val(data.kolesterol_total)
            $('#modal-edit-darah #hdl').val(data.hdl)
            $('#modal-edit-darah #hematokrit').val(data.hematokrit)
            $('#modal-edit-darah #ldl').val(data.ldl)
            $('#modal-edit-darah #triglyceride').val(data.triglyceride)
            $('#modal-edit-darah #glukosa_acak').val(data.glukosa_acak)
            $('#modal-edit-darah #hba_1c').val(data.hba_1c)
            $('#modal-edit-darah #glukosa_2jam').val(data.glukosa_2_jam_pp)
            $('#modal-edit-darah #glukosa_puasa').val(data.glukosa_puasa)
            $('#modal-edit-darah #sgot').val(data.sgot)
            $('#modal-edit-darah #sgpt').val(data.sgpt)
            $('#modal-edit-darah #bilirubin_direk').val(data.bilirubin_direk)
            $('#modal-edit-darah #bilirubin_indirek').val(data.bilirubin_indirek)
            $('#modal-edit-darah #bilirubin_total').val(data.bilirubin_total)
            $('#modal-edit-darah #alkali_fosfatase').val(data.alkali_fosfatase)
            $('#modal-edit-darah #gamma_gt').val(data.gamma_gt)
            $('#modal-edit-darah #total_protein').val(data.total_protein)
            $('#modal-edit-darah #albumin').val(data.albumin)
            $('#modal-edit-darah #globulin').val(data.globulin)
            $('#modal-edit-darah #ureum_bun').val(data.ureum_bun)
            $('#modal-edit-darah #kreatinin').val(data.kreatinin)
            $('#modal-edit-darah #asam_urat').val(data.asam_urat)
            $('#modal-edit-darah #hemoglobin').val(data.hemoglobin)
            $('#modal-edit-darah #led').val(data.led)
            $('#modal-edit-darah #eritrosit').val(data.eritrosit)
            $('#modal-edit-darah #leukosit').val(data.leukosit)
            $('#modal-edit-darah #hct').val(data.hct)
            $('#modal-edit-darah #trombosit').val(data.trombosit)
            $('#modal-edit-darah #mcv').val(data.mcv)
            $('#modal-edit-darah #mch').val(data.mch)
            $('#modal-edit-darah #mchc').val(data.mchc)
            $('#modal-edit-darah #retikulosit').val(data.retikulosit)
            $('#modal-edit-darah #diff_eosinofil').val(data.diff_eosinofil)
            $('#modal-edit-darah #diff_basofil').val(data.diff_basofil)
            $('#modal-edit-darah #diff_stab').val(data.diff_stab)
            $('#modal-edit-darah #diff_segmen').val(data.diff_segmen)
            $('#modal-edit-darah #diff_limposit').val(data.diff_limposit)
            $('#modal-edit-darah #diff_monosit').val(data.diff_monosit)
            $('#modal-edit-darah #cholinnesterase').val(data.cholinnesterase)
            $('#modal-edit-darah #na').val(data.na)
            $('#modal-edit-darah #k').val(data.k)
            $('#modal-edit-darah #cl').val(data.cl)
            $('#modal-edit-darah #ca').val(data.ca)
            $('#modal-edit-darah #pendarahan').val(data.pendarahan)
            $('#modal-edit-darah #pembekuan').val(data.pembekuan)
            $('#modal-edit-darah #psa_eclia').val(data.psa_eclia)
            $('#modal-edit-darah #pt').val(data.pt);
            $('#modal-edit-darah').modal('show');
            $('#loading-top').hide();
        },
        error: function() {
            alert('error');
        },
    });
}
</script>
