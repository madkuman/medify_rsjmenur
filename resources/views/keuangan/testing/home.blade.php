<table class="table" style="border: 1px; border-color: black;">
  <thead>
    <tr>
      <th scope="col" rowspan="2">No</th>
      <th scope="col" rowspan="2">Kategori</th>
      <th scope="col" rowspan="2">Deskripsi</th>
      <th colspan="8">Biasa</th>
      <th colspan="8">Cito</th>
    </tr>
    <tr>
      <th scope="col">Kelas VVIP</th>
      <th scope="col">Kelas VIP A</th>
      <th scope="col">Kelas VIP B</th>
      <th scope="col">Kelas 1 Utama</th>
      <th scope="col">Kelas 1A</th>
      <th scope="col">Kelas 1B</th>
      <th scope="col">Kelas 2</th>
      <th scope="col">Kelas 3</th>
      <th scope="col">Kelas VVIP</th>
      <th scope="col">Kelas VIP A</th>
      <th scope="col">Kelas VIP B</th>
      <th scope="col">Kelas 1 Utama</th>
      <th scope="col">Kelas 1A</th>
      <th scope="col">Kelas 1B</th>
      <th scope="col">Kelas 2</th>
      <th scope="col">Kelas 3</th>
    </tr>
  </thead>
  <tbody>
  	@php $i=0; @endphp
  	@foreach ($master as $data)
  	<tr>
  	<td>{{++$i}}</td>
    <td>{{$data->kategori->nama ?? "-"}}</td>
    <td>{{$data->deskripsi}}</td>
    @php
      $vvip=-1;
      $vipa=-1;
      $vipb=-1;
      $utama=-1;
      $kelas1a=-1;
      $kelas1b=-1;
      $kelas2=-1;
      $kelas3=-1;

      $cito_vvip=-1;
      $cito_vipa=-1;
      $cito_vipb=-1;
      $cito_utama=-1;
      $cito_kelas1a=-1;
      $cito_kelas1b=-1;
      $cito_kelas2=-1;
      $cito_kelas3=-1;
    @endphp
  	@foreach ($data->tarif as $tarif)
  	<!-- <td>{{$tarif->harga}}({{$tarif->kelas_id}})</td> -->
  	@php
    if($tarif->tipe_id == 1){
        if ($tarif->kelas_id==1){
          $vvip=$tarif->harga;
        }
        if ($tarif->kelas_id==6){
          $vipa=$tarif->harga;
        }
        if ($tarif->kelas_id==7){
          $vipb=$tarif->harga;
        }
        if ($tarif->kelas_id==8){
          $utama=$tarif->harga;
        }
        if ($tarif->kelas_id==9){
          $kelas1a=$tarif->harga;
        }
        if ($tarif->kelas_id==10){
          $kelas1b=$tarif->harga;
        }
        if ($tarif->kelas_id==4){
          $kelas2=$tarif->harga;
        }
        if ($tarif->kelas_id==5){
          $kelas3=$tarif->harga;
        }
        if($tarif->kelas_id == 0){
          $vvip=$tarif->harga;
          $vipa=$tarif->harga;
          $vipb=$tarif->harga;
          $utama=$tarif->harga;
          $kelas1a=$tarif->harga;
          $kelas1b=$tarif->harga;
          $kelas2=$tarif->harga;
          $kelas3=$tarif->harga;
        }
      }elseif($tarif->tipe_id == 2){

        if ($tarif->kelas_id==1){
          $cito_vvip=$tarif->harga;
        }
        if ($tarif->kelas_id==6){
          $cito_vipa=$tarif->harga;
        }
        if ($tarif->kelas_id==7){
          $cito_vipb=$tarif->harga;
        }
        if ($tarif->kelas_id==8){
          $cito_utama=$tarif->harga;
        }
        if ($tarif->kelas_id==9){
          $cito_kelas1a=$tarif->harga;
        }
        if ($tarif->kelas_id==10){
          $cito_kelas1b=$tarif->harga;
        }
        if ($tarif->kelas_id==4){
          $cito_kelas2=$tarif->harga;
        }
        if ($tarif->kelas_id==5){
          $cito_kelas3=$tarif->harga;
        }
        if($tarif->kelas_id == 0){
          $cito_vvip=$tarif->harga;
          $cito_vipa=$tarif->harga;
          $cito_vipb=$tarif->harga;
          $cito_utama=$tarif->harga;
          $cito_kelas1a=$tarif->harga;
          $cito_kelas1b=$tarif->harga;
          $cito_kelas2=$tarif->harga;
          $cito_kelas3=$tarif->harga;
        }
      }
  		//dd($tarif);
  	@endphp
  	@endforeach
    <td>{{$vvip != -1 ? $vvip : "-"}}</td>
    <td>{{$vipa != -1 ? $vipa : "-"}}</td>
    <td>{{$vipb != -1 ? $vipb : "-"}}</td>
    <td>{{$utama != -1 ? $utama : "-"}}</td>
    <td>{{$kelas1a != -1  ? $kelas1a : "-"}}</td>
    <td>{{$kelas1b != -1 ?  $kelas1b : "-"}}</td>
    <td>{{$kelas2 != -1  ? $kelas2 : "-"}}</td>
    <td>{{$kelas3 != -1  ? $kelas3 : "-"}}</td>

    <td>{{$cito_vvip != -1 ? $cito_vvip : "-"}}</td>
    <td>{{$cito_vipa != -1 ? $cito_vipa : "-"}}</td>
    <td>{{$cito_vipb != -1 ? $cito_vipb : "-"}}</td>
    <td>{{$cito_utama != -1 ? $cito_utama : "-"}}</td>
    <td>{{$cito_kelas1a != -1  ? $cito_kelas1a : "-"}}</td>
    <td>{{$cito_kelas1b != -1 ?  $cito_kelas1b : "-"}}</td>
    <td>{{$cito_kelas2 != -1  ? $cito_kelas2 : "-"}}</td>
    <td>{{$cito_kelas3 != -1  ? $cito_kelas3 : "-"}}</td>
  	</tr>
  	@endforeach
  </tbody>
</table>