<script type="text/javascript">

function getDokter(id)
{

    $('#pilihDokterLoading').show();
    $.ajax({
        type:'GET',
        url:"/rawatjalan/get-dokter/"+id,
        dataType: 'json',
        success:function(data){
            $('#pilih-dokter').html('').select2({data: [{id: '', text: ''}]});
            var newOption = new Option('-', 0, false, false);       //DEFAULT KOSONG
            $("#pilih-dokter").append(newOption).trigger('change');
            data.forEach(function(item) {
                var newOption = new Option(item.text, item.id, false, false);
                $("#pilih-dokter").append(newOption).trigger('change');
            });
            $('#pilihDokterLoading').fadeOut();
        },
        error:function(data){
            console.log(data);
        }
    });
}
</script>