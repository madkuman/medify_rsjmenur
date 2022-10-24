@extends('igd.layouts.main')

@section('title')
Pendaftaran - IGD - Medify
@endsection

@section('subtitle')
Pendaftaran Pasien Baru ke IGD
@endsection

@section('content')
<main id="main-container">
    @include('igd.layouts.navbar')
    <div class="container">
        <div class="">
            <div class="block-content">
                <form id="pasienIGDSubmit">
                    <div class="block" id="dataDasar">
                        <div class="block-content">
                            @include('igd.triage.form.data-dasar')
                        </div>
                    </div>
                    <div class="block" id="dataDatang">
                        <div class="block-content">
                            @include('igd.triage.form.data-datang')
                        </div>
                    </div>
                    <div class="block" id="dataTriage">
                        <div class="block-content">
                            @include('igd.triage.form.data-triage')
                        </div>
                    </div>
                    <div class="block" id="dataVital">
                        <div class="block-content">
                            @include('igd.triage.form.data-vital')
                        </div>
                    </div>
                    <div class="block" id="dataPsikologi">
                        <div class="block-content">
                            @include('igd.triage.form.data-psikologi')
                        </div>
                    </div>

                    <div class="col-12" style="height: 75px">
                        <button class="btn btn-primary btn-hero pull-right" type="button" id="buttonSubmit"><i class="fa fa-check"></i> Simpan</button>
                        <button class="btn btn-alt-primary btn-hero pull-right" style="display: none" type="button"  id="buttonLoading">
                            <i class="fa fa-asterisk fa-spin"></i> Loading
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection

