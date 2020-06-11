<?php
require ($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");


if (CModule::IncludeModule("nkhost.phpexcel")) {
    global $PHPEXCELPATH;
    require_once($PHPEXCELPATH . '/PHPExcel.php');
    require_once($PHPEXCELPATH . '/PHPExcel/Writer/Excel5.php');


    $PHPExcel_file = PHPExcel_IOFactory::load($_FILES['file']['tmp_name']);

/*
    foreach ($PHPExcel_file->getWorksheetIterator() as $worksheet) {
        $highestRow = $worksheet->getHighestRow(); // получаем количество строк
        $highestColumn = $worksheet->getHighestColumn(); // а так можно получить количество колонок
        $lists = $PHPExcel_file->getActiveSheet();

        for ($row = 2; $row <= $highestRow; $row++) // обходим все строки
        {
            $cell1 = $worksheet->getCellByColumnAndRow(0, $row); // Фирма
            $cell2 = $worksheet->getCellByColumnAndRow(1, $row); // Объём
            $cell3 = $worksheet->getCellByColumnAndRow(2, $row); // Модель
            $cell4 = $worksheet->getCellByColumnAndRow(3, $row); // Ревизия платы
            $cell5 = $worksheet->getCellByColumnAndRow(4, $row); // S/N
            $cell6 = $worksheet->getCellByColumnAndRow(5, $row); // MLC
            $cell7 = $worksheet->getCellByColumnAndRow(6, $row); // Интерфейс платы

            if (CModule::IncludeModule("iblock"))
            {
                $el = new CIBlockElement;

                $PROP = array();
                $PROP[14] = $cell1; // Фирма
                $PROP[15] = $cell2; // Объем
                $PROP[16] = $cell3; // Модель
                $PROP[19] = $cell4; // Ревизия платы
                $PROP[20] = $cell5; // S/N
                $PROP[21] = $cell6; // MLC
                $PROP[18] = $cell7; // Интерфейс платы

                $arLoadProductArray = Array(
                    "MODIFIED_BY"    => $USER->GetID(), // элемент изменен текущим пользователем
                    "IBLOCK_SECTION_ID" => false,          // элемент лежит в корне раздела
                    "IBLOCK_ID"      => 5,
                    "PROPERTY_VALUES"=> $PROP,
                    "NAME"           => "Жесткий диск " . $cell2 . " " . $cell4,
                    "ACTIVE"         => "Y",            // активен
                );

                if($PRODUCT_ID = $el->Add($arLoadProductArray))
                    echo "New ID: ".$PRODUCT_ID;
                else
                    echo "Error: ".$el->LAST_ERROR;
            }

        // Добавление в инфоблок

        }
    }

*/

$arr = array();

    foreach ($PHPExcel_file->getAllSheets() as $arSheet)
    {
        $highestRow = $arSheet->getHighestRow(); // получаем количество строк
        $highestColumn = $arSheet->getHighestColumn(); // а так можно получить количество колонок
        // echo $arSheet->getTitle() . "<br>";
        //echo $arSheet->getHighestRow() . "<br>";

        for ($row = 3; $row <= $highestRow; $row++) // обходим все строки
        {
            $cell1 = $arSheet->getCellByColumnAndRow(2, $row); // Фирма
            $cell2 = $arSheet->getCellByColumnAndRow(3, $row); // Объём
            $cell3 = $arSheet->getCellByColumnAndRow(4, $row); // Модель
            $cell4 = $arSheet->getCellByColumnAndRow(5, $row); // Ревизия платы
            $cell5 = $arSheet->getCellByColumnAndRow(6, $row); // S/N
            $cell6 = $arSheet->getCellByColumnAndRow(7, $row); // MLC
            $cell7 = $arSheet->getCellByColumnAndRow(8, $row); // Интерфейс платы

            if (CModule::IncludeModule("iblock"))
            {
                $el = new CIBlockElement;

                $PROP = array();
                $PROP[14] = $cell1; // Фирма
                $PROP[15] = $cell2; // Объем
                $PROP[16] = $cell3; // Модель
                $PROP[19] = $cell4; // Ревизия платы
                $PROP[20] = $cell5; // S/N
                $PROP[21] = $cell6; // MLC
                $PROP[18] = $cell7; // Интерфейс платы

                $arLoadProductArray = Array(
                    "MODIFIED_BY"    => $USER->GetID(), // элемент изменен текущим пользователем
                    "IBLOCK_SECTION_ID" => false,          // элемент лежит в корне раздела
                    "IBLOCK_ID"      => 5,
                    "PROPERTY_VALUES"=> $PROP,
                    "NAME"           => "Жесткий диск " . $cell2 . " " . $cell4,
                    "ACTIVE"         => "Y",            // активен
                );

                if($PRODUCT_ID = $el->Add($arLoadProductArray))
                    echo "New ID: ".$PRODUCT_ID;
                else
                    echo "Error: ".$el->LAST_ERROR;
            }
        }

    }

}