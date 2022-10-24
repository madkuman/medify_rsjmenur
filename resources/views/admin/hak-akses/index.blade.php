@extends('layouts.main-dashboard')

@section('title')
Admin - Hak Akses User
@endsection

@section('css')
<link rel="stylesheet" href="{{asset('assets/js/plugins/datatables/dataTables.bootstrap4.min.css')}}">
@endsection

@section('content')

@include('admin.layouts.components.sidebar')
@include('layouts.components2.navbar-dashboard')

<div class="content" style="margin-top:50px;">
	<div class="block p-10"  >
		<div class="block-header">
			<h3 class="block-title">
                Daftar Hak Akses User
                <small>
                    <a href="javascript:void(0)" class="pull-right" id="add-akses-btn">
                        <i class="fa fa-plus-circle"></i> Tambahkan Hak Akses Baru
                    </a>
                </small>
			</h3>
		</div>
		<div class="block-content">
			<table class="table table-bordered table-striped table-vcenter js-dataTable-full" id="akses-table">
				<thead>
					<tr class="text-center">
						<th width="10%">No</th>
						<th>Nama</th>
						<th width="40%">Hak Akses</th>
						<th width="20%">Aksi</th>
					</tr>
                </thead>
			</table>
		</div>
	</div>
</div>

<div id="add-akses" class="modal fade" role="dialog">
    <div class="modal-dialog modal-bg" role="document">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="POST" action="#" id="add-akses-form">
                    {{ csrf_field() }}
                    <div class="modal-title font-size-lg font-w600">
                        <span>Tambahkan</span> Hak Akses User
                        <hr style="border-top: 2px solid #0b72c6">
                    </div>
                    <div class="modal-body px-0">
                        <div class="form-group">
                            <label>Pilih User</label>
                            <select name="user_id" class="js-select2 form-control" style="width: 100%">
                                <option value="" selected disabled>Cari User</option>
                                @foreach ($user_all as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group row">
                            <label class="col-12">Pilih Hak Akses</label>
                            @foreach($master_hak_akses as $item)
                            <div class="col-12 col-md-6">
                                <label class="css-control css-control-primary css-checkbox">
                                    <input type="checkbox" name="hak_akses[]" class="css-control-input checkbox-akses {{$item->slug}}" value="{{$item->id}}">
                                    <span class="css-control-indicator"></span> {{$item->nama_akses}}
                                </label>
                            </div>
                            @endforeach
                        </div>
                        <p class="mb-0 text-danger error-alert error-select-akses hide">* Pilih user untuk hak akses</p>
                        <p class="mb-0 text-danger error-alert error-checkbox-akses hide">* Centang salah satu dari hak akses</p>
                    </div>
                    <div class="modal-footer px-0">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        <button type="button" class="btn btn-primary btn-click-animate" id="submit-btn"><i class="fa fa-check"></i> Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{asset('assets/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script type="text/javascript">
var userdata = [];
$(document).ready(function() {
    table.draw();
});

var table = $('#akses-table').DataTable({
    ordering: true,
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
        url: '{{ url()->current() }}/data'
    },
    columns: [
    { data: 'id', name: 'id', className: 'text-center', 
        render: function(data, type, row, meta){
            return meta.row + meta.settings._iDisplayStart + 1;}
        },
    { data: 'name', name: 'name', className: 'font-w600' },
    { data: 'hak_akses', name: 'hak_akses', className: 'text-center', sortable: false,
        render: function(data, type, row, meta){
            userdata[row.id] = [];
            console.log(data);
            content = '';
            $.each(data, function(i, item) {
                console.log(i,item)
                userdata[row.id].push(item);
                roles = item.replace(/-/g, ' ').replace('admin ', '').replace('keu', 'keuangan');
                content += '<span class="badge badge-primary mr-10" style="text-transform: uppercase">'+roles+'</span>';
            });
            return content;
        }
    },
    { data: 'name', name: 'name', className: 'text-center', sortable: false,
        render: function(data, type, row, meta){
            console.log(row);
            content = `<button type="button" class="btn btn-sm btn-circle btn-outline-info mr-10" onclick="editAkses(${row.id})" title="Edit Akses">
                            <i class="fa fa-pencil"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-circle btn-outline-danger" onclick="deleteAkses(${row.id})" title="Hapus Akses">
                            <i class="fa fa-times"></i>
                        </button>`;
            return content;
        },
    },
    ],
    order: [[ 0, "asc" ]]
});


$(".filter-status").on('change', function(){
    filter_status = this.value;
    userdata = [];
    table.draw(true);
});


function editAkses(id)
{
    var user_roles = userdata[id];
    $('#add-akses').find('.checkbox-akses:checked').prop('checked', false);
    
    @foreach($master_hak_akses as $item)
    if (user_roles.includes('{{$item->slug}}'))
        $('#add-akses').find(`.{{$item->slug}}`).prop('checked', true);
    @endforeach
    $('#add-akses').find('select[name=user_id]').val(id).trigger('change');
    $('#add-akses').find('.modal-title span').text('Edit');
    $('#add-akses').modal('show');
    console.log(userdata);
}

function deleteAkses(id)
{	
    swal({
        title: 'Apakah Anda Yakin?',
        text: "Menghapus Hak Akses User",
        type: 'warning',
        showCancelButton: true,
        confirmButtonClass: 'btn btn-secondary',
        cancelButtonClass: 'btn btn-danger',
        confirmButtonText: 'Ya, Hapus Akses!',
        cancelButtonText: 'Batalkan',
        showLoaderOnConfirm: true,
        preConfirm: function() {
            return new Promise(function(resolve) {
                $.ajax({
                    type: "GET",
                    url: "{{ url()->current() }}/hapus/" + id,
                    dataType: "json",
                    success: function (data) {
                        userdata = [];
                        table.draw(true);
                        callSwal(data.type,data.title,data.text,0);
                    },
                    error: function () {
                        callSwal('error','Penghapusan Akses Gagal','Silahkan Coba Lagi',0);
                    }
                })
            });
        }
    })

}

$(document).on('click', '#add-akses-btn', function () {
    $('#add-akses').find('.checkbox-akses:checked').prop('checked', false);
    $('#add-akses').find('select[name=user_id]').val("").trigger('change');
    $('#add-akses').find('.modal-title span').text('Tambahkan');
    $('#add-akses').modal('show');
})

$(document).on('click', '#submit-btn', function () {
    $('.error-alert').hide();
    checkbox_akses = $('.checkbox-akses:checked');
    if (checkbox_akses.length == 0) {
        $('#add-akses-form').unbind('submit');
        $('.error-checkbox-akses').show();
    }
    if ($('select[name=user_id]').val() == null) {
        $('.error-select-akses').show();
    }
    if (checkbox_akses.length > 0 && $('select[name=user_id]').val() != null) {
        $(this).prop('disabled', true);
        $('#submit-btn').children('i').toggleClass('fa-spin fa-spinner','fa-check');
        $.ajax({
            type: "POST",
            url: "{{ url()->current() }}/add",
            dataType: "json",
            data: $('#add-akses-form').serialize(),
            success: function (data) {
                userdata = [];
                $(this).prop('disabled', false);
                $('#add-akses').modal('hide');
                $('select[name=user_id]').val('').trigger('change')
                table.draw(true);
                callSwal(data.type,data.title,data.text,0);
                $('#add-akses-form').unbind('submit');
                $('#submit-btn').children('i').toggleClass('fa-spin fa-spinner','fa-check');
                $('#submit-btn').prop('disabled', false);
            },
            error: function () {
                callSwal('error','Penghapusan Akses Gagal','Silahkan Coba Lagi',0);
                $('#submit-btn').children('i').toggleClass('fa-spin fa-spinner','fa-check');
                $('#submit-btn').prop('disabled', false);
            }
        })
    }
})
</script>
@endsection