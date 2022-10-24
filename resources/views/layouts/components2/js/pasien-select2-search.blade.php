
<script type="text/javascript">
    function initSelect2PasienSearch(element_name)
    {
        $(element_name).select2({
            ajax: {
                url: API_URL+"/pasien/get",
                dataType: 'json',
                delay: 250,
                data: function (params) 
                {
                    return {
                        keyword: params.term,
                        page: params.page
                    };
                },
                processResults: function (data, params) {
                    params.page = params.page || 1;
                    return {
                        results: data.data,
                    };
                },
                cache: true
            },
            escapeMarkup: function (markup) { return markup; },
            minimumInputLength: 3,
            placeholder: "Cari Pasien",
            templateResult: formatPasien,
            templateSelection: formatPasienSelection
        });

        function formatPasien (item) {
            if (item.loading) {
                return item.text;
            }
            var markup = item.no_rm + ' - ' + item.name
            return markup;
        }
        function formatPasienSelection (item) {
            if (item.no_rm) {
                return item.no_rm + ' - ' + item.name;
            }
            return item.name || item.text;
        }
    }
</script>