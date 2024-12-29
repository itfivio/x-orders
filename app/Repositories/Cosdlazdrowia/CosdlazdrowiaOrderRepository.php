<?php

namespace App\Repositories\Cosdlazdrowia;

use App\Models\Cosdlazdrowia\Order as CosdlazdrowiaOrder;
use App\Repositories\OrderRepositoryInterface;

class CosdlazdrowiaOrderRepository implements OrderRepositoryInterface
{
    public function getOrdersFromDate(\DateTime $fromDate): array
    {
        $model = $this->getModel();

        $dbOrders = $model::with(['OrderItems', 'Delivery'])
            ->whereNull('order_sellasist_id')
            ->where('order_created_at', '>=', $fromDate->format('Y-m-d H:i:s'))
            ->get();

        return (new CosdlazdrowiaOrderMapper())->mapOrders($dbOrders);
    }

    public function findById($id): array
    {
        $model = $this->getModel();

        $dbOrders = $model::with(['OrderItems', 'Delivery'])
            ->whereNull('order_sellasist_id')
            ->where('order_id', '=', $id)
            ->get();

        return (new CosdlazdrowiaOrderMapper())->mapOrders($dbOrders);
    }

    private function getModel()
    {
        return CosdlazdrowiaOrder::class;
    }
}
