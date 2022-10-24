@extends('layouts.main-dashboard')

@section('title')
Admin - Daftar Keanggotaan TNI
@endsection

@section('css')

@endsection

@section('content')

@include('admin.layouts.components.sidebar')
@include('layouts.components2.navbar-dashboard')

<div class="content" style="margin-top:50px;">
    <div class="block p-10">
        <div class="block-header">
            <h3 class="block-title">
                <small><a href="{{url('admin/tni-keanggotaan/baru')}}" class="pull-right">
                <i class="fa fa-plus-circle"></i> Input Anggota TNI Baru</a></small> 
                Daftar Anggota TNI
            </h3>
        </div>
        <form method="post" action="{{url('admin/tni-keanggotaan/mass-edit')}}" id="form-edit">
            {{csrf_field()}}
            <div class="block-content">
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full" id="example">
                    <thead>
                        <tr>
                            <th style="width:10%;text-align:center;">ID</th>
                            <th>Nama</th>
                            <th>Aksi</th>
                        </tr>
                        @foreach($anggota as $item)
                        <tr>    
                            <td>
                                <input type="text" class="form-control id" value="{{$item->id}}" disabled>
                            </td>
                            <td>
                                <input type="text" class="form-control nama" value="{{$item->nama}}">
                            </td>
                            <td>
                                <a href="#deletemodal" class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5" data-toggle="modal" data-id="{{$item->id}}" data-nama="{{$item->nama}}">
                                <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </thead>
                </table>
                <div class="form-group text-center">
                    <button class="btn btn-alt btn-primary btn-hero m-0" type="button" id="button_submit">Simpan</button>
                    <button class="btn btn-alt btn-primary btn-hero m-0 disabled" id="button_loading" style="display: none"><i class="fa fa-spinner fa-spin"></i> Loading</button>
                </div>
            </div>
            <input type="hidden" name="id_diganti[]" id="id_diganti">
            <input type="hidden" name="nama_baru[]" id="nama_baru">
        </form>
    </div>
</div>
<div id="deletemodal" class="modal fade" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Hapus Data</h4>
            </div>
            <div class="modal-body">
                <p id="show-name"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <a id="del-btn">
                    <button type="button" class="btn btn-danger pull-right" style="margin-left: 4px ;">Hapus</button>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')



<script type="text/javascript">
    var id_diganti = []; //id terganti
    var nama_baru = []; //nama baru
    var id_cek;
    $('.nama').on('change', function() {
        var id = ambilId($(this));
        var nama = $(this).val();
        id_cek = id;
        var id_ada = id_diganti.findIndex(checkExist);
        console.log(id_ada);
        if(id_ada != -1)
        {   
            console.log('abc');
            hapusValue(id_ada);
        }
        pushBaru(id,nama);
    });
    function hapusValue(index)// hapus value di array sebelumnya
    {   
        console.log(index);
        id_diganti.splice(index,1);
        nama_baru.splice(index,1);
        console.log(id_diganti,nama_baru);
    }
    function ambilId(item)//ambil id
    {
        var temp = item.parent().siblings()[0]; //sibling id
        var temp2 = $(temp).children()[0]; //child id
        var temp3 = $(temp2).val(); //val id
        return temp3;
    }
    function checkExist(element) //check sudah pernah di edit belm
    {
        console.log(id_cek,element);
        return element == id_cek;
    }
    function pushBaru(id,nama,checkbox) //push ke item ke global variable
    {
        id_diganti.push(id);
        nama_baru.push(nama);
        console.log(id_diganti,nama_baru);
    }

    function deleteModal(id)
    {
        swal({
            title: 'Apakah Anda Yakin?',
            text: "Kotama TNI akan dihapus.",
            type: 'warning',
            showCancelButton: true,
            confirmButtonClass: 'btn btn-secondary',
            cancelButtonClass: 'btn btn-danger',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batalkan'
        }).then((result) => {
            if (result.value) {
                swal(
                    'Sukses!',
                    'Kotama berhasil dihapus.',
                    'success'
                    )
            }
        })

    }
    $(document).on("click",".btn-outline-danger", function () {
        var id = $(this).data('id');
        var nama = $(this).data('nama');
        console.log(id,nama);
        $("#del-btn").attr('href','{{url('admin/tni-keanggotaan/delete')}}' + '/' + id)
        $("#show-name").html('Anda yakin ingin menghapus data Keanggotaan TNI ' + nama + '?')

    })
    $(document).on('click','#button_submit', function() {
        $('#button_loading').show();
        $('#button_submit').hide();
        $('#id_diganti').val(id_diganti); //push value ke backend
        $('#nama_baru').val(nama_baru); //push value ke backend
        $('#form-edit').submit();
    })
</script>

@endsection