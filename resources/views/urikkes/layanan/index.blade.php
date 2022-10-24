@extends('urikkes.layouts.main')

@section('title')
Urikkes - Medify
@endsection

@section('content')
<main id="main-container">
    <div class="container">

        <div class="row mt-50 mb-20">
            <div class="col-12">
                <button class="btn btn-primary pull-right mt-10 modal-show" data-toggle="modal" data-target="#modal">+ Buat Baru</button>
                <h1><span class="font-w600">Unit Pemeriksaan Kesehatan</span> </h1>
            </div>
        </div>
        <div class="row gutters-tiny" >
            <div class="col-12">
                <div class="block block-bordered">
                    <div class="block-content block-content-full">
                        <table class="table table-striped table-hover table-pointer "> 
                            <thead>
                                <tr class="header">
                                    <th style="width:5%">#</th>
                                    <th style="width:50%">Nama</th>
                                    <th style="width:13%">Kode</th>
                                    <th style="width:20%">Harga</th>
                                    <th style="width:12%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($layanan as $item)
                                <tr class="clickable">
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->nama}}</td>
                                    <td>{{$item->kode}}</td>
                                    <td>{{$item->harga}}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-primary modal-show" id="edit" data-item="{{$item}}" data-toggle="modal" data-target="#modal">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-danger delete" id="deleteLayanan" data-item="{{$item}}">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="modal" class="modal fade " role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content ">
                <form method="post" action="{{url('urikkes/layanan/save')}}">
                    {{ csrf_field() }}
                    <input type="text" id="modal-id" name="layanan_id" class="form-control" hidden="">
                    <div class="modal-body">
                        <div id="modal-title" name="modal-title" class="font-size-lg font-w600 mb-20">Pilih Layanan</div>
                        <div class="form-group">
                            <label class="control-label">Nama</label>
                            <input type="text" id="nama-modal" name="nama" class="form-control">
                        </div>

                        <div class="form-group">
                            <label class="control-label">Kode</label>
                            <input type="text" id="kode-modal" name="kode" class="form-control">
                        </div>


                        <div class="form-group">
                            <label class="control-label">Harga</label>
                            <input type="text" id="harga-modal" name="harga" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <input type="submit" class="btn btn-success" id="addButton">
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

@endsection

@section('js')
<script type="text/javascript">
$(document).ready(function(){
    $("#deleteLayanan").on("click",function(e) {
        var item = $(this).data('item');
        e.preventDefault(); // cancel the link itself
        hapusConfirm(item);
        //nggawe ajax
      });

    function hapusConfirm(item) {
        swal(
        {
            title:"Hapus "+item.nama+"?", 
            text:"Data layanan "+item.nama+" akan dihapus. Yakin ingin menghapus "+item.nama+"?", 
            type: "warning",
            showCancelButton: true,
            cancelButtonText: 'Hapus!',
            confirmButtonText: "Batal",
            dangerMode: true,
            closeOnConfirm: false,
            closeOnCancel: false
        }).then(function(isCancel) {
            if (isCancel) {
                hapus(item);
            }
        });
    }

    function hapus(item) {
            $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });

          $.ajax({
            type:'POST',
            url:'{{url("urikkes/layanan/delete")}}',
            data: {
              "_token": "{{ csrf_token() }}",
              "layanan_id": item.id
            },
            success:function(data){
                console.log('cook');
              swal(
                {
                    title:"Berhasil!", 
                    text:"Data layanan dari paket "+item.nama+" berhasil dihapus.", 
                    type:"success",
                    timer:3000,
                }).then(function() {
                        // console.log(data);
                        location.href = '{{url('urikkes/layanan')}}';
                });
            },
            error:function(data){
              console.log(data);
              swal(
                {
                   type: "error", 
                   title: "Gagal|",
                   text: "Data layanan dari paket "+item.nama+" gagal dihapus",
                    timer:3000,
                });
            }
          });
    }
});
    
$(document).on("click", ".modal-show", function () {
    var item = $(this).data('item');
    if(item !== undefined){
        $('#modal-id').val(item.id);
        $('#modal-title').text('Ubah Data Layanan');
        $('#nama-modal').val(item.nama);
        $('#kode-modal').val(item.kode);
        $('#harga-modal').val(item.harga);
        $('#addButton').val('Simpan');
    }else{
        $('#modal-id').val(0);
        $('#modal-title').text('Tambahkan Layanan Baru');
        $('#nama-modal').val('');
        $('#kode-modal').val('');
        $('#harga-modal').val('');
        $('#addButton').val('Tambah');
    }
});

</script>
@endsection