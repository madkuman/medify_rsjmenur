@extends('kasir.layouts.app')

@section('title')
Daftar Kasir - Kasir
@endsection

@section('content')
@include('kasir.manajemen.components.header')


    <div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title">Daftar Kasir Tersedia</h3>
            <div class="block-options">
                    <a href="{{url()->current()}}/manajemen/baru" class="btn btn-sm btn-primary btn-hero">
                        <i class="fa fa-plus"></i> Tambah Kasir
                    </a>
            </div>
        </div>
        <div class="block-content">
            <div class="row">
                @foreach($kasir as $row)
                    <div class="col-md-3">
                        <a class="block block-rounded block-link-pop text-center" href="{{url('kasir/'.$row->id.'/dashboard')}}" style="border: 1px solid #eaecee;">
                            <div class="block-content block-content-full">
                                <h4 class="font-w600 mb-5">{{$row->nama}}</h4>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
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