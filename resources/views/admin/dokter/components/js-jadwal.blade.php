<script type="text/javascript">
var rowNum = 0;
$('.js-masked-time').mask("99:99");

$(document).on('click', '#buttonSubmit', function () {
    swal({
        title: 'Apa anda yakin menyimpan data ini?',
        type: 'warning',
        confirmButtonClass: 'btn btn-success',
        cancelButtonClass: 'btn btn-secondary',
        showCancelButton: true,
        confirmButtonText: 'Simpan',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.value) {
            $('#form-dokter').submit();
        }
    })    
})

$(document).on('click', '.unlimited', function () {
    if ($(this).prop('checked') == true) {
        $(this).parents('.form-group.row').find('input.kuota').val('').prop('disabled', true);
    } else {
        $(this).parents('.form-group.row').find('input.kuota').val('').prop('disabled', false);
    }
})

$(document).on('click', '#jadwal_praktek_form_add', function() {
    $('#jadwal_praktek_content').removeClass('d-none');
    $('#jadwal_praktek_empty').addClass('d-none');
    form_data = [];
    form_serialize = $('#jadwal_praktek_form').serializeArray();
    jQuery.each(form_serialize, function( i, field ) {
        if (field.name != 'form_row' && field.name != 'form_jadwal_id') {
            nama = field.name.split('[]');
            if(form_data[nama[0]] == undefined) {
                form_data[nama[0]] = [];
            }
            form_data[nama[0]].push(field.value);
        } else {
            form_data[field.name] = field.value;
        }
    });
    // console.log(form_data)
    jQuery.each(form_data.form_poliklinik, function (i,item) {
        if(typeof form_data.is_video == 'undefined'){
            is_video = 0
        }
        else{
            is_video = form_data.is_video[i]
        }
        poli_text = form_data.form_poli_txt[i];
        hari = form_data.form_hari[i].split("|");
        addJadwal(form_data.form_poliklinik[i], poli_text, hari[0], hari[1], form_data.form_time_start[i], form_data.form_time_end[i], form_data.form_jadwal_id, form_data.form_row,is_video);
    })  
    $('#modal_jadwal_praktek').modal('hide');
    $('#jadwal_praktek_form_content').children('.template_element:not(:first)').remove();
})

$(document).on('click', '#btn_add_jadwal', function() {
    $('.modal-jadwal-text').text('Tambahkan');
    $('#jadwal_praktek_form').trigger("reset");
    $('#jadwal_praktek_form').find('input[type="hidden"]').val(0);
    $('#jadwal_praktek_form').find('select[name="form_poliklinik[]"]').val('').trigger('change');
    $('#jadwal_praktek_form').find('select[name="form_hari[]"]').val('').trigger('change');
    $('#jadwal_praktek_form_add_row').removeClass('d-none')
    $('#modal_jadwal_praktek').modal('show');
})

$(document).on('click', '.btn-edit-jadwal', function() {
    $('.modal-jadwal-text').text('Edit');
    row_id = $(this).data('row')
    id = $('#jadwal_id_ke_'+row_id).val()
    poli = $('#jadwal_poli_ke_'+row_id).val()
    poli_txt = $('#jadwal_praktek_row_'+row_id).find('div p').text()
    hari = $('#jadwal_hari_ke_'+row_id).val()
    jam_mulai = $('#jadwal_start_ke_'+row_id).val()
    jam_selesai = $('#jadwal_finish_ke_'+row_id).val()
    is_video = $('#is_video_ke_'+row_id).val()
    $('input[name="form_row"]').val(row_id)
    $('input[name="form_jadwal_id"]').val(id)
    $('select[name="form_poliklinik[]"]').val(poli).trigger('change')
    $('input[name="form_poli_txt[]"]').val(poli_txt)
    $('select[name="form_hari[]"]').val(hari).trigger('change')
    $('input[name="form_time_start[]"]').val(jam_mulai)
    $('input[name="form_time_end[]"]').val(jam_selesai)
    if(is_video == 1){
        $('input[name="is_video[]"]').prop('checked', true);
    }
    else{
        $('input[name="is_video[]"]').prop('checked', false);
    }
    $('#jadwal_praktek_form_add_row').addClass('d-none')
    $('#modal_jadwal_praktek').modal('show');
})

$(document).on('click', '.btn-hapus-jadwal', function() {
    row_id = $(this).data('row')
    $('#jadwal_praktek_row_'+row_id).remove();
    if ($('#jadwal_praktek_content div').length == 0) {
        $('#jadwal_praktek_content').addClass('d-none');
        $('#jadwal_praktek_empty').removeClass('d-none');
    }
})

