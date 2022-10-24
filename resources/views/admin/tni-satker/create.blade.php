@extends('layouts.main-dashboard')

@section('title')
Admin - 
    @if(empty($data))
    Input Satker TNI Baru
    @else
    Edit Satker TNI
    @endif
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
                @if(empty($data))
                Input Satker TNI Baru
                @else
                Edit Satker TNI
                @endif
            </h3>
        </div>
        <div class="block-content">
            <!--ketika dikoding ini diganti ya action sama methodnya -->
            <form action="{{url('admin/tni-satker/mass-simpan')}}" method="POST">
            {{csrf_field()}}         
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <div class="row gutters-tiny">
                                <div class="form-group col-12">
                                    <div class="row">
                                        <div class="col-4">
                                            <label>Kotama</label>
                                            <select class="form-control col-12 select-2"name="kotama_id[]">
                                                <option value=""></option>
                                                @foreach($kotama_list as $kotama)
                                                    <option value="{{ $kotama->id }}"
                                                        @if(!empty($data) && $data->kotama_id == $kotama->id)
                                                            selected
                                                        @endif >{{ $kotama->nama }}</option>
                                                @endforeach
                                            </select>    
                                        </div>
                                        <div class="col-4">
                                            <label>Nama</label>
                                            <div class="" style="margin-bottom: 6px !important;">
                                                <input type="text" class="form-control" name="nama[]">
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <label>Kode</label>
                                            <div class="" style="margin-bottom: 6px !important;">
                                                <input type="text" class="form-control" name="kode[]">
                                            </div>
                                        </div>
                                        <div class="col-1 text-center" style="padding-top:25px;">
                                            <button type="button" class="btn btn-circle btn-outline-danger mr-5 mb-5 btnRemove" disabled>
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                    @include('admin.tni-satker.isian')
                                    @include('admin.tni-satker.isian')
                                    @include('admin.tni-satker.isian')
                                    @include('admin.tni-satker.isian')
                                </div>
                            </div>
                            <div class="row gutters-tiny" id="container-new-form">

                            </div>
                            <div class="form-group text-center" style="margin-top: 25px !important;">
                                <div class="row">
                                    <div class="col-10">
                                        <button type="button" class="btn btn-circle btn-outline-primary mr-5 mb-5" id="buttonAdd"><i class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-info btn-hero pull-right">Simpan</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')



<script type="text/javascript">
    jQuery('.js-dataTable-full').dataTable({
        "ordering": true,
        pageLength: 8,
        lengthMenu: [[5, 8, 15, 20], [5, 8, 15, 20]],
        autoWidth: false
    });

    $('.select-2').select2();

    $('#buttonAdd').click(function(){
        content = `
        <div class="form-group col-12">
            <div class="row">
                <div class="col-6">
                    <label>Kotama</label>
                    <select class="form-control col-12 select-2"name="kotama_id[]">
                        <option value=""></option>
                        @foreach($kotama_list as $kotama)
                            <option value="{{ $kotama->id }}"
                                @if(!empty($data) && $data->kotama_id == $kotama->id)
                                    selected
                                @endif >{{ $kotama->nama }}</option>
                        @endforeach
                    </select>    
                </div>
                <div class="col-5">
                    <label>Nama</label>
                    <div class="col-12" style="margin-bottom: 6px !important;">
                        <input type="text" class="form-control" name="nama[]">
                    </div>
                </div>
                <div class="col-1 text-center" style="padding-top:0px;">
                    <button type="button" class="btn btn-circle btn-outline-danger mr-5 mb-5 btnRemove">
                        <i class="fa fa-trash"></i>
                    </button>
                </div>
            </div>
        </div>
        `

        $('#container-new-form').append(content);
        removeParent();
        $('.select-2').select2();
    });
    function removeParent()
    {
        $('.btnRemove').on('click', function(){
            //console.log($(this).parent().siblings());
            $(this).parent().parent().parent().remove();
        });    
    }
    function removeParentAwal()
    {
        $('.btnRemove').on('click', function(){
            //console.log($(this).parent().siblings());
            $(this).parent().parent().remove();
        });    
    }
    $(document).ready(function(){
        removeParentAwal();
    })
    function deleteModal(id)
    {
        swal({
            title: 'Apakah Anda Yakin?',
            text: "Satker TNI akan dihapus.",
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
                    'Satker TNI berhasil dihapus.',
                    'success'
                    )
            }
        })

    }
</script>

@endsection