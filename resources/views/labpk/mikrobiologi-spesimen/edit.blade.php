@extends('layouts.main2')
@section('title')
Edit {{$spesimen->nama}} - {{$spesimen->kategori->nama}} - Kategori Spesimen Mikrobiologi - Pengaturan
@endsection
@section('css')

@endsection
@section('content')
@include('labpk.components.header')

<div class="content">
    <div class="block">
        <div class="block-header">
            <h3 class="block-title">Edit {{$spesimen->nama}} - {{$spesimen->kategori->nama}}</h3>
            <div class="block-options">
                <button class="btn btn-danger deleteButton"><i class="fa fa-trash"></i> Hapus</button>
            </div>
        </div>
        <div class="block-content">
            <form method="POST">
                {{csrf_field()}}
                <input class="" type="hidden" name="id" value="{{$spesimen->id}}" required>
                <div class="row">
                    <div class="col-5">
                        <div class="form-group">
                            <label>Nama</label>
                            <input class="form-control" type="text" name="nama" value="{{$spesimen->nama}}" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-5">
                        <div class="form-group">
                            <label>Input Keterangan</label><br>
                            <label class="css-control css-control-primary css-radio">
                                <input type="radio" class="css-control-input" name="input_keterangan" value="0" @if(!$spesimen->input_keterangan) checked @endif>
                                <span class="css-control-indicator"></span> Tidak
                            </label>
                            <label class="css-control css-control-primary css-radio">
                                <input type="radio" class="css-control-input" name="input_keterangan" value="1" @if($spesimen->input_keterangan) checked @endif>
                                <span class="css-control-indicator"></span> Ya
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-5">
                        <div class="form-group">
                            <label>Kategori</label>
                            <select class="js-select2 form-control" name="mikrobiologi_spesimen_kategori_id">
                                @foreach($kategori as $item)
                                <option value="{{$item->id}}" @if($item->id == $spesimen->mikrobiologi_spesimen_kategori_id) selected @endif>{{$item->nama}}</option>
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
<script type="text/javascript">
     $('.deleteButton').click(function(){
        var id = {{$spesimen->id}}       
        swal({
            title: 'Apakah anda yakin?',
            text: "Data tidak dapat dikembalikan",
            type: 'warning',
            showCancelButton: true,
            confirmButtonClass: 'btn btn-danger',
            cancelButtonClass: 'btn btn-secondary',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            showLoaderOnConfirm: true,
            preConfirm: function() {
                return new Promise(function(resolve) {
                    $.ajax({
                        type: "POST",
                        url: BASE_URL + "labpk/pengaturan/mikrobiologi-spesimen/delete/"+id,
                        dataType: "json",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (data) {
                            callSwal(data.type,data.title,data.message,0);
                            if(data.type == 'success')
                                window.location.href = BASE_URL + "labpk/pengaturan/mikrobiologi-spesimen";
                        },
                        error: function () {
                            callSwal('error','Transaksi Gagal','Silahkan Coba Lagi',0);
                        }
                    })
                });
            }
        })
    });
</script>
@endsection