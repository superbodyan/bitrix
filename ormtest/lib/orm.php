<?php
namespace ormtest\ORM;

use \Bitrix\Main\Entity;
use \Bitrix\Main\Type;


class OrmTable extends Entity\DataManager
{
    public static function getTableName()
    {
        return "orm_test";
    }

    public static function getConnectionName()
    {
        return "default";
    }

    public static function getMap()
    {
        return array(
            new Entity\IntegerField('ID', array(
                'primary' => true,
                "autocomplete" => true
            )),
            new Entity\StringField("NAME"),
            new Entity\DatetimeField("DATE_INSERT", array(
                "default_value" => new Type\DateTime,
                )),
        );
    }
}