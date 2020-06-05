<?php


class ormgetlist extends CBitrixComponent
{
    protected function checkModules()
    {
        if (!\Bitrix\Main\Loader::includeModule("orm"))
                throw new \Bitrix\Main\LoaderException("Модуль не установлен");
    }



    public function executeComponent()
    {
        $this -> checkModules();
        if($this->startResultCache($arParams['CACHE_TIME'])){
            $this->arResult = $rows = \ormnew\ORM\OrmnewTable::getList(array("select" => array("*")))->fetchAll();
        }
        $this->includeComponentTemplate();
    }
}