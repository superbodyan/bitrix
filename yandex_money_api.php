<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("test");
global $USER;

$secr = "KEYKEYKEYKEYKEYK";

$hash = sha1($_POST['notification_type'].'&'.
    $_POST['operation_id'].'&'.
    $_POST['amount'].'&'.
    $_POST['currency'].'&'.
    $_POST['datetime'].'&'.
    $_POST['sender'].'&'.
    $_POST['codepro'].'&'.
    $secr .'&'.
    $_POST['label']);


if ($_POST['sha1_hash'] != $hash) {
    exit();
}

if (CModule::IncludeModule("iblock"))
{
    $el = new CIBlockElement;

    $PROP = array();
    $PROP[32] = $_POST['label'];  // свойству с кодом 12 присваиваем значение "Белый"
    $PROP[33] = $_POST['amount'];  // свойству с кодом 12 присваиваем значение "Белый"
    $PROP[34] = $_POST['datetime'];  // свойству с кодом 12 присваиваем значение "Белый"


    $arLoadProductArray = Array(
        "IBLOCK_ID" => 15,
        "PROPERTY_VALUES" => $PROP,
        "NAME" => "Элемент",
    );

    if ($PRODUCT_ID = $el->Add($arLoadProductArray))
        echo "New ID: " . $PRODUCT_ID;
    else
        echo "Error: " . $el->LAST_ERROR;

}
$ID = $_POST['label'];
$user = new CUser;
$fields = array(
    "UF_BALANCE" => $_POST['amount'],
);
$user->Update($ID, $fields);