@extends('pasien.layouts.main')

@section('title')
Laporan - Administrasi & Rekam Medis
@endsection

@section('subtitle')
Laporan - Administrasi & Rekam Medis
@endsection

@section('css')

@endsection

@section('content')
<main id="main-container">
    @include('pasien.layouts.navbar')
    <div class="container">
        <div class="content" style="margin-top:50px;">
            <div class="block p-10">
                <div class="block-header">
                    <h3 class="block-title"> Daftar Laporan
                    </h3>
                </div>
                <div class="block-content">
                    <table class="table table-bordered table-striped table-vcenter js-dataTable-full" id="example">
                        <thead>
                            <tr>
                                <th class="">No</th>
                                <th>Nama</th>
                                <th>Tags</th>
                                <th>Departemen</th>
                                <th>Lihat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($laporan as $index => $item)
                            <tr>
                                <td class="">{{$index + 1}}</td>
                                <td class="font-w600">{{$item->nama}}</td>
                                <td class="">
                                    @php $tags = explode(',',$item->tags) @endphp
                                    @foreach($tags as $tag)
                                    <span class="badge badge-secondary">{{$tag}}</span>
                                    @endforeach
                                </td>
                                <td class="font-w600">{{$item->departemen->nama}}</td>
                                <td><a href="{{url('')}}/{{$item->url}}" target="_blank" class="btn btn-primary">Lihat</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>

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