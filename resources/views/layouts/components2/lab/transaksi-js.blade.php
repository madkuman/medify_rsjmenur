<script type="text/javascript" src="{{asset('assets/js/jquery1.10.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/dataTables1.10.bootstrap4.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        var monthNames = [
            "January", "February", "March",
            "April", "May", "June", "July",
            "August", "September", "October",
            "November", "December"
        ];

        var table = $('#datatable').DataTable( {
            "order": [[ 6, "desc" ]]
        });

        $(document).on('change', '#tanggalTransaksi', function(){
            var date = $('#tanggalTransaksi').val();
            if(date === '')
                window.location.href = `{{url()->current()}}?date=${date}&all=true`;
            else
                window.location.href = `{{url()->current()}}?date=${date}`;
        });
        $(document).on('click', '#clearTanggal', function(){
            $('#tanggalTransaksi').val('');
            window.location.href = `{{url()->current()}}?date=&all=true`;
        });

        $(document).on('change', '#jenisLayanan', function(){
            if(this.value == 0)
                table.columns(5).search('', true, false, true).draw();
            else
                table.columns(5).search(this.value, true, false, true).draw();
        });
        $(document).on('change', '#jenisPemeriksaan', function(){
            console.log(this.value,$('#jenisPemeriksaan').val().toString())
            if(this.value)
                table.columns(8).search($('#jenisPemeriksaan').val().toString().replace(/,/g, ' '), true, true, true).draw();
            else
                table.columns(8).search('', true, false, true).draw();
        });
    });
</script>