@extends('keuangan.layouts.main')

@section('title')
Rekap Penagihan Piutang @foreach($perusahaan as $item){{ $loop->first ? '' : ', ' }}{{$item->nama}}@endforeach - Keuangan
@endsection

@section('css')
@endsection
@section('content')
@include('keuangan.piutang.components.header')

<div class="block">
    <div class="block-content">
        <h4>Rekap Penagihan Piutang @foreach($perusahaan as $item){{ $loop->first ? '' : ', ' }}{{$item->nama}}@endforeach</h4>
        <hr>
        <button class="btn btn-warning btn-hero" id="btn-tagihkan">Tagihkan</button>
    </div>
    <div class="block-content">
        <form action="{{url('keuangan/piutang/tagihkan')}}" method="POST" id="piutangForm">
            {{csrf_field()}}
        <table class="table table-bordered table-vcenter">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>No. Piutang</th>
                <th>Jumlah</th>
                <th>Aksi</th>
            </tr>

            @php $total = 0 @endphp

            @foreach($piutang as $item)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$item->pasien->name}}</td>
                <td>PTG{{$item->id}}</td>
                <td>Rp {{number_format($item->total)}}</td>
                <td>
                    <button type="button" data-href="{{url('keuangan/piutang/rekap-penagihan/print-all/'.$item->id)}}" onclick="printPenagihanAll(this, {{$item->id}}, `{{$item->pasien->name}}`);" class="btn btn-primary mt-5">Download File</button>
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

            @if(!isset($item->kasusTagihan->kasus->active_sep) || $item->kasusTagihan->kasus->pembayaran->perusahaan->tipe->slug != 'bpjs')
            <input type="hidden" class="invalid-{{$item->id}} invalid-SEP" value="{{$item->pasien->name}}" data-invalid="No SEP Terdaftar">
            @endif

            @if(!isset($item->kasusTagihan->kasus->rawat_inap_transaksi_first))
            <input type="hidden" class="invalid-{{$item->id}} invalid-transaksi-rawat-inap" value="{{$item->pasien->name}}" data-invalid="Riwayat Rawat Inap">
            @endif

            @if(!isset($item->kasusTagihan->detailOperasi->operasi))
                <input type="hidden" class="invalid-{{$item->id}} invalid-lembar-pelayanan-operasi" value="{{$item->pasien->name}}" data-invalid="Riwayat Operasi">
            @endif


            @if(!isset($item->kasusTagihan->kasus->rawat_inap_transaksi_first))
            <input type="hidden" class="invalid-{{$item->id}} invalid-transaksi-rawat-inap" value="{{$item->pasien->name}}" data-invalid="Riwayat Rawat Inap">
            @endif
            <input type="hidden" name="piutang_id[]" value="{{$item->id}}">
            @php $total = $total + $item->total @endphp
            @endforeach
            <tr>
                <td colspan="3"><strong>Total</strong></td>
                <td><strong>Rp {{number_format($total)}}</strong></td>
                <td></td>
            </tr>
        </table>
        </form>
    </div>
    <div class="block-content block-content-full">
        <h5>Pilihan Print</h5>
        <a href="{{url('keuangan/piutang/rekap-penagihan/print-daftar-penagihan?id='.$ids)}}" target="_blank" class="btn btn-primary mt-5">Daftar Penagihan</a>
        <a href="{{url('keuangan/piutang/rekap-penagihan/print-surat-pengantar?id='.$ids)}}" target="_blank"  class="btn btn-primary mt-5">Surat Pengantar</a>
        <a href="{{url('keuangan/piutang/rekap-penagihan/print-perincian-biaya?id='.$ids)}}" target="_blank"  class="btn btn-primary mt-5">Perincian Biaya</a>
        <a href="{{url('keuangan/piutang/rekap-penagihan/print-kwitansi-satuan?id='.$ids)}}" target="_blank"  class="btn btn-primary mt-5">Kwitansi Satuan</a>
        <a href="{{url('keuangan/piutang/rekap-penagihan/print-kwitansi-total?id='.$ids)}}" target="_blank"  class="btn btn-primary mt-5">Kwitansi Total</a>
        <button type="button" data-href="{{url('keuangan/piutang/rekap-penagihan/print-perincian-biaya-sesuai-kelas?id='.$ids)}}" onclick="printPenagihan(this, 'print-perincian-biaya-sesuai-kelas');" class="btn btn-primary mt-5">Perincian Biaya Sesuai Hak Kelas (IUR)</button>
        <button type="button" data-href="{{url('keuangan/piutang/rekap-penagihan/print-resume-medis?id='.$ids)}}" onclick="printPenagihan(this, 'resume');" class=" btn btn-primary mt-5">Resume Medis</button>
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
    </div>
</div>

@endsection

@section('js')


@include('keuangan.piutang.components.penagihan-js')
@endsection