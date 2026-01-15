<br><br><br>
<table style="width: 100%;">
    <tr>
        <td class=" position-relative text-center border-top border-bottom border-left border-right p-0" colspan="1" rowspan="1">
            <h5 class="mb-0">PERSETUJUAN TINDAKAN KEDOKTERAN</h5>
        </td>
    </tr>
    <tr>
        <td style="width:100%;" class=" position-relative text-center border-left border-right" colspan="1" rowspan="1">
            <span>Yang bertanda tangan dibawah ini :</span>
        </td>
    </tr>
</table>
<table style="width: 100%" class="border-left border-right">
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>Nama</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>:</span>
        </td>
        <td class=" position-relative" colspan="4" rowspan="1">
            <div class="form-group medify-form-genv4-input-container d-inline-block">
                <input type="text" class="form-control" name="persetujuan[nama]" value="{{$hasil_data->{'persetujuan'}->{'nama'} ?? '' ?? ''}}">
            </div>
            <span class="form-group medify-form-genv4-view-container"> {{$hasil_data->{'persetujuan'}->{'nama'} ?? '' ?? ''}}</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>Alamat</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>:</span>
        </td>
        <td class=" position-relative" colspan="4" rowspan="1">
            <div class="form-group medify-form-genv4-input-container d-inline-block">
                <input type="text" class="form-control" name="persetujuan[alamat]" value="{{$hasil_data->{'persetujuan'}->{'alamat'} ?? '' ?? ''}}">
            </div>
            <span class="form-group medify-form-genv4-view-container"> {{$hasil_data->{'persetujuan'}->{'alamat'} ?? '' ?? ''}}</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>No. Telepon</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>:</span>
        </td>
        <td class=" position-relative" colspan="4" rowspan="1">
            <div class="form-group medify-form-genv4-input-container d-inline-block">
                <input type="text" class="form-control" name="persetujuan[nomor_telepon]" value="{{$hasil_data->{'persetujuan'}->{'nomor_telepon'} ?? '' ?? ''}}">
            </div>
            <span class="form-group medify-form-genv4-view-container"> {{$hasil_data->{'persetujuan'}->{'nomor_telepon'} ?? '' ?? ''}}</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>Hubungan dengan Pasien</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>:</span>
        </td>
        <td class=" position-relative" colspan="4" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container d-inline-block">
                <input class="form-check-input" type="radio" name="persetujuan[hubungan_dengan_pasien]" id="radio-input-fasfwa" value="Diri Sendiri" @php $hasil_data_temp=$hasil_data->{'persetujuan'}->{'hubungan_dengan_pasien'} ?? '' @endphp @if($hasil_data_temp == 'Diri Sendiri' ) checked @endif > <label class="form-check-label" for="radio-input-fasfwa"> Diri Sendiri </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'persetujuan'}->{'hubungan_dengan_pasien'} ?? '' @endphp @if($hasil_data_temp == 'Diri Sendiri' ) <span style='font-family:calibri'>&#x2611;</span> @else <span style='font-family:calibri'>&#x2610;</span> @endif Diri Sendiri </span>
            <span>&nbsp;&nbsp;</span>
            <div class="form-check form-check-inline medify-form-genv4-input-container d-inline-block">
                <input class="form-check-input" type="radio" name="persetujuan[hubungan_dengan_pasien]" id="radio-input-csadas" value="Suami" @php $hasil_data_temp=$hasil_data->{'persetujuan'}->{'hubungan_dengan_pasien'} ?? '' @endphp @if($hasil_data_temp == 'Suami' ) checked @endif > <label class="form-check-label" for="radio-input-csadas"> Suami </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'persetujuan'}->{'hubungan_dengan_pasien'} ?? '' @endphp @if($hasil_data_temp == 'Suami' ) <span style='font-family:calibri'>&#x2611;</span> @else <span style='font-family:calibri'>&#x2610;</span> @endif Suami </span>
            <span>&nbsp;&nbsp;</span>
            <div class="form-check form-check-inline medify-form-genv4-input-container d-inline-block">
                <input class="form-check-input" type="radio" name="persetujuan[hubungan_dengan_pasien]" id="radio-input-fsa13242" value="Istri" @php $hasil_data_temp=$hasil_data->{'persetujuan'}->{'hubungan_dengan_pasien'} ?? '' @endphp @if($hasil_data_temp == 'Istri' ) checked @endif > <label class="form-check-label" for="radio-input-fsa13242"> Istri </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'persetujuan'}->{'hubungan_dengan_pasien'} ?? '' @endphp @if($hasil_data_temp == 'Istri' ) <span style='font-family:calibri'>&#x2611;</span> @else <span style='font-family:calibri'>&#x2610;</span> @endif Istri </span>
            <span>&nbsp;&nbsp;</span>
            <div class="form-check form-check-inline medify-form-genv4-input-container d-inline-block">
                <input class="form-check-input" type="radio" name="persetujuan[hubungan_dengan_pasien]" id="radio-input-casfqw2" value="Ayah" @php $hasil_data_temp=$hasil_data->{'persetujuan'}->{'hubungan_dengan_pasien'} ?? '' @endphp @if($hasil_data_temp == 'Ayah' ) checked @endif > <label class="form-check-label" for="radio-input-casfqw2"> Ayah </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'persetujuan'}->{'hubungan_dengan_pasien'} ?? '' @endphp @if($hasil_data_temp == 'Ayah' ) <span style='font-family:calibri'>&#x2611;</span> @else <span style='font-family:calibri'>&#x2610;</span> @endif Ayah </span>
            <span>&nbsp;&nbsp;</span>
            <div class="form-check form-check-inline medify-form-genv4-input-container d-inline-block">
                <input class="form-check-input" type="radio" name="persetujuan[hubungan_dengan_pasien]" id="radio-input-dcasdsad" value="Ibu" @php $hasil_data_temp=$hasil_data->{'persetujuan'}->{'hubungan_dengan_pasien'} ?? '' @endphp @if($hasil_data_temp == 'Ibu' ) checked @endif > <label class="form-check-label" for="radio-input-dcasdsad"> Ibu </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'persetujuan'}->{'hubungan_dengan_pasien'} ?? '' @endphp @if($hasil_data_temp == 'Ibu' ) <span style='font-family:calibri'>&#x2611;</span> @else <span style='font-family:calibri'>&#x2610;</span> @endif Ibu </span>
            <span>&nbsp;&nbsp;</span>
            <div class="form-check form-check-inline medify-form-genv4-input-container d-inline-block">
                <input class="form-check-input" type="radio" name="persetujuan[hubungan_dengan_pasien]" id="radio-input-csafsawqv" value="Anak" @php $hasil_data_temp=$hasil_data->{'persetujuan'}->{'hubungan_dengan_pasien'} ?? '' @endphp @if($hasil_data_temp == 'Anak' ) checked @endif > <label class="form-check-label" for="radio-input-csafsawqv"> Anak </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'persetujuan'}->{'hubungan_dengan_pasien'} ?? '' @endphp @if($hasil_data_temp == 'Anak' ) <span style='font-family:calibri'>&#x2611;</span> @else <span style='font-family:calibri'>&#x2610;</span> @endif Anak </span>
            <span>&nbsp;&nbsp;</span>
            <div class="form-check form-check-inline medify-form-genv4-input-container d-inline-block">
                <input class="form-check-input" type="radio" name="persetujuan[hubungan_dengan_pasien]" id="radio-input-sadwq" value="Lain-lain" @php $hasil_data_temp=$hasil_data->{'persetujuan'}->{'hubungan_dengan_pasien'} ?? '' @endphp @if($hasil_data_temp == 'Lain-lain' ) checked @endif > <label class="form-check-label" for="radio-input-sadwq"> Lain-lain </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'persetujuan'}->{'hubungan_dengan_pasien'} ?? '' @endphp @if($hasil_data_temp == 'Lain-lain' ) <span style='font-family:calibri'>&#x2611;</span> @else <span style='font-family:calibri'>&#x2610;</span> @endif Lain-lain </span>
            <span>&nbsp;&nbsp;</span>
            <div class="form-group medify-form-genv4-input-container d-inline-block">
                <input type="text" class="form-control" name="persetujuan[hubungan_dengan_pasien_lain_lain]" value="{{$hasil_data->{'persetujuan'}->{'hubungan_dengan_pasien_lain_lain'} ?? '' ?? ''}}">
            </div>
            <span class="form-group medify-form-genv4-view-container"> {{$hasil_data->{'persetujuan'}->{'hubungan_dengan_pasien_lain_lain'} ?? '.............' ?? ''}}</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="6" rowspan="1">
            <span>Dengan ini menyatakan persetujuan untuk dilakukannya tindakan terhadap :</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>No. RM</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>:</span>
        </td>
        <td class=" position-relative" colspan="4" rowspan="1">
            <span>{{ $kasus->pasien->no_rm }}</span>
        </td>
    </tr>
    <tr>
        <td style="width: 18%" class=" position-relative" colspan="1" rowspan="1">
            <span>Nama</span>
        </td>
        <td style="width: 2%" class=" position-relative" colspan="1" rowspan="1">
            <span>:</span>
        </td>
        <td style="width: 30%" class=" position-relative" colspan="1" rowspan="1">
            <span>{{ $kasus->pasien->name }}</span>
        </td>
        <td style="width: 18%" class=" position-relative" colspan="1" rowspan="1">
            <span>Jenis Kelamin</span>
        </td>
        <td style="width: 2%" class=" position-relative" colspan="1" rowspan="1">
            <span>:</span>
        </td>
        <td style="width: 30%" class=" position-relative" colspan="1" rowspan="1">
            <span>
            @if($kasus->identitas->gender == 1) L
            @else P
            @endif
            </span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>Tgl Lahir/Umur</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>:</span>
        </td>
        <td class=" position-relative" colspan="4" rowspan="1">
            <span>{{date('d F Y', strtotime($kasus->identitas->tanggal_lahir))}}</span>
            <span>/</span>
            <span>{{ $kasus->identitas->age ?? '' }}</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>Ruangan</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>:</span>
        </td>
        <td class=" position-relative" colspan="4" rowspan="1">
            <span>{{ $kasus->lokasi->lokasi->nama ?? '' }}</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="6" rowspan="1">
            <span>Saya memahami perlunya dan manfaat tindakan tersebut sebagaimana telah dijelaskan diatas kepada saya, termasuk resiko dan komplikasi yang mungkin timbul.</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="6" rowspan="1">
            <span>Saya menyadari bahwa oleh karena ilmu kedokteran bukanlah ilmu pasti, maka keberhasilan tindakan kedokteran bukanlah keniscayaan, melainkan sangat bergantung kepada izin Tuhan Yang Maha Esa.</span>
        </td>
    </tr>
