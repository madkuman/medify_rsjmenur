<table>
    <thead>
        <tr>
            <td rowspan="2">Tanggal</td>
            <td rowspan="2">Pasien Awal</td>
            <td colspan="2">PASIEN MASUK</td>
            <td rowspan="2">PX. Pindahan</td>
            <td rowspan="2">JUMLAH (2+3+4)</td>
            <td colspan="6">PASIEN KELUAR HIDUP</td>
            <td colspan="2">PASIEN MATI</td>
            <td rowspan="2">JUMLAH 6 s/d 13</td>
            <td colspan="2">Lama Dirawat</td>
            <td rowspan="2">px. MRS/KRS hr sama</td>
            <td rowspan="2">Pasien Masih Dirawat</td>
            <td colspan="6">rincian admin pasien yang ada</td>
            <td colspan="7">rincian admin pasien yang ada</td>
        </tr>
        <tr>
            <td>POLI</td>
            <td>IGD</td>
            <td>pindah ruang</td>
            <td>SS</td>
            <td>Pulang Paksa</td>
            <td>Pindah RS Lain</td>
            <td>DROP</td>
            <td>Lari</td>
            <td>{{'< 48 Jam'}}</td>
            <td>{{'> 48 Jam'}}</td>
            <td>JUMLAH (6)</td>
            <td>JUMLAH 7 s/d 13</td>
            <td>Umum</td>
            <td>non-PBI</td>
            <td>PBI</td>
            <td>SKM</td>
            <td>JKD</td>
            <td>Sehati</td>
            <td>VIP A</td>
            <td>VIP B</td>
            <td>VIP C</td>
            <td>VIP D</td>
            <td>KELAS I</td>
            <td>KELAS II</td>
            <td>KELAS III</td>
        </tr>
        <tr>
            <td>1</td>
            <td>2</td>
            <td colspan="2">3</td>
            <td>4</td>
            <td>5</td>
            <td>6</td>
            <td>7</td>
            <td>8</td>
            <td>9</td>
            <td>10</td>
            <td>11</td>
            <td>12</td>
            <td>13</td>
            <td>14</td>
            <td colspan="2">15</td>
            <td>16</td>
            <td>17</td>
            <td>18</td>
            <td>19</td>
            <td>20</td>
            <td>21</td>
            <td>22</td>
            <td>23</td>
            <td>24</td>
            <td>25</td>
            <td>26</td>
            <td>27</td>
            <td>28</td>
            <td>29</td>
            <td>30</td>
        </tr>
    </thead>
    <tbody>
        @php
            $total_1 = 0;
            $total_2 = 0;
            $total_3 = 0;
            $total_4 = 0;
            $total_5 = 0;
            $total_6 = 0;
            $total_7 = 0;
            $total_8 = 0;
            $total_9 = 0;
            $total_10 = 0;
            $total_11 = 0;
            $total_12 = 0;
            $total_13 = 0;
            $total_14 = 0;
            $total_15 = 0;
            $total_16 = 0;
            $total_17 = 0;
            $total_18 = 0;
            $total_19 = 0;
            $total_20 = 0;
            $total_21 = 0;
            $total_22 = 0;
            $total_23 = 0;
            $total_24 = 0;
            $total_25 = 0;
            $total_26 = 0;
            $total_27 = 0;
            $total_28 = 0;
            $total_29 = 0;
            $total_30 = 0;
        @endphp
        @foreach ($period as $date)
            @php
                $tanggal = $date->format('Y-m-d');
                $total_1 += $data_laporan[$tanggal]["jumlah_awal"];
                $total_2 += $data_laporan[$tanggal]["jumlah_poli"];
                $total_3 += $data_laporan[$tanggal]["jumlah_igd"];
                $total_4 += $data_laporan[$tanggal]["jumlah_pindahan"];
                $total_5 += $data_laporan[$tanggal]["total_1"];
                $total_6 += $data_laporan[$tanggal]["jumlah_ss"];
                $total_7 += $data_laporan[$tanggal]["jumlah_pulang_paksa"];
                $total_8 += $data_laporan[$tanggal]["jumlah_pindah_rs"];
                $total_9 += $data_laporan[$tanggal]["jumlah_drop"];
                $total_10 += $data_laporan[$tanggal]["jumlah_lari"];
                $total_11 += $data_laporan[$tanggal]["jumlah_mati_kurang_48"];
                $total_12 += $data_laporan[$tanggal]["jumlah_mati_lebih_48"];
                $total_13 += $data_laporan[$tanggal]["total_2"];
                $total_14 += $data_laporan[$tanggal]["jumlah_ss"];
                $total_15 += $data_laporan[$tanggal]["total_3"];
                $total_16 += $data_laporan[$tanggal]["jumlah_mrs_sama_krs"];
                $total_17 += $data_laporan[$tanggal]["jumlah_masih_dirawat"];
                $total_18 += $data_laporan[$tanggal]["jumlah_umum"];
                $total_19 += $data_laporan[$tanggal]["jumlah_non_pbi"];
                $total_20 += $data_laporan[$tanggal]["jumlah_PBI"];
                $total_21 += $data_laporan[$tanggal]["jumlah_skm"];
                $total_22 += $data_laporan[$tanggal]["jumlah_jkd"];
                $total_23 += $data_laporan[$tanggal]["jumlah_sehati"];
                $total_24 += $data_laporan[$tanggal]["jumlah_vip_a"];
                $total_25 += $data_laporan[$tanggal]["jumlah_vip_b"];
                $total_26 += $data_laporan[$tanggal]["jumlah_vip_c"];
                $total_27 += $data_laporan[$tanggal]["jumlah_vip_d"];
                $total_28 += $data_laporan[$tanggal]["jumlah_kelas_1"];
                $total_29 += $data_laporan[$tanggal]["jumlah_kelas_2"];
                $total_30 += $data_laporan[$tanggal]["jumlah_kelas_3"];
            @endphp
            
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$data_laporan[$tanggal]["jumlah_awal"]}}</td>
                <td>{{$data_laporan[$tanggal]["jumlah_poli"]}}</td>
                <td>{{$data_laporan[$tanggal]["jumlah_igd"]}}</td>
                <td>{{$data_laporan[$tanggal]["jumlah_pindahan"]}}</td>
                <td>{{$data_laporan[$tanggal]["total_1"]}}</td>
                <td>{{$data_laporan[$tanggal]["jumlah_pindahan"]}}</td>
                <td>{{$data_laporan[$tanggal]["jumlah_ss"]}}</td>
                <td>{{$data_laporan[$tanggal]["jumlah_pulang_paksa"]}}</td>
                <td>{{$data_laporan[$tanggal]["jumlah_pindah_rs"]}}</td>
                <td>{{$data_laporan[$tanggal]["jumlah_drop"]}}</td>
                <td>{{$data_laporan[$tanggal]["jumlah_lari"]}}</td>
                <td>{{$data_laporan[$tanggal]["jumlah_mati_kurang_48"]}}</td>
                <td>{{$data_laporan[$tanggal]["jumlah_mati_lebih_48"]}}</td>
                <td>{{$data_laporan[$tanggal]["total_2"]}}</td>
                <td>{{$data_laporan[$tanggal]["jumlah_ss"]}}</td>
                <td>{{$data_laporan[$tanggal]["total_3"]}}</td>
                <td>{{$data_laporan[$tanggal]["jumlah_mrs_sama_krs"]}}</td>
                <td>{{$data_laporan[$tanggal]["jumlah_masih_dirawat"]}}</td>
                <td>{{$data_laporan[$tanggal]["jumlah_umum"]}}</td>
                <td>{{$data_laporan[$tanggal]["jumlah_non_pbi"]}}</td>
                <td>{{$data_laporan[$tanggal]["jumlah_PBI"]}}</td>
                <td>{{$data_laporan[$tanggal]["jumlah_skm"]}}</td>
                <td>{{$data_laporan[$tanggal]["jumlah_jkd"]}}</td>
                <td>{{$data_laporan[$tanggal]["jumlah_sehati"]}}</td>
                <td>{{$data_laporan[$tanggal]["jumlah_vip_a"]}}</td>
                <td>{{$data_laporan[$tanggal]["jumlah_vip_b"]}}</td>
                <td>{{$data_laporan[$tanggal]["jumlah_vip_c"]}}</td>
                <td>{{$data_laporan[$tanggal]["jumlah_vip_d"]}}</td>
                <td>{{$data_laporan[$tanggal]["jumlah_kelas_1"]}}</td>
                <td>{{$data_laporan[$tanggal]["jumlah_kelas_2"]}}</td>
                <td>{{$data_laporan[$tanggal]["jumlah_kelas_3"]}}</td>
            </tr>
            
        @endforeach

        <tr>
            <td colspan="2">JUMLAH</td>
            <td>{{$total_2}}</td>
            <td>{{$total_3}}</td>
            <td>{{$total_4}}</td>
            <td>{{$total_5}}</td>
            <td>{{$total_4}}</td>
            <td>{{$total_6}}</td>
            <td>{{$total_7}}</td>
            <td>{{$total_8}}</td>
            <td>{{$total_9}}</td>
            <td>{{$total_10}}</td>
            <td>{{$total_11}}</td>
            <td>{{$total_12}}</td>
            <td>{{$total_13}}</td>
            <td>{{$total_14}}</td>
            <td>{{$total_15}}</td>
            <td>{{$total_16}}</td>
            <td>{{$total_17}}</td>
            <td>{{$total_18}}</td>
            <td>{{$total_19}}</td>
            <td>{{$total_20}}</td>
            <td>{{$total_21}}</td>
            <td>{{$total_22}}</td>
            <td>{{$total_23}}</td>
            <td>{{$total_24}}</td>
            <td>{{$total_25}}</td>
            <td>{{$total_26}}</td>
            <td>{{$total_27}}</td>
            <td>{{$total_28}}</td>
            <td>{{$total_29}}</td>
            <td>{{$total_30}}</td>
        </tr>
    </tbody>
</table>