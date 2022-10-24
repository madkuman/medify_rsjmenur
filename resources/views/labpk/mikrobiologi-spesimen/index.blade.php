@extends('layouts.main2')
@section('title')
Daftar Form - Pengaturan
@endsection
@section('css')

@endsection
@section('content')
@include('labpk.components.header')

<div class="content">
    <div class="block">
        <div class="block-header">
            <h3 class="block-title">Daftar Spesimen Mikrobiologi</h3>
            <div class="block-options">
                <a href="{{url('labpk\pengaturan\mikrobiologi-spesimen\create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Spesimen</a>
            </div>
        </div>

        <div class="clearfix"></div>
        <div class="block-content">
            <table class="table js-dataTable-full">
                <thead>
                    <tr>
                        <th style="width: 5%">No</th>
                        <th>Nama</th>
                        <th style="width: 30%">Kategori</th>
                        <th style="width: 10%">Input Keterangan</th>
                        <th style="width: 10%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$item->nama}}</td>
                        <td>{{$item->kategori->nama}}</td>
                        <td class="text-center">@if($item->input_keterangan) <i class="fa fa-check"></i> @endif</td>
                        <td>
                            <a href="{{url('')}}/labpk/pengaturan/mikrobiologi-spesimen/edit/{{$item->id}}" class="btn btn-primary">
                                Edit
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
@include('labpk.components.footer')

@endsection
@section('js')
<script type="text/javascript">
    
    jQuery('.js-dataTable-full').dataTable({
        "ordering": true,
        pageLength: 10,
        lengthMenu: [[5, 10, 15, 20], [5, 10, 15, 20]],
        autoWidth: false
    });
</script>
@endsection