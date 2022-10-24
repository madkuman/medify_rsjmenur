@extends('layouts.main',['app' => "warehouse"])

@section('title')
Item Edit - Pergudangan - Medify
@endsection

@section('sidebarcomponent')
    @include('warehouse.components.sidebar')
@endsection

@section('content')
<div class="row page-title-container">
    <div class="icon">
        <i class="fa fa-pencil"></i>
    </div>
    <div class="title">
        Edit Barang<br>
        <small>
            Anda akan Mengubah data barang
        </small>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="card-title text-center">Isi data dengan benar</h5>
    </div>
    <div class="card-body">
        <form action="{{url('warehouse/item/edit')}}" method="POST" enctype="multipart/form-data" id="editItemForm">
            {{csrf_field()}}
            <input type="hidden" name="id" value="{{$items->id}}">
            <div class="form-group">
                <label>Nama Barang <star class="star">*<star></label>
                <input type="text" class="form-control" id="nameBar" placeholder="Nama Barang" name="name" value="{{$items->name}}" onblur="checkName()">
                <div id="nameCheck"></div>
            </div>
            <div class="form-group">
                <label>Asal Perusahaan <star class="star">*<star></label>
                <select class="selectpicker" data-live-search="true" data-width="100%" name="supplier" data-style="btn-default btn-outline">
                    <option disabled="">Pilih</option>
                    @foreach($supplier as $supp)
                    <option value="{{$supp->id}}" @if($items->supplier == $supp->id) selected @endif>{{$supp->nama}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Jenis Barang <star class="star">*<star></label>
                <select class="selectpicker" name="type" data-style="btn-default btn-outline">
                    <option @if($items->type == "1") selected @endif value="1">Obat</option>
                    <option @if($items->type == "2") selected @endif value="2">Alat Kesehatan</option>
                </select>
            </div>
            <div class="form-group">
                <label>Deskripsi Barang <small>Opsional</small></label>
                <textarea class="form-control" placeholder="ex : Barang tertukar" rows="4" name="desc">{{$items->description}}</textarea>
            </div>
            <div class="form-group">
                <label>Harga Beli Barang <star class="star">*<star></label>
                <input type="text" class="form-control" placeholder="ex : 10000" name="itemPrice" id="item-price" value="{{$items->price}}">
                <input type="hidden" name="price" id="real-item-price" value="{{$items->price}}">
            </div>
            <div class="form-group">
                <label>Gambar Barang <small>Opsional</small></label>
                <div class="preview-zone {{(!is_null($items->image_thumb)) ? "" : "hidden"}}" style="text-align: center;">
                    <div class="box box-solid">
                        <div class="box-header with-border" style="border-bottom: 1px solid #333;">
                            <div>Preview</div>
                        </div>
                        <div class="box-body" style="padding: 20px;">
                            <div class="pull-right">
                                <button type="button" class="btn btn-sm btn-warning edit-preview" title="Tekan untuk mengubah gambar ini"><i class="fa fa-pencil"></i></button>
                            </div>
                            <div class="preview-img">
                            	<img src="{{asset($items->image_thumb)}}" id="preview" height="200" class="img-responsive img-rounded">
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <input type="file" id="inputImg" name="image" class="form-control change-img"> --}}
                {{-- <input type="file" class="form-control change-img" name="input_image"> --}}
                <input type="file" id="inputImg" name="input_image" class="form-control hidden change-img" style="margin-bottom: 20px;" value="">
            </div>
            <div class="form-group">
                <small><b>Catatan :</b></small>
                <br>
                <small><star class="star">(*)<star> Kolom wajib diisi</small>
            </div>

            <div class="card-footer">
                <div class="pull-right">
                    <a href="{{url('warehouse/item/'.$items->slug)}}" class="btn btn-default btn-fill">
                        Batal
                    </a>
                    <button type="submit" class="btn btn-fill btn-primary">
                        <i class="fa fa-floppy-o" aria-hidden="true"></i> Simpan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('css')
    <style type="text/css">
        .bootstrap-select.btn-group .dropdown-menu.inner {
            max-height: 200px !important;
        }

        .hidden {
            display: none;
        }
    </style>
@endsection

@section('js')
<script src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>
<script src="//cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#editItemForm').validate({
            rules: {
                name: {
                    required: true,
                },
                supplier: {
                    required: true,
                },
                type: {
                    required: true,
                },
                itemPrice: {
                    required: true,
                }
            },

            messages: {
                name: {
                    required: "Kolom ini wajib diisi."
                },
                supplier: {
                    required: "Kolom ini wajib diisi."
                },
                type: {
                    required: "Kolom ini wajib diisi."
                },
                itemPrice: {
                    required: "Kolom ini wajib diisi."
                }
            }, 

            highlight: function(element) {
                $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
                $(element).closest('.form-check').removeClass('has-success').addClass('has-error');
            },
            success: function(element) {
                $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
                $(element).closest('.form-check').removeClass('has-error').addClass('has-success');
            },
            errorPlacement: function(error, element) {
                $(element).closest('.form-group').append(error).addClass('has-error');
            },
        });
    });

    $('#item-price').inputmask("numeric", {
        radixPoint: ",",
        groupSeparator: ",",
        //digits: 2,
        autoGroup: true,
        //prefix: 'Rp. ', //No Space, this will truncate the first character
        rightAlign: false,
        //oncleared: function () { self.Value(''); }
    });

    $("#item-price").keyup(function() {
        var price = document.getElementById("item-price").value;
        var priceReplace = price.split('.').join('');
        document.getElementById("real-item-price").value = priceReplace;
        //console.log(priceReplace);
    });

    function readImage(input){
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                var preview = 
                    '<img width="200" src="' + e.target.result + '" />'+
                    '<p>' + input.files[0].name + '</p>';
                var previewZone = $(input).parent().parent().find('.preview-zone');
                var boxZone = $(input).parent().find('.preview-zone').find('.box').find('.box-body').find('.preview-img');
                previewZone.removeClass('hidden');
                boxZone.empty();
                boxZone.append(preview);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    function resetImg(e) {
        e.wrap('<form>').closest('form').get(0).reset();
        e.unwrap();
    }

    $('.edit-preview').on('click', function() {
        var previewZone = $(this).parents('.preview-zone');
        var input = $(this).parents('.form-group').find('#inputImg');
        var changeImg = $(this).parents('.form-group').find('.change-img');

        previewZone.addClass('hidden');
        input.removeClass('hidden');
        resetImg(changeImg);
    });

    $('.change-img').change(function() {
        //console.log(this);
        readImage(this);
    });

    function checkName() {
      var name = $('#nameBar').val();
      var str = "";

      if(name.length > 3) {
        $.ajax({
           type:'GET',
           url:'{{url("warehouse/item/search")}}/' + name,
           dataType: 'json',
           success:function(data){
                
                if(data.total > 0) 
                {
                    str += "Terdapat Nama Barang yang mirip : ";
                    for (var i = 0; i < data.total; i++) {
                        if(i!=0) str+= ", ";
                        str += data.data[i].name;
                        console.log(data.data[i]);
                    }
                }
                else str += "Nama barang tersedia";
                
                document.getElementById("nameCheck").innerHTML = str;
            }
        });
      }
      else document.getElementById("nameCheck").innerHTML = "";

    };
</script>
@endsection