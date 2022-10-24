<script type="text/javascript">

    function logbookDelete(id)
    {
        $('#logbook-id-del').val(id);
        $('#modal-delete').modal('show');
    }

    $(document).ready(function(){
        $('#pegawai').select2({
            ajax: {
				url: API_URL+"/pegawai/search",
				data: function (params) {
					return {
						keyword: params.term
					};
				},
				processResults: function (data) {
					var res = JSON.parse(data);
					return {
						results: $.map(res, function(obj) {
							return { id: obj.id, text: obj.name };
						})
					};
				},
				cache: true
			},
			escapeMarkup: function (markup) { return markup; },
			language: {
                searching: function(){ return "Sedang mencari..."; },
                errorLoading: function(){ return "Sedang mencari..."; },
                noResults: function (){ return "Hasil tidak ditemukan"; },
                inputTooShort: function() { return 'Pencarian minimal 2 huruf'; }
            },
            minimumInputLength: 2,
			placeholder: "Cari Pegawai"
	    });

        function formatPegawai (item) {
            if (item.loading) {
                return item.text;
            }
            var markup = item.name
            return markup;
        }

        function formatPegawaiSelection (item) {
            return item.name || item.text;
        }
    });
</script>