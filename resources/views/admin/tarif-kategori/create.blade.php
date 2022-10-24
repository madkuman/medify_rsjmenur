@extends('layouts.main-dashboard')

@section('title')
Admin - Buat Tarif Kategori
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
            <h3 class="block-title">Buat Tarif Kategori Baru</h3>
        </div>
        <div class="block-content container">
            <form action="{{url()->current()}}" method="POST">
                {{csrf_field()}}
                <div class="row justify-content-start">
                    <div class="col-8 align-self-start">
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" id="nama" name="nama" class="form-control" style="width: 100%;" placeholder="Deskripsi Tarif Kategori" required="">
                        </div>
                        <div class="form-group">
                            <label>Parent</label>
                            <select class="js-select2 form-control" name="parent_id">
                                <option value="0">Tanpa Parent</option>  
                                @foreach($kategori as $item)
                                <option value="{{$item->id}}">{{$item->nama}}</option>  
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Jenis Tarif</label>
                            <select class="js-select2 form-control" name="slug">
                                <option value="">Tanpa Jenis</option>  
                                @foreach($slugs as $item)
                                <option value="{{$item->slug}}">{{$item->nama}}</option>  
                                @endforeach
                            </select>
                            <small >Digunakan untuk mapping master jenis jenis tarif</small>
                        </div>
                        <div class="form-group">
                            <label>Jenis Kegiatan Radiologi</label>
                            <select class="js-select2 form-control" name="jenis_kegiatan_radiologi">
                                <option value="">Tanpa Jenis</option>  
                                @foreach($jenis_kegiatan_radiologi as $item)
                                <option value="{{$item->id}}">{{$item->nomor}}) {{$item->nama}}</option>  
                                @endforeach
                            </select>
                            <small >Digunakan untuk mapping master jenis kegiatan radiologi</small>
                        </div>
                        <div class="form-group">
                            <label>Jenis Kegiatan Lab</label>
                            <select class="js-select2 form-control" name="jenis_kegiatan_lab">
                                <option value="">Tanpa Jenis</option>  
                                @foreach($jenis_kegiatan_lab as $item)
                                <option value="{{$item->id}}">{{$item->nomor}}) {{$item->nama}}</option>  
                                @endforeach
                            </select>
                            <small >Digunakan untuk mapping master jenis kegiatan lab</small>
                        </div>
                        <div class="form-group">
                            <label>Jenis Kegiatan Perinatologi</label>
                            <select class="js-select2 form-control" name="jenis_kegiatan_perinatologi">
                                <option value="">Tanpa Jenis</option>  
                                @foreach($jenis_kegiatan_perinatologi as $item)
                                <option value="{{$item->id}}">{{$item->nomor}}) {{$item->nama}}</option>  
                                @endforeach
                            </select>
                            <small >Digunakan untuk mapping master jenis kegiatan Perinatologi</small>
                        </div>
                        <div class="form-group">
                            <label>Jenis Kegiatan Gigi Mulut</label>
                            <select class="js-select2 form-control" name="jenis_kegiatan_gigi_mulut">
                                <option value="">Tanpa Jenis</option>  
                                @foreach($jenis_kegiatan_gigi_mulut as $item)
                                <option value="{{$item->id}}">{{$item->nomor}}) {{$item->nama}}</option>  
                                @endforeach
                            </select>
                            <small >Digunakan untuk mapping master jenis kegiatan gigi mulut</small>
                        </div>
                        <div class="form-group">
                            <label>Jenis Kegiatan Rehab Medik</label>
                            <select class="js-select2 form-control" name="jenis_kegiatan_rehab_medik">
                                <option value="">Tanpa Jenis</option>  
                                @foreach($jenis_kegiatan_rehab_medik as $item)
                                <option value="{{$item->id}}">{{$item->nomor}}) {{$item->nama}}</option>  
                                @endforeach
                            </select>
                            <small >Digunakan untuk mapping master jenis kegiatan rehab medik</small>
                        </div>
                        <div class="form-group">
                            <label>Jenis Kegiatan Pelayanan Khusus</label>
                            <select class="js-select2 form-control" name="jenis_kegiatan_pelayanan_khusus">
                                <option value="">Tanpa Jenis</option>  
                                @foreach($jenis_kegiatan_pelayanan_khusus as $item)
                                <option value="{{$item->id}}">{{$item->nomor}}) {{$item->nama}}</option>  
                                @endforeach
                            </select>
                            <small >Digunakan untuk mapping master jenis kegiatan pelayanan khusus</small>
                        </div>
                        <div class="form-group">
                            <label>Jenis Kegiatan Kesehatan Jiwa</label>
                            <select class="js-select2 form-control" name="jenis_kegiatan_kesehatan_jiwa">
                                <option value="">Tanpa Jenis</option>  
                                @foreach($jenis_kegiatan_kesehatan_jiwa as $item)
                                <option value="{{$item->id}}">{{$item->nomor}}) {{$item->nama}}</option>  
                                @endforeach
                            </select>
                            <small >Digunakan untuk mapping master jenis kegiatan kesehatan jiwa</small>
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