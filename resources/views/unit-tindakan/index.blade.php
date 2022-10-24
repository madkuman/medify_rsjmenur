@extends('farmasi.layouts.app')

@section('title')
Unit Tindakan
@endsection

@section('content')
	<div class="block">
        <div class="block-header block-header-default row mx-0">
            <h3 class="col-lg-10 col-sm-12">Daftar Unit Tindakan Tersedia</h3>
            <div class="col-lg-2 col-sm-12">
                <button class="btn btn-sm btn-primary btn-square" data-toggle="modal" data-target="#modal-large">
                    <i class="fa fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;Unit Tindakan Baru
                </button>
            </div>
        </div>
        <div class="block-content">
            <div class="row">
                @foreach($tindakan as $row)
                    <div class="col-md-3">
                        <a class="block block-rounded block-link-pop text-center" href="{{url('unit-tindakan/'.$row->slug.'/dashboard')}}" style="border: 1px solid #eaecee;">
                            <div class="block-content block-content-full">
                                <div class="font-size-h4 font-w600">{{$row->nama}}</div>
                                <!-- <div class="font-size-sm text-muted">{{$row->telepon}}</div> -->
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="modal" id="modal-large" role="dialog" aria-labelledby="modal-large" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form method="POST" enctype="multipart/form-data" action="{{url('unit-tindakan/new')}}">
                {{csrf_field()}}
                <div class="modal-content">
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header">
                            <h3 class="block-title">Tambah Unit Tindakan Baru</h3>
                        </div>
                        <div class="block-content">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input type="text" class="form-control" name="nama" placeholder="Masukkan Nama Unit Tindakan" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Poliklinik Unit </label>
                                    <select class="js-select2 form-control" id="kategori-select2" name="poli_id" style="width: 100%;">
                                        <option hidden="" disabled="">Pilih Poliklinik yang terhubung</option>
                                        <option>Tidak Terhubung Poli</option>
                                        @foreach($poli as $p)
                                            <option value="{{$p->id}}" >{{$p->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label>Lokasi Unit </label>
                                        <select class="js-select2 form-control" id="kategori-select2" name="lokasi_id" style="width: 100%;" required>
                                            <option value="0">Buat Lokasi Baru</option>
                                            @foreach($lokasi as $l)
                                                <option value="{{$l->id}}">{{$l->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-square" data-dismiss="modal">Batalkan</button>
                        <button type="submit" class="btn btn-primary btn-square">
                             <i class="fa fa-save"></i> Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('css')
	<style type="text/css">
		.card-img-top-custom {
		    display: block;
		    width: 100%;
		    height: 220px;
		}
		.modal-content {
	        border-radius: 0;
	    }
	    .modal-lg {
	        max-width: 80% !important;
	    }
	</style>
@endsection

@section('js')
	<script type="text/javascript">
		function readImage(input){
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    var preview = 
                        '<center><img width="180" src="' + e.target.result + '" />'+
                        '<p>' + input.files[0].name + '</p></center>';
                    var previewZone = $(input).parent().parent().find('.preview-zone');
                    var boxZone = $(input).parent().find('.preview-zone').find('.box').find('.box-body').find('.preview-img');
                    previewZone.removeClass('d-none');
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
            previewZone.addClass('d-none');
            resetImg(changeImg);
        });

        $('.change-img').change(function() {
            readImage(this);
        });
	</script>
@endsection