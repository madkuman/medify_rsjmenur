@extends('layouts.main-dashboard')

@section('title')
Admin - Edit Breakdown Tarif INACBG
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
        <h3 class="block-title">Edit Breakdown Tarif INACBG</h3>
    </div>
    <div class="block-content container">
        <form method="POST" id="edit-form">
        {{csrf_field()}}
        <div class="row justify-content-start">
            <div class="col-4 align-self-start">
                <label>Deskripsi Tarif</label>
                <input type="text" id="deskripsi" name="deskripsi" class="form-control" style="width: 100%;" placeholder="Deskripsi Tarif" value="{{$tarif->master->deskripsi}}" disabled>
            </div>
            <div class="col-4 align-self-start">
                <label>Tipe</label>
                <input type="text" id="tipe" name="tipe" class="form-control" style="width: 100%;" value="{{$tarif->tipe->nama}}" disabled>
            </div>
            <div class="col-4 align-self-start">
                <label>Kelas</label>
                <input type="text" id="kelas" name="kelas" class="form-control" style="width: 100%;" value="{{$tarif->kelas->nama}}" disabled>
            </div>
            <div class="col-4 align-self-start">
                <label>Kategori</label>
                <input type="text" id="kategori" name="kategori" class="form-control" style="width: 100%;" value="{{$tarif->master->kategori->nama}}" disabled>
            </div>
            <div class="col-4 align-self-start">
                <label>Total</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Rp</span>
                    </div>
                    <input type="text" id="total" name="total" class="form-control input-total" value="{{$tarif->harga}}" disabled>
                </div>
            </div>
        </div>
        <div class="row justify-content-md-center">
            <div class="col-12">
                <hr>    
            </div>
            <div class="col-12 table-responsive">
                <table class="table table-bordered table-hover table-striped table-vcenter" id="hargaTable">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 5%;">#</th>
                            <th style="width: 9%;">Kategori INACBG</th>
                            <th class="text-center" style="width: 5%;">Harga</th>
                        </tr>
                    </thead>
                    <tbody id="harga-tbody">
                        @foreach($kategori_inacbg as $i => $k)
                            <tr id="harga-tr-{{$k->id}}" class="harga-tr">
                            <input type="hidden" name="kategori_id[]" value="{{$k->id}}" class="kategori-id">
                                <th class="text-center index-num" scope="row">{{++$i}}</th>
                                <td>{{$k->nama}}</td>
                                <td class="text-center">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp</span>
                                        </div>
                                        <input type="text" class="form-control input-harga" name="harga[]" value="{{$k->harga}}" autocomplete="off">
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-12">
            <table class="table table-borderless table-vcenter">
                <tbody>
                    <tr>
                        <td style="width: 80%" class="text-right font-w700"></td>
                        <td class="text-right font-w700"  style="width: 40%" id="satuan">
                            <button class="btn btn-success btn-hero btn-block" type="submit" id="buttonSubmit"><i class="fa fa-check"></i> Simpan</button>
                            <button class="btn btn-alt-success btn-hero btn-block" style="display: none" id="buttonLoading">
                                <i class="fa fa-asterisk fa-spin"></i> Loading
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    </form>
</div>
</div>

<!-- END Page Content -->
@endsection

@section('js')
    <script type="text/javascript" src="{{asset('assets/js/plugins/jquery-masked-inputs/jquery.mask.min.js')}}"></script>
    <script type="text/javascript">
        $('.input-harga').mask("000.000.000.000.000", {reverse: true});
        $('.input-total').mask("000.000.000.000.000", {reverse: true});

        $(document).ready(function(){
            var total = {{$tarif->harga}};

            $('#buttonSubmit').on('click', function(e) {
                e.preventDefault();
                
                var breakdown_total = 0;
                $('.input-harga').each(function() {
                    harga = $(this).cleanVal();
                    breakdown_total += parseInt(harga);
                });

                if (total == breakdown_total) {
                    $('#edit-form').submit();
                } else {
                    if (total > breakdown_total) {
                        callSwal('error','Gagal','Jumlah yang dimasukkan kurang dari Total Tarif','');
                    } else {
                        callSwal('error','Gagal','Jumlah yang dimasukkan melebihi Total Tarif','');
                    }
                }
            })
        });
    </script>
@endsection