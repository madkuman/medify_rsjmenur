<script type="text/javascript">
    $(document).ready(function(){
        $('.js-example-basic-multiple').select2();
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
            // $this.submit();
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
            // $this.submit();
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
</script>