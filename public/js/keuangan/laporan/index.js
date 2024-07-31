
$.fn.editable.defaults.mode = 'inline';
$(document).ready(function() {
    initEditable();
    initSelect2Layanan(".layanan");
});

function printContent(id){
    var restorepage = document.body.innerHTML;
    var printcontent = document.getElementById(id).innerHTML;
    document.body.innerHTML = printcontent;
    window.print();
    document.body.innerHTML = restorepage;
}