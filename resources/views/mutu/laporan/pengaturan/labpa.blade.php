@extends('mutu.layouts.main')

@section('title')
Mutu - Laporan - Medify
@endsection

@section('subtitle')
Laporan
@endsection

@section('content')


<main id="main-container">
    @include('mutu.layouts.navbar')
    <div class="container">
        <div class="row">
            <div class="col-xl-12 text-center py-20">
                <h3>Laporan</h3>
            </div>
        <div class="block-content px-20">
            <div class="row mx-0">
                <form method="POST" action="{{url()->current()}}/mutu-ketepatan">
                    {{csrf_field()}}
                    <div class="form-group">
                        {{ Form::label('nama', 'Nama Laporan')}}
                        <input type="text" name="nama" class="form-control" value="{{$master->nama}}">
                    </div>
                        @foreach($konten as $key => $val)
                            <div class="parent-div row">
                                <div class="col-12">
                                    <h5>{{$key}}</h5>
                                    <input type="hidden" name="parent[]" value="{{$key}}">
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
                                </div>
                                <div class="col-10"></div>
                                <div class="col-2"><button class="btn btn-alt-info btn-hero" onclick="addChild(this, '{{$key}}');" type="button"><i class="fa fa-plus"></i> Tambah</button></div>
                            </div>
                            <hr>
                            <br>
                        @endforeach
                    <button type="submit" class="btn btn-alt-success">Simpan</button>
                </form>
            </div>
        </div>
    </div>
    </div>
</main>
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