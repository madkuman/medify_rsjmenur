@extends('layouts.main',['app' => "warehouse"])

@section('title')
Item - Pergudangan - Medify
@endsection

@section('sidebarcomponent')
    @include('warehouse.components.sidebar')
@endsection

@section('content')
    <div class="row page-title-container">
        <div class="icon">
            <i class="fa fa-plus"></i>
        </div>
        <div class="title">
            Tambah Barang<br>
            <small>
                Anda akan menambah barang baru
            </small>
        </div>
    </div>

    <div class="card stacked-form">
        <div class="card-header">
            <h5 class="card-title text-center">Isi data dengan benar</h5>
        </div>
        <div class="card-body">
            <form action="{{url('warehouse/item')}}" method="POST" enctype="multipart/form-data" id="itemsForm">
                {{csrf_field()}}
                <div class="form-group">
                    <label>Nama Barang <star class="star">*</star></label>
                    <input type="text" class="form-control" placeholder="Nama Barang" name="name" id="nameBar" onblur="checkName()">
                    <small class="form-text text-muted" id="nameCheck"></small>
                </div>
                <div class="form-group">
                    <label>Asal Perusahaan <star class="star">*</star></label>
                    <select class="selectpicker" data-style="btn-default btn-outline" data-live-search="true" data-width="100%" data-size="4" name="supplier">
                        <option selected disabled="">Pilih</option>
                        @foreach($supplier as $supplier)
                        <option value="{{$supplier->id}}">{{$supplier->nama}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Jenis Barang <star class="star">*</star></label>
                    <select class="selectpicker" data-style="btn-default btn-outline" name="type" id="selectType" onchange="changeField()">
                        <option selected disabled="">Pilih</option>
                        <option value="1">Obat</option>
                        <option value="2">Alat Kesehatan</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Deskripsi Barang <small>Opsional</small></label>
                    <textarea class="form-control" placeholder="ex : Barang tertukar" rows="4" name="desc"></textarea>
                </div>
                <div class="form-group">
                    <label>Jumlah Barang <star class="star">*</star></label>
                    <input type="number" class="form-control" placeholder="ex : 100" name="qty_total">
                </div>
                <div class="form-group" id="jumlahSiap">
                    
                </div>
                <div class="form-group">
                    <label>Harga Beli Barang <star class="star">*</star></label>
                    <input type="text" class="form-control" placeholder="ex : 10000" name="itemPrice" id="item-price">
                    <input type="hidden" name="price" id="real-item-price">
                </div>
                <div class="form-group">
                    <label>Gambar Barang <small>Opsional</small></label>
                    <div class="preview-zone hidden" style="text-align: center;">
                        <div class="box box-solid">
                            <div class="box-header with-border" style="border-bottom: 1px solid #333;">
                                <div>Preview</div>
                            </div>
                            <div class="box-body" style="padding: 20px;">
                                <div class="pull-right">
                                    <button type="button" class="btn btn-sm btn-danger remove-preview" title="Tekan untuk menghapus gambar ini"><i class="fa fa-times"></i></button>
                                </div>
                                <div class="preview-img"></div>
                            </div>
                        </div>
                    </div>
                    <input type="file" id="inputImg" name="input_image" class="form-control change-img">
                </div>
                <div class="form-group">
                    <small><b>Catatan :</b></small>
                    <br>
                    <small><star class="star">(*)<star> Kolom wajib diisi</small>
                </div>
                <div class="card-footer">
                    <div class="pull-right">
                        <button type="submit" class="btn btn-fill btn-primary">
                            <i class="fa fa-floppy-o" aria-hidden="true"></i> Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

{{-- <div class="col-md-7 card main-content" style="">
    <form action="{{url('warehouse/item')}}" method="POST" enctype="multipart/form-data">
        {{csrf_field()}}
        <h4>Tambah Barang Baru
        </h4>

        <hr class="big">
        <div class="row">
            <div class="col-md-12 form-container">
                <label>Nama Barang</label><br>
                <input type="text" class="form-control" id="nameBar" placeholder="Nama Barang" name="name" onblur="checkName()">
                
            </div>
            <div class="col-md-12 form-container">
                <label>Asal Perusahaan</label>
                <select class="selectpicker" data-live-search="true" data-width="100%" name="supplier">
                    <option selected disabled="">Pilih</option>
                    @foreach($supplier as $supp)
                    <option value="{{$supp->id}}">{{$supp->nama}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-12 form-container">
                <label>Jenis Barang</label>
                <div  style="margin-bottom: 10px">
                    <select class="selectpicker" name="type">
                        <option value="1">Obat</option>
                        <option value="2">Alat Kesehatan</option>
                    </select>
                </div>
                <label>Deskripsi Barang (Opsional)</label>
                <textarea class="form-control" placeholder="ex : Barang tertukar" rows="4" name="desc"></textarea>
            </div>
            <div class="col-md-12 form-container">
                <label>Jumlah Barang</label><br>
                <input type="number" class="form-control" placeholder="ex : 100" name="qty_total">
                <small class="form-text text-muted">Masukkan harga tanpa rupiah dan titik/koma. Misal : 20000</small>
            </div>
            <div class="col-md-12 form-container">
                <label>Harga Beli Barang</label><br>
                <input type="number" class="form-control" placeholder="ex : 10000" name="price">
                <small class="form-text text-muted">Masukkan harga tanpa rupiah dan titik/koma. Misal : 20000</small>
            </div>
            <div class="col-md-12 form-container">
                <label>Gambar Barang</label><br>
                <input type="file" id="inputImg" name="input_image" class="form-control" style="margin-bottom: 20px;">
                <img id="preview" height="200" class="img-responsive img-rounded">
            </div>

            <div class="col-md-12 form-container">
                <button class="btn btn-fill btn-primary btn-md btn-block" type="submit"><i class="fa fa-paper-plane"></i> Submit</button>
            </div>
        </div>
    </form>
</div>
<div id="detailModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="post-creator">
                    <strong>Faiq Firdausy </strong> <small class="text-muted"> 2 jam</small>
                    <div class="text-muted">
                        <small>
                            <i class="fa fa-mail-reply-all"></i>
                            Apotek Utama Rumah Sakit
                        </small>
                    </div>
                </h4>
            </div>
            <div class="modal-body">
                <p>Retur - barang rusak</p>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Nama</th>
                                <th>Jenis</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center">1</td>
                                <td>Paramex</td>
                                <td>Obat</td>
                                <td>200</td>
                            </tr>
                            <tr>
                                <td class="text-center">2</td>
                                <td>Paramex</td>
                                <td>Obat</td>
                                <td>200</td>
                            </tr>
                            <tr>
                                <td class="text-center">3</td>
                                <td>Paramex</td>
                                <td>Obat</td>
                                <td>200</td>
                            </tr>
                            <tr>
                                <td class="text-center">4</td>
                                <td>Paramex</td>
                                <td>Obat</td>
                                <td>200</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btn-fill" >Kirim</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div> --}}
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
        formValidate();
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

    function formValidate() {
        $('#itemsForm').validate({
            rules: {
                name: {
                    required: true,
                },
                company: {
                    required: true,
                },
                type: {
                    required: true,
                },
                qty_total: {
                    required: true,
                },
                itemPrice: {
                    required: true,
                },
            },
            messages: {
                name: {
                    required: "Kolom ini wajib di isi"
                },
                company: {
                    required: "Kolom ini wajib di isi"
                },
                type: {
                    required: "Kolom ini wajib di isi"
                },
                qty_total: {
                    required: "Kolom ini wajib di isi",
                },
                itemPrice: {
                    required: "Kolom ini wajib di isi",
                },
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
        })
    }

    function changeField() {
        var type = $('#selectType').val();
        var str = `<label>Jumlah Barang Siap Pakai<star class="star">*</star></label>
                    <input type="number" class="form-control" placeholder="ex : 100" name="qty_ready">`
        if(type==2) document.getElementById("jumlahSiap").innerHTML = str;
        else document.getElementById("jumlahSiap").innerHTML = "";
    }

    function checkName() {
      var name = $('#nameBar').val();
      var str = "";
      
      if(name.length > 3) {
        $.ajax({
           type:'GET',
           url:'{{url("warehouse/item/search")}}/' + name,
           dataType: 'json',
           beforeSend: function() {
                console.log("loading...");
                var loadingScreen = 
                    '<i class="fa fa-spinner fa-spin"></i> Sedang memeriksa...';
                $('#nameCheck').html(loadingScreen);
            },
           success:function(data){
            console.log(data);
                var length = data.total > 3 ? 3 : data.total ;
                if(data.total > 0) 
                {
                    str += "Terdapat Nama Barang yang mirip : ";
                    for (var i = 0; i < length; i++) {
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

    $('.remove-preview').on('click', function() {
        var boxZone = $(this).parents('.preview-zone').find('.box-body');
        var previewZone = $(this).parents('.preview-zone');
        var changeImg = $(this).parents('.form-group').find('.change-img');
        boxZone.empty();
        previewZone.addClass('hidden');
        resetImg(changeImg);
    });

    $('.change-img').change(function() {
        readImage(this);
    });
</script>
@endsection