@extends('keuangan.layouts.main')

@section('title')
Rekap Penagihan Piutang @foreach($perusahaan as $item){{ $loop->first ? '' : ', ' }}{{$item->nama}}@endforeach - Keuangan
@endsection

@section('css')
@endsection
@section('content')
@include('keuangan.piutang.components.header')
@include('keuangan.piutang.components.modal-ttd')
<div class="block">
    <div class="block-content">
        <h4>Rekap Penagihan Piutang @foreach($perusahaan as $item){{ $loop->first ? '' : ', ' }}{{$item->nama}}@endforeach</h4>
        <hr>
        @if(empty($back_url))
        @php
            $back_url = url('keuangan/piutang');
        @endphp
        @endif
        <a class="btn btn-primary" href="{{$back_url}}">Kembali ke halaman sebelumnya</a>
        <button class="btn btn-warning btn-hero float-right mx-5" id="btn_tagihkan" data-valid="{{$valid_tagih}}">Tagihkan</button>
        <button class="btn btn-primary btn-hero float-right mx-5" id="btn-tambahkan-piutang" data-valid="{{$valid_tagih}}">Tambahkan ke Penagihan</button>
    </div>
    <div class="block-content">
        <form action="{{url('keuangan/piutang/tagihkan')}}?origin={{$origin}}" method="POST" id="piutangForm">
            {{csrf_field()}}
        <table class="table table-bordered table-vcenter">
            <tr>
                <th>No</th>
                <th style="width: 300px;">Nama</th>
                <th>Nomor SEP</th>
                <th>No. Piutang</th>
                <th>Jumlah</th>
                <th style="text-align: right;">Aksi</th>
            </tr>

            @php $total = 0; $no=1; @endphp

            @foreach($piutang as $item)
            <tr>
                <td>{{$no}} @php $no++ @endphp</td>
                <td>{{$item->pasien->name}}</td>
                <td>{{$item->kasusTagihan->kasus->sep->no_sep ?? '-'}}</td>
                <td>PTG{{$item->id}}</td>
                <td>Rp {{number_format($item->total)}}</td>
                <td>
                    <button type="button" data-href="{{url('keuangan/piutang/rekap-penagihan/print-all/'.$item->id)}}" class="btn btn-primary mt-5 pull-right ml-10 download-piutang-btn">Download File</button>
                    @if(isset($item->kasusTagihan->kasus))
                        <a href="{{url('kasus/'.$item->kasusTagihan->kasus->nomor_kasus)}}" target="_blank" class="btn btn-outline-primary mt-5 pull-right" >Lihat Kasus</a>
                    @endif
                </td>
            </tr>
            @if(!isset($item->kasusTagihan->kasus->resume) || is_null($item->kasusTagihan->kasus->resume))
            <input type="hidden" class="invalid-{{$item->id}} invalid-resume" value="{{$item->pasien->name}}" data-invalid="Resume">
            @endif

            @if(!isset($item->kasusTagihan) || !$item->kasusTagihan->hasPenunjang('radiologi'))
                <input type="hidden" class="invalid-{{$item->id}} invalid-hasil-penunjang-radiologi invalid-formulir-penunjang-radiologi" value="{{$item->pasien->name}}" data-invalid="Transaksi Radiologi">
            @endif

            @if(!isset($item->kasusTagihan) || !$item->kasusTagihan->hasPenunjang('labpa'))
                <input type="hidden" class="invalid-{{$item->id}} invalid-hasil-penunjang-labpa invalid-formulir-penunjang-labpa" value="{{$item->pasien->name}}" data-invalid="Transaksi Lab PA">
            @endif

            @if(!isset($item->kasusTagihan) || !$item->kasusTagihan->hasPenunjang('labpk'))
                <input type="hidden" class="invalid-{{$item->id}} invalid-hasil-penunjang-labpk invalid-formulir-penunjang-labpk" value="{{$item->pasien->name}}" data-invalid="Transaksi Lab PK">
            @endif

            @if(!isset($item->kasusTagihan->kasus->active_sep) || $item->kasusTagihan->kasus->pembayaran->perusahaan->type != 1)
            <input type="hidden" class="invalid-{{$item->id}} invalid-SEP" value="{{$item->pasien->name}}" data-invalid="No SEP Terdaftar">
            @endif

            @if(!isset($item->kasusTagihan->kasus->rawat_inap_transaksi_first))
            <input type="hidden" class="invalid-{{$item->id}} invalid-transaksi-rawat-inap" value="{{$item->pasien->name}}" data-invalid="Riwayat Rawat Inap">
            @endif

            @if(!isset($item->kasusTagihan->detailOperasi->operasi))
                <input type="hidden" class="invalid-{{$item->id}} invalid-lembar-pelayanan-operasi" value="{{$item->pasien->name}}" data-invalid="Riwayat Operasi">
            @endif

            @if(!isset($item->kasusTagihan->permintaanJenazah) || is_null($item->kasusTagihan->permintaanJenazah))
                <input type="hidden" class="invalid-{{$item->id}} invalid-surat-kematian" value="{{$item->pasien->name}}" data-invalid="Surat Kematian">
            @endif

            @if(!isset($item->kasusTagihan->ketKelahiran) || count($item->kasusTagihan->ketKelahiran) == 0)
                <input type="hidden" class="invalid-{{$item->id}} invalid-surat-kelahiran" value="{{$item->pasien->name}}" data-invalid="Surat Kelahiran">
            @endif
            
            @if(!isset($item->kasusTagihan->kasus->inacbg_latest))
            <input type="hidden" class="invalid-{{$item->id}} invalid-klaim-inacbg" value="{{$item->pasien->name}}" data-invalid="Klaim INACBG">
            @endif

            @if(!isset($item->kasusTagihan->kasus->alatBantu) || count($item->kasusTagihan->kasus->alatBantu->where('type', 'permintaan-usg')) == 0)
                <input type="hidden" class="invalid-{{$item->id}} invalid-hasil-usg" value="{{$item->pasien->name}}" data-invalid="Hasil Baca USG">
            @endif

