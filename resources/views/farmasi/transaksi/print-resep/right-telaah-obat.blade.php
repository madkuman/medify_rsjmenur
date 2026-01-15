{{-- <br>
<div style="text-align: left">
    <strong>TELAAH OBAT</strong>
</div>
<table class="border font-8">
    <tr>
        <td>Kriteria Pengkajian</td>
        <td style="width: 15%; text-align: center;">Ya</td>
        <td style="width: 15%; text-align: center;">Tidak</td>
    </tr>
    <tr>
        <td><strong>SYARAT ADMINISTRASI</strong></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td>Nama Pasien</td>
        <td class="bordered text-center">
            @if($transaksi->lima_benar_pasien == '1' || empty($transaksi->lima_benar_at))
            X
            @endif
        </td>
        <td class="bordered text-center">
            @if($transaksi->lima_benar_pasien != 1 && !empty($transaksi->lima_benar_at))
            X
            @endif
        </td>
    </tr>
    <tr>
        <td>Nama Obat</td>
        <td class="bordered text-center">
            @if($transaksi->lima_benar_obat == '1' || empty($transaksi->lima_benar_at))
            X
            @endif
        </td>
        <td class="bordered text-center">
            @if($transaksi->lima_benar_obat != 1 && !empty($transaksi->lima_benar_at))
            X
            @endif
        </td>
    </tr>
    <tr>
        <td>Dosis, Bentuk, Kekuatan Sediaan</td>
        <td class="bordered text-center">
            @if($transaksi->lima_benar_dosis == '1' || empty($transaksi->lima_benar_at))
            X
            @endif
        </td>
        <td class="bordered text-center">
            @if($transaksi->lima_benar_dosis != 1 && !empty($transaksi->lima_benar_at))
            X
            @endif
        </td>
    </tr>
    <tr>
        <td>Rute Pemberian</td>
        <td class="bordered text-center">
            @if($transaksi->lima_benar_aturan == '1' || empty($transaksi->lima_benar_at))
            X
            @endif
        </td>
        <td class="bordered text-center">
            @if($transaksi->lima_benar_aturan != 1 && !empty($transaksi->lima_benar_at))
            X
            @endif
        </td>
    </tr>
    <tr>
        <td>Waktu Frekuensi Aturan Pakai</td>
        <td class="bordered text-center">
            @if($transaksi->lima_benar_waktu == '1' || empty($transaksi->lima_benar_at))
            X
            @endif
        </td>
        <td class="bordered text-center">
            @if($transaksi->lima_benar_waktu != 1 && !empty($transaksi->lima_benar_at))
            X
            @endif
        </td>
    </tr>
</table>
<table>
    <tr>
        <td style="width: 55%;text-align: center" colspan="3">
            Penelaah
        </td>
    </tr>
    <tr>
        <td style="text-align: center" colspan="3">
            @if(!empty($transaksi->lima_benar_created_by) && !empty($transaksi->lima_benar_creator->ttd))
            <img src="{{{url('')}}}/{{$transaksi->lima_benar_creator->ttd}}" height="30px">
            @else
            <div style="height: 30px"></div>
            @endif
        </td>
    </tr>
    <tr>
        <td style="text-align: center" colspan="3">
            @if(!empty($transaksi->lima_benar_created_by))
            (  {{$transaksi->lima_benar_creator->name}}  )
            @else
            (  ........................  )
            @endif
        </td>
    </tr>
    <tr>
        <td style="text-align: center" colspan="3">
            Nama Terang
        </td>
    </tr>
</table> --}}

