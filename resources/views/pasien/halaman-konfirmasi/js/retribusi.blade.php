<script type="text/javascript">
    function add(jumlah)
    {
        totalBayar = totalBayar + jumlah;
    }
    function min(jumlah)
    {
        totalBayar = totalBayar - jumlah;
    }
    
    $('#pasien_baru').click(function() {
        if(clickPasienBaru == 1) 
        {
            clickPasienBaru = 0;
            min(36000);
            $("#total_bayar").html(`<span class="control-label font-w700" >`+totalBayar+`</span>`);
        }
        else {
            add(36000);
            clickPasienBaru =1 ;
            $("#total_bayar").html(`<span class="control-label font-w700" >`+totalBayar+`</span>`);
        }
    });

    $('#is_kartu_baru').click(function() {
        if(clickKartu == 1) 
        {
            min(15000);
            clickKartu = 0;
            $("#total_bayar").html(`<span class="control-label font-w700" >`+totalBayar+`</span>`);
        }
        else {
            add(15000);
            clickKartu =1 ;
            $("#total_bayar").html(`<span class="control-label font-w700" >`+totalBayar+`</span>`);
        }
    });

    $('#karcis_poli').click(function() {
        if(clickPoli == 1) 
        {
            clickPoli = 0;
            min(9000);
            $("#total_bayar").html(`<span class="control-label font-w700" >`+totalBayar+`</span>`);
        }
        else {
            add(9000);
            clickPoli =1 ;
            $("#total_bayar").html(`<span class="control-label font-w700" >`+totalBayar+`</span>`);
        }
    });
</script>