@section('angular')
<script type="text/javascript">
    $("#penyebabTrauma").hide();
    $("#traumaLain").hide();

    $('input:radio[name=trauma-radios]').change(function () {
        if ($("input[name='trauma-radios']:checked").val() == 3) {
            $("#penyebabTrauma").show();
        }
        else {
            $("#penyebabTrauma").hide();
        }
    });
    $('input:radio[name=penyebab-radios]').change(function () {
        if ($("input[name='penyebab-radios']:checked").val() == 5) {
            $("#traumaLain").show();
        }
        else {
            $("#traumaLain").hide();
        }
    });

    function addForm(){
        var totalLayanan = $(".cideraForm").length;
        var codeToAdd = `<div class="col-12" id="cidera-form-`+totalLayanan+`">
                <div class="row">
                    <div class="col-5 mb-5">
                        <select class="form-control cideraForm" id="kelompok-select-`+totalLayanan+`" name="kelompok[]">
                            <option value="1">Kepala</option>
                            <option value="2">Badan</option>
                            <option value="3">Kaki</option>
                        </select>
                    </div>
                    <div class="col-6">
                        <input type="text" class="form-control form-control-lg" id="keterangan-`+totalLayanan+`" name="keterangan[]" placeholder="Keterangan" >
                    </div>
                    <div class="col-1">
                        <a href="javascript:removeForm(`+totalLayanan+`);" id="remove-`+totalLayanan+`"><i class="fa fa-trash-o fa-2x text-danger mt-2"></i></a>
                    </div>  
                </div>
            </div>`;
        $("#lokasi_cidera").append(codeToAdd);
    }
    function removeForm(id) {
        $("#cidera-form-"+id).remove();
    }

    function inputValidation(){
        var errCounter=0;
        $('#dataDasar input').each(function(n,element){
            if ($(element).val()=='' || $(element).val()==null || $(element).val()=='null') {
                errCounter++;
            }
        });
        console.log(errCounter);
        if (errCounter==0) {
            return 1;
        } 
        else {
            return 0;
        }
    }

    $('#buttonSubmit').click(function() {

        var validate = inputValidation();
        if (validate) {
            $('#buttonSubmit').hide();
            $('#buttonLoading').show();
        
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            //data dasar
            namaPasien = $("input[name='namaPasien']").val();
            usiaPasien = $("input[name='usiaPasien']").val();
            namaPengantar = $("input[name='namaPengantar']").val();
            alamatPengantar = $("input[name='alamatPengantar']").val();
            jenisKelamin = $("input[name='jk-radios']:checked").val();
            //data datang
            datang = $("input[name='datang-radios']:checked").val();
            transportasi = $("input[name='transportasi-radios']:checked").val();
            trauma = $("input[name='trauma-radios']:checked").val();
            penyebab = $("input[name='penyebab-radios']:checked").val();
            alasan = $("input[name='penyebab_trauma']").val();
            //data psikologi
            psikologi = $("input[name='psikologi-radios']:checked").val();
            alergi = $("input[name='alergi']").val();
            risiko = $("input[name='risiko-radios']:checked").val();
            //data triage 
            jalan = $("input[name='jalan-radios']:checked").val();
            nafas = $("input[name='nafas-radios']:checked").val();
            sirkulasi = $("input[name='sirkulasi-radios']:checked").val();
            sadar = $("input[name='sadar-radios']:checked").val();
            kategori = $("input[name='kategori-radios']:checked").val();
            //data vital
            anamnesis = $("input[name='anamnesis']").val();
            sistol = $("input[name='sistol']").val();
            diastol = $("input[name='diastol']").val();
            nadi = $("input[name='nadi']").val();
            pernapasan = $("input[name='pernapasan']").val();
            temperatur = $("input[name='temperatur']").val();
            skala_nyeri = $("input[name='skala_nyeri']").val();
            spo = $("input[name='spo']").val();
            var keterangan = $('input[name="keterangan[]"]').map(function () {
                return $(this).val() // $(this).val()
            }).get();
            var kelompok = [];
            for (var i = 0; i < keterangan.length; i++) {
                var val = $("#kelompok-select-"+i).val();
                kelompok.push(val);
            }
            
            var formData = new FormData();
            formData.append('nama_pasien', namaPasien);
            formData.append('usia_pasien', usiaPasien);
            formData.append('nama_pengantar', namaPengantar);
            formData.append('alamat_pengantar', alamatPengantar);
            formData.append('jenis_kelamin', jenisKelamin);

            formData.append('datang', datang);
            formData.append('transportasi', transportasi);
            formData.append('trauma', trauma);
            formData.append('penyebab', penyebab);
            formData.append('alasan', alasan);

            formData.append('psikologi', psikologi);
            formData.append('alergi', alergi);
            formData.append('risiko', risiko);

            formData.append('jalan', jalan);
            formData.append('nafas', nafas);
            formData.append('sirkulasi', sirkulasi);
            formData.append('sadar', sadar);
            formData.append('kategori', kategori);

            formData.append('anamnesis', anamnesis);
            formData.append('sistol', sistol);
            formData.append('diastol', diastol);
            formData.append('nadi', nadi);
            formData.append('pernapasan', pernapasan);
            formData.append('temperatur', temperatur);
            formData.append('skala_nyeri', skala_nyeri);
            formData.append('spo', spo);    
            formData.append('keterangan', keterangan);
            formData.append('kelompok', kelompok);
            for (var i = 0; i < kelompok.length; i++) {
                formData.append('kelompok[]', kelompok[i]);
            }
            for (var i = 0; i < keterangan.length; i++) {
                formData.append('keterangan[]', keterangan[i]);
            }

            /*
            for (var pair of formData.entries()) {
                console.log(pair[0]+ ', ' + pair[1]); 
            }
            */
            
            $.ajax({
                type: "POST",
                url: API_URL + "/igd/triage/baru",
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
                success: function (response) {
                    callSwalString(response);
                },
                error: function () {
                    callSwal('error','Transaksi Gagal','Silahkan Coba Lagi',0);
                    $('#buttonSubmit').show();
                    $('#buttonLoading').hide();
                }
            });

            function callSwalString(string)
            {
                var response = jQuery.parseJSON(string);
                callSwal(response.type,response.title,response.text,response.url);
            }
        }
        else {
            document.documentElement.scrollTop = 0;
            callSwal('error','Transaksi Gagal','Terdapat Masukan yang Kosong',0);
            $('#buttonSubmit').show();
            $('#buttonLoading').hide();
        }
    });

    
</script>
@endsection
