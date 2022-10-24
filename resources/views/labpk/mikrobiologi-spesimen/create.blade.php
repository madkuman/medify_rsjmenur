@extends('layouts.main2')
@section('title')
Buat Spesimen Mikrobiologi - Pengaturan
@endsection
@section('css')

@endsection
@section('content')
@include('labpk.components.header')

<div class="content">
    <div class="block">
        <div class="block-header">
            <h3 class="block-title">Buat Spesimen Mikrobiologi</h3>
        </div>
        <div class="block-content">
            <form method="POST">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-5">
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" class="js-tags-input form-control" data-height="50px"  name="nama">
                            <small>Pisahkan dengan koma</small>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-5">
                        <div class="form-group">
                            <label>Kategori</label>
                            <select class="js-select2 form-control" name="mikrobiologi_spesimen_kategori_id">
                                @foreach($kategori as $item)
                                <option value="{{$item->id}}">{{$item->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <div class="col-3">
                            <button class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
@include('labpk.components.footer')

@endsection
@section('js')
@endsection