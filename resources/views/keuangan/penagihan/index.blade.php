@extends('keuangan.layouts.main')

@section('title')
Daftar Tagihan & Penagihan - Keuangan
@endsection

@section('css')

<style>
    .dataTables_processing {
        background-color: white;
    }
    .pink {
      background-color: pink !important;
  }
</style>
@endsection
@section('content')
@include('keuangan.penagihan.components.header')

<div class="row">
    <div class="col-md-12">
        <div class="block block-rounded">
            <div class="block-header py-20">
                <span><h4 class="mb-0">Penagihan</h4>
                </span>
                <input type="text" class="d-none" id="today" value="{{date('d F Y', strtotime($today))}}">
            </div>
            <div class="block-content py-20">
                <div class="col-12">
                    <table class="table table-striped table-hover table-vcenter js-dataTable-simple" id="transaksiTable">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 1%;">#  </th>
                                <th class="text-left" style="width: 23%;">Judul  </th>
                                <th class="text-center" style="width: 10%;">Tanggal  </th>
                                <th class="text-right" style="width: 12%;">Total  </th>
                                <th class="text-right" style="width: 12%;">Nomor Surat  </th>
                                <th class="text-center" style="width: 25%;">Aksi  </th>
                            </tr>
                        </thead>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
@include('keuangan.penagihan.index-js')


@endsection