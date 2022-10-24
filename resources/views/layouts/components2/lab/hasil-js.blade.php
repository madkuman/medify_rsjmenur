<script type="text/javascript">
$("#lightgallery").lightGallery({
    appendSubHtmlTo: '.lg-item',
    addClass: 'fb-comments',
    mode: 'lg-fade',
    zoom: true,
    actualSize: true,
    fullscreen: true,
    mousewheel: false,
    selector:'.btn.selector',
    keyPress: false
});


function editPenunjang(id){
    $(`.show-container-${id}`).hide();
    $(`.edit-container-${id}`).show();
}
function cancelEditPenunjang(id)
{
    $(".show-container-"+id).show();
    $(".edit-container-"+id).hide();
}
function deletePenunjang(id){
    swal({
        title: 'Apa anda yakin menghapus file ini?',
        text: "File yang telah dihapus tidak dapat dikembalikan",
        type: 'warning',
        confirmButtonClass: 'btn btn-danger',
        cancelButtonClass: 'btn btn-primary',
        showCancelButton: true,
        confirmButtonText: 'Hapus',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.value) {
            $("#deleteId").val(id);
            $("#deleteForm").submit();
        }
    })
}
function submitEditPenunjang(id){
    var data = $(`#editFormPenunjang_${id}`).serialize();
    swal({
        title: 'Ubah Penunjang?',
        type: 'warning',
        confirmButtonClass: 'btn btn-success',
        cancelButtonClass: 'btn btn-primary',
        showCancelButton: true,
        confirmButtonText: 'Ubah',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.value) {
            swal({
                html: `<h4>Mengupdate Penunjang</h4><span class="fa fa-4x fa-cog fa-spin text-primary text-center loader"></span>`,
                showCancelButton: false,
                showConfirmButton: false
            });
            $.post(`${LAB_URL}/transaksi/update/penunjang`, data)
                .done(function(){
                    var showContainer = $(`.show-container-${id}`);
                    var newTitle = $(`#liveTitle_${id}`).val();
                    var newCaption = $(`#liveCaption_${id}`).val();
                    var checkKirim = $(`#liveCheck_${id}`).val();

                    showContainer.empty();
                    showContainer.append(`<h5>${newTitle}</h5>`);
                    showContainer.append(`<p style="white-space: pre-line;">${newCaption}</p>`);
                    if(checkKirim == 'true')
                        showContainer.append(`<p style=" color: red">Gambar ini dikirimkan ke penunjang</p>`);
                    swal.close();
                    swal('Berhasil', 'Berhasil mengupdate Penunjang', 'success');
                    cancelEditPenunjang(id);
                });
        }
    })
}
function verifikasiTransaksi(id){
    swal({
        title: 'Verifikasi Transaksi ini?',
        text: "Pastikan semua keterangan pada gambar telah diisi",
        type: 'warning',
        cancelButtonClass: 'btn btn-danger',
        confirmButtonClass: 'btn btn-primary',
        showCancelButton: true,
        cancelButtonText: 'Batal',
        confirmButtonText: 'Verifikasi',
        reverseButtons: true
    }).then((result) => {
        if (result.value) {
            swal({
                html: `<h4>Verifikasi Transaksi</h4><span class="fa fa-4x fa-cog fa-spin text-primary text-center loader"></span>`,
                showCancelButton: false,
                showConfirmButton: false
            });
            $.post(`${CURRENT_URL}/verifikasi`, $(`#verificationForm`).serialize())
                .done(function(){
                    $(`#verifikasiDiv`).html(`<button class="btn btn-secondary pull-right" type="button" disabled="">Sudah terverifikasi</button>
                    `);
                    swal.close();
                    swal('Berhasil', 'Verifikasi berhasil', 'success');
                    location.reload(true);
                })
                .fail(function(){
                    swal('Gagal', 'Verifikasi gagal, silahkan coba lagi', 'error');
                });
        }
    })
}

function editHasilBaca(){
    $("#showPemeriksaanDiv").hide();
    $("#editPemeriksaanDiv").show();
}

function cancelEditHasilBaca(){
    $("#editPemeriksaanDiv").hide();
    $("#showPemeriksaanDiv").show();
}

function submitEditHasilBaca(){
    swal({
        title: 'Ubah hasil Baca?',
        type: 'warning',
        confirmButtonClass: 'btn btn-success',
        cancelButtonClass: 'btn btn-primary',
        showCancelButton: true,
        confirmButtonText: 'Ubah',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.value) {
            swal({
                html: `<h4>Mengupdate Hasil Baca</h4><span class="fa fa-4x fa-cog fa-spin text-primary text-center loader"></span>`,
                showCancelButton: false,
                showConfirmButton: false
            });
            var hasilBaca = tinyMCE.activeEditor.getContent();
            $("#pemeriksaanInput").val(hasilBaca);
            $.post(`${CURRENT_URL}/update/hasilbaca`, $(`#hasilBacaForm`).serialize())
                .done(function(){
                    $("#showPemeriksaanDiv").html(hasilBaca);
                    swal.close();
                    swal('Berhasil', 'Berhasil mengupdate Hasil Baca', 'success');
                    cancelEditHasilBaca();
                });
        }
    })
}

$(document).on('change', '.edit-check', function(){
    var target = this.dataset.target;
    $(`#${target}`).val(this.checked);
});

$(document).on('keyup', '.edit-title', function(){
    var target = this.dataset.target;
    $(`#${target}`).val(this.value);
});

$(document).on('keyup', '.edit-caption', function(){
    var target = this.dataset.target;
    $(`#${target}`).val(this.value);
})
</script>