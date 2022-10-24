@extends('layouts.main2')

@section('title')
Pengaturan Profesi
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
                            <h4 class="font-w400 mb-5 text-center">Profesi</h4>
                            <hr>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label">Profesi</label>
                                        <div >
                                            <select class="js-select2 form-control" id="profesi" name="profession" data-placeholder="{{Auth::user()->profesi_detail->title}}" disabled="disabled">
                                                <option value=""></option>
                                            </select>
                                        </div>
                                    </div>
                                    @if(!empty($specialty))
                                    <div class="form-group">
                                        <label class="">Spesialisasi</label>
                                        <div class="">
                                            <select class="js-select2 form-control" id="spesialisasi" name="specialty" data-placeholder="">
                                                @foreach($specialty as $id => $title)
                                                <option value="{{ $id }}" @if(Auth::user()->specialty == $id) selected @endif>{{ $title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    @endif

                                    @if(Auth::user()->profesi_detail->title == 'Dokter')
                                    <div class="form-group" id="subsp_select">
                                        <label class="">Sub Spesialisasi</label>
                                        <select class="js-select2 form-control" id="subspesialis" name="subspecialty">
                                            <option value="">Tanpa Subspesialis</option>
                                            @foreach($subspecialty as $item)
                                            <option value="{{ $item->id }}"  @if(Auth::user()->subspecialty == $item->id) selected @endif >{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div> 
                                    @endif


                                    @if(Auth::user()->profesi_detail->title == 'Dokter' || Auth::user()->profesi_detail->title == 'Apoteker' || Auth::user()->profesi_detail->title == 'Perawat')

                                    <div class="form-group">
                                        <label class="">SIP</label>
                                        <div class="">
                                            <input type="text" class="form-control" name="sip" 
                                            value=
                                            @if(!empty(Auth::user()->sip))
                                            "{{Auth::user()->sip}}"
                                            @else
                                            ""
                                            @endif 
                                            required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="">STR</label>
                                        <div>
                                            <input type="text" class="form-control" name="str" 
                                            value=
                                            @if(!empty(Auth::user()->str))
                                            "{{Auth::user()->str}}"
                                            @else
                                            ""
                                            @endif 
                                            required>
                                        </div>
                                    </div>
                                    @endif
                                </label">
                            </div>
                            <button type="submit" id="btn_submit" class="btn btn-block btn-primary">Simpan</button>
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
    });
</script>
@endsection
