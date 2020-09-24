<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Selling extends Model
{
    protected $guarded = [];

    protected $casts = [
      'customer_id' => 'int',
    ];
}
