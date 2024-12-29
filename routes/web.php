<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {

    $orderRepository = new \App\Repositories\Cosdlazdrowia\CosdlazdrowiaOrderRepository();
    $orders = $orderRepository->getOrdersFromDate(\Carbon\Carbon::now()->subDay());
    dd($orders);

    return view('welcome');
});
