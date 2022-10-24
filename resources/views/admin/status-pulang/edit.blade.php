@extends('layouts.main-dashboard')

@section('title')
Admin - Edit Status Pulang
@endsection

@section('css')

@endsection

@section('content')

@include('admin.layouts.components.sidebar')
@include('layouts.components2.navbar-dashboard')

<!-- Page Content -->

<div class="content" style="margin-top:50px;">
    <div class="block block-rounded">
        <div class="block-header">
            <h3 class="block-title">Edit Status Pulang</h3>
        </div>
        <div class="block-content container">
            <form method="POST">
                {{csrf_field()}}
                <div class="row justify-content-start">
                    <div class="col-8 align-self-start">
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" id="nama" name="nama" class="form-control" style="width: 100%;" required="" value="{{$status_pulang->nama}}" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label>Jenis Status Pulang</label>
                            <select class="js-select2 form-control" name="slug">
                                <option value="">Tanpa Jenis</option>  
                                @foreach($slugs as $item)
                                <option value="{{$item->slug}}" @if($item->slug == $status_pulang->slug) selected @endif>{{$item->nama}}</option>  
                                @endforeach
                            </select>
                            <small>Digunakan untuk mapping master jenis status pulang</small>
                        </div>
                        <button class="btn btn-primary" type="submit" id="buttonSubmit"><i class="fa fa-check"></i> Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection

@section('js')
@endsection