{{--            @if(count($item->obat_fornas)<1)
                <input type="hidden" class="invalid-{{$item->id}} invalid-form-obat-khusus" value="{{$item->pasien->name}}" data-invalid="Form Permintaan Obat Khusus">             
            @endif--}}

            <input type="hidden" name="piutang_id[]" value="{{$item->id}}">
            @php $total = $total + $item->total @endphp
            @endforeach
            <tr>
                <td colspan="4"><strong>Total</strong></td>
                <td><strong>Rp {{number_format($total)}}</strong></td>
                <td><button type="button" onclick="window.open('{{url('keuangan/piutang/rekap-penagihan/download-all?id='.$ids)}}', 'newwindow', `width=${screen.width},height=${screen.height}`);" class="btn btn-success mt-5 pull-right ml-10">Download Semua</button></td>
            </tr>
        </table>
        <input type="hidden" name="akun" value="{{$akun}}">
        </form>
    </div>
    <div class="block-content block-content-full">
        <h5>Pilihan Print</h5>
        <a href="javascript:void(0)" data-href="{{url('keuangan/piutang/rekap-penagihan/print-daftar-penagihan?id='.$ids)}}" class="btn btn-primary mt-5 btn-print" data-ttd="true">Daftar Penagihan</a>
        <a href="javascript:void(0)" data-href="{{url('keuangan/piutang/rekap-penagihan/print-surat-pengantar?id='.$ids)}}" class="btn btn-primary mt-5 btn-print" data-ttd="true">Surat Pengantar</a>
        <a href="javascript:void(0)" data-href="{{url('keuangan/piutang/rekap-penagihan/print-perincian-biaya?id='.$ids)}}" class="btn btn-primary mt-5 btn-print" data-ttd="true">Perincian Biaya</a>
        <a href="javascript:void(0)" data-href="{{url('keuangan/piutang/rekap-penagihan/print-kwitansi-satuan?id='.$ids)}}" class="btn btn-primary mt-5 btn-print" data-ttd="true">Kwitansi Satuan</a>
        <a href="javascript:void(0)" data-href="{{url('keuangan/piutang/rekap-penagihan/print-kwitansi-total?id='.$ids)}}" class="btn btn-primary mt-5 btn-print" data-ttd="true">Kwitansi Total</a>
        <button type="button" onclick="printPenagihan(this, 'print-perincian-biaya-sesuai-kelas', '{{url("keuangan/piutang/rekap-penagihan/print-perincian-biaya-sesuai-kelas?id=".$ids)}}');" class="btn btn-primary mt-5" data-ttd="true">Perincian Biaya Sesuai Hak Kelas (IUR)</button>
        <button type="button" data-href="{{url('keuangan/piutang/rekap-penagihan/print-resume-medis?id='.$ids)}}" onclick="printPenagihan(this, 'resume');" class=" btn btn-primary mt-5">Resume Medis</button>


        <button type="button" data-href="{{url('keuangan/piutang/rekap-penagihan/print-bukti-ranap?id='.$ids)}}" onclick="printPenagihan(this, 'transaksi-rawat-inap');" class=" btn btn-primary mt-5">Bukti Layanan</button>

        <button type="button" data-href="{{url('keuangan/piutang/rekap-penagihan/print-opname?id='.$ids)}}" onclick="printPenagihan(this, 'transaksi-rawat-inap');" class=" btn btn-primary mt-5">Permintaan Opname</button>
        <button type="button" data-href="{{url('keuangan/piutang/rekap-penagihan/print-sep?id='.$ids)}}" onclick="printPenagihan(this, 'SEP');" class=" btn btn-primary mt-5">SEP</button>
        <button type="button" data-href="{{url('keuangan/piutang/rekap-penagihan/print-operasi?id='.$ids)}}" onclick="printPenagihan(this, 'lembar-pelayanan-operasi');" class=" btn btn-primary mt-5 ">Lembar Pelayanan Operasi</button>
        <button type="button" data-href="{{url('keuangan/piutang/rekap-penagihan/print-resep?id='.$ids)}}" onclick="printPenagihan(this, 'resep');" class=" btn btn-primary mt-5">Resep</button>
        <button type="button" data-href="{{url('keuangan/piutang/rekap-penagihan/print-hasil/radiologi?id='.$ids)}}" onclick="printPenagihan(this, 'hasil-penunjang-radiologi');" class=" btn btn-primary mt-5">Hasil Radiologi</button>
        <button type="button" data-href="{{url('keuangan/piutang/rekap-penagihan/print-hasil/labpa?id='.$ids)}}" onclick="printPenagihan(this, 'hasil-penunjang-labpa');" class=" btn btn-primary mt-5">Hasil LabPA</button>
        <button type="button" data-href="{{url('keuangan/piutang/rekap-penagihan/print-hasil/labpk?id='.$ids)}}" onclick="printPenagihan(this, 'hasil-penunjang-labpk');" class=" btn btn-primary mt-5">Hasil LabPK</button>
        <button type="button" data-href="{{url('keuangan/piutang/rekap-penagihan/print-formulir/radiologi?id='.$ids)}}" onclick="printPenagihan(this, 'formulir-penunjang-radiologi');" class=" btn btn-primary mt-5">Formulir&Hasil Radiologi</button>
        <button type="button" data-href="{{url('keuangan/piutang/rekap-penagihan/print-formulir/labpa?id='.$ids)}}" onclick="printPenagihan(this, 'formulir-penunjang-labpa');" class=" btn btn-primary mt-5">Formulir&Hasil LabPA</button>
        <button type="button" data-href="{{url('keuangan/piutang/rekap-penagihan/print-formulir/labpk?id='.$ids)}}" onclick="printPenagihan(this, 'formulir-penunjang-labpk');" class=" btn btn-primary mt-5">Formulir&Hasil LabPK</button>
        <button type="button" data-href="{{url('keuangan/piutang/rekap-penagihan/print-surat-kematian?id='.$ids)}}" onclick="printPenagihan(this, 'surat-kematian');" class=" btn btn-primary mt-5">Surat Kematian</button>
        <button type="button" data-href="{{url('keuangan/piutang/rekap-penagihan/print-surat-kelahiran?id='.$ids)}}" onclick="printPenagihan(this, 'surat-kelahiran');" class=" btn btn-primary mt-5">Surat Kelahiran</button>
        <button type="button" data-href="{{url('keuangan/piutang/rekap-penagihan/print-inacbg?id='.$ids)}}" onclick="printPenagihan(this, 'klaim-inacbg');" class=" btn btn-primary mt-5">Klaim INACBG</button>
        <button type="button" data-href="{{url('keuangan/piutang/rekap-penagihan/print-hasil-usg?id='.$ids)}}" onclick="printPenagihan(this, 'hasil-usg');" class=" btn btn-primary mt-5">Hasil Baca USG</button>
        {{--
        <button type="button" data-href="{{url('keuangan/piutang/rekap-penagihan/print-form-obat-khusus?id='.$ids)}}" onclick="printPenagihan(this, 'form-obat-khusus');" class=" btn btn-primary mt-5">Form Obat Khusus</button>--}}
    </div>
</div>

@include('keuangan.piutang.components.modal-pilih-penagihan')
@include('keuangan.piutang.components.modal-tagihkan')
@endsection

@section('js')


@include('keuangan.piutang.components.penagihan-js')
@endsection