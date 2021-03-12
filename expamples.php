<?php
/** Напр. нам нужно создать несколько сервисов доставки */



$item = new \Dtos\ElementDto(10, 10, 10);
$item2 = new \Dtos\ElementDto(10, 10, 10);

$senderAddress = new \Core\Address("Москва, ул. Ленина 1");
$recipientAddress = new \Core\Address("Москва, ул. Ленина 2");


$firstService = new \DeliveryService\ServiceA($senderAddress, $recipientAddress, [$item, $item2]);
$secondService = new \DeliveryService\ServiceB($senderAddress, $recipientAddress, [$item, $item2]);

$firstService->setServiceName('СберМаркет');

    try {
        $module = new Module();

        $module->addDeliveryService($firstService);
        $module->addDeliveryService($secondService);

        $module->getDeliveryInfoForService('СберМаркет'); // Для получения информации по одной конкрентной службе
        $module->getDeliveryInfo(); // Для получения информации по одной конкрентной службе

        /** Изменить получателя в сервисе с названием СберМаркет */
        $newRecipientAddress = new \Core\Address('Москва, ул. Ленина 3');
        $module->getDeliveryService('СберМаркет')->setRecipientAddress($newRecipientAddress);

        /** Добавить товары */
        $item3 = new \Dtos\ElementDto(10, 10, 10);
        $module->getDeliveryService('СберМаркет')->addElement($item3);

        /**
         * Если нужно, можно написать свой класс сервиса доставки, унаследовавшись от Core\AbstractDeliveryService
         * и затем добавить  его в модуль
         */



    } catch (\Exceptions\DeliveryServiceException $e) {

        /** TODO: Do something */

    } catch (\Exceptions\ModuleException $e) {

        /** TODO: Do something */

    } catch(\Exceptions\TypeException $e) {

        /** TODO: Do something */

    } finally {
        /** TODO: Do something */
    }
