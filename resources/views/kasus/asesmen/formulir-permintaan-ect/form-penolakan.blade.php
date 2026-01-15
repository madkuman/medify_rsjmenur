<table style="width: 100%;">
    <tr>
        <td class=" position-relative text-center border-bottom border-left border-right p-0" colspan="1" rowspan="1">
            <h5 class="mb-0">PENOLAKAN TINDAKAN KEDOKTERAN</h5>
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
                <input type="text" class="form-control" name="penolakan[nama]" value="{{$hasil_data->{'penolakan'}->{'nama'} ?? '' ?? ''}}">
            </div>
            <span class="form-group medify-form-genv4-view-container"> {{$hasil_data->{'penolakan'}->{'nama'} ?? '' ?? ''}}</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>Alamat</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>:</span>
        </td>
        <td class=" position-relative" colspan="2" rowspan="1">
            <div class="form-group medify-form-genv4-input-container d-inline-block">
                <input type="text" class="form-control" name="penolakan[alamat]" value="{{$hasil_data->{'penolakan'}->{'alamat'} ?? '' ?? ''}}">
            </div>
            <span class="form-group medify-form-genv4-view-container"> {{$hasil_data->{'penolakan'}->{'alamat'} ?? '' ?? ''}}</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>No. Telepon</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>:</span>
        </td>
        <td class=" position-relative" colspan="2" rowspan="1">
            <div class="form-group medify-form-genv4-input-container d-inline-block">
                <input type="text" class="form-control" name="penolakan[nomor_telepon]" value="{{$hasil_data->{'penolakan'}->{'nomor_telepon'} ?? '' ?? ''}}">
            </div>
            <span class="form-group medify-form-genv4-view-container"> {{$hasil_data->{'penolakan'}->{'nomor_telepon'} ?? '' ?? ''}}</span>
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
                <input class="form-check-input" type="radio" name="penolakan[hubungan_dengan_pasien]" id="radio-input-2121" value="Diri Sendiri" @php $hasil_data_temp=$hasil_data->{'penolakan'}->{'hubungan_dengan_pasien'} ?? '' @endphp @if($hasil_data_temp == 'Diri Sendiri' ) checked @endif > <label class="form-check-label" for="radio-input-2121"> Diri Sendiri </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'penolakan'}->{'hubungan_dengan_pasien'} ?? '' @endphp @if($hasil_data_temp == 'Diri Sendiri' ) <span style='font-family:calibri'>&#x2611;</span> @else <span style='font-family:calibri'>&#x2610;</span> @endif Diri Sendiri </span>
            <span>&nbsp;&nbsp;</span>
            <div class="form-check form-check-inline medify-form-genv4-input-container d-inline-block">
                <input class="form-check-input" type="radio" name="penolakan[hubungan_dengan_pasien]" id="radio-input-df21" value="Suami" @php $hasil_data_temp=$hasil_data->{'penolakan'}->{'hubungan_dengan_pasien'} ?? '' @endphp @if($hasil_data_temp == 'Suami' ) checked @endif > <label class="form-check-label" for="radio-input-df21"> Suami </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'penolakan'}->{'hubungan_dengan_pasien'} ?? '' @endphp @if($hasil_data_temp == 'Suami' ) <span style='font-family:calibri'>&#x2611;</span> @else <span style='font-family:calibri'>&#x2610;</span> @endif Suami </span>
            <span>&nbsp;&nbsp;</span>
            <div class="form-check form-check-inline medify-form-genv4-input-container d-inline-block">
                <input class="form-check-input" type="radio" name="penolakan[hubungan_dengan_pasien]" id="radio-input-fsf13" value="Istri" @php $hasil_data_temp=$hasil_data->{'penolakan'}->{'hubungan_dengan_pasien'} ?? '' @endphp @if($hasil_data_temp == 'Istri' ) checked @endif > <label class="form-check-label" for="radio-input-fsf13"> Istri </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'penolakan'}->{'hubungan_dengan_pasien'} ?? '' @endphp @if($hasil_data_temp == 'Istri' ) <span style='font-family:calibri'>&#x2611;</span> @else <span style='font-family:calibri'>&#x2610;</span> @endif Istri </span>
            <span>&nbsp;&nbsp;</span>
            <div class="form-check form-check-inline medify-form-genv4-input-container d-inline-block">
                <input class="form-check-input" type="radio" name="penolakan[hubungan_dengan_pasien]" id="radio-input-faffsa" value="Ayah" @php $hasil_data_temp=$hasil_data->{'penolakan'}->{'hubungan_dengan_pasien'} ?? '' @endphp @if($hasil_data_temp == 'Ayah' ) checked @endif > <label class="form-check-label" for="radio-input-faffsa"> Ayah </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'penolakan'}->{'hubungan_dengan_pasien'} ?? '' @endphp @if($hasil_data_temp == 'Ayah' ) <span style='font-family:calibri'>&#x2611;</span> @else <span style='font-family:calibri'>&#x2610;</span> @endif Ayah </span>
            <span>&nbsp;&nbsp;</span>
            <div class="form-check form-check-inline medify-form-genv4-input-container d-inline-block">
                <input class="form-check-input" type="radio" name="penolakan[hubungan_dengan_pasien]" id="radio-input-casdfq" value="Ibu" @php $hasil_data_temp=$hasil_data->{'penolakan'}->{'hubungan_dengan_pasien'} ?? '' @endphp @if($hasil_data_temp == 'Ibu' ) checked @endif > <label class="form-check-label" for="radio-input-casdfq"> Ibu </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'penolakan'}->{'hubungan_dengan_pasien'} ?? '' @endphp @if($hasil_data_temp == 'Ibu' ) <span style='font-family:calibri'>&#x2611;</span> @else <span style='font-family:calibri'>&#x2610;</span> @endif Ibu </span>
            <span>&nbsp;&nbsp;</span>
            <div class="form-check form-check-inline medify-form-genv4-input-container d-inline-block">
                <input class="form-check-input" type="radio" name="penolakan[hubungan_dengan_pasien]" id="radio-input-casfqr21" value="Anak" @php $hasil_data_temp=$hasil_data->{'penolakan'}->{'hubungan_dengan_pasien'} ?? '' @endphp @if($hasil_data_temp == 'Anak' ) checked @endif > <label class="form-check-label" for="radio-input-casfqr21"> Anak </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'penolakan'}->{'hubungan_dengan_pasien'} ?? '' @endphp @if($hasil_data_temp == 'Anak' ) <span style='font-family:calibri'>&#x2611;</span> @else <span style='font-family:calibri'>&#x2610;</span> @endif Anak </span>
            <span>&nbsp;&nbsp;</span>
            <div class="form-check form-check-inline medify-form-genv4-input-container d-inline-block">
                <input class="form-check-input" type="radio" name="penolakan[hubungan_dengan_pasien]" id="radio-input-dsaq" value="Lain-lain" @php $hasil_data_temp=$hasil_data->{'penolakan'}->{'hubungan_dengan_pasien'} ?? '' @endphp @if($hasil_data_temp == 'Lain-lain' ) checked @endif > <label class="form-check-label" for="radio-input-dsaq"> Lain-lain </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'penolakan'}->{'hubungan_dengan_pasien'} ?? '' @endphp @if($hasil_data_temp == 'Lain-lain' ) <span style='font-family:calibri'>&#x2611;</span> @else <span style='font-family:calibri'>&#x2610;</span> @endif Lain-lain </span>
            <span>&nbsp;&nbsp;</span>
            <div class="form-group medify-form-genv4-input-container d-inline-block">
                <input type="text" class="form-control" name="penolakan[hubungan_dengan_pasien_lain_lain]" value="{{$hasil_data->{'penolakan'}->{'hubungan_dengan_pasien_lain_lain'} ?? '' ?? ''}}">
            </div>
            <span class="form-group medify-form-genv4-view-container"> {{$hasil_data->{'penolakan'}->{'hubungan_dengan_pasien_lain_lain'} ?? '.............' ?? ''}}</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="6" rowspan="1">
            <span>Dengan ini menyatakan penolakan untuk dilakukannya tindakan terhadap :</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>No. RM</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>:</span>
        </td>
        <td class=" position-relative" colspan="2" rowspan="1">
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
        <td style="width: 30%" class=" position-relative" colspan="4" rowspan="1">
            <span>{{ $kasus->pasien->name }}</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>Umur</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>:</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>{{ $kasus->identitas->age ?? '' }}</span>
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
            <span>Ruangan</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>:</span>
        </td>
        <td class=" position-relative" colspan="2" rowspan="1">
            <span>{{ $kasus->lokasi->lokasi->nama ?? '' }}</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="6" rowspan="1">
            <span>Saya memahami perlunya dan manfaat tindakan tersebut sebagaimana telah dijelaskan seperti diatas kepada saya, termasuk resiko dan komplikasi yang mungkin timbul apabila tindakan tersebut tidak dilakukan.</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="6" rowspan="1">
            <span>Saya bertanggung jawab secara penuh atas segala akibat yang mungkin timbul sebagai akibat tidak dilakukannya tindakan kedokteran tersebut.</span>
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
                <input type="date" class="form-control" name="tanggal_penolakan_asesmen" value="{{$hasil_data->tanggal_penolakan_asesmen ?? '' ?? ''}}">
            </div>
            <span class="form-group medify-form-genv4-view-container"> {{($hasil_data->tanggal_penolakan_asesmen ?? null) ? indonesian_date($hasil_data->tanggal_penolakan_asesmen) : '..........................'}}</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="3" rowspan="1"></td>
    </tr>
    <tr>
        <td class=" position-relative text-center align-top" colspan="1" rowspan="1">
            <span>Yang menyatakan penolakan </span>
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
            @if (($hasil_data->yang_menyatakan_penolakan ?? '') != '')
                @if (file_exists(((($hasil_data->{'ttd_yang_menyatakan_penolakan'} ?? '') ?? ''))))
                <div>
                    <img style="max-width: 100%;width:105px;height:60px;object-fit:contain;" src="{{ url('') }}/{{ $hasil_data->{'ttd_yang_menyatakan_penolakan'} }}" alt="Tanda tangan">
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
            @if (($hasil_data->yang_menyatakan_penolakan ?? '') != '')
                <div>( <span>{{ $hasil_data->{'yang_menyatakan_penolakan'} ?? '' }}</span> )</div>
            @else
                <div>( <span>.............................</span> )</div>
            @endif
        </td>
        <td class=" position-relative text-center align-top" colspan="1" rowspan="1">
            @if (($kasus->dpjp ?? null) != null)
                <div>( <span>{{ $kasus->dpjp->user->name ?? '' }}</span> )</div>
            @else
                <div>( ............................. )</div>
            @endif
        </td>
        <td class=" position-relative text-center align-top" colspan="1" rowspan="1">
            @if ((Auth::user()->ttd ?? null) != null)
                <div>( <span>{{ Auth::user()->name ?? '' }}</span> )</div>
            @else
                <div>( ............................. )</div>
            @endif
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="3" rowspan="1">
            <span>**) Coret yang tidak perlu</span>
        </td>
    </tr>
</table>