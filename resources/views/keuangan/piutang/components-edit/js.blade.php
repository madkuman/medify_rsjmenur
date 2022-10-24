<script type="text/javascript">
function initTransaksi(){
	$('#emptyTable').hide();
	var pasien_id = $('#pasien').val();
	var pasien_pembayaran_id = $('#pasien-pembayaran').val();
	if (pasien_id != null){
		$.ajax({
			type: "POST",
			url: API_URL + "/kasir/tagihan/getPasienPembayaran",
			dataType: "json",
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			data: {
				id : pasien_id
			},
			success: function (data) {
				var option = [];
				option.push({
					id: '',
					text: '',
				});
				for (i in data) {
					if(data[i].id == pasien_pembayaran_id)
						option.push({
							id: data[i].id,
							text: data[i].perusahaan.nama,
							perusahaan_keuangan_id : data[i].perusahaan.perusahaan_keuangan_id,
							perusahaan_keuangan_nama : data[i].perusahaan.perusahaan_keuangan.nama,
							selected : true
						});
					else
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
	}
	var countdetail = $('#countdetail').val();
	var i;
	var j;
	// alert(countdetail);
	for(i=1;i<=countdetail;i++){
		var detail_id = $('#detail_id'+i).val();
		var tarif_id = $('#tarif_id'+i).val();
		var deskripsi = $('#deskripsi'+i).val();
		var harga = $('#harga'+i).val();
		var kelas_id = $('#kelas_id'+i).val();
		var tarif_tipe_id = $('#tarif_tipe_id'+i).val();
		var jumlah = $('#jumlah'+i).val();
		var diskon = $('#diskon'+i).val();
		var keterangan = $('#keterangan'+i).val();
		var subtotal = $('#subtotal'+i).val();
		var created_by = $('#created_by'+i).val();
		var kategori_id = $('#kategori_id'+i).val();
		var lokasi_id = $('#lokasi_id'+i).val();
		var created_by = $('#created_by'+i).val();
		var creator_name = $('#creator_name'+i).val();
		var data = {
			id_detail:detail_id,
			deskripsi: deskripsi,
			kategori_id: kategori_id,
			lokasi_id: lokasi_id,
			tarif_id: tarif_id,
			kelas_id: kelas_id,
			tarif_tipe_id: tarif_tipe_id,
			jumlah: jumlah,
			harga: harga,
			diskon: diskon,
			subtotal: subtotal,
			keterangan: keterangan,
			id:i,
			created_by:created_by,
			creator_name:creator_name,
		}
		backboneAddTransaksiDetail(data,1);
	}
}

//--------------------------------------------------------------------------------------------------------------------INITIATE SELECT2

$('#lokasi').on('select2:select', function (e) {
	var data = e.params.data;
	kategori_id = $("#lokasi").select2().find(":selected").data("kategori");
	$('#kategori').val(kategori_id).trigger('change');
});

//--------------------------------------------------------------------------------------------------------------------INITIATE SELECT2
$(document).ready(function() {
	$.ajax({
		type: "GET",
		url: API_URL + "/keuangan/akun/get",
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
			// alert(data[0].tipe.name);
			for (i in data) {
				option.push({
					id: data[i].id,
					text: data[i].no_rekening+' - '+data[i].nama,
				});
			}
			$('#akun').select2({
				data: option
			})
		}
	});
});


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
	$('#pasien_pembayaran_loading').show();
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
			$('#pasien_pembayaran_loading').hide();
		}
	});
})

$('#pasien-pembayaran').select2();

$('#pasien-pembayaran').on('select2:select', function (e) {
	var data = e.params.data;
	var perusahaan = data.perusahaan_keuangan_id;
	$('#perusahaan').val(perusahaan).trigger('change');
	var pembayaran = $('#pasien-pembayaran').select2('data')

	if($('#pasien').val() == null || pembayaran[0].text != 'Tunai')
		document.getElementById("pihak3").value = data.perusahaan_keuangan_nama;
	else{
		var pasien = $('#pasien').select2('data')
		if(pasien[0].text != '')
			pasien_nama = pasien[0].text
		else
			pasien_nama = pasien[0].name
		document.getElementById("pihak3").value = pasien_nama;
	}

})

