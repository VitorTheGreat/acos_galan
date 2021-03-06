$(document).ready(function() {

    //close selling page
    $('#desconto').keyup(function() {
        const sub_total = parseFloat($('#sub_total').attr('data-sub-total-real'));
        
        $('#sub_total').val(sub_total - parseFloat($(this).val()));
        $('.sub_total span').text(sub_total - parseFloat($(this).val()));
    });

    $('#valor_pago').keyup(function() {
        $('#troco').val( (parseFloat($(this).val()) - parseFloat($('#sub_total').val())).toFixed(2))
        $('.troco span').text( (parseFloat($(this).val()) - parseFloat($('#sub_total').val())).toFixed(2) )
    })

    $('#save_budget, #close_selling').on('click', function() {
        setTimeout(() => {
            window.location.href = '/movimentacao/vendas';
        }, 600);
    })
})