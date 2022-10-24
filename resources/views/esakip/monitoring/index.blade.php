@extends('esakip.layouts.main')

@section('title')
E-Sakip - Monitoring
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="block block-rounded">
            <div class="block-header py-20">
                <span><h4 class="mb-0">Monitoring</h4><hr></span>
            </div>
            
            <div class="block-content py-5">
                <div class="row">
                    <div class="col-2">
                        <div class="form-group">
                            <label>Pilih Periode</label>
                            <div class="form-inline">
                                <input type="text" class="form-control js-datepicker-year" onkeydown="return false" id="periode" value="{{date('Y')}}" data-date-autoclose="true">
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label>Kategori</label>
                            <div class="form-inline">
                                <select class="js-select2 form-control" id="kategori" name="kategori_id" style="width: 100%;" data-placeholder="Pilih Kategori" required>
                                    @foreach($kategori as $item)
                                        <option value="{{$item->id}}">{{$item->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label>Status</label>
                            <div class="form-inline">
                                <select class="js-select2 form-control" id="status" name="status" style="width: 100%;" data-placeholder="Pilih Status" required>
                                    <option value="belum">Belum</option>
                                    <option value="sudah">Sudah</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    @if($admin)
                    <div class="col-3">
                        <div class="form-group">
                            <label>Atasan</label>
                            <div class="form-inline">
                                <select class="js-select2 form-control" id="atasan" name="user_id" style="width: 100%;" required>
                                        <option value="all">Semua</option>
                                    @foreach($users as $user)
                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <input type="text" id="pegawaiSearch" class=" form-control" placeholder="Cari Pegawai">
                        </div>

                        <div class="mt-10 spinner-container">
                            <div class="spinner-back">
                                <div id="transaksi-content">
                                </div>
                                <div class="spinner">
                                     <i class="fa fa-4x fa-asterisk fa-spin text-info"></i>
                                </div>
                                <div class="flex-center" style="">
                                    <ul id="pagination" class="pagination"></ul>
                                </div>
                            </div>
                        </div>

                        </div>
                    </div>
                </div>
               
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
@include('esakip.monitoring.components.js-index')
@endsection