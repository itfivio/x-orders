<?php

namespace App\Models\Hurt;

use App\Models\SellasistConnectedModelInterface;
use Illuminate\Database\Eloquent\Model;

class Order extends Model implements SellasistConnectedModelInterface
{
    const CREATED_AT = 'order_created_at';
    const UPDATED_AT = 'order_updated_at';
    const SYSTEM_NAME = 'hrdz';
    const STANDARD_BANK_PAYMENT_ID = 1;
    const COD_PAYMENT_ID = 2;
    const CREDIT_PAYMENT_ID = 3;

    protected $connection = 'hurt';
    protected $primaryKey = 'order_id';

    public function setSellasistOrderId($sellasistOrderId)
    {
        $this->order_sellasist_id = $sellasistOrderId;
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_item_order_id', 'order_id');
    }

    public function getToPay()
    {
        return ($this->getProductsAmount() + $this->order_delivery_brutto);
    }

    public function getProductsAmount()
    {
        $amount = 0;

        foreach ($this->OrderItems as $orderItem) {
            $amount += ($orderItem->order_item_brutto * $orderItem->order_item_quantity);
        }

        return $amount;
    }

    public function isCod()
    {
        return $this->order_payment_id == self::COD_PAYMENT_ID;
    }

    public function isCreditPayment()
    {
        return $this->order_payment_id == self::CREDIT_PAYMENT_ID;
    }
}
