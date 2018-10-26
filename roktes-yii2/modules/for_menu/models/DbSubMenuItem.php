<?php

namespace app\modules\for_menu\models;

use yii\db\ActiveRecord;

class DbSubMenuItem extends ActiveRecord
{
	public static function tableName()
    {
        return 'menu_subitem';
    }
    public function rules()
    {
        return [
            [['item_id', 'name', 'url'], 'required'],
            [['name', 'url'], 'trim'],
            [['name', 'url'], 'string'],
            ['name', 'safe'],
            ['item_id', 'integer'],
            ['is_parent', 'boolean'],
        ];
    }
}