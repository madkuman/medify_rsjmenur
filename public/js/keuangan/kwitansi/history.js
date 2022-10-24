$("#kategori").select2();

$('#kategori').on('select2:select', function (e) {
    var current_val = $("#kategori").val();
    if(current_val == 1)
    {
        $("#by-date").hide();
        $("#by-date-submit").hide();
    }
    else
    {
        $("#by-date").show();
        $("#by-date-submit").show();
    }
});