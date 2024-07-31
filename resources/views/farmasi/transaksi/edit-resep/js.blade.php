
    <script type="text/javascript">
        checkResep();
        removeResepJadi();
        changeResepJadi();
        removeItem();
        removeRacikan();
        var harian = "{{($transaksi->pembayaran_detail && $transaksi->pembayaran_detail->perusahaan->tipe->slug == 'bpjs' )}}";
        var resepTemp;
        var tipeObatDb;
        var hargaPerRacikan;
        var item_detail_obat;
        var status_selected_obat_kronis = false;

        $(document).ready(function(){
            
        });

        $('#satuan-select2').select2({
            tags: true
        });

        $('#aturan-select2').select2({
            ajax: {
                url: API_URL+"/farmasi/aturan/search-has-usage",
                dataType: 'json',
                delay: 250,
                data: function (params) 
                {
                    return {
                        keyword: params.term,
                        page: params.page
                    };
                },
                processResults: function (data, params) {
                    params.page = params.page || 1;
                    console.log(data);
                    return {
                        results: data,
                    };
                },
                cache: true
            },
            escapeMarkup: function (markup) { return markup; },
            minimumInputLength: 1,
            tags: true
        });
        $('#satuan-penggunaan-select2').select2({
            tags: true
        });
        $('#namaObat').select2({
            ajax: {
                url: API_URL+"/farmasi/{{session('farmasi')->slug}}/item/get",
                dataType: 'json',
                delay: 250,
                data: function (params) 
                {
                    return {
                        keyword: params.term,
                        page: params.page
                    };
                },
                processResults: function (data, params) {
                    params.page = params.page || 1;
                    return {
                        results: data.data,
                    };
                },
                cache: true
            },
            escapeMarkup: function (markup) { return markup; },
            minimumInputLength: 3,
            placeholder: "Cari Barang",
            templateResult: formatBarang,
            templateSelection: formatBarangSelection
        });
        $('#racikan-select2-1').select2({
            ajax: {
                url: API_URL+"/farmasi/{{session('farmasi')->slug}}/item/get",
                dataType: 'json',
                delay: 250,
                data: function (params) 
                {
                    return {
                        keyword: params.term,
                        page: params.page
                    };
                },
                processResults: function (data, params) {
                    params.page = params.page || 1;
                    return {
                        results: data.data,
                    };
                },
                cache: true
            },
            escapeMarkup: function (markup) { return markup; },
            minimumInputLength: 3,
            placeholder: "Cari Barang",
            templateResult: formatBarang,
            templateSelection: formatBarangSelection
        });

        function formatBarang (item) {
            if (item.loading) {
                return item.text;
            }

            var stok = 0;
            if(item.stok)
                stok = item.stok.aggregate;
            var markup = item.item_detail.nama + " ("+item.item_detail.satuan+") - Stok : " + stok + " - Harga : "+item.item_detail.harga;

            return markup;
        }

        function formatBarangSelection (item) {
            item_detail_obat = item.item_detail;
           if(item.item_detail){
                tipeObatDb = item.item_detail.satuan;

                var stok = 0;
                if(item.stok)
                    stok = item.stok.aggregate;
                return item.item_detail.nama + " ("+item.item_detail.satuan+") - Stok : " + stok + " - Harga : "+item.item_detail.harga;
            } 
            else return item.text;
        }

        function changeDukungan() {
            // jumlah = $('#jumlah-obat').val();
            // hari7 = $('#hari-7').val();
            // dukungan = $('#dukungan-rs').val();
            // console.log(jumlah,hari7,dukungan);
            // $('#hari-23').val(jumlah-hari7-dukungan);

            // ----------------------
            // let jumlah = $('#jumlah-obat').val();
            // let dua_puluh_tiga_hari = (parseInt(jumlah) * 23)/30;
            // let num = Number(dua_puluh_tiga_hari);
            // let roundedString = num.toFixed(2);
            // let dua_puluh_tiga_hari_rounded = Number(Math.floor(roundedString));

            // $('#hari-23').val(dua_puluh_tiga_hari_rounded);

            // let tujuh_hari = parseInt(jumlah) - dua_puluh_tiga_hari_rounded;
            // $('#hari-7').val(tujuh_hari);


            // ----------------------
            if (item_detail_obat) {
                item_detail_obat.kategori_item.forEach(item => {
                    if (item.detail_kategori.slug == 'obat-kronis') {
                        status_selected_obat_kronis = true;
                    }
                });
            }

            if (status_selected_obat_kronis) {
                let jumlah_obat = $('#jumlah-obat').val();
                jumlah_obat = parseInt(jumlah_obat);
                let kolom_7 = Math.round((jumlah_obat/30)*7);
                let kolom_23 = jumlah_obat - kolom_7;

                $('#hari-7').val(kolom_7);
                $('#hari-23').val(kolom_23);
            } else {
                let jumlah_obat = $('#jumlah-obat').val();
                $('#hari-7').val(jumlah_obat);
            }
        }

        //Racikan
        $('#obatGenerik').on('click', function() {
            $(this).parents('.block-content').find('#obatForGenerik').removeClass('d-none');
            $('#satuan-select2').parent().addClass('d-none');
            $(this).parents('.block-content').find('#obatForRacikan').addClass('d-none');
        });

        $('#racikan').on('click', function() {
            $(this).parents('.block-content').find('#obatForGenerik').addClass('d-none');
            $('#satuan-select2').parent().removeClass('d-none');
            $(this).parents('.block-content').find('#obatForRacikan').removeClass('d-none');
        });

        $('#resepForm').on('select2:select', function (e) {
            var data = e.params.data;
            ide = $(e.target).attr('id');
            ideas = ide.slice(-1);
            if(data.item_detail) 
            {
                if(ideas == 't'){
                    $("#obat-generik").text(data.item_detail.nama);
                    $("#harga-generik").val(data.item_detail.harga);
                }
                else{
                    $("#racikan-text-"+ideas).text(data.item_detail.nama);
                    $("#harga-racikan-"+ideas).val(data.item_detail.harga);
                }
            }
        });

        cik = 1;
        $('#btnAddRacikan').on('click', function() {
            cik++;
            var formRacikan = 
                `<div class="row racikan-obat-wrapper mt-3">
                    <h1 id="racikan-text-`+cik+`" hidden></h1>
                    <input type="hidden" class="form-control harga-racikan" id="harga-racikan-`+cik+`">
                    <div class="col-md-7">
                        <select class="js-select2 form-control barang-racikan" id="racikan-select2-`+cik+`" name="barang[]" style="width: 100%;" data-placeholder="Pilih Barang">
                            <option></option>
                        </select>
                        <p class="text-warning"></p>
                    </div>
                    <div class="col-md-3 px-1">
                        <input type="number" class="form-control jumlah-obat" id="jumlah" placeholder="Jumlah">
                        <p class="text-warning"></p>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="button-control btn btn-sm btn-danger btn-square btnRemoveRacikan">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>`
            $('#racikan-row').append(formRacikan);
            removeRacikan();
            $('#racikan-select2-'+cik).select2({
                ajax: {
                    url: API_URL+"/farmasi/{{session('farmasi')->slug}}/item/get",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) 
                    {
                        return {
                            keyword: params.term,
                            page: params.page
                        };
                    },
                    processResults: function (data, params) {
                        params.page = params.page || 1;
                        return {
                            results: data.data,
                        };
                    },
                    cache: true
                },
                escapeMarkup: function (markup) { return markup; },
                minimumInputLength: 3,
                placeholder: "Cari Barang",
                templateResult: formatBarang,
                templateSelection: formatBarangSelection
            });
        });

        function removeRacikan() {
            $('.btnRemoveRacikan').on('click', function() {
                var remove_racikan = $(this).parents('.racikan-obat-wrapper');
                remove_racikan.remove();
            })
        }

        $('#btn-add').on('click', function(){
            flag = 0;
            var jenisObat = $('input[name=jenisObat]:checked').val();
            var tipeObat = $('#satuan-select2').val();
            //console.log($('#jumlahObat').val());
            if($('#satuan-select2').val() == '') 
            {
                $('#satuan-select2').parent('div').find('.text-warning').html('Harap diisi !');
                flag++;
            }
            else $('#satuan-select2').parent('div').find('.text-warning').html('');

            if($('#jumlahObat').val() == '') 
            {
                $('#jumlahObat').parent('div').find('.text-warning').html('Harap diisi !');
                flag++;
            }
            else $('#jumlahObat').parent('div').find('.text-warning').html('');
            var namaObat;
            var namaObatVal;
            var input = {};
            if(harian)
            {
                nomorObat = $('#jumlah-obat').val();
                if($('#jumlah-obat').val() == '') {
                    $('#jumlah-obat').parent('div').find('.text-warning').html('Harap diisi !');
                    flag++;
                }
                else $('#jumlah-obat').parent('div').find('.text-warning').html('');
                hari7 = $('#hari-7').val();
                hari23 = $('#hari-23').val();
                dukRS = $('#dukungan-rs').val();
            }
            else var nomorObat = $('#jumlahObat').val();
            if(typeof keteranganObat != 'undefined')
            {
                var keteranganObat = $('#ketObat').val();
            
            }
            var aturanPenggunaan = $('#aturan-select2 option:selected').text();
            var aturanPenggunaanVal = $('#aturan-select2').val();

            if(aturanPenggunaan == '') 
            {
                $('#aturan-select2').parent('div').find('.text-warning').html('Harap diisi !');
                flag++;
            }
            else $('#aturan-select2').parent('div').find('.text-warning').html('');

            var satuan_penggunaan = $('#satuan-penggunaan-select2').val();

            // if(satuan_penggunaan == '')
            // {
            //     $('#satuan-penggunaan-select2').parent('div').find('.text-warning').html('Harap diisi !');
            //     flag++;
            // }
            // else $('#satuan-penggunaan-select2').parent('div').find('.text-warning').html('');

            var detailRacikan = [];

            var resepJadi = 
            `<div class="col-md-12 resep-jadi">
                <a class="block block-link-shadow" href="javascript:void(0)">
                    <div class="block-content block-content-full clearfix">
                        <div class="float-right">
                            <button type="button" class="btn-block-option btnRemoveResep">
                                <i class="fa fa-times"></i>
                            </button>
                        </div>
                        <div class="float-left mt-10">`

            if (jenisObat == 'generik') {
                namaObat = $('#obat-generik').text();
                hargaObat = $('#harga-generik').val();
                tipeObat = tipeObatDb;
                namaObatVal = $('#namaObat').find(":selected").val();

                if(namaObatVal == '') 
                {
                    $('#namaObat').parent('div').find('.text-warning').html('Harap diisi !');
                    flag++;
                }
                else $('#namaObat').parent('div').find('.text-warning').html('');

                if(flag) return 0;


                namaObat = namaObat.replace("'","")
                namaObat = namaObat.replace('"','')
                input.jenis = jenisObat;
                input.satuan = tipeObat;
                input.obat = namaObatVal;
                input.jumlah = nomorObat;
                if(typeof keteranganObat != 'undefined')
                {
                    input.keterangan = keteranganObat;
                }
                input.aturan = aturanPenggunaan;
                input.satuan_penggunaan = satuan_penggunaan;
                input.namaObat = namaObat;
                if(harian)
                {
                    input.hari7 = hari7;
                    input.hari23 = hari23;
                    input.dukRS = dukRS;
                }

                // cek kalau ada yang sama di resep list
                $('.resep-jadi').each(function() {
                    resep = JSON.parse($(this).find('.resep-input').val());
                    if (resep.jenis == 'generik' && resep.obat == namaObatVal && resep.aturan == aturanPenggunaan && resep.satuan_penggunaan == satuan_penggunaan) {
                        input.jumlah = parseInt(input.jumlah)+parseInt(resep.jumlah);
                        if(harian)
                        {
                            input.hari7 = parseInt(input.hari7)+parseInt(resep.hari7);
                            input.hari23 = parseInt(input.hari23)+parseInt(resep.hari23);
                            input.dukRS = parseInt(input.dukRS)+parseInt(resep.dukRS);
                        }
                        if(typeof keteranganObat == 'undefined' && typeof resep.keterangan != 'undefined')
                        {
                            input.keterangan = resep.keteranganObat;
                        }

                        // remove this from resep list
                        var remove_resep = $(this);
                        remove_resep.remove();
                        checkResep();

                        return false;
                    }
                });

                resepJadi += 
                    `<div class="font-w600 mb-5">Obat </div>
                    <div class="font-size-sm text-muted">`+ tipeObat +`</div>
                    <div class="font-size-sm text-muted">`+ namaObat +`</div>
                    <div class="font-size-sm text-muted">Jumlah : `+ input.jumlah; 
                if(harian) resepJadi += ` (7 Hari : `+input.hari7+`, 23 Hari : `+input.hari23+`, Duk RS : `+input.dukRS+`)`;
                resepJadi += ` - Aturan : `+ aturanPenggunaan + ` ` + satuan_penggunaan +`</div>`
                if(typeof keteranganObat != 'undefined')
                   resepJadi += `<div class="font-size-sm text-muted">Keterangan : `+ keteranganObat
                resepJadi += `<div class="font-w600 mt-5">Harga : `+ parseFloat(hargaObat*input.jumlah).toLocaleString('id-ID', {currency: 'IDR', style: 'currency'}) +`</div>`;
                    resepJadi += `<input type="hidden" name="input[]" class="resep-input" value='`+ JSON.stringify(input) +`'>`;
                    /*<input type="hidden" name="jenisObatVal" value="`+ jenisObat +`">
                    <input type="hidden" name="tipeObatVal" value="`+ tipeObat +`">
                    <input type="hidden" name="namaObatVal" value="`+ namaObatVal +`">
                    <input type="hidden" name="nomorObatVal" value="`+ nomorObat +`">
                    <input type="hidden" name="aturanPenggunaanVal" value="`+ aturanPenggunaan +`">`*/
            } else if (jenisObat == 'racikan') {
                var namaObatTxt = [];
                var jumlahObatTxt = [];
                var arrInputNamaObat = [];
                var arrInputHargaObat = [];
                var arrInputJumlah = [];
                var textRacikan = $('#textRacikan').val();
                console.log(textRacikan);

                if(textRacikan == '') 
                {
                    $('#textRacikan').parent('div').find('.text-warning').html('Harap diisi !');
                    flag++;
                }
                else $('#textRacikan').parent('div').find('.text-warning').html('');
                
                $(".barang-racikan").each(function () {
                    if($(this).val() == '')
                    {
                        $(this).parent('div').find('.text-warning').html('Harap diisi !');
                        flag++;
                    }
                    else $(this).parent('div').find('.text-warning').html('');
                    arrInputNamaObat.push($(this).val());
                    idol = $(this).attr('id').slice(-1);
                    namaObatTxt.push($("#racikan-text-"+idol).text());
                    arrInputHargaObat.push($("#harga-racikan-"+idol).val());
                });

                $(".jumlah-obat").each(function () {
                    if($(this).val() == '')
                    {
                        $(this).parent('div').find('.text-warning').html('Harap diisi !');
                        flag++;
                    }
                    else $(this).parent('div').find('.text-warning').html('');
                    arrInputJumlah.push($(this).val());
                    jumlahObatTxt.push($(this).val());
                });

                if(flag) return 0;

                resepJadi += 
                    `<div class="font-w600 mb-5">Racikan</div>
                    <div class="font-size-sm text-muted">`+ textRacikan +`</div>
                    <div class="font-size-sm text-muted">`+ tipeObat +`</div>`;

                hargaPerRacikan = 0;
                for (var i = 0; i < arrInputNamaObat.length; i++) {
                    resepJadi += 
                    `<div class="font-size-sm text-muted">
                    `+ namaObatTxt[i] +` - `+ jumlahObatTxt[i] +`
                    </div>`;
                    hargaPerRacikan += arrInputHargaObat[i]*jumlahObatTxt[i];
                    /*<input type="hidden" name="jenisObatVal" value="`+ arrInputNamaObat[i] +`">
                    <input type="hidden" name="jenisObatVal" value="`+ arrInputJumlah[i] +`">`;*/
                }

                input.jenis = jenisObat;
                input.satuan = tipeObat;
                input.racikan = textRacikan;
                input.obat = arrInputNamaObat;
                input.jumlah = nomorObat;
                input.jumlah_racikan = arrInputJumlah;
                if(typeof keteranganObat != 'undefined')
                {
                    input.keterangan = keteranganObat;    
                }
                input.aturan = aturanPenggunaan;
                input.satuan_penggunaan = satuan_penggunaan;
                input.namaObat = namaObatTxt;
                if(harian)
                {
                    input.hari7 = hari7;
                    input.hari23 = hari23;
                    input.dukRS = dukRS;
                }

                resepJadi +=
                     `<div class="font-size-sm text-muted">Jumlah : `+ nomorObat; 
                if(harian) resepJadi += ` (7 Hari : `+hari7+`, 23 Hari : `+hari23+`, Duk RS : `+dukRS+`)`;
                resepJadi += ` - Aturan : `+ aturanPenggunaan + ` ` + satuan_penggunaan +`</div>`
                if(typeof keteranganObat != 'undefined')
                    resepJadi += `<div class="font-size-sm text-muted">Keterangan : `+ keteranganObat
                resepJadi += `<div class="font-w600 mt-5">Harga : `+ parseFloat(hargaPerRacikan*nomorObat).toLocaleString('id-ID', {currency: 'IDR', style: 'currency'}) +`</div>`;
                    resepJadi += `<input type="hidden" name="input[]" class="resep-input" value='`+ JSON.stringify(input) +`'>`;
                     /*<input type="hidden" name="jenisObatVal" value="`+ jenisObat +`">
                     <input type="hidden" name="tipeObatVal" value="`+ tipeObat +`">
                     <input type="hidden" name="textRacikan" value="`+ textRacikan +`">
                     <input type="hidden" name="aturanPenggunaanVal" value="`+ aturanPenggunaan +`">`*/
            }

            resepJadi += 
                        `</div>
                    </div>
                </a>
            </div>`;

            $('#resep-wrapper').append(resepJadi);
            removeResepJadi();
            changeResepJadi();
            reseFields();
            checkResep();
        });

        function removeResepJadi() {
            $('.btnRemoveResep').on('click', function() {
                var remove_racikan = $(this).parents('.resep-jadi');
                remove_racikan.remove();
                checkResep();
            })
        }

        function reseFields() {
            $('#temporary-resep_detail_ori_id').val(null);
            $('#jumlahSisa').val(null).trigger('change');
            $('#detailAsal').val(null).trigger('change');
            $('#tipeObat').val(null).trigger('change');
            $('#namaObat').val(null).trigger('change');
            $('#jumlahObat').val(null).trigger('change');
            //$('#aturanPenggunaan').val(null).trigger('change');
            $('#racikan-select2-1').val(null).trigger('change');
            $('#textRacikan').val(null).trigger('change');
            $('#_racikan').val(null).trigger('change');
            $('#jumlah').val(null).trigger('change');
            $('#jumlah-obat').val(null).trigger('change');
            $('#hari-7').val(null).trigger('change');
            $('#hari-23').val(null).trigger('change');
            $('#dukungan-rs').val(null).trigger('change');
            $('#satuan-penggunaan-select2').val(null).trigger('change');
            $('#aturan-select2').val(null).trigger('change');

            $('.btnRemoveRacikan').each(function () {
                var remove_racikan = $(this).parents('.racikan-obat-wrapper');
                remove_racikan.remove();
            })
        }

        function checkResep() {
            var countResep = document.getElementsByClassName("resep-jadi");
            console.log(countResep.length);
            if (countResep.length > 0) {
                $('#btnSimpan').attr('disabled', false);
                $('#checkResep').addClass('d-none');
            } else {
                $('#btnSimpan').attr('disabled', true);
                $('#checkResep').removeClass('d-none');
            }
        }

        function changeResepJadi() {
            $('.resep-jadi').on('click', function(){
                reseFields();
                resepTemp = $(this);
                input = JSON.parse($(this).find('.resep-input').val());
                $('#temporary-resep_detail_ori_id').val(input.resep_detail_ori_id);
                if (input.jenis == 'generik') {
                    $("#obatGenerik").prop("checked", true).click();
                    $("#namaObat").append('<option value="'+input.obat+'" selected>'+input.namaObat+'</option>');
                    $('#namaObat').trigger('change');
                    $("#obat-generik").text(input.namaObat);
                    tipeObatDb = input.satuan;
                    status_selected_obat_kronis = input.is_kronis ? true : false;
                }
                else {
                    $("#racikan").prop("checked", true).click();
                    $('#textRacikan').val(input.racikan);
                    if(input.obat.length <= 0)
                    {
                        var formRacikan = 
                            `<div class="row racikan-obat-wrapper mt-3">
                                <h1 id="racikan-text-1" hidden>`+nama+`</h1>
                                <div class="col-md-7">
                                    <select class="js-select2 form-control barang-racikan" id="racikan-select2-1" name="barang[]" style="width: 100%;" data-placeholder="Pilih Barang">
                                    </select>
                                </div>
                                <div class="col-md-3 px-1">
                                    <input type="number" class="form-control jumlah-obat" id="jumlah" placeholder="Jumlah">
                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="button-control btn btn-sm btn-danger btn-square btnRemoveRacikan">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </div>`
                        $('#racikan-row').append(formRacikan);
                        removeRacikan();
                        $('#racikan-select2-'+cik).select2({
                            ajax: {
                                url: API_URL+"/farmasi/{{session('farmasi')->slug}}/item/get",
                                dataType: 'json',
                                delay: 250,
                                data: function (params) 
                                {
                                    return {
                                        keyword: params.term,
                                        page: params.page
                                    };
                                },
                                processResults: function (data, params) {
                                    params.page = params.page || 1;
                                    return {
                                        results: data.data,
                                    };
                                },
                                cache: true
                            },
                            escapeMarkup: function (markup) { return markup; },
                            minimumInputLength: 3,
                            placeholder: "Cari Barang",
                            templateResult: formatBarang,
                            templateSelection: formatBarangSelection
                        });
                    }
                    else
                    {
                        $("#racikan-select2-1").append('<option value="'+input.obat[0]+'" selected>'+input.namaObat[0]+'</option>');
                        $('#racikan-select2-1').trigger('change');
                        $("#racikan-text-1").text(input.namaObat[0]);
                        $("#jumlah").val(input.jumlah_racikan[0]);

                        cik = 0;
                        input.namaObat.forEach(function(nama) {
                            cik++;
                            var formRacikan = 
                                `<div class="row racikan-obat-wrapper mt-3">
                                    <h1 id="racikan-text-`+cik+`" hidden>`+nama+`</h1>
                                    <div class="col-md-7">
                                        <select class="js-select2 form-control barang-racikan" id="racikan-select2-`+cik+`" name="barang[]" style="width: 100%;" data-placeholder="Pilih Barang">
                                            <option value="`+input.obat[cik-1]+`" selected>`+nama+`</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 px-1">
                                        <input type="number" class="form-control jumlah-obat" id="jumlah" value="`+input.jumlah_racikan[cik-1]+`" placeholder="Jumlah">
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="button-control btn btn-sm btn-danger btn-square btnRemoveRacikan">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </div>`
                            $('#racikan-row').append(formRacikan);
                            removeRacikan();
                            $('#racikan-select2-'+cik).select2({
                                ajax: {
                                    url: API_URL+"/farmasi/{{session('farmasi')->slug}}/item/get",
                                    dataType: 'json',
                                    delay: 250,
                                    data: function (params) 
                                    {
                                        return {
                                            keyword: params.term,
                                            page: params.page
                                        };
                                    },
                                    processResults: function (data, params) {
                                        params.page = params.page || 1;
                                        return {
                                            results: data.data,
                                        };
                                    },
                                    cache: true
                                },
                                escapeMarkup: function (markup) { return markup; },
                                minimumInputLength: 3,
                                placeholder: "Cari Barang",
                                templateResult: formatBarang,
                                templateSelection: formatBarangSelection
                            });
                        });
                    }
                } 
                $('#satuan-select2').append('<option value="'+input.satuan+'" selected>'+input.satuan+'</option>').trigger('change');
                $('#aturan-select2').append('<option value="'+input.aturan+'" selected>'+input.aturan+'</option>').trigger('change');
                $('#satuan-penggunaan-select2').append('<option value="'+input.satuan+'" selected>'+input.satuan+'</option>').trigger('change');
                if(harian)
                {
                    nomorObat = $('#jumlah-obat').val(input.jumlah);
                    hari7 = $('#hari-7').val(input.hari7);
                    hari23 = $('#hari-23').val(input.hari23);
                    dukRS = $('#dukungan-rs').val(input.dukRS);
                }
                else $('#jumlahObat').val(input.jumlah);
                $('#jumlahSisa').val(input.jumlah_sisa);
                $('#detailAsal').val(input.detail_asal_id);

                $('#tambahResepBtn').addClass('d-none');
                //$('#tambahResepBtn').attr('hidden', true);
                $('#editResepBtn').removeClass('d-none');
            })
        }

        $('#btn-save').on('click', function(){
            resepTemp.find('.block').remove();
            var jenisObat = $('input[name=jenisObat]:checked').val();
            var tipeObat = $('#satuan-select2').val();
            var namaObat;
            var namaObatVal;
            var satuan_penggunaan = $('#satuan-penggunaan-select2').val();
            var input = {};
            input.resep_detail_ori_id = $('#temporary-resep_detail_ori_id').val() || null;
            if(harian)
            {
                nomorObat = $('#jumlah-obat').val();
                hari7 = $('#hari-7').val();
                hari23 = $('#hari-23').val();
                dukRS = $('#dukungan-rs').val();
            }
            else var nomorObat = $('#jumlahObat').val();
            if(typeof keteranganObat != 'undefined')
            {
                var keteranganObat = $('#ketObat').val();
            
            }
            var aturanPenggunaan = $('#aturan-select2 option:selected').text();
            var aturanPenggunaanVal = $('#aturan-select2').val();

            var detailRacikan = [];

            var resepJadi = 
            `<a class="block block-link-shadow" href="javascript:void(0)">
                <div class="block-content block-content-full clearfix">
                    <div class="float-right">
                        <button type="button" class="btn-block-option btnRemoveResep">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                    <div class="float-left mt-10">`

            if (jenisObat == 'generik') {
                namaObat = $('#obat-generik').text();
                namaObatVal = $('#namaObat').find(":selected").val();
                tipeObat = tipeObatDb;
                input.jenis = jenisObat;
                input.satuan = tipeObat;
                input.obat = namaObatVal;
                input.jumlah = nomorObat;
                input.jumlah_sisa = $('#jumlahSisa').val();
                input.detail_asal_id = $('#detailAsal').val();
                input.satuan_penggunaan = satuan_penggunaan;
                if(typeof keteranganObat != 'undefined')
                {
                    input.keterangan = keteranganObat;
                
                }
                input.aturan = aturanPenggunaan;
                input.namaObat = namaObat;
                if(harian)
                {
                    input.hari7 = hari7;
                    input.hari23 = hari23;
                    input.dukRS = dukRS;
                }

                resepJadi += 
                    `<div class="font-w600 mb-5">Obat </div>
                    <div class="font-size-sm text-muted">`+ tipeObat +`</div>
                    <div class="font-size-sm text-muted">`+ namaObat +`</div>
                    <div class="font-size-sm text-muted">Jumlah : `+ nomorObat; 
                if(harian) resepJadi += ` (7 Hari : `+hari7+`, 23 Hari : `+hari23+`, Duk RS : `+dukRS+`)`;
                resepJadi += ` - Aturan : `+ aturanPenggunaan + ` ` + satuan_penggunaan +`</div>`
                if(typeof keteranganObat != 'undefined')
                    resepJadi += `<div class="font-size-sm text-muted">Keterangan : `+ keteranganObat
                    resepJadi += `<input type="hidden" name="input[]" class="resep-input" value='`+ JSON.stringify(input) +`'>`;
                    /*<input type="hidden" name="jenisObatVal" value="`+ jenisObat +`">
                    <input type="hidden" name="tipeObatVal" value="`+ tipeObat +`">
                    <input type="hidden" name="namaObatVal" value="`+ namaObatVal +`">
                    <input type="hidden" name="nomorObatVal" value="`+ nomorObat +`">
                    <input type="hidden" name="aturanPenggunaanVal" value="`+ aturanPenggunaan +`">`*/
            } else if (jenisObat == 'racikan') {
                var namaObatTxt = [];
                var jumlahObatTxt = [];
                var arrInputNamaObat = [];
                var arrInputJumlah = [];
                var textRacikan = $('#textRacikan').val();
                
                $(".barang-racikan").each(function () {
                    arrInputNamaObat.push($(this).val());
                    idol = $(this).attr('id').slice(-1);
                    namaObatTxt.push($("#racikan-text-"+idol).text());
                });

                $(".jumlah-obat").each(function () {
                    arrInputJumlah.push($(this).val());
                    jumlahObatTxt.push($(this).val());
                })

                resepJadi += 
                    `<div class="font-w600 mb-5">Racikan</div>
                    <div class="font-size-sm text-muted">`+ textRacikan +`</div>
                    <div class="font-size-sm text-muted">`+ tipeObat +`</div>`;

                for (var i = 0; i < arrInputNamaObat.length; i++) {
                    resepJadi += 
                    `<div class="font-size-sm text-muted">
                        `+ namaObatTxt[i] +` - `+ jumlahObatTxt[i] +`
                    </div>`;
                    /*<input type="hidden" name="jenisObatVal" value="`+ arrInputNamaObat[i] +`">
                    <input type="hidden" name="jenisObatVal" value="`+ arrInputJumlah[i] +`">`;*/
                }

                input.jenis = jenisObat;
                input.satuan = tipeObat;
                input.racikan = textRacikan;
                input.obat = arrInputNamaObat;
                input.jumlah = nomorObat;
                input.jumlah_sisa = $('#jumlahSisa').val();
                input.jumlah_racikan = arrInputJumlah;
                input.aturan = aturanPenggunaan;
                input.satuan_penggunaan = satuan_penggunaan
                input.namaObat = namaObatTxt;
                if(typeof keteranganObat != 'undefined')
                {
                    input.keterangan = keteranganObat;    
                }
                if(harian)
                {
                    input.hari7 = hari7;
                    input.hari23 = hari23;
                    input.dukRS = dukRS;
                }

                resepJadi +=
                     `<div class="font-size-sm text-muted">Jumlah : `+ nomorObat; 
                if(harian) resepJadi += ` (7 Hari : `+hari7+`, 23 Hari : `+hari23+`, Duk RS : `+dukRS+`)`;
                resepJadi += ` - Aturan : `+ aturanPenggunaan + ` ` + satuan_penggunaan +`</div>`
                if(typeof keteranganObat != 'undefined')
                    resepJadi += `<div class="font-size-sm text-muted">Keterangan : `+ keteranganObat
                    resepJadi += `<input type="hidden" name="input[]" class="resep-input" value='`+ JSON.stringify(input) +`'>`;
                     /*<input type="hidden" name="jenisObatVal" value="`+ jenisObat +`">
                     <input type="hidden" name="tipeObatVal" value="`+ tipeObat +`">
                     <input type="hidden" name="textRacikan" value="`+ textRacikan +`">
                     <input type="hidden" name="aturanPenggunaanVal" value="`+ aturanPenggunaan +`">`*/
            }

            resepJadi += 
                        `</div>
                    </div>
                </a>`;

            resepTemp.append(resepJadi);
            reseFields();
            changeResepJadi();
            removeResepJadi();
            $('#tambahResepBtn').removeClass('d-none');
            $('#editResepBtn').addClass('d-none');
        });

        $('#btn-cancel').on('click', function(){
            reseFields();

            $('#tambahResepBtn').removeClass('d-none');
            $('#editResepBtn').addClass('d-none');
        });

      


        function removeItem() {
            $('.btnRemove').on('click', function(){
                var wrapper = $(this).parents('.item-wrapper');
                wrapper.remove();
            });
        }

        pasien_id = '{{$transaksi->pasien_detail->id ?? 0}}';
        initHistoriResep('.histori-resep-container',pasien_id);

    </script>