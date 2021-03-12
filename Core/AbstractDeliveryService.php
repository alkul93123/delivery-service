<?php


namespace Core;


use Dtos\DeliveryInfoDto;
use Exceptions\DeliveryServiceException;
use Exceptions\TypeException;
use Interfaces\AddressInterface;
use Interfaces\ElementDtoInterface;
use Interfaces\ElementRepositoryInterface;

abstract class AbstractDeliveryService
{
    /**
     * @var string Название сервиса доставки
     */
    public string $serviceName = 'Default Service';

    protected ElementRepositoryInterface $repository;

    protected ?AddressInterface $recipientAddress = null;
    protected ?AddressInterface $senderAddress = null;

    /**
     * AbstractDeliveryService constructor.
     * @param AddressInterface|null $recipientAddress
     * @param AddressInterface|null $senderAddress
     * @param array|null $elements
     * @throws TypeException
     */
    public function __construct(?AddressInterface $senderAddress = null, ?AddressInterface $recipientAddress = null, ?array $elements = null)
    {
        $this->repository = $repository ?? new ElementRepository();

        $this->recipientAddress = $recipientAddress;
        $this->senderAddress = $senderAddress;
        if (!empty($elements)) {
            $this->addElements($elements);
        }
    }

    public function setRepository(ElementRepositoryInterface $repository): AbstractDeliveryService
    {
        $this->repository = $repository;
        return $this;
    }

    public function setServiceName(string $name): AbstractDeliveryService
    {
        $this->serviceName = $name;
        return $this;
    }

    /**
     * @param AddressInterface $address
     * @return AbstractDeliveryService
     */
    public function setRecipientAddress(AddressInterface $address) : AbstractDeliveryService
    {
        $this->recipientAddress = $address;
        return $this;
    }

    /**
     * @param AddressInterface $address
     * @return AbstractDeliveryService
     */
    public function setSenderAddress(AddressInterface $address) : AbstractDeliveryService
    {
        $this->senderAddress = $address;
        return $this;
    }

    /**
     * Добавить один элемент
     *
     * @param ElementDtoInterface $element
     * @return $this
     */
    public function addElement(ElementDtoInterface $element): AbstractDeliveryService
    {
        $this->repository->addElement($element);
        return $this;
    }

    /**
     * Добавить несколько элементов
     *
     * @param array $elements
     * @return AbstractDeliveryService
     * @throws TypeException
     */
    public function addElements(array $elements): AbstractDeliveryService
    {
        foreach ($elements as $element) {
            if (!($element instanceof ElementDtoInterface)) {
                throw new TypeException("Element must be instance of " . ElementDtoInterface::class);
            }

            $this->repository->addElement($element);
        }

        return $this;
    }

    /**
     * Метод, который будет переопределен в дочерних классах, он как раз и будет отвечать за расчет
     *
     * @return DeliveryInfoDto
     */
    abstract protected function calculateDeliveryInfo(): DeliveryInfoDto;

    /**
     * Рассчитать стоимость доставки
     *
     * @return DeliveryInfoDto
     * @throws DeliveryServiceException
     */
    public function calculate(): DeliveryInfoDto
    {
        if (!$this->recipientAddress) {
            throw new DeliveryServiceException("Recipient Address must by set.");
        }

        if (!$this->senderAddress) {
            throw new DeliveryServiceException("Recipient Address must by set.");
        }

        if ($this->repository->isEmpty()) {
            throw new DeliveryServiceException("Recipient Address must by set.");
        }


        return $this->calculateDeliveryInfo();
    }
}