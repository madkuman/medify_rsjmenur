<div class="col-lg-6 col-12 p-10 mb-10">
    <div class="border p-10" style="height: 100%">
        <p class="h6 my-0 mb-10">DATA PASIEN 
            <a class="btn btn-secondary pull-right" 
            <?php if(!is_null($transaksi->kasus_id)) {?>
                href="{{url('kasus/'.$transaksi->kasus->nomor_kasus)}}" 
            <?php } else {?>
                href="{{url('pasien/'.$transaksi->patient_id)}}"
            <?php } ?>
            target="_blank">Lihat Data Selengkapnya</a>
        </p>
        <br><br>
        <table>
            <tr>
                <td style="width: 30%; vertical-align: top"><h6 class="my-0"> Nama </h6></td>
                <td style="width: 2%; vertical-align: top"> &nbsp&nbsp:&nbsp&nbsp</td>
                <td> <h6 class="my-0">{{$transaksi->pasien->name}}</h6></td>
                <td style="width: 4%"></td>
            </tr>
            <tr>
                <td style="width: 30%; vertical-align: top"><h6 class="my-0"> No. RM </h6></td>
                <td style="width: 2%; vertical-align: top"> &nbsp&nbsp:&nbsp&nbsp</td>
                <td> <h6 class="my-0">{{$transaksi->pasien->no_rm}}</h6></td>
                <td style="width: 4%"></td>
            </tr>
            <tr>
                <td style="vertical-align: top"> JK, Usia</td>
                <td style="vertical-align: top"> &nbsp&nbsp:&nbsp&nbsp </td>
                <td style="vertical-align: top"> <?php if($transaksi->pasien->gender == 1) {echo "Laki-laki";}
                else {echo "Perempuan";}?>, {{$transaksi->pasien->age}} tahun<br></td>
                <td style="vertical-align: top"></td>
            </tr>
            <tr>
                <td style="vertical-align: top"> Alamat</td>
                <td style="vertical-align: top"> &nbsp&nbsp:&nbsp&nbsp </td>
                <td style="vertical-align: top"> {{$transaksi->pasien->address}}</td>
                <td style="vertical-align: top"></td>
            </tr>
            <tr>
                <td style="vertical-align: top"> Tanggal Lahir</td>
                <td style="vertical-align: top"> &nbsp&nbsp:&nbsp&nbsp </td>
                <td style="vertical-align: top"> {{date("j F, Y", strtotime($transaksi->pasien->date_of_birth))}}</td>
                <td style="vertical-align: top"></td>
            </tr>
            <tr>
                <td style="vertical-align: top"> Jenis Pasien</td>
                <td style="vertical-align: top"> &nbsp&nbsp:&nbsp&nbsp </td>
                <td style="vertical-align: top"> {{$transaksi->pembayaran['perusahaan']['tipe']['nama']}}</td>
                <td style="vertical-align: top"></td>
            </tr>
            <tr>
                <td style="vertical-align: top"> Nomor Asuransi</td>
                <td style="vertical-align: top"> &nbsp&nbsp:&nbsp&nbsp </td>
                <td style="vertical-align: top"> {{$transaksi->pembayaran['no_asuransi']}}</td>
                <td style="vertical-align: top"></td>
            </tr>
            <tr>
                <td style="vertical-align: top"> Lokasi Pasien</td>
                <td style="vertical-align: top"> &nbsp&nbsp:&nbsp&nbsp </td>
                <td style="vertical-align: top"> {{$transaksi->asal['nama'] ?? '-'}}</td>
                <td style="vertical-align: top"></td>
            </tr>
            <tr>
                <td style="vertical-align: top"> Kelas Pasien</td>
                <td style="vertical-align: top"> &nbsp&nbsp:&nbsp&nbsp </td>
                <td style="vertical-align: top"> {{$transaksi->kelas->nama}}</td>
                <td style="vertical-align: top"></td>
            </tr>
            <tr>
                <td style="vertical-align: top"> Jenis Layanan</td>
                <td style="vertical-align: top"> &nbsp&nbsp:&nbsp&nbsp </td>
                <td style="vertical-align: top"> {{$transaksi->tipe()}}</td>
                <td style="vertical-align: top"></td>
            </tr>
            <tr>
                <td style="vertical-align: top"> Sisa Plafon SEP</td>
                <td style="vertical-align: top"> &nbsp&nbsp:&nbsp&nbsp </td>
                @if(isset($transaksi->kasus->active_sep->sisa_plafon))
                <td style="vertical-align: top"> Rp 
                    @php $sisa_plafon = $transaksi->kasus->active_sep->sisa_plafon ?? 0 @endphp
                    {{number_format($sisa_plafon,0)}}
                </td>
                @elseif(isset($transaksi->sepOrigin->sisa_plafon))
                <td style="vertical-align: top"> Rp 
                    @php $sisa_plafon = $transaksi->sepOrigin->sisa_plafon ?? 0 @endphp
                    {{number_format($sisa_plafon,0)}}
                </td>
                @elseif (!is_null($transaksi->kasus) && is_null($transaksi->kasus->active_sep))
                <td style="vertical-align: top">-</td>
                @else
                <td style="vertical-align: top">-</span></td>
                @endif
            </tr>
            <tr>
                <td style="vertical-align: top"> Tujuan Tagihan</td>
                <td style="vertical-align: top"> &nbsp&nbsp:&nbsp&nbsp </td>
                <td style="vertical-align: top"> {{$transaksi->kirim_kasir ? 'Kasir' : 'Kasus'}}</td>
                <td style="vertical-align: top"></td>
            </tr>
        </table>
    </div>
</div>