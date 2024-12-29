<?php

namespace App\Repositories\Hurt;

use App\DTO\Order;
use App\Models\Hurt\Order as HurtOrder;
use Illuminate\Support\Collection;

class HurtOrderMapper
{
    public function mapOrders(?Collection $dbOrders): array
    {
        $orderItemMapper = new HurtOrderItemMapper();

        $orders = [];
            /** @var HurtOrder $dbOrder */
        foreach ($dbOrders as $dbOrder) {
            $order = new Order();
            $notice[] = $dbOrder->isCreditPayment() ? 'Kredit kupiecki.' : '';
            if (strlen($dbOrder->order_notice)) {
                $notice[] = trim($dbOrder->order_notice);
            }

            $fullName = $this->getFullName($dbOrder);
            $order->setConnectedModel($dbOrder);
            $order->setSystemName(HurtOrder::SYSTEM_NAME);
            $order->setExternalId($dbOrder->order_id);
            $order->setCustomerEmail($dbOrder->order_customer_email);
            $order->setCustomerFullname($fullName);
            $order->setCustomerPostcode($dbOrder->order_customer_postcode);
            $order->setCustomerCity(trim($dbOrder->order_customer_city));
            $order->setCustomerAddress(trim($dbOrder->order_customer_address));
            $order->setCustomerPhone($dbOrder->order_customer_phone);
            $order->setCustomerCompany(trim($dbOrder->order_company_name));
            $order->setWantInvoice(1);
            $order->setCompanyName(trim($dbOrder->order_company_name));
            $order->setCompanyNip($dbOrder->order_company_nip);
            $order->setCompanyPostcode(trim($dbOrder->order_company_postcode));
            $order->setCompanyCity(trim($dbOrder->order_company_city));
            $order->setCompanyAddress(trim($dbOrder->order_company_address));
            $order->setCompanyPhone(trim($dbOrder->order_company_phone));
            $order->setNotice(implode(' - ', $notice));
            $order->setAmount($dbOrder->getToPay());
            $order->setIsPaid(0);
            $order->setPayId('');
            $order->setDeliveryMethod($dbOrder->order_delivery_name);
            $order->setPunktName('');
            $order->setPostageAmount($dbOrder->order_delivery_brutto);
            $order->setPayType('PLID_' . $dbOrder->order_payment_id);
            $order->setCod($dbOrder->isCod());
            $order->setNumberOfPackages(1);

            $order->setItems($orderItemMapper->mapOrderItems($dbOrder->OrderItems));

            $orders[] = $order;
        }

        return $orders;
    }
    private function getFullName(HurtOrder $order)
    {
        return trim($order->order_customer_firstname) . ' ' . trim($order->order_customer_lastname);
    }
}
