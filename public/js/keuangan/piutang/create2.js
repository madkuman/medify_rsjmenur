//--------------------------------------------------------------------------------------------------------------------INITIATE SELECT2
$(document).ready(function() {
	$.ajax({
		type: "GET",
		url: API_URL + "/kasir/tagihan/getLokasi",
		dataType: "json",
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		success: function (data) {
			var option = [];
			option.push({
				id: '',
				text: '',
			});
			console.log(data)
			// alert(data[0].tipe.name);
			for (i in data) {
				option.push({
					id: data[i].id,
					text: data[i].nama,
				});
			}
			$('#lokasi').select2({
				data: option
			})
		}
	});
});

$("#kategori").select2();

$("#pasien").select2({
	ajax: {
		url: API_URL+"/pasien/get",
		dataType: 'json',
		delay: 250,
		data: function (params) 
		{
			return {
				keyword: params.term,
				page: params.page
			};
		},
		processResults: function (data, params) {
			params.page = params.page || 1;
			return {
				results: data.data,
			};
		},
		cache: true
	},
	escapeMarkup: function (markup) { return markup; },
	minimumInputLength: 3,
	placeholder: "Cari Pasien",
	templateResult: formatPasien,
	templateSelection: formatPasienSelection
});

//FORMAT DISPLAY
function formatPasien (item) {
	if (item.loading) {
		return item.text;
	}

	var markup = item.name

	return markup;
}

//FORMAT UNTUK DI SHOW DI HTML
function formatPasienSelection (item) {
	return item.name || item.text;
}

$('#pasien').on('select2:select', function (e) {
	var data = e.params.data;
	// alert(data.id)
	$.ajax({
		type: "POST",
		url: API_URL + "/kasir/tagihan/getPasienPembayaran",
		dataType: "json",
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		data: {
			id : data.id
		},
		success: function (data) {
			var option = [];
			option.push({
				id: '',
				text: '',
			});
			console.log(data)
			// alert(data[0].tipe.name);
			for (i in data) {
				option.push({
					id: data[i].id,
					text: data[i].perusahaan.nama,
					perusahaan_keuangan_id : data[i].perusahaan.perusahaan_keuangan_id,
					perusahaan_keuangan_nama : data[i].perusahaan.perusahaan_keuangan.nama,
				});
			}
			$("#pasien-pembayaran option").remove();
			$('#pasien-pembayaran').select2({
				data: option
			})
		}
	});
})

$('#pasien-pembayaran').select2();

$('#pasien-pembayaran').on('select2:select', function (e) {
	var data = e.params.data;
	document.getElementById("perusahaan").value = data.perusahaan_keuangan_id;
	document.getElementById("pihak3").value = data.perusahaan_keuangan_nama;
})

$('#btnOpen').click(function(){
	$('#tambahTransaksi').modal('show');
	emptyInput();
});


//--------------------------------------------------------------------------------------------------------------------MODAL TAMBAH
$('#tambahTransaksi .js-autocomplete').autoComplete({
	minChars: 3,
	source: function(term, suggest){
		term = term.toLowerCase();

		$.ajax({
			url: API_URL+"/keuangan/layanan?keyword="+term,
			type: 'GET',
			dataType: 'json',
			success: function(response) {
				data = response
				suggest(data);
			},
			error: function() {
				alert('error');
			},
		});
	},
	renderItem: function (item, search){
		var value = item['tarif_kategori']['name']+' '+ item['deskripsi'];
		return '<div class="autocomplete-suggestion" data-dept="'+item['departemen_id']+'" data-id="'+item['id']+'" data-val="'+value+'">'+ value +'</div>';
	},
	onSelect: function(event, term, item) {
		element = $('#tambahTransaksi .tipe');
		last_deskripsi = item.data('val');
		$('#tambahTransaksi .tarif_id').val(item.data('id'));
		$('#tambahTransaksi .departemen_id').val(item.data('dept'));
		updateTarifAttribute(element,item.data('id'))
	}
});

