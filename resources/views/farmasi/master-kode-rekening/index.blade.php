@extends('farmasi.layouts.main')

@section('title')
Master Kode Rekening 
@endsection

@section('content')
<div class="block p-10">
    <div class="block-header">
        <h3 class="block-title">
            <button class="btn btn-primary new-data pull-right">Tambah Master</button>
            Daftar Kode Rekening
        </h3>
    </div>
    <div class="block-content">
        <table class="table table-bordered table-striped table-vcenter js-dataTable-full" id="example">
            <thead>
                <tr>
                    <th class="">No</th>
                    <th>Parent</th>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php $i = 1; @endphp
                @foreach($master_kode_rekening as $item)
                <tr>
                    <td class="">{{$i}}</td>
                    <td class="font-w600">{{$item->parent->kode}} - {{$item->parent->nama}}</td>
                    <td class="font-w600">{{$item->kode}}</td>
                    <td class="font-w600">{{$item->nama}}</td>
                    <td class="">
                        <button class="btn btn-sm btn-circle btn-outline-info mr-5 mb-5 edit-data" data-id="{{$item->id}}"  data-kode="{{$item->kode}}" data-nama="{{$item->nama}}" data-parent-id="{{$item->parent_id}}">
                            <i class="fa fa-edit"></i>
                        </button>
                        <button class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5 delete-data" data-id="{{$item->id}}"  data-kode="{{$item->kode}}" data-nama="{{$item->nama}}" data-parent-id="{{$item->parent_id}}">
                            <i class="fa fa-trash"></i>
                        </button>
                    </td>
                </tr>
                @php $i++; @endphp
                @endforeach
            </tbody>
        </table>
    </div>
</div>


<div id="deleteModal" class="modal fade" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Hapus Data</h4>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{url()->current()}}/delete">
                    {{csrf_field()}}
                    <input type="hidden" class="form-control input-id" name="id">
                    <div class="form-group">
                        <label>Parent Kode</label>
                        <select class="js-select2 form-control input-parent-id" style="width: 100%;" name="parent_id" disabled>
                            <option value="">Tanpa Parent</option>
                            @foreach($master_kode_rekening as $item)
                            <option value="{{$item->id}}">{{$item->kode}} - {{$item->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Kode</label>
                        <input type="text" class="form-control input-kode" name="kode" readonly>
                    </div>
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control input-nama" name="nama" readonly>
                    </div>
                    <div class="alert alert-danger">Apakah Anda Yakin? Data Tidak Bisa Dikembalikan</div>
                    <button class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="formModal" class="modal fade" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{url()->current()}}/form">
                    {{csrf_field()}}
                    <input type="hidden" class="form-control input-id" name="id">
                    <div class="form-group">
                        <label>Parent Kode</label>
                        <select class="js-select2 form-control input-parent-id" style="width: 100%;" name="parent_id">
                            <option value="">Tanpa Parent</option>
                            @foreach($master_kode_rekening as $item)
                            <option value="{{$item->id}}">{{$item->kode}} - {{$item->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Kode</label>
                        <input type="text" class="form-control input-kode" name="kode">
                    </div>
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control input-nama" name="nama">
                    </div>
                    <button class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script type="text/javascript">
    jQuery('.js-dataTable-full').dataTable({
        "ordering": true,
        pageLength: 10,
        lengthMenu: [
            [10,25,50,100],
            [10,25,50,100]
        ],
        autoWidth: false
    });

    $('.delete-data').click(function(){
        var id = $(this).data('id')
        var kode = $(this).data('kode')
        var nama = $(this).data('nama')
        var parent_id = $(this).data('parent-id')

        $('#deleteModal .input-id').val(id)
        $('#deleteModal .input-kode').val(kode)
        $('#deleteModal .input-nama').val(nama)
        $('#deleteModal .input-parent-id').val(parent_id).trigger('change')
        $('#deleteModal').modal('show');
    })

    $('.new-data').click(function(){
        $('#formModal .modal-title').html('Tambah Data')
        $('#formModal .input-id').val(0)
        $('#formModal .input-kode').val("")
        $('#formModal .input-nama').val("")
        $('#formModal .input-parent-id').val("").trigger('change')
        $('#formModal').modal('show');
    })

    $('.edit-data').click(function(){
        $('#formModal .modal-title').html('Edit Data')

        var id = $(this).data('id')
        var kode = $(this).data('kode')
        var nama = $(this).data('nama')
        var parent_id = $(this).data('parent-id')

        $('#formModal .input-id').val(id)
        $('#formModal .input-kode').val(kode)
        $('#formModal .input-nama').val(nama)
        $('#formModal .input-parent-id').val(parent_id).trigger('change')
        $('#formModal').modal('show');
    })
</script>
@endsection