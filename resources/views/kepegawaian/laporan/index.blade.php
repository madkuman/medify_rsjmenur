@extends('kepegawaian.layouts.main')

@section('title')
{{$htmlheader_title}}
@endsection

@section('subtitle')
{{$contentheader_title}}
@endsection

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-12 text-center my-20">
			<h3>Laporan</h3>
        </div>
        <div class="col-md-12">
            <div class="row row-deck">
                @include('kepegawaian.laporan.content.daftar-keluar-masuk')
                @include('kepegawaian.laporan.content.laporan-legalitas')
                @include('kepegawaian.laporan.content.resume-pegawai')
            </div>
        </div>
	</div>

	{{-- modal --}}
	@include('kepegawaian.laporan.modals.daftar-keluar-masuk')
    @include('kepegawaian.laporan.modals.laporan-legalitas')
    @include('kepegawaian.laporan.modals.profile-pegawai')
</div>
@endsection

@push('footer-script')
<script>
	$(function(){
		$('.combodate').combodate({
			customClass: 'js-select2 form-control',
			smartDays: true,
			maxYear: new Date().getFullYear()
		});
	});

    $("#cetakBulananPolos").datepicker({
        format: "yyyy-mm",
        startView: "months",
        minViewMode: "months"
    });
</script>
@endpush
@section('js')
<script type="text/javascript">
    $(document).ready(function(){
        $('.checkBtn').click(function(e) {
            e.preventDefault();
            var form = $(this).parent().parent();
            if ( form.find('.status-pegawai-checkbox').length){
                var checked = form.find('.status-pegawai-checkbox:checked').length;
                // checked = $(".status-pegawai-checkbox:checked").length;

                if(!checked) {
                    form.find('.box-alert').css("border-top", "1px solid red");
                    form.find('.box-alert').css("border-bottom", "1px solid red");
                    form.find('.text-alert').css("display", "inline");
                    return false;
                }
                $(this).parent().parent().find(".form-submit").submit();
            }
            else
            {
                 $(this).parent().parent().find(".form-submit").submit();
            }
        });
        $('.keperluan').select2();
    });
