@extends('layouts.main2')

@section('title')
Rencana Asuhan Keperawatan
@endsection


@section('content')

@include('layouts.components2.navbar')
<!-- Main Container -->
<main id="main-container">
    <div class="content pb-100">
        @include('keperawatan.components.navbar')
        <div class="block">
            <div class="block-content">
                <a href="{{url('keperawatan')}}/rencana-asuhan/baru" class="btn btn-primary pull-right">+ Buat Baru</a>
                <h6 class="text-uppercase">Rencana Asuhan Keperawatan</h6>
                <hr>
                <form method="get">
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label class="text-uppercase">jenis</label>
                                <select class="form-control js-select2" name="jenis">
                                    <option value="0">Semua</option>
                                    @foreach($jenis as $item)
                                    <option value="{{$item->id}}">{{$item->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-2" style="padding-top: 25px">
                            <button class="btn btn-primary">Filter</button>
                        </div>
                    </div>
                </form>

                <table class="table table-bordered table-striped table-vcenter js-dataTable-full" id="example">
                    <thead>
                        <tr>
                            <th class="">No</th>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 1; @endphp
                        @foreach($asuhan as $item)
                        <tr>
                            <td class="">{{$loop->iteration}}</td>
                            <td class="font-w600">{{$item->diagnosa}}</td>
                            <td class="font-w600">{{$item->jenis->nama}}</td>
                            <td class="">
                                <a href="{{url('keperawatan')}}/rencana-asuhan/{{$item->id}}" class="btn btn-primary mr-5 mb-5">
                                    <i class="fa fa-paper-plane"></i> Lihat
                                </a>
                            </td>
                        </tr>
                        @php $i++; @endphp  
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

@endsection

@section('js')



<script type="text/javascript">
    jQuery('.js-dataTable-full').dataTable({
        "ordering": true,
        pageLength: 8,
        lengthMenu: [[5, 8, 15, 20], [5, 8, 15, 20]],
        autoWidth: false
    });
</script>
@endsection