function updateTarifAttribute(element, id, default_value = 0){
	$.ajax({
		type: "POST",
		url: API_URL + "/keuangan/tarif/getalldetail",
		dataType: "json",
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		data: {
			id : id
		},
		success: function (data) {
			var option = [];
			option.push({
				id: '',
				text: 'Pilih Tipe',
			});
			for (i in data) {
				option.push({
					id: data[i].tarif_tipe_id,
					text: data[i].tipe.name,
					tarif_id: data[i].tarif_id,
				});
			}
			element.html('').select2({data: option});
			if(default_value != 0) $('#tambahTransaksi .tipe').select2().val(default_value).trigger('change')
		}
});
}

function updateKelasOptions(tarif_id,tipe_id, kelas, default_value = 0)
{
	$.ajax({
		type: "POST",
		url: API_URL + "/keuangan/tarif/getdetail",
		dataType: "json",
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		data: {
			id : tarif_id,
			tipe : tipe_id
		},
		success: function (data) {
			var option2 = [];
			option2.push({
				id: '',
				text: 'Pilih Kelas',
			});
			if(data.biasa != null && data.biasa > 0){
				option2.push({
					id:data.biasa,
					tarif: data.biasa,
					text: 'Biasa',
					tipe_id: data.tarif_tipe_id
				});
			};
			if(data.urj != null && data.urj > 0){
				option2.push({
					id:data.urj,
					tarif: data.urj,
					text: 'URJ',
					tipe_id: data.tarif_tipe_id
				});
			};
			if(data.igd != null && data.igd > 0){
				option2.push({
					id:data.igd,
					tarif: data.igd,
					text: 'IGD',
					tipe_id: data.tarif_tipe_id
				});
			};
			if(data.vvip != null && data.vvip > 0){
				option2.push({
					id:data.vvip,
					tarif: data.vvip,
					text: 'VVIP',
					tipe_id: data.tarif_tipe_id
				});
			};
			if(data.vip_a != null && data.vip_a > 0){
				option2.push({
					id:data.vip_a,
					tarif: data.vip_a,
					text: 'VIP A',
					tipe_id: data.tarif_tipe_id
				});
			};
			if(data.vip_paviliun != null && data.vip_paviliun > 0){
				option2.push({
					id:data.vip_paviliun,
					tarif: data.vip_paviliun,
					text: 'VIP Paviliun',
					tipe_id: data.tarif_tipe_id
				});
			};
			if(data.i_paviliun != null &&data.i_paviliun > 0){
				option2.push({
					id:data.i_paviliun,
					tarif: data.i_paviliun,
					text: 'I Paviliun',
					tipe_id: data.tarif_tipe_id
				});
			};
			if(data.vip_ruangan != null && data.vip_ruangan > 0){
				option2.push({
					id:data.vip_ruangan,
					tarif: data.vip_ruangan,
					text: 'VIP Ruangan',
					tipe_id: data.tarif_tipe_id
				});
			};
			if(data.i_a != null && data.i_a > 0){
				option2.push({
					id:data.i_a,
					tarif: data.i_a,
					text: 'I A',
					tipe_id: data.tarif_tipe_id
				});
			};
			if(data.i_b != null && data.i_b > 0){
				option2.push({
					id:data.i_b,
					tarif: data.i_b,
					text: 'I B',
					tipe_id: data.tarif_tipe_id
				});
			};
			if(data.ii != null && data.ii > 0){
				option2.push({
					id:data.ii,
					tarif: data.ii,
					text: 'II',
					tipe_id: data.tarif_tipe_id
				});
			};
			if(data.iii_ac != null && data.iii_ac > 0){
				option2.push({
					id:data.iii_ac,
					tarif: data.iii_ac,
					text: 'III AC',
					tipe_id: data.tarif_tipe_id
				});
			};
			if(data.iii_non_ac != null && data.iii_non_ac > 0){
				option2.push({
					id:data.iii_non_ac,
					tarif: data.iii_non_ac,
					text: 'III Non AC',
					tipe_id: data.tarif_tipe_id
				});
			};
			
			if(default_value != 0) {
				// alert(default_value);
				result = option2.findIndex(function(object) {
					return object.text == default_value;
				});
				option2[result].selected = true;
				// alert(result);
				// $('#tambahTransaksi .kelas').select2().val(default_value).trigger('change')
			}
			kelas.html('').select2({data: option2});
			
		}
});
}

