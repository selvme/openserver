<?php

namespace app\modules\for_page\models;

use app\modules\for_addCh\models\DbAddCh;
use app\modules\for_category\models\DbCategory;
use app\modules\for_img\models\DbImg;
use app\modules\for_mainCh\models\DbMainCh;
use app\modules\for_scan\models\DbScan;
use app\modules\for_typeOfPages\models\DbTypeOfPages;
use yii\db\ActiveRecord;

class DbPage extends ActiveRecord
{
    public static function tableName()
    {
        return "page";
    }

    public function rules()
    {
        return [
            [['type', 'status', 'url', 'title', 'content'], 'required'],
            [['url', 'title', 'description', 'content', 'ttx', 'path_to_video', 'spec_offer_content', 'city', 'meta_title', 'meta_desc', 'meta_key'], 'trim'],
            [['url', 'title', 'description', 'content', 'ttx', 'path_to_video', 'spec_offer_content', 'city', 'meta_title', 'meta_desc', 'meta_key'], 'string'],
            [['title', 'description', 'content', 'ttx', 'path_to_video', 'spec_offer_content', 'city', 'meta_title', 'meta_desc', 'meta_key'], 'safe'],
            [['type', 'category_id', 'price_dollar', 'spec_offer_price'], 'integer'],
            ['date', 'default', 'value' => date('Y-m-d')],
            [['status', 'have_img', 'have_scan', 'is_spec_offer', 'is_block'], 'boolean'],
        ];
    }

    public function getAllItemsByCategory($id){
        $data = self::find()
            ->where(['category_id' => $id,
                'status' => 1])
            ->select('id, url, title, have_img, price_dollar, weight')
            ->asArray()
            ->all();

        return $data;
    }

    public function beforeDelete(){
        $images = DbImg::find()->where(['entity_id' => $this->id])->all();
        foreach ($images as $img){
            unlink($img->path_to_img);
            $img->delete();
        }
    }

    public function getCategoryName(){
        return $this->hasOne(DbCategory::className(), ['id' => 'category_id']);
    }
    public function getTypeName(){
        return $this->hasOne(DbTypeOfPages::className(), ['id' => 'type']);
    }
    public function getImages(){
        return $this->hasMany(DbImg::className(), ['entity_id' => 'id']);
    }
    public function getScan(){
        return $this->hasMany(DbScan::className(), ['review_id' => 'id']);
    }
    public function getMainCharacteristics(){
        return $this->hasMany(DbMainCh::className(), ['product_id' => 'id']);
    }
    public function getAddCharacteristics(){
        return $this->hasMany(DbAddCh::className(), ['product_id' => 'id']);
    }
}