$('#btnOpen').click(function(){
	$('#tambahTransaksi').modal('show');
	emptyInput();
});


//------------------------MODAL TAMBAH---------------------------------------------------
$('#tambahTransaksi .js-autocomplete').autoComplete({
	minChars: 3,
	delay:200,
	source: function(term, suggest){
		term = term.toLowerCase();
		kelas_id = $('#tambahTransaksi .kelas_id').val()
		tipe_id = $('#tambahTransaksi .tipe_id').val()

		$.ajax({
			url: API_URL+"/keuangan/tarif/search?keyword="+term+"&kelas="+kelas_id+"&tipe="+tipe_id,
			type: 'GET',
			dataType: 'json',
			tryCount : 0,
			retryLimit : 3,
			success: function(response) {
				data = response
				suggest(data);
			},
			error : function(xhr, textStatus, errorThrown ) {
				if (textStatus == 'timeout') {
					this.tryCount++;
					if (this.tryCount <= this.retryLimit) {
						$.ajax(this);
						return;
					}            
					return;
				}
				if (xhr.status == 500) {
					alert('error 500 - silahkan coba lagi');
				} else {
					alert('error, silahkan coba lagi');
				}
			}
		});
	},
	renderItem: function (item, search){
		var value = item['deskripsi'];
		var show = item['deskripsi'] +'-'+ item['tags'];
		content = '<div class="autocomplete-suggestion border-bottom" data-harga="'+item['harga']+'"  data-id="'+item['tarif_id']+'" data-val="'+value+'">'
		content+= '<div class="autocomplete-content-top">'+item['deskripsi']+'</div>'
		content+= '<div class="autocomplete-content-bottom text-muted">'+item['tags']+'</div>'
		content+= '</div>'
		return content;
	},
	onSelect: function(event, term, item) {
		element = $('#tambahTransaksi .tipe');
		last_deskripsi = item.data('val');
		var harga = item.data('harga')
		var harga_numeral = numeral(harga).format('0,0')

		$('#tambahTransaksi .tarif_id').val(item.data('id'));
		$('#tambahTransaksi .harga_satuan').val(harga_numeral);
		$('#tambahTransaksi .jumlah').val(1);
		$('#tambahTransaksi .diskon').val(0);
		updateSubtotal(harga_numeral,1,0);

	}
});

$('.lokasi').on('select2:select', function (e) {
	var data = e.params.data;
	kategori_id = $(".lokasi").select2().find(":selected").data("kategori");
	$('.kategori').val(kategori_id).trigger('change');
});

$('.kelas_id').on('select2:select', function (e) {
	var data = e.params.data;
	$('#tambahTransaksi .deskripsi').prop('disabled', false);
	$('#tambahTransaksi .deskripsi-info-disabled').hide();
	var kelas_id = $('#tambahTransaksi .kelas_id').val()
	var tipe_id = $('#tambahTransaksi .tipe_id').val()

	var tarif_id = $('#tambahTransaksi .tarif_id').val();
	if(tarif_id != '')
	{
		eventUpdateGetHarga(tarif_id,kelas_id,tipe_id);
	}
});

