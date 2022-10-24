@extends('rawatjalan.video.layouts.main')


@section('title')
    File Penunjang
@endsection


@section('content')
    <div >
        
        
        <form  method="POST" accept-charset="UTF-8" enctype="multipart/form-data" action="{{url('rawatjalan/video/penunjang')}}">
                        {{csrf_field()}}
            <input type="hidden" name="transaksi_id" value="{{$id}}">
            <div class="form-group">
                <label class="control-label">Keluhan<small>(Opsional)</small></label>
                <div class="row">
                    <div class="col-10">
                        <div class="form-group row">
                            <textarea class="form-control" name="keluhan" id="keluhan"></textarea>
                        </div>
                    </div>
                    <div class="col-2">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">
                    Gambar <small>(Opsional)</small>
                </label>
                <div id="gambar_content">
                    <div class="row gambar_row">
                        <div class="col-8">
                            <div class="form-group row">
                                <input type="file" id="upload_gambar" name="link_gambar[]" accept="image/*" class="form-control" style="overflow: hidden; display: block;" multiple>
                            </div>
                        </div>
                        <div class="col-1">
                            <div class="form-group row">
                                <div class="col-12 pt-5">
                                    <a href="javascript:void(0);" class="gambar_remove_button"><span class="fa fa-2x fa-trash" style="color: red;"></span></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">
                    Video <small>(Opsional)</small>
                </label>
                <div id="video_content">
                    <div class="row video_row">
                        <div class="col-8">
                            <div class="form-group row">
                                <input type="file" id="upload_video" name="link_video[]" accept="video/*" class="form-control" style="overflow: hidden; display: block;" multiple>
                            </div>
                        </div>
                        <div class="col-1">
                            <div class="form-group row">
                                <div class="col-12 pt-5">
                                    <a href="javascript:void(0);" class="video_remove_button"><span class="fa fa-2x fa-trash" style="color: red;"></span></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">
                    Audio <small>(Opsional)</small>
                </label>
                <div id="audio_content">
                    <div class="row audio_row">
                        <div class="col-8">
                            <div class="form-group row">
                                <input type="file" id="upload_audio" name="link_audio[]" accept="audio/*" class="form-control" style="overflow: hidden; display: block;" multiple>
                            </div>
                        </div>
                        <div class="col-1">
                            <div class="form-group row">
                                <div class="col-12 pt-5">
                                    <a href="javascript:void(0);" class="audio_remove_button"><span class="fa fa-2x fa-trash" style="color: red;"></span></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                        </div>
                    </div>
                </div>
                
            </div>

            <div class="row">
                <button type="submit" class="btn btn-primary btn-square">
                    <i class="fa fa-save"></i> Simpan
                </button>
            </div>
        </form>
    </div>
@endsection

@section('css')
    <style type="text/css">
        .error {
            color: red;
        }

        .inline {
            display: inline;
        }

        .modal-content {
            border-radius: 0;
        }

        tr {
            cursor: pointer;
        }

        .bootstrap-tagsinput {
            width: 100%;
        }

        .bootstrap-tagsinput .tag {
            background-color: deepskyblue;
        }
    </style>
@endsection

@section('js')
    <script>
        // $(document).on('click', '#gambar_add_row', function () {
        //     temp1 = $('#gambar_content .row:first').clone();
        //     temp1.find("input").val("");
        //     $('#gambar_content').append(temp1);
        //     // $(this).siblings('input[name="link_gambar[]"]').val();
        // })
        // $(document).on('click', '#audio_add_row', function () {
        //     temp2 = $('#audio_content .row:first').clone();
        //     temp2.find("input").val("");
        //     $('#audio_content').append(temp2);
        // })
        // $(document).on('click', '#video_add_row', function () {
        //     temp3 = $('#gambar_content .row:first').clone();
        //     temp3.find("input").val("");
        //     $('#video_content').append(temp3);
        // })

        $(document).on('click', '.gambar_remove_button', function () {
            $('#gambar_content .row:first').find("input").val("");
        })
        $(document).on('click', '.video_remove_button', function () {
            $('#video_content .row:first').find("input").val("");
        })
        $(document).on('click', '.audio_remove_button', function () {
            $('#audio_content .row:first').find("input").val("");
        })
    </script>
@endsection

