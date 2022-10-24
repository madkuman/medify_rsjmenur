<script type="text/javascript">
    const numberWithCommas = (x) => {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }
    
    $('#tarifLoading').hide();

    function updateCreateSubTotal()
    {
        var unit_price = $('#tagihanCreateUnitPrice').val();
        var qty = $('#tagihanCreateQty').val();
        var subtotal = unit_price * qty;
        subtotal = numberWithCommas(subtotal);
        $('#tagihanCreateSubTotalMask').val(subtotal);
    }

    var kasus_departemen_id =  {{$transaksi->kasus->lokasi->lokasi->departemen->id}}

    


</script>