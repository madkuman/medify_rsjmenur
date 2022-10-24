{{-- <script src="{{ asset('assets/js/combodate.js') }}"></script>
<script src="{{ asset('js/kepegawaian/combodateSelect2v1.1.js') }}"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script> --}}
<script type="text/javascript">

    $(function(){
        $('#date').combodate({
            customClass: 'js-select2 form-control',
            smartDays: true,
            maxYear: new Date().getFullYear() + 1
        });
    });

</script>