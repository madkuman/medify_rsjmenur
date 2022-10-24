@extends('pasien.layouts.main')

@section('title')
Pasien - Medify
@endsection

@section('subtitle')
Daftar Pasien
@endsection

@section('content')
<main id="main-container">
    @include('pasien.layouts.navbar')
    <div class="container">
        <div class="row justify-content-md-around mx-0">
            <div class="block rounded main-content transaction-index col-md -offset2 col-lg-3 col-sm-12 " ng-controller="PasienController">
                <div class="block-header col">
                    <h3 class="block-title">Filter</h3>
                </div>
                <div class="block-content">
                    <form id="pasienFilterForm">
                        <dt>Nomor RM</dt>
                        <input type="text" class="mb-15 form-control" placeholder="Ketik Nama Pasien" id="pasienRM">

                        <dt>Nama</dt>
                        <input type="text" class="mb-15 form-control" placeholder="Ketik Nama Pasien" id="pasienNama">

                        <dt>NRP</dt>
                        <input type="text" class="mb-15 form-control" placeholder="Ketik NRP Pasien" id="pasienNRP">

                        <dt>Alamat</dt>
                        <input type="text" class="mb-15 form-control" placeholder="Alamat Lengkap Pasien" id="pasienAlamat">

                        <label for="kotaSelect2">Kota/Kabupaten</label>
                        <div class="input-group mb-15">
                            <select class="js-select2 form-control custom-select kotaSelect2" id="kotaSelect2" name="city"  data-placeholder="Pilih kota/kabupaten">
                                <option value="" id=""></option>
                            </select>
                        </div>

                        <div id="kecamatanWrap">
                            <label class="control-label">Kecamatan <i id="kecamatanLoading" class="fa fa-asterisk fa-spin text-info"></i></label>
                            <div class="input-group mb-15">
                                <select class="js-select2 form-control custom-select" id="kecamatanSelect2" name="district"  data-placeholder="Pilih kecamatan">
                                    <option value="" id=''></option>
                                </select>
                            </div>
                        </div>

                        <dt>KTP</dt>
                        <input type="text" class="mb-15 form-control" placeholder="Ketik Nomor KTP" id="pasienKTP">

                        <dt>No Asuransi</dt>
                        <input type="text" class="mb-15 form-control" placeholder="Ketik Nomor Asuransi" id="pasienAsuransi">

                        <dt>Usia</dt>
                        <input type="text" class="mb-5 form-control" placeholder="Usia Min" id="pasienUsiaMin">
                        <input type="text" class="mb-15 form-control" placeholder="Usia Max" id="pasienUsiaMax">

                        <dt>Jenis Kelamin</dt>
                        <div class="input-group">
                            <label class="css-control css-control-primary css-checkbox">
                                <input type="checkbox" class="css-control-input" id="pasienLaki">
                                <span class="css-control-indicator"></span> Laki-laki
                            </label>
                        </div>
                        <div class="input-group">
                            <label class="css-control css-control-primary css-checkbox">
                                <input type="checkbox" class="css-control-input" id="pasienPerempuan">
                                <span class="css-control-indicator"></span> Perempuan
                            </label>
                        </div>
                        <div class="mt-30 mb-20">
                            <button class="btn btn-primary btn-block" type="submit">Filter</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="block rounded main-content transaction-index col-md -offset2 col-lg-9 col-sm-12 "  ng-controller="PasienController" style="overflow: auto;">
                <div class="block-header">
                    <h3 class="block-title">Daftar Pasien</h3>
                </div>

                <div id="noResult" style="display: none">
                    <div class="text-center py-50">
                        Pasien tidak ditemukan. Silahkan coba dengan kata kunci lainnya <br>
                        Atau anda bisa membuat pasien baru<br><br>
                        <a href="{{url('pasien/baru')}}" class="btn btn-outline-primary">+ Pasien Baru</a>
                    </div>
                </div>

                <div class="table-full-width spinner-container" id="pasienResult">
                    <div class="spinner-back">
                        <table class="table table-striped table-hover table-pointer ">
                            <thead>
                                <tr class="header" ng-click="getCurrentPage()">
                                    <th style="width:8%">No RM </th>
                                    <th style="width:20%">Nama</th>
                                    <th style="width:27%">Alamat</th>
                                    <th style="width:10%">Kartu Identitas</th>
                                    <th style="width:10%">NRP</th>
                                    <th style="width:10%">Jenis Pasien</th>
                                </tr>
                            </thead>
                            <tbody class="spinner-back-placeholder">
                                @for ($i = 0; $i < 10; $i++)
                                <tr class="clickable-row">
                                    <td class="py-10 px-10"><div class=" bg-primary-lighter">&nbsp;</div></td>
                                    <td class="py-10 px-10"><div class=" bg-primary-lighter">&nbsp;</div></td>
                                    <td class="py-10 px-10"><div class=" bg-primary-lighter">&nbsp;</div></td>
                                    <td class="py-10 px-10"><div class=" bg-primary-lighter">&nbsp;</div></td>
                                    <td class="py-10 px-10"><div class=" bg-primary-lighter">&nbsp;</div></td>
                                    <td class="py-10 px-10"><div class=" bg-primary-lighter">&nbsp;</div></td>
                                </tr>
                                @endfor
                            </tbody>
                            <tbody id="renderPasien"></tbody>
                        </table>
                    </div>

                    <div class="spinner">
                        <td colspan="6"><i class="fa fa-4x fa-asterisk fa-spin text-info"></i></td>
                    </div>

                    <div class="flex-center" style="">
                        <ul id="pagination" class="pagination"></ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection


