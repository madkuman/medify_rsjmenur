@extends('kasir.layouts.app')

@section('title')
{{$kasir->nama}} Edit - Kasir
@endsection

@section('content')
@include('kasir.manajemen.components.header')

<!-- Page Content -->

<div class="block rounded">
    <div class="block-header">
        <h3 class="block-title">Edit Kasir</h3>
    </div>
    <form enctype="multipart/form-data" action="{{ route('manajemen_edit', ['id' => $kasir->id]) }}"method="post">
        {{ csrf_field() }}
        <div class="block-content">
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label>Nama Kasir</label>
                        <input class="form-control" type="text" name="nama" value="{{$kasir->nama}}">   
                    </div>
                    <div class="form-group">
                        <label>Jenis Kasir</label>
                        <select class="js-select2 form-control" name="slugs[]" multiple>
                            @foreach($slugs_now as $item)
                            <option value="{{$item->slug}}" selected="">{{$item->nama}}</option>
                            @endforeach
                            @foreach($slugs as $item)
                            <option value="{{$item->slug}}">{{$item->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <button class="btn btn-success btn-hero btn-block"><i class="fa fa-check"></i> Simpan</button>
                    <button class="btn btn-alt-success btn-hero btn-block" style="display: none" id="buttonLoading">
                        <i class="fa fa-asterisk fa-spin"></i> Loading
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>



<!-- END Page Content -->
@endsection

@section('js')

<script>
    $(function () {
        $("#inputFile").change(function () {
            readURL(this);
        });
    });


    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                //alert(e.target.result);
                $('#imgLogo').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script> 

@endsection