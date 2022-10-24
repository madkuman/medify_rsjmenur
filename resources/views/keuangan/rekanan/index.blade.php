@extends('keuangan.layouts.main')


@section('title')
Daftar Rekanan - Keuangan
@endsection


@section('css')

<style>
.dataTables_processing {
    background-color: white;
}
</style>
@endsection
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="block block-rounded">
            <div class="block-header py-20">
                <span><h4 class="mb-0">Daftar Rekanan</h4><hr>
                <h5></h5></span>
                <div class="block-options">
                    <a href="{{url()->current()}}/baru" class="btn btn-sm btn-primary btn-hero">
                        <i class="fa fa-plus"></i> Buat Rekanan
                    </a>
                    <!-- <a href="{{url()->current()}}/edit" class="btn btn-sm btn-primary btn-hero">
                        <i class="fa fa-plus"></i> Update
                    </a> -->
                </div>
            </div>
            <div class="block-content py-20">
                <table class="table table-striped table-hover table-vcenter transaksiTable" id="indexTable">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 5%;">#  </th>
                            <th class="text-center" style="width: 25%;">Nama Rekanan  </th>
                            <th class="text-center" style="width: 25%;">Direktur  </th>
                            <th class="text-center" style="width: 35%;">Alamat  </th>
                            <th class="text-center" style="width: 10%;">Aksi  </th>
                        </tr>
                    </thead>
                    
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{asset('js/keuangan/perusahaan/index2.js')}}"></script>


@endsection