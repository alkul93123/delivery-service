<?php


namespace Interfaces;


interface ElementRepositoryInterface
{
    public function addElement(ElementDtoInterface $element): ElementRepositoryInterface;
    public function getElements(): array;
}