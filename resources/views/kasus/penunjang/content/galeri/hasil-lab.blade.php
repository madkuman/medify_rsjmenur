@extends('layouts.main-simple')

@section('title')
History Lab
@endsection

@section('content')
@php $space = '&nbsp;&nbsp;' ; $space2 = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' ; $space3 = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' ; $pasien_gender = $kasus->pasien->gender ;@endphp
<div class="px-20 pt-20">
    <div class="text-center">
        <h3 class="mb-0">Hasil Labolatorium</h3>
        <h4>Pasien {{ ucwords(strtolower($kasus->identitas->nama))}} | Tanggal : {{$date_start != null ? indonesian_date(date("d-m-Y", strtotime($date_start))) : ' ' }} - {{$date_end != null ? indonesian_date(date("d-m-Y", strtotime($date_end))) : ' ' }}</h4>
    </div>
    <div class="row block-content bg-white px-2">
        <div class="col-12 table-responsive text-nowrap">
            <table  class="table">
                <thead class="table-dark">
                    <tr>
                        <th class="text-center" style="width: 25%;">Pemeriksaan</th>
                        <th class="text-center">Nilai Rujukan</th>
                        @foreach($tanggal_result_created_at as  $result_created_at)
                        <th class="text-center" width="200px">{{ $result_created_at }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($hasil_pemeriksaaan as $jenis_penunjang => $data_transaksi)
                        <tr>
                            <td colspan="{{2 + count($tanggal_result_created_at)}}"><h5 class="mb-0">{{ strtoupper(str_replace( '-' , ' ', $jenis_penunjang)) }}</h5></td>
                        </tr>
                        @foreach($data_transaksi as $jenis_kategori => $data_kategori)
                            <tr>
                                <td colspan="{{2 + count($tanggal_result_created_at)}}">{{$space}}<b>{{ $jenis_kategori }}</b></td>
                            </tr>
                            @php $nomor = 0; @endphp
                            @foreach($data_kategori as $nama_tarif_master => $data_tarif_master)
                                <tr>
                                    <td colspan="{{2 + count($tanggal_result_created_at)}}"><h6 class="mb-0">{{$space2}} {{++$nomor}}. {{$nama_tarif_master}}</h6></td>
                                </tr>
                                @foreach($data_tarif_master as $nama_parameter => $data_parameter)
                                    <tr>
                                        <td>{{$space3}} &#8226; {{$nama_parameter}}</td>
                                        <td class="text-center a">{{$hasil_pemeriksaaan[$jenis_penunjang][$jenis_kategori][$nama_tarif_master][$nama_parameter]['referensi']}}</td>
                                        @foreach($tanggal_result_created_at as $index_tanggal => $result_created_at)
                                            <td class="text-center b">{{ $hasil_pemeriksaaan[$jenis_penunjang][$jenis_kategori][$nama_tarif_master][$nama_parameter]['value'][$index_tanggal] }}</td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            @endforeach
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection