      
      var item = $bakat_minat_dewasa[$this.data("index")];
      var tanggal_pemeriksaan = item.tanggal_pemeriksaan ? formatDate(item.tanggal_pemeriksaan) : "-";
      var tujuan_tes = item.tujuan_tes ? item.tujuan_tes : "-";
      
      var intelegensi_umum = item.intelegensi_umum ? item.intelegensi_umum : "-";
      var daya_nalar = item.daya_nalar ? item.daya_nalar : "-";
      var daya_analisa_sintesa = item.daya_analisa_sintesa ? item.daya_analisa_sintesa : "-";
      var fleksibilitas_berpikir = item.fleksibilitas_berpikir ? item.fleksibilitas_berpikir : "-";
      var daya_ingat = item.daya_ingat ? item.daya_ingat : "-";
      var kecepatan_kerja = item.kecepatan_kerja ? item.kecepatan_kerja : "-";
      var ketelitian = item.ketelitian ? item.ketelitian : "-";
      var daya_tahan_kerja = item.daya_tahan_kerja ? item.daya_tahan_kerja : "-";
      var stabilitas_emosi = item.stabilitas_emosi ? item.stabilitas_emosi : "-";
      var penyesuaian_diri = item.penyesuaian_diri ? item.penyesuaian_diri : "-";
      var motivasi_dorongan_ambisi = item.motivasi_dorongan_ambisi ? item.motivasi_dorongan_ambisi : "-";
      var kerja_sama = item.kerja_sama ? item.kerja_sama : "-";
      var kemampuan_verbal = item.kemampuan_verbal ? item.kemampuan_verbal : "-";
      var kemampuan_numerik = item.kemampuan_numerik ? item.kemampuan_numerik : "-";

      var minat = item.minat ? JSON.parse(item.minat) : "-";
      var kesimpulan = item.kesimpulan ? nl2br(item.kesimpulan) : "-";

      var hasil = `@include("kasus.psikologi.bakat-minat-dewasa.hasil")`;