<?php

namespace app\modules\for_mainCh\models;

use yii\db\ActiveRecord;

class DbMainCh extends ActiveRecord
{
	public static function tableName()
    {
        return 'product_main_ch';
    }

    public function rules()
    {
        return [
            [['id', 'product_id'], 'integer'],
            [['name', 'product_id'], 'required'],
            [['name', 'value'], 'string'],
            [['name', 'value'], 'trim'],
            [['name', 'value'], 'safe'],
        ];
    }

    public static function getAllChForPr($id){
        $data = self::find()
                        ->asArray()
                        ->where(['product_id' => $id])
                        ->all();
        return $data;
    }
}