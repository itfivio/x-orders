<?php

namespace App\Models\Cosdlazdrowia;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    const CREATED_AT = 'order_item_created_at';
    const UPDATED_AT = 'order_item_updated_at';

    protected $connection = 'cosdlazdrowia';
    protected $primaryKey = 'order_item_id';
}
