<input type="hidden" name="id" value="" id="id">
	<div class="block-content" style="padding-left: 25px; padding-right: 25px;">
	    {{csrf_field()}}
	    <div class="row">
	    	
			<div class="col-12">
				<h5 class="pt-15">ORIENTASI</h5>
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Sekarang (hari), (tanggal), (bulan), (tahun) berapa dan (musim) apa ?</label>
			    <input type="number" class="form-control" name="hari_tanggal_bulan_tahun_musim" >
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Sekarang kita berada di mana? (jalan), (nomor rumah), (kabupaten), (provinsi),(negara)</label>
			    <input type="number" class="form-control" name="kita_berada_dimana" >
			</div>
			<div class="col-12">
				<h5 class="pt-15">REGISTRASI</h5>
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Pewawancara menyebutkan nama 3 buah benda, 1 detik untuk tiap benda. Kemudian mintalah Lansia mengulang ke 3 nama benda tersebut. Berikan 1 angka untuk tiap jawaban yang benar. Bila masih salah, ulanglah penyebutan ke 3 nama benda tersebut sampai ia dapat mengulangnya dengan benar. Hitunglah jumlah percobaan dan catatlah (bola, kursi, sepatu). </label>
			    <input type="number" class="form-control" name="nama_tiga_buah_benda" >
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Jumlah Percobaan</label>
			    <input type="number" class="form-control" name="jumlah_percobaan" >
			</div>
			<div class="col-12">
				<h5 class="pt-15">ATENSI DAN KALKULASI</h5>
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Hitunglah berturut-turut selang 7 mulai dan 100 ke bawah. Berilah 1 angka untuk tiap jawaban yang benar. Berhenti setelah 5 hitungan (93, 86, 79, 72, 65). Kemungkinan lain, ejalah kata "dunia" dari akhir ke awal (a-i-n-u-d).</label>
			    <input type="number" class="form-control" name="hitung_berturut_turut" >
			</div>
			<div class="col-12">
				<h5 class="pt-15">MENGINGAT KEMBALI <i>(RECALL)</i></h5>
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Tanyalah kembali nama ke 3 benda yang telah disebutkan di atas. Berilah 1 angka untuk tiap jawaban yang benar.</label>
			    <input type="number" class="form-control" name="tanya_nama_benda" >
			</div>
			<div class="col-12">
				<h5 class="pt-15">BAHASA</h5>
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Apakah nama benda-benda ini? Perlihatkan pensil dan arloji. (2 angka)</label>
			    <input type="number" class="form-control" name="nama_benda_benda" >
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Ulanglah kalimat berikut: "Namun, Tanpa, Bila". (1 angka)</label>
			    <input type="number" class="form-control" name="ulangi_kalimat_berikut" >
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Laksanakan 3 buah perintah ini: "Peganglah selembar kertas dengan tangan kananmu, lipatlah kertas itu pada pertengahan dan letakkanlah di lantai". (3 angka)</label>
			    <input type="number" class="form-control" name="laksanakan_perintah" >
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Bacalah dan laksanakan perintah berikut: "PEJAMKAN MATA ANDA".(1 angka)</label>
			    <input type="number" class="form-control" name="bacalah_dan_laksanakan_perintah" >
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Tulislah sebuah kalimat. (1 angka)</label>
			    <input type="number" class="form-control" name="tulis_sebuah_kalimat" >
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Tirulah gambar ini. (1 angka)</label>
			    <input type="number" class="form-control" name="tirulah_gambar" >
			</div>
	    </div>
	</div>