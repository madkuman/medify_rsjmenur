@extends('layouts.main2')

@section('title')
Pengaturan Publikasi
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
                        <form method="POST" class="col-md-12">
                            {{csrf_field()}}
                            <h4 class="font-w400 mb-5 text-center">Publikasi</h4>
                            <hr>
                            <div class="row">
                                <label class="css-control css-control-primary css-switch col-md-12">
                                    @if(!empty($user->allow_publish))
                                    @if($user->allow_publish)
                                    <input type="checkbox" id="allow-publish" class="css-control-input" name="allow_publish" value="1" checked="checked">
                                    @else
                                    <input type="checkbox" id="allow-publish" class="css-control-input" name="allow_publish" value="1">
                                    @endif
                                    @else
                                    <input type="checkbox" id="allow-publish" class="css-control-input" name="allow_publish" value="1">
                                    @endif
                                    <span class="css-control-indicator"></span>
                                    Izinkan publikasi profil saya ke website RS
                                </label>
                                <br>
                                <div class="row allowed-field px-20">
                                    <label class="css-control css-control-sm css-control-primary css-switch col-md-12">
                                        <hr class="mb-5">
                                        @if(!empty($user->allow_pendidikan))
                                        @if($user->allow_pendidikan)
                                        <input type="checkbox" class="css-control-input" name="pendidikan" value="1" checked="checked">
                                        @else
                                        <input type="checkbox" class="css-control-input" name="pendidikan" value="1">
                                        @endif
                                        @else
                                        <input type="checkbox" class="css-control-input" name="pendidikan" value="1">
                                        @endif
                                        <span class="css-control-indicator"></span>
                                        Tampilkan riwayat pendidikan saya
                                    </label>
                                    <br>
                                    <label class="css-control css-control-sm css-control-primary css-switch col-md-12">
                                        @if(!empty($user->allow_pelatihan))
                                        @if($user->allow_pelatihan)
                                        <input type="checkbox" class="css-control-input" name="pelatihan" value="1" checked="checked">
                                        @else
                                        <input type="checkbox" class="css-control-input" name="pelatihan" value="1">
                                        @endif
                                        @else
                                        <input type="checkbox" class="css-control-input" name="pelatihan" value="1">
                                        @endif
                                        <span class="css-control-indicator"></span>
                                        Tampilkan riwayat pelatihan saya
                                    </label>
                                    <br>
                                    <label class="css-control css-control-sm css-control-primary css-switch col-md-12">
                                        @if(!empty($user->allow_karya))
                                        @if($user->allow_karya)
                                        <input type="checkbox" class="css-control-input" name="karya" value="1" checked="checked">
                                        @else
                                        <input type="checkbox" class="css-control-input" name="karya" value="1">
                                        @endif
                                        @else
                                        <input type="checkbox" class="css-control-input" name="karya" value="1">
                                        @endif
                                        <span class="css-control-indicator"></span>
                                        Tampilkan karya-karya saya
                                    </label>
                                    <br>
                                    <label class="css-control css-control-sm css-control-primary css-switch col-md-12">
                                        @if(!empty($user->allow_skill))
                                        @if($user->allow_skill)
                                        <input type="checkbox" class="css-control-input" name="skill" value="1" checked="checked">
                                        @else
                                        <input type="checkbox" class="css-control-input" name="skill" value="1">
                                        @endif
                                        @else
                                        <input type="checkbox" class="css-control-input" name="skill" value="1">
                                        @endif
                                        <span class="css-control-indicator"></span>
                                        Tampilkan skill-skill saya
                                    </label>
                                    <br>
                                    <label class="css-control css-control-sm css-control-primary css-switch col-md-12">
                                        @if(!empty($user->allow_kasus))
                                        @if($user->allow_kasus)
                                        <input type="checkbox" class="css-control-input" name="kasus" value="1" checked="checked">
                                        @else
                                        <input type="checkbox" class="css-control-input" name="kasus" value="1">
                                        @endif
                                        @else
                                        <input type="checkbox" class="css-control-input" name="kasus" value="1">
                                        @endif
                                        <span class="css-control-indicator"></span>
                                        Tampilkan histori kasus saya
                                    </label>
                                    <br>
                                    @if(Auth::user()->profesi == 1)
                                    <label class="css-control css-control-sm css-control-primary css-switch col-md-12">
                                        @if(!empty($user->allow_jadwal))
                                        @if($user->allow_jadwal)
                                        <input type="checkbox" class="css-control-input" name="jadwal" value="1" checked="checked">
                                        @else
                                        <input type="checkbox" class="css-control-input" name="jadwal" value="1">
                                        @endif
                                        @else
                                        <input type="checkbox" class="css-control-input" name="jadwal" value="1">
                                        @endif
                                        <span class="css-control-indicator"></span>
                                        Tampilkan jadwal praktek saya
                                    </label>
                                    @endif
                                </div>
                            </div>
                            <hr>
                            <button type="submit" id="btn_submit" class="btn btn-block btn-primary mt-10">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection

@section('js')
<script src="assets/js/pages/be_pages_dashboard.js"></script>
<script>
    $(document).ready(function(){
        $('#profesi').select2();
        $('#spesialisasi').select2();
        if($('#allow-publish').prop('checked') == true){
            $('.allowed-field').show();
        }
        else{
            $('.allowed-field').hide();
        }

        $('#allow-publish').change(function(){
            if($('#allow-publish').prop('checked') == true){
                $('.allowed-field').show(500);
            }
            else{
                $('.allowed-field').hide(500);
                $('.css-control-input').prop('checked', false);
            }
        });
    });
</script>
@endsection
