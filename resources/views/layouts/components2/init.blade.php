<script>
    function setActiveButton(selector, status = true) {
        let element = $(selector);
        element.attr('disabled', !status);
        if (status == true) {
            element.find('.active-button-loader').remove();
            element.children().show();
        } else {
            element.children().hide();
            element.prepend(`<i class="fas fa-sync fa-spin active-button-loader">`);
        }
    }

    var number_format_formatter = new Intl.NumberFormat('id-ID', {
        minimumFractionDigits: 0,
        maximumFractionDigits: 2,
    });

    $(document).ready(function () {
        $('[data-tooltip="tooltip"]').tooltip();
    });
</script>
