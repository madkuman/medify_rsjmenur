<script type="text/javascript">
    function jsonFormatHtml(json) {
        if (typeof json != 'string') {
            json = JSON.stringify(json, undefined, 2);
        }
        json = JSON.parse(json);
        html = jsonFormatHtmlProcessArray('',json);
        return html;
    }

    function jsonFormatHtmlProcessArray(key,data)
    {
        if (typeof jsonFormatterNumberParse  === 'undefined') {
            jsonFormatterNumberParse = [];
        }

        html = ''
        $.each(data, function( index, item ) {
            if(typeof item === 'object')
            {
                var index_text = index + ' ';
                html += jsonFormatHtmlProcessArray(index_text,item)
            }
            else
            {
                if(jsonFormatterNumberParse.includes(index))
                {
                    item_text = numeral(item).format('0,0')
                }
                else item_text = item;

                html += `<tr class="json-item-container">
                    <td class="key">`+key+index+`</td>
                    <td class="value">`+item_text+`</td>
                </tr>`;
            }
        })
        return html;
    }
</script>