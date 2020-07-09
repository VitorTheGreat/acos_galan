import VMasker from 'vanilla-masker';

$(document).ready(() => {

  //money mask
  let moneyInput = document.querySelectorAll(".data-money");
  VMasker(moneyInput).maskMoney({
    precision: 2,
    separator: ',',
    delimiter: '.',
    unit: '',
    zeroCents: false
  });

  // percent mask
  let percentInput = document.querySelectorAll(".data-percent");
  VMasker(percentInput).maskMoney({
    precision: 2,
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
  let preco_custo = document.getElementById('preco_custo');
  let preco_venda = document.getElementById('preco_venda');
  let lucro = document.getElementById('lucro');
  let icms = document.getElementById('icms');
  let ipi = document.getElementById('ipi');

  //calculate the price of the weigth
  preço_kg.addEventListener("blur", (event) => {

    let valor_peso = parseFloat(peso.value.replace('R$', '').replace(',', '.'));
    let valor_preco = parseFloat(event.target.value.replace('R$', '').replace(',', '.'));

    let custo_brutoTotal = valor_peso * valor_preco;
    custo_bruto.value = VMasker.toMoney(custo_brutoTotal.toFixed(2));

    if(valor_peso != 0 && valor_preco != 0) {

      custo_bruto.setAttribute("disabled", "disabled");
      ipi.focus();

    }
    else {

      custo_bruto.removeAttribute("disabled")
      custo_bruto.focus();

    }

  }, true);

  //calculate the price of taxes
  icms.addEventListener("blur", (event) =>  {

    let ipi_c = parseFloat(ipi.value.replace('%', '').replace(',', '.'))
    let icms_c = parseFloat(icms.value.replace('%', '').replace(',', '.'))
    let custo_bruto_c = parseFloat(custo_bruto.value.replace('R$', '').replace(',', '.'));

    let total_percent = (ipi_c + icms_c) / 100;

    let total_taxes =  custo_bruto_c * total_percent

    let preco_custo_with_taxes = parseFloat(total_taxes.toFixed(2)) + parseFloat(custo_bruto_c)

    preco_custo.value = VMasker.toMoney(preco_custo_with_taxes.toFixed(2));

  }, true);

  //calculate the price of the profit
  lucro.addEventListener("blur", ( event ) => {

    let preco_custo_c = parseFloat(preco_custo.value.replace(',', '.')).toFixed(2);
    let lucro_c = parseFloat(lucro.value.replace('%', '').replace(',', '.'));
    let percent = lucro_c / 100;

    let preco_ventaTotal = (percent * preco_custo_c)

    let precoFinal = parseFloat(preco_custo_c) + parseFloat(preco_ventaTotal.toFixed(2))

    preco_venda.value = VMasker.toMoney(precoFinal.toFixed(2));

  }, true);

})
