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
                <a href="{{url('radiologi/pengaturan/hasil-baca')}}" class="btn btn-alt-success">Kembali</a>
            </div>
        </div>

        <div class="clearfix"></div>
        <div class="block-content">
            <form method="POST">
                <div class="row">
                    {{csrf_field()}}
                    <div class="col-12 form-group">
                        <select multiple class="form-control new-layanan js-select2" name="tarif_id[]" style="width: 100%;" >
                            @foreach($tarif as $row)
                            <option value="{{$row->id}}">{{$row->deskripsi}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 form-group">
                        <input type="text" name="title" class="form-control" placeholder="Tuliskan judul template">
                    </div>
                    <div class="col-12 form-group">
                        <textarea class="form-control js-summernote" rows="15" name="konten" placeholder="Isi Template hasil baca disini..."></textarea>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-alt-primary pull-right">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
@include('radiolog.components.footer')
@endsection
@section('js')
<script src="{{ URL::asset('/plugins/tinymce/tinymce.min.js') }}" type="text/javascript" ></script> 
<script type="text/javascript">
    $(document).ready(function(){
        @if(session('status'))
        swal(
            '{{session("message")}}',
            "",
            '{{session("status")}}'
            );
        @endif
        Codebase.helpers(['summernote']);
    });
</script>
@endsection