
// const formatToCurrency = val =>
//   Number(val.replace(/\,/g,'')).toFixed(2).replace(/\d(?=(\d{3})+\.)/g,'$&,').slice(0,-3);

function formatToRupiah(angka, prefix) {
  var number_string = angka.replace(/[^,\d]/g, '').toString(),
      split    = number_string.split(','),
      sisa     = split[0].length % 3,
      rupiah     = split[0].substr(0, sisa),
      ribuan     = split[0].substr(sisa).match(/\d{3}/gi);
      
  if (ribuan) {
      separator = sisa ? '.' : '';
      rupiah += separator + ribuan.join('.');
  }
  
  rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
  return prefix == undefined ? rupiah : (rupiah ? 'Rp' + rupiah : '');
}

function convertToRupiah(param) {
  $('.currency').on('input',function(e){
    let input = $(this).val();    
    $(param).val(formatToRupiah(input));
  });
}

function formatToAngka(param) {
  let rupiah = $(param).val(),
      convertResult = parseInt(rupiah.replace(/,.*|[^0-9]/g, ''), 10);
  $(param).val(convertResult);
}

function convertToAngka(param) {
  $('.save-button').on('click', function() {
    formatToRupiah(param);
  });
}