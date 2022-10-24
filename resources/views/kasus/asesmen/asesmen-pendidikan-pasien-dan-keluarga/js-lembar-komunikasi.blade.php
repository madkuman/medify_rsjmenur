$(`:hidden[name="asesmen_id"]`).val(item.id);
$(`.blank-form`).val("");

for(lembar of item.lembar){
var tanggal_edukasi= '-';
if(lembar.tanggal_edukasi){
var tgl = lembar.tanggal_edukasi.split(" ");
var tgl_format = tgl[0].split("-");
tanggal_edukasi = tgl_format[2]+'-'+tgl_format[1]+'-'+tgl_format[0];
}
	$(`#tableGrafik`).append(`
		<tr class="refreshRow">
		<td>${tanggal_edukasi}</td>
		<td>${lembar.jam_edukasi}</td>
		<td>${lembar.durasi_edukasi}</td>
		<td>${lembar.kebutuhan_materi_edukasi_informasi}</td>
		<td>${lembar.metode}</td>
		<td>${lembar.nama_edukator_pemberi_informasi}</td>
		<td>${lembar.verifikasi_verfikasi}</td>
		<td>${lembar.nama_penerima_informasi}</td>
		<td>${lembar.hubungan_terhadap_pasien}</td>
		<td class="text-center"><button class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5 deleteGrafikBtn" data-id="${lembar.id}">
				<i class="fa fa-trash"></i>
			</button>
		</td>
		</tr>
		`);
}