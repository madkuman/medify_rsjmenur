const targetEl = $('.tujuan-permintaan');
const kelasEl = $('#kelasLayanan');
const tipeEl = $('.tipe-layanan');
function changeForm()
{

    if( (!$('#tujuanPermintaan').val() && $('.tujuan-permintaan:checked').length == 0) || $('.tipe-layanan:checked').length == 0 || $("#kelasInput").val() == "")
        return;
    let kelas = kelasEl.find(':selected').val() || $('#kelasInput').val(),
        departemen = $('.tujuan-permintaan:checked').data('dept') || $('#tujuanPermintaan').data('dept'),
        tipe = $('.tipe-layanan:checked').val();

    let targetUrl = `${layananUrl}?kelas=${kelas}&departemen=${departemen}&tipe=${tipe}`;
    $('.ajax-container').css('display', 'none');
    $.ajax({
        url: targetUrl,
        type: 'GET',
        dataType: 'json',
        beforeSend: function(){
            $('.loader').css('display', 'block');
        },
        success: function(response) {
            loadResponse(response);
        },
        complete: function(){
            $('.loader').css('display','none');
        },
        error: function() {
            $('#errorContainer').css('display', 'block');
        },
    });
}

function loadResponse(response)
{
    // console.log(response[0])
    let responseLength = Object.keys(response).length;
    if(responseLength){
        let formCode = '<div class="col-6">';
        let offset = Math.floor(responseLength/2);
        let flag = true;
        let count = 0;
        let check_urikkes = $('#tarif_urikkes').val();
        if(check_urikkes)
            var tarif_urikkes = $('#tarif_urikkes').val().split(",");
        for(let index in response){
            if(count > offset && flag){
                formCode += `</div><div class="col-6">`;
                flag = false;
            }
            formCode += `<h5 class="bg-warning p-10 kategori-text" style="margin-bottom: 5px; margin-top: 20px;">${index}</h5>`;
            response[index].tarif.forEach(function(tarif){
                if(check_urikkes && tarif_urikkes.includes(tarif.id.toString()))
                    formCode += `<div><label class="css-control css-control-primary css-checkbox single-layanan">
                                <input type="checkbox" name="layanan[]" value="${tarif.id}" class="css-control-input" checked>
                                <span class="css-control-indicator"></span><span class="tarif-name"> ${tarif.deskripsi}</span>
                            </label></div>
                            `;
                else
                    formCode += `<div><label class="css-control css-control-primary css-checkbox single-layanan">
                                    <input type="checkbox" name="layanan[]" value="${tarif.id}" class="css-control-input">
                                    <span class="css-control-indicator"></span><span class="tarif-name"> ${tarif.deskripsi}</span>
                                </label></div>
                                `;
            });
            count++;
        }
        formCode += `</div>`;
        $('#layananDiv').html(formCode);

        $('#layananContainer').css('display', 'block');
    } else {
        $('#emptyContainer').css('display', 'block');
    }
}

function filterLayanan(e)
{
    if(e.value.length < 2){
        $('.kategori-text').css('display', '');
        $('.single-layanan').css('display', '');
        return;
    }

    let filter, container, rows, i, textValue;
    filter = e.value.toLowerCase();

    container = document.getElementById('layananDiv');
    rows = container.getElementsByClassName('single-layanan');

    $('.kategori-text').css('display', 'none');
    for(i = 0; i < rows.length; i++)
    {
        textValue = rows[i].getElementsByClassName('tarif-name')[0].innerText.toLowerCase();
        if(textValue.indexOf(filter) > -1 ) {
            rows[i].style.display = "";
        } else {
            rows[i].style.display = "none";
        }
    }
}

var submitBtn = document.getElementById("submitBuatPermintaanBtn");

function validateForm(){
    disableClick(submitBtn);
    if($('input[name="layanan[]"]:checked').length == 0){
        swal('Gagal!', 'Pilih minimal satu layanan yang akan dipesan', 'error');
        enableClick(submitBtn);
        return false;
    }
    if($('input[name=kirim_kasir]:checked').val() != 0 && $('input[name=kirim_kasir]:checked').val() != 1){
        swal('Gagal!', 'Pilih tujuan tagihan akan dikirim', 'error');
        enableClick(submitBtn);
        return false;
    }
    $('#submitBuatPermintaanBtn').off('click');
    $('#permintaanForm').submit();
}