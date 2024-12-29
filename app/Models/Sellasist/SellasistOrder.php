<?php

namespace App\Models\Sellasist;

use Illuminate\Database\Eloquent\Model;

class SellasistOrder extends Model
{
    const CREATED_AT = 'sellasist_order_date_add';
    const UPDATED_AT = 'sellasist_order_date_update';

    protected $connection = 'sellasist';
    protected $primaryKey = 'sellasist_order_id';
}
