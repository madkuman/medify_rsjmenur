@extends('layouts.main2')

@section('title')
Pengaturan Akun
@endsection

@section('content')

<!-- Main Container -->
<main id="main-container">
    <div class="content">
        <div class="row">
            @include('settings.components.sidebar')
            <div class="col-md-9 mb-20">
                <div class="container bg-white px-100 py-50" data-toggle="appear">
                    <div class="row justify-content">
                        <form method="POST" class="col-md-12 text-center" enctype="multipart/form-data" id="form-ttd">
                            {{csrf_field()}}
                            <h4 class="font-w400 mb-5">Tanda Tangan</h4>
                            <hr>
                            <div style="border:solid 1px #ccc" >
                                @if(!empty(Auth::user()->ttd))
                                <img src="{{asset(Auth::user()->ttd)}}" height="200px">
                                @else
                                <img src="{{url('assets/img/image_placeholder.jpg')}}" height="200px">
                                @endif
                            </div>
                            <div class="text-center p-10 mt-20">
                                <label class="btn btn-primary btn-upload" for="inputImage" title="Upload image file">
                                    <input type="file" class="sr-only" id="inputImage" name="file" accept="image/*">
                                    <span class="docs-tooltip" data-toggle="tooltip" title="Pilih file pada perangkat Anda">
                                        <span class="fa fa-upload"></span> Upload Tanda Tangan
                                    </span>
                                </label>
                            </div>
                            <div id="cropper-img" class="hide">
                                <div class=" mb-10">
                                    <div class="text-center">
                                        <div class="btn-group push">
                                            <button type="button" class="js-tooltip btn btn-alt-primary" data-toggle="cropper" data-method="setDragMode" data-option="move" title="Set drag mode to move">
                                                <i class="fa fa-arrows"></i>
                                            </button>
                                            <button type="button" class="js-tooltip btn btn-alt-primary" data-toggle="cropper" data-method="setDragMode" data-option="crop" title="Set drag mode to crop">
                                                <i class="fa fa-crop"></i>
                                            </button>
                                        </div>
                                        <div class="btn-group push">
                                            <button type="button" class="js-tooltip btn btn-alt-primary" data-toggle="cropper" data-method="zoom" data-option="0.1" title="Zoom In">
                                                <i class="fa fa-search-plus"></i>
                                            </button>
                                            <button type="button" class="js-tooltip btn btn-alt-primary" data-toggle="cropper" data-method="zoom" data-option="-0.1" title="Zoom Out">
                                                <i class="fa fa-search-minus"></i>
                                            </button>
                                        </div>
                                        <div class="btn-group push">
                                            <button type="button" class="js-tooltip btn btn-alt-primary" data-toggle="cropper" data-method="rotate" data-option="-45" title="Rotate Left">
                                                <i class="fa fa-rotate-left"></i>
                                            </button>
                                            <button type="button" class="js-tooltip btn btn-alt-primary" data-toggle="cropper" data-method="rotate" data-option="45" title="Rotate Right">
                                                <i class="fa fa-rotate-right"></i>
                                            </button>
                                        </div>
                                        <div class="btn-group push">
                                            <button type="button" class="js-tooltip btn btn-alt-primary" data-toggle="cropper" data-method="scaleX" data-option="-1" title="Flip Horizontal">
                                                <i class="fa fa-arrows-h"></i>
                                            </button>
                                            <button type="button" class="js-tooltip btn btn-alt-primary" data-toggle="cropper" data-method="scaleY" data-option="-1" title="Flip Vertical">
                                                <i class="fa fa-arrows-v"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <!-- END Toolbar -->

                                <!-- Image Cropper -->
                                <div class="block">
                                    <div class="block-content">
                                        <div class="row items-push">
                                            <div class="col-xl-8">
                                                <div>
                                                    <img id="js-img-cropper" class="img-fluid" src="{{asset(Auth::user()->ttd_ori)}}" alt="photo">
                                                </div>
                                            </div>
                                            <div class="col-xl-4">
                                                <h6>Preview</h6>
                                                <div class="overflow-hidden mb-10" style="">
                                                    <div class="js-img-cropper-preview center-block overflow-hidden" style="height: 200px;border:solid 1px #222"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END Image Cropper -->
                                <input id="base64_img" type="hidden" name="ttd">
                                <div class="text-center">
                                    <span>Pastikan tanda tangan dapat terlihat semua pada layar <strong>Preview</strong> sebelah kanan</span>
                                    <br>
                                    <button type="button" id="btn_submit" class="btn mt-10 btn-primary" data-toggle="cropper" data-method="crop">Simpan</button>
                                </div>

                            </div>
                            <!-- END Page Content -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>




@endsection

@section('js')
<script src="{{url('')}}/assets/js/plugins/cropperjs/cropper.min.js"></script>
<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#js-img-cropper').css('background-image', 'url('+e.target.result +')');
                $('#js-img-cropper').hide();
                $('#js-img-cropper').fadeIn(650);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#avatar").change(function() {
        readURL(this);
    });

    var BeCompImageCropper = function() {
        var initImageCropper = function(){
            // Get Image Container
            var image = document.getElementById('js-img-cropper');

            var options = {
                aspectRatio: 16 / 9,
                preview: '.js-img-cropper-preview',
            };


            var cropper = new Cropper(image, options);
            var uploadedImageURL;
            var originalImageURL = image.src;
            var uploadedImageType = 'image/jpeg';
            var uploadedImageName = 'cropped.jpg';


            // Mini Cropper API
            jQuery('[data-toggle="cropper"]').on('click', function(){
                var btn     = jQuery(this);
                var method  = btn.data('method') || false;
                var option  = btn.data('option') || false;

                // Method selection
                switch(method) {
                    case 'zoom':
                    cropper.zoom(option);
                    break;
                    case 'setDragMode':
                    cropper.setDragMode(option);
                    break;
                    case 'rotate':
                    cropper.rotate(option);
                    break;
                    case 'scaleX':
                    cropper.scaleX(option);
                    btn.data('option', -(option));
                    break;
                    case 'scaleY':
                    cropper.scaleY(option);
                    btn.data('option', -(option));
                    break;
                    case 'setAspectRatio':
                    cropper.setAspectRatio(option);
                    break;
                    case 'crop':
                    canvas = cropper.getCroppedCanvas({
                        width: 500,
                        height: 500,
                    });
                    var img_url = canvas.toDataURL();
                    $('#base64_img').val(img_url);
                    $('#form-ttd').submit();

                    break;
                    case 'clear':
                    cropper.clear();
                    break;
                }
            });

            // Import image
            var inputImage = document.getElementById('inputImage');

            if (URL) {
                inputImage.onchange = function () {
                    $('#cropper-img').show()
                    var files = this.files;
                    var file;

                    if (cropper && files && files.length) {
                        file = files[0];

                        if (/^image\/\w+/.test(file.type)) {
                            uploadedImageType = file.type;
                            uploadedImageName = file.name;

                            if (uploadedImageURL) {
                                URL.revokeObjectURL(uploadedImageURL);
                            }

                            image.src = uploadedImageURL = URL.createObjectURL(file);
                            cropper.destroy();
                            cropper = new Cropper(image, options);
                            inputImage.value = null;
                        } else {
                            window.alert('Please choose an image file.');
                        }
                    }
                };
            } else {
                inputImage.disabled = true;
                inputImage.parentNode.className += ' disabled';
            }



        };

        return {
            init: function () {
                // Init Image Cropper
                initImageCropper();
            }
        };
    }();

    jQuery(function(){ BeCompImageCropper.init(); });



</script>
@endsection
