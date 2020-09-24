<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    //passing the correct types from input defined as texts
    protected $casts = [
      'preco_unitario' => 'float',
      'preco_compra' => 'float',
      'preco_custo' => 'float',
      'preco_venda' => 'float',
      'ipi' => 'float',
      'icms' => 'float',
      'compra_fracionada' => 'boolean'
    ];
}