$('.tipe_id').on('select2:select', function (e) {
	var kelas_id = $('#tambahTransaksi .kelas_id').val()
	var tipe_id = $('#tambahTransaksi .tipe_id').val()
	var tarif_id = $('#tambahTransaksi .tarif_id').val();
	if(tarif_id != '')
	{
		eventUpdateGetHarga(tarif_id,kelas_id,tipe_id);
	}
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

function eventUpdateGetHarga(tarif_id,kelas_id,tipe_id)
{
	$('#tambahTransaksi #harga_loading').show();
	$('#tambahTransaksi .error-deskripsi-notfound').hide();
	$.ajax({
		url: API_URL+"/keuangan/tarif/get-sister?tarif="+tarif_id+"&kelas="+kelas_id+"&tipe="+tipe_id,
		type: 'GET',
		dataType: 'json',
		tryCount : 0,
		retryLimit : 3,
		success: function(data) {
			var harga = data.harga
			var harga_numeral = numeral(harga).format('0,0')

			$('#tambahTransaksi .harga_satuan').val(harga_numeral);
			$('#tambahTransaksi .deskripsi').val(data.deskripsi);
			var jumlah = $('#tambahTransaksi .jumlah').val();
			var diskon = $('#tambahTransaksi .diskon').val();
			updateSubtotal(harga_numeral,jumlah,diskon);

			if(data.tarif_id != 0)
			{
				$('#tambahTransaksi .tarif_id').val(data.tarif_id);
			}
			else
			{
				$('#tambahTransaksi .error-deskripsi-notfound').text('Tidak tersedia "'+data.deskripsi+'" untuk filter tersebut');
				$('#tambahTransaksi .error-deskripsi-notfound').show();
				
			}


			$('#tambahTransaksi #harga_loading').hide();
		},
		error : function(xhr, textStatus, errorThrown ) {
			if (textStatus == 'timeout') {
				this.tryCount++;
				if (this.tryCount <= this.retryLimit) {
					$.ajax(this);
					return;
				}            
				return;
			}
			if (xhr.status == 500) {
				alert('error 500 - silahkan coba lagi');
			} else {
				alert('error, silahkan coba lagi');
			}
		}
	});
}


function updateSubtotal(harga_numeral,jumlah,diskon)
{
	if(harga_numeral == '-' || harga_numeral == null) harga_numeral = $('#tambahTransaksi .harga_satuan').val();
	if(jumlah == '-') jumlah = $('#tambahTransaksi .jumlah').val();
	if(diskon == '-') diskon = $('#tambahTransaksi .diskon').val();

	harga_satuan = harga_numeral.replace(/\,/g, '');

	harga_satuan = Number(harga_satuan)
	jumlah = parseFloat(jumlah)
	diskon = parseFloat(diskon)

	subtotal = harga_satuan * jumlah - diskon;

	var subtotal_numeral = numeral(subtotal).format('0,0')

	$('#tambahTransaksi .subtotal').val(subtotal_numeral);
}

function emptyInput()
{
	deskripsi = $('#tambahTransaksi .deskripsi').val('');
	$('#tambahTransaksi .deskripsi-info-disabled').show();

	tarif_id= $('#tambahTransaksi .tarif_id').val(null);
	jumlah = $('#tambahTransaksi .jumlah').val('');
	harga = $('#tambahTransaksi .harga_satuan').val('');
	diskon = $('#tambahTransaksi .diskon').val('');
	subtotal = $('#tambahTransaksi .subtotal').val('');
	keterangan = $('#tambahTransaksi .keterangan').html('');
	id = $('#tambahTransaksi .id').val('');
	kelas_val = $('#tambahTransaksi .kelas_id').val();

	if(kelas_val == 0 )
		$('#tambahTransaksi .deskripsi').prop('disabled', true);
}

function validateInput()
{
	deskripsi = $('#tambahTransaksi .deskripsi').val();
	kategori = $('#tambahTransaksi .kategori').val();
	lokasi = $('#tambahTransaksi .lokasi').val();
	tarif_id= $('#tambahTransaksi .tarif_id').val();
	kelas_id = $('#tambahTransaksi .kelas_id').val();
	tarif_tipe_id = $('#tambahTransaksi .tipe_id').val();
	jumlah = $('#tambahTransaksi .jumlah').val();
	harga_numeral = $('#tambahTransaksi .harga_satuan').val();
	diskon = $('#tambahTransaksi .diskon').val();
	subtotal_numeral = $('#tambahTransaksi .subtotal').val();
	keterangan = $('#tambahTransaksi .keterangan').val();
	id = $('#tambahTransaksi .id').val();
	data_creator = $('#tambahTransaksi .created_by').select2('data')
	created_by = data_creator[0].id
	creator_name = data_creator[0].name
	error =0;

	harga = harga_numeral.replace(/\,/g, '');
	subtotal = subtotal_numeral.replace(/\,/g, '');

	if(deskripsi == '') {$('#tambahTransaksi .deskripsi-error').show();error=1;} else $('#tambahTransaksi .deskripsi-error').hide(); 
	if(kategori == 0) {$('#tambahTransaksi .kategori-error').show();error=1;} else $('#tambahTransaksi .kategori-error').hide(); 
	if(lokasi == 0) {$('#tambahTransaksi .lokasi-error').show();error=1;} else $('#tambahTransaksi .lokasi-error').hide(); 
	if(kelas_id == 0) {$('#tambahTransaksi .tarif-kelas-error').show();error=1;} else $('#tambahTransaksi .tarif-kelas-error').hide(); 
	if(jumlah == '' || jumlah == 0) {$('#tambahTransaksi .jumlah-error').show();error=1;} else $('#tambahTransaksi .jumlah-error').hide(); 
	if(harga == '' || harga == 0) {$('#tambahTransaksi .harga-error').show();error=1;} else $('#tambahTransaksi .harga-error').hide(); 
	if(diskon == '') {$('#tambahTransaksi .diskon-error').show();error=1;} else $('#tambahTransaksi .diskon-error').hide(); 
	if(error == 1) return 0;

	var data = {
		deskripsi: deskripsi,
		kategori_id: kategori,
		lokasi_id:lokasi,
		tarif_id: tarif_id,
		kelas_id: kelas_id,
		tarif_tipe_id:tarif_tipe_id,
		jumlah: jumlah,
		harga: harga,
		diskon: diskon,
		subtotal: subtotal,
		keterangan: keterangan,
		id:id,
		created_by:created_by,
		creator_name:creator_name,
	}


	return data;
}

function showEditModal(data)
{
	harga = data.get('harga');
	subtotal = data.get('subtotal');
	harga_numeral= numeral(harga).format('0,0')
	subtotal_numeral= numeral(subtotal).format('0,0')

	deskripsi = $('#tambahTransaksi .deskripsi').val(data.get('deskripsi'));
	kategori = $('#tambahTransaksi .kategori').val(data.get('kategori_id')).trigger('change');
	lokasi = $('#tambahTransaksi .lokasi').val(data.get('lokasi_id')).trigger('change');
	jumlah = $('#tambahTransaksi .jumlah').val(data.get('jumlah'));
	harga = $('#tambahTransaksi .harga_satuan').val(harga_numeral);
	diskon = $('#tambahTransaksi .diskon').val(data.get('diskon'));
	subtotal = $('#tambahTransaksi .subtotal').val(subtotal_numeral);
	keterangan = $('#tambahTransaksi .keterangan').html(data.get('keterangan'));
	id = $('#tambahTransaksi .id').val(data.id);
	kelas_id = $('#tambahTransaksi .kelas_id').val(data.get('kelas_id')).trigger('change');
	tarif_tipe_id = $('#tambahTransaksi .tipe_id').val(data.get('tarif_tipe_id')).trigger('change');
	tarif_id= $('#tambahTransaksi .tarif_id').val(data.get('tarif_id'));
	last_deskripsi = data.get('deskripsi')
    var $newOption = $("<option selected='selected'></option>").val(data.get('created_by')).text(data.get('creator_name'))

	$('#tambahTransaksi .created_by').append($newOption).trigger('change');

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
	var is_deleteds = transaksiCollection.pluck("is_deleted");

	var allJumlah = 0;
	var allDiskon = 0;
	var allTotal = 0;

	$.each(subtotals, function( index, value ) {
		if(!is_deleteds[index]){
			allJumlah+= hargas[index]*jumlahs[index]
			allDiskon+= parseFloat(diskons[index])	
		}
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
		id_detail: "",
		deskripsi: "",
		kategori_id: "",
		lokasi_id: "",
		tarif_id: null,
		kelas_id: "",
		tarif_tipe_id:"",
		jumlah: "",
		harga: "",
		diskon: "",
		subtotal: "",
		keterangan: "",
		created_by: null,
		is_deleted: 0,
	},
	idAttribute: "id"
});

var Transaksi = Backbone.Collection.extend({
	model: TransaksiDetail,
	sort_key: 'id'
});

var transaksiCollection = new Transaksi();
var recordCount = 0;
var newRecordCount = 0;

function backboneAddTransaksiDetail(data,default_value = 0)
{

	if(transaksiCollection.length > 0)
	{
		var transaksidetail = transaksiCollection.findWhere({id: data.id});
		if(typeof transaksidetail !== "undefined") 
			transaksiCollection.remove(transaksidetail);
	}

	if(default_value)
		recordCount = data.id;
	else
		recordCount++;

	var detail = new TransaksiDetail({ 
		id:recordCount,
		id_detail: data.id_detail,
		deskripsi: data.deskripsi,
		kategori_id: data.kategori_id,
		lokasi_id: data.lokasi_id,
		tarif_id: data.tarif_id,
		kelas_id: data.kelas_id,
		tarif_tipe_id:data.tarif_tipe_id,
		jumlah: data.jumlah,
		harga: data.harga,
		diskon: data.diskon,
		subtotal: data.subtotal,
		keterangan: data.keterangan,
		created_by: data.created_by,
		creator_name: data.creator_name
	});

	transaksiCollection.add(detail);
	if(!default_value){
		addRowHTML(data);
		var id = '#transaksi-'+recordCount;
	}
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
			deskripsi: data.deskripsi,
			kategori_id: data.kategori_id,
			lokasi_id: data.lokasi_id,
			tarif_id: data.tarif_id,
			kelas_id: data.kelas_id,
			tarif_tipe_id:data.tarif_tipe_id,
			jumlah: data.jumlah,
			harga: data.harga,
			diskon: data.diskon,
			subtotal: data.subtotal,
			keterangan: data.keterangan,
			created_by: data.created_by,
			creator_name:data.creator_name
		});
	}
	updateRowHTML(data);
	updateAllTotal();
}

