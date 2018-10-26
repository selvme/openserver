<?php

namespace app\modules\for_scan\models;

use yii\db\ActiveRecord;

class DbScan extends ActiveRecord
{
	public static function tableName()
    {
        return 'scan_img';
    }

    public function rules()
    {
        return [
            [['review_id', 'scan_path'], 'required'],
            [['id', 'entity_id'], 'integer'],
            [['scan_alt', 'scan_title', 'scan_path'], 'string'],
            [['scan_alt', 'scan_title', 'scan_path'], 'trim'],
            [['scan_alt', 'scan_title', 'scan_path'], 'safe'],
        ];
    }

    public static function findScanById($id){
        $data = self::find()
                    ->where([
                        'review_id' => $id,
                    ])
                    ->select('scan_alt, scan_path')
                    ->asArray()
                    ->one();

        return $data;
    }
}