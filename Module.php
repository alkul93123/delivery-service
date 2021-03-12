<?php


use Core\AbstractDeliveryService;
use Dtos\DeliveryInfoDto;
use Exceptions\ModuleException;

class Module
{
    public array $deliveryServices = [];

    public function __construct(AbstractDeliveryService $service)
    {
        $this->deliveryServices[] = $service;
    }

    /**
     * Добавить сервис доставки
     *
     * @param AbstractDeliveryService $service
     * @return $this
     * @throws ModuleException
     */
    public function addDeliveryService(AbstractDeliveryService $service) : Module
    {
        /** @var AbstractDeliveryService $deliveryService */
        foreach ($this->deliveryServices as $deliveryService) {
            if ($deliveryService->serviceName === $service->serviceName) {
                throw new ModuleException("Service with name {$service->serviceName} already exists.");
            }
        }

        $this->deliveryServices[] = $service;
        return $this;
    }

    /**
     * Удалить сервис доставки
     *
     * @param string $name
     * @return AbstractDeliveryService
     * @throws ModuleException
     */
    public function getDeliveryService(string $name) : AbstractDeliveryService
    {
        $newDeliveryServices = [];

        /** @var AbstractDeliveryService $deliveryService */
        foreach ($this->deliveryServices as $key => $deliveryService) {
            if ($deliveryService->serviceName === $name) {
                return $deliveryService;
            }
        }

        throw new ModuleException("Delivery service {$name} not found.");
    }

    /**
     * Удалить сервис доставки
     *
     * @param string $name
     * @return Module
     * @throws ModuleException
     */
    public function removeDeliveryService(string $name) : Module
    {
        $newDeliveryServices = [];

        /** @var AbstractDeliveryService $deliveryService */
        foreach ($this->deliveryServices as $key => $deliveryService) {
            if ($deliveryService->serviceName === $name) {
                continue;
            }

            $newDeliveryServices[] = $deliveryService;
        }

        if (count($newDeliveryServices) < 1) {
            throw new ModuleException("Count delivery services must be more than one.");
        }

        $this->deliveryServices = $newDeliveryServices;

        return $this;
    }

    /**
     * Получить информацию по всем сервисам доставки
     *
     * @return DeliveryInfoDto[]
     */
    public function getDeliveryInfo(): array
    {
        $deliveryInfoItems = [];

        foreach ($this->deliveryServices as $deliveryService) {
            $deliveryInfoItems[] = $deliveryService->calculate();
        }

        return $deliveryInfoItems;
    }

    /**
     * Получить информацию по конкретному сервису
     *
     * @param string $serviceName Имя сервсиа
     * @return DeliveryInfoDto
     * @throws ModuleException
     */
    public function getDeliveryInfoForService(string $serviceName): DeliveryInfoDto
    {
        /** @var AbstractDeliveryService $deliveryService */
        foreach ($this->deliveryServices as $deliveryService) {
            if ($deliveryService->serviceName === $serviceName) {
                return $deliveryService->calculate();
            }
        }

        throw new ModuleException("Delivery service with name {$serviceName} not found.");
    }
}