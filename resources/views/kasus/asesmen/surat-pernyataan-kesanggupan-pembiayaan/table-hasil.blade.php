<div class="col-md-12">
	<table class="table table-sm table-striped table-vcenter" style="width: 100%">
     
      <tbody style="text-align: left">

         <tr>
            <td colspan="3"><b>Penangung Jawab</b></td>
         </tr>         
         <tr>
            <td width="10%">Nama</td>
            <td width="5%">:</td>
            <td width="70%">{{ $res->nama_penanda }}</td>
         </tr>
         <tr>
            <td width="10%">Alamat</td>
            <td width="5%">:</td>
            <td width="70%">{{ $res->alamat_penanda }}</td>
         </tr>
         <tr>
            <td width="10%">Telp</td>
            <td width="5%">:</td>
            <td width="70%">{{ $res->telp_penanda }}</td>
         </tr>
         <tr>
            <td width="10%">Hubungan</td>
            <td width="5%">:</td>
            <td width="70%">{{ $res->hubungan_dengan_pasien }}</td>
         </tr>         
         <tr>
            <td width="10%">Petugas Ruangan</td>
            <td width="5%">:</td>
            @php
               $user = \App\User::find($res->perawat_ruangan);
            @endphp
            <td width="70%">{{ $user->name }}</td>
         </tr>         
      </tbody>
   </table>
</div>