@section('angular')
<script type="text/javascript">

    $('#select').select2();
    $('.js-select2').select2();
    $('#tanggal-lahir').bootstrapMaterialDatePicker({ weekStart : 0, time: false });

    changeJenis(1)

    var valJenisPasien = 1;
    var valGender = 1;
    var valMarriage = 1;

    function getKota()
    {
        $.ajax({
            type:'GET',
            url:API_URL + '/pasien/alamat/kota/get',
            dataType: 'json',
            success:function(data){
                console.log(data);
                data.forEach(function(item) {
                    var newOption = new Option(item.name, item.id, false, false);
                    $("#kotaSelect2").append(newOption).trigger('change');
                });
                $('#kotaSelect2').select2({
                    allowClear: true
                });
            },
            error:function(data){
                if(getKotaErrorCounter<3) getKota();
                else swalError()
                    getKotaErrorCounter++;
            }
        });
    }

    function setKecamatan(id)
    {
        $('#kecamatanLoading').show();
        $.ajax({
            type:'GET',
            url:API_URL + '/pasien/alamat/kecamatan/get/'+id,
            dataType: 'json',
            success:function(data){
                console.log(data);
                data.forEach(function(item) {
                    var newOption = new Option(item.name, item.id, false, false);
                    $("#kecamatanSelect2").append(newOption).trigger('change');
                });
                $('#kecamatanLoading').fadeOut();
                $('#kecamatanSelect2').select2({
                    allowClear: true
                });
            },
            error:function(data){
                console.log(data);
            }
        });
    }

    function setJenis(){
        @foreach($form['jenis_pasien'] as $item)
        $("#jenisSelect2").append(new Option('{{$item->nama}}', {{$item->id}}, false, false)).trigger('change');
        @endforeach

        $('#jenisSelect2').select2({
            allowClear: true
        });
    }

    $( document ).ready(function() {
        setJenis();
        getKota();

        id = $('#kotaSelect2').val()
        console.log(id)
        if(id!=''){
            setKecamatan(id);
            $('#kecamatanWrap').slideDown();
            $('#kecamatanSelect2').html('').select2({data: [{id: '', text: ''}]});
        }else{
            $('#kecamatanWrap').slideUp();
        }

        $('#kotaSelect2').on("select2:select", function(e) {
            id = $('#kotaSelect2').val()
            console.log(id)
            if(id!=''){
                setKecamatan(id);
                $('#kecamatanWrap').slideDown();
                $('#kecamatanSelect2').html('').select2({data: [{id: '', text: ''}]});
            }else{
                $('#kecamatanWrap').slideUp();
            }
        });

        $("#kotaSelect2").on("select2:unselecting", function (e) {
            $('#kecamatanWrap').slideUp();
            $(this).on('select2:opening', function(e) {
                e.preventDefault();
            });
        });

        $('#kotaSelect2').on("select2:unselect", function(e){
            var sel = $(this);
            setTimeout(function() {
                sel.off('select2:opening');
            }, 1);
        });


        $("#kecamatanSelect2").on("select2:unselecting", function (e) {
            $(this).on('select2:opening', function(e) {
                e.preventDefault();
            });
        });

        $('#kecamatanSelect2').on("select2:unselect", function(e){
            var sel = $(this);
            setTimeout(function() {
                sel.off('select2:opening');
            }, 1);
        });


        $("#jenisSelect2").on("select2:unselecting", function (e) {
            $(this).on('select2:opening', function(e) {
                e.preventDefault();
            });
        });

        $('#jenisSelect2').on("select2:unselect", function(e){
            var sel = $(this);
            setTimeout(function() {
                sel.off('select2:opening');
            }, 1);
        });
    });


    function changeJenis(val)
    {
        valJenisPasien = val;
        if(val == 1)
        {
            $('.jenis-asuransi').hide();
            $('.jenis-kerjasama').hide();
            $('.jenis-bpjs').hide();
            $('.nomor-asuransi').hide();
        }
        else if(val == 2)
        {
            $('.jenis-asuransi').hide();
            $('.jenis-kerjasama').hide();
            $('.jenis-bpjs').show();
            $('.nomor-asuransi').show();
        }
        else if(val == 3)
        {
            $('.jenis-asuransi').show();
            $('.jenis-kerjasama').hide();
            $('.jenis-bpjs').hide();
            $('.nomor-asuransi').show();
        }
        else if(val == 4)
        {
            $('.jenis-asuransi').hide();
            $('.jenis-kerjasama').show();
            $('.jenis-bpjs').hide();
            $('.nomor-asuransi').show();
        }
    }

    function changeGender(val)
    {
        valGender = val;
    }

    function changeMarriage(val)
    {
        valMarriage = val;
    }


    $('#kecamatanWrap').hide();

