      
      var item = $identifikasi_potensi_psikologi[$(this).data("index")];
      var kesimpulan = item.hasil ? nl2br(item.hasil) : "-";
      var tujuan_pemeriksaan = item.tujuan_pemeriksaan ? item.tujuan_pemeriksaan : "-";
      var rujukan = item.rujukan ? item.rujukan : "-";
      var tanggal_pemeriksaan = item.tanggal_pemeriksaan ? formatDate(item.tanggal_pemeriksaan) : "-";
      var dokter = item.dokter_pemeriksa ? item.dokter_pemeriksa.name : "-";
      
      var hasil = `@include("kasus.psikologi.identifikasi-potensi-psikologi.hasil")`;