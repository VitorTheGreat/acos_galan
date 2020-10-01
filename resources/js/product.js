import VMasker from 'vanilla-masker';

const toFloat = (value) => {
    return parseFloat(value.replace('R$', '').replace(',', '.'))
}

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
        suffixUnit: '',
        zeroCents: false
    });

    // kilogram masker
    let kiloInput = document.querySelectorAll(".data-kilo");
    VMasker(kiloInput).maskMoney({
        precision: 3,
        separator: ',',
        delimiter: ',',
        suffixUnit: '',
        zeroCents: false
    });

    //vars - Elements IDs
    let preco_unitario
    let quantidade
    let preco_compra
    let preco_custo
    let preco_venda
    let lucro
    let icms
    let ipi
    let qtd_fracionada

    $('#preco_unitario, #preco_unitario_edit')
        .bind('keyup', (event) => {
            if (event.currentTarget.id == 'preco_unitario') {
                preco_unitario = document.getElementById('preco_unitario');
                quantidade = document.getElementById('quantidade');
                preco_compra = document.getElementById('preco_compra');
                preco_custo = document.getElementById('preco_custo');
                preco_venda = document.getElementById('preco_venda');
                lucro = document.getElementById('lucro');
                icms = document.getElementById('icms');
                ipi = document.getElementById('ipi');
                qtd_fracionada = document.getElementById('qtd_fracionada');

                calcs()
            }
            if (event.currentTarget.id == 'preco_unitario_edit') {
                preco_unitario = document.getElementById('preco_unitario_edit');
                quantidade = document.getElementById('quantidade_edit');
                preco_compra = document.getElementById('preco_compra_edit');
                preco_custo = document.getElementById('preco_custo_edit');
                preco_venda = document.getElementById('preco_venda_edit');
                lucro = document.getElementById('lucro_edit');
                icms = document.getElementById('icms_edit');
                ipi = document.getElementById('ipi_edit');
                qtd_fracionada = document.getElementById('qtd_fracionada_edit');

                calcs()
            }
        })

    const calcs = () => {

        //calculate the price of the weigth
        preco_unitario.addEventListener("blur", (event) => {

            let preco_compraTotal = toFloat(quantidade.value) * toFloat(preco_unitario.value);
            let preco_compraTotalFracionada = toFloat(qtd_fracionada.value) * toFloat(preco_unitario.value)

            if (preco_compraTotalFracionada != 0) {
                preco_compra.value = VMasker.toMoney(preco_compraTotalFracionada.toFixed(2));
            } else {
                preco_compra.value = VMasker.toMoney(preco_compraTotal.toFixed(2));
            }

            console.log(preco_compra.value)

            preco_unitario.value == '0,00' ? preco_compra.focus() : ipi.focus();

        }, true);

        //preço compra
        preco_compra.addEventListener('blur', (event) => {

            let un = toFloat(preco_compra.value) / toFloat(quantidade.value);

            if (preco_unitario.value == '0,00') {
                preco_unitario.value = VMasker.toMoney(un.toFixed(2))
            }

        })

        //calculate the price of taxes
        icms.addEventListener("blur", (event) => {

            let total_percent = (toFloat(ipi.value) + toFloat(icms.value)) / 100;

            let total_taxes = toFloat(preco_compra.value) * total_percent

            let preco_custo_with_taxes = parseFloat(total_taxes.toFixed(2)) + toFloat(preco_compra.value)

            preco_custo.value = VMasker.toMoney(preco_custo_with_taxes.toFixed(2));

        }, true);

        //calculate the price of the profit
        lucro.addEventListener("blur", (event) => {

            let percent = toFloat(lucro.value) / 100;

            let preco_ventaTotal = (percent * toFloat(preco_custo.value))

            let precoFinal = toFloat(preco_custo.value) + parseFloat(preco_ventaTotal.toFixed(2))

            preco_venda.value = VMasker.toMoney(precoFinal.toFixed(2));

            console.log(preco_venda.value, precoFinal)

        }, true);
    }


})
