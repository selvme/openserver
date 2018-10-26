<?php

namespace app\modules\for_menu\models;

use yii\db\ActiveRecord;

class DbMenuItem extends ActiveRecord
{
	public static function tableName()
    {
        return 'menu_item';
    }
}