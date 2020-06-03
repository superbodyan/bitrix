<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\hashit\PrUser as PRUS;

class UserEditMainInfo extends CBitrixComponent
{
    public function executeComponent()
    {
        if($this->startResultCache())//startResultCache используется не для кеширования html, а для кеширования arResult
        {
            if (CModule::IncludeModule("hashit")) {
                $pruser = New \Bitrix\hashit\PrUser();
                $pruser->GetUserInfo();
                $this->arResult = array(
                    "ID" => $pruser->getPID(),
                    "FAMILY" => $pruser->getFamily(),
                    "NAME" => $pruser->getPName(),
                    "USER_GROUP" => $pruser->getUserGId(),
                    "PERSONAL_PHOTO" => CFile::GetPath($pruser->getMainphoto()),
                );
                $this->arResult['ONLINE'] = $pruser->CheckOnline();
            }
            $this->includeComponentTemplate();
        }
        return $this->arResult["Y"];
    }
};

?>