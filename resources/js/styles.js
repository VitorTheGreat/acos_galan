import VMasker from 'vanilla-masker';

$(document).ready(function(){

//alert
let vh = {
  showNotification: function(from, align, type, message) {
    // type = ['', 'info', 'danger', 'success', 'warning', 'rose', 'primary'];

    $.notify({
      icon: "add_alert",
      message: message
      // message: "Welcome to <b>Material Dashboard Pro</b> - a beautiful admin panel for every web developer."

    }, {
      type: type,
      timer: 3000,
      placement: {
        from: from,
        align: align
      }
    });
  }
}

//money mask
let moneyInput = document.querySelectorAll(".data-money");
VMasker(moneyInput).maskMoney({
  precision: 2,
  separator: ',',
  delimiter: '.',
  unit: 'R$',
  zeroCents: false
});

// percent mask
let percentInput = document.querySelectorAll(".data-percent");
VMasker(percentInput).maskMoney({
  precision: 1,
  suffixUnit: '%',
  zeroCents: false
});

// kilogram masker
let kiloInput = document.querySelectorAll(".data-kilo");
VMasker(kiloInput).maskMoney({
  precision: 3,
  separator: ',',
  delimiter: ',',
  suffixUnit: 'gr',
  zeroCents: false
});

let preço_kg = document.getElementById('preco_kg');
let peso = document.getElementById('peso');
let custo_bruto = document.getElementById('custo_bruto');

preço_kg.addEventListener("blur", function( event ) {

  let valor_peso = parseFloat(peso.value.replace('R$', '').replace(',', '.'));
  let valor_preco = parseFloat(event.target.value.replace('R$', '').replace(',', '.'));

  let custo_brutoTotal = valor_peso * valor_preco;
  custo_bruto.value = "";

}, true);

$('body').on('click', '.btn-success', function(){

  moneyInput.forEach((el, i) => {
    console.log('money => ', el.value, 'money corrected value => ', parseFloat(el.value.replace('R$', '').replace(',', '.')))
  });

  percentInput.forEach((el, i) => {
    console.log('percent => ', el.value, 'percent corrected value => ', parseFloat(el.value.replace('R$', '').replace(',', '.')))
  });

  kiloInput.forEach((el, i) => {
    console.log('kilo => ', el.value, 'kiloInput corrected value => ', parseFloat(el.value.replace('gr', '').replace(',', '.')));
  });

});

});
