<?php

namespace App\Repositories\Hurt;

use App\Repositories\OrderRepositoryInterface;
use App\Models\Hurt\Order as HurtOrder;

class HurtOrderRepository implements OrderRepositoryInterface
{
    public function getOrdersFromDate(\DateTime $fromDate): array
    {
        $model = $this->getModel();

        $dbOrders = $model::with(['OrderItems'])
            ->whereNull('order_sellasist_id')
            ->where('order_created_at', '>=', $fromDate->format('Y-m-d H:i:s'))
            ->get();

        return (new HurtOrderMapper())->mapOrders($dbOrders);
    }

    public function findById($id): array
    {
        $model = $this->getModel();

        $dbOrders = $model::with(['OrderItems'])
            ->whereNull('order_sellasist_id')
            ->where('order_id', '=', $id)
            ->get();

        return (new HurtOrderMapper())->mapOrders($dbOrders);
    }

    private function getModel()
    {
        return HurtOrder::class;
    }
}
