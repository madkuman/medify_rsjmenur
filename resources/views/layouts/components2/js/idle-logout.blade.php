<script type="text/javascript">
    var idleTime = 0;
    $(document).ready(function () {
        var idleInterval = setInterval(timerIncrement, 1000);  //checking per detik

        $(this).mousemove(function (e) {
            idleTime = 0;
        });
        $(this).keypress(function (e) {
            idleTime = 0;
        });
    });

    function timerIncrement() {
        idleTime = idleTime + 1;
        if (idleTime == 25200) { //25200 detik atau 7 jam 
            // window.location.href = "{{url('logout')}}";
        }
    }
</script>
