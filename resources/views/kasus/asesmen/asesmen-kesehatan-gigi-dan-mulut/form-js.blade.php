@section('js')
<script type="text/javascript">
    $(document).ready(function() {
        $('#btn-submit').prop('disabled', false);
        $('#btn-submit').html('Simpan')
    });	
    $('#btn-submit').on( 'click', function() {
        $(this).prop('disabled', true);
        $(this).css({ cursor: "not-allowed" });
        $(this).html('<i class="fa fa-spinner fa-spin"></i> Simpan')
        $('#form-post').submit()
    } );
</script>
@endsection