<?php

namespace app\models;

use app\modules\for_img\models\DbImg;
use app\modules\for_page\models\DbPage;
use app\modules\for_scan\models\DbScan;
use Yii;
use yii\base\Model;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    public $file;

    public function rules()
    {
        return [
            ['file', 'file', 'extensions' => ['jpg', 'png'], 'maxSize' => 310000],
        ];
    }
    public function upload($id, $type_page, $type_upload)
    {
        $this->file = UploadedFile::getInstance($this, 'file');
        if ($this->file && $this->validate()) {
            $directory = $this->createDirectory($id, $type_page, $type_upload) . $this->file->baseName . '.' . $this->file->extension;
            $this->file->saveAs($directory);
            $this->saveImgInDb($id, $directory, $type_upload);
            return true;
        } else {
            return false;
        }
    }
//    public function uploadTo($id, $type_page, $type_upload, $file, $weight)
//    {
//        if ($this->validate()) {
//            $directory = $this->createDirectory($id, $type_page, $type_upload);
//            $file->saveAs($directory . $file->baseName . '.' . $file->extension);
//            $this->saveImgInDb($id, $directory, $type_upload, $weight);
//            return true;
//        } else {
//            return false;
//        }
//    }
    private function createDirectory($id, $type_page, $type_upload){
        $dir = Yii::getAlias('@web');
        if ($type_page == 'products'){
            $dir .= 'img/product/' . 'item-' . $id . '/';
        }elseif ($type_page == 'news'){
            $dir .= 'img/news/' . 'item-' . $id . '/';
        }elseif ($type_page == 'reviews' && $type_upload == 'img'){
            $dir .= 'img/reviews/' . 'item-' . $id . '/' . 'scan/';
        }else{
            $dir .= 'img/reviews/' . 'item-' . $id . '/' . 'img/';
        }
        // Создаем папки по пути если их нет
        if (!is_dir($dir)) {
            FileHelper::createDirectory($dir);
        }
        return $dir;
    }
    private function saveImgInDb($id, $dir, $type_upload){
        $img = $this->checkForExistence($type_upload, $dir);
        $page = new DbPage();
        if ($type_upload == 'img'){
            $img->entity_id = $id;
            $img->img_title = '';
            $img->img_alt = '';
            $img->path_to_img = $dir;
            $img->save();
            //Сохраняем маркер наличия изображения на странице
            $page::findOne($id)->have_img = 1;
        }else{
            $img->review_id = $id;
            $img->scan_title = '';
            $img->scan_alt = '';
            $img->scan_path = $dir;
            $img->save();
            //Сохраняем маркер наличия скана на странице
            $page::findOne($id)->have_scan = 1;
        }
    }
    private function checkForExistence($type_upload, $dir)
    {
        if ($type_upload == 'img') {
            $img = new DbImg();
            $is_exist = $img::find()->where(['path_to_img' => $dir])->one();
            $this->deleteImg($is_exist->id);
        } else {
            $img = new DbScan();
            $is_exist = $img::find()->where(['scan_path' => $dir])->one();
            $this->deleteScan($is_exist->id);
        }
        return $img;
    }
    private function deleteImg($id){
        $model = new DbImg();
        $model->findOne($id);
        $page_id = $model->entity_id;
        $model->delete();
        $countOfImg = $model::find()->where(['entity_id' => $page_id])->all();
        if ($countOfImg < 1){
            $page = new DbPage();
            $page->findOne($page_id)->have_img = 0;
            $page->save();
        }
    }
    private function deleteScan($id){
        $model = new DbScan();
        $model->findOne($id);
        $page_id = $model->entity_id;
        $model->delete();
        $countOfImg = $model::find()->where(['entity_id' => $page_id])->all();
        if ($countOfImg < 1){
            $page = new DbPage();
            $page->findOne($page_id)->have_scan = 0;
            $page->save();
        }
    }
}