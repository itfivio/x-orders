<?php

namespace App\DTO;

use DateTime;
class OrderItem
{
    private int $productId;
    private int $orderId;
    private string $auctionId;
    private int $quantity;
    private float $price;
    private float $amount;
    private string $vat;
    private string $title;
    private string $index;

    public function getProductId(): int
    {
        return $this->productId;
    }

    public function setProductId(int $productId): self
    {
        $this->productId = $productId;
        return $this;
    }

    public function getOrderId(): int
    {
        return $this->orderId;
    }

    public function setOrderId(int $orderId): self
    {
        $this->orderId = $orderId;
        return $this;
    }

    public function getAuctionId(): string
    {
        return $this->auctionId;
    }

    public function setAuctionId(string $auctionId): self
    {
        $this->auctionId = $auctionId;
        return $this;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;
        return $this;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;
        return $this;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): self
    {
        $this->amount = $amount;
        return $this;
    }

    public function getVat(): string
    {
        return $this->vat;
    }

    public function setVat(string $vat): self
    {
        $this->vat = $vat;
        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function getIndex(): string
    {
        return $this->index;
    }

    public function setIndex(string $index): self
    {
        $this->index = $index;
        return $this;
    }
}