$('.tipe').on('select2:select', function (e) {
	var data = e.params.data;

	var kelas = $(this).closest('.tarif_container').find('.kelas_id');
	var tarif_id = $(this).closest('.tarif_container').find('.tarif_id').val();
	kelas.html('')
	
	updateKelasOptions(tarif_id,data.id,kelas)
});

$('.kelas_id').on('select2:select', function (e) {
	var data = e.params.data;

	var kelas_id = $(this).closest('.tarif_container').find('.kelas_id');
	var kelas = $(this).closest('.tarif_container').find('.kelas');
	var harga = $(this).closest('.tarif_container').parent().find('.harga_satuan');
	var jumlah = $(this).closest('.tarif_container').parent().find('.jumlah');
	var diskon = $(this).closest('.tarif_container').parent().find('.diskon');

	kelas.val(data.text);
	kelas_id.val(data.id);
	harga.val(data.tarif);
	jumlah.val(1);
	diskon.val(0);
	updateSubtotal(data.tarif,1,0);
});

var last_deskripsi = ''

$(".deskripsi").change(function() {
	// alert(last_deskripsi);
	if(last_deskripsi != $(this).val()){
		$('#tambahTransaksi .tarif_id').val('');
		$('#tambahTransaksi .departemen_id').val(null);	
	}
});

$( ".harga_satuan" ).change(function() {
	harga_satuan = $(this).val();
	console.log(harga_satuan);
	updateSubtotal(harga_satuan,'-','-');
});

$( ".jumlah" ).change(function() {
	jumlah = $(this).val();
	updateSubtotal('-',jumlah,'-');
});

$( ".diskon" ).change(function() {
	diskon = $(this).val();
	updateSubtotal('-','-',diskon);
});

$('#tambahTransaksi .submitBtn').click(function(){
	data = validateInput();
	console.log(data);
	if(data != 0){ 
		if(data.id == '')
		{
			backboneAddTransaksiDetail(data);
			emptyInput()
			$('#tambahTransaksi').modal('hide');
		}
		else
		{
			backboneUpdateTransaksi(data);
			emptyInput()
			$('#tambahTransaksi').modal('hide');
		}
	}
});

function updateSubtotal(harga_satuan,jumlah,diskon)
{
	console.log(harga_satuan)

	if(harga_satuan == '-' || harga_satuan == null) harga_satuan = $('#tambahTransaksi .harga_satuan').val();
	if(jumlah == '-') jumlah = $('#tambahTransaksi .jumlah').val();
	if(diskon == '-') diskon = $('#tambahTransaksi .diskon').val();

	console.log(harga_satuan)

	harga_satuan = Number(harga_satuan)
	jumlah = parseInt(jumlah)
	diskon = parseInt(diskon)
	divider = (100-diskon);

	console.log(harga_satuan)
	console.log(jumlah)
	console.log(diskon)
	console.log(divider)

	if(diskon >= 100)
		subtotal = 0;
	else
		subtotal = harga_satuan * jumlah / divider * 100;

	$('#tambahTransaksi .subtotal').val(subtotal);
}

function emptyInput()
{
	deskripsi = $('#tambahTransaksi .deskripsi').val('');
	kategori = $('#tambahTransaksi .kategori').val(null).trigger('change');
	tarif_id= $('#tambahTransaksi .tarif_id').val(null);
	departemen_id= $('#tambahTransaksi .departemen_id').val(null);
	tarif_tipe = $('#tambahTransaksi .tipe').html('');
	tarif_kelas_id = $('#tambahTransaksi .kelas_id').html('');
	tarif_kelas = $('#tambahTransaksi .kelas').val(null);
	jumlah = $('#tambahTransaksi .jumlah').val('');
	harga = $('#tambahTransaksi .harga_satuan').val('');
	diskon = $('#tambahTransaksi .diskon').val('');
	subtotal = $('#tambahTransaksi .subtotal').val('');
	keterangan = $('#tambahTransaksi .keterangan').html('');
	id = $('#tambahTransaksi .id').val('');
}

