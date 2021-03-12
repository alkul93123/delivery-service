<?php


namespace Dtos;


class DeliveryInfoDto
{
    public ?float $deliveryCost = null;
    public ?int $days = null;
    public ?float $coefficient = null;

    public function __construct(float $cost = null, float $days = null, float $coefficient = null)
    {
        $this->deliveryCost = $cost;
        $this->days = $days;
        $this->coefficient = $coefficient;
    }
}