<script src="{{asset('assets/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>

<script type="text/javascript">
	jQuery('.js-dataTable-full').dataTable({
		"ordering": true,
		pageLength: 8,
		lengthMenu: [[5, 8, 15, 20], [5, 8, 15, 20]],
		autoWidth: false
	});

	$(document).on("click",".btn-outline-danger", function () {
			var url = $(this).data('url');
			var nama = $(this).data('nama');
			$(".selected").removeClass("selected");
			$(this).parent().parent().addClass("selected");
			$('#form_delete').attr('action',url);
			$("#show-name").html('Anda yakin ingin menghapus data Kualifikasi ' + nama + '?')

		})

    $('.btn-tambah').click(function(){
			$(".selected").removeClass("selected");
			$(this).parent().parent().addClass("selected");
			var url =  $(this).data('url');
			$('#form_tambah').attr('action',url);
		});

		$('.btn-outline-info').click(function(){
			var url =  $(this).data('url');
			getData(url);
			$(".selected").removeClass("selected");
			$(this).parent().parent().addClass("selected");
			$('#form-edit').attr('action',url);
		});

		function getData(url) {
        $.ajax({
            type: "GET",
            url: url,
			beforeSend:function() {
					$('#loading').removeClass('d-none');
					$('#edit-content').addClass('d-none');
				},
            success: function(data){
                $('#form-edit #nama').val(data.nama);
				$('#loading').addClass('d-none');
				$('#edit-content').removeClass('d-none');
            },
        });
    }
</script>