</table>
<table style="width: 100%;" class="border-bottom border-left border-right">
    <tr>
        <td class=" position-relative" colspan="3" rowspan="1"></td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="3" rowspan="1">
            <span>Surabaya,</span>
            <div class="form-group medify-form-genv4-input-container d-inline-block">
                <input type="date" class="form-control" name="tanggal_persetujuan_asesmen" value="{{$hasil_data->tanggal_persetujuan_asesmen ?? '' ?? ''}}">
            </div>
            <span class="form-group medify-form-genv4-view-container"> {{($hasil_data->tanggal_persetujuan_asesmen ?? null) ? indonesian_date($hasil_data->tanggal_persetujuan_asesmen) : '..........................'}}</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="3" rowspan="1"></td>
    </tr>
    <tr>
        <td class=" position-relative text-center align-top" colspan="1" rowspan="1">
            <span>Yang menyatakan persetujuan </span>
        </td>
        <td class=" position-relative text-center align-top" colspan="1" rowspan="1">
            <span>Dokter</span>
        </td>
        <td class=" position-relative text-center align-top" colspan="1" rowspan="1">
            <span>Saksi keluarga/ petugas</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center align-top" colspan="1" rowspan="1">
            @if (($hasil_data->yang_menyatakan_persetujuan ?? '') != '')
                @if (file_exists(((($hasil_data->{'ttd_yang_menyatakan_persetujuan'} ?? '') ?? ''))))
                <div>
                    <img style="max-width: 100%;width:105px;height:60px;object-fit:contain;" src="{{ url('') }}/{{ $hasil_data->{'ttd_yang_menyatakan_persetujuan'} }}" alt="Tanda tangan">
                </div>
                @else
                <br><br><br><br>
                @endif
            @endif
        </td>
        <td class=" position-relative text-center align-top" colspan="1" rowspan="1">
            @if (($kasus->dpjp ?? null) != null)
                @if (file_exists(((($kasus->dpjp->user->ttd ?? '') ?? ''))))
                <div>
                    <img style="max-width: 100%;width:105px;height:60px;object-fit:contain;" src="{{ url('') }}/{{ $kasus->dpjp->user->ttd }}" alt="Tanda tangan">
                </div>
                @else
                <br><br><br><br>
                @endif
            @endif
        </td>
        <td class=" position-relative text-center align-top" colspan="1" rowspan="1">
            @if ((Auth::user()->ttd ?? null) != null)
                @if (file_exists((((Auth::user()->ttd ?? '') ?? ''))))
                <div>
                    <img style="max-width: 100%;width:105px;height:60px;object-fit:contain;" src="{{ url('') }}/{{ Auth::user()->ttd }}" alt="Tanda tangan">
                </div>
                @else
                <br><br><br><br>
                @endif
            @endif
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center align-top" colspan="1" rowspan="1">
            @if (($hasil_data->yang_menyatakan_persetujuan ?? '') != '')
                <div>( <span>{{ $hasil_data->{'yang_menyatakan_persetujuan'} ?? '' }}</span> )</div>
            @else
                <div>( <span>.............................</span> )</div>
            @endif
        </td>
        <td class=" position-relative text-center align-top" colspan="1" rowspan="1">
            @if (($kasus->dpjp ?? null) != null)
                <div>( <span>{{ $kasus->dpjp->user->name ?? '' }}</span> )</div>
            @else
                <div>( .............................. )</div>
            @endif
        </td>
        <td class=" position-relative text-center align-top" colspan="1" rowspan="1">
            @if ((Auth::user()->ttd ?? null) != null)
                <div>( <span>{{ Auth::user()->name ?? '' }}</span> )</div>
            @else
                <div>( .............................. )</div>
            @endif
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="3" rowspan="1">
            <span>**) Coret yang tidak perlu</span>
        </td>
    </tr>
</table>