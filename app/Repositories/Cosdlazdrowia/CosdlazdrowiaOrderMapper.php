<?php

namespace App\Repositories\Cosdlazdrowia;

use App\DTO\Order;
use App\Models\Cosdlazdrowia\Order as CosdlazdrowiaOrder;
use Illuminate\Support\Collection;

class CosdlazdrowiaOrderMapper
{
    public function mapOrders(?Collection $dbOrders): array
    {
        $orderItemMapper = new CosdlazdrowiaOrderItemMapper();

        $orders = [];
        /** @var CosdlazdrowiaOrder $dbOrder */
        foreach ($dbOrders as $dbOrder) {
            if ($this->skipOrder($dbOrder)) {
                continue;
            }

            $order = new Order();
            $fullName = $this->getFullName($dbOrder);

            $order->setConnectedModel($dbOrder);
            $order->setSystemName(CosdlazdrowiaOrder::SYSTEM_NAME);
            $order->setExternalId($dbOrder->order_id);
            $order->setCustomerEmail($dbOrder->order_customer_email);
            $order->setCustomerFullname($fullName);
            $order->setCustomerPostcode($dbOrder->order_customer_postcode);
            $order->setCustomerCity(trim($dbOrder->order_customer_city));
            $order->setCustomerAddress(trim($dbOrder->order_customer_address));
            $order->setCustomerPhone($dbOrder->order_customer_phone);
            $order->setCustomerCompany(trim($dbOrder->order_company_name));
            $order->setWantInvoice(trim($dbOrder->order_want_invoice));
            $order->setCompanyName(trim($this->getCompanyName($dbOrder)));
            $order->setCompanyNip($dbOrder->order_company_nip);
            $order->setCompanyPostcode(trim($this->getCompanyPostcode($dbOrder)));
            $order->setCompanyCity(trim($this->getCompanyCity($dbOrder)));
            $order->setCompanyAddress(trim($this->getCompanyAddress($dbOrder)));
            $order->setCompanyPhone(trim($this->getCompanyPhone($dbOrder)));
            $order->setNotice($dbOrder->order_notice);
            $order->setAmount($dbOrder->getToPay());
            $order->setIsPaid($dbOrder->isPaid());
            $order->setPayId($dbOrder->order_payu_id);
            $order->setDeliveryMethod($dbOrder->Delivery->delivery_name);
            $order->setPunktName($dbOrder->order_inpost_point);
            $order->setPostageAmount($dbOrder->order_delivery_brutto);
            $order->setPayType('PLID_' . $dbOrder->order_payment_id);
            $order->setCod($dbOrder->isCod());
            $order->setNumberOfPackages(1);

            $order->setItems($orderItemMapper->mapOrderItems($dbOrder->OrderItems));

            $orders[] = $order;
        }

        return $orders;
    }

    private function skipOrder(CosdlazdrowiaOrder $order)
    {
        return in_array($order->order_payment_id, [CosdlazdrowiaOrder::IMOJE_PAYMENT_ID, CosdlazdrowiaOrder::IMOJE_APPLE_GOOLE_PAYMENT_ID]) && strlen($order->order_payu_id) === 0;
    }

    private function getFullName(CosdlazdrowiaOrder $order)
    {
        return trim($order->order_customer_first_name) . ' ' . trim($order->order_customer_last_name);
    }

    private function getCompanyName(CosdlazdrowiaOrder $order)
    {
        if (strlen($order->order_company_name)) {
            return $order->order_company_name;
        }

        return $this->getFullName($order);
    }

    private function getCompanyAddress(CosdlazdrowiaOrder $order)
    {
        if (strlen($order->order_company_address)) {
            return $order->order_company_address;
        }

        return $order->order_customer_address;
    }

    private function getCompanyCity(CosdlazdrowiaOrder $order)
    {
        if (strlen($order->order_company_city)) {
            return $order->order_company_city;
        }

        return $order->order_customer_city;
    }

    private function getCompanyPostcode(CosdlazdrowiaOrder $order)
    {
        if (strlen($order->order_company_postcode)) {
            return $order->order_company_postcode;
        }

        return $order->order_customer_postcode;
    }

    private function getCompanyPhone(CosdlazdrowiaOrder $order)
    {
        if (strlen($order->order_company_phone)) {
            return $order->order_company_phone;
        }

        return $order->order_customer_phone;
    }
}
