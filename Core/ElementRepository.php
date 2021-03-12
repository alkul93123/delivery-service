<?php


namespace Core;


use Interfaces\ElementDtoInterface;
use Interfaces\ElementRepositoryInterface;

class ElementRepository implements ElementRepositoryInterface
{
    protected array $elements = [];

    /**
     * @param ElementDtoInterface $element
     * @return ElementRepository
     */
    public function addElement(ElementDtoInterface $element) : ElementRepository
    {
        $this->elements[] = $element;
        return $this;
    }

    /**
     * @return ElementDtoInterface[]
     */
    public function getElements() : array
    {
        return $this->elements;
    }

    public function isEmpty(): bool
    {
        return empty($this->elements);
    }
}