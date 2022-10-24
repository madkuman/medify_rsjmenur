
<script type="text/javascript">

    $('#tanggal').bootstrapMaterialDatePicker({ weekStart : 0, time: false });
    $( document ).ready(function(){
        $('#modalTanggal').on('show.bs.modal', function(e) {
            var title = $(e.relatedTarget).data('title');
            $(e.currentTarget).find('div[name="modal-title"]').html(title);
        });

        $('#table-laporan-sensus-rawat-inap').DataTable({
            "searching": false,
            "info": false,
            ajax : {
                url : API_URL+'/laporan/list/',
                data : {
                    slug: 'pasien-laporan-sensus-rawat-inap'
                }
            },
            columns : [
                {
                    title : "File",
                    data : 'file_name'
                },
                {
                    title : "Download",
                    data : (data) => {
                        return `<a href="${BASE_URL+data.file_path}" class="btn btn-sm btn-primary">Download</a>`;
                    }
                }
            ]
        });
    });
    $(".bulan-datepicker").datepicker( {
        format: "yyyy-mm",
        startView: "months", 
        minViewMode: "months",
        autoclose: true,
    });

    getProvinsi();

    function getKota(id, element)
    {
        var getKotaErrorCounter = 0;
        $.ajax({
            type:'GET',
            url:API_URL + '/pasien/alamat/kota/search/'+id,
            dataType: 'json',
            success:function(data){
                element.html('').select2({data: [{id: '', text: ''}]});
                data.forEach(function(item) {
                    var newOption = new Option(item.name, item.id, false, false);
                    element.append(newOption).trigger('change');
                });
            },
            error:function(data){
                if(getKotaErrorCounter<3) getKota();
                else swalError()
                    getKotaErrorCounter++;
            }
        });
    }

    $('.provinsiSelect2').on("select2:select", function(e) {
        var data = e.params.data;
        id = data.id;
        var element = $(this).parent().parent().parent().find('.kotaSelect2')
        getKota(id, element)
    });

    function getProvinsi()
    {
        $.ajax({
            type:'GET',
            url:API_URL + '/pasien/alamat/provinsi/get',
            dataType: 'json',
            success:function(data){
                $('.provinsiSelect2').html('').select2({data: [{id: '', text: ''}]});
                data.forEach(function(item) {
                    var newOption = new Option(item.nama, item.id, false, false);
                    $(".provinsiSelect2").append(newOption).trigger('change');
                });

                var element = $(this).parent().parent().parent().find('.kotaSelect2')
                getKota(1, element)
            },
            error:function(data){
                console.log(data);
            }
        });
    }

    $('.pasien-select2').select2({
        ajax: {
            url: API_URL+"/pasien/get",
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
        placeholder: "Cari Pasien",
        templateResult: formatPasien,
        templateSelection: formatPasienSelection
    });



    function formatPasien (item) {
        if (item.loading) {
            return item.text;
        }

        var markup = item.name;

        return markup;
    }

    function formatPasienSelection (item) {
        if(item.name) return item.name;
        else return item.text;
    }

    $("#modalSuratKeteranganDirawat #pasien-select").change(function(){
        $('#modalSuratKeteranganDirawat #loading-kasus').show()
        var pasien_id = $(this).val();
        $.ajax({
            url: API_URL + '/pasien/'+pasien_id+'/kasus-with-krs',
            dataType: 'json',
            success: function(data){
                var kasus_current = $('#modalSuratKeteranganDirawat #kasus-select').val();
                var option = [];
                option.push({
                    id: 0,
                    text: 'Tanpa kasus'
                });


                for (i in data) {
                    if(kasus_current != data[i].id)
                    {
                        option.push({
                            id: data[i].nomor_kasus,
                            text: data[i].lokasi +' - '+data[i].waktu_create +' - ('+data[i].status_krs_text +')' ,
                        });
                    }
                }
                $('#kasus-select').html('').select2({
                    data: option
                })
                $('#modalSuratKeteranganDirawat #loading-kasus').hide()
            }
        });
    });

    $('#modalSuratKeteranganDirawat #buttonSubmit').click(function(e){
        e.preventDefault();
        var nomor_kasus = $('#modalSuratKeteranganDirawat #kasus-select').val();
        $('#modalSuratKeteranganDirawat form').attr('action', '{{url('')}}/kasus/'+nomor_kasus+'/alat-bantu/sk-dirawat');
        $('#modalSuratKeteranganDirawat form').submit();
    });

    
    $(document).on('click', '.btn-submit', function(){
        $(this).parent().parent().unbind('submit').submit();
    })


    $('.icd10-search').select2({
        ajax: {
            url: API_URL+"/kasus/get/list/diagnosis",
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
        placeholder: "Cari ICD 10",
        templateResult: formatICD10,
        templateSelection: formatICD10Selection
    });



    function formatICD10 (item) {
        if (item.loading) {
            return item.text;
        }

        var markup = item.code_icd + ' - '+ item.long_desc;

        return markup;
    }

    function formatICD10Selection (item) {
        if(item.code_icd){
            var markup = item.code_icd + ' - '+ item.long_desc;
            return markup;
        }
        else return item.text;
    }
</script>