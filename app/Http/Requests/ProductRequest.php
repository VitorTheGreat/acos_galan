<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
        $this->merge([
          'preco_unitario' => floatval(str_replace(',', '.', $this->preco_unitario)),
          'preco_compra' => floatval(str_replace(',', '.', $this->preco_compra)),
          'preco_custo' => floatval(str_replace(',', '.', $this->preco_custo)),
          'preco_venda' => floatval(str_replace(',', '.', $this->preco_venda)),
          'ipi' => floatval(str_replace(',', '.', $this->ipi)),
          'icms' => floatval(str_replace(',', '.', $this->icms)),
          'lucro' => floatval(str_replace(',', '.', $this->lucro)),
          'supplier_id' => (int) $this->supplier_id,
          'storage_id' => (int) $this->storage_id,
          'quantidade' => floatval(str_replace(',', '.', $this->quantidade)),
        ]);
    }
}
