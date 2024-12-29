<?php

namespace App\Models\Cosdlazdrowia;

use App\Models\SellasistConnectedModelInterface;
use Illuminate\Database\Eloquent\Model;

class Order extends Model implements SellasistConnectedModelInterface
{
    const CREATED_AT = 'order_created_at';
    const UPDATED_AT = 'order_updated_at';
    const SYSTEM_NAME = 'cdzpl';
    const COD_PAYMENT_ID = 2;
    const STANDARD_BANK_PAYMENT_ID = 1;
    const IMOJE_PAYMENT_ID = 9;
    const IMOJE_APPLE_GOOLE_PAYMENT_ID = 12;

    protected $connection = 'cosdlazdrowia';
    protected $primaryKey = 'order_id';

    public function setSellasistOrderId($sellasistOrderId)
    {
        return $this->order_sellasist_id = $sellasistOrderId;
    }

    public function getToPay()
    {
        return ($this->getProductsAmount() + $this->order_delivery_brutto);
    }

    public function getProductsAmount()
    {
        $amount = 0;

        foreach ($this->OrderItems as $orderItem) {
            $amount += $orderItem->order_item_ammount;
        }

        return $amount;
    }

    public function isCod()
    {
        return $this->order_payment_id == self::COD_PAYMENT_ID;
    }

    public function isPaid()
    {
        return strlen($this->order_payu_id) > 0;
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_item_order_id', 'order_id');
    }

    public function delivery()
    {
        return $this->hasOne(Delivery::class, 'delivery_id', 'order_delivery_id');
    }
}
