<script type="text/javascript">
    checkKelas()
    function checkKelas()
    {
        $('.retribusi-checkbox').prop('checked', false);
        updateTotalHarga(0)

        var slug_default = '.administrasi-lainnya'
        if(valLayanan == 1)
        {
            kelas = $("#selectKelasPoli").val()
            var slug = '.administrasi-poli'
            var slug_konsultasi = '.pemeriksaan-dokter'
            $(slug+'.retribusi-checkbox-container-kelas-0 .retribusi-checkbox')[0].checked = true;
        }
        else if(valLayanan == 2) {
            kelas = $("#selectKelasIGD").val();
            var slug = '.administrasi-igd'
        }
        else if(valLayanan == 3) {
            kelas = $("#selectKelasMedicalCheckup").val();
            var slug = '.administrasi-medical-checkup'
        }

        $('.retribusi-checkbox-container').hide()
        $(slug+'.retribusi-checkbox-container-kelas-'+kelas).show()
        $(slug+'.retribusi-checkbox-container-kelas-0').show()
        $(slug_default+'.retribusi-checkbox-container-kelas-'+kelas).show()
        $(slug_default+'.retribusi-checkbox-container-kelas-0').show()
        $(slug_konsultasi+'.retribusi-checkbox-container-kelas-0').show()
        $(slug_konsultasi+'.retribusi-checkbox-container-kelas-'+kelas).show()

        
    }

    // $('#selectPoli').on('change', function()
    //     {
    //         console.log(this.value)
    //         if(this.value == 11){
    //             $(slug_konsultasi_umum+'.retribusi-checkbox-container-kelas-0').show()
    //             $(slug_konsultasi_umum+'.retribusi-checkbox-container-kelas-'+kelas).show()
    //         } else {
    //             $('.pemeriksaan-dokter-120000 .retribusi-checkbox-container-kelas-0').show()
    //             $('.pemeriksaan-dokter-120000 .retribusi-checkbox-container-kelas-'+kelas).show()
    //         }
    //     });

    function add(jumlah)
    {
        totalBayar = totalBayar + jumlah;
        updateTotalHarga(totalBayar)
    }
    function min(jumlah)
    {
        totalBayar = totalBayar - jumlah;
        updateTotalHarga(totalBayar)
    }
    function updateTotalHarga(totalBayar)
    {
        totalBayar = numeral(totalBayar).format('0,0');
        $("#total_bayar").html(`<span class="control-label font-w700" >`+totalBayar+`</span>`);
    }


    $('.retribusi-checkbox').click(function() {
        var harga = $(this).data('harga')
        var id = $(this).val()
        var is_checked = $(this).is(":checked")

        if(is_checked) add(harga)
        else min(harga)
    });
    
</script>