@extends('layouts.main-simple')

@section('css')
<style type="text/css">
    .view-resume{
        white-space: pre-line;
    }
</style>
@endsection

@section('content')
<div class="px-20 pt-20">
    <div class="text-center">
        <h3 class="mb-0">HISTORI Ringkasan Pulang</h3>
        <h4>Pasien {{$kasus->identitas->nama}}</h4>
    </div>
    <div class="row">
        @foreach ($resume as $key => $item)
        <div class="col-12">
            <div class="block block-bordered block-mode-hidden">
                <div class="block-header block-header-default">
                    <h5 class="mb-0">Kasus {{$item->kasus->judul_kasus}}</h5>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle" aria-controls="resume-item-{{$key}}"></button>
                    </div>
                </div>
                <div class="block-content soap-item" id="resume-item-{{$key}}">
                    <div class="row">
                        <h4 class="my-0">Ringkasan Pulang Medis</h4>
                        <hr class="my-20">
                        <div class="col-10">
                            <div class="form-group">
                                <label>Diagnosa Masuk</label>
                                <h5 class="font-w400 view-resume">{{$item->diagnosa_masuk}}</h5>
                            </div>
                        </div>

                        <div class="col-10">
                            <div class="form-group">
                                <label>Diagnosa Utama</label>
                                <h5 class="font-w400 view-resume">{{$item->diagnosa_utama}}</h5>
                            </div>
                        </div>

                        <div class="col-10">
                            <div class="form-group">
                                <label>Diagnosa Tambahan</label>
                                <h5 class="font-w400 view-resume">{{$item->diagnosa_tambahan}}</h5>
                            </div>
                        </div>

                        <div class="col-10">
                            <div class="form-group">
                                <label>Jenis Tindakan</label>
                                <h5 class="font-w400 view-resume">{{$item->jenis_tindakan}}</h5>
                            </div>
                        </div>

                        <div class="col-10">
                            <div class="form-group">
                                <label>Alasan Dirawat</label>
                                <h5 class="font-w400 view-resume">{{$item->alasan_rawat}}</h5>
                            </div>
                        </div>

                        <div class="col-10">
                            <div class="form-group">
                                <label>Ringkasan Penyakit</label>
                                <h5 class="font-w400 view-resume">{{$item->ringkasan}}</h5>
                            </div>
                        </div>

                        <div class="col-10">
                            <div class="form-group">
                                <label>Pemeriksaan Fisik</label>
                                <h5 class="font-w400 view-resume">{{$item->pemeriksaan_fisik}}</h5>
                            </div>
                        </div>

                        <div class="col-10">
                            <div class="form-group">
                                <label>Lab</label>
                                <h5 class="font-w400 view-resume">{{$item->lab}}</h5>
                            </div>
                        </div>

                        <div class="col-10">
                            <div class="form-group">
                                <label>Terapi Pasien</label>
                                <h5 class="font-w400 view-resume">{{$item->terapi}}</h5>
                            </div>
                        </div>

                        <div class="col-10">
                            <div class="form-group">
                                <label>Hasil Konsul</label>
                                <h5 class="font-w400 view-resume">{{$item->hasil_konsul}}</h5>
                            </div>
                        </div>

                        <div class="col-10">
                            <div class="form-group">
                                <label>Perkembangan</label>
                                <h5 class="font-w400 view-resume">{{$item->perkembangan}}</h5>
                            </div>
                        </div>

                        <div class="col-10">
                            <div class="form-group">
                                <label>Keadaan Waktu Pulang</label>
                                <h5 class="font-w400 view-resume">{{$item->keadaan_krs}}</h5>
                            </div>
                        </div>


                        <div class="col-10">
                            <div class="form-group">
                                <label>Tujuan Kontrol Poliklinik</label>
                                <h5 class="font-w400 view-resume">{{ $item->poli->name ?? '-'}}</h5>
                            </div>
                        </div>

                        <div class="col-10">
                            <div class="form-group">
                                <label>Waktu Kontrol Ulang</label>
                                <h5 class="font-w400 view-resume">{{$item->waktu_kontrol}}</h5>
                            </div>
                        </div>

                        <div class="col-10">
                            <div class="form-group">
                                <label>Instruksi / Saran tindak lanjut</label>
                                <h5 class="font-w400 view-resume">{{$item->instruksi}}</h5>
                            </div>
                        </div>

                        <div class="col-10">
                            <div class="form-group">
                                <h6>
                                    <small class="text-muted">Dibuat Oleh</small><br>
                                    {{$item->creator->name}}
                                    <span class="float-right font-w400"><i class="fa fa-clock-o text-muted"></i> {{date('l, j F Y H:i',strtotime($item->updated_at))}}</span>
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection