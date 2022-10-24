@extends('rawatinap.layouts.main')

@section('title')
Buat Bangsal Baru - Rawat Inap - Medify
@endsection

@section('subtitle')
Pengaturan - Buat Bangsal Baru 
@endsection

@section('content')


<main id="main-container">
    @include('rawatinap.layouts.navbar')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="block">
                    <div class="block-content block-content text-left">
                        <h4>Buat Bangsal Baru</h4>
                        <hr>
                        <form method="POST" action="{{url()->current()}}" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label >Nama Bangsal</label>
                                        <input type="text" class="form-control" name="name" placeholder=".." required>
                                    </div>
                                    <div class="form-group">
                                        <label>Jenis Tarif</label>
                                        <select class="js-select2 form-control requireForm" id="tipeLayanan" name="jenis_tarif" style="width: 100%;" data-placeholder="Choose one..">
                                            <option disabled="" hidden="" selected="">Pilih Jenis Tarif</option>
                                            @foreach($tarif as $row)
                                                <option value="{{$row->id}}">{{$row->deskripsi}}</option>
                                            @endforeach
                                        </select>
                                        <p class="text-danger teksWarning" id="tipeWarn" style="display: none; margin-bottom: 8px;"></p>
                                    </div>
                                   
                                    <div class="form-group">
                                        <label >Deskripsi Bangsal</label>
                                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="6" 
                                        placeholder="Content.."></textarea>
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox custom-control-inline mb-5">
                                            <input class="custom-control-input" type="checkbox" name="intensif" id="example-inline-checkbox1" value="1">
                                            <label class="custom-control-label" for="example-inline-checkbox1">Ruang Intensif</label>
                                        </div>
                                        <div class="custom-control custom-checkbox custom-control-inline mb-5">
                                            <input class="custom-control-input" type="checkbox" name="bayi" id="example-inline-checkbox2" value="1">
                                            <label class="custom-control-label" for="example-inline-checkbox2">Ruang Bayi</label>
                                        </div>
                                    </div>
                                    <div class="form-group float-right">
                                        <button class="btn btn-primary btn-hero">Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('js')
@endsection