</script>

<script type="text/javascript">

    var total_pages = 1;
    var visible_pages = 5;
    var keyword = '';
    var items_show = 10;
    var firstLoadPagination = false;
    nama = $('#pasienNama').val();
    no_rm = $('#pasienRM').val();
    alamat = $('#pasienAlamat').val();
    kota = $('#kotaSelect2').val();
    kecamatan = $('#kecamatanSelect2').val();
    ktp = $('#pasienKTP').val();
    asuransi = $('#pasienAsuransi').val();
    jenis = $('#jenisSelect2').val();
    usia_min = $('#pasienUsiaMin').val();
    usia_max = $('#pasienUsiaMax').val();
    if($('#pasienLaki').is(':checked')){
        laki=1;
    }else{
        laki=0;
    }

    if($('#pasienPerempuan').is(':checked')){
        perempuan=1;
    }else{
        perempuan=0;
    }

    loadData();

    function loadPagination(currentPage = 1)
    {
        console.log(total_pages);

        $('#pagination').twbsPagination('destroy');
        $('#pagination').twbsPagination({
            totalPages: total_pages,
            startPage: currentPage,
            visiblePages: visible_pages,
            initiateStartPageClick: false,
            onPageClick: function (event, page) {
                loadData(page,nama,alamat,kota,kecamatan,ktp,asuransi,jenis,usia_min,usia_max,laki,perempuan, no_rm);
            }
        });
        firstLoadPagination = true;
    }
    function reloadPagination(currentPage)
    {
        var defaultOpts = {
            totalPages: 20
        };
        console.log('reload');
        console.log(total_pages);
        $('#pagination').twbsPagination($.extend({}, defaultOpts, {
            startPage: currentPage,
            totalPages: total_pages
        }));
    }


    function loadData(currentPage=1, nama='', alamat='', kota='', kec='', ktp='', asuransi='', jenis='', usia_min='', usia_max='', laki=0, perempuan=0, nrp='', no_rm='')
    {
        $('.spinner').fadeIn();
        $('#noResult').hide();
        $('#pasienResult').show();
        $('#renderPasien').hide();
        $('.spinner-back-placeholder').show();
        $.ajax({
            url: API_URL + '/pasien/filter?page='+ currentPage+
            '&nama='+nama+
            '&alamat='+alamat+
            '&no_rm='+no_rm+
            '&kota='+kota+
            '&kecamatan='+kec+
            '&ktp='+ktp+
            '&asuransi='+asuransi+
            '&jenis='+jenis+
            '&usia_min='+usia_min+
            '&usia_max='+usia_max+
            '&laki='+laki+
            '&perempuan='+perempuan+
            '&nrp='+nrp,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                if(data.total>0)
                {
                    $('#noResult').hide();
                    $('#pasienResult').show();
                    total_pages = Math.ceil(data.total/items_show);
                    var template = $('#template-pasienlist').html();
                    loadMustache(template);
                    var rendered = Mustache.render(template, data);
                    $('.spinner').fadeOut();
                    $('#renderPasien').show();
                    $('#renderPasien').html(rendered);
                    $('.spinner-back-placeholder').hide();
                    loadPagination(currentPage);
                }
                else
                {
                    $('.spinner').fadeOut();
                    $('#noResult').fadeIn();
                    $('#pasienResult').hide();
                    $('.spinner-back-placeholder').hide();
                }
            },
            error: function() {
                alert('error');
            },
        });
    }

    function loadMustache(template) {
        Mustache.parse(template, customTags);
        Mustache.tags = customTags;
    }

    $('#pasienFilterForm').submit(function( event ) {
        event.preventDefault();

        nama = $('#pasienNama').val();
        no_rm = $('#pasienRM').val();
        nrp = $('#pasienNRP').val();
        alamat = $('#pasienAlamat').val();
        kota = $('#kotaSelect2').val();
        kecamatan = $('#kecamatanSelect2').val();
        ktp = $('#pasienKTP').val();
        asuransi = $('#pasienAsuransi').val();
        jenis = $('#jenisSelect2').val();
        usia_min = $('#pasienUsiaMin').val();
        usia_max = $('#pasienUsiaMax').val();
        if($('#pasienLaki').is(':checked')){
            laki=1;
        }else{
            laki=0;
        }

        if($('#pasienPerempuan').is(':checked')){
            perempuan=1;
        }else{
            perempuan=0;
        }
        loadData(1,nama,alamat,kota,kecamatan,ktp,asuransi,jenis,usia_min,usia_max,laki,perempuan,nrp, no_rm);
    });

</script>


<script id="template-pasienlist" type="x-tmpl-mustache">
    @{{#data}}
    <tr class="clickable-row" data-href="{{url('pasien')}}/@{{id}}">
    <td>@{{no_rm}}</td>
    <td>
    @{{name}}<br>
    @{{jenis_kelamin}}, @{{age}} tahun
    </td>
    <td>@{{address}}<br>
    @{{kecamatan}}, @{{kota}}
    </td>
    <td>
    @{{kartu}}<br>
    @{{no_identitas}}
    </td>
    @{{#is_anggota}}
    <td>@{{tni_nrp}}</td>
    @{{/is_anggota}}
    @{{^is_anggota}}
    <td>-</td>
    @{{/is_anggota}}
    <td>@{{pembayaran}}
    </td>
    </tr>
    @{{/data}}
</script>
@endsection
