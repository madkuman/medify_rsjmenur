<script type="text/javascript">
	function initHistoriResep(element_name, pasien_id)
	{
		element = $(element_name);
        element.html(`@include("farmasi.js-features.histori-resep.view-table")`);

        element.slimScroll({
            height: '400px', 
            color: '#416dea',
            alwaysVisible: true
        });

		element.find('.loading-histori').show();
         $.ajax({
            url: API_URL + '/farmasi/histori-resep/get/'+pasien_id,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if(response == null) return;
                var data = response.data
                content = '';
                $.each(data, function( index, item ) {
                    if(item.colspan != 1)
                    {
                        td_item = `<td colspan="`+item.colspan+`">`+item.nama+`</td>`
                    }
                    else
                    {
                        td_item = `
                            <td width="5%">`+item.nomor+`</td>
                            <td width="29%">`+item.nama+`</td>
                            <td width="26%">`+item.jumlah+` `+item.satuan+`</td>
                            <td width="40%">`+item.signa+`</td>
                        `
                    }

                    content += `
                        <tr class="`+item.trclass+`">
                            `+td_item+`
                        </tr>
                    `
                });

                var pasien_nama = response.pasien;

                element.find('tbody').html(content);
                element.find('.loading-histori').hide();   
                element.find('.nama-pasien').html(pasien_nama)
                return;
            },
            error: function() {
                this.tryCount++;
                if (this.tryCount <= this.retryLimit) {
                    $.ajax(this);
                    return;
                }
                element.find('.loading-histori').hide();   
                element.find('.error-loading-histori').show();       
                return;
                
            },
        })
	}
</script>