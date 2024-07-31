$(document).ready(function() {
  //JS SELECT2
  $('.js-select2').select2();
  $('.js-placeholder-day').select2({
    placeholder: "Pilih Tanggal"
  });
  $('.js-placeholder-month').select2({
    placeholder: "Pilih Bulan"
  });
  $('.js-placeholder-year').select2({
    placeholder: "Pilih Tahun"
  });

  // leap variable
  var isLeapYear = 0;
  var isLeapMonth = 0;
  // array of months
  var month = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'Nopember', 'Desember'];
  // year
  var now = new Date();
  var lastYear = now.getFullYear();
  var firstYear = 1900;
  
  monthPicker();
  yearPicker();
  dayPicker(31);

  function dayPicker (day) {
    for (let a = 1; a <= day ; a++) {
      let value;
      if( a < 10)
        value = '0' + a;
      else
        value = a;
      let option = new Option(a, value, false, false);
      $('.day').append(option).trigger('change');
    }
  }

  function monthPicker () {
    for (let a = 1; a <= 12 ; a++) {
      let value;
      if( a < 10)
        value = '0' + a;
      else
        value = a;
      let option = new Option(month[a-1], value, false, false);
      $('.month').append(option).trigger('change');
    }
  
    $('.month').change(function() {
      $('.day').empty();
      let data = $(this).val();
      isLeapMonth = data;
      if(data == "04" || data == "06" || data == "09" || data == "11" )
        dayPicker(30);
      else if (data == "02") {
        if(isLeapYear % 4 == 0) {
          if(isLeapYear % 100 == 0) {
            if(isLeapYear % 400 == 0) {
              dayPicker(29);
            } else {
              dayPicker(28);
            }
          } else {
            dayPicker(29);
          }
        } else {
          dayPicker(28);
        }
      }
      else
        dayPicker(31);
    });
  }

  function yearPicker() {
    for (let a = firstYear; a <= lastYear ; a++) {
      let option = new Option(a, a, false, false);
      $('.year').append(option).trigger('change');
    }

    $('.year').change(function() {
      let data = $(this).val();
      isLeapYear = data;
      if(isLeapMonth == "02") {
        $('.day').empty();
        if(data % 4 == 0) {
          if(data % 100 == 0) {
            if(data % 400 == 0) {
              dayPicker(29);
            } else {
              dayPicker(28);
            }
          } else {
            dayPicker(29);
          }
        } else {
          dayPicker(28);
        }
      }
    });
  }
});