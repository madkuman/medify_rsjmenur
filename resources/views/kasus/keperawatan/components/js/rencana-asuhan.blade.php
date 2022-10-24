
<script type="text/javascript">
    $('#loadingSelectRencanaAsuhan').hide()

    $(document).on('click', '#modal-create-rencana-asuhan #buttonSubmitSelectRencanaAsuhan', function() {
        $.ajax({ 
            url: API_URL + '/keperawatan/rencana-asuhan/' + $('#modal-create-rencana-asuhan #selectRencanaAsuhan').val().trim(), 
            success: function(data) {
                $('#modal-create-rencana-asuhan-form #form-container').empty();
                $('#modal-create-rencana-asuhan-form #form-container').append(data);
                $('#modal-create-rencana-asuhan-form').modal('toggle');
                $('#modal-create-rencana-asuhan').modal('toggle');
            } });
    });
</script>

<script>
    $(document).ready(function(){
        // $("#manajemen_kamar").addClass('active');
        $(".hapus").click(function(e){
            e.preventDefault();
            var link = $(this).attr('href');
            swal({
                title: "Hapus",
                text: "Apakah anda yakin akan menghapus rencana asuhan ini?",
                showCancelButton: true,
                reverseButtons: true,
                type: 'warning',
                confirmButtonClass: "btn btn-danger",
                cancelButtonClass: "btn btn-default",
                confirmButtonText: "Hapus",
                cancelButtonText: "Kembali",
                closeOnConfirm: false
            }).then(function(result) {
                if(result.value)
                    window.location.href = link;
            });
        });
    });

    $('#selectJenisAsuhan').on('select2:select', function (e) {
        var data = e.params.data;
        id = data.id

        $('#loadingSelectRencanaAsuhan').show();
        $('#buttonSubmitSelectRencanaAsuhan').prop( "disabled", true );
        $.ajax({ 
            url: API_URL + '/keperawatan/rencana-asuhan/get-list/' +id, 
            dataType: 'json',
            tryCount : 0,
            retryLimit : 3,
            success:function(data){
                $('#selectRencanaAsuhan').html('')
                var dataCount=0;
                data.forEach(function(item) {
                    var newOption = new Option(item.diagnosa, item.id, false, false);
                    $("#selectRencanaAsuhan").append(newOption).trigger('change');
                });
                $('#loadingSelectRencanaAsuhan').hide();
                $('#buttonSubmitSelectRencanaAsuhan').prop( "disabled", false );
                return 1;
            },
            error : function(xhr, textStatus, errorThrown ) {
                this.tryCount++;
                if (this.tryCount <= this.retryLimit) {
                    $.ajax(this);
                    return;
                }            
                return;
            }})
    });
</script>