function validateInput()
{
	deskripsi = $('#tambahTransaksi .deskripsi').val();
	kategori = $('#tambahTransaksi .kategori').val();
	tarif_id= $('#tambahTransaksi .tarif_id').val();
	tarif_tipe = $('#tambahTransaksi .tipe').val();
	tarif_kelas_id = $('#tambahTransaksi .kelas_id').val();
	tarif_kelas = $('#tambahTransaksi .kelas').val();
	jumlah = $('#tambahTransaksi .jumlah').val();
	harga = $('#tambahTransaksi .harga_satuan').val();
	diskon = $('#tambahTransaksi .diskon').val();
	subtotal = $('#tambahTransaksi .subtotal').val();
	keterangan = $('#tambahTransaksi .keterangan').val();
	departemen_id = $('#tambahTransaksi .departemen_id').val();
	id = $('#tambahTransaksi .id').val();
	error =0;

	if(deskripsi == '') {$('#tambahTransaksi .deskripsi-error').show();error=1;} else $('#tambahTransaksi .deskripsi-error').hide(); 
	if(kategori == null) {$('#tambahTransaksi .kategori-error').show();error=1;} else $('#tambahTransaksi .kategori-error').hide(); 
	if(tarif_tipe == 0) {$('#tambahTransaksi .tarif-tipe-error').show();error=1;} else $('#tambahTransaksi .tarif-tipe-error').hide(); 
	if(tarif_kelas_id == 0) {$('#tambahTransaksi .tarif-kelas-error').show();error=1;} else $('#tambahTransaksi .tarif-kelas-error').hide(); 
	if(jumlah == '' || jumlah == 0) {$('#tambahTransaksi .jumlah-error').show();error=1;} else $('#tambahTransaksi .jumlah-error').hide(); 
	if(harga == '' || harga == 0) {$('#tambahTransaksi .harga-error').show();error=1;} else $('#tambahTransaksi .harga-error').hide(); 
	if(diskon == '') {$('#tambahTransaksi .diskon-error').show();error=1;} else $('#tambahTransaksi .diskon-error').hide(); 
	if(error == 1) return 0;

	var data = {
		deskripsi: deskripsi,
		kategori: kategori,
		tarif_id: tarif_id,
		tarif_tipe: tarif_tipe,
		tarif_kelas_id: tarif_kelas_id,
		tarif_kelas: tarif_kelas,
		jumlah: jumlah,
		harga: harga,
		diskon: diskon,
		subtotal: subtotal,
		keterangan: keterangan,
		departemen_id: departemen_id,
		id:id,
	}

	return data;
}

function showEditModal(data)
{
	deskripsi = $('#tambahTransaksi .deskripsi').val(data.get('layanan_string'));
	kategori = $('#tambahTransaksi .kategori').val(data.get('kategori')).trigger('change');
	jumlah = $('#tambahTransaksi .jumlah').val(data.get('jumlah'));
	harga = $('#tambahTransaksi .harga_satuan').val(data.get('harga'));
	diskon = $('#tambahTransaksi .diskon').val(data.get('diskon'));
	subtotal = $('#tambahTransaksi .subtotal').val(data.get('subtotal'));
	keterangan = $('#tambahTransaksi .keterangan').html(data.get('keterangan'));
	id = $('#tambahTransaksi .id').val(data.id);
    tarif_tipe = $('#tambahTransaksi .tipe').html('');
    tarif_kelas_id = $('#tambahTransaksi .kelas_id').html('');
	if(data.get('layanan_id') != 0)
	{
		var element = $('#tambahTransaksi .tipe')
		var kelas = $('#tambahTransaksi .kelas_id')
		var id = data.get('layanan_id')
		updateTarifAttribute(element,id,data.get('tipe'))
		updateKelasOptions(data.get('layanan_id'),data.get('tipe'),kelas,data.get('kelas'))
    }
	tarif_id= $('#tambahTransaksi .tarif_id').val(data.get('layanan_id'));
	last_deskripsi = data.get('layanan_string')

	$('#tambahTransaksi').modal('show');
}
//--------------------------------------------------------------------------------------------------------------------GLOBAL TOTAL

var globalJumlah = 0;
var globalDiskon = 0;
var globalTotal = 0;

