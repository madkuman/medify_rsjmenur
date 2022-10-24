@extends('layouts.main')

@section('title')
Ruangan - IGD - Medify
@endsection


@section('sidebarcomponent') 
    @include('igd.components.sidebar') 
@endsection

@section('content')

<div class="row page-title-container">
    <div class="icon">
        <i class="fa fa-exchange"></i>
    </div>
    <div class="title">
        Ruangan<br>
        <small>
            Penambahan Ruangan Baru
        </small>
    </div>
</div>


<div class="card main-content transaction-index" style="">
    <div class="card-header"> 
        <a href="{{url('igd/ruangan/')}}" class="btn btn-fill btn-round btn-primary pull-right"><i class="fa fa-paper-plane"></i> Kembali</a>
        <h4 class="card-title">Ruangan Instalasi Gawat Darurat</h4>
    </div>

    <div class="card-body">
        <form method="POST" action="{{url('igd/ruangan/')}}" enctype="multipart/form-data">
    {{csrf_field()}}
    <div class="form-group has-label">
        <label>
            Nama Ruangan
            <star class="star">*</star>
        </label>
        <input class="form-control" name="name" type="text" required="true" placeholder="Nama Ruangan Baru">
    </div>
    <div class="form-group has-label">
        <label>
            Kapasitas Ruangan
            <star class="star">*</star>
        </label>
        <input class="form-control" name="kapasitas" type="text" required="true" placeholder="Kapasitas Ruangan Baru">
    </div>
    <div class="form-group has-label">
        <label>
            Level Ruangan
            <star class="star">*</star>
        </label>
        <input class="form-control" name="level" type="text" required="true" placeholder="Level Ruangan Baru">
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-info btn-fill pull-right">Tambah</button>
    </div>
</form>
    </div>
</div>
@endsection