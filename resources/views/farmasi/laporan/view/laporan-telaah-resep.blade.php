<table>
    <thead>
        <tr>
            <td></td>
        </tr>
        <tr>
            <th colspan="20">LAPORAN TELAAH RESEP</th>
        </tr>
        <tr>
            <th colspan="20">Periode : {{indonesian_date($date_start,'d F Y')}} - {{indonesian_date($date_end,'d F Y')}}</th>
        </tr>
        <tr>
            <td></td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th rowspan="2">NO</th>
            <th rowspan="2">ITEM</th>
            <th colspan="2">IGD</th>
            <th colspan="2">RAWAT JALAN</th>
            <th colspan="2">RAWAT INAP</th>
            <th colspan="3">TOTAL</th>
            <th></th>
            <th colspan="2">IGD</th>
            <th colspan="2">RAWAT JALAN</th>
            <th colspan="2">RAWAT INAP</th>
            <th colspan="2">TOTAL</th>
        </tr>
        <tr>
        	@for($i=0;$i<4;$i++)
        	<td>Tepat</td>
        	<td>Tidak Tepat</td>
        	@endfor
            <td>Semua</td>
            <td></td>
            @for($i=0;$i<4;$i++)
            <td>Tepat</td>
            <td>Tidak Tepat</td>
            @endfor
        </tr>
        <tr><td colspan="11">SYARAT ADMINISTRASI</td></tr>
        @php $row = 8 @endphp
        <tr>
        	<td>1</td>
        	<td>SEP</td>
            <td>{{$data['igd']->total_analisa_resep_sep}}</td>
            <td>{{$data['igd']->total - $data['igd']->total_analisa_resep_sep}}</td>
            <td>{{$data['rawat_jalan']->total_analisa_resep_sep}}</td>
            <td>{{$data['rawat_jalan']->total - $data['rawat_jalan']->total_analisa_resep_sep}}</td>
            <td>{{$data['rawat_inap']->total_analisa_resep_sep}}</td>
            <td>{{$data['rawat_inap']->total - $data['rawat_inap']->total_analisa_resep_sep}}</td>
            <td>=C{{$row}}+E{{$row}}+G{{$row}}</td>
            <td>=D{{$row}}+F{{$row}}+H{{$row}}</td>
            <td>=I{{$row}}+J{{$row}}</td>
            @include('farmasi.laporan.view.components.laporan-telaah-resep-percentage')
        </tr>
        @php $row++ @endphp
        <tr>
            <td>2</td>
            <td>Fotokopi Kartu</td>
            <td>{{$data['igd']->total_analisa_resep_fotokopi_kartu}}</td>
            <td>{{$data['igd']->total - $data['igd']->total_analisa_resep_fotokopi_kartu}}</td>
            <td>{{$data['rawat_jalan']->total_analisa_resep_fotokopi_kartu}}</td>
            <td>{{$data['rawat_jalan']->total - $data['rawat_jalan']->total_analisa_resep_fotokopi_kartu}}</td>
            <td>{{$data['rawat_inap']->total_analisa_resep_fotokopi_kartu}}</td>
            <td>{{$data['rawat_inap']->total - $data['rawat_inap']->total_analisa_resep_fotokopi_kartu}}</td>
            <td>=C{{$row}}+E{{$row}}+G{{$row}}</td>
            <td>=D{{$row}}+F{{$row}}+H{{$row}}</td>
            <td>=I{{$row}}+J{{$row}}</td>
            @include('farmasi.laporan.view.components.laporan-telaah-resep-percentage')
        </tr>
        @php $row++ @endphp
        <tr>
            <td>3</td>
            <td>Identitas Pasien (Nama, Domisili, Tgl Lahir)</td>
            <td>{{$data['igd']->total_analisa_resep_identitas_pasien}}</td>
            <td>{{$data['igd']->total - $data['igd']->total_analisa_resep_identitas_pasien}}</td>
            <td>{{$data['rawat_jalan']->total_analisa_resep_identitas_pasien}}</td>
            <td>{{$data['rawat_jalan']->total - $data['rawat_jalan']->total_analisa_resep_identitas_pasien}}</td>
            <td>{{$data['rawat_inap']->total_analisa_resep_identitas_pasien}}</td>
            <td>{{$data['rawat_inap']->total - $data['rawat_inap']->total_analisa_resep_identitas_pasien}}</td>
            <td>=C{{$row}}+E{{$row}}+G{{$row}}</td>
            <td>=D{{$row}}+F{{$row}}+H{{$row}}</td>
            <td>=I{{$row}}+J{{$row}}</td>
            @include('farmasi.laporan.view.components.laporan-telaah-resep-percentage')
        </tr>
        @php $row++ @endphp
        <tr>
            <td>4</td>
            <td>Paraf Dokter</td>
            <td>{{$data['igd']->total_analisa_resep_paraf_dokter}}</td>
            <td>{{$data['igd']->total - $data['igd']->total_analisa_resep_paraf_dokter}}</td>
            <td>{{$data['rawat_jalan']->total_analisa_resep_paraf_dokter}}</td>
            <td>{{$data['rawat_jalan']->total - $data['rawat_jalan']->total_analisa_resep_paraf_dokter}}</td>
            <td>{{$data['rawat_inap']->total_analisa_resep_paraf_dokter}}</td>
            <td>{{$data['rawat_inap']->total - $data['rawat_inap']->total_analisa_resep_paraf_dokter}}</td>
            <td>=C{{$row}}+E{{$row}}+G{{$row}}</td>
            <td>=D{{$row}}+F{{$row}}+H{{$row}}</td>
            <td>=I{{$row}}+J{{$row}}</td>
            @include('farmasi.laporan.view.components.laporan-telaah-resep-percentage')
        </tr>
        @php $row++ @endphp
        <tr><td colspan="11">ASPEK FARMASETIK</td></tr>
        @php $row++ @endphp
        <tr>
            <td>5</td>
            <td>Nama, Bentuk, Kekuatan</td>
            <td>{{$data['igd']->total_analisa_resep_nama_obat}}</td>
            <td>{{$data['igd']->total - $data['igd']->total_analisa_resep_nama_obat}}</td>
            <td>{{$data['rawat_jalan']->total_analisa_resep_nama_obat}}</td>
            <td>{{$data['rawat_jalan']->total - $data['rawat_jalan']->total_analisa_resep_nama_obat}}</td>
            <td>{{$data['rawat_inap']->total_analisa_resep_nama_obat}}</td>
            <td>{{$data['rawat_inap']->total - $data['rawat_inap']->total_analisa_resep_nama_obat}}</td>
            <td>=C{{$row}}+E{{$row}}+G{{$row}}</td>
            <td>=D{{$row}}+F{{$row}}+H{{$row}}</td>
            <td>=I{{$row}}+J{{$row}}</td>
            @include('farmasi.laporan.view.components.laporan-telaah-resep-percentage')
        </tr>
        @php $row++ @endphp
        <tr>
            <td>6</td>
            <td>Jumlah Obat</td>
            <td>{{$data['igd']->total_analisa_resep_jumlah_obat}}</td>
            <td>{{$data['igd']->total - $data['igd']->total_analisa_resep_jumlah_obat}}</td>
            <td>{{$data['rawat_jalan']->total_analisa_resep_jumlah_obat}}</td>
            <td>{{$data['rawat_jalan']->total - $data['rawat_jalan']->total_analisa_resep_jumlah_obat}}</td>
            <td>{{$data['rawat_inap']->total_analisa_resep_jumlah_obat}}</td>
            <td>{{$data['rawat_inap']->total - $data['rawat_inap']->total_analisa_resep_jumlah_obat}}</td>
            <td>=C{{$row}}+E{{$row}}+G{{$row}}</td>
            <td>=D{{$row}}+F{{$row}}+H{{$row}}</td>
            <td>=I{{$row}}+J{{$row}}</td>
            @include('farmasi.laporan.view.components.laporan-telaah-resep-percentage')
        </tr>
        @php $row++ @endphp
        <tr>
            <td>7</td>
            <td>Signa / Aturan Pakai</td>
            <td>{{$data['igd']->total_analisa_resep_signa_obat}}</td>
            <td>{{$data['igd']->total - $data['igd']->total_analisa_resep_signa_obat}}</td>
            <td>{{$data['rawat_jalan']->total_analisa_resep_signa_obat}}</td>
            <td>{{$data['rawat_jalan']->total - $data['rawat_jalan']->total_analisa_resep_signa_obat}}</td>
            <td>{{$data['rawat_inap']->total_analisa_resep_signa_obat}}</td>
            <td>{{$data['rawat_inap']->total - $data['rawat_inap']->total_analisa_resep_signa_obat}}</td>
            <td>=C{{$row}}+E{{$row}}+G{{$row}}</td>
            <td>=D{{$row}}+F{{$row}}+H{{$row}}</td>
            <td>=I{{$row}}+J{{$row}}</td>
            @include('farmasi.laporan.view.components.laporan-telaah-resep-percentage')
        </tr>
        @php $row++ @endphp
        <tr><td colspan="11">ASPEK KLINIS</td></tr>
        @php $row++ @endphp
        <tr>
            <td>8</td>
            <td>Tepat Indikasi</td>
            <td>{{$data['igd']->total_analisa_resep_tepat_indikasi}}</td>
            <td>{{$data['igd']->total - $data['igd']->total_analisa_resep_tepat_indikasi}}</td>
            <td>{{$data['rawat_jalan']->total_analisa_resep_tepat_indikasi}}</td>
            <td>{{$data['rawat_jalan']->total - $data['rawat_jalan']->total_analisa_resep_tepat_indikasi}}</td>
            <td>{{$data['rawat_inap']->total_analisa_resep_tepat_indikasi}}</td>
            <td>{{$data['rawat_inap']->total - $data['rawat_inap']->total_analisa_resep_tepat_indikasi}}</td>
            <td>=C{{$row}}+E{{$row}}+G{{$row}}</td>
            <td>=D{{$row}}+F{{$row}}+H{{$row}}</td>
            <td>=I{{$row}}+J{{$row}}</td>
            @include('farmasi.laporan.view.components.laporan-telaah-resep-percentage')
        </tr>
        @php $row++ @endphp
        <tr>
            <td>9</td>
            <td>Tepat Dosis</td>
            <td>{{$data['igd']->total_analisa_resep_tepat_dosis}}</td>
            <td>{{$data['igd']->total - $data['igd']->total_analisa_resep_tepat_dosis}}</td>
            <td>{{$data['rawat_jalan']->total_analisa_resep_tepat_dosis}}</td>
            <td>{{$data['rawat_jalan']->total - $data['rawat_jalan']->total_analisa_resep_tepat_dosis}}</td>
            <td>{{$data['rawat_inap']->total_analisa_resep_tepat_dosis}}</td>
            <td>{{$data['rawat_inap']->total - $data['rawat_inap']->total_analisa_resep_tepat_dosis}}</td>
            <td>=C{{$row}}+E{{$row}}+G{{$row}}</td>
            <td>=D{{$row}}+F{{$row}}+H{{$row}}</td>
            <td>=I{{$row}}+J{{$row}}</td>
            @include('farmasi.laporan.view.components.laporan-telaah-resep-percentage')
        </tr>
        @php $row++ @endphp
        <tr>
            <td>10</td>
            <td>Tepat Rute</td>
            <td>{{$data['igd']->total_analisa_resep_tepat_rute}}</td>
            <td>{{$data['igd']->total - $data['igd']->total_analisa_resep_tepat_rute}}</td>
            <td>{{$data['rawat_jalan']->total_analisa_resep_tepat_rute}}</td>
            <td>{{$data['rawat_jalan']->total - $data['rawat_jalan']->total_analisa_resep_tepat_rute}}</td>
            <td>{{$data['rawat_inap']->total_analisa_resep_tepat_rute}}</td>
            <td>{{$data['rawat_inap']->total - $data['rawat_inap']->total_analisa_resep_tepat_rute}}</td>
            <td>=C{{$row}}+E{{$row}}+G{{$row}}</td>
            <td>=D{{$row}}+F{{$row}}+H{{$row}}</td>
            <td>=I{{$row}}+J{{$row}}</td>
            @include('farmasi.laporan.view.components.laporan-telaah-resep-percentage')
        </tr>
        @php $row++ @endphp
        <tr>
            <td>11</td>
            <td>Tepat Waktu</td>
            <td>{{$data['igd']->total_analisa_resep_tepat_waktu}}</td>
            <td>{{$data['igd']->total - $data['igd']->total_analisa_resep_tepat_waktu}}</td>
            <td>{{$data['rawat_jalan']->total_analisa_resep_tepat_waktu}}</td>
            <td>{{$data['rawat_jalan']->total - $data['rawat_jalan']->total_analisa_resep_tepat_waktu}}</td>
            <td>{{$data['rawat_inap']->total_analisa_resep_tepat_waktu}}</td>
            <td>{{$data['rawat_inap']->total - $data['rawat_inap']->total_analisa_resep_tepat_waktu}}</td>
            <td>=C{{$row}}+E{{$row}}+G{{$row}}</td>
            <td>=D{{$row}}+F{{$row}}+H{{$row}}</td>
            <td>=I{{$row}}+J{{$row}}</td>
            @include('farmasi.laporan.view.components.laporan-telaah-resep-percentage')
        </tr>
        @php $row++ @endphp
        <tr>
            <td>12</td>
            <td>Tidak Duplikasi Terapi</td>
            <td>{{$data['igd']->total_analisa_resep_duplikasi_terapi}}</td>
            <td>{{$data['igd']->total - $data['igd']->total_analisa_resep_duplikasi_terapi}}</td>
            <td>{{$data['rawat_jalan']->total_analisa_resep_duplikasi_terapi}}</td>
            <td>{{$data['rawat_jalan']->total - $data['rawat_jalan']->total_analisa_resep_duplikasi_terapi}}</td>
            <td>{{$data['rawat_inap']->total_analisa_resep_duplikasi_terapi}}</td>
            <td>{{$data['rawat_inap']->total - $data['rawat_inap']->total_analisa_resep_duplikasi_terapi}}</td>
            <td>=C{{$row}}+E{{$row}}+G{{$row}}</td>
            <td>=D{{$row}}+F{{$row}}+H{{$row}}</td>
            <td>=I{{$row}}+J{{$row}}</td>
            @include('farmasi.laporan.view.components.laporan-telaah-resep-percentage')
        </tr>
        @php $row++ @endphp
        <tr>
            <td>13</td>
            <td> Tidak Ada Alergi Obat dan ROTD</td>
            <td>{{$data['igd']->total_analisa_resep_alergi_obat}}</td>
            <td>{{$data['igd']->total - $data['igd']->total_analisa_resep_alergi_obat}}</td>
            <td>{{$data['rawat_jalan']->total_analisa_resep_alergi_obat}}</td>
            <td>{{$data['rawat_jalan']->total - $data['rawat_jalan']->total_analisa_resep_alergi_obat}}</td>
            <td>{{$data['rawat_inap']->total_analisa_resep_alergi_obat}}</td>
            <td>{{$data['rawat_inap']->total - $data['rawat_inap']->total_analisa_resep_alergi_obat}}</td>
            <td>=C{{$row}}+E{{$row}}+G{{$row}}</td>
            <td>=D{{$row}}+F{{$row}}+H{{$row}}</td>
            <td>=I{{$row}}+J{{$row}}</td>
            @include('farmasi.laporan.view.components.laporan-telaah-resep-percentage')
        </tr>
        @php $row++ @endphp
        <tr>
            <td>14</td>
            <td> Tidak Ada Interaksi Obat</td>
            <td>{{$data['igd']->total_analisa_resep_interaksi_obat}}</td>
            <td>{{$data['igd']->total - $data['igd']->total_analisa_resep_interaksi_obat}}</td>
            <td>{{$data['rawat_jalan']->total_analisa_resep_interaksi_obat}}</td>
            <td>{{$data['rawat_jalan']->total - $data['rawat_jalan']->total_analisa_resep_interaksi_obat}}</td>
            <td>{{$data['rawat_inap']->total_analisa_resep_interaksi_obat}}</td>
            <td>{{$data['rawat_inap']->total - $data['rawat_inap']->total_analisa_resep_interaksi_obat}}</td>
            <td>=C{{$row}}+E{{$row}}+G{{$row}}</td>
            <td>=D{{$row}}+F{{$row}}+H{{$row}}</td>
            <td>=I{{$row}}+J{{$row}}</td>
            @include('farmasi.laporan.view.components.laporan-telaah-resep-percentage')
        </tr>
        @php $row++ @endphp
        <tr>
            <td>15</td>
            <td>Tidak Ada Kontra Indikasi</td>
            <td>{{$data['igd']->total_analisa_resep_kontra_indikasi}}</td>
            <td>{{$data['igd']->total - $data['igd']->total_analisa_resep_kontra_indikasi}}</td>
            <td>{{$data['rawat_jalan']->total_analisa_resep_kontra_indikasi}}</td>
            <td>{{$data['rawat_jalan']->total - $data['rawat_jalan']->total_analisa_resep_kontra_indikasi}}</td>
            <td>{{$data['rawat_inap']->total_analisa_resep_kontra_indikasi}}</td>
            <td>{{$data['rawat_inap']->total - $data['rawat_inap']->total_analisa_resep_kontra_indikasi}}</td>
            <td>=C{{$row}}+E{{$row}}+G{{$row}}</td>
            <td>=D{{$row}}+F{{$row}}+H{{$row}}</td>
            <td>=I{{$row}}+J{{$row}}</td>
            @include('farmasi.laporan.view.components.laporan-telaah-resep-percentage')
        </tr>
        @php $row++ @endphp
    </tbody>
</table>
