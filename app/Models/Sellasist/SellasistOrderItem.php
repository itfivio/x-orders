<?php

namespace App\Models\Sellasist;

use Illuminate\Database\Eloquent\Model;

class SellasistOrderItem extends Model
{
    const CREATED_AT = 'sellasist_order_item_date_add';
    const UPDATED_AT = null;

    protected $connection = 'sellasist';
    protected $primaryKey = 'sellasist_order_item_id';
}
