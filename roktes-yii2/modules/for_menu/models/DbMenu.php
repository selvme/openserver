<?php

namespace app\modules\for_menu\models;

use yii\db\ActiveRecord;

class DbMenu extends ActiveRecord
{
	public static function tableName()
    {
        return 'menu_name';
    }
}