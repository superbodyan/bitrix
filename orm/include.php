<?php
/*Bitrix\Main\Loader::registerAutoloadClasses(
    "orm",
    array(
        "ormnew\ORM\OrmnewTable" => "lib/ormnew.php",
    )
);*/

Bitrix\Main\Loader::registerAutoLoadClasses(null, [
    'ormnew\ORM\OrmnewTable' => '/local/modules/orm/lib/ormnew.php'
]);