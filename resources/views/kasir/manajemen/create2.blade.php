@extends('kasir.layouts.app')

@section('title')
Buat Kasir Baru - Kasir
@endsection

@section('content')
@include('kasir.manajemen.components.header')

<!-- Page Content -->

<div class="block rounded">
    <div class="block-header">
        <h3 class="block-title">Tambah Kasir Baru</h3>
    </div>
    <form enctype="multipart/form-data" action="{{ route('manajemen_create') }}"method="post">
        {{ csrf_field() }}
        <div class="block-content">
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label>Nama Kasir</label>
                        <input class="form-control" type="text" name="nama">    
                    </div>         
                    <div class="form-group">
                        <label>Jenis Kasir</label>
                        <select class="js-select2 form-control" name="slugs[]" multiple>
                            @foreach($slugs as $item)
                            <option value="{{$item->slug}}">{{$item->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <button class="btn btn-success btn-hero btn-block"><i class="fa fa-check"></i> Simpan</button>
                    </div>

                </div>
            </div>
        </div>
    </form>
</div>



<!-- END Page Content -->
@endsection

@section('js')
{{-- <script src="{{asset('js/kasir/manajemen/create.js')}}"></script> --}}
@endsection