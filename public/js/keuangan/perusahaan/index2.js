$(document).on('click', '.remove', function(){
    var id = $(this).data("pk")     
    swal({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
        showLoaderOnConfirm: true,
        preConfirm: function() {
            return new Promise(function(resolve) {
                $.ajax({
                    type: "POST",
                    url: API_URL + "/keuangan/pengaturan/rekanan/delete",
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        id : id
                    },
                    success: function (data) {
                        table.destroy();
                        callSwal(data.type,data.title,data.text,0);
                        filter="unpaid";
                        draw(filter,null,null);
                    },
                    error: function () {
                        callSwal('error','Gagal','Silahkan Coba Lagi',0);
                    }
                })
            });
        }
    })
});

var table;
function draw(){
    table = $('#indexTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            type: "GET",
            dataType: "json",
            url: API_URL + "/keuangan/pengaturan/rekanan/get",
        },
        columns: [
            { data: 'DT_Row_Index', name: 'DT_Row_Index'},
            { data: 'nama', name: 'nama'},
            { data: 'direktur', name: 'direktur'},
            { data: 'alamat', name: 'alamat'},
            { data: 'id', name: 'id', className: 'text-center', 
                render: function(data, type, row, meta){
                    data = '<a href="rekanan/edit/'+data+'" class="btn btn-sm btn-alt-warning" data-toggle="tooltip" title="Edit Rekanan">&nbsp;<i class="fa fa-edit"></i></a>&nbsp;<button class="btn btn-sm btn-alt-danger remove" id="remove" data-pk="'+data+'" data-toggle="tooltip" title="Hapus Rekanan">&nbsp;<i class="fa fa-trash"></i></button>&nbsp;';
                    
                    return data;
                },
                searchable: false,
                sortable: false
            }
        ]
    });
}
$(document).ready(function() {
    draw();
});