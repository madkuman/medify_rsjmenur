@extends('layouts.main-dashboard')

@section('title')
Admin - Daftar Kotama TNI
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
                <small>
                    <a href="{{url('admin/tni-kotama/baru')}}" class="pull-right">
                        <i class="fa fa-plus-circle"></i> Input Kotama TNI Baru
                    </a>
                </small> 
                Daftar Kotama TNI
            </h3>
        </div>
        <div id="kotama-search">    
            <form method="post" action="{{url('admin/tni-kotama/mass-edit')}}" id="form-edit">
                {{csrf_field()}}
                <div class="block-content">
                    <label>
                        Search :
                        <input type="search" class="form-control form-control-sm search mb-15"> 
                    </label>
                    <table class="table table-bordered table-striped table-vcenter" id="example">
                        <thead>
                            <tr>
                                <th style="width:10%;text-align:center;">ID</th>
                                <th>Nama</th>
                                <th>Kode</th>
                                <th>Print</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            @foreach($kotama as $item)
                            <tr>    
                                <td>
                                    <input type="text" class="form-control id" value="{{$item->id}}" disabled>
                                </td>
                                <td class="nama-kotama">
                                    <input type="text" class="form-control nama" value="{{$item->nama}}">
                                </td>
                                <td class="kode-kotama">
                                    <input type="text" class="form-control kode" value="{{$item->kode}}">
                                </td>
                                <td class="text-center">
                                    <label class="css-control css-control-lg css-control-primary css-checkbox" style="display: inline !important;">
                                        <input type="checkbox" class="form-control checkbox css-control-input" @if($item->cetak == 1) checked value="1" @else value="0" @endif>
                                        <span class="css-control-indicator"></span>
                                    </label>
                                </td>
                                <td>
                                    <a href="{{url('admin/tni-satker/kotama').'/'.$item->id}}" class="btn btn-sm btn-circle btn-outline-primary mr-5 mb-5" data-toggle="tooltip" data-placement="top" title="Lihat Satker dari Kotama Ini">
                                        <i class="fa fa-search"></i>
                                    </a>
                                    <a href="#deletemodal" class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5" data-toggle="modal" data-id="{{$item->id}}" data-nama="{{$item->nama}}" data-toggle="tooltip" data-placement="top" title="Hapus">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="form-group text-center">
                        <button class="btn btn-alt btn-primary btn-hero m-0" type="button" id="button_submit">Simpan</button>
                        <button class="btn btn-alt btn-primary btn-hero m-0 disabled" id="button_loading" style="display: none"><i class="fa fa-spinner fa-spin"></i> Loading</button>
                    </div>
                </div>
                <input type="hidden" name="id_diganti[]" id="id_diganti">
                <input type="hidden" name="nama_baru[]" id="nama_baru">
                <input type="hidden" name="kode_baru[]" id="kode_baru">
                <input type="hidden" name="flag_print[]" id="flag_print">
            </form>
        </div>
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


