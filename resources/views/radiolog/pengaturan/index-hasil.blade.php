@extends('layouts.main2')
@section('title')
Laboratorium Radiologi
@endsection
@section('css')

@include('radiolog.layouts.css')
@endsection
@section('content')
@include('radiolog.components.header')

<div class="content">
    <div class="block block-themed">
        <div class="block-header" style="background-color:#ffffff">
            <h3 class="block-title" style="font-weight: 550; color: black">Daftar Layanan</h3>
            <div class="block-options">
                <a href="{{url('radiologi/pengaturan/hasil-baca/new')}}" class="btn btn-alt-success">Buat Baru</a>
            </div>
        </div>

        <div class="clearfix"></div>
        <div class="block-content">
            <table class="table table-bordered table-striped table-vcenter no-footer" aria-describedby="DataTables_info" id="pengaturanTable" style="width: 100%">
                <thead>
                    <tr >
                        <th width="5%">No.</th>
                        <th width="75%">Nama</th>
                        <th width="20%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($template as $i => $row)
                    <tr>
                        <td class="font-w600">{{++$i}}</td>
                        <td>{{$row->title}}</td>
                        <td style="border: none;" class="text-center">
                            <a href="{{url($link.'/pengaturan/hasil-baca')}}/{{$row->generic_id}}" class="btn btn-info full-only">
                                <i class="fa fa-pencil"></i> &nbsp;Edit
                            </a>
                            <a href="javascript:void(0);" class="btn btn-info" onclick="openConfirmation({{$row->generic_id}}, '{{$row->title}}')">
                                <i class="fa fa-trash"></i> &nbsp;Hapus
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
<div class="modal fade" id="modalConfirmation" tabindex="-1" role="dialog" aria-labelledby="modalConfirmation" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-popin" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Hapus Template</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <p>Apakah anda yakin ingin menghapus Template <span id="layanan_title"></span> ?</p>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
@include('radiolog.components.footer')

@endsection
@section('js')
<script type="text/javascript" src="{{asset('assets/js/jquery1.10.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/dataTables1.10.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/js/pages/be_tables_datatables.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        var oTable = $("#pengaturanTable").DataTable({
            scrollX:        true,
            scrollCollapse: true,
            processing: true,
            language: {
                processing: '<i class="fa fa-4x fa-asterisk fa-spin text-info"></i>'
            },
        });
    });
    function openConfirmation(id, name) {
        $("#layanan_title").html(name);
        $(".modal-footer").html(`<form action="{{url('radiologi/pengaturan/hasil-baca/delete')}}" method="POST">
            {{csrf_field()}}
            <input type="hidden" value="`+id+`" name="to_delete"/>
            <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-alt-danger" >
            <i class="fa fa-trash"></i> Hapus
            </button>
            </form>`);
        $("#modalConfirmation").modal('show');
    }
</script>
@endsection