</script>
<script type="text/javascript">
    /*$('.pegawai').on('select2:select', function (e) {
        console.log(e.params);
        var data = e.params.data;
        console.log(data.jabatan);
    });*/
    var lulus_postur = 0 , lulus_garjas = 0 , lulus_renang = 0 , lulus_akhir = 0;
    var lari = 0 , pullup = 0 , pushup = 0 , situp = 0 , shuttle = 0;
    var tinggi = 0 , bb = 0;
    var gaya_renang = 0 , waktu_renang = 0;
    var NP = 0, NG = 0, NR = 0;
    var typingTimer;                
    var doneTypingInterval = 2000;  

    $('.keperluan').on('change',function(){
        lulus_akhir = $(this).find(':selected').data('akhir');
        var nama = $(this).find(':selected').data('nama');
        if(nama == 'Rutin')
        {
            $('#berenang').hide();
        }
        else
        {
            $('#berenang').show();
        }
        console.log($(this).find(':selected').data('postur'));
    });

    $('#lari').on('keyup', function()
    {
        clearTimeout(typingTimer);
        var flag = $(this).attr('id');
        typingTimer = setTimeout(getNilai(flag), doneTypingInterval);
    })

    $('#lari').on('keydown', function()
    {
        clearTimeout(typingTimer);
    })

    $('#pullup').on('keyup', function()
    {
        clearTimeout(typingTimer);
        var flag = $(this).attr('id');
        typingTimer = setTimeout(getNilai(flag), doneTypingInterval);
    })

    $('#pullup').on('keydown', function()
    {
        clearTimeout(typingTimer);
    })

    $('#situp').on('keyup', function()
    {
        clearTimeout(typingTimer);
        var flag = $(this).attr('id');
        typingTimer = setTimeout(getNilai(flag), doneTypingInterval);
    })

    $('#situp').on('keydown', function()
    {
        clearTimeout(typingTimer);
    })
    
    $('#pushup').on('keyup', function()
    {
        clearTimeout(typingTimer);
        var flag = $(this).attr('id');
        typingTimer = setTimeout(getNilai(flag), doneTypingInterval);
    })

    $('#pushup').on('keydown', function()
    {
        clearTimeout(typingTimer);
    })

    $('#shuttle').on('keyup', function()
    {
        clearTimeout(typingTimer);
        var flag = $(this).attr('id');
        typingTimer = setTimeout(getNilai(flag), doneTypingInterval);
    })

    $('#shuttle').on('keydown', function()
    {
        clearTimeout(typingTimer);
    })

    $('.pegawai').on('change', function(){
        var data = $(this).find(':selected').data('jabatan');
        var umur = $(this).find(':selected').data('umur');
        var gender = $(this).find(':selected').data('gender');
        console.log(data);
        $('#jabatan').val(data);
        $('.umur').val(umur);
        $('.gender').val(gender);
    });
    $('#waktu_lari_pns').on('keyup', function()
    {
        clearTimeout(typingTimer);
        var flag = $(this).attr('id');
        typingTimer = setTimeout(getNilaiPNS(), doneTypingInterval);
    })

    $('#waktu_lari_pns').on('keydown', function()
    {
        clearTimeout(typingTimer);
    })
    function getNilaiPNS()
    {
        var nilai =  $('#waktu_lari_pns').val();
        var umur = $('.umur').val();
        var gender = $(".gender").val();
        $.ajax({
            url: BASE_URL + '/kepegawaian/master/kepegawaian/get/nilaiPNS',
            dataType : 'json',
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            type : 'post',
            data : {'nilai' : nilai , 'umur' : umur, 'gender' : gender},
            success: function(data){
                console.log(data);
                $('#nilai_lari_pns').val(data.nilai);
                $('#kategori_lari_pns').val(data.kategori);
                $('#nilai_lari_pns_nilai').val(data.nilai);
                $('#kategori_lari_pns_nilai').val(data.kategori);
                $('#kategori_umur').val(data.kategori_umur) 
            }
        })
    }
    function getNilai(flag)
    {   
        //hitungAB(lari,pullup,situp,pushup,shuttle);
        console.log(flag)
        if(flag == 'lari')
        {
            var nilai = $('#lari').val();    
        }
        else if(flag == 'pullup')
        {
            var nilai = $('#pullup').val();
        }
        else if(flag == 'pushup')
        {
            var nilai = $('#pushup').val();
        }
        else if(flag == 'situp')
        {
            var nilai = $('#situp').val();
        }
        else if(flag == 'shuttle')
        {
            var nilai = $('#shuttle').val();
        }
        var umur = $('.umur').val();
        var gender = $(".gender").val();
        $.ajax({
            url: BASE_URL + '/kepegawaian/master/kepegawaian/get/nilai',
            dataType : 'json',
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            type : 'post',
            data : {'nilai' : nilai , 'umur' : umur, 'gender' : gender, 'flag' : flag},
            success: function(data){
                console.log(data);
                if(flag == 'lari')
                {
                    $('.nilai_lari').val(data);
                    lari = data;    
                }
                else if(flag == 'pullup')
                {
                    $('.nilai_pullup').val(data);
                    pullup = data;
                }
                else if(flag == 'situp')
                {
                    $('.nilai_situp').val(data);
                    situp = data;
                }
                else if(flag == 'pushup')
                {
                    $('.nilai_pushup').val(data);
                    pushup = data;
                }
                else if(flag == 'shuttle')
                {
                    $('.nilai_shuttle').val(data);
                    shuttle = data;
                }
                hitungAB(lari,pullup,situp,pushup,shuttle);
                hitungAkhir(NP,NG,NR);
            }
        })
    }

    function hitungAB(lari,pullup,situp,pushup,shuttle)
    {
        var nilaiA , nilaiB, nilaiMean , kategori;
        nilaiA = lari;
        nilaiB = (pullup+situp+pushup+shuttle) / 4;
        nilaiMean = (nilaiA + nilaiB) / 2;
        $('.nilai_b').val(nilaiB);
        $('.nilai_mean').val(nilaiMean);
        NG = nilaiMean;
        if(nilaiMean >= 81)
        {
            kategori = 'BS';
        }
        else if(nilaiMean >= 61)
        {
            kategori = 'B';
        }
        else if(nilaiMean >= 41)
        {
            kategori = 'C';
        }
        else if(nilaiMean >= 37)
        {
            kategori = 'K1';
        }
        else if(nilaiMean >= 0)
        {
            kategori = 'K2';
        }
        $('.kategori_garjas').val(kategori);
    }

    $('#tinggi').on('keyup', function()
    {
        clearTimeout(typingTimer);
/*        var flag = $(this).attr('id');
        var val = $(this).val();*/
        typingTimer = setTimeout(getNilaiPostur($(this)), doneTypingInterval);
    })

    $('#tinggi').on('keydown', function()
    {
        clearTimeout(typingTimer);
    })

    $('#berat').on('keyup', function()
    {
        clearTimeout(typingTimer);
/*        var flag = $(this).attr('id');
        var val = $(this).val();*/
        typingTimer = setTimeout(getNilaiPostur($(this)), doneTypingInterval);
    })

    $('#berat').on('keydown', function()
    {
        clearTimeout(typingTimer);
    })

    function getNilaiPostur(param)
    {   
        console.log(param);
        var value = param.val();
        var id = param.attr('id');
        console.log(value,id);
        if(id == 'tinggi')
        {
            tinggi = value;
        }
        else
        {
            bb = value;
        }

        if(tinggi != 0 && bb != 0)
        {   
            console.log('abc');
            $.ajax({
                url: BASE_URL + '/kepegawaian/master/kepegawaian/get/nilaiPostur',
                dataType : 'json',
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                type : 'post',
                data : {'tinggi' : tinggi , 'bb' : bb},
                success: function(data){
                    console.log(data);
                    $('.klasifikasi_bb').val(data);
                    hitungPostur(data);
                    hitungAkhir(NP,NG,NR); 
                }
            })    
        }
        
    }

    function hitungPostur(data)
    {   
        if(data == 'LLB')
        {
            $('.nilai_postur').val('1');
            NP = 1;
            $('.kategori_postur').val('K2');
        }
        else if(data == 'LLA')
        {
            $('.nilai_postur').val('21');
            NP = 21;
            $('.kategori_postur').val('K2'); 
        }
        else if(data == 'LA')
        {
            $('.nilai_postur').val('41');
            NP = 41;
            $('.kategori_postur').val('C');
        }
        else if(data == 'NA')
        {
            $('.nilai_postur').val('61');
            NP = 61;
            $('.kategori_postur').val('B');
        }
        else if(data == 'HA')
        {
            $('.nilai_postur').val('81');
            NP = 81;
            $('.kategori_postur').val('BS');
        }
        else if(data == 'I')
        {
            $('.nilai_postur').val('91');
            NP = 91;
            $('.kategori_postur').val('BS');
        }
        else if(data == 'HB')
        {
            $('.nilai_postur').val('71');
            NP = 71;
            $('.kategori_postur').val('B');
        }
        else if(data == 'NB')
        {
            $('.nilai_postur').val('51');
            NP = 51;
            $('.kategori_postur').val('C');
        }
        else if(data == 'LB')
        {
            $('.nilai_postur').val('31');
            NP = 31;
            $('.kategori_postur').val('K1');
        }
    }

    $('#waktu_renang').on('keyup', function()
    {
        clearTimeout(typingTimer);
/*        var flag = $(this).attr('id');
        var val = $(this).val();*/
        typingTimer = setTimeout(getNilaiRenang($(this)), doneTypingInterval);
    })

    $('#waktu_renang').on('keydown', function()
    {
        clearTimeout(typingTimer);
    })

    function getNilaiRenang(param)
    {   
        console.log(param);
        if($(param).attr('id') != 'waktu_renang')
        {
            var value = $(param).find('option:selected').val();
            var id = param.id;
            console.log(value,id);       
        }
        else
        {
            var value = param.val();
            var id = param.attr('id');
            console.log(value,id); 
        }
        
        if(id == 'waktu_renang')
        {
            waktu_renang = value;
        }
        else
        {
            gaya_renang = value;
        }
        var gender = $('#gender').val();
        if(gaya_renang != 0 && waktu_renang != 0)
        {   
            console.log('abc');
            $.ajax({
                url: BASE_URL + '/kepegawaian/master/kepegawaian/get/nilaiRenang',
                dataType : 'json',
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                type : 'post',
                data : {'gaya_renang' : gaya_renang , 'waktu_renang' : waktu_renang , 'gender' : gender},
                success: function(data){
                    console.log(data);
                    $('.nilai_renang').val(data);
                    NR = data;
                    hitungRenang(data);
                    hitungAkhir(NP,NG,NR);
                }
            })    
        }
        
    }

    function hitungRenang(data)
    {
        if(data >= 81)
        {
            $('.kategori_renang').val('BS');
        }
        else if(data >= 61)
        {
            $('.kategori_renang').val('B');   
        }
        else if(data >= 41)
        {
            $('.kategori_renang').val('C');   
        }
        else if(data >= 37)
        {
            $('.kategori_renang').val('K1');   
        }
        else if(data >= 0)
        {
            $('.kategori_renang').val('K2');   
        }
    }

    function hitungAkhir(NP,NG,NR)
    {
        var total;
        total = ((NP * 2) + (NG * 5) + (NR * 3)) / 10;
        $('.nilai_akhir').val(total);
        if(total >= 61)
        {
            $('.kategori_akhir').val('B');
        }
        else if(total >= 41)
        {
            $('.kategori_akhir').val('C');
        }
        else if(total >= 38)
        {
            $('.kategori_akhir').val('K1');
        }
        else if(total >= 0)
        {
            $('.kategori_akhir').val('K2');
        }

        if(total >= lulus_akhir)
        {   
            $('.kelulusan').hide();
            $('#kelulusan').text('LULUS');
            $('.kelulusan').show();
        }
        else if(total < lulus_akhir)
        {
            $('.kelulusan').hide();
            $('#kelulusan').text('TIDAK LULUS');
            $('.kelulusan').show();
        }
    }

	$('.kesatuan').select2({
            ajax: {
                url: BASE_URL + 'kepegawaian/master/kepegawaian/get/satker',
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
                        results: data.item,
                    };
                },
                cache: true
            },
            escapeMarkup: function (markup) { return markup; },
            minimumInputLength: 3,
            placeholder: "Cari Satker",
            templateResult: formatPasien,
            templateSelection: formatPasienSelection
        });
	function formatPasien (item) {
            if (item.loading) {
                return item.text;
            }

            var markup = item.nama;

            return markup;
        }

    function formatPasienSelection (item) {
        if(item.nama) return item.nama;
        else return item.text;
    }


</script>

<script type="text/javascript">
    $(document).on('click', '.submit-button', function(){
        $(this).parent().parent().unbind('submit').submit();
    })
</script>
<script>
      $(document).ready(function() {
        $("#pegawai").select2({
            ajax: {
                url: "/kepegawaian/laporan/get-pegawai",
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
                        results: data,
                    };
                },
                cache: true
            },
            escapeMarkup: function (markup) { return markup; },
            minimumInputLength: 3,
            placeholder: "Cari nama pegawai",
            templateResult: formatPegawai,
            templateSelection: formatSelection
        }); 
    });

    function formatPegawai (item) {
        if (item.loading) {
            return item.text;
        }

        var markup = item.text

        return markup;
    }

    //FORMAT UNTUK DI SHOW DI HTML
    function formatSelection (item) {
        return item.name || item.text;
    }
</script>
@endsection