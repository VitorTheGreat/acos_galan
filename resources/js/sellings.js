$(document).ready(() => {
    const calcTotal = (percent = 0) => {
        var precos = []

        $('.preco_venda_final').each(function(e) {
            var preco = parseFloat($(this).parent().find('input[name="preco_venda"]').val())

            var quantidade = parseFloat($(this).parent().find('input[name="quantidade"]').val())
            
            if(percent == 0) {
                preco = parseFloat($(this).parent().find('input[name="preco_venda"]').attr('data-real-price'))
            }
            
            var preco_final = (preco*percent + preco) * quantidade;

            // $(this).parent().find('input[name="preco_venda"]').val(preco_final.toFixed(2))
            $(this).html(`<small>R$</small>${preco_final.toFixed(2).toString()}`)
            
            precos.push(preco_final)
            
        })
        
        var total = precos.reduce((a, value) => a + value)
        
        $('input[name="total_venda"]').val(total.toFixed(2))
    }

    $('input[name="preco_venda"]').each(function(e) {
    
        $(this).keyup(() => {
            calcTotal($('#tabela').val()/100)
        })
    
    })

    $('input[name="quantidade"]').each(function(e) {
    
        $(this).keyup(() => {
            calcTotal($('#tabela').val()/100)
        })
    
    })

    $('#tabela').change(function() {
        var percent = $(this).val() / 100;
        $('span.percentage').text(`${$(this).val()}%`)
        calcTotal(percent)
    })

    calcTotal()


})