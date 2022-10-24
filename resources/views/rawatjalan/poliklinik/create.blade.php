@extends('layouts.main')

@section('title')
Rawat Jalan - Poliklinik - Medify
@endsection


@section('sidebarcomponent') 
    @include('rawatjalan.components.sidebar') 
@endsection

@section('content')

<div class="row page-title-container">
    <div class="icon">
        <i class="fa fa-exchange"></i>
    </div>
    <div class="title">
        Poliklinik<br>
        <small>
            Penambahan Poliklinik
        </small>
    </div>
</div>


<div class="card main-content transaction-index" style="">
    <div class="card-header"> 
        <a href="{{url('rawatjalan/poliklinik/')}}" class="btn btn-fill btn-round btn-primary pull-right"><i class="fa fa-paper-plane"></i> Kembali</a>
        <h4 class="card-title">Poliklinik Rawat Jalan</h4>
    </div>

    <div class="card-body">
        <form method="POST" action="{{url('rawatjalan/poliklinik')}}" enctype="multipart/form-data">
    {{csrf_field()}}
    <div class="form-group has-label">
        <label>
            Nama Poliklinik
            <star class="star">*</star>
        </label>
        <input class="form-control" name="name" type="text" required="true" placeholder="Nama Poliklinik baru">
    </div>
    <label>
            Logo Poliklinik
            <star class="star">*</star>
    </label>
    <div class="input-group has-label">
        <input class="form-control" name="image" type="file" required="true">
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-info btn-fill pull-right">Tambah</button>
    </div>
</form>
    </div>
</div>
@endsection