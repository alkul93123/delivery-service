<?php


namespace DeliveryService;


use Core\AbstractDeliveryService;
use Dtos\DeliveryInfoDto;

class ServiceB extends AbstractDeliveryService
{

    public string $serviceName = 'IGooods';
    protected int $baseCost = 150;

    protected function calculateDeliveryInfo(): DeliveryInfoDto
    {
        // TODO: Тут расчет стоимости доставки с учетом напр. $this->baseCost
    }
}