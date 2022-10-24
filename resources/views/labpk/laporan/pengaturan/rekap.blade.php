@extends('layouts.main2')
@section('title')
Edit Laporan LabPK
@endsection
@section('css')
@include('radiolog.layouts.css')
@endsection
@section('content')
@include('labpk.components.header')

<div class="content">
    <div class="block block-themed">
        <div class="block-header" style="background-color:#ffffff">
            <h3 class="block-title" style="font-weight: 550; color: black">Edit Laporan {{$master->nama}}</h3>
            <a href="{{url('labpk/laporan')}}" class="pull-right btn btn-info">Kembali</a>
        </div>
        <div class="block-content px-20">
            <form method="POST">
            <div class="mx-0">
                    {{csrf_field()}}
                    <div class="form-group">
                        {{ Form::label('nama', 'Nama Laporan')}}
                        <input type="text" name="nama" class="form-control" value="{{$master->nama}}">
                    </div>
                    @foreach($konten as $key => $val)
                    <div class="parent-div row">
                        <div class="col-12">
                            <h5>{{str_replace('_', ' ', $key)}}</h5>
                            <input type="hidden" name="parent[]" value="{{$key}}">
                            @if(is_array($val))
                                @foreach($val as $i => $det)
                                <div class="child-div row">
                                    <div class="form-group col-10">
                                        {{ Form::label('parent', 'Nama Header')}}
                                        <input type="text" name="header_{{$key}}[{{$i}}]" value="{{$det->header}}" class="form-control">
                                    </div>
                                    <div class="col-2">
                                        <button type="button" class="btn btn-alt-danger btn-hero mt-20" onclick="deleteChild(this, true);"><i class="fa fa-close"></i> Hapus</button>
                                    </div>
                                    <div class="form-group col-12">
                                        {{ Form::label('parent', 'Layanan')}}
                                        <select class="form-control js-select2" name="detail_{{$key}}[{{$i}}][]" style="width: 100%;" data-placeholder="Pilih Layanan" multiple="">
                                            @foreach($layanan as $l)
                                            <option value="{{$l->id}}" @if(in_array($l->id, $det->id)) selected @endif>{{$l->deskripsi}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @endforeach
                            @else
                                <div class="form-group col-12">
                                    {{ Form::label('parent', 'Layanan')}}
                                    <select class="form-control js-select2" name="detail_{{$key}}[]" style="width: 100%;" data-placeholder="Pilih Layanan" multiple="">
                                        @foreach($layanan as $l)
                                        <option value="{{$l->id}}" @if(in_array($l->id, $val->id)) selected @endif>{{$l->deskripsi}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif
                        </div>
                        <div class="col-10"></div>
                        <div class="col-2"><button class="btn btn-alt-info btn-hero" onclick="addChild(this, '{{$key}}');" type="button"><i class="fa fa-plus"></i> Tambah</button>
                        </div>
                    </div>
                    <hr>
                    <br>
                    @endforeach
                    <button type="submit" class="btn btn-alt-success">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>

@include('labpk.components.footer')
@endsection

@section('js')
<script type="text/javascript">
    function addChild(el, parent){
        var parentDiv = $(el).parent().parent();

        var childIndex = parentDiv.find('.new-child').length;
        var childTemplate = `<div class="child-div new-child row">
        <div class="form-group col-10">
        {{ Form::label('parent', 'Nama Header')}}
        <input type="text" name="header_${parent}_new[]" value="" class="form-control">
        </div>
        <div class="col-2">
        <button type="button" class="btn btn-alt-danger btn-hero mt-20"  onclick="deleteChild(this);"><i class="fa fa-close"></i> Hapus</button>
        </div>
        <div class="form-group col-12">
        {{ Form::label('parent', 'Layanan')}}
        <select class="form-control new-js-select2" name="detail_${parent}_new[${childIndex}][]" data-placeholder="Pilih Layanan" multiple="">
        @foreach($layanan as $l)
        <option value="{{$l->id}}">{{$l->deskripsi}}</option>
        @endforeach
        </select>
        </div>
        </div>`;
        var lastChild = parentDiv.find('.child-div').last();
        lastChild.after(childTemplate);
        $('.new-js-select2').select2();
    }
    function deleteChild(el, confirmation = false){
        console.log(confirmation)
        if(!confirmation)
            $(el).parent().parent().remove();
        else{
            swal({
              title: 'Apakah anda yakin?',
              text: "Silahkan refresh halaman jika ingin mengembalikan",
              type: 'warning',
              showCancelButton: true,
              confirmButtonClass: 'btn btn-alt-danger',
              cancelButtonClass: 'btn btn-alt-success',
              confirmButtonText: 'Ya',
              cancelButtonText: 'Batal',
              reverseButtons: true
          }).then((result) => {
              if (result.value) {
                $(el).parent().parent().remove();            
            }
        })
      }
  }
</script>
@endsection