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
            <h3 class="block-title">Daftar Form</h3>
            <div class="block-options">
                <a href="{{url('labpk\pengaturan\form\create')}}" class="btn btn-secondary">Tambah Form</a>
            </div>
        </div>

        <div class="clearfix"></div>
        <div class="block-content">
            <table class="table js-dataTable-full">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Parameter</th>
                        <th>Kode</th>
                        <th>Satuan</th>
                        <th>Metode</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$item->parameter}}</td>
                        <td>{{$item->slug}}</td>
                        <td>{{$item->satuan}}</td>
                        <td>{{$item->metode}}</td>
                        <td>
                            <a href="{{url('')}}/labpk/pengaturan/form/edit/{{$item->id}}" class="btn btn-primary">
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