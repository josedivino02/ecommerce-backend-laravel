<?php

namespace App\Order\DTOs;

use App\Order\Enums\{OrderStatus, PaymentMethod, PaymentStatus, ShippingMethod, ShippingStatus};

class CreateOrderDTO
{
    /**
     * @param array<int, array<string, mixed>> $items
     */
    public function __construct(
        public string $uuid,
        public readonly string $shipping_address,
        public readonly string $billing_address,
        public readonly PaymentMethod $payment_method,
        public readonly ShippingMethod $shipping_method,
        public readonly int $shipping_costs_id,
        public readonly float $discount,
        public array $items,
        public PaymentStatus $payment_status,
        public ShippingStatus $shipping_status,
        public OrderStatus $status,
        public string $verification_code,
        public float $total_price = 0,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function make(array $data): self
    {
        return new self(
            uuid: "",
            shipping_address: $data["shipping_address"],
            billing_address: $data["billing_address"],
            payment_method: PaymentMethod::from($data["payment_method"]),
            shipping_method: ShippingMethod::from($data["shipping_method"]),
            shipping_costs_id: $data["shipping_costs_id"],
            discount: $data["discount"],
            items: $data["items"],
            payment_status: PaymentStatus::PENDING,
            shipping_status: ShippingStatus::PROCESSING,
            status: OrderStatus::PENDING,
            verification_code: "",
            total_price: 0,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
