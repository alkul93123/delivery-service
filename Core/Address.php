<?php


namespace Core;


use Interfaces\AddressInterface;

class Address implements AddressInterface
{
    protected string $fullAddress;
    protected ?float $latitude = null;
    protected ?float $longitude = null;

    public function __construct(string $fullAddress)
    {
        $this->fullAddress = $fullAddress;
    }

    public function setFullAddress(string $address) : AddressInterface
    {
        $this->fullAddress = $address;
    }
}