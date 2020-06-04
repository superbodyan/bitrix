<?

use Bitrix\Main\Loader;
use Bitrix\Main\Entity\Base;
use Bitrix\Main\Application;
global $APPLICATION;


class ormtest extends CModule
{
    var $MODULE_ID = "ormtest";
    var $MODULE_VERSION;
    var $MODULE_VERSION_DATE;
    var $MODULE_NAME;
    var $MODULE_DESCRIPTION;
    var $MODULE_CSS;

    function ormtest()
    {
        $arModuleVersion = array();

        $path = str_replace("\\", "/", __FILE__);
        $path = substr($path, 0, strlen($path) - strlen("/index.php"));
        include($path . "/version.php");

        if (is_array($arModuleVersion) && array_key_exists("VERSION", $arModuleVersion)) {
            $this->MODULE_VERSION = $arModuleVersion["VERSION"];
            $this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
        }

        $this->MODULE_NAME = "ormtest – модуль с компонентом";
        $this->MODULE_DESCRIPTION = "После установки вы сможете пользоваться компонентом";
    }

    function InstallFiles()
    {
        CopyDirFiles($_SERVER["DOCUMENT_ROOT"]."/local/modules/ormtest/install/components",
            $_SERVER["DOCUMENT_ROOT"]."/bitrix/components/ormtest", true, true);
        return true;
    }

    function InstallDB()
    {
       Application::getConnection()->queryExecute("CREATE TABLE IF NOT EXISTS `orm_test`(
        `ID` int NOT NULL AUTO_INCREMENT,
        `NAME` varchar(255) NOT NULL,
        `DATE_INSERT` date NOT NULL,
        PRIMARY KEY(`ID`))"
       );
    }

    function UnInstallDB()
    {
        Loader::includeModule($this->MODULE_ID);
        \Bitrix\Main\Application::getConnection(\ormtest\ORM\ProdPrmTable::getConnectionName())->
        queryExecute('drop table if exists' . \Bitrix\Main\Entity\Base::getInstance("\ormtest\ORM\ProdPrmTable")->getDBTableName());
        \Bitrix\Main\Config\Option::delete($this->MODULE_ID);
    }


    function DoInstall()
    {
        global $DOCUMENT_ROOT, $APPLICATION;
        $this->InstallDB();
        RegisterModule("ormtest");
        $APPLICATION->IncludeAdminFile("Установка модуля ormtest", $DOCUMENT_ROOT . "/local/modules/ormtest/install/step.php");
    }



    function DoUninstall()
    {
        global $DOCUMENT_ROOT, $APPLICATION;
        $this->UnInstallDB();
        UnRegisterModule("ormtest");
        $APPLICATION->IncludeAdminFile("Деинсталляция модуля ormtest", $DOCUMENT_ROOT . "/local/modules/ormtest/install/unstep.php");
    }
}

?>