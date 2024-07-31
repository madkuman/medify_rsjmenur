@if(str_contains($jenis, 'gawat'))
  @include('kasus.datamedis.content.asesmenawal.non-jiwa.print.print-dokter-gawat-darurat-non-jiwa')
@elseif(str_contains($jenis, 'jalan'))
  @include('kasus.datamedis.content.asesmenawal.non-jiwa.print.print-dokter-rawat-jalan-non-jiwa')
@elseif(str_contains($jenis, 'inap'))
  @include('kasus.datamedis.content.asesmenawal.non-jiwa.print.print-dokter-rawat-inap-non-jiwa')
@else
  Tidak ditemukan asesmen
@endif