function updateAllTotal()
{
	var subtotals = transaksiCollection.pluck("subtotal");
	var jumlahs = transaksiCollection.pluck("jumlah");
	var hargas = transaksiCollection.pluck("harga");
	var diskons = transaksiCollection.pluck("diskon");

	var allJumlah = 0;
	var allDiskon = 0;
	var allTotal = 0;

	$.each(subtotals, function( index, value ) {
		allJumlah+= hargas[index]*jumlahs[index]
		allDiskon+= hargas[index]*jumlahs[index]*diskons[index]/100
	});

	allTotal = allJumlah-allDiskon;

	globalTotal = allTotal;
	globalDiskon = allDiskon;
	globalJumlah = allJumlah;

	var allJumlahFormat = numeral(allJumlah).format('0,0');
	var allDiskonFormat = numeral(allDiskon).format('0,0');
	var allTotalFormat = numeral(allTotal).format('0,0');


	$('#allJumlah').html('Rp '+allJumlahFormat)
	$('#allDiskon').html('Rp '+allDiskonFormat)
	$('#allTotal').html('Rp '+allTotalFormat)
}

//--------------------------------------------------------------------------------------------------------------------BACKBONE

var TransaksiDetail = Backbone.Model.extend({
	defaults: {
		layanan_string: "",
		kategori: "",
		layanan_id: null,
		tipe: "",
		kelas_id: "",
		kelas: "",
		jumlah: "",
		harga: "",
		diskon: "",
		subtotal: "",
		keterangan: "",
		created_at: null,
		updated_at: null,
		tagihan_id: null,
		departemen_id: null,
	},
	idAttribute: "id"
});

var Transaksi = Backbone.Collection.extend({
	model: TransaksiDetail,
	sort_key: 'id'
});

var transaksiCollection = new Transaksi();
var recordCount = 0;

function backboneAddTransaksiDetail(data)
{

	if(transaksiCollection.length > 0)
	{
		var transaksidetail = transaksiCollection.findWhere({id: data.id});
		if(typeof transaksidetail !== "undefined") 
			transaksiCollection.remove(transaksidetail);
	}

	recordCount++;

	var detail = new TransaksiDetail({ 
		id:recordCount,
		layanan_string: data.deskripsi,
		kategori: data.kategori,
		layanan_id: data.tarif_id,
		tipe: data.tarif_tipe,
		kelas: data.tarif_kelas,
		kelas_id: data.tarif_kelas_id,
		jumlah: data.jumlah,
		harga: data.harga,
		diskon: data.diskon,
		subtotal: data.subtotal,
		keterangan: data.keterangan,
		departemen_id: data.departemen_id,
		created_by: user
	});

	transaksiCollection.add(detail);
	addRowHTML(data);
	var id = '#transaksi-'+recordCount;
	updateAllTotal()

}


function backboneUpdateTransaksi(data)
{
	id = parseInt(data.id);
	var transaksidetail = transaksiCollection.findWhere({id: id});
	if(typeof transaksidetail !== "undefined") var exist = 1;
	else var exist = 0; 
	if(exist)
	{
		transaksidetail.set({
			id: id,
			layanan_string: data.deskripsi,
			kategori: data.kategori,
			layanan_id: data.tarif_id,
			tipe: data.tarif_tipe,
			kelas: data.tarif_kelas,
			kelas_id: data.tarif_kelas_id,
			jumlah: data.jumlah,
			harga: data.harga,
			diskon: data.diskon,
			subtotal: data.subtotal,
			keterangan: data.keterangan,
			departemen_id: data.departemen_id,
		});
	}
	updateRowHTML(data);
	updateAllTotal();
}

function updateRowHTML(data)
{
	$("#deskripsi-"+data.id).html(data.deskripsi);
	$("#keterangan-"+data.id).html(data.keterangan);
	$("#jumlah-"+data.id).html(data.jumlah);
	$("#harga-"+data.id).html(data.harga);
	$("#diskon-"+data.id).html(data.diskon);
	$("#subtotal-"+data.id).html(data.subtotal);
}

//--------------------------------------------------------------------------------------------------------------------HTML