function updateRowHTML(data)
{

	harga = data.harga;
	subtotal = data.subtotal;
	diskon = data.diskon;
	harga_numeral= numeral(harga).format('0,0')
	subtotal_numeral= numeral(subtotal).format('0,0')
	diskon_numeral= numeral(diskon).format('0,0')

	$("#deskripsi-"+data.id).html(data.deskripsi);
	$("#keterangan-"+data.id).html(data.keterangan);
	$("#jumlah-"+data.id).html(data.jumlah);
	$("#harga-"+data.id).html(harga_numeral);
	$("#diskon-"+data.id).html(diskon_numeral);
	$("#subtotal-"+data.id).html(subtotal_numeral);
}

//--------------------------------------------------------------------------------------------------------------------HTML

function addRowHTML(data)
{
	$('#emptyTable').hide()
	if (newRecordCount == 0) {
		$('.main-table tbody').append(`
			<tr class="table-warning">
                <td colspan="8" class="text-center">
                Tagihan Baru
                </td>
            </tr>
		`);
		newRecordCount++;
	}
	$('.main-table tbody').append(`
		<tr id="transaksi-`+recordCount+`" data-id="`+recordCount+`">
		<td class="text-center" style="width: 5%;">`+recordCount+`</td>
		<td id="deskripsi-`+recordCount+`" style="width: 19%;">`+data.deskripsi+`</td>
		<td id="keterangan-`+recordCount+`" style="width: 10%;">`+data.keterangan+`</td>
		<td id="jumlah-`+recordCount+`" class="text-center" style="width: 9%;">`+data.jumlah+`</td>
		<td id="harga-`+recordCount+`" class="text-right" style="width: 12%;">`+numeral(data.harga).format('0,0')+`</td>
		<td id="diskon-`+recordCount+`" class="text-center" style="width: 9%;">`+numeral(data.diskon).format('0,0')+`</td>
		<td id="subtotal-`+recordCount+`" class="text-right" style="width: 18%;">`+numeral(data.subtotal).format('0,0')+`</td>
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
	var countdetail = $('#countdetail').val();
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
				if(id<=countdetail)
					transaksidetail.set({
						is_deleted: 1});
				else
					transaksiCollection.remove(transaksidetail);
				deleteRow(id);
				var numOfModels = transaksiCollection.filter(function(model) { 
					return model.get('is_deleted') == 1;
				}).length;
				// alert(numOfModels);
				if(numOfModels == transaksiCollection.length){
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
	var lokasi = $('#lokasi').val();
	var pasien_pembayaran_id = $('#pasien-pembayaran').val();
	var akun_id = $('#akun').val();
	var lokasi_id = $("#lokasi").val();
	var perusahaan_id = $('#perusahaan').val();
	var piutang_parent_id = $('#piutang_parent_id').val();
	var kasus_tagihan_id = $('#kasus_tagihan_id').val();
	var keterangan = $('#keterangan').val();
	var kasir_id = $('#kasir_id').val();
	var numOfModels = transaksiCollection.filter(function(model) { 
		return model.get('is_deleted') == 1;
	  }).length;

	$('#error_tanggal_kosong').hide();
	$('#error_transaksi_kosong').hide();
	$('#error_kategori_kosong').hide();
	$('#error_lokasi_kosong').hide();
	$('#error_judul_kosong').hide();
	$('#error_pihak_3_kosong').hide();
	$('#error_akun_kosong').hide();

	var error = 0;
		
	if(numOfModels == transaksiCollection.length){
		$('#error_transaksi_kosong').show();
		error = 1;
	}
	if(tanggal == ''){
		$('#error_main_tanggal').show();
		error = 1;
	}
	if(kategori == ''){
		$('#error_kategori_kosong').show();
		error = 1;
	}
	if(judul == ''){
		$('#error_judul_kosong').show();
		error = 1;
	}
	if(pihak_3 == ''){
		$('#error_pihak_3_kosong').show();
		error = 1;
	}
	if(akun_id == ''){
		$('#error_akun_kosong').show();
		error = 1;
	}
	if(lokasi == 0){
		$('#error_lokasi_kosong').show();
		error = 1;
	}

	if(error == 1)
	{
		callSwal('warning','Transaksi Gagal','Input Tidak Valid',0);
	}
	else{
		var transaksiCollectionJSON = JSON.stringify(transaksiCollection);
		
		$('#buttonSubmit').hide();
		$('#buttonLoading').show();

		console.log(transaksiCollection);
		console.log(transaksiCollectionJSON);
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		var id = $('#idtransaksi').val();
		
		$.ajax({
			type: "POST",
			url: API_URL + "/keuangan/piutang/edit",
			dataType: "json",
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			data: {
				id : id,
				judul: judul,
				pasien_id : pasien_id,
				pihak_3 : pihak_3,
				tanggal : tanggal,
				kategori : kategori,
				pasien_pembayaran_id : pasien_pembayaran_id,
				akun_id : akun_id,
				lokasi_id : lokasi_id,
				perusahaan_id : perusahaan_id,
				kasus_tagihan_id : kasus_tagihan_id,
				piutang_parent_id : piutang_parent_id,
				keterangan : keterangan,
				kasir_id : kasir_id,
				transaksi: transaksiCollectionJSON,
				alltotal : globalTotal,
				alldiskon : globalDiskon,
				alljumlah : globalJumlah,
				redir_url : redirect_url
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

$(".user-select2").select2({
	ajax: {
		url: API_URL+"/search-user",
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
				results: data,
			};
		},
		cache: true
	},
	escapeMarkup: function (markup) { return markup; },
	minimumInputLength: 3,
	placeholder: "Cari Staff RS",
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
    initTransaksi()
</script>