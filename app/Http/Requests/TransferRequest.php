<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransferRequest extends FormRequest
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
             'estoque_fornece' => 'required',
             'prod_id' => 'required',
             'status_transferencia' => 'required',
             'qtd_prod' => 'required',
             'estoque_recebe' => 'required',
             'responsavel_retira' => 'required'
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
           'estoque_fornece' => (int)$this->estoque_fornece,
           'prod_id' => (int)$this->prod_id,
           'qtd_prod' => floatval(str_replace(',', '.', $this->qtd_prod)),
           'estoque_recebe' => (int)$this->estoque_recebe
         ]);
     }
}