$('.jadwal_praktek_form_poli').on("select2:select", function(e) { 
    poli_txt = $(this).children("option:selected").text();
    $(this).siblings('input[name="form_poli_txt[]"]').val(poli_txt);
});

$(document).on('click', '#jadwal_praktek_form_add_row', function () {
    $('.js-select2').select2('destroy');
    temp = $('#jadwal_praktek_form_content .row:first').clone();
    $('#jadwal_praktek_form_content').append(temp);
    $(".js-select2").select2();
    $('.js-masked-time').mask("99:99");
    $('.jadwal_praktek_form_poli').on("select2:select", function(e) { 
        poli_txt = $(this).children("option:selected").text();
        $(this).siblings('input[name="form_poli_txt[]"]').val(poli_txt);
    });
})


$(document).on('click', '.jadwal_remove_button', function () {
    if ($('.template_element').length > 1) {
        $(this).parents('.template_element').remove();
    }
})


function addJadwal(poli_id, poli_name, hari_order, hari, time_start, time_end, jadwal_id, edit_row = 0,is_video = 0) {
    if(is_video){
        video_badge = `<span class="badge badge-success video-check">Telekonsultasi</span>`;
    }
    else{
        video_badge = `<span class="badge badge-success video-check"></span>`;
    }

    if (edit_row == 0) {
        rowNum++;

        if(is_video){
            video = `<input type="hidden" name="is_video[]" id="is_video_ke_`+rowNum+`" value=1>`;
        }
        else{
            video = `<input type="hidden" name="is_video[]" id="is_video_ke_`+rowNum+`" value=0>`;
        }

        content =   `<div class="block block-bordered mb-10" id="jadwal_praktek_row_`+rowNum+`">
                        <div class="block-content p-10 pb-15">
                            <a class="btn btn-sm btn-circle btn-alt-danger float-right ml-5 btn-hapus-jadwal" href="javascript:void(0)" data-row="`+rowNum+`">
                                <i class="fa fa-trash"></i>
                            </a>
                            <a class="btn btn-sm btn-circle btn-alt-info float-right btn-edit-jadwal" href="javascript:void(0)" data-row="`+rowNum+`">
                                <i class="fa fa-pencil"></i>
                            </a>
                            <p class="font-w600 font-size-md my-0"><input type="hidden" class="poli_id" value="`+poli_id+`"/>`+poli_name+`</p>
                            <span class="font-w400 font-size-sm mb-5"><span class="hari">`+hari+`</span>, Pukul <span class="jam-mulai">`+time_start+`</span> - <span class="jam-selesai">`+time_end+`</span>${video_badge}</span>
                        </div>
                        <input type="hidden" name="jadwal_id[]" id="jadwal_id_ke_`+rowNum+`" value="`+jadwal_id+`">
                        <input type="hidden" name="poli[]" id="jadwal_poli_ke_`+rowNum+`" value="`+poli_id+`">
                        <input type="hidden" name="hari[]" id="jadwal_hari_ke_`+rowNum+`" value="`+(hari_order+'|'+hari)+`">
                        <input type="hidden" name="time_start[]" id="jadwal_start_ke_`+rowNum+`" value="`+time_start+`">
                        <input type="hidden" name="time_end[]" id="jadwal_finish_ke_`+rowNum+`" value="`+time_end+`">
                        ${video}
                    </div>`;
        $('#jadwal_praktek_content').append(content);
    } else {
        $('#jadwal_praktek_row_'+edit_row).find('div p').html('<input type="hidden" class="poli_id" value="'+poli_id+'"/>'+poli_name)
        $('#jadwal_praktek_row_'+edit_row).find('span.hari').text(hari)
        $('#jadwal_praktek_row_'+edit_row).find('span.jam-mulai').text(time_start)
        $('#jadwal_praktek_row_'+edit_row).find('span.jam-selesai').text(time_end)
        $('#jadwal_id_ke_'+edit_row).val(jadwal_id)
        $('#jadwal_poli_ke_'+edit_row).val(poli_id)
        $('#jadwal_hari_ke_'+edit_row).val(hari_order+'|'+hari)
        $('#jadwal_start_ke_'+edit_row).val(time_start)
        $('#jadwal_finish_ke_'+edit_row).val(time_end)
        $('#is_video_ke_'+edit_row).val(is_video)
    }
}
</script>