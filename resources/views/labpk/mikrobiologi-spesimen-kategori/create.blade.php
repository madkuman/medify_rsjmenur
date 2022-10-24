@extends('layouts.main2')
@section('title')
Buat Kategori Spesimen Mikrobiologi - Pengaturan
@endsection
@section('css')

@endsection
@section('content')
@include('labpk.components.header')

<div class="content">
    <div class="block">
        <div class="block-header">
            <h3 class="block-title">Buat Kategori Spesimen Mikrobiologi</h3>
        </div>
        <div class="block-content">
            <form method="POST">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <label>Nama</label>
                            <input class="form-control" type="text" name="nama" required>
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