function addRowHTML(data)
{
	$('#emptyTable').hide()
	$('.main-table tbody').append(`
		<tr id="transaksi-`+recordCount+`" data-id="`+recordCount+`">
		<td class="text-center" style="width: 5%;">`+recordCount+`</td>
		<td id="deskripsi-`+recordCount+`" style="width: 19%;">`+data.deskripsi+`</td>
		<td id="keterangan-`+recordCount+`" style="width: 10%;">`+data.keterangan+`</td>
		<td id="jumlah-`+recordCount+`" class="text-center" style="width: 9%;">`+data.jumlah+`</td>
		<td id="harga-`+recordCount+`" class="text-right" style="width: 12%;">`+data.harga+`</td>
		<td id="diskon-`+recordCount+`" class="text-center" style="width: 9%;">`+data.diskon+`</td>
		<td id="subtotal-`+recordCount+`" class="text-right" style="width: 18%;">`+data.subtotal+`</td>
		<td class="text-right" style="width: 7%;">
		<button class="btn btn-circle btn-outline-danger btn-sm btnDelete"><i class="fa fa-trash"></i></button>
		<button class="btn btn-circle btn-outline-info btn-sm btnEdit"><i class="fa fa-pencil"></i></button>
		</td>
		</tr>
		`)
}

$(document).on('click','.btnEdit',function(){
	id = $(this).parent().parent().data("id");
	data = transaksiCollection.get(id);
	showEditModal(data);
});

$(document).on('click','.btnDelete',function(){
	id = $(this).parent().parent().data("id");
	var transaksidetail = transaksiCollection.findWhere({id: id});
	swal({
        title: 'Apakah anda yakin hapus?',
        text: '',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
        preConfirm: function() {
            return new Promise(function(resolve) {
				transaksiCollection.remove(transaksidetail);
				deleteRow(id);
				if(transaksiCollection.length <= 0){
					$('#emptyTable').show();
				}
				updateAllTotal();
				dismiss;
            });
          }
        })
});

function deleteRow(rowid)  
{   
    var row = document.getElementById("transaksi-"+rowid);
    row.parentNode.removeChild(row);
}


//--------------------------------------------------------------------------------------------------------------------FINAL
$('#buttonSubmit').click(function() {
	var pasien_id = $('#pasien').val();
	var pihak_3 = $('#pihak3').val();
	var tanggal = $('#tanggaltransaksi').val();
	var judul = $('#judul').val();
	var kategori = $('#kategori').val();
	var pasien_pembayaran_id = $('#pasien-pembayaran').val();
	var lokasi_id = $("#lokasi").val();
	var perusahaan_id = $('#perusahaan').val();
		
	if(tanggal == '')
		callSwal('warning','Transaksi Gagal','Tanggal Tidak Boleh Kosong',0);
	else if(transaksiCollection.length < 1)
		callSwal('warning','Transaksi Gagal','Transaksi Tidak Boleh Kosong',0);
	else if(kategori == '')
		callSwal('warning','Transaksi Gagal','Kategori Tidak Boleh Kosong',0);
	else if(judul == '')
		callSwal('warning','Transaksi Gagal','Judul Tidak Boleh Kosong',0);
	else if(pihak_3 == '')
		callSwal('warning','Transaksi Gagal','Pihak ke 3 Tidak Boleh Kosong',0);
	else{
		var transaksiCollectionJSON = JSON.stringify(transaksiCollection);
		
		$('#buttonSubmit').hide();
		$('#buttonLoading').show();

		console.log(transaksiCollection);
		console.log(transaksiCollectionJSON);
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		
		$.ajax({
			type: "POST",
			url: API_URL + "/keuangan/piutang/baru",
			dataType: "json",
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			data: {
				id : null,
				judul: judul,
				pasien_id : pasien_id,
				pihak_3 : pihak_3,
				tanggal : tanggal,
				kategori : kategori,
				pasien_pembayaran_id : pasien_pembayaran_id,
				lokasi_id : lokasi_id,
				perusahaan_id : perusahaan_id,
				transaksi: transaksiCollectionJSON,
				alltotal : globalTotal,
				alldiskon : globalDiskon,
                alljumlah : globalJumlah,
                created_at : null,
                updated_at : null,
                kasus_tagihan_id : null,
			},

			success: function (data) {
				callSwal(data.type,data.title,data.text,data.url);
				$('#buttonSubmit').show();
				$('#buttonLoading').hide();
				//$('#buttonLoading').fadeOut();

			},
			error: function () {
				callSwal('error','Transaksi Gagal','Silahkan Coba Lagi',0);
				$('#buttonSubmit').show();
				$('#buttonLoading').hide();
			}
		});
	}
});