<?php


namespace Interfaces;


interface AddressInterface
{
    public function setFullAddress(string $address): AddressInterface;
}