<script src="{{asset('assets/js/plugins/listjs/list.min.js')}}"></script>
<script type="text/javascript">
    var id_diganti = []; //id terganti
    var nama_baru = []; //nama baru
    var flag_print = [];
    var kode_baru = [];
    var id_cek;
    $('.nama').on('change', function() {
        var id = ambilId($(this));
        var nama = $(this).val();
        var kode = ambilKodeNama($(this));
        var checkbox = ambilCheckbox($(this));
        id_cek = id;
        var id_ada = id_diganti.findIndex(checkExist);
        if(id_ada != -1)
        {   
            hapusValue(id_ada);
        }
        pushBaru(id,nama,kode,checkbox);
    });
    $('.kode').on('change', function() {
        var id = ambilId($(this));
        var nama = ambilNama($(this));
        var kode = $(this).val();
        var checkbox = ambilCheckbox($(this));
        id_cek = id;
        var id_ada = id_diganti.findIndex(checkExist);
        if(id_ada != -1)
        {   
            hapusValue(id_ada);
        }
        pushBaru(id,nama,kode,checkbox);
    });
    $('.checkbox').on('change', function() {
        var id = ambilIdCB($(this));
        var nama = ambilNamaCB($(this));
        var kode = ambilKodeCheckbox($(this));
        if($(this).is(':checked'))
        {
            var checkbox = 1;
            $(this).val(checkbox);
        }
        else
        {
            var checkbox = 0;
            $(this).val(checkbox);
        }
        id_cek = id;
        var id_ada = id_diganti.findIndex(checkExist);
        if(id_ada != -1)
        {   
            hapusValue(id_ada);
        }
        pushBaru(id,nama,kode,checkbox);
    })
    function hapusValue(index)// hapus value di array sebelumnya
    {   
        id_diganti.splice(index,1);
        nama_baru.splice(index,1);
        kode_baru.splice(index,1);
        flag_print.splice(index,1);
    }
    function ambilNama(item)
    {
        var temp = item.parent().siblings()[1]; //sibling nama
        var temp2 = $(temp).children()[0]; //child nama
        var temp3 = $(temp2).val(); //val nama
        return temp3;
    }
    function ambilNamaCB(item)
    {
        var temp = item.parent().parent().siblings()[1]; //sibling nama
        var temp2 = $(temp).children()[0]; //child nama
        var temp3 = $(temp2).val(); //val nama
        return temp3;
    }
    function ambilIdCB(item)//ambil id dari checkbox
    {   
        var temp = item.parent().parent().siblings()[0]; //sibling id
        var temp2 = $(temp).children()[0]; //child id
        var temp3 = $(temp2).val(); //val id
        return temp3;
    }

    function ambilId(item)//ambil id
    {   
        var temp = item.parent().siblings()[0]; //sibling id
        var temp2 = $(temp).children()[0]; //child id
        var temp3 = $(temp2).val(); //val id
        return temp3;
    }

    function ambilKodeNama(item)//ambil id
    {   
        var temp = item.parent().siblings()[1]; //sibling id
        var temp2 = $(temp).children()[0]; //child id
        var temp3 = $(temp2).val(); //val id
        return temp3;
    }
    function ambilKodeCheckbox(item)//ambil id
    {   
        var temp = item.parent().parent().siblings()[2]; //sibling nama
        var temp2 = $(temp).children()[0]; //child nama
        var temp3 = $(temp2).val(); //val namad
        return temp3;
    }
    //ambil checkbox
    function ambilCheckbox(item)
    {
        var temp = item.parent().siblings()[2]; //sibling checkbox
        var temp2 = $(temp).children().children()[0] //child checkbox
        var temp3 = $(temp2).val(); //val checkbox
        return temp3;
    }
    function checkExist(element) //check sudah pernah di edit belm
    {
        return element == id_cek;
    }
    function pushBaru(id,nama,kode,checkbox) //push ke item ke global variable
    {
        id_diganti.push(id);
        nama_baru.push(nama);
        kode_baru.push(kode);
        flag_print.push(checkbox);
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
        $("#del-btn").attr('href','{{url('admin/tni-kotama/delete')}}' + '/' + id)
        $("#show-name").html('Anda yakin ingin menghapus data Kotama TNI ' + nama + '?')

    })

    $(document).on('click','.btn-outline-info', function() {
        var id = $(this).data('id');
        var nama = $($(this).parent().siblings().children()[1]).val();
    })
    $(document).on('click','#button_submit', function() {
        $('#button_loading').show();
        $('#button_submit').hide();
        $('#id_diganti').val(id_diganti); //push value ke backend
        $('#nama_baru').val(nama_baru); //push value ke backend
        $('#kode_baru').val(kode_baru); //push value ke backend
        $('#flag_print').val(flag_print); //push value ke backend
        $('#form-edit').submit();
    })
</script>
<script type="text/javascript">
    var options = {
      valueNames: [ 'nama-kotama' ]
  };
  var kotamaSearchList = new List('kotama-search', options);
</script>
@endsection