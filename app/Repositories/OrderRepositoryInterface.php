<?php

namespace App\Repositories;

interface OrderRepositoryInterface
{
    /** Order[] */
    public function getOrdersFromDate(\DateTime $fromDate): array;

    public function findById($id): array;
}
