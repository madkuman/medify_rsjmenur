<script type="text/javascript">
	function loadingMetode()
    {
        $("#InfoPembayaran").html(`<div id="myLoading" class="col-12 text-center">
            <i class="fa fa-4x fa-asterisk fa-spin text-info mb-5"></i>
            </div>
            `);
    }

    function lihatMetode(id)
    {
        loadingMetode();
        $('.bpjs').hide();
        $('#infoBPJSWrapper').hide();
        $('#sep_custom_wrapper').hide();
        resetBPJSModalPreview()
        $.ajax({
            type:'GET',
            url:API_URL + '/pasien/pendaftaran/metode/get/'+id,
            dataType: 'json',
            success:function(data){
                if (data.perusahaan.tipe.slug=='bpjs') {
                    $('#form-no-sep').show();
                    $('#nomorSEP').show();
                    $('#noSEP').val('');
                    $("#InfoPembayaran").html(`
                        <div class="col-12">
                            <span class="font-w600 h3">
                                BPJS
                            </span>    
                        </div>
                        <div class="col-lg-4 col-12">
                            <div class="font-w600">Jenis Pasien</div>                            
                        </div>
                        <div class="col-lg-8 col-12 mb-5">BPJS</div>
                        <div class="col-lg-4 col-12">
                            <div class="font-w600">Jenis BPJS</div>                            
                        </div>
                        <div class="col-lg-8 col-12 mb-5">`+data.perusahaan.nama+`</div>
                        <div class="col-lg-4 col-12">
                            <div class="font-w600">Nomor BPJS</div>                            
                        </div>
                        <div class="col-lg-8 col-12 mb-5">`+data.no_asuransi+`</div>
                        <div class="col-lg-4 col-12 mb-5">
                            <div class="font-w600">Kelas Perawatan</div>                            
                        </div>
                        <div class="col-lg-8 col-12 mb-5">`+data.kelas.nama+`</div>
                        `);
                    nomor_kartu = data.no_asuransi;
                    is_bpjs = 1;
                    
                    @if(config('app.bpjs_enable', false))
                        $('.bpjs').show();
                        getNoRujukan(data.no_asuransi);
                    @endif
                }
                else if(data.perusahaan.tipe.slug=='tunai'){
                    $('#form-no-sep').hide();
                    $('#nomorSEP').hide();
                    $('#infoBPJSWrapper').hide();
                    $('#sep_button_wrapper').hide();
                    $('#noSEP').val(0);
                    $("#InfoPembayaran").html(`
                        <div class="col-12 font-w600 h3">Umum</div>
                        <div class="col-lg-4 col-12">
                        <div class="font-w600">Jenis Pasien</div>                            
                        </div>
                        <div class="col-lg-8 col-12 mb-5">Umum</div>
                        <div class="col-lg-4 col-12 mb-5">
                        <div class="font-w600">Kelas Perawatan</div>                            
                        </div>
                        <div class="col-lg-8 col-12 mb-5">`+data.kelas.nama+`</div>
                        `);
                    
                    nomor_kartu = null;
                    is_bpjs = 0;
                }
                else{
                    $('#form-no-sep').hide();
                    $('#nomorSEP').hide();
                    $('#infoBPJSWrapper').hide();
                    $('#sep_button_wrapper').hide();
                    $('#noSEP').val(0);
                    $("#InfoPembayaran").html(`
                        <div class="col-12 font-w600 h3">Asuransi / Kerjasama</div>
                        <div class="col-lg-4 col-12">
                        <div class="font-w600">Jenis Pasien</div>                            
                        </div>
                        <div class="col-lg-8 col-12 mb-5">Asuransi / Kerjasama</div>
                        <div class="col-lg-4 col-12">
                        <div class="font-w600">Perusahaan</div>                            
                        </div>
                        <div class="col-lg-8 col-12 mb-5">`+data.perusahaan.nama+`</div>
                        <div class="col-lg-4 col-12">
                        <div class="font-w600">Nomor Asuransi</div>                            
                        </div>
                        <div class="col-lg-8 col-12 mb-5">`+data.no_asuransi+`</div>
                        <div class="col-lg-4 col-12 mb-5">
                        <div class="font-w600">Kelas Perawatan</div>                            
                        </div>
                        <div class="col-lg-8 col-12 mb-5">`+data.kelas.nama+`</div>
                        `);

                    nomor_kartu = null;
                    is_bpjs = 0;
                }
            },
            error:function(data){
            }
        });
	}

    $('.select-kelas').change(function(){
        checkKelas();
    })

	
</script>