<?php

namespace App\Repositories\Sellasist;

use App\DTO\Order;
use App\DTO\OrderItem;
use App\Models\Sellasist\SellasistOrder;
use App\Models\Sellasist\SellasistOrderItem;
use Illuminate\Support\Facades\DB;

class SellasistOrderRepository
{
    public function findBySystemAndExternalOrderId(string $system, string $externalOrderId): ?SellasistOrder
    {
        $model = $this->getModel();

        return $model::where('sellasist_system_name', 'like', $system)
            ->where('sellasist_order_external_order_id', $externalOrderId)
            ->first();
    }

    public function createOrder(Order $orderDto): ?int
    {
        $order = new SellasistOrder();

        $order->sellasist_system_name = $orderDto->getSystemName();
        $order->sellasist_order_allegro_account = '';
        $order->sellasist_order_external_order_id = $orderDto->getExternalId();
        $order->sellasist_order_customer_email = $orderDto->getCustomerEmail();
        $order->sellasist_order_customer_nick = '';
        $order->sellasist_order_customer_fullname = $orderDto->getCustomerFullname();
        $order->sellasist_order_customer_company = $orderDto->getCustomerCompany();
        $order->sellasist_order_customer_country = $orderDto->getCustomerCountry();
        $order->sellasist_order_customer_postcode = $orderDto->getCustomerPostcode();
        $order->sellasist_order_customer_city = $orderDto->getCustomerCity();
        $order->sellasist_order_customer_address = $orderDto->getCustomerAddress();
        $order->sellasist_order_customer_phone = $orderDto->getCustomerPhone();
        $order->sellasist_order_want_invoice = $orderDto->isWantInvoice();
        $order->sellasist_order_company_name = $orderDto->getCompanyName();
        $order->sellasist_order_company_nip = $orderDto->getCompanyNip();
        $order->sellasist_order_company_postcode = $orderDto->getCompanyPostcode();
        $order->sellasist_order_company_city = $orderDto->getCompanyCity();
        $order->sellasist_order_company_address = $orderDto->getCompanyAddress();
        $order->sellasist_order_company_phone = $orderDto->getCompanyPhone();
        $order->sellasist_order_notice = $orderDto->getNotice();
        $order->sellasist_order_amount = $orderDto->getAmount();
        $order->sellasist_order_is_paid = $orderDto->isIsPaid();
        $order->sellasist_order_delivery_method = $orderDto->getDeliveryMethod();
        $order->sellasist_order_punkt_name = $orderDto->getPunktName();
        $order->sellasist_order_point_address = '';
        $order->sellasist_order_postage_amount = $orderDto->getPostageAmount();
        $order->sellasist_order_pay_type = $orderDto->getPayType();
        $order->sellasist_order_cod = $orderDto->isCod();
        $order->sellasist_number_of_packages = $orderDto->getNumberOfPackages();
        $order->sellasist_order_pay_id = $orderDto->getPayId();

        DB::transaction(function () use ($order, $orderDto) {
            $order->save();

            $this->createOrderItems($order->sellasist_order_id, $orderDto->getItems());
        });

        return $order->sellasist_order_id;
    }

    /**
     * @param $orderId
     * @param array $orderItemsDto
     * @return void
     */
    public function createOrderItems(int $orderId, array $orderItemsDto): void
    {
        /** @var OrderItem $orderItemDto */
        foreach ($orderItemsDto as $orderItemDto) {
            $orderItem = new SellasistOrderItem();
            $orderItem->sellasist_order_item_order_id = $orderId;
            $orderItem->sellasist_order_item_quantity = $orderItemDto->getQuantity();
            $orderItem->sellasist_order_item_price = $orderItemDto->getPrice();
            $orderItem->sellasist_order_item_amount = $orderItemDto->getAmount();
            $orderItem->sellasist_order_item_vat = $orderItemDto->getVat();
            $orderItem->sellasist_order_item_title = $orderItemDto->getTitle();
            $orderItem->sellasist_order_item_index = $orderItemDto->getIndex();
            $orderItem->sellasist_order_item_product_id = $orderItemDto->getProductId();
            $orderItem->sellasist_order_item_auction_id = $orderItemDto->getProductId();

            $orderItem->save();
        }
    }

    private function getModel(): string
    {
        return SellasistOrder::class;
    }
}
