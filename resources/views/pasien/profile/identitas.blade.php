<div class="card">
    <div class="card-body">
        <div class="col-12 mt-20">
            <h6 class="text-muted">INFORMASI PASIEN</h6>
            <hr>
            <div class="row mb-20">
                <div class="col-lg-6 col-sm-12">
                    <div class="row mb-10">
                        <div class="col-lg-3 col-sm-6">
                            <label>Nama</label>
                        </div>
                        <div class="col-lg-9 col-sm-6">
                            {{$identitas->name or '-'}}
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <div class="row mb-10">
                        <div class="col-lg-3 col-sm-6">
                            <label>Kartu Identitas</label>
                        </div>
                        <div class="col-lg-9 col-sm-6">
                            @if(!empty($identitas->jenis_identitas))
                            {{$identitas->jenis_identitas->nama or '-'}}
                            @else @endif
                            - {{$identitas->no_identitas or '-'}}
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <div class="row mb-10">
                        <div class="col-lg-3 col-sm-6">
                            <label>Jenis Kelamin</label>
                        </div>
                        <div class="col-lg-9 col-sm-6">
                            @if($identitas->gender == 1) Laki laki
                            @else Perempuan
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <div class="row mb-10">
                        <div class="col-lg-3 col-sm-6">
                            <label>Kategori Pasien</label>
                        </div>
                        <div class="col-lg-9 col-sm-6">
                            {{ $identitas->kategori ?? '-' }}
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <div class="row mb-10">
                        <div class="col-lg-3 col-sm-6">
                            <label>TTL</label>
                        </div>
                        <div class="col-lg-9 col-sm-6">
                            {{$identitas->place_of_birth or '-'}}, {{date('d F Y', strtotime($identitas->date_of_birth))}}
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <div class="row mb-10">
                        <div class="col-lg-3 col-sm-6">
                            <label>Pekerjaan</label>
                        </div>
                        <div class="col-lg-9 col-sm-6">
                            {{$identitas->job or '-'}}
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <div class="row mb-10">
                        <div class="col-lg-3 col-sm-6">
                            <label>Usia</label>
                        </div>
                        <div class="col-lg-9 col-sm-6">
                            {{$identitas->detailed_long_age}}
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <div class="row mb-10">
                        <div class="col-lg-3 col-sm-6">
                            <label>Agama</label>
                        </div>
                        <div class="col-lg-9 col-sm-6">
                            @if(!empty($identitas->agama)){{$identitas->agama->nama or '-'}}
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <div class="row mb-20">
                        <div class="col-lg-3 col-sm-6">
                            <label>Alamat KTP</label>
                        </div>
                        <div class="col-lg-9 col-sm-6">
                            {{$identitas->address or '-'}}, 
                            @if(!empty($identitas->alamat_kecamatan))
                            {{$identitas->alamat_kelurahan->nama or '-'}}, {{$identitas->alamat_kecamatan->nama or '-'}}, {{$identitas->alamat_kota->nama or '-'}}, {{$identitas->alamat_kota->provinsi->nama or '-'}} 
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <div class="row mb-10">
                        <div class="col-lg-3 col-sm-6">
                            <label>Pendidikan</label>
                        </div>
                        <div class="col-lg-9 col-sm-6">
                            @if(!empty($identitas->pendidikan)){{$identitas->pendidikan->nama or '-'}}
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <div class="row mb-20">
                        <div class="col-lg-3 col-sm-6">
                            <label>Alamat Domisili</label>
                        </div>
                        <div class="col-lg-9 col-sm-6">
                            {{ $identitas->address_domisili ?? '-' }}
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <div class="row mb-10">
                        <div class="col-lg-3 col-sm-6">
                            <label>No HP</label>
                        </div>
                        <div class="col-lg-9 col-sm-6">
                            {{$identitas->phone or '-'}}
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <div class="row mb-10">
                        <div class="col-lg-3 col-sm-6">
                            <label>Pernikahan</label>
                        </div>
                        <div class="col-lg-9 col-sm-6">
                            {{$identitas->pernikahan->nama or '-'}}
                        </div>
                    </div>
                </div>

                

                <div class="col-lg-6 col-sm-12">
                    <div class="row mb-10">
                        <div class="col-lg-3 col-sm-6">
                            <label>Alergi</label>
                        </div>
                        <div class="col-lg-9 col-sm-6">
                            {{ $identitas->alergi ?? '-' }}
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="row mb-10">
                        <div class="col-lg-3 col-sm-6">
                            <label>Suku</label>
                        </div>
                        <div class="col-lg-9 col-sm-6">
                            {{$identitas->suku or '-'}}
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-12 col-sm-12"></div>

                <div class="col-lg-6 col-sm-12">
                    <div class="row mb-10">
                        <div class="col-lg-3 col-sm-6">
                            <label>Nama Ayah</label>
                        </div>
                        <div class="col-lg-9 col-sm-6">
                            {{$identitas->nama_ayah or '-'}}
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12"></div>

                <div class="col-lg-6 col-sm-12">
                    <div class="row mb-10">
                        <div class="col-lg-3 col-sm-6">
                            <label>Nama Ibu</label>
                        </div>
                        <div class="col-lg-9 col-sm-6">
                            {{$identitas->nama_ibu or '-'}}
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <div class="row mb-10">
                        <div class="col-lg-3 col-sm-6">
                            <label>IHS Number</label>
                        </div>
                        <div class="col-lg-9 col-sm-6">
                            {{$identitas->satusehat_patient->ihs_number or '-'}}
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="row mb-10">
                        <div class="col-lg-3 col-sm-6">
                            <label>Nama Suami</label>
                        </div>
                        <div class="col-lg-9 col-sm-6">
                            {{$identitas->nama_suami or '-'}}
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12"></div>

                <div class="col-lg-6 col-sm-12">
                    <div class="row mb-10">
                        <div class="col-lg-3 col-sm-6">
                            <label>Nama Istri</label>
                        </div>
                        <div class="col-lg-9 col-sm-6">
                            {{$identitas->nama_istri or '-'}}
                        </div>
                    </div>
                </div>
            </div>
            @if($identitas->is_anggota == 1)
            <div class="mt-20" id="infoAnggota">
                <h6 class="text-muted">INFORMASI ANGGOTA</h6>
                <hr>
                <div class="row">
                    <div class="col-lg-6 col-sm-12">
                        <div class="row mb-10">
                            <div class="col-lg-3 col-sm-6">
                                <label>NRP</label>
                            </div>
                            <div class="col-lg-9 col-sm-6">
                                {{$identitas->tni_nrp or '-'}}
                            </div>
                        </div>
                        <div class="row mb-10">
                            <div class="col-lg-3 col-sm-6">
                                <label>Keanggotaan</label>
                            </div>
                            <div class="col-lg-9 col-sm-6">
                                @if(!empty($identitas->tni_keanggotaan->nama))
                                    {{$identitas->tni_keanggotaan->nama or '-'}}
                                @endif
                            </div>
                        </div>
                        <div class="row mb-10">
                            <div class="col-lg-3 col-sm-6">
                                <label>Pangkat</label>
                            </div>
                            <div class="col-lg-9 col-sm-6">
                                @if(!empty($identitas->tni_pangkat->nama))
                                    {{$identitas->tni_pangkat->nama or '-'}}
                                @endif
                            </div>
                        </div>
                        <div class="row mb-10">
                            <div class="col-lg-3 col-sm-6">
                                <label>Kotama</label>
                            </div>
                            <div class="col-lg-9 col-sm-6">
                                @if(!empty($identitas->tni_kotama->nama))
                                    {{$identitas->tni_kotama->nama or '-'}}
                                @endif
                            </div>
                        </div>
                        <div class="row mb-10">
                            <div class="col-lg-3 col-sm-6">
                                <label>Satker</label>
                            </div>
                            <div class="col-lg-9 col-sm-6">
                                @if(!empty($identitas->tni_satker->nama))
                                    {{$identitas->tni_satker->nama or '-'}}
                                @endif
                            </div>
                        </div>
                        <div class="row mb-10">
                            <div class="col-lg-3 col-sm-6">
                                <label>Korps</label>
                            </div>
                            <div class="col-lg-9 col-sm-6">
                                @if(!empty($identitas->tni_korps->nama))
                                    {{$identitas->tni_korps->nama or '-'}}
                                @endif
                            </div>
                        </div>
                        <div class="row mb-10">
                            <div class="col-lg-3 col-sm-6">
                                <label>Jabatan</label>
                            </div>
                            <div class="col-lg-9 col-sm-6">
                                @if(!empty($identitas->tni_jabatan))
                                    {{$identitas->tni_jabatan or '-'}}
                                @endif
                            </div>
                        </div>
                        <div class="row mb-10">
                            <div class="col-lg-3 col-sm-6">
                                <label>Singkat Pangkat</label>
                            </div>
                            <div class="col-lg-9 col-sm-6">
                                @if(!empty($identitas->tni_pangkat_singkat))
                                    {{$identitas->tni_pangkat_singkat or '-'}}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @if(!empty($identitas->wali))
            <div class="mt-20 row">
                <div class="col-lg-6 col-sm-12">
                    <h6 class="text-muted">INFORMASI KERABAT</h6>
                    <hr>
                    <div class="row mb-10">
                        <div class="col-lg-3 col-sm-6">
                            <label>Nama</label>
                        </div>
                        <div class="col-lg-9 col-sm-6">
                            {{$identitas->wali->name or '-'}}
                        </div>
                    </div>
                    <div class="row mb-10">
                        <div class="col-lg-3 col-sm-6">
                            <label>Jenis Kelamin</label>
                        </div>
                        <div class="col-lg-9 col-sm-6">
                            @if($identitas->wali->gender == 1) Laki laki
                            @else Perempuan
                            @endif
                        </div>
                    </div>
                    <div class="row mb-10">
                        <div class="col-lg-3 col-sm-6">
                            <label>Alamat</label>
                        </div>
                        <div class="col-lg-9 col-sm-6">
                            {{$identitas->wali->address or '-'}}
                            @if(!empty($identitas->wali->alamat_kecamatan))
                            {{$identitas->wali->alamat_kelurahan->nama or '-'}}, {{$identitas->wali->alamat_kecamatan->nama or '-'}}, {{$identitas->wali->alamat_kota->nama or '-'}}, {{$identitas->wali->alamat_kota->provinsi->nama or '-'}}
                            @endif
                        </div>
                    </div>
                    <div class="row mb-10">
                        <div class="col-lg-3 col-sm-6">
                            <label>No Hp</label>
                        </div>
                        <div class="col-lg-9 col-sm-6">
                            {{$identitas->wali->phone or '-'}}
                        </div>
                    </div>
                    <div class="row mb-10">
                        <div class="col-lg-3 col-sm-6">
                            <label>Hubungan</label>
                        </div>
                        <div class="col-lg-9 col-sm-6">
                            {{$identitas->jenis_hubungan_keluarga->nama or '-'}}
                        </div>
                    </div>
                </div>
                @if($identitas->wali->is_anggota == 1)
                <div class="col-lg-6 col-sm-12" id="kerabatAnggota">
                    <h6 class="text-muted">INFORMASI KERABAT ANGGOTA</h6>
                    <hr>
                    <div class="row mb-10">
                        <div class="col-lg-3 col-sm-6">
                            <label>Nama</label>
                        </div>
                        <div class="col-lg-9 col-sm-6">
                                {{$identitas->wali->tni_nama or '-'}}
                        </div>
                    </div>
                    <div class="row mb-10">
                        <div class="col-lg-3 col-sm-6">
                            <label>NRP</label>
                        </div>
                        <div class="col-lg-9 col-sm-6">
                                {{$identitas->wali->tni_nrp or '-'}}
                        </div>
                    </div>
                    <div class="row mb-10">
                        <div class="col-lg-3 col-sm-6">
                            <label>Keanggotaan</label>
                        </div>
                        <div class="col-lg-9 col-sm-6">
                                {{$identitas->wali->tni_keanggotaan->nama or '-'}}
                        </div>
                    </div>
                    <div class="row mb-10">
                        <div class="col-lg-3 col-sm-6">
                            <label>Pangkat</label>
                        </div>
                        <div class="col-lg-9 col-sm-6">
                                {{$identitas->wali->tni_pangkat->nama or '-'}}
                        </div>
                    </div>
                    <div class="row mb-10">
                        <div class="col-lg-3 col-sm-6">
                            <label>Kotama</label>
                        </div>
                        <div class="col-lg-9 col-sm-6">
                                {{$identitas->wali->tni_kotama->nama or '-'}}
                        </div>
                    </div>
                    <div class="row mb-10">
                        <div class="col-lg-3 col-sm-6">
                            <label>Satker</label>
                        </div>
                        <div class="col-lg-9 col-sm-6">
                                {{$identitas->wali->tni_satker->nama or '-'}}
                        </div>
                    </div>
                    <div class="row mb-10">
                        <div class="col-lg-3 col-sm-6">
                            <label>Hubungan</label>
                        </div>
                        <div class="col-lg-9 col-sm-6">
                            {{$identitas->wali->tni_hubungan->nama or '-'}}
                        </div>
                    </div>
                </div>
                @endif
            </div>
            @endif
        </div>

        @php
            $pasien_photo_data_ktp = (!empty($identitas->photo_identity) && $identitas->photo_identity != 'assets/img/placeholder.jpg');
            $pasien_photo_data_kk = (!empty($identitas->file_kk) && $identitas->file_kk != 'assets/img/placeholder.jpg');
            $pasien_photo_data_kartu_asuransi = (!empty($identitas->file_kartu_asuransi) && $identitas->file_kartu_asuransi != 'assets/img/placeholder.jpg');
            $available_photo_data = $pasien_photo_data_ktp && $pasien_photo_data_kk && $pasien_photo_data_kartu_asuransi;
        @endphp
        <div class="row mt-20">
            <div class="col-12 row">
                <div class="col-lg-3 col-sm-12">
                    <h6 class="text-muted" style="margin: 0;">INFORMASI FOTO DATA PASIEN</h6>
                </div>
            </div>
            <div class="col-12 row">
                <div class="col-12">
                    <hr>
                </div>

                @if ($pasien_photo_data_ktp)
                    <div class="col-lg-4 col-sm-12">
                        <div class="block block-rounded pasien-foto-data">
                            <div class="block-content">
                                    <form method="POST" action="{{ url('pasien/download/berkas') }}" onsubmit="$(this).unbind('submit')">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="filename" value="{{ $identitas->photo_identity }}">
                                        <input type="hidden" name="file_rename" value="foto_ktp_pasien_rm_{{ $identitas->no_rm }}">
                                        <button type="submit" class="btn btn-circle btn-alt-secondary btn-download"><i class="fa fa-download"></i></button>
                                    </form>
                                <img src="{{asset('')}}/{{$identitas->photo_identity}}">
                            </div>
                        </div>
                    </div>
                @endif

                @if ($pasien_photo_data_kk)
                    <div class="col-lg-4 col-sm-12">
                        <div class="block block-rounded pasien-foto-data">
                            <div class="block-content">
                                    <form method="POST" action="{{ url('pasien/download/berkas') }}" onsubmit="$(this).unbind('submit')">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="filename" value="{{ $identitas->file_kk }}">
                                        <input type="hidden" name="file_rename" value="foto_kk_pasien_rm_{{ $identitas->no_rm }}">
                                        <button type="submit" class="btn btn-circle btn-alt-secondary btn-download"><i class="fa fa-download"></i></button>
                                    </form>
                                <img src="{{asset('')}}/{{$identitas->file_kk}}">
                            </div>
                        </div>
                    </div>
                @endif

                @if ($pasien_photo_data_kartu_asuransi)
                    <div class="col-lg-4 col-sm-12">
                        <div class="block block-rounded pasien-foto-data">
                            <div class="block-content">
                                <form method="POST" action="{{ url('pasien/download/berkas') }}" onsubmit="$(this).unbind('submit')">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="filename" value="{{ $identitas->file_kartu_asuransi }}">
                                    <input type="hidden" name="file_rename" value="foto_kartu_asuransi_pasien_rm_{{ $identitas->no_rm }}">
                                    <button type="submit" class="btn btn-circle btn-alt-secondary btn-download"><i class="fa fa-download"></i></button>
                                </form>
                                <img src="{{asset('')}}/{{$identitas->file_kartu_asuransi}}">
                            </div>
                        </div>
                    </div>
                @endif

                @if (!$available_photo_data)
                    <div class="col-12">
                        <p class="text-muted">Data belum tersedia</p>
                    </div>
                @endif
            </div>
        </div>

        <div class="row mt-20">
            <div class="col-12">
                <div class="mt-20">
                    <div class="row">
                        <div class="col-lg-3 col-sm-12">
                            <h6 class="text-muted" style="margin: 0;">INFORMASI PEMBAYARAN</h6>    
                        </div>
                        <div class="col-lg-9 col-sm-12">
                            <a href="{{url()->current()}}/pembayaran/baru" class="btn" style="padding: 0;">+ Tambah Metode Pembayaran</a>
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-10">
                        @foreach($pembayaran as $bayar)
                        <div class="col-lg-4 col-sm-12">
                            @if($bayar->utama == 1)
                            <div class="block block-bordered bg-earth-lighter">
                            @else
                            <div class="block block-bordered">
                            @endif
                                <div class="block-header">
                                    <h3 class="block-title">
                                        {{$bayar->perusahaan->tipe->nama}}
                                    
                                        @if($bayar->utama == 1) (Utama)
                                        @else
                                            <button type="button" onclick="setPembayaranUtama({{ $identitas->id }},{{ $bayar->id }})" class="btn btn-sm btn-circle btn-noborder btn-outline-secondary pull-right" title="Jadikan Pembayaran Utama"><i class="fas fa-key"></i></button>
                                        @endif
                                    </h3>
                                        @if(count($pembayaran)!=1)
                                           <button type="button" class="btn btn-sm btn-circle btn-noborder btn-outline-danger pull-right d-none" onclick="pembayaranDeleteModal({{$bayar->id}})"><i class="fa fa-trash"></i></button>
                                        @endif
                                    <a href="{{url()->current()}}/pembayaran/edit/{{$bayar->id}}" class="btn btn-sm btn-circle btn-noborder btn-outline-info pull-right"><i class="fa fa-pencil"></i></a>
                                </div>
                                <div class="block-content">
                                    <div class="row mb-10">
                                        <div class="col-lg-6 col-sm-12">
                                            <label class="text-muted">Jenis Pasien</label>
                                        </div>
                                        <div class="col-lg-6 col-sm-12">
                                            {{$bayar->perusahaan->tipe->nama or '-'}}
                                        </div>
                                    </div>
                                    @if(!($bayar->perusahaan_id==80))
                                    <div class="row mb-10">
                                        <div class="col-lg-6 col-sm-12">
                                            <label class="text-muted">
                                                Jenis Perusahaan
                                            </label>
                                        </div>
                                        <div class="col-lg-6 col-sm-12">
                                            {{$bayar->perusahaan->nama or '-'}}
                                        </div>
                                    </div>
                                    <div class="row mb-10">
                                        <div class="col-lg-6 col-sm-12">
                                            <label class="text-muted">
                                                Nomor Asuransi
                                            </label>
                                        </div>
                                        <div class="col-lg-6 col-sm-12">
                                            {{$bayar->no_asuransi or '-'}}
                                        </div>
                                    </div>
                                    @endif
                                    <div class="row mb-10">
                                        <div class="col-lg-6 col-sm-12">
                                            <label class="text-muted">Kelas Perawatan</label>
                                        </div>
                                        <div class="col-lg-6 col-sm-12">
                                            Kelas {{$bayar->kelas->nama or '-'}}
                                        </div>
                                    </div>
                                </div>
                            </div>                            
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <hr>
            <div class="row">
                <div class="col-lg-6 col-sm-12">
                    <h6 class="pt-10">
                        <small class="text-muted">Terakhir Diubah Oleh</small><br>
                        <span class="float-right"> <i class="fa fa-clock-o text-muted"></i> {{ $identitas->tanggal }} </span>
                        {{ $identitas->creator->name or '-'}}
                    </h6>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="modal-large" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form method="POST" action="{{url('rawatinap/pengaturan/ruangan/edit')}}" enctype="multipart/form-data">
                <div class="block block-themed block-transparent mb-0">

                    <div class="block-header">
                        <h3 class="block-title">Edit Data Ruangan</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>


                    <div class="block-content">
                        {{csrf_field()}}
                        <input type="hidden" name="ruangan_id" id="inputEditRuanganID">
                        <div class="form-group row">
                            <div class="col-md-8 text-left">
                                <label >Nama Ruangan</label>
                                <input type="text" class="form-control" name="name" id="inputEditRuanganNama" placeholder="..">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-8  text-left">
                                <label>Kelas</label>
                                <select class="js-select2 form-control" name="kelas" id="inputEditRuanganKelas" style="width: 100%;" data-placeholder="Choose one..">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="vip">VIP</option>
                                    <option value="vvip">VVIP</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary btn-hero" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-alt-primary btn-hero">
                        <i class="fa fa-check"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@section('js')

<script type="text/javascript">
    $( document ).ready(function() {
        if({{$identitas->is_anggota}} !=1){
            $('#infoAnggota').hide();
        }
        @if(!empty($identitas->wali))
            if({{$identitas->wali->is_anggota}} !=1){
                $('#kerabatAnggota').hide();   
            }
        @endif
    });

    $(".clickable-row").click(function() {
        window.location = $(this).data("href");
    });

    function setPembayaranUtama(pasien_id, bayar_id) {
        $(".fa-key").parent().attr("disabled",true)
        $(".fa-key").removeClass("fa-key").addClass("fa-circle-o-notch fa-spin")
        $.ajax({
            type: "POST",
            url: "{{url()->current()}}/pembayaran/jadikan-utama",
            data: {
                pasien_id,
                bayar_id,
                _token: "{{ csrf_token() }}"
            },
            success: function (response) {
                swal(
					"Berhasil",
					"Metode Pembayaran Utama Diperbaharui",
					"success"
				)
                location.reload()
            },
            error: function() {
				swal(
					"Gagal",
					"Terjadi Kesalahan",
					"error"
				)
                location.reload()
			}
        });
    }
</script>
@endsection