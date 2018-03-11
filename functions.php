<?php
/**
 * Created by PhpStorm.
 * User: Андрей
 * Date: 10.03.2018
 * Time: 0:30
 */

function task1 (){
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

function task2($arr){
    // Преобразование в JSON и запись в первый файл
    $en = json_encode($arr);
    file_put_contents('output.json', $en);

    // Читаем первый файл
    $jsonString = file_get_contents('output.json');
    $dataOne = json_decode($jsonString, true);

    // Меняем данные в массиве и записываем их во второй файл
    $dataTwoReplace = [['a' => 66, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5],['q' => 88, 's' => 25, 'z' => 33, 't' => 49, 'o' => 56]];
    $basket = array_replace($dataOne,$dataTwoReplace);
    $newJsonString = json_encode($basket);
    file_put_contents('output2.json', $newJsonString);

    // Читаем второй файл
    $get = file_get_contents('output2.json');
    $dataTwo = json_decode($get,true);

    // Проверяем расхождения массивов
    for($i=0;$i<2;$i++) {
        $result1 = array_diff($dataOne[$i], $dataTwo[$i]);
        $result2 = array_diff($dataTwo[$i], $dataOne[$i]);
        print_r($result1);
        print_r($result2);
    }
}

function task3 (){
    // Создание массива из случайных чисел
    for($i=0; $i<50; $i++) {
        $arr[$i] = rand(1,100);
    }
    $arrayTwo[] = $arr;

    // Открытие файла и запись в файл
    $fp = fopen('task3.csv', 'w');

    foreach ($arrayTwo as $fields) {
        fputcsv($fp, $fields);
    }

    fclose($fp);
    $sum = 0;
    for($i=0;$i<count($arr);$i++)
    {
        if($arr[$i] % 2==0)
        {
            echo $arr[$i].' - четное.' . "\n";
            $sum += $arr[$i];
            //echo "Сумма: " . $sum . "\n";

        }
    }
    echo "Сумма: " . $sum . "\n";
}

