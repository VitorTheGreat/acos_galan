<form action="{{route('produto.store')}}" method="post">
    @csrf
    <div class="form-row">
        <div class="col form-group">
            <label for="descricao">Descrição</label>
            <input type="text" class="form-control" placeholder="Descrição" id="descricao" name="descricao" value="{{old('descricao')}}">
        </div>
    </div>
    <div class="form-row">
        <div class="col-2 form-group">
            <label for="ean">EAN</label>
            <input type="text" class="form-control" placeholder="EAN" id="ean" name="ean" value="{{old('ean')}}">
        </div>
        <div class="col-2 form-group">
            <label for="">Quantidade</label>
            <input type="text" class="form-control" placeholder="Quantidade" id="quantidade" name="quantidade" value="{{old('quantidade')}}">
        </div>
        <div class="col-2 form-group">
            <select class="form-control" id="unidade_venda" name="unidade_venda">
                <option value="">Unidade de venda</option>
                <option value="br">Barra (br)</option>
                <option value="lt">Lata (lt)</option>
                <option value="kg">Kilo (kg)</option>
                <option value="mt">Metro (mt)</option>
                <option value="pc">Peça (pç)</option>
            </select>
        </div>
    </div>
    <hr />
    <div class="form-row">
        <div class="col-2 form-group">
            <label for="">Quantidade Fracionada</label>
            <input type="text" class="form-control data-kilo" placeholder="Kilo ou Metro" id="qtd_fracionada" name="qtd_fracionada" value="{{old('qtd_fracionada')}}">
        </div>
        <div class="col-2 form-group">
            <label for="">Preço</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        R$
                    </span>
                </div>
                <input class="form-control data-money" type="text" name="preco_unitario" id="preco_unitario" placeholder="Preço unitário" value="{{old('preco_unitario')}}">
            </div>
        </div>
        <div class="col-2 form-group">
            <label for="">Custo bruto / Preço Compra</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        R$
                    </span>
                </div>
                <input type="text" class="form-control data-money" id="preco_compra" name="preco_compra" placeholder="Preço Compra (unidade)" value="{{old('preco_compra')}}">
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="col-2 form-group">
            <label for="">% IPI</label>
            <input type="text" class="form-control data-percent" placeholder="% IPI" id="ipi" name="ipi" value="{{old('ipi')}}">
        </div>
        <div class="col-2 form-group">
            <label for="">% ICMS</label>
            <input type="text" class="form-control data-percent" placeholder="% ICMS" id="icms" name="icms" value="{{old('icms')}}">
        </div>
        <div class="col-2 form-group">
            <label for="">Preço de Custo (com taxas)</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        R$
                    </span>
                </div>
                <input type="text" class="form-control data-money" placeholder="Preço de Custo (com taxas)" id="preco_custo" name="preco_custo" value="{{old('preco_custo')}}">
            </div>
        </div>
        <div class="col-2 form-group">
            <label for="">% Lucro</label>
            <input type="text" class="form-control data-percent" placeholder="% Lucro" id="lucro" name="lucro" value="{{old('lucro')}}">
        </div>
        <div class="col-2 form-group">
            <label for="">Preço de Venda</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        R$
                    </span>
                </div>
                <input type="text" class="form-control data-money" placeholder="Preço de Venda (unidade)" id="preco_venda" name="preco_venda" value="{{old('preco_venda')}}">
            </div>
        </div>
    </div>
    <hr />
    <div class="form-row">
        <div class="col-2 form-group">
            <label for="">NCM</label>
            <input type="text" class="form-control" placeholder="NCM" id="ncm" name="ncm" value="{{old('ncm')}}">
        </div>
        <div class="col-2 form-group">
            <label for="">CSOSN</label>
            <input type="text" class="form-control" placeholder="CSOSN" id="csosn" name="csosn" value="{{old('csosn')}}">
        </div>
    </div>
    <div class="form-row">
        <div class="col-6 form-group">
            <label for="exampleFormControlSelect1">Fornecedor</label>
            <select class="form-control" data-style="btn btn-link" id="supplier_id" name="supplier_id">
                @foreach ($suppliers as $key => $supplier)
                <option value="{{$supplier->id}}">{{$supplier->razao_social}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-6 form-group">
            <label for="exampleFormControlSelect1">Loja/Estoque Fisico</label>
            <select class="form-control" data-style="btn btn-link" id="storage_id" name="storage_id">
                @foreach ($storages as $key => $storage)
                <option value="{{$storage->id}}">{{$storage->name}}</option>
                @endforeach
            </select>
        </div>

    </div>
    <button type="submit" class="btn btn-success">Cadastrar</button>
</form>