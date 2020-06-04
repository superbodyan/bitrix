<?php
use ormtest\ORM\OrmTable;

class ormgetlist extends CBitrixComponent
{
    protected function checkModules()
    {
        if (!\Bitrix\Main\Loader::includeModule("ormtest"))
                throw new \Bitrix\Main\LoaderException("Модуль не установлен");
    }



    public function executeComponent()
    {
        $this -> checkModules();
        if($this->startResultCache($arParams['CACHE_TIME'])){
            $this->arResult = $rows = OrmTable::getList(array("select" => array("*")))->fetchAll();
        }
        $this->includeComponentTemplate();
    }
}