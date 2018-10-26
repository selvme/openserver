<?php

namespace app\modules\ymr\controllers;

use app\models\UploadForm;
use app\modules\for_addCh\models\DbAddCh;
use app\modules\for_img\models\DbImg;
use app\modules\for_mainCh\models\DbMainCh;
use app\modules\for_scan\models\DbScan;
use Yii;
use app\modules\for_page\models\DbPage;
use app\modules\for_page\models\DbPageSearch;
use app\modules\for_typeOfPages\models\DbTypeOfPages;
use app\modules\for_category\models\DbCategory;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DbPageController implements the CRUD actions for DbPage model.
 */
class DbPageController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }
    /**
     * Lists all DbPage models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DbPageSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DbPage model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new DbPage model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $types = DbTypeOfPages::find()->all();
        $categories = DbCategory::find()->all();
        $model = new DbPage();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'cats' => $categories,
            'types' => $types,
        ]);
    }

    /**
     * Updates an existing DbPage model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $types = DbTypeOfPages::find()->all();
        $categories = DbCategory::find()->all();
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('update', [
            'model' => $model,
            'cats' => $categories,
            'types' => $types,
        ]);
    }

    /**
     * Deletes an existing DbPage model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the DbPage model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DbPage the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DbPage::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function actionUpload($id, $type_page, $type_upload)
    {
        $model = new UploadForm();
        $currentImg = new DbImg();
        $page = DbPage::findOne($id);
        if ($type_page == 'products' || $type_page == 'news'){
            $currentImg = $currentImg::find()->where(['entity_id' => $id])->all();
        }else{
            $currentImg = new DbScan();
            $currentImg = $currentImg::find()->where(['reviews_id' => $id])->all();
        }
        if (Yii::$app->request->isPost) {
            if ($model->upload($id, $type_page, $type_upload)){
                $page->have_img = 1;
                $page->save();
            }
            $this->refresh();
        }
        return $this->render('upload', [
            'model' => $model,
            'images' => $currentImg,
        ]);
    }

    /**
     * @return DbImg|DbScan
     * @throws HttpException
     */
    public function actionChangeParamImg(){
        if (Yii::$app->request->isPost){
            $img = new DbImg();
            $scan = new DbScan();
            if ($img->load(Yii::$app->request->post())){
                $img = $img::findOne($_POST['DbImg']['id']);
                if ($img->load(Yii::$app->request->post()) && $img->validate()){
                    $img->save();
                    return $img;
                }
            }
            if($scan->load(Yii::$app->request->post())){
                $scan = $scan::findOne($_POST['DbScan']['id']);
                if ($scan->load(Yii::$app->request->post()) && $scan->validate()){
                    $scan->save();
                    return $scan;
                }
            }
        }
    }

    public function actionShowParams($id){
        $modelPage = DbPage::findOne($id);
        $newAddCh = new DbAddCh();
        $newMainCh = new DbMainCh();
        $addCh = $modelPage->getAddCharacteristics()->all();
        $mainCh = $modelPage->getMainCharacteristics()->all();

        if (Yii::$app->request->isPost){
            if ($newMainCh->load(Yii::$app->request->post())){
                if ($newMainCh->validate()){
                    $newMainCh->save();
                    return $this->refresh();
                }else{
                    return print_r($newMainCh->getErrors());
                }
            }
            if ($newAddCh->load(Yii::$app->request->post())){
                if ($newAddCh->validate()){
                    $newAddCh->save();
                    return $this->refresh();
                }else{
                    return print_r($newAddCh->getErrors());
                }
            }
        }
        return $this->render('parameters', [
            'model' => $modelPage,
            'addCh' => $addCh,
            'mainCh' => $mainCh,
            'newAddCh' => $newAddCh,
            'newMainCh' => $newMainCh,
        ]);
    }

    public function actionDelParam(){
        if (Yii::$app->request->isPost){
            $addCh = new DbAddCh();
            $mainCh = new DbMainCh();
            if ($addCh->load(Yii::$app->request->post())){
                $addCh::findOne($_POST['DbAddCh']['id'])->delete();
            }
            if ($mainCh->load(Yii::$app->request->post())){
                $mainCh::findOne($_POST['DbMainCh']['id'])->delete();
            }
            return "OK";
        }
    }

    public function actionChangeParam(){
        if (Yii::$app->request->isPost){
            $addCh = new DbAddCh();
            $mainCh = new DbMainCh();
            if ($addCh->load(Yii::$app->request->post())){
                $addCh = $addCh::findOne($_POST['DbAddCh']['id']);
                if ($addCh->load(Yii::$app->request->post()) && $addCh->validate()){
                    $addCh->save();
                    return $addCh;
                }
            }
            if ($mainCh->load(Yii::$app->request->post())){
                $mainCh = $mainCh::findOne($_POST['DbMainCh']['id']);
                if ($mainCh->load(Yii::$app->request->post()) && $mainCh->validate()){
                    $mainCh->save();
                    return $mainCh;
                }
            }
        }
    }

    public function actionDelImg(){
        if (Yii::$app->request->isPost){
            $img = new DbImg();
            $scan = new DbScan();
            if ($img->load(Yii::$app->request->post())){
                $img::findOne($_POST['DbImg']['id'])->delete();
            }
            if ($scan->load(Yii::$app->request->post())){
                $scan::findOne($_POST['DbScan']['id'])->delete();
            }
            return "Image was be deleted!";
        }else{
            throw new HttpException("Don't find the model of IMG/SCAN in the query!");
        }
    }
}
