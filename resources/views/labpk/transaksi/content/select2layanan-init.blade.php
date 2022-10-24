<script type="text/javascript">
    //FORMAT UNTUK DI SHOW DI HTML
    function formatLayananSelection (item) {
        return item.deskripsi || item.text;
    }
    function formatLayanan (item) {
        if (item.loading) {
            return item.text;
        }

        var markup = item.deskripsi

        return markup;
    }

    function initSelect2Layanan(selector)
    {
        $(selector).select2({
            ajax: {
                url: API_URL+"/keuangan/tarif",
                dataType: 'json',
                delay: 250,
                data: function (params) 
                {
                    return {
                        keyword: params.term,
                        page: params.page,
                        detail: true
                    };
                },
                processResults: function (data, params) {
                    params.page = params.page || 1;
                    var kelas = "{{$transaksi->class}}";
                    var tipe = "{{$transaksi->tarif_tipe_id}}";
                    if(kelas == 2 ) tipe = 1;
                    
                    var filteredData = $.grep(data.data, (n, i) => {
                        return n.departemen_id === {{departemenId}};
                    });
                    var myResults = []
                    filteredData.forEach((dataItem) => {
                        dataItem['detail'].forEach((item) => {
                            if(item.tarif_tipe_id == tipe){
                                switch (kelas) {
                                    case "1":
                                        if(item.urj != null)    myResults.push(dataItem);
                                        break;
                                    case "2":
                                        if(item.igd != null)    myResults.push(dataItem);
                                        break;
                                    case "3":
                                        if(item.vvip != null)    myResults.push(dataItem);
                                        break;
                                    case "4":
                                        if(item.vip_a != null)    myResults.push(dataItem);
                                        break;
                                    case "5":
                                        if(item.vip_paviliun != null)    myResults.push(dataItem);
                                        break;
                                    case "6":
                                        if(item.i_paviliun != null)    myResults.push(dataItem);
                                        break;
                                    case "7":
                                        if(item.vip_ruangan != null)    myResults.push(dataItem);
                                        break;
                                    case "8":
                                        if(item.i_a != null)    myResults.push(dataItem);
                                        break;
                                    case "9":
                                        if(item.i_b != null)    myResults.push(dataItem);
                                        break;
                                    case "10":
                                        if(item.ii != null)    myResults.push(dataItem);
                                        break;
                                    case "11":
                                        if(item.iii_ac != null)    myResults.push(dataItem);
                                        break;
                                    case "12":
                                        if(item.iii_non_ac != null)    myResults.push(dataItem);
                                        break;
                                }
                            }
                        })
                    });
                    return {
                        results: myResults,
                    };
                },
                cache: true
            },
            escapeMarkup: function (markup) { return markup; },
            minimumInputLength: 3,
            placeholder: "Cari Layanan",
            templateResult: formatLayanan,
            templateSelection: formatLayananSelection,
        });
    }
</script>