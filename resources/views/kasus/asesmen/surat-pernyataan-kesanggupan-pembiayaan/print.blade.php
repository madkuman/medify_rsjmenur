@extends('layouts.print')

@section('title')
    Print Surat Permintaan Masuk Rumah Sakit
@endsection

@section('css')
    <style type="text/css">
        body,
        p {
            font-size: 12px;
            font-family: Arial, Helvetica, sans-serif;
            line-height: 16px;
        }

        table.bordered {
            border-collapse: collapse;
        }

        table.bordered,
        .bordered th,
        .bordered td.has-border {
            border: 1px solid black;
        }
    </style>
@endsection

@section('content')
    @php
        $val = json_decode($ect->val);
        $penanda = $val->nama_penanda ?? '';
        $saksi = \App\User::find($val->saksi ?? null) ?? null;
        $perawat = \App\User::find($val->perawat_ruangan ?? null) ?? null;              
    @endphp
    {{-- <table class="bordered" align="right" cellpadding="3">
        <tr>
            <td align="center" class="has-border">RM. 17</td>
        </tr>
        <tr>
            <td align="center">Halaman 1/1</td>
        </tr>
    </table> --}}


    <table width="90%" class="bordered" align="center" cellpadding="5" style="margin-top: 20px;">
        <tr>
            <th align="center">
                <img src="{{ config('app.kop_lg') }}" height="80">
            </th>
        </tr>
        <tr>
            <th align="center">
                <h4>SURAT PERNYATAAN KESANGGUPAN PEMBIAYAAN</h4>
            </th>
        </tr>
        <tr>
            <td align="left" class="has-border">
                <table width="100%">
                    <tr>
                        <td>Disampaikan oleh petugas Admisi</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td align="center" class="">
                <table width="100%">
                    <tr>
                        <td colspan="3">Yang bertanda tangan dibawah ini : </td>
                    </tr>
                    <tr>
                        <td width="22%">Nama</td>
                        <td width="3%">:</td>
                        <td width="75%">{{ $val->nama_penanda ?? '.........................................' }}</td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>:</td>
                        <td>{{ $val->alamat_penanda ?? '.........................................' }}</td>
                    </tr>
                    <tr>
                        <td>Telp</td>
                        <td>:</td>
                        <td>{{ $val->telp_penanda ?? '.........................................' }}</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td align="center" class="">
                <table width="100%">
                    <tr>
                        <td>Hubungan dengan Pasien : {{ $val->hubungan_dengan_pasien }}</td>
                    </tr>
                    <tr>
                        <td>Dengan ini kami sebagai penanggung jawab / pengampu pasien menyatakan / menyetujui perawatan
                            pasien di kelas {{ $val->kelas_perawatan ?? '' }} dengan pembiayaan sesuai tarif yang ditetapkan
                            oleh RS
                            Jiwa Menur Provinsi Jawa Timur dengan pasien :</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td align="center" class="">
                <table width="100%">
                    <tr>
                        <td colspan="3"></td>
                    </tr>
                    <tr>
                        <td width="22%">No. RM</td>
                        <td width="3%">:</td>
                        <td width="75%">
                            {{ $val->no_rm ?? ($kasus->pasien->no_rm ?? '.........................................') }}</td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td>{{ $kasus->identitas->nama ?? ($val->nama_pasien ?? '.........................................') }}
                        </td>
                    </tr>
                    <tr>
                        <td>Tgl Lahir / Umur</td>
                        <td>:</td>
                        <td>{{ !is_null($kasus->identitas->tanggal_lahir) ? date('d/m/Y', strtotime($kasus->identitas->tanggal_lahir)) : '-' }}
                            / {{ $kasus->identitas->umur ?? '.........................................' }} Tahun</td>
                    </tr>
                    <tr>
                        <td>Ruangan</td>
                        <td>:</td>
                        <td>{{ $val->ruangan ?? '.........................................' }}</td>
                    </tr>
                    <tr>
                        <td colspan="3"></td>
                    </tr>
                    <tr>
                        <td colspan="3">Demikian surat pernyataan ini saya buat dengan sebenarnya.</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td align="center" class="">
                <table width="100%">
                    <tr>
                        <td width="33%"></td>
                        <td width="33%"></td>
                        <td width="33%" align="center">
                            <p>Surabaya, {{ date('d F Y', strtotime($ect->created_at)) }}</p>
                        </td>
                    </tr>
                    <tr>
                        <td align="center">Perawat Ruangan</td>
                        <td align="center">Saksi</td>
                        <td align="center">Yang membuat pernyataan</td>
                    </tr>
                    <tr>
                     <td align="center">
                        @if(isset($perawat->ttd))
                           <img src="{{public_path($perawat->ttd)}}" height="50px">
                        @endif
                     </td>
                     <td align="center">
                        @if(isset($saksi->ttd))
                           <img src="{{public_path($saksi->ttd)}}" height="50px">
                        @endif
                     </td>
                     <td align="center">
                        @if(isset($val->img_ttd))
                           <img src="{{public_path($val->img_ttd)}}" height="50px">
                        @endif
                     </td>
                 </tr>
                    <tr>
                        <td align="center">
                            <p style="margin-top: 20px;">
                                ({{ $perawat != null ? $perawat->name : '.........................................' }})</p>
                        </td>
                        <td align="center">
                            <p style="margin-top: 20px;">
                                ({{ $saksi != null ? $saksi->name : '.........................................' }})</p>
                        </td>
                        <td align="center">
                            <p style="margin-top: 20px;">
                                ({{ $penanda ?? '.........................................' }})</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
@endsection
