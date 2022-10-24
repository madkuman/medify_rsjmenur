@extends('layouts.main-dashboard')

@section('title')
Admin - Pengaturan Administrasi
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
            <h3 class="block-title">Pengaturan Administrasi</h3>
        </div>
        <div class="block-content">
            <form method="POST" action="{{url('admin/administrasi')}}/edit" enctype='multipart/form-data'>
                {{csrf_field()}}
                <hr>
                <div class="row">
                    <div class="col-12">
                        <h5>Pengiriman Retribusi</h5>
                        <table class="table table-bordered table-striped table-vcenter js-dataTable-full" id="example">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Kirim Ke</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($retribusi as $key => $item)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$item->nama}}</td>
                                    <td>
                                        <input type="hidden" name="tipe_pembayaran_perusahaan[]" value="{{$item->id}}">
                                        <select class="js-select2 form-control" name="retribusi_ke[]" style="width: 100%;" data-placeholder="Pilih aksi">
                                            <option value="0" @if(!$item->kirim_kasus) selected @endif>Kasir</option>
                                            <option value="1" @if($item->kirim_kasus) selected @endif>Kasus</option>
                                        </select>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <hr>
                <div class="row pt-20">
                    <div class="col-12">
                        <button class="btn btn-primary" type="submit" id="buttonSubmit"><i class="fa fa-check"></i> Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection

@section('js')
<script type="text/javascript">
    var table = jQuery('.js-dataTable-full').dataTable({
        "ordering": true,
        pageLength: 10,
        lengthMenu: [[5, 10, 15, 20], [5, 10, 15, 20]],
        autoWidth: false
    });
</script>
@endsection