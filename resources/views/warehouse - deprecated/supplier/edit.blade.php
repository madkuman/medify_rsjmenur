@extends('layouts.main',['app' => "warehouse"])

@section('title')
Supplier - Pergudangan - Medify
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
            Edit Supplier<br>
            <small>
                Anda akan Mengubah data supplier
            </small>
        </div>
    </div>

    <div class="card stacked-form">
        <div class="card-header">
            <h5 class="card-title text-center">Isi data dengan benar</h5>
        </div>
        <div class="card-body ">
            <form method="POST" enctype="multipart/form-data" action="{{url('warehouse/supplier/edit/')}}" id="editSuppForm">
                {{csrf_field()}}
                <input type="hidden" name="slug" value="{{$supplier->slug}}">
                <input type="hidden" name="id" value="{{$supplier->id}}">
                <div class="form-group">
                    <label>Nama Perusahaan <star class="star">*</star></label>
                    <input class="form-control" type="text" id="nameBar" name="name" value="{{$supplier->nama}}" onblur="checkName()">
                    <div id="nameCheck"></div>
                </div>
                <div class="form-group">
                    <label>Pilih Jenis Supplier <star class="star">*</star></label>
                    <select class="selectpicker" data-style="btn-default btn-outline" name="type">
                        <option value="">Pilih</option>
                        <option @if($supplier->jenis == "Obat - Obatan") selected @endif value="Obat - Obatan">Obat - Obatan</option>
                        <option @if($supplier->jenis == "Perlengkapan") selected @endif value="Perlengkapan">Perlengkapan
                        </option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Alamat Perusahaan <star class="star">*</star></label>
                    <input class="form-control" type="text" name="address" value="{{$supplier->alamat}}">
                </div>
                <div class="form-group">
                    <label>Telepon Perusahaan <star class="star">*</star></label>
                    <input class="form-control" type="text" name="phone" value="{{$supplier->telepon}}">
                </div>
                <div class="form-group">
                    <label>Nama Agen Perusahaan <star class="star">*</star></label>
                    <input class="form-control" type="text" name="agent" value="{{$supplier->agen}}">
                </div>
                <div class="form-group">
                    <label>Keterangan Supplier <small>Opsional</small></label>
                    <textarea name="desc" class="form-control" rows="4">{{$supplier->deskripsi}}</textarea>
                </div>
                <div class="form-group">
                    <label>Logo Supplier <small>Opsional</small></label>
                    <div class="preview-zone" style="text-align: center;">
                        <div class="box box-solid">
                            <div class="box-header with-border" style="border-bottom: 1px solid #333;">
                                <div>Preview</div>
                            </div>
                            <div class="box-body" style="padding: 20px;">
                                <div class="pull-right">
                                    <button type="button" class="btn btn-sm btn-warning edit-preview" title="Tekan untuk mengubah gambar ini"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                                </div>
                                <div class="preview-img">
                                    <img src="{{asset($supplier->foto)}}" id="preview" height="200" class="img-responsive img-rounded">
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="file" id="inputImg" name="image" class="form-control hidden change-img" style="margin-bottom: 20px;" value="">
                    {{-- <img src="{{asset($supplier->foto)}}" id="preview" height="200" class="img-responsive img-rounded"> --}}
                </div>
                <div class="form-group">
                    <small><b>Catatan :</b></small>
                    <br>
                    <small><star class="star">(*)<star> Kolom wajib diisi</small>
                </div>
                <div class="card-footer">
                    <div class="pull-right">
                        <a href="{{url('warehouse/supplier/')}}" class="btn btn-default btn-fill">
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
        .hidden {
            display: none;
        }
    </style>
@endsection

@section('js')
    <script type="text/javascript">
       $(document).ready(function(){
            $('#editSuppForm').validate({
                rules: {
                    name: {
                        required: true,
                    },
                    address: {
                        required: true,
                    },
                    phone: {
                        required: true,
                    },
                    agent: {
                        required: true,
                    },
                    type: {
                        required: true,
                    },
                },

                messages: {
                    name: {
                        required: "Kolom ini wajib diisi."
                    },
                    address: {
                        required: "Kolom ini wajib diisi."
                    },
                    phone: {
                        required: "Kolom ini wajib diisi."
                    },
                    agent: {
                        required: "Kolom ini wajib diisi."
                    },
                    type: {
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
            //console.log(e);
            e.wrap('<form>').closest('form').get(0).reset();
            e.unwrap();
        }

        function checkName() {
          var name = $('#nameBar').val();
          var str = "";

          if(name.length > 3) {
            $.ajax({
               type:'GET',
               url:'{{url("warehouse/supplier/search")}}/' + name,
               dataType: 'json',
               success:function(data){
                    var length = data.count > 3 ? 3 : data.count ;
                    if(data.count > 0) 
                    {
                        str += "Terdapat Nama Supplier yang mirip : ";
                        for (var i = 0; i < length; i++) {
                            if(i!=0) str+= ", ";
                            str += data.data[i].nama;
                            console.log(data.data[i]);
                        }
                    }
                    else str += "Nama supplier tersedia";
                    
                    document.getElementById("nameCheck").innerHTML = str;
                }
            });
          }
          else document.getElementById("nameCheck").innerHTML = "";

        };

        $('.change-img').change(function() {
            //console.log(this);
            readImage(this);
        });

        $('.edit-preview').on('click', function() {
            var previewZone = $(this).parents('.preview-zone');
            var input = $(this).parents('.form-group').find('#inputImg');
            var changeImg = $(this).parents('.form-group').find('.change-img');

            previewZone.addClass('hidden');
            input.removeClass('hidden');
            resetImg(changeImg);
        });

    </script>
@endsection