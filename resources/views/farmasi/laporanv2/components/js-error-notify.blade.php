<script type="text/javascript">

    function errorNotify(title,message)
    {
        $.notify({
            title: '<strong>'+title+'</strong>',
            message: message
        },{
            type: 'danger',
            placement: {
                from: "top",
                align: "center"
            },
            delay: 3000
        });   
    }       
</script>