<!-- new telaah obat -->
<table width="100%" style="font-size: 3pt !important; border: 1px solid #9d9d9d; border-collapse: collapse; line-height: 6px; margin-top: -10px">
    <thead style="text-align: center; background-color: #c0c0c0">
        <tr>
            <td width="40%" style="border: 1px solid #9d9d9d; border-collapse: collapse;">TELAAH OBAT</td>
            <td width="15%" style="border: 1px solid #9d9d9d; border-collapse: collapse;"><b>Penerimaan</b></td>
            <td width="15%" style="border: 1px solid #9d9d9d; border-collapse: collapse;"><b>Penyiapan</b></td>
            <td width="15%" style="border: 1px solid #9d9d9d; border-collapse: collapse;"><b>Pengemasan</b></td>
            <td width="15%" style="border: 1px solid #9d9d9d; border-collapse: collapse;"><b>Penyerahan</b></td>
        </tr>
    </thead>
    <tbody>
        @php
            $list_telaah = [
                'nama_pasien' => 'Nama Pasien',
                'no_rm' => 'No. Rekam Medis',
                'tanggal_lahir' => 'Tanggal Lahir',
                'nama_obat' => 'Nama Obat',
                'dosis_bentuk_kekuatan_sediaan' => 'Dosis, bentuk, kekuatan sediaan',
                'jumlah' => 'Jumlah',
                'rute_pemberian' => 'Rute Pemberian',
                'waktu_frekuensi_aturan_pakai' => 'Waktu/frekuensi aturan pakai',
            ];
        @endphp
        <tr>
            <td style="text-align: center; border: 1px solid #9d9d9d; border-collapse: collapse;">Nama Pasien</td>
            <td style="text-align: center; border: 1px solid #9d9d9d; border-collapse: collapse;">
                @if(isset($transaksi->paid_at)) <span style="font-family: DejaVu Sans, sans-serif;">✔</span>@endif
            </td>
            <td style="text-align: center; border: 1px solid #9d9d9d; border-collapse: collapse;">
                @if(!empty($transaksi->transaksi_obat_telaah_obat_penyiapan->nama_pasien)) <span style="font-family: DejaVu Sans, sans-serif;">✔</span>@endif
            </td>
            <td style="text-align: center; border: 1px solid #9d9d9d; border-collapse: collapse;">
                @if(!empty($transaksi->transaksi_obat_telaah_obat_pengemasan->nama_pasien)) <span style="font-family: DejaVu Sans, sans-serif;">✔</span>@endif
            </td>
            <td style="text-align: center; border: 1px solid #9d9d9d; border-collapse: collapse;">
                @if(!empty($transaksi->transaksi_obat_telaah_obat_penyerahan->nama_pasien)) <span style="font-family: DejaVu Sans, sans-serif;">✔</span>@endif
            </td>
        </tr>
        <tr>
            <td style="text-align: center; border: 1px solid #9d9d9d; border-collapse: collapse;">No. Rekam Medik</td>
            <td style="text-align: center; border: 1px solid #9d9d9d; border-collapse: collapse;">
                @if(isset($transaksi->paid_at)) <span style="font-family: DejaVu Sans, sans-serif;">✔</span>@endif
            </td>
            <td style="text-align: center; border: 1px solid #9d9d9d; border-collapse: collapse;">
                @if(!empty($transaksi->transaksi_obat_telaah_obat_penyiapan->no_rm)) <span style="font-family: DejaVu Sans, sans-serif;">✔</span>@endif
            </td>
            <td style="text-align: center; border: 1px solid #9d9d9d; border-collapse: collapse;">
                @if(!empty($transaksi->transaksi_obat_telaah_obat_pengemasan->no_rm)) <span style="font-family: DejaVu Sans, sans-serif;">✔</span>@endif
            </td>
            <td style="text-align: center; border: 1px solid #9d9d9d; border-collapse: collapse;">
                @if(!empty($transaksi->transaksi_obat_telaah_obat_penyerahan->no_rm)) <span style="font-family: DejaVu Sans, sans-serif;">✔</span>@endif
            </td>
        </tr>
        <tr>
            <td style="text-align: center; border: 1px solid #9d9d9d; border-collapse: collapse;">Tanggal Lahir</td>
            <td style="text-align: center; border: 1px solid #9d9d9d; border-collapse: collapse;">
                @if(isset($transaksi->paid_at)) <span style="font-family: DejaVu Sans, sans-serif;">✔</span>@endif
            </td>
            <td style="text-align: center; border: 1px solid #9d9d9d; border-collapse: collapse;">
                @if(!empty($transaksi->transaksi_obat_telaah_obat_penyiapan->tanggal_lahir)) <span style="font-family: DejaVu Sans, sans-serif;">✔</span>@endif
            </td>
            <td style="text-align: center; border: 1px solid #9d9d9d; border-collapse: collapse;">
                @if(!empty($transaksi->transaksi_obat_telaah_obat_pengemasan->tanggal_lahir)) <span style="font-family: DejaVu Sans, sans-serif;">✔</span>@endif
            </td>
            <td style="text-align: center; border: 1px solid #9d9d9d; border-collapse: collapse;">
                @if(!empty($transaksi->transaksi_obat_telaah_obat_penyerahan->tanggal_lahir)) <span style="font-family: DejaVu Sans, sans-serif;">✔</span>@endif
            </td>
        </tr>
        <tr>
            <td style="text-align: center; border: 1px solid #9d9d9d; border-collapse: collapse;">Nama Obat</td>
            <td style="text-align: center; border: 1px solid #9d9d9d; border-collapse: collapse;">
                @if(isset($transaksi->paid_at)) <span style="font-family: DejaVu Sans, sans-serif;">✔</span>@endif
            </td>
            <td style="text-align: center; border: 1px solid #9d9d9d; border-collapse: collapse;">
                @if(!empty($transaksi->transaksi_obat_telaah_obat_penyiapan->nama_obat)) <span style="font-family: DejaVu Sans, sans-serif;">✔</span>@endif
            </td>
            <td style="text-align: center; border: 1px solid #9d9d9d; border-collapse: collapse;">
                @if(!empty($transaksi->transaksi_obat_telaah_obat_pengemasan->nama_obat)) <span style="font-family: DejaVu Sans, sans-serif;">✔</span>@endif
            </td>
            <td style="text-align: center; border: 1px solid #9d9d9d; border-collapse: collapse;">
                @if(!empty($transaksi->transaksi_obat_telaah_obat_penyerahan->nama_obat)) <span style="font-family: DejaVu Sans, sans-serif;">✔</span>@endif
            </td>
        </tr>
        <tr>
            <td style="text-align: center; border: 1px solid #9d9d9d; border-collapse: collapse;">Dosis, bentuk, kekuatan sediaan</td>
            <td style="text-align: center; border: 1px solid #9d9d9d; border-collapse: collapse;">
                @if(isset($transaksi->paid_at)) <span style="font-family: DejaVu Sans, sans-serif;">✔</span>@endif
            </td>
            <td style="text-align: center; border: 1px solid #9d9d9d; border-collapse: collapse;">
                @if(!empty($transaksi->transaksi_obat_telaah_obat_penyiapan->dosis_bentuk_kekuatan_sediaan)) <span style="font-family: DejaVu Sans, sans-serif;">✔</span>@endif
            </td>
            <td style="text-align: center; border: 1px solid #9d9d9d; border-collapse: collapse;">
                @if(!empty($transaksi->transaksi_obat_telaah_obat_pengemasan->dosis_bentuk_kekuatan_sediaan)) <span style="font-family: DejaVu Sans, sans-serif;">✔</span>@endif
            </td>
            <td style="text-align: center; border: 1px solid #9d9d9d; border-collapse: collapse;">
                @if(!empty($transaksi->transaksi_obat_telaah_obat_penyerahan->dosis_bentuk_kekuatan_sediaan)) <span style="font-family: DejaVu Sans, sans-serif;">✔</span>@endif
            </td>
        </tr>
        <tr>
            <td style="text-align: center; border: 1px solid #9d9d9d; border-collapse: collapse;">Jumlah</td>
            <td style="text-align: center; border: 1px solid #9d9d9d; border-collapse: collapse;">
                @if(isset($transaksi->paid_at)) <span style="font-family: DejaVu Sans, sans-serif;">✔</span>@endif
            </td>
            <td style="text-align: center; border: 1px solid #9d9d9d; border-collapse: collapse;">
                @if(!empty($transaksi->transaksi_obat_telaah_obat_penyiapan->jumlah)) <span style="font-family: DejaVu Sans, sans-serif;">✔</span>@endif
            </td>
            <td style="text-align: center; border: 1px solid #9d9d9d; border-collapse: collapse;">
                @if(!empty($transaksi->transaksi_obat_telaah_obat_pengemasan->jumlah)) <span style="font-family: DejaVu Sans, sans-serif;">✔</span>@endif
            </td>
            <td style="text-align: center; border: 1px solid #9d9d9d; border-collapse: collapse;">
                @if(!empty($transaksi->transaksi_obat_telaah_obat_penyerahan->jumlah)) <span style="font-family: DejaVu Sans, sans-serif;">✔</span>@endif
            </td>
        </tr>
        <tr>
            <td style="text-align: center; border: 1px solid #9d9d9d; border-collapse: collapse;">Rute Pemberian</td>
            <td style="text-align: center; border: 1px solid #9d9d9d; border-collapse: collapse;">
                @if(isset($transaksi->paid_at)) <span style="font-family: DejaVu Sans, sans-serif;">✔</span>@endif
            </td>
            <td style="text-align: center; border: 1px solid #9d9d9d; border-collapse: collapse;">
                @if(!empty($transaksi->transaksi_obat_telaah_obat_penyiapan->rute_pemberian)) <span style="font-family: DejaVu Sans, sans-serif;">✔</span>@endif
            </td>
            <td style="text-align: center; border: 1px solid #9d9d9d; border-collapse: collapse;">
                @if(!empty($transaksi->transaksi_obat_telaah_obat_pengemasan->rute_pemberian)) <span style="font-family: DejaVu Sans, sans-serif;">✔</span>@endif
            </td>
            <td style="text-align: center; border: 1px solid #9d9d9d; border-collapse: collapse;">
                @if(!empty($transaksi->transaksi_obat_telaah_obat_penyerahan->rute_pemberian)) <span style="font-family: DejaVu Sans, sans-serif;">✔</span>@endif
            </td>
        </tr>
        <tr>
            <td style="text-align: center; border: 1px solid #9d9d9d; border-collapse: collapse;">Waktu/frekuensi aturan pakai</td>
            <td style="text-align: center; border: 1px solid #9d9d9d; border-collapse: collapse;">
                @if(isset($transaksi->paid_at)) <span style="font-family: DejaVu Sans, sans-serif;">✔</span>@endif
            </td>
            <td style="text-align: center; border: 1px solid #9d9d9d; border-collapse: collapse;">
                @if(!empty($transaksi->transaksi_obat_telaah_obat_penyiapan->waktu_frekuensi_aturan_pakai)) <span style="font-family: DejaVu Sans, sans-serif;">✔</span>@endif
            </td>
            <td style="text-align: center; border: 1px solid #9d9d9d; border-collapse: collapse;">
                @if(!empty($transaksi->transaksi_obat_telaah_obat_pengemasan->waktu_frekuensi_aturan_pakai)) <span style="font-family: DejaVu Sans, sans-serif;">✔</span>@endif
            </td>
            <td style="text-align: center; border: 1px solid #9d9d9d; border-collapse: collapse;">
                @if(!empty($transaksi->transaksi_obat_telaah_obat_penyerahan->waktu_frekuensi_aturan_pakai)) <span style="font-family: DejaVu Sans, sans-serif;">✔</span>@endif
            </td>
        </tr>
    </tbody>
    <tfoot>
        <tr>
            <td style="text-align: center; border: 1px solid #9d9d9d; border-collapse: collapse;">Paraf</td>
            <td style="border: 1px solid #9d9d9d; border-collapse: collapse; text-align: center">
                @if (isset($transaksi->paidBy->ttd) 
                && file_exists(public_path($transaksi->paidBy->ttd)))
                    <img style="height: 8px" src="{{ public_path($transaksi->paidBy->ttd) }}" alt="">
                @endif
            </td>
            <td style="border: 1px solid #9d9d9d; border-collapse: collapse; text-align: center">
                @if (isset($transaksi->transaksi_obat_telaah_obat_penyiapan->user_telaah->ttd) 
                && file_exists(public_path($transaksi->transaksi_obat_telaah_obat_penyiapan->user_telaah->ttd)))
                    <img style="height: 8px" src="{{ public_path($transaksi->transaksi_obat_telaah_obat_penyiapan->user_telaah->ttd) }}" alt="">
                @endif
            </td>
            <td style="border: 1px solid #9d9d9d; border-collapse: collapse; text-align: center">
                @if (isset($transaksi->transaksi_obat_telaah_obat_pengemasan->user_telaah->ttd) 
                && file_exists(public_path($transaksi->transaksi_obat_telaah_obat_pengemasan->user_telaah->ttd)))
                    <img style="height: 8px" src="{{ public_path($transaksi->transaksi_obat_telaah_obat_pengemasan->user_telaah->ttd) }}" alt="">
                @endif
            </td>
            <td style="border: 1px solid #9d9d9d; border-collapse: collapse; text-align: center">
                @if (isset($transaksi->transaksi_obat_telaah_obat_penyerahan->user_telaah->ttd) 
                && file_exists(public_path($transaksi->transaksi_obat_telaah_obat_penyerahan->user_telaah->ttd)))
                    <img style="height: 8px" src="{{ public_path($transaksi->transaksi_obat_telaah_obat_penyerahan->user_telaah->ttd) }}" alt="">
                @endif
            </td>
        </tr>
        <tr>
            <td style="text-align: center; border: 1px solid #9d9d9d; border-collapse: collapse;">Nama</td>
            <td style="border: 1px solid #9d9d9d; border-collapse: collapse;">{{ $transaksi->paidBy->name ?? '' }}</td>
            <td style="border: 1px solid #9d9d9d; border-collapse: collapse;">{{ $transaksi->transaksi_obat_telaah_obat_penyiapan->user_telaah->name ?? '' }}</td>
            <td style="border: 1px solid #9d9d9d; border-collapse: collapse;">{{ $transaksi->transaksi_obat_telaah_obat_pengemasan->user_telaah->name ?? '' }}</td>
            <td style="border: 1px solid #9d9d9d; border-collapse: collapse;">{{ $transaksi->transaksi_obat_telaah_obat_penyerahan->user_telaah->name ?? '' }}</td>
        </tr>
    </tfoot>
</table>