<?php

namespace app\modules\for_typeOfPages\models;

use yii\db\ActiveRecord;

class DbTypeOfPages extends ActiveRecord
{
    public static function tableName()
    {
        return "type_of_pages";
    }
}