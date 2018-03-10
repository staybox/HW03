<?php
/**
 * Created by PhpStorm.
 * User: Андрей
 * Date: 10.03.2018
 * Time: 0:30
 */

function OpenXML (){
    if (file_exists('data.xml')) {
        $xml = simplexml_load_file('data.xml');
        echo "Номер заказа: " . $xml->attributes()['PurchaseOrderNumber'] . "\n";
        echo "Дата заказа: " . $xml->attributes()['OrderDate'] . "\n";
        foreach ($xml->Address as $items) {
            echo "--------------"."\n";
            if ($items->attributes() == "Shipping") {
                echo "Адрес доставки: " ."\n";
            }elseif ($items->attributes() == "Billing"){
                echo "Адрес выставления счёта: " ."\n";
            }
            echo "ФИО: " . $items->Name. "\n";
            echo "Страна: " . $items->Country. "\n";
            echo "Штат: " . $items->State. "\n";
            echo "Город: " . $items->City. "\n";
            echo "Индекс: " . $items->Zip. "\n";
            echo "Улица: " . $items->Street. "\n";
        }
        echo "\n";
        echo "Комментарии к заказу: " . $xml->DeliveryNotes . "\n";
        foreach ($xml->Items->Item as $item) {
            echo "--------------"."\n";
            echo "Артикул товара: " . $item->attributes() . "\n";
            echo "Название товара: " . $item->ProductName . "\n";
            echo "Количество: " . $item->Quantity . "\n";
            echo "Стоимость: " . $item->USPrice . "$" ."\n";
            if($item->Comment != ''){
                echo "Комментарий: " . $item->Comment . "\n";
            }elseif ($item->ShipDate != ''){
                echo "День доставки: " . $item->ShipDate . "\n";
            }
        }
    } else {
        exit('Не удалось открыть файл data.xml.');
    }
}
