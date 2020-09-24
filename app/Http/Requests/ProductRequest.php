<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use NumberFormatter;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'descricao' => 'required',
            'ean' => 'required',
            'preco_unitario' => 'required',
            'preco_compra' => 'required',
            'preco_custo' => 'required',
            'preco_venda' => 'required',
            'lucro' => 'required',
            'ipi' => 'required',
            'icms' => 'required',
            'ncm' => 'required',
            'csosn' => 'required',
            'supplier_id' => 'required',
            'storage_id' => 'required',
            'quantidade' => 'required',
            'unidade_venda' => 'required',
        ];
    }
    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $region = 'pt_BR';
        // $currency = 'BRL';
        //Correction to thounsand values
        $formatter = new NumberFormatter($region, NumberFormatter::DECIMAL);
        
        $this->merge([
            'preco_unitario' => round($formatter->parse($this->preco_unitario), 2),
            'preco_compra' => round($formatter->parse($this->preco_compra), 2),
            'preco_custo' => round($formatter->parse($this->preco_custo), 2),
            'preco_venda' => round($formatter->parse($this->preco_venda), 2),
            'ipi' => round($formatter->parse($this->ipi), 2),
            'icms' => round($formatter->parse($this->icms), 2),
            'lucro' => round($formatter->parse($this->lucro), 2),
            'supplier_id' => (int) $this->supplier_id,
            'storage_id' => (int) $this->storage_id,
            'quantidade' => round($formatter->parse($this->quantidade), 2),
            'qtd_fracionada' => round($formatter->parse($this->qtd_fracionada), 2),
        ]);
    }
}
