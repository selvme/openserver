<?php

namespace app\modules\for_category\models;

use Imagine\Image\ManipulatorInterface;
use Yii;
use yii\db\ActiveRecord;
use app\modules\for_page\models\DbPage;
use app\modules\for_mainCh\models\DbMainCh;
use app\modules\for_img\models\DbImg;
use yii\helpers\BaseStringHelper;
use yii\imagine\BaseImage;

class DbCategory extends ActiveRecord
{
	public static function tableName()
    {
        return 'category';
    }

    public function rules()
    {
        return [
            [['url', 'title', 'meta_desc', 'meta_key', 'meta_title'], 'required'],
            [['url', 'title', 'description', 'meta_title', 'meta_desc', 'meta_key'], 'trim'],
            [['url', 'title', 'description', 'meta_title', 'meta_desc', 'meta_key'], 'string'],
            [['title', 'description', 'meta_title', 'meta_desc', 'meta_key'], 'safe'],
            ['parent_menu_item', 'integer'],
            [['is_menu_item', 'is_parent'], 'boolean'],
        ];
    }

    public function getNameAll(){
        $data = [];
    	$select = self::find()->all();
        for ($i=0; $i<count($select); $i++) {
            $data[$i] = [   'id' => $select[$i]['id'],
                            'title' => $select[$i]['title'],
                            'url' => $select[$i]['url'],
                        ];
        }
        return $data;
    }

    public function findByUrl($url){
        $data = self::find()
                        ->where(['url' => $url])
                        ->one();
        return $data;
    }

    public function getDesc($id){
        $data = self::find()
                        ->asArray()
                        ->where(['id' => $id])
                        ->select('title, url, description')
                        ->one();
        return $data;
    }

    public function getAllPrPreview($id){
        $page = new DbPage();
        $items = $page->getAllItemsByCategory($id);
        for ($i=0; $i<count($items); $i++) {
            if ($items[$i]['have_img'] == 1) {
                $img = DbImg::findImgById($items[$i]['id']);
                $dir = Yii::getAlias('@web') . "thumbs/" . "thumb_250x400_" .BaseStringHelper::basename($img['path_to_img']);
                if (!file_exists($dir)){
                    BaseImage::thumbnail($img['path_to_img'], 250, 400 , ManipulatorInterface::THUMBNAIL_INSET)->save($dir);
                    $items[$i] += ['image' => ['path_to_img' => $dir]];
                }else{
                    $items[$i] += ['image' => ['path_to_img' => $dir]];
                }
            }
            $items[$i] += [ 'main_ch' => DbMainCh::getAllChForPr($items[$i]['id']) ];
        }
        return $items;
    }
}