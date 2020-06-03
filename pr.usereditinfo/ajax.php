<?php
require ($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
//require ($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_after.php");

$COMMAND = $_POST['ajax_task'];

switch ($COMMAND)
{
    case "UpdateInfo":
        if (CModule::IncludeModule("hashit")) {
            $pruser = New \Bitrix\hashit\PrUser();
            $new_name = htmlspecialchars($_POST['U_NAME']);
            $new_family = htmlspecialchars($_POST['U_FAMILY']);
            $new_photo = htmlspecialchars($_POST['U_PHOTO']);
            $pruser->EditPersonalInfo($new_name, $new_family, $new_photo);
        }
        echo "good";
        break;
}

