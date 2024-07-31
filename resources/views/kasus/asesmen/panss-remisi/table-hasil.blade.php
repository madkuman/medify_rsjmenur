<div class="col-md-12">
	<table class="table table-sm table-striped table-vcenter" style="width: 100%">
		<thead style="text">
			<tr>
				<th class="text-center">Positive and Negative Syndromes Scale</th>
				{{-- <th class="text-center">Tgl Pemeriksaan</th> --}}
				<th class="text-center">Score</th>
			</tr>
		</thead>
		<tbody>
			<tr>
            <td>P I  : WAHAM</td>
            {{-- <td>Masuk: {{ is_null($res->p1_masuk) ? '-' : date('d-m-Y', strtotime($res->p1_masuk)) }}, Keluar: {{ is_null($res->p1_keluar) ? '-' : date('d-m-Y', strtotime($res->p1_keluar)) }}</td> --}}
            <td>{{ $res->p1_score }}</td>
         </tr>
			<tr>
            <td>P 2 : KEKACAUAN PROSES BERFIKIR(CONSEPTUALORGANIZATION)</td>
            {{-- <td>Masuk: {{ is_null($res->p2_masuk) ? '-' : date('d-m-Y', strtotime($res->p2_masuk)) }}, Keluar: {{ is_null($res->p2_keluar) ? '-' : date('d-m-Y', strtotime($res->p2_keluar)) }}</td> --}}
            <td>{{ $res->p2_score }}</td>
         </tr>
			<tr>
            <td>P 3 : PERILAKU HALUSINASI</td>
            {{-- <td>Masuk: {{ is_null($res->p3_masuk) ? '-' : date('d-m-Y', strtotime($res->p3_masuk)) }}, Keluar: {{ is_null($res->p3_keluar) ? '-' : date('d-m-Y', strtotime($res->p3_keluar)) }}</td> --}}
            <td>{{ $res->p3_score }}</td>
         </tr>
			<tr>
            <td>N I : AFEK TUMPUL</td>
            {{-- <td>Masuk: {{ is_null($res->n1_masuk) ? '-' : date('d-m-Y', strtotime($res->n1_masuk)) }}, Keluar: {{ is_null($res->n1_keluar) ? '-' : date('d-m-Y', strtotime($res->n1_keluar)) }}</td> --}}
            <td>{{ $res->n1_score }}</td>
         </tr>
			<tr>
            <td>N 4 : PENARIKAN DIRI DARI HUBUNGAN SOSIAL SECARA PASIF/APATIS</td>
            {{-- <td>Masuk: {{ is_null($res->n4_masuk) ? '-' : date('d-m-Y', strtotime($res->n4_masuk)) }}, Keluar: {{ is_null($res->n4_keluar) ? '-' : date('d-m-Y', strtotime($res->n4_keluar)) }}</td> --}}
            <td>{{ $res->n4_score }}</td>
         </tr>
			<tr>
            <td>N 6 : KURANGNYA SPONTANITAS DAN ARUS PERCAKAPAN</td>
            {{-- <td>Masuk: {{ is_null($res->n6_masuk) ? '-' : date('d-m-Y', strtotime($res->n6_masuk)) }}, Keluar: {{ is_null($res->n6_keluar) ? '-' : date('d-m-Y', strtotime($res->n6_keluar)) }}</td> --}}
            <td>{{ $res->n6_score }}</td>
         </tr>
			<tr>
            <td>G 5 : MEKANISME DAN SIKAP TUBUH</td>
            {{-- <td>Masuk: {{ is_null($res->g5_masuk) ? '-' : date('d-m-Y', strtotime($res->g5_masuk)) }}, Keluar: {{ is_null($res->g5_keluar) ? '-' : date('d-m-Y', strtotime($res->g5_keluar)) }}</td> --}}
            <td>{{ $res->g5_score }}</td>
         </tr>
			<tr>
            <td>G 9 : ISI PIKIRAN YANG TIDAK  BIASA</td>
            {{-- <td>Masuk: {{ is_null($res->g9_masuk) ? '-' : date('d-m-Y', strtotime($res->g9_masuk)) }}, Keluar: {{ is_null($res->g9_keluar) ? '-' : date('d-m-Y', strtotime($res->g9_keluar)) }}</td> --}}
            <td>{{ $res->g9_score }}</td>
         </tr>


         <!-- total score -->
         <tr>
            <td><b>TOTAL SCORE</b></td>
            @php
               $total_score = $res->p1_score + $res->p2_score + $res->p3_score + $res->n1_score + $res->n4_score + $res->n6_score + $res->g5_score + $res->g9_score;
            @endphp
            {{-- <td>&nbsp;</td> --}}
            <td>{{ $total_score }}</td>
         </tr>

         <!-- persen peningkatan score -->
         {{-- <tr>
            <td><b>PERSEN PENINGKATAN SCORE</b></td>
            <td colspan="2"></td>
         </tr> --}}

		</tbody>
	</table>
</div>
<div class="col-md-6">
</div>