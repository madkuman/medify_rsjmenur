<script>
    function getIcare() {
        var param = $('#param').val();
        var kodedokter = $('#kodedokter').val();

        $.ajax({
            url: "{{ route('icare') }}",
            type: 'POST',
            data: {
                param: param,
                kodedokter: kodedokter
            },
            success: function(data) {
                window.open(data.url, 'miniWindow', 'width=600,height=400');
            }
        });
    }
</script>
