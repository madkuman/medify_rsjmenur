<script type="text/javascript">
    $(document).ready(function(){
        $('.js-example-basic-multiple').select2();
        $('#jenis-pembayaran').hide();
    });

    $('#obat-resep').on('click', function(){
        if($('#obat-resep').is(":checked") && !$('#obat-bebas').is(":checked")) $('#jenis-pembayaran').show();
        else $('#jenis-pembayaran').hide();
    });

    $('#obat-bebas').on('click', function(){
        if($('#obat-resep').is(":checked") && !$('#obat-bebas').is(":checked")) $('#jenis-pembayaran').show();
        else $('#jenis-pembayaran').hide();
    });

    $('.btn-pdf').on('click', function(e){
        e.preventDefault();
        var pdf = '<input type="hidden" name="export_as" value="pdf">';
        var $this = $(this).parents('form');
        date = $(this).parents('form').find('.datepicker');
        
        flag=0;
        for(i=0;i<date.length;i++)
        {
            if($(date[i]).val()) continue;
            else flag++;
        }
        if(!flag)
        {
            $this.find('.export-as').html(pdf);
            $this.unbind('submit').submit();
            $this.find('.text-warning').addClass('d-none');
        }
        else $this.find('.text-warning').removeClass('d-none');
    });

    $('.btn-excel').on('click', function(e){
        e.preventDefault();
        var xls = '<input type="hidden" name="export_as" value="xls">';
        var $this = $(this).parents('form');

        date = $(this).parents('form').find('.datepicker');
        
        flag=0;
        for(i=0;i<date.length;i++)
        {
            if($(date[i]).val()) continue;
            else flag++;
        }
        if(!flag)
        {
            $this.find('.export-as').html(xls);
            $this.unbind('submit').submit();
            $this.find('.text-warning').addClass('d-none');
        }
        else $this.find('.text-warning').removeClass('d-none');

    });

    datepicker();

    function datepicker() {
        $('.datepicker').datepicker({
            // startDate: "today",
            autoclose: true,
            todayHighlight: true,
            format: 'dd/mm/yyyy',
        });
    }

    function checkValidDate() {
        $('.form-group').on('change', '.datepicker', function(){
            var today = new Date();

            var str = $(this).val();
            var res = str.split('/');
            var expired = res[1]+'/'+res[0]+'/'+res[2];
            var expiredDate = new Date(expired);

            if (today > expiredDate) {
                $(this).parent('div').find('.txt-date').html('Tanggal kurang dari hari ini !');
            } else {
                $(this).parent('div').find('.txt-date').html('');
            }
        });
    }

    $('input[type=radio][name=tipe_put]').change(function() {
        if($(this).val() == "triwulan"){
            $('#put-bulanan-form').hide();
            $('#put-triwulan-form').show();
            $('#bulan-put').val(null).trigger('change');
        }else{
            $('#put-triwulan-form').hide();
            $('#put-bulanan-form').show();
            $('#triwulan-put').val(null).trigger('change');
        }
    });

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
</script>    