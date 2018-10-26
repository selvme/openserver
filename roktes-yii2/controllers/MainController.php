<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\SignupForm;
use app\models\User;
use app\models\LoginForm;

class MainController extends Controller
{
	public function clearUrl($url){
	    if (strripos($url, '?')){
	        $result = substr($url, 0, strripos($url, '?'));
	        $result = trim($result, "/");
        }else{
	        $result = trim($url, "/");
	        return $result;
        }
        return $result;
    }
	public function actionError(){
		$this->layout = "empty";
		return $this->render('404');
	}

	public function actionAppmanager(){
        $this->layout = 'login';

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goHome();
        }
        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionYmr(){
	    $this->layout = '@app/modules/ymr/views/layouts/main';

        if (!Yii::$app->user->isGuest) {
            return $this->render('@app/modules/ymr/views/main/index');
        }
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goHome();
        }
        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout(){
        Yii::$app->user->logout();
        return $this->goHome();
    }

	// public function actionSignup()
 //    {
 //        $model = new SignupForm();
 
 //        if ($model->load(Yii::$app->request->post())) {
 //            if ($user = $model->signup()) {
 //                if (Yii::$app->getUser()->login($user)) {
 //                    return $this->goHome();
 //                }
 //            }
 //        }
 
 //        return $this->render('signup', [
 //            'model' => $model,
 //        ]);
 //    }
//    public function actionAddAdmin() {
//        $model = User::find()->where(['username' => 'adminr'])->one();
//        if (empty($model)) {
//            $user = new User();
//            $user->username = 'adminr';
//            $user->email = 'admin@roktes.ru';
//            $user->setPassword('WwUL9oKX~xGjEH&=');
//            $user->generateAuthKey();
//            if ($user->save()) {
//                echo 'good';
//            }
//        }
//    }
}
