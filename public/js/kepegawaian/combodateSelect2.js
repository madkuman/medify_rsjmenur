//SELECT2
function jsSelect2() {
  $('.js-select2').select2();
}

function combodate(param, value) {
  $(function() {
    $(param).combodate({
      value: value,
      minYear: 1900,
      maxYear: moment().format('YYYY'),
      smartDays: true,
      customClass: 'form-control js-select2'
    });
    $(param).combodate('setValue', value);
    jsSelect2();
  });
}

function combodateFirst(param,year) {
  if(year == undefined)
  {
    year =  moment().format('YYYY')
  }

  $(function() {
    $(param).combodate({
      firstItem: 'empty',
      minYear: 1900,
      maxYear: year,
      smartDays: true,
      customClass: 'form-control js-select2'
    });
    jsSelect2();
  });
}

//make my own function, because combodate's width customization is not flexible
function yearPicker() {
  let now = new Date(),
      lastYear = now.getFullYear(),
      firstYear = 1900;

  for (let a = lastYear; a >= firstYear ; a--) {
    let option = new Option(a, a, false, false);
    $('.year').append(option).trigger('change');
  }
}

