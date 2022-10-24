<script src="{{ URL::asset('/plugins/tinymce/tinymce.min.js') }}" type="text/javascript" ></script>
<script type="text/javascript">
    $(document).ready(function(){
        Codebase.helpers(['summernote']);

        $(function() {
            $('.tooltip-wrapper').tooltip({position: "top"});
        });
    });
</script>
<script  type="text/javascript">
    $('.confirm-del').on('click', function(){
        var deleteSupp = $(this).parent().find('form');
        swal({
            title: 'Apa anda yakin?',
            text: 'Data yang telah terhapus tidak dapat dikembalikan lagi',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d26a5c',
            confirmButtonText: 'Hapus',
            html: false,
            preConfirm: function() {
                return new Promise(function (resolve) {
                    setTimeout(function () {
                        resolve();
                    }, 50);
                });
            }
        }).then(function(result){
            if (result.value) {
                deleteSupp.submit();
                //swal('Berhasil', 'Data berhasil dihapus.', 'success');
                // result.dismiss can be 'overlay', 'cancel', 'close', 'esc', 'timer'
            } else if (result.dismiss === 'cancel') {
                swal('Batal', 'Hapus data dibatalkan.', 'error');
            }
        });
    });

    $('#btn-submit-print').on('click',function(){
        var $this = $(this).parents('form');
        $this.unbind('submit').submit();
    });
    $('#usulan-file').change(function(e){
        var fileNames =  e.target.files;
        var fileName = '';
        $.each(fileNames,function (j,item) {
            fileName += item.name+' '
        });
        if (fileName.length > 130) {
            fileName = fileName.substring(0,130)+'..';
        }
        $(this).next().html(fileName);
    });

    function deleteUsulanFile(index,value)
    {
        $('#input-usulan-file-'+index).val(value);
        $('#block-usulan-file-'+index).addClass('d-none')

    }

    function deleteLogUsulanFile(index,value)
    {
        $('#input-log-usulan-file-'+index).val(value);
        $('#block-edit-log-usulan-file-'+index).addClass('d-none')
        $('#block-create-log-usulan-file-'+index).removeClass('d-none')

    }

    function toggleEditUsulan(id)
    {
        $('#id_usulan').val(id);
        $('#formToggleEdit').submit();
    }
</script>