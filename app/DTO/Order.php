<?php

namespace App\DTO;

use App\Models\SellasistConnectedModelInterface;
use Illuminate\Database\Eloquent\Model;

class Order
{
    private string $systemName;
    private string $externalId;
    private string $customerEmail;
    private string $customerFullname;
    private ?string $customerCompany;
    private string $customerCountry = 'PL';
    private string $customerPostcode;
    private string $customerCity;
    private string $customerAddress;
    private string $customerPhone;
    private bool $wantInvoice;
    private ?string $companyName;
    private ?string $companyNip;
    private ?string $companyPostcode;
    private ?string $companyCity;
    private ?string $companyAddress;
    private ?string $companyPhone;
    private ?string $notice;
    private float $amount;
    private bool $isPaid;
    private ?string $payId;
    private string $deliveryMethod;
    private ?string $punktName;
    private float $postageAmount;
    private string $payType;
    private bool $cod;
    private int $numberOfPackages;
    /** @var array OrderItem[] */
    private array $items;


    private ?SellasistConnectedModelInterface $connectedModel;

    public function getSystemName(): string
    {
        return $this->systemName;
    }

    public function setSystemName(string $systemName): self
    {
        $this->systemName = $systemName;
        return $this;
    }

    public function getAllegroAccount(): string
    {
        return $this->allegroAccount;
    }

    public function setAllegroAccount(string $allegroAccount): self
    {
        $this->allegroAccount = $allegroAccount;
        return $this;
    }

    public function getExternalId(): string
    {
        return $this->externalId;
    }

    public function setExternalId(string $externalId): self
    {
        $this->externalId = $externalId;
        return $this;
    }

    public function getCustomerEmail(): string
    {
        return $this->customerEmail;
    }

    public function setCustomerEmail(string $customerEmail): self
    {
        $this->customerEmail = $customerEmail;
        return $this;
    }

    public function getCustomerNick(): string
    {
        return $this->customerNick;
    }

    public function setCustomerNick(string $customerNick): self
    {
        $this->customerNick = $customerNick;
        return $this;
    }

    public function getCustomerFullname(): string
    {
        return $this->customerFullname;
    }

    public function setCustomerFullname(string $customerFullname): self
    {
        $this->customerFullname = $customerFullname;
        return $this;
    }

    public function getCustomerCompany(): ?string
    {
        return $this->customerCompany;
    }

    public function setCustomerCompany(?string $customerCompany): self
    {
        $this->customerCompany = $customerCompany;
        return $this;
    }

    public function getCustomerCountry(): string
    {
        return $this->customerCountry;
    }

    public function setCustomerCountry(string $customerCountry): self
    {
        $this->customerCountry = $customerCountry;
        return $this;
    }

    public function getCustomerPostcode(): string
    {
        return $this->customerPostcode;
    }

    public function setCustomerPostcode(string $customerPostcode): self
    {
        $this->customerPostcode = $customerPostcode;
        return $this;
    }

    public function getCustomerCity(): string
    {
        return $this->customerCity;
    }

    public function setCustomerCity(string $customerCity): self
    {
        $this->customerCity = $customerCity;
        return $this;
    }

    public function getCustomerAddress(): string
    {
        return $this->customerAddress;
    }

    public function setCustomerAddress(string $customerAddress): self
    {
        $this->customerAddress = $customerAddress;
        return $this;
    }

    public function getCustomerPhone(): string
    {
        return $this->customerPhone;
    }

    public function setCustomerPhone(string $customerPhone): self
    {
        $this->customerPhone = $customerPhone;
        return $this;
    }

    public function isWantInvoice(): bool
    {
        return $this->wantInvoice;
    }

    public function setWantInvoice(bool $wantInvoice): self
    {
        $this->wantInvoice = $wantInvoice;
        return $this;
    }

    public function getCompanyName(): ?string
    {
        return $this->companyName;
    }

    public function setCompanyName(?string $companyName): self
    {
        $this->companyName = $companyName;
        return $this;
    }

