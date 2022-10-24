@extends('kasir.layouts.app')

@section('title')
Daftar Kasir - Kasir
@endsection

@section('css')

@endsection
@section('content')
@include('kasir.manajemen.components.header')

<!-- Page Content -->
<div class="row">
    <div class="col-md-12">
        <div class="block">
            <div class="block-header block-header-default py-20">
                <h3 class="block-title">
                    <a href="{{url('/kasir')}}" class="btn btn-sm btn-default btn-hero">
                        <i class="  fa fa-chevron-circle-left"></i> Daftar Kasir
                    </a>
                </h3>
                <div class="block-options">
                    <a href="{{url()->current()}}/baru" class="btn btn-sm btn-primary btn-hero">
                        <i class="fa fa-plus"></i> Tambah Kasir
                    </a>
                </div>
            </div>
            <div class="block-content py-20">
                <table class="table table-striped table-hover table-vcenter js-dataTable-simple" id="transaksiTable">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 5%;">#  </th>
                            <th class="text-center" style="width: 20%;">Nama  </th>
                            <th class="text-center">Deskripsi  </th>
                            <th class="text-center" style="width: 25%;">Aksi </th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($manajemen_detail as $rownum =>$item)
                        <tr>
                            <th class="text-center" scope="row">{{$rownum+1}}</th>
                            <td class="text-center">
                                {{$item->nama}}
                            </td>
                            <td class="text-center">
                                {{$item->deskripsi}}
                            </td>
                            <td class="text-center">
                                <a href="{{url()->current()}}/edit/{{$item->id}}" class="btn btn-sm btn-alt-warning" data-toggle="tooltip" title="Edit Detail Kasir">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <button class="btn btn-sm btn-alt-danger remove" data-pk="{{$item->id}}" data-toggle="tooltip" title="Delete Kasir">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<!-- <script src="{{URL::to('assets/js/pages/be_pages_dashboard.js')}}"></script> -->
<script src="{{asset('js/kasir/manajemen/delete.js')}}"></script>



<!-- <script src="{{URL::to('assets/js/pages/be_tables_datatables.js')}}"></script> -->


@endsection