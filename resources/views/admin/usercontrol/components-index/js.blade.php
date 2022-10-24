
<script src="{{asset('assets/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>

<script type="text/javascript">

	var filter_profesi='all';
	var filter_special;
	var filter_status = 'all';
	var auth = {{Auth::user()->id}}

	$(document).ready(function() {
		table.draw();
	});

	var table = $('#tableUser').DataTable({
		"ordering": true,
		pageLength: 8,
		lengthMenu: [[5, 8, 15, 20], [5, 8, 15, 20]],
		autoWidth: false,
		processing: true,
		serverSide: true,
		language: {
            processing: '<div class="panel panel-default"><i class="fa fa-4x fa-gear fa-spin text-info"></i></div>'
        },
		ajax: {
			type: "GET",
			dataType: "json",
			url: API_URL + '/admin/user-control/load-table',
			data: function(d) {
				d.profesi = filter_profesi;
				d.special = filter_special;
				d.status = filter_status;
			}
		},
		columns: [
		{ data: 'id', name: 'id', 
		render: function(data, type, row, meta){
			return meta.row + meta.settings._iDisplayStart + 1;}
		},
		{ data: 'name', name: 'name', className: 'font-w600' },
		{ data:null, name:'profesi',
			render: function(data, type, row){
				var profesi = '';

				if(data.profesi_detail != null)
					profesi = data.profesi_detail.title;

				return (profesi ?? '-')
			}
		},
		{ data: null, name: 'admin',
			render: function(data,type,row){
				if(data.admin == 1)
					return '<i class="fa fa-check"></i>';
				else
					return '';
			}
		},
		{ data: null, name: 'last_login_at',
			render: function(data,type,row){
		        if(data.last_login_at){
                    date = moment(data.last_login_at);
                    return date.format('D-MM-YYYY');
                }
                else{
                    return '';
                }
			}
		},
		{ data: null, name: 'flag', className: 'text-center',
			render: function ( data ) {
				if (data.flag == 1) {
					content = `<div class="badge badge-primary" href="javascript:void(0)">Aktif</div>`;
				} else {
					content = `<div class="badge badge-danger" href="javascript:void(0)">Tidak Aktif</div>`;
				}
				return content;
			}
		},
		{ data: null, name: 'flag',
		render: function (data, type, row, meta) {
			content = `<button type="button" class="btn btn-alt-primary btn-square dropdown-toggle" id="page-header-options-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                	&nbsp;&nbsp;Aksi
            	</button>
            	<div class="dropdown-menu" aria-labelledby="page-header-options-dropdown" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 34px, 0px); top: 0px; left: 0px; will-change: transform;">`
			if (data.flag == 1) {
				content += `
				<a href="javascript:void(0)" id="deaktif_`+row.id+`" data-id="`+row.id+`" class="btn dropdown-item btn-danger btn-outline-danger  deaktif">Deaktifkan Akun</a>
				<a href="javascript:void(0)" id="reset_`+row.id+`" data-id="`+row.id+`" class="btn dropdown-item btn-danger btn-outline-success  reset">Reset Password</a>
				`;
			} else {
				content += `<a href="javascript:void(0)" data-id="`+row.id+`" class="btn dropdown-item btn-info btn-outline-info  aktif">Aktifkan Akun</a>`;
			}
			content+=`<a class="btn dropdown-item " href="{{url('`+modules+`/user-control/`+data.id+`/edit')}}">Edit Akun</a>`;
			if(auth == 3)
			{
                content+=`<a class="btn dropdown-item " href="{{url('`+modules+`/user-control/`+data.id+`/bypass-login')}}">Bypass Login</a>`;
            }
			content+=`</div>`;
			return content;},
			searchable: false,
			sortable: false
		},
		],
		order: [[ 0, "asc" ]]
	});

	$('#tableUser tbody').on('click','.deaktif',function(){
		deleteModal($(this).data('id'));
	});
	$('#tableUser tbody').on('click','.aktif',function(){
		aktifModal($(this).data('id'));
	});
	$('#tableUser tbody').on('click','.reset',function(){
		resetModal($(this).data('id'));
	});

	$('#tableUser tbody').on('click','.masa-berlaku',function(){
		$('#modal-berlaku').modal('show');
		$('#id_masa_aktif').val($(this).data('id'));
	});

	$(".filter-profesi").on('change', function(){
		filter_profesi = this.value;
		table.draw(true);
	});

	$(".filter-special").on('change', function(){
		filter_special = this.value;
		table.draw(true);
	});

	$(".filter-status").on('change', function(){
		filter_status = this.value;
		table.draw(true);
	});
	
	
	function deleteModal(id)
	{	
		swal({
			title: 'Apakah Anda Yakin?',
			text: "User akan menjadi tidak aktif",
			type: 'warning',
			showCancelButton: true,
			confirmButtonClass: 'btn btn-secondary',
			cancelButtonClass: 'btn btn-danger',
			confirmButtonText: 'Ya, Deaktifkan!',
			cancelButtonText: 'Batalkan',
			showLoaderOnConfirm: true,
			preConfirm: function() {
				return new Promise(function(resolve) {
					$.ajax({
						type: "GET",
						url: API_URL + "/admin/user-control/deaktif/" + id,
						dataType: "json",
						success: function (data) {
							table.draw(false);
							callSwal(data.type,data.title,data.text,0);
						},
						error: function () {
							callSwal('error','Transaksi Gagal','Silahkan Coba Lagi',0);
						}
					})
				});
			}
		})

	}
	function aktifModal(id)
	{
		swal({
			title: 'Apakah Anda Yakin?',
			text: "User akan menjadi aktif",
			type: 'warning',
			showCancelButton: true,
			confirmButtonClass: 'btn btn-secondary',
			cancelButtonClass: 'btn btn-danger',
			confirmButtonText: 'Ya, Aktifkan!',
			cancelButtonText: 'Batalkan',
			showLoaderOnConfirm: true,
			preConfirm: function() {
				return new Promise(function(resolve) {
					$.ajax({
						type: "GET",
						url: API_URL + "/admin/user-control/aktif/" + id,
						dataType: "json",
						success: function (data) {
							table.draw(false);
							callSwal(data.type,data.title,data.text,0);
						},
						error: function () {
							callSwal('error','Transaksi Gagal','Silahkan Coba Lagi',0);
						}
					})
				});
			}
		})

	}
	function resetModal(id)
	{
		swal({
			title: 'Apakah Anda Yakin?',
			text: "Password User akan direset menjadi '123456'",
			type: 'warning',
			showCancelButton: true,
			confirmButtonClass: 'btn btn-secondary',
			cancelButtonClass: 'btn btn-danger',
			confirmButtonText: 'Ya, Reset!',
			cancelButtonText: 'Batalkan',
			showLoaderOnConfirm: true,
			preConfirm: function() {
				return new Promise(function(resolve) {
					$.ajax({
						type: "GET",
						url: API_URL + "/admin/user-control/reset/" + id,
						dataType: "json",
						success: function (data) {
							table.draw(false);
							callSwal(data.type,data.title,data.text,0);
						},
						error: function () {
							callSwal('error','Transaksi Gagal','Silahkan Coba Lagi',0);
						}
					})
				});
			}
		})

	}

</script>
