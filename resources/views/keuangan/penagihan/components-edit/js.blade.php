<script src="{{asset('js/keuangan/piutang/editv1.4.js')}}"></script>
<script>
    var user = {{ (Auth::user()->id) }}
    initTransaksi()
</script>