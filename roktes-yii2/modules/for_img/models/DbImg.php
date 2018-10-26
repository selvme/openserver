<?php

namespace app\modules\for_img\models;

use yii\db\ActiveRecord;

class DbImg extends ActiveRecord
{
	public static function tableName()
    {
        return 'page_img';
    }

    public function rules()
    {
        return [
            [['entity_id', 'path_to_img'], 'required'],
            [['id', 'entity_id', 'weight'], 'integer'],
            [['img_alt', 'img_title', 'path_to_img'], 'string'],
            [['img_alt', 'img_title', 'path_to_img'], 'trim'],
            [['img_alt', 'img_title', 'path_to_img'], 'safe'],
        ];
    }

    public static function findImgById($id){
        $data = self::find()
                    ->where([
                        'entity_id' => $id,
                    ])
                    ->asArray()
                    ->one();
        return $data;
    }

    public static function findAllImgById($id){
        $data = self::find()
                    ->where([
                        'entity_id' => $id,
                    ])
                    ->asArray()
                    ->all();

        return $data;
    }
}