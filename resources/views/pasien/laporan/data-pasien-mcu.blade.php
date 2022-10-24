<table>
    <tr>
        <td colspan="5">
            DATA PELAYANAN PASIEN MEDICAL CHECKUP
        </td>
    </tr>
    <tr>
        <td colspan="5">

        </td>
    </tr>
    <tr>
        <td colspan="5">
            Periode Waktu {{indonesian_date($date_start)}} - {{indonesian_date($date_start)}}
        </td>
    </tr>
    <tr>
        <td colspan="5">
            {{config('app.name')}}
        </td>
    </tr>
    <tr></tr>
    <tr>
        <td rowspan="2">No.</td>
        <td rowspan="2">No. RM</td>
        <td rowspan="2">Nama Pasien</td>
        <td rowspan="2">NIK</td>
        <td rowspan="2">Alamat</td>
        <td rowspan="2">Jenis Kelamin</td>
        <td rowspan="2">Status Pernikahan</td>
        <td rowspan="2">No. Hp</td>
        <td rowspan="2">Tempat Lahir</td>
        <td rowspan="2">Tanggal Lahir</td>
        <td rowspan="2">Umur</td>
        <td rowspan="2">Pekerjaan</td>
        <td rowspan="2">Agama</td>
        <td rowspan="2">Pendidikan</td>
        <td rowspan="2">Suku</td>
        <td rowspan="2">Jenis Bayar</td>
        <td rowspan="2">Kelas Bayar</td>
        <td rowspan="2">No. Asuransi</td>
        <td rowspan="2">No. SEP</td>
        <td rowspan="2">Poliklinik/IGD</td>
        <td rowspan="2">Tanggal Berkunjung</td>
        <td rowspan="2">Jam Berkunjung</td>
        <td rowspan="2">Jenis Kunjungan</td>
        <td rowspan="2">DPJP</td>
        <td rowspan="2">Kode ICD 10</td>
        <td rowspan="2">Diagnosa Utama</td>
        <td rowspan="2">Diagnosa Tambahann</td>
        <td rowspan="2">Kode ICD 9</td>
        <td rowspan="2">Tindakan</td>
        <td rowspan="2">Paket</td>
        @if(config('app.is_military'))
            <td colspan="6">Pasien Adalah Anggota</td>
        @endif
        <td colspan="5">Data Keluarga / Kerabat yang bisa dihubungi</td>
        @if(config('app.is_military'))
            <td colspan="7">Pasien memiliki Kerabat Anggota</td>
        @endif
    </tr>
    <tr>
        @if(config('app.is_military'))
            <td>Nama Anggota</td>
            <td>NRP/NIP</td>
            <td>Keanggotaan</td>
            <td>Pangkat</td>
            <td>Kotoma</td>
            <td>Satker</td>
        @endif
        <td>Nama</td>
        <td>Jenis Kelamin</td>
        <td>Alamat</td>
        <td>No. Telp</td>
        <td>Hubungan</td>
        @if(config('app.is_military'))
            <td>Nama Anggota</td>
            <td>NRP/NIP</td>
            <td>Keanggotaan</td>
            <td>Pangkat</td>
            <td>Kotama</td>
            <td>Satker</td>
            <td>Hubungan</td>
        @endif
    </tr>
    @foreach($data as $key => $item)
        <tr>
            <td>{{$key+1}}</td>
            <td>{{$item->pasien->no_rm}}</td>
            <td>{{$item->pasien->name}}</td>
            <td>{{$item->pasien->no_identitas ?? '-'}}</td>
            <td>{{$item->pasien->address ?? '-'}}</td>
            <td>{{$item->pasien->gender == 1 ? 'Laki-laki' : 'Perempuan'}}</td>
            <td>{{$item->pasien->pernikahan->nama ?? '-'}}</td>
            <td>{{$item->pasien->phone ?? '-'}}</td>
            <td>{{$item->pasien->place_of_birth ?? '-'}}</td>
            <td>{{!empty($item->pasien->date_of_birth) && $item->pasien->date_of_birth != '0000-00-00' ? date("d-m-Y", strtotime($item->pasien->date_of_birth)) : '-'}}</td>
            <td>{{$item->pasien->age ?? '-'}}</td>
            <td>{{$item->kasus->identitas->pekerjaan ?? '-'}}</td>
            <td>{{$item->pasien->agama->nama ?? '-'}}</td>
            <td>{{$item->pasien->pendidikan->nama ?? '-'}}</td>
            <td>{{$item->pasien->suku ?? '-'}}</td>
            <td>{{$item->kasus->pembayaran->perusahaan->nama ?? '-'}}</td>
            <td>{{$item->kasus->pembayaran->kelas->nama ?? '-'}}</td>
            <td>{{$item->kasus->pembayaran->no_asuransi ?? '-'}}</td>
            <td>{{$item->kasus->sep->no_sep ?? '-'}}</td>
            <td>{{$item->kasus->lokasi->lokasi->nama ?? '-'}}</td>
            <td>{{date("d-m-Y", strtotime($item->waktu_pemeriksaan))}}</td>
            <td>{{date("H:i", strtotime($item->waktu_pemeriksaan))}}</td>
            <td>{{!empty($item->kasus->is_baru) ? 'Baru' : 'Lama'}}</td>
            <td>{{$item->kasus->dpjp->user->name ?? '-'}}</td>
            <td>{{$item->kasus->diagnosisUtama->icd10->code_icd ?? ''}}</td>
            <td>{{$item->kasus->diagnosisUtama->icd10->code_icd ?? ''}} {{$item->kasus->diagnosisUtama->icd10->long_desc ?? ''}}</td>
            <td>
                @if(count($item->kasus->diagnosis) > 0)
                    @foreach($item->kasus->diagnosis as $diagnosis)
                        {{$diagnosis->icd10->code_icd ?? ''}} {{$diagnosis->icd10->long_desc ?? ''}}<br>
                    @endforeach
                @endif
            </td>
            <td>
                @if(count($item->kasus->tindakan_icd9) > 0)
                    {{$item->kasus->tindakan_icd9[0]->icd9->code_icd ?? ''}}
                @endif
            </td>
            <td>
                @if(count($item->kasus->tindakan_icd9) > 0)
                    @foreach($item->kasus->tindakan_icd9 as $tindakan)
                        {{$tindakan->desc ?? ''}}<br>
                    @endforeach
                @endif
            </td>
            <td>{{$item->transaksi_detail[0]->paket->nama ?? '-'}}</td>
            @if(config('app.is_military'))
                <td>{{$item->pasien->is_anggota == 1 ? $item->pasien->name : ''}}</td>
                <td>{{$item->pasien->is_anggota == 1 ? $item->pasien->tni_nrp : ''}}</td>
                <td>{{$item->pasien->is_anggota == 1 ? $item->pasien->tni_keanggotaan->nama ?? '-' : ''}}</td>
                <td>{{$item->pasien->is_anggota == 1 ? $item->pasien->tni_pangkat->nama ?? '-' : ''}}</td>
                <td>{{$item->pasien->is_anggota == 1 ? $item->pasien->tni_kotama->nama ?? '-' : ''}}</td>
                <td>{{$item->pasien->is_anggota == 1 ? $item->pasien->tni_satker->nama ?? '-' : ''}}</td>
            @endif

            <td>{{$item->pasien->wali->name ?? ''}}</td>
            <td>{{!empty($item->pasien->wali) ? $item->pasien->wali->gender == 1 ? 'Laki-laki' : 'Perempuan' : ''}}</td>
            <td>{{$item->pasien->wali->address ?? ''}}</td>
            <td>{{$item->pasien->wali->phone ?? ''}}</td>
            <td>{{$item->pasien->jenis_hubungan_keluarga->nama ?? ''}}</td>
            @if(config('app.is_military'))
                <td>{{!empty($item->pasien->wali) ? $item->pasien->wali->is_anggota == 1 ? $item->pasien->wali->name : '' : ''}}</td>

                <td>{{!empty($item->pasien->wali) ? $item->pasien->wali->is_anggota == 1 ? $item->pasien->wali->tni_nrp : '' : ''}}</td>
                <td>{{!empty($item->pasien->wali) ? $item->pasien->wali->is_anggota == 1 ? $item->pasien->wali->tni_keanggotaan->nama ?? '-' : '' : ''}}</td>
                <td>{{!empty($item->pasien->wali) ? $item->pasien->wali->is_anggota == 1 ? $item->pasien->wali->tni_pangkat->nama ?? '-' : '' : ''}}</td>
                <td>{{!empty($item->pasien->wali) ? $item->pasien->wali->is_anggota == 1 ? $item->pasien->wali->tni_kotama->nama ?? '-' : '' : ''}}</td>
                <td>{{!empty($item->pasien->wali) ? $item->pasien->wali->is_anggota == 1 ? $item->pasien->wali->tni_satker->nama ?? '-' : '' : ''}}</td>
                <td>{{$item->pasien->jenis_hubungan_keluarga->nama ?? ''}}</td>
            @endif
        </tr>
    @endforeach
</table>