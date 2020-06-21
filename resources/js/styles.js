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

//masks

// function to make dynamic masks
function inputHandler(masks, max, event) {
  let c = event.target;
  let v = c.value.replace(/\D/g, '');
  let m = c.value.length > max ? 1 : 0;
  VMasker(c).unMask();
  VMasker(c).maskPattern(masks[m]);
  c.value = VMasker.toPattern(v, masks[m]);
}

//cellphone and telephone masks
// let telMask = ['(99) 9999-99999', '(99) 99999-9999'];
// let tel = document.querySelector('#tel');
// VMasker(tel).maskPattern(telMask[0]);
// tel.addEventListener('input', inputHandler.bind(undefined, telMask, 14), false);
//
//cpf and cnpj masks
// let docMask = ['999.999.999-999', '99.999.999/9999-99'];
// let doc = document.querySelector('#doc');
// VMasker(doc).maskPattern(docMask[0]);
// doc.addEventListener('input', inputHandler.bind(undefined, docMask, 14), false);

//percent mask
let percentMask = ['9%', '99%', '999%'];
let percent = document.querySelectorAll(".data-percent");
VMasker(percent).maskPattern(percentMask[0]);
for (let i = 0; i < percent.length; i++) {
  percent[i].addEventListener('input', inputHandler.bind(undefined, percentMask, 14), false);
  console.log('percent => ', percent[i]);
}

// money mask
let data_money = document.querySelectorAll(".data-money");
VMasker(data_money).maskMoney({
  // Decimal precision -> "90"
  precision: 2,
  // Decimal separator -> ",90"
  separator: ',',
  // Number delimiter -> "12.345.678"
  delimiter: '.',
  // Money unit -> "R$ 12.345.678,90"
  unit: 'R$',
  // Force type only number instead decimal,
  // masking decimals with ",00"
  // Zero cents -> "R$ 1.234.567.890,00"
  // zeroCents: true
});

});
