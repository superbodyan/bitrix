<?
require_once( $_SERVER['DOCUMENT_ROOT'] . '/local/modules/orm/include.php');
use Bitrix\Main\Loader;
use Bitrix\Main\Entity\Base;
use Bitrix\Main\Application;
use ormnew\ORM\OrmnewTable;
global $APPLICATION;


class orm extends CModule
{
    var $MODULE_ID = "orm";
    var $MODULE_VERSION;
    var $MODULE_VERSION_DATE;
    var $MODULE_NAME;
    var $MODULE_DESCRIPTION;
    var $MODULE_CSS;

    function orm()
    {
        $arModuleVersion = array();

        $path = str_replace("\\", "/", __FILE__);
        $path = substr($path, 0, strlen($path) - strlen("/index.php"));
        include($path . "/version.php");

        if (is_array($arModuleVersion) && array_key_exists("VERSION", $arModuleVersion)) {
            $this->MODULE_VERSION = $arModuleVersion["VERSION"];
            $this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
        }

        $this->MODULE_NAME = "orm – модуль с компонентом";
        $this->MODULE_DESCRIPTION = "После установки вы сможете пользоваться компонентом";
    }


    function InstallFiles()
    {
        CopyDirFiles($_SERVER["DOCUMENT_ROOT"]."/local/modules/orm/install/components",
            $_SERVER["DOCUMENT_ROOT"]."/local/components/orm", true, true);
        return true;
    }

    function UnInstallFiles()
    {
        DeleteDirFilesEx("/local/components/orm");
        return true;
    }

    function InstallDB()
    {
        Loader::includeModule($this->MODULE_ID);
        $db = Application::getConnection();
        $storeEntity = OrmnewTable::getEntity();
        if (! $db->isTableExists($storeEntity->getDBTableName()))
        {
            $storeEntity->createDbTable();
        }
    }

    function UnInstallDB()
    {
        Loader::includeModule($this->MODULE_ID);
        \Bitrix\Main\Application::getConnection(OrmnewTable::getConnectionName())->
        queryExecute('drop table if exists ' . \Bitrix\Main\Entity\Base::getInstance("\ormnew\ORM\OrmnewTable")->getDBTableName());
        \Bitrix\Main\Config\Option::delete($this->MODULE_ID);
    }


    function DoInstall()
    {
        global $DOCUMENT_ROOT, $APPLICATION;
        $this->InstallDB();
        $this->InstallFiles();
        RegisterModule("orm");
        $APPLICATION->IncludeAdminFile("Установка модуля orm", $DOCUMENT_ROOT . "/local/modules/orm/install/step.php");
    }



    function DoUninstall()
    {
        global $DOCUMENT_ROOT, $APPLICATION;
        $this->UnInstallDB();
        $this->UnInstallFiles();
        UnRegisterModule("orm");
        $APPLICATION->IncludeAdminFile("Деинсталляция модуля orm", $DOCUMENT_ROOT . "/local/modules/orm/install/unstep.php");
    }
}

?>