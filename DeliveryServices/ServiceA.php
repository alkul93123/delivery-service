<?php


namespace DeliveryService;


use Core\AbstractDeliveryService;
use Dtos\DeliveryInfoDto;

class ServiceA extends AbstractDeliveryService
{
    public string $defaultServiceName = 'СберМаркет';


    /**
     * Для примера, я же не могу знать как рассчитывается кол-во дней
     *
     * @return int
     */
    protected function calculateDays(): int
    {
        return 1;
    }

    protected function calculateDeliveryInfo(): DeliveryInfoDto
    {
        // TODO: Тут расчет стоимости доставки.
    }
}