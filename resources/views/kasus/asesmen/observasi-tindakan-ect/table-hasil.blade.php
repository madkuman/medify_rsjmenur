<div class="col-md-12">
	<table class="table table-sm table-striped table-vcenter" style="width: 100%">
     
      <tbody style="text-align: left">

         <tr>
            <td colspan="3"><b>PERSIAPAN ICT</b></td>
         </tr>
         <tr>
            <td width="10%">Tanggal</td>
            <td width="5%">:</td>
            <td width="70%">{{ is_null($res->tgl_persiapan_ect) ? '-' : date('d-m-Y', strtotime($res->tgl_persiapan_ect)) }}</td>
         </tr>
         <tr>
            <td width="10%">Jam</td>
            <td width="5%">:</td>
            <td width="70%">{{ $res->jam_persiapan_ect }}</td>
         </tr>
         <tr>
            <td width="10%">T</td>
            <td width="5%">:</td>
            <td width="70%">{{ $res->t_persiapan_ect }}</td>
         </tr>
         <tr>
            <td width="10%">N</td>
            <td width="5%">:</td>
            <td width="70%">{{ $res->n_persiapan_ect }}</td>
         </tr>
         <tr>
            <td width="10%">S</td>
            <td width="5%">:</td>
            <td width="70%">{{ $res->s_persiapan_ect }}</td>
         </tr>
         <tr>
            <td width="10%">RR</td>
            <td width="5%">:</td>
            <td width="70%">{{ $res->rr_persiapan_ect }}</td>
         </tr>
         <tr>
            <td width="10%">Puasa</td>
            <td width="5%">:</td>
            <td width="70%">{{ $res->puasa_persiapan_ect }}</td>
         </tr>
         <tr>
            <td width="10%">Petugas Ruangan</td>
            <td width="5%">:</td>
            @php
               $user = \App\User::find($res->ptg_ru_persiapan_ect);
            @endphp
            <td width="70%">{{ $user->name }}</td>
         </tr>
         <tr>
            <td width="10%">Petugas ECT</td>
            <td width="5%">:</td>
            @php
               $user = \App\User::find($res->ptg_ect_persiapan_ect);
            @endphp
            <td width="70%">{{ $user->name }}</td>
         </tr>
         

         <tr>
            <td colspan="3"><b>PELAKSANAAN ICT</b></td>
         </tr>
         <tr>
            <td width="10%">T</td>
            <td width="5%">:</td>
            <td width="70%">{{ $res->t_pelaksanaan_ect }}</td>
         </tr>
         <tr>
            <td width="10%">N</td>
            <td width="5%">:</td>
            <td width="70%">{{ $res->n_pelaksanaan_ect }}</td>
         </tr>
         <tr>
            <td width="10%">S</td>
            <td width="5%">:</td>
            <td width="70%">{{ $res->s_pelaksanaan_ect }}</td>
         </tr>
         <tr>
            <td width="10%">RR</td>
            <td width="5%">:</td>
            <td width="70%">{{ $res->rr_pelaksanaan_ect }}</td>
         </tr>
         <tr>
            <td width="10%">Jam ECT</td>
            <td width="5%">:</td>
            <td width="70%">{{ $res->jam_pelaksanaan_ect }}</td>
         </tr>
         <tr>
            <td width="10%">Dosis</td>
            <td width="5%">:</td>
            <td width="70%">{{ $res->dosis_pelaksanaan_ect }}</td>
         </tr>
         <tr>
            <td width="10%">Dr.</td>
            <td width="5%">:</td>
            @php
               $dokter = \App\User::find($res->dr_pelaksanaan_ect);
            @endphp
            <td width="70%">{{ $dokter->name ?? '-' }}</td>
         </tr>
         <tr>
            <td width="10%">Perawat</td>
            <td width="5%">:</td>
            @php
               $perawat = \App\User::find($res->pwt_pelaksanaan_ect);
            @endphp
            <td width="70%">{{ $perawat->name ?? '-' }}</td>
         </tr>
         <tr>
            <td width="10%">Jam</td>
            <td width="5%">:</td>
            <td width="70%">{{ $res->jam2_pelaksanaan_ect }}</td>
         </tr>
         <tr>
            <td width="10%">Kesadaran</td>
            <td width="5%">:</td>
            <td width="70%">{{ $res->kesadaran_pelaksanaan_ect }}</td>
         </tr>


         <tr>
            <td colspan="3"><b>POST ICT</b></td>
         </tr>
         <tr>
            <td width="10%">T</td>
            <td width="5%">:</td>
            <td width="70%">{{ $res->t_post_ect }}</td>
         </tr>
         <tr>
            <td width="10%">N</td>
            <td width="5%">:</td>
            <td width="70%">{{ $res->n_post_ect }}</td>
         </tr>
         <tr>
            <td width="10%">S</td>
            <td width="5%">:</td>
            <td width="70%">{{ $res->s_post_ect }}</td>
         </tr>
         <tr>
            <td width="10%">RR</td>
            <td width="5%">:</td>
            <td width="70%">{{ $res->rr_post_ect }}</td>
         </tr>
         <tr>
            <td width="10%">Ket</td>
            <td width="5%">:</td>
            <td width="70%">{{ $res->ket_post_ect }}</td>
         </tr>


         <tr>
            <td colspan="3"><b>SERAH TERIMA</b></td>
         </tr>
         <tr>
            <td width="10%">Jam</td>
            <td width="5%">:</td>
            <td width="70%">{{ $res->jam_serah_ect }}</td>
         </tr>
         <tr>
            <td width="10%">Petugas ECT</td>
            <td width="5%">:</td>
            @php
               $user = \App\User::find($res->ptg_ect_serah_ect);
            @endphp
            <td width="70%">{{ $user->name ?? '-' }}</td>
         </tr>
         <tr>
            <td width="10%">Petugas Ruangan</td>
            <td width="5%">:</td>
            @php
               $user = \App\User::find($res->ptg_ruangan_serah_ect);
            @endphp
            <td width="70%">{{ $user->name ?? '-' }}</td>
         </tr>



      </tbody>
   </table>
</div>