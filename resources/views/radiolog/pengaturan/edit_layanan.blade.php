@extends('layouts.main2')
@section('title')
Laboratorium Radiologi
@endsection
@section('content')
@include('radiolog.components.header')

<div class="content">
    <div class="block block-themed">
        <div class="block-header" style="background-color:#ffffff">
            <h3 class="block-title" style="font-weight: 550; color: black">Ubah Tarif {{$tarif->deskripsi}}</h3>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="block-content">
                    {{ Form::open(['url' => 'radiologi/pengaturan/layanan/', 'method' => 'POST', 'id' => 'tarifForm'])}}
                    <input type="hidden" name="tarif_id" value="{{$tarif->id}}">    
                    <h5>Biasa</h5>
                    <div class="form-group">
                        {{ Form::label('1_urj', 'URJ')}}
                        {{ Form::text('1_urj', $biasa['urj'], array('class' => 'form-control'))}}
                    </div>
                    <div class="form-group">
                        {{ Form::label('1_igd', 'IGD')}}
                        {{ Form::text('1_igd', $biasa['igd'], array('class' => 'form-control'))}}
                    </div>
                    <div class="form-group">
                        {{ Form::label('1_vvip', 'VVIP')}}
                        {{ Form::text('1_vvip', $biasa['vvip'], array('class' => 'form-control'))}}
                    </div>
                    <div class="form-group">
                        {{ Form::label('1_vip_a', 'VIP A')}}
                        {{ Form::text('1_vip_a', $biasa['vip_a'], array('class' => 'form-control'))}}
                    </div>
                    <div class="form-group">
                        {{ Form::label('1_vip_paviliun', 'VIP Paviliun')}}
                        {{ Form::text('1_vip_paviliun', $biasa['vip_paviliun'], array('class' => 'form-control'))}}
                    </div>
                    <div class="form-group">
                        {{ Form::label('1_i_paviliun', 'I Paviliun')}}
                        {{ Form::text('1_i_paviliun', $biasa['i_paviliun'], array('class' => 'form-control'))}}
                    </div>
                    <div class="form-group">
                        {{ Form::label('1_vip_ruangan', 'VIP Ruangan')}}
                        {{ Form::text('1_vip_ruangan', $biasa['vip_ruangan'], array('class' => 'form-control'))}}
                    </div>
                    <div class="form-group">
                        {{ Form::label('1_i_a', 'I A')}}
                        {{ Form::text('1_i_a', $biasa['i_a'], array('class' => 'form-control'))}}
                    </div>
                    <div class="form-group">
                        {{ Form::label('1_i_b', 'I B')}}
                        {{ Form::text('1_i_b', $biasa['i_b'], array('class' => 'form-control'))}}
                    </div>
                    <div class="form-group">
                        {{ Form::label('1_ii', 'II')}}
                        {{ Form::text('1_ii', $biasa['ii'], array('class' => 'form-control'))}}
                    </div>
                    <div class="form-group">
                        {{ Form::label('1_iii_ac', 'III (AC)')}}
                        {{ Form::text('1_iii_ac', $biasa['iii_ac'], array('class' => 'form-control'))}}
                    </div>
                    <div class="form-group">
                        {{ Form::label('1_iii_non_ac', 'III (Non AC)')}}
                        {{ Form::text('1_iii_non_ac', $biasa['iii_non_ac'], array('class' => 'form-control'))}}
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="block-content">
                    <h5>CITO</h5>
                    <div class="form-group">
                        {{ Form::label('2_urj', 'URJ')}}
                        {{ Form::text('2_urj', $cito['urj'], array('class' => 'form-control'))}}
                    </div>
                    <div class="form-group">
                        {{ Form::label('2_igd', 'IGD')}}
                        {{ Form::text('2_igd', $cito['igd'], array('class' => 'form-control'))}}
                    </div>
                    <div class="form-group">
                        {{ Form::label('2_vvip', 'VVIP')}}
                        {{ Form::text('2_vvip', $cito['vvip'], array('class' => 'form-control'))}}
                    </div>
                    <div class="form-group">
                        {{ Form::label('2_vip_a', 'VIP A')}}
                        {{ Form::text('2_vip_a', $cito['vip_a'], array('class' => 'form-control'))}}
                    </div>
                    <div class="form-group">
                        {{ Form::label('2_vip_paviliun', 'VIP Paviliun')}}
                        {{ Form::text('2_vip_paviliun', $cito['vip_paviliun'], array('class' => 'form-control'))}}
                    </div>
                    <div class="form-group">
                        {{ Form::label('2_i_paviliun', 'I Paviliun')}}
                        {{ Form::text('2_i_paviliun', $cito['i_paviliun'], array('class' => 'form-control'))}}
                    </div>
                    <div class="form-group">
                        {{ Form::label('2_vip_ruangan', 'VIP Ruangan')}}
                        {{ Form::text('2_vip_ruangan', $cito['vip_ruangan'], array('class' => 'form-control'))}}
                    </div>
                    <div class="form-group">
                        {{ Form::label('2_i_a', 'I A')}}
                        {{ Form::text('2_i_a', $cito['i_a'], array('class' => 'form-control'))}}
                    </div>
                    <div class="form-group">
                        {{ Form::label('2_i_b', 'I B')}}
                        {{ Form::text('2_i_b', $cito['i_b'], array('class' => 'form-control'))}}
                    </div>
                    <div class="form-group">
                        {{ Form::label('2_ii', 'II')}}
                        {{ Form::text('2_ii', $cito['ii'], array('class' => 'form-control'))}}
                    </div>
                    <div class="form-group">
                        {{ Form::label('2_iii_ac', 'III (AC)')}}
                        {{ Form::text('2_iii_ac', $cito['iii_ac'], array('class' => 'form-control'))}}
                    </div>
                    <div class="form-group">
                        {{ Form::label('2_iii_non_ac', 'III (Non AC)')}}
                        {{ Form::text('2_iii_non_ac', $cito['iii_non_ac'], array('class' => 'form-control'))}}
                    </div>
                </form>
                    <button type="button" class="btn btn-rounded btn-primary btn-noborder" data-toggle="modal" data-target="#modalConfirmation" style="float: right">Simpan</button>
                    <br><br>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalConfirmation" tabindex="-1" role="dialog" aria-labelledby="modalConfirmation" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-popin" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Simpan Perubahan</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <p>Apakah anda yakin untuk menyimpan perubahan?</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Batal</button>
                <button type="button" onclick="submitForm();" class="btn btn-alt-success" data-dismiss="modal">
                    <i class="fa fa-check"></i> Lanjut
                </button>
            </div>
        </div>
    </div>
</div>
@include('radiolog.components.footer')

@endsection
@section('js')
<script type="text/javascript">
    function submitForm() {
        $("#tarifForm").submit();
    }
</script>
@endsection