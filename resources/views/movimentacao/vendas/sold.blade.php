<!DOCTYPE html>
<html>
<head>
	<title>Venda Concluida</title>
</head>
<style>
  * {
    margin: 0;
    padding: 0px;
    font-weight: bold;
  }
table.greyGridTable {
  border: 0.8px solid #000000;
  width: 100%;
  border-collapse: collapse;
}
table.greyGridTable td, table.greyGridTable th {
  border: 0.5px solid #FFFFFF;
  padding: 3px 4px;
}
table.greyGridTable tbody td {
  font-size: 16px;
}
/* table.greyGridTable td:nth-child(even) {
  background: #EBEBEB;
} */
table.greyGridTable thead {
  background: #FFFFFF;
  border-bottom: 4px solid #333333;
}
table.greyGridTable thead th {
  font-size: 16px;
  font-weight: bold;
  color: #333333;
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
  @if ($venda[0]->status_venda == 'venda_fechada')
  <h4 style="margin: 30px 10px 10px 10px">V Aços Galan</h4>
  @elseif ($venda[0]->status_venda == 'orcamento')
  <h4 style="margin: 30px 10px 10px 10px">O Aços Galan</h4>
  @endif
  <div style="margin: 5px 10px">
    <strong>Tels:(11) 4621-9051 - KM54</strong> - <strong>(11) 4621-9080 - Cotia 2</strong> - <strong>(15) 3248-3689 - Ibiúna</strong> - <strong>(11) 4784-3169 - São Roque</strong>
  </div>  
  <hr />

    <div style="margin: 5px 10px">
        Data: <strong>{{date('d/m/Y h:i:s', strtotime($venda[0]->created_at))}}</strong> - Número: <strong>{{$venda[0]->id}}</strong> - Vendedor: <strong>{{$venda[0]->vendedor}}</strong>
    </div>
  
    <h4 style="margin: 5px 10px">
      Cliente: {{$venda[0]->nome}} <br />
      Endereço: {{$venda[0]->endereco}} - CEP: {{$venda[0]->cep}} - {{$venda[0]->bairro}} - {{$venda[0]->cidade}}
    </h4>

    <div style="margin: 10px 10px">

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
                <td>Forma de Pagamento</td>

                <td>Total</td>
            </tr>
              <tr>
                  <td>{{$venda[0]->metodo_pagamento}}</td>
                  <td>R$ {{$venda[0]->total}}</td>
              </tr>
        </table>

        <div>
          <h4>Observação:</h4>
          <p>{{$venda[0]->observacao}}</p>
        </div>
    </div>
    
    <br />

    <div class="row" style="margin: 5px 10px">
      <table>
          <td>
              ___________________________________<br />
              Assinatura do Entregador
          </td>
          <td>
              __________________________________<br />
              Assinatura do Cliente
          </td>
        </tr>

      </table>

    </div>
    
</body>
</html>