    public function getCompanyNip(): ?string
    {
        return $this->companyNip;
    }

    public function setCompanyNip(?string $companyNip): self
    {
        $this->companyNip = $companyNip;
        return $this;
    }

    public function getCompanyPostcode(): ?string
    {
        return $this->companyPostcode;
    }

    public function setCompanyPostcode(?string $companyPostcode): self
    {
        $this->companyPostcode = $companyPostcode;
        return $this;
    }

    public function getCompanyCity(): ?string
    {
        return $this->companyCity;
    }

    public function setCompanyCity(?string $companyCity): self
    {
        $this->companyCity = $companyCity;
        return $this;
    }

    public function getCompanyAddress(): ?string
    {
        return $this->companyAddress;
    }

    public function setCompanyAddress(?string $companyAddress): self
    {
        $this->companyAddress = $companyAddress;
        return $this;
    }

    public function getCompanyPhone(): ?string
    {
        return $this->companyPhone;
    }

    public function setCompanyPhone(?string $companyPhone): self
    {
        $this->companyPhone = $companyPhone;
        return $this;
    }

    public function getNotice(): ?string
    {
        return $this->notice;
    }

    public function setNotice(?string $notice): self
    {
        $this->notice = $notice;
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

    public function isIsPaid(): bool
    {
        return $this->isPaid;
    }

    public function setIsPaid(bool $isPaid): self
    {
        $this->isPaid = $isPaid;
        return $this;
    }

    public function getPayId(): ?string
    {
        return $this->payId;
    }

    public function setPayId(?string $payId): self
    {
        $this->payId = $payId;
        return $this;
    }

    public function getDeliveryMethod(): string
    {
        return $this->deliveryMethod;
    }

    public function setDeliveryMethod(string $deliveryMethod): self
    {
        $this->deliveryMethod = $deliveryMethod;
        return $this;
    }

    public function getPointId(): ?string
    {
        return $this->pointId;
    }

    public function setPointId(?string $pointId): self
    {
        $this->pointId = $pointId;
        return $this;
    }

    public function getPunktName(): ?string
    {
        return $this->punktName;
    }

    public function setPunktName(?string $punktName): self
    {
        $this->punktName = $punktName;
        return $this;
    }

    public function getPointPostcode(): ?string
    {
        return $this->pointPostcode;
    }

    public function setPointPostcode(?string $pointPostcode): self
    {
        $this->pointPostcode = $pointPostcode;
        return $this;
    }

    public function getPointCity(): ?string
    {
        return $this->pointCity;
    }

    public function setPointCity(?string $pointCity): self
    {
        $this->pointCity = $pointCity;
        return $this;
    }

    public function getPointAddress(): ?string
    {
        return $this->pointAddress;
    }

    public function setPointAddress(?string $pointAddress): self
    {
        $this->pointAddress = $pointAddress;
        return $this;
    }

    public function getPostageAmount(): float
    {
        return $this->postageAmount;
    }

    public function setPostageAmount(float $postageAmount): self
    {
        $this->postageAmount = $postageAmount;
        return $this;
    }

    public function getPayType(): string
    {
        return $this->payType;
    }

    public function setPayType(string $payType): self
    {
        $this->payType = $payType;
        return $this;
    }

    public function isCod(): bool
    {
        return $this->cod;
    }

    public function setCod(bool $cod): self
    {
        $this->cod = $cod;
        return $this;
    }

    public function getNumberOfPackages(): int
    {
        return $this->numberOfPackages;
    }

    public function setNumberOfPackages(int $numberOfPackages): self
    {
        $this->numberOfPackages = $numberOfPackages;
        return $this;
    }

    public function setItems(array $items): self
    {
        $this->items = $items;
        return $this;
    }

    /**
     * @return OrderItem[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    public function getConnectedModel(): ?SellasistConnectedModelInterface
    {
        return $this->connectedModel;
    }

    public function setConnectedModel(?SellasistConnectedModelInterface $connectedModel): void
    {
        $this->connectedModel = $connectedModel;
    }
}
