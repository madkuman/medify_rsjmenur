<script type="text/javascript">
    // $('.tes').slimScroll({
    //     height: '1030px', 
    // });

    var hargaPerRacikan;

    $('.barang-kemo-racik').on('select2:select', function (e) {
        ideas = $(this).attr('id').split('-')[2];
        var data = e.params.data;
        console.log('ini data', data)
        if(data.item_detail) 
        {
            $("#kemo-text-"+ideas).text(JSON.stringify(data.item_detail));
        }
    });

    var form_counter = 1;

	// TAMBAH RESEP OBAT
	$('#btn-add-kanker').on('click', function(){
        var flag = 0;
        var isEdit = $('#is_edit_kemo').val();
        var namaObatTxt = [];
        var jumlahObatTxt = [];
        var volumeObatTxt = [];
        var arrInputNamaObat = [];
        var arrInputHargaObat = [];
        var arrInputJumlah = [];
        var arrInputVolume = [];
        var obat_obj = [];
        var textRacikan = $('#textKemo').val();
        
        $(".barang-kemo-racik").each(function () {
            if($(this).val() == '')
            {
                $(this).parent('div').find('.text-warning').html('Harap diisi !');
                flag++;
            }
            else $(this).parent('div').find('.text-warning').html('');
            arrInputNamaObat.push($(this).val());
            idol = $(this).attr('id').split('-')[2];
            var obatTemp = JSON.parse($("#kemo-text-"+idol).text());
            console.log(obatTemp, 'adaewdawed');
            var namaObatTemp = obatTemp.nama;

            namaObatTemp = namaObatTemp.replace("'","")
            namaObatTemp = namaObatTemp.replace('"','')

            obat_obj.push(obatTemp);
            namaObatTxt.push(namaObatTemp);
            arrInputHargaObat.push(obatTemp.harga);
        });

        $(".jumlah-obat-kemo").each(function () {
            if($(this).val() == '')
            {
                $(this).parent('div').find('.text-warning').html('Harap diisi !');
                flag++;
            }
            else $(this).parent('div').find('.text-warning').html('');
            arrInputJumlah.push($(this).val());
            jumlahObatTxt.push($(this).val());
        });
        $(".volume-obat-kemo").each(function () {
            if($(this).val() == '')
            {
                $(this).parent('div').find('.text-warning').html('Harap diisi !');
                flag++;
            }
            else $(this).parent('div').find('.text-warning').html('');
            arrInputVolume.push($(this).val());
            volumeObatTxt.push($(this).val());
        });
		var tipe = $('#tipe_kemo :selected').text();
		var dosis = $('#dosis_kemo').val();
		var cara_pemberian = $('#cara_pemberian :selected').text();
		var lama_pemberian = $('#lama_pemberian :selected').text();
		var volume_pelarut = $('#volume_pelarut').val();
        var nama_infus = $('#nama-infus').select2('data')[0].text;
        var id_infus = $('#nama-infus').val();
        var volume_infus = $('#volume_infus').val();
        var jumlah_infus = $('#jumlah_infus').val();
		var dagang = $('#dagang').val();
		var pabrik = $('#pabrik').val();
		var batch = $('#batch').val();
		var exp_date = $('#exp_date_kemo').val();
		var kondisi = $('#kondisi :selected').text();
		var penyimpanan = $('#penyimpanan :selected').text();
		var stabilitas_time = $('#stabilitas_time :selected').text();
		var stabilitas_date = $('#stabilitas_date').val();
        var counter = parseInt($('#counter_kemo').val()) + 1;
        var checkResep = $('#check_resep_id_kemo').val();

        var object = {};
        var obat_name = "";
        for (var i = 0; i < arrInputNamaObat.length; i++) {
            obat_name += 
            `<div class="font-size-sm text-muted">
            `+ namaObatTxt[i] +` (`+volumeObatTxt[i]+`) - `+ jumlahObatTxt[i] +`
            </div>`;
            hargaPerRacikan += arrInputHargaObat[i]*jumlahObatTxt[i];
        }
        object.tipe = tipe;
        object.satuan_penggunaan = tipe;
        object.obat = arrInputNamaObat;
        object.jumlah_racikan   = arrInputJumlah;
        object.volume_racikan   = arrInputVolume;
        object.obat_obj = obat_obj;
        object.hargaObat = arrInputHargaObat;
        object.dosis = dosis;
        object.cara_pemberian = cara_pemberian;
        object.lama_pemberian = lama_pemberian;
        object.volume_pelarut = volume_pelarut;
        object.nama_infus = nama_infus;
        object.id_infus = id_infus;
        object.volume_infus = volume_infus;
        object.jumlah_infus = jumlah_infus;
        object.dagang = dagang;
        object.pabrik = pabrik;
        object.batch = batch;
        object.exp_date = exp_date;
        object.kondisi = kondisi;
        object.penyimpanan = penyimpanan;
        object.stabilitas_time = stabilitas_time;
        object.stabilitas_date = stabilitas_date;
        console.log(object);
		var string = 
		`<a class="block block-link-shadow" href="javascript:void(0)">
            <div class="block-header block-header-default">
                <h3 class="block-title"></h3>
                <div class="block-options">
                    <button type="button" class="btn btn-sm btn-secondary btn-ubah" data-id="`+ counter +`">Ubah</button>
                    <button type="button" class="btn btn-sm btn-secondary btn-hapus">Hapus</button>
                </div>
            </div>
            <div class="block-content block-content-full clearfix">
                <input type="hidden" class="input" name="input[]" value='`+ JSON.stringify(object,getCircularReplacer()) +`'>
                <div class="row">
                    <div class="col-6">
                        <table class="table table-borderless table-vcenter kemo">
                            <tbody>
                                <tr>
                                    <td>Tipe Obat</td>
                                    <td>:</td>
                                    <td>`+ tipe +`</td>
                                </tr>
                                <tr>
                                    <td>Nama dan Vol Infus</td>
                                    <td>:</td>
                                    <td>`+ nama_infus + '(' + volume_infus +`) `+jumlah_infus+`</td>
                                </tr>
                                <tr>
                                    <td>Volume Pelarut</td>
                                    <td>:</td>
                                    <td>`+ volume_pelarut +`</td>
                                </tr>
                                <tr>
                                    <td>Nama Dagang</td>
                                    <td>:</td>
                                    <td>`+ dagang +`</td>
                                </tr>
                                <tr>
                                    <td>Pabrik</td>
                                    <td>:</td>
                                    <td>`+ pabrik +`</td>
                                </tr>
                                <tr>
                                    <td>Obat</td>
                                    <td>:</td>
                                    <td>`+ obat_name+`</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-6">
                        <table class="table table-borderless table-vcenter kemo">
                            <tbody>
                                <tr>
                                    <td>Dosis yg dibutuhkan</td>
                                    <td>:</td>
                                    <td>`+ dosis +`</td>
                                </tr>
                                <tr>
                                    <td>Cara Pemberian</td>
                                    <td>:</td>
                                    <td>`+ cara_pemberian +`</td>
                                </tr>
                                <tr>
                                    <td>Lama Pemberian</td>
                                    <td>:</td>
                                    <td>`+ lama_pemberian +`</td>
                                </tr>
                                <tr>
                                    <td>Kondisi Penyimpanan</td>
                                    <td>:</td>
                                    <td>`+ kondisi +` <br> `+ penyimpanan +`</td>
                                </tr>
                                <tr>
                                    <td>Stabilitas</td>
                                    <td>:</td>
                                    <td>`+ stabilitas_time +` <br> `+ stabilitas_date +`</td>
                                </tr>
                                <tr>
                                    <td>No. Batch</td>
                                    <td>:</td>
                                    <td>`+ batch +`</td>
                                </tr>
                                <tr>
                                    <td>Exp Date</td>
                                    <td>:</td>
                                    <td>`+ exp_date +`</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </a>`;

        $('#counter_kemo').val(counter);
        $('#resep-jadi').append(string);

        if (isEdit == 'true') {
            console.log('wtg', checkResep);
            var removeWrapper = $('.btn-ubah*[data-id="'+ checkResep +'"]');
            removeWrapper.closest('a').remove();

            $(this).html('<i class="fa fa-plus mr-2" aria-hidden="true"></i> Tambahkan Obat');
            $('#is_edit_kemo').val(false);
        }

        reset();
	});

    // EDIT RESEP OBAT
    $('#resep-jadi').on('click', '.btn-ubah', function(){
        reset();
        var $this = $(this).closest('a');
        var value = $this.find('.input').val();
        value = JSON.parse(value);
        console.log(value);
        var dataId = $(this).data('id');
        var checkResep = $('#check_resep_id_kemo').val(dataId);
        var item =value.obat_obj;
        
        cik = 0;
        value.obat_obj.forEach(function(obat_obj) {
            cik++;
            if(cik==1){
                $("#kemo-select2-1").append('<option value="'+value.obat[0]+'" selected>'+obat_obj.nama+'</option>');
                $('#kemo-select2-1').trigger('change');
                $("#kemo-text-1").text(JSON.stringify(obat_obj));
                $("#harga-kemo-1").text(value.hargaObat[0]);
                $("#jumlah-kemo").val(value.jumlah_racikan[0]);
                $("#volume-kemo").val(value.jumlah_racikan[0]);
            }
            else
            {
                var formKemo = 
                `<div class="row kemo-obat-wrapper mt-1">
                <h1 id="kemo-text-`+cik+`" hidden>`+JSON.stringify(obat_obj)+`</h1>
                <input type="hidden" class="form-control harga-kemo" id="harga-kemo-`+cik+`" value="`+value.hargaObat[cik-1]+`">
                <div class="col-7">
                <select class="js-select2 form-control barang-kemo barang-kemo-racik" id="kemo-select2-`+cik+`" name="barang[]" style="width: 100%;" data-placeholder="Pilih Barang">
                <option value="`+value.obat[cik-1]+`" selected>`+obat_obj.nama+`</option>
                </select>
                </div>
                <div class="col-2 pr-0">
                <input type="number" class="form-control jumlah-obat-kemo" id="jumlah" value="`+value.jumlah_racikan[cik-1]+`" placeholder="Jumlah">
                </div>
                <div class="col-2 pr-0">
                <input type="number" class="form-control volume-obat-kemo" id="jumlah" value="`+value.volume_racikan[cik-1]+`" placeholder="Volume (mg)">
                </div>
                <div class="col-1 pr-0">
                <button type="button" class="button-control btn btn-sm btn-danger btn-square btnRemoveKemo">
                <i class="fa fa-trash" aria-hidden="true"></i>
                </button>
                </div>
                </div>`
                $('#kemo-row').append(formKemo);
                removeKemo();
                $('#kemo-select2-'+cik).select2({
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
                    templateSelection: formatBarangSelectionKemo
                });
            }
        });
        $('#is_edit_kemo').val(true);
        $('#tipe_kemo').val(value.tipe).trigger('change');

        $('#dosis_kemo').val(value.dosis);
        $('#cara_pemberian').val(value.cara_pemberian).trigger('change');
        $('#lama_pemberian').val(value.lama_pemberian).trigger('change');
        $('#volume_pelarut').val(value.volume_pelarut);
        $('#nama-infus').append('<option value="'+value.id_infus+'" selected>'+value.nama_infus+'</option>').trigger('change');
        $('#volume_infus').val(value.volume_infus);
        $('#jumlah_infus').val(value.jumlah_infus);
        $('#dagang').val(value.dagang);
        $('#pabrik').val(value.pabrik);
        $('#batch').val(value.batch);
        $('#exp_date_kemo').val(value.exp_date);        
        $('#kondisi').val(value.kondisi).trigger('change');
        $('#penyimpanan').val(value.penyimpanan).trigger('change');
        $('#stabilitas_time').val(value.stabilitas_time).trigger('change');
        $('#stabilitas_date').val(value.stabilitas_date);

        $('#btn-add-kanker').html('<i class="fa fa-pencil mr-2" aria-hidden="true"></i> Simpan Perubahan');
    });

	// HAPUS RESEP
	$('#resep-jadi').on('click', '.btn-hapus', function(){
		var counter = parseInt($('#counter_kemo').val()) - 1;
        var wrapper = $(this).closest('a');

        $('#counter_kemo').val(counter);
        wrapper.remove();
    });

    $('#kemoterapi').on('change', function() {
        $('#btn-modal-kemoterapi').removeClass('d-none');
    })

	// RESET FORM FIELD
	function reset() {
		$('#tipe_kemo').prop('selectedIndex', 0).change();
        $('#kemo-select2-1').val(null).trigger('change');
        $('#nama-infus').val(null).trigger('change');
        $('#jumlah-kemo').val('');
        $('#volume-kemo').val('');
        $('.btnRemoveKemo').each(function () {
            var remove_kemo = $(this).parents('.kemo-obat-wrapper');
            remove_kemo.remove();
        });
		$('#dosis_kemo').val('');
		$('#cara_pemberian').prop('selectedIndex', 0).change();
		$('#lama_pemberian').prop('selectedIndex', 0).change();
		$('#volume_pelarut').val('');

        $('#nama-infus').val('');
        $('#jumlah_infus').val('');
		$('#volume_infus').val('');
		$('#dagang').val('');
		$('#pabrik').val('');
		$('#batch').val('');
		$('#exp_date_kemo').val('');
		$('#kondisi').prop('selectedIndex', 0).change();
		$('#penyimpanan').prop('selectedIndex',0).change();
		$('#stabilitas_time').prop('selectedIndex', 0).change();
		$('#stabilitas_date').val('');
	}


    $('#btnAddKemo').on('click', function() {
        form_counter++;
        var formKemo = 
        `<div class="row kemo-obat-wrapper mt-1">
        <h1 class="text-kemo" id="kemo-text-`+form_counter+`" hidden></h1>
        <input type="hidden" class="form-control harga-kemo" id="harga-kemo-`+form_counter+`">
        <div class="col-7">
        <select class="js-select2 form-control barang-kemo barang-kemo-racik" id="kemo-select2-`+form_counter+`" name="barang[]" style="width: 100%;" data-placeholder="Pilih Barang">
        <option></option>
        </select>
        <p class="text-warning"></p>
        </div>
        <div class="col-2 pr-0">
            <input type="number" class="form-control jumlah-obat-kemo" placeholder="Jumlah Amp/Vial">
            <p class="text-warning"></p>
        </div>
        <div class="col-2 pr-0">
            <input type="number" class="form-control volume-obat-kemo" placeholder="Volume Amp/Vial (mg)">
            <p class="text-warning"></p>
        </div>
        <div class="col-1 pr-0">
        <button type="button" class="button-control btn btn-sm btn-danger btn-square btnRemoveKemo">
        <i class="fa fa-trash" aria-hidden="true"></i>
        </button>
        </div>
        </div>`
        $('#kemo-row').append(formKemo);
        removeKemo();
        $('#kemo-select2-'+form_counter).select2({
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
            templateSelection: formatBarangSelectionKemo
        });


        $('.barang-kemo-racik').on('select2:select', function (e) {
            ideas = $(this).attr('id').split('-')[2];
            var data = e.params.data;
            console.log('ini data', data)
            if(data.item_detail) 
            {
                $("#kemo-text-"+ideas).text(JSON.stringify(data.item_detail));
            }
        });

    });

    function removeKemo() {
        $('.btnRemoveKemo').on('click', function() {
            var remove_kemo = $(this).parents('.kemo-obat-wrapper');
            remove_kemo.remove();
        })
    }
</script>