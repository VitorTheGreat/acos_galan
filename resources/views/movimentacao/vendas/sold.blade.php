<!DOCTYPE html>
<html>
<head>
	<title>Venda Concluida</title>
</head>
<style>
h1, p{
    text-align: center;
}
table.greyGridTable {
  border: 2px solid #000000;
  width: 100%;
  text-align: center;
  border-collapse: collapse;
}
table.greyGridTable td, table.greyGridTable th {
  border: 1px solid #FFFFFF;
  padding: 3px 4px;
}
table.greyGridTable tbody td {
  font-size: 16px;
}
table.greyGridTable td:nth-child(even) {
  background: #EBEBEB;
}
table.greyGridTable thead {
  background: #FFFFFF;
  border-bottom: 4px solid #333333;
}
table.greyGridTable thead th {
  font-size: 16px;
  font-weight: bold;
  color: #333333;
  text-align: center;
  border-left: 2px solid #333333;
}
table.greyGridTable thead th:first-child {
  border-left: none;
}

table.greyGridTable tfoot {
  font-size: 16px;
  font-weight: bold;
  color: #333333;
  border-top: 4px solid #333333;
}
table.greyGridTable tfoot td {
  font-size: 16px;
}
</style>

<body>
    <h1>Venda Concluida - Aços Galan</h1>
    <hr />

    <div>
        Data: <strong>{{$venda[0]->created_at}}</strong> - Número da venda: <strong>{{$venda[0]->id}}</strong> - Loja: <strong>{{$venda[0]->loja}}</strong> - Vendedor: <strong>{{$venda[0]->vendedor}}</strong>
    </div>
    
    <br />

    <h3>Cliente: {{$venda[0]->nome}} </h3>
    <h4>Endereço: {{$venda[0]->endereco}} - CEP: {{$venda[0]->cep}} - {{$venda[0]->bairro}} - {{$venda[0]->cidade}} </h4>

    <br />

    <div>

        <table class="greyGridTable">
            <tr>
                <td>Produto</td>
                <td>Quantidade</td>
                <td>Preço unitário</td>
                <td>Sub Total</td>
            </tr>
            @foreach ($venda as $key => $item)
                <tr>
                    <td>{{$item->descricao}}</td>
                    <td>{{$item->quantidade}}</td>
                    <td>R$ {{$item->preco_venda_final}}</td>
                    <td>R$ {{$item->sub_total_produto}}</td>
                </tr>
            @endforeach
        </table>

        <br />

        <table class="greyGridTable">
            <tr>
                <td>Método de Pagamento</td>
                <td>Desconto</td>
                <td>Valor Pago</td>
                <td>Total</td>
                <td>Troco</td>
            </tr>
              <tr>
                  <td>{{$venda[0]->metodo_pagamento}}</td>
                  <td>R$ {{$venda[0]->valor_desconto}}</td>
                  <td>R$ {{$venda[0]->valor_pago}}</td>
                  <td>R$ {{$venda[0]->total}}</td>
                  <td>R$ {{$venda[0]->troco}}</td>
              </tr>
        </table>

    </div>
    
    <br />

    <div class="row">
        <p> 
            ________________________________________________<br />
            Assinatura do Cliente ({{$venda[0]->nome}})

        </p>
        <br />
        <p> 
                ________________________________________________<br />
                Assinatura do Responsavel entrega ({{$venda[0]->vendedor}} - Aços Galan)
    
        </p>
    </div>
    
</body>
</html>