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
        Data: <strong>000</strong>
    </div>
    
    <br />

    <div>

        {{$venda->id}}
        {{$venda->metodo_pagamento}}
        {{-- <table class="greyGridTable">
            <tr>
                <td>Estoque a Fornecer</td>
                <td>Estoque a Receber</td>
                <td>Quantidade</td>
                <td>Produto</td>
                <td>Responsavel retirada</td>
            </tr>
            <tr>
                <td>{{$transfer[0]->estoque_a_fornecer}}</td>
                <td>{{$transfer[0]->estoque_a_receber}}</td>
                <td>{{$transfer[0]->quantidade}}</td>
                <td>{{$transfer[0]->descricao}}</td>
                <td>{{$transfer[0]->responsavel_retira}}</td>
            </tr>
        </table> --}}

    </div>
    
    <br />

    <div class="row">
        <p> 
            ________________________________________________<br />
            Assinatura do Responsavel Recebimento

        </p>
        <br />
        <p> 
                ________________________________________________<br />
                Assinatura do Responsavel entrega (ALGUEM)
    
        </p>
    </div>
    
</body>
</html>