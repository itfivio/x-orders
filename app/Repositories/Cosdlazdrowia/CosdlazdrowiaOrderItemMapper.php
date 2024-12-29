<?php

namespace App\Repositories\Cosdlazdrowia;

use App\DTO\OrderItem;
use Illuminate\Support\Collection;

class CosdlazdrowiaOrderItemMapper
{
    public function mapOrderItems(?Collection $dbOrderItems): array
    {
        $orderItems = [];
        foreach ($dbOrderItems as $dbOrderItem) {
            $orderItem = new OrderItem();
            $orderItem->setProductId($dbOrderItem->order_item_product_id);
            $orderItem->setOrderId($dbOrderItem->order_item_order_id);
            $orderItem->setQuantity($dbOrderItem->order_item_quantity);
            $orderItem->setPrice($dbOrderItem->order_item_brutto);
            $orderItem->setAmount($dbOrderItem->order_item_ammount);
            $orderItem->setVat($this->getVat($dbOrderItem->order_item_vat_value));
            $orderItem->setTitle($dbOrderItem->order_item_name);
            $orderItem->setIndex($dbOrderItem->order_item_index);
            $orderItems[] = $orderItem;
        }

        return $orderItems;
    }

    private function getVat($vat)
    {
        if ($vat == 0) {
            $vat = 0.05;
        }

        return (string)($vat * 100);
    }
}
