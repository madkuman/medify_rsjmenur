<script type="text/javascript">
    $('#btnAddItems').on('click', function(){
        str = `@include('rawatjalan.pengaturan.telekonsultasi-form',['index' => "\${counter}", 'row' => null])`;
        $('#newItem').append(str);
        $('#tarif-telekonsultasi-'+counter).select2();
        removeItem()
        counter++;
    });

    function removeItem() {
        $('.btnRemove').on('click', function(){
            var wrapper = $(this).parents('.item-wrapper');
            wrapper.remove();
        });
    }
</script>