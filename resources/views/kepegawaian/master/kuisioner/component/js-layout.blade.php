<script type="text/javascript">
    function layoutPilgan() {
        var layout  =   '<hr>'
                        +'<div id="isian-pilgan-content">'
                        +'<div class="form-group row jawab-pilgan">'
                        +'<label class="col-lg-2 col-form-label" for="val_pilihan_ganda">Pilihan A</label>'
                        +'<div class="col-lg-10">'
                        +'<input type="text" class="form-control" name="val_pilihan_ganda[]" placeholder="Negatif" id="val_pilgan_1" autocomplete="off">'
                        +'</div>'
                        +'</div>'
                        +'</div>'
                        +'<div class="form-group row">'
                        +'<div class="col-lg-12 text-center">'
                        +'<a href="javascript:void(0)" id="addPilihanBtn" data-id="2" data-huruf="B" onclick="addPilihan()" class="btn btn-hero btn-rounded btn-alt-success mr-5 mb-5"><i class="fa fa-plus"></i> Tambah Pilihan</a>'
                        +'</div>'
                        +'</div>';
        return layout;
    }

    function layoutSkala() {
        var temp = $('input[name=skala-temp]').val();
        var checkBox = '';
        if (temp !== 'kosong') {
            checkBox =  '<label class="css-control css-control-primary css-checkbox">'
                        +'<input type="checkbox" class="css-control-input" id="set-skala" onclick="setSkala()">'
                        +'<span class="css-control-indicator"></span> Gunakan skala sebelumnya'
                        +'</label>';
        }
        var layout  =   '<hr>'
                        +'<div class="form-group row">'
                        +'<div class="col-12">'
                        +'<label class="control-label">Batas Skala</label><br>'
                        +'</div>'
                        +'<div class="col-2 mt-10">'
                        +'1 sampai'
                        +'</div>'
                        +'<div class="col-4">'
                        +'<input type="text" id="batas_skala" class="form-control" name="batas_skala" autocomplete="off" onkeyup="showKeterangan()" placeholder="Maksimal 10">'
                        +'</div>'
                        +'<div class="col-4">';
        if(checkBox){
            layout += checkBox;
        }
                layout  +='</div>'
                        +'</div>'
                        +'<div class="form-group row">'
                        +'<div class="col-12">'
                        +'<label class="control-label">Keterangan Skala</label><br>'
                        +'</div>'
                        +'<div class="col-12">'
                        +'<div class="row" id="show_skala" style="padding: 0px 10px;flex: 0 0 100%"></div>'
                        +'</div>'
                        +'</div>';
        return layout;
    }
</script>